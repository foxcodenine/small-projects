<?php use app\Model\MyUtilities; ?>
<div class="sign ">        
        
    <form class="sign__form sign__form--up sign__transition" method="POST" action="<?= $_ENV['BASE_PATH'] ?>/sign-up" autocomplete="off">

        <div class="sign__side-img">
            <img src="<?= MyUtilities::fetchSignImage() ?>" alt="">
        </div>

        
        <div class="sign__title">Welcome to <b>My</b>Admin</div>
        
        <div class="sign__message message message__<?= $messageType ?> ">
            <?= $message ?>
        </div> 


        <div class="field__pair-group">

            <div class="field__group">
                <label class="field__label" for="sign-firstname" >firstname</label>
                <div class="field__error"><?= $errorFirstname; ?></div>
                <input type="text" class="field__input" id="sign-firstname" name="firstname" value="<?= $_SESSION['sign-up']['firstname'] ?? '' ;?>">
            </div>

            <div class="field__group">
                <label class="field__label" for="sign-lastname" >lastname</label>
                <div class="field__error"><?= $errorLastname; ?></div>
                <input type="text" class="field__input" id="sign-lastname" name="lastname" value="<?= $_SESSION['sign-up']['lastname'] ?? '' ;?>">
            </div>
            
        </div>


        <div class="field__group">
            <label class="field__label" for="sign-email">Email</label>
            <div class="field__error"><?= $errorEmail; ?></div>
            <input type="text" class="field__input" id="sign-email" name="email" value="<?= $_SESSION['sign-up']['email'] ?? '' ;?>" >
        </div>

        <div class="field__group">
            <label class="field__label" for="sign-password">Password</label>
            <div class="field__error"><?= $errorPassword; ?></div>
            <input type="password" class="field__input" id="sign-password" placeholder="6+characters" name="password" value="<?= $_SESSION['sign-up']['password'] ?? '' ;?>" >
            <svg class="sign__icon" id="svg-icon-eye">
                <use  xlink:href="./app/static/svg/icomoon.svg#icon-eye-slash"></use>
            </svg>
        </div>

        
        <button class="btn btn--primary btn--thick btn--100 mt-md myLoaderBtn" type="submit">Create Demo Account</button>

        <div class="sign__text ">
            <p>Already has account? <a href="<?= $_ENV['BASE_PATH'] ?>/sign-in">Sign-in</a>.</p>
            <p> Creating an account means you're okay with our 
            <a href="<?= $_ENV['BASE_PATH'] . '/terms' ?>">Terms of Service</a></p>                
        </div>
    </form>

    <div class="myadmin-ribbon-container sign__transition">
        <div id="corner-ribbon">
        <div>
            <div>
            <div></div>
            </div>
        </div>
        </div>
    </div>
</div>

