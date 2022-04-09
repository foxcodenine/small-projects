<?php use app\Model\MyUtilities; ?>
<div class="sign ">
        
    <form class="sign__form sign__form--in sign__transition" method="POST">

        <div class="sign__side-img">
                <img src="<?= MyUtilities::fetchSignImage() ?>" alt="">
        </div>

        <div class="sign__title">Password Recovery</div>



        <div class="sign__message message message__<?= $messageType ?> ">
                <?= $message ?>
        </div> 

        <div class="sign__text mb-md">
            <p>Please enter the email address you'd like yout password reset infomation send to</p>                           
        </div>

        <div class="field__group">
            <label class="field__label" for="sign-email">Email</label>
            <div class="field__error"><?= $errorEmail; ?></div>
            <input type="text" class="field__input" id="sign-email" name="email"  value="<?= $_SESSION['sign-in']['email'] ?? '' ;?>">
        </div>

        
        <button class="btn btn--primary btn--thick btn--100 mt-md myLoaderBtn" type="submit" >Sign In</button>

        <div class="sign__text">
            
            <p> <span>Back to <a href="<?= $_ENV['BASE_PATH'] ?>/sign-in">Sign-in</a></span> 
                <!-- <span>&nbsp;Just<a href="#"> Visit</a>.</span> -->
            </p>
        
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



