<?php

use Bramus\Router\Router;

$routerBase = new Router;

// ----- Define routes -------------------------------------------------

$routerBase->match('GET', '/', function() {
    $GLOBALS['endpoint']  = 'home'; 
    include './app/views/dashboard.php';
});

$routerBase->match('GET', '/test', function() {
    $GLOBALS['endpoint']  = 'test'; 
    include './app/views/test.php';    
    exit;

});

$routerBase->match('GET', '/projects', function() {
    $GLOBALS['endpoint']  = 'projects'; 
    include './app/views/projects.php';    
    exit;

});

$routerBase->match('GET', '/clients', function() {
    $GLOBALS['endpoint']  = 'clients'; 
    include './app/views/clients.php';    
    exit;

});

// ----- Run it! -------------------------------------------------------

$routerBase->run();
?>