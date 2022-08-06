@extends('layouts.auth')
  @section('content')
                                            <h5 class="text-muted font-weight-normal mb-4">{{ __('Reset Password') }}</h5>

                                            @if (session('status'))
                                            <div class="mt-2 alert alert-success" role="alert">
                                                {{ session('status') }}
                                            </div>
                                            @endif
                                            <form class="forms-sample" id="forget-form" method="POST" action="{{ route('password.email') }}">
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

                                                <div class="mt-3">
                                                    <button type="button" id="forget-btn" class="btn btn-primary mr-2 mb-2 mb-md-0 text-white">{{ __('Send Password Reset Link') }}</button>
                                                </div>

                                                <a class="d-block mt-3 text-muted" href="/">
                                                    <small> {{ __('back to sign-in') }}</small>
                                                </a>
                                            </form>
@endsection