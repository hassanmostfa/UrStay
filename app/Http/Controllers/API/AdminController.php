<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use App\Models\Unit;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{

    // Admin Login Action
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'msg' => $validator->errors()->first(), 'data' => null, 'notes' => ['Invalid data']], 400);
        }

        $credentials = $request->only('email', 'password');

        if (Auth::guard('admin')->attempt($credentials)) {
            $admin = Auth::guard('admin')->user();
            $token = $admin->createToken('admin_token')->plainTextToken;

            return response()->json(['status' => true, 'msg' => 'Login successful', 'data' => ['token' => $token, 'admin' => $admin], 'notes' => ['Login successful']], 200);
        } else {
            return response()->json(['status' => false, 'msg' => 'Invalid credentials', 'data' => null, 'notes' => ['Invalid credentials']], 401);
        }
    }

    public function logout(Request $request)
    {
        // Revoke the token that was used to authenticate the current request
        $request->user()->currentAccessToken()->delete();

        return response()->json(['status' => true, 'msg' => 'Logout successful', 'data' => null, 'notes' => ['Logout successful']], 200);
    }

    // View Admins
    public function viewAdmins()
    {
        $admins = Admin::where('isMaster', false)->paginate(20); // Fetch admins with pagination
        return response()->json(['status' => true, 'msg' => 'Admins fetched successfully', 'data' => ['admins' => $admins], 'notes' => ['Admins fetched']], 200);
    }

    // Store Admin
    public function storeAdmin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'msg' => $validator->errors()->first(), 'data' => null, 'notes' => ['Invalid data']], 400);
        }

        $admin = Admin::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json(['status' => true, 'msg' => 'Admin added successfully', 'data' => ['admin' => $admin], 'notes' => ['Admin added']], 201);
    }

        // Get all units with pagination
        public function getUnits(Request $request)
        {
            $perPage = $request->input('per_page', 10); // Default to 10 per page
            $units = Unit::paginate($perPage);

            return response()->json([
                'status' => true,
                'msg' => 'Units retrieved successfully',
                'data' => $units,
                'notes' => ['Paginated list of units retrieved'],
            ], 200);
        }

        // Get units with search and pagination
        public function getUnitsSearchPaginate(Request $request)
        {
            $perPage = $request->input('per_page', 10); // Default to 10 per page
            $query = Unit::query();

            // Apply search filters
            if ($request->has('title')) {
                $query->where('title', 'like', '%' . $request->input('title') . '%');
            }
            if ($request->has('category')) {
                $query->where('category', $request->input('category'));
            }
            if ($request->has('country')) {
                $query->where('country', $request->input('country'));
            }
            if ($request->has('city_name')) {
                $query->where('city_name', 'like', '%' . $request->input('city_name') . '%');
            }
            // Add more filters as needed

            $units = $query->paginate($perPage);

            if ($units->isEmpty()) {
                return response()->json([
                    'status' => false,
                    'msg' => 'No units found matching the search criteria',
                    'data' => null,
                    'notes' => ['No units match the provided search filters'],
                ], 404);
            }

            return response()->json([
                'status' => true,
                'msg' => 'Units retrieved successfully with search filters',
                'data' => $units,
                'notes' => ['Paginated list of units retrieved with applied search filters'],
            ], 200);
        }

    // Delete Admin
    public function deleteAdmin($id)
    {
        $admin = Admin::findOrFail($id);
        $admin->delete();

        return response()->json(['status' => true, 'msg' => 'Admin deleted successfully', 'data' => null, 'notes' => ['Admin deleted']], 200);
    }

    // Assign Unit to Admin
    public function assignUnitToAdmin($unitId, $adminId)
    {
        $admin = Admin::findOrFail($adminId);
        $unit = Unit::findOrFail($unitId);
        $unit->managed_by = $admin->id;
        $unit->save();

        return response()->json(['status' => true, 'msg' => 'Unit assigned to admin', 'data' => null, 'notes' => ['Unit assigned']], 200);
    }
    public function receiveUnit(Request $request, $unitId)
    {
        $admin = $request->user();
        $unit = Unit::findOrFail($unitId);
        $unit->managed_by = $admin->id;
        $unit->save();

        return response()->json(['status' => true, 'msg' => 'Unit received successfuly', 'data' => null, 'notes' => ['Unit assigned']], 200);
    }
}
