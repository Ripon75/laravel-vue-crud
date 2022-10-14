<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function index()
    {
        if (!Auth::user()->ability(['admin'], ['admins-read'])) {
            return back()->with('error', __('auth.unauthorized'));
        }

        $admins = Admin::get();

        return view('admin.auth.index', [
            'admins' => $admins
        ]);
    }

    public function register(Request $request)
    {
        if (!Auth::user()->ability(['admin'], ['admins-create'])) {
            return back()->with('error', __('auth.unauthorized'));
        }

        $roles = Role::get();

        return view('admin.auth.register', [
            'roles' => $roles
        ]);
    }

    public function registerStore(Request $request)
    {
        $request->validate([
            'username'              => ['required', 'unique:admins,username'],
            'email'                 => ['required', 'email', 'unique:admins,email'],
            'phone_number'          => ['required', 'unique:admins,phone_number'],
            'password'              => ['required', 'confirmed'],
            'password_confirmation' => ['required'],
            'role_id'               => ['required']
        ],
        [
            'role_id.required' => 'Please select role'
        ]
        );

        $username        = $request->input('username', null);
        $email           = $request->input('email', null);
        $phoneNumber     = $request->input('phone_number', null);
        $password        = $request->input('password', null);

        $admin = new Admin();

        $admin->username     = $username;
        $admin->email        = $email;
        $admin->phone_number = $phoneNumber;
        $admin->password     = Hash::make($password);
        $res = $admin->save();
        if ($res) {
            $roleID = $request->input('role_id', null);
            $admin->syncRoles($roleID);
            return redirect()->route('admins.index')->with('message', 'Admin created successfully');
        } else {
            return back()->with('message', 'Something went to wrong');
        }
    }

    public function adminEdit($id)
    {
         if (!Auth::user()->ability(['admin'], ['admins-update'])) {
            return back()->with('error', __('auth.unauthorized'));
        }

        $admin = Admin::with(['roles'])->find($id);
        $adminRoleID = null;
        if ($admin->roles) {
            foreach ($admin->roles as $role) {
                $adminRoleID =  $role->pivot->role_id;
            }
        }
        $roles = Role::get();

        return view('admin.auth.edit', [
            'admin'       => $admin,
            'roles'       => $roles,
            'adminRoleID' => $adminRoleID
        ]);
    }

    public function adminUpdate(Request $request, $id)
    {
        $request->validate([
            'username'              => ['required', "unique:admins,username,$id"],
            'email'                 => ['required', 'email', "unique:admins,email, $id"],
            'phone_number'          => ['required', "unique:admins,phone_number, $id"],
            'password'              => ['nullable', 'confirmed'],
            // 'password_confirmation' => ['required'],
            'role_id'               => ['required']
        ]);

        $username        = $request->input('username', null);
        $email           = $request->input('email', null);
        $phoneNumber     = $request->input('phone_number', null);
        $password        = $request->input('password', null);

        $admin = Admin::find($id);

        $admin->username     = $username;
        $admin->email        = $email;
        $admin->phone_number = $phoneNumber;
        if ($password) {
            $admin->password = Hash::make($password);
        }
        $res = $admin->save();
        if ($res) {
            $roleID = $request->input('role_id', null);
            $admin->roles()->sync($roleID);
            return back()->with('message', 'Admin Updated successfully');
        } else {
            return back()->with('message', 'Something went to wrong');
        }
    }

    public function login()
    {
        return view('admin.auth.login');
    }

    public function loginStore(Request $request)
    {
        $request->validate([
            'email'    => ['required'],
            'password' => ['required']
        ]);

        $email      = $request->input('email', null);
        $password   = $request->input('password', null);
        $isRemember = $request->input('is_remember', null);
        $isRemember = $isRemember ? true : false;

        if (Auth::guard('admin')->attempt(['email' => $email, 'password' => $password], $isRemember)) {
            return redirect()->route('admins.dashboard');
        } else {
            return back()->with('message', 'Invalid credential');
        }
    }

    public function forgotPassword()
    {
        return view('admin.auth.forgot-password');
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();

        return redirect()->route('admins.login');
    }

    public function adminDestroy($id)
    {
        if (!Auth::user()->ability(['admin'], ['admins-delete'])) {
            return back()->with('error', __('auth.unauthorized'));
        }

        $admin = admin::find($id);

        $admin->delete();

        return back()->with('message', 'Admin deleted successfully');
    }
}
