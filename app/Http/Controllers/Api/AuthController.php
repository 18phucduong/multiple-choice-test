<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Requests\Auth\RegisterRequest;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\User;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function signup(RegisterRequest $request)
    {
        $validated = $request->validated();

        $validated['password'] = bcrypt($request->password);
        $user = User::create($validated);

        $accessToken = $user->createToken('authToken');
        dd($accessToken);

        return response([ 'user' => $user, 'access_token' => $accessToken]);
    }

    public function login(Request $request)
    {
        $loginData = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);
        if (!auth()->attempt($loginData)) {
            return response(['message' => 'Invalid Credentials']);
        }
        $accessToken = auth()->user()->createToken('authToken',['start-a-test','send-a-test']);


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
