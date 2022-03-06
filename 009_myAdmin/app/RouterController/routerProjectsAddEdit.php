<?php

////////////////////////////////////////////////////////////////////////

use app\Model\DBConnect;
use app\Model\MyCript;
use app\Model\MyUtilities;
use app\Model\Project;


////////////////////////////////////////////////////////////////////////

$router->match('GET|POST', '/projects-add|/projects-edit(\d+)|/projects-edit', function($id=null) {   

    $id = MyCript::stringSanitize($id);
    
    // ----- Get url endpoint

    
    $arrURL = explode('/', $_SERVER['REQUEST_URI']);
    $endpointURL = end($arrURL);


    switch ($endpointURL) {
        // Check if ADD or EDIT.
        // If ADD break 
        // If EDIT set project in session
        // Or redirect if pojectID is empty or invalid.

        case 'projects-add':
            $currentProject = new stdClass;
            break;

        case 'projects-edit':
            MyUtilities::redirect($_ENV['BASE_PATH']);
            exit();
            break;

        default:
            $endpointURL = 'projects-edit';    
            
        if (!Project::checkForProjectList()) {
                Project::updateProjectList();
            }
        if (array_key_exists($id, Project::getProjectList() ) && !isset($_SESSION['project']['id'])) {
            $currentProject = Project::getProjectList()[$id];

            $_SESSION['project']['projectname']     = $currentProject->getProjectname();
            $_SESSION['project']['localityName']    = $currentProject->getLocalityName();
            $_SESSION['project']['strAddr']         = $currentProject->getStrAddr();
            $_SESSION['project']['clientId']        = $currentProject->getClientId();
            $_SESSION['project']['projectNo']       = $currentProject->getProjectNo();
            $_SESSION['project']['paNo']            = $currentProject->getPaNo();
            $_SESSION['project']['stageName']       = $currentProject->getStageName();
            $_SESSION['project']['categoryName']    = $currentProject->getCategoryName();

            $_SESSION['project']['projectname']     = stripslashes($_SESSION['project']['projectname']);
            $_SESSION['project']['localityName']    = stripslashes($_SESSION['project']['localityName']);
            $_SESSION['project']['strAddr']         = stripslashes($_SESSION['project']['strAddr']);

            if ($currentProject->getProjectDate()) {
                $_SESSION['project']['projectDate']  = $currentProject->formatDateForForm();

            } else {
                $_SESSION['project']['projectDate'] = '';
            }        

    
            $_SESSION['project']['descriptProject'] = $currentProject->descript('read');
        } else {
            MyUtilities::redirect($_ENV['BASE_PATH']);
            exit();
        }

    }

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
    $errorDescription   = $_SESSION['error']['descriptProject'] ?? '&nbsp;';

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



        $_SESSION['project']['descriptProject'] = trim(htmlspecialchars($_POST['descriptProject'])); 	
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

        if ($_SESSION['project']['descriptProject'] && strlen($_SESSION['project']['descriptProject']) > 65500 ) {
            $_SESSION['error']['descriptProject'] = 'Project desciption is too long' . strlen($_SESSION['project']['descriptProject']);
        } else {
            unset($_SESSION['error']['descriptProject']);
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



                $newProject = new Project(
                    projectname :   $_SESSION['project']['projectname'],
                    id :            null,
                    strAddr :       $_SESSION['project']['strAddr'],
                    projectNo :     $_SESSION['project']['projectNo'],
                    paNo :          $_SESSION['project']['paNo'],
                    projectDate :   $_SESSION['project']['projectDate'],
                    localityName :  $_SESSION['project']['localityName'] ?: null,
                    stageName :     $_SESSION['project']['stageName']    ?: null,
                    categoryName :  $_SESSION['project']['categoryName'] ?: null, 
                    clientId :      $_SESSION['project']['clientId']     ?: null,
                    userID :        $userId ,
                );

                // --- If info save to db  in infoClient table;
                if( isset($_SESSION['project']['descriptProject']) && 
                    !empty($_SESSION['project']['descriptProject']) ) { 
                        
                    $newProject->descript('create', $_SESSION['project']['descriptProject']);
                }

            }           


            // --- Edit Project
            if ($endpointURL === 'projects-edit') {

                $currentProject->setProjectname($_SESSION['project']['projectname']); 
                $currentProject->setLocalityName($_SESSION['project']['localityName']); 
                $currentProject->setStrAddr($_SESSION['project']['strAddr']); 
                $currentProject->setClientId($_SESSION['project']['clientId']); 
                $currentProject->setProjectNo($_SESSION['project']['projectNo']); 
                $currentProject->setPaNo($_SESSION['project']['paNo']); 
                $currentProject->setStageName($_SESSION['project']['stageName']); 
                $currentProject->setCategoryName($_SESSION['project']['categoryName']); 
                $currentProject->setProjectDate($_SESSION['project']['projectDate']); 
                
                $currentProject->updateProjectToDB();
                $currentProject->descript('update', $_SESSION['project']['descriptProject']);
            }


            // --- Redirect to Projects page
            unset($_SESSION['project']);
            MyUtilities::redirect($_ENV['BASE_PATH'] . '/projects');            
        }       

        
        MyUtilities::redirect($_ENV['BASE_PATH'] . '/projects-add');
        exit();
    
    }
    
    $pageName = 'pojects_add'; include './app/views/_page.php'; 
    unset($_SESSION['error']);  
    unset($_SESSION['project']);  
    exit;
});




////////////////////////////////////////////////////////////////////////

