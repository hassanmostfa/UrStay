<?php

namespace App\Http\Controllers\API\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Rating;
class RatingsController extends Controller
{
    // create rating 
    public function create(Request $request){
        $validator = Validator::make($request->all(), [
            'unit_id' => 'required',
            'rate' => 'required',
            'comment' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()], 422);
        }

        $rating = new Rating();
        $rating->user_id = Auth::user()->id;
        $rating->owner_id = $request->owner_id;
        $rating->unit_id = $request->unit_id;
        $rating->rating = $request->rate;
        $rating->comment = $request->comment;

        if($rating->save()){
            return response()->json(['success' => true, 'message' => 'Rating created successfully'], 200);
        }else{
            return response()->json(['success' => false, 'message' => 'Failed to create rating'], 500);
        }
    }

    // get all ratings for specific unit
    public function getUnitRatings($unit_id){
        $ratings = Rating::where('unit_id', $unit_id)
        ->with('user')
        ->get();
        return response()->json(['success' => true, 'data' => $ratings], 200);
    }
}
