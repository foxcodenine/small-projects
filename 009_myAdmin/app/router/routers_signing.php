<?php

use app\Controller\MyHelperClass;
use app\Model\DBConnect;
use app\Model\Mail;
use app\Model\User;


// _____________________________________________________________________

$router->match('GET', '/account-verify', function() {   

    echo $_GET['code'] . '<br>';
    echo base64_decode($_GET['code']) . '<br>';
    echo $_GET['id'];
    exit;
});

// _____________________________________________________________________


$router->match('GET|POST', '/sign-up', function() {


    // --- setting messages
    $message = $_SESSION['message']['content'] ?? '&nbsp;';    
    $messageType = $_SESSION['message']['type'] ?? 'none';
    unset($_SESSION['message']);

    

    // --- setting password & error message
    $errorEmail    = $_SESSION['error']['errorEmail'] ?? '&nbsp;';
    $errorPassword = $_SESSION['error']['errorPassword'] ?? '&nbsp;';

    
    unset($_SESSION['error']);
    
    // --- if post
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        // _____________________________________________________________

        unset($_SESSION['message']); unset($_SESSION['error']);

        // _____________________________________________________________

        $firstname = filter_input(INPUT_POST, 'firstname',  FILTER_SANITIZE_STRING);
        $lastname  = filter_input(INPUT_POST, 'lastname',   FILTER_SANITIZE_STRING);
        $email     = filter_input(INPUT_POST, 'email',      FILTER_SANITIZE_EMAIL);
        $password  = filter_input(INPUT_POST, 'password',   FILTER_SANITIZE_STRING);       

        
        // _____________________________________________________________

        if (!$email) {
            $_SESSION['error']['errorEmail'] = 'This field is required';

        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error']['errorEmail'] = 'Invalid email address';

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

        // _____________________________________________________________

        if (!isset($_SESSION['error']) || empty($_SESSION['error'])) {     

            $_SESSION['message']['content'] = "An email has been sent to {$email}, to activate your account.";
            $_SESSION['message']['type'] = 'success';

            $newUser = new User( email:$email, passHash:$password, 
                firstUserName:$firstname, lastUserName:$lastname );

    
            $emailMail = new Mail();
            $emailMail->recipient($email, "$firstname $lastname");
            $emailMail->accountVerify($newUser);
            $emailMail->send();
        }

        // _____________________________________________________________

        session_write_close();        
        header('Location: ' . '/009/sign-up');
        exit();
    }

    include './app/views/sign/sign_up.php';  
    exit;
});
