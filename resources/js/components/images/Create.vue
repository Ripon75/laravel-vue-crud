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
                                <label class="form-label">Upload file</label>
                                <input @change="onFileChange" type="file" class="form-control">
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
            'img_src': ''
        }
    },

    methods: {
        onFileChange(event) {
            this.img_src = event.target.files[0];
        },
        formSubmit() {
                let formData = new FormData();

                formData.append('img_src', this.img_src);
 
                axios.post('/api/images/create', formData)
                .then((res) => {
                    console.log(res);
                })
                .catch((error) => {
                    console.log(error);
                });
                // axios.post('/api/employees', this.form)
                // .then((response) => {
                //     this.$router.push({name: 'EmployeeIndex'});
                // })
                // .catch((error) => {
                //     console.log(error);
                // });
        }
    }
}
</script>