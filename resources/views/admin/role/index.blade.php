@extends('layouts.admin.index')

@section('css')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
@endsection

@section('content')
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
            @foreach ($roles as $role)
                <tr>
                    <td>{{ $role->id }}</td>
                    <td>{{ $role->name }}</td>
                    <td>{{ $role->description }}</td>
                    <td class="d-flex flex-row">
                        <div>
                            <a href="{{ route('admin.roles.edit', $role->id) }}" class="btn btn-success btn-sm">
                                <i class="fa-regular fa-pen-to-square"></i>
                            </a>
                        </div>
                        <div class="ml-2">
                            <form action="{{ route('admin.roles.destroy', $role->id) }}" method="POST">
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
@endsection

@push('scripts')
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
    <script>
        $(document).ready( function () {
            $('#roles_table').DataTable();
        } );
    </script>
@endpush