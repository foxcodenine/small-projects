<template>
  <section class="profile">
      <div class="profile__layout">
        


        <div class="profile__left"></div>

        

        <div class="profile__right">
            <h2 class="title__primary profile__title--primary">{{title}}</h2>
            <p class="title__text profile__title--text" v-html="titleText"></p>
        </div>



      </div>
  </section>
</template>

<script>

import { sampleProfileText } from "@/data/sampleData";
export default {
    data() {
        return {
            title: 'Profrssional Background',
            titleText: sampleProfileText,
            profileImage: '_nuxt/assets/images/profile/pro_1.jpg',

        }
    }
}
</script>

<style>

</style>