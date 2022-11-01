<template>
    <div class="container">
        <div class="row">
            <div class="col-md-10 offset-1">
                <div class="card">
                    <!-- Search part -->
                    <div class="row">
                        <div class="col-md-4">
                            <div class="d-flex form-control">
                                <input v-model="search_key" class="form-control me-2" type="search" placeholder="Type here">
                                <button class="btn btn-outline-success" type="submit">Search</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-header">
                        Image List
                        <router-link class="btn btn-success btn-sm float-end" :to="{name: 'ImageCreate'}">
                            Create
                        </router-link>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Nmae</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(data, index) in result.data" :key="data.id">
                                    <td>{{ index + 1 }}</td>
                                    <td>{{ data.name }}</td>
                                    <td>
                                        <img :src="`uploadImages/products/${data.img_src}`" style="width:100px; height:80px;">
                                    </td>
                                    <td>
                                        <router-link :to="{name: 'ImageEdit', params: {id: data.id}}"
                                            class="btn btn-success btn-sm">
                                            Edit
                                        </router-link>
                                        <button class="btn btn-danger btn-sm m-2" @click="deleteImage(data.id)">
                                            Delete
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <Pagination :data="result" @pagination-change-page="getImage" />
                </div>
            </div>
        </div>
    </div>
</template>
<script>
// import Swal from 'sweetalert2'
import LaravelVuePagination from 'laravel-vue-pagination';

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
            result: {},
            search_key: ''
        }
    },
    mounted() {
        this.getImage();
    },
    methods: {
        getImage() {
            axios.get('/api/images')
            .then(res => {
                if (res.data.success) {
                    this.result = res.data.result;
                }
            })
            .catch(err => {
                console.log(err);
            });
        },
        deleteImage(id) {
            this.sweetalertNotification('api/images/', id);
        }
    },
}
</script>