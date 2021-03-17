from my_app import app
from flask import Blueprint, render_template, redirect, request, url_for, jsonify, session

from flask_login import login_required

from my_app.modules.forms import ProjectForm
from my_app.modules.database import JFW_Categories, JFW_Status, JFW_Clients

import datetime

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

@my_projects.route('/add/', methods=['GET', 'POST'])
@login_required
def add_project():

    status = JFW_Status.query.all()
    categories = JFW_Categories.query.all()
    clients = JFW_Clients.query.all()

    status = [s.status for s in status]
    categories = [c.category for c in categories]
    clients = [{
        'key': c.id, 'value': f'{c.id} {c.title} {c.lastname} {c.firstname} - {c.id_card} - {c.city}'
    } for c in clients]

    form = ProjectForm(status_options=status, category_options=categories, ref_client_options=clients)

    if form.validate_on_submit():
        name        = (form.data['name'])
        address     = (form.data['address'])
        locality    = (form.data['locality'])
        ref_client  = (form.data['ref_client'])
        ref_number  = (form.data['ref_number'])
        pa_number   = (form.data['pa_number'])
        images      = (form.data['images'])
        status      = (form.data['status'])
        category    = (form.data['category'])
        date        = (form.data['date'])
        if not date:
            date = datetime.date.today()
        content     = (form.data['content'])

        print(form.images.data)
        print(form.images.data[0].filename)
        print(form.images.data[0].__dict__)
        markup = f"""
                <br>{name}<br>{address}<br>{locality}<br>{ref_client}
                <br>{ref_number}<br>{pa_number}<br>{images}<br>{status}
                <br>{category}<br>{date}<br>{content}
                """
        return "<h3>" + markup + "</h3>"


    return render_template('projects/add-project.html', form=form)

# _____________________________



