@extends('admin.layouts.my')
@section('content')
<div class="page-content">
    <div class="profile-page tx-13">
        <div class="row">
            <div class="col-md-12">
                <nav class="page-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Users List</li>
                    </ol>
                </nav>
            </div>
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6"><h6 class="card-title">{{ __('Category List') }}</h6></div>
                            <div class="col-md-6">
                                <div class="d-flex justify-content-space-between float-right">
                                    <a href="#" class="btn btn-primary ml-1"><i class="fa fa-plus"></i> {{  __('Add') }}</a>
                                    <button type="button" id="delete_btn" class="btn btn-danger ml-1"><i class="fa fa-trash-alt"></i> {{  __('Delete') }}</button>
                                    @include('layouts.filter')
                                </div>
                            </div>
                        </div>
                        <style>
                        .table th, .table td {
                            font-size: 12px;
                        }
                        </style>
                        <h6 class="card-title">{{ __('Users Record') }}</h6>
						<div class="table-responsive">
                            <table class="table table-striped">
								<thead>
								    <tr>
                                        <th style="width: 1px;" class="text-center"><input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" /></th>
                                        <th>{{ __('Profile') }} </th>
										<th>{{ __('Name') }} </th>
										<th>{{ __('Phone') }} </th>
                                        <th>{{ __('Email') }} </th>
                                        <th>{{ __('Role') }} </th>
                                        <th>{{ __('verify') }} </th>                                        
										<th>{{ __('created') }} </th>
                                        <th>{{ __('action') }} </th>
									</tr>
								</thead>
								<tbody>
								    
                                    @if(count($client) > 0 )
                                        @foreach($client as $row)
                                    <tr>
                                        <td><input type="checkbox" name="selected[]" value="{{ $row->id }}" /></td>
                                        <td class="py-1">
                                        @if(!in_array($row->profile,['0','1','2','3','4']))
                                            <img class="profile-pic" src="{{ asset('storage') }}/profile/{{ explode('/',$row->profile)[2] }}" alt="{{ $row->name }}" style="width:38px; height:38px; object-fit:cover;">
                                        @else
                                            <img class="profile-pic" src="{{ asset('logo') }}/{{ $row->profile }}.png" alt="{{ $row->name }}">
                                        @endif
                                        </td>
										<td>{{ $row->name }}</td>
										<td>
                                            <a href="tel:{{$row->phone}}"><span class="font-weight-bold text-dark">{{ $row->phone }}</span></a>
                                        </td>
                                        <td>
                                            <a href="mail:{{$row->email}}"><span class="font-weight-bold text-dark">{{ $row->email }}</span></a>
										</td>
										<td>
                                            @php($role = App\Models\Role::where('id',$row->role->role_id)->select('name')->first())
                                            <span class="badge badge-danger font-weight-bold text-white">{{ $role->name }}</span>                                            
                                        </td>
                                        <td>
                                            @if(!empty($row->email_verified_at))
                                                <span class="font-weight-bold text-success"><i class="fa fa-check"></i></span>
                                            @else
                                            <span class="font-weight-bold text-danger"><i class="fa fa-times"></i></span>
                                            @endif
                                        </td>
                                        <td>
                                            @if(!empty($row->authenticate_type))
                                                <span class="badge badge-dark text-white font-weight-bold">{{ $row->authenticate_type }}</span>
                                            @else
                                            <span class="badge badge-dark text-white font-weight-bold">{{ 'Website' }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="badge badge-dark text-white font-weight-bold">{{ \Carbon\Carbon::parse($row->created_at)->diffForHumans()}}</span>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-between">
                                                <div>
                                                    <a href="" class="text-secondary"><i data-feather="share"></i></a>
                                                </div>
                                                <div>
                                                    <a href="" class="text-"><i data-feather="pause"></i></a>
                                                </div>
                                            </div>
                                        </td>
                                        @endforeach
                                    </tr>
                                    @else
                                    <tr>
                                        <td colspan="6">
                                            <div class="text-center">
                                                <p class="card-descrption">Oops! no record found.</p>
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
                            {{ $client->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('layouts.footer')

@endsection