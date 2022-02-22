<section class="clients">
<form action="<?= $_ENV['BASE_PATH'] ?>/clients-delete"  class="clients__form" method="POST">

    <div class="top-pannel">
        <div class="top-pannel__date"><b>CLIENTS</b> List</div>
            
        <div class="top-pannel__buttons">
            <a href="<?= $_ENV['BASE_PATH'] ?>/clients-add" class="btn btn--light">add new client</a>
            <button class="btn btn--red modalBtn" type="button">remove client</button>
        </div>
    </div>
    
    <div class="table__container" id="table-container">

        <table class="table ">
            <thead class="table__thead ">
                <th class="table__th">chk</th>
                <th class="table__th">btn-s</th>
                <th class="table__th"><a class="table-sort-js" id="getId"           href="<?= $_ENV['BASE_PATH'] ?>/clients?By=getId&sortOrder=ASC">db-id</a></th>
                <th class="table__th"><a class="table-sort-js" id="getFirstname"    href="<?= $_ENV['BASE_PATH'] ?>/clients?sortBy=getFirstname&sortOrder=ASC">firstname</a></th>
                <th class="table__th"><a class="table-sort-js" id="getLastname"     href="<?= $_ENV['BASE_PATH'] ?>/clients?sortBy=getLastname&sortOrder=ASC">lastname</a></th>
                <th class="table__th"><a class="table-sort-js" id="getIdCard"       href="<?= $_ENV['BASE_PATH'] ?>/clients?sortBy=getIdCard&sortOrder=ASC">id-no</a></th>
                <th class="table__th"><a class="table-sort-js" id="getCompany"      href="<?= $_ENV['BASE_PATH'] ?>/clients?sortBy=getCompany&sortOrder=ASC">company</a></th>
                <th class="table__th"><a class="table-sort-js" id="getEmail"        href="<?= $_ENV['BASE_PATH'] ?>/clients?sortBy=getEmail&sortOrder=ASC">email</a></th>
                <th class="table__th"><a class="table-sort-js" id="getPhone"        href="<?= $_ENV['BASE_PATH'] ?>/clients?sortBy=getPhone&sortOrder=ASC">phone</a></th>
                <th class="table__th"><a class="table-sort-js" id="getMobile"       href="<?= $_ENV['BASE_PATH'] ?>/clients?sortBy=getMobile&sortOrder=ASC">mobile</a></th>
                <th class="table__th"><a class="table-sort-js" id="getStrAddr"      href="<?= $_ENV['BASE_PATH'] ?>/clients?sortBy=getStrAddr&sortOrder=ASC">street address</a></th>
                <th class="table__th"><a class="table-sort-js" id="getLocalityName" href="<?= $_ENV['BASE_PATH'] ?>/clients?sortBy=getLocalityName&sortOrder=ASC">locality</a></th>
                <th class="table__th"><a class="table-sort-js" id="getCountryName"  href="<?= $_ENV['BASE_PATH'] ?>/clients?sortBy=getCountryName&sortOrder=ASC">country</a></th>
                <th class="table__th"><a class="table-sort-js" id="getPostcode"     href="<?= $_ENV['BASE_PATH'] ?>/clients?sortBy=getPostcode&sortOrder=ASC">postcode</a></th>
            </thead>
            
            <tbody class="table__tbody">

                <!--  -->
                <?php $tr = false; ?>
                <?php foreach($clientList as $client): ?>
                <?php $tr = !$tr; ?>
                
                

                <tr class="table__tr table__tr--<?= $tr?> ">

                    <td class="table__td">
                    <label class="checkbox-2" >
                    <!-- <input type="hidden"> TODO: to remove  --> 
                        <input type="checkbox" class="checkbox-2__input client-checkbox"  name="clientsDeleteList[]" value="<?= $client->getId()?>" id="client-id-checkbox-<?= $client->getId(); ?>">
                        <svg class="checkbox-2__icon checkbox-2__icon--unchecked"><use href="./app/static/svg/icomoon.svg#icon-checkbox-6"></use></svg>
                        <svg class="checkbox-2__icon checkbox-2__icon--checked"><use href="./app/static/svg/icomoon.svg#icon-checkbox-3"></use></svg>
                    </label>
                    </td>

                    <td class="table__td">
                        <a href="<?= $_ENV['BASE_PATH'] ?>/clients-edit<?= $client->getId();?>" class="icon__link" id="table-icon-update">
                            <svg class="icon__svg"> <use xlink:href="./app/static/svg/icomoon.svg#icon-pencil-10"></use></svg>
                        </a>
                        <a href="<?= $_ENV['BASE_PATH'] ?>/clients-details<?= $client->getId();?>" class="icon__link" id="table-icon-details">
                            <svg class="icon__svg"> <use xlink:href="./app/static/svg/icomoon.svg#icon-view-12"></use></svg>
                        </a>
                        <a  class="icon__link client-remove-link" id="client-id-link-<?= $client->getId(); ?>">
                            <svg class="icon__svg "> <use xlink:href="./app/static/svg/icomoon.svg#icon-minus-4" ></use></svg>
                        </a>
                    </td>

                                 
                    <td class="table__td"><?= $client->getId(); ?></td>
                    <td class="table__td"><?= $client->getFirstname(); ?></td>
                    <td class="table__td"><?= $client->getLastname(); ?></td>
                    <td class="table__td"><?= $client->getIdCard(); ?></td>
                    <td class="table__td"><?= $client->getCompany(); ?></td>
                    <td class="table__td"><?= $client->getEmail(); ?></td>
                    <td class="table__td"><?= $client->getPhone(); ?></td>
                    <td class="table__td"><?= $client->getMobile(); ?></td>
                    <td class="table__td"><?= $client->getStrAddr(); ?></td>
                    <td class="table__td"><?= $client->getLocalityName(); ?></td>
                    <td class="table__td"><?= $client->getCountryName(); ?></td>
                    <td class="table__td"><?= $client->getPostcode(); ?></td>
                </tr>

                <?php endforeach ?>
                <!--  -->
       
            </tbody>
        </table>
    </div>



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
