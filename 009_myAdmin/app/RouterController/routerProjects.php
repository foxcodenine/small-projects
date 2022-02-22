<?php

////////////////////////////////////////////////////////////////////////

use app\Model\DBConnect;
use app\Model\MyCript;
use app\Model\MyUtilities;
use app\Model\Project;

$router->match('GET', '/projects', function() {   
    


    $projectList = Project::getProjectList();

    $pageName = 'projects'; include './app/views/_page.php';
    
    exit;
});

////////////////////////////////////////////////////////////////////////

$router->match('GET|POST', '/projects-delete', function() {

    Project::deleteProjectsFromDB(...$_POST['projectsDeleteList']);
    MyUtilities::redirect($_ENV['BASE_PATH'] . '/projects');

});

////////////////////////////////////////////////////////////////////////

$router->match('GET', '/images', function() {   

    $pageName = 'images'; include './app/views/_page.php';
    exit;
});