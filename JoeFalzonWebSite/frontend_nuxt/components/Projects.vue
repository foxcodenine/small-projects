<template>
  <section class="projects">
    <div class="projects__layout">
      <h2 class="title__primary">{{title}}</h2>
      <p class="title__text">{{titleText}}</p>


      <!-- <div class="card2">
        <div class="card2__box">
          <div class="card2__shap">
            <img src="./img/projects/project__1--small.jpg" alt="" class="card2__img">
          </div>
          <div class="card2__text">
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Velit, atque.</p>
          </div>
        </div>
      </div> -->

      <div class="slider">

        <div class="slider__box">
          <div class="slider__shape">
            <img :src="returnImage('project__5--small.jpg')" alt="project-image">
          </div>
          <div class="silder__text">
            <p>{{returnImage('project__5--small.jpg')}}</p>
          </div>
        </div>
        
        <div class="slider__box">
          <div class="slider__shape">
            <img :src="returnImage('project__5--small.jpg')" alt="project-image">
          </div>
          <div class="silder__text">
            <p>{{returnImage('project__5--small.jpg')}}</p>
          </div>
        </div>

        <div class="slider__box">
          <div class="slider__shape">
            <img :src="returnImage('project__5--small.jpg')" alt="project-image">
          </div>
          <div class="silder__text">
            <p>{{returnImage('project__5--small.jpg')}}</p>
          </div>
        </div>

        <div class="slider__box">
          <div class="slider__shape">
            <img :src="returnImage('project__5--small.jpg')" alt="project-image">
          </div>
          <div class="silder__text">
            <p>{{returnImage('project__5--small.jpg')}}</p>
          </div>
        </div>

        <div class="slider__box">
          <div class="slider__shape">
            <img :src="returnImage('project__5--small.jpg')" alt="project-image">
          </div>
          <div class="silder__text">
            <p>{{returnImage('project__5--small.jpg')}}</p>
          </div>
        </div>
        
        <div class="slider__box">
          <div class="slider__shape">
            <img :src="returnImage('project__5--small.jpg')" alt="project-image">
          </div>
          <div class="silder__text">
            <p>{{returnImage('project__5--small.jpg')}}</p>
          </div>
        </div>





      </div>

    </div>

  </section>
</template>

<script>
export default {
  data() {
    return {
      title: 'Projects',
      titleText: `
              Dorem ipsum dolor sit amet consectetur adipisicing elit.
              Inventore minus possimus quaerat ullam rem. Explicabo odio
              officia maiores reiciendis earum!`,
      imgLocation: 'http://localhost:3000/_nuxt/assets/images/projects/'
    }
  },
  methods: {
    returnImage(i) {
      return this.imgLocation + i;
    }
  }
}
</script>

<style lang="scss" >
  .slider {
    overflow-x: scroll;
    overflow-y: hidden;
    // white-space: nowrap;
    
    display: grid;
    width: 100%;
    grid-template-columns: repeat(4, 23%);
    grid-column-gap: 2.66667%;
    grid-auto-flow: column;
    grid-auto-columns: 23%;


    &__box {

      width: 100%;
    }

    &__image {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    &__shape {
        width: 100%;
        overflow: hidden;  
        height: 25rem;
        transition: all 0.2s ease-in-out;
    }
  }
</style>