<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Supervisor;
use Illuminate\Http\Request;

class AdminSupervisorsController extends Controller
{
    // Get a paginated list of supervisors
    public function getSupervisors(Request $request)
    {
        $perPage = $request->input('per_page', 10); // Default to 10 per page
        $supervisors = Supervisor::paginate($perPage);

        return response()->json([
            'status' => true,
            'msg' => 'Supervisors retrieved successfully',
            'data' => $supervisors,
            'notes' => ['Paginated list of supervisors retrieved'],
        ], 200);
    }

    // Approve a supervisor
    public function approveSupervisor($id)
    {
        $supervisor = Supervisor::find($id);

        if (!$supervisor) {
            return response()->json([
                'status' => false,
                'msg' => 'Supervisor not found',
                'data' => null,
                'notes' => ['Supervisor with the given ID does not exist'],
            ], 404);
        }

        $supervisor->isApproved = 1;
        $supervisor->save();

        return response()->json([
            'status' => true,
            'msg' => 'Supervisor approved successfully',
            'data' => $supervisor,
            'notes' => ['The supervisor has been approved'],
        ], 200);
    }

    // Reject a supervisor
    public function rejectSupervisor($id)
    {
        $supervisor = Supervisor::find($id);

        if (!$supervisor) {
            return response()->json([
                'status' => false,
                'msg' => 'Supervisor not found',
                'data' => null,
                'notes' => ['Supervisor with the given ID does not exist'],
            ], 404);
        }

        $supervisor->isApproved = 0;
        $supervisor->save();

        return response()->json([
            'status' => true,
            'msg' => 'Supervisor rejected successfully',
            'data' => $supervisor,
            'notes' => ['The supervisor has been rejected'],
        ], 200);
    }
}
