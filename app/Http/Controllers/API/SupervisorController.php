<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use App\Models\Supervisor;
use App\Models\Phone;
use App\Models\Supervisor_owner_permission;

class SupervisorController extends Controller
{
    // Register Supervisor Action
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => 'required|unique:supervisors,email',
            'phone' => 'required|unique:supervisors,phone',
            'password' => ['required', 'string', 'min:8'],
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'msg' => $validator->errors()->first(), 'data' => null], 400);
        }

        // Verify phone from the 'phones' table
        $phoneRecord = Phone::where('phone', $request->phone)->first();
        if (!$phoneRecord || !$phoneRecord->verified_at) {
            return response()->json(['status' => false, 'msg' => 'Phone number not verified', 'data' => null], 403);
        }

        try {
            $supervisor = Supervisor::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
            ]);

            return response()->json(['status' => true, 'msg' => 'Registration successful', 'data' => $supervisor], 201);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['status' => false, 'msg' => 'An error occurred', 'data' => null], 500);
        }
    }

    // Supervisor Login Action
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone_or_email' => 'required',
            'password' => 'required|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'msg' => $validator->errors()->first(), 'data' => null], 400);
        }

        $loginField = $request->input('phone_or_email');
        $fieldType = filter_var($loginField, FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';
        $credentials = [$fieldType => $loginField, 'password' => $request->input('password')];

        $supervisor = Supervisor::where([$fieldType => $loginField])->first();
        if (!$supervisor || !$supervisor->isApproved) {
            return response()->json(['status' => false, 'msg' => 'Account not found or not approved', 'data' => null], 403);
        }

        if (Auth::guard('supervisor')->attempt($credentials)) {
            $token = $supervisor->createToken('supervisor_token')->plainTextToken;
            return response()->json(['status' => true, 'msg' => 'Login successful', 'data' => ['token' => $token, 'supervisor' => $supervisor]], 200);
        } else {
            return response()->json(['status' => false, 'msg' => 'Invalid credentials', 'data' => null], 401);
        }
    }

    // Logout Supervisor
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['status' => true, 'msg' => 'Logout successful'], 200);
    }

    // Get Supervisor's Dashboard
    public function dashboard(Request $request)
    {
        $supervisor = $request->user(); // Get the authenticated supervisor

        $accounts = Supervisor_owner_permission::with('owner')
            ->where('supervisor_id', $supervisor->id)
            ->select('owner_id')
            ->distinct()
            ->orderBy('owner_id', 'desc')
            ->paginate(15);

        return response()->json(['status' => true, 'msg' => 'Dashboard data fetched successfully', 'data' => $accounts], 200);
    }

    // Fetch Supervisors
    public function getSupervisors()
    {
        $supervisors = Supervisor::all();
        return response()->json(['status' => true, 'msg' => 'Supervisors fetched successfully', 'data' => $supervisors], 200);
    }
}
