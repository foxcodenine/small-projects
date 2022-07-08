<template>
    <div class="certification">
        <div v-on:click='closeCertifications' class="certification__bg"></div>
        <div class="certification__img">
            <img :src="require(`@/assets/img/${certification}`)" alt="">
            <div  v-on:click='closeCertifications' class="certification__close">&times;</div>
        </div>
    </div>
</template>

<script>
export default {
    props:['certification'],
    methods: {
        closeCertifications() {
			this.$emit('closeCertifications')
		}
    }
}
</script>

<style lang="scss" scoped>
@use '../sass/abstracts/' as *;
.certification {

    position: fixed;
    top: 0;
    bottom: 0;
    right: 0;
    left: 0;
    z-index: 500;
    display: grid;
    grid-template-columns: 1fr;
    grid-template-rows: 1fr;

    &__bg {
        background: rgba(black, .8);      
        grid-row: 1 / -1;  
        grid-column: 1 / -1;  
    }

    &__img {
        z-index: 502;
        grid-row: 1 / -1;  
        grid-column: 1 / -1; 
        align-self: center;
        justify-self: center;
        position: relative;

            img {
                max-width: 100rem;   
                margin: 1rem 4rem; 
                border-radius: .3rem;
                overflow: hidden;
                
                @include respond (1100) { 
                    max-width: calc(100% - 8rem);
                };
            }
    }
    &__close {
        cursor: pointer;
        position: absolute;
        color: white;
        z-index: 503;
        top: -.7rem;
        right: 1rem;
        font-size: 4rem;
        font-weight: 300;
        &:hover {
            color: $col-secondary;
        }
    }
}

</style>