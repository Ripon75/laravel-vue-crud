<template>
    <div class="container">
        <div class="card">
            <div v-if="showMessage">
                <div class="alert alert-success">
                    {{ message }}
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="d-flex form-control">
                        <input v-model="search_key" class="form-control me-2" type="search" placeholder="Type here">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </div>
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
                                <router-link 
                                    :to="{name: 'EmployeeEdit', params: {id: employee.id}}"
                                    class="btn btn-success btn-sm">
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
            message: '',
            search_key: null
        }
    },
    watch : {
        search_key() {
            this.getEmployees();
        }
    },
    created() {
        this.getEmployees();
    },
    methods: {
        getEmployees() {
            axios.get('/api/employees', {
                // search product
                params: {
                    search_key: this.search_key
                }
            })
            .then(res => {
                this.employees = res.data.result.data;
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