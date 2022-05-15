<template>
    <div class="projects">
        <div class="projects__background"></div>
        pojects
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

.projects {

    z-index: 20;

    min-height: 30rem; 

    &__background {
        position: absolute;
        width: 100%;
        left: 0;
        height: 52rem;
        background-color: #F2F4FA;
        clip-path: polygon(0 0 , 100% 10%, 100% 100%, 0% 100%);
        z-index: 1;
    }
}
</style>