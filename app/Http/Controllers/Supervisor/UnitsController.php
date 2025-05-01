<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Unit;
use App\Models\Category;
use App\Models\Zone;
use App\Models\Governorate;
use App\Models\City;
use App\Models\CompletedUnit;
use App\Models\District;
use Illuminate\Support\Facades\Log;

class UnitsController extends Controller
{
    // Reset Add Unit Page
    public function addUnitPage()
    {
        // Get all Categories
        $categories = Category::all();

        // Get all zones
        $zones = Zone::all();
        // Get all governates
        $governorates = Governorate::all();
        // Get all cities
        $cities = City::all();
        // Get all districts
        $districts = District::all();

        return view('supervisor.units.addUnit' , compact('zones' , 'governorates' , 'cities' , 'districts' , 'categories'));
    }

    // Reset Add Unit Actionpublic function addUnit(Request $request)
    public function addUnit(Request $request, $owner)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'category' => 'required|string',
            // 'subcategory' => 'required|string',
            // 'sub_sub_category' => 'required|string',
            'zone_name' => 'required|string|max:255',
            'governorate_name' => 'required|string|max:255',
            'city_name' => 'required|string|max:255',
            'district_name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'size' => 'required|numeric',
            'facilities' => 'array',
            'rooms' => 'required|integer',
            'no_of_single_beds' => 'required|integer',
            'no_of_master_beds' => 'required|integer',
            'pool' => 'required|integer',
            'kitchen' => 'array',
            'table_chairs' => 'required|integer',
            'bathrooms' => 'required|integer',
            'bathroom_facilities' => 'array',
            'additional_facilities' => 'array',
            'advantages' => 'array',
            'description' => 'nullable|string',
            'images' => 'nullable|array', // Ensure that 'images' is an array
            'images.*' => 'image|mimes:jpg,png,jpeg|max:2048', // Validate each file in the 'images' array
            'rooms_images' => 'nullable|array', // Ensure that 'rooms_images' is an array
            'rooms_images.*' => 'image|mimes:jpg,png,jpeg|max:2048', // Validate each file in the 'rooms_images' array
            'kitchen_images' => 'nullable|array', // Ensure that 'kitchen_images' is an array
            'kitchen_images.*' => 'image|mimes:jpg,png,jpeg|max:2048', // Validate each file in the 'kitchen_images' array
            'has_mot_permission' => 'required|boolean',
            'mot_permission' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => $validator->errors()], 422);
        }

        try {
            // Handle multiple image uploads
            $imagePaths = [];
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    // Log file information
                    Log::info('Uploading file:', ['name' => $image->getClientOriginalName(), 'size' => $image->getSize()]);

                    $path = $image->store('unit_images');
                    $imagePaths[] = $path; // Add each image path to the array
                }
            }

            // Handle rooms image uploads
        $roomImagePaths = [];
        if ($request->hasFile('rooms_images')) {
            foreach ($request->file('rooms_images') as $image) {
                // Log file information
                Log::info('Uploading file:', ['name' => $image->getClientOriginalName(), 'size' => $image->getSize()]);

                $path = $image->store('unit_images'); // Store in the 'public' disk
                $roomImagePaths[] = $path; // Add each image path to the array
            }
        }


        // Handle kitchen images uploads
        $kitchenImagePaths = [];
        if ($request->hasFile('kitchen_images')) {
            foreach ($request->file('kitchen_images') as $image) {
                // Log file information
                Log::info('Uploading file:', ['name' => $image->getClientOriginalName(), 'size' => $image->getSize()]);
                $path = $image->store('unit_images'); // Store in the 'public' disk
                $kitchenImagePaths[] = $path; // Add each image path to the array
            }
        }

        // Handle pool images uploads
        $poolImagePaths = [];
        if ($request->hasFile('pool_images')) {
            foreach ($request->file('pool_images') as $image) {
                // Log file information
                Log::info('Uploading file:', ['name' => $image->getClientOriginalName(), 'size' => $image->getSize()]);
                $path = $image->store('unit_images'); // Store in the 'public' disk
                $poolImagePaths[] = $path; // Add each image path to the array
            }
        }

        // Handle Bathrooms images uploads
        $bathroomImagePaths = [];
        if ($request->hasFile('bathroom_images')) {
            foreach ($request->file('bathroom_images') as $image) {
                // Log file information
                Log::info('Uploading file:', ['name' => $image->getClientOriginalName(), 'size' => $image->getSize()]);
                $path = $image->store('unit_images'); // Store in the 'public' disk
                $bathroomImagePaths[] = $path; // Add each image path to the array
            }
        }

        // Handle Building images uploads
        $buildingImagePaths = [];
        if ($request->hasFile('building_images')) {
            foreach ($request->file('building_images') as $image) {
                // Log file information
                Log::info('Uploading file:', ['name' => $image->getClientOriginalName(), 'size' => $image->getSize()]);
                $path = $image->store('unit_images'); // Store in the 'public' disk
                $buildingImagePaths[] = $path; // Add each image path to the array
            }
        }

        // Handle facilities images uploads

        $facilitiesImagePaths = [];
        if ($request->hasFile('facilities_images')) {
            foreach ($request->file('facilities_images') as $image) {
                // Log file information
                Log::info('Uploading file:', ['name' => $image->getClientOriginalName(), 'size' => $image->getSize()]);
                $path = $image->store('unit_images'); // Store in the 'public' disk
                $facilitiesImagePaths[] = $path; // Add each image path to the array
            }
        }

        // Handle additional images uploads
        $additionalImagePaths = [];
        if ($request->hasFile('additional_images')) {
            foreach ($request->file('additional_images') as $image) {
                // Log file information
                Log::info('Uploading file:', ['name' => $image->getClientOriginalName(), 'size' => $image->getSize()]);
                $path = $image->store('unit_images'); // Store in the 'public' disk
                $additionalImagePaths[] = $path; // Add each image path to the array
            }
        }


            // Convert image paths to JSON (store it as an array of file paths in the database)
            $imageJson = json_encode($imagePaths);

            // Convert room image paths to JSON (store it as an array of file paths in the database)
            $roomImageJson = json_encode($roomImagePaths);

            // Convert kitchen image paths to JSON (store it as an array of file paths in the database)
            $kitchenImageJson = json_encode($kitchenImagePaths);

            // Convert pool image paths to JSON (store it as an array of file paths in the database)
            $poolImageJson = json_encode($poolImagePaths);

            // Convert bathroom image paths to JSON (store it as an array of file paths in the database)
            $bathroomImageJson = json_encode($bathroomImagePaths);

            // Convert building image paths to JSON (store it as an array of file paths in the database)
            $buildingImageJson = json_encode($buildingImagePaths);

            // Convert facilities image paths to JSON (store it as an array of file paths in the database)
            $facilitiesImageJson = json_encode($facilitiesImagePaths);

            // Convert additional image paths to JSON (store it as an array of file paths in the database)
            $additionalImageJson = json_encode($additionalImagePaths);

            // Create a new unit and store all fields, including the image paths as JSON
            $unit = new Unit([
                'owner_id' => $owner,
                'title' => $request->input('title'),
                'category' => $request->input('category'),
                // 'sub_category' => $request->input('subcategory'),
                // 'sub_sub_category' => $request->input('sub_sub_category'),
                'zone_name' => $request->input('zone_name'),
                'governorate_name' => $request->input('governorate_name'),
                'city_name' => $request->input('city_name'),
                'district_name' => $request->input('district_name'),
                'location' => $request->input('location'),
                'size' => $request->input('size'),
                'facilities' => json_encode($request->input('facilities')),
                'rooms' => $request->input('rooms'),
                'no_of_single_beds' => $request->input('no_of_single_beds'),
                'no_of_master_beds' => $request->input('no_of_master_beds'),
                'pool' => $request->input('pool'),
                'pool_size' => $request->input('pool_size'),
                'kitchen' => json_encode($request->input('kitchen')),
                'table_chairs' => $request->input('table_chairs'),
                'bathrooms' => $request->input('bathrooms'),
                'bathroom_facilities' => json_encode($request->input('bathroom_facilities')),
                'additional_facilities' => json_encode($request->input('additional_facilities')),
                'advantages' => json_encode($request->input('advantages')),
                'description' => $request->input('description'),
                'image' => $imageJson, // Store image paths as JSON
                'rooms_images' => $roomImageJson, // Store room image paths as JSON
                'kitchen_images' => $kitchenImageJson, // Store kitchen image paths as JSON
                'pool_images' => $poolImageJson, // Store pool image paths as JSON
                'bathroom_images' => $bathroomImageJson, // Store bathroom image paths as JSON
                'building_images' => $buildingImageJson, // Store building image paths as JSON
                'facilities_images' => $facilitiesImageJson, // Store facilities image paths as JSON
                'additional_images' => $additionalImageJson, // Store additional image paths as JSON
                'price' => $request->input('price'),
                'has_mot_permission' => $request->input('has_mot_permission'),
                'mot_permission' => $request->file('mot_permission') ? $request->file('mot_permission')->store('mot_permissions') : null,
            ]);

            $unit->save();
            return redirect()->route('manage.owner.myUnits', ['owner' => $owner])->with('success', 'تم تسجيل الوحدة بنجاح ، سيتم تفعيلها من قبل المشرف في اقرب وقت.');
        } catch (\Exception $e) {
            // Log exception message for debugging
            Log::error('Error creating unit:', ['message' => $e->getMessage()]);
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }

    // Get Owner Units
    public function getOwnerUnits($owner)
    {
        $units = Unit::where('owner_id', $owner)
            ->whereIn('request_status', ['approved', 'completed' , 'accepted' , 'pending']) // Get both approved and completed units
            ->get();

        return view('supervisor.units.myUnits', compact('units'));
    }


    // Show Unit Details
    public function showUnitDetails($owner, $id)
    {
        try {
        $unit = Unit::where('owner_id', $owner)->find($id);

        if ($unit) {
            return view('supervisor.units.showUnit', compact('unit'));
        }else{
            return redirect()->route('supervisor-dashboard')->with('error', 'Unit not found.');
        }
        } catch (\Exception $e) {
            return redirect()->route('supervisor-dashboard')->with('error', 'Unit not found.');
        }
    }


    // Update Unit Page
    public function updateUnitPage(Request $request ,$owner, $id)
    {
        $unit = Unit::find($id);
        $categories = Category::all();
        $zones = Zone::all();
        $completed_unit = CompletedUnit::where('unit_id' , $id)->first();
        return view('supervisor.units.updateUnit' , compact('unit' , 'categories' , 'zones' , 'completed_unit'));
    }


  // Update Unit
