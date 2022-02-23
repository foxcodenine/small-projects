<section class="images">
<form action="<?= $_ENV['BASE_PATH'] . '/projects-upload-' . $currentProject->getId() ?>"  class="images__form" method="POST" enctype="multipart/form-data" >

    <div class="top-pannel">
        <div class="top-pannel__date"><b>Sirens St Paul Bay</b></div>          
     
        
        <div class="images__upload-box">
        
            <input  class="images__input" type="file" id="files" name="projectsImages[]" multiple>
            <button class="images__btn">
                <svg class="images__icon"><use href="./app/static/svg/icomoon.svg#icon-upload-10"></use></svg>
            </button>
        </div>
        <div class="placeholder"></div>
        <div class="field__error"></div>

    </div>    
    
    <!-- ----------------------------------------------------------- -->

    <?php foreach($projectImages as $image ): ?>
        
        <div class="image__frame" id="image-<?= $image->id?>">  
        
            
    
            <a href="#" class="image__link">
                <img class="image__img" src="<?= $image->urlPath ?>" alt="">
            </a>
            
            <input type="checkbox" class="image__checkbox" id="image-checkbox-<?= $image->id ?>">
    
            <label class="image__menu image__menu--open" id="image-1-menu" for="image-checkbox-<?=$image->id?>">
                <svg class="image__menu--open"><use href="./app/static/svg/icomoon.svg#icon-menu-thin"></use></svg>
            </label>
    
            <label class="image__menu image__menu--close" id="image-1-menu" for="image-checkbox-<?= $image->id ?>">
                <svg class="image__menu--open"><use href="./app/static/svg/icomoon.svg#icon-x-mark-thin"></use></svg>
            </label>
    
            <div class="dropdownmenu dropdownmenu--2 image__dopdownmenu" id="image-<?= $image->id ?>-dropdownmenu">
    
                <ul class="dropdownmenu__list">
    
                    <li class="dropdownmenu__item">
                        <a href="#" class="dropdownmenu__link">
                            <svg class="dropdownmenu__icon"><use  xlink:href="./app/static/svg/icomoon.svg#icon-save-thin"></use></svg>
                             Download                
                        </a>
                    </li>
                    <li class="dropdownmenu__item">
                        <a href="#" class="dropdownmenu__link">
                            <svg class="dropdownmenu__icon"><use  xlink:href="./app/static/svg/icomoon.svg#icon-picture-thin"></use></svg>
                             Make Project Cover                
                        </a>
                    </li>
                    <li class="dropdownmenu__item">
                        <a href="#" class="dropdownmenu__link">
                            <svg class="dropdownmenu__icon"><use  xlink:href="./app/static/svg/icomoon.svg#icon-trash-can-thin"></use></svg>
                            Delete Image      
                        </a>
                    </li>
                </ul>
                
            </div>
    
            <div class="image__arrow">
                <a href="#" class="image__arrow--left">
                    <svg class="image__arrow-icon"><use href="./app/static/svg/icomoon.svg#icon-triangle-4"></use></svg>
                </a>
                <a href="#" class="image__arrow--right">
                    <svg class="image__arrow-icon"><use href="./app/static/svg/icomoon.svg#icon-triangle-4"></use></svg>
                </a>      
                
            </div>
        </div>      
    
        <?php endforeach; ?>

    <!-- ----------------------------------------------------------- -->          

</form>
</section>
