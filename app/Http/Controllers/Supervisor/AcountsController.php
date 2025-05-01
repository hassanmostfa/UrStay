<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;
use App\Models\Owner;
use App\Models\Supervisor_owner_permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AcountsController extends Controller
{
    public function ownerDashboard($owner) {
        $owner = Owner::find($owner);

        return view('supervisor.ownerDashboard', compact('owner'));
    }
}
