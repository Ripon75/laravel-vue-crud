import { createRouter, createWebHashHistory } from 'vue-router'

import EmployeeIndex from './components/employees/Index';
import EmployeeCreate from './components/employees/Create';
import EmployeeEdit from './components/employees/Edit';

const routes = [
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
    // {
    //     path: '/employees:id',
    //     name: 'EmployeeEdit',
    //     component: EmployeeEdit
    // }
];

const router = createRouter({
    history: createWebHashHistory(),
    routes
});

export default router;