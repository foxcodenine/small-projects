<?php

use app\Model\MyCript;
use app\Model\MyUtilities;
use app\Model\DBConnect;
use app\Model\Mail;
use app\Model\User;

use function Aws\filter;

// ___ Sign-out ________________________________________________________
////////////////////////////////////////////////////////////////////////


$router->match('GET', 'password-recover-([=|\w]+)|/password-recover', function($email=null) { 
    
    if (isset($email)) $email = base64_decode($email);

    $message = $_SESSION['message']['content'] ?? '&nbsp;';
    $errorEmail = '&nbsp;';
    $messageType = $_SESSION['message']['type'] ?? '&nbsp;';


    $pageName = 'password_recover'; include './app/views/_page.php';
    unset($_SESSION['message']);
    exit();

});

$router->match('POST', '/password-recover', function() {   


    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $email = filter_var($email, FILTER_VALIDATE_EMAIL);       


    if (!$email) {

        $_SESSION['message']['content'] = "Please enter a valid email address.";
        $_SESSION['message']['type'] = 'warning';

    } else {

        $_SESSION['message']['content'] = "A message has been sent to $email with instractions to set your password";
        $_SESSION['message']['type'] = 'primary';

        $emailMail = new Mail();        

        if (MyUtilities::emailInDB($email)) {

            $currentUser = User::getUserById_Email(null, $email);

            $emailMail->recipient($email, " ");
            $emailMail->contentRecoverPassword($currentUser);

        } else {
            $emailMail->recipient($email, " ");
            $emailMail->contentRecoverPasswordInvalidEmail();
        }

        $emailMail->send(); 

    }

    header("location: {$_ENV['BASE_PATH']}/password-recover");

});


////////////////////////////////////////////////////////////////////////






