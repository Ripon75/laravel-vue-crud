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
                            <div class="mb-3">
                                <label class="form-label">Department</label>
                                <select class="form-select">
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
                                <select class="form-select">
                                    <option selected>Select country</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">State</label>
                                <select class="form-select">
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
                                <select class="form-select">
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
                                <input type="date" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                             <div class="mb-3">
                                <label class="form-label">Hire Date</label>
                                <input type="date" class="form-control">
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
export default {
    
}
</script>
<style>
    
</style>