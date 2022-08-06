@extends('admin.layouts.my')
@section('content')
@php($site=App\Models\Site::where('panelId',0)->first())
<div class="page-content">
    <div class="profile-page tx-13">
        <div class="row">
            <div class="col-md-12">
                <nav class="page-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">{{ __('Home') }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ __('Setting') }}</li>
                    </ol>
                </nav>
            </div>
            
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8"><h6 class="card-title">{{ __('Setting') }}<h6></div>
                            <div class="col-md-4">
                                <div class="d-flex justify-content-end">
                                    <button type="submit" form="form-setting-form" data-toggle="tooltip" title="" data-original-title="Save" class="btn btn-primary ml-1"><i class="fa fa-save"></i></a>
                                </div>
                            </div>
                        </div>
                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab">{{ __('General') }}</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="pills-option-tab" data-toggle="pill" href="#pills-option" role="tab">{{ __('Option')}}</a>
                            </li>                            
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="pills-customer-tab" data-toggle="pill" href="#pills-customer" role="tab">{{ __('Customer Options')}}</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="pills-image-tab" data-toggle="pill" href="#pills-image" role="tab">{{ __('Image')}}</a>
                            </li>
                        </ul>
                        <form action="{{ route('admin.web.panel.setting.edit') }}" method="post" enctype="multipart/form-data" id="form-setting-form">
                            <div class="tab-content" id="pills-tabContent">

                                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                                    @csrf
                                    <div class="form-group ">
                                        <label for="input-url"><span data-toggle="tooltip" data-html="true" data-original-title="{{ __('global.info_url') }}">Store URL</span></label>
                                        <input type="text" name="config_site_url" value="@if(old('config_site_url')) {{ old('config_site_url') }} @else{{ config('settings.config_site_url') }}@endif" placeholder="Store URL" id="input-url" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="store_name">{{ __('Store Name') }} <span class="text-danger">*</span></label>  
                                        <input type="text" name="config_store_name" class="form-control" value="@if(old('config_store_name')){{ old('config_store_name') }}@else{{ config('settings.config_store_name') }}@endif" >
                                        @if(!empty($errors->first('config_store_name')))
                                        <div class="">
                                            <small class="text-danger">{{ $errors->first('config_store_name') }}</small>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="store_name">{{ __('Loader Type') }} <span class="text-danger">*</span></label>  
                                        <select name="config_loder_type" id="loder_type">
                                            <option value="text" @if(old('config_loder_type') == 'text') selected @endif @if(config('settings.config_loder_type') == 'text') selected @endif> {{ __('Text') }} </option>
                                            <option value="default"  @if(old('config_loder_type') == 'default') selected @endif @if(config('settings.config_loder_type') == 'default') selected @endif> {{ __('Default') }} </option>                                            
                                        </select>
                                        @if(!empty($errors->first('config_loder_type')))
                                        <div class="">
                                            <small class="text-danger">{{ $errors->first('config_loder_type') }}</small>
                                        </div>
                                        @endif
                                        
                                    </div>    
                                    
                                    <div class="text-loader"></div>
                                    <div class="class-error">
                                        @if(!empty($errors->first('config_loder_name')))
                                        <div class="">
                                            <small class="text-danger">{{ $errors->first('config_loder_name') }}</small>
                                        </div>
                                        @endif
                                        @if(!empty($errors->first('config_loder_color')))
                                        <div class="">
                                            <small class="text-danger">{{ $errors->first('config_loder_color') }}</small>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="store_name">{{ __('Pagination Per Page') }} <span class="text-danger">*</span></label>  
                                        <input type="text" name="config_pagination" class="form-control" value="@if(old('config_pagination')){{ old('config_pagination') }}@else{{ config('settings.config_pagination') }}@endif" >
                                        @if(!empty($errors->first('config_pagination')))
                                        <div class="">
                                            <small class="text-danger">{{ $errors->first('config_pagination') }}</small>
                                        </div>
                                        @endif
                                    </div>               
                                </div>
                                <div class="tab-pane fade" id="pills-option" role="tabpanel" aria-labelledby="pills-option-tab">
                                    <div class="form-group">
                                        <label for="btn-text" class="">{{ __('Default Role') }}</label>
                                        <select name="config_default_group" id="config_default_group" class="form-control">
                                            <option selected>{{ __('---- select role ----') }}</option>
                                            @if(count($data['roles']) > 0)
                                            @foreach($data['roles'] as $role)
                                            
                                            <option value="{{ $role->id }}" @if(old('config_default_group') == $role->id) selected @endif @if(config('settings.config_default_group') == $role->id) selected @endif>{{ $role->name }}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                        @if(!empty($errors->first('config_default_group')))
                                        <div class="">
                                            <small class="text-danger">{{ $errors->first('config_default_group') }}</small>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="btn-text" class="">{{ __('Which customer redirect dashboard?') }}</label>
                                        <select name="config_default_redirect" id="config_default_redirect" class="form-control">
                                            <option selected>{{ __('---- select role ----') }}</option>
                                            @if(count($data['roles']) > 0)
                                            @foreach($data['roles'] as $role)
                                            
                                            <option value="{{ $role->id }}" @if(old('config_default_redirect') == $role->id) selected @endif @if(config('settings.config_default_redirect') == $role->id) selected @endif>{{ $role->name }}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                        @if(!empty($errors->first('config_default_redirect')))
                                        <div class="">
                                            <small class="text-danger">{{ $errors->first('config_default_redirect') }}</small>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="form-group ">
                                        <label for="input-url">Mime Type</label>
                                        <input type="text" name="config_mime_type" value="@if(old('config_mime_type')){{ old('config_mime_type') }}@else{{ config('settings.config_mime_type') }}@endif" placeholder="Mime extension" class="form-control">
                                    </div>

                                    <div class="form-group ">
                                        <label for="input-url">Max Upload Size</label>
                                        <input type="text" name="config_max_upload_size" value="@if(old('config_max_upload_size')){{ old('config_max_upload_size') }}@else{{ config('settings.config_max_upload_size') }}@endif" placeholder="max upload size" class="form-control">
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="pills-customer" role="tabpanel" aria-labelledby="pills-customer-tab">
                                    <div class="form-group">
                                        <label for="btn-text" class="">{{ __('Profile Edit') }}</label>
                                        <select name="config_profile_edit" id="config_profile_edit" class="form-control">
                                            @if(!config('settings.config_profile_edit'))
                                            <option value="0" selected>{{ __('Disable') }}</option>
                                            <option value="1">{{ __('Enable') }}</option>
                                            @else 
                                            <option value="0">{{ __('Disable') }}</option>
                                            <option value="1" selected>{{ __('Enable') }}</option>
                                            @endif
                                        </select>
                                        @if(!empty($errors->first('config_profile_edit')))
                                        <div class="">
                                            <small class="text-danger">{{ $errors->first('config_profile_edit') }}</small>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="btn-text" class="">{{ __('Password Edit') }}</label>
                                        <select name="config_password_edit" id="config_password_edit" class="form-control">
                                            @if(!config('settings.config_password_edit'))
                                            <option value="0" selected>{{ __('Disable') }}</option>
                                            <option value="1">{{ __('Enable') }}</option>
                                            @else 
                                            <option value="0">{{ __('Disable') }}</option>
                                            <option value="1" selected>{{ __('Enable') }}</option>
                                            @endif
                                            
                                        </select>
                                        @if(!empty($errors->first('config_password_edit')))
                                        <div class="">
                                            <small class="text-danger">{{ $errors->first('config_password_edit') }}</small>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="btn-text" class="">{{ __('Two Way Auth') }}</label>
                                        <select name="config_two_way_authentication" id="config_two_way_authentication" class="form-control">
                                        @if(!config('settings.config_two_way_authentication'))
                                            <option value="0" selected>{{ __('Disable') }}</option>
                                            <option value="1">{{ __('Enable') }}</option>
                                            @else 
                                            <option value="0">{{ __('Disable') }}</option>
                                            <option value="1" selected>{{ __('Enable') }}</option>
                                            @endif
                                        </select>
                                        @if(!empty($errors->first('config_two_way_authentication')))
                                        <div class="">
                                            <small class="text-danger">{{ $errors->first('config_two_way_authentication') }}</small>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="btn-text" class="">{{ __('Other Devices Login') }}</label>
                                        <select name="config_other_devices" id="config_other_devices" class="form-control">
                                        @if(!config('settings.config_other_devices'))
                                            <option value="0" selected>{{ __('Disable') }}</option>
                                            <option value="1">{{ __('Enable') }}</option>
                                            @else 
                                            <option value="0">{{ __('Disable') }}</option>
                                            <option value="1" selected>{{ __('Enable') }}</option>
                                            @endif
                                        </select>
                                        @if(!empty($errors->first('config_other_devices')))
                                        <div class="">
                                            <small class="text-danger">{{ $errors->first('config_other_devices') }}</small>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="btn-text" class="">{{ __('Customer Ticket System')}}</label>
                                        <select name="config_ticket_support_panel" id="config_ticket_support_panel" class="form-control">
                                        @if(!config('settings.config_ticket_support_panel'))
                                            <option value="0" selected>{{ __('Disable') }}</option>
                                            <option value="1">{{ __('Enable') }}</option>
                                            @else 
                                            <option value="0">{{ __('Disable') }}</option>
                                            <option value="1" selected>{{ __('Enable') }}</option>
                                            @endif
                                        </select>
                                        @if(!empty($errors->first('config_ticket_support_panel')))
                                        <div class="">
                                            <small class="text-danger">{{ $errors->first('config_ticket_support_panel') }}</small>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="btn-text" class="">{{ __('Account Create') }}</label>
                                        <select name="config_account_create" id="config_account_create" class="form-control">
                                        @if(!config('settings.config_account_create'))
                                            <option value="0" selected>{{ __('Disable') }}</option>
                                            <option value="1">{{ __('Enable') }}</option>
                                            @else 
                                            <option value="0">{{ __('Disable') }}</option>
                                            <option value="1" selected>{{ __('Enable') }}</option>
                                            @endif
                                        </select>
                                        @if(!empty($errors->first('config_account_create')))
                                        <div class="">
                                            <small class="text-danger">{{ $errors->first('config_account_create') }}</small>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="btn-text" class="">{{ __('Password Forget') }}</label>
                                        <select name="config_password_forget" id="config_account_create" class="form-control">
                                        @if(!config('settings.config_password_forget'))
                                            <option value="0" selected>{{ __('Disable') }}</option>
                                            <option value="1">{{ __('Enable') }}</option>
                                            @else 
                                            <option value="0">{{ __('Disable') }}</option>
                                            <option value="1" selected>{{ __('Enable') }}</option>
                                            @endif
                                        </select>
                                        @if(!empty($errors->first('config_password_forget')))
                                        <div class="">
                                            <small class="text-danger">{{ $errors->first('config_password_forget') }}</small>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="btn-text" class="">{{ __('Customer Login') }}</label>
                                        <select name="config_user_account_login" id="config_user_account_login" class="form-control">
                                        @if(!config('settings.config_user_account_login'))
                                            <option value="0" selected>{{ __('Disable') }}</option>
                                            <option value="1">{{ __('Enable') }}</option>
                                            @else 
                                            <option value="0">{{ __('Disable') }}</option>
                                            <option value="1" selected>{{ __('Enable') }}</option>
                                            @endif
                                        </select>
                                        @if(!empty($errors->first('config_user_account_login')))
                                        <div class="">
                                            <small class="text-danger">{{ $errors->first('config_user_account_login') }}</small>
                                        </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="pills-image" role="tabpanel" aria-labelledby="pills-image-tab">
                                    <style type="text/css">
                                        img.img-fluid.logo-view {
                                            position: absolute;
                                            width: 185px;
                                            height: 40px;
                                            left: 0px;
                                            object-fit: contain;
                                        }
                                        img#faviconImg{
                                            position: absolute;
                                            width: 15px;
                                            height: 14px;
                                            left: 24px;
                                            object-fit: contain;
                                            top: 5px;
                                        }
                                    </style>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <img src="{{ asset('storage')}}/logo/0/{{explode('/',$site->logo)[3]}}" id="logoimage" onclick="document.getElementById('logoChnage').click();" class="img-fluid logo-view" style="background-color: #fff;">
                                            <input type="file" id="logoChnage" name="logochange" data-type="logoimage|{{ route('admin.logo') }}" class="d-none">
                                            <img src="{{ asset('logo/placeholder/logo.png') }}" class="img-fluid" style="object-fit: contain; width: 100%;">
                                            <div class="mt-5 border-top">
                                                <p>How to change Logo?</p>
                                                <ul>
                                                    <li>Click on logo place.</li>
                                                    <li>Select image, image must be in png, jpeg, jpg.</li>
                                                    <li>Then, click open button, and relax your logo uploading start.</li>
                                                    <li>Logo change success.</li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <img src="{{ asset('storage')}}/logo/0/favicon/{{explode('/',$site->favicon)[4]}}" id="faviconImg" onclick="document.getElementById('logoChnage1').click();" class="img-fluid logo-view1" style="background-color: #fff;">
                                            <input type="file" id="logoChnage1" name="faviconChange" data-type="faviconImg|{{ route('admin.favicon') }}" class="d-none">
                                            <img src="{{ asset('logo/placeholder/favicon-dark.png') }}" class="img-fluid" style="object-fit: contain; width: 100%;">
                                            <div class="mt-5 border-top">
                                                <p>How to change Favicon icon?</p>
                                                <ul>
                                                    <li>Click on favicon icon place.</li>
                                                    <li>Select image, image must be in png, jpeg, jpg.</li>
                                                    <li>Then, click open button, and relax your favicon uploading start.</li>
                                                    <li>favicon change success.</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>      

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('layouts.footer')
@endsection
@section('myscript')
 <script type="text/javascript">
    $(function(){
        
        let loaderKey = $('#loder_type option:selected').val();
        
        checkLoaderType(loaderKey);
    });


    $(document).on('change','#loder_type',function(){
        let key = $(this).val();
        checkLoaderType(key);
    });

    function checkLoaderType(key){
        if(key == 'text') {
            var html = '<div class="form-group" id="text-loader">'+
                    '<label for="store_name">{{ __('App Loader') }} <span class="text-danger">*</span></label>'+
                    '<input type="text" name="config_loder_name" class="form-control" value="@if(old('config_loder_name')) {{ old('config_loder_name') }} @else{{ config('settings.config_loder_name') }}@endif" >'+
                    '<div class="text-small mt-1"><i class="fa fa-info-circle text-danger"></i> <strong>NOTE:</strong> app loader must be add underscore (_) to break space.</div>'+
                    //+'@if(!empty($errors->first('config_loder_name')))<div class=""><small class="text-danger">{{ $errors->first('config_loder_name') }}</small></div>@endif'+
                    '</div>';
            $('.text-loader').append(html);
        } else {
            $('#text-loader').remove();
        }

        if(key == 'default') {
            var html = '<div class="form-group" id="text-default">'+
                    '<label for="store_name">{{ __('Loader Color') }} <span class="text-danger">*</span></label>'+
                    '<input type="color" name="config_loder_color" class="form-control" value="@if(old('config_loder_color')) {{ old('config_loder_color') }} @else{{ config('settings.config_loder_color') }}@endif" >'+
                    //+'@if(!empty($errors->first('config_loder_color')))<div class=""><small class="text-danger">{{ $errors->first('config_loder_color') }}</small></div>@endif'+
                    '</div>';
            $('.text-loader').append(html);
        } else {
            $('#text-default').remove();
        }
    }

    // var app = angular.module('app',[]);

    // app.controller('postController', function ($scope, $http) {
    //     $scope.posts = [];
    //     $scope.configurationSetting = function () {
    //         $http.get('{{ route("admin.web.get-panel-config") }}').then(function (response) {
    //             $scope.posts        = response.data;
    //         });
    //     };        

    //     $scope.updateSelection = function($event, id) {
            
    //         $http.get('/admin/web/config-update-request/'+id+'').then(function (response) {
    //             if(response.data.color != 'success') {
    //                 toastr.warning(response.data.message);
    //             } else {
    //                 toastr.success(response.data.message);
    //             }
    //         });  
    //     };

    // });

 </script>
@endsection