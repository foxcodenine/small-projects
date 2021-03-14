from my_app import app, db, bcrypt, serializer
import jwt
from datetime import datetime, timedelta

from flask_login import UserMixin

# ______________________________________________________________________

class JFW_Clients(db.Model):
    __tablename__ = 'jfw_clients'

    id          = db.Column(db.Integer, primary_key=True)
    title       = db.Column(db.String(5), nullable=False)
    firstname   = db.Column(db.String(50), nullable=False)
    lastname    = db.Column(db.String(50), nullable=False)
    id_card     = db.Column(db.String(50), nullable=False)
    company     = db.Column(db.String(255))
    filenumber  = db.Column(db.Integer)
    phone       = db.Column(db.Integer)
    mobile      = db.Column(db.Integer)
    email       = db.Column(db.String(255))
    street      = db.Column(db.String(255), nullable=False)
    city        = db.Column(db.String(255), nullable=False)
    country     = db.Column(db.String(100), nullable=False)
    postcode    = db.Column(db.String(50))
    registered  = db.Column(db.DateTime, nullable=False)

# ______________________________________________________________________

    def __init__(self, title, firstname, lastname, id_card, street, city, 
        country, postcode=None, company=None, filenumber=0, 
        phone=0, mobile=0, email=None ):

        self.title = title
        self.firstname = firstname
        self.lastname = lastname
        self.id_card = id_card
        self.company = company
        self.filenumber = filenumber
        self.phone = phone
        self.mobile = mobile
        self.email = email
        self.street = street
        self.city = city
        self.country = country
        self.postcode = postcode
        self.registered = datetime.utcnow()       

# ______________________________________________________________________


class JFW_Users(UserMixin, db.Model):
    __tablename__ = 'jfw_users'

    id = db.Column(db.Integer, primary_key=True)
    email = db.Column(db.String(255), nullable=False, unique=True)
    password = db.Column(db.String(255), nullable=False)
    login1 = db.Column(db.DateTime)
    login2 = db.Column(db.DateTime)
    login3 = db.Column(db.DateTime)
    session_token = db.Column(db.String(255), unique=True)    

    def __init__ (self, email, password):
        self.email = email
        self.password = self.hash_password(password)
        self.login1 = datetime.utcnow()
        self.session_token = serializer.dumps([self.email, str(self.password), self.login1.strftime('%c')])

    def get_id(self):
        return self.session_token
    
    def update_session_token(self):
        self.session_token = serializer.dumps([self.email, str(self.password), self.login1.strftime('%c')])        

    def hash_password(self, password):
        return bcrypt.generate_password_hash(password)
    
    def check_password(self, pw_hash, candidate):
        return bcrypt.check_password_hash(pw_hash, candidate)

    def user_sign_in(self):
        self.login3 = self.login2
        self.login2 = self.login1
        self.login1 = datetime.utcnow()

# ______________________________________________________________________

class JFW_Status(db.Model):
    __tablename__ = 'jfw_status'
    id = db.Column(db.Integer, primary_key=True)
    status = db.Column(db.String(50), nullable=False, unique=True)

    def __init__(self, status):
        self.status = status

# ______________________________________________________________________

class JFW_Categories(db.Model):
    __tablename__ = 'jfw_categories'
    id = db.Column(db.Integer, primary_key=True)
    category = db.Column(db.String(50), nullable=False, unique=True)

    def __init__(self, category):
        self.category = category

# ______________________________________________________________________
