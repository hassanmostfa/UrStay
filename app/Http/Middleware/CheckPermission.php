<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next, $permission)
    {
        $user = auth()->user();
        $ownerId = $request->route('owner');

        $roles = DB::table('supervisor_owner_permissions')
            ->where('owner_id', $ownerId)
            ->where('supervisor_id', $user->id)
            ->get();

        if (!$roles) {
            abort(403, 'Unauthorized');
        }

        $isAuthorized = false;

        foreach ($roles as $role) {
            if ($role->permission == $permission) {
                $isAuthorized = true;
            }
        }

        if (!$isAuthorized)
            abort(403, 'Unauthorized');

        return $next($request);
    }
}
