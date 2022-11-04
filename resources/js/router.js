import { createRouter, createWebHistory } from 'vue-router'

import Home from './components/Home';
import EmployeeIndex from './components/employees/Index';
import EmployeeCreate from './components/employees/Create';
import EmployeeEdit from './components/employees/Edit';
import ImageIndex from './components/images/Index';
import ImageCreate from './components/images/Create';
import ImageEdit from './components/images/Edit';
import Register from './components/auth/Register';
import Login from './components/auth/Login';
import store from './store';

const routes = [
    {
        path: '/',
        name: 'Home',
        component: Home,
        meta: {
            requestAuth: true
        }
    },
    // auth route
    {
        path: '/register',
        name: 'Register',
        component: Register,
        meta: {
            requestAuth: false
        }
    },
    {
        path: '/login',
        name: 'Login',
        component: Login,
        meta: {
            requestAuth: false
        }
    },
    // route for employees
    {
        path: '/employees',
        name: 'EmployeeIndex',
        component: EmployeeIndex
    },
    {
        path: '/employees/create',
        name: 'EmployeeCreate',
        component: EmployeeCreate
    },
    {
        path: '/employees:id',
        name: 'EmployeeEdit',
        component: EmployeeEdit
    },
    // route for image
    {
        path: '/images',
        name: 'ImageIndex',
        component: ImageIndex
    },
    {
        path: '/images/create',
        name: 'ImageCreate',
        component: ImageCreate
    },
    {
        path: '/images:id',
        name: 'ImageEdit',
        component: ImageEdit
    }
];

const router = createRouter({
    history: createWebHistory(),
    routes
});

router.beforeEach((to, from) => {
    if (to.meta.requestAuth && store.getters.getToken == 0) {
        return {name: 'Login'}
    }
    if (to.meta.requestAuth == false && store.getters.getToken != 0) {
        return {name: 'Home'}
    }
});

export default router;