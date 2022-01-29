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
<!-- ------------------------------------------------------- -->


<section class="clients">
<form action="#"  class="clients__form">

    <div class="top-pannel">
        <div class="top-pannel__date"><b>CLIENTS</b> List</div>
            
        <div class="top-pannel__buttons">
            <a href="#" class="btn btn--light">add new client</a>
            <button class="btn btn--red">remove client</button>
        </div>
    </div>
    
    <div class="table__container" id="table-container">

        <table class="table ">
            <thead class="table__thead ">
                <th class="table__th">chk</th>
                <th class="table__th">btn-s</th>
                <th class="table__th">db id</th>
                <th class="table__th">firstname</th>
                <th class="table__th">lastname</th>
                <th class="table__th">ID No</th>
                <th class="table__th">company</th>
                <th class="table__th">client No</th>
                <th class="table__th">phone</th>
                <th class="table__th">mobile</th>
                <th class="table__th">street address</th>
                <th class="table__th">locality</th>
                <th class="table__th">country</th>
                <th class="table__th">postcode</th>
            </thead>
            
            <tbody class="table__tbody">
                <!--  -->
                <tr class="table__tr table__tr--1">

                    <td class="table__td">
                    <label class="checkbox-2" >
                        <input type="checkbox" class="checkbox-2__input">
                        <svg class="checkbox-2__icon checkbox-2__icon--unchecked"><use href="../static/svg/icomoon.svg#icon-checkbox-6"></use></svg>
                        <svg class="checkbox-2__icon checkbox-2__icon--checked"><use href="../static/svg/icomoon.svg#icon-checkbox-3"></use></svg>
                    </label>
                    </td>

                    <td class="table__td">
                        <a href="#" class="icon__link" id="table-icon-update">
                            <svg class="icon__svg"> <use xlink:href="../static/svg/icomoon.svg#icon-pencil-10"></use></svg>
                        </a>
                        <a href="#" class="icon__link" id="table-icon-details">
                            <svg class="icon__svg"> <use xlink:href="../static/svg/icomoon.svg#icon-view-12"></use></svg>
                        </a>
                        <a href="#" class="icon__link" id="table-icon-remove">
                            <svg class="icon__svg"> <use xlink:href="../static/svg/icomoon.svg#icon-minus-4"></use></svg>
                        </a>
                    </td>

                    <td class="table__td">1</td>
                    <td class="table__td">Christopher</td>
                    <td class="table__td">Farrugia</td>
                    <td class="table__td">397284m</td>
                    <td class="table__td">foxcode.io</td>
                    <td class="table__td">0123</td>
                    <td class="table__td">79124578</td>
                    <td class="table__td">21875421</td>
                    <td class="table__td">64 'Koala' St Andrew Street</td>
                    <td class="table__td">Birzebbugia</td>
                    <td class="table__td">Malta</td>
                    <td class="table__td">BBG 2232</td>
                </tr>
                <!--  -->
                <tr class="table__tr table__tr--2">

                    <td class="table__td">
                    <label class="checkbox-2" >
                        <input type="checkbox" class="checkbox-2__input">
                        <svg class="checkbox-2__icon checkbox-2__icon--unchecked"><use href="../static/svg/icomoon.svg#icon-checkbox-6"></use></svg>
                        <svg class="checkbox-2__icon checkbox-2__icon--checked"><use href="../static/svg/icomoon.svg#icon-checkbox-3"></use></svg>
                    </label>
                    </td>

                    <td class="table__td">
                        <a href="#" class="icon__link" id="table-icon-update">
                            <svg class="icon__svg"> <use xlink:href="../static/svg/icomoon.svg#icon-pencil-10"></use></svg>
                        </a>
                        <a href="#" class="icon__link" id="table-icon-details">
                            <svg class="icon__svg"> <use xlink:href="../static/svg/icomoon.svg#icon-view-12"></use></svg>
                        </a>
                        <a href="#" class="icon__link" id="table-icon-remove">
                            <svg class="icon__svg"> <use xlink:href="../static/svg/icomoon.svg#icon-minus-4"></use></svg>
                        </a>
                    </td>

                    <td class="table__td">2</td>
                    <td class="table__td">Tania</td>
                    <td class="table__td">Cardona</td>
                    <td class="table__td">785612m</td>
                    <td class="table__td">Gauchi Office</td>
                    <td class="table__td">0457</td>
                    <td class="table__td">79189562</td>
                    <td class="table__td">21785612</td>
                    <td class="table__td">92 'Night' St Paul street</td>
                    <td class="table__td">Zebbug</td>
                    <td class="table__td">Malta</td>
                    <td class="table__td">ZBG 0055</td>
                </tr>
                <!--  -->
                <tr class="table__tr table__tr--1">

                    <td class="table__td">
                    <label class="checkbox-2" >
                        <input type="checkbox" class="checkbox-2__input">
                        <svg class="checkbox-2__icon checkbox-2__icon--unchecked"><use href="../static/svg/icomoon.svg#icon-checkbox-6"></use></svg>
                        <svg class="checkbox-2__icon checkbox-2__icon--checked"><use href="../static/svg/icomoon.svg#icon-checkbox-3"></use></svg>
                    </label>
                    </td>

                    <td class="table__td">
                        <a href="#" class="icon__link" id="table-icon-update">
                            <svg class="icon__svg"> <use xlink:href="../static/svg/icomoon.svg#icon-pencil-10"></use></svg>
                        </a>
                        <a href="#" class="icon__link" id="table-icon-details">
                            <svg class="icon__svg"> <use xlink:href="../static/svg/icomoon.svg#icon-view-12"></use></svg>
                        </a>
                        <a href="#" class="icon__link" id="table-icon-remove">
                            <svg class="icon__svg"> <use xlink:href="../static/svg/icomoon.svg#icon-minus-4"></use></svg>
                        </a>
                    </td>

                    <td class="table__td">3</td>
                    <td class="table__td">Dorothy</td>
                    <td class="table__td">Cassar</td>
                    <td class="table__td">0145785m</td>
                    <td class="table__td"></td>
                    <td class="table__td">0211</td>
                    <td class="table__td">79784515</td>
                    <td class="table__td">21748596</td>
                    <td class="table__td">74 'Woodland' Poetry street</td>
                    <td class="table__td">Qormi</td>
                    <td class="table__td">Malta</td>
                    <td class="table__td">QRM 0055</td>
                </tr>
                <!--  -->
                <tr class="table__tr table__tr--2">

                    <td class="table__td">
                    <label class="checkbox-2" >
                        <input type="checkbox" class="checkbox-2__input">
                        <svg class="checkbox-2__icon checkbox-2__icon--unchecked"><use href="../static/svg/icomoon.svg#icon-checkbox-6"></use></svg>
                        <svg class="checkbox-2__icon checkbox-2__icon--checked"><use href="../static/svg/icomoon.svg#icon-checkbox-3"></use></svg>
                    </label>
                    </td>

                    <td class="table__td">
                        <a href="#" class="icon__link" id="table-icon-update">
                            <svg class="icon__svg"> <use xlink:href="../static/svg/icomoon.svg#icon-pencil-10"></use></svg>
                        </a>
                        <a href="#" class="icon__link" id="table-icon-details">
                            <svg class="icon__svg"> <use xlink:href="../static/svg/icomoon.svg#icon-view-12"></use></svg>
                        </a>
                        <a href="#" class="icon__link" id="table-icon-remove">
                            <svg class="icon__svg"> <use xlink:href="../static/svg/icomoon.svg#icon-minus-4"></use></svg>
                        </a>
                    </td>

                    <td class="table__td">4</td>
                    <td class="table__td">Danine</td>
                    <td class="table__td">Bartolo</td>
                    <td class="table__td">998745m</td>
                    <td class="table__td"></td>
                    <td class="table__td">0021</td>
                    <td class="table__td">99254715</td>
                    <td class="table__td">21784698</td>
                    <td class="table__td">61, St John street </td>
                    <td class="table__td">Valletta</td>
                    <td class="table__td">Malta</td>
                    <td class="table__td">VAL 4512</td>
                </tr>
              
       
            </tbody>
        </table>
    </div>

</form>
</section>










<!-- ------------------------------------------------------- -->
        </main>
<!-- ------------------------------------------------------- -->
    </div>
    <script src="../static/js/ck-editor/ckeditor.js"></script>
    <script src="../static/js/vanillajs-datepicker/datepicker-full.min.js"></script>
    <script src="../static/js/tippy-js/popper.min.js"></script>
    <script src="../static/js/tippy-js/tippy-bundle.umd.min.js"></script>
    <script src="../static/js/script.js"></script>
</body>
</html>