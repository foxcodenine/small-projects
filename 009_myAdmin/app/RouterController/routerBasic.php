<?php
use app\Model\DBTables;
use app\Model\MyCript;
use app\Model\MyUtilities;
use app\Model\Project;
use app\Model\Collection;
use app\Model\Locality;

////////////////////////////////////////////////////////////////////////



$router->match('GET', '/test', function() {
    $GLOBALS['endpoint']  = 'test'; 
    include './app/views/test.php';    
    exit;

});

////////////////////////////////////////////////////////////////////////




$router->match('GET|POST', 'locality|category|stage', function() {

    $currentUser = MyUtilities::checkCookieAndReturnUser();
    MyUtilities::userInSessionPage();

    // --- collections router

    $pageName=trim(strtr(strrchr(strtok($_SERVER["REQUEST_URI"],'?'), '/'), '/', ' '));

    class Stage extends Collection {
        protected static $tableName = 'Stage';
        protected static $fieldName = 'sName';
    }
    // class Locality extends Collection {
    //     protected static $tableName = 'Locality';
    //     protected static $fieldName = 'lName';
    // }
    class Category extends Collection {
        protected static $tableName = 'Category';
        protected static $fieldName = 'yName';
    }


    switch ($pageName) {

        case 'locality':   
            $objList = Locality::getList();
            class_alias('Locality', 'ClassAlias', true);
            break;  

        case 'category':   
            $objList = Category::getList();
            class_alias('Category', 'ClassAlias', true);
            break;  

        case 'stage':   
            $objList = Stage::getList();
            class_alias('Stage', 'ClassAlias', true);
            break;  
    }  
    
    // -----------------------------------------------

    $errorCollectionAdd      = $_SESSION['collection']['add'] ?? false;
    $errorCollectionRename   = $_SESSION['collection']['rename'] ?? false;
    $errorCollectionDelete   = $_SESSION['collection']['delete'] ?? false;


    // -----------------------------------------------

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $className = ucwords($pageName);

        $action = $_POST['collection']['action'];
        $action = MyCript::stringSanitize($action);

        $name   = $_POST['collection']['name'] ?? false;
        $name   = MyCript::stringSanitize($name);

        if ($action === 'add' && $name && !ClassAlias::isInDb($name)) {
            // MyUtilities::optionInDB()

            $newEntry = new ClassAlias(null, $name, $currentUser->getId());
        }

        header('Location: ' . $_ENV['BASE_PATH'] . '/'. $pageName);
    }

    // -----------------------------------------------
    
    include './app/views/_page.php';
    unset($_SESSION['collection']);
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
