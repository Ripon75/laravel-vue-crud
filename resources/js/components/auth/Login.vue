<template>
    <div class="container">
        <div class="row">
            <div class="col-md-10 offset-1">
                <div class="card">
                    <div class="card-header">
                        Login Here
                    </div>
                    <div class="card-body">
                        <form @submit.prevent="login">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Email</label>
                                        <input type="text" class="form-control" v-model="form.email">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Password</label>
                                        <input type="password" class="form-control" v-model="form.password">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Remember Me </label>
                                        <input type="checkbox" class="" v-model="form.remember_me">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mt-4">
                                        <button type="submit" class="btn btn-primary float-end">
                                            Login
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
                email: '',
                password: '',
                remember_me: ''
            },
            errors: []
        }
    },
    methods: {
        login() {
            axios.post('/api/login', this.form)
            .then(res => {
                if (res.data.success) {
                    this.$store.dispatch('setToken', res.data.result)
                    this.$router.push({name: 'Home'});
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