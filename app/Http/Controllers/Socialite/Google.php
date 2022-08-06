<?php

namespace App\Http\Controllers\Socialite;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class Google extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    
    public function redirectToProviderGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleProviderCallbackGoogle()
    {
        try{

            $google = Socialite::driver('google')->user();

        } catch (\Exception $e) {
            return redirect(route('login'));
        }
        $user = User::where('email',$google->email)->first();
        
        Session::put('avatar',$google->avatar);
        if(!empty($user)){
            Auth::login($user);
        }else{
            
            $user = new User;
            $user->name = $google['name'];
            $user->email = $google['email'];
            $user->email_verified_at = date('Y-m-d h:i:s');
            $user->authenticate_type = 'Google';
            $user->authenticate_id = $google['id'];
            $user->password = bcrypt($google['id']);
            $user->role_id = '2';   
            $user->save();
            Auth::login($user);

        }
        
        return redirect(route('home'));    
    }
}
