<?php

namespace App\Http\Controllers\MVC;

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
    public function bookUnit(Request $request, $unitId)
    {
        $user = Auth::user();
    
        if ($user->is_completed === 1) {
            try {
                // Find the unit by its ID
                $completed_unit = CompletedUnit::where('unit_id', $unitId)->first();
    
                // Validate user inputs
                $request->validate([
                    'start_date' => 'required|date|after_or_equal:today',
                    'end_date' => 'required|date|after:start_date',
                    'user_price' => 'nullable|numeric|min:0', // Optional user-negotiated price
                ]);
    
                // Parse the start and end dates
                $startDate = Carbon::parse($request->start_date);
                $endDate = Carbon::parse($request->end_date);
    
                // Check if the requested booking dates overlap with any existing accepted bookings
                $existingBooking = Booking::where('completed_unit_id', $completed_unit->id)
                    ->where('booking_status', 'accepted') // Only check accepted bookings
                    ->where(function ($query) use ($startDate, $endDate) {
                        $query->whereBetween('start_date', [$startDate, $endDate])
                            ->orWhereBetween('end_date', [$startDate, $endDate])
                            ->orWhere(function ($query) use ($startDate, $endDate) {
                                $query->where('start_date', '<=', $startDate)
                                    ->where('end_date', '>=', $endDate);
                            });
                    })->exists();
    
                // If there is an overlap, reject the booking
                if ($existingBooking) {
                    return redirect()->back()->with('error', 'عذراً، هذا العقار محجوز في هذه الفترة. يرجى اختيار فترة أخرى.');
                }
    
                // Initialize the total price
                $totalPrice = 0;
                $currentDate = $startDate;
    
                // Loop through the date range to calculate the total price for each day
                while ($currentDate <= $endDate) {
                    $dayOfWeek = $currentDate->format('l'); // Get the name of the day (e.g., Monday)
    
                    // Determine the price for each day of the week
                    switch ($dayOfWeek) {
                        case 'Saturday':
                            $dayPrice = $completed_unit->saturday_price;
                            break;
                        case 'Sunday':
                            $dayPrice = $completed_unit->sunday_price;
                            break;
                        case 'Monday':
                            $dayPrice = $completed_unit->monday_price;
                            break;
                        case 'Tuesday':
                            $dayPrice = $completed_unit->tuesday_price;
                            break;
                        case 'Wednesday':
                            $dayPrice = $completed_unit->wednesday_price;
                            break;
                        case 'Thursday':
                            $dayPrice = $completed_unit->thursday_price;
                            break;
                        case 'Friday':
                            $dayPrice = $completed_unit->friday_price;
                            break;
                        default:
                            $dayPrice = 0; // fallback if any, this should not happen
                    }
    
                    // Add the day's price to the total price
                    $totalPrice += $dayPrice;
    
                    // Move to the next day in the range
                    $currentDate->addDay();
                }
    
                // Handle negotiable price if the owner has allowed it and the user provided one
                if ($completed_unit->negotiable_price && $request->filled('user_price')) {
                    $totalPrice = $request->user_price;
                    
                }
    
                // Assuming you have already fetched the $completed_unit
                $bookingData = [
                    'user_id' => $user->id,
                    'completed_unit_id' => $completed_unit->id,
                    'owner_id' => $completed_unit->owner_id,
                    'start_date' => $request->start_date,
                    'end_date' => $request->end_date,
                    'user_price' => $request->user_price ?? null,
                    'note' => $request->note ?? null,
                    'total_price' => $totalPrice,
                    
                ];

                // Check the booking status of the completed unit
                if ($completed_unit->booking_status === 'immediate') {
                    $bookingData['booking_status'] = 'accepted';
                }

                // Create the booking with a pending status if not immediate
                Booking::create($bookingData);

    
                return redirect()->route('home')->with('success', 'تم ارسال طلب الحجز بنجاح!');
            } catch (\Throwable $th) {
                return response()->json(['error' => $th->getMessage()]);
            }
        } else {
            return response()->json(['error' => 'يجب تسجيل الدخول اولا']);
        }
    }
    


    // Calculate price
    public function calculatePrice(Request $request)
{
    $completed_unit = CompletedUnit::where('unit_id', $request->unit_id)->first();
    $unit = $completed_unit;
    $startDate = Carbon::parse($request->start_date);
    $endDate = Carbon::parse($request->end_date);

    // Initialize total price
    $totalPrice = 0;
    $currentDate = $startDate;

    // Loop through the date range to calculate total price for each day
    while ($currentDate <= $endDate) {
        $dayOfWeek = $currentDate->format('l'); // Get the day of the week
        
        // Get the price for each day of the week
        switch ($dayOfWeek) {
            case 'Saturday':
                $dayPrice = $unit->saturday_price;
                break;
            case 'Sunday':
                $dayPrice = $unit->sunday_price;
                break;
            case 'Monday':
                $dayPrice = $unit->monday_price;
                break;
            case 'Tuesday':
                $dayPrice = $unit->tuesday_price;
                break;
            case 'Wednesday':
                $dayPrice = $unit->wednesday_price;
                break;
            case 'Thursday':
                $dayPrice = $unit->thursday_price;
                break;
            case 'Friday':
                $dayPrice = $unit->friday_price;
                break;
            default:
                $dayPrice = 0;
        }

        // Add the day's price to the total
        $totalPrice += $dayPrice;

        // Move to the next day
        $currentDate->addDay();
    }

    return response()->json(['total_price' => $totalPrice]);
}


    // Show Booking Opreations Page
    public function showBookingOpreationsPage()
    {
        // Get All Accepted Bookings
        $bookings = Booking::where('booking_status' , 'accepted')
        ->where('owner_id' , Auth::user()->id)
        ->get();
        return view('owner.bookings.allBookings' , compact('bookings'));
    }

    // Show New Bookings Requests
    public function showNewBookingRequests()
    {
        // Get All Pending Bookings
        $bookings = Booking::where('booking_status' , 'in_negotiation')
        ->where('owner_id' , Auth::user()->id)
        ->get();
        return view('owner.bookings.newBookingRequests' , compact('bookings'));
    }


    // Show Booking Details
    public function showBookingRequest($id)
    {
        $booking = Booking::findOrFail($id);

        // Get User Details
        $user = User::where('id' , $booking->user_id)->first();

        // Get Completed Unit Details
        $completed_unit = CompletedUnit::where('id' , $booking->completed_unit_id)->first();
        return view('owner.bookings.showBookingRequest' , compact('booking' , 'user' , 'completed_unit'));
    }

    /************************************************************************************/
    // Accept Booking Request
    public function acceptBookingRequest($id)
    {
        $booking = Booking::findOrFail($id);

        // Get Completed Unit Details
        $completed_unit = CompletedUnit::where('id' , $booking->completed_unit_id)->first();

        // Get Unit Details
        $unit = Unit::where('id' , $completed_unit->unit_id)->first();

        // Update Unit Status to reserved
        $unit->update(['status' => 'reserved']);
        
        $booking->update(['booking_status' => 'accepted']);
        return redirect()->route('owner.bookings')->with('success', 'تم قبول الطلب بنجاح!');
    }

public function getReservedDates($unitId)
    {
        // Fetch the completed unit
        $completedUnit = CompletedUnit::where('unit_id', $unitId)->first();

        // Fetch all reserved bookings (accepted bookings) for the unit
        $reservedDates = Booking::where('completed_unit_id', $completedUnit->id)
            ->where('booking_status', 'accepted')
            ->get(['start_date', 'end_date']);

        // Return reserved dates as JSON
        return response()->json($reservedDates);
    }
}
