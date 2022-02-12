<?php

use app\Model\MyUtilities;
use app\Model\Client;
use app\Model\DBConnect;

////////////////////////////////////////////////////////////////////////

$router->match('GET|POST', '/clients-edit', function() {


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
        echo 123; exit();
    }

    
    $pageName = 'clients_add'; include './app/views/_page.php';
    unset($_SESSION['error']);
    unset($_SESSION['client']);
    exit;

});

////////////////////////////////////////////////////////////////////////


