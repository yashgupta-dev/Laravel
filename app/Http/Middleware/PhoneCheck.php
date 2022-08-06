<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;

class PhoneCheck
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
        
        // if(Auth::user()->phone == null || empty(Auth::user()->phone)){
        //     if(url()->current() == URL::to('/profile/update')){
                
        //     }else{
        //         if(url()->current() != URL::to('/home/profile')){
        //             return redirect(route('home.profile'))->withErrors(['erpr'=>'Oops! you don\'t complete your profile, please complete your profile now! '])->withInput();
        //         }    
        //     }
        // } 
        return $next($request);
    }
}
