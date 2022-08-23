<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-2">
                <div class="card">
                    <div v-if="showMessage">
                        <div class="alert alert-success">
                            {{ message }}
                        </div>
                    </div>
                    <div class="card-header">
                        Employee List
                        <router-link class="btn btn-success btn-sm float-end" :to="{name: 'ImageCreate'}">
                            Create
                        </router-link>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(data, index) in result" :key="data.id">
                                    <td>{{ index + 1 }}</td>
                                    <td>
                                        <img :src="`public/images/${data.img_src}`" style="width:100px; height:80px;">
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
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            'result': ''
        }
    },
    mounted() {
        this.getImage();
    },
    methods: {
        getImage() {
            axios.get('/api/images')
            .then(res => {
                this.result = res.data.result;
            })
            .catch(err => {
                console.log(err);
            });
        },
        deleteImage(id) {
            axios.delete('api/images/'+id)
            .then(res => {
                this.getImage();
            })
            .catch(err => {
                console.log(err);
            })
        }
    },
}
</script>