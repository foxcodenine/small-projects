<?php

////////////////////////////////////////////////////////////////////////

use app\Model\AwsClass;
use app\Model\DBConnect;
use app\Model\MyCript;
use app\Model\MyUtilities;
use app\Model\Project;

$router->match('GET', '/projects', function() {  
    
    Project::updateProjectList();

    $projectList = Project::getProjectList();
    
    $projectList = MyUtilities::sortTable($projectList);

    $pageName = 'projects'; include './app/views/_page.php';

    unset($_SESSION['error']);
    unset($_SESSION['poject']);
    
    exit;
});

////////////////////////////////////////////////////////////////////////

$router->match('GET|POST', '/projects-delete', function() {

    Project::deleteProjectsFromDB(...$_POST['projectsDeleteList']);    
    AwsClass::deleteProjectsImagesFromAWS(...$_POST['projectsDeleteList']);  
    unset($_POST['projectsDeleteList']);  
    MyUtilities::redirect($_ENV['BASE_PATH'] . '/projects');
    
});

////////////////////////////////////////////////////////////////////////

$router->match('GET', '/projects-detail-1', function() {  
    

    $pageName = 'detail'; include './app/views/_page.php';
   
    exit;
});

////////////////////////////////////////////////////////////////////////