<?php

////////////////////////////////////////////////////////////////////////

use app\Model\MyCript;

$router->match('GET', '/settings', function() {

    

    $currentUser = unserialize($_SESSION['currentUser']);
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
    
    $currentUser = unserialize($_SESSION['currentUser']);

    $action = MyCript::stringSanitize($_POST['settingsModalBtn']);

    // _________________________________________________________________

    $currentPassword = trim($_POST['currentPassword'] ?? false);
    
    if (!$currentPassword) {
        $_SESSION['settings']['message'] = 'Your current password is missing!';
        $_SESSION['settings']['class']   = 'message__warning';
    }

    $passwordCorrect = MyCript::passVerify($currentUser->getPassHash(), $currentPassword);

    if (!$passwordCorrect) {
        $_SESSION['settings']['message'] = 'Your current password is incorrect!';
        $_SESSION['settings']['class']   = 'message__warning';
    }


    // _________________________________________________________________

    if ($action === 'name' && !isset($_SESSION['settings']['message'])) {
        

        var_export($_POST);
        exit;

    }
    // echo $_SESSION['settings']['message'];
    header('location: ' . $_ENV['BASE_PATH'] . '/settings');
    exit;

});