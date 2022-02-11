<?php

use app\Model\MyUtilities;
use app\Model\Client;
use app\Model\DBConnect;

////////////////////////////////////////////////////////////////////////

$router->match('GET', '/clients', function() {

    Client::updatedClientList();
    
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
    $errorInfoClient  = $_SESSION['error']['infoClient'] ?? ''; 
    
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
        $_SESSION['client']['locality']     = ucwords(strtolower(trim(filter_input(INPUT_POST, 'locality', FILTER_SANITIZE_STRING))));
        $_SESSION['client']['country']      = ucwords(strtolower(trim(filter_input(INPUT_POST, 'country', FILTER_SANITIZE_STRING))));
        $_SESSION['client']['postcode']     = strtoupper(filter_input(INPUT_POST, 'postcode', FILTER_SANITIZE_STRING));
        $_SESSION['client']['infoClient']   = trim(htmlspecialchars($_POST['infoClient']));

        

        unset($_POST);

    
        // --- Validating fields

        if (!$_SESSION['client']['firstname']) {
            $_SESSION['error']['firstname'] = 'This field is required';
        } else if (!MyUtilities::validateName($_SESSION['client']['firstname'])) {
            $_SESSION['error']['firstname'] = 'Invalid firstname';
        } else {
            unset($_SESSION['error']['firstname']);
        }

        if (!$_SESSION['client']['lastname']) {
            $_SESSION['error']['lastname'] = 'This field is required';
        } else if (!MyUtilities::validateName($_SESSION['client']['lastname'])) {
            $_SESSION['error']['lastname'] = 'Invalid lastname';
        } else {
            unset($_SESSION['error']['lastname']);
        }

        if (!empty($_SESSION['client']['email']) && !filter_var($_SESSION['client']['email'], FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error']['email'] = 'Invalid email address';
        } else {
            unset($_SESSION['error']['email']);
        }

        if (!MyUtilities::validatePhoneNumber($_SESSION['client']['phone'])) {
            $_SESSION['error']['phone'] = 'Invalid Format';
        } else {
            unset($_SESSION['error']['phone']);
        }

        if (!MyUtilities::validatePhoneNumber($_SESSION['client']['mobile'])) {
            $_SESSION['error']['mobile'] = 'Invalid Format';
        } else {
            unset($_SESSION['error']['mobile']);
        }

        if ($_SESSION['client']['infoClient'] && strlen($_SESSION['client']['infoClient']) > 65500 ) {
            $_SESSION['error']['infoClient'] = 'Client info is too long' . strlen($_SESSION['client']['infoClient']);

        } else {


            unset($_SESSION['error']['infoClient']);
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
                $_SESSION['client']['locality'] ?: null,
                $_SESSION['client']['country']  ?: null,
                (int) unserialize($_SESSION['currentUser'])->getId()                
            );
            

            // --- If info save to db  in infoClient table;
            if(
                isset($_SESSION['client']['infoClient']) && 
                !empty($_SESSION['client']['infoClient'])
            ) { 
                $newClient->info('create', $_SESSION['client']['infoClient']);
            }
            
            
            // --- Redirect to client page;
            unset($_SESSION['client']);
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