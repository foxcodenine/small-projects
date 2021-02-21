### Connect to AWS server

    $ sudo ssh -i "deploy_web_apps.pem" ubuntu@ec2-54-93-189-85.eu-central-1.compute.amazonaws.com

### Load dist folder to AWS server

    $ sudo scp -i ./deploy_web_apps.pem -r /home/foxcodenine/Desktop/JoeFalzonWebSite/frontend_nuxt/dist ubuntu@ec2-54-93-189-85.eu-central-1.compute.amazonaws.com:/var/www/projects/002_jf_website/




<VirtualHost *:80>
ServerName foxcode.io


        Alias /001/nuxt /var/www/projects/001_trava/dist/nuxt
        Alias /001 /var/www/projects/001_trava/dist
        RequestHeader append "API-KEY" "123#456#789"
        <Directory "/var/www/projects/001_trava/dist" >
            allow from all
            AllowOverride All
            Order allow,deny
            Options +Indexes
        </Directory>



        WSGIScriptAlias /api/001 /var/www/projects/001_trava/backend_flask_deploy/flaskapp.wsgi
        <Directory /var/www/projects/001_trava/backend_flask_deploy>
            Order allow,deny
            Allow from all
        </Directory>

########################################################################

        Alias /002/nuxt /var/www/projects/002_jf_website/dist/nuxt
        Alias /002 /var/www/projects/002_jf_website/dist
#        RequestHeader append "API-KEY" "123#456#789"
        <Directory "/var/www/projects/002_jf_website/dist" >
            allow from all
            AllowOverride All
            Order allow,deny
            Options +Indexes
        </Directory>


        ErrorLog ${APACHE_LOG_DIR}/error.log
        LogLevel warn
        CustomLog ${APACHE_LOG_DIR}/access.log combined


        RewriteEngine on
</VirtualHost>
