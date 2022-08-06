@extends('admin.layouts.my')
@section('content')
<div class="page-content">
    <div class="profile-page tx-13">
        <div class="row">
            <div class="col-md-12">
                <nav class="page-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">{{ __('Home') }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ __('Permission') }}</li>
                    </ol>
                </nav>
            </div>
            
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6"><h6 class="card-title">{{ __('User Permission') }}<h6></div>
                            <div class="col-md-6">
                                <div class="d-flex justify-content-space-between float-right">
                                    <a href="{{ route('admin.web.role.add') }}" class="btn btn-dark ml-1"><i class="fa fa-plus"></i> {{  __('Add Role') }}</a>
                                    <button type="button" id="delete_btn" class="btn btn-danger ml-1"><i class="fa fa-trash-alt"></i> {{  __('Delete') }}</button>
                                    <a href="{{ route('admin.create.user') }}"  class="btn btn-info ml-1"><i class="fa fa-user"></i> {{  __('Create User') }}</a>
                                    @include('layouts.filter')
                                </div>
                            </div>
                        </div>
                        <form action="{{ route('admin.usergroup.delete') }} " method="post" enctype="multipart/form-data" id="form-group">
                        @csrf
                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                        <td style="width: 1px;" class="text-center"><input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" /></td>
                                            <th>{{ __('Role') }} </th>
                                            <th>{{ __('Role Descrption') }}</th>
                                            <th>{{ __('Edit') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                        @if(count($roles) > 0 )
                                            @foreach($roles as $row)
                                        <tr>
                                            <td><input type="checkbox" name="selected[]" value="{{ $row->id }}" /></td>
                                            <td>{{ $row->name }}</td>
                                            <td>{{ $row->description }}</td>
                                            <td>
                                            <a href="{{ route('admin.web.setting.permission.roles',['role'=>$row->id,'name'=>$row->name]) }}" class="btn btn-xs btn-info"> <i class="fa fa-edit"></i> </a>
                                            </td>
                                            @endforeach
                                        </tr>
                                        @else
                                        <tr>
                                            <td colspan="6">
                                                <div class="text-center">
                                                    <p class="card-descrption">Oops! no permission found.</p>
                                                </div>
                                            </td>
                                        </tr>
                                        @endif
                                            
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer bg-light p-4">
                        <div class="d-flex justify-content-end">
                            {{ $roles->links() }}
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
        $(document).on('click','#delete_btn',function(){
            $.confirm({
                title: 'Confirmation',
                content: 'Do you really want to delete?',
                type: 'danger',
                typeAnimated: true,
                buttons: {
                    tryAgain: {
                        text: 'confirm',
                        btnClass: 'btn-danger',
                        action: function(){
                            $('#delete_btn').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
                            $('#form-group').submit();
                        }
                    },
                    close: function () {}
                }
            });
        });
    });
</script>
@endsection