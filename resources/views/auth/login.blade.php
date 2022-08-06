@extends('layouts.auth') 
@section('content')

<h5 class="text-muted font-weight-normal mb-4">Welcome back! Log in to your account.</h5>
<form class="forms-sample" id="login-form" method="POST" action="{{ route('login') }}">
    @csrf
    <div class="form-group">
        <label for="exampleInputEmail1">{{ __('E-Mail Address') }}</label>
        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus />

        @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="form-group">
        <label for="exampleInputPassword1">{{ __('Password') }}</label>
        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" />

        @error('password')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="mt-3">
        <button type="button" id="login-btn" class="btn btn-primary mr-2 mb-2 mb-md-0 text-white">{{ __('Sign in') }}</button>
    </div>
    <div class="form-row">
        @if(config('settings.config_account_create'))
        <div class="col-md-6">
            <a class="d-block mt-3 text-muted" href="{{ route('register') }}">
                <small>{{ __('I don\'t have an account ?') }}</small>
            </a>
        </div>
        @endif
        @if(config('settings.config_password_forget'))
        <div class="col-md-6">
            @if (Route::has('password.request'))
            <a class="d-block mt-3 text-muted" href="{{ route('password.request') }}">
                <small>{{ __('Forgot Your Password?') }}</small>
            </a>
            @endif
        </div>
        @endif
    </div>
    @if(config('settings.facebook_module_status') || config('settings.google_module_status'))
    <hr />
    @endif
    <div class="form-row">
    @if(config('settings.facebook_module_status'))
        <div class="col-md-6">
            <div class="d-flex justify-content-between" id="btn_fb">
                <a href="{{ route('login.facebook') }}" class="btn btn-block" style="background: #3b5998;border: 1px solid #3b5998;color: #fff;margin-top: 15px;padding: 8px;">
                    <i class="fab fa-facebook-square"></i> <span>{{ config('settings.facebook_module_title') }}</span>
                </a>
            </div>
        </div>
    @endif
    @if(config('settings.google_module_status'))
        <div class="col-md-6">
            <div class="d-flex justify-content-between">
                <a href="{{ route('login.google') }}" class="btn btn-block">
                    <img src="{{ asset('google/1x/btn_google_signin_light_pressed_web.png') }}" style="
    width: 170px;
    height: 45px;
    object-fit: contain;
">
                </a>
            </div>
        </div>
    @endif
    </div>
    
</form>
<style>
@media only screen and (max-width: 600px) {
    #btn_fb{
        justify-content:center !important;
    }
    #btn_fb a{
        width: 185px !important;
    }
}
</style>
@endsection