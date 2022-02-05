<div class="sign ">
        
    <form class="sign__form sign__form--in " method="POST">

        <div class="sign__side-img">
                <img src="./app/static/images/signing/img-sign-6.jpg" alt="">
        </div>

        <div class="sign__title">Welcome to <b>My</b>Admin</div>

        <div class="sign__message message message__<?= $messageType ?> ">
                <?= $message ?>
        </div> 

        <div class="field__group">
            <label class="field__label" for="sign-email">Email</label>
            <div class="field__error"><?= $errorEmail; ?></div>
            <input type="text" class="field__input" id="sign-email" name="email"  value="<?= $_SESSION['sign-in']['email'] ?? '' ;?>">
        </div>

        <div class="field__group">
            <label class="field__label" for="sign-password">Password</label>
            <div class="field__error"><?= $errorPassword; ?></div>
            <input type="password" class="field__input" id="sign-password"  name="password" value="<?= $_SESSION['sign-up']['password'] ?? '' ;?>" >
                <svg class="sign__icon" id="svg-icon-eye">
                    <use  xlink:href="./app/static/svg/icomoon.svg#icon-eye-slash"></use>
                </svg>
        </div>

        <div class="field__pair-group">            
            <div class="field__group">                
                
                <label class="checkbox-1__label" >
                    <input class="checkbox-1__hidden" type="checkbox"  name="remember" <?php if(isset($_SESSION['sign-in']['remember'])) echo 'checked'; ?> >
                    <span  class="checkbox-1__box"></span> 
                    Remember this device
                </label>

            </div> 

            <div class="field__group">           
                <a class="sign__forgot" href="#">Forgot your password?</a>
            </div>
        </div>

        
        <button class="btn btn--primary btn--thick btn--100 mt-md" type="submit" >Sign In</button>

        <div class="sign__text">
            
            <p> <span>Test app, create <a href="/009/sign-up">Demo Account</a> ?</span> 
                <span>&nbsp;Just<a href="#"> Visit</a>.</span>
            </p>
        
        </div>           

    </form>
</div>
