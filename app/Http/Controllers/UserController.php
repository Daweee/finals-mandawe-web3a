<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function login(Request $request) {
        $incomingFields = $request->validate([
            'login-email' => 'required',
            'login-password' => 'required'
        ]);

        if (Auth::attempt([
            'email' => $incomingFields['login-email'],
            'password' => $incomingFields['login-password'],
            ])) {
            $request->session()->regenerate();
            return redirect('/')->with('success', 'You have successfully logged in');
        } else {
            return redirect('/')->with('failure', 'Invalid login.');
        }
    }

    public function register(Request $request) {
        $incomingFields = $request->validate([
            'username' => ['required', 'min:3', 'max:20', Rule::unique('users', 'username')],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'min:8', 'confirmed'],
        ]);

        $user = User::create($incomingFields);
        auth()->login($user);
        $welcomeMessage = 'Welcome' . ' ' . $user->username . '! Thank you for creating an account.';
        return redirect('/')->with('success', $welcomeMessage);
    }

    public function showRegisterPage() {
        return view('auth.movie-register');
    }

}
