<template>
    <div class="container">
       <div class="row">
            <div class="col-md-10 offset-1">
                 <nav class="navbar navbar-expand-lg navbar-light bg-light m-2">
                    <div class="container-fluid">
                        <!-- <a class="navbar-brand" href="#">Home</a> -->
                         <router-link class="nav-link" :to="{name: 'Home'}">
                            Home
                        </router-link>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                <li class="nav-item">
                                    <router-link class="nav-link" :to="{name: 'EmployeeIndex'}">Employees</router-link>
                                </li>
                                <li class="nav-item">
                                    <router-link class="nav-link" :to="{name:'ImageIndex'}">Images
                                    </router-link>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        Dropdown
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <li>
                                            <router-link class="dropdown-item" :to="{name: 'Login'}" 
                                                v-if="$store.getters.getToken == 0">
                                                Login
                                            </router-link>
                                        </li>
                                        <li>
                                            <router-link class="dropdown-item" :to="{name: 'Register'}"
                                                v-if="$store.getters.getToken == 0">
                                                Register
                                            </router-link>
                                        </li>
                                        <li>
                                            <button v-if="$store.getters.getToken != 0" class="dropdown-item" @click="logout">
                                                Logout
                                            </button>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                            <!-- <form class="d-flex">
                                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                                <button class="btn btn-outline-success" type="submit">Search</button>
                            </form> -->
                        </div>
                    </div>
                </nav>
            </div>
       </div>
        <router-view></router-view>
    </div>
</template>
<script>
export default {
    methods: {
        logout() {
            // localStorage.removeItem('token');
            this.$store.dispatch('removedToken')
            this.$router.push({name: 'Login'});
        }
    },
}
</script>