from my_app import app, db, s3_resource, s3_client
from flask import Blueprint, render_template, redirect, request, url_for, jsonify, session, flash, Markup

from flask_login import login_required

from my_app.modules.forms import ProjectForm
from my_app.modules.database import JFW_Categories, JFW_Status, JFW_Clients, JFW_Projects, JFW_Images

import datetime
import os

from my_app.modules.helper_functions import save_images
# ______________________________________________________________________


my_projects = Blueprint('my_projects', __name__, url_prefix='/projects')

# ______________________________________________________________________
# ______________________________________________________________________

# Helper functions

def return_project_form():
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

    return form




# ______________________________________________________________________
# ______________________________________________________________________

# Filters
@app.template_filter('strftime')
def datetime_format(value, format="%H:%M %d-%m-%y"):
    return value.strftime(format)

@app.template_filter('chk_img')
def check_image(value):
    if not value:
        return '../../static/images/image_not_available.png'
    return value

# ______________________________________________________________________

@my_projects.route('/')
@login_required
def dashbord():

    return render_template('main.html')

# ______________________________________________________________________


@my_projects.route('/all-projects')
@login_required
def all_projects():

    projects = JFW_Projects.query.all()

    i = 1
    for p in projects:
        i = i * -1
        if i < 0:
            p._class = 'projects__row projects__shade'
        else:
            p._class = 'projects__row'

    return render_template('projects/all-projects.html', projects=projects)

# ______________________________________________________________________

@my_projects.route('/add/', methods=['GET', 'POST'])
@login_required
def add_project():
 

    form = return_project_form()
    

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


        save_images(new_project.id, form.images.data)
        db.session.commit()
        
        return redirect(url_for('my_projects.all_projects'))
        # _____________________________

    return render_template('projects/add-project.html', form=form)

# ______________________________________________________________________



@my_projects.route('/delete-project/<id>', methods=['GET'])
@login_required
def delete_project(id):
    project = JFW_Projects.query.get(id)
    if project:       

        # --- delete images from db
        JFW_Images.query.filter_by(project_id = id).delete()

        # --- delete project from db
        db.session.delete(project)
        db.session.commit()

        # --- images delete from AWS S3  
        bucket = s3_resource.Bucket(os.getenv('my_bucket_name'))
        bucket.objects.filter(Prefix = f'projects_images/id_{id}').delete()
        

        flash(
            'Project has been removed successfully!'
            , 'flash flash--warning'
        )

    return redirect(url_for('my_projects.all_projects'))

# ______________________________________________________________________



@my_projects.route('/edit-project/', defaults={'id': None}, methods=['GET', 'POST'])
@my_projects.route('/edit-project/<id>', methods=['GET', 'POST'])
@login_required
def edit_project(id):
    project = JFW_Projects.query.get(id)

    if not project:
        return redirect(url_for('my_projects.all_projects'))
    
    form = return_project_form()

    if project.client:
        form.ref_client.data = project.client.id

    if project.status:  
        form.status.data = project.status.id

    if project.category:
        form.category.data = project.category.id

    print(repr(project.ref_number))
    if not project.ref_number or project.ref_number == None:
        project.ref_number = ''

    form.content.data = project.content

    if form.validate_on_submit():

        project.name        = (form.data['name'])
        project.address     = (form.data['address'])
        project.locality    = (form.data['locality'])        
        project.ref_number  = (form.data['ref_number'])
        project.pa_number   = (form.data['pa_number'])
        # project.images      = (form.data['images'])       
        project.date        = (form.data['date'])
        project.content     = (form.data['content'])
        
        project.ref_client  = (form.data['ref_client'])
        if project.ref_client == 0:
            project.ref_client= None
        

        project.status_id = (form.data['status'])
        if project.status_id == 0:
            project.status_id = None

        project.category_id  = (form.data['category'])
        if project.category_id == 0:
            project.category_id = None

        
        save_images(id, form.images.data)
        db.session.commit()

        if not project.ref_number or project.ref_number == None:
            project.ref_number = ''

        

        markup = Markup('Project has been updated! <a href="{{url_for("my_projects.all_projects")}}">View all projects</a>')
        flash(
            markup, 'flash flash--success'
        )

        


    return render_template('projects/edit-project.html', form=form, edit=project)


