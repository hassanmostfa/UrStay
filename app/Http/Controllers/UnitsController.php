<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Unit;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class UnitsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $units = Unit::where('owner_id', auth()->user()->id)
            ->where('request_status', 'approved')
            ->get();
        return view('owner.units', compact('units'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('owner.unit-create' , compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'owner_name' => 'required',
            'unit_title' => 'required',
            'owner_id' => 'required',
            'unit_price' => 'required',
            'unit_location' => 'required',
            'unit_size' => 'required',
            'unit_rooms' => 'required',
            'unit_bathrooms' => 'required',
            'unit_type' => 'required',
            'unit_status' => 'required',
            'lisence_one' => 'required|file|mimes:pdf,jpg,png,jpeg|max:2048',
            'lisence_two' => 'required|file|mimes:pdf,jpg,png,jpeg|max:2048',
            'owner_email' => 'required',
            'owner_phone' => 'required',
            'unit_description' => 'required',
            
        ]);

        $unit = new Unit();
        $unit->owner_name = $request->owner_name;
        $unit->owner_id = $request->owner_id;
        $unit->unit_title = $request->unit_title;
        $unit->unit_price = $request->unit_price;
        $unit->unit_location = $request->unit_location;
        $unit->unit_size = $request->unit_size;
        $unit->unit_rooms = $request->unit_rooms;
        $unit->unit_bathrooms = $request->unit_bathrooms;
        $unit->unit_type = $request->unit_type;
        $unit->unit_status = $request->unit_status; 
        $unit->owner_email = $request->owner_email;
        $unit->owner_phone = $request->owner_phone;
        $unit->unit_description = $request->unit_description;
        $unit->rate = $request->rate;
        $unit->lisence_one = $request->file('lisence_one')->store('unitsLisences');
        $unit->lisence_two = $request->file('lisence_two')->store('unitsLisences');
        $unit->unit_image = $request->file('unit_image')->store('unitsImages');
        $unit->save();
        return redirect()->route('owner/home')->with('success', 'تم ارسال طلبك بنجاح');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $unit = Unit::find($id);
        $categories = Category::all();
        return view('owner.edit-unit', compact('unit') , compact('categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'owner_name' => 'required',
            'unit_title' => 'required',
            'owner_id' => 'required',
            'unit_price' => 'required',
            'unit_location' => 'required',
            'unit_size' => 'required',
            'unit_rooms' => 'required',
            'unit_bathrooms' => 'required',
            'unit_type' => 'required',
            'unit_status' => 'required',
            'owner_email' => 'required',
            'owner_phone' => 'required',
            'unit_description' => 'required',
        ]);

        $unit = Unit::find($id);
        if($unit){
            $unit->owner_name = $request->owner_name;
            $unit->owner_id = $request->owner_id;
            $unit->unit_title = $request->unit_title;
            $unit->unit_price = $request->unit_price;
            $unit->unit_location = $request->unit_location;
            $unit->unit_size = $request->unit_size;
            $unit->unit_rooms = $request->unit_rooms;
            $unit->unit_bathrooms = $request->unit_bathrooms;
            $unit->unit_type = $request->unit_type;
            $unit->unit_status = $request->unit_status; 
            $unit->owner_email = $request->owner_email;
            $unit->owner_phone = $request->owner_phone;
            $unit->unit_description = $request->unit_description;
            $unit->rate = $request->rate;
            // $unit->lisence_one = $request->file('lisence_one')->store('unitsLisences');
            // $unit->lisence_two = $request->file('lisence_two')->store('unitsLisences');
            $unit->unit_image = $request->file('unit_image')->store('unitsImages');
        $unit->save();
        return redirect()->route('owner/home');
        }else{
            return redirect()->route('owner/home')->with('error', 'Unit not found');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $unit = Unit::find($id);
        $unit->delete();
        return redirect()->route('owner/home');
    }


    // show unit data
    public function showSingleUnitData($id){
        $unit = Unit::find($id);
        return view('admin.units.showUnitData', compact('unit'));
    }
    
}
