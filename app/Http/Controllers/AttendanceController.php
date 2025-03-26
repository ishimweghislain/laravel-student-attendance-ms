<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }
    
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string'
        ], [
            'username.required' => 'Username is required.',
            'password.required' => 'Password is required.'
        ]);

        // Find the user by username
        $user = User::where('username', $credentials['username'])->first();

        // Detailed logging for debugging
        Log::info('Login attempt', [
            'username' => $credentials['username']
        ]);

        // Check if user exists and password is correct
        if ($user && Hash::check($credentials['password'], $user->password)) {
            // Manually log in the user
            Auth::login($user);
            $request->session()->regenerate();

            // Log successful login
            Log::info('Successful login', [
                'username' => $user->username
            ]);

            return redirect()->intended('dashboard');
        }

        // Log failed login attempt
        Log::warning('Login failed', [
            'username' => $credentials['username']
        ]);

        // Return with error message
        return back()->withErrors([
            'login_error' => 'The username or password you entered is incorrect. Please try again.',
        ])->withInput($request->only('username'));
    }
    
    public function showRegister()
    {
        return view('auth.register');
    }
    
    public function register(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ], [
            'username.required' => 'Username is required.',
            'username.unique' => 'This username is already taken.',
            'password.required' => 'Password is required.',
            'password.min' => 'Password must be at least 6 characters.',
            'password.confirmed' => 'Passwords do not match.',
        ]);

        $user = new User();
        $user->username = $validated['username'];
        $user->password = $validated['password']; // Will be hashed by the model's mutator
        $user->save();

        Auth::login($user);

        return redirect()->intended('dashboard');
    }
    
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}