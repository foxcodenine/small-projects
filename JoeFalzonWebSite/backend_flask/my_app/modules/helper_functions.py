import os
from my_app import app, db, s3_resource, s3_client
from my_app.modules.database import JFW_Categories, JFW_Status, JFW_Clients, JFW_Projects, JFW_Images

# ______________________________________________________________________

# ----- Views Projects Functions ---------------------------------------

def save_images(project_id, images_data):

    # upload images to s3 bucket and save url to db
    my_bucket_name = os.getenv('my_bucket_name') 

    image_count = 0
    # _____________________________

    thumbnail = JFW_Images.query.filter_by(thumbnail='thumbnail').filter_by(project_id=project_id).first()   
    if thumbnail:
        image_count += 1
    
    # _____________________________
    
    for img in images_data:

        if img.filename == '':
            break

        image_name = f'projects_images/id_{project_id}/{img.filename}'

        s3_resource.Bucket(my_bucket_name).put_object(
            Body = img,
            Key =  image_name,
            ACL =  'public-read'
        )            

        image_url = f'https://foxcode-project-002.s3.eu-central-1.amazonaws.com/projects_images/id_{project_id}/{img.filename}'


        if not image_count:
            thumbnail = 'thumbnail'
        else:
            thumbnail = ''
        
        image_count += 1

        new_image = JFW_Images(
            url=image_url, use='project_image', 
            project_id=project_id, thumbnail=thumbnail
        )
        db.session.add(new_image)

    # _____________________________

    

# ----------------------------------------------------------------------