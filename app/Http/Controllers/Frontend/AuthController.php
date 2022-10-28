<?php

namespace App\Http\Controllers\Frontend;

use App\Models\User;
use Illuminate\Http\Request;
use App\UtilClasses\CommonUtils;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'     => ['required'],
            'email'    => ['required', 'unique:users,email'],
            'password' => ['required', 'confirmed']
        ]);

       if ($validator->stopOnFirstFailure()->fails()) {
            return CommonUtils::error(null, $validator->errors());
        }

        $name            = $request->input('name', null);
        $email           = $request->input('email', null);
        $password        = $request->input('password', null);
        $passwordConfirm = $request->input('password_confirmation', null);

        $user = new User();

        $user->name     = $name;
        $user->email    = $email;
        $user->password = Hash::make($password);
        $res = $user->save();
        if ($res) {
            return CommonUtils::response($user, __('Register successfully done'));
        } else {
            return CommonUtils::error(null, __('common.error'));
        }

    }

    public function login(Request $request)
    {
        return $request->all();
    }
}
