<template>
    <nav class="nav-bar" id="home">

        <ul class="top-links">
            <li class="top-links__item"><a class="top-links__link" href="#home">Home</a></li>
            <li class="top-links__item"><a class="top-links__link" href="#projects">Projects</a></li>
            <li class="top-links__item"><a class="top-links__link" href="https://www.linkedin.com/in/christopher-farrugia-3a51184b/" target="_blank">Linkdin</a></li>
            <li class="top-links__item"><a class="top-links__link" href="https://www.facebook.com/chrisfarrugia12/" target="_blank">Facebook</a></li>
            <li class="top-links__item top-links__item--active"><a class="top-links__link" href="#contacts">Contact me</a></li>
        </ul>
    </nav>
</template>

<!--------------------------------------------------------------------->

<script>
export default {

}
</script>

<!--------------------------------------------------------------------->

<style lang="scss" scoped>
@use '../sass/abstracts/' as *;

.nav-bar {
	grid-column: 2 / -2;
	grid-row: 1 / 2;
	z-index: 10;
	// border: 1px solid black;

	color: lighten($col-dark, 5%);
    background-color: transparent; 
    padding: 6rem 0rem 4rem 0rem;

	z-index: 10;

    
	display: flex;
	justify-content: flex-end;
	align-items: center;
	width: 100%;
}



.top-links {
	list-style: none;
	display: flex;
	justify-content: flex-end;
	// border: 1px solid black;
	
	gap: 2rem;

	@include respond (900) {
	justify-content: space-between;
	width: 100%;
	}


	&__item {
		cursor: pointer;
		
		border-radius: $border-radius;
		font-weight: 500;
		font-size: 1.6rem;
		background-color: transparent;
		transition: all .1s ease-out;
		box-shadow: none;
		
		&:hover  { 
			transform: translateY(-3px);
			background-color: lighten($col-tertiary, 5%);
			box-shadow: $shadow-3;
			color: currentColor;
		}
		
		&:active { transform: translateY(-2px); }
		&:focus {  border-radius: none; outline: none;}
		
		&--active {
			background-color: $col-secondary;
			color: $col-white;
			box-shadow: $shadow-3;
		}
	}
	
	&__link:link, &__link:visited {
		padding: .3rem 2rem;
		display: block;
		color: currentColor;
		text-decoration: none;
	}
}
</style>