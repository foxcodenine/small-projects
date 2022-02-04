<?php

$router->match('GET', '/clients', function() {
    
    $pageName = 'clients'; include './app/views/_page.php';
    exit;

});

$router->match('GET', '/clients-add', function() {

    $pageName = 'clients_add'; include './app/views/_page.php';
    exit;

});