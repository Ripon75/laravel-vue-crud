<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\UtilClasses\CommonUtils;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    public function index()
    {
        if (!Auth::user()->ability(['admin'], ['roles-read'])) {
            return back()->with('error', __('auth.unauthorized'));
        }

        $roles = Role::get();

        return view('admin.role.index', [
            'roles' => $roles
        ]);
    }

    public function create()
    {
        if (!Auth::user()->ability(['admin'], ['roles-create'])) {
            return back()->with('error', __('auth.unauthorized'));
        }

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
            return redirect()->route('admins.roles.index')->with('message', __('role.create'));
        } else {
            return back()->with('message', __('common.error'));
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        if (!Auth::user()->ability(['admin'], ['roles-update'])) {
            return back()->with('error', __('auth.unauthorized'));
        }

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
            return redirect()->route('admins.roles.index')->with('message', __('admin.update'));
        } else {
            return back()->with('message', __('common.error'));
        }
    }

    public function destroy($id)
    {
        if (!Auth::user()->ability(['admin'], ['roles-delete'])) {
            return back()->with('error', __('auth.unauthorized'));
        }

        $role = Role::find($id);

        $res = $role->delete();
        if ($res) {
            return CommonUtils::response(null, __('role.delete'));
        } else {
            return CommonUtils::error(null, __('common.error'));
        }
    }
}
