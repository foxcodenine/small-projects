<?php

use Bramus\Router\Router;

$router = new Router;



// ----- Define routes -------------------------------------------------


include './app/RouterController/routerBasic.php';


include './app/RouterController/routerProjects.php';
include './app/RouterController/routerProjectsAddEdit.php';


include './app/RouterController/routerClients.php';
include './app/RouterController/routerClientsAddEdit.php';


include './app/RouterController/routerSign.php';
include './app/RouterController/routerSignUp.php';
include './app/RouterController/routerSignIn.php';



// ----- Run it! -------------------------------------------------------

$router->run();
?>