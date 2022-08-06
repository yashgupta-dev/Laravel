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
							@if(!empty($errors->first('er')))
							<div class="alert alert-warning alert-dismissible fade show" role="alert">
							  <strong>Report!</strong> {{ $errors->first('er')}}
							  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
							    <span aria-hidden="true">&times;</span>
							  </button>
							</div>
							@endif
							
							<div class="form-create mt-3" id="install">
								@php($site = App\Models\Site::where('panelId',0)->first())
								@if(empty($site))
								<form action="{{ route('setup.finshing.installing') }}" method="post" enctype="multipart/form-data">
									<div class="form-group">
										<label class="font-weight-bold">Domain Name</label>
										<input type="text" class="form-control" value="{{ $_SERVER['SERVER_NAME'] }}" readonly>
									</div>
									
									<div class="form-group">
										<label class="font-weight-bold">Your Site Title</label>
										<input type="text" name="title" value="{{ old('title') }}" class="form-control @if(!empty($errors->first('title'))) is-invalid @endif" placeholder="site title" required>		
										@if(!empty($errors->first('title')))
										<div>
											<small class="text-danger">
												<strong>
													{{ $errors->first('title') }}
												</strong>
											</small>
										</div>
										@endif
									</div>
									@csrf
									<div class="ml-2 mr-2 d-flex justify-content-between">
										<div>
											<img onclick="document.getElementById('profile').click();" id="favicon" src="{{ asset('logo/placeholder/placeholder.jpg') }}" alt="favicon" style="width: 100px;height: 100px;object-fit: contain;border-radius: 100px;   @if(!empty($errors->first('favicon'))) border:1px solid red; @endif background: #dde;" class="img-thumbnail">
											<input type="file" name="favicon" class="d-none" data-type="favicon" id="profile">
										</div>

										<div>
											<img onclick="document.getElementById('logoclick').click();" id="logo" src="{{ asset('logo/placeholder/placeholder.jpg') }}" alt="logo" style="width: 100px;height: 100px;object-fit: contain;border-radius: 100px;background: #dde; @if(!empty($errors->first('logo'))) border:1px solid red; @endif " class="img-thumbnail">
											<input type="file" name="logo" class="d-none" data-type="logo" id="logoclick">
										</div>
									</div>
									<div class="border-top mb-1 mt-3"></div>
									<div class="form-group text-center">
										<button class="btn btn-dark btn-block btn-md" type="button" id="submit_btn" style="border-radius: 20px;">SETUP INSTALL</button>
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
									@php($site = App\Models\Admin::first())
									@if(empty($site) && !$site)
										<div class="text-center">
											<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
										</div>
										<script>window.location = "/setup/finish";</script>
									@endif
								@endif
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	@endsection