require('./bootstrap');

import { createApp } from 'vue'
import Swal from 'sweetalert2'
import router from './router.js';
import App from './layouts/App.vue';

const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3000,
  timerProgressBar: true,
  didOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
  }
})

const myGlobalFunction = {
    methods: {
        sweetalertNotification(url, id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Delete'
                }).then((result) => {
                if (result.isConfirmed) {
                    // Delete action start
                    axios.delete(url+id)
                    .then(res => {
                        if (res.data.success) {
                            Toast.fire({
                              icon: 'success',
                              title: res.data.msg
                            })
                        } else {
                            Toast.fire({
                              icon: 'success',
                              title: res.data.msg
                            })
                        }
                        // this.getImage();
                    })
                    .catch(err => {
                        Toast.fire({
                            icon: 'success',
                            title: err
                        })
                    });
                    // Delete action end
                }
            })
        }
    },
}

const app = createApp(App)

app.use(router)
app.mixin(myGlobalFunction)
app.mount('#app')