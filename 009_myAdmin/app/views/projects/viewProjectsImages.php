<section class="images">
<form action="<?= $_ENV['BASE_PATH'] . '/projects-upload-img-' . $currentProject->getId() ?>"   method="POST" class="images__form" enctype="multipart/form-data" >

    <div class="top-pannel">
        <div class="top-pannel__date"><?= $currentProject->getProjectname() ?> </div>          
     
        
        <div class="images__upload-box">
        
            <input  class="images__input" type="file" id="upload-images" name="projectImages[]" multiple>
            <button class="images__btn myLoaderBtn" >
                <svg class="images__icon"><use href="./app/static/svg/icomoon.svg#icon-upload-10"></use></svg>
            </button>
        </div>
        <div class="images__massage">
        The maximum number of images per project is 24. Maximum image file size is 2M.
        </div>

    </div>    
    
    <!-- ----------------------------------------------------------- -->

    <?php foreach($projectImages as $image ): ?>
        
        <div    class="image__frame lazy_img_js <?php if ($image->getCover()) echo 'image__frame--cover' ?>" 
                id="image-<?= $image->getId()?>" 
                test='<?= $image->getCode() ?>' >  
        
            
    
            <a href="#" class="image__link">
                <img class="image__img  " 
                src="<?= $image->getThumbnail() ?>" 
                onerror="this.src='<?= './app/static/images/image_not_found.png' ?>'" alt=""
                >
            </a>
            
            <input type="checkbox" class="image__checkbox" id="image-checkbox-<?= $image->getId() ?>">
    
            <label class="image__menu image__menu--open" id="image-1-menu" for="image-checkbox-<?=$image->getId()?>">
                <svg class="image__menu--open"><use href="./app/static/svg/icomoon.svg#icon-menu-thin"></use></svg>
            </label>
    
            <label class="image__menu image__menu--close" id="image-1-menu" for="image-checkbox-<?= $image->getId() ?>">
                <svg class="image__menu--open"><use href="./app/static/svg/icomoon.svg#icon-x-mark-thin"></use></svg>
            </label>
    
            <div class="dropdownmenu dropdownmenu--2 image__dopdownmenu" id="image-<?= $image->getId() ?>-dropdownmenu">
    
                <ul class="dropdownmenu__list">
    
                    <li class="dropdownmenu__item">
                        <a href="<?= $image->getUrlPath() ?>" class="dropdownmenu__link">
                            <svg class="dropdownmenu__icon"><use  xlink:href="./app/static/svg/icomoon.svg#icon-save-thin"></use></svg>
                             Download                
                        </a>
                    </li>
                    <li class="dropdownmenu__item">
                        <a 
                            href="<?= $_ENV['BASE_PATH'] . '/projects-images-' . $currentProject->getId() . '?setAsProjectCover=' . $image->getId()?>" 
                            class="dropdownmenu__link myLoaderBtn">
                            <svg class="dropdownmenu__icon"><use  xlink:href="./app/static/svg/icomoon.svg#icon-picture-thin"></use></svg>
                            Make Project Cover                
                        </a>
                    </li>
                    <li class="dropdownmenu__item">
                        <a deleteLink="<?= $_ENV['BASE_PATH'] . '/projects-remove-img-' . $image->getProjectId() . '-' . $image->getCode() . '-' . $image->getCover() ?>" 
                            class="dropdownmenu__link modalBtn">
                            <svg class="dropdownmenu__icon"><use  xlink:href="./app/static/svg/icomoon.svg#icon-trash-can-thin"></use></svg>
                            Delete Image      
                        </a>
                    </li>
                </ul>
                
            </div>
    
            <div class="image__arrow">
                <a href="<?= $_ENV['BASE_PATH'] . '/projects-images-' . $currentProject->getId() . '?imgSwap%5Bid%5D=' . $image->getId() . '&imgSwap%5Bdir%5D=prev'?>" 
                    class="image__arrow--left">
                    <svg class="image__arrow-icon"><use href="./app/static/svg/icomoon.svg#icon-triangle-4"></use></svg>
                </a>
                <a href="<?= $_ENV['BASE_PATH'] . '/projects-images-' . $currentProject->getId() . '?imgSwap%5Bid%5D=' . $image->getId() . '&imgSwap%5Bdir%5D=next'?>" 
                    class="image__arrow--right">
                    <svg class="image__arrow-icon"><use href="./app/static/svg/icomoon.svg#icon-triangle-4"></use></svg>
                </a>      
                
            </div>
        </div>      
    
        <?php endforeach; ?>

    <!-- ----------------------------------------------------------- -->          

</form>
</section>



<section class="modal">
    <div class="modal__content">

        <svg class="modal__close"><use href="./app/static/svg/icomoon.svg#icon-x-mark-thin"></use></svg>

        <div class="modal__title">Delete Confermation </div>

        <p style="display: none;" class="modal-hidden-message-js">Are you sure you want to delete these Projects?</p>

        <div class="modal__question modal-question-js">Are you sure you want to delete this image?</div>

        <div  class="modal__confirmation" method="POST">
        
            
            <button class="btn btn--light modal__cancel" type="button">cancel</button>
            <a href="" class="btn btn--red myLoaderBtn" id="modalDeleteLink-js">Confirm</a>
        </div>

    </div>    
</section>
