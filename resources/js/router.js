import { createRouter, createWebHistory } from 'vue-router'

import EmployeeIndex from './components/employees/Index';
import EmployeeCreate from './components/employees/Create';
import EmployeeEdit from './components/employees/Edit';
import ImageIndex from './components/images/Index';
import ImageCreate from './components/images/Create';
import ImageEdit from './components/images/Edit';

const routes = [
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