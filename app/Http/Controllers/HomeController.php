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

        return view('admin.mainDashBoard');
    }

    public function ownerHome()
    {
        return view('owner.ownerHome');
    }
}
