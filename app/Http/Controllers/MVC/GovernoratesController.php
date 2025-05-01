<?php

namespace App\Http\Controllers\MVC;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Zone;
use App\Models\Governorate;


class GovernoratesController extends Controller
{
        // Show Governorates Page
        public function governorates()
        {
            // Get All Zones
            $zones = Zone::all();
            // Get All Governorates
            $governorates = Governorate::all ();
    
            // Get How Many Cities For Each Governorate
            foreach ($governorates as $governorate) {
                $governorate->cities_count = $governorate->cities()->count();
            }
            // Get Every Governorate With Its Zone
            foreach ($governorates as $governorate) {
                $governorate->zone = $governorate->zone()->first();
            }
            return view('admin.locations.governorates' , compact('governorates' , 'zones'));
        }
    
    
        // Add Governorate
        public function addGovernorate()
        {
            $validator = Validator::make(request()->all(), [
                'name' => 'required',
                'zone_id' => 'required',
            ]);
            if ($validator->fails()) {
                return redirect()->route('admin.governorates')->with('error', $validator->errors()->first());
            }
            $governorate = new Governorate();
            $governorate->name = request()->name;
            $governorate->zone_id = request()->zone_id;
            $governorate->save();
            return redirect()->route('admin.governorates')->with('success', 'Governorate Added Successfully');
        }
    
        // Delete Governorate 
        public function deleteGovernorate($id) {
            $governorate = Governorate::find($id);
            $governorate->delete();
            return redirect()->route('admin.governorates')->with('success', 'Governorate Deleted Successfully');
        }
}
