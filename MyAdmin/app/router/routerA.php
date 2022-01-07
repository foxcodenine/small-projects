<?php

use Bramus\Router\Router;

$routerA = new Router;

// ----- Define routes -------------------------------------------------

$routerA->match('GET', '/', function() {
    $GLOBALS['endpoint']  = 'home'; 
    include './app/views/home.php';
    
    exit;

});

// ----- Run it! -------------------------------------------------------

$routerA->run();
?>