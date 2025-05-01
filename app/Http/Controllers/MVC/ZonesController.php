<?php

namespace App\Http\Controllers\MVC;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Zone;

class ZonesController extends Controller
{

        // Show Zones Page
        public function zones()
        {
            // Show All Zones
            $zones = Zone::all();
            // Get How Many governorates For Each Zone
            foreach ($zones as $zone) {
                $zone->governorates_count = $zone->governorates()->count();
            }
            // // Get Every Zone With Its Country
            // foreach ($zones as $zone) {
            //     $zone->country = $zone->country()->first();
            // }
            return view('admin.locations.zones' , compact('zones'));
        }
    
        // Add Zone 
        public function addZone()
        {
            $validator = Validator::make(request()->all(), [
                'name' => 'required',
                // 'country_id' => 'required',
            ]);
            if ($validator->fails()) {
                return redirect()->route('admin.zones')->with('error', $validator->errors()->first());
            }
            $zone = new Zone();
            // $zone->country_id = request()->country_id;
            $zone->name = request()->name;
            $zone->save();
            return redirect()->route('admin.zones')->with('success', 'Zone Added Successfully');
        }
    
        // Delete Zone 
        public function deleteZone($id) {
            $zone = Zone::find($id);
            $zone->delete();
            return redirect()->route('admin.zones')->with('success', 'Zone Deleted Successfully');
        }
}
