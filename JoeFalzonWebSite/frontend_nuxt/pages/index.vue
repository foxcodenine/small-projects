<template>
  <div class="app">
    <NavBar />
    <Header />
    <Projects />
    <Profile />
  </div>
</template>

<script>
import NavBar from "@/components/NavBar";
import Header from "@/components/Header";
import Projects from "@/components/Projects";
import Profile from "@/components/Profile";


export default {
  components: {    
    NavBar,
    Header,
    Projects,
    Profile
  }
}


</script>

<style lang="scss">

</style>