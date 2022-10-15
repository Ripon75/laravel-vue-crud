<!-- Bootstrap core JavaScript-->
<script src="{{ asset('js/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('js/bootstrap/bootstrap.bundle.min.js') }}"></script>

<!-- Core plugin JavaScript-->
<script src="{{ asset('js/jquery/jquery.easing.min.js') }}"></script>

<!-- Custom scripts for all pages-->
<script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

<!-- Page level plugins -->
<script src="{{ asset('js/chart.js/Chart.min.js') }}"></script>

{{-- cdn link for sweet alert --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>
{{-- axios cdn link --}}
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>


<script>
    // flash message set timeout
    $("document").ready(function(){
        setTimeout(function(){
            $("div.alert").remove();
        }, 4000 );
    });

    // sweet alert
    function __sweetAlert(endpoint, id) {
        Swal.fire({
            title: 'Are you sure?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                axios.delete(`${endpoint}${id}`)
                .then(res => {
                    if(res.data.success) {
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

                        Toast.fire({
                            icon: 'success',
                            title: res.data.msg
                        })
                        setTimeout(function() {
                            location.reload();
                        }, 3000)
                    }
                })
                .catch(err => {
                    console.log(err);
                });
            }
        });
    }
</script>

@stack('scripts')