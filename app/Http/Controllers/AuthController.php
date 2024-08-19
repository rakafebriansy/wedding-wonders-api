<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        Log::info('Register endpoint hit', ['email' => $request->input('email')]);

        try {
            $validated = $request->validate([
                'username' => 'required|string|max:255|unique:users',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8|confirmed',
            ]);

            $user = User::create([
                'username' => $validated['username'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
            ]);

            Log::info('User created successfully', ['user_id' => $user->id]);

            return response()->json([
                'message' => 'User successfully registered',
                'user' => $user,
                'token' => $user->createToken('API Token')->plainTextToken,
            ], 201);
        } catch (ValidationException $e) {
            Log::error('Validation failed during registration', ['errors' => $e->errors()]);

            return response()->json([
                'message' => 'Validation errors',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            Log::error('Unexpected error during registration', ['error' => $e->getMessage()]);

            return response()->json([
                'message' => 'An error occurred while registering the user',
            ], 500);
        }
    }



    public function login(Request $request)
    {
        try {
            $validated = $request->validate([
                'email' => 'required|string|email',
                'password' => 'required|string',
            ]);

            if (Auth::check()) {
                return response()->json([
                    'message' => 'Already logged in'
                ], 200);
            }

            $user = User::where('email', $validated['email'])->first();

            if (!$user || !Hash::check($validated['password'], $user->password)) {
                return response()->json([
                    'message' => 'Invalid credentials'
                ], 401);
            }

            \Log::info('User found', ['user' => $user]);

            $token = $user->createToken('API Token')->plainTextToken;

            \Log::info('Token created', ['token' => $token]);

            return response()->json([
                'message' => 'Login successful',
                'user' => $user,
                'token' => $token,
            ], 200);
        } catch (\Exception $e) {
            \Log::error('Login error', ['exception' => $e]);

            return response()->json([
                'message' => 'An error occurred during login'
            ], 500);
        }
    }


    public function changePassword(Request $request)
    {
        \Log::info('ChangePassword endpoint hit'); 

        $validated = $request->validate([
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        \Log::info('Validation passed'); 

        $user = Auth::user();

        if (!Hash::check($validated['current_password'], $user->password)) {
            \Log::info('Current password is incorrect'); 
            return response()->json([
                'message' => 'Current password is incorrect'
            ], 400);
        }

        $user->update(['password' => Hash::make($validated['new_password'])]);

        \Log::info('Password successfully updated'); 

        return response()->json([
            'message' => 'Password successfully updated'
        ], 200);
    }
}
