<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Auth\Authenticatable;
use Auth;

class MasterRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (! Auth::guard('admin')->user()->hasRole(auth()->guard('admin')->user()->role->role_id)) {
            abort(401, 'This action is unauthorized.');
        }

        return $next($request);
    }
}
