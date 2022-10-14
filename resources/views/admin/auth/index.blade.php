@extends('layouts.admin.index')

@section('css')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <div>
                    <h4>All Admin User</h4>
                </div>
                <div class="">
                    <a href="{{ route('admins.register') }}" class="btn btn-primary btn-sm">
                        Create <i class="fa-solid fa-user-plus"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table id="admins_table" class="display">
                <thead>
                    <tr>
                        <th>SL</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($admins as $admin)
                    <tr>
                        <td>{{ $admin->id }}</td>
                        <td>{{ $admin->username }}</td>
                        <td>{{ $admin->email }}</td>
                        <td>{{ $admin->phone_number }}</td>
                        <td class="d-flex flex-row">
                            <div class="ml-2">
                                <a href="{{ route('admins.edit', $admin->id) }}" class="btn btn-success btn-sm">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                </a>
                            </div>
                            <div class="ml-2">
                                <form action="{{ route('admins.destroy', $admin->id) }}" method="POST">
                                    @csrf
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
            $('#admins_table').DataTable();
        } );
    </script>
@endpush