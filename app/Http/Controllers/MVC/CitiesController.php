<?php

namespace App\Http\Controllers\MVC;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Zone;
use App\Models\Governorate;
use App\Models\City;

class CitiesController extends Controller
{

    // Show Cities Page
    public function cities()
    {

        // Get All Governorates
        $governorates = Governorate::all();
        // Get All Zones
        $zones = Zone::all();
        // Get All Cities
        $cities = City::all();

        // Get Every City With Its Governorate
        foreach ($cities as $city) {
            $city->governorate = $city->governorate()->first();
        }

        // Get count of districts for each city
        foreach ($cities as $city) {
            $city->districts_count = $city->districts()->count();
        }
        return view('admin.locations.cities' , compact('cities' ,'governorates' , 'zones'));
    }


    // Get Governorates By Zone
    public function getGovernoratesByZone($zoneId)
{
    $governorates = Governorate::where('zone_id', $zoneId)->get();
    return response()->json($governorates);
}
    // Add City
    public function addCity()
    {
        $validator = Validator::make(request()->all(), [
            'name' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->route('admin.cities')->with('error', $validator->errors()->first());
        }
        $city = new City();
        $city->name = request()->name;
        $city->save();
        return redirect()->route('admin.cities')->with('success', 'City Added Successfully');
    }

    // Delete City
    public function deleteCity($id) {
        $city = City::find($id);
        $city->delete();
        return redirect()->route('admin.cities')->with('success', 'City Deleted Successfully');
    }

}
