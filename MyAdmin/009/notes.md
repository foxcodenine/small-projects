## ------ Sites --------------------------------------------------------
https://packagist.org/ 

https://www.toptal.com/designers/htmlarrows/symbols/

https://www.flaticon.com/search?word=eye&type=icon

https://iconmonstr.com/ 
https://iconmonstr.com/checkbox-3-svg/

## ------ Music --------------------------------------------------------

https://www.youtube.com/watch?v=iJ51s0dDUn0
https://www.youtube.com/watch?v=j6hwb1IE0xk
https://www.youtube.com/watch?v=jE74DEsjmlQ&t=599s

## ------ Linux --------------------------------------------------------

To recursively give directories read&execute privileges:

    $ find /path/to/base/dir -type d -print0 | xargs -0 chmod 755 
    $ find /path/to/base/dir -type f -print0 | xargs -0 chmod 644

## ------ Apache -------------------------------------------------------

### Enable htaccess in Apache

First enable rewrite using this command:

    $ sudo a2enmod rewrite

Restart apache2:

    $ sudo service apache2 restart

Then go into the sites-available folder: 

    /etc/apache2/sites-available

And add the following to your virtual host (default vh: 000-default.conf)

        <Directory />
            AllowOverride none
            Require all denied
        </Directory>
        <Directory /var/www/html>
            Options Indexes FollowSymLinks
            AllowOverride All
            Require all granted
        </Directory>

And:    $ sudo service apache2 restart

note: 
In the first part we are restricting access  from to / foward.
And granting from  /var/www/html onwards.



## ------ PHP Pacages --------------------------------------------------

### installing composer

Check if instraction are update here:

    https://getcomposer.org/download/

Download the installer to the current directory:

    $ php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"

Verify the installer SHA-384:

    $ php -r "if (hash_file('sha384', 'composer-setup.php') === '906a84df04cea2aa72f40b5f787e49f22d4c2f19492ac310e8cba5b96ac8b64115ac402c8cd292b8a03482574915d1a8') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"

Run the installer:

    $ php composer-setup.php

Remove the installer:

    $ php -r "unlink('composer-setup.php');"

Most likely, you want to put the composer.phar into a directory on your PATH, so you can simply call composer from any directory (Global install), using for example:

    $ sudo mv composer.phar /usr/local/bin/composer


### phpdotenv
https://github.com/vlucas/phpdotenv

    $ composer require vlucas/phpdotenv
    $ composer dump-autoload -o

### bramus/router
https://packagist.org/packages/bramus/router
https://github.com/bramus/router

    $ composer require bramus/router ~1.6
    $ composer dump-autoload -o

### PHPMailer
https://github.com/PHPMailer/PHPMailer

    $ composer require phpmailer/phpmailer
    $ composer dump-autoload -o



## ------ JS Script ----------------------------------------------------

#### CKEditor

You can find the script in 'static/js/ck-editor/ckeditor.js' 
& my 'wysiwyg()' function in 'static/js/script.js' 

else include:

    <script src="https://cdn.ckeditor.com/ckeditor5/25.0.0/classic/ckeditor.js"></script>

and follow:

https://ckeditor.com/docs/ckeditor5/latest/builds/guides/quick-start.html
https://ckeditor.com/docs/ckeditor5/latest/builds/guides/integration/configuration.html



#### vanillajs-datepicker


You can find the script in 'static/js/vanillajs-datepicker/datepicker-full.min.js' 
& my'formatDateInput()' function in 'static/js/script.js' 

And the css style file in  static/css/datepicker.min.css

else include:

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/vanillajs-datepicker@1.2.0/dist/css/datepicker.min.css">
    <script src="https://cdn.jsdelivr.net/npm/vanillajs-datepicker@1.1.4/dist/js/datepicker-full.min.js"></script>

and  follow:

    https://mymth.github.io/vanillajs-datepicker/#/




#### tippyJS


You can find the script in 'static/js/tippy-js/...' 
& my'formatDateInput()' function in 'static/js/script.js' 

else include:

    <!-- Development -->
    <script src="https://unpkg.com/@popperjs/core@2/dist/umd/popper.min.js"></script>
    <script src="https://unpkg.com/tippy.js@6/dist/tippy-bundle.umd.js"></script>

    <!-- Production -->
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="https://unpkg.com/tippy.js@6"></script>

and  follow:

    https://atomiks.github.io/tippyjs/
    https://atomiks.github.io/tippyjs/v6/getting-started/




#### Drag to scroll
https://htmldom.dev/drag-to-scroll/




## ------ CSS & SASS ---------------------------------------------------



#### Stylized Table Design from Figma to HTML CSS
https://www.youtube.com/watch?v=Oy9K7iz3aa4



#### How TO - Responsive Tables
https://www.w3schools.com/howto/howto_css_table_responsive.asp