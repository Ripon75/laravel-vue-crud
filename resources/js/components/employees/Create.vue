<template>
    <div class="container">
        <div class="card">
            <div class="card-header">
                Employee Create
                <router-link class="btn btn-success btn-sm float-end" :to="{name: 'EmployeeIndex'}">All Employee
                </router-link>
            </div>
            <div class="card-body">
                <form>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Name</label>
                                <input type="text" class="form-control" v-model="form.name">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Address</label>
                                <input type="text" class="form-control" v-model="form.address">
                            </div>
                        </div>
                        <div class="col-md-6">
                             <div class="mb-3">
                                <label class="form-label">Zip code</label>
                                <input type="text" class="form-control" v-model="form.zip_code">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Department</label>
                                <select class="form-select" v-model="form.department_id">
                                    <option selected>Select department</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Country</label>
                                <select class="form-select" v-model="form.country_id" @change="getStates()">
                                    <option selected value="">Select country</option>
                                    <option v-for="country in countries" :key="country.id" :value="country.id">
                                        {{country.name}}
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">State</label>
                                <select class="form-select" v-model="form.state_id">
                                    <option selected>Select state</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">City</label>
                                <select class="form-select" v-model="form.city_id">
                                    <option selected>Select city</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Date of barth</label>
                                <Datepicker v-model="form.dob"></Datepicker>
                            </div>
                        </div>
                        <div class="col-md-6">
                             <div class="mb-3">
                                <label class="form-label">Hire Date</label>
                                <Datepicker v-model="form.hire_date"></Datepicker>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import Datepicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css'
export default {
    components: {
        Datepicker
    },
    data() {
        return {
            countries: [],
            states: [],
            cities: [],
            departments: [],
            form: {
                'name': '',
                'address': '',
                'zip_code': '',
                'department_id': '',
                'state_id': '',
                'city_id': '',
                'country_id': '',
                'dob': '',
                'hire_date': ''
            }
        }
    },
    created() {
        this.getCountries();
    },
    methods: {
        getCountries() {
            axios.get('/api/employee/countries')
            .then((response) => {
                this.countries = response.data.result;
            })
            .catch((error) => {
                console.log(error);
            });
        },
        getStates() {
            axios.get('/api/employee/'+this.form.country_id + '/states')
            .then((response) => {
                console.log(response);
            })
            .catch((error) => {
                console.log(error);
            });
        }
    },
}
</script>