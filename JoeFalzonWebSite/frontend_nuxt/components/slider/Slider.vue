<template>
    <div class="slider" >

        <SliderBox 
            v-for="(p, index) in projectsArray" 
            :key='index'
            :boxID="p.id"
            :boxURL="p.imgURL"
            :boxTXT="p.txt"
            
            >
        </SliderBox>    
  

    </div>
</template>

<script>
import { sampleProjects } from "@/data/sampleData";
import { SliderBox } from "./SliderBox";
export default {
    components : {
        SliderBox
    },
    data() {
        return {
            baseUrl: '@/assets/images/projects/',
            projectsArray: sampleProjects,
        }
    },
    methods: {
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

<style>

</style>