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

    // _________________________________________________________________


    if (!$pro) {
        header('location: ' . $_ENV['BASE_PATH']);
    }

    // _________________________________________________________________
    // --- Set variables for view page

    $projectName = stripslashes($pro->getProjectName());


    $addressStr = [];
    if ($pro->getStrAddr()) array_push($addressStr, $pro->getStrAddr());
    if ($pro->getLocalityName()) array_push($addressStr, $pro->getLocalityName());
    $addressStr = stripslashes(implode(', &nbsp; ', $addressStr));

    $paNo = $pro->getPaNo() ? "<span><b>{$pro->getPaNo()}</b></span>" : false;
    $projectNo =  $pro->getProjectNo() ? "<b>{$pro->getProjectNo()}</b>" : false;

    $numberStr = '';
    if ($paNo) $numberStr .= $paNo . ' &nbsp; &nbsp; ';
    if ($paNo) $numberStr .= '<span>PROJECT No: ' . $projectNo . '</span>';

    
    $dateObject         = DateTime::createFromFormat('Y-m-d', $pro->getProjectDate());
    $projectDate        = $dateObject->format('F j, o');

    $projectEditLink    = "{$_ENV['BASE_PATH']}/projects-edit{$pro->getId()}";
    $projectImgsLink    = "{$_ENV['BASE_PATH']}/projects-images-{$pro->getId()}";
    $projectsLink       = "{$_ENV['BASE_PATH']}/projects";

    $projectContent     = htmlspecialchars_decode($pro->descript('read'));
    // $projectContent     = substr_replace($projectContent, '<p class="pro_details__content">', 0, 3);
    $projectContent     = '<div class="pro_details__content">' . $projectContent . '</div>';

    $hostBtn            = $pro->getHosted() ? 'Un-Host' : 'Host';
 

    $pageName = 'detail'; include './app/views/_page.php';   
    exit;
});


////////////////////////////////////////////////////////////////////////

$router->match('POST', '/projects-detail-(\d+)', function($id) {  
    
    
    $projectId = (int) MyCript::stringSanitize($id);
    $projectList = Project::getProjectList();   
    $pro = $projectList[$projectId] ?? false;

    // _________________________________________________________________

    if (!$pro) {

        header('location: ' . $_ENV['BASE_PATH']);
    } else {

        $hosted = (bool) $pro->getHosted();
        $hosted = (int) !$hosted;

        $pro->setHosted($hosted);
        $pro->updateProjectToDB();
    }

    // _________________________________________________________________ 

    header('location: ' . $_ENV['BASE_PATH'] . '/projects-detail-' . $projectId);
    exit;
});



////////////////////////////////////////////////////////////////////////


$router->set404(function() {
    header('HTTP/1.1 404 Not Found');
    echo '... do something special here';
});