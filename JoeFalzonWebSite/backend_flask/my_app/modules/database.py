from my_app import app, db, bcrypt, serializer
import jwt
from datetime import datetime, timedelta

from flask_login import UserMixin
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

    projects = db.relationship('JFW_Projects', backref='client',  lazy='dynamic')

    def __repr__(self):
        return "<{} - {} - {}>".format(self.id, self.firstname, self.lastname)

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

class JFW_Status(db.Model):
    __tablename__ = 'jfw_status'
    id = db.Column(db.Integer, primary_key=True)
    status = db.Column(db.String(50), nullable=False, unique=True)

    projects = db.relationship('JFW_Projects', backref='status',  lazy='dynamic')

    def __init__(self, status):
        self.status = status

    

# ______________________________________________________________________

class JFW_Categories(db.Model):
    __tablename__ = 'jfw_categories'
    id = db.Column(db.Integer, primary_key=True)
    category = db.Column(db.String(50), nullable=False, unique=True)

    projects = db.relationship('JFW_Projects', backref='category',  lazy='dynamic')

    def __init__(self, category):
        self.category = category   


# ______________________________________________________________________


    
class JFW_Projects(db.Model):
    __tablename__ = 'jfw_projects'

    id = db.Column(db.Integer, primary_key=True)
    name = db.Column(db.String(255), nullable=False)
    address = db.Column(db.String(255), nullable=False)
    locality = db.Column(db.String(100), nullable=False)
    ref_number = db.Column(db.Integer())
    pa_number = db.Column(db.String(50), nullable=False)

    ref_client = db.Column(db.Integer(), db.ForeignKey('jfw_clients.id'))
    status_id = db.Column(db.Integer(), db.ForeignKey('jfw_status.id'))
    category_id = db.Column(db.Integer(), db.ForeignKey('jfw_categories.id'))

    date = db.Column(db.Date)
    content = db.Column(db.Text)
    published = db.Column(db.String(20))

    images = db.relationship('JFW_Images', backref='project',  lazy='dynamic')

    def __repr__(self):
        return "<{} - {}>".format(self.id, self.name)

    def __init__(
        self, name, address, locality, ref_number, pa_number, 
        ref_client, status_id, category_id, date, content
    ):
        self.name = name
        self.address = address
        self.locality = locality
        self.ref_number = ref_number
        self.ref_client = ref_client
        self.pa_number = pa_number
        self.status_id = status_id
        self.category_id = category_id
        self.date = date
        self.content = content
        self.published = 'draft'



        
class JFW_Images(db.Model):
    __tablename__ = 'jfw_images'

    id = db.Column(db.Integer, primary_key=True)
    use = db.Column(db.String(50), nullable=True)
    project_id = db.Column(db.Integer(), db.ForeignKey('jfw_projects.id'))
    url = db.Column(db.String(255), nullable=False, index=True)
    thumbnail = db.Column(db.String(50), nullable=True)

    def __init__(self, url, use=None, project_id=None, thumbnail=None):
        self.url = url
        self.use = use
        self.project_id = project_id
        self.thumbnail = thumbnail

    def __repr__(self):
        return "<{}>".format(self.url)
    def __str__(self):
        return "{}".format(self.url)