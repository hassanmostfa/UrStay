<?php

namespace App\Http\Controllers\MVC;

use App\Http\Controllers\Controller;
use App\Models\Phone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use App\Models\Supervisor;
use App\Models\Supervisor_owner_permission;

class SupervisorController extends Controller
{
    // Register Supervisor Page
    public function registerPage()
    {
        return view('auth.registerPages.supervisorRegister');
    }

    // Register Supervisor Action
    public function registerAction(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email'         => 'required|unique:supervisors',
            'phone'         => 'required|unique:supervisors',
            'password' => ['required', 'string', 'min:8'],
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => $validator->errors()->first()], 422);
        }

        // Check if the phone number exists in the 'phones' table and is verified
        $phoneRecord = Phone::where('phone',  $request['phone'])->first();

        if (!$phoneRecord || !$phoneRecord->verified_at) {
            // If the phone is not found or not verified, return an error response
            return response()->json(['status' => 'error', 'message' => 'رقم الهاتف غير مفعل'], 403);
        }


        try {
            $supervisor = Supervisor::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
            ]);

            $supervisor->save();
            return response()->json(['status' => 'success', 'message' => 'تم التسجيل    بنجاح']);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['status' => 'error', 'message' => 'حدث خطأ ما'], 500);
        }
    }

    // Login Supervisor Page
    public function loginPage()
    {
        return view('auth.loginPages.supervisorLogin');
    }

    // Login Supervisor Action
    public function loginAction(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone_or_email' => ['required'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => $validator->errors()], 422);
        }

        $loginField = $request->input('phone_or_email');

        // Determine if it's an email or phone
        $fieldType = filter_var($loginField, FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';

        $credentials = [
            $fieldType => $loginField,
            'password' => $request->input('password')
        ];

        $supervisor = Supervisor::where($fieldType, $loginField)->first();

        if (!$supervisor)
            return redirect()->route('supervisor.login')->with('error', 'لا يوجد حساب بتلك البيانات');

        if (!$supervisor->isApproved)
            return redirect()->route('supervisor.login')->with('error', 'الحساب تحت المراجعة من قبل المسولين سوف نخبرك عندما يتم قبوله');


        if (Auth::guard('supervisor')->attempt($credentials)) {
            return redirect()->route('supervisor-dashboard');
        } else {
            return redirect()->route('supervisor.login')->with('error', 'Invalid email or password');
        }
    }

    // Supervisor Dashboard
    public function index()
    {
        $accounts = Supervisor_owner_permission::with('owner')
            ->where('supervisor_id', Auth::guard('supervisor')->user()->id)
            ->select('owner_id') // Select distinct owner_id
            ->distinct() // Make sure only unique owner_id are retrieved
            ->orderBy('owner_id', 'desc')
            ->paginate(15);

        return view('supervisor.dashboard', compact('accounts'));
    }

    public function logout()
    {
        Auth::guard('supervisor')->logout();
        return redirect()->to('/supervisor/login');
    }
}
