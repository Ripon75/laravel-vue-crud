<template>
    <div class="container">
        <div class="row">
            <div class="col-md-10 offset-1">
                <div class="card">
                    <div class="card-header">
                        Image Update
                        <router-link class="btn btn-success btn-sm float-end" :to="{name:'ImageIndex'}">All Image
                        </router-link>
                    </div>
                    <div class ="card-body">
                        <form @submit.prevent="formSubmit" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label class="form-label">Name</label>
                                <input type="text" class="form-control" v-model="form.name">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Upload file</label>
                                <input @change="onFileChange" type="file" class="form-control">
                                <div class="" v-if="form.img_src">
                                <img :src="imgPreview == null ? `public/images/${form.img_src}` : imgPreview" alt="Image" style="width:100px; heigth:80px;" class="mt-2">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
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
                img_src: '',
            },
            imgPreview: null,
            data: ''
        }
    },

    mounted() {
        this.getData();
    },

    methods: {
        getData() {
            axios.get('/api/images/' + this.$route.params.id)
            .then(res => {
                this.form = res.data.result;
            })
            .catch(err => {
                this.$toast.error(err);
            });
        },
        onFileChange(event) {
            this.form.img_src = event.target.files[0];
            let reader = new FileReader();
            reader.addEventListener('load', () => {
                this.imgPreview = reader.result;
            });
            if (this.form.img_src) {
                if (/\.(jpe?g|png|gif)$/i.test(this.form.img_src.name)) {
                    reader.readAsDataURL(this.form.img_src);
                }
            }
        },
        formSubmit() {
            let formData = new FormData();

            formData.append('name', this.form.name);
            formData.append('img_src', this.form.img_src);

            axios.post('/api/images/' + this.$route.params.id, formData)
            .then((res) => {
                this.$router.push({name: 'ImageIndex'});
                if (res.data.success) {
                    this.$toast.success(res.data.msg);
                } else {
                    this.$toast.error(res.data.msg);
                }
            })
            .catch((error) => {
                this.$toast.error(err);
            });
        }
    }
}
</script>