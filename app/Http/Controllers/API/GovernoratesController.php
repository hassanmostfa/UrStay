<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Zone;
use App\Models\Governorate;

class GovernoratesController extends Controller
{
    // Get all Governorates
    public function getGovernorates()
    {
        $governorates = Governorate::all();
        $zones = Zone::all();

        // Add city count and zone information for each governorate
        foreach ($governorates as $governorate) {
            $governorate->cities_count = $governorate->cities()->count();
            $governorate->zone = $governorate->zone()->first();
        }

        return response()->json([
            'status' => true,
            'msg' => 'Governorates fetched successfully',
            'data' => ['governorates' => $governorates, 'zones' => $zones],
            'notes' => ['Fetched all governorates with related zones']
        ], 200);
    }

    // Add a new Governorate
    public function addGovernorate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'zone_id' => 'required|exists:zones,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'msg' => $validator->errors()->first(),
                'data' => null,
                'notes' => ['Invalid data provided']
            ], 400);
        }

        $governorate = new Governorate();
        $governorate->name = $request->name;
        $governorate->zone_id = $request->zone_id;
        $governorate->save();

        return response()->json([
            'status' => true,
            'msg' => 'Governorate added successfully',
            'data' => ['governorate' => $governorate],
            'notes' => ['New governorate created']
        ], 201);
    }

    // Delete a Governorate
    public function deleteGovernorate($id)
    {
        $governorate = Governorate::find($id);

        if (!$governorate) {
            return response()->json([
                'status' => false,
                'msg' => 'Governorate not found',
                'data' => null,
                'notes' => ['Governorate with the given ID does not exist']
            ], 404);
        }

        $governorate->delete();

        return response()->json([
            'status' => true,
            'msg' => 'Governorate deleted successfully',
            'data' => null,
            'notes' => ['Governorate deletion successful']
        ], 200);
    }
}
