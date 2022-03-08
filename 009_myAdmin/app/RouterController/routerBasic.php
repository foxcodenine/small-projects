<?php
use app\Model\DBTables;
use app\Model\MyCript;
use app\Model\MyUtilities;
use app\Model\Project;
use app\Model\Collection;

////////////////////////////////////////////////////////////////////////



$router->match('GET', '/test', function() {
    $GLOBALS['endpoint']  = 'test'; 
    include './app/views/test.php';    
    exit;

});

////////////////////////////////////////////////////////////////////////



$router->match('GET', 'locality|category|stage', function() {
    // --- collections router

    $pageName=trim(strtr(strrchr(strtok($_SERVER["REQUEST_URI"],'?'), '/'), '/', ' '));

    class Stage extends Collection {
        protected static $tableName = 'Stage';
        protected static $fieldName = 'sName';
    }
    class Locality extends Collection {
        protected static $tableName = 'Locality';
        protected static $fieldName = 'lName';
    }
    class Category extends Collection {
        protected static $tableName = 'Category';
        protected static $fieldName = 'yName';
    }

    switch ($pageName) {

        case 'locality':   
            $objList = Locality::getList();
            break;  

        case 'category':   
            $objList = Category::getList();
            break;  

        case 'stage':   
            $objList = Stage::getList();
            break;  
    }

      

    
    include './app/views/_page.php';
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
