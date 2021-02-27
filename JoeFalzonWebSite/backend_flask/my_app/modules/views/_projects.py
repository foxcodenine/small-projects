from my_app import app
from flask import Blueprint, render_template, redirect, request, url_for, jsonify, session



# ______________________________________________________________________


my_projects = Blueprint('my_projects', __name__, url_prefix='/projects')

# ______________________________________________________________________


@my_projects.route('/')
def dashbord():

    return render_template('main.html')

# _____________________________



@my_projects.route('/all-projects')
def all_projects():

    return render_template('projects/all-projects.html')

# _____________________________

@my_projects.route('/add/')
def add_project():

    return render_template('projects/add-project.html')

# _____________________________



