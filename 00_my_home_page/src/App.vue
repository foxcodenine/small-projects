<template>
	<div class="app">

		<div class="grid">

			<div class="top__bg"></div>
			<div class="middle__bg"></div>
	
			<the-navbar></the-navbar>
			<the-hero></the-hero>
			<the-profile-image></the-profile-image>
			<the-technologies></the-technologies>			
			<the-projects></the-projects>
			<the-footer></the-footer>
		</div>
		
	</div>
</template>

<!--------------------------------------------------------------------->

<script>
import TheNavbar from './components/TheNavbar.vue';
import TheHero from './components/TheHero.vue'
import TheProfileImage from './components/TheProfileImage.vue';
import TheTechnologies from './components/TheTechnologies.vue'
import TheProjects from './components/TheProjects.vue'
import TheFooter from './components/TheFooter.vue';

export default {
	components: {
		TheNavbar,
		TheHero,
		TheProfileImage,
		TheTechnologies,
		TheProjects,
		TheFooter
	}
}
</script>

<!--------------------------------------------------------------------->

<style lang="scss">
@use 'sass/main.scss';
@use 'sass/abstracts/' as *;

.app {  
    width: 100%;
    max-width: 122rem;
    margin: 0 auto;
	background-color: $col-white;

    padding: 1rem;

    min-height: 100rem;
    margin-bottom: 10rem;
    background-color: $col-white; 	
	position: relative;

}

.grid {	
	width: 100%;
	display: grid;
	grid-template-columns: 8rem repeat(12, 1fr) 8rem;
	
}

.top__bg {
	grid-column: 1 / -1;
	grid-row: 1 / 3;
	clip-path: polygon(0 0 , 100% 0, 100% 70%, 0% 100%);
	margin-bottom: -3rem;


	@include respond (1100) { 
		clip-path: polygon(0 0 , 100% 0, 100% 80%, 0% 100%);
		margin-bottom: 2rem;
	};
}

.top__bg, .middle__bg  {
	background-color: lighten($col-light, 5%);
	z-index: 1;position: relative;


	&::before {
		content: '';
		background-image: url(./assets/img/hero_bg2.png);
		background-position-y: -20rem;
		background-size: 100%;
		background-repeat: no-repeat;
		opacity: .45;
		position: absolute;   top: 0; right: 0; bottom: 0; left: 0;
		z-index: 2;

		@include respond (1200) {background-position-y: -15rem;};
		@include respond (1100) {background-position-y: -10rem;};
		@include respond (1000) {background-position-y: -5rem;};
		@include respond (900) {background-position-y: -0rem;};
		// @include respond (929) {background-position-y: 2rem;};
	}	
}


.middle__bg {
	grid-column: 1 / -1;
	grid-row: 4 / 6;
	clip-path: polygon(0 7% , 100% 10%, 100% 100%, 0% 100%);
	background-position-y: 0rem;

	@include respond (899) { margin-top: -8rem };
	@include respond (824) { margin-top: -2rem };
	@include respond (791) { margin-top: -8rem };
	margin-top: -2rem;


	&::before {
		content: '';
		background-position-y: 0rem;
			@include respond (600) {
				background-position-y: 20rem;
				// background-repeat: 10rem;
			};
	}
}

</style>

