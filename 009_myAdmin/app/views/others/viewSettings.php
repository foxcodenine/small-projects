<section class="settings">
<div class="settings__display">

    <div class="top-pannel">
        <div class="top-pannel__date"><b>General Account Settings</b></div>
    </div>

    <!-- ----------------------------------------------------------- -->
    
    <div class="settings__container">
        <div class="settings__group">
            <div class="settings__key">name</div>
            <div class="settings__value">Christopher Farrugia</div>
            <div class="settings__link">edit</div>
        </div>
        <div class="settings__group">
            <div class="settings__key">email</div>
            <div class="settings__value">chris12aug@yahoo.com</div>
            <div class="settings__link">change</div>
        </div>
        <div class="settings__group">
            <div class="settings__key">password</div>
            <div class="settings__value">********</div>
            <div class="settings__link">change</div>
        </div>

    </div>

    <!-- ----------------------------------------------------------- -->

</div>
</section>

<section class="modal" style="display: grid;">

    <form class="modal__content" style="display: none;">
        <svg class="modal__close"><use href="./app/static/svg/icomoon.svg#icon-x-mark-thin"></use></svg>        
           
            <div class="modal__title">Edit Name </div>
            
            <input type="text" class="modal__input" placeholder="firstname">
            <input type="text" class="modal__input" placeholder="lastname">
            
            <div  class="modal__confirmation" method="POST">            
                <button class="btn btn--light modal__cancel" type="button">cancel</button>
                <button class="btn btn--red">Confirm</button>
            </div>
    </form>  

    <form class="modal__content" style="display: none;">
        <svg class="modal__close"><use href="./app/static/svg/icomoon.svg#icon-x-mark-thin"></use></svg>        
           
            <div class="modal__title">Change Email</div>
            
            <input type="text" class="modal__input" placeholder="new email">
            <input type="text" class="modal__input" placeholder="confirm new email">
            
            <div  class="modal__confirmation" method="POST">            
                <button class="btn btn--light modal__cancel" type="button">cancel</button>
                <button class="btn btn--red">Change</button>
            </div>
    </form>  

    <form class="modal__content">
        <svg class="modal__close"><use href="./app/static/svg/icomoon.svg#icon-x-mark-thin"></use></svg>        
           
            <div class="modal__title">Change Password</div>
            
            <input type="text" class="modal__input" placeholder="current password">
            <input type="text" class="modal__input" placeholder="new password">
            <input type="text" class="modal__input" placeholder="confirm new password">

            
            
            <div  class="modal__confirmation" method="POST">            
                <button class="btn btn--light modal__cancel" type="button">cancel</button>
                <button class="btn btn--red">Change</button>
            </div>
    </form>  

</section>
