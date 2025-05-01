<?php

namespace App\Http\Controllers\MVC;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Country;

class CountriesController extends Controller
{
    //===============================================================================
    //======================= Countries Functions For Admin =========================
    //===============================================================================

//============================================================================>

    // Show Countries Page
    public function countries()
    {
        // Show All Countries
        $countries = Country::all();

        // Get How Many Zones For Each Country
        foreach ($countries as $country) {
            $country->zones_count = $country->zones()->count();
        }
        return view('admin.locations.countries' , compact('countries'));
    }

    // Add Country
    public function addCountry()
    {
        $validator = Validator::make(request()->all(), [
            'name' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->route('admin.countries')->with('error', $validator->errors()->first());
        }
        $country = new Country();
        $country->name = request()->name;
        $country->save();
        return redirect()->route('admin.countries')->with('success', 'Country Added Successfully');
    }

    //============================================================================>
    //=============================================================================== //
}
