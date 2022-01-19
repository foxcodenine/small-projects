import Vue from 'vue';
import GMap from "\u002Fhome\u002Ffoxcodenine\u002FDesktop\u002FJoeFalzonWebSite\u002Ffrontend_nuxt\u002Fnode_modules\u002Fnuxt-gmaps\u002Fcomponents\u002FGMap.vue";
import GMapMarker from "\u002Fhome\u002Ffoxcodenine\u002FDesktop\u002FJoeFalzonWebSite\u002Ffrontend_nuxt\u002Fnode_modules\u002Fnuxt-gmaps\u002Fcomponents\u002FGMapMarker.vue";
import GMapCircle from "\u002Fhome\u002Ffoxcodenine\u002FDesktop\u002FJoeFalzonWebSite\u002Ffrontend_nuxt\u002Fnode_modules\u002Fnuxt-gmaps\u002Fcomponents\u002FGMapCircle.vue";
import GMapInfoWindow from "\u002Fhome\u002Ffoxcodenine\u002FDesktop\u002FJoeFalzonWebSite\u002Ffrontend_nuxt\u002Fnode_modules\u002Fnuxt-gmaps\u002Fcomponents\u002FGMapInfoWindow.vue";
export default(context, inject) =>{
  Vue.component('GMap', GMap);
  Vue.component('GMapMarker', GMapMarker);
  Vue.component('GMapCircle', GMapCircle);
  Vue.component('GMapInfoWindow', GMapInfoWindow);
  inject('GMaps', {apiKey: "AIzaSyAfXrmWPKvCXAArFY95A85i1OibkPIRDyk", loaded: false, libraries: undefined})
}