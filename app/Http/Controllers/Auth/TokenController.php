<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\ActiveCode;
use App\Models\User;
use Illuminate\Http\Request;

class TokenController extends Controller
{
    public function showToken(Request $request)
    {

        if (! $request->session()->has('auth'))
        {
            return  redirect(route('auth.login'));
        }
        $request->session()->reflash();
        return view('Auth.token');
    }

    public function token(Request $request)
    {
        $data = $request->validate([
            'code' => 'required'
        ]);


        if (! $request->session()->has('auth'))
        {
            return  redirect(route('auth.login'));
        }


        $user = User::findOrFail($request->session()->get('auth.user_id'));
        $status = ActiveCode::verifyCode($data['code'] , $user);

        if(! $status) {
           // alert()->error('کد صحیح نبود');
            return redirect(route('auth.login'));
        }
        if(auth()->loginUsingId($user->id,$request->session()->get('auth.remember'))) {
            $user->activeCode()->delete();
            // alert()->error('خوش آمدید به سایت ');
            return redirect(route('home'));
        }
        return redirect(route('auth.login'));

    }
}
