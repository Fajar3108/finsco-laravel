<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        if (!Auth::attempt(['email' => $request->email, 'password' => $request->password])) return back()->with('error', 'Login Failed! Please check your email and password');

        return redirect()->route('home');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
