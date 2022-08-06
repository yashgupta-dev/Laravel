@extends('layouts.my')
@section('content')
<div class="page-content">
    <div class="profile-page tx-13">
        <div class="row">
        	
            <div class="col-12 grid-margin">
				<div class="profile-header">
					<div class="cover">
            		<?php $rand = rand(0,9);?>
						<div class="" style="height: 40vh;background-image: linear-gradient(to right, #ab3c3c26,#7f9cf552),url('{{ asset('logo/pattern/pattern_'.$rand.'.png') }}');width: 100%;background-position: center;background-size: contain;"></div>
						<div class="cover-body d-flex justify-content-between align-items-center">
							<div>
							@if(!in_array(Auth::user()->profile,['0','1','2','3','4']))
	                    		<img class="profile-pic" src="{{ asset('storage') }}/profile/{{ explode('/',Auth::user()->profile)[2] }}" alt="{{ Auth::user()->name }}" style="width:80px; height:80px;object-fit: cover;">
							@else
								<img class="profile-pic" src="{{ asset('logo') }}/{{ Auth::user()->profile }}.png" alt="{{ Auth::user()->name }}"style="width:80px; height:80px;object-fit: cover;">
							@endif
							
								<span class="profile-name" style="background: #ffffffeb;padding: 10px;border-radius: 35px;">{{ Auth::user()->name }}</span>
							</div>
						</div>
					</div>
					<div class="header-links">
						<ul class="links d-flex align-items-center mt-3 mt-md-0">
							<li class="header-link-item ml-3 pl-3  text-dark d-flex align-items-center active">
								<i class="mr-1 icon-md" data-feather="activity"></i>
								<a class="pt-1px d-none d-md-block" href="javascript:;">Manage Profile</a>
							</li>
						</ul>
					</div>
            	</div>
            </div>
        </div>
        <div class="row profile-body">
		<!-- left wrapper start -->
		@if(config('settings.config_profile_edit'))
			<div class="col-md-12">
				<div class="row">
					<div class="col-md-12">
						<div class="row">
							<div class="col-md-4">
								<h3 class="text-lg font-weight-light text-dark">Profile Information</h3>
								<p class="mt-1 text-sm text-gray-600">
						            Update your account&#039;s profile information and email address.
						        </p>
						    </div>
							<div class="col-md-8">
								<form class="form-profile" method="post" enctype="multipart/form-data" action="{{ route('profile.update') }}">
									<div class="card">
										<div class="card-body">
										<div class="row">
											<div class="col-md-10">
												<div class="mb-3">
													<p>Photo</p>
													@csrf
													<div class="form-group" id="fit-image">
													@if(!in_array(Auth::user()->profile,['0','1','2','3','4']))
														<img onclick="document.getElementById('profile').click();" id="profileImg" src="{{ asset('storage') }}/profile/{{ explode('/',Auth::user()->profile)[2] }}" alt="{{ Auth::user()->name }}">
													@else
														<img onclick="document.getElementById('profile').click();" class="profile-pic" id="profileImg" src="{{ asset('logo') }}/{{ Auth::user()->profile }}.png" alt="{{ Auth::user()->name }}">
													@endif
													
														<div class="camera">
															<i class="fa fa-camera"></i>
														</div>
														<input type="file" name="profile" class="d-none" id="profile">
													</div>
													<div class="f-flex justify-content-between">
													@if(!in_array(Auth::user()->profile,['0','1','2','3','4']))
														<a href="{{ route('delete-photo') }}" id="removeBackground" class="mt-1 btn btn-danger">REMOVE PHOTO</a>
														@endif
													</div>
													@if(!empty($errors->first('profile')))
						                                <div class="mt-1">
						                                    <small class="text-danger"><strong>{{ $errors->first('profile') }}</strong></small>
						                                </div>
						                            @endif
											
												</div>
											</div>
										</div>
										<div class="form-group">
											<label for="name">Name</label>
											<input type="text" name="name" class="form-control @if(!empty($errors->first('name'))) is-invalid  @endif" value="@if(!empty(old('name'))){{ old('name') }}@else{{ Auth::user()->name }}@endif">
											@if(!empty($errors->first('name')))
			                                <div class="">
			                                    <small class="text-danger">{{ $errors->first('name') }}</small>
			                                </div>
			                                @endif
										</div>
										<div class="form-group">
											<label for="email">Email</label>
											<input type="email" name="email" class="form-control @if(!empty($errors->first('email'))) is-invalid  @endif" value="@if(!empty(old('email'))){{ old('email')}}@else{{ Auth::user()->email }}@endif">
											@if(!empty($errors->first('email')))
			                                <div class="">
			                                    <small class="text-danger">{{ $errors->first('email') }}</small>
			                                </div>
			                                @endif
										</div>
										<div class="form-group">
											<label for="phone">Phone</label>
											<input type="text" name="phone" class="form-control @if(!empty($errors->first('phone'))) is-invalid  @endif" value="@if(!empty(old('phone'))){{ old('phone')}}@else{{Auth::user()->phone}}@endif">
											@if(!empty($errors->first('phone')))
			                                <div class="">
			                                    <small class="text-danger">{{ $errors->first('phone') }}</small>
			                                </div>
			                                @endif
										</div>
										</div>
										<div class="card-footer bg-light">
											<button class="btn btn-dark" type="button" id="check_submit">SAVE</button>
											<span class="text-dark ml-2">
												<strong>
												@if(!empty($errors->first('pok'))) {{ $errors->first('pok') }} @endif
												</strong>
											</span>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		@endif
		@if(config('settings.config_password_edit'))
			<!-- password update  -->
			<div class="col-md-12 border mt-5 mb-5"></div>
			<div class="col-md-12">
				<div class="row">
					<div class="col-md-12">
						<div class="row">
							<div class="col-md-4">
								<h3 class="text-lg font-weight-light text-dark">Update Password</h3>
								<p class="mt-1 text-sm text-gray-600">
						            Ensure your account is using a long, random password to stay secure.
						        </p>
						    </div>
							<div class="col-md-8">
								<form class="form-password" method="post" action="{{ route('profile.password.edit') }}">
									<div class="card">
										<div class="card-body">
										
											<div class="form-group">
												@csrf
												<label for="name">Current Password</label>
												<input type="password" name="current_password" class="form-control @if(!empty($errors->first('current_password'))) is-invalid  @endif">
												@if(!empty($errors->first('current_password')))
				                                <div class="">
				                                    <small class="text-danger">{{ $errors->first('current_password') }}</small>
				                                </div>
				                                @endif
											</div>
											<div class="form-group">
												<label for="password">New Password</label>
												<input type="password" name="password" class="form-control @if(!empty($errors->first('password'))) is-invalid  @endif" autocomplete="new-password">
												@if(!empty($errors->first('password')))
				                                <div class="">
				                                    <small class="text-danger">{{ $errors->first('password') }}</small>
				                                </div>
				                                @endif
											</div>
											<div class="form-group">
												<label for="password_confirmation">Confirm Password</label>
												<input type="password" name="password_confirmation" class="form-control" autocomplete="new-password">
												
											</div>
										</div>
										<div class="card-footer bg-light">
											<button class="btn btn-dark" type="button" id="check_submitPassword">PASSWORD UPDATE</button>
												<span class="text-dark ml-2">
													<strong>
													@if(!empty($errors->first('ps'))) {{ $errors->first('ps') }} @endif
													</strong>
												</span>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		@endif
		@if(config('settings.config_two_way_authentication'))
			<!-- two way auth -->
			<div class="col-md-12 border mt-5 mb-5"></div>
			<div class="col-md-12">
				<div class="row">
					<div class="col-md-12">
						<div class="row">
							<div class="col-md-4">
								<h3 class="text-lg font-weight-light text-dark">{{ __('Two Factor Authentication') }}</h3>
								<p class="mt-1 text-sm text-gray-600">
								{{ __('Add additional security to your account using two factor authentication.') }}
						        </p>
						    </div>
							<style>
								.text-lg {
										font-size: 1.125rem;
									}
									.font-medium {
										font-weight: 500;
									}
									.text-gray-900 {
										--text-opacity: 1;
										color: #161e2e;
										color: rgba(22, 30, 46, var(--text-opacity));
									}
									.font-medium {
										font-weight: 500;
									}
									.font-semibold {
										font-weight: 600;
									}
									.max-w-xl {
										max-width: 36rem;
									}
									.font-mono {
										font-family: Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
									}
									.grid {
										display: grid;
									}
									.gap-1 {
										grid-gap: 0.25rem;
										gap: 0.25rem;
									}
									.bg-gray-100 {
										--bg-opacity: 1;
										background-color: #f4f5f7;
										background-color: rgba(244, 245, 247, var(--bg-opacity));
									}
									.rounded-lg {
										border-radius: 0.5rem;
									}
							</style>
							<div class="col-md-8">
								<form class="form-password" method="post" action="{{ route('two-factor.enable') }}">
									<div class="card">
										<div class="card-body">
											<h3 class="text-lg font-medium text-gray-900">
												@if (Auth::user()->two_factor_secret)
													{{ __('You have enabled two factor authentication.') }}
												@else
													{{ __('You have not enabled two factor authentication.') }}
												@endif
											</h3>
											<div class="mt-3 max-w-xl text-sm text-gray-600">
												<p>
													{{ __('When two factor authentication is enabled, you will be prompted for a secure, random token during authentication. You may retrieve this token from your phone\'s Google Authenticator application.') }}
												</p>
											</div>
											<div class="mt-2">
											@if (Auth::user()->two_factor_secret)
											<div class="mt-4 max-w-xl text-sm text-gray-600">
												<p class="font-semibold">
													{{ __('Two factor authentication is now enabled. Scan the following QR code using your phone\'s authenticator application.') }}
												</p>
											</div>
											<div class="mt-4">
												{!! Auth::user()->twoFactorQrCodeSvg() !!}
											</div>
												@if(Auth::user()->two_factor_recovery_codes)
												<div class="mt-4 max-w-xl text-sm text-gray-600">
													<p class="font-semibold">
														{{ __('Store these recovery codes in a secure password manager. They can be used to recover access to your account if your two factor authentication device is lost.') }}
													</p>
												</div>

												<div class="grid gap-1 max-w-xl mt-4 px-4 py-4 font-mono text-sm bg-gray-100 rounded-lg">
													@foreach (json_decode(decrypt(Auth::user()->two_factor_recovery_codes), true) as $code)
														<div>{{ $code }}</div>
													@endforeach
												</div>
												@endif
											@endif
											</div>
										</div>
										@csrf
										<div class="card-footer bg-light">
											@if (Auth::user()->two_factor_secret)
												@if (Auth::user()->two_factor_recovery_codes)
													@method('post')
													<button class="btn btn-info" type="submit" form="form_recovery_code">{{ __('Regenerate Recovery Codes') }}</button>
												@endif
												@method('delete')
												<button class="btn btn-danger" type="submit">{{ __('Disable') }}</button>
											@else
												<button class="btn btn-success" type="submit">{{ __('Enable') }}</button>
											@endif
										</div>
									</div>
								</form>
								<form method="post" action="{{ route('two-factor.recovery-codes') }}" id="form_recovery_code">@csrf</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		@endif
		@if(config('settings.config_other_devices'))
			<!-- browser session check -->
			<div class="col-md-12 border mt-5 mb-5"></div>
			<div class="col-md-12">
				<div class="row">
					<div class="col-md-12 mt-2">
						<div class="row">
							<div class="col-md-4">
								<h3 class="text-lg font-weight-light text-dark">Browser Sessions</h3>
								<p class="mt-1 text-sm text-gray-600">
						            Manage and logout your active sessions on other browsers and devices.
						        </p>
						    </div>
							<div class="col-md-8">
								<form class="form-logout" method="post" action="#">
									<div class="card">
										<div class="card-body">
											<p class="font-weight-light text-sm" style="font-size: 14px;">If necessary, you may logout of all of your other browser sessions across all of your devices. Some of your recent sessions are listed below; however, this list may not be exhaustive. If you feel your account has been compromised, you should also update your password.</p>

										@php($session = DB::table('sessions')->where('user_id',Auth::user()->id)->orderBy('id','desc')->get())
										@if(count($session) > 0)
										<div class="mt-4 space-y-6">
										    <!-- Other Browser Sessions -->
										    @foreach($session as $row)
										    <?php
										        $agent = new \Jenssegers\Agent\Agent;
   												$agent->setUserAgent($row->user_agent);
												
										    ?>
										    <div class="d-flex mb-3">
										        <div>
										        	@if($agent->isDesktop())
										        	<svg fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor" class="w-8 h-8 text-gray">
										                <path d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
										            </svg>
										        	@else
										        	<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" class="w-8 h-8 text-gray">
                                    					<path d="M0 0h24v24H0z" stroke="none"></path><rect x="7" y="4" width="10" height="16" rx="1"></rect><path d="M11 5h2M12 17v.01"></path>
                                					</svg>
										        	@endif
										            
										        </div>

										        <div class="ml-3">
										            <div class="text-sm text-gray" style="font-family: system-ui;">
										            	{{ $agent->platform() }} - {{ $agent->browser() }}
										            </div>
										            <div>
										                <div class="text-xs text-gray" style="font-family: system-ui;">
										                    {{ $row->ip_address }},

										                    @php($now = \Session::getId())
										                    @if($now == $row->id)
										                    <span class="text-success font-semibold">
										                    	This Device
										                    </span>
										                    @else
										                    {{ __('Last active') }} 
										                    
										                    @endif

										                </div>
										            </div>
										        </div>
										    </div>
										    @endforeach
										    
										</div>

										

										</div>
										<div class="card-footer bg-light">
											<button class="btn btn-dark" type="button">LOGOUT OTHER BROWSER SESSIONS</button>
										</div>
										@endif
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		@endif					
    </div>
</div>
@include('layouts.footer')
@endsection
