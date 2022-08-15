require('./bootstrap');

import { createApp } from 'vue'
// import HelloWorld from './components/Welcome'
// import ProductIndex from './components/products/index.vue';

import router from './router.js';
import App from './layouts/App.vue';


// const app = createApp(App)

createApp(App)
    .use(router)
    .mount('#app')

// app.component('hello-world', HelloWorld)
// app.component('product-index', ProductIndex)

// app.use(router).mount('#app')
