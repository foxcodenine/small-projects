<?php

////////////////////////////////////////////////////////////////////////

use app\Model\AwsClass;
use app\Model\DBConnect;
use app\Model\ImageProject;
use app\Model\MyCript;
use app\Model\MyUtilities;
use app\Model\Project;

////////////////////////////////////////////////////////////////////////

$router->match('GET', '/projects-images-(\d+)', function($id=null) { 

    ini_set('post_max_size', '25M');

    // ----- Check for id
    if(!isset($id)){ 
        MyUtilities::redirect($_ENV['BASE_PATH']); exit();
    } else {
        $id = MyCript::stringSanitize($id);
    }

    // ----- Check if project exits    

    if (array_key_exists($id, Project::getProjectList() ) && !isset($_SESSION['project']['id'])) {
        $currentProject = Project::getProjectList()[$id];

        // --- Fetch project images

        $projectImages = $currentProject->fetchImagesFromDb();
        


        $_SESSION['projectImages']['imgsInDb'] = sizeof($projectImages);

        if ($_SESSION['projectImages']['imgsInDb'] > 0) {

            $imgLastPos  = end($projectImages)->getPosition(); // TODO: Remove
            // $imgLastPos  = $projectImages->bottom();
        }

        $_SESSION['projectImages']['imgLastPos'] = $imgLastPos ?? 0; 



        // --- Change project cover Or Auto set project cover

        if (isset($_GET['setAsProjectCover']) && !empty(trim($_GET['setAsProjectCover']))) {

            $imgID = MyCript::stringSanitize(($_GET['setAsProjectCover']));
            unset($_GET['setAsProjectCover']);

            $_SESSION['projectImageCover']['currentImages']  = serialize($projectImages[$imgID]);
            $_SESSION['projectImageCover']['currentProject'] = serialize($currentProject);

            header('Location: ' . $_ENV['BASE_PATH'] . '/projects-set-cover');


        } else {

            $projectCover = $currentProject->getCover();
            
            if((!isset($projectCover) || empty($projectCover )) && (bool) count($projectImages)) {

                // 'if project have images but cover not set';
                
                $currentProject->setCover(current($projectImages)->getUrlPath());
                $currentProject->updateProjectToDB();
            
                current($projectImages)->setCover(True);
                current($projectImages)->updateImageToDB();

            } else if (!count($projectImages)) {

                // 'if project have no images';
                
            } else {
                // 'cover is alraedy set';
            }
        }  
        
        // --- Swap position of images

        if (isset($_GET['imgSwap']) ) {

            $imgId = (int) MyCript::stringSanitize($_GET['imgSwap']['id']);
            $direction   = MyCript::stringSanitize($_GET['imgSwap']['dir']);

            unset($_GET['imgSwap']);

            reset($projectImages);
            while (current($projectImages) && current($projectImages)->getId() != $imgId) next($projectImages);

            if (current($projectImages) && in_array($direction, ['prev', 'next'])) {

                $imgA = current($projectImages);
                $imgB = $direction($projectImages);

                $posA = (int) $imgA->getPosition();
                $posB = (int) $imgB->getPosition();

                $imgA->setPosition($posB);
                $imgB->setPosition($posA);

                $imgA->updateImageToDB();
                $imgB->updateImageToDB();

                $projectImages[$imgA->getId()] = $imgB;
                $projectImages[$imgB->getId()] = $imgA;

                
                // --- [ This JS Code is cleaing the get parameters from url addess ]  

                echo "<script>
                
                history.pushState(
                    history.state, 
                    `MyAdmin`, 
                    `{$_ENV['BASE_PATH']}/projects-images-{$currentProject->getId()}`);

                </script>";
                                
            }

        }
        
    } else {
        MyUtilities::redirect($_ENV['BASE_PATH']);
        exit();
    }


    $pageName = 'images'; include './app/views/_page.php';
    exit;
});

////////////////////////////////////////////////////////////////////////

