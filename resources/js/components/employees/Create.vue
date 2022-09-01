<template>
    <div class="container">
       <div class="row">
            <div class="col-md-10 offset-1">
                <div class="card">
                <div class="card-header">
                    Employee Create
                    <router-link class="btn btn-success btn-sm float-end" :to="{name: 'EmployeeIndex'}">All Employee
                    </router-link>
                </div>
                <div class="card-body">
                    <form @submit.prevent="storeEmployee">
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
                                        <option value="" selected>Select department</option>
                                        <option v-for="department in departments" :key="department.id" :value="department.id">
                                            {{ department.name }}
                                        </option>
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
                                    <select class="form-select" v-model="form.state_id" @change="getCities()">
                                        <option value="" selected>Select state</option>
                                        <option v-for="state in states" :key="state.id" :value="state.id">
                                            {{ state.name }}
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">City</label>
                                    <select class="form-select" v-model="form.city_id">
                                        <option value="" selected>Select city</option>
                                        <option v-for="city in cities" :key="city.id" :value="city.id">
                                            {{ city.name }}
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Date of barth</label>
                                    <Datepicker v-model="form.birthdate"></Datepicker>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Hire Date</label>
                                    <Datepicker v-model="form.date_hire">

                                    </Datepicker>
                                </div>
                            </div>
                        </div>
                        <button @click="dateFormate()" type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
       </div>
    </div>
</template>

<script>
import Datepicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css'
import moment from 'moment';

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
                'birthdate': '',
                'date_hire': ''
            }
        }
    },
    created() {
        this.getCountries();
        this.getDepartment()
    },
    methods: {
        getCountries() {
            axios.get('/api/employees/countries')
            .then((response) => {
                this.countries = response.data.result;
            })
            .catch((error) => {
                console.log(error);
            });
        },
        getStates() {
            axios.get('/api/employees/'+this.form.country_id + '/states')
            .then((response) => {
                this.states = response.data.result;
            })
            .catch((error) => {
                console.log(error);
            });
        },
        getCities() {
            axios.get('/api/employees/'+this.form.state_id + '/cities')
            .then((response) => {
                this.cities = response.data.result;
            })
            .catch((error) => {
                console.log(error);
            });
        },
        getDepartment() {
            axios.get('/api/employees/departments')
            .then((response) => {
                this.departments = response.data.result;
            })
            .catch((error) => {
                console.log(error);
            });
        },
        storeEmployee() {
            axios.post('/api/employees', this.form)
            .then((response) => {
                this.$router.push({name: 'EmployeeIndex'});
            })
            .catch((error) => {
                console.log(error);
            });
        },
        formatDate(value) {
            if (value) {
                return moment(String(value)).format('YYYY-MM-DD');
            }
        },
        dateFormate() {
            var dob = this.form.birthdate;
            var hireDate = this.form.date_hire;
            if (dob) {
                var formattedDate = this.formatDate(dob);
                this.form.birthdate = formattedDate;

            }
            if (hireDate) {
                this.formatDate(dob);
                var formattedDate = this.formatDate(hireDate);
                this.form.date_hire = formattedDate;
            }
        }
    },
}
</script>