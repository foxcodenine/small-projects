<div class="table__container" id="table-container-client">

<table class="table ">
    <thead class="table__thead ">
        <th class="table__th">chk</th>
        <th class="table__th">btn-s</th>
        <th class="table__th"><a class="table-sort-js" id="getId"           href="?By=getId&sortTable=Client&sortOrder=ASC">db-id</a></th>
        <th class="table__th"><a class="table-sort-js" id="getFirstname"    href="?sortBy=getFirstname&sortTable=Client&sortOrder=ASC">firstname</a></th>
        <th class="table__th"><a class="table-sort-js" id="getLastname"     href="?sortBy=getLastname&sortTable=Client&sortOrder=ASC">lastname</a></th>
        <th class="table__th"><a class="table-sort-js" id="getIdCard"       href="?sortBy=getIdCard&sortTable=Client&sortOrder=ASC">id-no</a></th>
        <th class="table__th"><a class="table-sort-js" id="getCompany"      href="?sortBy=getCompany&sortTable=Client&sortOrder=ASC">company</a></th>
        <th class="table__th"><a class="table-sort-js" id="getEmail"        href="?sortBy=getEmail&sortTable=Client&sortOrder=ASC">email</a></th>
        <th class="table__th"><a class="table-sort-js" id="getPhone"        href="?sortBy=getPhone&sortTable=Client&sortOrder=ASC">phone</a></th>
        <th class="table__th"><a class="table-sort-js" id="getMobile"       href="?sortBy=getMobile&sortTable=Client&sortOrder=ASC">mobile</a></th>
        <th class="table__th"><a class="table-sort-js" id="getStrAddr"      href="?sortBy=getStrAddr&sortTable=Client&sortOrder=ASC">street address</a></th>
        <th class="table__th"><a class="table-sort-js" id="getLocalityName" href="?sortBy=getLocalityName&sortTable=Client&sortOrder=ASC">locality</a></th>
        <th class="table__th"><a class="table-sort-js" id="getCountryName"  href="?sortBy=getCountryName&sortTable=Client&sortOrder=ASC">country</a></th>
        <th class="table__th"><a class="table-sort-js" id="getPostcode"     href="?sortBy=getPostcode&sortTable=Client&sortOrder=ASC">postcode</a></th>
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
            <td class="table__td"><?= stripslashes($client->getCompany()); ?></td>
            <td class="table__td"><?= $client->getEmail(); ?></td>
            <td class="table__td"><?= $client->getPhone(); ?></td>
            <td class="table__td"><?= $client->getMobile(); ?></td>
            <td class="table__td"><?= stripslashes($client->getStrAddr()); ?></td>
            <td class="table__td"><?= stripslashes($client->getLocalityName()); ?></td>
            <td class="table__td"><?= stripslashes($client->getCountryName()); ?></td>
            <td class="table__td"><?= $client->getPostcode(); ?></td>
        </tr>

        <?php endforeach ?>
        <!--  -->

    </tbody>
</table>
</div>