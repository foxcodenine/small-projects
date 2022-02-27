
<!DOCTYPE html>
<html lang="en">

<?php


use app\Model\MyUtilities;


require './app/views/include/viewHeader.php'; ?>

<!-- --- Body ------------------------------------------------------ -->

<body>
<div class="content">

    <?php 
    if ($pageName !== 'sign_up' && $pageName !== 'sign_in') {
        
        // Checking if user is loged in;
        MyUtilities::checkCookieAndReturnUser();
        MyUtilities::userInSessionPage();
        
        // Setup topbar use fullname, id and roll;
        [$topbarFullname, $topbarRoll, $topbarIcon] =  MyUtilities::topBarUserFullnameRollIcon();

        // Inserting top and side bars
        require './app/views/include/viewBodyUpper.php';
        echo '<main  class="pages pageTransition">';
        
        
    } else {
        echo '<main>';
        MyUtilities::checkCookieAndReturnUser();
    }    
    ?>      

<!-- --------------------------------------------------------------- -->
    <?php
    $pagePath = '';
    switch ($pageName) {

        case 'dashboard':   
            $pagePath = './app/views/viewDashboard.php';
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
    }
    ?>
    <?php include $pagePath; ?>
    

<!-- --------------------------------------------------------------- -->

</main>

</div>

    <?php require './app/views/include/viewBodyScripts.php'; ?>

</body>
</html>