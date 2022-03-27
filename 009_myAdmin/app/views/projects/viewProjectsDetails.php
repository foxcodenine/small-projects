<section class="pro_details">

    <div class="pro_details__container">

        <!-- <div class="pro_details__topbar">&nbsp;</div> -->


    
        <img class="pro_details__cover" src="<?= $pro->getCover() ?>" alt="">

        <div class="pro_details__group">
            <h3 class="pro_details__name"><?= $projectName ?></h3>
            <h3 class="pro_details__address"><?= $addressStr ?></h3>
            <h3 class="pro_details__client"><?= $pro->fetchClientName() ?></h3>

            <div class="pro_details__numbers">
                <?= $numberStr ?>
            </div>

            <div class="pro_details__date">
                <svg class="pro_details__icon icon__svg"> <use xlink:href="./app/static/svg/icomoon.svg#icon-clock-thin"></use></svg>
                <span>&nbsp; <?= $projectDate ?></span>
                
            </div>

            <form class="pro_details__btn" method="POST">
                <a href="<?= $projectEditLink ?>" class="btn btn--light">Edit</a>
                <a href="<?= $projectImgsLink ?>" class="btn btn--light">Images</a>
                <a href="<?= $projectsLink?>" class="btn btn--light">Projects</a>                
                <button class="btn btn--light" type="submit" name="proDetailsHostBtn" value="1"><?= $hostBtn ?></button>
            </form>
        </div>

        <?php echo $projectContent?> 
</section>