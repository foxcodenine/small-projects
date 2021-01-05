export { default as Display } from '../../components/Display.vue'
export { default as Header } from '../../components/Header.vue'

export const LazyDisplay = import('../../components/Display.vue' /* webpackChunkName: "components/Display" */).then(c => c.default || c)
export const LazyHeader = import('../../components/Header.vue' /* webpackChunkName: "components/Header" */).then(c => c.default || c)
