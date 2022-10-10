<?php

namespace App\Http\Controllers\Admin;

use App\Models\Permission;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::get();

        return view('admin.permission.index', [
            'permissions' => $permissions
        ]);
    }

    public function create()
    {
        return view('admin.permission.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'display_name' => ['required']
        ]);

        $displayName   = $request->input('display_name', null);
        $description   = $request->input('description', null);
        $name          = Str::slug($displayName, '-');

        $permission = new Permission();

        $permission->name         = $name;
        $permission->display_name = $displayName;
        $permission->description  = $description;

        $res = $permission->save();
        if ($res) {
            return redirect()->route('admin.permissions.index')->with('message', 'Role created successfully');
        } else {
            return back()->with('message', 'Something went to wrong');
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $permission = Permission::find($id);

        return view('admin.permission.edit', [
            'permission' => $permission
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'display_name' => ['required']
        ]);

        $displayName   = $request->input('display_name', null);
        $description   = $request->input('description', null);
        $name          = Str::slug($displayName, '-');

        $permission = Permission::find($id);

        $permission->name         = $name;
        $permission->display_name = $displayName;
        $permission->description  = $description;

        $res = $permission->save();
        if ($res) {
            return redirect()->route('admin.permissions.index')->with('message', 'Role created successfully');
        } else {
            return back()->with('message', 'Something went to wrong');
        }
    }

    public function destroy($id)
    {
        $permission = Permission::find($id);

        $permission->delete();

        return back()->with('message', 'Permission deleted successfully');
    }
}
