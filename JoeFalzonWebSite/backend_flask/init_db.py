from my_app import db, JFW_Users

db.create_all()
db.session.commit()

new_user = JFW_Users('chris12aug@gmail.com', 'a******4')

db.session.add(new_user)
db.session.commit()