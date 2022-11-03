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
        showMessage(msg){
            Toast.fire({
                icon: 'success',
                title: msg
            })
        },
        sweetalertNotification(url, id, items, index) {
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
                            var msg = res.data.msg;
                            this.showMessage(msg);
                            items.splice(index, 1);
                        } else {
                            var msg = res.data.msg;
                            this.showMessage(msg);
                        }
                    })
                    .catch(err => {
                        console.log(err);
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