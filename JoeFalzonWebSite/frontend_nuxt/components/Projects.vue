<template>
  <section class="projects">
    <div class="projects__layout">
      <h2 class="title__primary projects__title--primary">{{title}}</h2>
      <p class="title__text projects__title--text">{{titleText}}</p>


      <div class="slider">

        <div class="slider__box">
          <div class="slider__shape">
            <img class="slider__image" src="@/assets/images/projects/project__1--small.jpg" alt="project-image">
          </div>
          <div class="slider__text">
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
          </div>
        </div>
        
        <div class="slider__box">
          <div class="slider__shape">
            <img class="slider__image" src="@/assets/images/projects/project__2--small.jpg" alt="project-image">
          </div>
          <div class="slider__text">
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
          </div>
        </div>

        <div class="slider__box">
          <div class="slider__shape">
            <img class="slider__image" src="@/assets/images/projects/project__3--small.jpg" alt="project-image">
          </div>
          <div class="slider__text">
            <p>Dignissimos, quod.</p>
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
      imgLocation: '@/assets/images/projects/project__5--small.jpg'
    }
  },
  methods: {
    returnImage(i) {
      return this.imgLocation + i;
    }
  },
  computed: {

  },
  mounted() {

    // _________________________________________________

    function mySliderFunction() {
    
      const slider = document.querySelector('.slider');

      let isDown = false;
      let startX;
      let scrollLeft;

      slider.addEventListener('mousedown', (e) => {

          event.preventDefault();

          isDown = true;
          // slider.classList.add('active');
          startX = e.pageX - slider.offsetLeft;
          scrollLeft = slider.scrollLeft;
      });

      slider.addEventListener('mouseleave', () => {
          isDown = false;
          // slider.classList.remove('active');

      });

      slider.addEventListener('mouseup', () => {
          isDown = false;
          // slider.classList.remove('active');

      });

      slider.addEventListener('mousemove', (e) => {

          event.preventDefault();
          if(!isDown) return;        

          const x = e.pageX - slider.offsetLeft;       

          const walk = x - startX;

          slider.scrollLeft = (scrollLeft - walk) * 1;
      });
    }
    // _________________________________________________
    mySliderFunction();
  }
}
</script>

<style lang="scss" >
  .slider {
    overflow-x: scroll;
    overflow-y: hidden;
    // border: red solid 1px;
    // white-space: nowrap;

    width: 100%;
    
    display: grid;
    
    grid-template-columns: repeat(2, 48%);
    grid-column-gap: 4%;
    grid-auto-flow: column;
    grid-auto-columns: 23%;

    color: transparent;
    // scrollbar-color: rgba(#000, .0) transparent;
    scrollbar-width: thin;

&__box {

      width: 100%;
    }

    &__image {
        width: 100%;
        height: 100%;
        object-fit: cover;

        
        filter: sepia(70%);
        transition: all 0.2s ease-in-out;

        outline-offset: 0rem;
        outline: 3px solid rgba(#fff, .8); 


    }

    &__shape {
        width: 100%;
        overflow: hidden;  
        height: 28rem;       
        margin-top: 3rem;
        transition: all 0.2s ease-in-out;

      &:hover   {

          box-shadow: 0 1.5rem 1.5rem -1.5rem black; 
          transform: translateY(-1rem);
           
          
          & .slider__image {
            filter: sepia(20%);        
            outline-offset: -2rem;
            transform: scale(1.05);
          }
              
      }
    }

    &__text {
      font-size: 1.4rem;
      min-height: 5rem;
      margin-top: .7rem;
      color: #333;
      text-align: center;
      background-color: transparent;
      
    }

    } 
</style>