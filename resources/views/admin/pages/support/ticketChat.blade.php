@extends('admin.layouts.my') @section('content')
<style>
    .nav-link.active {
        background: transparent !important;
        font-size: 15px;
        font-weight: 600;
        border: none;
        border-bottom: 2px solid #7f40ba !important;
    }
    .nav-tabs .nav-link {
        color: #353535 !important;
        font-size: 15px;
        font-weight: 600;
    }
    .nav-tabs .nav-link:hover,
    .nav-tabs .nav-link:focus {
        background: transparent !important;
        font-size: 15px;
        font-weight: 600;
        border: none;
    }
  
#exampleModal.modal.rightModal .modal-dialog {
  width: 320px !important;
}
</style>
<div ng-app="app" class="page-content">
    <div ng-controller="postController" class="profile-page tx-13">
        <div class="row">
            @if(count($data['chats']) > 0)
            <div class="col-md-3" id="responsive">
                <div class="row">
                    <div class="col-md-8"><h5 class="font-weight-bold">{{ __('TICKET #')}}{{$data['ticket']}}</h5></div>
                    <div class="col-md-4">
                        <a href="{{ route('admin.ticket') }}" class="font-weight-bold h5 text-dark"><i class="fas fa-angle-left"></i> {{ __('Back') }}</a>
                    </div>

                    <div class="col-md-12 mb-3" style="margin-top: 1.1rem !important;">
                        <div class="uv-mob-aside">
                            <span class="uv-icon-aside-menu"></span>
                        </div>
                        <div class="border-bottom"></div>
                    </div>
                    @foreach($data['chats'] as $row)
                    <!-- customer information -->
                    <div class="col-md-12 mt-4">
                        <h6 class="font-weight-dark">{{ __('Customer Information') }}</h6>
                        <div class="mt-3">
                            <div class="d-flex">
                                <div>
                                    @if(!in_array($row->user['profile'],['0','1','2','3','4']))
                                    <img src="{{ asset('storage') }}/profile/{{ explode('/',$row->user['profile'])[2] }}" alt="{{ $row->user['name'] }}" style="border-radius: 8px; width: 40px; height: 40px; object-fit: cover;" />
                                    @else
                                    <img src="{{ asset('logo') }}/{{ $row->user['profile'] }}.png" alt="{{ $row->user['name'] }}" style="border-radius: 8px; width: 40px; height: 40px; object-fit: cover;" />
                                    @endif
                                </div>
                                <div class="col-md-10 mt-2">
                                    <p class="" style="color: #2d2c2c; font-weight: 600; font-size: 15px;">{{ $row->user['name'] }}</p>
                                    <div class="d-flex justify-content-between">
                                        <div class="font-weight-dark">{{ substr($row->user['email'],0,30) }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- total replies -->
                    <div class="col-md-12 mt-4">
                        <h6 class="font-weight-dark">{{ __('Total Replies') }}</h6>
                        <div class="mt-2">
                            <div class="d-flex">
                                <div>
                                    <i class="fas fa-share text-dark"></i>
                                </div>
                                <div class="ml-2">
                                    {{ count($row->supportreplies) }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- timestamp -->
                    <div class="col-md-12 mt-4">
                        <h6 class="font-weight-dark">{{ __('TimeStamp') }}</h6>
                        <div class="mt-2">
                            <div class="d-flex">
                                <div>
                                    <i class="fas fa-stopwatch text-dark"></i>
                                </div>
                                <div class="ml-2">
                                    {{ date('d-M-y h:i A',strtotime($row->created_at)) }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- channel -->
                    <div class="col-md-12 mt-4">
                        <h6 class="font-weight-dark">{{ __('Channel') }}</h6>
                        <div class="mt-2">
                            <div class="d-flex">
                                <div>
                                    <i class="fas fa-globe text-dark"></i>
                                </div>
                                <div class="ml-2">
                                    {{ __('Website') }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 mt-4 mb-4">
                        <div class="border-bottom"></div>
                    </div>
                    <form method="post" action="{{ route('admin.ticket.update') }}" id="custom-update">
                        <div class="col-md-12">
                            <h6 class="font-weight-dark">{{ __('Agent')}}</h6>
                            <div class="mt-1 mb-2">
                                <div class="d-flex">
                                    <div class="ml-2">
                                        @if(!$data['status'])
                                        <input type="hidden" name="ticket" value="{{ $data['ticket'] }}" />
                                        @foreach($data['chats'] as $row)
                                        <input
                                            type="text"
                                            name="assigne"
                                            id="assigne"
                                            value="@if(!empty($row->assign)) {{ $row->assign->agent['name'] }} @else {{ __('Unassigned') }} @endif"
                                            class="form-control"
                                            placeholder="{{ __('set assignee by name or email') }}"
                                        />
                                        @endforeach
                                        <input type="hidden" name="assigne_id" id="assigne_id" class="form-control" />
                                        @else @foreach($data['chats'] as $row)
                                        <h6>@if(!empty($row->assign)) {{ $row->assign->agent['name'] }} @else {{ __('Unassigned') }} @endif</h6>
                                        @endforeach @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- priorty -->
                        <div class="col-md-12">
                            <h6 class="font-weight-dark">{{ __('Priority')}}</h6>
                            <div class="mt-1">
                                <div class="d-flex">
                                    <div class="ml-2">
                                        @csrf
                                        <input type="hidden" name="ticket" value="{{ $data['ticket'] }}" />
                                        <input type="hidden" name="user" value="{{ $data['user'] }}" />
                                        <div class="input-group select-group">
                                            <span class="input-group-addon" style="margin-top: 12px; font-size: 8px;">
                                                <span class="fa fa-circle @if($row->priority == 0) text-info @elseif($row->priority == 1) text-warning @elseif($row->priority == 2) text-danger @endif"></span>
                                            </span>
                                            <select name="priority" id="priority" style="background: transparent; border: none;" onchange="event.preventDefault();document.getElementById('custom-update').submit();">
                                                <option value="0" @if($row->priority == 0) selected @endif >{{__('Normal')}}</option>
                                                <option value="1" @if($row->priority == 1) selected @endif >{{__('High')}}</option>
                                                <option value="2" @if($row->priority == 2) selected @endif >{{__('Urgent')}}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- status -->
                        <div class="col-md-12">
                            <h6 class="font-weight-dark">{{ __('Status')}}</h6>
                            <div class="mt-1">
                                <div class="d-flex">
                                    <div class="ml-2">
                                        <select name="status" id="status" style="background: transparent; border: none;" onchange="event.preventDefault();document.getElementById('custom-update').submit();">
                                        @if(!empty(json_decode(config('settings.ticket_module_select_ticket_status'))))
                                            @foreach(json_decode(config('settings.ticket_module_select_ticket_status')) as $status)
                                                @php($statusName = App\Models\Statusmange::where('id',$status)->select('status_name')->first()['status_name'])
                                                
                                                <option value="{{ $status }}" @if($status == $row->status) selected @endif>{{ $statusName }}</option>
                                            @endforeach
                                        @endif
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- group -->
                        <div class="col-md-12">
                            <h6 class="font-weight-dark">{{ __('Team')}}</h6>
                            <div class="mt-1">
                                <div class="d-flex">
                                    <div class="ml-2">
                                        <div class="input-group select-group">
                                            <select name="group" id="group" style="background: transparent; border: none;">
                                                <option value="{{ auth()->guard('admin')->user()->role->role_id }}" selected>@php(print_r(App\Models\Role::where('id',auth()->guard('admin')->user()->role->role_id)->first()['name']))</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    @endforeach
                </div>
            </div>
            <div class="col-md-9" id="responsiveChat">
                <div class="row">
                    <div class="col-md-12 scrollCheck">
                        <div class="template-header" id="template-header">
                            <ul class="nav nav-tabs" style="width: 100%; background: rgb(255 255 255); padding-bottom: 10px; z-index: 9;">
                                <li>
                                    <div class="uv-mob-aside">
                                        <span class="uv-icon-aside-menu"></span>
                                    </div>
                                </li>
                                <li class="nav-item" id="pinOnTop">
                                    <a href="javascript:;" class="nav-link" type="button"><i class="fas fa-map-marker-alt"></i></a>
                                </li>
                                <li class="nav-item">
                                    <a class="filter-button nav-link active" href="#all-threads" type="button" data-filter="threads">{{ __('All Threads') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="filter-button nav-link" href="#replies" type="button" data-filter="replies">{{ __('Replies')}}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="filter-button nav-link" href="#notes" type="button" data-filter="notes">{{ __('Notes')}}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="filter-button nav-link" href="#attachements" type="button" data-filter="attachements">{{ __('Attachements')}}</a>
                                </li>
                            </ul>
                        </div>
                        <div class="template-header" id="template-header1">
                            @foreach($data['chats'] as $row)
                            <div class="title mt-4">
                                <h4 class="font-weight-light"><i class="far fa-star"></i> {{ $row->subject }}</h4>
                                <div class="mt-2 d-flex justify-content-arround">
                                    <div class="font-weight-light">{{ __('Created -') }} <span class="font-weight-bold">{{ date('d-m-y h:i A',strtotime($row->created_at)) }}</span></div>
                                    <div class="font-weight-light ml-3">
                                        {{ __('By -') }} <span class="font-weight-bold">{{ $row->user['name'] }}</span>
                                        @if($data['moreticket'] > 0)
                                        <a href="javascript:;" ng-init="relatedTicket({{ $row->user_id }},{{ $row->id}})" data-toggle="modal" data-target="#exampleModal" class="font-weight-bold">
                                            ({{ $data['moreticket'] }} {{ __('more tickets')}})
                                        </a>
                                        @endif
                                    </div>
                                    <div class="font-weight-light ml-3">{{ __('Agent -') }} <span class="font-weight-bold">@if(!empty($row->assign)) {{ $row->assign->agent['name'] }} @else {{ __('Unassigned') }} @endif</span></div>
                                </div>
                            </div>
                            <div class="border-bottom mt-3"></div>
                        </div>

                        <div class="template">
                            <div class="template-content">
                                <div class="template-content-chat" style="margin-top: 10px;">
                                    @if(count($row->ticket_msg))
                                    <!-- chat section start -->
                                    <?php $i = 0; ?>
                                    @foreach($row->ticket_msg as $msg)
                                    <?php $i++; ?>
                                    <div class="chat-section filter @if(!$msg->from) replies @endif @if(count($msg->msg_attachement)) attachements @endif">
                                        @if($i == 1)
                                        <div class="mb-1 d-flex justify-content-arround">
                                            <div class="font-weight-light">{{ date('d-m-y h:i A',strtotime($row->created_at)) }} - <span class="font-weight-bold">{{ $row->user['name'] }}</span> Created</div>
                                        </div>
                                        @else
                                        <div class="font-weight-light display-inline mb-1">
                                            {{ date('d-m-y h:i A',strtotime($msg->created_at)) }} - @if($msg->from){{ $row->user['name'] }}@else{{ $msg->agent['name'] }}@endif <span style="color: #9e9e9e;">replied</span>
                                            <span>
                                                <a href="{{ url()->current() }}#{{ strtotime($msg->created_at) }}" data-toggle="tooltip" data-placement="top" title="{{ url()->current() }}#{{ strtotime($msg->created_at) }}">
                                                    #{{ strtotime($msg->created_at) }}
                                                </a>
                                            </span>
                                        </div>
                                        @endif
                                        <div class="d-flex">
                                            <div class="image">
                                                @if($msg->from) @if(!in_array($row->user['profile'],['0','1','2','3','4']))
                                                <img
                                                    src="{{ asset('storage') }}/profile/{{ explode('/',$row->user['profile'])[2] }}"
                                                    alt="{{ $row->user['name'] }}"
                                                    style="border-radius: 8px; width: 40px; height: 40px; object-fit: cover;"
                                                />
                                                @else
                                                <img src="{{ asset('logo') }}/{{ $row->user['profile'] }}.png" alt="{{ $row->user['name'] }}" style="border-radius: 8px; width: 40px; height: 40px; object-fit: cover;" />
                                                @endif @else @if(!in_array($msg->agent['profile'],['0','1','2','3','4']))
                                                <img
                                                    src="{{ asset('storage') }}/profile/{{ explode('/',$msg->agent['profile'])[2] }}"
                                                    alt="{{ $msg->agent['name'] }}"
                                                    style="border-radius: 8px; width: 40px; height: 40px; object-fit: cover;"
                                                />
                                                @else
                                                <img src="{{ asset('logo') }}/{{ $msg->agent['profile'] }}.png" alt="{{ $row->user['name'] }}" style="border-radius: 8px; width: 40px; height: 40px; object-fit: cover;" />
                                                @endif @endif
                                            </div>
                                            <div class="desc ml-3">
                                                <div class="agent-title mb-1"><a href="#"> @if($msg->from) {{ $row->user['name'] }} @else {{ $msg->agent['name'] }} @endif </a></div>
                                                {!! $msg->r_msg !!}
                                            </div>
                                        </div>
                                        @if(count($msg->msg_attachement))
                                        <div class="chat-files ml-5 mt-2">
                                            <ul class="docs-pictures flex-row">
                                                @foreach($msg->msg_attachement as $attachment)
                                                <li>
                                                    @if (in_array($extension = pathinfo($attachment->attachments, PATHINFO_EXTENSION), ['jpg', 'png', 'bmp','jpeg']))
                                                    <img
                                                        src="{{ asset('storage')}}/attachements/{{ $attachment->ticket_msg_id }}/{{explode('/',$attachment->attachments)[3] }}"
                                                        data-original="{{ asset('storage')}}/attachements/{{ $attachment->ticket_msg_id }}/{{explode('/',$attachment->attachments)[3] }}"
                                                    />
                                                    @elseif(in_array($extension = pathinfo($attachment->attachments, PATHINFO_EXTENSION), ['pdf']))
                                                    <a href="{{ asset('storage')}}/attachements/{{ $attachment->ticket_msg_id }}/{{explode('/',$attachment->attachments)[3] }}" target="_blank">
                                                        <img src="{{ asset('logo/filetype/'.$extension.'.png')}}" />
                                                    </a>
                                                    @else
                                                    <a href="{{ asset('storage')}}/attachements/{{ $attachment->ticket_msg_id }}/{{explode('/',$attachment->attachments)[3] }}" target="_blank">
                                                        <img src="{{ asset('logo/filetype/file.png')}}" />
                                                    </a>
                                                    @endif
                                                </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        @endif
                                    </div>

                                    @foreach($msg->notes as $key) @if($key['ticket_msg_id'] == $msg->id)
                                    <!-- note layout -->
                                    <div class="chat-section mt-3 filter notes">
                                        <div class="font-weight-light display-inline mb-1">
                                            {{ date('d-m-y h:i A',strtotime($msg->created_at)) }} - @if($key['notes_added_name'] == 'System'){{ __('System') }}@else{{ $key['notes_added_name'] }}@endif
                                            <span style="color: #9e9e9e;">added note</span>
                                        </div>
                                        <div class="d-flex">
                                            <div class="image">
                                                @if($key['notes_added_name'] == 'System')
                                                <img src="{{ asset('logo/af40b44.png') }}" alt="" style="border-radius: 8px; width: 40px; height: 40px; object-fit: cover;" />
                                                @else @if(!in_array($key->agent['profile'],['0','1','2','3','4']))
                                                <img src="{{ asset('storage') }}/profile/{{ explode('/',$key->agent['profile'])[2] }}" alt="" style="border-radius: 8px; width: 40px; height: 40px; object-fit: cover;" />
                                                @else
                                                <img src="{{ asset('logo') }}/{{ $key->agent['profile'] }}.png" alt="" style="border-radius: 8px; width: 40px; height: 40px; object-fit: cover;" />
                                                @endif @endif
                                            </div>
                                            <div class="uv-ticket-main-rt desc ml-3">
                                                <a href="/member/edituser/5069" class="uv-ticket-member-name">
                                                    {{ $key['notes_added_name'] }}
                                                </a>
                                                <!-- Message Block -->
                                                <div class="message">
                                                    <p><strong>{!! $key['notes'] !!}</strong></p>
                                                </div>
                                                <!-- //Message Block -->
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end note layout -->
                                    @endif @endforeach @endforeach
                                    <!-- chat section end -->
                                    @endif
                                </div>
                            </div>

                            <!-- chat message section -->
                            <div class="form mt-2">
                                <div class="d-flex">
                                    <div class="image">
                                        @if(!in_array(Auth::guard('admin')->user()->profile,['0','1','2','3','4']))
                                        <img
                                            src="{{ asset('storage') }}/profile/{{ explode('/',Auth::guard('admin')->user()->profile)[2] }}"
                                            alt="{{ Auth::guard('admin')->user()->name }}"
                                            style="border-radius: 8px; width: 40px; height: 40px; object-fit: cover;"
                                        />
                                        @else
                                        <img src="{{ asset('logo') }}/{{ Auth::guard('admin')->user()->profile }}.png" alt="{{ $row->user['name'] }}" style="border-radius: 8px; width: 40px; height: 40px; object-fit: cover;" />
                                        @endif
                                    </div>
                                    <div class="desc ml-3">
                                        <div class="agent-title mb-1">{{ Auth::guard('admin')->user()->name }}</div>
                                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">{{ __('Reply') }}</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">{{ __('Note') }}</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="tab-content mt-4" id="myTabContent">
                                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                        <form method="post" name="replyTicket" action="{{ route('admin.ticket.replies') }}" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group">
                                                <label for="">{{ __('Write a reply') }}</label>
                                                <textarea class="form-control" id="summernote" name="editordata">{{ old('editordata') }}</textarea>
                                                @if(!empty($errors->first('editordata')))
                                                <div class="">
                                                    <small class="text-danger">{{ $errors->first('editordata') }}</small>
                                                </div>
                                                @endif
                                                <input type="hidden" name="ticket" value="{{ $data['ticket'] }}" />
                                                <input type="hidden" name="user" value="{{ $data['user'] }}" />
                                            </div>
                                            <div class="form-group">
                                                <div class="form-group" style="display: inline-block;"></div>
                                                <span id="addFile" style="cursor: pointer;" class="label-right pointer text-primary"><i class="fas fa-paperclip"></i> {{ __('add attachements') }}</span>
                                            </div>
                                            <div class="uv-dropdown reply">
                                                <div class="uv-btn uv-dropdown-other">
                                                    Reply
                                                <span class="uv-icon-down-light"></span>
                                                </div>
                                                <div class="uv-dropdown-list uv-top-left" style="display: none;">
                                                    <div class="uv-dropdown-container" id="replyTicket">
                                                        <label>Reply</label>
                                                        @if(!empty(json_decode(config('settings.ticket_module_select_ticket_reply'))))
                                                        <ul>
                                                            @foreach(json_decode(config('settings.ticket_module_select_ticket_reply')) as $status)
                                                                @php($statusName = App\Models\Statusmange::where('id',$status)->select('status_name')->first()['status_name'])
                                                                <li data-id="{{$status}}">Submit And {{ $statusName }}</li>
                                                            @endforeach
                                                        </ul>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                    <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                                        <form method="post" name="note-form" action="{{ route('admin.ticket.note') }}" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group">
                                                <label for="">{{ __('Write a reply') }}</label>
                                                <textarea class="form-control" id="note" name="note">{{ old('note') }}</textarea>
                                                @if(!empty($errors->first('note')))
                                                <div class="">
                                                    <small class="text-danger">{{ $errors->first('note') }}</small>
                                                </div>
                                                @endif
                                                <input type="hidden" name="ticket" value="{{ $data['ticket'] }}" />
                                                <input type="hidden" name="user" value="{{ $data['user'] }}" />
                                            </div>
                                            <div class="uv-dropdown reply">
                                                <div class="uv-btn uv-dropdown-other">
                                                    {{ __('Reply') }}
                                                <span class="uv-icon-down-light"></span>
                                                </div>
                                                <div class="uv-dropdown-list uv-top-left" style="display: none;">
                                                    <div class="uv-dropdown-container" id="note">
                                                    <label>Reply</label>
                                                        @if(!empty(json_decode(config('settings.ticket_module_select_ticket_reply'))))
                                                        <ul>
                                                            @foreach(json_decode(config('settings.ticket_module_select_ticket_reply')) as $status)
                                                                @php($statusName = App\Models\Statusmange::where('id',$status)->select('status_name')->first()['status_name'])
                                                                <li data-id="{{$status}}">Submit And {{ $statusName }}</li>
                                                            @endforeach
                                                        </ul>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>                                            
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>

        <!-- Modal -->
        <div class="modal rightModal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="uv-filter-head">
                        <div class="uv-filter-title">
                            <h6>Customer's Ticket</h6>
                            <span>View current Customer's Previous Ticket(s) data</span>
                        </div>
                        <div class="uv-filter-toggle" id="filter-close-trigger" data-dismiss="modal">
                            <span></span>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="uv-filter-paper" id="uv-customer-tickets-list">
                            <div ng-if="related.status == 1">
                                <div ng-repeat="list in related.data">
                                    <!--Section-->
                                    <div class="uv-app-section">
                                        <div class="uv-app-task-plank">
                                            <div class="uv-app-task-section">
                                                <span class="uv-app-task-text">
                                                    <span class="uv-margin-right-5">
                                                        <a href="/admin/ticket/view/@{{list.id}}/@{{list.user_id}}" target="_blank">
                                                            {{__('#')}}@{{list.id}}
                                                        </a>
                                                    </span>
                                                    <a href="/admin/ticket/view/@{{list.id}}/@{{list.user_id}}" target="_blank">
                                                        @{{ list.subject}}
                                                    </a>
                                                </span>
                                            </div>
                                            <div class="uv-app-task-section">
                                                <span class="uv-app-task-text" data-index="timestamp">
                                                    <span class="uv-icon-timestamp" data-toggle="tooltip" data-placement="top" title="TimeStamp"></span>
                                                    <span class="timeago" data-timestamp="1630750440" data-toggle="tooltip" data-placement="top" title="04-09-21 03:44pm">
                                                        @{{ list.created_at}}
                                                    </span>
                                                </span>
                                            </div>

                                            <div class="uv-app-task-section">
                                                <span data-index="source">
                                                    <span class="uv-channel uv-channel-web" data-toggle="tooltip" data-placement="top" title="Source"></span>

                                                    <span class="uv-margin-right-5">website</span>
                                                </span>
                                            </div>

                                            <div class="uv-app-task-section">
                                                <span class="uv-app-task-text" data-index="priority">
                                                    <span ng-if="list.priority == 0">
                                                        <span class="uv-list-task-priority" style="background: #2dd051;" data-toggle="tooltip" data-placement="top" title="Priority"></span>
                                                        {{ __('Normal') }}
                                                    </span>
                                                    <span ng-if="list.priority == 1">
                                                        <span class="uv-list-task-priority" style="background: #ffcb00;" data-toggle="tooltip" data-placement="top" title="Priority"></span>
                                                        {{ __('High') }}
                                                    </span>
                                                    <span ng-if="list.priority == 2">
                                                        <span class="uv-list-task-priority" style="background: #ff0000;" data-toggle="tooltip" data-placement="top" title="Priority"></span>
                                                        {{ __('Urgent') }}
                                                    </span>
                                                </span>
                                                <span class="uv-app-task-text" data-index="status">
                                                    <span class="uv-icon-graph" data-toggle="tooltip" data-placement="top" title="Status"></span>
                                                    <span">
                                                        @{{ list.status }}
                                                    </span>
                                                    
                                                </span>
                                            </div>

                                            <div data-index="replies">
                                                <span class="uv-icon-replies" data-toggle="tooltip" data-placement="top" title="Total Replies"></span>
                                                <span>@{{ list.count }}</span>
                                            </div>

                                            <div class="uv-app-task-section" data-index="agent">
                                                <span class="uv-tag-info">Agent:</span>

                                                <div class="uv-app-task-section">
                                                    <img src="@{{list.admin_profile}}" class="uv-agent-thumbnail" alt="" />
                                                    <span class="uv-agent-name">@{{ list.agent_name }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--//Section-->
                                </div>
                                <p class="uv-no-more uv-text-center">
                                    That’s all!<br />
                                    customer doesn't have any more tickets
                                </p>
                            </div>
                            <p ng-if="related.status == 0" class="uv-no-more uv-text-center text-danger">
                                <i class="fa fa-exclamation-circle"></i>
                                @{{ related.message }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('layouts.footer') @endsection @section('myscript')
<link href="{{ asset('support/image_viewer/main.css')}}" rel="stylesheet" />
<link href="{{ asset('support/image_viewer/viewer.css')}}" rel="stylesheet" />
<script src="{{ asset('support/image_viewer/main.js') }}"></script>
<script src="{{ asset('support/image_viewer/viewer.js') }}"></script>
<style>
    ul.docs-pictures.flex-row {
        display: flex;
    }
    #template-header ul:hover #pinOnTop {
        /* display: block !important; */
    }
</style>
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.2/angular.min.js"></script>
<script>
    $(function() {
    
    var viewEl = $('#uv-view');
    var viewContainerEl = $('#uv-view-container');

    $('.uv-dropdown-pta').focus( function() {
        viewEl.addClass('uv-dropdown-disable-parent-scroll');
        viewContainerEl.addClass('uv-dropdown-disable-parent-scroll');
    });

    $('.uv-simple-dropdown-pta').focus( function() {
        viewEl.addClass('uv-dropdown-disable-parent-scroll');
        viewContainerEl.addClass('uv-dropdown-disable-parent-scroll');
    });

    $(document).click(function(e) {
        var target = e.target;

        if (!$(target).parents('.uv-dropdown-open').length || $(target).is('li') || $(target).is('a')) {
            $('.uv-dropdown-list').hide();
            $('.uv-dropdown-btn').removeClass('uv-dropdown-btn-active');
            $('.uv-dropdown-other').removeClass('uv-dropdown-btn-active');
            $('.uv-dropdown-open').removeClass('uv-dropdown-open');

            viewEl.removeClass('uv-dropdown-disable-parent-scroll');
            viewContainerEl.removeClass('uv-dropdown-disable-parent-scroll');

            let targetEl = $('.uv-dropdown-navigations-support.uv-dropdown-active-focus');
            
            targetEl.removeAttr('data-dropdownindex');
            targetEl.removeClass('uv-dropdown-active-focus');
        }

        if (!$(target).parents('.uv-search-result-active').length && !$(target).is('.uv-search-bar')) {
            $('.uv-search-result-wrapper').removeClass('uv-search-result-active');
            $('.uv-search-result-wrapper').removeClass('uv-search-flap-up');
        }
    });

    $('body').delegate('.uv-dropdown-btn, .uv-dropdown-other', 'click', function(e) {
        toggleDropdown(e);
    });
    function toggleDropdown(e) {
        var currentElement = $(e.currentTarget);

        if (currentElement.hasClass('uv-dropdown-btn-active')) {
            $('.uv-dropdown-list').hide();
            $('.uv-dropdown-btn').removeClass('uv-dropdown-btn-active');
            $('.uv-dropdown-other').removeClass('uv-dropdown-btn-active');
            $('.uv-dropdown-open').removeClass('uv-dropdown-open');
        } else {
            $('.uv-dropdown-list').hide(); 
            $('.uv-dropdown-btn').removeClass('uv-dropdown-btn-active');
            $('.uv-dropdown-other').removeClass('uv-dropdown-btn-active');
            $('.uv-dropdown-open').removeClass('uv-dropdown-open');

            if (currentElement.attr('disabled') != "disabled") {
                currentElement.addClass('uv-dropdown-btn-active');
                currentElement.parent().find('.uv-dropdown-list').fadeIn(100);
                currentElement.parent().addClass('uv-dropdown-open');

                // currentElement.parent().find('ul.dropdown-list li').removeClass('active');
                // currentElement.parent().find('ul.dropdown-list li:first').attr('class','active');
                autoDropupDropdown();
            }
        }
    }
    function autoDropupDropdown() {
        dropdownButton = $(".uv-dropdown-open");

        if (
            !dropdownButton.find('.uv-dropdown-list').hasClass('uv-top-left') 
            && !dropdownButton.find('.uv-dropdown-list').hasClass('uv-top-right') 
            && dropdownButton.length
        ) {
            dropdown = dropdownButton.find('.uv-dropdown-list');
            height = dropdown.height() + 50;

            var topOffset = dropdownButton.offset().top - 70;
            var bottomOffset = $(window).height() - topOffset - dropdownButton.height();

            dropdownButton.removeClass("bottom");
            
            if (bottomOffset > topOffset || height < bottomOffset) {
                if (dropdown.hasClass('uv-top-right')) {
                    dropdown.removeClass('uv-top-right')
                    dropdown.addClass('uv-bottom-right')
                } else if (dropdown.hasClass('uv-top-left')) {
                    dropdown.removeClass('uv-top-left')
                    dropdown.addClass('uv-bottom-left')
                }
            } else {
                if (dropdown.hasClass('uv-bottom-right')) {
                    dropdown.removeClass('uv-bottom-right')
                    dropdown.addClass('uv-top-right')
                } else if(dropdown.hasClass('uv-bottom-left')) {
                    dropdown.removeClass('uv-bottom-left')
                    dropdown.addClass('uv-top-left')
                }
            }
        }
    }

    $('div').scroll(function() {
        autoDropupDropdown()
    });

    $('.uv-dropdown-container#note ul li').on('click',function(e){
        var id = $(this).attr('data-id');
        $('.uv-dropdown-container#note').append('<input type="hidden" name="note_submit" value="'+id+'">');
        $('form[name="note-form"]').submit();
    });

    $('.uv-dropdown-container#replyTicket ul li').on('click',function(e){
        var id = $(this).attr('data-id');
        $('.uv-dropdown-container#replyTicket').append('<input type="hidden" name="note_submit" value="'+id+'">');
        $('form[name="replyTicket"]').submit();
    });

});

    $("#summernote").summernote({
        tabsize: 2,
        height: 200,
        toolbar: [
            ["style", ["style"]],
            ["font", ["bold", "underline", "clear"]],
            ["color", ["color"]],
            ["para", ["ul", "ol", "paragraph"]],
            ["table", ["table"]],
            ["insert", ["link", "picture", "video"]],
            //   ['insert', ['picture', 'video']],
            //   ['insert', ['picture']],
            ["view", ["fullscreen", "help"]],
            //   ['view', ['fullscreen']]
        ],
    });
    $("#note").summernote({
        // placeholder: 'Describe your details here. ',
        tabsize: 2,
        height: 120,
        backColor: 'yellow',
        toolbar: [
            ["style", ["style"]],
            ["font", ["bold", "underline", "clear"]],
            ["color", ["color"]],
            ["para", ["ul", "ol", "paragraph"]],
            ["table", ["table"]],
            //   ['insert', ['link', 'picture', 'video']],
            //   ['insert', ['picture', 'video']],
            //   ['insert', ['picture']],
            //   ['view', ['fullscreen', 'codeview', 'help']]
            //   ['view', ['fullscreen']]
        ],
    });
</script>
<script>
       $(function(){
        if (window.matchMedia("(max-width: 767px)").matches) {
            
        } else {
            $(".sidebar-toggler").trigger("click");
        }
       });
       var app = angular.module('app',[]);
       app.controller('postController', function ($scope, $http) {
           $scope.related = [];
           $scope.relatedTicket = function (user,ticket_id) {
               $http.post('/admin/ticket/related/'+ticket_id+'/'+user).then(function (response) {
                   console.log(response.data);
                   $scope.related        = response.data;
               });
           };

           // ticket assignee;
           $('input[name=\'assigne\']').autocomplete({
    'source': function(request, response) {
    	$.ajax({
    		url: '{{ route('admin.ticket.assign.autocomplate') }}?filter_name=' +  encodeURIComponent(request),
    		dataType: 'json',
    		success: function(json) {
    			response($.map(json, function(item) {
                       return {
    					label: item['name'],
    					value: item['user_id'],
                           image: item['image'],
                           email: item['email'],
    				}
    			}));
    		}
    	});
    },
    'select': function(item) {
    	$('input[name=\'assigne\']').val(item['label']);
    	// $('input[name=\'assigne_id\']').val(item['value']);

           $.ajax({
               url:'{{ route('admin.ticket.assignee.user') }}',
               method:'post',
               data:{'assignee_row':item['value'],'selected':{{$data['ticket']}}},
               dataType:'json',
               beforeSend:function(){
                   $('.preloader').css('display','block');
               },
               success:function(response) {
                   $('.preloader').css('display','none');
                   if(response.status) {
                       $scope.getAssigneeList();
                       toastr.success(response.message);
                   } else {
                       toastr.error(response.message);
                   }
               },
               error:function(xhr,error){
                   toastr.error(response.message);
               }
           });
    }
       });

       $(document).on('click','.uv-app-task-section.new',function(){
           $('.preloader').css('display','block');
           let assignee_id = 0;
           if($(this).attr('title') != undefined) {
               assignee_id = $(this).attr('title');
           } else {
               assignee_id = 0;
           }
           $scope.assignesDelete(assignee_id);
           // $(this).remove();
       });
       $scope.html = '';
       $scope.assignesDelete = function (id) {
           $http.post('/admin/ticket/get/assigne/delete/'+id+'').then(function (response) {
               if(response.data.error) {
                   $('.preloader').css('display','none');
                   toastr.error(response.data.message);
               } else {
                   $('.preloader').css('display','none');
                   toastr.success(response.data.message);
                   $scope.getAssigneeList();
               }
               // $scope.html        = response.data;
           });
       };
       $scope.getAssigneeList = function () {
           var ids = [];
           $('input[name="selected[]"]:checked').each(function(){
               ids.push($(this).val());
           });
           if(ids.length < 1) {
               ids.push(0);
           }

           $http.post('/admin/ticket/get/assigne/list/'+ids+'').then(function (response) {
               $scope.html = response.data;
           });
       };
       });
       function scrollToBottom(){
           div_height = $(".page-wrapper").height();
           div_offset = $("#myTabContent").offset().top;
           window_height = $(window).height();
           $('.page-wrapper').animate({
               scrollTop: div_offset-window_height+div_height
           },'slow');
       }

       $(document).ready(function() {
           scrollToBottom();
           $(document).on('click','.uv-mob-aside',function() {
               // $('#responsive').slideToggle('slow');
               $('#responsive').css({
                   'display': 'block !important',
               });
               $('#responsive').toggle({ direction: "left" }, 1000);

           });
       });
       $(function() {
           if(localStorage.getItem('pin') != 0) {
               $('#template-header .nav-tabs').css('position','fixed');
               $('#template-header .nav-tabs').css('top','60px');
               $('#template-header .nav-tabs').css('padding-top','25px');
               $('#template-header1').css('margin-top','65px');
            //    $('.template').css('margin-top','10px');
               $('#pinOnTop a').html('<i class="fas fa-map-marker-alt"></i>');
           }
           $(document).on('click','#pinOnTop a',function(){
               if(localStorage.getItem('pin') != 0) {
                   localStorage.setItem("pin", 0);
                   $('#template-header .nav-tabs').css('position','');
                   $('#template-header .nav-tabs').css('top','');
                   $('#template-header .nav-tabs').css('padding-top','');
                   $('#template-header1').css('margin-top','0px');
                //    $('.template').css('margin-top','10px');
                    $('#pinOnTop a').html('<i class="fas fa-map-marker-alt"></i>');
                   toastr.success('Unpinned on top');
               } else {
                   localStorage.setItem("pin", 1);
                   toastr.success('Pinned on top');
                   $('#template-header .nav-tabs').css({'position':'fixed','top':'60px','padding-top':'25px'});
                   $('#template-header1').css('margin-top','65px');
                //    $('.template').css('margin-top','10px');
                $('#pinOnTop a').html('<i class="fas fa-map-marker-alt"></i>');
               }

           });
       });
</script>
<script>
    $(document).ready(function(){
        var limit = 1;
        var active = "inbox";
        var max = {{ config('settings.ticket_module_attachment') }};
        $('#addFile').on('click', function() {
        limit++;
        if (max >= limit ) {
            html='';
            html += '<label class="attach-file pointer attach"  style="margin-left: 5px; margin-right: 5px;"><i class="fa fa-upload"style="cursor:pointer;"></i><input type="file" name="file[]"  class="files" style="display:none"  onchange="validate_fileupload(this);"><i class="fa fa-times remove-file pointer" style="cursor:pointer;background:#000;color:#fff;border-radius: 3px;padding: 5px;font-size: 7px;"></i></label>';
            $(this).prev().append(html);
            $(this).removeAttr('id');
        } else {
            limit--;
            toastr.warning("maximum limit of attachment is " + max);
        }
        });

        $(document.body).on('click', '.remove-file', function(event) {
        event.preventDefault();
        limit--;
        $(this).parent().remove();
        });
    });

    function validate_fileupload(thisthis)
    {
        var limit = 0;
        var max = {{ config('settings.ticket_module_attachment') }};
        var size=thisthis.files[0].size/1000;
        var maxsize = '{{ config('settings.ticket_module_filesize') }}';
        var allowed_extensions ={!! config('settings.ticket_module_extension') !!}
        if(thisthis.type == 'file') {
            fileName = thisthis.value;
            var file_extension = fileName.split('.').pop();
            for(var i = 0; i <= allowed_extensions.length && limit<=max; i++)
            {
                if(allowed_extensions[i]==file_extension && size<maxsize)
                {
                var getImagePath = URL.createObjectURL(thisthis.files[0]);
                    $(thisthis).parent().css('background-image', 'url(' + getImagePath + ')');
                    $(thisthis).parent().append(file_extension);
                    limit++;
                    return true;
                }
            }
        }
        if(limit>max)
            toastr.warning('Maximum Number of file is '+max);
        else
            toastr.warning("Invalid file type or size");
        thisthis.value="";
            return false;
    }
    $(document.body).on('mouseenter','.attach-file',function(){
    $(this).children().last().css("display","inline-block");
    });
    $(document.body).on('mouseleave','.attach-file',function(){
    $(this).children().last().css("display","none");
    });
    $(document).ready(function(){
        $(".filter-button").click(function(){
            $(".filter-button.active").removeClass("active");
            $(this).addClass("active");
            var value = $(this).attr('data-filter');
            if(value == "threads") {
                $('.filter').show('1000');
                $('#remove').remove();
            } else {
                $('#remove').remove();
                if(!$('.'+value).length){
                    $('.template-content-chat').append('<div id="remove" class="mt-2 h5 d-flex justify-content-center font-weight-bold">Oops! no '+value+' here.</div>');
                }
                $(".filter").not('.'+value).hide('3000');
                $('.filter').filter('.'+value).show('3000');
            }
        });
    });

    $(document).ready(function(){
        @if(!empty($errors->first('er')))
            toastr.warning('{{ $errors->first('er') }}');
        @endif
        @if(!empty($errors->first('success')))
            toastr.success('{{ $errors->first('success') }}');
        @endif

    });
</script>
@endsection
