<section class="search">

    <!-- /////////////////////////////////////////////////////////// -->
    <!-- Search Clients form -->

    <form id="serch-query-form-client" action="" class="search__query-form ">

        <div class="search__fields">
            <input type="text" class="search__field" placeholder="firstname">
            <input type="text" class="search__field" placeholder="lastname">
            <input type="text" class="search__field" placeholder="id">
            <input type="text" class="search__field" placeholder="company">
            <input type="text" class="search__field" placeholder="email">
            <input type="text" class="search__field" placeholder="phone / mobile">
            <input type="text" class="search__field search__field--span2" placeholder="street address">

            <div class=" search__field search__field--select">
                <select name="" id="" class="search__select" id="client" required>
                    <option value="" selected hidden">Locality...</option>
                    <option value="">Dorothy Cassar</option>
                    <option value="">Joelle Ellul</option>
                    <option value="">Danine Leonardi</option>
                </select>
                <svg class="search__down-arrow">
                    <use xlink:href="./app/static/svg/icomoon.svg#icon-arrow_drop_down"></use>
                </svg>
            </div>
            
            <div class=" search__field search__field--select" >
                <select name="" id="" class="search__select" id="client" required>
                    <option value="" selected hidden">Country...</option>
                    <option value="">Dorothy Cassar</option>
                    <option value="">Joelle Ellul</option>
                    <option value="">Danine Leonardi</option>
                </select>
                <svg class="search__down-arrow">
                    <use xlink:href="./app/static/svg/icomoon.svg#icon-arrow_drop_down"></use>
                </svg>
            </div>

            <button class="btn btn--dark search__btn--1" type="button">search</button>
        </div>

    </form>

    <!-- /////////////////////////////////////////////////////////// -->
    <!-- Search Project form -->

    <form id="serch-query-form-project" action="" class="search__query-form search__hidden">

        <div class="search__fields">
            
            <input type="text" class="search__field search__field--span2" placeholder="Project Name">

            <div class=" search__field search__field--span2 search__field--select" >
                <select name="" id="" class="search__select" id="client" required>
                    <option value="" selected hidden">Client...</option>
                    <option value="">Dorothy Cassar</option>
                    <option value="">Joelle Ellul</option>
                    <option value="">Danine Leonardi</option>
                </select>
                <svg class="search__down-arrow">
                    <use xlink:href="./app/static/svg/icomoon.svg#icon-arrow_drop_down"></use>
                </svg>
            </div>

            <input type="text" class="search__field " placeholder="Street Address">
            

            <div class=" search__field search__field--select">
                <select name="" id="" class="search__select" id="client" required>
                    <option value="" selected hidden">Locality...</option>
                    <option value="">Dorothy Cassar</option>
                    <option value="">Joelle Ellul</option>
                    <option value="">Danine Leonardi</option>
                </select>
                <svg class="search__down-arrow">
                    <use xlink:href="./app/static/svg/icomoon.svg#icon-arrow_drop_down"></use>
                </svg>
            </div>


            <input type="text" class="search__field" placeholder="Project No">
            <input type="text" class="search__field" placeholder="PA No">

            <div class=" search__field  search__field--select">
                <select name="" id="" class="search__select" id="client" required>
                    <option value="" selected hidden">Stage...</option>
                    <option value="">Dorothy Cassar</option>
                    <option value="">Joelle Ellul</option>
                    <option value="">Danine Leonardi</option>
                </select>
                <svg class="search__down-arrow">
                    <use xlink:href="./app/static/svg/icomoon.svg#icon-arrow_drop_down"></use>
                </svg>
            </div>
            
            <div class=" search__field  search__field--select" >
                <select name="" id="" class="search__select" id="client"  required>
                    <option value="" selected hidden">Category...</option>
                    <option value="">Dorothy Cassar</option>
                    <option value="">Joelle Ellul</option>
                    <option value="">Danine Leonardi</option>
                </select>
                <svg class="search__down-arrow">
                    <use xlink:href="./app/static/svg/icomoon.svg#icon-arrow_drop_down"></use>
                </svg>
            </div>



            <button class="btn btn--dark search__btn--1" type="button">search</button>

        </div>

        

    </form>

    <!-- /////////////////////////////////////////////////////////// -->

    <form  action=""  class="search__form" method="POST">

    <!-- 1 --------------------------------------------------------- -->

        <div class="top-pannel">
                <div class="top-pannel__date"><b>search</b></div>

            <div class="top-pannel__buttons">
                <a href="<?= $_ENV['BASE_PATH'] ?>/clients-add" class="btn btn--light">add new client</a>
                <button class="btn btn--red modalBtn" type="button">remove client</button>
            </div>
        </div>


    <!-- 2 --------------------------------------------------------- -->


        <div   id="search-tabs"         class="search__tabs" >
            <a id="search-client-tab"   class="search__tab search__tab--active" >Clients</a>
            <a id="search-project-tab"  class="search__tab search__tab--active" >Projects</a>
        </div>

    <!-- 3 --------------------------------------------------------- -->


        <div class="search__errors" id="search-errors-client">
            clients error placeholder! .... clients error placeholder! ....
        </div>

        <div class="search__errors search__hidden" id="search-errors-project">
            projects error placeholder! .... projects error placeholder! ....
        </div>

        
    <!-- 4 --------------------------------------------------------- -->

        <div class="search__placeholder"></div>

    <!-- 5 --------------------------------------------------------- -->


        <?php require './app/views/tables/viewClientsTable.php'?>
        <?php require './app/views/tables/viewProjectsTable.php'?>


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


    <!-- /////////////////////////////////////////////////////////// -->

</section>