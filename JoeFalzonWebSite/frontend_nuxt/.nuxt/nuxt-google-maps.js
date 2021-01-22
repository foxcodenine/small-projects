import Vue from 'vue';
import GMap from "C:\\origin\\JoeFalzonWebSite\\frontend_nuxt\\node_modules\\nuxt-gmaps\\components\\GMap.vue";
import GMapMarker from "C:\\origin\\JoeFalzonWebSite\\frontend_nuxt\\node_modules\\nuxt-gmaps\\components\\GMapMarker.vue";
import GMapCircle from "C:\\origin\\JoeFalzonWebSite\\frontend_nuxt\\node_modules\\nuxt-gmaps\\components\\GMapCircle.vue";
import GMapInfoWindow from "C:\\origin\\JoeFalzonWebSite\\frontend_nuxt\\node_modules\\nuxt-gmaps\\components\\GMapInfoWindow.vue";
export default(context, inject) =>{
  Vue.component('GMap', GMap);
  Vue.component('GMapMarker', GMapMarker);
  Vue.component('GMapCircle', GMapCircle);
  Vue.component('GMapInfoWindow', GMapInfoWindow);
  inject('GMaps', {apiKey: "AIzaSyAfXrmWPKvCXAArFY95A85i1OibkPIRDyk", loaded: false, libraries: undefined})
}