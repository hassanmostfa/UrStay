<?php

namespace App\Http\Controllers\API\owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\Coupon;
class CouponsController extends Controller
{
    // get all coupons 
    public function index(){
        $coupons = Coupon::all()->where('owner_id', auth()->user()->id);
        return response()->json([
            'status' => 'success',
            'data' => $coupons
            ], 200);  
    }

    // Create Coupon
    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'discount_name' => 'required',
            'discount_type' => 'required',
            'percentage' => 'required',
            'applied_on' => 'required',
            'code' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'msg' => $validator->errors()->first(),
                'data' => null,
                'notes' => ['Invalid data provided']
            ], 400);
        }

        $coupon = new Coupon();
        $coupon->owner_id = auth()->user()->id;
        $coupon->discount_name = $request->discount_name;
        $coupon->discount_type = $request->discount_type;
        $coupon->from_date = $request->from_date??null;
        $coupon->to_date = $request->to_date??null;
        $coupon->no_of_nights = $request->no_of_nights??null;
        $coupon->no_of_units = $request->no_of_units;
        $coupon->unit_id = $request->unit_id??null;
        $coupon->percentage = $request->percentage;
        $coupon->applied_on = $request->applied_on;
        $coupon->code = $request->code;
        $coupon->save();

        return response()->json([
            'status' => 'success',  
            'msg' => 'Coupon added successfully',
            'data' => ['coupon' => $coupon],
        ], 201);
    }

    // update coupon
    public function update(Request $request , $id){
        $coupon = Coupon::find($id);
        $coupon->update($request->all());
        return response()->json([
            'status' => 'success',  
            'msg' => 'Coupon updated successfully',
            'data' => ['coupon' => $coupon],
        ], 200);
    }

    // delete coupon
    public function destroy($id){
        $coupon = Coupon::find($id);
        $coupon->delete();  
        return response()->json([
            'status' => 'success',
            'msg' => 'Coupon deleted successfully',
            ], 200);
    } 

}
