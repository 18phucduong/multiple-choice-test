<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Auth\LoginRequest;

use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\User;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function signup(RegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email'=> $request->email,
            'password' => $request->password
        ]);

        $accessToken = $user->createToken('authToken')->accessToken;

        return response([ 'user' => $user, 'access_token' => $accessToken]);
    }

    public function login(LoginRequest $request)
    {
        if (!auth()->attempt([
            'email' => $request->email,
            'password' => $request->password
        ])) {
            return response(['message' => 'Invalid Credentials']);
        }
        $accessToken = auth()->user()->createToken('authToken',['start-a-test','send-a-test'])->accessToken;


        return response(['user' => auth()->user(), 'access_token' => $accessToken]);
    }
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json([
            'status' => 'success',
        ]);
    }

    public function user(Request $request)
    {
        $user = Auth::user()->token();

        return response()->json(
            [
                'success' => $user
            ],
        );
    }
}
