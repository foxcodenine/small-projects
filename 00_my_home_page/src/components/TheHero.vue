<template>
    <div class="hero">

        
        <div class="hero__title">
            Chris&nbsp;Farrugia
        </div>
        <div class="hero__text">
            Hi! I'm Chris. I'm a PHP Developer and Zend Certified. 
            I'm skilled in PHP, Laravel, JavaScript, Vue, SQL,  SASS... 
            I'm also handy with Linux, 
            being certified by the Linux Professional Institute,
            and knowledge in Cloud Services, as AWS and Digital Ocean, 
            where I deploy and manage most of my projects.                
        </div>

        <div class="hero__btns">
            <base-button class="btn--secondary" myLink='https://foxcode.io/010/download'>View my CV</base-button>
            <base-button class="btn--secondary btn--git" myLink='https://github.com/foxcodenine' >
                <svg class="git"><use href="../assets/svg/sprite.svg#icon-github"></use></svg>
            </base-button>
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
@use '../sass/abstracts/' as *;


.git {
    fill: currentColor;
    width: 2.5rem;
    height: 2.5rem;
}

.hero {
    grid-column: 2 / -2;
    grid-row: 2 / 3;
    display: grid;
    grid-template-columns: repeat(12, 1fr);
    z-index: 10;




    &__title {
        font-size: 6rem;
        font-weight: 600;
        font-family: $font-display;
        color: lighten($col-dark, 5%);
        fill: $col-white;
        position: relative;
        z-index: 20;

        grid-column: 1 / 7;

        @include respond (1059) { 
            font-size: 5rem;
        };

        @include respond (749) { 
            font-size: 4rem;
        };
    }

    &__text {
        color: lighten($col-dark, 5%);
        font-size: 1.8rem;
        line-height: 1.5;
        letter-spacing: .05rem;
        margin-bottom: 4rem;
        grid-column: 1 / 8;

        @include respond (749) { 
            font-size: 1.6rem;
        };
    }

    &__btns {
        display: flex;
        align-items: center;
        gap: 1.5rem;
        margin-bottom: 6rem;
        grid-column: 1 / 7;

        @include respond (1059) { 
            margin-bottom: 8rem
        };
    }
}
</style>