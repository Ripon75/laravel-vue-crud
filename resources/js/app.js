require('./bootstrap');

import { createApp } from 'vue'
import Toaster from "@meforma/vue-toaster";


import router from './router.js';
import App from './layouts/App.vue';

// import {Swal }from 'sweetalert2'

// const Toast = Swal.mixin({
//   toast: true,
//   position: 'top-end',
//   showConfirmButton: false,
//   timer: 3000,
//   timerProgressBar: true,
//   didOpen: (toast) => {
//     toast.addEventListener('mouseenter', Swal.stopTimer)
//     toast.addEventListener('mouseleave', Swal.resumeTimer)
//   }
// })

const app = createApp(App)

app.use(router)
app.use(Toaster, {
    position: "top" 
})
app.mount('#app')
