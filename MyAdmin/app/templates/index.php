<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../static/css/datepicker.min.css">
    <link rel="stylesheet" href="../static/css/style.css">
    <title>MyAdmin</title>
</head>
<body>
    <div class="content">

        <!-- ------------------------------------------------------- -->

        <div class="topbar">            
            <a class="topbar__logobox" href="#">
                <span><b>MY</b>Admin</span>
            </a>

            <!-- <div class="topbar__up-in">
                <a href="#">Sign-in</a>
                /
                <a href="#">Sign-up</a>
            </div>  -->

            <div class="topbar__name">
                <span class="topbar__name-upper">Joseph Falzon</span>
                <span class="topbar__name-lower">Architect</span>
            </div>

            <div class="topbar__dropdown" id="topbar-dropdown">
                <div class="topbar__pic">JF</div>
                <svg class="topbar__arrow">
                    <use  xlink:href="../static/svg/icomoon.svg#icon-arrow_drop_down"></use>
                </svg>
            </div>

        </div>

        <!-- ------------------------------------------------------- -->

        <div class="dropdownmenu dropdownmenu--1 display_none" id="dropdownmenu-1">

            <ul class="dropdownmenu__list">
                <li class="dropdownmenu__item">
                    <a href="#" class="dropdownmenu__link">
                        <svg class="dropdownmenu__icon"><use  xlink:href="../static/svg/icomoon.svg#icon-gears"></use></svg>
                        Settings      
                    </a>
                </li>
                <li class="dropdownmenu__item">
                    <a href="./sign_in.html" class="dropdownmenu__link">
                        <svg class="dropdownmenu__icon"><use  xlink:href="../static/svg/icomoon.svg#icon-expand"></use></svg>
                         Logout                
                    </a>
                </li>
            </ul>
            
        </div>

        <!-- ------------------------------------------------------- -->

        <div class="menu-btn" id="menu-btn">
            <div class="menu-btn__line"></div>              
            <div class="menu-btn__line"></div>              
            <div class="menu-btn__line"></div>              
        </div>

        <!-- ------------------------------------------------------- -->

        <div class="sidemenu" id="sidemenu" >
            
            <a href="#" class="sidemenu__item">              
                <svg class="sidemenu__icon"><use xlink:href="../static/svg/icomoon.svg#icon-home"></use></svg>  
                <div class="sidemenu__text">Dashbord</div>
            </a>
            
            <a href="#" class="sidemenu__item">              
                <svg class="sidemenu__icon"><use xlink:href="../static/svg/icomoon.svg#icon-telescope"></use></svg>  
                <div class="sidemenu__text">Search</div>
            </a>

            <div class="sidemenu__line"></div>

            <a href="#" class="sidemenu__item sidemenu__close">                
                <svg class="sidemenu__icon"><use xlink:href="../static/svg/icomoon.svg#icon-strategy"></use></svg>              
                <div class="sidemenu__text">Clients</div>
            </a>

            <a href="#" class="sidemenu__item sidemenu__close">                
                <svg class="sidemenu__icon"><use xlink:href="../static/svg/icomoon.svg#icon-plus"></use></svg>              
                <div class="sidemenu__text">Add&nbsp;Client</div>
            </a>

            <div class="sidemenu__line"></div>

            <a href="#" class="sidemenu__item sidemenu__close">                
                <svg class="sidemenu__icon"><use xlink:href="../static/svg/icomoon.svg#icon-circle-compass"></use></svg>              
                <div class="sidemenu__text">Projects</div>
            </a>

            <a href="#" class="sidemenu__item sidemenu__close">                
                <svg class="sidemenu__icon"><use xlink:href="../static/svg/icomoon.svg#icon-plus"></use></svg>              
                <div class="sidemenu__text">Add&nbsp;Project</div>
            </a>

            <div class="sidemenu__line"></div>

            <a href="#" class="sidemenu__item sidemenu__close">                
                <svg class="sidemenu__icon"><use xlink:href="../static/svg/icomoon.svg#icon-layers"></use></svg>              
                <div class="sidemenu__text">Categories</div>
            </a>

            <a href="#" class="sidemenu__item sidemenu__close">                
                <svg class="sidemenu__icon"><use xlink:href="../static/svg/icomoon.svg#icon-linegraph"></use></svg>              
                <div class="sidemenu__text">Status</div>
            </a>

            <a href="#" class="sidemenu__item sidemenu__close">                
                <svg class="sidemenu__icon"><use xlink:href="../static/svg/icomoon.svg#icon-map-pin"></use></svg>              
                <div class="sidemenu__text">Locations</div>
            </a>            

        </div>

        <!-- ------------------------------------------------------- -->

        <main class="pages">

            <?php 
            //  include 'dashboard.html' 
            ?>
            <?php 
            //  include 'projects_form.html' 
            ?>
            <?php 
            //  include 'clients_form.html' 
             ?>
            <?php  
            //  include 'clients.html' 
            ?>
            <?php  
            //  include 'projects.html' 
            ?>
            <?php  
            //  include 'modal_box.html' 
            ?>
            <?php  
            //  include 'group.html' 
            ?>
            <?php  
             include 'images.html' 
            ?>

        </main>

    </div>
    <script src="../static/js/ck-editor/ckeditor.js"></script>
    <script src="../static/js/vanillajs-datepicker/datepicker-full.min.js"></script>
    <script src="../static/js/tippy-js/popper.min.js"></script>
    <script src="../static/js/tippy-js/tippy-bundle.umd.min.js"></script>
    <script src="../static/js/script.js"></script>
</body>
</html>