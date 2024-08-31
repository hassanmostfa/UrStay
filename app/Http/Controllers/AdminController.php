<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Unit;
use App\Models\Booking;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index(){
        $users = User::where('status', 'approved')->get();
        return view('admin.users.allUsers', compact('users'));
    }
    public function create(){
        return view('admin.users.user-create');
    }

    public function store(Request $request){
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
        return redirect()->route('admin/users')->with('success', 'User created successfully.');
    }

    public function edit($id){
        $user = User::find($id);
        return view('admin.users.user-edit', compact('user'));
    }

    public function update(Request $request, $id){
        $user = User::find($id);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make($request->password),
        ]);
        return redirect()->route('admin/users')->with('success', 'User updated successfully.');
    }

    public function destroy($id){
        $user = User::find($id);
        $user->delete();
        return redirect()->route('admin/users')->with('success', 'User deleted successfully.');
    }

    public function showNewUsersRequests(){
        $pendingUsers = User::where('status', 'pending')->get();
        return view('admin.users.newRequests', compact('pendingUsers'));
    }

    public function approveUser($id){
        $user = User::find($id);
        $user->update([
            'status' => 'approved',
        ]);
        return redirect()->route('admin/users/new-requests')->with('success', 'تم تاكيد الطلب بنجاح.');
    }

    public function showSingleUser($id){
        $user = User::find($id);
        return view('admin.users.showUserData', compact('user'));
    }

    public function showNewUnitsRequests(){
        $pendingUnits = Unit::where('request_status', 'pending')->get();
        return view('admin.units.newUnitsRequests', compact('pendingUnits'));
    }

    public function approveUnit($id){
        $unit = Unit::find($id);
        if ($unit) {
            $unit->update([
                'request_status' => 'approved',
            ]);
            return redirect()->route('admin/home')->with('success', 'تم تاكيد الطلب بنجاح.');
        }else{
            return redirect()->route('admin/home')->with('error', 'هذه الوحدة غير موجودة.');
        }
    }


    // Show All Units

    public function showAllUnits(){
        $units = Unit::where('request_status', 'approved')->get();
        return view('admin.units.allUnits', compact('units'));
    }


    // Show ِAll Booking Transactions

    public function showAllBookings(){
        $bookings = Booking::where('status', 'confirmed')->orWhere('status', 'cancelled')
        ->orWhere('status', 'completed')
        ->get();
        return view('admin.users.allBookings', compact('bookings'));
    }


    // Show Booking Details

    public function showBookingDetails($id){
        $booking = Booking::Findorfail($id);
        $user = User::find($booking->user_id);
        $unit = Unit::find($booking->unit_id);

        return view('admin.users.showBookingDetails', compact('booking' , 'user' , 'unit'));
    }


    // Show New Booking Requests

    public function showNewBookingRequests(){
        $newBookings = Booking::where('status', 'pending')->get();
        return view('admin.users.newBookingRequests', compact('newBookings'));
    }


    // Approve Booking Request
    public function confirmBooking($id) {
        $booking = Booking::find($id);
        if($booking) {
            try {
                // Update the booking status
        $booking->update(['status' => 'confirmed']);

        // Mark the unit as reserved
        $unit = Unit::find($booking->unit_id);
        $unit->update(['unit_status' => 'reserved']);
        return redirect()->route('admin/bookings/new-requests')->with('success', 'تم تاكيد الطلب بنجاح.');
            } catch (\Exception $e) {
                return redirect()->route('admin/bookings/new-requests')->with('error', 'حدث خطأ ما. الرجاء المحاولة مرة اخرى.');
            }
        }
        
    }


    // Cancel Booking Request
    public function cancelBooking($id) {
        $booking = Booking::find($id);
        if($booking) {
            try {
                // Update the booking status
        $booking->update(['status' => 'cancelled']);
        return redirect()->route('admin/bookings/new-requests')->with('success', 'تم الغاء الطلب بنجاح.');
            } catch (\Exception $e) {
                return redirect()->route('admin/bookings/new-requests')->with('error', 'حدث خطأ ما. الرجاء المحاولة مرة اخرى.');
            }
        }
        
    }
}
