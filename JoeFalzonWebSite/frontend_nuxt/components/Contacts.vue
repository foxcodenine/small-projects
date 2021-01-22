<template>
  <section class="contacts">
      <div class="contacts__layout">

          <div class="contacts__left cform" >

              <div class="cform__info">
                  <h2 class="title__primary cform__title--primary">Contact us</h2>                 
                  <p class="title__text cform__title--text">  <a v-html="iconMap"></a>{{ address }}</p>
                  <p class="title__text cform__title--text">| <a v-html="iconEnvelope"></a> {{ mail }} </p>
                  <p class="title__text cform__title--text">| <a v-html="iconPhone"></a> {{ phone }} </p>
              </div>

              <input 
                    v-model="user.firstname"
                    type="text" 
                    class="cform__input cform__input--firstname" 
                    placeholder="first name *">
              <input 
                    v-model="user.lastname"
                    type="text" 
                    class="cform__input cform__input--lastname"  
                    placeholder="last name *">
              <input 
                    v-model="user.email"
                    type="text" 
                    class="cform__input cform__input--email" 
                    placeholder="email *">

              <textarea 
                    v-model="user.message"
                    class="cform__input cform__input--message" 
                    placeholder="message *"></textarea>

              
          </div>

          <div class="contacts__right">
              
            <GMap     ref="gMap" language="en" :zoom="16" :center="mapCenter">
            <GMapMarker :position="mapCenter" /> 
            </GMap>
          
          </div>

          <button 
                @click="sendMessage()"
                class="btn btn--black contacts__btn">Send message</button>           

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

            address: 'No 35, Ibragg, Swiewi, Triq ix-Xiber Malta ',
            mail: 'joseph.falzon@melita.com',
            phone: '+356 79 471 000',            

            mapCenter: {lat: 35.896611, lng:14.4889349},

            user :{
                firstname: '',
                lastname: '', 
                email: '',
                message: ''
            },
        }
    },
    methods: {
        sendMessage() {
            console.log(this.user);
            
            this.user = {firstname: '', lastname: ''
                        , email: '', message: ''}
        }
    },
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