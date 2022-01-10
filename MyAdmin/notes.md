## ------ Sites --------------------------------------------------------
https://packagist.org/ 

https://www.toptal.com/designers/htmlarrows/symbols/

https://www.flaticon.com/search?word=eye&type=icon


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
