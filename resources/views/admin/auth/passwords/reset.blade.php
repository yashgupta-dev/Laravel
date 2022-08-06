@extends('admin.layouts.app')

@section('content')
<h5 class="text-muted font-weight-normal mb-4">{{ __('Reset Password') }}</h5>
<form class="forms-sample" id="reset-form" method="POST" action="{{ route('admin.password.request') }}">
    @csrf

    <input type="hidden" name="token" value="{{ $token }}" />

    <div class="form-group">
        <label for="exampleInputEmail1">{{ __('E-Mail Address') }}</label>
        <input id="email" type="hidden" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus />

        @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="form-group">
        <label for="exampleInputPassword1">{{ __('Password') }}</label>
        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" />

        @error('password')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="form-group">
        <label for="exampleInputPassword1">{{ __('Confirm Password') }}</label>
        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" />
    </div>

    <div class="mt-3">
        <button type="button" id="reset-btn" class="btn btn-primary mr-2 mb-2 mb-md-0 text-white">{{ __('Reset Password') }}</button>
    </div>
</form>
@endsection
