<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Unit;
use App\Models\Admin;
use App\Models\Owner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AdminUnitsController extends Controller
{
    // Get all units
    public function allUnits()
    {
        $units = Unit::with('admin')->where('request_status', 'completed')->get();
        return response()->json([
            'status' => true,
            'message' => 'Units retrieved successfully.',
            'data' => $units
        ], 200);
    }

    // Get units managed by the authenticated admin
    public function myUnits()
    {
        $units = Unit::with('admin')->where('managed_by', Auth::guard('admin')->id())->get();
        return response()->json([
            'status' => true,
            'message' => 'Your units retrieved successfully.',
            'data' => $units
        ], 200);
    }

    // Get units managed by a specific admin
    public function adminUnits($id)
    {
        $admin = Admin::findOrFail($id);
        $units = Unit::with('admin')->where('managed_by', $id)->get();
        return response()->json([
            'status' => true,
            'message' => 'Units managed by admin retrieved successfully.',
            'data' => $units
        ], 200);
    }

    // Show unit details
    public function unitDetails($id)
    {
        $unit = Unit::findOrFail($id);
        return response()->json([
            'status' => true,
            'message' => 'Unit details retrieved successfully.',
            'data' => $unit
        ], 200);
    }

    // Update unit
    public function updateUnit(Request $request, $id)
    {
        $unit = Unit::findOrFail($id);
        $unit->update($request->all());
        return response()->json([
            'status' => true,
            'message' => 'Unit updated successfully.',
            'data' => $unit
        ], 200);
    }

    // Delete unit
    public function deleteUnit($id)
    {
        $unit = Unit::findOrFail($id);
        $unit->delete();
        return response()->json([
            'status' => true,
            'message' => 'Unit deleted successfully.'
        ], 200);
    }

    // Get new units requests
    public function newUnitsRequests()
    {
        $units = Unit::with('admin')->where('request_status', 'pending')->get();
        return response()->json([
            'status' => true,
            'message' => 'New units requests retrieved successfully.',
            'data' => $units
        ], 200);
    }

    public function showUnitDetailsForUser($id)
    {
        $owner = Owner::findOrFail($id);

        // Optionally, you can add more details related to the unit, such as completed unit details
        $units = Unit::where("owner_id", $owner->id)->paginate(15);

        return response()->json([
            'status' => true,
            'message' => 'Unit details retrieved successfully.',
            'data' => [
                'unit' => $units,
                'owner' => $owner,
            ]
        ], 200);
    }

    // Approve unit
    public function approveUnit($id)
    {
        $unit = Unit::findOrFail($id);
        $unit->request_status = 'approved';
        $unit->save();
        return response()->json([
            'status' => true,
            'message' => 'Unit approved successfully.',
            'data' => $unit
        ], 200);
    }

    // Reject unit
    public function rejectUnit(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'rejection_reason' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'msg' => $validator->errors()->first(), 'data' => null, 'notes' => ['Invalid data']], 400);
        }

        $unit = Unit::findOrFail($id);
        $unit->request_status = 'rejected';
        $unit->rejection_reason = $request->input('rejection_reason');
        $unit->save();

        return response()->json([
            'status' => true,
            'message' => 'Unit rejected successfully.',
            'data' => $unit
        ], 200);
    }

    // Show rejected units
    public function rejectedUnits()
    {
        $units = Unit::with('admin')->where('request_status', 'rejected')->get();
        return response()->json([
            'status' => true,
            'message' => 'Rejected units retrieved successfully.',
            'data' => $units
        ], 200);
    }

    // Show updated units
    public function updatedUnits()
    {
        $units = Unit::with('admin')->where('request_status', 'updated')->get();
        return response()->json([
            'status' => true,
            'message' => 'Updated units retrieved successfully.',
            'data' => $units
        ], 200);
    }

    // Get all approved units
    public function getApprovedUnits()
    {
        $units = Unit::with('admin')->where('request_status', 'approved')->get();
        return response()->json([
            'status' => true,
            'message' => 'Approved units retrieved successfully.',
            'data' => $units
        ], 200);
    }
}
