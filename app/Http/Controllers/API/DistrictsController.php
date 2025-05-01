<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Zone;
use App\Models\Governorate;
use App\Models\City;
use App\Models\District;

class DistrictsController extends Controller
{
    // Get all districts with related cities, zones, and governorates
    public function getDistricts()
    {
        $districts = District::with(['city', 'zone', 'governorate'])->get();

        return response()->json([
            'status' => true,
            'msg' => 'Districts retrieved successfully',
            'data' => $districts,
            'notes' => ['Retrieved all districts with their related cities, zones, and governorates'],
        ], 200);
    }

    // Get cities by governorate ID
    public function getCitiesByGovernorate($governorateId)
    {
        $cities = City::where('governorate_id', $governorateId)->get();

        if ($cities->isEmpty()) {
            return response()->json([
                'status' => false,
                'msg' => 'No cities found for the given governorate',
                'data' => null,
                'notes' => ['No cities are associated with the specified governorate ID'],
            ], 404);
        }

        return response()->json([
            'status' => true,
            'msg' => 'Cities retrieved successfully',
            'data' => $cities,
            'notes' => ['Cities associated with the specified governorate ID were retrieved'],
        ], 200);
    }

    // Add a new district
    public function addDistrict(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'city_id' => 'required|exists:cities,id',
            'zone_id' => 'required|exists:zones,id',
            'governorate_id' => 'required|exists:governorates,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'msg' => 'Validation error',
                'data' => null,
                'notes' => $validator->errors()->all(),
            ], 422);
        }

        $district = new District();
        $district->name = $request->name;
        $district->city_id = $request->city_id;
        $district->zone_id = $request->zone_id;
        $district->governorate_id = $request->governorate_id;
        $district->save();

        return response()->json([
            'status' => true,
            'msg' => 'District added successfully',
            'data' => $district,
            'notes' => ['The district has been added to the database'],
        ], 201);
    }

    // Delete a district by ID
    public function deleteDistrict($id)
    {
        $district = District::find($id);

        if (!$district) {
            return response()->json([
                'status' => false,
                'msg' => 'District not found',
                'data' => null,
                'notes' => ['District with the given ID does not exist'],
            ], 404);
        }

        $district->delete();

        return response()->json([
            'status' => true,
            'msg' => 'District deleted successfully',
            'data' => null,
            'notes' => ['District deletion successful'],
        ], 200);
    }
}
