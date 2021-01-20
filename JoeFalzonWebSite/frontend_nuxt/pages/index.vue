<template>
  <div class="app">
    <NavBar />
    <Header />
    <Projects />
    <Profile />
    <Contacts />
  </div>
</template>

<script>
import NavBar from "@/components/NavBar";
import Header from "@/components/Header";
import Projects from "@/components/Projects";
import Profile from "@/components/Profile";
import Contacts from "@/components/Contacts";


export default {
  components: {    
    NavBar,
    Header,
    Projects,
    Profile,
    Contacts,
  }
}


</script>

<style lang="scss">

</style>