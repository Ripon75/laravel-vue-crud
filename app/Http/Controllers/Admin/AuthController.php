<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        $admins = Admin::get();

        return view('admin.auth.index', [
            'admins' => $admins
        ]);
    }

    public function register(Request $request)
    {
        if (!Auth::user()->hasRole('admin')) {
            return back()->with('message', 'Unauthorize action');
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
        ]);

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
            return back()->with('message', 'Admin created successfully');
        } else {
            return back()->with('message', 'Something went to wrong');
        }
    }

    public function adminEdit($id)
    {
        $admin = Admin::with(['roles'])->find($id);
        foreach ($admin->roles as $key => $role) {
            $adminRoleID =  $role->pivot->role_id;
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
            return redirect()->route('admin.dashboard');
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

        return redirect()->route('admin.login');
    }
}
