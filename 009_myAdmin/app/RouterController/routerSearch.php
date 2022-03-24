<?php

use app\Model\MyCript;
use app\Model\MyUtilities;
use app\Model\Project;
use app\Model\Client;



$router->match('GET|POST', '/search', function() {  

    $table = $_GET['sortTable'] ?? false;
    $table = MyCript::stringSanitize($table);

    // -------------------------------------------------    
    // --- Fetching clients object list from session & sorting

    $clientList = $_SESSION['search-client-list'] ?? 'a:0:{}';
    $clientList = unserialize($clientList);    

    if ($table === 'Client') {
        $clientList = MyUtilities::sortTable($clientList);
    }    
         
    // -------------------------------------------------
    // --- Fetching project object list from session & sorting

    $projectList = $_SESSION['search-project-list'] ?? 'a:0:{}';
    $projectList = unserialize($projectList);

    if ($table === 'Project') {
        $projectList = MyUtilities::sortTable($projectList);
    }

    // -----------------------------------------------------------------
    // --- Fetching select options

    $listLocality = MyUtilities::fetchOptionsFromDB('locality');
    $listCountry  = MyUtilities::fetchOptionsFromDB('country');
    $listStage    = MyUtilities::fetchOptionsFromDB('stage');
    $listCategory = MyUtilities::fetchOptionsFromDB('category');
    $listClient   = MyUtilities::fetchOptionsFromDB('client');
     

    // -----------------------------------------------------------------
    // --- Fetching input values from session 

    $firstname    = $_SESSION['srch']['cli']['firstname'] ?? '';
    $lastname     = $_SESSION['srch']['cli']['lastname'] ?? '';
    $idCard       = $_SESSION['srch']['cli']['idCard'] ?? '';
    $company      = $_SESSION['srch']['cli']['company'] ?? '';
    $email        = $_SESSION['srch']['cli']['email'] ?? '';
    $phoneMobile  = $_SESSION['srch']['cli']['phoneMobile'] ?? '';
    $strAddrCli   = $_SESSION['srch']['cli']['strAddr'] ?? '';
    $localityNCli = $_SESSION['srch']['cli']['localityName'] ?? '';
    $countryName  = $_SESSION['srch']['cli']['countryName'] ?? '';

    $projectname  = $_SESSION['srch']['pro']['projectname'] ?? '';
    $clientId     = $_SESSION['srch']['pro']['clientId'] ?? '';
    $strAddrPro   = $_SESSION['srch']['pro']['strAddr'] ?? '';
    $localityNPro = $_SESSION['srch']['pro']['localityName'] ?? '';
    $projectNo    = $_SESSION['srch']['pro']['projectNo'] ?? '';
    $paNo         = $_SESSION['srch']['pro']['paNo'] ?? '';
    $stageName    = $_SESSION['srch']['pro']['stageName'] ?? '';
    $categoryName = $_SESSION['srch']['pro']['categoryName'] ?? '';

    // $testDataClient  = $_SESSION['srch']['cli']['list'] ?? false;
    // $testDataProject = $_SESSION['srch']['pro']['list'] ?? false;
    unset($_SESSION['srch']);

    // ----------------------------------------------------------------- 
    // --- Error message 

    $projectErrorMessage = count($projectList) < 1 ? 'Your search yielded no results!': '&nbsp;';
    $clientErrorMessage  = count($clientList)  < 1 ? 'Your search yielded no results!': '&nbsp;';

    // -----------------------------------------------------------------
    // ----------- Post Method

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $searchBtn = $_POST['searchBtn'] ?? false;
        $searchBtn = MyCript::stringSanitize($searchBtn);

        // ------- Post Client

        if ($searchBtn === 'client') {

            // --- Saving post data in array 

            $clientSearchFields = [ 
                'firstname'     => $_POST['firstname'] ?? false ,
                'lastname'      => $_POST['lastname'] ?? false  ,
                'idCard'        => $_POST['idCard'] ?? false  ,
                'company'       => $_POST['company'] ?? false  ,
                'email'         => $_POST['email'] ?? false  ,
                'phone'         => $_POST['phoneMobile'] ?? false  ,
                'mobile'        => $_POST['phoneMobile'] ?? false  ,
                'strAddr'       => $_POST['strAddr'] ?? false  ,
                'localityName'  => $_POST['locality'] ?? false  ,
                'countryName'   => $_POST['country'] ?? false 
            ];

            // --- Saving post data in session

            list (
                'firstname'     => $_SESSION['srch']['cli']['firstname'],
                'lastname'      => $_SESSION['srch']['cli']['lastname'],
                'idCard'        => $_SESSION['srch']['cli']['idCard'],
                'company'       => $_SESSION['srch']['cli']['company'],
                'email'         => $_SESSION['srch']['cli']['email'],
                'phone'         => $_SESSION['srch']['cli']['phoneMobile'],
                'mobile'        => $_SESSION['srch']['cli']['phoneMobile'],
                'strAddr'       => $_SESSION['srch']['cli']['strAddr'],
                'localityName'  => $_SESSION['srch']['cli']['localityName'] ,
                'countryName'   => $_SESSION['srch']['cli']['countryName']
            )= $clientSearchFields;
            
            // --- Sanitizing  data                         

            array_walk($clientSearchFields, function(&$v, $k) {
                $v = trim(htmlentities($v));
                $v = $v === '' ? false : $v;
            });  
            
            // --- Creating ClientList from data 
            
            Client::getSearchList('Client', $clientSearchFields);
        }

        // ------- Post Project

        if ($searchBtn === 'project') {

            // --- Saving post data in array 

            $projectSearchFields = [
                'projectname'   => $_POST['projectname'] ?? false,
                'clientId'      => $_POST['clientId'] ?? false,
                'strAddr'       => $_POST['strAddr'] ?? false,
                'localityName'  => $_POST['localityName'] ?? false,
                'projectNo'     => $_POST['projectNo'] ?? false,
                'paNo'          => $_POST['paNo'] ?? false,
                'stageName'     => $_POST['stageName'] ?? false,
                'categoryName'  => $_POST['categoryName'] ?? false,
            ];

            // --- Saving post data in session

            list (
                'projectname'   => $_SESSION['srch']['pro']['projectname'],
                'clientId'      => $_SESSION['srch']['pro']['clientId'],
                'strAddr'       => $_SESSION['srch']['pro']['strAddr'],
                'localityName'  => $_SESSION['srch']['pro']['localityName'],
                'projectNo'     => $_SESSION['srch']['pro']['projectNo'],
                'paNo'          => $_SESSION['srch']['pro']['paNo'],
                'stageName'     => $_SESSION['srch']['pro']['stageName'],
                'categoryName'  => $_SESSION['srch']['pro']['categoryName'],
            ) = $projectSearchFields;

            // --- Sanitizing  data 
                
            array_walk($projectSearchFields, function(&$v, $k) {
                $v = trim(htmlentities($v));
                $v = $v === '' ? false : $v;
            }); 
            
            // --- Creating ProjectList from data
            
            Project::getSearchList('Project', $projectSearchFields);
        }               
        
        


        // -------------------------------------------------------------
        // --- Redirect from POST to fetch SESSION data

        $redirect_url  = $_ENV['BASE_PATH'];
        $redirect_url .= $searchBtn === 'client' ? 
                        '/search?sortBy=&sortTable=Client&sortOrder=' : 
                        '/search?sortBy=&sortTable=Project&sortOrder=';
        
        
        header('Location: ' .  $redirect_url);
        // header('Location: ' .  $_SERVER["REQUEST_URI"]);
    }

    // -----------------------------------------------------------------


    $pageName = 'search'; include './app/views/_page.php';
    
    exit;
});


////////////////////////////////////////////////////////////////////////