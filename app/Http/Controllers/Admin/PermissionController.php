<?php

namespace App\Http\Controllers\Admin;

use App\Models\Permission;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\UtilClasses\CommonUtils;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class PermissionController extends Controller
{
    public function index()
    {
        if (!Auth::user()->ability(['admin'], ['permissions-read'])) {
            return back()->with('error', __('auth.unauthorized'));
        }

        $permissions = Permission::get();

        return view('admin.permission.index', [
            'permissions' => $permissions
        ]);
    }

    public function create()
    {
        if (!Auth::user()->ability(['admin'], ['permissions-create'])) {
            return back()->with('error', __('auth.unauthorized'));
        }

        return view('admin.permission.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'display_name' => ['required', 'unique:permissions,display_name']
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
            return redirect()->route('admins.permissions.index')->with('message', __('permission.create'));
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
        if (!Auth::user()->ability(['admin'], ['permissions-update'])) {
            return back()->with('error', __('auth.unauthorized'));
        }

        $permission = Permission::find($id);

        return view('admin.permission.edit', [
            'permission' => $permission
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'display_name' => ['required', "unique:permissions,display_name,$id"]
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
            return redirect()->route('admins.permissions.index')->with('message', __('permission.update'));
        } else {
            return back()->with('message', __('common.error'));
        }
    }

    public function destroy($id)
    {
        if (!Auth::user()->ability(['admin'], ['permissions-delete'])) {
            return back()->with('error', __('auth.unauthorized'));
        }

        $permission = Permission::find($id);

        $res = $permission->delete();
        if ($res) {
            return CommonUtils::response(null, __('permission.delete'));
        } else {
            return CommonUtils::error(null, __('common.error'));
        }
    }
}
