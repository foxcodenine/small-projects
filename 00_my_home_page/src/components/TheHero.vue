<template>
    <div class="hero">
        <div class="hero__background"></div>

        <div class="hero__left">
            <div class="hero__title">
                Chris&nbsp;Farrugia
            </div>
            <div class="hero__text">
                Hi! I'm Chris. I'm a PHP Developer and Zend Certified. 
                I'm skilled in PHP, Laravel, JavaScript, Vue, SQL,  SASS... 
                I'm also handy with Linux, <span style="display:none;"> 
                being certified by the Linux Professional Institute, </span>
                and in Cloud Services, such as AWS and Digital Ocean, 
                where I deploy and manage most of my projects.                
            </div>

            <div class="flex">
                <base-button class="btn--secondary">Download CV</base-button>
                <base-button class="btn--secondary btn--git" myLink='https://github.com/foxcodenine'>
                    <svg class="git"><use href="../assets/svg/sprite.svg#icon-github"></use></svg>
                </base-button>
            </div>

            <ul class="technologies">
                <svg class="technologies__item technologies__item--big"><use href="../assets/svg/sprite.svg#icon-mysql"></use></svg>
                <svg class="technologies__item"><use href="../assets/svg/sprite.svg#icon-php"></use></svg>
                <svg class="technologies__item"><use href="../assets/svg/sprite.svg#icon-laravel"></use></svg>
                <svg class="technologies__item"><use href="../assets/svg/sprite.svg#icon-javascript"></use></svg>
                <svg class="technologies__item"><use href="../assets/svg/sprite.svg#icon-vue-dot-js"></use></svg>
                <img src="../assets/svg/bash.svg">
                <svg class="technologies__item"><use href="../assets/svg/sprite.svg#icon-sass"></use></svg>
                <svg class="technologies__item"><use href="../assets/svg/sprite.svg#icon-git"></use></svg>
                <svg class="technologies__item"><use href="../assets/svg/sprite.svg#icon-apache"></use></svg>
                <svg class="technologies__item"><use href="../assets/svg/sprite.svg#icon-aws"></use></svg>
            </ul>
        </div>

        <div class="hero__right">
            <img src="../assets/img/pofile_image2.png" alt="">            
        </div>
    </div>
</template>

<!--------------------------------------------------------------------->

<script>

export default {

}
</script>

<!--------------------------------------------------------------------->

<style lang="scss" scoped>
@use '../../sass/abstracts/' as *;

.flex {
    display: flex;
    align-items: center;
    gap: 1.5rem;
}

.git {
    fill: currentColor;
    width: 2.5rem;
    height: 2.5rem;
}

.technologies {
    z-index: 200;
    display: grid;
    position: absolute;
    bottom: .5rem;
    left: 0rem;
    width: 120%;

 
    grid-template-columns: repeat(auto-fit, minmax(3.5rem, 1fr));
    gap: 4rem;
    row-gap: 1.5rem;
    align-items: center;

    &__item {
        width: 3.5rem;
        height: 3.5rem;
        fill: lighten($col-dark, 5%) !important;     
        
        &--big {
            width: 5rem;
            height: 4rem; 
        }
    }
    @include respond ($bp-largest) { 
    width: 120%;
    };
    @include respond (1100) { 
    width: 100%;
    padding: 0 8rem; 
    };
}

.hero {
    position: relative;
    display:  flex;
    justify-content: space-between;
    padding: 0 10rem; 
    gap: 2rem;
    height: 60rem;


    @include respond ($bp-largest) { 
    
    height: 55rem;
    };

    @include respond (1100) { 
        padding: 0 8rem;
        height: 60rem;
    };
    @include respond (1030) {
        height: 62rem;
    };
    @include respond (1000) { 
        height: 56rem;
    };
    @include respond (900) { 
        height: 56rem;
    };
       
    &__background {
        position: absolute;
        width: 100%;
        left: 0;
        height: 51rem;
        background-color: lighten($col-light, 5%);
        clip-path: polygon(0 0 , 100% 0, 100% 70%, 0% 100%);
        z-index: 1;

        @include respond (1100) { height: 54rem; };
        @include respond (1000) { height: 48rem; };

        &::before {  
            content: '';
            background-image: url(../assets/img/hero_bg.png);
            background-position-y: -20rem;
   
            background-size:100%;
            background-repeat: no-repeat;
            width: 110%;
            opacity: .3;

            transform: translateX(-3rem);
      
            position: absolute;   top: 0; right: 0; bottom: 0; left: 0;
            z-index: -1;

            @include respond (1200) { background-position-y: -12rem; };
            @include respond (1100) { background-position-y: 0rem; };
            @include respond (900) { background-position-y: 5rem; };            
        }
    }

    &__left {
        z-index: 10;
        flex: 0 0 47%;
        position: relative;

        margin-top: 13rem;

        @include respond ($bp-largest) {
        flex: 0 0 55%;
        }

        @include respond (1100) {
        position: static;
        }

    }

    &__right {  
        position: relative;
        z-index: 5;
        flex: 0 0 33%; 
        border: 1rem solid $col-white;
        border-radius: $border-radius;

        height: 52rem;
        @include respond ($bp-largest) {
            height: min-content;
        }


        margin-top: 15rem;

        img {
            width: 100%;       
            height: 50rem;

            object-fit: cover;
            object-position: top;
            z-index: 20;
            box-shadow: $shadow-3;
            border-radius: $border-radius;

            @include respond ($bp-largest) {
                max-height: 50rem;
                height: 33vw;
                min-height: 29rem;
            }
            @include respond ($bp-large) {
                max-height: 38rem;
                height: 33vh;
                min-height: 29rem;
            }
        }
    }

    &__icon {
        position: absolute;
        right: 0;
        top: 0rem;
        transform: scale(3.9)rotate(0deg)translateY(4.4rem)translateX(-3.2rem);
        width: 15rem;
        z-index: -10;  
        fill: $col-secondary;  
    }

    &__title {
        font-size: 6rem;
        font-weight: 600;
        font-family: $font-display;
        color: lighten($col-dark, 5%);
        fill: $col-white;
        position: relative;
        z-index: 20;


        @include respond ($bp-largest) {
            font-size: 5rem;
        }
    }

    &__text {
        color: lighten($col-dark, 5%);
        font-size: 1.8rem;
        line-height: 1.5;
        letter-spacing: .05rem;
        margin-bottom: 4rem;

        @include respond ($bp-largest) { font-size: 1.6rem; }
        @include respond (1100) { margin-bottom: 8rem; };
        @include respond (1000) { margin-bottom: 4rem; };
    }
}
</style>