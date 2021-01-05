<template>
  <header class="header">
      <div class="header__grids">        
        <h2 class="header__title" v-html="title"></h2>
        <p class="header__text" v-html="text"></p>
        <button class="btn btn--white header__btn">{{btn_text}}</button>
      </div>
  </header>
</template>

<script>
export default {
  data() {
    return {
      title:  `Architect Joseph Falzon`,

      text:   `Bachelor of Architecture and Civil Engineer (Hons) University of Malta 
              LEED AP and WELL AP candidate at Green Building Research Institute (U.S) WELL Building Institute (U.S.)`,

      btn_text: `contact us`
    }
  }
}
</script>

<style lang="scss" scoped>

</style>