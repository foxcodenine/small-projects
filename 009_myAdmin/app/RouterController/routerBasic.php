<?php
use app\Model\DBTables;
use app\Model\MyCript;
use app\Model\MyUtilities;
use app\Model\Project;
use app\Model\Collection;
use app\Model\Locality;
use app\Model\Category;
use app\Model\Client;
use app\Model\Stage;
use app\Model\Country;
use app\Model\DBConnect;

////////////////////////////////////////////////////////////////////////



$router->match('GET', '/test', function() {
    $GLOBALS['endpoint']  = 'test'; 
    include './app/views/test.php';    
    exit;

});
////////////////////////////////////////////////////////////////////////


$router->match('GET|POST', '/disclaimer', function() {

    
    if (!isset($_SESSION['currentUser'])) header('Location: ' . $_ENV['BASE_PATH'] . '/sign-up');
    $currentUser = unserialize($_SESSION['currentUser']);
    
    // --------------------------------------------

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    

        $disclaimerBtn = $_POST['disclaimerBtn'] ?? 'reject';

        if ($disclaimerBtn === 'accept') {

            
            $remember = $_SESSION['remember']  ?? false;
            unset($_SESSION['remember']);

            $currentUser->setLastLogin(date(DBConnect::DT_FORMAT, time()));
            $currentUser->updateUser();

            // $_SESSION['currentUser'] = MyUtilities::setUserInSession($currentUser);
            
            MyUtilities::setCookie($currentUser, $remember);
            MyUtilities::checkCookieAndReturnUser();

            header('Location: ' . $_ENV['BASE_PATH'] . '/');

            

        } else {
            header('Location: ' . $_ENV['BASE_PATH'] . '/sign-in');
        }
    } 

    // --------------------------------------------
    
    $pageName = 'disclaimer'; include './app/views/_page.php';  
    $_SESSION['currentUser'] = serialize($currentUser);
    
    unset($_SESSION['sign-in']);
    unset($_SESSION['message']);
    unset($_SESSION['error']);
    exit;

});


$router->match('GET', '/terms', function() {
            
    $pageName = 'terms'; include './app/views/_page.php';  
    exit;
});


////////////////////////////////////////////////////////////////////////

$router->match('GET', '/table/(\w+)', function($action) {

    $action = MyCript::stringSanitize($action);
    
    switch ($action) {
        case 'create':
            DBTables::createTables();
            break;

        case 'drop':
            DBTables::dropTables();
            break;

        case 'populate':
            DBTables::populateTables('chris12aug@yahoo.com');
            break;
    }

    echo $action;
    
    // header("Location: " . $_ENV['BASE_PATH']);
    exit();
});


////////////////////////////////////////////////////////////////////////


$router->match('GET', '/accountActivationEmail', function() {


    $link = 'hg';
    include './app/views/accountActivationEmail.php';
    exit();
});

////////////////////////////////////////////////////////////////////////

