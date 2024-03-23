<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController
{
    public function login(Request $request) {
        $validator = Validator::make($request->all(),[
            'login'    => 'required',
            'password' => 'required'
        ]);

        if($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first()
            ]);
        }

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

        return ['token' => $user->createToken("API TOKEN")->plainTextToken];
    }

    public function register(Request $request) {
        $validator = Validator::make($request->all(), [
            'login' => ['required', 'string', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        if($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first()
            ]);
        }

        return User::create([
            'login'    => $request->login,
            'password' => Hash::make($request->password),
        ]);
    }
}
