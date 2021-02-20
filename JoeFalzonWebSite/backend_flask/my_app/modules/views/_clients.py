from my_app import app
from flask import Blueprint, render_template, redirect, request, url_for, jsonify, session



# ______________________________________________________________________


my_clients = Blueprint('my_clients', __name__, url_prefix='/clients')


# ______________________________________________________________________

@my_clients.route('/add')
def add_client():

    return render_template('clients/add-client.html')

# _____________________________