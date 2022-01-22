## ------ Sites --------------------------------------------------------
https://packagist.org/ 

https://www.toptal.com/designers/htmlarrows/symbols/

https://www.flaticon.com/search?word=eye&type=icon

https://iconmonstr.com/ 
https://iconmonstr.com/checkbox-3-svg/
https://www.youtube.com/watch?v=j6hwb1IE0xk

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