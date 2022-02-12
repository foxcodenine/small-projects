<?php

use app\Model\MyUtilities;
use app\Model\Client;
use app\Model\DBConnect;

////////////////////////////////////////////////////////////////////////

$router->match('GET', '/clients', function() {

    Client::updatedClientList();

    $clientList = Client::$ClientList;
    
    $pageName = 'clients'; include './app/views/_page.php';
    unset($_SESSION['error']);
    unset($_SESSION['client']);
    exit;

});

////////////////////////////////////////////////////////////////////////


