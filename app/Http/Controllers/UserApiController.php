<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class UserApiController extends Controller
{

    public function logoutApi(Request $request) {
        $request->user()->tokens()->delete();
        return response()->json('Logged out successfully', 200);
    }

    public function loginApi(Request $request) {
        $incomingFields = $request->validate([
            'login-email' => 'required',
            'login-password' => 'required'
        ]);

        if (Auth::attempt([
            'email' => $incomingFields['login-email'],
            'password' => $incomingFields['login-password']
            ]))
        {
            $user = User::where('email', $incomingFields['login-email'])->first();
            $token = $user->createToken('finalsToken')->plainTextToken;
            return $token;
        }
        return 'Invalid Login';
    }

    public function registerApi(Request $request) {
        $incomingFields = $request->validate([
            'username' => ['required', 'min:3', 'max:20', Rule::unique('users', 'username')],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'min:8', 'confirmed'],
        ]);

        try {
            $user = User::create([
                'username' => $incomingFields['username'],
                'email' => $incomingFields['email'],
                'password' => bcrypt($incomingFields['password']),
            ]);

            $token = $user->createToken('finalsToken')->plainTextToken;

            return response()->json(['token' => $token], 201);
        } catch (Exception $e) {
            return response()->json(['message' => 'Could not register user: ' . $e->getMessage()], 500);
        }
    }

}
