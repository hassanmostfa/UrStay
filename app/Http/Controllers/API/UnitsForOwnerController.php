<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Unit;
use App\Models\Category;
use App\Models\Zone;
use App\Models\Governorate;
use App\Models\City;
use App\Models\District;
use App\Models\CompletedUnit;

class UnitsForOwnerController extends Controller
{
    // Get Add Unit Page Data
    public function getAddUnitPageData()
    {
        try {
            // Get all Categories, Zones, Governorates, Cities, Districts
            $categories = Category::all();
            $zones = Zone::all();
            $governorates = Governorate::all();
            $cities = City::all();
            $districts = District::all();

            return response()->json([
                'status' => true,
                'data' => compact('categories', 'zones', 'governorates', 'cities', 'districts')
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to fetch data',
                'data' => null
            ], 500);
        }
    }

    // Add Unit
    public function addUnit(Request $request)
    {
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
                'status' => false,
                'message' => 'Validation error',
                'data' => $validator->errors()
            ], 422);
        }

        try {
            // Handle image uploads (images, rooms_images, kitchen_images, etc.)
            $imagePaths = $this->handleImages($request, 'images');
            $roomImagePaths = $this->handleImages($request, 'rooms_images');
            $kitchenImagePaths = $this->handleImages($request, 'kitchen_images');
            $poolImagePaths = $this->handleImages($request, 'pool_images');
            $bathroomImagePaths = $this->handleImages($request, 'bathroom_images');
            $buildingImagePaths = $this->handleImages($request, 'building_images');
            $facilitiesImagePaths = $this->handleImages($request, 'facilities_images');
            $additionalImagePaths = $this->handleImages($request, 'additional_images');

            // Create the unit
            $unit = new Unit([
                'owner_id' => Auth::id(),
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
                'kitchen' => json_encode($request->input('kitchen')),
                'table_chairs' => $request->input('table_chairs'),
                'bathrooms' => $request->input('bathrooms'),
                'bathroom_facilities' => json_encode($request->input('bathroom_facilities')),
                'additional_facilities' => json_encode($request->input('additional_facilities')),
                'advantages' => json_encode($request->input('advantages')),
                'description' => $request->input('description'),
                'image' => json_encode($imagePaths),
                'rooms_images' => json_encode($roomImagePaths),
                'kitchen_images' => json_encode($kitchenImagePaths),
                'pool_images' => json_encode($poolImagePaths),
                'bathroom_images' => json_encode($bathroomImagePaths),
                'building_images' => json_encode($buildingImagePaths),
                'facilities_images' => json_encode($facilitiesImagePaths),
                'additional_images' => json_encode($additionalImagePaths),
                'price' => $request->input('price'),
                'has_mot_permission' => $request->input('has_mot_permission'),
                'mot_permission' => $request->file('mot_permission') ? $request->file('mot_permission')->store('mot_permissions') : null,
                'latitude' => $request->input('latitude'),
                'longitude' => $request->input('longitude'),
                'insurance_amount' => $request->input('insurance_amount'),
                'booking_type' => $request->input('booking_type'),
                'possibility_of_cancellation' => $request->input('possibility_of_cancellation'),
                'cancellation_type' => $request->input('cancellation_type') ? $request->input('cancellation_type') : null,
                'specific_time_cancellation_duration' => $request->input('specific_time_cancellation_duration') ? $request->input('specific_time_cancellation_duration') : null
            ]);

            $unit->save();

            return response()->json([
                'status' => true,
                'message' => 'Unit added successfully',
                'data' => $unit
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to add unit',
                'data' => $e->getMessage()
            ], 500);
        }
    }

    // Get Owner's Units
    public function getOwnerUnits(Request $request)
    {
        try {
            $units = Unit::where('owner_id', $request->user()->id)
                ->whereIn('request_status', ['approved', 'completed', 'accepted', 'pending'])
                ->get();

            return response()->json([
                'status' => true,
                'data' => $units
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to fetch units',
                'data' => null
            ], 500);
        }
    }

    // Get Owner's Units
    public function updatedUnits(Request $request)
    {
        try {
            $units = Unit::where('owner_id', $request->user()->id)
            ->where('request_status', 'updated')
            ->get();

            return response()->json([
                'status' => true,
                'data' => $units
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to fetch units',
                'data' => null
            ], 500);
        }
    }

    public function rejectedUnits(Request $request)
    {
        try {
            $units = Unit::where('owner_id', $request->user()->id)
            ->where('request_status', 'rejected')
            ->get();

            return response()->json([
                'status' => true,
                'data' => $units
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to fetch units',
                'data' => null
            ], 500);
        }
    }

    // Show Unit Details
    public function showUnitDetails($id)
    {
        try {
            $unit = Unit::where('owner_id', Auth::id())->find($id);

            if ($unit) {
                return response()->json([
                    'status' => true,
                    'data' => $unit
                ], 200);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Unit not found',
                    'data' => null
                ], 404);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to fetch unit details',
                'data' => $e->getMessage()
            ], 500);
        }
    }

    // Update Unit
    public function updateUnit(Request $request, $id)
    {
        try {
            $unit = Unit::where('id', $id)->where('owner_id', Auth::id())->first();

            if (!$unit) {
                return response()->json([
                    'status' => false,
                    'message' => 'Unit not found or permission denied',
                    'data' => null
                ], 404);
            }

            $unit->update($request->all());

            if ($request->hasFile('mot_permission')) {
                $unit->mot_permission = $request->file('mot_permission')->store('mot_permissions');
                $unit->has_mot_permission = true;
                $unit->save();
            }

            return response()->json([
                'status' => true,
                'message' => 'Unit updated successfully',
                'data' => $unit
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to update unit',
                'data' => $e->getMessage()
            ], 500);
        }
    }

    // Delete Unit
    public function deleteUnit($id)
    {
        try {
            $unit = Unit::where('id', $id)->where('owner_id', Auth::id())->first();

            if (!$unit) {
                return response()->json([
                    'status' => false,
                    'message' => 'Unit not found or permission denied',
                    'data' => null
                ], 404);
            }

            $unit->delete();

            return response()->json([
                'status' => true,
                'message' => 'Unit deleted successfully',
                'data' => null
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to delete unit',
                'data' => $e->getMessage()
            ], 500);
        }
    }

    private function handleImages($request, $inputName)
    {
        $imagePaths = [];
        if ($request->hasFile($inputName)) {
            foreach ($request->file($inputName) as $image) {
                $path = $image->store('unit_images');
                $imagePaths[] = $path;
            }
        }
        return $imagePaths;
    }


    // update Cancelation type
    public function updateCancelationType(Request $request, $id)
    {
        try {
            $unit = Unit::where('id', $id)->first();

            if (!$unit) {
                return response()->json([
                    'status' => false,
                    'message' => 'Unit not found or permission denied',
                    'data' => null
                ], 404);
            }

            $unit->cancellation_type = $request->cancellation_type ?? $unit->cancellation_type;
            $unit->specific_time_cancellation_duration = $request->specific_time_cancellation_duration ?? $unit->specific_time_cancellation_duration;
            $unit->save();

            return response()->json([
                'status' => true,
                'message' => 'Cancelation type updated successfully',
                'data' => $unit
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to update cancelation type',
                'data' => $e->getMessage()
            ], 500);
        }
    }

    // update Booking type 
    public function updateBookingType(Request $request, $id)
    {
        try {
            $unit = Unit::where('id', $id)->first();

            if (!$unit) {
                return response()->json([
                    'status' => false,
                    'message' => 'Unit not found or permission denied',
                    'data' => null
                ], 404);
            }

            $unit->booking_type = $request->booking_type ?? $unit->booking_type;
            $unit->save();

            return response()->json([
                'status' => true,
                'message' => 'Booking type updated successfully',
                'data' => $unit
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to update booking type',
                'data' => $e->getMessage()
            ], 500);
        }
    }
}
