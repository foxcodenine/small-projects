<section class="clients">
<form action="<?= $_ENV['BASE_PATH'] ?>/clients-delete"  class="clients__form" method="POST">

    <div class="top-pannel">
        <div class="top-pannel__date"><b>CLIENTS</b> List</div>
            
        <div class="top-pannel__buttons">
            <a href="<?= $_ENV['BASE_PATH'] ?>/clients-add" class="btn btn--light">add new client</a>
            <button class="btn btn--red modalBtn" type="button">remove client</button>
        </div>
    </div>
    
    <?php require './app/views/tables/viewClientsTable.php'?>



<section class="modal">
    <div class="modal__content">

        <svg class="modal__close"><use href="./app/static/svg/icomoon.svg#icon-x-mark-thin"></use></svg>

        <div class="modal__title">Delete Confermation </div>

        <p style="display: none;" class="modal-hidden-message-js">Are you sure you want to delete these Clients?</p>
        
        <div class="modal__question modal-question-js">Are you sure you want to delete these Clients?</div>

        <div  class="modal__confirmation" method="POST">
        
            
            <button class="btn btn--light modal__cancel" type="button">cancel</button>
            <button class="btn btn--red">Confirm</button>
        </div>

    </div>    
</section>


</form>
</section>
