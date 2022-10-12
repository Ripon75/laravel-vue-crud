@extends('layouts.admin.index')

@section('content')
    <div class="">
        <div class="row">
            <div class="col-md-10 offset-1">
                @if(Session::has('message'))
                    <div class="alert alert-danger mt-8">
                        {{ Session::get('message') }}
                    </div>
                @endif
                <div class="card">
                    <div class="card-header d-flex flex-row justify-content-between">
                        <div>
                            <h5>Edit Role</h1>
                        </div>
                        <div>
                            <a href="{{ route('admins.roles.index') }}" class="btn btn-primary btn-sm float-right">All Roles</a>
                        </div>
                    </div>
                    <form action="{{ route('admins.roles.update', $role->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="mb-3">
                                        <label class="form-label">Name</label>
                                        <input type="text" class="form-control" name="display_name" value="{{ $role->name }}">
                                        @error('display_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Description</label>
                                        <input type="text" class="form-control" name="description" value="{{ $role->description }}">
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <div class="row">
                                        @foreach ($permissions as $permission)
                                            <div class="col-md-6">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="permission_ids[]"
                                                        value="{{ $permission->id }}"
                                                        {{ in_array($permission->id, $permissionIDs) ? 'checked' : '' }}>
                                                    <label class="form-check-label">
                                                        {{ $permission->display_name }}
                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-primary float-right mb-3">Update</button>
                        </div>
                    </form>
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