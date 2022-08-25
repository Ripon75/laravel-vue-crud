<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-2">
                <div class="card">
                    <div class="card-header">
                        Image Create
                        <router-link class="btn btn-success btn-sm float-end" :to="{name:'ImageIndex'}">All Employee
                        </router-link>
                    </div>
                    <div class ="card-body">
                        <form @submit.prevent="formSubmit" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label class="form-label">Name</label>
                                <input type="text" class="form-control" v-model="name">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Upload file</label>
                                <input @change="onFileChange" type="file" class="form-control">
                                <div class="" v-if="img_src">
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
            name: '',
            img_src: '',
            imgPreview: null
        }
    },

    methods: {
        onFileChange(event) {
            this.img_src = event.target.files[0];
            let reader = new FileReader();
            reader.addEventListener('load', () => {
                this.imgPreview = reader.result;
            });
            if (this.img_src) {
                if (/\.(jpe?g|png|gif)$/i.test(this.img_src.name)) {
                    reader.readAsDataURL(this.img_src);
                }
            }
        },
        formSubmit() {
            let formData = new FormData();

            formData.append('name', this.name);
            formData.append('img_src', this.img_src);
            axios.post('/api/images', formData)
            .then((res) => {
                this.$router.push({name: 'ImageIndex'})
            })
            .catch((error) => {
                console.log(error);
            });
        }
    }
}
</script>