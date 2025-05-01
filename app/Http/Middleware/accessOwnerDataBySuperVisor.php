<?php

namespace App\Http\Middleware;

use App\Models\Supervisor_owner_permission;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class accessOwnerDataBySuperVisor
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
        $supervisor = Auth::guard('supervisor')->user();
        $ownerId = $request->route('owner');

        $permissions = Supervisor_owner_permission::where('supervisor_id', $supervisor->id)->where('owner_id', $ownerId)->get();

        if ($permissions->count() == 0)
            abort(403, 'Unauthorized');

        return $next($request);
    }
}
