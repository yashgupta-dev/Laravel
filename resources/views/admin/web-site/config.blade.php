@extends('admin.layouts.my')
@section('content')
<div class="page-content">
    <div class="profile-page tx-13">
        <div class="row">
            <div class="col-md-12">
                <nav class="page-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">{{ __('Home') }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ __('Settings') }}</li>
                    </ol>
                </nav>
            </div>
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">{{ __('Modules List') }}</h6>
						<div class="table-responsive">
                            <table class="table table-striped table-hover table-bordered">
								<thead>
								    <tr>
                                        <th>{{ __('Name') }}</th>
										<th>{{ __('Status') }}</th>
                                        <th>{{ __('Action') }}</th>
									</tr>
								</thead>
								<tbody>
								    
                                    @if(count($extension) > 0 )
                                        @foreach($extension as $row)
                                    <tr>
                                        <td>{{ $row['name'] }}</td>
                                        <td>
                                        @if(!empty($row['status']))
                                            @if($row['status'] != 1)
                                                {{ __('Disable') }}
                                            @else 
                                                {{ __('Enable')}}
                                            @endif
                                        @else
                                            {{ __('Disable') }}
                                        @endif
                                        </td>
                                        <td>
                                        <a href="{{ $row['path'] }}" class="btn btn-xs btn-info"> <i class="fa fa-edit"></i> </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr>
                                        <td colspan="6">
                                            <div class="text-center">
                                                <p class="card-descrption">Oops! no settings found.</p>
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
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('layouts.footer')
@endsection