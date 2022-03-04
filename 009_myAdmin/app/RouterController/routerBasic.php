<?php
use app\Model\DBTables;
use app\Model\MyUtilities;
use app\Model\Project;

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
    header("Location: " . $_ENV['BASE_PATH']);
    exit();
});
