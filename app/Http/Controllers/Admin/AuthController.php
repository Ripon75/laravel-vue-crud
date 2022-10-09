<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function getAdmin()
    {
        return view('admin.auth.index');
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
