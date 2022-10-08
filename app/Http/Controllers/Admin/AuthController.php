<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function getAdmin()
    {
        return view('admin.auth.index');
    }

    public function login()
    {
        return view('admin.auth.login');
    }

    public function loginStore(Request $request)
    {
        return $request->all();
    }

    public function register()
    {
        return view('admin.auth.register');
    }

    public function registerStore(Request $request)
    {
        $request->validate([
            'username'              => ['required', 'unique:admins,username'],
            'email'                 => ['required', 'email', 'unique:admins,email'],
            'phone_number'          => ['required', 'unique:admins,phone_number'],
            'password'              => ['required', 'confirmed'],
            'password_confirmation' => ['required'],
        ]);

        $username        = $request->input('username', null);
        $email           = $request->input('email', null);
        $phoneNumber     = $request->input('phone_number', null);
        $password        = $request->input('password', null);
        $passwordConfirm = $request->input('password_confirm', null);

        $adminObj = new Admin();

        $adminObj->username     = $username;
        $adminObj->email        = $email;
        $adminObj->phone_number = $phoneNumber;
        $adminObj->password     = Hash::make($password);
        $res = $adminObj->save();
        if ($res) {
            return back()->with('message', 'Admin created successfully');
        }
    }

    public function forgotPassword()
    {
        return view('admin.auth.forgot-password');
    }
}
