<?php
use Dotenv\Dotenv;

// ----- ENV -----------------------------------------------------------

require_once __DIR__ . '../../vendor/autoload.php';
$dotenv =  Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();


// ----- Routes --------------------------------------------------------

require './app/router/routerBase.php';







// ---------------------------------------------------------------------

if (!debug_backtrace()) {

    echo $_ENV['APP_ENV'];
    echo '...so far so good!<br>';
    
}
?>