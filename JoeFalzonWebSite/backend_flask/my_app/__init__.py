
# ______________________________________________________________________

from flask import Flask, redirect, render_template, request, url_for, Blueprint, jsonify, make_response, send_from_directory
from flask_cors import CORS, cross_origin
from werkzeug.exceptions import HTTPException
import socket
import os


from flask_sqlalchemy import SQLAlchemy
from flask_bcrypt import Bcrypt
from flask_mail import Mail

from flask_wtf.csrf import CSRFProtect

# ______________________________________________________________________

def create_app():
    app = Flask(__name__)

    if app.config['ENV'] == 'development':
        app.config.from_object('config.ConfigDev')
    else:
        app.config.from_object('config.ConfigPro')
    return app 


app    = create_app()
db     = SQLAlchemy(app)
bcrypt = Bcrypt(app)
mail   = Mail(app)
csrf = CSRFProtect(app)
CORS(app)





# ______________________________________________________________________
from my_app.modules.views._my_admin import my_admin
from my_app.modules.views._clients import my_clients
from my_app.modules.views._projects import my_projects


app.register_blueprint(my_admin)
app.register_blueprint(my_clients)
app.register_blueprint(my_projects)

from my_app.modules.database import JFW_Clients, JFW_Users


# ______________________________________________________________________

@app.route('/info')
def info():
    hostname = socket.gethostname()    
    local_host = socket.gethostbyname(hostname)    
    host_addr = socket.gethostbyname(hostname + ".local") 

    markup = f"""
        <p>Computer Name is: <b>{hostname}</b></p>
        <p>Local Host Address is: <b>{local_host}</b></p>
        <p>Computer IP Address is: <b>{host_addr}</b></p>
        <p>Environment: <b>{app.env}</b></p>
        <p>Debug: <b>{app.debug}</b></p>
        <p>Testing: <b>{app.testing}</b></p>
        <p>Secret Key: <b>{app.config['SECRET_KEY'][::-2]}</b></p>
        <p>Secret Key: <b>{app.config['WTF_CSRF_SECRET_KEY'][::-2]}</b></p>
    
    """

    return markup

@app.route('/error_page')
def error_page():
    return render_template('error.html')


@app.errorhandler(HTTPException)
def http_error_handler(e):
    error_body = jsonify({
        'code': e.code,
        'name': e.name,
        'description': e.description
    })

    r = make_response(
        render_template(
            'error.html', code=e.code, name=e.name, description=e.description)
        )

    # r.headers['Content-Type'] = 'application/json'                    # <- (A)
    r.headers['Content-Type'] = 'text/html; charset=UTF-8'              # <- (B)
    r.headers['Code'] = e.code
    r.headers['Error'] = e.name
        
    #r.headers.set('Description', e.description)                         # <- (C)
    
    return r

    # 'A' used for api, 'B' used to display html and text
    # 'C' alternative way to add headers



@app.route('/favicon.ico')
def favicon():
    return send_from_directory(
                os.path.join(app.root_path, 'static/images'),
                'my_admin_primary.png',
                mimetype='image/vnd.microsoft.icon'
    )