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
                        <li class="breadcrumb-item active" aria-current="page">{{ __('facebook.title') }}</li>
                    </ol>
                </nav>
            </div>
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8"><h6 class="card-title">{{ __('facebook.title') }}</h6></div>
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
                            <strong>{{ __('global.info') }}</strong> {!! __('facebook.info') !!}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{ route('admin.extension.module.facebook.edit') }}" method="post" enctype="multipart/form-data" id="form-category" class="form-horizontal">
                                @csrf
                                <div class="form-group">                                    
                                    <label for="btn-text" class="">{{ __('facebook.text_status') }}</label>
                                    <select name="facebook_module_status" id="facebook_module_status" class="form-control @if(!empty($errors->first('facebook_module_status'))) is-invalid @endif">
                                        @if(empty(old('facebook_module_status')))
                                        <option value="0" @if($data['facebook_module_status'] == 0) selected @endif>{{ __('facebook.text_disable') }}</option>
                                        <option value="1" @if($data['facebook_module_status'] == 1) selected @endif>{{ __('facebook.text_enable') }}</option>
                                        @else
                                        <option value="0" @if(old('facebook_module_status') == 0) selected @endif>{{ __('facebook.text_disable') }}</option>
                                        <option value="1" @if(old('facebook_module_status') == 1) selected @endif>{{ __('facebook.text_enable') }}</option>
                                        @endif
                                    </select>
                                    @if(!empty($errors->first('facebook_module_status')))
                                    <div class="">
                                        <small class="text-danger">{{ $errors->first('facebook_module_status') }}</small>
                                    </div>
                                    @endif
                                </div>
                                <div class="form-group">                                    
                                    <label for="btn-text" class="">{{ __('facebook.btn_text') }} <span class="text-danger">*</span></label>
                                    <input type="text" name="facebook_module_title" value="@if(empty(old('facebook_module_title'))){{ $data['facebook_module_title'] }}@else{{ old('facebook_module_title') }}@endif" id="facebook_module_title" class="form-control @if(!empty($errors->first('facebook_module_title'))) is-invalid @endif" placeholder="{{ __('facebook.title_placeholder') }}">
                                    @if(!empty($errors->first('facebook_module_title')))
                                    <div class="">
                                        <small class="text-danger">{{ $errors->first('facebook_module_title') }}</small>
                                    </div>
                                    @endif
                                </div>
                                <div class="form-group">                                    
                                    <label for="btn-text" class="">{{ __('facebook.client') }} <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @if(!empty($errors->first('facebook_module_client_id'))) is-invalid @endif" value="@if(empty(old('facebook_module_client_id'))){{ $data['facebook_module_client_id'] }}@else{{ old('facebook_module_client_id') }}@endif" name="facebook_module_client_id" id="facebook_module_client_id" placeholder="{{ __('facebook.client') }}">
                                    @if(!empty($errors->first('facebook_module_client_id')))
                                    <div class="">
                                        <small class="text-danger">{{ $errors->first('facebook_module_client_id') }}</small>
                                    </div>
                                    @endif
                                </div>
                                <div class="form-group">                                    
                                    <label for="btn-text" class="">{{ __('facebook.secret') }} <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @if(!empty($errors->first('facebook_module_client_secret_id'))) is-invalid @endif" value="@if(empty(old('facebook_module_client_secret_id'))){{ $data['facebook_module_client_secret_id'] }}@else{{ old('facebook_module_client_secret_id') }}@endif" name="facebook_module_client_secret_id" id="facebook_module_client_secret_id" placeholder="{{ __('facebook.secret') }}">
                                    @if(!empty($errors->first('facebook_module_client_secret_id')))
                                    <div class="">
                                        <small class="text-danger">{{ $errors->first('facebook_module_client_secret_id') }}</small>
                                    </div>
                                    @endif
                                </div>
                                <div class="form-group">                                    
                                    <label for="btn-text" class="">{{ __('facebook.redirect') }} <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @if(!empty($errors->first('facebook_module_redirect_url'))) is-invalid @endif" value="@if(empty(old('facebook_module_redirect_url'))){{ $data['facebook_module_redirect_url'] }}@else{{ old('facebook_module_redirect_url') }}@endif" name="facebook_module_redirect_url" id="facebook_module_redirect_url" placeholder="{{ __('facebook.redirect') }}">
                                    @if(!empty($errors->first('facebook_module_redirect_url')))
                                    <div class="">
                                        <small class="text-danger">{{ $errors->first('facebook_module_redirect_url') }}</small>
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