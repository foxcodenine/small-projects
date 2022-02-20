<?php

////////////////////////////////////////////////////////////////////////

use app\Model\DBConnect;
use app\Model\MyCript;
use app\Model\MyUtilities;
use app\Model\Project;


////////////////////////////////////////////////////////////////////////

$router->match('GET|POST', '/projects-add', function() {   
    
    // ----- Get url endpoint

    $arrURL = explode('/', $_SERVER['REQUEST_URI']);
    $endpointURL = end($arrURL);


    // --- setting  error messages

    $errorProjectname   = $_SESSION['error']['projectname'] ?? '&nbsp;';
    $errorLocalityName  = $_SESSION['error']['localityName'] ?? '&nbsp;';
    $errorStrAddr       = $_SESSION['error']['strAddr'] ?? '&nbsp;';
    $errorClientId      = $_SESSION['error']['clientId'] ?? '&nbsp;';
    $errorProjectNo     = $_SESSION['error']['projectNo'] ?? '&nbsp;';
    $errorPaNo          = $_SESSION['error']['paNo'] ?? '&nbsp;';
    $errorStageName     = $_SESSION['error']['stageName'] ?? '&nbsp;';
    $errorCategoryName  = $_SESSION['error']['categoryName'] ?? '&nbsp;';
    $errorProjectDate   = $_SESSION['error']['projectDate'] ?? '&nbsp;';
    $errorDescription   = $_SESSION['error']['description'] ?? '&nbsp;';

    // ----- Set select option 
 
  
    $listLocality = MyUtilities::fetchOptionsFromDB('locality');
    $listStage    = MyUtilities::fetchOptionsFromDB('stage');
    $listCategoy  = MyUtilities::fetchOptionsFromDB('category');
    $listClients  = MyUtilities::fetchOptionsFromDB('client');





    // ----- If post

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $_SESSION['project']['projectname'] = MyCript::stringSanitize($_POST['projectname']); 
        $_SESSION['project']['localityName'] = ucwords(strtolower(MyCript::stringSanitize($_POST['localityName']))); 
        $_SESSION['project']['strAddr'] = MyCript::stringSanitize($_POST['strAddr']); 
        $_SESSION['project']['clientId'] = MyCript::stringSanitize($_POST['clientId']); 
        $_SESSION['project']['projectNo'] = MyCript::stringSanitize($_POST['projectNo']); 
        $_SESSION['project']['paNo'] = strtoupper(strtolower(MyCript::stringSanitize($_POST['paNo']))); 
        $_SESSION['project']['stageName'] = ucwords(strtolower(MyCript::stringSanitize($_POST['stageName']))); 
        $_SESSION['project']['categoryName'] = ucwords(strtolower(MyCript::stringSanitize($_POST['categoryName']))); 
        $_SESSION['project']['projectDate'] = MyCript::stringSanitize($_POST['projectDate']); 

        $_SESSION['project']['description'] = trim(htmlspecialchars($_POST['description'])); 	
        unset($_POST);


    
        // --- Validating fields

        if (!$_SESSION['project']['projectname']) {
            $_SESSION['error']['projectname'] = 'This field is required';
        }  else {
            unset($_SESSION['error']['projectname']);
        }

        if (!$_SESSION['project']['localityName']) {
            $_SESSION['error']['localityName'] = 'This field is required';
        }  else {
            unset($_SESSION['error']['localityName']);
        }

        if (!$_SESSION['project']['strAddr']) {
            $_SESSION['error']['strAddr'] = 'This field is required';
        }  else {
            unset($_SESSION['error']['strAddr']);
        }
        // ----- if NO error

        if (!isset($_SESSION['error']) || empty($_SESSION['error'])) {

            // --- Check if locality and country are in db
     

            $location_in_db = empty($_SESSION['project']['localityName']) ?: 
                        MyUtilities::optionInDB('locality', $_SESSION['project']['localityName']);

            $stage_in_db = empty($_SESSION['project']['stageName']) ?: 
                        MyUtilities::optionInDB('stage', $_SESSION['project']['stageName']);

            $category_in_db = empty($_SESSION['project']['categoryName']) ?: 
                        MyUtilities::optionInDB('category', $_SESSION['project']['categoryName']);



            if (!$location_in_db) {
                MyUtilities::insertOptionToDB('locality', $_SESSION['project']['localityName']);
            }

            if (!$stage_in_db) {
                MyUtilities::insertOptionToDB('stage', $_SESSION['project']['stageName']);
            }

            if (!$category_in_db) {
                MyUtilities::insertOptionToDB('category', $_SESSION['project']['categoryName']);
            }
       
            // --- Createing New Project


            if ($endpointURL === 'projects-add') {

                $userId = (int) unserialize($_SESSION['currentUser'])->getId();

                $date =  $_SESSION['project']['projectDate'];
                $date =  preg_match('@(\d+)/(\d+)/(\d+)@', $date, $arr);
                $date =  $date ? "{$arr[3]}-{$arr[2]}-{$arr[1]}" : date(DBConnect::D_FORMAT, time());




                $newProject = new Project(
                    projectname :   $_SESSION['project']['projectname'],
                    id :            null,
                    strAddr :       $_SESSION['project']['strAddr'],
                    projectNo :     $_SESSION['project']['projectNo'],
                    paNo :          $_SESSION['project']['paNo'],
                    projectDate :   $date,
                    localityName :  $_SESSION['project']['localityName'] ?: null,
                    stageName :     $_SESSION['project']['stageName']    ?: null,
                    categoryName :  $_SESSION['project']['categoryName'] ?: null, 
                    clientId :      $_SESSION['project']['clientId']     ?: null,
                    userID :        $userId ,
                );

                unset($_SESSION['project']);
            }           


            // --- Edit Project
            if ($endpointURL === 'projects-edit') {}


            // --- Redirect to Projects page

            MyUtilities::redirect($_ENV['BASE_PATH'] . '/projects');            
        }
        

        unset($_SESSION['project']);
        MyUtilities::redirect($_ENV['BASE_PATH'] . '/projects-add');
        exit();
    
    }
    
    $pageName = 'pojects_add'; include './app/views/_page.php'; 
    unset($_SESSION['error']);  
    unset($_SESSION['project']);  
    exit;
});




////////////////////////////////////////////////////////////////////////

