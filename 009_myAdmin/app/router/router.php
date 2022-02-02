<?php

use Bramus\Router\Router;

$router = new Router;



// ----- Define routes -------------------------------------------------


include './app/router/routerBasic.php';


include './app/router/routerProjects.php';


include './app/router/routerClients.php';


include './app/router/routerSigning.php';



// ----- Run it! -------------------------------------------------------

$router->run();
?>