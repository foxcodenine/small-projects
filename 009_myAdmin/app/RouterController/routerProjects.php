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

$router->match('GET', '/projects-detail-(\d+)', function($id) {  
    
    
    $projectId = (int) MyCript::stringSanitize($id);
    // header('Content-Type: application/json');


    $projectList = Project::getProjectList();    


    $pro = $projectList[$projectId] ?? false;


    // // print_r($projectId);
    // // print_r($projectList);
    // print_r($pro); 
    // exit();

    if (!$pro) {
        header('location: ' . $_ENV['BASE_PATH']);
    }

    $pageName = 'detail'; include './app/views/_page.php';
   
    exit;
});

////////////////////////////////////////////////////////////////////////


$router->set404(function() {
    header('HTTP/1.1 404 Not Found');
    echo '... do something special here';
});