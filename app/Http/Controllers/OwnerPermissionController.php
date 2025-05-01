<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Owner;
use App\Models\Supervisor;
use App\Models\Role;
use App\Models\Permission;
use App\Models\Supervisor_owner_permission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OwnerPermissionController extends Controller
{
    public function showAssignForm()
    {
        $supervisors = Supervisor::all(); // Get all supervisors
        $permessions = Supervisor_owner_permission::with("supervisor")->where("owner_id", Auth::guard('owner')->user()->id)->orderBy('supervisor_id', 'desc')->paginate(15);

        return view('owner.assign_permissions.assign_permissions', compact('supervisors', 'permessions'));
    }

    public function assignPermissions(Request $request)
    {
        $validated = $request->validate([
            'supervisor_id' => 'required|exists:supervisors,id',
            'role' => 'required',
        ]);

        $ownerId = Auth::guard("owner")->user()->id;

        $isExistes = Supervisor_owner_permission::where([
            "owner_id" => $ownerId,
            "supervisor_id" => $request->get("supervisor_id"),
            "permission" => $request->get("role"),
        ])->first();


        if($isExistes)
            return redirect()->back()->with('success', 'تم منح هذا التصريح من قبل');

        Supervisor_owner_permission::create([
            "owner_id" => $ownerId,
            "supervisor_id" => $request->get("supervisor_id"),
            "permission" => $request->get("role"),
        ]);


        return redirect()->back()->with('success', 'تم منح الاذن بنجاح');
    }
    public function deletePermission($id)
    {

        $ownerId = Auth::guard("owner")->user()->id;

        $permession = Supervisor_owner_permission::where([
            "owner_id" => $ownerId,
            "id" => $id,
        ])->first();

        if ($permession) {
            $permession->delete();
        }


        return redirect()->back()->with('success', 'تم حذف الاذن بنجاح');
    }
}
