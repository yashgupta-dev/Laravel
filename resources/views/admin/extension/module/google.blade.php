@extends('admin.layouts.my')
@section('content')
<div class="page-content">
    <div class="profile-page tx-13">
        <div class="row">
            <div class="col-md-12">
                <nav class="page-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">{{ __('Home') }}</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.web.setting.configration') }}">{{ __('Extension') }} </a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ __('google.title') }}</li>
                    </ol>
                </nav>
            </div>
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8"><h6 class="card-title">{{ __('google.title') }}</h6></div>
                            <div class="col-md-4">
                                <div class="d-flex justify-content-space-between">
                                    <button type="submit" form-id="form-category" class="btn btn-primary ml-1"><i class="fa fa-save"></i> {{  __('global.save') }}</button>
                                    <a href="{{ route('admin.web.setting.configration') }}" class="btn btn-danger ml-1"><i class="fa fa-undo"></i> {{  __('global.back') }}</a>
                                </div>
                            </div>
                        </div>
						<div class="table-responsive mt-2">
                            @if(!empty($errors->first('message')))
                            <div class="alert {{ $errors->first('alert') }} alert-dismissible fade show" role="alert">
                                <strong>{{ $errors->first('title') }}</strong> {{ $errors->first('message') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @endif
                            <div class="alert alert-info alert-dismissible fade show" role="alert">
                            <strong>{{ __('global.info') }}</strong> {!! __('google.info') !!}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{ route('admin.extension.module.google.edit') }}" method="post" enctype="multipart/form-data" id="form-category" class="form-horizontal">
                                @csrf
                                <div class="form-group">                                    
                                    <label for="btn-text" class="">{{ old('google_module_status') }} {{ __('google.text_status') }}</label>
                                    <select name="google_module_status" id="google_module_status" class="form-control @if(!empty($errors->first('google_module_status'))) is-invalid @endif">
                                        @if(old('google_module_status'))

                                        <option value="0" @if($data['google_module_status'] == 0) selected @endif>{{ __('google.text_disable') }}</option>
                                        <option value="1" @if($data['google_module_status'] == 1) selected @endif>{{ __('google.text_enable') }}</option>
                                        @else
                                        <option value="0" @if($data['google_module_status'] == 0) selected @endif>{{ __('google.text_disable') }}</option>
                                        <option value="1" @if($data['google_module_status'] == 1) selected @endif>{{ __('google.text_enable') }}</option>
                                        @endif
                                    </select>
                                    @if(!empty($errors->first('google_module_status')))
                                    <div class="">
                                        <small class="text-danger">{{ $errors->first('google_module_status') }}</small>
                                    </div>
                                    @endif
                                </div>
                                <div class="form-group">                                    
                                    <label for="btn-text" class="">{{ __('google.text_api_key') }} <span class="text-danger">*</span></label>
                                    <input type="text" name="google_module_api_key" value="@if(empty(old('google_module_api_key'))){{ $data['google_module_api_key'] }}@else{{ old('google_module_api_key') }}@endif" id="google_module_api_key" class="form-control @if(!empty($errors->first('google_module_api_key'))) is-invalid @endif" placeholder="{{ __('google.text_api_key') }}">
                                    @if(!empty($errors->first('google_module_api_key')))
                                    <div class="">
                                        <small class="text-danger">{{ $errors->first('google_module_api_key') }}</small>
                                    </div>
                                    @endif
                                </div>
                                <div class="form-group">                                    
                                    <label for="btn-text" class="">{{ __('google.btn_text') }} <span class="text-danger">*</span></label>
                                    <input type="text" name="google_module_title" value="@if(empty(old('google_module_title'))){{ $data['google_module_title'] }}@else{{ old('google_module_title') }}@endif" id="google_module_title" class="form-control @if(!empty($errors->first('google_module_title'))) is-invalid @endif" placeholder="{{ __('google.title_placeholder') }}">
                                    @if(!empty($errors->first('google_module_title')))
                                    <div class="">
                                        <small class="text-danger">{{ $errors->first('google_module_title') }}</small>
                                    </div>
                                    @endif
                                </div>
                                <div class="form-group">                                    
                                    <label for="btn-text" class="">{{ __('google.client') }} <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @if(!empty($errors->first('google_module_client_id'))) is-invalid @endif" value="@if(empty(old('google_module_client_id'))){{ $data['google_module_client_id'] }}@else{{ old('google_module_client_id') }}@endif" name="google_module_client_id" id="google_module_client_id" placeholder="{{ __('google.client') }}">
                                    @if(!empty($errors->first('google_module_client_id')))
                                    <div class="">
                                        <small class="text-danger">{{ $errors->first('google_module_client_id') }}</small>
                                    </div>
                                    @endif
                                </div>
                                <div class="form-group">                                    
                                    <label for="btn-text" class="">{{ __('google.secret') }} <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @if(!empty($errors->first('google_module_client_secret_id'))) is-invalid @endif" value="@if(empty(old('google_module_client_secret_id'))){{ $data['google_module_client_secret_id'] }}@else{{ old('google_module_client_secret_id') }}@endif" name="google_module_client_secret_id" id="google_module_client_secret_id" placeholder="{{ __('google.secret') }}">
                                    @if(!empty($errors->first('google_module_client_secret_id')))
                                    <div class="">
                                        <small class="text-danger">{{ $errors->first('google_module_client_secret_id') }}</small>
                                    </div>
                                    @endif
                                </div>
                                <div class="form-group">                                    
                                    <label for="btn-text" class="">{{ __('google.redirect') }} <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @if(!empty($errors->first('google_module_redirect_url'))) is-invalid @endif" value="@if(empty(old('google_module_redirect_url'))){{ $data['google_module_redirect_url'] }}@else{{ old('google_module_redirect_url') }}@endif" name="google_module_redirect_url" id="google_module_redirect_url" placeholder="{{ __('google.redirect') }}">
                                    @if(!empty($errors->first('google_module_redirect_url')))
                                    <div class="">
                                        <small class="text-danger">{{ $errors->first('google_module_redirect_url') }}</small>
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

@include('layouts.footer')

@endsection
@section('myscript')
@endsection