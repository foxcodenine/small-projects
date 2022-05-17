<template>
    <div class="projects" id="projects">
        <!-- <div class="projects__background"></div> -->

        <a href="https://foxcode.io/009" target="_blank" class="projects__shape">
            <img src="../assets/img/MyAdmin.png" alt="Person on a tour" class="projects__image">
            <figcaption class="projects__caption"></figcaption>
        </a>
        <a href="https://foxcode.io/002/" target="_blank" class="projects__shape">
            <img src="../assets/img/JoeFalzonWebSite.png" alt="Person on a tour" class="projects__image">
            <figcaption class="projects__caption"></figcaption>
        </a> 

        <a href="https://foxcode.io/007/" target="_blank" class="projects__shape">
            <img src="../assets/img/forkify.png" alt="Person on a tour" class="projects__image">
            <figcaption class="projects__caption"></figcaption>
        </a>
        <a href="https://foxcode.io/003/" target="_blank" class="projects__shape">
            <img src="../assets/img/natours.png" alt="Person on a tour" class="projects__image">
            <figcaption class="projects__caption"></figcaption>
        </a>
        <a href="https://foxcode.io/004/" target="_blank" class="projects__shape">
            <img src="../assets/img/trillo.png" alt="Person on a tour" class="projects__image">
            <figcaption class="projects__caption"></figcaption>
        </a> 
        <a href="https://foxcode.io/005/" target="_blank" class="projects__shape">
            <img src="../assets/img/nexter.png" alt="Person on a tour" class="projects__image">
            <figcaption class="projects__caption"></figcaption>
        </a>
        <a href="https://foxcode.io/001/" target="_blank" class="projects__shape">
            <img src="../assets/img/trava.png" alt="Person on a tour" class="projects__image">
            <figcaption class="projects__caption"></figcaption>
        </a>
        
    </div>
</template>

<!--------------------------------------------------------------------->

<script>
export default {

}
</script>

<!--------------------------------------------------------------------->

<style lang="scss" scoped>
@use '../sass/abstracts/' as *;


.projects {
    grid-column: 1 / -1;
    grid-row: 4 / 5;
    z-index: 10;

    padding: 12rem 8rem 0 8rem;
    margin-bottom: 4rem;
    margin-top: -2rem;

	width: 100%;
	display: grid;
	grid-template-columns:  repeat(auto-fit, minmax(20rem, 1fr)) ;
    row-gap: 4rem;
    column-gap: 6rem;
    overflow: hidden;
    

    &__shape {

        overflow: hidden;
        border-radius: $border-radius;
        border: 1px solid rgba($col-dark, .9);
        box-shadow: $shadow-1;

        transform: translateY(0rem)scale(1);
        transition: all .2s ease;
        margin-bottom: 2rem;

        background-size: cover;
        background-position: center;  
        background-position: top;  
        background-repeat: no-repeat; 

      
        &:hover {        
            transform: translateY(-1.5rem)scale(1.05);            
            box-shadow: $shadow-4;
            transform: translateY(-.7rem); 
            filter: sepia(0%);
        }
    }


    &__image {
        width: 100%;       
        height:100%;
        object-fit: cover;
        object-position: top;  
        border-radius: $border-radius;   
        
        filter: grayscale(10%) brightness(100%) saturate(100%) contrast(1);
        transform: scale(1);
        transition: all .1s ease;
        
        
        &:hover {            
            filter: brightness(1.02) ;  
            transform: scale(.95);             
        }
    }

    &__caption {
       display: none;
    }
}
</style>