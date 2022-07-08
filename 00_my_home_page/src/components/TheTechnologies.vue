<template>
    <ul class="technologies ">
        <span class="technologies__item technologies__item--space" ></span>
        <svg class="technologies__item tippy-php"><use href="../assets/svg/sprite.svg#icon-php" ></use></svg>
        <svg class="technologies__item tippy-laravel"><use href="../assets/svg/sprite.svg#icon-laravel"></use></svg>
        <svg class="technologies__item tippy-mysql"><use href="../assets/svg/sprite.svg#icon-mysql"></use></svg>
        <svg class="technologies__item tippy-js"><use href="../assets/svg/sprite.svg#icon-javascript"></use></svg>
        <svg class="technologies__item tippy-vue"><use href="../assets/svg/sprite.svg#icon-vue-dot-js"></use></svg>
        <img class="technologies__item tippy-bash" src="../assets/svg/bash.svg">
        <svg class="technologies__item tippy-git"><use href="../assets/svg/sprite.svg#icon-git"></use></svg>
        <svg class="technologies__item tippy-aws"><use href="../assets/svg/sprite.svg#icon-aws"></use></svg>
        <svg class="technologies__item tippy-html"><use href="../assets/svg/sprite.svg#icon-html"></use></svg>
        <svg class="technologies__item tippy-css"><use href="../assets/svg/sprite.svg#icon-css"></use></svg>
        <svg class="technologies__item tippy-sass"><use href="../assets/svg/sprite.svg#icon-sass"></use></svg>
        <svg class="technologies__item tippy-apache"><use href="../assets/svg/sprite.svg#icon-apache"></use></svg>
    </ul>
</template>

<!--------------------------------------------------------------------->

<script>
// import tippy from 'tippy.js';
// import 'tippy.js/dist/tippy.css';
export default {

    mounted() {
        // tippy('.tippy-php', {
        //     content: `★ ★ ★ ★ ☆`,
        // });
        // tippy('.tippy-laravel', {
        //     content: `★ ★ ⯪ ☆ ☆`,
        // });
        // tippy('.tippy-mysql', {
        //     content: `★ ★ ⯪ ☆ ☆`,
        // });
        // tippy('.tippy-js', {
        //     content: `★ ★ ★ ⯪ ☆`,
        // });
        // tippy('.tippy-vue', {
        //     content: `★ ★ ★ ★ ☆`,
        // });
        // tippy('.tippy-git', {
        //     content: `★ ★ ☆ ☆ ☆`,
        // });
        // tippy('.tippy-bash', {
        //     content: `★ ★ ⯪ ☆ ☆`,
        // });
        // tippy('.tippy-aws', {
        //     content: `★ ★ ☆ ☆ ☆`,
        // });
        // tippy('.tippy-html', {
        //     content: `★ ★ ★ ⯪ ☆`,
        // });
        // tippy('.tippy-css', {
        //     content: `★ ★ ★ ⯪ ☆`,
        // });
        // tippy('.tippy-sass', {
        //     content: `★ ★ ★ ★ ☆`,
        // });
        // tippy('.tippy-apache', {
        //     content: `★ ★ ☆ ☆ ☆`,
        // });
    }

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