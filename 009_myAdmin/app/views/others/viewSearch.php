<section class="search">

    <form action="" class="search__query-form">

        <div class="search__fields">
            <input type="text" class="search__field" placeholder="firstname">
            <input type="text" class="search__field" placeholder="lastname">
            <input type="text" class="search__field" placeholder="id">
            <input type="text" class="search__field" placeholder="company">
            <input type="text" class="search__field" placeholder="email">
            <input type="text" class="search__field" placeholder="phone">
            <input type="text" class="search__field" placeholder="mobile">
            <input type="text" class="search__field" placeholder="street address">
            <input type="text" class="search__field" placeholder="locality">
            <input type="text" class="search__field" placeholder="country">
        </div>

        <button class="btn btn--red search__btn--1" type="button">remove client</button>
    </form>

    <form action=""  class="search__form" method="POST">

    <!-- 1 --------------------------------------------------------- -->

    <div class="top-pannel">
            <div class="top-pannel__date"><b>search</b></div>

        <div class="top-pannel__buttons">
            <a href="<?= $_ENV['BASE_PATH'] ?>/clients-add" class="btn btn--light">add new client</a>
            <button class="btn btn--red modalBtn" type="button">remove client</button>
        </div>
    </div>


    <!-- 2 --------------------------------------------------------- -->


    <div class="search__tabs">
        <a href="" class="search__tab search__tab--active">Clients</a>
        <a href="" class="search__tab">Projects</a>
    </div>

    <!-- 3 --------------------------------------------------------- -->

    <div class="search__errors">
        error placeholder! .... error placeholder! ....
    </div>

    

    <!-- 4 --------------------------------------------------------- -->

    <div class="search__placeholder"></div>

    <!-- 5 --------------------------------------------------------- -->


    <?php require './app/views/tables/viewClientsTable.php'?>


    <!-- 6 --------------------------------------------------------- -->

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