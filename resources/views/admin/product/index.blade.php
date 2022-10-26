@extends('layouts.admin.index')

@section('content')
    
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <div>
                    <h4>All Product</h4>
                </div>
                <div class="">
                    <a href="{{ route('admins.products.create') }}"
                        class="btn btn-primary btn-sm">
                        Create <i class="fa-solid fa-plus"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>SL</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Brand</th>
                        <th>MRP</th>
                        <th>Selling Price</th>
                        <th>Vat</th>
                        <th>Quantity</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $key => $product)
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->category->name ?? null }}</td>
                            <td>{{ $product->brand->name ?? null }}</td>
                            <td>{{ $product->mrp }}</td>
                            <td>{{ $product->selling_price }}</td>
                            <td>{{ $product->vat }}</td>
                            <td>{{ $product->quantity }}</td>
                            <td>{{ $product->status }}</td>
                            <td class="d-flex flex-row">
                                <div class="ml-2">
                                    <a href="{{ route('admins.permissions.edit', $product->id) }}" class="btn btn-success btn-sm">
                                        <i class="fa-regular fa-pen-to-square"></i>
                                    </a>
                                </div>
                                <div class="ml-2">
                                    <button type="button" class="btn_permission_delete btn btn-danger btn-sm"
                                        data-permission_id="{{ $product->id }}">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @if ($products->hasPages())
                {{ $products->links() }}
            @endif
        </div>
    </div>
@endsection

@section('css')
    {{-- cdn link for data table --}}
    {{-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css"> --}}
@endsection

@push('scripts')
    {{-- cdn link for data table --}}
    {{-- <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script> --}}
    <script>
        $(document).ready( function () {
            // for data table
            // $('#products_table').DataTable();
            // product delete button event
            // $(".display").on("click", '.btn_permission_delete', function(){
            //     var permissionID = $(this).data('permission_id');
            //     __sweetAlert('/admin/permissions/', permissionID, $(this));
            // });
        } );
    </script>
@endpush