<?php
use app\Model\DBTables;
use app\Model\MyUtilities;
use app\Model\Project;

////////////////////////////////////////////////////////////////////////


$router->match('GET', '/', function() {

    $projectList = Project::getProjectList();

    // ----- Change change dashboard display



    $_SESSION['dashboard']['display'] =  $_SESSION['dashboard']['display'] ?? 'All&nbsp;Projects';

    if (isset($_GET['dashboard']['changeDisplay'])) {
        echo $_GET['dashboard']['changeDisplay'];
        echo ' ' . $_SESSION['dashboard']['display'];
        

        switch ($_SESSION['dashboard']['display']) {
            case 'All&nbsp;Projects':
                $_SESSION['dashboard']['display'] = 'Hosted';
                break;
            case 'Hosted':
                $_SESSION['dashboard']['display'] = 'Hidden';
                break;
            default:
                $_SESSION['dashboard']['display'] = 'All&nbsp;Projects';
        }

        header('Location:' . $_ENV["BASE_PATH"]);
    }

    unset($_GET['dashboard']['changeDisplay']);

    if ($_SESSION['dashboard']['display'] === 'Hosted') {

        $projectList = array_filter($projectList, function($p) {
            if ($p->getHosted()) return $p;
        });

    } else if ($_SESSION['dashboard']['display'] === 'Hidden') {

        $projectList = array_filter($projectList, function($p) {
            if (!$p->getHosted()) return $p;
        });

    }

    // ------------------------------------




    $pageName = 'dashboard'; include './app/views/_page.php';    
});

////////////////////////////////////////////////////////////////////////

$router->match('GET', '/test', function() {
    $GLOBALS['endpoint']  = 'test'; 
    include './app/views/test.php';    
    exit;

});

////////////////////////////////////////////////////////////////////////

$router->match('GET', '/tables', function() {
    
    $GLOBALS['endpoint']  = 'tables'; 
    DBTables::createTables();
    header("Location: " . $_ENV['BASE_PATH']);
    exit();
});
