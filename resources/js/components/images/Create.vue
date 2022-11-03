<template>
    <div class="container">
        <div class="row">
            <div class="col-md-10 offset-1">
                <div class="card">
                    <div class="card-header">
                        Image Create
                        <router-link class="btn btn-success btn-sm float-end" :to="{name:'ImageIndex'}">All Image
                        </router-link>
                    </div>
                    <div class ="card-body">
                        <form @submit.prevent="formSubmit" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label class="form-label">Name</label>
                                <input type="text" class="form-control" v-model="form.name">
                                <span v-if="errors.name" class="text-danger">
                                    {{ errors.name[0] }}
                                </span>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Upload file</label>
                                <input @change="onFileChange" type="file" class="form-control">
                                <span v-if="errors.img_src" class="text-danger">
                                    {{ errors.img_src[0] }}
                                </span>
                                <div class="" v-if="form.img_src">
                                    <img :src="imgPreview" alt="Image" style="width:100px; heigth:80px;" class="mt-2">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
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
                img_src: ''
            },
            imgPreview: null,
            errors: []
        }
    },

    methods: {
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
            axios.post('/api/images', formData)
            .then((res) => {
                if (res.data.success) {
                    this.$router.push({name: 'ImageIndex'});
                    this.showMessage(res.data.msg);
                } else {
                    this.errors = res.data.msg;
                }
            })
            .catch((err) => {
                console.log(err);
            });
        }
    }
}
</script>