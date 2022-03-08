<section class="group">

    <div class="group__read">
        <div class="group__title"><b><?= $pageName ?></b> List</div>

        <ul class="group__list">
            <!-- --------------------------------------------------- -->

            <li class="group__item group__item--1">

                <p>Gharb</p>
                <a href="#" class="icon__link" id="table-icon-rename">
                    <svg class="icon__svg"> <use xlink:href="./app/static/svg/icomoon.svg#icon-text-3"></use></svg>
                </a>
                <a href="#" class="icon__link" id="table-icon-delete">
                    <svg class="icon__svg"> <use xlink:href="./app/static/svg/icomoon.svg#icon-x-mark-1"></use></svg>
                </a>
                
            </li>
            <!-- --------------------------------------------------- -->
            <li class="group__item group__item--2">

                <p>Hamrun</p>
                <a href="#" class="icon__link" id="table-icon-rename">
                    <svg class="icon__svg"> <use xlink:href="./app/static/svg/icomoon.svg#icon-text-3"></use></svg>
                </a>
                <a href="#" class="icon__link" id="table-icon-delete">
                    <svg class="icon__svg"> <use xlink:href="./app/static/svg/icomoon.svg#icon-x-mark-1"></use></svg>
                </a>
                
            </li>
            <!-- --------------------------------------------------- -->
            <!-- --------------------------------------------------- -->
            <?php foreach($objList as $ol): ?>
                <li class="group__item group__item--1">

                <p><?= $ol->getName() ?></p>
                <a href="#" class="icon__link" id="table-icon-rename">
                    <svg class="icon__svg"> <use xlink:href="./app/static/svg/icomoon.svg#icon-text-3"></use></svg>
                </a>
                <a href="#" class="icon__link" id="table-icon-delete">
                    <svg class="icon__svg"> <use xlink:href="./app/static/svg/icomoon.svg#icon-x-mark-1"></use></svg>
                </a>

                </li>
            <?php endforeach ?>
            <!-- --------------------------------------------------- -->
        </ul>

    </div>

    <div class="group__add">
        <div class="group__title"><b>Add</b> new locations</div>
        <div class="group__box">
            <input type="text" class="group__input">
            <button class="btn btn--tertiary">Add</button>
        </div>
    </div>

    <div class="group__add">
        <div class="group__title"><b>Rename</b> and Update</div>
        <div class="group__box">
            <select class="group__select" name="">
                <option value="0">no-locality</option>
                <option value="1">Attard</option>
            </select>
            <input type="text" class="group__input">
            <button class="btn btn--secondary">Rename</button>
        </div>
    </div>

    <div class="class__delete">
        <div class="group__title"><b>Delete</b> and replace</div>
        <div class="group__box">
            <select class="group__select" name="">
                <option value="0">no-locality</option>
                <option value="1">Attard</option>
            </select>
            <select class="group__select" name="">
                <option value="0">no-locality</option>
                <option value="1">Attard</option>
            </select>
            <button class="btn btn--red">Delete</button>
        </div>
    </div>
</section>