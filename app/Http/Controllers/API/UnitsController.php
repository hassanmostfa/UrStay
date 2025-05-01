<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Unit;


class UnitsController extends Controller
{

    // Get All Units
    public function addUnit(Request $request)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'category' => 'required|string',
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
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpg,png,jpeg|max:2048',
            'rooms_images' => 'nullable|array',
            'rooms_images.*' => 'image|mimes:jpg,png,jpeg|max:2048',
            'kitchen_images' => 'nullable|array',
            'kitchen_images.*' => 'image|mimes:jpg,png,jpeg|max:2048',
            'has_mot_permission' => 'required|boolean',
            'mot_permission' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 422);
        }
    
        try {
            // Handle image uploads
            $imagePaths = [];
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $path = $image->store('unit_images', 'public');
                    $imagePaths[] = $path;
                }
            }
    
            $roomImagePaths = [];
            if ($request->hasFile('rooms_images')) {
                foreach ($request->file('rooms_images') as $image) {
                    $path = $image->store('unit_images');
                    $roomImagePaths[] = $path;
                }
            }
    
            $kitchenImagePaths = [];
            if ($request->hasFile('kitchen_images')) {
                foreach ($request->file('kitchen_images') as $image) {
                    $path = $image->store('unit_images');
                    $kitchenImagePaths[] = $path;
                }
            }

            // Handle pool images uploads
        $poolImagePaths = [];
        if ($request->hasFile('pool_images')) {
            foreach ($request->file('pool_images') as $image) {
                // Log file information
                \Log::info('Uploading file:', ['name' => $image->getClientOriginalName(), 'size' => $image->getSize()]);
                $path = $image->store('unit_images'); // Store in the 'public' disk
                $poolImagePaths[] = $path; // Add each image path to the array
            }
        }

        // Handle Bathrooms images uploads
        $bathroomImagePaths = [];
        if ($request->hasFile('bathroom_images')) {
            foreach ($request->file('bathroom_images') as $image) {
                // Log file information
                \Log::info('Uploading file:', ['name' => $image->getClientOriginalName(), 'size' => $image->getSize()]);
                $path = $image->store('unit_images'); // Store in the 'public' disk
                $bathroomImagePaths[] = $path; // Add each image path to the array
            }
        }

        // Handle Building images uploads
        $buildingImagePaths = [];
        if ($request->hasFile('building_images')) {
            foreach ($request->file('building_images') as $image) {
                // Log file information
                \Log::info('Uploading file:', ['name' => $image->getClientOriginalName(), 'size' => $image->getSize()]);
                $path = $image->store('unit_images'); // Store in the 'public' disk
                $buildingImagePaths[] = $path; // Add each image path to the array
            }
        }

        // Handle facilities images uploads

        $facilitiesImagePaths = [];
        if ($request->hasFile('facilities_images')) {
            foreach ($request->file('facilities_images') as $image) {
                // Log file information
                \Log::info('Uploading file:', ['name' => $image->getClientOriginalName(), 'size' => $image->getSize()]);
                $path = $image->store('unit_images'); // Store in the 'public' disk
                $facilitiesImagePaths[] = $path; // Add each image path to the array
            }
        }

        // Handle additional images uploads
        $additionalImagePaths = [];
        if ($request->hasFile('additional_images')) {
            foreach ($request->file('additional_images') as $image) {
                // Log file information
                \Log::info('Uploading file:', ['name' => $image->getClientOriginalName(), 'size' => $image->getSize()]);
                $path = $image->store('unit_images'); // Store in the 'public' disk
                $additionalImagePaths[] = $path; // Add each image path to the array
            }
        }
        
            // Convert image paths to JSON
            $imageJson = json_encode($imagePaths);
            $roomImageJson = json_encode($roomImagePaths);
            $kitchenImageJson = json_encode($kitchenImagePaths);
            $poolImageJson = json_encode($poolImagePaths);
            $bathroomImageJson = json_encode($bathroomImagePaths);
            $buildingImageJson = json_encode($buildingImagePaths);
            $facilitiesImageJson = json_encode($facilitiesImagePaths);
            $additionalImageJson = json_encode($additionalImagePaths);
    
            // Create a new unit
            $unit = new Unit([
                'owner_id' => auth()->id(),  // Use API authentication
                'title' => $request->input('title'),
                'category' => $request->input('category'),
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
                'image' => $imageJson,
                'rooms_images' => $roomImageJson,
                'kitchen_images' => $kitchenImageJson,
                'pool_images' => $poolImageJson, // Store pool image paths as JSON
                'bathroom_images' => $bathroomImageJson, // Store bathroom image paths as JSON
                'building_images' => $buildingImageJson, // Store building image paths as JSON
                'facilities_images' => $facilitiesImageJson, // Store facilities image paths as JSON
                'additional_images' => $additionalImageJson, // Store additional image paths as JSON
                'has_mot_permission' => $request->input('has_mot_permission'),
                'mot_permission' => $request->file('mot_permission')->store('mot_permissions'),
            ]);
        
            $unit->save();
        
            return response()->json([
                'status' => 'success',
                'message' => 'Unit added successfully',
                'unit' => $unit
            ], 201);
        
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred while adding the unit',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    //  Get Owner Units
    public function getOwnerUnits()
    {
        $units = Unit::where('owner_id', auth()->id())->get();
        return response()->json([
            'status' => 'success',
            'units' => $units
        ], 200);
    }

    // Show Unit Details
    public function showUnitDetails($id)
    {
        try {
            $unit = Unit::where('owner_id', auth()->id())->find($id)->first();
            if ($unit) {
                return response()->json([
                    'status' => 'success',
                    'unit' => $unit
                ], 200);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Unit not found'
                ], 404);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred while getting the unit details',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // Update Unit
public function updateUnit(Request $request, $id)
{
    try {
        // Find the unit by its ID
    $unit = Unit::where('owner_id', auth()->id())->find($id)->first();

    // Check if the unit exists
    if (!$unit) {
        return response()->json([
            'status' => 'error',
            'message' => 'Unit not found'
        ], 404);
    }

    // Update the unit with the request data
    $unit->update($request->all());

    // Manually set the request_status to 'updated'
    $unit->request_status = 'updated';
    
    // Save the unit with the updated status
    $unit->save();

    // Return a JSON response
    return response()->json([
        'status' => 'success',
        'message' => 'Unit updated successfully',
        'unit' => $unit
    ], 200);
    } catch (\Exception $e) {
    return response()->json([
        'status' => 'error',
        'message' => 'An error occurred while updating the unit',
        'error' => $e->getMessage()
    ], 500);
    }
}

// Delete Unit
public function deleteUnit($id)
{
    try {
        $unit = Unit::where('owner_id', auth()->id())->find($id);
        if ($unit) {
            $unit->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'Unit deleted successfully'
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Unit not found'
            ], 404);
        }
    } catch (\Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => 'An error occurred while deleting the unit',
            'error' => $e->getMessage()
        ], 500);
    }
}
}
