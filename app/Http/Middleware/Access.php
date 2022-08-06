<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Role;

class Access
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next,$controller)
    {
        $roleCheck = Role::where('id',auth()->user()->role->role_id)->select('permission')->first()['permission'];        
        if(strpos($controller,'.')) {
            $controller  = str_replace('.','/',$controller);
        }
        if(!empty($roleCheck) && $roleCheck != 'null' && !in_array($controller,json_decode($roleCheck,true)['access'])) {
            abort(403, 'Warning: you don\'t have access this page');
        }
        return $next($request);
    }
}
