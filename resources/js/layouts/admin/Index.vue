<template lang="">
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
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Address</label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Zip code</label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
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
    
}
</script>
<style lang="">
    
</style>