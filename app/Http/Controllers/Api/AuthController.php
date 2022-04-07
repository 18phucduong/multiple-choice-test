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
    public function signup(RegisterRequest $request): JsonResponse
    {
        $user = User::create($request->only('name', 'email', 'password'));

        $accessToken = $user->createToken('authToken')->accessToken;

        return response()->json([
            'status' => 'success',
            'accessToken' => $accessToken
        ]);
    }

    public function login(LoginRequest $request): JsonResponse
    {
        if (!auth()->attempt([
            'email' => $request->email,
            'password' => $request->password
        ])) {
            return response()->json([
                'status' => 'Invalid Credentials'
            ],406);
        }
        $accessToken = auth()->user()->createToken('authToken',['start-a-test','send-a-test'])->accessToken;

        return response()->json([
            'status' => 'success',
            'accessToken' => $accessToken
        ]);
    }
    public function logout(): JsonResponse
    {
        Auth::user()->token()->revoke();
        return response()->json([
            'status' => 'success',
        ]);
    }

    public function user(): JsonResponse
    {
        return response()->json([
                'status' => 'success',
                'user' =>  Auth::user()
            ]);
    }
}
