<?php

use app\Model\DBConnect;
use app\Model\DBTables;
use Bramus\Router\Router;

$routerBase = new Router;


// ---------------------------------------------------------------------
	
$is_page_refreshed = (
            isset($_SERVER['HTTP_CACHE_CONTROL']) && 
            $_SERVER['HTTP_CACHE_CONTROL'] == 'max-age=0'
);


// ----- Define routes -------------------------------------------------




$routerBase->match('GET', '/', function() {
    $GLOBALS['endpoint']  = 'home'; 
    include './app/views/dashboard.php';
});

$routerBase->match('GET', '/test', function() {
    $GLOBALS['endpoint']  = 'test'; 
    include './app/views/test.php';    
    exit;

});

$routerBase->match('GET', '/tables', function() {
    $GLOBALS['endpoint']  = 'tables'; 
    DBTables::createTables();
    header("Location: /009");
    exit;
});



$routerBase->match('GET|POST', '/sign-up', function() use ($is_page_refreshed) {

    // --- reset session var  
    if ($is_page_refreshed) {
        unset($_SESSION['message']); unset($_SESSION['error']);
    }

    // --- setting messages
    $message = $_SESSION['message']['content'] ?? '&nbsp;';    
    $messageType = $_SESSION['message']['type'] ?? 'none';

    
    // $errorPassword = 'This field is required';

    $errorEmail    = $_SESSION['error']['errorEmail'] ?? '&nbsp;';
    $errorPassword = $_SESSION['error']['errorPassword'] ?? '&nbsp;';

    
    // --- if post
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        unset($_SESSION['message']); unset($_SESSION['error']);

        $firstname = filter_input(INPUT_POST, 'firstname',  FILTER_SANITIZE_STRING);
        $lastname  = filter_input(INPUT_POST, 'lastname',   FILTER_SANITIZE_STRING);
        $email     = filter_input(INPUT_POST, 'email',      FILTER_SANITIZE_EMAIL);
        $password  = filter_input(INPUT_POST, 'password',   FILTER_SANITIZE_STRING);       

        

        if (!$email) {
            $_SESSION['error']['errorEmail'] = 'This field is required';

        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error']['errorEmail'] = 'Invalid email address';

        } else {
            unset($_SESSION['error']['errorEmail']);
        }

        if (!$password) {
            $_SESSION['error']['errorPassword'] = 'This field is required';

        } elseif (strlen($password) < 6) {
            $_SESSION['error']['errorPassword'] = 'Password is too short';

        } elseif (strlen($password) > 25) {
            $_SESSION['error']['errorPassword'] = 'Password is too long';

        } else {
            unset($_SESSION['error']['errorPassword']);
        }

        if (!isset($_SESSION['error']) || empty($_SESSION['error'])) {            
            $_SESSION['message']['content'] = 'An email has been sent to your email address to activate your account.';
            $_SESSION['message']['type'] = 'success';

            try {

                $conn = DBConnect::getConn();

                $sql = " INSERT INTO User (email, pass,  accountState, roleGroup, signUpDate)
                        VALUES (:email, :pass, :accountState, :roleGroup, :signUpDate)";

                $addUser = $conn -> prepare($sql);

                $addUser -> bindValue(':email', $email);
                $addUser -> bindValue(':pass', $password);
                $addUser -> bindValue(':accountState', 'not-validated');
                $addUser -> bindValue(':roleGroup', 'Demo');
                $addUser -> bindValue(':signUpDate', date(DBConnect::DT_FORMAT, time()));

                $addUser -> execute();


            } catch (PDOException $e) {
                die("Error getConn: <br>" . $e->getMessage());
            }
        }
            
        header('Location: ' . '/009/sign-up');
    }


    include './app/views/sign/sign_up.php'; 
    
    

    exit;
});

// ----- Signing





// ----- Projects

$routerBase->match('GET', '/projects', function() {
    $GLOBALS['endpoint']  = 'projects'; 
    include './app/views/projects.php';    
    exit;

});

$routerBase->match('GET', '/projects-add', function() {
    $GLOBALS['endpoint']  = 'projects-add'; 
    include './app/views/projects_add.php';    
    exit;
});

$routerBase->match('GET', '/images', function() {
    $GLOBALS['endpoint']  = 'images'; 
    include './app/views/images.php';    
    exit;
});


// ----- Clients

$routerBase->match('GET', '/clients', function() {
    $GLOBALS['endpoint']  = 'clients'; 
    include './app/views/clients.php';    
    exit;

});

$routerBase->match('GET', '/clients-add', function() {
    $GLOBALS['endpoint']  = 'clients-add'; 
    include './app/views/clients_add.php';    
    exit;

});







// ----- Run it! -------------------------------------------------------

$routerBase->run();
?>