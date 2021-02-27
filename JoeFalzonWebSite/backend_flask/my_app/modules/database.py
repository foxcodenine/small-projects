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