$router->match('POST|GET', '/projects-upload-img-(\d+)', function($id=null) { 
  
    // ----- Check for id
    if(!isset($id)){ 
        MyUtilities::redirect($_ENV['BASE_PATH']); exit();
    } else {
        $id = MyCript::stringSanitize($id);
    }

        // ----- Check if input is empty
    if(empty($_FILES['projectImages']['name'][0])  ){ 
        usleep(1000000); // Delay to display page loader
        
        header('location:' . $_ENV['BASE_PATH'] . '/projects-images-' . $id);  exit();
    }

    // ----- Set Paramiters

    $valid_formats = ['image/png' , 'image/jpeg'];

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


    foreach ($tmp_name_arr as $index => $tempFile) {

        // --- get max number of img allowed to upload
        if (($index + 1) > $max_number_img_to_upload) break;

        // --- check if img in tmp folder
        if (!is_uploaded_file($tempFile)) continue;

        // --- check img for errors
        if ( $error_arr[$index]) continue;

        // --- check img if format is valid
        $fileType = $finfo->file($tempFile);
        if ( !in_array($fileType, $valid_formats, True) ) continue;


        // ---  create img string for AWS        

        $newImageProject = new ImageProject($projectID, $userID);
        $newImageProject->setPosition(++$img_last_pos_in_db);
        

        $result = $newImageProject->uploadToAwa($name_arr[$index] , $tempFile);

        if ($result["@metadata"]["statusCode"] == '200') {

            $newImageProject->setUrlPath($result["ObjectURL"]);          

            $newImageProject->saveToDb();

            $newImageProject->createThumbnail();
        }
    }

    unset($_SESSION['projectImages']);
    usleep(1500000); // Delay to display page loader
    header('location:' . $_ENV['BASE_PATH'] . '/projects-images-' . $id);  exit(); 
    exit();
});

////////////////////////////////////////////////////////////////////////

$router->match('POST|GET', '/projects-remove-img-(\d+)-([\w \.]+)-(\d*)', function($projectID=null, $imgCode=null, $isCover=null) {



    $currentUser = MyUtilities::checkCookieAndReturnUser(); 
    MyUtilities::userInSessionPage();
    $userID = $currentUser->getId();

    $projectID = MyCript::stringSanitize($projectID);
    $imgCode   = MyCript::stringSanitize($imgCode);

    $result =   AwsClass::removeImage("user{$userID}/poject{$projectID}/images/{$imgCode}");
    
    if ($result["@metadata"]["statusCode"] == '200') {

        AwsClass::removeImage("user{$userID}/poject{$projectID}/thumbnails/{$imgCode}");

        $conn = DBConnect::getConn();

        $sql  = 'DELETE FROM ImageProject WHERE 
                    UserID = :UserID AND 
                    ProjectID = :ProjectID AND 
                    Code = :Code';

        $stmt = $conn->prepare($sql);

        $stmt->bindValue(':UserID', $userID);
        $stmt->bindValue(':ProjectID', $projectID);
        $stmt->bindValue(':Code', $imgCode);

        $stmt->execute();


        if ($isCover) {
            $sql = 'UPDATE Project SET cover = NULL WHERE id = :id';
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':id', $projectID);
            $stmt->execute();
        } 

        
    }

    header('Location: '. $_ENV['BASE_PATH'] . '/projects-upload-img-' . $projectID);
    exit();
});

////////////////////////////////////////////////////////////////////////

$router->match('POST|GET', '/projects-set-cover', function() {

    
    $currentProject = unserialize($_SESSION['projectImageCover']['currentProject']);
    $currentImage   = unserialize($_SESSION['projectImageCover']['currentImages']);
    unset($_SESSION['projectImageCover']);

    if ( isset($currentProject) && $currentProject->getId() && 
         isset($currentImage)   && $currentImage->getId()) {

        ImageProject::removeCoverFromDb($currentProject->getId());

        $currentProject->setCover($currentImage->getUrlPath());
        $currentProject->updateProjectToDB();
    
        $currentImage->setCover(True);
        $currentImage->updateImageToDB();
    
    } 

    header('Location: '. $_ENV['BASE_PATH'] . '/projects-upload-img-' . $currentProject->getId());
    exit();
});

////////////////////////////////////////////////////////////////////////


