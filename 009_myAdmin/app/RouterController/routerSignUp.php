<?php

use app\Model\MyCript;
use app\Model\MyUtilities;
use app\Model\DBConnect;
use app\Model\DBTables;
use app\Model\Mail;
use app\Model\User;

// ___ Sign-Up _________________________________________________________
////////////////////////////////////////////////////////////////////////


$router->match('GET|POST', '/sign-up', function() {


    // --- setting messages
    $message = $_SESSION['message']['content'] ?? '&nbsp;';    
    $messageType = $_SESSION['message']['type'] ?? 'none';
    

    

    // --- setting password & error message
    $errorEmail    = $_SESSION['error']['errorEmail'] ?? '&nbsp;';
    $errorPassword = $_SESSION['error']['errorPassword'] ?? '&nbsp;'; 
    $errorLastname    = $_SESSION['error']['errorLastname'] ?? '&nbsp;';
    $errorFirstname = $_SESSION['error']['errorFirstname'] ?? '&nbsp;'; 
    

    
    // --- if post
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {


        // _____________________________________________________________

        $firstname = ucwords(strtolower(filter_input(INPUT_POST, 'firstname',  FILTER_SANITIZE_STRING)));
        $lastname  = ucwords(strtolower(filter_input(INPUT_POST, 'lastname',   FILTER_SANITIZE_STRING)));
        $email     = filter_input(INPUT_POST, 'email',      FILTER_SANITIZE_EMAIL);
        $password  = filter_input(INPUT_POST, 'password',   FILTER_SANITIZE_STRING);  
        unset($_POST);   
        
        
        $_SESSION['sign-up']['firstname'] = $firstname;
        $_SESSION['sign-up']['lastname'] = $lastname;
        $_SESSION['sign-up']['email'] = $email;
        $_SESSION['sign-up']['password'] = $password;

        
        // _____________________________________________________________

        if (!$email) {
            $_SESSION['error']['errorEmail'] = 'This field is required';

        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error']['errorEmail'] = 'Invalid email address';

        } elseif (MyUtilities::emailInDB($email)) {
            $_SESSION['error']['errorEmail'] = 'This Email address is already being used';

        } else {
            unset($_SESSION['error']['errorEmail']);
        }

        if (!$password) {
            $_SESSION['error']['errorPassword'] = 'This field is required';

        } elseif (strlen($password) < 6) {
            $_SESSION['error']['errorPassword'] = 'Password is too short';

        } elseif (strlen($password) > 25) {
            $_SESSION['error']['errorPassword'] = 'Password is too long';

        } else {
            unset($_SESSION['error']['errorPassword']);
        }

        if (!$firstname) {
            $_SESSION['error']['errorFirstname'] = 'This field is required';

        } elseif (!MyUtilities::validateName($firstname)) {
            $_SESSION['error']['errorFirstname'] = 'Invalid firstname';

        } else {
            unset($_SESSION['error']['errorFirstname']);
        }

        if (!$lastname) {
            $_SESSION['error']['errorLastname'] = 'This field is required';

        } elseif (!MyUtilities::validateName($lastname)) {
            $_SESSION['error']['errorLastname'] = 'Invalid lastname';

        } else {
            unset($_SESSION['error']['errorLastname']);
        }

        // _____________________________________________________________

        if (!isset($_SESSION['error']) || empty($_SESSION['error'])) {     


            $_SESSION['message']['content'] = "An email has been sent to {$email} to activate your account.";
            $_SESSION['message']['type'] = 'success';
    
            $newUser = new User( email:$email, passHash:$password, 
                firstUserName:$firstname, lastUserName:$lastname );

            DBTables::populateTables($email);            
    
            $emailMail = new Mail();
            $emailMail->recipient($email, "$firstname $lastname");
            $emailMail->contentAccountActivation($newUser);
            $emailMail->send();
            usleep(2000000);
            // $emailMail->send();
    
            $newUser->removeUserTimer();  
            unset($_SESSION['sign-up']);
        }

        // _____________________________________________________________


        session_write_close();        
        header('Location: ' . $_ENV['BASE_PATH'] . '/sign-up');
        exit();
    }

    $pageName = 'sign_up'; include './app/views/_page.php';
    unset($_SESSION['sign-up']);
    unset($_SESSION['message']);
    unset($_SESSION['error']);
    exit;

});





