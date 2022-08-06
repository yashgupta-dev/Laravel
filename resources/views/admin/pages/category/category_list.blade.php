@extends('admin.layouts.my')
@section('content')
<div class="page-content">
    <div class="profile-page tx-13">
        <div class="row">
            <div class="col-md-12">
                <nav class="page-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Category List</li>
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
                                    <a href="{{  route('admin.category.add')  }}" class="btn btn-primary ml-1"><i class="fa fa-plus"></i> {{  __('Add') }}</a>
                                    <button type="button" id="delete_btn" class="btn btn-danger ml-1"><i class="fa fa-trash-alt"></i> {{  __('Delete') }}</button>
                                    @include('layouts.filter')
                                </div>
                            </div>
                        </div>
                    <form action="{{ route('admin.category.delete') }} " method="post" enctype="multipart/form-data" id="form-category">
                        @csrf
						<div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 1px;" class="text-center"><input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" /></th>
                                        <th>{{ __('Name') }}</th>
                                        <th>{{ __('Status') }}</th>
                                        <th>{{ __('Created') }}</th>
                                        <th>{{ __('Last Modified') }}</th>
                                        <th>{{ __('Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($data) > 0 )
                                        @foreach($data as $row)
                                        <tr>
                                            <td><input type="checkbox" name="selected[]" value="{{ $row->category_id }}" /></td>
                                            <td>{!! $row->name !!}</td>
                                            <td>@if($row->status) {{ __('Enable') }} @else {{ __('Disable') }} @endif</td>
                                            <td>{{ $row->created_at }}</td>
                                            <td>{{ $row->updated_at }}</td>
                                            <td><a href="{{ route('admin.category.edit',['edit'=>$row->category_id]) }}" class="btn btn-sm btn-info"><i class="fa fa-edit"></i>{{ __('Edit') }}</a></td>
                                        </tr>
                                        @endforeach
                                    @else
                                    <tr>
                                        <td colspan="6">
                                            <div class="text-center">
                                                <p class="card-descrption">Oops! no data found.</p>
                                            </div>
                                        </td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </form>
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
                            $('#form-category').submit();
                        }
                    },
                    close: function () {}
                }
            });
        });
    });
</script>
@endsection