@extends('layouts.my')
@section('content')
<div class="page-content">
    <div class="profile-page tx-13">
        <div class="row">
            <div class="col-md-12">
                <nav class="page-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Tickets List</li>
                    </ol>
                </nav>
            </div>
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-md-8"><h6 class="card-title">{{ __('My Tickets') }}</h6></div>
                            <div class="col-md-4">
                                <div class="d-flex justify-content-end">
                                    <a href="{{ route('home.support.add') }}" class="btn btn-secondary"><i class="fa fa-plus-circle"></i> {{  __('Raise Ticket') }}</a>                                    
                                </div>
                            </div>
                        </div>

						<div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th style="width: 1px;" class="text-center"><input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" /></th>
                                        <th>{{ __('#Ticket ID') }}</th>
                                        <th></th>
                                        <th>{{ __('Agent') }}</th>
                                        <th>{{ __('Subject') }}</th>                                        
                                        <th>{{ __('Last Reply') }}</th>
                                        <th>{{ __('Replies') }}</th>
                                        <th>{{ __('Status') }}</th>
                                        <th>{{ __('Timestamp') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
								    
                                    @if(count($data) > 0 )
                                        @foreach($data as $row)
                                        @php($count_reply=App\Models\Ticket_message::where(['ticket_id'=>$row->id,'user_id'=>0])->count())
                                    <tr @if(!$row->user_read_status) style="background-color:#f9fafb;" @endif class="ticket-open" data-route="{{ route('home.support.ticket',['ticket'=>$row->id]) }}">
                                        <td><input type="checkbox" name="selected[]" value="{{ $row->id }}" /></td> 
										<td>{{ __('#') }}{{ $row->id }}</td>
										<td>
                                            @if($row->priority == 0)
                                            <i class="fa fa-circle text-info" style="font-size:8px;"></i>
                                            @elseif($row->priority == 1) 
                                            <i class="fa fa-circle text-warning" style="font-size:8px;"></i>
                                            @elseif($row->priority == 2) 
                                            <i class="fa fa-circle text-danger" style="font-size:8px;"></i>
                                            @endif
                                        </td>
                                        <td>
                                            @if(!empty($row->assign))
                                            <div class="text-center" data-toggle="tooltip" data-placement="top" title="{{ $row->assign->agent['name'] }}">
                                                @if(!in_array($row->assign->agent['profile'],['0','1','2','3','4']))
                                                    <img src="{{ asset('storage') }}/profile/{{ explode('/',$row->assign->agent['profile'])[2] }}" alt="" style="border-radius: 50px;width: 30px;height: 30px;object-fit: cover;">
                                                @else
                                                    <img src="{{ asset('logo') }}/{{ $row->assign->agent['profile'] }}.png" alt="" style="border-radius: 50px;width: 30px;height: 30px;object-fit: cover;">
                                                @endif                                                
                                            </div>
                                            <span class="text-center font-weight-bold" style="font-size:12px;">{{ $row->assign->agent['name']}}</span>                               
                                            @else
                                            {{ __('Unassigned')}}
                                            @endif
                                        </td>
                                        <td style="white-space: break-spaces;">{{ $row->subject }}</td>                                    
                                        
                                        <td><span class="badge badge-dark text-white font-weight-bold">{{ \Carbon\Carbon::parse($row->last_reply['created_at'])->diffForHumans()}}</span></td>
                                        <td class="font-weight-bold">{{ $count_reply }}</td>
                                        <td>
                                            <span class="font-weight-bold">{{ $row->getStatus->status_name }}</span>
                                        </td>
                                        <td><span class="badge badge-dark text-white font-weight-bold">{{ date('d-m-y h:i a', strtotime($row->created_at)) }}</span></td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr>
                                        <td colspan="9">
                                            <div class="text-center">
                                                <p class="card-descrption">Oops! no tickets found.</p>
                                            </div>
                                        </td>
                                    </tr>
                                    @endif
									    
									</tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer bg-light p-4">
                        <div class="d-flex justify-content-end">
                        {{ $data->links() }}
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
<script>
    $(function(){
        $('.ticket-open').css('cursor','pointer');
        $(document).on('click','.ticket-open',function(){
            window.location = $(this).data("route");
        });
    });
</script>
@endsection