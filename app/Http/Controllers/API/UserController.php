<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Citizen;
use App\Models\Visitor;
use App\Models\Resident;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Storage; 
use Illuminate\Support\Facades\Log;
use App\Models\Unit;
use App\Models\CompletedUnit;
use App\Models\Owner;
use App\Models\UserWallet;
class UserController extends Controller
{

    public function userRegister(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }



        try{
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'personal_id' => $request->personal_id,
            'birth_date' => $request->birth_date,
            'passport_number' => $request->passport_number,
            'nationality' => $request->nationality,
            'residence_number' => $request->residence_number,
        ]);

        $user->save();

        // create wallet for this owner
        UserWallet::create(['user_id' => $user->id]);

        return response()->json(['status' => 'success', 'message' => 'تم التسجيل بنجاح']);

        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['status' => 'error', 'message' => 'حدث خطأ ما'], 500);
        }
    }

/******************************************************************************************/
        // Login API
        public function userLogin(Request $request)
        {
            // Validation request 
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required|string',
            ]);
            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }
            try {
                if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                    $user = Auth::user();
                    $token = $user->createToken('access_token')->plainTextToken;
                    return response()->json([
                        'success' => true,
                        'access_token' => $token ,
                        'token_type' => 'Bearer',
                        'data' => $user],
                        200);
                }else {
                    return response()->json(['error' => 'Unauthorised'], 401);
                }
            } catch (\Throwable $th) {
                return response()->json(['success' => false, 'message' => $th->getMessage()], 500);
            }
        }

        // Logout API
        public function userLogout(Request $request)
        {
            $request->user()->currentAccessToken()->delete(); // Delete access token
            return response()->json(['success' => true, 'message' => 'User logged out successfully.'], 200);
        }

/************************************************************************************************/
// Get All Units
public function getAllUnits(){
    try{
        $units = Unit::with('owner')
        ->withAvg('ratings', 'rating') // Calculate the average rating
        ->get();
    
        return response()->json([
            'status' => true,
            'data' => $units
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'status' => false,
            'message' => $e->getMessage()
        ]);
    }
}
/************************************************************************************************/

// get completed unit details
public function getCompletedUnitDetails($id){
    try{
        $unit = CompletedUnit::where('unit_id', $id)
    ->with(['unit' => function ($query) {
        $query->withAvg('ratings', 'rating');
    }])
    ->first();


        if(!$unit){
            return response()->json([
                'status' => false,
                'message' => 'Unit not found'
            ]);
        }
        
        return response()->json([
            'status' => true,
            'data' => $unit
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'status' => false,
            'message' => $e->getMessage()
        ]);
    }
}
/********************************************************************************************/

// get all completed units
public function getAllCompletedUnits()
{
    try {
        // Update units that are in draft and their publishment date has passed
        CompletedUnit::where('publishment_status', 'draft')
            ->whereNotNull('publishment_date') // Ensure there's a date set
            ->where('publishment_date', '<=', now()) // Check if the date has passed
            ->update(['publishment_status' => 'published']);

        // Retrieve all published units
        $units = CompletedUnit::with(['unit' => function ($query) {
            $query->withAvg('ratings', 'rating'); // Get the average rating for each unit
        },
        'unit.pricing_mechanisms' ,
        'unit.owner'
        ])
        ->where('publishment_status', 'published')
        ->get();
        
        return response()->json([
            'status' => 'success',
            'data' => $units
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => $e->getMessage()
        ]);
    }
}

/********************************************************************************************/

}

