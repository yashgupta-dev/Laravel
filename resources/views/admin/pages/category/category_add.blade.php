@extends('admin.layouts.my')
@section('content')
<style>
    .nav-tabs {
    margin-bottom: 25px;
}

.nav-tabs {
    border-bottom: 1px solid #ddd;
}
.nav-tabs > li.active > a, .nav-tabs > li.active > a:hover, .nav-tabs > li.active > a:focus {
    font-weight: bold;
    color: #333;
}

.nav-tabs > li.active > a, .nav-tabs > li.active > a:hover, .nav-tabs > li.active > a:focus {
    color: #555;
    background-color: #fff;
    border: 1px solid #ddd;
    border-bottom-color: transparent;
    cursor: default;
}
.nav-tabs > li > a {
    color: #a5a5a5;
    border-radius: 2px 2px 0 0;
}
.nav-tabs > li > a {
    margin-right: 2px;
    line-height: 1.42857;
    border: 1px solid transparent;
    border-radius: 3px 3px 0 0;
}
.nav > li > a {
    position: relative;
    display: block;
    padding: 10px 15px;
}
    .nav-tabs > li > a {
    color: #a5a5a5;
    border-radius: 2px 2px 0 0;
}
.nav-tabs > li > a {
    margin-right: 2px;
    line-height: 1.42857;
    border: 1px solid transparent;
    border-radius: 3px 3px 0 0;
}
</style>
<div class="page-content">
    <div class="profile-page tx-13">
        <div class="row">
            <div class="col-md-12">
                <nav class="page-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.category') }}">Category List</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Category Add</li>
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
                                    <button type="submit" form-id="form-category" class="btn btn-primary ml-1"><i class="fa fa-save"></i> {{  __('Save') }}</button>
                                    <a href="#" class="btn btn-danger ml-1"><i class="fa fa-undo"></i> {{  __('Back') }}</a>
                                </div>
                            </div>
                        </div>
						<div class="table-responsive">
                        <form action="{{ route('admin.category_add') }}" method="post" enctype="multipart/form-data" id="form-category" class="form-horizontal">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#tab-general" data-toggle="tab" aria-expanded="true">{{ __('General') }}</a></li>
                                <li class=""><a href="#tab-data" data-toggle="tab" aria-expanded="false">{{ __('Data') }}</a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab-general">
                                    <div class="tab-content">
                                        <div class="tab-pane active">
                                            <div class="form-group required">
                                                <label class="col-sm-2 control-label" for="input-name1">{{ __('Category Name') }} <span class="text-danger">*</span></label>
                                                <div class="col-sm-10">
                                                    @csrf
                                                    <input type="text" name="name" value="{{ old('name') }}" placeholder="Category Name" id="input-name1" class="form-control @if(!empty($errors->first('name'))) is-invalid @endif"/>
                                                    @if(!empty($errors->first('name')))
                                                    <div class="">
                                                        <small class="text-danger">{{ $errors->first('name') }}</small>
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tab-data">
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="input-parent">{{ __('Parent') }}</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="path" value="{{ old('path') }}" placeholder="{{ __('Parent category') }}" id="input-parent" class="form-control @if(!empty($errors->first('path'))) is-invalid @endif @if(!empty($errors->first('parent_id'))) is-invalid @endif" />
                                            <input type="hidden" name="parent_id" value="{{ old('parent_id') }}" />
                                            @if(!empty($errors->first('parent_id')))
                                                <div class="">
                                                    <small class="text-danger">{{ $errors->first('parent_id') }}</small>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="input-status">{{ __('Status' ) }}</label>
                                        <div class="col-sm-10">
                                            <select name="status" id="input-status" class="form-control">
                                                <option value="1" selected="selected">{{ __('Enabled') }}</option>
                                                <option value="0">{{ __('Disabled') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
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
<script>
    $(document).delegate('.nav,.nav-tabs li','click',function(){
        $(this).addClass('active').siblings().removeClass('active');
    });
    $('input[name=\'path\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: '{{ route('admin.category.autocomplete') }}?filter_name=' +  encodeURIComponent(request),
			dataType: 'json',
			success: function(json) {
                
				json.unshift({
					category_id: 0,
					name: ' --- None --- '
				});

				response($.map(json, function(item) {
                    return {
						label: item['name'],
						value: item['category_id']
					}
				}));
                
			}
		});
	},
	'select': function(item) {     
		$('input[name=\'path\']').val(item['label']);
		$('input[name=\'parent_id\']').val(item['value']);
	}
});
</script>
@endsection