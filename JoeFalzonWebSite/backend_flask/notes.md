
### G_Mail Create & use App Passwords
https://support.google.com/accounts/answer/185833?hl=
<!-- --------------------------------------------------------------- -->

### Flask WTForms dynamic select field from list instead of db
https://stackoverflow.com/questions/59762878/flask-wtforms-dynamic-select-field-from-list-instead-of-db

<!-- --------------------------------------------------------------- -->

### How to upload multiple files with flask-wtf?
https://stackoverflow.com/questions/53890136/how-to-upload-multiple-files-with-flask-wtf

<!-- --------------------------------------------------------------- -->

### How to render my TextArea with WTForms?
https://stackoverflow.com/questions/7979548/how-to-render-my-textarea-with-wtforms

<!-- --------------------------------------------------------------- -->

### DatePickerWidget with Flask, Flask-Admin and WTforms
https://stackoverflow.com/questions/26057710/datepickerwidget-with-flask-flask-admin-and-wtforms

<!-- --------------------------------------------------------------- -->


### Easily change drop down arrow

How I remove default -> https://fabriceleven.com/design/clever-way-to-change-the-drop-down-selector-arrow-icon/

Style I used         -> https://codepen.io/stepher/pen/yLOaEOP




Setup Boto3

    1. Install awscli using pip3.

        $ pip3 awscli

    2. Run aws configure, This will setup your access key and secret key globally. 

        $ aws configure

            AWS Access Key ID [None]: AKIAV........
            AWS Secret Access Key [None]: s7uySKcKkQDal/..........
            Default region name [None]: eu-central-1

    It will create '~/.aws' folder with two files
            i.  config
            ii. credentials

    3. You can move this folder to your project directory and redirect aws/boto3 to
        the new path by setting AWS_CONFIG_FILE & AWS_SHARED_CREDENTIALS_FILE 
        in your .env

    