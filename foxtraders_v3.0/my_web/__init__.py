import os
from flask import Flask, redirect, render_template, url_for, request
from flask_sqlalchemy import SQLAlchemy

from flask_login import LoginManager, UserMixin, login_required, login_user, logout_user
from flask_bcrypt import Bcrypt
from flask_cors import CORS

from datetime import datetime

from flask_wtf import FlaskForm
from wtforms import StringField, SubmitField
from wtforms.validators import DataRequired
from flask_wtf.csrf import CSRFProtect

from flask_admin import Admin
from flask_admin.contrib.sqla import ModelView


# ______________________________________________________________________

def create_app():
    app = Flask(__name__)

    if os.getenv('MY_FLASK_ENV') == 'home':
        print(f'-> {os.getenv("MY_FLASK_ENV")}')
        app.config.from_object('config.ConfigHome')

    elif os.getenv('MY_FLASK_ENV') == 'work':
        print(f'-> {os.getenv("MY_FLASK_ENV")}')
        app.config.from_object('config.ConfigWork')

    else:
        print(f'-> {os.getenv("MY_FLASK_ENV")}')
        app.config.from_object('config.ConfigPro')

    return app 

# ______________________________________________________________________

app = create_app()
db = SQLAlchemy(app)
bcrypt = Bcrypt(app)
csrf = CSRFProtect(app)
CORS(app)

login_manager = LoginManager(app)

admin = Admin(app, template_mode='bootstrap4')

# ______________________________________________________________________

class LoginInForm(FlaskForm):
    email = StringField('email', validators=[DataRequired()])
    password = StringField('password', validators=[DataRequired()])
    submit = SubmitField()
# ______________________________________________________________________
class Fxt_User(UserMixin, db.Model):
    __tablename__ = 'fxt_user'

    id = db.Column(db.Integer, primary_key=True)
    email = db.Column(db.String(255), nullable=False, unique=True)
    password = db.Column(db.String(255), nullable=False)
    login1 = db.Column(db.DateTime)
    login2 = db.Column(db.DateTime)
    login3 = db.Column(db.DateTime)

    def __init__ (self, email, password):
        self.email = email
        self.password = self.hash_password(password)
        self.login1 = datetime.utcnow()
    
    def hash_password(self, password):
        return bcrypt.generate_password_hash(password)
    
    def check_password(self, pw_hash, candidate):
        return bcrypt.check_password_hash(pw_hash, candidate)

    def user_sign_in(self):
        self.login3 = self.login2
        self.login2 = self.login1
        self.login1 = datetime.utcnow()



class Fxt_Settings(db.Model):
    __tablename__ = 'fxt_settings'

    id = db.Column(db.Integer, primary_key=True)
    name = db.Column(db.String(50), unique=True)
    value = db.Column(db.String(50))
    info = db.Column(db.String(255))

    def __init__(self, name, value, info=None):
        self.name = name
        self.value = value
        self.info = info

    def __repr__(self):
        return f'<{self.name}>'

db.create_all()
db.session.commit()



# ______________________________________________________________________
# new_user = Fxt_User(email='chris12aug@yahoo.com', password=f'{os.getenv("WEB_PASSWORD")}')
# db.session.add(new_user)
# db.session.commit()
# ______________________________________________________________________

admin.add_view(ModelView(Fxt_Settings, db.session))


# ______________________________________________________________________

@login_manager.user_loader
def load_user(user_id):
    return Fxt_User.query.get(int(user_id))

# ______________________________________________________________________
@app.route('/', methods=['GET'])
@login_required
def index():
    return '...so far so good!'

@app.route('/sign-in/', methods=['GET', 'POST'])
def signin():
    form = LoginInForm()
    if form.validate_on_submit():

        email = form.email.data 
        password = form.password.data

        signin_user = Fxt_User.query.filter_by(email=email).first() 

        if signin_user and signin_user.check_password(signin_user.password, password):
            signin_user.user_sign_in()
            db.session.commit()
            login_user(signin_user, remember=False)

            return redirect(url_for('index'))           


    return render_template('signin.html', form=form)

@app.route('/sign-out/')
@login_required
def signout():
    logout_user()
    return redirect(url_for('signin')) 



