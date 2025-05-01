<?php

namespace App\Http\Controllers\API\owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\Unit;
use App\Models\CompletedUnit;

class CompletedUnitsController extends Controller
{
    // Save Completed Units
    public function saveCompletedUnits(Request $request, $id)
{
    // Validation
    $validator = Validator::make($request->all(), [
        'saturday_price' => 'required|numeric',
        'sunday_price' => 'required|numeric',
        'monday_price' => 'required|numeric',
        'tuesday_price' => 'required|numeric',
        'wednesday_price' => 'required|numeric',
        'thursday_price' => 'required|numeric',
        'friday_price' => 'required|numeric',
        'availability_of_booking' => 'required|boolean',
        'negotiable_price' => 'required|boolean',
        'booking_status' => 'required|string',
    ]);

    // Return validation errors
    if ($validator->fails()) {
        return response()->json([
            'status' => false,
            'message' => 'Validation Error',
            'errors' => $validator->errors(),
        ], 422);
    }

    try {
        // Check if the unit exists
        $unit = Unit::find($id);
        if (!$unit) {
            return response()->json([
                'status' => false,
                'message' => 'Unit not found',
            ], 404);
        }

        // Create and save the completed unit
        $completedUnit = CompletedUnit::create([
            'unit_id' => $unit->id,
            'owner_id' => Auth::id(), // Authenticated user
            'saturday_price' => $request->saturday_price,
            'sunday_price' => $request->sunday_price,
            'monday_price' => $request->monday_price,
            'tuesday_price' => $request->tuesday_price,
            'wednesday_price' => $request->wednesday_price,
            'thursday_price' => $request->thursday_price,
            'friday_price' => $request->friday_price,
            'availability_of_booking' => $request->availability_of_booking,
            'negotiable_price' => $request->negotiable_price,
            'booking_status' => $request->booking_status,
            'follows_pricing_mechanism' => $request->follows_pricing_mechanism ?? false,
        ]);

        // Update the unit's request status
        $unit->update(['request_status' => 'completed']);

        // Return success response
        return response()->json([
            'status' => true,
            'message' => 'Completed unit saved successfully',
            'data' => $completedUnit,
        ], 201);

    } catch (\Exception $e) {
        // Log the exception for debugging
        \Log::error('Error saving completed unit: ' . $e->getMessage());

        // Return error response
        return response()->json([
            'status' => false,
            'message' => 'An error occurred while saving the completed unit',
            'error' => $e->getMessage(),
        ], 500);
    }
}


    /********************************************************************************/

   // Update Completed Units
public function updateCompletedUnitsData(Request $request, $id)
{
    // Validate the request
    $validator = Validator::make($request->all(), [
        'saturday_price' => 'nullable|numeric',
        'sunday_price' => 'nullable|numeric',
        'monday_price' => 'nullable|numeric',
        'tuesday_price' => 'nullable|numeric',
        'wednesday_price' => 'nullable|numeric',
        'thursday_price' => 'nullable|numeric',
        'friday_price' => 'nullable|numeric',
        'availability_of_booking' => 'nullable|boolean',
        'negotiable_price' => 'nullable|boolean',
        'booking_status' => 'nullable|string',
    ]);

    // Handle validation errors
    if ($validator->fails()) {
        return response()->json([
            'status' => false,
            'message' => 'Validation Error',
            'errors' => $validator->errors()
        ], 422);
    }

    try {
        // Find the completed unit
        $completedUnit = CompletedUnit::findOrFail($id);

        // Update the record
        $completedUnit->update($request->only([
            'saturday_price',
            'sunday_price',
            'monday_price',
            'tuesday_price',
            'wednesday_price',
            'thursday_price',
            'friday_price',
            'availability_of_booking',
            'negotiable_price',
            'booking_status',
        ]));

        // Return success response
        return response()->json([
            'status' => true,
            'message' => 'Completed unit updated successfully',
            'data' => $completedUnit
        ], 200);

    } catch (\Throwable $e) {
        // Handle exceptions
        return response()->json([
            'status' => false,
            'message' => 'Failed to update completed unit',
            'error' => $e->getMessage() // Include error details for debugging
        ], 500);
    }
}

/**********************************************************************************/
// Update Follows Pricing Mechanism Column
public function updateFollowsPricingMechanism(Request $request, $id)
{
    try {
        // Find the completed unit
        $completedUnit = CompletedUnit::findOrFail($id);

        // Update the record
        $completedUnit->update([
            'follows_pricing_mechanism' => $request->follows_pricing_mechanism,
        ]);

        // Return success response
        return response()->json([
            'status' => true,
            'message' => 'Completed unit updated successfully',
            'data' => $completedUnit
        ], 200);

    } catch (\Throwable $e) {
        // Handle exceptions
        return response()->json([
            'status' => false,
            'message' => 'Failed to update completed unit',
            'error' => $e->getMessage() // Include error details for debugging
        ], 500);
    }
}

/********************************************************************************/
// Update Publishment Status Or Publishment Date
public function updatePublishmentStatusOrPublishmentDate(Request $request, $id)
{
    try {
        // Find the completed unit
        $completedUnit = CompletedUnit::findOrFail($id);

        if(! $completedUnit) {
            return response()->json([
                'status' => 'error',
                'message' => 'Completed unit not found',
            ], 404);
        }
        
        // Update the record
        $completedUnit->update([
            'publishment_status' => $request->publishment_status ?? $completedUnit->publishment_status,
            'publishment_date' => $request->publishment_date ?? $completedUnit->publishment_date,
        ]);

        // Return success response
        return response()->json([
            'status' => 'success',
            'message' => 'Completed unit updated successfully',
            'data' => $completedUnit
        ], 200);

    } catch (\Throwable $e) {
        // Handle exceptions
        return response()->json([
            'status' => 'error',
            'message' => 'Failed to update completed unit',
            'error' => $e->getMessage() // Include error details for debugging
        ], 500);
    }
}

}
