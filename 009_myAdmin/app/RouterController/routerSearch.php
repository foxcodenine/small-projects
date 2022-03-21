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

    // -----------------------------------------------------------------
    // --- Get select options

    $listLocality = MyUtilities::fetchOptionsFromDB('locality');
    $listCountry  = MyUtilities::fetchOptionsFromDB('country');
    $listStage    = MyUtilities::fetchOptionsFromDB('stage');
    $listCategoy  = MyUtilities::fetchOptionsFromDB('category');
    $listClients  = MyUtilities::fetchOptionsFromDB('client');
     

    // -----------------------------------------------------------------
    // --- Clear search array

    $clientsSeachFields = $projectSeachFields = ['localityName'  =>  '1x2x3x4x'];

    // -----------------------------------------------------------------
    // --- Post Method

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $testData = $_POST['searchBtn'] ?? false;

        $searchBtn = $_POST['searchBtn'] ?? false;
        $searchBtn = MyCript::stringSanitize($searchBtn);

        // --- Post Client

        if ($searchBtn === 'client') {

            $clientsSeachFields = [ 
                'firstname' => $_POST['firstname'] ?? false ,
                'lastname'  => $_POST['lastname'] ?? false  ,
                'idCard'    => $_POST['idCard'] ?? false  ,
                'company'   => $_POST['company'] ?? false  ,
                'email'     => $_POST['email'] ?? false  ,
                'phone'     => $_POST['phoneMobile'] ?? false  ,
                'mobile'    => $_POST['phoneMobile'] ?? false  ,
                'strAddr'   => $_POST['strAddr'] ?? false  ,
                'localityName'  => $_POST['locality'] ?? false  ,
                'countryName'   => $_POST['country'] ?? false 
            ];
            

            array_walk($clientsSeachFields, function(&$v, $k) {
                $v = trim(htmlentities($v));
                $v = $v === '' ? false : $v;
            });

            $testData = Client::getSearchList('Client', $clientsSeachFields);

        }

        // --- Post Project

        if ($searchBtn === 'poject') {

            $projectSeachFields = [
                'projectname'   => $_POST['firstname'] ?? false,
                'strAddr'       => $_POST['strAddr'] ?? false,
                'projectNo'     => $_POST['projectNo'] ?? false,
                'projectDate'   => $_POST['projectDate'] ?? false,
                'localityName'  => $_POST['localityName'] ?? false,
                'stageName'     => $_POST['stageName'] ?? false,
                'categoryName'  => $_POST['categoryName'] ?? false,
                'clientId'      => $_POST['clientId'] ?? false
            ];

            array_walk($clientsSeachFields, function(&$v, $k) {
                $v = trim(htmlentities($v));
                $v = $v === '' ? false : $v;
            });

        }

        $testData = Client::getSearchList('Client', $clientsSeachFields);
    }

    // -----------------------------------------------------------------

    
    // $testData = $clientsSeachFields;



    // -----------------------------------------------------------------

    $pageName = 'search'; include './app/views/_page.php';
   
    exit;
});


////////////////////////////////////////////////////////////////////////