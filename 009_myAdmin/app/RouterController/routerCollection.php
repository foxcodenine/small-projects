<?php
use app\Model\DBTables;
use app\Model\MyCript;
use app\Model\MyUtilities;
use app\Model\Project;
use app\Model\Collection;
use app\Model\Locality;
use app\Model\Category;
use app\Model\Stage;
use app\Model\Country;



////////////////////////////////////////////////////////////////////////

$router->match('GET|POST', 'locality|category|stage|country', function() {

    $currentUser = MyUtilities::checkCookieAndReturnUser();
    MyUtilities::userInSessionPage();

    // --- collections router

    $pageName=trim(strtr(strrchr(strtok($_SERVER["REQUEST_URI"],'?'), '/'), '/', ' '));

    switch ($pageName) {

        case 'locality':   
            $objList = Locality::getList();
            class_alias('app\Model\Locality', 'ClassAlias', true);
            break;  

        case 'category':   
            $objList = Category::getList();
            class_alias('app\Model\Category', 'ClassAlias', true);
            break;  

        case 'stage':   
            $objList = Stage::getList();
            class_alias('app\Model\Stage', 'ClassAlias', true);
            break;  

        case 'country':   
            $objList = Country::getList();
            class_alias('app\Model\Country', 'ClassAlias', true);
            break;  
    }  
    
    // -----------------------------------------------

    $errorCollectionAdd      = $_SESSION['collectionError']['add'] ?? false;
    $errorCollectionRename   = $_SESSION['collectionError']['rename'] ?? false;
    $errorCollectionDelete   = $_SESSION['collectionError']['delete'] ?? false;
    unset($_SESSION['collectionError']);

    $collectionAdd     = $_SESSION[$pageName]['add']     ?? '';      //ok
    $collectionRename1 = $_SESSION[$pageName]['rename1'] ?? '';
    $collectionRename2 = $_SESSION[$pageName]['rename2'] ?? '';      //ok
    $collectionDelete  = $_SESSION[$pageName]['delete']  ?? '';      //ok
    $collectionReplace = $_SESSION[$pageName]['replace'] ?? '';      //ok 
    




    // -----------------------------------------------

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        // $className = ucwords($pageName);

        $action = $_POST['collection']['action'];
        $action = MyCript::stringSanitize($action);
        


        // -------- Add 

        $name   = $_POST['collection']['name'] ?? false;
        $name   = ucwords(MyCript::stringSanitize($name));


        // var_export($_SESSION[$pageName]); exit();

        

        if ($action === 'add') {

            unset($_SESSION[$pageName]);
            $_SESSION[$pageName]['add'] = $name ?? false;

            if (!$name) {
                $_SESSION['collectionError']['add'] = 'This field is required!';
                
            } else if (ClassAlias::isInDb($name)) {
                $_SESSION['collectionError']['add'] = "$name is already in database!";
            }
            
            else {
                unset($_SESSION['collectionError']);                
                $newEntry = new ClassAlias(null, $name, $currentUser->getId());
                
            }            
        }


        // -------- Rename

        $rename1   = $_POST['collection']['rename1'] ?? false;
        $rename1   = ucwords(strtolower(MyCript::stringSanitize($rename1)));

        


        $rename2   = $_POST['collection']['rename2'] ?? false;
        $rename2   = ucwords(strtolower(MyCript::stringSanitize($rename2)));

        

        $currentOjt = $objList[$rename1] ?? false;
        $collection_in_db = ClassAlias::isInDb($rename2);

        if ($action === 'rename') {

            unset($_SESSION[$pageName]);
            $_SESSION[$pageName]['rename1'] = $rename1  ?? false;
            $_SESSION[$pageName]['rename2'] = $rename2  ?? false;
            
            if(!$rename1 || !array_key_exists($rename1, $objList)) {

                $_SESSION['collectionError']['rename'] = "No {$pageName} selected!";

            } else if (!$rename2) {

                $_SESSION['collectionError']['rename'] = "The rename field has been left empty!";

            } else if ($collection_in_db || $objList[$rename1]->getName() === $rename2) {

                $_SESSION['collectionError']['rename'] = "$rename2 is already in database!";

            } else {

                $currentOjt = $objList[$rename1];
                $currentOjt->rename($rename2);
                unset($_SESSION[$pageName]);
            }
        }


        // -------- Delete
        

        $delete   = $_POST['collection']['delete'] ?? false;
        $delete   = MyCript::stringSanitize($delete);

        

        $replace   = $_POST['collection']['replace'] ?? false;
        $replace   = MyCript::stringSanitize($replace);

        

        if ($action === 'delete') {

            
            unset($_SESSION[$pageName]);
            $_SESSION[$pageName]['delete'] = $delete  ?? false;
            $_SESSION[$pageName]['replace'] = $replace  ?? false;


            if (!$delete || !ClassAlias::isInDb($delete)) {

                $_SESSION['collectionError']['delete'] = "No {$pageName} selected!";

            } elseif ($delete === $replace) {

                $_SESSION['collectionError']['delete'] = 'The replacement field can\'t be the same as the delete field!';

            } else {
                
                if ($replace) {
                    ClassAlias::replaceProjectCollectionInDb($delete, $replace);
                    ClassAlias::deleteFromDb($delete);

                } else {
                    ClassAlias::deleteFromDb($delete);
                    
                }
            }            
        }
        if(!isset($_SESSION['collectionError']) || count( $_SESSION['collectionError']) < 1 ) {
            unset($_SESSION[$pageName]);
        }
        

        header('Location: ' . $_ENV['BASE_PATH'] . '/'. $pageName);
    }

    // -----------------------------------------------
    
    include './app/views/_page.php';
    
    exit();

});

////////////////////////////////////////////////////////////////////////
