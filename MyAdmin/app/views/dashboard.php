<!DOCTYPE html>
<html lang="en">

<?php require './app/views/include/header.php'; ?>

<body>
<div class="content">

<?php require './app/views/include/body_upper.php'; ?>   

<main class="pages">

<!-- /////////////////////////////////////////////////////////////// -->

<section class="dashboard">
<form action="#"  class="dashboard__form">

    <div class="top-pannel">
        <div class="top-pannel__date">Wed, 16 Aug <b>10:24PM</b></div>
            
        <div class="top-pannel__buttons">
            <button class="btn btn--light">Hosted</button>
            <button class="btn btn--light">Add</button>
            <button class="btn btn--light">Remove</button>
            <button class="btn btn--light">Delete</button>
        </div>
    </div> 

    <!-- ----------------------------------------------------------- -->
    <div class="frame">
        
        <img class="frame__img" src="./app/static/images/samples/house-1.jpeg" alt="">
        <div class="frame__box">
            <p class="frame__name">
                <span class="frame--top">St Ewdard street</span>
                <span class="frame--bot">Birzebbugia</span>
            </p>                       


            <a href="#" class="icon__link">
                <svg class="icon__svg"> <use xlink:href="./app/static/svg/icomoon.svg#icon-pencil-10"></use></svg>
            </a>

            <a href="#" class="icon__link">
                <svg class="icon__svg"><use xlink:href="./app/static/svg/icomoon.svg#icon-camers-7"></use></svg>
            </a>

            <label class="checkbox-2" >
                <input type="checkbox" class="checkbox-2__input">
                <svg class="checkbox-2__icon checkbox-2__icon--unchecked"><use href="./app/static/svg/icomoon.svg#icon-checkbox-6"></use></svg>
                <svg class="checkbox-2__icon checkbox-2__icon--checked"><use href="./app/static/svg/icomoon.svg#icon-checkbox-3"></use></svg>
            </label>
    
        </div>
    </div>   
    <!-- ----------------------------------------------------------- -->      
    <div class="frame">
        
        <img class="frame__img" src="./app/static/images/samples/house-2.jpeg" alt="">
        <div class="frame__box">
            <p class="frame__name">
                <span class="frame--top">Lasco</span>
                <span class="frame--bot">Zejtun</span>
            </p>                       


            <a href="#" class="icon__link">
                <svg class="icon__svg"> <use xlink:href="./app/static/svg/icomoon.svg#icon-pencil-10"></use></svg>
            </a>

            <a href="#" class="icon__link">
                <svg class="icon__svg"><use xlink:href="./app/static/svg/icomoon.svg#icon-camers-7"></use></svg>
            </a>

            <label class="checkbox-2" >
                <input type="checkbox" class="checkbox-2__input">
                <svg class="checkbox-2__icon checkbox-2__icon--unchecked"><use href="./app/static/svg/icomoon.svg#icon-checkbox-6"></use></svg>
                <svg class="checkbox-2__icon checkbox-2__icon--checked"><use href="./app/static/svg/icomoon.svg#icon-checkbox-3"></use></svg>
            </label>
    
        </div>
    </div>  
    <!-- ----------------------------------------------------------- -->      
    <div class="frame">
        
        <img class="frame__img" src="./app/static/images/samples/house-3.jpeg" alt="">
        <div class="frame__box">
            <p class="frame__name">
                <span class="frame--top">South Street</span>
                <span class="frame--bot">Valletta</span>
            </p>                       


            <a href="#" class="icon__link">
                <svg class="icon__svg"> <use xlink:href="./app/static/svg/icomoon.svg#icon-pencil-10"></use></svg>
            </a>

            <a href="#" class="icon__link">
                <svg class="icon__svg"><use xlink:href="./app/static/svg/icomoon.svg#icon-camers-7"></use></svg>
            </a>

            <label class="checkbox-2" >
                <input type="checkbox" class="checkbox-2__input">
                <svg class="checkbox-2__icon checkbox-2__icon--unchecked"><use href="./app/static/svg/icomoon.svg#icon-checkbox-6"></use></svg>
                <svg class="checkbox-2__icon checkbox-2__icon--checked"><use href="./app/static/svg/icomoon.svg#icon-checkbox-3"></use></svg>
            </label>
    
        </div>
    </div> 
    <!-- ----------------------------------------------------------- -->
    <div class="frame">
        
        <img class="frame__img" src="./app/static/images/samples/house-4.jpeg" alt="">
        <div class="frame__box">
            <p class="frame__name">
                <span class="frame--top">Poetri Street</span>
                <span class="frame--bot">Qormi</span>
            </p>                       


            <a href="#" class="icon__link">
                <svg class="icon__svg"> <use xlink:href="./app/static/svg/icomoon.svg#icon-pencil-10"></use></svg>
            </a>

            <a href="#" class="icon__link">
                <svg class="icon__svg"><use xlink:href="./app/static/svg/icomoon.svg#icon-camers-7"></use></svg>
            </a>

            <label class="checkbox-2" >
                <input type="checkbox" class="checkbox-2__input">
                <svg class="checkbox-2__icon checkbox-2__icon--unchecked"><use href="./app/static/svg/icomoon.svg#icon-checkbox-6"></use></svg>
                <svg class="checkbox-2__icon checkbox-2__icon--checked"><use href="./app/static/svg/icomoon.svg#icon-checkbox-3"></use></svg>
            </label>
    
        </div>
    </div>         
    <!-- ----------------------------------------------------------- -->

</form>
</section>

<!-- /////////////////////////////////////////////////////////////// -->

</main>

</div>
<?php require './app/views/include/body_scripts.php'; ?>
</body>
</html>

