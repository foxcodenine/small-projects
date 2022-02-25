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

        $projectImages = $currentProject->fetchImagesFromDb();


        $_SESSION['projectImages']['imgsInDb'] = sizeof($projectImages);

        if ($_SESSION['projectImages']['imgsInDb'] > 0) {

            $imgLastPos  = end($projectImages)->position;
        }

        $_SESSION['projectImages']['imgLastPos'] = $imgLastPos ?? 0;        


    } else {
        MyUtilities::redirect($_ENV['BASE_PATH']);
        exit();
    }


    $pageName = 'images'; include './app/views/_page.php';
    exit;
});

////////////////////////////////////////////////////////////////////////

$router->match('POST', '/projects-upload-(\d+)', function($id=null) { 
  
    // ----- Check for id
    if(!isset($id)){ 
        MyUtilities::redirect($_ENV['BASE_PATH']); exit();
    }

        // ----- Check if input is empty
    if(empty($_FILES['projectImages']['name'][0])  ){ 
        MyUtilities::redirect($_ENV['BASE_PATH'] . '/projects-images-' . $id); exit();
    }

    // ----- Set Paramiters

    $valid_formats = ['image/png' , 'image/jpeg', 'image/gif'];

    $max_number_img_to_upload = $_ENV['IMG_PER_PROJECT'] - $_SESSION['projectImages']['imgsInDb'];

    // ----------------

    $tmp_name_arr   = $_FILES['projectImages']['tmp_name'];
    $error_arr      = $_FILES['projectImages']['error'];
    $name_arr       = $_FILES['projectImages']['name'];

    $currentProject     = Project::getProjectList()[$id];
    $projectID          = $currentProject->getId();
    $img_last_pos_in_db = $_SESSION['projectImages']['imgLastPos'];

    $currentUser = MyUtilities::checkCookieAndReturnUser(); 
    MyUtilities::userInSessionPage();
    $userID = $currentUser->getId();

    $finfo = new finfo(FILEINFO_MIME_TYPE);

    // ----------------

    // print_r($_FILES['projectImages']);



    foreach ($tmp_name_arr as $index => $tempFile) {

        // --- check qty
        if (($index + 1) > $max_number_img_to_upload) break;

        // --- check if img in tmp
        if (!is_uploaded_file($tempFile)) continue;

        // --- check img for error
        if ( $error_arr[$index]) continue;

        // --- check img format
        $fileType = $finfo->file($tempFile);
        if ( !in_array($fileType, $valid_formats, True) ) continue;


        // --- upload to AWS
        $img_code = str_pad((string) rand(0, 999999), 6, '0', STR_PAD_LEFT);

        $img_format = explode('.', $name_arr[$index]);
        $img_format = end($img_format);


        $img_name = "user{$userID}/poject{$projectID}/images/{$img_code}.{$img_format}";          

        $result =  AwsClass::uploadImage($img_name, $tempFile); 

        if ($result["@metadata"]["statusCode"] == '200') {

            $image_url = $result["ObjectURL"]; 

            ++$img_last_pos_in_db;

            $currentProject->saveImagesToDb($image_url, $img_last_pos_in_db);
        }
    }

    unset($_SESSION['projectImages']);
    MyUtilities::redirect($_ENV['BASE_PATH'] . '/projects-images-' . $id); 
    exit();
});