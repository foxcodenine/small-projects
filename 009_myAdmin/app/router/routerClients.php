<?php

use app\Controller\MyUtilities;
use app\Model\DBConnect;

$router->match('GET', '/clients', function() {
    
    $pageName = 'clients'; include './app/views/_page.php';
    exit;

});



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
    




    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        $_SESSION['client']['title']        = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
        $_SESSION['client']['firstname']    = filter_input(INPUT_POST, 'fistname', FILTER_SANITIZE_STRING);
        $_SESSION['client']['lastname']     = filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_STRING);
        $_SESSION['client']['id']           = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING);
        $_SESSION['client']['company']      = filter_input(INPUT_POST, 'company', FILTER_SANITIZE_STRING);
        $_SESSION['client']['email']        = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $_SESSION['client']['phone']        = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING);
        $_SESSION['client']['mobile']       = filter_input(INPUT_POST, 'mobile', FILTER_SANITIZE_STRING);
        $_SESSION['client']['strAddr']      = filter_input(INPUT_POST, 'strAddr', FILTER_SANITIZE_STRING);
        $_SESSION['client']['locality']     = filter_input(INPUT_POST, 'locality', FILTER_SANITIZE_STRING);
        $_SESSION['client']['country']      = filter_input(INPUT_POST, 'country', FILTER_SANITIZE_STRING);
        $_SESSION['client']['postcode']     = filter_input(INPUT_POST, 'postcode', FILTER_SANITIZE_STRING);
        $_SESSION['client']['clientInfo']   = htmlspecialchars($_POST['clientInfo']);

        unset($_POST);

        // echo $_SESSION['client']['title']; exit();
   

        // _____________________________________________________________


        if (!$_SESSION['client']['firstname']) {
            $_SESSION['error']['errorFirstname'] = 'This field is required';
        }

        if (!$_SESSION['client']['lastname']) {
            $_SESSION['error']['errorLastname'] = 'This field is required';
        }

        if (!empty($_SESSION['client']['email']) && !filter_var($_SESSION['client']['email'], FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error']['errorEmail'] = 'Invalid email address';
        }


        if (!isset($_SESSION['error']) || empty($_SESSION['error'])) {
            
            function localityExists ($locality=false) {

                if (!isset($locality) || empty($locality)) return false;

                // -----------------------------------------------------

                $conn = DBConnect::getConn();
                $sql = 'SELECT * FROM Locality WHERE lName = :locality';

                $stmt = $conn->prepare($sql);
                $stmt->bindValue(':locality', $locality);

                $stmt->execute();

                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

                var_dump((bool) $result);
                echo '<br>';

                var_dump($_SESSION);

                exit();

                // -----------------------------------------------------
                
                
            } 

            localityExists($_SESSION['client']['locality']);
            
        }




        MyUtilities::redirect('/009/clients-add');
        exit();
    }

    $pageName = 'clients_add'; include './app/views/_page.php';
    unset($_SESSION['error']);
    unset($_SESSION['client']);
    exit;

});
