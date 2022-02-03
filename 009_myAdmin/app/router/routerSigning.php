<?php

use app\Controller\MyCript;
use app\Controller\MyHelperClass;
use app\Model\DBConnect;
use app\Model\Mail;
use app\Model\User;


// ___ Activate ________________________________________________________
// _____________________________________________________________________


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
// _____________________________________________________________________

$router->match('GET', '/resendEmail', function() {   

    var_dump($_SESSION); echo '<br>';
    var_dump($_SESSION['resendEmail']);

    $email = $_SESSION['resendEmail'];
    unset($_SESSION['resendEmail']);

    $currentUser = User::getUserById_Email(null, $email);

    $firstname = $currentUser->getFirstUserName();
    $lastname  = $currentUser->getLastUserName();

    $emailMail = new Mail();
    $emailMail->recipient($email, "$firstname $lastname");
    $emailMail->contentAccountActivation($currentUser);
    $emailMail->send();

    
});

// ___ Sign-In _________________________________________________________
// _____________________________________________________________________

$router->match('GET|POST', '/sign-in', function() {   

    // --- setting messages
    
    $message = $_SESSION['message']['content'] ?? '&nbsp;';    
    $messageType = $_SESSION['message']['type'] ?? 'none';


    // --- setting password & error message
    $errorEmail    = $_SESSION['error']['errorEmail'] ?? '&nbsp;';
    $errorPassword = $_SESSION['error']['errorPassword'] ?? '&nbsp;'; 


    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $email     = filter_input(INPUT_POST, 'email',      FILTER_SANITIZE_EMAIL);
        $password  = filter_input(INPUT_POST, 'password',   FILTER_SANITIZE_STRING);  
        $remember  = filter_input(INPUT_POST, 'remember',   FILTER_SANITIZE_STRING);
        unset($_POST); 

        $_SESSION['sign-in']['email'] = $email;
        $_SESSION['sign-in']['remember'] = $remember ?? null ;

        // _____________________________________________________________

        if (!$email) {
            $_SESSION['error']['errorEmail'] = 'This field is required';
        } 
        
        if (!$password) {
            $_SESSION['error']['errorPassword'] = 'This field is required';
        }
        


        if ($email && $password) {

            if ($email_in_db = MyHelperClass::emailInDB($email)) {

                $currentUser = User::getUserById_Email (null, $email);
                $pass_is_correct = MyCript::passVerify($currentUser->getPassHash(), $password);
                $user_activated  = $currentUser->getAccountState() === 'Activated';
            }

            if (!$email_in_db || !$pass_is_correct) {
                $_SESSION['message']['content'] = "Your email and password do not match. <br> Please try again.";
                $_SESSION['message']['type'] = 'danger';

            }  else if (!$user_activated) {
                $_SESSION['message']['content'] = "You Haven't Activated Your Account Yet. <br> 
                Kindly check your mail. <a class='sign__resend-link myLoaderBtn' href='/009/resendEmail'>Resend email</a>";
                $_SESSION['message']['type'] = 'primary';
                $_SESSION['resendEmail'] = $email;
                

            } else {
                $_SESSION['message']['content'] = "Loged In";
                $_SESSION['message']['type'] = 'success';
            }
        }

        // _____________________________________________________________

        session_write_close();        
        header('Location: ' . '/009/sign-in');
        exit();
    }

    $pageName = 'sign_in'; include './app/views/_page.php';

    unset($_SESSION['sign-in']);
    unset($_SESSION['message']);
    unset($_SESSION['error']);

    exit();

    // $message = Please log in to access this page.;

});


// ___ Sign-Up _________________________________________________________
// _____________________________________________________________________


$router->match('GET|POST', '/sign-up', function() {


    // --- setting messages
    $message = $_SESSION['message']['content'] ?? '&nbsp;';    
    $messageType = $_SESSION['message']['type'] ?? 'none';
    

    

    // --- setting password & error message
    $errorEmail    = $_SESSION['error']['errorEmail'] ?? '&nbsp;';
    $errorPassword = $_SESSION['error']['errorPassword'] ?? '&nbsp;'; 
    

    
    // --- if post
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {


        // _____________________________________________________________

        $firstname = filter_input(INPUT_POST, 'firstname',  FILTER_SANITIZE_STRING);
        $lastname  = filter_input(INPUT_POST, 'lastname',   FILTER_SANITIZE_STRING);
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
    unset($_SESSION['message']);
    unset($_SESSION['error']);
    exit;

});




