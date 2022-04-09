
<!DOCTYPE html>
<html lang="en">

<?php


use app\Model\MyUtilities;


require './app/views/include/viewHeader.php'; ?>

<!-- --- Body ------------------------------------------------------ -->

<body>
<!-- <div class="content"> -->
 
    <?php 
    
    if (!in_array($pageName, ['sign_up', 'sign_in', 'disclaimer', 
                    'terms', 'password_recover', 'password_reset'])) {
        
        // Checking if user is loged in;
        MyUtilities::checkCookieAndReturnUser();
        MyUtilities::userInSessionPage();
        
        // Setup topbar use fullname, id and roll;
        [$topbarFullname, $topbarRoll, $topbarIcon] =  MyUtilities::topBarUserFullnameRollIcon();

        // Inserting top and side bars
        require './app/views/include/viewBodyUpper.php';
        echo '<div class="content"><main  class="pages pageTransition">';
        
        
    } else {
        echo '<div class="content content--2"><main>';
        MyUtilities::checkCookieAndReturnUser();
    }    
    ?>      

<!-- --------------------------------------------------------------- -->

    <?php

    if ($pageName !== 'locality') { unset($_SESSION['locality']); }
    if ($pageName !== 'stage') { unset($_SESSION['stage']); }
    if ($pageName !== 'category') { unset($_SESSION['category']); }
    if ($pageName !== 'country') { unset($_SESSION['country']); }
    
    ?>

<!-- --------------------------------------------------------------- -->
    <?php
    $pagePath = '';
    switch ($pageName) {

        case 'dashboard':   
            $pagePath = './app/views/others/viewDashboard.php';
            break; 
            
        case 'settings':
            $pagePath = './app/views/others/viewSettings.php';
            break;

        case 'search':   
            $pagePath = './app/views/others/viewSearch.php';
            break;  

        case 'locality':   
        case 'category':   
        case 'stage':   
        case 'country':   
            $pagePath = './app/views/others/viewCollections.php';
            break;  

        case 'projects':
            $pagePath = './app/views/projects/viewProjects.php';
            break;  

        case 'pojects_add':
            $pagePath = './app/views/projects/viewProjectsAddEdit.php';
            break;  

        case 'images':
            $pagePath = './app/views/projects/viewProjectsImages.php';
            break;            

        case 'detail':
            $pagePath = './app/views/projects/viewProjectsDetails.php';
            break;            

        case 'clients':
            $pagePath = './app/views/clients/viewClients.php';
            break;   

        case 'clients_details':
            $pagePath = './app/views/clients/viewClientsDetails.php';
            break;            

        case 'clients_add_edit':
            $pagePath = './app/views/clients/viewClientsAddEdit.php';
            break;    

        case 'sign_up':
            $pagePath = './app/views/sign/viewSignUp.php';
            break;  

        case 'sign_in':
            $pagePath = './app/views/sign/viewSignIn.php';
            break;            

        case 'password_recover':
            $pagePath = './app/views/sign/viewPasswordRecover.php';
            break;            

        case 'password_reset':
            $pagePath = './app/views/sign/viewPasswordReset.php';
            break;            

        case 'disclaimer':
        case 'terms':
            $pagePath = './app/views/sign/viewDisclaimer.php';
            break;     

            
    }
    ?>
    <?php include $pagePath; ?>
    

<!-- --------------------------------------------------------------- -->

</main>

</div>

    <?php  require './app/views/include/viewBodyScripts.php'; ?>

</body>
</html>