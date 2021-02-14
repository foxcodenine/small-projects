<template>
  <footer class="footer">
      <div class="footer__layout">
          <a href="#" class="foxcode__link">© 2020 foxcode.io</a>
          <i class="foxcode__icon" v-html="foxcodeLogo"></i>
      </div>
  </footer>
</template>

<script>
import { foxcodeLogo } from "@/data/icons";
export default {
    data() {
        return {
            foxcodeLogo
        }
    }
}
</script>

<style lang="scss">

.footer {


    &__layout {
        width: 100%;
        
        height: 6rem;

        background: rgba($btn-bg-dark, .8);

        display: flex;

        align-items: center;
        justify-content: flex-end;

        padding: 0 2.5rem;
       
    }

    .foxcode {
        &__link,
        &__link:link, 
        &__link:visited {
            color: rgba($col-white, .9);
            text-decoration: none;

            font-weight: 100;
            font-size: 1.5rem;


        }

        &__icon svg {
            margin-left: .8rem;
            width: 5rem;
            height: 3rem;
        }
    }
}

</style>