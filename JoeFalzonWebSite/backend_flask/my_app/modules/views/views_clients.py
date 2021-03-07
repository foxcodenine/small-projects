from my_app import app, db
from flask import Blueprint, render_template, redirect, request, url_for, jsonify, session

from my_app.modules.forms import ClientForm
from my_app.modules.database import JFW_Clients
from flask_login import login_required

from datetime import datetime

# ______________________________________________________________________


my_clients = Blueprint('my_clients', __name__, url_prefix='/clients')


# ______________________________________________________________________

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
        

        new_client = JFW_Clients(
                        title=title, firstname=firstname, lastname=lastname,
                        id_card=id_card, company=company, filenumber=filenumber,
                        phone=phone, mobile=mobile, email=email, street=street, 
                        city=city, country=country, postcode=postcode
                    )
        db.session.add(new_client)
        db.session.commit()
        

        test = f"""
            {title} <br> {firstname} <br> {lastname} <br> {id_card} <br> 
            {company} <br> {filenumber} <br> {phone} <br> {mobile} <br> 
            {email} <br> {street} <br> {city} <br> {country} <br> {postcode}
            """

        return f"<h4>{test}</h4>"


    return render_template('clients/add-client.html', form=form)

# _____________________________

@my_clients.route('all-clients')
def all_clients():
    return render_template('clients/all-clients.html')