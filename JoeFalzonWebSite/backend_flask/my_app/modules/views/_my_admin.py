from my_app import app
from flask import Blueprint, render_template, redirect, request, url_for, jsonify, session



# ______________________________________________________________________


my_admin = Blueprint('my_admin', __name__, url_prefix='/')


# ______________________________________________________________________

@my_admin.route('/')
def index():

    return render_template('main.html')

# _____________________________

@my_admin.route('/sign-in')
def sign_in():

    return render_template('sign-in.html')

# _____________________________



