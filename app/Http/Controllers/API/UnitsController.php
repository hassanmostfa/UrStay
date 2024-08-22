<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Models\Unit;
class UnitsController extends Controller
{
    /* Retrieves all units from the database and returns them as a JSON response. */
    public function showAllUnits()
    {
        $units = Unit::all();
        return response()->json(["success" => true ,"data" =>$units]);
    }



    /* Creates a new unit in the database and returns the created unit as a JSON response. */
    public function createUnit(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'owner_id' => 'required',
                'owner_name' => 'required|string|max:255',
                'unit_title' => 'required|string|max:255',
                'unit_image' => 'required',
                'unit_price' => 'required',
                'unit_location' => 'required|string|max:255',
                'unit_description' => 'required|string|max:255',
                'unit_size' => 'required',
                'unit_rooms' => 'required',
                'unit_bathrooms' => 'required',
                'unit_type' => 'required',
                'unit_status' => 'required',
                'owner_email' => 'required',
                'owner_phone' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }else {
                $unit = Unit::create([
                    'owner_id' => $request->owner_id,
                    'owner_name' => $request->owner_name,
                    'unit_title' => $request->unit_title,
                    'unit_image' => $request->file('unit_image')->store('unitsImages'),
                    'rate' => $request->rate,
                    'unit_price' => $request->unit_price,
                    'unit_description' => $request->unit_description,
                    'unit_status' => $request->unit_status,
                    'unit_location' => $request->unit_location,
                    'unit_size' => $request->unit_size,
                    'unit_rooms' => $request->unit_rooms,
                    'unit_bathrooms' => $request->unit_bathrooms,
                    'unit_type' => $request->unit_type,
                    'owner_email' => $request->owner_email,
                    'owner_phone' => $request->owner_phone,
                ]);
                return response()->json(["success" => true , "message" => "Unit created successfully." ,"data" => $unit], 200);
            }
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => $th->getMessage()], 500);
        }
    }



    /* Retrieves a single unit from the database and returns it as a JSON response. */
    public function showOneUnit($id)
    {
        $unit = Unit::findorfail($id);
        return response()->json(["success" => true ,"data" => $unit]);
    }


    /* Updates a unit in the database and returns the updated unit as a JSON response. */
    public function updateUnit(Request $request, $id)
    {
        $unit = Unit::findorfail($id);
        if ($unit) {
            try {
                $validator = Validator::make($request->all(), [
                    'owner_id' => 'required',
                    'owner_name' => 'required|string|max:255',
                    'unit_title' => 'required|string|max:255',
                    'unit_image' => 'required',
                    'unit_price' => 'required',
                    'unit_location' => 'required|string|max:255',
                    'unit_description' => 'required|string|max:255',
                    'unit_size' => 'required',
                    'unit_rooms' => 'required',
                    'unit_bathrooms' => 'required', 
                    'unit_type' => 'required',
                    'unit_status' => 'required',
                    'owner_email' => 'required',
                    'owner_phone' => 'required',
                ]);
                $unit->update([ 
                    'owner_id' => $request->owner_id,
                    'owner_name' => $request->owner_name,
                    'unit_title' => $request->unit_title,
                    'rate' => $request->rate,
                    'unit_price' => $request->unit_price,   
                    'unit_location' => $request->unit_location,
                    'unit_description' => $request->unit_description,
                    'unit_size' => $request->unit_size,
                    'unit_rooms' => $request->unit_rooms,
                    'unit_bathrooms' => $request->unit_bathrooms,
                    'unit_type' => $request->unit_type,
                    'unit_status' => $request->unit_status,
                    'owner_email' => $request->owner_email,
                    'owner_phone' => $request->owner_phone,
                ]);
                
                if ($request->hasFile('unit_image')) {
                    $unit->unit_image = $request->file('unit_image')->store('unitsImages');
                    $unit->save();
                }
                return response()->json(["success" => true , "message" => "Unit updated successfully." ,"data" => $unit], 200);
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => $th->getMessage()], 500);
        }
    }
}


/* Deletes a unit from the database and returns the deleted unit as a JSON response. */
public function destroyUnit($id)
{
    try {
        $unit = Unit::findorfail($id);
        if ($unit) {
            $unit->delete();
            return response()->json(["success" => true, "message" => "Unit deleted successfully."], 200);
        }else {
            return response()->json(['success' => false, 'message' => 'Unit not found.'], 404);
        }
    } catch (\Throwable $th) {
        return response()->json(['success' => false, 'message' => $th->getMessage()], 500);
    }
}
}
