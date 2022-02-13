<section class="clients">
<form action="#"  class="clients__form">

    <div class="top-pannel">
        <div class="top-pannel__date"><b>CLIENTS</b> List</div>
            
        <div class="top-pannel__buttons">
            <a href="#" class="btn btn--light">add new client</a>
            <button class="btn btn--red">remove client</button>
        </div>
    </div>
    
    <div class="table__container" id="table-container">

        <table class="table ">
            <thead class="table__thead ">
                <th class="table__th">chk</th>
                <th class="table__th">btn-s</th>
                <th class="table__th">db id</th>
                <th class="table__th">firstname</th>
                <th class="table__th">lastname</th>
                <th class="table__th">ID No</th>
                <th class="table__th">company</th>
                <th class="table__th">client No</th>
                <th class="table__th">phone</th>
                <th class="table__th">mobile</th>
                <th class="table__th">street address</th>
                <th class="table__th">locality</th>
                <th class="table__th">country</th>
                <th class="table__th">postcode</th>
            </thead>
            
            <tbody class="table__tbody">

                <!--  -->
                <?php $tr = false; ?>
                <?php foreach($clientList as $client): ?>
                <?php $tr = !$tr; ?>
                
                

                <tr class="table__tr table__tr--<?= $tr?> ">

                    <td class="table__td">
                    <label class="checkbox-2" >
                        <input type="checkbox" class="checkbox-2__input">
                        <svg class="checkbox-2__icon checkbox-2__icon--unchecked"><use href="./app/static/svg/icomoon.svg#icon-checkbox-6"></use></svg>
                        <svg class="checkbox-2__icon checkbox-2__icon--checked"><use href="./app/static/svg/icomoon.svg#icon-checkbox-3"></use></svg>
                    </label>
                    </td>

                    <td class="table__td">
                        <a href="/009/clients-edit<?= $client->getId(); ?>" class="icon__link" id="table-icon-update">
                            <svg class="icon__svg"> <use xlink:href="./app/static/svg/icomoon.svg#icon-pencil-10"></use></svg>
                        </a>
                        <a href="#" class="icon__link" id="table-icon-details">
                            <svg class="icon__svg"> <use xlink:href="./app/static/svg/icomoon.svg#icon-view-12"></use></svg>
                        </a>
                        <a href="#" class="icon__link" id="table-icon-remove">
                            <svg class="icon__svg"> <use xlink:href="./app/static/svg/icomoon.svg#icon-minus-4"></use></svg>
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

</form>
</section>


