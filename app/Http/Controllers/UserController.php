<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function register(UserRegisterRequest $request) {
        $user = new User();
        $user->name = $request->name;
        $user->username = $request->username;
        $user->password = $request->password;
        $path = Storage::disk("public")->putFile('/avatars',$request->file("avatar"));
        $user->avatar = $path;
        $user->save();
        return response()->json(["token"=>$user->createToken('api')->plainTextToken]);
    }
}
