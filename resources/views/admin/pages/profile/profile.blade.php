@extends('admin.layouts.my')
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
							@if(!in_array(Auth::guard('admin')->user()->profile,['0','1','2','3','4']))
	                    		<img class="profile-pic" src="{{ asset('storage') }}/profile/{{ explode('/',Auth::guard('admin')->user()->profile)[2] }}" alt="{{ Auth::guard('admin')->user()->name }}" style="width:80px; height:80px;object-fit: cover;">
							@else
								<img class="profile-pic" src="{{ asset('logo') }}/{{ Auth::guard('admin')->user()->profile }}.png" alt="{{ Auth::guard('admin')->user()->name }}"style="width:80px; height:80px;object-fit: cover;">
							@endif
							
								<span class="profile-name" style="background: #ffffffeb;padding: 10px;border-radius: 35px;">{{ Auth::guard('admin')->user()->name }}</span>
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
								<form class="form-profile" method="post" enctype="multipart/form-data" action="{{ route('admin.profile.update') }}">
									<div class="card">
										<div class="card-body">
										<div class="row">
											<div class="col-md-10">
												<div class="mb-3">
													<p>Photo</p>
													@csrf
													<div class="form-group" id="fit-image">
													@if(!in_array(Auth::guard('admin')->user()->profile,['0','1','2','3','4']))
														<img onclick="document.getElementById('profile').click();" id="profileImg" src="{{ asset('storage') }}/profile/{{ explode('/',Auth::guard('admin')->user()->profile)[2] }}" alt="{{ Auth::guard('admin')->user()->name }}">
													@else
														<img onclick="document.getElementById('profile').click();" class="profile-pic" id="profileImg" src="{{ asset('logo') }}/{{ Auth::guard('admin')->user()->profile }}.png" alt="{{ Auth::guard('admin')->user()->name }}">
													@endif
													
														<div class="camera">
															<i class="fa fa-camera"></i>
														</div>
														<input type="file" name="profile" class="d-none" id="profile">
													</div>
													<div class="f-flex justify-content-between">
													@if(!in_array(Auth::guard('admin')->user()->profile,['0','1','2','3','4']))
														<a href="{{ route('admin.delete-photo') }}" id="removeBackground" class="mt-1 btn btn-danger">REMOVE PHOTO</a>
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
											<input type="text" name="name" class="form-control @if(!empty($errors->first('name'))) is-invalid  @endif" value="@if(!empty(old('name'))){{ old('name') }}@else{{ Auth::guard('admin')->user()->name }}@endif">
											@if(!empty($errors->first('name')))
			                                <div class="">
			                                    <small class="text-danger">{{ $errors->first('name') }}</small>
			                                </div>
			                                @endif
										</div>
										<div class="form-group">
											<label for="email">Email</label>
											<input type="email" name="email" class="form-control @if(!empty($errors->first('email'))) is-invalid  @endif" value="@if(!empty(old('email'))){{ old('email')}}@else{{ Auth::guard('admin')->user()->email }}@endif">
											@if(!empty($errors->first('email')))
			                                <div class="">
			                                    <small class="text-danger">{{ $errors->first('email') }}</small>
			                                </div>
			                                @endif
										</div>
										<div class="form-group">
											<label for="phone">Phone</label>
											<input type="text" name="phone" class="form-control @if(!empty($errors->first('phone'))) is-invalid  @endif" value="@if(!empty(old('phone'))){{ old('phone')}}@else{{Auth::guard('admin')->user()->phone}}@endif">
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
								<form class="form-password" method="post" action="{{ route('admin.profile.password.edit') }}">
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

										@php($session = DB::table('sessions')->where('admin_user_id',Auth::guard('admin')->user()->id)->orderBy('id','desc')->get())
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
    </div>
</div>
@include('layouts.footer')

@endsection
