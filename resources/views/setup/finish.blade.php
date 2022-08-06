@extends('layouts/guest')
	@section('content')
		<div class="container" style="margin-top: 60px;">
			<div class="row">
				<div class="offset-md-4 col-md-4">
					<div class="card" style="box-shadow: 1px 1px 11px 2px #dde">
						<div class="card-head bg-dark">
							<div class="logo1 text-center">
								<img src="{{ asset('logo/logo.png') }}" style="object-fit: contain;">
								<!-- <p>AV <span class="text-info">Digietech</span></p> -->
							</div>
						</div>
						<div class="card-body">
							@if(!empty($errors->first('favicon')) || !empty($errors->first('logo')))
							<div class="alert alert-warning alert-dismissible fade show" role="alert">
							  <strong>Report!</strong> {{ $errors->first('favicon')}} OR {{ $errors->first('logo')}}
							  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
							    <span aria-hidden="true">&times;</span>
							  </button>
							</div>
							@endif
							<div class="form-create mt-3" id="setup">
							@php($site = App\Models\Site::where('panelId',0)->first())
							@if(!empty($site))
								@php($site = App\Models\Admin::first())
								@if(empty($site) && !$site)
								<form class="forms-sample" method="POST" action="{{ route('setup.register') }}">
                      			@csrf
			                      <div class="form-group">
			                        <label for="exampleInputEmail1">{{ __('Name') }}</label>
			                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

			                                @error('name')
			                                    <span class="invalid-feedback" role="alert">
			                                        <strong>{{ $message }}</strong>
			                                    </span>
			                                @enderror
			                      </div>
                      
			                      <div class="form-group">
			                        <label for="exampleInputEmail1">{{ __('E-Mail Address') }}</label>
			                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

			                                @error('email')
			                                    <span class="invalid-feedback" role="alert">
			                                        <strong>{{ $message }}</strong>
			                                    </span>
			                                @enderror
			                      </div>

			                      <div class="form-group">
			                        <label for="exampleInputEmail1">{{ __('Phone') }}</label>
			                        <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="off">

			                                @error('phone')
			                                    <span class="invalid-feedback" role="alert">
			                                        <strong>{{ $message }}</strong>
			                                    </span>
			                                @enderror
			                      </div>

			                      <div class="form-group">
			                        <label for="exampleInputEmail1">{{ __('Password') }}</label>
			                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

			                                @error('password')
			                                    <span class="invalid-feedback" role="alert">
			                                        <strong>{{ $message }}</strong>
			                                    </span>
			                                @enderror
			                      </div>

			                      <div class="form-group">
			                        <label for="exampleInputEmail1">{{ __('Confirm Password') }}</label>
			                        <input type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">

			                      </div>
                      			  <div class="border-top mb-1 mt-3"></div>
									<div class="form-group text-center">
				                      <div class="mt-3">
				                        <button type="button" id="submit_btn" style="border-radius: 20px;" class="btn btn-dark mr-2 mb-2 mb-md-0 text-white">{{ __('FINISH SETUP') }}</button>
				                      </div>
                  					</div>
                  					<div class="border-top mb-1 mt-3"></div>
									<div class="row">
                                        <div class="col-md-12">
                                            <div class="text-center">
											<p><small class="text-muted">© 2020 All Rights Reserved by Digi Growth Solution</small></p>
        									</div>
                                        </div>
                                    </div>
                      
                    			</form>
								@else
								<div class="text-center">
									<p><strong>Setup allready installed!</strong></p>
									<a href="{{ url('/') }}" class="mt-1 btn btn-primary">Go To Home</a>
								</div>
								@endif
							@else
							<div class="text-center">
								<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
							</div>
							<script>window.location = "/setup/install";</script>
							@endif
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	@endsection