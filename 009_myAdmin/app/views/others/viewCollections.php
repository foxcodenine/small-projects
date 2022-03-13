<form action="" method="POST">
<section class="group" id="sectionCollection">

    <div class="group__read">
        <div class="group__title">
            <b>
            <?php
            echo $pageName === 'country'  ? 'countries' : '';
            echo $pageName === 'locality' ? 'localities' : '';
            echo $pageName === 'category' ? 'categories' : '';
            echo $pageName === 'stage'    ? 'stages' : '';
            
            ?>
            </b>
        </div>

        <ul class="group__list">
            
            <!-- --------------------------------------------------- -->
            <?php $i = true; foreach($objList as $ol): ?>
                <li class="group__item group__item--<?= $i ?>" data-collactionName="<?= $ol->getName() ?>" data-collectionItem="<?= $ol->getId() ?>">

                    <p><?= $ol->getName() ?></p>
                    <!-- <a href="#" class="icon__link" id="table-icon-rename">
                        <svg class="icon__svg"> <use xlink:href="./app/static/svg/icomoon.svg#icon-text-3"></use></svg>
                    </a>
                    <a href="#" class="icon__link" id="table-icon-delete">
                        <svg class="icon__svg"> <use xlink:href="./app/static/svg/icomoon.svg#icon-x-mark-1"></use></svg>
                    </a> -->
                </li>
            <?php $i = !$i; endforeach ?>
            <!-- --------------------------------------------------- -->
        </ul>

    </div>



    <!-- --- ADD ------ -->

    <div class="group__add">
        <div class="group__title"><b>Add</b> new <?= $pageName ?></div>
        <div class="group__box">
            <input type="text" class="group__input" name="collection[name]">
            <button class="btn btn--dark" type="submit" name="collection[action]" value="add">Add</button>
        </div>
        <div class="group__error"><?= $errorCollectionAdd ?></div>
    </div>

    <!-- --- UPDATE --- -->

    <div class="group__add">
        <div class="group__title"><b>Rename</b> <?= $pageName ?></div>
        <div class="group__box">
            <select class="group__select" name="collection[rename1]" id="collection-select-rename1-js">
                <option value="0">no <?= $pageName ?> selected</option>
                <?php foreach($objList as $ol): ?>
                    <option id="collectionRename<?=$ol->getId()?>" value="<?=$ol->getId()?>" ><?= $ol->getName() ?></option>
                <?php endforeach ?>
            </select>
            <input type="text" class="group__input" name="collection[rename2]" id="collection-select-rename2-js">
            <button class="btn btn--dark modalBtn" type="button" name="collection[action]" value="rename" >Rename</button>
        </div>
        <div class="group__error"><?= $errorCollectionRename ?></div>
    </div>

    <!-- --- DELETE --- -->

    <div class="class__delete">
        <div class="group__title"><b>Delete</b></div>        
        <div class="group__box">
            <select class="group__select" name="collection[delete]" id="collection-select-delete-js">
            <option value="0">no <?= $pageName ?> selected</option>
                <?php foreach($objList as $ol): ?>
                    <option id="collectionDelete<?=$ol->getId()?>">
                        <?= $ol->getName() ?>
                    </option>
                <?php endforeach ?>
            </select>
            <div class="group__select">
            <div class="group__title group__title--mid"><b></b>replace with</div>
            <select  class="group__select--inner" name="collection[replace]" id="collection-select-replace-js">
                <option value="0">field empty</option>
                <?php foreach($objList as $ol): ?>
                    <option value="<?=$ol->getName()?>"><b><?= $ol->getName() ?></b></option>
                <?php endforeach ?>
                
            </select>
            </div>
            <button class="btn btn--red modalBtn" type="button" name="collection[action]" value="delete" >Delete</button>
        </div>
        <div class="group__error"><?= $errorCollectionDelete ?></div>
    </div>

    

    <!-- ---------------- -->
    
</section>
</form>


<section class="modal">
    <form class="modal__content" action="" method="POST" id="modalForm">
        

        <svg class="modal__close"><use href="./app/static/svg/icomoon.svg#icon-x-mark-thin"></use></svg>

        <div class="modal__title modal-title-js">Delete Confermation </div>

        <p style="display: none;" class="modal-hidden-message-js"><?= $pageName ?></p>
        
        <div class="modal__question modal-question-js">Are you sure you want to delete these Clients?</div>

        <div  class="modal__confirmation" method="POST">
        
            <input type="text" hidden id="modalField-1-js" value="">
            <input type="text" hidden id="modalField-2-js" value="">            
            
            <button class="btn btn--light modal__cancel" type="button">cancel</button>
            <button class="btn btn--red" name="collection[action]" type="submit" id="modalSubmitBtn" >Confirm</button>

        </div>   
    </form>  
</section>



