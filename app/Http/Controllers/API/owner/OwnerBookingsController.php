<?php

namespace App\Http\Controllers\API\owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Booking;
use App\Models\CompletedUnit;
use App\Models\Unit;

class OwnerBookingsController extends Controller
{
    // get all bookings of current owner
    public function index(){
        try{
            $bookings = Booking::with('user')->where('owner_id', auth()->user()->id)->get();
            return response()->json(['status' => 'success', 'data' => $bookings], 200);
        }catch(\Throwable $th){
            return response()->json(['status' => 'error', 'data' => $th->getMessage()], 500);
        }
    }

    /*********************************************************************************/
    // Accept Booking Request
    public function acceptBookingRequest($id)
    {
        try {
            // Find the booking
            $booking = Booking::findOrFail($id);

            // Get Completed Unit Details
            $completed_unit = CompletedUnit::findOrFail($booking->completed_unit_id);

            // Get Unit Details
            $unit = Unit::findOrFail($completed_unit->unit_id);

            // Update Unit Status to reserved
            $unit->update(['status' => 'reserved']);

            // Update Booking Status to accepted
            $booking->update(['booking_status' => 'accepted']);

            return response()->json([
                'status' => 'success',
                'message' => 'The booking request has been successfully accepted!',
                'data' => [
                    'booking' => $booking,
                    'unit' => $unit,
                ],
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**********************************************************************************/
    // Get Reserved Dates for Specific Unit
public function getMyUnitsReservedDates($unitId)
{
    // Fetch the completed unit
    $completedUnit = CompletedUnit::where('unit_id', $unitId)->first();

    if (!$completedUnit) {
        return response()->json(['status' => 'error', 'message' => 'Unit not found'], 404);
    }

    // Fetch all reserved bookings for the unit
    $reservedDates = Booking::where('completed_unit_id', $completedUnit->id)
    ->with('user')
    ->get();

    // Return reserved dates as JSON
    return response()->json(['status' => 'success', 'bookings_data' => $reservedDates], 200);
}

/**********************************************************************************/

public function disableUnit(Request $request, $unitId)
{

    try {
        // Find the unit by its ID
        $completed_unit = CompletedUnit::where('unit_id', $unitId)->first();

        if (!$completed_unit) {
            return response()->json(['error' => 'العقار غير موجود'], 404);
        }

        // Validate user inputs
        $request->validate([
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date',
            'booking_status' => 'required',
            'user_price' => 'nullable|numeric|min:0', // Optional user-negotiated price
        ]);

        // Parse the start and end dates
        $startDate = Carbon::parse($request->start_date);
        $endDate = Carbon::parse($request->end_date);

                // Calculate the total price
                $totalPrice = 0;
                $currentDate = $startDate;
        
                while ($currentDate <= $endDate) {
                    $dayOfWeek = $currentDate->format('l');
        
                    $dayPrice = match ($dayOfWeek) {
                        'Saturday' => $completed_unit->saturday_price,
                        'Sunday' => $completed_unit->sunday_price,
                        'Monday' => $completed_unit->monday_price,
                        'Tuesday' => $completed_unit->tuesday_price,
                        'Wednesday' => $completed_unit->wednesday_price,
                        'Thursday' => $completed_unit->thursday_price,
                        'Friday' => $completed_unit->friday_price,
                        default => 0,
                    };
        
                    $totalPrice += $dayPrice;
                    $currentDate->addDay();
                }

        // Prepare booking data
        $bookingData = [
            'completed_unit_id' => $completed_unit->id,
            'owner_id' => $completed_unit->owner_id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'booking_status' => $request->booking_status,
            'user_price' => $request->user_price ?? null,
            'note' => $request->note ?? null,
            'total_price' => $totalPrice,
        ];


        // Create the booking
        $booking = Booking::create($bookingData);

        return response()->json(['status' => 'success', 'message' => 'تم تعطيل الوحدة بنجاح! ', 'data' => $booking], 200);
    } catch (\Throwable $th) {
        return response()->json(['status' => 'error', 'error' => $th->getMessage()], 500);
    }
}

/**********************************************************************************/

// Update Payment Status Or Payment Method 
public function updatePaymentStatusOrPaymentMethod(Request $request, $id)
{
    try{
        $booking = Booking::findOrFail($id);
        $booking->payment_status = $request->payment_status ?? $booking->payment_status;
        $booking->payment_method = $request->payment_method ?? $booking->payment_method;
        $booking->updated_at = now();
        $booking->save();

        return response()->json(['status' => 'success', 'message' => 'تم تعديل حالة الدفع بنجاح' , 'data' => $booking], 200);
    }catch(\Exception $e){
        return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
    }
}

/**********************************************************************************/
// Update Booking Start & End Date
public function updateBookingDates(Request $request, $id)
{
    try {
        $booking = Booking::findOrFail($id);
        if(!$booking){
            return response()->json(['status' => 'error', 'message' => 'الحجز غير موجود'], 404);
        }
        $booking->start_date = $request->start_date ?? $booking->start_date;
        $booking->end_date = $request->end_date ?? $booking->end_date;
        $booking->updated_at = now();
        $booking->save();

        return response()->json(['status' => 'success', 'message' => 'تم تعديل تاريخ الحجز بنجاح', 'data' => $booking], 200);
    } catch (\Exception $e) {
        return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
    }
    }

    /**********************************************************************************/
    // Delete Booking
    public function deleteBooking($id){
        try{
            $booking = Booking::findOrFail($id);
            $booking->delete();
            return response()->json(['status' => 'success', 'message' => 'تم حذف الحجز بنجاح'], 200);
        }catch(\Exception $e){
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }
}
