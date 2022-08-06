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
                        <li class="breadcrumb-item active" aria-current="page">{{ __('ENV editor') }}</li>
                    </ol>
                </nav>
            </div>
           
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8"><h6 class="card-title">{{ __('ENV Editor') }}<h6></div>
                            <div class="col-md-4">
                                <div class="d-flex justify-content-end">
                                    <button type="submit" form="form-setting" data-toggle="tooltip" title="" data-original-title="Save" class="btn btn-primary ml-1"><i class="fa fa-save"></i></a>
                                </div>
                            </div>
                        </div>
                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                                    
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active"  id="pills-mail-tab" data-toggle="pill" href="#pills-mail" role="tab">{{ __('Mail')}}</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="pills-server-tab" data-toggle="pill" href="#pills-server" role="tab">{{ __('Server')}}</a>
                            </li>
                        </ul>
                        <form action="{{ route('admin.web.panel.setting.edit') }}" method="post" id="form-setting">
                            <div class="tab-content" id="pills-tabContent">
                                
                                <div class="tab-pane fade show active" id="pills-mail" role="tabpanel" aria-labelledby="pills-mail-tab">
                                    @csrf
                                    <div class="form-group">
                                        <label for="input-mail-engine"><span data-toggle="tooltip" title="" data-original-title="Only choose 'Mail' unless your host has disabled the php mail function.">Mail Engine</span></label>
                                        <select name="MAIL_MAILER" id="input-mail-engine" class="form-control">
                                            <option value="mail" @if(env('MAIL_MAILER') == 'male') selected @endif>Mail</option>                                                                                    
                                            <option value="smtp" @if(env('MAIL_MAILER') == 'smtp') selected @endif>SMTP</option>
                                        </select>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="input-mail-parameter"><span data-toggle="tooltip" title="" data-original-title="When using 'Mail', additional mail parameters can be added here (e.g. -f email@storeaddress.com).">Mail Parameters</span></label>
                                                <input type="text" name="MAIL_FROM_ADDRESS" value="{{ env('MAIL_FROM_ADDRESS') }}" placeholder="Mail Parameters" id="input-mail-parameter" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="input-mail-smtp-hostname"><span data-toggle="tooltip" title="" data-original-title="Add 'tls://' or 'ssl://' prefix if security connection is required. (e.g. tls://smtp.gmail.com, ssl://smtp.gmail.com).">SMTP Hostname</span></label>
                                                <input type="text" name="MAIL_HOST" value="{{ env('MAIL_HOST') }}" placeholder="SMTP Hostname" id="input-mail-smtp-hostname" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="input-mail-smtp-timeout">SMTP MAIL ENCRYPTION</label>
                                                <input type="text" name="MAIL_ENCRYPTION" value="{{ env('MAIL_ENCRYPTION') }}" placeholder="MAIL ENCRYPTION" id="input-mail-smtp-timeout" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="input-mail-smtp-port">SMTP Port</label>
                                                <input type="text" name="MAIL_PORT" value="{{ env('MAIL_PORT') }}" placeholder="SMTP Port" id="input-mail-smtp-port" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="input-mail-smtp-username">SMTP Username</label>
                                                <input type="text" name="MAIL_USERNAME" value="{{ env('MAIL_USERNAME') }}" placeholder="SMTP Username" id="input-mail-smtp-username" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="input-mail-smtp-password"><span data-toggle="tooltip" title="" data-original-title="For gmail you might need to setup a application specific password here: https://security.google.com/settings/security/apppasswords.">SMTP Password</span></label>
                                                <input type="text" name="MAIL_PASSWORD" value="{{ env('MAIL_PASSWORD') }}" placeholder="SMTP Password" id="input-mail-smtp-password" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="pills-server" role="tabpanel" aria-labelledby="pills-server-tab">
                                    <div class="form-row">
                                        <div class="col-md-3">
                                            <label>
                                                <span data-toggle="tooltip" title="" data-original-title="Prevents customers from browsing your store. They will instead see a maintenance message. If logged in as admin, you will see the store as normal."><i class="fa fa-info-circle text-primary"></i> Maintenance Mode</span>
                                            </label>
                                        </div>
                                        <div class="col-md-10">
                                            <div class="form-group">
                                                <label class="radio-inline">
                                                    <input type="radio" name="" value="1">
                                                    {{ __('Yes') }}
                                                </label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="" value="0" checked="checked">
                                                    {{ __('No') }}
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="col-md-3">
                                            <label>
                                                <span data-toggle="tooltip" title="" data-original-title="For enable Debug Mode you can see errors "><i class="fa fa-info-circle text-primary"></i> Display error</span>
                                            </label>
                                        </div>
                                        <div class="col-md-10">
                                            <div class="form-group">
                                                <label class="radio-inline">
                                                    <input type="radio" name="APP_DEBUG" value="True" @if(env('APP_DEBUG') == 1) checked @endif>
                                                    {{ __('Yes') }}
                                                </label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="APP_DEBUG" value="False" @if(env('APP_DEBUG') == 0) checked @endif>
                                                    {{ __('No') }}
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="store_name">{{ __('Session Time') }} <span class="text-danger">*</span></label>  
                                        <input type="text" name="SESSION_LIFETIME" class="form-control" value="{{ env('SESSION_LIFETIME') }}" required>
                                    </div>  
                                    <div class="form-group">
                                        <label for="store_name">{{ __('Session Store Driver') }} <span class="text-danger">*</span></label>  
                                        <select name="SESSION_DRIVER" id="session_driver">
                                            <option value="file" @if(env('SESSION_DRIVER') == 'file') selected @endif> {{ __('File') }} </option>
                                            <option value="cookie"  @if(env('SESSION_DRIVER') == 'cookie') selected @endif> {{ __('Cookie') }} </option>
                                            <option value="database"  @if(env('SESSION_DRIVER') == 'database') selected @endif> {{ __('Database') }} </option>
                                            <option value="memcached"  @if(env('SESSION_DRIVER') == 'memcached') selected @endif> {{ __('Memcached') }} </option>
                                            <option value="redis"  @if(env('SESSION_DRIVER') == 'redis') selected @endif> {{ __('Redis') }} </option>
                                            <option value="dynamodb" @if(env('SESSION_DRIVER') == 'dynamodb') selected @endif> {{ __('Dynamodb') }} </option>
                                            <option value="array"  @if(env('SESSION_DRIVER') == 'array') selected @endif> {{ __('Array') }} </option>
                                        </select>
                                    </div>    
                                    
                                    <div class="form-row" id="extraInput"></div>

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
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.2/angular.min.js"></script>  
 <script type="text/javascript">
    $(function(){
        let key = $('#session_driver option:selected').val();
        let loaderKey = $('#loder_type option:selected').val();
        createExtraInput(key);
        checkLoaderType(loaderKey);
    });

    $(document).on('change','#session_driver',function(){
        let key = $(this).val();
        createExtraInput(key);
    });

    $(document).on('change','#loder_type',function(){
        let key = $(this).val();
        checkLoaderType(key);
    });

    function checkLoaderType(key){
        if(key == 'text') {
            var html = '<div class="form-group" id="text-loader">'+
                    '<label for="store_name">{{ __('App Loader') }} <span class="text-danger">*</span></label>'+
                    '<input type="text" name="APP_LOADER" class="form-control" value="{{ config('settings.config_loder_name') }}" required>'+
                    '<div class="text-small mt-1"><i class="fa fa-info-circle text-danger"></i> <strong>NOTE:</strong> app loader must be add underscore (_) to break space.</div>'+
                    '</div>';
            $('.text-loader').append(html);
        } else {
            $('#text-loader').remove();
        }

        if(key == 'default') {
            var html = '<div class="form-group" id="text-default">'+
                    '<label for="store_name">{{ __('Loader Color') }} <span class="text-danger">*</span></label>'+
                    '<input type="color" name="Loader_color" class="form-control" value="#{{ env('Loader_color') }}" required>'+
                    '</div>';
            $('.text-loader').append(html);
        } else {
            $('#text-default').remove();
        }
    }

    function createExtraInput(key) {
        
        if(key == 'redis') {
            var html = '<div class="col-md-12" id="redis"><div class="row"><div class="col-md-4"><div class="form-group"><label>REDIS_HOST</label><input type="text" name="REDIS_HOST" value="{{ env('REDIS_HOST') }}" placeholder="Redis Host" class="form-control"></div></div><div class="col-md-4"><div class="form-group"><label>REDIS_PASSWORD</label><input type="text" name="REDIS_PASSWORD" value="{{ env('REDIS_PASSWORD') }}" placeholder="Redis Password" class="form-control"></div></div><div class="col-md-4"><div class="form-group"><label>REDIS_PORT</label><input type="text" name="REDIS_PORT" value="{{ env('REDIS_PORT') }}" placeholder="Redis Port" class="form-control"></div></div></div></div>';
            $('#extraInput').append(html);
        } else {
            $('#redis').remove();
        }
        
        if(key == 'memcached') {
            var html = '<div class="col-md-12" id="memcached"><div class="row"><div class="col-md-12"><div class="form-group"><label>MEMCACHED_HOST</label><input type="text" name="MEMCACHED_HOST" value="{{ env('MEMCACHED_HOST') }}" placeholder="MEMCACHED_HOST" class="form-control"></div></div></div></div></div>';
            $('#extraInput').append(html);
        } else {
            $('#memcached').remove();
        }

        
    }

    var app = angular.module('app',[]);

    app.controller('postController', function ($scope, $http) {
        $scope.posts = [];
        $scope.configurationSetting = function () {
            $http.get('{{ route("admin.web.get-panel-config") }}').then(function (response) {
                $scope.posts        = response.data;
            });
        };        

        $scope.updateSelection = function($event, id) {
            
            $http.get('/admin/web/config-update-request/'+id+'').then(function (response) {
                if(response.data.color != 'success') {
                    toastr.warning(response.data.message);
                } else {
                    toastr.success(response.data.message);
                }
            });  
        };

    });

 </script>
@endsection