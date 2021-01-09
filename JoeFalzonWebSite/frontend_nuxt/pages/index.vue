<template>
  <div class="app">
    <NavBar />
    <Header />
    <Display />
  </div>
</template>

<script>
import NavBar from "@/components/NavBar";
import Header from "@/components/Header";
import Display from "@/components/Display";


export default {
  components: {    
    NavBar,
    Header,
    Display,
  }
}


</script>

<style lang="scss">

</style>