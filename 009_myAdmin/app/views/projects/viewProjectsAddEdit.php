<section class="project-form">
<form action="#" class="project-form__form" autocomplete="off">

    <h2 class="project-form__title">Add new <b>Project</b></h2>


    <div class="field__group">
        <label class="field__label" for="project name">project name</label>
        <div class="field__error"><?= $errorProjectname; ?></div>
        <input type="text" class="field__input" id="project name">
    </div>

    <div class="field__group">
        <label class="field__label" for="locality">locality</label>
        <div class="field__error"><?= $errorLocalityName; ?></div>
        <input type="text" class="field__input" id="locality" list="locationList">
        <datalist id="locationList">
            <option value="Birzebbugia">  
            <option value="Valletta">
            <option value="Qormi">
        </datalist>
        <svg class="field__down-arrow">
            <use  xlink:href="./app/static/svg/icomoon.svg#icon-arrow_drop_down"></use>
        </svg>
    </div>

    <div class="field__group">
        <label class="field__label" for="street address">street address</label>
        <div class="field__error"><?= $errorStrAddr; ?></div>
        <input type="text" class="field__input" id="street address">
    </div>

    <div class="field__group">
        <label class="field__label" for="client">client</label>
        <div class="field__error"><?= $errorClientId; ?></div>
        <select name="" id="" class="field__input field__input--select" id="client">
            <option value=""></option>
            <option value="">Dorothy Cassar</option>
            <option value="">Joelle Ellul</option>
            <option value="">Danine Leonardi</option>
        </select>
        <svg class="field__down-arrow">
            <use  xlink:href="./app/static/svg/icomoon.svg#icon-arrow_drop_down"></use>
        </svg>
    </div>


    <div class="field__group">
        <label class="field__label" for="project no">project no</label>
        <div class="field__error"><?= $errorProjectNo; ?></div>
        <input type="text" class="field__input" id="project no">
    </div>

    <div class="field__group">
        <label class="field__label" for="pa no">pa no</label>
        <div class="field__error"><?= $errorPaNo; ?></div>
        <input type="text" class="field__input" id="pa no">
    </div>

    <div class="field__group">
        <label class="field__label" for="stage">stage</label>
        <div class="field__error"><?= $errorStageName; ?></div>
        <input type="text" class="field__input" id="stage" list="stageList">
        <datalist id="stageList">
            <option value="Submition to PA">  
            <option value="Finished">
            <option value="Canceled">
        </datalist>
        <svg class="field__down-arrow"><use  xlink:href="./app/static/svg/icomoon.svg#icon-arrow_drop_down"></use></svg>
    </div>

    <div class="field__group">
        <label class="field__label" for="category">category</label>
        <div class="field__error"><?= $errorCategoryName; ?></div>
        <input type="text" class="field__input" id="category" list="categoryList">
        <datalist id="categoryList">
            <option value="Residentional">  
            <option value="Public">
            <option value="Industrial">
        </datalist>
        <svg class="field__down-arrow"><use  xlink:href="./app/static/svg/icomoon.svg#icon-arrow_drop_down"></use></svg>
    </div>

    <div class="field__group">
        <label class="field__label" for="date">date</label>
        <div class="field__error"><?= $errorProjectDate; ?></div>
        <input type="text" class="field__input dateFormat" id="date">
    </div>

    <div class="field__group field__group--textarea">
        <label class="field__label" for="description"></label>
        <div class="field__error"><?= $errorDescription; ?></div>
        <div class="field__error"></div>
        <textarea id="editor_body" class="ck"></textarea>
    </div>    
    

    <button class="btn btn--primary btn--thick project-form__btn">Add Project</button>
    
</form>
</section>



