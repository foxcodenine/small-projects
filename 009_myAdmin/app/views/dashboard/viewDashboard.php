<section class="dashboard">
<form action="#"  class="dashboard__form">

    <div class="top-pannel">
        <div class="top-pannel__date">Wed, 12 Aug <b>10:24PM</b></div>
            
        <div class="top-pannel__buttons">
            <a href="<?= $_ENV['BASE_PATH'] ?>?dashboard%5BchangeDisplay%5D=1" class="btn btn--light"><?= $_SESSION['dashboard']['display'] ?></a>
            <button class="btn btn--light">Add</button>
            <button class="btn btn--light">Remove</button>
            <button class="btn btn--light">Delete</button>
        </div>
    </div> 

    <!-- ----------------------------------------------------------- -->
    
    <?php foreach ($projectList as $p): ?>

    <div class="frame">
        
        <img class="frame__img" src="<?= $p->getThumbnail() ?>" alt="">
        <div class="frame__box">
            <p class="frame__name">
                <span class="frame--top"><?= $p->getProjectname() ?></span>
                <span class="frame--bot"><?= $p->getLocalityName() ?></span>
            </p>                       


            <a href="#" class="icon__link">
                <svg class="icon__svg"> <use xlink:href="./app/static/svg/icomoon.svg#icon-pencil-10"></use></svg>
            </a>

            <a href="<?= $_ENV['BASE_PATH'] ?>/projects-images-<?= $p->getId() ?>" class="icon__link">
                <svg class="icon__svg"><use xlink:href="./app/static/svg/icomoon.svg#icon-camers-7"></use></svg>
            </a>

            <label class="checkbox-2" >
                <input type="checkbox" class="checkbox-2__input">
                <svg class="checkbox-2__icon checkbox-2__icon--unchecked"><use href="./app/static/svg/icomoon.svg#icon-checkbox-6"></use></svg>
                <svg class="checkbox-2__icon checkbox-2__icon--checked"><use href="./app/static/svg/icomoon.svg#icon-checkbox-3"></use></svg>
            </label>
    
        </div>
    </div>    
    <?php endforeach ?>     
    <!-- ----------------------------------------------------------- -->

</form>
</section>
