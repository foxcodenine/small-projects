## ------ Sites --------------------------------------------------------
https://packagist.org/

https://www.toptal.com/designers/htmlarrows/symbols/

https://www.flaticon.com/search?word=eye&type=icon

https://iconmonstr.com/
https://iconmonstr.com/checkbox-3-svg/
https://dev.w3.org/html5/html-author/charref

https://shortpixel.com/online-image-compression

https://github.com/ckeditor/ckeditor4

https://computingforgeeks.com/install-and-use-firewalld-on-ubuntu/
https://www.digitalocean.com/community/tutorials/how-to-install-the-apache-web-server-on-centos-7


## image display and slider
https://www.youtube.com/watch?v=QghhoJBdw7A
https://www.youtube.com/watch?v=KcdBOoK3Pfw
https://www.youtube.com/watch?v=TSRtBISvsh4

https://splidejs.com/guides/getting-started/

## ------  DigitalOcean Spaces -----------------------------------------

https://docs.digitalocean.com/products/spaces/resources/s3-sdk-examples/

https://www.digitalocean.com/community/tools/adapting-an-existing-aws-s3-application-to-digitalocean-spaces

## ------ Bash ---------------------------------------------------------

https://ryanstutorials.net/bash-scripting-tutorial/bash-if-statements.php

## ------ AWS S3 -------------------------------------------------------

Tutorials
https://blog.trigent.com/crud-operations-on-amazon-s3-using-php-aws-sdk/
https://blog.eduonix.com/web-programming-tutorials/learn-s3-using-aws-php-sdk/

https://packagist.org/packages/aws/aws-sdk-php
$ composer require aws/aws-sdk-php
$ composer dump-autoload -o

https://www.youtube.com/watch?v=giFKMqZ_d5E
https://www.youtube.com/watch?v=6fZQHLbNZjY

Documantation
https://docs.aws.amazon.com/sdk-for-php/v3/developer-guide/s3-examples.html
https://docs.aws.amazon.com/en_cn/sdk-for-php/v3/developer-guide/guide_configuration.html
https://aws.amazon.com/sdk-for-php/

Amazon Simple Storage Service (php)
https://docs.aws.amazon.com/aws-sdk-php/v3/api/api-s3-2006-03-01.html#listobjects



## ------ Createing thumbnails -----------------------------------------

https://pqina.nl/blog/creating-thumbnails-with-php/
https://www.umaryland.edu/cpa/toolbox/web-image-specifications-cheat-sheet/#d.en.356608

https://css-tricks.com/almanac/properties/f/filter/


## ------ Hosting and deploying ----------------------------------------

https
https://www.digitalocean.com/community/tutorials/how-to-secure-apache-with-let-s-encrypt-on-ubuntu-20-04

vh_redirection
https://linuxize.com/post/redirect-http-to-https-in-apache/

DNS
https://www.namecheap.com/support/knowledgebase/article.aspx/319/2237/how-can-i-set-up-an-a-address-record-for-my-domain/


## ------ Ideas --------------------------------------------------------

https://support.anghami.com/hc/en-us
https://www.mjmda.eu/portfolio/pipeline/binomial/
https://www.mjmda.eu/portfolio/pipeline/old-spine-new-space/
https://www.model.mt/house51



## ------ Music --------------------------------------------------------

https://www.youtube.com/watch?v=BRjT__r6IfA
https://www.youtube.com/watch?v=3nocNDQOWQQ
https://www.youtube.com/watch?v=-VeEfElzJ-w&list=RDiJ51s0dDUn0&index=3
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

Enable the vhost

    $ sudo a2ensite YOUR_VHOST.com.conf

Restart apache2:

    $ sudo service apache2 restart

Then go into the sites-available folder:

    /etc/apache2/sites-available

And add the following to your virtual host (default vh: 000-default.conf or in your vh)

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

## ------ PHP Extention that required installation on server -----------

    $ sudo apt-get install php8.0-gd
    $ sudo apt install php8.0-xmlwriter
    $ sudo systemctl restart apache2

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

You might need too Enable PHP mail() function on Ubuntu
    https://researchhubs.com/post/computing/linux-basic/enable-php-mail-function-to-work-on-ubuntu.html

    and installing sendmail

    $ sudo apt install sendmail

    also you may need to update your /etc/hosts too. Check:
    git/repo/research_n_study/resources/Linux/Sendmail___unqualified_hostname_unknown..._Tutorials_-_Learn.pdf





## ------ JS Script ----------------------------------------------------

https://attacomsian.com/blog/javascript-update-url-without-page-reload

https://christopheraue.net/design/fading-pages-on-load-and-unload

#### swup

https://github.com/swup/swup
https://www.youtube.com/watch?v=eVwH3VL1EsA


<!-- Swup can be installed from npm…

    $ npm install swup

…or include the file from the dist folder…

    <script src="./dist/swup.js"></script>

    or directly from unpkg
    <script src="https://unpkg.com/swup@latest/dist/swup.min.js"></script>   -->


#### CKEditor4

    https://github.com/ckeditor/ckeditor4

Getting started
Using npm package

        npm install --save ckeditor
Use it on your website:

    <div id="editor">
        <p>This is the editor content.</p>
    </div>

    <script src="./node_modules/ckeditor/ckeditor.js"></script>

    <script>
        CKEDITOR.replace( 'editor' );
    </script>

Using CDN
Load the CKEditor 4 script from CDN:

    <div id="editor">
        <p>This is the editor content.</p>
    </div>

    <script src="https://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>

    <script>
        CKEDITOR.replace( 'editor' );
    </script>



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



## ------ MySQL --------------------------------------------------------

https://www.mysqltutorial.org/mysql-on-delete-cascade/




## ------ Messages --------------------------------------------------------

An email with a link to reset your password has been sent to: chris12aug@yahoo.com
