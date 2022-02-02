<div class="sign">
        
    <form class="sign__form sign__form-in">

        <div class="sign__title">Welcome to <b>My</b>Admin</div>

        <div class="sign__message message message__<?= $messageType ?> ">
                <?= $message ?>
        </div> 

        <div class="field__group">
            <label class="field__label" for="sign-email">Email</label>
            <div class="field__error">This field is required</div>
            <input type="text" class="field__input" id="sign-email">
        </div>

        <div class="field__group">
            <label class="field__label" for="sign-password">Password</label>
            <div class="field__error">This field is required</div>
            <input type="password" class="field__input" id="sign-password">
            <svg class="sign__icon" id="svg-icon-eye">
                <use  xlink:href="../static/svg/icomoon.svg#icon-eye-slash"></use>
            </svg>
        </div>

        <div class="field__pair-group">            
            <div class="field__group">                
                
                <label class="checkbox-1__label" >
                    <input class="checkbox-1__hidden" type="checkbox">
                    <span  class="checkbox-1__box"></span> 
                    Remember this device
                </label>

            </div> 

            <div class="field__group">           
                <a class="sign__forgot" href="#">Forgot your password?</a>
            </div>
        </div>

        
        <button class="btn btn--primary btn--thick btn--100 mt-md">Sign In</button>

        <div class="sign__text">
            
            <p> <span>Test app, create <a href="/009/sign-up">Demo Account</a> ?</span> 
                <span>&nbsp;Just<a href="#"> Visit</a>.</span>
            </p>
            <p class="field__error">Please log in to access this page.</p>
        </div>           

    </form>
</div>
