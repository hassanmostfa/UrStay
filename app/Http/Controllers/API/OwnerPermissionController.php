<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Supervisor;
use App\Models\Supervisor_owner_permission;

class OwnerPermissionController extends Controller
{
    // Show Supervisors and their Permissions for an Owner
    public function showAssignForm(Request $request)
    {
        try {
            $ownerId = Auth::user()->id; // Get authenticated owner
            $permessions = Supervisor_owner_permission::with('supervisor')
                ->where('owner_id', $ownerId)
                ->orderBy('supervisor_id', 'desc')
                ->paginate(15);

            return response()->json([
                'status' => true,
                'data' => $permessions
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to fetch permissions',
                'data' => null
            ], 500);
        }
    }

    /*********************************************************************************/

    // Assign Permissions to Supervisors
    public function assignPermissions(Request $request)
    {
        $validated = $request->validate([
            'supervisor_id' => 'required|exists:supervisors,id',
            'role' => 'required',
        ]);

        try {
            $ownerId = $request->user()->id; // Get authenticated owner

            $isExistes = Supervisor_owner_permission::where([
                'owner_id' => $ownerId,
                'supervisor_id' => $request->get('supervisor_id'),
                'permission' => $request->get('role'),
            ])->first();

            if ($isExistes) {
                return response()->json([
                    'status' => false,
                    'message' => 'Permission already exists',
                ], 400);
            }

            Supervisor_owner_permission::create([
                'owner_id' => $ownerId,
                'supervisor_id' => $request->get('supervisor_id'),
                'permission' => $request->get('role'),
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Permission assigned successfully',
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to assign permission',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /*********************************************************************************/
    // Delete a Permission
    public function deletePermission($id)
    {
        try {
            $ownerId = Auth::user()->id; // Get authenticated owner

            $permession = Supervisor_owner_permission::where([
                'owner_id' => $ownerId,
                'id' => $id,
            ])->first();

            if ($permession) {
                $permession->delete();
                return response()->json([
                    'status' => true,
                    'message' => 'Permission deleted successfully',
                ], 200);
            }

            return response()->json([
                'status' => false,
                'message' => 'Permission not found',
            ], 404);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to delete permission',
            ], 500);
        }
    }

    // Get a list of all supervisors
    public function getSupervisors()
    {
        try {
            $supervisors = Supervisor::all();

            return response()->json([
                'status' => true,
                'data' => $supervisors
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to fetch supervisors',
                'data' => null
            ], 500);
        }
    }
}
