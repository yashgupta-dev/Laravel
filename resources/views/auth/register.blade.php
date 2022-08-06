@extends('layouts.auth')
  @section('content')
                <h5 class="text-muted font-weight-normal mb-4">{{ __('Create new account')}}</h5>
                    <form class="forms-sample" id="register-form" method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">{{ __('Name') }}</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus />

                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">{{ __('E-Mail Address') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" />

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">{{ __('Phone') }}</label>
                            <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="off" />

                            @error('phone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">{{ __('Password') }}</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" />

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">{{ __('Confirm Password') }}</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" />
                        </div>

                        <div class="mt-3">
                            <button type="button" id="register-btn" class="btn btn-primary mr-2 mb-2 mb-md-0 text-white">{{ __('Sign up') }}</button>
                        </div>

                        <a class="d-block mt-2 text-muted" href="{{ route('login') }}">
                            <small>{{ __('I have an account ? sign-in') }}</small>
                        </a>
                    </form>
                
  @endsection