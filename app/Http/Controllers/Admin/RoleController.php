<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::get();

        return view('admin.role.index', [
            'roles' => $roles
        ]);
    }

    public function create()
    {
        $permissions = Permission::get();

        return view('admin.role.create', [
            'permissions' => $permissions
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'display_name' => ['required']
        ]);

        $displayName   = $request->input('display_name', null);
        $description   = $request->input('description', null);
        $permissionIDs = $request->input('permission_ids', []);
        $name          = Str::slug($displayName, '-');

        $role = new Role();

        $role->name         = $name;
        $role->display_name = $displayName;
        $role->description  = $description;

        $res = $role->save();
        if ($res) {
            $role->syncPermissions($permissionIDs);
            return redirect()->route('admins.roles.index')->with('message', 'Role created successfully');
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
        $role          = Role::find($id);
        $permissions   = Permission::get();
        $permissionIDs = $role->permissions()->pluck('id')->toArray();

        return view('admin.role.edit', [
            'role'          => $role,
            'permissions'   => $permissions,
            'permissionIDs' => $permissionIDs
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'display_name' => ['required']
        ]);

        $displayName   = $request->input('display_name', null);
        $description   = $request->input('description', null);
        $permissionIDs = $request->input('permission_ids', []);
        $name          = Str::slug($displayName, '-');

        $role = Role::find($id);

        $role->name         = $name;
        $role->display_name = $displayName;
        $role->description  = $description;

        $res = $role->save();
        if ($res) {
            $role->syncPermissions($permissionIDs);
            return redirect()->route('admins.roles.index')->with('message', 'Role updated successfully');
        } else {
            return back()->with('message', 'Something went to wrong');
        }
    }

    public function destroy($id)
    {
        $role = Role::find($id);

        $role->delete();

        return back()->with('message', 'Role deleted successfully');
    }
}
