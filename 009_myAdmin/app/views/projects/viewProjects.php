<section class="projects">
<form action="#"  class="projects__form">

    <div class="top-pannel">
        <div class="top-pannel__date"><b>projects</b> list</div>
            
        <div class="top-pannel__buttons">
            <a href="<?= $_ENV['BASE_PATH']?>/projects-add" class="btn btn--light">add new poject</a>
            <button class="btn btn--red">remove project</button>
        </div>
    </div>
    
    <div class="table__container" id="table-container">

        <table class="table ">
            <thead class="table__thead ">
                <th class="table__th">select</th>
                <th class="table__th">links</th>
                <th class="table__th">DB #</th>
                <th class="table__th">project</th>
                <th class="table__th">locality</th>
                <th class="table__th">client</th>
                <th class="table__th">project #</th>
                <th class="table__th">pa #</th>
                <th class="table__th">images</th>
                <th class="table__th">status</th>
                <th class="table__th">category</th>
                <th class="table__th">date</th>
                <th class="table__th">address</th>
            </thead>
            
            <tbody class="table__tbody">

            
    
                
               
                <!-- ----------------------------------------------- -->
                <?php $tr = true; ?>
                <?php foreach($projectList as $p): ?>
                <?php $tr = !$tr; ?>

                <tr class="table__tr table__tr--<?= $tr ?>">

                    <td class="table__td">
                    <label class="checkbox-2" >
                        <input type="checkbox" class="checkbox-2__input">
                        <svg class="checkbox-2__icon checkbox-2__icon--unchecked"><use href="./app/static/svg/icomoon.svg#icon-checkbox-6"></use></svg>
                        <svg class="checkbox-2__icon checkbox-2__icon--checked"><use href="./app/static/svg/icomoon.svg#icon-checkbox-3"></use></svg>
                    </label>
                    </td>

                    <td class="table__td">
                        <a href="#" class="icon__link" id="table-icon-update">
                            <svg class="icon__svg"> <use xlink:href="./app/static/svg/icomoon.svg#icon-pencil-10"></use></svg>
                        </a>
                        <a href="#" class="icon__link" id="table-icon-details">
                            <svg class="icon__svg"> <use xlink:href="./app/static/svg/icomoon.svg#icon-view-12"></use></svg>
                        </a>
                        <a href="#" class="icon__link" id="table-icon-remove">
                            <svg class="icon__svg"> <use xlink:href="./app/static/svg/icomoon.svg#icon-minus-4"></use></svg>
                        </a>
                    </td>

                    <td class="table__td"><?= $p->getId() ?></td>
                    <td class="table__td"><?= $p->getProjectName() ?></td>
                    <td class="table__td"><?= $p->getLocalityName() ?></td>
                    <td class="table__td"><?= $p->fetchClientName() ?></td>
                    <td class="table__td"><?= $p->getProjectNo() ?></td>
                    <td class="table__td"><?= $p->getPaNo() ?></td>
                    <td class="table__td">
                        <a class="table__a" href="#"><img id="table-images" class="table__img" src="<?= $p->getCover() ?: './app/static/images/upload_img.png' ?>" alt="default image"></a>
                    </td>
                    <td class="table__td"><?= $p->getStageName() ?></td>
                    <td class="table__td"><?= $p->getCategoryName() ?></td>
                    <td class="table__td"><?= $p->getProjectDate() ?></td>
                    <td class="table__td"><?= $p->getStrAddr() ?>, <?= $p->getLocalityName() ?></td>   

                </tr>
                <?php endforeach; ?>
                <!-- ----------------------------------------------- -->
       
            </tbody>
        </table>
    </div>

</form>
</section>


