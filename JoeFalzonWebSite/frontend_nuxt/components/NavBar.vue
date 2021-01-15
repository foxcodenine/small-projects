<template>
    <nav class="nav" id="nav">
        <div class="nav__layout">
            <h3 class="nav__link">{{admin}}</h3>
            <a href="#" class="nav__link">About</a>
            <a href="#" class="nav__link">Projects</a>
            <a href="#" class="nav__link">Press</a>
            
            <div class="nav__link"><div class="vertical-line"></div></div>


            <a href="#" class="nav__link" v-html="iconFacebook"></a>
            <a href="#" class="nav__link" v-html="iconLocation"></a>

        </div>
    </nav>
</template>

<script>

import { iconLocation, iconFacebook } from "@/data/icons";

export default {
    data() {
        return {
            iconLocation,
            iconFacebook,
            admin: ''
        }
    },
    methods: {

    },
    mounted() {
        
        // ----- nav-background

        window.document.addEventListener('scroll', ()=> {
            const {scrollTop} = document.documentElement;
            
            if (scrollTop > 50) {   
                document.getElementById('nav').classList.add('nav__background')
            } 
        });
        window.document.addEventListener('scroll', ()=> {
            const {scrollTop} = document.documentElement;
            
            if (scrollTop <= 50) {
                document.getElementById('nav').classList.remove('nav__background')
            } 
        });
        // _____________________
    }    
}

</script>

<style>

</style>