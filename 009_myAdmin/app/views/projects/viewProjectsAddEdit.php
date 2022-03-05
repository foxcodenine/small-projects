<section class="project-form">
<form action="" class="project-form__form" autocomplete="off" method="POST">

    <h2 class="project-form__title">Add new <b>Project</b></h2>


    <div class="field__group">
        <label class="field__label" for="project name">project name</label>
        <div class="field__error"><?= $errorProjectname; ?></div>
        <input type="text" class="field__input" id="project name" name="projectname" value='<?= $_SESSION['project']['projectname'] ?? '' ?>'>
    </div>

    <div class="field__group">
        <label class="field__label" for="locality">locality</label>
        <div class="field__error"><?= $errorLocalityName; ?></div>
        <input type="text" class="field__input" id="locality" list="locationList" name="localityName" value="<?= (stripslashes($_SESSION['project']['localityName'])) ?? '' ?>" >
        <datalist id="locationList">
            <?php foreach ($listLocality as $obj): ?>
            <option value="<?= stripslashes($obj->lName) ?>">  
            <?php endforeach; ?>
        </datalist>
        <svg class="field__down-arrow">
            <use  xlink:href="./app/static/svg/icomoon.svg#icon-arrow_drop_down"></use>
        </svg>
    </div>

    <div class="field__group">
        <label class="field__label" for="street address">street address</label>
        <div class="field__error"><?= $errorStrAddr; ?></div>
        <input type="text" class="field__input" id="street address" name="strAddr" value="<?= stripslashes($_SESSION['project']['strAddr']) ?? '' ?>" >
    </div>

    <div class="field__group">
        <label class="field__label" for="client">client</label>
        <div class="field__error"><?= $errorClientId; ?></div>
        <select  class="field__input field__input--select" id="client" name="clientId">
            <option value=""></option>
            <!-- <option value="">Dorothy Cassar</option>
            <option value="">Joelle Ellul</option>
            <option value="">Danine Leonardi</option> -->
            <?php foreach ($listClients as $obj): ?>
                <option value="<?=  $obj->id ?>" 
                    <?php if (isset($_SESSION['project']['clientId']) && $_SESSION['project']['clientId'] === $obj->id ) echo 'selected'?> >  
                    <?=   $obj->id . ' - ' . $obj->firstname . ' ' . $obj->lastname  ?>
                </option>
            <?php endforeach; ?>
        </select>
        <svg class="field__down-arrow">
            <use  xlink:href="./app/static/svg/icomoon.svg#icon-arrow_drop_down"></use>
        </svg>
    </div>


    <div class="field__group">
        <label class="field__label" for="project no">project no</label>
        <div class="field__error"><?= $errorProjectNo; ?></div>
        <input type="text" class="field__input" id="project no" name="projectNo" value='<?= $_SESSION['project']['projectNo'] ?? '' ?>'>
    </div>

    <div class="field__group">
        <label class="field__label" for="pa no">pa no</label>
        <div class="field__error"><?= $errorPaNo; ?></div>
        <input type="text" class="field__input" id="pa no" name="paNo" value='<?= $_SESSION['project']['paNo'] ?? '' ?>'>
    </div>

    <div class="field__group">
        <label class="field__label" for="stage">stage</label>
        <div class="field__error"><?= $errorStageName; ?></div>
        <input type="text" class="field__input" id="stage" list="stageList" name="stageName" value='<?= $_SESSION['project']['stageName'] ?? '' ?>'>
        <datalist id="stageList">
            <!-- <option value="Submition to PA">   -->
            <!-- <option value="Finished"> -->
            <!-- <option value="Canceled"> -->
            <?php foreach ($listStage as $obj): ?>
            <option value="<?= $obj->sName ?>">  
            <?php endforeach; ?>
        </datalist>
        <svg class="field__down-arrow"><use  xlink:href="./app/static/svg/icomoon.svg#icon-arrow_drop_down"></use></svg>
    </div>

    <div class="field__group">
        <label class="field__label" for="category">category</label>
        <div class="field__error"><?= $errorCategoryName; ?></div>
        <input type="text" class="field__input" id="category" list="categoryList" name="categoryName" value='<?= $_SESSION['project']['categoryName'] ?? '' ?>'>
        <datalist id="categoryList">
            <!-- <option value="Residentional">   -->
            <!-- <option value="Public"> -->
            <!-- <option value="Industrial"> -->
            <?php foreach ($listCategoy as $obj): ?>
            <option value="<?= $obj->yName ?>">  
            <?php endforeach; ?>
        </datalist>
        <svg class="field__down-arrow"><use  xlink:href="./app/static/svg/icomoon.svg#icon-arrow_drop_down"></use></svg>
    </div>

    <div class="field__group">
        <label class="field__label" for="date">date</label>
        <div class="field__error"><?= $errorProjectDate; ?></div>
        <input type="text" class="field__input dateFormat" id="date" name="projectDate" value='<?= $_SESSION['project']['projectDate'] ?? '' ?>'>
    </div>

    <div class="field__group field__group--textarea">
        <label class="field__label" for="description"></label>
        <div class="field__error"><?= $errorDescription; ?></div>
        <div class="field__error"></div>
        <textarea id="editor_body" class="ck" name="descriptProject"><?= $_SESSION['project']['descriptProject'] ?? '' ?></textarea>
    </div>    
    

    <button class="btn btn--primary btn--thick project-form__btn"><?= $endpointURL === 'projects-add' ? 'Add' : 'Update' ?> Project</button>
    
</form>
</section>



