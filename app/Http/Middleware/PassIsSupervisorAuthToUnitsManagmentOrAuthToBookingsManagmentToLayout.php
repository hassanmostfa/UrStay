<?php

namespace App\Http\Middleware;

use App\Models\Owner;
use App\Models\Supervisor_owner_permission;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class PassIsSupervisorAuthToUnitsManagmentOrAuthToBookingsManagmentToLayout
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $ownerId = $request->route('owner');

        $owner = Owner::find($ownerId);
        $supervisor = Auth::guard('supervisor')->user();

        $isAuthToUnitsManagment = Supervisor_owner_permission::where([
            "owner_id" => $owner->id,
            "supervisor_id" => $supervisor->id,
            "permission" => "units_managment",
        ])->get()->count() > 0;

        $isAuthToBookingsManagment = Supervisor_owner_permission::where([
            "owner_id" => $owner->id,
            "supervisor_id" => $supervisor->id,
            "permission" => "booking_managment",
        ])->get()->count() > 0;

        View::share('owner', $owner);
        View::share('isAuthToUnitsManagment', $isAuthToUnitsManagment);
        View::share('isAuthToBookingsManagment', $isAuthToBookingsManagment);

        return $next($request);
    }
}
