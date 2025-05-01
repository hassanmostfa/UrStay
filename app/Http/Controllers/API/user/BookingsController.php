<?php

namespace App\Http\Controllers\API\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\CompletedUnit;
use App\Models\Booking;
use App\Models\User;
use App\Models\Owner;
use App\Models\Unit;
use Illuminate\Support\Facades\Auth;

class BookingsController extends Controller
{
    // Book a unit
    public function bookUnit(Request $request, $unitId)
{
    $user = Auth::user();

    if (!$user) {
        return response()->json(['error' => 'يجب تسجيل الدخول اولا'], 401);
    }

    try {
        // Find the unit by its ID
        $completed_unit = CompletedUnit::where('unit_id', $unitId)->first();

        if (!$completed_unit) {
            return response()->json(['error' => 'العقار غير موجود'], 404);
        }

        // Validate user inputs
        $request->validate([
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date',
            'user_price' => 'nullable|numeric|min:0', // Optional user-negotiated price
            'no_of_people' => 'nullable|integer|min:1',
        ]);

        // Parse the start and end dates
        $startDate = Carbon::parse($request->start_date);
        $endDate = Carbon::parse($request->end_date);

        // Check if the requested booking dates overlap with any existing accepted bookings
        $existingBooking = Booking::where('completed_unit_id', $completed_unit->id)
            ->where('booking_status', 'accepted')
            ->where(function ($query) use ($startDate, $endDate) {
                $query->whereBetween('start_date', [$startDate, $endDate])
                    ->orWhereBetween('end_date', [$startDate, $endDate])
                    ->orWhere(function ($query) use ($startDate, $endDate) {
                        $query->where('start_date', '<=', $startDate)
                            ->where('end_date', '>=', $endDate);
                    });
            })->exists();

        if ($existingBooking) {
            return response()->json(['error' => 'عذراً، هذا العقار محجوز في هذه الفترة. يرجى اختيار فترة أخرى.'], 409);
        }

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

        // // Handle negotiable price if the user provided one
        // if ($completed_unit->negotiable_price && $request->filled('user_price')) {
        //     $totalPrice = $request->user_price;
        // }

        // Prepare booking data
        $bookingData = [
            'user_id' => $user->id,
            'completed_unit_id' => $completed_unit->id,
            'owner_id' => $completed_unit->owner_id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'user_price' => $request->user_price ?? null,
            'note' => $request->note ?? null,
            'total_price' => $totalPrice,
            'no_of_people' => $request->no_of_people,
            'payment_status' => $request->has('payment_status') ? $request->payment_status : 'not_paid',
            'payment_method' => $request->has('payment_method') ? $request->payment_method : null,
            'discount_value' => $request->has('discount_value') ? $request->discount_value : 0.00,
        ];
        

        if ($completed_unit->booking_status === 'immediate') {
            $bookingData['booking_status'] = 'accepted';
        }

        // Create the booking
        $booking = Booking::create($bookingData);

        return response()->json(['status' => 'success', 'message' => 'تم ارسال طلب الحجز بنجاح! ', 'data' => $booking], 200);
    } catch (\Throwable $th) {
        return response()->json(['status' => 'error', 'error' => $th->getMessage()], 500);
    }
}
/******************************************************************************************/
// Calculate price
public function calculatePrice(Request $request)
{
    // Validate incoming request data
    $request->validate([
        'unit_id' => 'required|exists:completed_units,unit_id',
        'start_date' => 'required|date|after_or_equal:today',
        'end_date' => 'required|date|after:start_date',
    ]);

    try {
        // Fetch the unit by unit_id
        $completed_unit = CompletedUnit::where('unit_id', $request->unit_id)->first();
        
        if (!$completed_unit) {
            return response()->json(['error' => 'Unit not found.'], 404);
        }

        // Parse dates
        $startDate = Carbon::parse($request->start_date);
        $endDate = Carbon::parse($request->end_date);

        // Initialize total price
        $totalPrice = 0;
        $currentDate = $startDate;

        // Calculate the total price for the date range
        while ($currentDate <= $endDate) {
            $dayOfWeek = $currentDate->format('l'); // Day of the week

            // Determine price for the current day
            switch ($dayOfWeek) {
                case 'Saturday':$dayPrice = $completed_unit->saturday_price;break;
                case 'Sunday':$dayPrice = $completed_unit->sunday_price;break;
                case 'Monday':$dayPrice = $completed_unit->monday_price;break;
                case 'Tuesday':$dayPrice = $completed_unit->tuesday_price;break;
                case 'Wednesday':$dayPrice = $completed_unit->wednesday_price;break;
                case 'Thursday':$dayPrice = $completed_unit->thursday_price;break;
                case 'Friday':$dayPrice = $completed_unit->friday_price;break;
                default:
                    $dayPrice = 0;
            }

            // Add the daily price to the total price
            $totalPrice += $dayPrice;

            // Move to the next day
            $currentDate->addDay();
        }

        // Return the total price as JSON
        return response()->json(['status' => 'success' ,'total_price' => $totalPrice], 200);
    } catch (\Throwable $e) {
        // Handle any unexpected errors
        return response()->json(['error' => $e->getMessage()], 500);
    }
}
/*****************************************************************************************/
// Get Reserved Dates for Specific Unit
public function getReservedDates($unitId)
    {
        // Fetch the completed unit
        $completedUnit = CompletedUnit::where('unit_id', $unitId)->first();

        if (!$completedUnit) {
            return response()->json(['status' => 'error', 'message' => 'Unit not found'], 404);
        }

        // Fetch all reserved bookings (accepted bookings) for the unit
        $reservedDates = Booking::where('completed_unit_id', $completedUnit->id)
            ->where('booking_status', 'accepted')
            ->get(['start_date', 'end_date']);

        // Return reserved dates as JSON
        return response()->json(['status' => 'success', 'data' => $reservedDates], 200);
    }
/******************************************************************************************/
// get All Bookings for specific user
public function getAllBookings(){
    try{
        $user = Auth::user();

        $bookings = Booking::where('user_id' , $user->id)->get();
    
        return response()->json(['status' => 'success', 'data' => $bookings], 200);
    }catch(\Throwable $th){
        return response()->json(['status' => 'error', 'error' => $th->getMessage()], 500);
    }
}

/******************************************************************************************/

// get All Bookings Bills for current user
public function getAllBookingsBills(){
    try{
        $user = Auth::user();

        $bookings = Booking::where('user_id' , $user->id)
        ->where('booking_status', 'accepted')
        ->where('payment_status', 'paid')
        ->with(['completed_unit' => function ($query) {
            $query->select('id', 'unit_id')->with('unit');
        }])
        ->with('user')
        ->with('owner')
        ->get();
        return response()->json(['status' => 'success', 'data' => $bookings], 200);
    }catch(\Throwable $th){
        return response()->json(['status' => 'error', 'error' => $th->getMessage()], 500);
    }
}

/*******************************************************************************************/
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

}
