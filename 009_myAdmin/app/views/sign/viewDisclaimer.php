<?php use app\Model\MyUtilities; ?>
<div class="sign">


    <div class="sign__disclaimer-bg "></div>
    
    
    <form class="sign__form sign__transition" method="POST">
   

        <div class="sign__side-img">
                <img src="<?= MyUtilities::fetchSignImage() ?>" alt="">
        </div>

        <div class="sign__title"><b><?= $pageName?></b></div>


        <p class="sign__disclaimer-text">
        The purpose of this application is only meant as a learning project. 
        </p>
        <p class="sign__disclaimer-text">
        All account will be automatically deleted after 12hrs from   
        signing-up and any material entered or uploaded will be removed.  
        </p>
        <p class="sign__disclaimer-text">
        To provide a better user experience new accounts has been pre-filled 
        in advance with sample data which may contain copyright material.
        <!-- , that the use of which may not always been specifically authorized by the copyright owner. -->
        </p>

        <?php if ($pageName == 'disclaimer'): ?>

        <p class="sign__disclaimer-text">
        Further use of this application, cookies will be set on your device, 
        which are required to enable its basic functionality.
        </p>
        By clicking Accept you are <b>Understanding</b> and <b>Agreeing</b> to these 
        Terms and Condition.
        </p>

        <div class="sign__btn-group">
            <button class="btn btn--light" name="disclaimerBtn" value="reject">Reject</button>
            <button class="btn btn--red  "   name="disclaimerBtn" value="accept">Accept</button>
        </div>

        <?php else: ?>

        <p class="sign__disclaimer-text">
        This application,  will be set cookies on your device, 
        which are required to enable its basic functionality.

        <div class="sign__btn-group ">
            <a  href="<?= $_ENV['BASE_PATH']?>" 
                class="btn btn--light mt-sm mb-tn-n sign--close"   
                name="disclaimerBtn" value="accept">close</a>
        </div>

        </p>
        <?php endif?>
        <p class="sign__disclaimer-text">

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


