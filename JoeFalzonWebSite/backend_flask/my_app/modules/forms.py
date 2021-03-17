from flask_wtf import FlaskForm

from wtforms import StringField, SelectField, IntegerField, \
     DateTimeField, BooleanField, SubmitField, MultipleFileField, TextAreaField

from wtforms.validators import Optional, DataRequired, Email

from wtforms.fields.html5 import DateField



# ______________________________________________________________________

class ClientForm(FlaskForm):

    title       = SelectField('title', choices=[('Mr', 'Mr'), ('Ms', 'Ms'), ('Mx', 'Mx')])
    firstname   = StringField('firstname', validators=[DataRequired()])
    lastname    = StringField('lastname', validators=[DataRequired()])
    id_card     = StringField('ID card', validators=[DataRequired()])
    company     = StringField('company')
    filenumber  = IntegerField('file No', validators=[Optional()])
    phone       = IntegerField('phone', validators=[Optional()])
    mobile      = IntegerField('mobile', validators=[Optional()])
    email       = StringField('email')
    street      = StringField('street address', validators=[DataRequired()])
    city        = StringField('city', validators=[DataRequired()])
    country     = StringField('country', validators=[DataRequired()])
    postcode    = StringField('postcode')
    submit      = SubmitField()

# ______________________________________________________________________

class SignInForm(FlaskForm):
    email = StringField('email', validators=[DataRequired(), Email()])
    password = StringField('password', validators=[DataRequired()])
    remember = BooleanField('Remember this device')
    submit = SubmitField()

# ______________________________________________________________________

class DeleteAllForm(FlaskForm):
    pass

# ______________________________________________________________________

class ProjectForm(FlaskForm):
    name = StringField(u'project name', validators=[DataRequired()])
    address = StringField(u'address', validators=[DataRequired()])
    locality = StringField(u'locality', validators=[DataRequired()])    
    ref_number = IntegerField(u'ref no', validators=[Optional()])
    pa_number = StringField(u'PA no', validators=[Optional()])

    ref_client = SelectField(u'ref client', choices=[], validators=[Optional()])
    status = SelectField(u'status', choices=[], validators=[Optional()])
    category = SelectField(u'category', choices=[], validators=[Optional()])

    images = MultipleFileField(
        u'images', render_kw={'multiple': True}, validators=[Optional()]
    )

    date = DateField(u'date', validators=[Optional()])

    content = TextAreaField(u'content', validators=[Optional()])

    submit = SubmitField()


    def __init__(
        self, ref_client_options=None, status_options=None, 
        category_options=None
    ):

        super().__init__() # calls the base initialisation and then...

        if ref_client_options:
            self.ref_client.choices  = [(' ', '')] + [(r['key'], r['value']) for r in ref_client_options]
        if status_options:
            self.status.choices      = [(' ', '')] + [(o, o) for o in status_options]
        if category_options:
            self.category.choices    = [(' ', '')] + [(c, c) for c in category_options]
