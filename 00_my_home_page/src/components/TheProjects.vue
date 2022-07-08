<template>
    <div class="projects" id="projects">
        <!-- <div class="projects__background"></div> -->

        <div class="projects__shape">
            <span>
            <a href="https://foxcode.io/009" target="_blank" >
                <img src="../assets/img/MyAdmin.png" alt="Person on a tour" class="projects__image">
            </a>
            <p class="projects__description tippy-myadmin" >MyAdmin - PHP CMS </p>
            </span>
        </div>
        
        <div class="projects__shape" >
            <span>
            <a href="https://foxcode.io/002/" target="_blank">
                <img src="../assets/img/JoeFalzonWebSite.png" alt="Person on a tour" class="projects__image">
            </a>
            <p class="projects__description tippy-arch" >Architect Page - NUXT JS</p>
            </span>
        </div> 

        <div class="projects__shape">
            <span>
            <a href="https://foxcode.io/007/" target="_blank">
                <img src="../assets/img/forkify.png" alt="Person on a tour" class="projects__image">
            </a>
            <p class="projects__description tippy-forkify" >Forkify - JavaScript</p>
            </span>
        </div>
        <div class="projects__shape">
            <span>
            <a href="https://foxcode.io/003/" target="_blank">
                <img src="../assets/img/natours.png" alt="Person on a tour" class="projects__image">
            </a>
            <p class="projects__description tippy-natours" >Natours - SASS/CSS</p>
            </span>
        </div>
        <div class="projects__shape">
            <span>
            <a href="https://foxcode.io/004/" target="_blank">
                <img src="../assets/img/trillo.png" alt="Person on a tour" class="projects__image">
            </a>
            <p class="projects__description tippy-trillo" >Trillo - CSS Flexbox</p>
            </span>
        </div> 
        <div class="projects__shape">
            <span>
            <a href="https://foxcode.io/005/" target="_blank">
                <img src="../assets/img/nexter.png" alt="Person on a tour" class="projects__image">
            </a>
            <p class="projects__description tippy-nexter" >Nexter - CSS Grid</p>
            </span>
        </div>
        <div class="projects__shape">
            <span>
            <a href="https://foxcode.io/001/" target="_blank">
                <img src="../assets/img/trava.png" alt="Person on a tour" class="projects__image">
            </a>
            <p class="projects__description tippy-trava" >Trava - Vue / Python</p>
            </span>
        </div>
        <div class="projects__shape">
            <span>
            <a href="https://foxcode.io/006/lesson_11/index.php" target="_blank">
                <img src="../assets/img/iceMalta.png" alt="Person on a tour" class="projects__image ">
            </a>
            <p class="projects__description tippy-icemalta" >Ice-Malta PHP Practical</p>
            </span>
        </div>
        
    </div>
</template>

<!--------------------------------------------------------------------->

<script>
import tippy from 'tippy.js';
import 'tippy.js/dist/tippy.css';
export default {
    mounted() {
        tippy('.tippy-myadmin', {
            content: `It is a CMS site design for an Architect to load and manage its project, and provide a rest APIs for a font-end.
                      It is built using PHP, SASS, JavaScript and Bash scripting. It also stores images on AWS S3 storage system.`,
        });

        tippy('.tippy-arch', {
            content: `It is meant to be the front-end to MyAdmin App. It is built in Vue/NUXT and is still in progress.`,
        });

        tippy('.tippy-forkify', {
            content: `Is a JavaScript App, built during a course I have taken. It uses REST to fetches and load recipes
                     though GET and POST requests, using a 3rd party API.`,
        });

        tippy('.tippy-natours', {
            content: `I have built this page during a course on Advanced CSS and SASS, it's main intent was, in using CSS animation.`,
        });

        tippy('.tippy-trillo', {
            content: `I have built this page during a course on Advanced CSS and SASS, it's main intent was, in using CSS flexbox.`,
        });

        tippy('.tippy-nexter', {
            content: `I have built this page during a course on Advanced CSS and SASS, it's main intent was, in using CSS grid system.`,
        });

        tippy('.tippy-trava', {
            content: `Is my first personal project. It is a Text to Speech App. Originally it was a JavaScript App which I
                      rebuilt in Vue/NUXT, and also added a back-end in Python and MySQL using Flask. It also connects to 
                      AWS to store and delete images on S3 storage system.`,
        });

        tippy('.tippy-icemalta', {
            content: `These were some small task, we had at Icemalta (PHP Course), which led to the PHP Zend certificate.`,
        });
    }
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
        margin-bottom: 2.8rem;

        background: rgba($col-dark, .8);

        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;

        span {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            transform: scale(1);
            transition: all .1s ease;
        }
      
        &:hover {        
            transform: translateY(-1.5rem)scale(1.05);            
            // transform: translateY(-.7rem); 
            // transform: scale(1.05); 

            .projects__image {
                transform: scale(.95); 
            }            

            .projects__description {
                margin-top: -.7rem;
                // transform: scale(1.1); 
                color: $col-secondary;  
                animation: pulsate 1s infinite 1s;              
            }
        }
    }


    &__image {
        width: 100%;       
        height:calc(100%);
        flex: 1;
        object-fit: cover;
        border-radius: 0;   
        
        filter: grayscale(10%) brightness(100%) saturate(100%) contrast(1);

        transition: all .1s ease;
        
        &:hover {            
            filter: brightness(1.02) ; 
            // border-radius: $border-radius; 
                        
        }
    }
    &__description {
        height: 3rem;
        width: 100%;
        color: rgba($col-white, .8);
        // font-family: $font-display;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 1.4rem;
        transition: all .2s ease;
        &:hover {
            transform: scale(1.08) !important;
            animation: none !important;
            color: $col-tertiary !important;
        }
    }

    &__caption {
       display: none;
    }
}
</style>