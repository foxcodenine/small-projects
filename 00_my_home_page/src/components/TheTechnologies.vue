<template>
    <ul class="technologies">
        <span class="technologies__item technologies__item--space" ></span>
        <svg class="technologies__item"><use href="../assets/svg/sprite.svg#icon-php"></use></svg>
        <svg class="technologies__item"><use href="../assets/svg/sprite.svg#icon-laravel"></use></svg>
        <svg class="technologies__item"><use href="../assets/svg/sprite.svg#icon-mysql"></use></svg>
        <svg class="technologies__item"><use href="../assets/svg/sprite.svg#icon-javascript"></use></svg>
        <svg class="technologies__item"><use href="../assets/svg/sprite.svg#icon-vue-dot-js"></use></svg>
        <img class="technologies__item" src="../assets/svg/bash.svg">
        <svg class="technologies__item"><use href="../assets/svg/sprite.svg#icon-git"></use></svg>
        <svg class="technologies__item"><use href="../assets/svg/sprite.svg#icon-aws"></use></svg>
        <svg class="technologies__item"><use href="../assets/svg/sprite.svg#icon-html"></use></svg>
        <svg class="technologies__item"><use href="../assets/svg/sprite.svg#icon-css"></use></svg>
        <svg class="technologies__item"><use href="../assets/svg/sprite.svg#icon-sass"></use></svg>
        <svg class="technologies__item"><use href="../assets/svg/sprite.svg#icon-apache"></use></svg>
    </ul>
</template>

<!--------------------------------------------------------------------->

<script>
export default {

}
</script>

<!--------------------------------------------------------------------->

<style lang="scss" scoped>
@use '../sass/abstracts/' as *;

.technologies {
    
    grid-column: 2 / 10;
    grid-row: 3 / 4;
    transform: translateY(-2rem);
    z-index: 10;
    
    width: 100%;
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(4rem, 1fr));

    @include respond (600) { 
        grid-template-columns: repeat(auto-fit, minmax(3rem, 1fr));
    };
         
    row-gap: 2rem;
    column-gap: 3rem;
    align-items: end;

    margin-bottom: 1rem;

    @include respond (1059) { 
        grid-column: 2 / -2;
        column-gap: 5rem;
        transform: translateY(-1rem);
    };

    &__item {
        width: 5rem;
        height: 5rem;
        padding: .2rem;
        fill: lighten($col-dark, 5%) !important;   
        border: $col-dark 1px solid;
        border-radius: $border-radius;


        
        @include respond (600) { 
            width: 3rem;
            height: 3rem;
        };
        
        &--big {
            width: 5.5rem;
            height: 4.5rem; 
            transform: translateX(-.7rem)translateY(.3rem);

            @include respond (600) { 
                width: 3.7rem;
                height: 3.7rem;
            };
        }

        &--space {
            grid-column: span 6;
            border: none;
            @include respond (1172) { grid-column: span 4; };
            @include respond (1059) { grid-column: span 4; };
            @include respond (979) { grid-column: span 3; };
            @include respond (894) { grid-column: span 2; };
            @include respond (824) { grid-column: span 3; };
            @include respond (787) { grid-column: span 2; };
            @include respond (712) { grid-column: span 2; };
            @include respond (600) { display: none };
        }
    }
    img  {
        width: 5rem;
        height: 5rem;
        padding: 0;
        border: none;

        @include respond (600) { 
            width: 3.2rem;
            height: 3.2rem;
        };
    }
}
</style>