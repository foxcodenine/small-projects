<section class="dashboard">
<form action=""  class="dashboard__form" method="POST">

    <div class="top-pannel">
        <div class="top-pannel__date dashboardDate-js">Wed, 12 Aug <b>10:24PM</b></div>
            
        <div class="top-pannel__buttons">
            <a href="<?= $_ENV['BASE_PATH'] ?>?dashboard%5BchangeDisplay%5D=1" class="btn btn--light"><?= $_SESSION['dashboard']['display'] ?></a>
            <?php if ($_SESSION['dashboard']['display'] !== 'Hosted'):?>
                <button class="btn btn--light" name="dashboardBtn" value="add">Add</button>
            <?php endif ?>
            <?php if ($_SESSION['dashboard']['display'] !== 'Hidden'):?>
                <button class="btn btn--light" name="dashboardBtn" value="remove">Remove</button>
            <?php endif ?>
            <button class="btn btn--light modalBtn" type="button" >Delete</button>
        </div>
    </div> 

    <!-- ----------------------------------------------------------- -->
    
    <?php foreach ($projectList as $p): ?>

    <div class="frame lazy_dash_js">
        
        <a href="#">
            <img class="frame__img" 
                 src="<?= $p->getThumbnail() ?>" 
                 onerror="this.src='<?= './app/static/images/image_not_found.png' ?>'" 
                 alt=""
            >
        </a>
        <div class="frame__box">
            <p class="frame__name">
                <span class="frame--top"><?= stripslashes($p->getProjectname()) ?></span>
                <span class="frame--bot"><?= stripslashes($p->getLocalityName()) ?></span>
            </p>                       


            <a href="<?= $_ENV['BASE_PATH'] ?>/projects-edit<?= $p->getId() ?>" class="icon__link">
                <svg class="icon__svg"> <use xlink:href="./app/static/svg/icomoon.svg#icon-pencil-10"></use></svg>
            </a>

            <a href="<?= $_ENV['BASE_PATH'] ?>/projects-images-<?= $p->getId() ?>" class="icon__link">
                <svg class="icon__svg"><use xlink:href="./app/static/svg/icomoon.svg#icon-camers-7"></use></svg>
            </a>

            <label class="checkbox-2" >
                <input type="checkbox" class="checkbox-2__input" name="dashboardProject[]" value="<?= $p->getId() ?>" >
                <svg class="checkbox-2__icon checkbox-2__icon--unchecked"><use href="./app/static/svg/icomoon.svg#icon-checkbox-6"></use></svg>
                <svg class="checkbox-2__icon checkbox-2__icon--checked"><use href="./app/static/svg/icomoon.svg#icon-checkbox-3"></use></svg>
            </label>
    
        </div>
    </div>    
    <?php endforeach ?>     
    <!-- ----------------------------------------------------------- -->




</section>


<section class="modal">
    <div class="modal__content">

        <svg class="modal__close"><use href="./app/static/svg/icomoon.svg#icon-x-mark-thin"></use></svg>

        <div class="modal__title">Delete Confermation </div>

        <!-- <p style="display: none;" class="modal-hidden-message-js">Are you sure you want to delete these Projects?</p> -->

        <div class="modal__question modal-question-js">Are you sure you want to delete these Projects?</div>

        <div  class="modal__confirmation" method="POST">        
            
            <button class="btn btn--light modal__cancel" type="button">cancel</button>
            <button class="btn btn--red myLoaderBtn" name="dashboardBtn" value="delete" >Confirm</button>
        </div>

    </div>    
</section>

</form>


