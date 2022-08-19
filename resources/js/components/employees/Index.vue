<template>
    <div class="container">
        <div class="card">
            <div v-if="showMessage">
                <div class="alert alert-success">
                    {{ message }}
                </div>
            </div>
            <div class="card-header">
                Employee List
                <router-link class="btn btn-success btn-sm float-end" :to="{name: 'EmployeeCreate'}">Create</router-link>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Department</th>
                            <th scope="col">Country</th>
                            <th scope="col">State</th>
                            <th scope="col">City</th>
                            <th scope="col">Zip code</th>
                            <th scope="col">Birth date</th>
                            <th scope="col">Hire date</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="employee in employees" :key="employee.id">
                            <td>{{ employee.name }}</td>
                            <td v-if="employee.department">{{ employee.department.name }}</td>
                            <td v-else>NULL</td>
                            <td v-if="employee.country">{{ employee.country.name }}</td>
                            <td v-else>NULL</td>
                            <td v-if="employee.state">{{ employee.state.name }}</td>
                            <td v-else>NULL</td>
                            <td v-if="employee.city">{{ employee.city.name }}</td>
                            <td v-else>NULL</td>
                            <td>{{ employee.zip_code }}</td>
                            <td>{{ formatDate(employee.birthdate) }}</td>
                            <td>{{ employee.date_hire }}</td>
                            <td>
                                <router-link :to="{name: 'EmployeeEdit', params: {id: employee.id}}" class="btn btn-success btn-sm">
                                    Edit
                                </router-link>
                                <button class="btn btn-danger btn-sm m-2" @click="deleteEmployee(employee.id)">
                                    Delete
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>
<script>
import moment from 'moment';
export default {
    data() {
        return {
            employees: [],
            showMessage: false,
            message: ''
        }
    },
    created() {
        this.getEmployees();
    },
    methods: {
        getEmployees() {
            axios.get('/api/employees')
            .then(response => {
                this.employees = response.data.result.data;
            })
            .catch(error => {
                console.log(error);
            });
        },
        formatDate(value) {
            if (value) {
                return moment(String(value)).format('YYYY-MM-DD');
            }
        },
        deleteEmployee(id) {
            axios.delete('/api/employees/' + id)
            .then(response => {
                this.getEmployees();
                this.showMessage = true;
                this.message = response.data.message;
            })
            .catch(error => {
                console.log(error);
            })
        }
    },
}
</script>
<style>
    
</style>