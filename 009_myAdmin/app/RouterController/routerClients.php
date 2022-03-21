<?php

use app\Model\MyUtilities;
use app\Model\Client;
use app\Model\DBConnect;
use app\Model\MyCript;

////////////////////////////////////////////////////////////////////////

$router->match('GET|POST', '/clients', function() {

    Client::updateClientList();

    $clientList = Client::getClientList();

    $clientList = MyUtilities::sortTable($clientList);
    
    $pageName = 'clients'; include './app/views/_page.php';
    
    unset($_SESSION['error']);
    unset($_SESSION['client']);
    exit;

});

////////////////////////////////////////////////////////////////////////

$router->match('GET', '/clients-details(\d+)', function($id=0) {

    $id = MyCript::stringSanitize($id);

    Client::updateClientList();

    $client = Client::getClientList()[$id] ?? null;

    if(!isset($client)) MyUtilities::redirect($_ENV['BASE_PATH']);

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

    $clientStrAddr      = $client->getStrAddr() ? $client->getStrAddr() . ' &nbsp; &nbsp; ' : false;
    $clientLocalityName = $client->getLocalityName() ? $client->getLocalityName() . ' &nbsp; &nbsp; ' : false;
    $clientPostcode     = $client->getPostcode() ? $client->getPostcode() . ' &nbsp; &nbsp; ' : false;
    $clientCountryName  = $client->getCountryName() ?: false;

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
    MyUtilities::redirect($_ENV['BASE_PATH'] . '/clients');

});




////////////////////////////////////////////////////////////////////////