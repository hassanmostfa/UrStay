<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\Owner;
use App\Models\Zone;
use App\Models\Governorate;
use App\Models\City;
use App\Models\District;
use App\Models\Category;
use App\Models\Phone;
use App\Models\SubCategory;
use App\Models\SubOfSubCategory;
use App\Models\Unit;
use App\Models\CompletedUnit;
use App\Models\Wallet;

class OwnerController extends Controller
{
    // Register Owner Action
  public function register(Request $request)
{
    $validator = Validator::make($request->all(), [
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:owners',
        'pid' => 'required|string|max:255',
        'phone' => 'required|unique:owners',
        'password' => 'required|string|min:8|confirmed',
    ]);

    if ($validator->fails()) {
        return response()->json(['status' => false, 'msg' => $validator->errors()->first(), 'data' => null, 'notes' => ['Invalid data']], 422);
    }

    $phoneRecord = Phone::where('phone', $request->phone)->first();

    if (!$phoneRecord || !$phoneRecord->verified_at) {
        return response()->json(['status' => false, 'msg' => 'رقم الهاتف غير مفعل', 'data' => null, 'notes' => ['Unverified phone']], 403);
    }

    try {
        // إنشاء المالك
        $owner = Owner::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'pid' => $request->pid,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ]);

        // تسجيل الدخول تلقائيًا
        Auth::guard('owner')->login($owner);

        // إنشاء الـ token
        $token = $owner->createToken('owner_token')->plainTextToken;

        // التحقق إذا كان للمالك وحدات
        $ownerHasUnits = Unit::where('owner_id', $owner->id)->exists() ? 1 : 0;

        // create wallet for this owner
        Wallet::create(['owner_id' => $owner->id]);

        return response()->json([
            'status' => true,
            'msg' => 'Registration and login successful',
            'data' => [
                'owner' => $owner,
                'token' => $token,
                'has_units' => $ownerHasUnits,
            ],
            'notes' => ['Owner registered and logged in']
        ], 201);

    } catch (\Exception $e) {
        Log::error($e->getMessage());
        return response()->json(['status' => false, 'msg' => 'حدث خطأ ما', 'data' => null, 'notes' => ['Error occurred']], 500);
    }
}


    /*********************************************************************************/
    // Login Owner Action
    public function loginAction(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone_or_email' => 'required',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'msg' => $validator->errors()->first(), 'data' => null, 'notes' => ['Invalid data']], 422);
        }

        $loginField = $request->input('phone_or_email');
        $fieldType = filter_var($loginField, FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';

        $credentials = [
            $fieldType => $loginField,
            'password' => $request->input('password')
        ];

        if (Auth::guard('owner')->attempt($credentials)) {
            $owner = Auth::guard('owner')->user();
            $token = $owner->createToken('owner_token')->plainTextToken;

            // check if the owner has units or not
            $ownerHasUnits = Unit::where('owner_id', $owner->id)->exists();

            $ownerHasUnits ? $ownerHasUnits = 1 : $ownerHasUnits = 0;
            

            return response()->json(['status' => true, 'msg' => 'Login successful', 'data' => ['token' => $token, 'owner' => $owner , 'has_units' => $ownerHasUnits], 'notes' => ['Login successful']], 200);
        } else {
            return response()->json(['status' => false, 'msg' => 'Invalid email or password', 'data' => null, 'notes' => ['Invalid credentials']], 401);
        }
    }

    /***********************************************************************************/
    // Owner Logout
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['status' => true, 'msg' => 'Logout successful', 'data' => null, 'notes' => ['Logout successful']], 200);
    }

    /*********************************************************************************/

    // Get Authenticated Owner
    public function ownerData(){
       try{
        $owner = Auth::user();
        return response()->json(['status' => 'success', 'data' => $owner], 200);
       }catch(\Throwable $th){
           return response()->json(['status' => 'error', 'data' => $th->getMessage()], 500);
       }
    }

    /*********************************************************************************/
    // Update Owner Profile
    public function updateProfile(Request $request) {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'pid' => 'required|string|max:255',
            'phone' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'msg' => $validator->errors()->first(), 'data' => null, 'notes' => ['Invalid data']], 422);
        }

        try {
            $owner = Auth::user();
            $owner->first_name = $request->first_name;
            $owner->last_name = $request->last_name;
            $owner->email = $request->email;
            $owner->pid = $request->pid;
            $owner->phone = $request->phone;
            $owner->save();

            return response()->json(['status' => true, 'msg' => 'Profile updated successfully', 'data' => ['owner' => $owner], 'notes' => ['Profile updated']], 200);
    }catch (\Exception $e) {
        return response()->json(['status' => false, 'msg' => 'حدث خطأ ما', 'data' => null, 'notes' => ['Error occurred']], 500);
    }

    }

    /**********************************************************************************/
    // Fetch cities based on selected governorate
    public function getCities($governorateId)
    {
        $cities = City::where('governorate_id', $governorateId)->get();
        return response()->json(['status' => true, 'msg' => 'Cities fetched', 'data' => $cities, 'notes' => ['Cities fetched']], 200);
    }

    // Fetch districts based on selected city
    public function getDistricts($cityId)
    {
        $districts = District::where('city_id', $cityId)->get();
        return response()->json(['status' => true, 'msg' => 'Districts fetched', 'data' => $districts, 'notes' => ['Districts fetched']], 200);
    }

    // Fetch subcategories based on category ID
    public function getSubcategories($categoryId)
    {
        $subcategories = SubCategory::where('category_id', $categoryId)->get();
        return response()->json(['status' => true, 'msg' => 'Subcategories fetched', 'data' => $subcategories, 'notes' => ['Subcategories fetched']], 200);
    }

    // Fetch sub-subcategories based on subcategory ID
    public function getSubSubcategories($subcategoryId)
    {
        $subSubcategories = SubOfSubCategory::where('sub_category_id', $subcategoryId)->get();
        return response()->json(['status' => true, 'msg' => 'Sub-subcategories fetched', 'data' => $subSubcategories, 'notes' => ['Sub-subcategories fetched']], 200);
    }

    /**********************************************************************************/
    // get all completed units
public function getAllCompletedUnits(){
    try{

        $owner = Auth::user();
        $units = CompletedUnit::with('unit')
        ->where('owner_id', $owner->id)
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
    /**********************************************************************************/

public function resetOwnerPassword(Request $request)
{
    try {
        // Validate input
        $validator = Validator::make($request->all(), [
            'new_password' => 'required|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        // Get the authenticated owner
        $owner = Auth::user();
        if (!$owner) {
            return response()->json([
                'status' => 'error',
                'message' => 'Owner not authenticated.',
            ], 401);
        }

        // Update the password
        $owner->password = Hash::make($request->new_password);
        $owner->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Password updated successfully.',
        ]);
    } catch (\Exception $e) {
        return response()->json( [
            'status' => 'error',
            'message' => $e->getMessage(),

        ], 500);
    }
}
/***********************************************************************************/

// Reset Password
public function resetPassword(Request $request){
    try {
        $validator = Validator::make($request->all(), [
            'phone' => 'required',
            'new_password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        $owner = Owner::where('phone', $request->phone)->first();

        if (!$owner) {
            return response()->json([
                'status' => 'error',
                'message' => 'هذا البريد غير موجود الرجاء التحقق من البريد الالكتروني او التواصل مع الادارة'
            ], 404);
        }

        $owner->password = Hash::make($request->new_password);
        $owner->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Password reset successfully'
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => $e->getMessage()
        ]); 
    }
}

}
