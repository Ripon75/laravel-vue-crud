@extends('layouts.admin.index')

@section('css')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <div>
                    <h4>All Role</h4>
                </div>
                <div class="">
                    <a href="{{ route('admins.roles.create') }}" class="btn btn-primary btn-sm">
                        Create <i class="fa-solid fa-plus"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table id="roles_table" class="display">
                <thead>
                    <tr>
                        <th>SL</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $key => $role)
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td>{{ $role->display_name }}</td>
                            <td>{{ $role->description }}</td>
                            <td class="d-flex flex-row">
                                <div class="ml-2">
                                    <a href="{{ route('admins.roles.edit', $role->id) }}" class="btn btn-success btn-sm">
                                        <i class="fa-regular fa-pen-to-square"></i>
                                    </a>
                                </div>
                                <div class="ml-2">
                                    <form action="{{ route('admins.roles.destroy', $role->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
    <script>
        $(document).ready( function () {
            $('#roles_table').DataTable();
        } );
    </script>
@endpush
