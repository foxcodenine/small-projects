from my_app import app, lodin_manager
from flask import Blueprint, render_template, redirect, request, \
                  url_for, jsonify, session, flash, session

from flask_login import login_user, login_required, logout_user
from my_app.modules.forms import SignInForm
from my_app.modules.database import JFW_Users

from my_app.modules.database import db

# ______________________________________________________________________

@lodin_manager.user_loader
def load_user(session_token):
    return JFW_Users.query.filter_by(session_token=session_token).first()
# ______________________________________________________________________


my_admin = Blueprint('my_admin', __name__, url_prefix='/')

# ______________________________________________________________________

@my_admin.route('/')
@login_required
def index():

    return render_template('main.html')

# _____________________________


@my_admin.route('/sign-in', methods=['POST', 'GET'])
def sign_in():

    form = SignInForm()


    if form.validate_on_submit():

        email = form.email.data 
        password = form.password.data
        remember = form.remember.data 


        signin_user = JFW_Users.query.filter_by(email=email).first()        
            

        if not signin_user:
            flash('The email you entered isn’t connected to an account.')
        
        elif not signin_user.check_password(signin_user.password, password):
            flash('The password you’ve entered is incorrect.')
        else:            
            signin_user.user_sign_in()
            signin_user.update_session_token()
            db.session.commit()
            login_user(signin_user, remember=remember)
            
            if 'next' in session:
                return redirect(session['next'])
            else:
                return redirect(url_for('my_projects.all_projects'))
                   

        

    return render_template('sign-in.html', form=form)


# _____________________________


@my_admin.route('/sign-out/')
def sign_out():
    logout_user()
    return redirect(url_for('my_admin.sign_in'))


# _____________________________


@my_admin.route('/test/')
@login_required
def test():
    return 'Test Ok!'
