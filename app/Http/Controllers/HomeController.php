<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Unit;


class HomeController extends Controller
{
    public function index()
    {
        $units = Unit::paginate(8);
        return view('home', compact('units'));
    }

    public function adminHome()
    {
        $allUsers = User::where('status', 'approved')->count();
        $pendingUsers = User::where('status', 'pending')->count();
        $pendingUnits = Unit::where('request_status', 'pending')->count();
        return view('admin.mainDashBoard', compact('allUsers', 'pendingUsers', 'pendingUnits'));
    }

    public function ownerHome()
    {
        return view('owner.ownerHome');
    }
}
