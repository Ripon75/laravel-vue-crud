@extends('layouts.admin.index')

@section('content')
    <div class="container">
        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-6 offset-3">
                        <div class="p-5">
                            @if(Session::has('message'))
                                <div class="alert alert-success mt-8">
                                    {{ Session::get('message') }}
                                </div>
                            @endif
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Admin Register</h1>
                            </div>
                            <form class="user" action="{{ route('admins.register.store') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label class="ml-3">Username</label>
                                    <input type="text" class="form-control form-control-user"
                                        name="username" value="{{ old('username') }}" placeholder="Userame">
                                   @error('username')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="ml-3">Email</label>
                                    <input type="text" class="form-control form-control-user"
                                        name="email" value="{{ old('email') }}" placeholder="Email Address">
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="ml-3">Phone Number</label>
                                    <input type="text" class="form-control form-control-user"
                                        name="phone_number" value="{{ old('phone_number') }}" placeholder="Phone Number">
                                    @error('phone_number')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="ml-3">Password</label>
                                    <input type="password" class="form-control form-control-user"
                                        name="password" placeholder="Password">
                                    @error('password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="ml-3">Confirm Password</label>
                                    <input type="password" class="form-control form-control-user"
                                        name="password_confirmation" placeholder="Confirm Password">
                                    @error('password_confirmation')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="ml-3">Role</label>
                                    <select class="form-control form-select-lg mb-3 rounded-pill" name="role_id">
                                        <option value="">Select</option>
                                        @foreach ($roles as $role)
                                            <option class="p-2" value="{{ $role->id }}">
                                                {{ $role->display_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('role_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    Register
                                </button>
                                {{-- <a href="index.html" class="btn btn-google btn-user btn-block">
                                    <i class="fab fa-google fa-fw"></i> Register with Google
                                </a>
                                <a href="index.html" class="btn btn-facebook btn-user btn-block">
                                    <i class="fab fa-facebook-f fa-fw"></i> Register with Facebook
                                </a> --}}
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="{{ route('admins.forgot.password') }}">Forgot Password?</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="{{ route('admins.login') }}">Already have an account? Login!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $("document").ready(function(){
            setTimeout(function(){
            $("div.alert").remove();
            }, 4000 );
        });
    </script>
@endpush