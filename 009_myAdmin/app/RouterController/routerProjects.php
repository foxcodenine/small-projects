<?php

////////////////////////////////////////////////////////////////////////

$router->match('GET', '/projects', function() {        

    $pageName = 'projects'; include './app/views/_page.php';
    
    exit;
});

////////////////////////////////////////////////////////////////////////

$router->match('GET|POST', '/projects-add', function() {   
    
        // _________________________________________________________________

    // --- setting password & error message

    $errorProjectname   = $_SESSION['error']['projectname'] ?? '&nbsp;';
    $errorLocalityName  = $_SESSION['error']['localityName'] ?? '&nbsp;';
    $errorStrAddr       = $_SESSION['error']['strAddr'] ?? '&nbsp;';
    $errorClientId      = $_SESSION['error']['clientId'] ?? '&nbsp;';
    $errorProjectNo     = $_SESSION['error']['projectNo'] ?? '&nbsp;';
    $errorPaNo          = $_SESSION['error']['paNo'] ?? '&nbsp;';
    $errorStageName     = $_SESSION['error']['stageName'] ?? '&nbsp;';
    $errorCategoryName  = $_SESSION['error']['categoryName'] ?? '&nbsp;';
    $errorProjectDate   = $_SESSION['error']['projectDate'] ?? '&nbsp;';
    $errorDescription   = $_SESSION['error']['description'] ?? '&nbsp;';
    

    
    $pageName = 'pojects_add'; include './app/views/_page.php'; 
    unset($_SESSION['error']);  
    exit;
});




////////////////////////////////////////////////////////////////////////

$router->match('GET', '/images', function() {   

    $pageName = 'images'; include './app/views/_page.php';
    exit;
});