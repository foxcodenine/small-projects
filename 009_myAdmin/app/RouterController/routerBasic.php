<?php
use app\Model\DBTables;
use app\Model\MyCript;
use app\Model\MyUtilities;
use app\Model\Project;

////////////////////////////////////////////////////////////////////////



$router->match('GET', '/test', function() {
    $GLOBALS['endpoint']  = 'test'; 
    include './app/views/test.php';    
    exit;

});

////////////////////////////////////////////////////////////////////////

$router->match('GET', '/table/(\w+)', function($action) {

    $action = MyCript::stringSanitize($action);
    
    switch ($action) {
        case 'create':
            DBTables::createTables();
            break;

        case 'drop':
            DBTables::dropTables();
            break;

        case 'populate':
            DBTables::populateTables('chris12aug@yahoo.com');
            break;
    }

    echo $action;
    
    // header("Location: " . $_ENV['BASE_PATH']);
    exit();
});
