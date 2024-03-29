<!-- --- Topbar ---------------------------------------------------- -->

<div class="topbar">            
    <a class="topbar__logobox" href="<?= $_ENV['BASE_PATH'] ?>">
        <span><b>MY</b>Admin</span>
    </a>

    <!-- <div class="topbar__up-in">
        <a href="#">Sign-in</a>
        /
        <a href="#">Sign-up</a>
    </div>  -->

    <div class="topbar__name">
        <span class="topbar__name-upper"><?= $topbarFullname ?? ' &nbsp; &nbsp; ' ?></span>
        <span class="topbar__name-lower"><?= $topbarRoll ?? ' &nbsp; &nbsp; ' ?></span>
    </div>

    <div class="topbar__dropdown" id="topbar-dropdown">
        <div class="topbar__pic"><?= $topbarIcon ?? '&nbsp;&nbsp;' ?></div>
        <svg class="topbar__arrow">
            <use  xlink:href="./app/static/svg/icomoon.svg#icon-arrow_drop_down"></use>
        </svg>
    </div>

</div>

<!-- --- Dropdown menu --------------------------------------------- -->

<div class="dropdownmenu dropdownmenu--1 display_none" id="dropdownmenu-1">

    <ul class="dropdownmenu__list">
        <li class="dropdownmenu__item">
            <a href="./settings" class="dropdownmenu__link">
                <svg class="dropdownmenu__icon"><use  xlink:href="./app/static/svg/icomoon.svg#icon-gears"></use></svg>
                Settings 
            </a>
        </li>
        <li class="dropdownmenu__item">
            <a href="./terms" class="dropdownmenu__link">
                <svg class="dropdownmenu__icon"><use  xlink:href="./app/static/svg/icomoon.svg#icon-warning-thin"></use></svg>
                Terms      
            </a>
        </li>
        <li class="dropdownmenu__item">
            <a href="./landing-site" class="dropdownmenu__link">
                <svg class="dropdownmenu__icon"><use  xlink:href="./app/static/svg/icomoon.svg#icon-light-bulb-thin"></use></svg>
                Landing Site
            </a>
        </li>
        <li class="dropdownmenu__item">
            <a href="./sign-out" class="dropdownmenu__link">
                <svg class="dropdownmenu__icon"><use  xlink:href="./app/static/svg/icomoon.svg#icon-expand"></use></svg>
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

<!-- --- Sidemenu -------------------------------------------------- -->

<div class="sidemenu" id="sidemenu" disabled>
    
    <a href="<?= $_ENV['BASE_PATH'] ?>" class="sidemenu__item">              
        <svg class="sidemenu__icon"><use xlink:href="./app/static/svg/icomoon.svg#icon-home"></use></svg>  
        <div class="sidemenu__text">Dashbord</div>
    </a>
    
    <a href="<?= $_ENV['BASE_PATH'] ?>/search" class="sidemenu__item">              
        <svg class="sidemenu__icon"><use xlink:href="./app/static/svg/icomoon.svg#icon-telescope"></use></svg>  
        <div class="sidemenu__text">Search</div>
    </a>

    <div class="sidemenu__line"></div>

    <a href="<?= $_ENV['BASE_PATH'] ?>/clients" class="sidemenu__item sidemenu__close">                
        <svg class="sidemenu__icon"><use xlink:href="./app/static/svg/icomoon.svg#icon-strategy"></use></svg>              
        <div class="sidemenu__text">Clients</div>
    </a>

    <a href="<?= $_ENV['BASE_PATH'] ?>/clients-add" class="sidemenu__item sidemenu__close">                
        <svg class="sidemenu__icon"><use xlink:href="./app/static/svg/icomoon.svg#icon-plus"></use></svg>              
        <div class="sidemenu__text">Add&nbsp;Client</div>
    </a>

    <div class="sidemenu__line"></div>

    <a href="<?= $_ENV['BASE_PATH'] ?>/projects" class="sidemenu__item sidemenu__close">                
        <svg class="sidemenu__icon"><use xlink:href="./app/static/svg/icomoon.svg#icon-circle-compass"></use></svg>              
        <div class="sidemenu__text">Projects</div>
    </a>

    <a href="<?= $_ENV['BASE_PATH'] ?>/projects-add" class="sidemenu__item sidemenu__close">                
        <svg class="sidemenu__icon"><use xlink:href="./app/static/svg/icomoon.svg#icon-plus"></use></svg>              
        <div class="sidemenu__text">Add&nbsp;Project</div>
    </a>

    <div class="sidemenu__line"></div>

    <a href="<?= $_ENV['BASE_PATH'] ?>/category" class="sidemenu__item sidemenu__close">                
        <svg class="sidemenu__icon"><use xlink:href="./app/static/svg/icomoon.svg#icon-layers"></use></svg>              
        <div class="sidemenu__text">Category</div>
    </a>

    <a href="<?= $_ENV['BASE_PATH'] ?>/stage"" class="sidemenu__item sidemenu__close">                
        <svg class="sidemenu__icon"><use xlink:href="./app/static/svg/icomoon.svg#icon-linegraph"></use></svg>              
        <div class="sidemenu__text">Stage</div>
    </a>

    <a href="<?= $_ENV['BASE_PATH'] ?>/locality"" class="sidemenu__item sidemenu__close">                
        <svg class="sidemenu__icon"><use xlink:href="./app/static/svg/icomoon.svg#icon-map-pin"></use></svg>              
        <div class="sidemenu__text">Locality</div>
    </a>    

    <a href="<?= $_ENV['BASE_PATH'] ?>/country"" class="sidemenu__item sidemenu__close">                
        <svg class="sidemenu__icon sidemenu__icon--thin"><use xlink:href="./app/static/svg/icomoon.svg#icon-glob-thin"></use></svg>              
        <div class="sidemenu__text">Country</div>
    </a>    
    
    <div class="sidemenu__line sidemenu__line--last"></div>

</div>

<!-- ------------------------------------------------------- -->

<!-- <div class="timer" id="timer">Your session will expire in 05:12:55</div> -->

<!-- ------------------------------------------------------- -->