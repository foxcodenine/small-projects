from my_app import app
from flask import Blueprint, render_template, redirect, request, url_for, jsonify, session

from flask_login import login_required

from my_app.modules.forms import ProjectForm
from my_app.modules.database import JFW_Categories, JFW_Status

# ______________________________________________________________________


my_projects = Blueprint('my_projects', __name__, url_prefix='/projects')

# ______________________________________________________________________


@my_projects.route('/')
@login_required
def dashbord():

    return render_template('main.html')

# _____________________________



@my_projects.route('/all-projects')
@login_required
def all_projects():

    return render_template('projects/all-projects.html')

# _____________________________

@my_projects.route('/add/')
@login_required
def add_project():

    status = JFW_Status.query.all()
    categories = JFW_Categories.query.all()

    status = [s.status for s in status]
    categories = [c.category for c in categories]

    form = ProjectForm(status_options=status, category_options=categories)



    return render_template('projects/add-project.html', form=form)

# _____________________________



