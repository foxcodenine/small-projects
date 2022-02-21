<?php

use app\Model\MyUtilities;
use app\Model\Client;
use app\Model\DBConnect;
use app\Model\MyCript;

////////////////////////////////////////////////////////////////////////

$router->match('GET|POST', '/clients-add|clients-edit(\d+)|clients-edit', function($id=null) {


    // ----- Get url endpoint

    $arrURL = explode('/', $_SERVER['REQUEST_URI']);
    $endpointURL = end($arrURL);

    // -----------------------------------------------------------------

    switch ($endpointURL) {
        // Check if ADD or EDIT.
        // If ADD break 
        // If EDIT set client in session
        // Or redirect if clientID is empty or invalid.

        case 'clients-add':
            $currentClient = new stdClass;
            break;

        case 'clients-edit':
            MyUtilities::redirect($_ENV['BASE_PATH']);
            exit();
            break;
                
        default:
            $endpointURL = 'clients-edit';    
            
            if (!Client::checkForClientList()) {
                Client::updateClientList();
            }
            if (array_key_exists($id, Client::getClientList() ) && !isset($_SESSION['client']['id'])) {
                $currentClient = Client::getClientList()[$id];

                $_SESSION['client']['id']       = $currentClient->getId() ?? ''; 
                $_SESSION['client']['title']    = $currentClient->getTitle() ?? '';        
                $_SESSION['client']['firstname']= $currentClient->getFirstname() ?? '';
                $_SESSION['client']['lastname'] = $currentClient->getLastname() ?? '';
                $_SESSION['client']['idCard']   = $currentClient->getIdCard() ?? '';
                $_SESSION['client']['company']  = $currentClient->getCompany() ?? '';
                $_SESSION['client']['email']    = $currentClient->getEmail() ?? '';
                $_SESSION['client']['phone']    = $currentClient->getPhone() ?? '';
                $_SESSION['client']['mobile']   = $currentClient->getMobile() ?? '';
                $_SESSION['client']['strAddr']  = $currentClient->getStrAddr() ?? '';
                $_SESSION['client']['locality'] = $currentClient->getLocalityName() ?? '';
                $_SESSION['client']['country']  = $currentClient->getCountryName() ?? '';
                $_SESSION['client']['postcode'] = $currentClient->getPostcode() ?? '';

                $_SESSION['client']['infoClient'] = $currentClient->info('read');
     
            } else {
                MyUtilities::redirect($_ENV['BASE_PATH']);
                exit();
            }
    }

    // _________________________________________________________________

    // --- setting error messages
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
    
    // --- Set select option 
    $title = $_SESSION['client']['title'] ?? ''; 
  
    $listLocality = MyUtilities::fetchOptionsFromDB('locality');
    $listCountry  = MyUtilities::fetchOptionsFromDB('country');



    // --- If post

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        $_SESSION['client']['title']        = MyCript::stringSanitize($_POST['title']);
        $_SESSION['client']['firstname']    = ucwords(strtolower( MyCript::stringSanitize($_POST['firstname'])));
        $_SESSION['client']['lastname']     = ucwords(strtolower( MyCript::stringSanitize($_POST['lastname'])));
        $_SESSION['client']['idCard']       = strtolower(MyCript::stringSanitize($_POST['idCard']));
        $_SESSION['client']['company']      = MyCript::stringSanitize($_POST['company']);
        $_SESSION['client']['email']        = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $_SESSION['client']['phone']        = MyCript::stringSanitize($_POST['phone']);
        $_SESSION['client']['mobile']       = MyCript::stringSanitize($_POST['mobile']);
        $_SESSION['client']['strAddr']      = MyCript::stringSanitize($_POST['strAddr']);
        $_SESSION['client']['locality']     = ucwords(strtolower(MyCript::stringSanitize($_POST['locality'])));
        $_SESSION['client']['country']      = ucwords(strtolower(MyCript::stringSanitize($_POST['country'])));
        $_SESSION['client']['postcode']     = strtoupper(MyCript::stringSanitize($_POST['postcode']));
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


        // ----- if NO error

        if (!isset($_SESSION['error']) || empty($_SESSION['error'])) {
            
            // --- Check if locality and country are in db

            $location_in_db = empty($_SESSION['client']['locality']) ?: MyUtilities::localityInDB($_SESSION['client']['locality']);
            $country_in_db  = empty($_SESSION['client']['country']) ?: MyUtilities::countryInDB($_SESSION['client']['country']);


            
            if (!$country_in_db) {
                MyUtilities::insertOptionToDB('country', $_SESSION['client']['country']);
            }
            
            if (!$location_in_db) {
                MyUtilities::insertOptionToDB('locality', $_SESSION['client']['locality']);
            }

            // --- Createing New Client

            if ($endpointURL === 'clients-add') {

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
            }

            // --- Edit clients
            if ($endpointURL === 'clients-edit') {

                $currentClient->setTitle($_SESSION['client']['title']);
                $currentClient->setFirstname($_SESSION['client']['firstname']);
                $currentClient->setLastname($_SESSION['client']['lastname']);
                $currentClient->setIdCard($_SESSION['client']['idCard']);
                $currentClient->setCompany($_SESSION['client']['company']);
                $currentClient->setEmail($_SESSION['client']['email']);
                $currentClient->setPhone($_SESSION['client']['phone']);
                $currentClient->setMobile($_SESSION['client']['mobile']);
                $currentClient->setStrAddr($_SESSION['client']['strAddr']);
                $currentClient->setPostcode($_SESSION['client']['postcode']);
                $currentClient->setLocalityName($_SESSION['client']['locality']);
                $currentClient->setCountryName($_SESSION['client']['country']);

                $currentClient->updateClientToDB();
                $currentClient->info('update', $_SESSION['client']['infoClient']);

            }

            
            
            // --- Redirect to client page;
            unset($_SESSION['client']);
            MyUtilities::redirect($_ENV['BASE_PATH'] . '/clients');
            exit();
        }

        
        MyUtilities::redirect($_ENV['BASE_PATH'] . '/clients-add');
        exit();

    }  
    // --- End post

    $pageName = 'clients_add_edit'; include './app/views/_page.php';
    unset($_SESSION['error']);
    unset($_SESSION['client']);
    exit;

});

////////////////////////////////////////////////////////////////////////