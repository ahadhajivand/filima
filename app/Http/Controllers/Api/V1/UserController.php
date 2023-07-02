<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getUser()
    {
     $users =  User::all();
     return response(['data' => ['users' => $users] , 'status' => '200'] , 200);
    }
}
