<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function showRegister()
    {
        return view('Auth.register');
    }

    public function register(Request $request)
    {

             $data = $request->validate([
                 'name' => ['required' , 'string' , 'min:3' , 'max:255'] ,
                 'phone' => ['required' , 'regex:/^09(1[0-9]|3[1-9]|2[1-9])-?[0-9]{3}-?[0-9]{4}$/' ,'unique:users,phone']
             ]);
             User::create($data);
             // نمایش پیغام : ثبت نام با موفقیت انجام شد
             return redirect(route('auth.login'));
    }
}
