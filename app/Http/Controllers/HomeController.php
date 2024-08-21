<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Unit;


class HomeController extends Controller
{
    public function index()
    {
        $units = Unit::paginate(6);
        return view('home', compact('units'));
    }

    public function adminHome()
    {
        // Return all users
        $users = User::all();
        return view('admin.users.dashboard' , compact('users'));
    }

    public function ownerHome()
    {
        return view('owner.dashboard');
    }
}
