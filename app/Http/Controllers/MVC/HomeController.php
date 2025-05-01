<?php

namespace App\Http\Controllers\MVC;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Unit;
use App\Models\CompletedUnit;

class HomeController extends Controller
{
    
    // Show Home Page
    public function index()
    {
        // Get All Units
        $units = Unit::where('request_status' , 'completed')->get();
        return view('home' , compact('units'));
    }
}
