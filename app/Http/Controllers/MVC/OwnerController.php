<?php

namespace App\Http\Controllers\MVC;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Storage;
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



class OwnerController extends Controller
{
    // Register Owner
    public function register(Request $request)
    {
        return view('auth.registerPages.ownerRegister');
    }

    // Register Owner Action
    public function registerAction(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'phone'         => 'required|unique:owners',
            'password' => ['required', 'string', 'min:8'],
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()->first()], 422);
        }

        $phoneRecord = Phone::where('phone',  $request['phone'])->first();

        if (!$phoneRecord || !$phoneRecord->verified_at) {
            // If the phone is not found or not verified, return an error response
            return response()->json(['success' => false, 'message' => 'رقم الهاتف غير مفعل'], 403);
        }

        try {
            $owner = Owner::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
            ]);

            $owner->save();
            Auth::guard('owner')->attempt([
                'email' => $request->email,
                'password' => $request->password,
            ]);
            return response()->json(['success' => true, 'message' => 'تم التسجيل بنجاح']);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['success' => false, 'message' => 'حدث خطأ ما'], 500);
        }
    }

    // Login Owner Page
    public function loginPage()
    {
        return view('auth.loginPages.ownerLogin');
    }

    // Login Owner Action
    public function loginAction(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone_or_email' => ['required'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()], 422);
        }

        $loginField = $request->input('phone_or_email');

        // Determine if it's an email or phone
        $fieldType = filter_var($loginField, FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';

        $credentials = [
            $fieldType => $loginField,
            'password' => $request->input('password')
        ];

        $owner = Owner::where($fieldType, $loginField)->first();

        if (!$owner)
            return redirect()->route('owner.login')->with('error', 'لا يوجد حساب بتلك البيانات');

        if (Auth::guard('owner')->attempt($credentials)) {
            return redirect()->route('owner-dashboard');
        } else {
            return redirect()->route('owner.login')->with('error', 'Invalid email or password');
        }
    }

    // Owner Logout
    public function logout()
    {
        Auth::guard('owner')->logout();
        return redirect()->route('owner.login');
    }

    // Owner Dashboard
    public function index()
    {
        return redirect()->route('owner.myUnits');
    }

        // Fetch governorates based on selected zone
        public function getGovernorates($zoneId)
        {
            $governorates = Governorate::where('zone_id', $zoneId)->get();
            return response()->json($governorates);
        }

        // Fetch cities based on selected governorate
        public function getCities($governorateId)
        {
            $cities = City::where('governorate_id', $governorateId)->get();
            return response()->json($cities);
        }

        // Fetch districts based on selected city
        public function getDistricts($cityId)
        {
            $districts = District::where('city_id', $cityId)->get();
            return response()->json($districts);
        }


    // Fetch subcategories based on category ID
    public function getSubcategories($categoryId)
    {
        // Fetch subcategories where the category_id matches
        $subcategories = Subcategory::where('category_id', $categoryId)->get();

        // Return subcategories as a JSON response
        return response()->json($subcategories);
    }

    // Fetch sub-subcategories based on subcategory ID
    public function getSubSubcategories($subcategoryId)
    {
        // Fetch sub-subcategories where the subcategory_id matches
        $subSubcategories = SubOfSubcategory::where('sub_category_id', $subcategoryId)->get();

        // Return sub-subcategories as a JSON response
        return response()->json($subSubcategories);
    }
}
