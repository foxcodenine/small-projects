<template>
  <div class="app">
    <NavBar />
    <Header />
    <Projects />
  </div>
</template>

<script>
import NavBar from "@/components/NavBar";
import Header from "@/components/Header";
import Projects from "@/components/Projects";


export default {
  components: {    
    NavBar,
    Header,
    Projects,
  }
}


</script>

<style lang="scss">

</style>