<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Zone;
use App\Models\Governorate;
use App\Models\City;
use App\Models\District;

class LocationsController extends Controller
{
    // Get All Zones
    public function getAllZones()
    {
        try {
            $zones = Zone::all();

            if ($zones->isEmpty()) {
                return response()->json([
                    'status' => false,
                    'msg' => 'No zones found',
                    'data' => null,
                    'notes' => ['No zones available'],
                ], 404);
            }

            return response()->json([
                'status' => true,
                'msg' => 'Zones retrieved successfully',
                'data' => $zones,
                'notes' => ['List of zones retrieved'],
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'msg' => 'Error retrieving zones',
                'data' => null,
                'notes' => [$e->getMessage()],
            ], 500);
        }
    }

    // Fetch governorates based on selected zone
    public function getGovernoratesByZoneId($zoneId)
    {
        try {
            $governorates = Governorate::where('zone_id', $zoneId)->get();

            if ($governorates->isEmpty()) {
                return response()->json([
                    'status' => false,
                    'msg' => 'No governorates found for the selected zone',
                    'data' => null,
                    'notes' => ['No governorates available for this zone'],
                ], 404);
            }

            return response()->json([
                'status' => true,
                'msg' => 'Governorates retrieved successfully',
                'data' => $governorates,
                'notes' => ['List of governorates retrieved for the zone'],
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'msg' => 'Error retrieving governorates',
                'data' => null,
                'notes' => [$e->getMessage()],
            ], 500);
        }
    }

    // Fetch cities based on selected governorate
    public function getCities()
    {
        try {
            $cities = City::all();

            if ($cities->isEmpty()) {
                return response()->json([
                    'status' => false,
                    'msg' => 'No cities found for the selected governorate',
                    'data' => null,
                    'notes' => ['No cities available for this governorate'],
                ], 404);
            }

            return response()->json([
                'status' => true,
                'msg' => 'Cities retrieved successfully',
                'data' => $cities,
                'notes' => ['List of cities retrieved for the governorate'],
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'msg' => 'Error retrieving cities',
                'data' => null,
                'notes' => [$e->getMessage()],
            ], 500);
        }
    }

    // Fetch districts based on selected city
    public function getDistrictsByCityId($cityId)
    {
        try {
            $districts = District::where('city_id', $cityId)->get();

            if ($districts->isEmpty()) {
                return response()->json([
                    'status' => false,
                    'msg' => 'No districts found for the selected city',
                    'data' => null,
                    'notes' => ['No districts available for this city'],
                ], 404);
            }

            return response()->json([
                'status' => true,
                'msg' => 'Districts retrieved successfully',
                'data' => $districts,
                'notes' => ['List of districts retrieved for the city'],
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'msg' => 'Error retrieving districts',
                'data' => null,
                'notes' => [$e->getMessage()],
            ], 500);
        }
    }
}
