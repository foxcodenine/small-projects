from my_app import app, db, s3_resource, s3_client
from flask import Blueprint, render_template, redirect, request, url_for, jsonify, session

from flask_login import login_required

from my_app.modules.forms import ProjectForm
from my_app.modules.database import JFW_Categories, JFW_Status, JFW_Clients, JFW_Projects

import datetime
import os

# ______________________________________________________________________


my_projects = Blueprint('my_projects', __name__, url_prefix='/projects')

# ______________________________________________________________________
# ______________________________________________________________________



@my_projects.route('/')
@login_required
def dashbord():

    return render_template('main.html')

# ______________________________________________________________________


@my_projects.route('/all-projects')
@login_required
def all_projects():

    return render_template('projects/all-projects.html')

# ______________________________________________________________________


@my_projects.route('/add/', methods=['GET', 'POST'])
@login_required
def add_project():

    status = JFW_Status.query.all()
    categories = JFW_Categories.query.all()
    clients = JFW_Clients.query.all()

    status = [{'key': s.id, 'value': s.status} for s in status]
    categories = [{'key':c.id, 'value': c.category} for c in categories]
    clients = [{
            'key': c.id, 
            'value': f'{c.id} {c.title} {c.lastname} {c.firstname} - {c.id_card} - {c.city}'
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
        status_id   = (form.data['status'])
        category_id  = (form.data['category'])
        date        = (form.data['date'])
        content     = (form.data['content'])

        if not date:
            date = datetime.date.today()
        
        if ref_client == 0:
            ref_client = None

        if status_id == 0:
            status_id = None
        
        if category_id == 0:
            category_id = None    

        # _____________________________

        new_project = JFW_Projects(
            name=name, address=address, locality=locality, ref_number=ref_number,
            pa_number=pa_number, status_id=status_id, category_id=category_id, 
            date=date, content=content, ref_client=ref_client
        )

        db.session.add(new_project)
        db.session.flush()
        # _____________________________

        my_bucket_name = os.getenv('my_bucket_name')
        
        
        for img in form.images.data:

            if img.filename == '':
                break

            image_name = f'JFW_Projects_Images{new_project.id}/{img.filename}'

            # print(img)
            # print(repr(img.filename))

            s3_resource.Bucket(my_bucket_name).put_object(
                Body = img,
                Key =  image_name,
                ACL =  'public-read'
        )

        # _____________________________

        # db.session.commit()
        # _____________________________


        markup = ''

        all_projects = JFW_Projects.query.all()

        for p in all_projects:
            markup += f'{p} <br>'

        return markup
        # _____________________________

    return render_template('projects/add-project.html', form=form)

# ______________________________________________________________________



