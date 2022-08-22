<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-2">
                <div class="card">
                    <div class="card-header">
                        Image Update
                        <router-link class="btn btn-success btn-sm float-end" :to="{name:'ImageIndex'}">All Employee
                        </router-link>
                    </div>
                    <div class ="card-body">
                        <form @submit.prevent="formSubmit" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label class="form-label">Upload file</label>
                                <input @change="onFileChange" type="file" class="form-control">
                                <div class="mt-2" v-if="img_src">
                                    <img :src="imgPreview" alt="Image" style="width:100px; heigth:80px;">
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