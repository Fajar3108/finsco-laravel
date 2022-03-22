<?php

namespace App\Http\Controllers;

use App\Models\User;
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

        $user = User::where('email', $request->email)->first();

        if ($user->role->slug == 'customer') return redirect()->route('home.customer');

        return redirect()->route('home');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
