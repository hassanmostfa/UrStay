<?php

namespace App\Http\Controllers\MVC;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use App\Models\Unit;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log ;

class AdminController extends Controller
{

    // Register Admin
    public function adminRegisterPage(){

        return view('auth.registerPages.adminRegister');
    }

    // Register Admin Action
    public function adminRegisterSave(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:admins',
            'password' => 'required|min:8',
        ]);

        $admin = new Admin();
        $admin->first_name = $request->first_name;
        $admin->last_name = $request->last_name;
        $admin->email = $request->email;
        $admin->password = Hash::make($request->password);
        $admin->save();

        // Return JSON response with 'status' and 'message' fields
        return response()->json(['status' => 'success',]);
    }

    // Admin Login Page
    public function adminLoginPage(){

        return view('auth.loginPages.adminLogin');
    }


    // Admin Login Action
    public function adminLoginAction(Request $request)
    {
        // Validate the request data
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        try {
            // Attempt to log the user in with the provided credentials
            $credentials = $request->only('email', 'password');
            Log::info('Attempting to log in with credentials: ' . json_encode($credentials));

            $result = Auth::guard('admin')->attempt($credentials);
            Log::info('Login attempt result: ' . json_encode($result));

            if ($result) {
                // Authentication passed
                return redirect()->route('admin.dashboard')->with('success', 'تم تسجيل الدخول بنجاح');
            } else {
                // Authentication failed
                $hashedPassword = Admin::where('email', $request->email)->first()->password;
                if (Hash::check($request->password, $hashedPassword)) {
                    // Password is correct, but authentication failed
                    Log::error('Login error: Password is correct, but authentication failed');
                    return redirect()->route('admin-login')->with('error', 'حدث خطأ ما');
                } else {
                    // Password is incorrect
                    return redirect()->route('admin-login')->with('error', 'Invalid email or password');
                }
            }
        } catch (\Exception $e) {
            // Log the exception message
            Log::error('Login error: ' . $e->getMessage());
            // Redirect with an error message
            return redirect()->route('admin-login')->with('error', 'حدث خطأ ما');
        }
    }

    // Admin Logout
    public function adminLogout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin-login');
    }

// Show Admin Dashboard
    public function index()
    {
        return view('admin.dashboard');
    }

    public function adminsView()
    {
        $admins = Admin::where('isMaster', false)->paginate(10); // Fetch admins with pagination
        $units = Unit::get();
        $allAdmins = Admin::where('isMaster', false)->get(); // Fetch admins with pagination
        return view('admin.managers.index', compact('admins', 'units', 'allAdmins'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email',
            'password' => 'required|string|min:8',
        ]);

        Admin::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->back()->with('success', 'Admin added successfully.');
    }

    public function destroy($id)
    {
        $admin = Admin::findOrFail($id);
        $admin->delete();

        return redirect()->back()->with('success', 'Admin deleted successfully.');
    }

    public function assignUnitToAdmin($unitId, $adminId)
    {
        $admin = Admin::findOrFail($adminId);
        $unit = Unit::findOrFail($unitId);
        $unit->managed_by = $admin->id;
        $unit->save();

        return redirect()->back()->with('success', 'Unit assigned successfully.');
    }
    public function assignUnitToAdminByForm(Request $request)
    {

        $adminId = $request->get('admin_id');
        $unitId = $request->get('unit_id');

        if (!$adminId && $unitId)
            return redirect()->back()->with('error', 'Please select an admin to assign unit to.');

        $admin = Admin::findOrFail($adminId);
        $unit = Unit::findOrFail($unitId);
        $unit->managed_by = $admin->id;
        $unit->save();

        return redirect()->back()->with('success', 'Unit assigned successfully.');
    }
}
