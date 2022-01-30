<!DOCTYPE html>
<html lang="en">

<?php require './app/views/include/header.php'; ?>

<!-- --- Body ------------------------------------------------------ -->

<body>
<div class="content">

    <?php require './app/views/include/body_upper.php'; ?>   

<main  id="swup" class="transition-fade pages">

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
    }
    ?>
    <?php include $pagePath; ?>

<!-- --------------------------------------------------------------- -->

</main>

</div>

    <?php require './app/views/include/body_scripts.php'; ?>

</body>
</html>