<!DOCTYPE html>
<html lang="en">

<?php require './app/views/include/header.php'; ?>

<!-- --- Body ------------------------------------------------------ -->

<body>
<div class="content">

    <?php 
    if ($pageName !== 'sign_up' && $pageName !== 'sign_in') {
        require './app/views/include/body_upper.php';
        echo '<main  class="pages pageTransition">';
    } else {
        echo '<main>';
    }    
    ?>  

<!-- --------------------------------------------------------------- -->
    <?php
    $pagePath = '';
    switch ($pageName) {

        case 'dashboard':   
            $pagePath = './app/views/dashboard.php';
            break;  

        case 'projects':
            $pagePath = './app/views/projects/projects.php';
            break;  

        case 'pojects_add':
            $pagePath = './app/views/projects/projects_add.php';
            break;  

        case 'images':
            $pagePath = './app/views/projects/images.php';
            break;            

        case 'clients':
            $pagePath = './app/views/clients/clients.php';
            break;            

        case 'clients_add':
            $pagePath = './app/views/clients/clients_add.php';
            break;    

        case 'sign_up':
            $pagePath = './app/views/sign/sign_up.php';
            break;  

        case 'sign_in':
            $pagePath = './app/views/sign/sign_in.php';
            break;            
    }
    ?>
    <?php include $pagePath; ?>

<!-- --------------------------------------------------------------- -->

</main>

</div>

    <?php require './app/views/include/body_scripts.php'; ?>

</body>
</html>