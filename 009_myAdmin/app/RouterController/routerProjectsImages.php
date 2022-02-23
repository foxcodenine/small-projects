<?php

////////////////////////////////////////////////////////////////////////

use app\Model\DBConnect;
use app\Model\MyCript;
use app\Model\MyUtilities;
use app\Model\Project;


////////////////////////////////////////////////////////////////////////

$router->match('GET', '/projects-images-(\d+)', function($id=null) { 


    // ----- Check for id
    if(!isset($id)){ 
        MyUtilities::redirect($_ENV['BASE_PATH']); exit();
    }

    // ----- Check if project exits

    if (array_key_exists($id, Project::getProjectList() ) && !isset($_SESSION['project']['id'])) {
        $currentProject = Project::getProjectList()[$id];

        // --- Fetch project images

        $projectImages = $currentProject->fetchImages();


        $_SESSION['projectImages']['imgsInDb'] = sizeof($projectImages);


    } else {
        MyUtilities::redirect($_ENV['BASE_PATH']);
        exit();
    }


    $pageName = 'images'; include './app/views/_page.php';
    exit;
});

////////////////////////////////////////////////////////////////////////

$router->match('GET|POST', '/projects-upload-(\d+)', function($id=null) { 

    header('Content-Type: application/json');



    $maxNo_of_img = 24 - $_SESSION['projectImages']['imgsInDb'];
    unset($_SESSION['projectImages']['imgsInDb']);

    echo($maxNo_of_img);

    // ----- Check for id
    if(!isset($id)){ 
        MyUtilities::redirect($_ENV['BASE_PATH']); exit();
    }

    print_r($_FILES);

});