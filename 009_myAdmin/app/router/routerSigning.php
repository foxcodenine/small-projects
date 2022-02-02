<?php

use app\Controller\MyHelperClass;
use app\Model\DBConnect;
use app\Model\Mail;
use app\Model\User;


// ___ Activate ________________________________________________________

$router->match('GET', '/activate/(\w+)/([\w=]+)', function($id, $code) {   

    $hash =  base64_decode($code);
    
    $currentUser = User::getUserById($id);

    $hashValid = $currentUser && $currentUser->getPassHash() === $hash;

    // _________________________________________________________________

    if ($hashValid && $currentUser->getAccountState() === 'Activated') {
        
        
        $_SESSION['message']['content'] = 'Your account has already been activated. <br> You may proceed to login.';
        $_SESSION['message']['type'] = 'warning';

        header('Location: /009/sign-in');
        exit();


    } else if ($hashValid && $currentUser->getAccountState() === 'Nonactivated') {


        $_SESSION['message']['content'] = 'Your account has been activated. <br> You may proceed to login.';
        $_SESSION['message']['type'] = 'success';

        $currentUser = $currentUser->setAccountState('Activated');
        $currentUser->updateUser();

        header('Location: /009/sign-in');
        exit();

    } else {
        
        $_SESSION['message']['content'] = "Your account activation link has expired or is invalid. Please try again.";
        $_SESSION['message']['type'] = 'warning';

        header('Location: /009/sign-up');
        exit();
    } 
});

// ___ Sign-In _________________________________________________________

$router->match('GET|POST', '/sign-in', function() {   

    // --- setting messages
    $message = $_SESSION['message']['content'] ?? '';    
    $messageType = $_SESSION['message']['type'] ?? 'none';
    unset($_SESSION['message']);

    $pageName = 'sign_in'; include './app/views/_page.php';
    unset($_SESSION['message']);
    exit;

});


// ___ Sign-Up _________________________________________________________


$router->match('GET|POST', '/sign-up', function() {


    // --- setting messages
    $message = $_SESSION['message']['content'] ?? '';    
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
        
        
        $_SESSION['sign-up']['firstname'] = $firstname;
        $_SESSION['sign-up']['lastname'] = $lastname;
        $_SESSION['sign-up']['email'] = $email;
        $_SESSION['sign-up']['password'] = $password;

        
        // _____________________________________________________________

        if (!$email) {
            $_SESSION['error']['errorEmail'] = 'This field is required';

        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error']['errorEmail'] = 'Invalid email address';

        } elseif (MyHelperClass::emailInDB($email)) {
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

        // _____________________________________________________________

        if (!isset($_SESSION['error']) || empty($_SESSION['error'])) {     


            $_SESSION['message']['content'] = "An email has been sent to {$email}, to activate your account.";
            $_SESSION['message']['type'] = 'success';
    
            $newUser = new User( email:$email, passHash:$password, 
                firstUserName:$firstname, lastUserName:$lastname );
    
    
            $emailMail = new Mail();
            $emailMail->recipient($email, "$firstname $lastname");
            $emailMail->contentAccountActivation($newUser);
            $emailMail->send();
    
            $newUser->removeNonactivatedUser();  
        }

        // _____________________________________________________________


        session_write_close();        
        header('Location: ' . '/009/sign-up');
        exit();
    }

    $pageName = 'sign_up'; include './app/views/_page.php';
    unset($_SESSION['sign-up']);
    exit;

});




