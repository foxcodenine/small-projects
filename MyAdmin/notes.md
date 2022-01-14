## ------ Sites --------------------------------------------------------
https://packagist.org/ 

https://www.toptal.com/designers/htmlarrows/symbols/

https://www.flaticon.com/search?word=eye&type=icon

https://iconmonstr.com/ 
https://iconmonstr.com/checkbox-3-svg/

## ------ Linux --------------------------------------------------------

To recursively give directories read&execute privileges:

    $ find /path/to/base/dir -type d -print0 | xargs -0 chmod 755 
    $ find /path/to/base/dir -type f -print0 | xargs -0 chmod 644

## ------ PHP Pacages --------------------------------------------------



#### phpdotenv
https://github.com/vlucas/phpdotenv

    $ composer require vlucas/phpdotenv
    $ composer dump-autoload -o

#### bramus/router
https://packagist.org/packages/bramus/router
https://github.com/bramus/router

    $ composer require bramus/router ~1.6
    $ composer dump-autoload -o

#### PHPMailer
https://github.com/PHPMailer/PHPMailer

    $ composer require phpmailer/phpmailer
    $ composer dump-autoload -o



## ------ JS Script ----------------------------------------------------

#### CKEditor

You can find the script in 'static/js/ckeditor.js' 
& my 'wysiwyg()' function in 'static/js/script.js' 

else include:

    <script src="https://cdn.ckeditor.com/ckeditor5/25.0.0/classic/ckeditor.js"></script>

and follow:

https://ckeditor.com/docs/ckeditor5/latest/builds/guides/quick-start.html
https://ckeditor.com/docs/ckeditor5/latest/builds/guides/integration/configuration.html



#### vanillajs-datepicker


You can find the script in 'static/js/datepicker-full.min.js' 
& my'formatDateInput()' function in 'static/js/script.js' 

And the css style file in  static/css/datepicker.min.css

else include:

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/vanillajs-datepicker@1.2.0/dist/css/datepicker.min.css">
    <script src="https://cdn.jsdelivr.net/npm/vanillajs-datepicker@1.1.4/dist/js/datepicker-full.min.js"></script>

and  follow:

    https://mymth.github.io/vanillajs-datepicker/#/