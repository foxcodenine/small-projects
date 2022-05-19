<template>
    <div class="footer" id="contacts">

        <div class="footer__title footer__title--1">Get in touch</div>

        <div class="footer__left">
            <p>chris12aug@yahoo.com</p>
            <p>+356 79310212</p>
            <p>61 'Koala',&nbsp;&nbsp;St&nbsp;Edward&nbsp;street,&nbsp;&nbsp;Birzebbuga,&nbsp;&nbsp;Malta EU</p>
        </div>

        <div class=" footer__title footer__title--2">Social Media</div>

        <div class="footer__right">
            <a href="https://github.com/foxcodenine" target="_blank" class="footer__link"><svg  class="footer__icon"><use href="../assets/svg/sprite.svg#icon-github"></use></svg></a>
            <a href="https://www.linkedin.com/in/christopher-farrugia-3a51184b/" target="_blank" class="footer__link"><svg  class="footer__icon"><use href="../assets/svg/sprite.svg#icon-linkedin"></use></svg></a>
            <a href="https://www.facebook.com/chrisfarrugia12/" target="_blank" class="footer__link"><svg  class="footer__icon"><use href="../assets/svg/sprite.svg#icon-facebook"></use></svg></a>
        </div>

        <div class="footer__bottom">... design & built in Vue & Sass!</div>
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

.footer {

    color: lighten($color: $col-dark, $amount: 5%);

    grid-column: 1 / -1;
    grid-row: 6 / 7;
    z-index: 10;

    min-height: 10rem;

    padding-top: 4rem;
    width: 100%;
	display: grid;
	grid-template-columns: 8rem repeat(12, 1fr) 8rem;

    &__title {    
        text-shadow: 2px 3px 5px rgba(0,0,0,0.3);
    
        font-family: $font-display;
        font-size: 3.5rem;
        margin-bottom: 2rem;

        @include respond (1100) {
            font-size: 3rem;
        };

        &--1 {
            grid-column: 2 / 6;
            grid-row: 1 / 2;
        }

        &--2 {
            grid-column: -6 / -2;
            grid-row: 1 / 2;
            text-align: end;
        }
    }

    &__left {
        grid-column: 2 / 9;
        margin-bottom: 3rem;
        text-shadow: 2px 3px 5px rgba(0,0,0,0.3);

        

        p { 
            margin-bottom: .5rem;
            font-size: 1.5rem;
            font-family: $font-display;
       
            &:last-child {
                margin-top: -.3rem;
            }
            @include respond (1100) {
                font-size: 1.5rem;

            };
        }
    }

    &__right {
        grid-column: -6 / -2;
        display: flex;
        justify-content: flex-end;
        gap: 2rem;
    }

    &__link:visited, &__link:link {
        color: currentColor;
    }

    &__icon {
        
        height: 3.2rem;
        width: 3.2rem;
        fill: currentColor;
        border: 1px solid currentColor;
        border-radius: $border-radius;
        padding: .3rem;

        display: block;
        margin: auto;
        box-shadow: 2px 3px 5px rgba(0,0,0,0.2);


        @include respond (1100) {
            height: 2.5rem;
            width: 2.5rem;
        };
        
        &:hover {
            background-color:  $col-tertiary;
        }
    }

    &__bottom {
        grid-column: 1 / -1;
        background-color: lighten($color: $col-dark, $amount: 5%);
        color: $col-white;
        margin-top: 2rem;
        padding: 2rem;
        text-align: center;
        letter-spacing: .2rem;
    }

}
</style>