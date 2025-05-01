<?php

namespace App\Http\Controllers\API\owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\Booking;
use App\Models\CompletedUnit;
use App\Models\Unit;
class StatisticsController extends Controller
{
     // get coount of bookings of owner
     public function getOwnerBookingsCount(){
        try{
            $owner = Auth::user();
            $countOfAllBookings = Booking::where('owner_id', $owner->id)->count();
            $countOfAcceptedBookings = Booking::where('owner_id', $owner->id)->where('booking_status', 'accepted')->count();
            $countOfPendingBookings = Booking::where('owner_id', $owner->id)->where('booking_status', 'in_negotiation')->count();
            $countOfRejectedBookings = Booking::where('owner_id', $owner->id)->where('booking_status', 'rejected')->count();
            $countOfCancelledBookings = Booking::where('owner_id', $owner->id)->where('booking_status', 'canceled')->count();
            return response()->json([
                'status' => 'success',
                'data' => [
                    'countOfAllBookings' => $countOfAllBookings,
                    'countOfAcceptedBookings' => $countOfAcceptedBookings,
                    'countOfPendingBookings' => $countOfPendingBookings,
                    'countOfRejectedBookings' => $countOfRejectedBookings,
                    'countOfCancelledBookings' => $countOfCancelledBookings
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }

    /**********************************************************************************/
    // get count of bookings for specific unit
    public function getUnitBookingsCount($unitId){
        try{
            $owner = Auth::user();

            // check if it completed unit or not
            $completedUnit = CompletedUnit::where('unit_id', $unitId)->first();

            if (!$completedUnit) {
                return response()->json(['status' => 'error', 'message' => 'هذه الوحدة غير مكتملة'], 404);
            }

            $countOfAllBookings = Booking::where('owner_id', $owner->id)->where('completed_unit_id', $completedUnit->id)->count();
            $countOfAcceptedBookings = Booking::where('owner_id', $owner->id)->where('completed_unit_id', $completedUnit->id)->where('booking_status', 'accepted')->count();
            $countOfPendingBookings = Booking::where('owner_id', $owner->id)->where('completed_unit_id', $completedUnit->id)->where('booking_status', 'in_negotiation')->count();
            $countOfRejectedBookings = Booking::where('owner_id', $owner->id)->where('completed_unit_id', $completedUnit->id)->where('booking_status', 'rejected')->count();
            $countOfCancelledBookings = Booking::where('owner_id', $owner->id)->where('completed_unit_id', $completedUnit->id)->where('booking_status', 'canceled')->count();
            return response()->json([
                'status' => 'success',
                'data' => [
                    'countOfAllBookings' => $countOfAllBookings,
                    'countOfAcceptedBookings' => $countOfAcceptedBookings,
                    'countOfPendingBookings' => $countOfPendingBookings,
                    'countOfRejectedBookings' => $countOfRejectedBookings,
                    'countOfCancelledBookings' => $countOfCancelledBookings,
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }

    /**********************************************************************************/
    public function calculateTotalRevenue()
    {
        try {
            // Ensure the user is authenticated
            $owner = Auth::user();
            if (!$owner) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'User not authenticated.'
                ], 401);
            }
    
            // Fetch accepted bookings for the owner
            $bookings = Booking::where('owner_id', $owner->id)
                ->where('booking_status', 'accepted')
                ->get();
    
            // Initialize revenue calculations
            $totalRevenue = 0;
            $finishedBookingRevenue = 0;
            $newBookingRevenue = 0;
    
            foreach ($bookings as $booking) {
                // Validate required fields
                if (empty($booking->start_date) || empty($booking->end_date)) {
                    \Log::warning('Booking has missing start_date or end_date', ['booking_id' => $booking->id]);
                    continue;
                }
    
                // Parse dates as Carbon instances
                $startDate = \Carbon\Carbon::parse($booking->start_date);
                $endDate = \Carbon\Carbon::parse($booking->end_date);
    
                // Ensure start_date is before or equal to end_date
                if ($startDate->gt($endDate)) {
                    \Log::warning('Booking has an invalid date range', ['booking_id' => $booking->id]);
                    continue;
                }
    
                // Calculate total revenue
                $totalRevenue += (float)$booking->total_price;
    
                // Determine the revenue categories
                if ($endDate->isPast()) {
                    // Booking is finished
                    $finishedBookingRevenue += (float)$booking->total_price;
                } elseif ($startDate->isFuture()) {
                    // Booking is new (upcoming)
                    $newBookingRevenue += (float)$booking->total_price;
                }
            }
    
            // Return calculated data
            return response()->json([
                'status' => 'success',
                'data' => [
                    'totalRevenue' => $totalRevenue,
                    'finishedBookingRevenue' => $finishedBookingRevenue,
                    'newBookingRevenue' => $newBookingRevenue
                ]
            ]);
        } catch (\Exception $e) {
            \Log::error('Error in calculateTotalRevenue: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred. Please try again later.'
            ], 500);
        }
    }
    
    /**********************************************************************************/

    public function getUnitRevenue($unitId)
    {
        try {
            // Check if the unit is completed
            $completedUnit = CompletedUnit::where('unit_id', $unitId)->first();
    
            if (!$completedUnit) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'هذه الوحدة غير مكتملة'
                ], 404);
            }
    
            // Fetch bookings associated with the completed unit
            $bookings = Booking::where('completed_unit_id', $completedUnit->id)
                ->where('booking_status', 'accepted')
                ->get();
    
            // Initialize revenue calculations
            $totalRevenue = 0;
            $finishedBookingRevenue = 0;
            $newBookingRevenue = 0;
    
            foreach ($bookings as $booking) {
                // Validate required fields
                if (empty($booking->start_date) || empty($booking->end_date)) {
                    \Log::warning('Booking has missing start_date or end_date', ['booking_id' => $booking->id]);
                    continue;
                }
    
                // Parse dates as Carbon instances
                $startDate = \Carbon\Carbon::parse($booking->start_date);
                $endDate = \Carbon\Carbon::parse($booking->end_date);
    
                // Ensure start_date is before or equal to end_date
                if ($startDate->gt($endDate)) {
                    \Log::warning('Booking has an invalid date range', ['booking_id' => $booking->id]);
                    continue;
                }
    
                // Calculate total revenue
                $totalRevenue += (float)$booking->total_price;
    
                // Determine the revenue categories
                if ($endDate->isPast()) {
                    // Booking is finished
                    $finishedBookingRevenue += (float)$booking->total_price;
                } elseif ($startDate->isFuture()) {
                    // Booking is new (upcoming)
                    $newBookingRevenue += (float)$booking->total_price;
                }
            }
    
            // Return calculated data
            return response()->json([
                'status' => 'success',
                'data' => [
                    'totalRevenue' => $totalRevenue,
                    'finishedBookingRevenue' => $finishedBookingRevenue,
                    'newBookingRevenue' => $newBookingRevenue
                ]
            ]);
        } catch (\Exception $e) {
            \Log::error('Error in getUnitRevenue: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json([
                'status' => 'error',
                'message' => 'حدث خطأ ما. يرجى المحاولة مرة أخرى لاحقًا.'
            ], 500);
        }
    }
    


}
