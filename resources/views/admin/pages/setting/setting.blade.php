@extends('admin.layouts.my')
@section('content')
<div class="page-content">
    <div class="profile-page tx-13">
        <div class="row">
            <div class="col-md-12">
                <nav class="page-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Error Logs</li>
                    </ol>
                </nav>
            </div>
            
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                        <h6 class="card-title">Error Logs</h6>
                        <form method="post" action="{{ route('admin.web.clear_error_log') }}">
                            @csrf
                            <button class="btn btn-warning btn-sm"><i class="fas fa-broom"></i> Clear</button>
                        </form>
                        </div>
						<div class="panel panel-default">
                        <div class="panel-body">
                            @if($log != 1)
                            <textarea wrap="on" rows="20" readonly class="form-control">{{ $log }}</textarea>
                            @else 
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong><i class="fa fa-info-circle"></i></strong> Error logs file size is crossed 5 MB.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @endif
                        </div>
                        </div>
					</div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('layouts.footer')

@endsection