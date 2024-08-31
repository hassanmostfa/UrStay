<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Unit;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;  // Import Carbon class

class UserController extends Controller
{
        // show unit details 
        public function showUnitDetails($id){
            if(!Auth::check()){
                return redirect()->route('login')->with('error','يجب تسجيل الدخول اولا');
            }
            $unit = Unit::find($id);
            return view('user.showUnitDetails', compact('unit'));
        }
    

        // book unit
        public function bookUnit(Request $request, $id) {
            $unit = Unit::find($id);
            
            // Get the current date
            $now = Carbon::now();
            
            // Convert start_date from request to Carbon instance
            $startDate = Carbon::parse($request->start_date);
        
            // Check if the unit exists, is available, and the start date is in the future
            if ($unit && $unit->unit_status === 'متاح' && $startDate->gt($now)) {
                // Create a new booking
                $booking = Booking::create([
                    'user_id' => auth()->user()->id,
                    'owner_id' => $unit->owner_id,
                    'unit_id' => $unit->id,
                    'start_date' => $request->start_date,
                    'end_date' => $request->end_date,
                    'status' => 'pending',
                ]);
        
                // Optionally, mark the unit as reserved
                // $unit->update(['unit_status' => 'محجوز']);
        
                return redirect()->route('home')->with('success', 'تم حجز الوحدة بنجاح سيتم التواصل معك بعد التأكيد');
            }
        
            // If the conditions are not met, return an error
            return redirect()->route('home')->with('error', 'لا يمكنك حجز هذه الوحدة لأنها محجوزة بالفعل أو لأن تاريخ الحجز غير صالح.');
        }
        
}
