<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Storage; 
use Illuminate\Support\Facades\Log;
class AuthController extends Controller
{
    public function __construct(){
        $this->middleware('guest', ['except' => ['logout']]); 
    }
    public function register(){
        return view('auth.register');
    }

    public function registerSave(Request $request){
        
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'pid' => 'required|file|mimes:pdf,jpg,png,jpeg|max:2048',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'pid' => $request->file('pid')->store('usersPids'),
        ]);
        return redirect()->route('home')->with('success', 'تم التسجيل بنجاح الطلب قيد المراجعة');
    }
    public function login(){
        return view('auth.login');
    }

    public function loginAction(Request $request){
        Validator::make($request->all(), [
            'email' => ['required', 'email'],
            'password' => ['required'],
        ])->validate();
        if (!Auth::attempt($request->only('email', 'password') , $request->boolean('remember'))) {
            throw ValidationException::withMessages([
                'email' => trans('auth.failed'),
            ]);
        }
        $request->session()->regenerate();

        if(Auth::user()->role == 'admin'){
            return redirect()->route('admin/home');
        }elseif (Auth::user()->role == 'owner' && Auth::user()->status == "approved") {
            return redirect()->route('owner/home');
        }
        elseif(Auth::user()->status == "pending"){
            return redirect()->route('home')->with('error', 'عفوا طلبكم لا يزال قيد المراجعة');
        }elseif(Auth::user()->role == "user" && Auth::user()->status == "approved"){
            return redirect()->route('home');
        }
        else{
            return redirect()->route('login')->with('error', 'يجب تسجيل الدخول اولا'); 
        }
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}

