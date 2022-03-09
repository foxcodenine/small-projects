<form action="" method="POST">
<section class="group">

    <div class="group__read">
        <div class="group__title">
            <b>
            <?php
            echo $pageName === 'locality' ? 'localities' : '';
            echo $pageName === 'category' ? 'categories' : '';
            echo $pageName === 'stage'    ? 'stages' : '';
            
            ?>
            </b>
        </div>

        <ul class="group__list">
            
            <!-- --------------------------------------------------- -->
            <?php $i = true; foreach($objList as $ol): ?>
                <li class="group__item group__item--<?= $i ?>" data-collactionName="<?= $ol->getName() ?>">

                    <p><?= $ol->getName() ?></p>
                    <a href="#" class="icon__link" id="table-icon-rename">
                        <svg class="icon__svg"> <use xlink:href="./app/static/svg/icomoon.svg#icon-text-3"></use></svg>
                    </a>
                    <a href="#" class="icon__link" id="table-icon-delete">
                        <svg class="icon__svg"> <use xlink:href="./app/static/svg/icomoon.svg#icon-x-mark-1"></use></svg>
                    </a>

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
            <select class="group__select" name="">
                <option value="0">no <?= $pageName ?> selected</option>
                <?php foreach($objList as $ol): ?>
                    <option class="collection-Option-Js-<?= $ol->getName() ?>"><?= $ol->getName() ?></option>
                <?php endforeach ?>
            </select>
            <input type="text" class="group__input">
            <button class="btn btn--dark" type="submit" name="collection[action]" value="remane" >Rename</button>
        </div>
        <div class="group__error"><?= $errorCollectionRename ?></div>
    </div>

    <!-- --- DELETE --- -->

    <div class="class__delete">
        <div class="group__title"><b>Delete</b></div>        
        <div class="group__box">
            <select class="group__select" name="">
            <option value="0">no <?= $pageName ?> selected</option>
                <?php foreach($objList as $ol): ?>
                    <option class="collection-Option-Js-<?= $ol->getName() ?>"><?= $ol->getName() ?></option>
                <?php endforeach ?>
            </select>
            <div class="group__select">
            <div class="group__title group__title--mid"><b></b>replace with</div>
            <select  name="" class="group__select--inner">
                <option value="0">field empty</option>
                <?php foreach($objList as $ol): ?>
                    <option value="<?=$ol->getName()?>"><b>replace with <?= $ol->getName() ?></b></option>
                <?php endforeach ?>
                
            </select>
            </div>
            <button class="btn btn--red" type="submit" name="collection[action]" value="delete" >Delete</button>
        </div>
        <div class="group__error"><?= $errorCollectionDelete ?></div>
    </div>

    

    <!-- ---------------- -->
    
</section>
</form>