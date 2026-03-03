<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function register(UserRegisterRequest $request) {
        $user = new User();
        $user->name = $request->name;
        $user->username = $request->username;
        $user->password = $request->password;
        $user->save();
        return response()->json(["token"=>$user->createToken('api')->plainTextToken]);
    }
}
