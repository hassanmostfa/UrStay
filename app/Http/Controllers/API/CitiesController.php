<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Zone;
use App\Models\Governorate;
use App\Models\City;

class CitiesController extends Controller
{
    // Get all cities with related governorates and districts count
    public function getCities()
    {
        // Get all cities
        $cities = City::with('districts')->get();

        return response()->json([
            'status' => true,
            'msg' => 'Cities retrieved successfully',
            'data' => $cities,
            'notes' => ['Retrieved all cities with their governorates and districts count'],
        ], 200);
    }

    // Get all governorates by zone ID
    public function getGovernoratesByZone($zoneId)
    {
        $governorates = Governorate::where('zone_id', $zoneId)->get();

        if ($governorates->isEmpty()) {
            return response()->json([
                'status' => false,
                'msg' => 'No governorates found for the given zone',
                'data' => null,
                'notes' => ['No governorates are associated with the specified zone ID'],
            ], 404);
        }

        return response()->json([
            'status' => true,
            'msg' => 'Governorates retrieved successfully',
            'data' => $governorates,
            'notes' => ['Governorates associated with the specified zone ID were retrieved'],
        ], 200);
    }

    // Add a new city
    public function addCity(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'governorate_id' => 'required|exists:governorates,id',
            'zone_id' => 'required|exists:zones,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'msg' => 'Validation error',
                'data' => null,
                'notes' => $validator->errors()->all(),
            ], 422);
        }

        $city = new City();
        $city->name = $request->name;
        $city->governorate_id = $request->governorate_id;
        $city->zone_id = $request->zone_id;
        $city->save();

        return response()->json([
            'status' => true,
            'msg' => 'City added successfully',
            'data' => $city,
            'notes' => ['The city has been added to the database'],
        ], 201);
    }

    // Delete a city by ID
    public function deleteCity($id)
    {
        $city = City::find($id);

        if (!$city) {
            return response()->json([
                'status' => false,
                'msg' => 'City not found',
                'data' => null,
                'notes' => ['City with the given ID does not exist'],
            ], 404);
        }

        $city->delete();

        return response()->json([
            'status' => true,
            'msg' => 'City deleted successfully',
            'data' => null,
            'notes' => ['City deletion successful'],
        ], 200);
    }
}
