<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Unit;
use App\Models\Category;

class UnitsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $units = Unit::where('owner_id', auth()->user()->id)->get();
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
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
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
        
        if($request->hasFile('unit_image')){
            $file = $request->file('unit_image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('uploads', $filename);
            $unit->unit_image = $filename;
        }

        $unit->save();
        return redirect()->route('owner/dashboard');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $unit = Unit::find($id);
        $categories = Category::all();
        return view('owner.edit-unit', compact('unit') , compact('categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'owner_name' => 'required',
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
        $unit->owner_name = $request->owner_name;
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
        $unit->save();
        return redirect()->route('owner/dashboard');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $unit = Unit::find($id);
        $unit->delete();
        return redirect()->route('owner/dashboard');
    }


}
