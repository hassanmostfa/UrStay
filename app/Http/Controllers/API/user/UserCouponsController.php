<?php

namespace App\Http\Controllers\API\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Coupon;

class UserCouponsController extends Controller
{
    // apply Coupon
    public function applyCoupon(Request $request)
{
    $request->validate(['code' => 'required',]);

    $coupon = Coupon::where('code', $request->code)
        ->where('to_date', '>=', now()) // Filter expired coupons directly in the query
        ->first();

    if (!$coupon) {
        return response()->json([
            'status' => 'error',
            'msg' => 'Invalid or expired coupon',
        ], 400);
    }

    return response()->json([
        'status' => 'success',
        'msg' => 'Coupon applied successfully',
        'data' => $coupon,
    ], 200);
}

}
