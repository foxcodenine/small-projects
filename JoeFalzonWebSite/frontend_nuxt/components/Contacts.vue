<template>
  <section class="contacts">
      <div class="contacts__layout">

          <div class="contacts__left cform" >

              <div class="cform__info">
                  <h2 class="title__primary cform__title--primary">Contact us</h2>
                  
                 
                  <p class="title__text cform__title--text">  <a   v-html="iconMap"></a>No 35, Ibragg, Swiewi, Triq ix-Xiber Malta </p>
                  <p class="title__text cform__title--text">| <a v-html="iconEnvelope"></a> joseph.falzon@melita.com </p>
                  <p class="title__text cform__title--text">| <a v-html="iconPhone"></a> +356 79 471 000 </p>
              </div>

              <input type="text" class="cform__input cform__input--firstname" placeholder="first name *">
              <input type="text" class="cform__input cform__input--lastname"  placeholder="last name *">
              <input type="text" class="cform__input cform__input--email" placeholder="email *">
              <textarea class="cform__input cform__input--message" placeholder="message *"></textarea>

              
          </div>

          <div class="contacts__right">
              
                  <GMap 
  
                    ref="gMap"
                    language="en"
                    :zoom="16"
                    :center="{lat: 44.933076, lng: 15.629058}"                    
                    :cluster="{options: {styles: clusterStyle}}"                    
                    >

                  </GMap>

          
          </div>

          <button class="btn btn--black contacts__btn">Send message</button>
            

      </div>

      

  </section>
</template>

<script>
import { iconPhone, iconMap, iconEnvelope } from "@/data/icons";
export default {

    data() {
        return {
            iconPhone,
            iconMap,
            iconEnvelope,
            cluster: {
                width:560,
                height:560
            }
        }
    },
    methods: {

    },
    beforeMount() {

    },
    created() {
        




    }
}
</script>

<style lang="scss">
    
.GMap {
    height: 100%;

&__Wrapper {
    height: 100%;
}

}
</style>