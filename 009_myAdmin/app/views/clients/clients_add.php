<section class="client-form">
<form action="#" class="client-form__form" autocomplete="off">

    <h2 class="client-form__title">Add new <b>Client</b></h2>


    <div class="field__group">
        <label class="field__label" for="title">title</label>
        <div class="field__error">This field is required</div>
        <select name="" id="" class="field__input field__input--select" id="title">
            <option value="">&nbsp;</option>
            <option value="Mr">Mr</option>
            <option value="Mr">Mrs</option>
            <option value="Mr">Ms</option>
            <option value="Mr">Miss</option>
        </select>
        <svg class="field__down-arrow">
            <use  xlink:href="./app/static/svg/icomoon.svg#icon-arrow_drop_down"></use>
        </svg>
    </div>

    <div class="field__group">
        <label class="field__label" for="firstname">firstname</label>
        <div class="field__error">This field is required</div>
        <input type="text" class="field__input" id="firstname">
    </div>

    <div class="field__group">
        <label class="field__label" for="lastname">lastname</label>
        <div class="field__error">This field is required</div>
        <input type="text" class="field__input" id="lastname">
    </div>

    <div class="field__group">
        <label class="field__label" for="id">id</label>
        <div class="field__error">This field is required</div>
        <input type="text" class="field__input" id="id">
    </div>

    <div class="field__group">
        <label class="field__label" for="company">company</label>
        <div class="field__error">This field is required</div>
        <input type="text" class="field__input" id="company">
    </div>

    <div class="field__group">
        <label class="field__label" for="client no">client no</label>
        <div class="field__error">This field is required</div>
        <input type="text" class="field__input" id="client no">
    </div>

    <div class="field__group">
        <label class="field__label" for="phone">phone</label>
        <div class="field__error">This field is required</div>
        <input type="text" class="field__input" id="phone">
    </div>

    <div class="field__group">
        <label class="field__label" for="mobile">mobile</label>
        <div class="field__error">This field is required</div>
        <input type="text" class="field__input" id="mobile">
    </div>

    <div class="field__group">
        <label class="field__label" for="street address">street address</label>
        <div class="field__error">This field is required</div>
        <input type="text" class="field__input" id="street address">
    </div>

    <div class="field__group">
        <label class="field__label" for="locality">locality</label>
        <div class="field__error">This field is required</div>
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
        <label class="field__label" for="country">country</label>
        <div class="field__error">This field is required</div>
        <input type="text" class="field__input" id="country" list="countryList">
        <datalist id="countryList">
            <option value="Malta">  
            <option value="Gozo">
            <option value="UK">
        </datalist>
        <svg class="field__down-arrow">
            <use  xlink:href="./app/static/svg/icomoon.svg#icon-arrow_drop_down"></use>
        </svg>
    </div>

    <div class="field__group">
        <label class="field__label" for="postcode">postcode</label>
        <div class="field__error">This field is required</div>
        <input type="text" class="field__input" id="postcode">
    </div>

    <div class="field__group field__group--textarea">
        <label class="field__label" for="description"></label>
        <div class="field__error"></div>
        <textarea id="editor_body" class="ck"></textarea>
    </div>

    <button class="btn btn--primary btn--thick client-form__btn mt-sm">Add Client</button>

</form>
</section>

