<template>
    <div class="container">
        <div class="row">
            <div class="col-md-10 offset-1">
                <div class="card">
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
                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col">Department</th>
                                    <th scope="col">Country</th>
                                    <th scope="col">State</th>
                                    <th scope="col">City</th>
                                    <th scope="col">Zip code</th>
                                    <th scope="col">Birth date</th>
                                    <!-- <th scope="col">Hire date</th> -->
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="employee in employees.data" :key="employee.id">
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
                                    <!-- <td>{{ employee.date_hire }}</td> -->
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
                    <Pagination :data="employees" @pagination-change-page="getEmployees" />
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import moment from 'moment';
import LaravelVuePagination from 'laravel-vue-pagination';
// import Swal from 'sweetalert2'

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

export default {
    components: {
        'Pagination': LaravelVuePagination,
    },
    data() {
        return {
            employees: {},
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
        getEmployees(page = 1) {
            axios.get('/api/employees?page=' + page, {
                params: {
                    search_key: this.search_key
                }
            })
            .then(res => {
                if (res.data.success) {
                    this.employees = res.data.result;
                }
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
            // Swal.fire({
            //     title: 'Are you sure?',
            //     text: "You won't be able to revert this!",
            //     icon: 'warning',
            //     showCancelButton: true,
            //     confirmButtonColor: '#3085d6',
            //     cancelButtonColor: '#d33',
            //     confirmButtonText: 'Delete'
            //     }).then((result) => {
            //     if (result.isConfirmed) {
            //         // Delete action start
            //         axios.delete('/api/employees/' + id)
            //         .then(res => {
            //             this.getEmployees();
            //             Toast.fire({
            //                   icon: 'success',
            //                   title: res.data.msg
            //             })
            //         })
            //         .catch(err => {
            //             Toast.fire({
            //                   icon: 'success',
            //                   title: err
            //             })
            //         })
            //         // Delete action end
            //     }
            // })
        }
    },
}
</script>