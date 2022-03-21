<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('email', 'password'))) return ResponseHelper::error([], 'Unauthorized', 401);

        $user = User::where('email', $request->email)->first();

        return ResponseHelper::success([
            'token' => $user->createToken('auth_token')->plainTextToken,
            'token_type' => 'Bearer',
        ], 'Login Success');
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();
        return ResponseHelper::success([], 'Logout Success');
    }
}
