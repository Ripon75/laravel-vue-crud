import { createRouter, createWebHashHistory } from 'vue-router'
import home from './pages/Home.vue';
import login from './pages/Login.vue';
import register from './pages/Register.vue';
import ProductIndex from './components/products/Index.vue';

const routes = [
    {
        path: '/',
        name: 'Home',
        component: home
    },
    {
        path: '/login',
        name: 'Login',
        component: login
    },
    {
        path: '/register',
        name: 'Register',
        component: register
    },
    {
        path: '/products',
        name: 'ProductIndex',
        component: ProductIndex
    }
];

const router = createRouter({
    history: createWebHashHistory(),
    routes
});

export default router;