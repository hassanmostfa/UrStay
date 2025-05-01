<?php

namespace App\Http\Middleware;

use App\Models\Unit;
use Closure;
use Illuminate\Http\Request;

class CheckIfAdminManager
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
        $unitId = $request->route('id');

        $admin = auth()->user();

        $unit = Unit::findOrFail($unitId);

        if ((!$unitId || !$unit || !$unit->managed_by == $admin->id) && !$admin->isMaster) {
            if ($request->is('api/*') && !$request->user()) {
                return route('not.auth');
            }

            return redirect()->route('unit.notauth', $unit->id);
        }

        return $next($request);
    }
}
