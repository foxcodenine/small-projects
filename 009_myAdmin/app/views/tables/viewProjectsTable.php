<div class="table__container" id="table-container-project">

    <table class="table ">
        <thead class="table__thead ">
            <th class="table__th">select</th>
            <th class="table__th">links</th>
    
            <th class="table__th"><a class="table-sort-js" id="getId"           href="?sortBy=getId&sortTable=Project&sortOrder=ASC">DB-id</a></th>

            <th class="table__th"><a class="table-sort-js" id="getProjectname"  href="?sortBy=getProjectname&sortTable=Project&sortOrder=ASC">project</a></th>

            <th class="table__th"><a class="table-sort-js" id="getLocalityName"  href="?sortBy=getLocalityName&sortTable=Project&sortOrder=ASC">locality</a></th>

            <th class="table__th"><a class="table-sort-js" id="fetchClientName"  href="?sortBy=fetchClientName&sortTable=Project&sortOrder=ASC">client</a></th>

            <th class="table__th"><a class="table-sort-js" id="getProjectNo"  href="?sortBy=getProjectNo&sortTable=Project&sortOrder=ASC">project #</a></th>

            <th class="table__th"><a class="table-sort-js" id="getPaNo"  href="?sortBy=getPaNo&sortTable=Project&sortOrder=ASC">pa #</a></th>

            <th class="table__th">images</th>

            <th class="table__th"><a class="table-sort-js" id="getStageName"  href="?sortBy=getStageName&sortTable=Project&sortOrder=ASC">stage</a></th>

            <th class="table__th"><a class="table-sort-js" id="getCategoryName"  href="?sortBy=getCategoryName&sortTable=Project&sortOrder=ASC">category</a></th>

            <th class="table__th"><a class="table-sort-js" id="getProjectDate"  href="?sortBy=getProjectDate&sortTable=Project&sortOrder=ASC">date</a></th>

            <th class="table__th"><a class="table-sort-js" id="getStrAddr"  href="?sortBy=getStrAddr&sortTable=Project&sortOrder=ASC">address</a></th>
        </thead>
        
        <tbody class="table__tbody">    
            
            
            <!-- ----------------------------------------------- -->
            <?php $tr = true; ?>
            <?php foreach($projectList as $p): ?>
            <?php $tr = !$tr; ?>

            <tr class="table__tr table__tr--<?= $tr ?>">

                <td class="table__td">
                <label class="checkbox-2" >
                    <input type="checkbox" class="checkbox-2__input project-checkbox" name="projectsDeleteList[]" value="<?= $p->getId()?>" id="project-id-checkbox-<?= $p->getId(); ?>">
                    <svg class="checkbox-2__icon checkbox-2__icon--unchecked"><use href="./app/static/svg/icomoon.svg#icon-checkbox-6"></use></svg>
                    <svg class="checkbox-2__icon checkbox-2__icon--checked"><use href="./app/static/svg/icomoon.svg#icon-checkbox-3"></use></svg>
                </label>
                </td>

                <td class="table__td">
                    <a href="<?= $_ENV['BASE_PATH'] ?>/projects-edit<?= $p->getId() ?>" class="icon__link" id="table-icon-update">
                        <svg class="icon__svg"> <use xlink:href="./app/static/svg/icomoon.svg#icon-pencil-10"></use></svg>
                    </a>
                    <a href="<?= $_ENV['BASE_PATH'] ?>/projects-detail-<?= $p->getId() ?>" class="icon__link" id="table-icon-details">
                        <svg class="icon__svg"> <use xlink:href="./app/static/svg/icomoon.svg#icon-view-12"></use></svg>
                    </a>
                    <a class="icon__link  project-remove-link" id="project-id-link-<?= $p->getId(); ?>">
                        <svg class="icon__svg"> <use xlink:href="./app/static/svg/icomoon.svg#icon-minus-4"></use></svg>
                    </a>



                </td>

                <td class="table__td"><?= $p->getId() ?></td>
                <td class="table__td"><?= stripslashes($p->getProjectName()) ?></td>
                <td class="table__td"><?= stripslashes($p->getLocalityName()) ?></td>
                <td class="table__td"><?= $p->fetchClientName() ?></td>
                <td class="table__td"><?= $p->getProjectNo() ?></td>
                <td class="table__td"><?= $p->getPaNo() ?></td>
                <td class="table__td">
                    <a class="table__a" href="<?= $_ENV['BASE_PATH'] . '/projects-images-' . $p->getId() ?>">
                        <img id="table-images" 
                            class="table__img" 
                            src="<?= $p->getThumbnail() ?: '' ?>"
                            onerror="this.src='<?= './app/static/images/upload_img.png' ?>'"
                            alt="default image"
                        >
                    </a>
                </td>
                <td class="table__td"><?= $p->getStageName() ?></td>
                <td class="table__td"><?= $p->getCategoryName() ?></td>
                <td class="table__td"><?= $p->formatDateForDisplay() ?></td>
                <td class="table__td"><?= stripslashes( $p->getStrAddr()) ?>, <?= stripslashes($p->getLocalityName()) ?></td>   

            </tr>
            <?php endforeach; ?>
            <!-- ----------------------------------------------- -->
    
        </tbody>
    </table>
    
</div>