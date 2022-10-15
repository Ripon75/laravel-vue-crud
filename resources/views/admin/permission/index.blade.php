@extends('layouts.admin.index')

@section('content')
    
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <div>
                    <h4>All Permission</h4>
                </div>
                <div class="">
                    <a href="{{ route('admins.permissions.create') }}"
                        class="btn btn-primary btn-sm">
                        Create <i class="fa-solid fa-plus"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table id="permissions_table" class="display">
                <thead>
                    <tr>
                        <th>SL</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($permissions as $key => $permission)
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td>{{ $permission->display_name }}</td>
                            <td>{{ $permission->description }}</td>
                            <td class="d-flex flex-row">
                                <div class="ml-2">
                                    <a href="{{ route('admins.permissions.edit', $permission->id) }}" class="btn btn-success btn-sm">
                                        <i class="fa-regular fa-pen-to-square"></i>
                                    </a>
                                </div>
                                <div class="ml-2">
                                    <button type="button" class="btn_permission_delete btn btn-danger btn-sm"
                                        data-permission_id="{{ $permission->id }}">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('css')
    {{-- cdn link for data table --}}
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
@endsection

@push('scripts')
    {{-- cdn link for data table --}}
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>

    <script>
        $(document).ready( function () {
            // for data table
            $('#permissions_table').DataTable();
            // permission delete button event
            $(".display").on("click", '.btn_permission_delete', function(){
                var permissionID = $(this).data('permission_id');
                __sweetAlert('/admin/permissions/', permissionID);
            });
        } );
    </script>
@endpush