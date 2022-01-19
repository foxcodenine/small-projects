from my_app import app, db
from flask import Blueprint, render_template, redirect, request, url_for, jsonify, session, flash, Markup

from my_app.modules.forms import ClientForm, DeleteAllForm
from my_app.modules.database import JFW_Clients
from flask_login import login_required

from datetime import datetime, timezone, tzinfo

from sqlalchemy import asc, desc

# ______________________________________________________________________


my_clients = Blueprint('my_clients', __name__, url_prefix='/clients')


# ______________________________________________________________________
# ______________________________________________________________________



@my_clients.route('/all-clients/')
@login_required
def all_clients():

    # ---- sorting table when click row header --------------------
    
    sort_column = 'id'
    sort_dir = 'DESC'

    form = DeleteAllForm()

    if len(request.args) >= 2:
        sort_column = request.args['sort']
        sort_dir = request.args['dirc']
    
    if sort_dir == 'ASC':
        sort = asc(sort_column)
    else:
        sort = desc(sort_column)     


    # ---- geting list of clients from db -------------------------

    clients = JFW_Clients.query.order_by(sort).all()


    # ---- looping clients ----------------------------------------

    # i is use to add 'clients__shade' class on each alternating row
    i = 1 

    for c in clients:
        i = i * -1
        if i < 0:
            c._class = 'clients__row clients__shade'
        else:
            c._class = 'clients__row'

        # update utctime to local timezone and changing date format
        local_time_zone = datetime.now() - datetime.utcnow()
        c.registered = c.registered + local_time_zone
        c.registered = c.registered.strftime('%d-%B-%Y | %X')

    # ------------------------------------------------------------

    return render_template('clients/all-clients.html', clients=clients, edit=None, form=form)


# _____________________________
# _____________________________


@my_clients.route('/add', methods=['POST', 'GET'])
@login_required
def add_client():


    form = ClientForm() 
   
    if form.validate_on_submit():        

        title = form.title.data
        firstname = form.firstname.data
        lastname = form.lastname.data
        id_card = form.id_card.data
        company = form.company.data
        filenumber = form.filenumber.data
        phone = form.phone.data
        mobile = form.mobile.data
        email = form.email.data
        street = form.street.data
        city = form.city.data
        country = form.country.data
        postcode = form.postcode.data

        if not filenumber: filenumber = 0
        if not phone: phone = 0
        if not mobile: mobile = 0
        

        new_client = JFW_Clients(
                        title=title, firstname=firstname, lastname=lastname,
                        id_card=id_card, company=company, filenumber=filenumber,
                        phone=phone, mobile=mobile, email=email, street=street, 
                        city=city, country=country, postcode=postcode
                    )
        db.session.add(new_client)
        db.session.commit()    

        flash(
            'Client has been added successfully!'
            , 'flash flash--success'
        )

        return redirect(url_for('my_clients.all_clients'))


    return render_template('clients/add-client.html', form=form)

# _____________________________
# _____________________________


@my_clients.route('/edit-client/<id>/', methods=['POST', 'GET'])
@login_required
def edit_client(id):

    form = ClientForm() 

    client = JFW_Clients.query.filter_by(id=id).first()
    form.title.data = client.title

    if form.validate_on_submit():

        client.title = form.title.data
        client.firstname = form.firstname.data
        client.lastname = form.lastname.data
        client.id_card = form.id_card.data
        client.company = form.company.data
        client.filenumber = form.filenumber.data
        client.phone = form.phone.data
        client.mobile = form.mobile.data
        client.email = form.email.data
        client.street = form.street.data
        client.city = form.city.data
        client.country = form.country.data
        client.postcode = form.postcode.data

        if not client.filenumber: client.filenumber = 0
        if not client.phone: client.phone = 0
        if not client.mobile: client.mobile = 0

        db.session.commit()

        flash(Markup(
            'Client has been successfully updated! &nbsp;<a href="../../all-clients">View all Clients</a>')
            , 'flash flash--success'
        )


    return render_template('clients/edit-client.html', form=form, edit=client)

# _____________________________
# _____________________________

@my_clients.route('/delete-client/<id>/', methods=['GET'])
@login_required
def delete_client(id):

    client = JFW_Clients.query.get(id)
    if client:
        db.session.delete(client)
        db.session.commit()

        flash(
            'Client has been removed successfully!'
            , 'flash flash--warning'
        )

    return redirect(url_for('my_clients.all_clients'))

# _____________________________
# _____________________________

@my_clients.route('/delete-clients', methods=['POST'])
@login_required
def delete_clients():

    # ___________________
    
    # get list of checked clients
    clients_list = request.form.getlist("checkBoxList")
    # change each client id from str to int
    clients_list = map(int, clients_list)
    # change list to tuple
    clients_list = tuple(clients_list)

    print(clients_list)

    # ___________________

    
    

    if len(clients_list) < 1:
        message = 'No Clients has been selected!'
    else:      

        delete_count = clients_list = JFW_Clients.query.filter(
            JFW_Clients.id.in_(clients_list)
        ).delete(synchronize_session=False)

        db.session.commit()

        print(repr(delete_count))

        if delete_count == 1 :
            c = 'client '
        else: 
            c = 'clients'

        message = f'{delete_count} {c} has been removed successfully!'

 
        

    # ___________________
 
    flash(Markup(message), 'flash flash--warning')

    return redirect(url_for('my_clients.all_clients'))
