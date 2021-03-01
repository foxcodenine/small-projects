from my_app import app, db, bcrypt
import jwt
from datetime import datetime, timedelta

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


class JFW_Users(db.Model):
    __tablename__ = 'jft_users'

    id = db.Column(db.Integer, primary_key=True)
    email = db.Column(db.String(255), nullable=False)
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