public function updateUnit(Request $request,$owner, $id)
{
    // Find the unit where both the id and owner_id match
    $unit = Unit::where('id', $id)->where('owner_id', $owner)->first();

    // Check if the unit was found
    if ($unit) {

        try{
            if($unit->request_status == 'rejected')
            {
                $unit->request_status = 'pending';
                $unit->save();
            }else{
                $unit->update($request->all());
                $unit->request_status = 'updated';
            }
        }catch(\Exception $e){
            return redirect()->route('manage.owner.myUnits', ['owner' => $owner])->with('error', 'Unit not found or you do not have permission to update it.');
        }

        if ($request->hasFile('mot_permission')) {
            $unit->mot_permission = $request->file('mot_permission')->store('mot_permissions');
            $unit->has_mot_permission = true;
            $unit->save();
        }

        $unit->save();

        return redirect()->route('manage.owner.myUnits', ['owner' => $owner])->with('success', 'Unit updated successfully.');
    }

    // If the unit was not found, return with an error
    return redirect()->route('manage.owner.myUnits', ['owner' => $owner])->with('error', 'Unit not found or you do not have permission to update it.');
}

    // Delete Unit
    public function deleteUnit($owner, $id)
    {
        $unit = Unit::find($id)->where('owner_id', $owner);
        $unit->delete();
        return redirect()->route('owner.myUnits')->with('success', 'Unit deleted successfully.');
    }

    // Show Updated Units
    public function updatedUnits($owner)
    {
        $units = Unit::where('owner_id', $owner)
        ->where('request_status', 'updated')
        ->get();
        return view('supervisor.units.updatedUnits', compact('units'));
    }

    // Show Rejected Units
    public function rejectedUnits($owner)
    {
        $units = Unit::where('owner_id', $owner)
        ->where('request_status', 'rejected')
        ->get();
        return view('supervisor.units.rejectedUnits', compact('units'));
    }
}
