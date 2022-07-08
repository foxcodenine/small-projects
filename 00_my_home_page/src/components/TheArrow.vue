<template>
    <div class="arrow__container">

        <div class="arrow__pos-top" >.</div>

        <a class="arrow arrow__remove">
            <svg><use href="../assets/svg/sprite.svg#icon-arrow-14" ></use></svg>
        </a>

    </div>
</template>

<!--------------------------------------------------------------------->

<script>
export default {
    mounted() {
     
        const arrow = document.querySelector(".arrow");
        const arrowTop = document.querySelector(".arrow__pos-top");


        let observerHide = new IntersectionObserver(function(entries) {
            if(entries[0].isIntersecting === true) {
                arrow.classList.add('arrow__remove');
                arrow.removeAttribute('href')
            } else {
                arrow.classList.remove('arrow__remove');
                arrow.setAttribute('href', '#home')
            }               
        }, { threshold: [1] });

        observerHide.observe(arrowTop);
        
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
        height: calc(100% - 1rem);
        width: 3rem;
        z-index: 200;
        right: 1rem;
    }

    &__pos-top {
        position: absolute;
        top: 105vh;
        top: 10rem;
        opacity: 0;
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
    bottom: 2.5rem;
    color: #F5F5FA;
    transition: all .2s ease;
    
    &:hover {
        color: lighten($col-tertiary, 0%);
        // animation: jump .8s infinite;
    }
    &:focus{
        color: lighten($col-secondary, 0%);
    }

    svg {
        width: 100%;
        height: 100%;
        fill: currentColor;
    }
}
</style>