<?php

namespace App\Http\Controllers\MVC;

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


class UserController extends Controller
{
    public function index()
    {
        return view('user.dashboard');
    }

    /* Redirect to userRegister page */
    public function userRegister()
    {
        return view('auth.registerPages.userRegister');
    }

    /* Save new user Data */
    public function userRegisterSave(Request $request){
        $validator = Validator::make($request->all(), [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'phone'         => 'required|unique:users',
            'password' => ['required', 'string', 'min:8'],
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()], 422);
        }

        try {
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ]);
        $user->save();
        return response()->json(['success' => true, 'message' => 'تم التسجيل بنجاح']);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['success' => false, 'message' => 'حدث خطأ ما'], 500);
        }
    }


    // Login user Page
    public function userLoginPage(){
        return view('auth.loginPages.userLogin');
    }


    // Login user with email and passwordS
    public function userLoginAction(Request $request)
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

        $user = User::where($fieldType, $loginField)->first();

        if (!$user)
            return redirect()->route('user-login')->with('error', 'لا يوجد حساب بتلك البيانات');
        
        try {
            
            if (Auth::attempt($credentials)) {
                return redirect()->route('user-dashboard')->with('success', 'تم تسجيل الدخول بنجاح');
            } else {
                return redirect()->route('user-login')->with('error', 'Invalid email or password');
                $request->session()->regenerate();
            }
        } catch (\Throwable $th) {
            return redirect()->route('user-login')->with('error', $th->getMessage());
        }
    }



    // Register user (citizen) 
    public function citizenRegister(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pid_number' => 'required|string|max:255',
            'birth_date' => 'required|date',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()], 422);
        }
    
        try {
            $user = Citizen::create([
                'user_id' => auth()->user()->id,
                'pid_number' => $request->pid_number,
                'birth_date' => $request->birth_date,
            ]);
    
            $user->save();
    
            // Reload the authenticated user
            $authenticatedUser = auth()->user();
            $authenticatedUser->update([
                'is_completed' => true , 
                'role' => 'citizen',
            ]);
    
            return redirect()->route('user-dashboard')->with('success', 'تم التسجيل بنجاح');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('user-dashboard')->with('error', 'حدث خطأ ما');
        }
    }

    // Register user (visitor)
    public function visitorRegister(Request $request){
        $validator = Validator::make($request->all(), [
            'passport_number' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'nationality' => 'required|string|max:255',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()], 422);
        }

        try {
            $visitor = Visitor::create([
                'user_id' => auth()->user()->id,
                'passport_number' => $request->passport_number,
                'birth_date' => $request->birth_date,
                'nationality' => $request->nationality,
            ]);
            $visitor->save();

            // Reload the authenticated user
            $authenticatedUser = auth()->user();
            $authenticatedUser->update([
                'is_completed' => true , 
                'role' => 'visitor',
            ]);

            return redirect()->route('user-dashboard')->with('success', 'تم التسجيل بنجاح');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('user-dashboard')->with('error', 'حدث خطأ ما');
        }

    }
    


    
    // Register user (resident)
    public function residentRegister(Request $request){
        $validator = Validator::make($request->all(), [
            'resident_number' => 'required|string|max:255',
            'birth_date' => 'required|date',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()], 422);
        }
    
        try {
            $resident = Resident::create([
                'user_id' => auth()->user()->id,
                'resident_number' => $request->resident_number,
                'birth_date' => $request->birth_date,
            ]);
    
            $resident->save();
    
            // Reload the authenticated user
            $authenticatedUser = auth()->user();
            $authenticatedUser->update([
                'is_completed' => true , 
                'role' => 'resident',   
            ]);
    
            return redirect()->route('user-dashboard')->with('success', 'تم التسجيل بنجاح');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('user-dashboard')->with('error', 'حدث خطأ ما');
        }
    }
}
