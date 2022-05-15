<template>
    <nav class="nav-bar">

        <ul class="top-links">
            <li class="top-links__item top-links__item--active"><a class="top-links__link" href="#">Home</a></li>
            <li class="top-links__item"><a class="top-links__link" href="#">Projects</a></li>
            <li class="top-links__item"><a class="top-links__link" href="#">Linkdin</a></li>
            <li class="top-links__item"><a class="top-links__link" href="#">Facebook</a></li>
            <li class="top-links__item"><a class="top-links__link" href="#">Contacts</a></li>
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
@use '../../sass/abstracts/' as *;

.nav-bar {
	color: lighten($col-dark, 5%);
    background-color: transparent; 
    padding: 6rem 10rem;
	position: absolute;
	z-index: 100;
	@include respond ($bp-large) { 
    padding: 6rem 8rem
    };
    
	display: flex;
	justify-content: flex-end;
	align-items: center;
	width: 100%;

}



.top-links {
	list-style: none;
	display: flex;
	gap: 2rem;
	margin-left: auto;

	&__item {
		cursor: pointer;
		padding: .5rem 2rem;
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
		color: currentColor;
		text-decoration: none;
	}
}
</style>