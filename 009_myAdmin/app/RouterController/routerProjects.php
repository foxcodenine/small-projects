<?php

////////////////////////////////////////////////////////////////////////

use app\Model\DBConnect;
use app\Model\MyCript;
use app\Model\MyUtilities;
use app\Model\Project;

$router->match('GET', '/projects', function() {   
    
    // header('Content-Type: application/json');

    // print_r(Project::getProjectList());

    // exit();

    $projectList = Project::getProjectList();

    $pageName = 'projects'; include './app/views/_page.php';
    
    exit;
});



////////////////////////////////////////////////////////////////////////

$router->match('GET', '/images', function() {   

    $pageName = 'images'; include './app/views/_page.php';
    exit;
});