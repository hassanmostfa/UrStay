<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Policy;
class PoliciesController extends Controller
{
    // get all policies
    public function index(){
        $policies = Policy::all();
        return response()->json(['status' => 'success','data' => $policies] , 200);
    }
}
