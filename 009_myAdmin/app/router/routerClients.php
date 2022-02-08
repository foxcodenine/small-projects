<?php

use app\Controller\MyUtilities;
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
    $errorTitle     = $_SESSION['error']['errorTitle'] ?? '&nbsp;';
    $errorFirstname = $_SESSION['error']['errorFirstname'] ?? '&nbsp;';
    $errorLastname  = $_SESSION['error']['errorLastname'] ?? '&nbsp;'; 
    $errorId        = $_SESSION['error']['errorId'] ?? '&nbsp;'; 
    $errorCompany   = $_SESSION['error']['errorCompany'] ?? '&nbsp;'; 
    $errorEmail     = $_SESSION['error']['errorEmail'] ?? '&nbsp;'; 
    $errorPhone     = $_SESSION['error']['errorPhone'] ?? '&nbsp;'; 
    $errorMobile    = $_SESSION['error']['errorMobile'] ?? '&nbsp;'; 
    $errorStrAddr   = $_SESSION['error']['errorStrAddr'] ?? '&nbsp;'; 
    $errorLocality  = $_SESSION['error']['errorLocality'] ?? '&nbsp;'; 
    $errorCountry   = $_SESSION['error']['errorCountry'] ?? '&nbsp;'; 
    $errorPostcode  = $_SESSION['error']['errorPostcode'] ?? '&nbsp;'; 
    
    // --- default select option
    $title = $_SESSION['client']['title'] ?? ''; 


    
    $listLocality = MyUtilities::fetchOptionsFromDB('locality');
    $listCountry  = MyUtilities::fetchOptionsFromDB('country');



    // --- If post

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        $_SESSION['client']['title']        = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
        $_SESSION['client']['firstname']    = ucwords(strtolower(filter_input(INPUT_POST, 'fistname', FILTER_SANITIZE_STRING)));
        $_SESSION['client']['lastname']     = ucwords(strtolower(filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_STRING)));
        $_SESSION['client']['id']           = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING);
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
            $_SESSION['error']['errorFirstname'] = 'This field is required';
        }

        if (!$_SESSION['client']['lastname']) {
            $_SESSION['error']['errorLastname'] = 'This field is required';
        }

        if (!empty($_SESSION['client']['email']) && !filter_var($_SESSION['client']['email'], FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error']['errorEmail'] = 'Invalid email address';
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