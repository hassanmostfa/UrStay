<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Zone;

class ZonesController extends Controller
{
    // Get all Zones
    public function getZones()
    {
        $zones = Zone::all();

        foreach ($zones as $zone) {
            $zone->governorates_count = $zone->governorates()->count();
        }

        return response()->json([
            'status' => true,
            'msg' => 'Zones fetched successfully',
            'data' => ['zones' => $zones],
            'notes' => ['Fetched all zones']
        ], 200);
    }

    // Add a new Zone
    public function addZone(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'msg' => $validator->errors()->first(),
                'data' => null,
                'notes' => ['Invalid data provided']
            ], 400);
        }

        $zone = new Zone();
        $zone->name = $request->name;
        $zone->save();

        return response()->json([
            'status' => true,
            'msg' => 'Zone added successfully',
            'data' => ['zone' => $zone],
            'notes' => ['New zone created']
        ], 201);
    }

    // Delete a Zone
    public function deleteZone($id)
    {
        $zone = Zone::find($id);

        if (!$zone) {
            return response()->json([
                'status' => false,
                'msg' => 'Zone not found',
                'data' => null,
                'notes' => ['Zone with the given ID does not exist']
            ], 404);
        }

        $zone->delete();

        return response()->json([
            'status' => true,
            'msg' => 'Zone deleted successfully',
            'data' => null,
            'notes' => ['Zone deletion successful']
        ], 200);
    }
}
