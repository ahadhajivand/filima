<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Jobs\DetailSerial;
use App\Jobs\DetailVideo;
use App\Jobs\LinkSerial;
use App\Jobs\PSerial;
use App\Jobs\PVideo;
use App\Models\Interest;
use App\Models\PaginationSerial;
use App\Models\PaginationVideo;
use App\Models\Plan;
use App\Models\SerialLink;
use App\Models\SingleSerial;
use App\Models\SingleVideo;
use App\Models\User;
use Carbon\Carbon;
use DOMDocument;
use DOMXPath;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        $user =  auth()->user();
        $interest = Interest::all();
        $user = User::where('id' , auth()->user()->id)->first();
        $interests = $interest->where('user_id' , $user->id)->all();
        $videos = \App\Models\DetailVideo::all();
        $serials = \App\Models\DetailSerial::all();
        $plans = Plan::all();

        return view('home.profile.index' , compact('user' , 'videos' , 'serials' , 'plans' , 'interests'));
    }


    public function edit()
    {

    }


    public function update(Request $request)
    {
        $user = User::where('id' , auth()->user()->id)->first();
        if ($request->name)
        {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
            ]);
            $data['name'] = $request->name;
        }
        if ($request->phone)
        {
            $request->validate([
                'phone' => ['required',  'regex:/^09(1[0-9]|3[1-9]|2[1-9])-?[0-9]{3}-?[0-9]{4}$/' , Rule::unique('users')->ignore($user->id)],
            ]);
            $data['phone']= $request->phone;
        }
        $user->update($data);
        return back();
    }
}
