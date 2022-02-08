<?php
use app\Model\DBTables;


////////////////////////////////////////////////////////////////////////


$router->match('GET', '/', function() {

    $pageName = 'dashboard'; include './app/views/_page.php';    
});

////////////////////////////////////////////////////////////////////////

$router->match('GET', '/test', function() {
    $GLOBALS['endpoint']  = 'test'; 
    include './app/views/test.php';    
    exit;

});

////////////////////////////////////////////////////////////////////////

$router->match('GET', '/tables', function() {
    
    $GLOBALS['endpoint']  = 'tables'; 
    DBTables::createTables();
    header("Location: /009");
    exit();
});
