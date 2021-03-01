from my_app import app
from flask import Blueprint, render_template, redirect, request, url_for, jsonify, session

from my_app.modules.forms import SignInForm

# ______________________________________________________________________


my_admin = Blueprint('my_admin', __name__, url_prefix='/')


# ______________________________________________________________________

@my_admin.route('/')
def index():

    return render_template('main.html')

# _____________________________

@my_admin.route('/sign-in', methods=['POST', 'GET'])
def sign_in():

    form = SignInForm()

    if request.method == 'POST':
        email = request.form['email']
        password = request.form['password']
        
        if 'remember' in request.form: 
            remember = True
        else:
            remember = False

        return "{} - {} - {}".format(email, password, remember)

    return render_template('sign-in.html', form=form)

# _____________________________



