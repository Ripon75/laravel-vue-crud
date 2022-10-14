@extends('layouts.admin.index')

@section('content')
    <div class="row">
        <div class="col-md-8 offset-2">
            <div class="card">
                <div class="card-header d-flex flex-row justify-content-between">
                    <div>
                        <h5>Create Permission</h1>
                    </div>
                    <div>
                        <a href="{{ route('admins.permissions.index') }}" class="btn btn-primary btn-sm float-right">All Permissions</a>
                    </div>
                </div>
                <form action="{{ route('admins.permissions.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Name</label>
                                    <input type="text" class="form-control" name="display_name">
                                    @error('display_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Description</label>
                                    <input type="text" class="form-control" name="description">
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary float-right mb-3">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection