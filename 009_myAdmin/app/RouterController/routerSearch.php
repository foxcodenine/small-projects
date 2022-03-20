<?php


use app\Model\MyCript;
use app\Model\MyUtilities;
use app\Model\Project;
use app\Model\Client;




$router->match('GET|POST', '/search', function() {  

    // -------------------------------------------------
    
    Client::updateClientList();

    $clientList = Client::getClientList();

    // -------------------------------------------------

    $table = $_GET['sortTable'] ?? false;

    $table = MyCript::stringSanitize($table);

    if ($table === 'Client') {
        $clientList = MyUtilities::sortTable($clientList);
    }

    

    // -------------------------------------------------

    Project::updateProjectList();

    $projectList = Project::getProjectList();


    if ($table === 'Project') {
        $projectList = MyUtilities::sortTable($projectList);
    }

      

    // -------------------------------------------------

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $testData = $_POST['searchBtn'] ?? false;


        $searchBtn = $_POST['searchBtn'] ?? false;
        $searchBtn = MyCript::stringSanitize($searchBtn);

        if ($searchBtn === 'client') {
            
        }

        if ($searchBtn === 'poject') {
            
        }


    }

    $testData = Client::getSearchList('Client', ['firstname' => 'e']);


    // -------------------------------------------------

    $pageName = 'search'; include './app/views/_page.php';
   
    exit;
});


////////////////////////////////////////////////////////////////////////