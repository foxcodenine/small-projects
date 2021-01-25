
# ______________________________________________________________________

from flask import Flask, redirect, render_template, request, url_for, Blueprint
from flask_cors import CORS, cross_origin


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


@app.route('/')
def index():
    return '{} {}'.format(app.config['CHECK_ENV'], app.config['SECRET_KEY'][::-1])