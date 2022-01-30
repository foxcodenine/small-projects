<section class="projects">
<form action="#"  class="projects__form">

    <div class="top-pannel">
        <div class="top-pannel__date"><b>projects</b> List</div>
            
        <div class="top-pannel__buttons">
            <a href="#" class="btn btn--light">add new client</a>
            <button class="btn btn--red">remove client</button>
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
                <tr class="table__tr table__tr--1">

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

                    <td class="table__td">1</td>
                    <td class="table__td">Sirens</td>
                    <td class="table__td">St Pauls Bay</td>
                    <td class="table__td">John Farrugia</td>
                    <td class="table__td">0402</td>
                    <td class="table__td">PA 01236/19</td>
                    <td class="table__td">
                        <a class="table__a" href="#"><img id="table-images" class="table__img" src="./app/static/images/samples/house-1.jpeg" alt="default image"></a>
                    </td>
                    <td class="table__td">Complete</td>
                    <td class="table__td">Commercial</td>
                    <td class="table__td">14/2/2020</td>
                    <td class="table__td">24 Triq San Geraldu, San Pawl il-Baħar</td>   

                </tr>
                <!-- ----------------------------------------------- -->
       
            </tbody>
        </table>
    </div>

</form>
</section>

