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
                        <li class="breadcrumb-item active" aria-current="page">{{ __('ticket.title') }}</li>
                    </ol>
                </nav>
            </div>
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8"><h6 class="card-title">{{ __('ticket.title') }}</h6></div>
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
                            <form action="{{ route('admin.extension.module.ticket.edit') }}" method="post" enctype="multipart/form-data" id="form-category" class="form-horizontal">
                                @csrf
                                <div class="form-group">                                    
                                    <label for="btn-text" class="">{{ __('ticket.text_status') }}</label>
                                    <select name="ticket_module_status" id="ticket_module_status" class="form-control @if(!empty($errors->first('ticket_module_status'))) is-invalid @endif">
                                        @if(empty(old('ticket_module_status')))

                                        <option value="0" @if($data['ticket_module_status'] == 0) selected @endif>{{ __('ticket.text_disable') }}</option>
                                        <option value="1" @if($data['ticket_module_status'] == 1) selected @endif>{{ __('ticket.text_enable') }}</option>
                                        @else
                                        <option value="0" @if($data['ticket_module_status'] == 0) selected @endif>{{ __('ticket.text_disable') }}</option>
                                        <option value="1" @if($data['ticket_module_status'] == 1) selected @endif>{{ __('ticket.text_enable') }}</option>
                                        @endif
                                    </select>
                                    @if(!empty($errors->first('ticket_module_status')))
                                    <div class="">
                                        <small class="text-danger">{{ $errors->first('ticket_module_status') }}</small>
                                    </div>
                                    @endif
                                </div>
                                <div class="form-group">                                    
                                    <label for="btn-text" class="">{{ __('ticket.text_default_open') }}</label>
                                    <select name="ticket_module_default_status" id="ticket_module_default_status" class="form-control @if(!empty($errors->first('ticket_module_default_status'))) is-invalid @endif">
                                        <option>{{ __('ticket.text_blank') }} </option>
                                        @if(count($data['all_status']) > 0)
                                            @foreach($data['all_status'] as $status)
                                                <option value="{{ $status->id }}" @if($status->id == $data['ticket_module_default_status']) selected @endif>{{ $status->status_name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @if(!empty($errors->first('ticket_module_default_status')))
                                    <div class="">
                                        <small class="text-danger">{{ $errors->first('ticket_module_default_status') }}</small>
                                    </div>
                                    @endif
                                </div>
                                <div class="form-group">                                    
                                    <label for="btn-text" class="">{{ __('ticket.text_open') }}</label>
                                    <select name="ticket_module_open_status" id="ticket_module_open_status" class="form-control @if(!empty($errors->first('ticket_module_open_status'))) is-invalid @endif">
                                        <option value="">{{ __('ticket.text_blank') }} </option>
                                        @if(count($data['all_status']) > 0)
                                            @foreach($data['all_status'] as $status)
                                                <option value="{{ $status->id }}" @if($status->id == $data['ticket_module_open_status']) selected @endif>{{ $status->status_name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @if(!empty($errors->first('ticket_module_open_status')))
                                    <div class="">
                                        <small class="text-danger">{{ $errors->first('ticket_module_open_status') }}</small>
                                    </div>
                                    @endif
                                </div>
                                <div class="form-group">                                    
                                    <label for="btn-text" class="">{{ __('ticket.text_note_status') }}</label>
                                    <select name="ticket_module_note_status" id="ticket_module_note_status" class="form-control @if(!empty($errors->first('ticket_module_note_status'))) is-invalid @endif">
                                        <option value="">{{ __('ticket.text_blank') }} </option>
                                        @if(count($data['all_status']) > 0)
                                            @foreach($data['all_status'] as $status)
                                                <option value="{{ $status->id }}" @if($status->id == $data['ticket_module_note_status']) selected @endif>{{ $status->status_name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @if(!empty($errors->first('ticket_module_note_status')))
                                    <div class="">
                                        <small class="text-danger">{{ $errors->first('ticket_module_note_status') }}</small>
                                    </div>
                                    @endif
                                </div>

                                <div class="form-group required">
                                    <label for="input-order-status">{{ __('ticket.text_default_status') }}</label>
                                    <div class="well well-sm" style="height: 150px; overflow: auto;">
                                    @if(count($data['all_status']) > 0)
                                        
                                        @foreach($data['all_status'] as $status)
                                        <div class="checkbox">
                                            <label>
                                            <input type="checkbox" name="ticket_module_select_ticket_status[{{$status->id}}]" @if(!empty($data['ticket_module_select_ticket_status'][$status->id]) && $data['ticket_module_select_ticket_status'][$status->id] == $status->id) checked="checked" @endif value="{{ $status->id }}" />{{$status->status_name}}
                                            </label>
                                        </div>
                                        @endforeach
                                    @endif
                                    </div>
                                    <a onclick="$(this).parent().find(':checkbox').prop('checked', true);">{{ __('ticket.text_select')}}</a> / <a onclick="$(this).parent().find(':checkbox').prop('checked', false);">{{ __('ticket.text_deselect')}}</a>
                                    @if(!empty($errors->first('ticket_module_select_ticket_status')))
                                    <div class="">
                                        <small class="text-danger">{{ $errors->first('ticket_module_select_ticket_status') }}</small>
                                    </div>
                                    @endif
                                </div>

                                <div class="form-group required">
                                    <label for="input-order-status">{{ __('ticket.text_ticket_status') }}</label>
                                    <div class="well well-sm" style="height: 150px; overflow: auto;">
                                    @if(count($data['all_status']) > 0)
                                        
                                        @foreach($data['all_status'] as $status)
                                        <div class="checkbox">
                                            <label>
                                            <input type="checkbox" name="ticket_module_select_ticket_reply[{{$status->id}}]" @if(!empty($data['ticket_module_select_ticket_reply'][$status->id]) && $data['ticket_module_select_ticket_reply'][$status->id] == $status->id) checked="checked" @endif value="{{ $status->id }}" />{{$status->status_name}}
                                            </label>
                                        </div>
                                        @endforeach
                                    @endif
                                    </div>
                                    <a onclick="$(this).parent().find(':checkbox').prop('checked', true);">{{ __('ticket.text_select')}}</a> / <a onclick="$(this).parent().find(':checkbox').prop('checked', false);">{{ __('ticket.text_deselect')}}</a>
                                    @if(!empty($errors->first('ticket_module_select_ticket_reply')))
                                    <div class="">
                                        <small class="text-danger">{{ $errors->first('ticket_module_select_ticket_reply') }}</small>
                                    </div>
                                    @endif
                                </div>

                                <div class="form-group required">
                                    <label for="input-order-status">{{ __('ticket.text_customer_status') }}</label>
                                    <div class="well well-sm" style="height: 150px; overflow: auto;">
                                    @if(count($data['all_status']) > 0)
                                        
                                        @foreach($data['all_status'] as $status)
                                        <div class="checkbox">
                                            <label>
                                            <input type="checkbox" name="ticket_module_select_ticket_customer_reply[{{$status->id}}]" @if(!empty($data['ticket_module_select_ticket_customer_reply'][$status->id]) && $data['ticket_module_select_ticket_customer_reply'][$status->id] == $status->id) checked="checked" @endif value="{{ $status->id }}" />{{$status->status_name}}
                                            </label>
                                        </div>
                                        @endforeach
                                    @endif
                                    </div>
                                    <a onclick="$(this).parent().find(':checkbox').prop('checked', true);">{{ __('ticket.text_select')}}</a> / <a onclick="$(this).parent().find(':checkbox').prop('checked', false);">{{ __('ticket.text_deselect')}}</a>
                                    @if(!empty($errors->first('ticket_module_select_ticket_customer_reply')))
                                    <div class="">
                                        <small class="text-danger">{{ $errors->first('ticket_module_select_ticket_customer_reply') }}</small>
                                    </div>
                                    @endif
                                </div>


                                <div class="form-group">                                    
                                    <label for="btn-text" class="">{{ __('ticket.sendAttachment') }} <span class="text-danger">*</span></label>
                                    <input type="number" name="ticket_module_attachment" value="@if(empty(old('ticket_module_attachment'))){{ $data['ticket_module_attachment'] }}@else{{ old('ticket_module_attachment') }}@endif" id="ticket_module_attachment" class="form-control @if(!empty($errors->first('ticket_module_attachment'))) is-invalid @endif" placeholder="{{ __('ticket.title_placeholder') }}">
                                    @if(!empty($errors->first('ticket_module_attachment')))
                                    <div class="">
                                        <small class="text-danger">{{ $errors->first('ticket_module_attachment') }}</small>
                                    </div>
                                    @endif
                                </div>
                                
                                <div class="form-group">                                    
                                    <label for="btn-text" class="">{{ __('ticket.allowed_file') }} <span class="text-danger">*</span></label>
                                    <input type="text" name="ticket_module_extension" value="@if(empty(old('ticket_module_extension'))){{ $data['ticket_module_extension'] }}@else{{ old('ticket_module_extension') }}@endif" id="ticket_module_extension" class="form-control @if(!empty($errors->first('ticket_module_extension'))) is-invalid @endif" placeholder="{{ __('ticket.allowed_place') }}">
                                    @if(!empty($errors->first('ticket_module_extension')))
                                    <div class="">
                                        <small class="text-danger">{{ $errors->first('ticket_module_extension') }}</small>
                                    </div>
                                    @endif
                                </div>

                                <div class="form-group">                                    
                                    <label for="btn-text" class="">{{ __('ticket.fileSize') }} <span class="text-danger">*</span></label>
                                    <input type="text" name="ticket_module_filesize" value="@if(empty(old('ticket_module_filesize'))){{ $data['ticket_module_filesize'] }}@else{{ old('ticket_module_filesize') }}@endif" id="ticket_module_filesize" class="form-control @if(!empty($errors->first('ticket_module_filesize'))) is-invalid @endif" placeholder="{{ __('ticket.allow_size') }}">
                                    @if(!empty($errors->first('ticket_module_filesize')))
                                    <div class="">
                                        <small class="text-danger">{{ $errors->first('ticket_module_filesize') }}</small>
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