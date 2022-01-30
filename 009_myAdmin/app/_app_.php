<?php
session_start();
use Dotenv\Dotenv;
define( 'WP_SAMESITE_COOKIE', 'None' );

// ----- ENV -----------------------------------------------------------

require_once __DIR__ . '../../vendor/autoload.php';
$dotenv =  Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();


// ----- Routes --------------------------------------------------------

require './app/router/router.php';
// require './app/router/routerSigning.php';




// ---------------------------------------------------------------------

if (!debug_backtrace()) {

    echo $_ENV['APP_ENV'];
    echo '...so far so good!<br>';

}
?>