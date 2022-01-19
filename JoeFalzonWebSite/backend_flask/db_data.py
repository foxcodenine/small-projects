from my_app import JFW_Categories, JFW_Status, db

db.create_all()
db.session.commit()

cat = ['Residential', 'Commercial', 'Office', 'Retail', 'Industrial', 'Agricultural', 'Religious', 'Government']

for c in cat: 
    a = JFW_Categories(c)
    db.session.add(a)
    db.session.commit()

sta = ['Planning', 'Approved', 'In progess', 'On hold', 'Completed', 'Archive', 'Cancelled']
for s in sta: 
    a = JFW_Status(s)
    db.session.add(a)
    db.session.commit()