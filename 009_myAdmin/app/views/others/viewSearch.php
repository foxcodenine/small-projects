<section class="search">

<?php

use app\Model\MyCript;
use app\Model\MyUtilities;

?>

    <!-- /////////////////////////////////////////////////////////// -->
    <!-- Search Clients form -->

    <form id="serch-query-form-client" action="?sortBy=&sortTable=Client&sortOrder=" class="search__query-form" method="POST" novalidate>

        <div class="search__fields" id="search-fields-client">

            <input type="text" class="search__field" placeholder="firstname" name="firstname" value="<?=$firstname?>">
            <input type="text" class="search__field" placeholder="lastname" name="lastname" value="<?=$lastname?>">
            <input type="text" class="search__field" placeholder="id"name="idCard" value="<?=$idCard?>">
            <input type="text" class="search__field" placeholder="company" name="company" value="<?=$company?>">
            <input type="text" class="search__field" placeholder="email" name="email" value="<?=$email?>">
            <input type="text" class="search__field" placeholder="phone / mobile" name="phoneMobile" value="<?=$phoneMobile?>">
            <input type="text" class="search__field search__field--span2" placeholder="street address" name="strAddr" value="<?=$strAddrCli?>">

            <div class=" search__field search__field--select">
                <select class="search__select" id="client" required name="locality">
                    <option value="" selected hidden">Locality...</option>

                    <?php foreach($listLocality as $l): ?>
                        <option value="<?= $l->lName ?>" <?php if ($l->lName === $localityNCli) echo 'selected' ?> >
                            <?= stripslashes($l->lName);  ?>
                        </option>
                    <?php endforeach ?>

                </select>
                <svg class="search__down-arrow">
                    <use xlink:href="./app/static/svg/icomoon.svg#icon-arrow_drop_down"></use>
                </svg>
            </div>
            
            <div class=" search__field search__field--select" >
                <select class="search__select" id="client" required name="country">
                    <option value="" selected hidden">Country...</option>

                    <?php foreach($listCountry as $c): ?>
                        <option value="<?= $c->cName ?>" <?php if ($c->cName === $countryName) echo 'selected' ?> >
                            <?= stripslashes($c->cName);  ?>
                        </option>
                    <?php endforeach ?>

                </select>
                <svg class="search__down-arrow">
                    <use xlink:href="./app/static/svg/icomoon.svg#icon-arrow_drop_down"></use>
                </svg>
            </div>

            <button class="btn btn--dark search__btn--1" type="submit" name="searchBtn" value='client' >search</button>
            <button class="btn btn--light search__btn--2" type="button" id="search-clear-btn-client">clear</button>
        </div>

    </form>

    <!-- /////////////////////////////////////////////////////////// -->
    <!-- Search Project form -->


    <form id="serch-query-form-project" action="?sortBy=&sortTable=Project&sortOrder=" class="search__query-form" method="POST" novalidate>

        <div class="search__fields" id="search-fields-project">
            
            <input type="text" class="search__field search__field--span2" placeholder="Project Name" name="projectname" value="<?=$projectname?>">

            <div class=" search__field search__field--span2 search__field--select" >
                <select class="search__select" id="client" required name="clientId">
                    <option value="" selected hidden">Client...</option>

                    <?php foreach($listClient as $obj): ?>
                        <option value="<?= $obj->id ?>" <?php if ($obj->id === $clientId) echo 'selected' ?> >
                            <?= stripslashes("{$obj->id} - {$obj->firstname} {$obj->lastname}");  ?>
                        </option>
                    <?php endforeach ?>

                </select>
                <svg class="search__down-arrow">
                    <use xlink:href="./app/static/svg/icomoon.svg#icon-arrow_drop_down"></use>
                </svg>
            </div>

            <input type="text" class="search__field " placeholder="Street Address" name="strAddr" value="<?=$strAddrPro?>" >
            

            <div class=" search__field search__field--select">
                <select class="search__select" id="client" required name="localityName">
                    <option value="" selected hidden">Locality...</option>

                    <?php foreach($listLocality as $l): ?>
                        <option value="<?= $l->lName ?>" <?php if ( $l->lName === $localityNPro ) echo 'selected' ?> > 
                            <?= stripslashes($l->lName);  ?> 
                        </option>
                    <?php endforeach ?>
                    
                </select>
                <svg class="search__down-arrow">
                    <use xlink:href="./app/static/svg/icomoon.svg#icon-arrow_drop_down"></use>
                </svg>
            </div>


            <input type="text" class="search__field" placeholder="Project No" name="projectNo" value="<?=$projectNo?>">
            <input type="text" class="search__field" placeholder="PA No" name="paNo" value="<?=$paNo?>" >

            <div class=" search__field  search__field--select">
                <select class="search__select" id="client" required name="stageName">
                    <option value="" selected hidden">Stage...</option>

                    <?php foreach($listStage as $s): ?>
                        <option value="<?= $s->sName ?>" <?php if ( $s->sName === $stageName ) echo 'selected' ?> > 
                            <?= stripslashes($s->sName);  ?>
                        </option>
                    <?php endforeach ?>

                </select>
                <svg class="search__down-arrow">
                    <use xlink:href="./app/static/svg/icomoon.svg#icon-arrow_drop_down"></use>
                </svg>
            </div>
            
            <div class=" search__field  search__field--select" >
                <select class="search__select" id="client"  required name="categoryName">
                    <option value="" selected hidden">Category...</option>

                    <?php foreach($listCategory as $y): ?>
                        <option value="<?= $y->yName ?>" <?php if ( $y->yName === $categoryName ) echo 'selected' ?> >  
                            <?= stripslashes($y->yName);  ?>
                        </option>
                    <?php endforeach ?>

                </select>
                <svg class="search__down-arrow">
                    <use xlink:href="./app/static/svg/icomoon.svg#icon-arrow_drop_down"></use>
                </svg>
            </div>



            <button class="btn btn--dark search__btn--1" type="submit" name="searchBtn" value='project' >search</button>
            <button class="btn btn--light search__btn--2" type="button" id="search-clear-btn-project">clear</button>

        </div>

        

    </form>

    <!-- /////////////////////////////////////////////////////////// -->

    <form  action=""  class="search__form" method="POST">

    <!-- 1 --------------------------------------------------------- -->

        <div class="top-pannel">
                <div class="top-pannel__date"><b>search</b></div>

            <div class="top-pannel__buttons">
                <a href="<?= $_ENV['BASE_PATH'] ?>/clients-add" class="btn btn--light">add new client</a>
                <button class="btn btn--red modalBtn searchRemoveBtn" type="button">remove client</button>
            </div>
        </div>


    <!-- 2 --------------------------------------------------------- -->


        <div   id="search-tabs"         class="search__tabs" >
            <a id="search-client-tab"   class="search__tab search__tab--active" >Clients</a>
            <a id="search-project-tab"  class="search__tab search__tab--active" >Projects</a>
        </div>

    <!-- 3 --------------------------------------------------------- -->


        <div class="search__errors" id="search-errors-client">
            <!-- clients error placeholder! .... clients error placeholder! .... -->
            <?php echo $clientErrorMessage ?>
        </div>

        <div class="search__errors" id="search-errors-project">
            <!-- projects error placeholder! .... projects error placeholder! .... -->
            <?php echo $projectErrorMessage ?>
        </div>

        
    <!-- 4 --------------------------------------------------------- -->

        <div class="search__placeholder"></div>

    <!-- 5 --------------------------------------------------------- -->


        <?php require './app/views/tables/viewClientsTable.php'?>
        <?php require './app/views/tables/viewProjectsTable.php'?>


    <!-- 6 --------------------------------------------------------- -->

        <section class="modal">
            <div class="modal__content">

                <svg class="modal__close"><use href="./app/static/svg/icomoon.svg#icon-x-mark-thin"></use></svg>

                <div class="modal__title">Delete Confermation </div>

                <p style="display: none;" class="modal-hidden-message-js">Are you sure you want to delete these Projects?</p>

                <div class="modal__question modal-question-js">Are you sure you want to delete these Projects?</div>

                <div  class="modal__confirmation" method="POST">
                                   
                    <button class="btn btn--light modal__cancel" type="button">cancel</button>
                    <button class="btn btn--red myLoaderBtn" >Confirm</button>
                </div>

            </div>    
        </section>

    </form>

    <?php // echo '<br> Clients:  '; if(isset($testDataClient)) print_r($testDataClient) ?>
    <?php // echo '<br> Projects: '; if(isset($testDataProject)) print_r($testDataProject) ?>


    <!-- /////////////////////////////////////////////////////////// -->

</section>