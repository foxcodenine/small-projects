<section class="projects">
<form action="<?= $_ENV['BASE_PATH'] ?>/projects-delete"  class="projects__form" method="POST">

    <div class="top-pannel">
        <div class="top-pannel__date"><b>projects</b> list</div>
            
        <div class="top-pannel__buttons">
            <a href="<?= $_ENV['BASE_PATH']?>/projects-add" class="btn btn--light">add new poject</a>
            <button class="btn btn--red modalBtn" type="button">remove project</button>
        </div>
    </div>
    
    <!-- ----------------------------------------------------------- -->
    
    <?php require './app/views/tables/viewProjectsTable.php'?>

    <!-- ----------------------------------------------------------- -->

<section class="modal">
    <div class="modal__content">

        <svg class="modal__close"><use href="./app/static/svg/icomoon.svg#icon-x-mark-thin"></use></svg>

        <div class="modal__title">Delete Confermation </div>

        <p style="display: none;" class="modal-hidden-message-js">Are you sure you want to delete these Projects?</p>

        <div class="modal__question modal-question-js">Are you sure you want to delete these Projects?</div>

        <div  class="modal__confirmation" method="POST">
        
            
            <button class="btn btn--light modal__cancel" type="button">cancel</button>
            <button class="btn btn--red myLoaderBtn" >Confirm</button>
        </div>

    </div>    
</section>

</form>
</section>


