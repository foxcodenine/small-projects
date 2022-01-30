<?php


$router->match('GET', '/projects', function() {        

    $pageName = 'projects'; include './app/views/_page.php';
    
    exit;
});

$router->match('GET', '/projects-add', function() {    
    
    $pageName = 'pojects_add'; include './app/views/_page.php';   
    exit;
});

$router->match('GET', '/images', function() {   

    $pageName = 'images'; include './app/views/_page.php';
    exit;
});