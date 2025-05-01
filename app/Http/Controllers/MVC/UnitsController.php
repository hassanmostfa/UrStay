<?php

namespace App\Http\Controllers\MVC;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Models\Unit;
use App\Models\Owner;
use App\Models\CompletedUnit;
use App\Models\Category;
use App\Models\Zone;
use App\Models\Governorate;
use App\Models\City;
use App\Models\District;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;

class UnitsController extends Controller
{

    // ==============================================================================
    // =========================== Admin Functions ==================================
    // ==============================================================================

    // get all units
public function allUnits()
{
    $units = [];
    // Check if the admin is not a master
    if (auth()->user()->isMaster != 1) {
        // Filter units to only those that do not have 'managed_by' set
        $units = Unit::latest()
            ->whereNull('managed_by')
            ->with('admin')
            ->paginate(15);
    } else {
        // If the admin is a master, get all units
        $units = Unit::latest()
            ->with('admin')
            ->paginate(15);
    }

    return view('admin.units.allUnits' , compact('units'));
}

    // get all units
public function myUnits()
{
    $units = Unit::with('admin')->where('managed_by' , Auth::guard('admin')->id())->get();
    return view('admin.units.myUnits' , compact('units'));
}

public function adminUnits($id)
{
    $admin = Admin::findOrFail($id);
    $units = Unit::with('admin')->where('managed_by' , $id)->get();
    return view('admin.units.adminUnits' , compact('units', 'admin'));
}

// show unit details
public function unitDetails($id)
{
    $unit = Unit::find($id);
    return view('admin.units.showUnitDetails' , compact('unit'));
}

// Update unit details
public function updateUnitPage(Request $request , $id)
{
    $unit = Unit::find($id);
    $categories = Category::all();
    $zones = Zone::all();
    return view('admin.units.updateUnit' , compact('unit' , 'categories' , 'zones'));
}


    // Update Unit
    public function updateUnit(Request $request , $id)
    {
        $unit = Unit::find($id);
        $unit->update($request->all());
        return redirect()->route('admin.dashboard')->with('success', 'Unit updated successfully.');
    }

    // Delete unit

    // Delete Unit
    public function deleteUnit($id)
    {
        $unit = Unit::find($id);
        $unit->delete();
        return redirect()->route('admin.allUnits')->with('success', 'Unit deleted successfully.');
    }


    // get new units requests
    public function newUnitsRequests()
    {
        $units = [];
        // Check if the admin is not a master
        if (auth()->user()->isMaster != 1) {
            // Filter units to only those that do not have 'managed_by' set
            $units = Unit::latest()
                ->whereNull('managed_by')
                ->where('request_status' , 'pending')
                ->with('admin')
                ->paginate(15);
        } else {
            // If the admin is a master, get all units
            $units = Unit::latest()
                ->with('admin')
                ->where('request_status' , 'pending')
                ->paginate(15);
        }

        return view('admin.units.newRequests' , compact('units'));
    }

    // Approve unit
    public function approveUnit($id)
    {
        $unit = Unit::find($id);
        $unit->request_status = 'approved';
        $unit->save();
        return redirect()->route('admin.allUnits')->with('success', 'Unit approved successfully.');
    }

    // Reject unit
    public function rejectUnit($id)
    {
        $validation = request()->validate([
            'rejection_reason' => 'required',
        ]);
        $unit = Unit::find($id);
        $unit->request_status = 'rejected';
        $unit->rejection_reason = request('rejection_reason');
        $unit->save();
        return redirect()->route('admin.newUnitsRequests')->with('success', 'تم الرفض بنجاح');
    }


    // Show Unit Details for User
    public function showUnitDetails($id)
    {
        $unit = Unit::find($id);
        $owner_id = $unit->owner_id;
        $owner = Owner::find($owner_id);

        // Get completed unit details
        $completedUnit = CompletedUnit::where('unit_id' , $id)->first();
        return view('user.showUnit' , compact('unit' , 'owner' , 'completedUnit'));
    }

    // Show Unit Details for Admin
    public function showUnitDetailsForAdmin($id)
    {
        $unit = Unit::find($id);
        $owner_id = $unit->owner_id;
        $owner = Owner::find($owner_id);

        // If request status is completed get the completed unit details
            $completedUnit = CompletedUnit::where('unit_id' , $id)->first();
        return view('admin.units.showUnitDetails' , compact('unit' , 'owner' , 'completedUnit'));
    }

    // Show Rejected Units
    public function rejectedUnits(){
        $units = Unit::with('admin')->where('request_status' , 'rejected')->get();
        return view('admin.units.rejectedUnits' , compact('units'));
    }

    // Show Updated Units
    public function updatedUnits(){
        $units = [];
         // Check if the admin is not a master
    if (auth()->user()->is_master != 1) {
        // Filter units to only those that do not have 'managed_by' set
        $units = Unit::latest()
            ->whereNull('managed_by')
            ->where('request_status' , 'updated')
            ->with('admin')
            ->paginate(15);
    } else {
        // If the admin is a master, get all units
        $units = Unit::latest()
            ->with('admin')
            ->where('request_status' , 'updated')
            ->paginate(15);
    }
        return view('admin.units.updatedUnits' , compact('units'));
    }


    // Get All Approved Units
    public function getApprovedUnits(){
        $units = [];
        // Check if the admin is not a master
   if (auth()->user()->is_master != 1) {
       // Filter units to only those that do not have 'managed_by' set
       $units = Unit::latest()
           ->whereNull('managed_by')
           ->where('request_status' , 'approved')
           ->with('admin')
           ->paginate(15);
   } else {
       // If the admin is a master, get all units
       $units = Unit::latest()
           ->with('admin')
           ->where('request_status' , 'approved')
           ->paginate(15);
   }

        return view('admin.units.approvedUnits' , compact('units'));
    }
    // ==============================================================================

}
