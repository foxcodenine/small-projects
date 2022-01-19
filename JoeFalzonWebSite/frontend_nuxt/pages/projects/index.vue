<template>
<div class="app">

<!-- --------------------------------------------------------------- -->

    <NavBar class="nav__background2" id="nav2"/>
<!-- --------------------------------------------------------------- -->
    
    <div class="categories">
            <ul class="categories__list">

                <li class="categories__item"
                    :class="{'categories__selected': selectedCat==1}"
                    @click="selectedCat=1">
                    All
                </li>
                <li class="categories__item"
                    :class="{'categories__selected': selectedCat==2}"
                    @click="selectedCat=2">
                    Commercial
                </li>
                <li class="categories__item"
                    :class="{'categories__selected': selectedCat==3}"
                    @click="selectedCat=3">
                    Education
                </li>
                <li class="categories__item"
                    :class="{'categories__selected': selectedCat==4}"
                    @click="selectedCat=4">
                    Office
                </li>
                <li class="categories__item"
                    :class="{'categories__selected': selectedCat==5}"
                    @click="selectedCat=5">
                    Residential
                </li>               

            </ul>
    </div>
             
<!-- --------------------------------------------------------------- -->
           

    <div class="display">
        <div class="display__layout">

        <div class="display__box" v-for="(p, index) in projectsArray" :key='index'>
          <div class="display__shape">
            <img class="display__image" :src="require(`${'@/assets/images/projects/'}${p.imgURL}`)"   alt="project-image">
          </div>
          <div class="slider__text">
            <p>{{p.txt}}</p>
          </div>
        </div>
            
        </div>
    </div>
<!-- --------------------------------------------------------------- -->

  </div>
</template>

<script>
import { sampleProjects } from "@/data/sampleData";
export default {
    scrollToTop: true,
    data() {
        return {
            selectedCat: 1,
            baseUrl: '@/assets/images/projects/',
            projectsArray: sampleProjects,
        }
    } ,
    methods: {
        
    },
    mounted() {
        setTimeout(() => {
            window.scrollTo(0, 0);
        }, 50);
        

        }
}
</script>

<style lang='scss'>
.display {

padding: 0rem 2rem;
margin-top: 4rem;

    &__layout {
        display: grid;
        width: 100%;
        max-width: $grid-width;
        grid-template-columns: repeat( auto-fit, minmax(20rem, 1fr));
        margin: auto;
        grid-gap: 2rem;

    }
    &__image {
        width: 100%;
        height: 100%;
        object-fit: cover;

        filter: sepia(70%);
        transition: all 0.2s ease-in-out;

        outline-offset: 0rem;
        outline: 1px solid rgba(#fff, .8); 

        outline-radius: $border-radius;
        -webkit-outline-radius: $border-radius;
        -moz-outline-radius: $border-radius;
    }
    &__shape {
      width: 100%;
      overflow: hidden;  
      height: 28rem;       

      transition: all 0.2s ease-in-out;
      border-radius: $border-radius;
      position: relative;

        &::after {
            position: absolute;
            content:"";
            height:100%;
            width:100%;
            top:0;
            left:0;
            background: linear-gradient(to right bottom, rgba($col-blue-3, .3), rgba($col-red-1, .1) 70%);
            transition: all 0.2s ease-in-out;
        }

        &:hover   {
            box-shadow: $shadow-1; 
            transform: translateY(-1rem);         
            &::after {
                background: none;
            }        
            & .display__image {
                filter: sepia(20%);        
                outline-offset: -2rem;
                transform: scale(1.05);
            }                
        }
    }   
}

</style>