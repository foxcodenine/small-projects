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

$routerBase->match('GET', '/clients-add', function() {
    $GLOBALS['endpoint']  = 'clients-add'; 
    include './app/views/clients_add.php';    
    exit;

});

$routerBase->match('GET', '/projects-add', function() {
    $GLOBALS['endpoint']  = 'projects-add'; 
    include './app/views/projects_add.php';    
    exit;

});

// ----- Run it! -------------------------------------------------------

$routerBase->run();
?>