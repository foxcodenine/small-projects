<template>
    <div class="slider" >

        <div class="slider__arrow slider__arrow--left"><img src="@/assets/images/svg/chevron.svg" alt=""></div>
        <div class="slider__arrow slider__arrow--right"><img src="@/assets/images/svg/chevron.svg" alt=""></div>
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
import SliderBox from "./SliderBox";
export default {
    components : {
        SliderBox
    },
    data() {
        return {
            // baseUrl: '@/assets/images/projects/',
            projectsArray: sampleProjects,
        }
    },
    methods: {
    },

    mounted() {
        

    // _________________________________________________

    function mySliderFunction() {

      
        // ___________ Slide Drag:
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

        // ___________ Slide Right:
        const arrowRight = document.querySelector('.slider__arrow--right');

        arrowRight.addEventListener('click', (e)=>{

            console.log(slider.scrollLeft + slider.clientWidth);

            console.log(slider.clientWidth);
            console.log(slider.scrollLeft);


            slider.scroll({
                top: 0,
                left: slider.scrollLeft + slider.clientWidth + 50 ,
                behavior: 'smooth'
            });

        });
        // ___________ Slide Left:
        const arrowLeft = document.querySelector('.slider__arrow--left');

        arrowLeft.addEventListener('click', (e)=>{

            console.log(slider.scrollLeft + slider.clientWidth);

            console.log(slider.clientWidth);
            console.log(slider.scrollLeft);


            slider.scroll({
                top: 0,
                left: (slider.clientWidth - slider.scrollLeft + 50 ) * -1,
                behavior: 'smooth'
            });

        });
        
    }
    // _________________________________________________

    mySliderFunction();

    }
}
</script>

<style>

</style>