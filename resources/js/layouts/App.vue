<template>
    <div>
        <div>
            <router-link :to="{name: 'EmployeeIndex'}">Index</router-link> |
            <router-link :to="{name: 'EmployeeCreate'}">Create</router-link> |
            <!-- <router-link :to="{name: 'EmployeeEdit'}">Register</router-link> -->
        </div>
        <router-view></router-view>
    </div>
</template>
<script>
export default {
    
}
</script>