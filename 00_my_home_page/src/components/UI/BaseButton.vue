<template>
    
    <button class="btn" v-bind:class="btnClass">
        <a v-bind:href="myLink" target="_blank"></a>
        <slot></slot>        
    </button>
    
</template>

<!--------------------------------------------------------------------->

<script>
export default {
    props: {
        'btnClass': {
            type: String,
            default: '',
            required: false
        },
        'myLink': {
            type: String,
            default: '',
            required: false
        },
    }
}
</script>

<!--------------------------------------------------------------------->

<style lang="scss" scoped>
@use '../../sass/abstracts/' as *;

.btn {
    
    a { position: absolute;   top: 0; right: 0; bottom: 0; left: 0; }
    
    cursor: pointer;
    position: relative;

    letter-spacing: 1px;
    display: inline-block;
    text-transform: capitalize;
    text-decoration: none;
    padding: .4rem 2rem; 
    font-size: 1.7rem;  
    font-weight: 500;
    font-family: $font-text;
    border-radius: $border-radius;

    border: 1px solid rgba($col-dark, .0);
    color: $col-white;

    display: flex;
    align-items: center;
    justify-content: center;

    transition: all 0.2s ease-in-out;

    &:hover  { transform: translateY(-3px); }
    &:active { transform: translateY(-2px); }
    &:focus {  border-radius: none; outline: none;}

    &--100 { width: 100%; }

    &:hover {
        background-color: $col-tertiary;
        color: $col-dark;
        // border: 1px solid rgba($col-dark, .8);
        box-shadow: $shadow-2; 
    }
    &--primary { background-color: $col-primary; }

    &--secondary { background-color: $col-secondary;  }

    &--tertiary { background-color: $col-tertiary; }

    &--git {
    padding: .2rem .2rem; 
    }
}
</style>