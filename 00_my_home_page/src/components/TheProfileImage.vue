<template>
        <div class="profile-image">
            <img src="../assets/img/pofile_image.png" alt="">            
        </div>
        <!-- <div class="profile-image-bottom"></div> -->
</template>

<!--------------------------------------------------------------------->

<script>
export default {

}
</script>

<!--------------------------------------------------------------------->

<style lang="scss" scoped>
@use '../sass/abstracts/' as *;

.profile-image {  
    grid-column: -6 / -2;
    grid-row: 2 / 4;
    transform: translateY(-2rem);
    z-index: 5;
    

    border: 1rem solid $col-white;
    border-radius: $border-radius;
    margin-left: 2rem;
    height: 52rem;
    z-index: 20;

    @include respond (1059) { 
        transform: translateY(0rem);
        grid-row: 2 / 3;
        height: calc(100% - 5.5rem);

    };

    @include respond (749) { 
        grid-column: -7 / -2;
    };

    img {
        width: 100%;       
        height: 100%;

        object-fit: cover;
        object-position: top;
        z-index: 20;
        box-shadow: $shadow-4;
        border-radius: $border-radius;
        
    }
}

</style>