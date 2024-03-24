<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegistrationRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController
{
    public function login(LoginRequest $request)
    {
        $user = User::where('login', $request->login)->first();

        if(!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not found.'
            ]);
        }

        if(!Auth::attempt($request->only(['login', 'password']))){
            return response()->json([
                'status' => false,
                'message' => 'Login & Password does not match with our record.',
            ], 401);
        }

        return response()->json([
            'token' => $user->createToken("API TOKEN")->plainTextToken,
        ]);
    }

    public function register(RegistrationRequest $request) {
        return User::create($request->validated());
    }
}
