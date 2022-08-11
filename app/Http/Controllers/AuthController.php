<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * create new User
     * '/api/register'
     *
     * @param  Request  $request
     * @return Token
     */
    public function register(UserRequest $request)
    {
        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            return response()->json([
                'message' => 'User created successfully',
                'token' => $user->createToken('Api token')->plainTextToken,
            ], 201);
        } catch (\Throwable$th) {
            return response()->json([
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    /**
     * Login by email & password
     * '/api/login'
     *
     * @param  Request  $request
     * @return Token
     */
    public function login(Request $request)
    {
        try {
            if (!Auth::attempt($request->only(['email', 'password']))) {
                return response()->json([
                    'message' => 'Email & Password does not match with our record',
                ], 404);
            }
            $user = User::where('email', $request->email)->first();

            return response()->json([
                'message' => 'Login successfully',
                'token' => $user->createToken('Api token')->plainTextToken,
            ], 200);
        } catch (\Throwable$th) {
            return response()->json([
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    /**
     * Logout user
     * '/api/logout'
     *
     * @param  Request  $request
     */
    public function logOut(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Log Out  successfully',
        ], 200);
    }
}
