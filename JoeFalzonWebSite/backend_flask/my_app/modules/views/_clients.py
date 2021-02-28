from my_app import app
from flask import Blueprint, render_template, redirect, request, url_for, jsonify, session

from my_app.modules.forms import ClientForm



# ______________________________________________________________________


my_clients = Blueprint('my_clients', __name__, url_prefix='/clients')


# ______________________________________________________________________

@my_clients.route('/add', methods=['POST', 'GET'])
def add_client():

    submitted = False
    if request.method == 'POST':
        submitted = True
    form = ClientForm() 
    print(form.validate())
    if form.validate_on_submit():

        

        title = form.title.data
        firstname = form.firstname.data
        lastname = form.lastname.data
        id_card = form.id_card.data
        company = form.company.data

        test = f"{title} - {firstname} - {lastname} - {id_card} - {company}"

        return f"<h4>{test}</h4>"


    return render_template('clients/add-client.html', form=form, submitted=submitted)

# _____________________________