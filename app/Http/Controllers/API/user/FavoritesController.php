<?php

namespace App\Http\Controllers\API\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Favorite;
use App\Models\Unit;
use App\Models\User;
class FavoritesController extends Controller
{
    // get all favorites for the current user
    public function index(){
        try{
            $user = Auth::user();
            $favorites = Favorite::where('user_id' , $user->id)
            ->with('unit')
            ->get();

            return response()->json(['status' => 'success', 'data' => $favorites], 200);
        }catch(\Throwable $th){
            return response()->json(['status' => 'error', 'error' => $th->getMessage()], 500);
        }
    }

    /*****************************************************************************************/

    // add favorite for the current user
    public function store($unit_id){
        try{
            $user = Auth::user();

            $favorite = Favorite::create([
                'user_id' => $user->id,
                'unit_id' => $unit_id,
            ]);

            return response()->json(['status' => 'success', 'data' => 'favorite added successfully'], 200);
        }catch(\Throwable $th){
            return response()->json(['status' => 'error', 'error' => $th->getMessage()], 500);
        }
    }

    /*****************************************************************************************/

    // delete favorite for the current user
    public function destroy($unit_id){
        try{
            $user = Auth::user();

            $favorite = Favorite::where('user_id' , $user->id)->where('unit_id' , $unit_id)->first();

            if($favorite){
                $favorite->delete();

                return response()->json(['status' => 'success', 'data' => 'favorite deleted successfully'], 200);
            }else{
                return response()->json(['status' => 'error', 'error' => 'favorite not found'], 404);
            }
        }catch(\Throwable $th){
            return response()->json(['status' => 'error', 'error' => $th->getMessage()], 500);
        }
    }
}
