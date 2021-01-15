export { default as Contacts } from '../../components/Contacts.vue'
export { default as Header } from '../../components/Header.vue'
export { default as NavBar } from '../../components/NavBar.vue'
export { default as Profile } from '../../components/Profile.vue'
export { default as Projects } from '../../components/Projects.vue'

export const LazyContacts = import('../../components/Contacts.vue' /* webpackChunkName: "components/Contacts" */).then(c => c.default || c)
export const LazyHeader = import('../../components/Header.vue' /* webpackChunkName: "components/Header" */).then(c => c.default || c)
export const LazyNavBar = import('../../components/NavBar.vue' /* webpackChunkName: "components/NavBar" */).then(c => c.default || c)
export const LazyProfile = import('../../components/Profile.vue' /* webpackChunkName: "components/Profile" */).then(c => c.default || c)
export const LazyProjects = import('../../components/Projects.vue' /* webpackChunkName: "components/Projects" */).then(c => c.default || c)
