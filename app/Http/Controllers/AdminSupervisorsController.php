<?php

namespace App\Http\Controllers;

use App\Models\Supervisor;
use Illuminate\Http\Request;

class AdminSupervisorsController extends Controller
{
    public function getSupervisorsView() {
        $supervisors = Supervisor::paginate(10); // Adjust the pagination as needed
        return view('admin.supervisors.index', compact('supervisors'));    }

    public function approve($id)
{
    $supervisor = Supervisor::findOrFail($id);
    $supervisor->isApproved = 1;
    $supervisor->save();

    return redirect()->back()->with('success', 'Supervisor approved successfully.');
}

public function reject($id)
{
    $supervisor = Supervisor::findOrFail($id);
    $supervisor->isApproved = 0;
    $supervisor->save();

    return redirect()->back()->with('success', 'Supervisor rejected successfully.');
}

}
