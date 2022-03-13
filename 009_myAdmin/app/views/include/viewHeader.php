<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="expires" content="Sun, 01 Jan 2014 00:00:00 GMT"/>
    <meta http-equiv="pragma" content="no-cache" />


    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="app/static/css/datepicker.min.css">
    <link rel="stylesheet" href="app/static/css/style.css">
    <title>MyAdmin</title>
    <link rel="shortcut icon" href="./app/static/images/fav.svg" type="image/x-icon"/>

    <?php

    use app\Model\MyUtilities;



    if ($pageName !== 'sign_up' && $pageName !== 'sign_in' && $pageName !== 'disclaimer' && $pageName !== 'terms') {

        MyUtilities::checkCookieAndReturnUser();
        MyUtilities::userInSessionPage();

    } else if ($pageName === 'terms') {

    } else {
        
        MyUtilities::checkCookieAndReturnUser();
        MyUtilities::userInSessionSigning();
    }    
    ?>  
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/vanillajs-datepicker@1.2.0/dist/css/datepicker.min.css">
    <script src="https://cdn.jsdelivr.net/npm/vanillajs-datepicker@1.1.4/dist/js/datepicker-full.min.js"></script>
</head>



