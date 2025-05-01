<?php

namespace App\Http\Controllers\MVC;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Zone;
use App\Models\Governorate;
use App\Models\City;
use App\Models\District;


class DistrictsController extends Controller
{
     // Show Districts Page
        public function districts()
        {
            // Get All Zones
            $zones = Zone::all();
            // Get All Governorates
            $governorates = Governorate::all();
            // Get All Cities
            $cities = City::all();
            // Get All Districts
            $districts = District::all();
            return view('admin.locations.districts' , compact('districts' , 'cities' , 'zones' , 'governorates'));
        }

        // Get Cities By Governorate
        public function getCitiesByGovernorate($governorateId)
    {
        $cities = City::where('governorate_id', $governorateId)->get();
        return response()->json($cities);
    }


        // Add District
        public function addDistrict()
        {
            $validator = Validator::make(request()->all(), [
                'name' => 'required',
                'city_id' => 'required',
                // 'country_id' => 'required',
            ]);
            if ($validator->fails()) {
                return redirect()->route('admin.districts')->with('error', $validator->errors()->first());
            }
            $district = new District();
            $district->name = request()->name;
            $district->city_id = request()->city_id;
            // $district->country_id = request()->country_id;
            $district->save();
            return redirect()->route('admin.districts')->with('success', 'District Added Successfully');
        }

        // Delete District
        public function deleteDistrict($id) {
            $district = District::find($id);
            $district->delete();
            return redirect()->route('admin.districts')->with('success', 'District Deleted Successfully');
        }
}
