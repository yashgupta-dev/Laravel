<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Site;
use App\Models\Admin;
use Illuminate\Contracts\Routing\Middleware;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

class SetupInstall
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
        $check = Site::where('panelId',0)->exists();
        $admin = Admin::get();
        if(url()->current() == URL::to('/setup/install') || url()->current() == URL::to('/setup/finish') || url()->current() == URL::to('/setup/finshing/installing') || url()->current() == URL::to('/setup/register')){
            
            if($check == 1 ){
                if(count($admin) > 0){
                    return redirect('/');
                }else{
                    
                }
            }else{
             
            }
        }else{
            if($check == 1 ){
                if(count($admin) > 0){

                }else{
                    return redirect('/setup/finish');
                }
            }else{
                return redirect('/setup/install');
            }
        }
        return $next($request);
    }
}
