<template>
    <div class="arrow__container">

        <div class="arrow__hide" >Hide</div>

        <a class="arrow arrow__remove">
            <svg><use href="../assets/svg/sprite.svg#icon-arrow-14" ></use></svg>
        </a>

        <div class="arrow__show">Show</div>
    </div>
</template>

<!--------------------------------------------------------------------->

<script>
export default {
    mounted() {
     
        const arrow = document.querySelector(".arrow");
        const arrowHide = document.querySelector(".arrow__hide");
        const arrowShow = document.querySelector(".arrow__show");

        let observerShow = new IntersectionObserver(function(entries) {
            if(entries[0].isIntersecting === true) {
                arrow.classList.remove('arrow__remove');
                arrow.setAttribute('href', '#home')
            }                 
        }, { threshold: [1] });

        observerShow.observe(arrowShow);

        let observerHide = new IntersectionObserver(function(entries) {
            if(entries[0].isIntersecting === true) {
                arrow.classList.add('arrow__remove');
                arrow.removeAttribute('href')
            }                
        }, { threshold: [1] });

        observerHide.observe(arrowHide);

        
    }
}
</script>

<!--------------------------------------------------------------------->

<style lang="scss" scoped>
@use '../sass/abstracts/' as *;

.arrow {

    &__remove{
        opacity: 0;
        cursor: default;
    }
    

    &__container {
        // border: 1px dashed crimson;
        position: absolute;
        height: 100%;
        width: 3rem;
        z-index: 200;
        right: 1rem;


    }

    &__show, &__hide {
        position: absolute;
        top: 105vh;
        color: transparent;
    }
    &__hide {
        top: 0;
    }
    
    z-index: 100;
    position: fixed;
    float: right;
    // right: 10rem;
    transform: rotate(-90deg);
    background-color: lighten($col-dark, 5%);
    padding: .4rem;
    border-radius: $border-radius;
    width: 3rem;
    height: 3rem;
    bottom: 3.3rem;
    color: #F5F5FA;
    transition: all .2s ease;
    
    &:hover {
        color: lighten($col-tertiary, 0%);
        // animation: jump .8s infinite;
    }
    &:focus{
        color: lighten($col-secondary, 0%);
        // transform: translateY(0)rotate(-90deg) !important;
    }

    svg {
        width: 100%;
        height: 100%;
        fill: currentColor;
    }
}
</style>