from flask_wtf import FlaskForm
from wtforms import StringField, SelectField, DateField, IntegerField, DateTimeField
from wtforms.validators import Optional, DataRequired, Email


class ClientForm(FlaskForm):

    title       = SelectField('title', choices=[('mr', 'Mr'), ('ms', 'Ms'), ('mx', 'Mx')])
    firstname   = StringField('firstname', validators=[DataRequired()])
    lastname    = StringField('lastname', validators=[DataRequired()])
    id_card     = StringField('identity card', validators=[DataRequired()])
    company     = StringField('company')
    filenumber  = IntegerField('file number', validators=[Optional()])
    phone       = IntegerField('phone', validators=[Optional()])
    mobile      = IntegerField('mobile', validators=[Optional()])
    email       = StringField('email')
    street      = StringField('street address', validators=[DataRequired()])
    city        = StringField('city', validators=[DataRequired()])
    country     = StringField('country', validators=[DataRequired()])
    postcode    = StringField('postcode')

class SignInForm(FlaskForm):
    pass