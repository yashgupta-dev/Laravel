<?php

namespace App\Http\Controllers\Socialite;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class Facebook extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleProviderCallback()
    {
        try{

            $facebook = Socialite::driver('facebook')->user();

        } catch (\Exception $e) {
            return redirect(route('login'));
        }
        $user = User::where('email',$facebook->email)->first();
        
        Session::put('avatar',$facebook->avatar);
        if(!empty($user)){
            Auth::login($user);
        }else{
            
            $user = new User;
            $user->name = $facebook['name'];
            $user->email = $facebook['email'];
            $user->email_verified_at = date('Y-m-d h:i:s');
            $user->authenticate_type = 'facebook';
            $user->authenticate_id = $facebook['id'];
            $user->password = bcrypt($facebook['id']);
            $user->role_id = '2';   
            $user->save();
            Auth::login($user);

        }
        
        return redirect(route('home'));    
    }
}
