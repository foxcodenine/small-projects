from my_app import app
from flask import Blueprint, render_template, redirect, request, url_for, jsonify, session

from my_app.modules.forms import ClientForm
from flask_login import login_required

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

        test = f"""
            {title} <br> {firstname} <br> {lastname} <br> {id_card} <br> 
            {company} <br> {filenumber} <br> {phone} <br> {mobile} <br> 
            {email} <br> {street} <br> {city} <br> {country} <br> {postcode}
            """

        return f"<h4>{test}</h4>"


    return render_template('clients/add-client.html', form=form)

# _____________________________