<?php
require './app/init.php';

use Bramus\Router\Router;
$router = new Router;

// ----- Define routes -------------------------------------------------

$router->match('GET', '/', function() {
    $GLOBALS['endpoint']  = 'home'; 
    include './app/view/home.php';
    
    exit;

});

// ----- Run it! -------------------------------------------------------
$router->run();

?>


