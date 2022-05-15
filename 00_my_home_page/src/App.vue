<template>
	<div class="app">
		<the-navbar></the-navbar>
		<the-hero></the-hero>
		<the-projects></the-projects>
	</div>
</template>

<!--------------------------------------------------------------------->

<script>
import TheNavbar from './components/TheNavbar.vue';
import TheHero from './components/TheHero.vue'
import TheProjects from './components/TheProjects.vue';
export default {
	components: {
		TheNavbar,
		TheHero,
TheProjects
	}
}
</script>

<!--------------------------------------------------------------------->

<style lang="scss">
@use '../sass/main.scss';
@use '../sass/abstracts/' as *;



.app {  
    width: 100%;
    max-width: 120rem;
    margin: 0 auto;

    min-height: 100rem;
    margin-bottom: 10rem;
    background-color: $col-white; 	
	position: relative;    
}

</style>

