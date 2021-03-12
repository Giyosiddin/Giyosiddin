<?php

namespace App\Http\Controllers;

use App\Http\Resources\UsersResource;
use App\User;
use Illuminate\Http\Request;
use Auth;

class UserController extends Controller
{
    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');
        try {
            if (!$token = auth('web')->attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 400);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        return response()->json(['token' => compact('token'), 'user' => new UsersResource(Auth::user())]);
    }

    public function show()
    {
        return new UsersResource(Auth::user());
    }

    public function getUsers()
    {
        if(Auth::user()->role_id != 1) {
            abort(404);
        }
        return UsersResource::collection(User::orderBy('id','DESC')->get());
    }
}
