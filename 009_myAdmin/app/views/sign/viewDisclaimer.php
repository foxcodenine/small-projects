<?php use app\Model\MyUtilities; ?>
<div class="sign">











    <div class="sign__disclaimer-bg"></div>


    
        
    <form class="sign__form disclaimer" method="POST">


    

        <div class="sign__side-img">
                <img src="<?= MyUtilities::fetchSignImage() ?>" alt="">
        </div>

        <div class="sign__title"><b>disclaimer</b></div>


        <p class="sign__disclaimer-text">
        The purpose of this application is only meant as a learning project. 
        </p>
        <p class="sign__disclaimer-text">
        All account will be automatically deleted after 12hrs from   
        signing-up and any material entered or uploaded will be removed.  
        </p>
        <p class="sign__disclaimer-text">
        To provide a better user experience this account has already been  
        pre-filled in advance with sample data which may contain copyright 
        material.
        <!-- , that the use of which may not always been specifically authorized by the copyright owner. -->
        </p>
        <p class="sign__disclaimer-text">
        Further use of this application, cookies will be set on your device, 
        which are required to enable its basic functionality.
        </p>
        <p class="sign__disclaimer-text">
        By clicking Accept you are <b>Understanding</b> and <b>Agreeing</b> to these 
        Terms and Condition.
        </p>



        <div class="sign__btn-group">
            <button class="btn btn--light" name="disclaimerBtn" value="reject">Reject</button>
            <button class="btn btn--red"   name="disclaimerBtn" value="accept">Accept</button>
        </div>




    </form>

    <div class="myadmin-ribbon-container">
        <div id="corner-ribbon">
        <div>
            <div>
            <div></div>
            </div>
        </div>
        </div>
    </div>

</div>

