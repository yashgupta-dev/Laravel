@extends('admin.layouts.my') @section('content')
<div ng-app="app" class="page-content">
    <div ng-controller="postController" class="profile-page tx-13">
        <div class="row">
            <div class="col-md-3" id="responsive">
                <div class="uv-aside">
                    <div class="uv-aside-default">
                        <div class="uv-aside-head">
                            <div class="uv-aside-title">
                                <h6>Tickets</h6>
                            </div>
                            <div class="uv-aside-back">
                                <span onclick="history.length > 1 ? history.go(-1) : window.location = '/en/member/dashboard';">Back</span>
                            </div>
                        </div>

                        <div class="uv-aside-nav">
                            <ul>
                                <!-- Predefined Label list -->
                                <ul class="predefined-label-list uv-aside-list">
                                    @if(!empty($data['filter_status']))
                                        @foreach($data['filter_status'] as $status)
                                            @if($status['status_id'] == 0) 
                                            <li>
                                                <a href="{{ route('admin.ticket') }}?status={{ $status['status_id'] }}#{{ $status['status'] }}" class="uv-aside-active">
                                                    {{$status['status']}}
                                                    <span class="uv-flag-gray uv-flag-dark">
                                                        {{ $status['count'] }}
                                                    </span>
                                                </a>                                                
                                            @else
                                                <ul class="status-list">
                                                    @if($status['is_selected'])
                                                    <li>
                                                        <a class="{{$status['active']}}" href="{{ route('admin.ticket') }}?status={{ $status['status_id'] }}#{{ $status['status'] }}">
                                                            {{ $status['status'] }}
                                                            <span class="uv-flag-gray uv-flag-dark">
                                                                {{ $status['count'] }}
                                                            </span>
                                                        </a>
                                                    </li>
                                                    @endif
                                                </ul>
                                            </li>
                                            @if(!$status['is_selected'])
                                            <li>
                                                <a href="{{ route('admin.ticket') }}?status={{ $status['status_id'] }}#{{ $status['status'] }}">
                                                    {{ $status['status'] }}
                                                    <span class="uv-flag-gray uv-flag-dark">
                                                        {{ $status['count'] }}
                                                    </span>
                                                </a>
                                            </li>
                                            @endif
                                            @endif
                                        @endforeach
                                    @endif
                                    
                                </ul>
                                <!-- //Predefined Label list -->
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-9" id="responsiveChat">
                <div class="row mb-2">
                    <div class="col-md-12">
                        <div class="d-flex justify-content-space-between float-right">
                            <button type="button" class="btn btn-primary ml-1 d-md-none" id="side-bar-logs-tickets"><i class="fa fa-angle-right"></i></button>
                            @include('layouts.filter')
                        </div>

                    </div>
                </div>    
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th></th>
                                <th>{{ __('#Ticket ID') }}</th>
                                <th>{{ __('Subject') }}</th>
                                <th>{{ __('Client') }}</th>
                                <th>{{ __('Timestamp') }}</th>
                                <th>{{ __('Last Reply') }}</th>
                                <th>{{ __('Replies') }}</th>
                                <th>{{ __('Agent') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($data['result'])> 0) @foreach($data['result'] as $row) @php($user=App\Models\User::select('name')->where('id',$row->user_id)->first())
                            @php($last_reply=App\Models\Ticket_message::select('created_at')->where('ticket_id',$row->id)->orderBy('id','desc')->first()) @php($count_reply=App\Models\Ticket_message::where(['ticket_id'=>$row->id])->count())

                            <tr @if(!$row->admin_read_status) style="background-color:#f9fafb;" @endif class="ticket-open" ticket_messages data-route="{{ route('admin.ticket.view',['ticket'=>$row->id,'client'=>$row->user_id]) }}">
                                <td>
                                    <div class="d-flex">
                                        <div>
                                            @if($row->priority == 0)
                                            <i class="fa fa-circle text-info" style="font-size: 8px;"></i>
                                            @elseif($row->priority == 1)
                                            <i class="fa fa-circle text-warning" style="font-size: 8px;"></i>
                                            @elseif($row->priority == 2)
                                            <i class="fa fa-circle text-danger" style="font-size: 8px;"></i>
                                            @endif
                                        </div>
                                        <div class="ml-1">
                                            <input type="checkbox" name="selected[]" value="{{ $row->id }}" />
                                        </div>
                                    </div>
                                </td>
                                <td>{{ __('#') }}{{ $row->id }}</td>
                                <td style="white-space: break-spaces;">{{ $row->subject }}</td>
                                <td>{{ $user->name }}</td>
                                <td><span class="badge badge-dark text-white font-weight-bold">{{ $row->created_at }}</span></td>
                                <td>@if(!empty($last_reply))<span class="badge badge-dark text-white font-weight-bold">{{ \Carbon\Carbon::parse($last_reply->created_at)->diffForHumans()}}</span>@else {{ __('No Reply') }}@endif</td>
                                <td class="font-weight-bold">{{ $count_reply }}</td>
                                <td>
                                    <div style="display: inline-flex;">
                                        @if(!$data['status']) 
                                        @php($ticketMessage=App\Models\Ticket::where('id',$row->id)->first()) 
                                            @if(count($ticketMessage->assigneusers) > 0) 
                                                @foreach($ticketMessage->assigneusers as $agentp)
                                                @php($ticketAssigneProfile=App\Models\Admin::select('name','profile')->where('id',$agentp->user_id)->first()) 
                                                    @if(!empty(json_decode($ticketAssigneProfile)))
                                                    <div class="text-center" style="width: 25%;" data-toggle="tooltip" data-placement="top" title="{{ json_decode($ticketAssigneProfile)->name }}">
                                                        @if(!in_array(json_decode($ticketAssigneProfile)->profile,['0','1','2','3','4']))
                                                            <img src="{{ asset('storage') }}/profile/{{ explode('/',json_decode($ticketAssigneProfile)->profile)[2] }}" alt="" style="border-radius: 5px; width: 30px; height: 30px; object-fit: cover;" />
                                                        @else
                                                            <img src="{{ asset('logo') }}/{{ json_decode($ticketAssigneProfile)->profile }}.png" alt="" style="border-radius: 5px; width: 30px; height: 30px; object-fit: cover;" />
                                                        @endif
                                                    </div>
                                                    <p class="ml-1">{{ json_decode($ticketAssigneProfile)->name }}</p>
                                                    @endif 
                                                @endforeach 
                                            @else 
                                            {{ __('Unassigned')}} 
                                            @endif 
                                        @else
                                        <div class="text-center" data-toggle="tooltip" data-placement="top" title="{{ $row->agent }}">
                                            @if(!in_array($row->agent_profile,['0','1','2','3','4']))
                                                <img src="{{ asset('storage') }}/profile/{{ explode('/',$row->agent_profile)[2] }}" alt="" style="border-radius: 5px; width: 30px; height: 30px; object-fit: cover;" />
                                            @else
                                                <img src="{{ asset('logo') }}/{{ $row->agent_profile }}.png" alt="" style="border-radius: 5px; width: 30px; height: 30px; object-fit: cover;" />
                                            @endif
                                        </div>
                                        @endif
                                    </div>
                                </td>
                            </tr>

                            @endforeach @else
                            <tr>
                                <td colspan="10">
                                    <div class="text-center">
                                        <p class="card-descrption">{{ __('Oops! No Records Available')}}</p>
                                    </div>
                                </td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
                @if(!empty($data['result']))
                <div class="p-4">
                    <div class="d-flex justify-content-end">
                        {{ $data['result']->links() }}
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>

@include('layouts.footer') @endsection @section('myscript')

<script>
    $(function () {
        
           $(document).on('click','button#side-bar-logs-tickets',function() {
               // $('#responsive').slideToggle('slow');
               $('#responsive').css({
                   'display': 'block !important',
               });
               $('#responsive').toggle({ direction: "left" }, 1000);

           });
      
        if (window.matchMedia("(max-width: 767px)").matches) {
            
        } else {
            $(".sidebar-toggler").trigger("click");
        }
    });
    
            $(".ticket-open").css("cursor", "pointer");
            $(document).on("click", ".ticket-open", function () {
                window.location = $(this).data("route");
            });
    
</script>
<script></script>
@endsection
