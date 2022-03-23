<?php

use app\Model\AwsClass;
use app\Model\Client;
use app\Model\DBConnect;
use app\Model\DBTables;
use app\Model\MyCript;
use app\Model\MyUtilities;
use app\Model\Project;

////////////////////////////////////////////////////////////////////////

$router->match('GET', '/', function() {

    $projectList = Project::getProjectList();


    // ----- Init Search Page Session
    
    if (!isset($_SESSION['search-client-list'])) {
        $_SESSION['search-client-list']  = serialize(Client::getClientList());
        $_SESSION['search-project-list'] = serialize($projectList);
    }
    


    // ----- Change change dashboard display



    $_SESSION['dashboard']['display'] =  $_SESSION['dashboard']['display'] ?? 'All&nbsp;Projects';

    if (isset($_GET['dashboard']['changeDisplay'])) {
        echo $_GET['dashboard']['changeDisplay'];
        echo ' ' . $_SESSION['dashboard']['display'];
        

        switch ($_SESSION['dashboard']['display']) {
            case 'All&nbsp;Projects':
                $_SESSION['dashboard']['display'] = 'Hosted';
                break;
            case 'Hosted':
                $_SESSION['dashboard']['display'] = 'Hidden';
                break;
            default:
                $_SESSION['dashboard']['display'] = 'All&nbsp;Projects';
        }

        header('Location:' . $_ENV["BASE_PATH"]);
    }

    unset($_GET['dashboard']['changeDisplay']);

    if ($_SESSION['dashboard']['display'] === 'Hosted') {

        $projectList = array_filter($projectList, function($p) {
            if ($p->getHosted()) return $p;
        });

    } else if ($_SESSION['dashboard']['display'] === 'Hidden') {

        $projectList = array_filter($projectList, function($p) {
            if (!$p->getHosted()) return $p;
        });

    }

    // ------------------------------------

    $pageName = 'dashboard'; include './app/views/_page.php';    
});

////////////////////////////////////////////////////////////////////////
$router->match('POST', '/', function() {

    // ----- fetch Post variables & filter them

    $action = MyCript::stringSanitize($_POST['dashboardBtn']);
    

    $projectIds = array_map(function($p){
        return MyCript::stringSanitize($p);
    }, $_POST['dashboardProject'] ?? []);

    unset($_POST['dashboardBtn']);
    unset($_POST['dashboardProject']);


    // --------- If Action is Delete

    if ($action === 'delete') {
        Project::deleteProjectsFromDB(...$projectIds);    
        AwsClass::deleteProjectsImagesFromAWS(...$projectIds); 

    } else if (count($projectIds)) {

    // --------- If Add or Remove from host
        // ----- Ceate SQL string

        $sql_start = 'UPDATE Project SET hosted = ';



        if ($action === 'add') {
            $sql_start .= ' 1 WHERE ';
        } else   {
            $sql_start .= ' false WHERE ';
        }
        

        $sql_array = array_map( function ($project_id) {
            return " userID = :userID AND id =  :id{$project_id}";
        }, $projectIds);


        $sql_end = implode(' OR ', $sql_array);

        $sql = $sql_start . $sql_end;

        // ----- Get coon and prepare

        $conn = DBConnect::getConn();
        $stmt = $conn->prepare($sql);	

        // ----- Bind data            


        $currentUser = MyUtilities::checkCookieAndReturnUser(); 
        MyUtilities::userInSessionPage();
        $userID = $currentUser->getId();

        $stmt->bindValue(":userID", $userID);


        foreach($projectIds as $project_id) {
            $stmt->bindValue(":id{$project_id}", $project_id);
        }

        // ----- Execute 
        $stmt -> execute();	
    } 
    

    header('Location: ' . $_ENV['BASE_PATH']);
});

////////////////////////////////////////////////////////////////////////