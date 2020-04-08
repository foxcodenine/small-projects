from flask import Flask, redirect, render_template, url_for, request
from flask import flash, session
from flask_sqlalchemy import SQLAlchemy
from uuid import uuid4
from flask_uploads import UploadSet, IMAGES ,configure_uploads

from os import remove

# ______________________________________________________________________
app = Flask(__name__)

photos = UploadSet('photos', IMAGES)

app.config['DEBUG'] = True
app.config['SECRET_KEY'] = uuid4().hex
app.config['SQLALCHEMY_DATABASE_URI'] = (
    'mysql://F2udETTsO6:U7hQzPXXBW@remotemysql.com:3306/F2udETTsO6')

app.config['UPLOADED_PHOTOS_DEST'] = './images'

configure_uploads(app, photos)

db = SQLAlchemy(app)
# ______________________________________________________________________


class PhotoAlbum(db.Model):
    __tablename__ = 'photoalbum'

    id = db.Column(db.Integer, primary_key=True)
    loc = db.Column(db.String(255), nullable=False)
    pos = db.Column(db.Integer, nullable=False)
    chk = db.Column(db.Boolean)

# ______________________________________________________________________

@app.route('/', methods=['GET'])
def index():

    images  = PhotoAlbum.query.order_by(PhotoAlbum.pos.desc()).all()
    return render_template('index.html', imgs=images)

# ____________________


@app.route('/add/', methods=['POST', 'GET'])
def add():
    
    if request.method == 'POST':

        if not request.files['filename']:
            flash('No Image Selected')
            return redirect(url_for('index'))

        file_name = photos.save(request.files['filename'])
        file_loc = str(photos.url(file_name))
        last_pos = PhotoAlbum.query.order_by(PhotoAlbum.pos.desc()).first()
        

        if last_pos:
            next_pos = int(last_pos.pos) + 1
        else:
            next_pos = 1
        
        new_photo = PhotoAlbum(loc=file_loc, pos=next_pos)
        db.session.add(new_photo)
        db.session.commit()

        return redirect(url_for('index'))
    return redirect(url_for('index'))

# ____________________


@app.route('/forward/', methods=['GET', 'POST'])
def forward():
    if request.method == 'GET':
        return redirect(url_for('index'))

    else:
        if  'img' not in request.form:
            flash('No Image Selected')
            return redirect(url_for('index'))

        file_id = request.form['img']
        session['file_id'] = file_id
        
        
        if request.form['forward'] == 'delete':
            return redirect(url_for('delete'))
        else:
            session['action'] = request.form['forward']
            session['places'] = request.form['plc']
            return redirect(url_for('move'))
        
# ____________________

@app.route('/move/')
def move():
    places  = session['places']
    action  = session['action']
    file_id = session['file_id']
    print('>>>>>', action, places)


    selected_row = PhotoAlbum.query.filter_by(id = file_id).first()  

    if action == 'up': 

        rows_above =   PhotoAlbum.query.filter(
            PhotoAlbum.pos > selected_row.pos).order_by(
                PhotoAlbum.pos).limit(places).all()
        
        selected_row.pos = int(selected_row.pos) + int(places)
        db.session.commit()
      
        for row in rows_above:            
            row.pos = int(row.pos) - 1
            db.session.commit()


    if action == 'down':
        rows_below =   PhotoAlbum.query.filter(
            PhotoAlbum.pos < selected_row.pos).order_by(
                PhotoAlbum.pos.desc()).limit(places).all()
        
        selected_row.pos = int(selected_row.pos) - int(places)
        db.session.commit()
      
        for row in rows_below:            
            row.pos = int(row.pos) + 1
            db.session.commit()

    return redirect(url_for('index'))

    
# ____________________


@app.route('/delete/')
def delete():
    file_id = session['file_id']
    if file_id:
        
        delete_file = PhotoAlbum.query.filter_by(id = file_id).first()
        
        remove_file = str(delete_file.loc).split('/')
        remove_file_loc = './images/{}'.format(remove_file[-1])
        print(remove_file_loc)
        remove(remove_file_loc)
        db.session.delete(delete_file)
        db.session.commit()        
    
        return redirect(url_for('index'))
    return redirect(url_for('index'))


# ____________________


if __name__ == "__main__":
    app.run()