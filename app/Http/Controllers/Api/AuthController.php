<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Auth\LoginRequest;

use Carbon\Carbon;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use App\Traits\ApiResponser;
use App\Traits\Tokener;

class AuthController extends Controller
{
    use ApiResponser, Tokener;

    public function signup(RegisterRequest $request): JsonResponse
    {
        $user = User::create($request->only('name', 'email', 'password'));

        $accessToken = $this->createToken($user);

        return $this->successResponse(['access_token' => $accessToken]);
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

        $user = auth()->user();
        $accessToken = $this->createToken($user, ['start-a-test','send-a-test']);

        return $this->successResponse(['access_token' => $accessToken]);
    }
    public function logout(): JsonResponse
    {
        auth()->user()->token()->revoke();
        return response()->json([
            'status' => 'success',
        ]);
    }

    public function user(): JsonResponse
    {
        return response()->json([
                'status' => 'success',
                'user' =>  auth()->user()
            ]);
    }

}
