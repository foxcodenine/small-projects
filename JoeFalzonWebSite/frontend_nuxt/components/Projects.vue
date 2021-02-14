<template>
  <section class="projects">
    <div class="projects__layout">
      <h2 class="title__primary projects__title--primary">{{title}}</h2>
      <p class="title__text projects__title--text">{{titleText}}</p>

      <Slider />

      <button class="btn btn--black projects__btn">{{btn_text}}</button>
    </div>

  </section>
</template>

<script>
import  Slider  from "./slider/Slider";
export default {
  data() {
    return {
      title: 'Projects',
      titleText: `
              Dorem ipsum dolor sit amet consectetur adipisicing elit.
              Inventore minus possimus quaerat ullam rem. Explicabo odio
              officia maiores reiciendis earum!`,

      btn_text: 'View All Projects'
      
    }
  },
  components: {
    Slider
  },

}
</script>

<style lang="scss" >

</style>