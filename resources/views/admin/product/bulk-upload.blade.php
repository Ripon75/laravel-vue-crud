@extends('layouts.admin.index')

@section('content')
    <div class="row">
        <div class="col-md-8 offset-2">
            <div class="card">
                <div class="card-header d-flex flex-row justify-content-between">
                    <div>
                        <h5>Product Bulk Upload</h1>
                    </div>
                    <div>
                        <a href="{{ route('admins.products.index') }}" class="btn btn-primary btn-sm float-right">All Products</a>
                    </div>
                </div>
                <form action="{{ route('admins.products.bulk.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Upload File</label>
                                    <input type="file" class="form-control" name="uploaded_file" accept=".csv">
                                    @error('uploaded_file')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
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