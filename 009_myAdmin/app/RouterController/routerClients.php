<?php

use app\Model\MyUtilities;
use app\Model\Client;
use app\Model\DBConnect;

////////////////////////////////////////////////////////////////////////

$router->match('GET|POST', '/clients', function() {

    Client::updatedClientList();

    $clientList = Client::getClientList();


    // ____________________________________________


    function cmp($a, $b) {

        $method = $_GET['sortBy'] ?? 'getId';
        $sortOrder = $_GET['sortOrder'] ?? 1;
     
      
        if ($a->$method() == $b->$method()) { 

            return 0;
        } else if ($sortOrder === 'ASC') {

            return ($a->$method() > $b->$method()) ? -1 : 1;

        } else {
            return ($a->$method() < $b->$method()) ? -1 : 1;
        }              
    }

    usort($clientList, "cmp");

    // ____________________________________________
    
    $pageName = 'clients'; include './app/views/_page.php';
    
    unset($_SESSION['error']);
    unset($_SESSION['client']);
    exit;

});

////////////////////////////////////////////////////////////////////////

$router->match('GET', '/clients-details(\d+)', function($id=0) {

    Client::updatedClientList();

    $client = Client::getClientList()[$id] ?? null;

    if(!isset($client)) MyUtilities::redirect('/009');

    // -----------------------

    $clientFullname = $client->getFirstname() . ' ' . $client->getLastname();

    // -----------------------

    $clientIdCard = $client->getIdCard();

    // -----------------------

    $clientEmail  = $client->getEmail()  ?: false;
    $clientMobile = $client->getMobile() ?: false;
    $clientPhone  = $client->getPhone () ?: false;

    $clinetContact = ((bool) $clientEmail) + ((bool) $clientMobile) + ((bool) $clientPhone);

    // -----------------------

    $clientStrAddr = $client->getStrAddr() ? $client->getStrAddr() . ' &nbsp; &nbsp; ' : false;
    $clientLocalityName = $client->getLocalityName() ? $client->getLocalityName() . ' &nbsp; &nbsp; ' : false;
    $clientPostcode = $client->getPostcode() ? $client->getPostcode() . ' &nbsp; &nbsp; ' : false;
    $clientCountryName = $client->getCountryName() ?: false;

    $clientAddress = trim(
        "$clientStrAddr $clientLocalityName ".
        "$clientPostcode $clientCountryName"
    );

    $clientAddress = empty($clientAddress) ? false : $clientAddress;

    // -----------------------

    $clientCompany  = $client->getCompany () ?: false;

    // -----------------------

    $clinetInfo = $client->info('read');
    $clinetInfo = empty($clinetInfo) ? false : $clinetInfo;


    
    $pageName = 'clients_details'; include './app/views/_page.php';
    unset($_SESSION['error']);
    unset($_SESSION['client']);
    exit;

});

////////////////////////////////////////////////////////////////////////

$router->match('GET|POST', '/clients-delete', function() {

    Client::deleteClientsFromDB(...$_POST['clientsDeleteList']);
    MyUtilities::redirect('/009/clients');

});




////////////////////////////////////////////////////////////////////////