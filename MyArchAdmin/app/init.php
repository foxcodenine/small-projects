<?php
use Dotenv\Dotenv;

// _____________________________________________________________________

require_once __DIR__ . '../../vendor/autoload.php';
$dotenv =  Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();


// _____________________________________________________________________

if (!debug_backtrace()) {

    echo $_ENV['APP_ENV'];
    echo '...so far so good!<br>';
    
}
?>