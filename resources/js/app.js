require('./bootstrap');

import { createApp } from 'vue'

import EmployeeIndex from './components/employees/Index'
import EmployeeCreate from './components/employees/Create'
import EmployeeEdit from './components/employees/Edit'

import router from './router.js';
import App from './layouts/App.vue';

const app = createApp(App)

app.component('employee-index', EmployeeIndex)
app.component('employee-create', EmployeeCreate)
app.component('employee-edit', EmployeeEdit)

app.use(router).mount('#app')
