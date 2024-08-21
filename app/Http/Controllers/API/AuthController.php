<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AuthController extends Controller
{
        // Register API
        public function register(Request $request)
        {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required',
                'role' => 'required',
            ]);
    
            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }
            try {
                $user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'role' => $request->role,
                ]);
                return response()->json(['success' => true, 'message' => 'User created successfully.' , 'data' => $user],200);
            } catch (\Throwable $th) {
                return response()->json(['success' => false, 'message' => $th->getMessage()], 500);
            }
        }



        // Login API
        public function login(Request $request)
        {
            // Validation request 
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required|string',
            ]);
            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }
            try {
                if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                    $user = Auth::user();
                    $token = $user->createToken('access_token')->plainTextToken;
                    return response()->json([
                        'access_token' => $token ,
                        'token_type' => 'Bearer',
                        'data' => $user],
                        200);
                }else {
                    return response()->json(['error' => 'Unauthorised'], 401);
                }
            } catch (\Throwable $th) {
                return response()->json(['success' => false, 'message' => $th->getMessage()], 500);
            }
        }



        // Logout API
        public function logout(Request $request)
        {
            $request->user()->currentAccessToken()->delete(); // Delete access token
            return response()->json(['success' => true, 'message' => 'User logged out successfully.'], 200);
        }
}
