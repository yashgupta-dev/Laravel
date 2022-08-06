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
                        <li class="breadcrumb-item active" aria-current="page">{{ __('Permission add') }}</li>
                    </ol>
                </nav>
            </div>
            
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                    <div class="d-flex justify-content-end">
                    <button type="submit" form="form-user-group" class="btn btn-primary"><i class="fa fa-save"></i></button>
                    </div>
                    <form action="{{ route('admin.web.permission.add') }}" method="post" enctype="multipart/form-data" id="form-user-group" class="form-horizontal" style="margin-left:120px;">
                        <input type="hidden" name="id" value="{{ $id }}">
                        @csrf
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Access Permission</label>
                            <div class="col-sm-10">
                                <div class="well well-sm" style="height: 150px; overflow: auto;">
                                    @foreach ($permissions as $permission )
                                    <div class="checkbox">
                                        <label>
                                            @if( !empty($access) && in_array($permission,$access))
                                            <input type="checkbox" name="permission[access][]" value="{{ $permission }}" checked/>
                                            @else
                                            <input type="checkbox" name="permission[access][]" value="{{ $permission }}" />
                                            @endif
                                            {{ $permission }}
                                        </label>
                                    </div>
                                    @endforeach
                                </div>
                                <button type="button" onclick="$(this).parent().find(':checkbox').prop('checked', true);" class="btn btn-link">Select All</button> /
                                <button type="button" onclick="$(this).parent().find(':checkbox').prop('checked', false);" class="btn btn-link">Unselect All</button>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Modify Permission</label>
                            <div class="col-sm-10">
                                <div class="well well-sm" style="height: 150px; overflow: auto;">
                                @foreach ($permissions as $permission )
                                    <div class="checkbox">
                                        <label>
                                            @if( !empty($modify) &&  in_array($permission,$modify))
                                            <input type="checkbox" name="permission[modify][]" value="{{ $permission }}" checked/>
                                            @else 
                                            <input type="checkbox" name="permission[modify][]" value="{{ $permission }}" />
                                            @endif
                                            {{ $permission }}
                                        </label>
                                    </div>
                                @endforeach
                                </div>
                                <button type="button" onclick="$(this).parent().find(':checkbox').prop('checked', true);" class="btn btn-link">Select All</button> /
                                <button type="button" onclick="$(this).parent().find(':checkbox').prop('checked', false);" class="btn btn-link">Unselect All</button>
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