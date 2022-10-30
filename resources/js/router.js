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

const routes = [
    {
        path: '/',
        name: 'Home',
        component: Home
    },
    // auth route
    {
        path: '/register',
        name: 'Register',
        component: Register
    },
    {
        path: '/login',
        name: 'Login',
        component: Login
    },
    {
        path: '/logout',
        name: 'Logout',
        // component: Login
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

export default router;