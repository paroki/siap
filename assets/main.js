import { createApp } from 'vue'
import App from './App'
import store from "./store"
import router from './router'

import {iconsSet as icons } from "./styles/icons";
import CoreuiVue from "@coreui/vue"
import CIcon from "@coreui/icons-vue"

const app = createApp(App)
app.use(store)
app.use(router)
app.use(CoreuiVue)
app.provide('icons', icons)
app.component('CIcon', CIcon)

app.mount('#app')