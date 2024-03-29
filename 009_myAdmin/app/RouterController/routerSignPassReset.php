<?php

use app\Model\MyCript;
use app\Model\Mail;
use app\Model\User;

use function Aws\filter;




$router->match('GET|POST', '/password-reset-(\d+)-(\w+)-(\d+)', function($id, $code, $timestamp) {   

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

    $email = $currentUser->getEmail();
    $message = $_SESSION['message']['content'] ?? "Password reset for {$email}";    
    $messageType = $_SESSION['message']['type'] ?? 'primary';
    $errorPassword1 = $_SESSION['error']['password1'] ?? '&nbsp;';
    $errorPassword2 = $_SESSION['error']['password2'] ?? '&nbsp;';

    

    // -----------------------------------------------------------------

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $password1 = trim(strip_tags($_POST['password1']));
        $password2 = trim(strip_tags($_POST['password2']));

        var_dump($password1); echo '<br>';
        var_dump($password2); echo '<br>';

        // _____________________________________________

        unset($_SESSION['error']);
        unset($_SESSION['message']);

        // _____________________________________________

        if (!$password1) {
            $_SESSION['error']['password1'] = 'Required!';
            $_SESSION['message']['content'] = 'Both password fields are required.';
        }
        if (!$password2) {
            $_SESSION['error']['password2'] = 'Required!';
            $_SESSION['message']['content'] = 'Both password fields are required.';
        }
        if (!isset($_SESSION['error'])  && $password1 !== $password2) {
            $_SESSION['error']['password1'] = 'Invalid!';
            $_SESSION['error']['password2'] = 'Invalid!';

            $_SESSION['message']['content'] = 'The password confirmation does not match password.';  

        } elseif (strlen($password1) < 6) {
            $_SESSION['error']['password1'] = 'Invalid!';
            $_SESSION['error']['password2'] = 'Invalid!';
            $_SESSION['message']['content'] = 'The password is too short.'; 

        } elseif (strlen($password1) > 25) {
            $_SESSION['error']['password1'] = 'Invalid!';
            $_SESSION['error']['password2'] = 'Invalid!';
            $_SESSION['message']['content'] = 'The password is too longe.'; 
        }

        if (isset($_SESSION['error'])) {
            $_SESSION['message']['type'] = 'warning';            
        } 
        // _____________________________________________

        if (!isset($_SESSION['error'])) {
            $_SESSION['message']['type'] = 'primary';
            $_SESSION['message']['content'] = 'Your password has been changed successfully.'; 

            // code
            $currentUser->setPassHash(MyCript::passHash($password1));
            $currentUser->setCode(0);
            $currentUser->updateUser();


            $emailMail = new Mail();  
            $emailMail->recipient($email, " ");
            $emailMail->contentPasswordHaveChanged($currentUser);  
            $emailMail->send();    

            header("location: {$_ENV['BASE_PATH']}/sign-in");
            exit();
        } 
        // _____________________________________________

        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' 
                     || $_SERVER['SERVER_PORT'] == 443) ? 'https://' : 'http://';
        
        $url = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

        header("location: $url");
        
        exit();
    }


    // -----------------------------------------------------------------

    // echo $currentUser->getEmail();  
    $pageName = 'password_reset'; include './app/views/_page.php';
    unset($_SESSION['error']);
    unset($_SESSION['message']);
    exit(); 

});





