require('./bootstrap');

import { createApp } from 'vue'
import Toaster from "@meforma/vue-toaster";

import router from './router.js';
import App from './layouts/App.vue';

const app = createApp(App)

app.use(router)
app.use(Toaster, {
    position: "top" 
})
app.mount('#app')
