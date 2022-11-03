<template>
    <div class="container">
        <div class="row">
            <div class="col-md-10 offset-1">
                <div class="card">
                    <div class="card-header">
                        Register Here
                    </div>
                    <div class="card-body">
                        <form @submit.prevent="register">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Name</label>
                                        <input type="text" class="form-control" v-model="form.name">
                                        <span v-if="errors.name" class="text-danger">
                                            {{ errors.name[0] }}
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Email</label>
                                        <input type="text" class="form-control" v-model="form.email">
                                        <span v-if="errors.email" class="text-danger">
                                            {{ errors.email[0] }}
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Password</label>
                                        <input type="password" class="form-control" v-model="form.password">
                                        <span v-if="errors.password" class="text-danger">
                                            {{ errors.password[0] }}
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Confirm Password</label>
                                        <input type="password" class="form-control" v-model="form.password_confirmation">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mt-4">
                                        <button type="submit" class="btn btn-primary float-end">
                                            Submit
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            form: {
                name: '',
                email: '',
                psssword: '',
                password_confirmation: ''
            },
            errors: []
        }
    },
    methods: {
        register() {
            axios.post('/api/register', this.form)
            .then(res => {
                if (res.data.success) {
                    this.$router.push({name: 'Login'});
                    this.showMessage(res.data.msg);
                } else {
                    this.errors = res.data.msg; 
                }
            })
            .catch(err => {
                console.log(err);
            })
        }
    },
}
</script>
<style lang="">
    
</style>