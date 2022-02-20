<section class="clients">
    
    <div class="top-pannel">
        <div class="top-pannel__date top-pannel__date--small"><?= $clientFullname ?></div>
            
        <div class="top-pannel__buttons">
            <a href="<?= $_ENV['BASE_PATH'] ?>/clients" class="btn btn--light">clients</a>
            <a href="<?= $_ENV['BASE_PATH'] ?>/clients-edit<?= $id ?>" class="btn btn--light">update</a>
            <a href="#" class="btn btn--red modalBtn">remove</a>            
        </div>
    </div>
    
    <div class="clients__display">

        <div class="clients__left">

            <?php if ($clientIdCard): ?>
            <h3 class="clients__title"><span></span></h3>
    
            <div class="clients__set">
                <svg class="clients__icon"><use href="./app/static/svg/icomoon.svg#icon-id-card-1"></use></svg>
                <div class="clients__field"><?= $clientIdCard ?></div>
            </div>
            <?php endif ?>


            <?php if ($clinetContact): ?>   
                <h3 class="clients__title"><span>Contacts</span></h3>
            
                 <?php if ($clientEmail): ?>  
                <div class="clients__set">
                    <svg class="clients__icon"><use href="./app/static/svg/icomoon.svg#icon-email-12"></use></svg>
                    <div class="clients__field"><?= $clientEmail ?></div>
                </div>
                <?php endif ?>
        
                
                 <?php if ($clientMobile): ?>  
                <div class="clients__set">
                    <svg class="clients__icon"><use href="./app/static/svg/icomoon.svg#icon-phone-1"></use></svg>
                    <div class="clients__field"><?= $clientMobile ?></div>
                </div>
                <?php endif ?>
        
                
                 <?php if ($clientPhone): ?>  
                <div class="clients__set">
                    <svg class="clients__icon"><use href="./app/static/svg/icomoon.svg#icon-smartphone-3"></use></svg>
                    <div class="clients__field"><?= $clientPhone ?></div>
                </div>
                <?php endif ?>

            <?php endif ?>

            <?php if ($clientAddress): ?>
            <h3 class="clients__title"><span>Address</span></h3>
    
            <div class="clients__set">
                <svg class="clients__icon"><use href="./app/static/svg/icomoon.svg#icon-location-17"></use></svg>
                <div class="clients__field"><?= $clientAddress ?></div>
            </div>
            <?php endif ?>

            <?php if ($clientCompany): ?>
            <h3 class="clients__title"><span>company</span></h3>

            <div class="clients__set">
                <svg class="clients__icon"><use href="./app/static/svg/icomoon.svg#icon-friend-5"></use></svg>
                <div class="clients__field"><?= $clientCompany ?></div>
            </div>
            <?php endif ?>

        </div>
        <div class="clients__right">
        <?php if ($clinetInfo): ?>
            <h3 class="clients__title"><span>Client Info</span></h3>
            <div class="clients__text">
                <?= $clinetInfo ?>
            </div>
        </div>
        <?php endif ?>
    </div>

    
</section>

<section class="modal">
    <div class="modal__content">

        <svg class="modal__close"><use href="./app/static/svg/icomoon.svg#icon-x-mark-thin"></use></svg>

        <div class="modal__title">Delete Confermation </div>

        <div class="modal__question">Are you sure you want to delete this Client?</div>

        <form action="<?= $_ENV['BASE_PATH'] ?>/clients-delete" class="modal__confirmation" method="POST">
            <input type="hidden" name="clientsDeleteList[]" value="<?= $id ?>">
            <button class="btn btn--light modal__cancel" type="button">cancel</button>
            <button class="btn btn--red">Confirm</button>
        </form>

    </div>    
</section>