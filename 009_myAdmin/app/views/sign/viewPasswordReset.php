<?php use app\Model\MyUtilities; ?>
<div class="sign ">        
        
    <form class="sign__form sign__form--up sign__transition" method="POST" action="" autocomplete="off">
        <div class="myadmin-ribbon-container sign__transition">
            <div id="corner-ribbon">
            <div>
                <div>
                <div></div>
                </div>
            </div>
            </div>
        </div>

        <div class="sign__side-img">
            <img src="<?= MyUtilities::fetchSignImage() ?>" alt="">
        </div>

        
        <div class="sign__title">Welcome to <b>My</b>Admin</div>
        
        <div class="sign__message message message__<?= $messageType ?> ">
            <?= $message ?>
        </div> 

        <div class="sign__text mb-md">
            <p>A strong password helps prevent unauthorized access to your MyAdmin account.</p>    
        </div>


        <div class="field__group">
            <label class="field__label" for="reset-password1">New Password</label>
            <div class="field__error"><?= $errorPassword1; ?></div>
            <input type="password" class="field__input" id="reset-password1" name="password1" value="<?= $_SESSION['reset']['password1'] ?? '' ;?>" placeholder="6+characters">
            <svg class="sign__icon" id="svg-icon-eye">
                <use  xlink:href="./app/static/svg/icomoon.svg#icon-eye-slash"></use>
            </svg>
        </div>

        <div class="field__group">
            <label class="field__label" for="reset-password2">Confirm new password</label>
            <div class="field__error"><?= $errorPassword2; ?></div>
            <input type="password" class="field__input" id="reset-password2" name="password2" value="<?= $_SESSION['reset']['password1'] ?? '' ;?>" >
        </div>

        
        <button class="btn btn--primary btn--thick btn--100 mt-md myLoaderBtn" type="submit">Reset Password</button>


    </form>


</div>

