<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Auth\LoginRequest;

use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    public function signup(RegisterRequest $request)
    {
        $user = User::create($request->only('name', 'email', 'password'));

        $accessToken = $user->createToken('authToken')->accessToken;

        return response([ 'user' => $user, 'access_token' => $accessToken]);
    }

    public function login(LoginRequest $request): JsonResponse
    {
        if (!auth()->attempt([
            'email' => $request->email,
            'password' => $request->password
        ])) {
            return response(['message' => 'Invalid Credentials']);
        }
        $accessToken = auth()->user()->createToken('authToken',['start-a-test','send-a-test'])->accessToken;


        return response()->json(['user' => auth()->user(), 'access_token' => $accessToken]);
    }
    public function logout(Request $request): JsonResponse
    {
        $request->user()->token()->revoke();
        return response()->json([
            'status' => 'success',
        ]);
    }

    public function user(Request $request): JsonResponse
    {
        $user = Auth::user()->token();
        dd(response()->json(
            [
                'success' => $user
            ],
        ));

        return response()->json(
            [
                'success' => $user
            ],
        );
    }
}
