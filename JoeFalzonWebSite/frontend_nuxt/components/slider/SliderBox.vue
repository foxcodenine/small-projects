<template>

        <div class="slider__box">
          <div class="slider__shape">
            <img class="slider__image" :src="require(`${'@/assets/images/projects/'}${boxURL}`)"   alt="project-image">
          </div>
          <div class="slider__text">
            <p>{{boxTXT}}</p>
          </div>
        </div>

</template>

<script>
export default {
    
    props: ['boxID', 'boxURL', 'boxTXT'],
    mounted() {
        // console.log('id: ', this.boxID)
    }
}
</script>

<style>

</style>