<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    // Show registration form
    public function showRegisterForm()
    {
        if (Auth::check()) {
            return redirect()->route('admin.dashboard');
        }
        else
        {
        return view('auth.register');
        }
    }

    // Handle registration
    public function register(Request $request)
    {
        // return Hash::make($request->password);
        // exit();
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        // Create user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'type' => 'admin',
            'password' => Hash::make($request->password),
        ]);

        // Log the user in
        Auth::login($user);

        return redirect()->route('dashboard')->with('success', 'Registration successful!');
    }

    // Show login form
    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect()->route('admin.dashboard');
        }
        else
        {
        return view('auth.login');
        }
    }

    // Handle login
    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();
            return redirect()->route('admin.dashboard')->with('success', 'Login successful!');
        }

        return back()->withErrors([
            'email' => 'Invalid email or password.',
        ]);
    }

    // Handle logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Logged out successfully!');
    }
}

