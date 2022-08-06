@extends('admin.layouts.my')
@section('content')
<style>
    .well-sm {
    padding: 9px;
    border-radius: 2px;
}
.well {
    min-height: 20px;
    padding: 19px;
    margin-bottom: 20px;
    background-color: #f5f5f5;
    border: 1px solid #e3e3e3;
    border-radius: 3px;
    -webkit-box-shadow: inset 0 1px 1px rgb(0 0 0 / 5%);
    box-shadow: inset 0 1px 1px rgb(0 0 0 / 5%);
}
</style>
<div class="page-content">
    <div class="profile-page tx-13">
        <div class="row">
            <div class="col-md-12">
                <nav class="page-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">{{ __('Home') }}</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.web.setting.permission') }}">{{ __('permission') }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ __('Create User') }}</li>
                    </ol>
                </nav>
            </div>
            
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">                    
                    <h5 class="text-muted font-weight-normal mb-4">{{ __('Create new account')}}</h5>
                    <form class="forms-sample" id="register-form" method="POST" action="{{ route('admin.create.confirm.user') }}">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">{{ __('Group') }} <span class="text-danger">*</span></label>
                            <select class="form-control" name="group">
                            <option>{{ __('Choose group') }}</option>
                            @if(!empty($data)) 
                                @foreach($data as $row)
                                    <option value="{{$row->id }}">{{ $row->name }}</option>
                                @endforeach
                            @endif
                            </select>
                            @error('group')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <!-- <div class="form-group">
                            <label for="exampleInputEmail1">{{ __('User Type') }} <span class="text-danger">*</span></label>
                            <select class="form-control" name="user_type">
                                <option>{{ __('Choose User Type') }}</option>
                                <option @if(old('user_type')) == 0) selected @endif value="0">{{ __('Fronted') }}</option>
                                <option @if(old('user_type')) == 1) selected @endif value="1">{{ __('Backend') }}</option>
                            </select>
                            @error('user_type')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div> -->
                        <div class="form-group">
                            <label for="exampleInputEmail1">{{ __('Name') }} <span class="text-danger">*</span></label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus />

                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">{{ __('E-Mail Address') }} <span class="text-danger">*</span></label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" />

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">{{ __('Phone') }} <span class="text-danger">*</span></label>
                            <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="off" />

                            @error('phone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">{{ __('Password') }} <span class="text-danger">*</span></label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" />

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">{{ __('Confirm Password') }} <span class="text-danger">*</span></label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" />
                        </div>

                        <div class="mt-3">
                            <button type="submit" id="register-btn" class="btn btn-primary mr-2 mb-2 mb-md-0 text-white">{{ __('Create account') }}</button>
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