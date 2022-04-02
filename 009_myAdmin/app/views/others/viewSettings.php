<section class="settings">
<div class="settings__display">

    <div class="top-pannel">
        <div class="top-pannel__date"><b>General Account Settings</b></div>
    </div>

    <!-- ----------------------------------------------------------- -->

    <div class="<?php echo $classMessage?> settings__message"><?php echo $message ?></div>
    
    <div class="settings__container modalBtn" id="settingsContainer">
        <div class="settings__group" data-settingsLink="name">
            <div class="settings__key">name</div>
            <div class="settings__value"><?php echo $firstname . ' ' . $lastname; ?></div>
            <div class="settings__link">edit</div>
        </div>
        <div class="settings__group" data-settingsLink="email">
            <div class="settings__key">email</div>
            <div class="settings__value"><?php echo $email ?></div>
            <div class="settings__link">change</div>
        </div>
        <div class="settings__group" data-settingsLink="password">
            <div class="settings__key">password</div>
            <div class="settings__value">********</div>
            <div class="settings__link">change</div>
        </div>

    </div>

    <!-- ----------------------------------------------------------- -->

</div>
</section>

<!-- <section class="modal" style="display: grid;"> -->
<section class="modal" id="settingsModal" style="display: none;">
    
    <form class="modal__content" style="display: none;" data-modalSettings="name" accept="" method="POST">
            <svg class="modal__close"><use href="./app/static/svg/icomoon.svg#icon-x-mark-thin"></use></svg>        
           
            <div class="modal__title">Edit Name </div>
            
            <input type="text" class="modal__input" name="firstname" placeholder="Firstname" value="<?php echo $firstname ?>">
            <input type="text" class="modal__input" name="lastname"  placeholder="Lastname"  value="<?php echo $lastname ?>">
            <input type="password" class="modal__input" name="currentPassword"  placeholder="Enter current password" >
            
            <div  class="modal__confirmation" method="POST">            
                <button class="btn btn--light modal__cancel" type="button">cancel</button>
                <button class="btn btn--red" type="submit" name="settingsModalBtn" value="name">Confirm</button>
            </div>
    </form>  

    <form class="modal__content" style="display: none;" data-modalSettings="email" accept="" method="POST">
            <svg class="modal__close"><use href="./app/static/svg/icomoon.svg#icon-x-mark-thin"></use></svg>        
           
            <div class="modal__title">Change Email</div>
            
            <input type="text" type="password" name="email1" class="modal__input" placeholder="new email">
            <input type="text" type="password" name="email2" class="modal__input" placeholder="confirm new email">
            <input type="password" class="modal__input" name="currentPassword"  placeholder="Enter current password" >
            
            <div  class="modal__confirmation" method="POST">            
                <button class="btn btn--light modal__cancel" type="button">cancel</button>
                <button class="btn btn--red" type="submit" name="settingsModalBtn" value="email">Change</button>
            </div>
    </form>  

    <form class="modal__content" style="display: none;" data-modalSettings="password"  accept="" method="POST">
            <svg class="modal__close"><use href="./app/static/svg/icomoon.svg#icon-x-mark-thin"></use></svg>        
           
            <div class="modal__title">Change Password</div>
            
            <input type="text" class="modal__input" name="currentPassword" placeholder="current password">
            <input type="text" class="modal__input" placeholder="new password">
            <input type="password" class="modal__input"  placeholder="confirm new password">

            
            
            <div  class="modal__confirmation" method="POST">            
                <button class="btn btn--light modal__cancel" type="button">cancel</button>
                <button class="btn btn--red" type="submit" name="settingsModalBtn" value="password">Change</button>
            </div>
    </form>  

</section>
