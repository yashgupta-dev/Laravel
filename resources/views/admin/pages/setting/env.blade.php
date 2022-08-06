@extends('admin.layouts.my')
@section('content')
<div class="page-content">
    <div class="profile-page tx-13">
        <div class="row">
            <div class="col-md-12">
                <nav class="page-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Env</li>
                    </ol>
                </nav>
            </div>
            
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Configration File</h6>
						<div class="panel panel-default">
                        <div class="panel-body">
                            <form class="form-env" action="{{ route('admin.web.edit.env') }}" method="post">
                            @csrf
                            <textarea wrap="off" rows="20" name="env" class="form-control">{{ $env }}</textarea>

                            <button class="btn btn-danger btn-center mt-2">{{ 'Save file' }}</button>
                            </form>
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