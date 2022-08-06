<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;
    protected function redirectPath()
    {
        if (auth()->user()->role->role_id == config('settings.config_default_redirect')) {
            return "/";
        }
        return RouteServiceProvider::HOME;   
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        if(!config('settings.config_user_account_login')):
            abort(404);
        endif;
        $this->middleware('guest')->except('logout');
    }
}
