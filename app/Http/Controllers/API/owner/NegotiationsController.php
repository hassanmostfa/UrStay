<?php

namespace App\Http\Controllers\API\owner;

use App\Http\Controllers\Controller;
use App\Events\NegotiationMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Booking;
use App\Models\Negotiation;
use App\Models\User;

class NegotiationsController extends Controller
{
    // Get All Negotiations For current User
    public function getAllNegotiations() {
    try {
        $ownerId = Auth::user()->id;
        $bookings = Booking::where('owner_id', $ownerId)
            ->where('booking_status', 'in_negotiation')
            ->orWhere('booking_status', 'canceled')
            ->get();

        return response()->json(['status' => 'success', 'data' => $bookings], 200);
    } catch (\Exception $e) {
        return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
    }
}   
    /*****************************************************************************************/
    // show all negotiations for current Booking
    public function index($booking_id){
        try{
            $negotiations = Negotiation::where('booking_id', $booking_id)->get();
            return response()->json(['status' => 'success', 'data' => $negotiations], 200);
        }catch(\Exception $e){
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }

    /*****************************************************************************************/

// Create new negotiation message for current booking
public function store(Request $request)
{
    try {
        $validator = Validator::make($request->all(), [
            'booking_id' => 'required',
            'message' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'errors' => $validator->errors()], 422);
        }

        $negotiation = Negotiation::create([
            'booking_id' => $request->booking_id,
            'sender_id' => auth()->user()->id,
            'sender_type' => 'owner',
            'message' => $request->message,
            'is_read' => false,
        ]);

        // Broadcast the NegotiationMessage event
        broadcast(new NegotiationMessage($negotiation))->toOthers();

        return response()->json(['status' => 'success', 'data' => $negotiation], 200);
    } catch (\Exception $e) {
        return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
    }
}

    /***************************************************************************************/
    // update negotiation for current Booking (Extend Negotiation)
    public function update(Request $request , $booking_id) {
        $validator = Validator::make($request->all(), [
            'total_price' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'errors' => $validator->errors()], 422);
        }

        try{
            // update Total Price for current Booking
            $booking = Booking::findOrFail($booking_id);
            $booking->total_price = $request->total_price;
            $booking->save();
            return response()->json(['status' => 'success', 'message' => 'تم تعديل السعر بنجاح بانتظار موافقة العميل'], 200);
        }catch(\Exception $e){
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }

    /****************************************************************************************/
    //  Accept Negotiation (User Price)
    public function acceptNegotiation($booking_id) {
        try{
            $booking = Booking::findOrFail($booking_id);
            $booking->total_price = $booking->user_price;
            $booking->booking_status = 'accepted';
            $booking->save();
            return response()->json(['status' => 'success', 'message' => 'تم قبول السعر بنجاح'], 200);
        }catch(\Exception $e){
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }

    /***************************************************************************************/
    // Cancel Negotiation (Booking)
    public function cancelNegotiation($booking_id) {
        try{
            $booking = Booking::findOrFail($booking_id);
            $booking->booking_status = 'canceled';
            $booking->save();
            return response()->json(['status' => 'success', 'message' => 'تم إلغاء الطلب بنجاح'], 200);
        }catch(\Exception $e){
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }
}
