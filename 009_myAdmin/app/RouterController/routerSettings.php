<?php

////////////////////////////////////////////////////////////////////////

use app\Model\Mail;
use app\Model\MyCript;
use app\Model\MyUtilities;
use app\Model\User;

$router->match('GET', '/settings', function() {

    

    $currentUser = MyUtilities::checkCookieAndReturnUser(); 
    MyUtilities::userInSessionPage();

    $firstname   = $currentUser->getFirstUserName();
    $lastname    = $currentUser->getLastUserName();
    $email       = $currentUser->getEmail();

    $message      = $_SESSION['settings']['message'] ?? '&nbsp;';
    $classMessage = $_SESSION['settings']['class'] ?? '&nbsp;';

    // $message = 'Your changes has been  successfully updated!';
    // $classMessage = 'success';
    
    $pageName = 'settings'; include './app/views/_page.php';
    unset($_SESSION['settings']);    
    exit;

});

////////////////////////////////////////////////////////////////////////


$router->match('POST', '/settings', function() {
    
    
    $currentUser = MyUtilities::checkCookieAndReturnUser(); 
    MyUtilities::userInSessionPage();

    $action = MyCript::stringSanitize($_POST['settingsModalBtn']);

    // _________________________________________________________________

    $currentPassword = trim($_POST['currentPassword'] ?? false);
    $passwordCorrect = MyCript::passVerify($currentUser->getPassHash(), $currentPassword);
    
    if (!$currentPassword) {

        $_SESSION['settings']['message'] = 'Current password is required!';
        $_SESSION['settings']['class']   = 'message__warning';

    } else  if (!$passwordCorrect) {

        $_SESSION['settings']['message'] = 'Your current password is incorrect!';
        $_SESSION['settings']['class']   = 'message__warning';
    }

    // _________________________________________________________________

    if ($action === 'name' && !isset($_SESSION['settings']['message'])) {

        $firstname = MyCript::stringSanitize($_POST['firstname'] ?? false);
        $lastname  = MyCript::stringSanitize($_POST['lastname'] ?? false);

        $currentFirstname = $currentUser->getFirstUserName();
        $currentLastname  = $currentUser->getLastUserName();

        $noChange = $currentFirstname === $firstname && $currentLastname === $lastname;

        if ($noChange) {

        } else if ($firstname && $lastname) { 
            
            $currentUser->setFirstUserName($firstname);
            $currentUser->setLastUserName($lastname);
            $currentUser->updateUser();

            MyUtilities::setUserInSession($currentUser);

            $_SESSION['settings']['message'] = 'Your changes has been  successfully updated!';
            $_SESSION['settings']['class']   = 'message__success';            

        } else {
            $_SESSION['settings']['message'] = 'Both firstname and lastname are required!';
            $_SESSION['settings']['class']   = 'message__warning';
        }         
    }

    // _________________________________________________________________

    if ($action === 'email' && !isset($_SESSION['settings']['message'])) { 
        $email1  = filter_input(INPUT_POST, 'email1',      FILTER_SANITIZE_EMAIL); 
        $email2  = filter_input(INPUT_POST, 'email2',      FILTER_SANITIZE_EMAIL);
        
        $email1  = filter_input(INPUT_POST, 'email1',      FILTER_SANITIZE_EMAIL); 
        $email2  = filter_input(INPUT_POST, 'email2',      FILTER_SANITIZE_EMAIL);
        $currentEmail = $currentUser->getEmail();

        if (!$email1 || !$email2) {

            $_SESSION['settings']['message'] = 'Both email fields are required!';
            $_SESSION['settings']['class']   = 'message__warning';

        
        } else if ($email1 !== $email2) {

            $_SESSION['settings']['message'] = 'Email confirmation does not match email address';
            $_SESSION['settings']['class']   = 'message__warning';

        } else if (!filter_var($email1, FILTER_VALIDATE_EMAIL)) {

            $_SESSION['settings']['message'] = 'Email address is not valid!';
            $_SESSION['settings']['class']   = 'message__warning';

        } else if ($currentEmail === $email1) {

        } else if (MyUtilities::emailInDB($email1)) {

            $_SESSION['settings']['message'] = 'This Email address is already being used';
            $_SESSION['settings']['class']   = 'message__warning';

        } else if (

            filter_var($email1, FILTER_VALIDATE_EMAIL) &&
            $email1 === $email2

        ) {
            $firstname = $currentUser->getFirstUserName();
            $lastname  = $currentUser->getLastUserName();
         
            $emailMail = new Mail();
            $emailMail->recipient($email1, "$firstname $lastname");
            $emailMail->contentChangeEmail($currentUser, $email1);
            $emailMail->send();            

            $_SESSION['settings']['message'] = 'A verification link has been sent to your new email address!';
            $_SESSION['settings']['class']   = 'message__success'; 
        }        
    }

    // _________________________________________________________________

    if ($action === 'password' && !isset($_SESSION['settings']['message'])) {

        $password1  = strip_tags($_POST['password1']);
        $password2  = strip_tags($_POST['password2']);

        if (!$password1 || !$password2) {
            $_SESSION['settings']['message'] = 'Both password fields are required!';
            $_SESSION['settings']['class']   = 'message__warning';
            
        } else if ($password1 !== $password2) {

            $_SESSION['settings']['message'] = 'Password confirmation doesn\'t match password';
            $_SESSION['settings']['class']   = 'message__warning';

        } elseif (strlen($password1) < 6) {
            $_SESSION['error']['errorPassword'] = 'Password is too short';

        } elseif (strlen($password1) > 25) {
            $_SESSION['error']['errorPassword'] = 'Password is too long';

        } else {

            $currentUser->setPassHash(MyCript::passHash($password1));
            $currentUser->updateUser();                       
                              
            $currentUser = MyUtilities::setCookie($currentUser, true);

            $_SESSION['settings']['message'] = 'Your password has been successfully updated! An email';
            $_SESSION['settings']['class']   = 'message__success'; 


            $firstname = $currentUser->getFirstUserName();
            $lastname  = $currentUser->getLastUserName();
            $email     = $currentUser->getEmail();


            $emailMail = new Mail();
            $emailMail->recipient($email, "$firstname $lastname");
            $emailMail->contentPasswordHaveChanged($currentUser);
            $emailMail->send();            


        }
    }

    header('location: ' . $_ENV['BASE_PATH'] . '/settings');
    exit;

});


