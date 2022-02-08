<?php

use app\Controller\MyCript;
use app\Controller\MyUtilities;
use app\Model\DBConnect;
use app\Model\Mail;
use app\Model\User;

// ___ Sign-out ________________________________________________________
////////////////////////////////////////////////////////////////////////


$router->match('GET', '/sign-out', function() {   

    $currentUser = unserialize($_SESSION['currentUser']);
    MyUtilities::unsetCookie($currentUser);
    MyUtilities::redirect('/009/sign-in');

});

// ___ Activate ________________________________________________________
////////////////////////////////////////////////////////////////////////


$router->match('GET', '/activate/(\w+)/([\w=]+)', function($id, $code) {   

    $hash =  base64_decode($code);
    
    $currentUser = User::getUserById_Email ($id);

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

// ___ Resend email ____________________________________________________
////////////////////////////////////////////////////////////////////////

$router->match('GET', '/resend-email', function() {   


    $email = $_SESSION['resend-email'] ?? null;

    if (!$email) { header('Location: ' . '/009/sign-in');  exit(); }

    unset($_SESSION['resend-email']);

    // _________________________________________________

    $currentUser = User::getUserById_Email(null, $email);

    $firstname = $currentUser->getFirstUserName();
    $lastname  = $currentUser->getLastUserName();

    $emailMail = new Mail();
    $emailMail->recipient($email, "$firstname $lastname");
    $emailMail->contentAccountActivation($currentUser);
    $emailMail->send();

    // _________________________________________________

    $_SESSION['message']['content'] = "A new activation email has been resent to {$email}. To activate your account.";
    $_SESSION['message']['type'] = 'primary';

    // _________________________________________________

    session_write_close();        
    header('Location: ' . '/009/sign-in');
    exit();   
});



