<?php

use app\Model\MyCript;
use app\Model\MyUtilities;
use app\Model\DBConnect;
use app\Model\Mail;
use app\Model\User;

use function Aws\filter;

// ___ Sign-out ________________________________________________________
////////////////////////////////////////////////////////////////////////


$router->match('GET', '/password-recover', function() {   

    $message = $_SESSION['message']['content'] ?? '&nbsp;';
    $errorEmail = '&nbsp;';
    $messageType = $_SESSION['message']['type'] ?? '&nbsp;';


    $pageName = 'password_recover'; include './app/views/_page.php';
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


$router->match('GET', '/password-reset/(\d+)/(\w+)/(\d+)', function($id, $code, $timestamp) {   

    // -----------------------------------------------------------------
    // --- fetch varables

    $currentUser = User::getUserById_Email ((int) $id);
    $code        = strip_tags($code);
    $code        = strlen($code) === 28 ?  $code : false;
    $timestamp   = (int) $timestamp;

    if (!$currentUser || !$timestamp || !$code) {
        header("location: {$_ENV['BASE_PATH']}/sign-out" );
        exit();
    }

    // -----------------------------------------------------------------
    // --- checking $code and $timestamp

    $codeValid = $currentUser->getCode() === $code;

    $currentDate  = new \DateTimeImmutable();
    $datePlus1hr = $currentDate->add(new \DateInterval('PT1H'));

    $currentTimestamp = $currentDate->getTimestamp();
    $timestampPlus1hr = $datePlus1hr->getTimestamp();

    $timestampValid   = $timestamp > $currentTimestamp && $timestamp < $timestampPlus1hr;

    if (!$codeValid || !$codeValid) {
        header("location: {$_ENV['BASE_PATH']}/sign-out" );
        exit();
    }

    // -----------------------------------------------------------------

    echo $currentUser->getEmail();   

    exit();

});


