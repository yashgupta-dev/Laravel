@extends('admin.layouts.app')

@section('content')

<h5 class="text-muted font-weight-normal mb-4">Welcome back! Log in to your account.</h5>
<form class="forms-sample" id="login-form" method="POST" action="{{ route('admin.login') }}">
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
        <!-- <div class="col-md-6">
            <a class="d-block mt-3 text-muted" href="{{ route('admin.register') }}">
                <small>{{ __('I don\'t have an account ?') }}</small>
            </a>
        </div> -->
        <div class="col-md-6">
            @if (Route::has('admin.password.request'))
            <a class="d-block mt-3 text-muted" href="{{ route('admin.password.request') }}">
                <small>{{ __('Forgot Your Password?') }}</small>
            </a>
            @endif
        </div>
    </div>
</form>
@endsection