$router->match('GET', '/changeEmail/(\w+)/([\w=]+)/(\d+)/([\w=]+)', function($id, $token, $timestamp, $email) {

   

    $currentUser = User::getUserById_Email ((int) $id);
    $token        =  base64_decode($token);   
    $timestamp   = (int) $timestamp;
    $email       = base64_decode($email);
    $email       = filter_var($email, FILTER_SANITIZE_EMAIL);   
    $email       = filter_var($email, FILTER_VALIDATE_EMAIL); 
    
    $emailInDb   = MyUtilities::emailInDB($email);
    
    $validateToken = $currentUser && $currentUser->getToken() === $token;

    $currentTimestamp  = (new \DateTimeImmutable())->getTimestamp();
    $validateTimestamp = $currentTimestamp < $timestamp;

    if (!$currentUser || !$token || !$timestamp || !$email || !$validateToken || !$validateTimestamp || $emailInDb) {

        header("location: {$_ENV['BASE_PATH']}/sign-out" );
        exit();
    }
    

    // echo $currentUser->getId() . '<br>';
    // echo $token . '<br>';
    // echo $timestamp . '<br>';
    // echo $email . '<br>';
    // var_export($validateToken); echo '<br>';
    // var_export($validateTimestamp); echo '<br>';


    $currentUser->setEmail($email);
    $currentUser->updateUser();



    if ($_SESSION['currentUser']) {

        $_SESSION['settings']['message'] = 'Your email address has been successfully updated!';
        $_SESSION['settings']['class']   = 'message__primary';

        header("location: {$_ENV['BASE_PATH']}/settings" );

    } else {

        $_SESSION['message']['content'] = 'Your email address has been <br> successfully updated!';
        $_SESSION['message']['type'] = 'primary';

        header("location: {$_ENV['BASE_PATH']}/sign-in" );

    }
    exit();   

});


