
# ______________________________________________________________________

from flask import Flask, redirect, render_template, request, url_for, Blueprint
from flask_cors import CORS, cross_origin
import socket


# ______________________________________________________________________

def create_app():
    app = Flask(__name__)

    if app.config['ENV'] == 'development':
        app.config.from_object('config.ConfigDev')
    else:
        app.config.from_object('config.ConfigPro')
    return app 


app = create_app()
CORS(app)




# ______________________________________________________________________
from my_app.modules.views._my_admin import my_admin
from my_app.modules.views._clients import my_clients
from my_app.modules.views._projects import my_projects


app.register_blueprint(my_admin)
app.register_blueprint(my_clients)
app.register_blueprint(my_projects)


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
    
    """

    return markup
