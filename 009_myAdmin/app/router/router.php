<?php

use Bramus\Router\Router;

$router = new Router;



// ----- Define routes -------------------------------------------------


include './app/router/routers_basic.php';


include './app/router/routers_projects.php';


include './app/router/routers_clients.php';


include './app/router/routers_signing.php';



// ----- Run it! -------------------------------------------------------

$router->run();
?>