<?php

////////////////////////////////////////////////////////////////////////

use app\Model\AwsClass;
use app\Model\DBConnect;
use app\Model\MyCript;
use app\Model\MyUtilities;
use app\Model\Project;

////////////////////////////////////////////////////////////////////////

$router->match('GET', '/projects-images-(\d+)', function($id=null) { 

    ini_set('post_max_size', '25M');

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
  
    // ----- Check for id or input is empty
    if(!isset($id) || empty($_FILES['projectImages']['name'][0])  ){ 
        MyUtilities::redirect($_ENV['BASE_PATH']); exit();
    }

    // ----- Paramiters

    $valid_formats = ['image/png' , 'image/jpeg', 'image/gif'];

    $max_number_img_to_upload = $_ENV['IMG_PER_PROJECT'] - $_SESSION['projectImages']['imgsInDb'];

    // print_r($_FILES['projectImages']);  // TODO: REMOVE

    // ----------------

    $tmp_name_arr  = $_FILES['projectImages']['tmp_name'];
    $tmp_error_arr = $_FILES['projectImages']['error'];

    $finfo = new finfo(FILEINFO_MIME_TYPE);

    // ----------------

    $s3client = AwsClass::getS3Client();
    
    // ----------------

    foreach ($tmp_name_arr as $index => $tempFile) {

        // --- check qty
        if (($index + 1) > $max_number_img_to_upload) break;

        // --- check if img in tmp
        if (!is_uploaded_file($tempFile)) continue;

        // --- check img for error
        if ( $tmp_error_arr[$index]) continue;

        // --- check img format
        $fileType = $finfo->file($tempFile);
        if ( !in_array($fileType, $valid_formats, True) ) continue;

        echo PHP_EOL . $tempFile . ' -> ' . $fileType . ' ' .  $max_number_img_to_upload;
    }

    unset($_SESSION['projectImages']);
});