<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Unit;
use App\Models\Owner;
use App\Models\CompletedUnit;

class CompletedUnitsController extends Controller
{
    // Save Completed Units
public function saveCompletedUnits(Request $request, $owner, $id)
{
    // Validation
    $validator = Validator::make($request->all(), [
        'saturday_price' => 'required|numeric',
        'sunday_price' => 'required|numeric',
        'monday_price' => 'required|numeric',
        'tuesday_price' => 'required|numeric',
        'wednesday_price' => 'required|numeric',
        'thursday_price' => 'required|numeric',
        'friday_price' => 'required|numeric',
        'availability_of_booking' => 'required|boolean',
        'negotiable_price' => 'required|boolean',
        'booking_status' => 'required|string',
    ]);

    // Return validation errors
    if ($validator->fails()) {
        return response()->json($validator->errors(), 422);
    }

    try {
        // Create and save the completed unit
        $completedUnit = CompletedUnit::create([
            'unit_id' => $id,
            'owner_id' => $owner,  // No need to pass from request
            'saturday_price' => $request->saturday_price,
            'sunday_price' => $request->sunday_price,
            'monday_price' => $request->monday_price,
            'tuesday_price' => $request->tuesday_price,
            'wednesday_price' => $request->wednesday_price,
            'thursday_price' => $request->thursday_price,
            'friday_price' => $request->friday_price,
            'availability_of_booking' => $request->availability_of_booking,
            'negotiable_price' => $request->negotiable_price,
            'booking_status' => $request->booking_status,
        ]);

        // Update unit request status
        $unit = Unit::find($id);
        $unit->request_status = 'completed';
        $unit->save();

        // Redirect with success message
        return redirect()->route('manage.owner.myUnits', ['owner' => $owner])->with('success', 'تم اكمال البيانات بنجاح');
    } catch (\Exception $e) {
        // Redirect with error message
        return redirect()->route('manage.owner.myUnits', ['owner' => $owner])->with('error', 'هناك خطأ ما');
    }
}

// Show Completed Units For Admin
public function showCompletedUnits()
{
    $units = Unit::where('request_status', 'completed')->get();
    return view('admin.units.completedUnits', compact('units'));
}


// Update Completed Units
public function updateCompletedUnitsData($owner, $id)
{
    $completedUnit = CompletedUnit::find($id);
    if ($completedUnit) {
        try {
            $completedUnit->update(request()->all());
            return redirect()->route('manage.owner.myUnits', ['owner' => $owner])->with('success', 'تم تحديث البيانات بنجاح');
        }catch (\Exception $e) {
            return redirect()->route('manage.owner.myUnits', ['owner' => $owner])->with('error', getMessage($e->getMessage()));
        }
    }else{
        return redirect()->route('manage.owner.myUnits', ['owner' => $owner])->with('error', 'هذه الوحدة غير مستكملة البيانات');
    }

}

}

