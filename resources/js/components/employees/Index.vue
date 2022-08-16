<template>
    <div class="container">
        <div class="card">
            <div class="card-header">
                Employee List
                <router-link class="btn btn-success btn-sm float-end" :to="{name: 'EmployeeCreate'}">Create</router-link>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Department</th>
                            <th scope="col">Country</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>@mdo</td>
                            <td>Edit</td>
                        </tr>
                    </tbody>
                </table>
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