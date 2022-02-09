<?php

use app\Controller\MyUtilities;
use app\Model\Client;
use app\Model\DBConnect;

////////////////////////////////////////////////////////////////////////

$router->match('GET', '/clients', function() {
    
    $pageName = 'clients'; include './app/views/_page.php';
    unset($_SESSION['error']);
    unset($_SESSION['client']);
    exit;

});

////////////////////////////////////////////////////////////////////////

$router->match('GET|POST', '/clients-add', function() {

    // --- setting password & error message
    $errorTitle     = $_SESSION['error']['title'] ?? '&nbsp;';
    $errorFirstname = $_SESSION['error']['firstname'] ?? '&nbsp;';
    $errorLastname  = $_SESSION['error']['lastname'] ?? '&nbsp;'; 
    $errorIdCard    = $_SESSION['error']['idCard'] ?? '&nbsp;'; 
    $errorCompany   = $_SESSION['error']['company'] ?? '&nbsp;'; 
    $errorEmail     = $_SESSION['error']['email'] ?? '&nbsp;'; 
    $errorPhone     = $_SESSION['error']['phone'] ?? '&nbsp;'; 
    $errorMobile    = $_SESSION['error']['mobile'] ?? '&nbsp;'; 
    $errorStrAddr   = $_SESSION['error']['strAddr'] ?? '&nbsp;'; 
    $errorLocality  = $_SESSION['error']['locality'] ?? '&nbsp;'; 
    $errorCountry   = $_SESSION['error']['country'] ?? '&nbsp;'; 
    $errorPostcode  = $_SESSION['error']['postcode'] ?? '&nbsp;'; 
    
    // --- default select option
    $title = $_SESSION['client']['title'] ?? ''; 


    
    $listLocality = MyUtilities::fetchOptionsFromDB('locality');
    $listCountry  = MyUtilities::fetchOptionsFromDB('country');



    // --- If post

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        $_SESSION['client']['title']        = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
        $_SESSION['client']['firstname']    = ucwords(strtolower(filter_input(INPUT_POST, 'fistname', FILTER_SANITIZE_STRING)));
        $_SESSION['client']['lastname']     = ucwords(strtolower(filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_STRING)));
        $_SESSION['client']['idCard']       = filter_input(INPUT_POST, 'idCard', FILTER_SANITIZE_STRING);
        $_SESSION['client']['company']      = (filter_input(INPUT_POST, 'company', FILTER_SANITIZE_STRING));
        $_SESSION['client']['email']        = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $_SESSION['client']['phone']        = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING);
        $_SESSION['client']['mobile']       = filter_input(INPUT_POST, 'mobile', FILTER_SANITIZE_STRING);
        $_SESSION['client']['strAddr']      = filter_input(INPUT_POST, 'strAddr', FILTER_SANITIZE_STRING);
        $_SESSION['client']['locality']     = ucwords(strtolower(filter_input(INPUT_POST, 'locality', FILTER_SANITIZE_STRING)));
        $_SESSION['client']['country']      = ucwords(strtolower(filter_input(INPUT_POST, 'country', FILTER_SANITIZE_STRING)));
        $_SESSION['client']['postcode']     = strtoupper(filter_input(INPUT_POST, 'postcode', FILTER_SANITIZE_STRING));
        $_SESSION['client']['clientInfo']   = trim(htmlspecialchars($_POST['clientInfo']));

        unset($_POST);

    
        // --- Validating fields

        if (!$_SESSION['client']['firstname']) {
            $_SESSION['error']['firstname'] = 'This field is required';
        }

        if (!$_SESSION['client']['lastname']) {
            $_SESSION['error']['lastname'] = 'This field is required';
        }

        if (!empty($_SESSION['client']['email']) && !filter_var($_SESSION['client']['email'], FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error']['email'] = 'Invalid email address';
        }

        if (!MyUtilities::validatePhoneNumber($_SESSION['client']['phone'])) {
            $_SESSION['error']['phone'] = 'Invalid Format';
        }

        if (!MyUtilities::validatePhoneNumber($_SESSION['client']['mobile'])) {
            $_SESSION['error']['mobile'] = 'Invalid Format';
        }


        // --- Createing New Client

        if (!isset($_SESSION['error']) || empty($_SESSION['error'])) {
            

            $location_in_db = empty($_SESSION['client']['locality']) ?: MyUtilities::localityInDB($_SESSION['client']['locality']);
            $country_in_db  = empty($_SESSION['client']['country']) ?: MyUtilities::countryInDB($_SESSION['client']['country']);

            
            if (!$country_in_db) {
                MyUtilities::insertOptionToDB('country', $_SESSION['client']['country']);
            }
            
            if (!$location_in_db) {
                MyUtilities::insertOptionToDB('locality', $_SESSION['client']['locality']);
            }


            $newClient = new Client(
                $_SESSION['client']['firstname'],
                $_SESSION['client']['lastname'],
                null,
                $_SESSION['client']['title'],
                $_SESSION['client']['idCard'],
                $_SESSION['client']['company'],
                $_SESSION['client']['email'],
                $_SESSION['client']['phone'],
                $_SESSION['client']['mobile'],
                $_SESSION['client']['strAddr'],
                $_SESSION['client']['postcode'],
                $_SESSION['client']['locality'],
                $_SESSION['client']['country'],
                (int) unserialize($_SESSION['currentUser'])->getId()                
            );
            unset($_SESSION['client']);

            // Save Client info in db // NOTE:

            MyUtilities::redirect('/009/clients');
            exit();
        }

        MyUtilities::redirect('/009/clients-add');
        exit();

    }  
    // --- End post

    $pageName = 'clients_add'; include './app/views/_page.php';
    unset($_SESSION['error']);
    unset($_SESSION['client']);
    exit;

});

////////////////////////////////////////////////////////////////////////