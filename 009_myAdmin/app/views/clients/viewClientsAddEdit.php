<section class="client-form">
<form action="" class="client-form__form" autocomplete="off" method="POST">

    <h2 class="client-form__title">Add new <b>Client</b></h2>


    <div class="field__group">
        <label class="field__label" for="title">title</label>
        <div class="field__error"><?= $errorTitle; ?></div>
        <select id="" class="field__input field__input--select" id="title" name="title">
            <option value=""    <?= $title === '' ? 'selected' : '' ?> >&nbsp;</option>
            <option value="Mr"  <?= $title === 'Mr' ? 'selected' : '' ?> >Mr</option>
            <option value="Mrs" <?= $title === 'Mrs' ? 'selected' : '' ?> >Mrs</option>
            <option value="Ms"  <?= $title === 'Ms' ? 'selected' : '' ?> >Ms</option>
            <option value="Miss"<?= $title === 'Miss' ? 'selected' : '' ?> >Miss</option>            
        </select>
        <svg class="field__down-arrow">
            <use  xlink:href="./app/static/svg/icomoon.svg#icon-arrow_drop_down"></use>
        </svg>
    </div>
    
    
    <div class="field__group">
        <label class="field__label" for="firstname">firstname</label>
        <div class="field__error"><?= $errorFirstname; ?></div>
        <input type="text" class="field__input" id="firstname" name="firstname" value='<?= $_SESSION['client']['firstname'] ?? '' ?>'>
    </div>

    <div class="field__group">
        <label class="field__label" for="lastname">lastname</label>
        <div class="field__error"><?= $errorLastname; ?></div>
        <input type="text" class="field__input" id="lastname" name="lastname" value='<?= $_SESSION['client']['lastname'] ?? '' ?>'>
    </div>

    <div class="field__group">
        <label class="field__label" for="idCard">id </label>
        <div class="field__error"><?= $errorIdCard; ?></div>
        <input type="text" class="field__input" id="idCard" name="idCard" value='<?= $_SESSION['client']['idCard'] ?? '' ?>'>
    </div>

    <div class="field__group">
        <label class="field__label" for="company">company</label>
        <div class="field__error"><?= $errorCompany; ?></div>
        <input type="text" class="field__input" id="company" name="company" value='<?= $_SESSION['client']['company'] ?? '' ?>'>
    </div>

    <div class="field__group">
        <label class="field__label" for="client no">email</label>
        <div class="field__error"><?= $errorEmail; ?></div>
        <input type="text" class="field__input" id="email" name="email" value='<?= $_SESSION['client']['email'] ?? '' ?>'>
    </div>

    <div class="field__group">
        <label class="field__label" for="phone">phone</label>
        <div class="field__error"><?= $errorPhone; ?></div>
        <input type="text" class="field__input" id="phone" name="phone" value='<?= $_SESSION['client']['phone'] ?? '' ?>'>
    </div>

    <div class="field__group">
        <label class="field__label" for="mobile">mobile</label>
        <div class="field__error"><?= $errorMobile; ?></div>
        <input type="text" class="field__input" id="mobile" name="mobile" value='<?= $_SESSION['client']['mobile'] ?? '' ?>'>
    </div>

    <div class="field__group">
        <label class="field__label" for="strAddr">street address</label>
        <div class="field__error"><?= $errorStrAddr; ?></div>
        <input type="text" class="field__input" id="strAddr" name="strAddr" value='<?= $_SESSION['client']['strAddr'] ?? '' ?>'>
    </div>

    <div class="field__group">
        <label class="field__label" for="locality">locality </label>
        <div class="field__error"><?= $errorLocality; ?></div>
        <input type="text" class="field__input" id="locality" list="locationList" name="locality" value='<?= htmlentities($_SESSION['client']['locality'] ?? '',ENT_QUOTES) ?>'>
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
        <label class="field__label" for="country">country</label>
        <div class="field__error"><?= $errorCountry; ?></div>
        <input type="text" class="field__input" id="country" list="countryList" name="country"  value='<?= $_SESSION['client']['country'] ?? '' ?>'>
        <datalist id="countryList">
            <?php foreach ($listCountry as $obj): ?>
            <option value="<?= stripslashes($obj->cName) ?>">  
            <?php endforeach; ?>
        </datalist>
        <svg class="field__down-arrow">
            <use  xlink:href="./app/static/svg/icomoon.svg#icon-arrow_drop_down"></use>
        </svg>
    </div>

    <div class="field__group">
        <label class="field__label" for="postcode">postcode</label>
        <div class="field__error"><?= $errorPostcode; ?></div>
        <input type="text" class="field__input" id="postcode" name="postcode">
    </div>

    <div class="field__group field__group--textarea" >
        <label class="field__label" for="description"></label>
        <div class="field__error"><?= $errorInfoClient; ?></div>
        <textarea  id="editor_body" name="infoClient"><?= $_SESSION['client']['infoClient'] ?? '' ?></textarea>
        
    </div>

    <button class="btn btn--primary btn--thick client-form__btn mt-sm"><?= $endpointURL === 'clients-add' ? 'Add' : 'Update' ?>  Client</button>

</form>
</section>


