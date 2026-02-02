<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register()
    {
        return view('auth.register');
    }

    public function store(Request $req)
    {
        $validated = $req->validate([
            'name' => ['required', 'unique:users', 'min:3', 'max:255'],
            'email' => ['required', 'email:dns', 'unique:users'],
            'password' => ['required', 'min:5',  'max:255']
        ]);

        $validated['password'] = Hash::make($validated['password']);

        User::create($validated);

        return redirect('/login')->with('success', 'Registration successful! Please sign in');
    }

    public function login()
    {
        return view('auth.login');
    }

    public function authenticate(Request $req)
    {
        $credentials = $req->validate([
            'email' => ['required', 'email:dns'],
            'password' => ['required']
        ]);
        if (Auth::attempt($credentials)) {
            $req->session()->regenerate();
            return redirect()->intended('/')->with('success', 'Login successful');
        }

        return back()->with('error', 'Login failed! Email or password is incorrect.');
    }

    public function logout(Request $req)
    {
        Auth::logout();

        $req->session()->invalidate();
        $req->session()->regenerateToken();

        return redirect('/')->with('success', 'Logout successful, good bye!');
    }
}
