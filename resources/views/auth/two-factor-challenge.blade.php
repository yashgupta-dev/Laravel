@extends('layouts.auth')

@section('content')
<div class="page-content">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Please confirm access to your account by entering the authentication code provided by your authenticator application.') }}</div>

                    <div class="card-body">
                    {{ __('Please confirm access to your account by entering one of your emergency recovery codes.') }}

                        <form method="POST" action="{{ route('two-factor.login') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="code" class="col-md-4 col-form-label text-md-right">{{ __('code') }}</label>

                                <div class="col-md-6">
                                    <input id="code" type="code" class="form-control @error('code') is-invalid @enderror" name="code" required autocomplete="current-code">

                                    @error('code')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('login') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
