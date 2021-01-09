export { default as Display } from '../../components/Display.vue'
export { default as Header } from '../../components/Header.vue'
export { default as NavBar } from '../../components/NavBar.vue'

export const LazyDisplay = import('../../components/Display.vue' /* webpackChunkName: "components/Display" */).then(c => c.default || c)
export const LazyHeader = import('../../components/Header.vue' /* webpackChunkName: "components/Header" */).then(c => c.default || c)
export const LazyNavBar = import('../../components/NavBar.vue' /* webpackChunkName: "components/NavBar" */).then(c => c.default || c)
