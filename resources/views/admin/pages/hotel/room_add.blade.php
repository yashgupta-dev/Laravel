@extends('admin.layouts.my')
@section('content')
<style>.nav-tabs{margin-bottom:25px}.nav-tabs{border-bottom:1px solid #ddd}.nav-tabs>li.active>a,.nav-tabs>li.active>a:focus,.nav-tabs>li.active>a:hover{font-weight:700;color:#333}.nav-tabs>li.active>a,.nav-tabs>li.active>a:focus,.nav-tabs>li.active>a:hover{color:#555;background-color:#fff;border:1px solid #ddd;border-bottom-color:transparent;cursor:default}.nav-tabs>li>a{color:#a5a5a5;border-radius:2px 2px 0 0}.nav-tabs>li>a{margin-right:2px;line-height:1.42857;border:1px solid transparent;border-radius:3px 3px 0 0}.nav>li>a{position:relative;display:block;padding:10px 15px}.nav-tabs>li>a{color:#a5a5a5;border-radius:2px 2px 0 0}.nav-tabs>li>a{margin-right:2px;line-height:1.42857;border:1px solid transparent;border-radius:3px 3px 0 0}ul.nav.nav-tabs a.active{color:#fff;border:1px solid #727cf5!important;background:#727cf5!important;border-bottom:0!important}.form-group.required.row.has-error{border-bottom:1px solid #cccccc61;padding:25px 0;width:100%}div#tab-data4 select.form-control{margin-bottom:10px}div#tab-data5 img{width:100px;height:100px}div#tab-data3 span.input-group-addon{margin:30px}.text-left a img{width:120px;height:100px;border-radius:0;background-color:#fff;border:2px solid #d5d3d3}.text-left a{padding:0}.dropdown-menu > li > a {display: block;padding: 5px 20px;clear: both;font-weight: normal;line-height: 1.42857;color: #333;white-space: nowrap;}.dropdown-menu {position: absolute;top: 100%;left: 0;z-index: 1000;display: none;float: left;min-width: 160px;padding:5px 0;margin: 2px 0 0;list-style: none;font-size: 13px;text-align: left;background-color: #fff;border: 1px solid #ccc;border: 1px solid rgba(0, 0, 0, .15);border-radius: 3px;-webkit-box-shadow: 0 6px 12px rgb(0 0 0 / 18%);box-shadow: 0 6px 12px rgb(0 0 0 / 18%);background-clip: padding-box;}
</style>
<div ng-app="app" class="page-content">
    <div ng-controller="roomController" ng-init="autoloadContent()" class="profile-page tx-13">
        <div class="row">
            <div class="col-md-12">
                <nav class="page-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.hotel.room') }}">Room List</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Room Add</li>
                    </ol>
                </nav>
            </div>
            <div class="col-md-12 error-screen"></div>
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h6 class="card-title">{{ __('Room Add') }}</h6>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex justify-content-space-between float-right">
                                    <button type="submit" form-id="form-room" class="btn btn-primary ml-1"><i class="fa fa-save"></i> {{ __('Save') }}</button>
                                    <a href="#" class="btn btn-danger ml-1"><i class="fa fa-undo"></i> {{ __('Back') }}</a>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <form method="post" onsubmit="return addRoom()" enctype="multipart/form-data" id="form-room" class="form-horizontal">
                                <ul class="nav nav-tabs">
                                    <li class=""><a class="active" href="#tab-general" data-toggle="tab" aria-expanded="true">{{ __('General') }}</a></li>
                                    <li class=""><a href="#tab-data1" data-toggle="tab" aria-expanded="false">{{ __('Data') }}</a></li>
                                    <li class=""><a href="#tab-data2" data-toggle="tab" aria-expanded="false">{{ __('Hotel') }}</a></li>
                                    <li class=""><a href="#tab-data3" data-toggle="tab" aria-expanded="false">{{ __('Fixed Facilities') }}</a></li>
                                    <li class=""><a href="#tab-data4" data-toggle="tab" aria-expanded="false">{{ __('Optional Facilities') }}</a></li>
                                    <li class=""><a href="#tab-data5" data-toggle="tab" aria-expanded="false">{{ __('Image') }}</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab-general">
                                        <div class="tab-content">
                                            <div class="tab-pane active">
                                                <div class="form-group required">
                                                    <label class="col-sm-2 control-label" for="input-name1">{{ __('Room Name') }} <span class="text-danger">*</span></label>
                                                    <div class="col-sm-10">
                                                        @csrf
                                                        <input type="text" name="name" value="{{ old('name') }}" placeholder="Room  Name" id="input-name1" class="form-control @if(!empty($errors->first('name'))) is-invalid @endif" />
                                                    </div>
                                                </div>
                                                <div class="form-group required">
                                                    <label class="col-sm-2 control-label" for="input-name1">{{ __('Room Description') }}</label>
                                                    <div class="col-sm-10">
                                                        <textarea class="form-control" id="summernote" name="editordata"> </textarea>
                                                    </div>
                                                </div>

                                                <div class="form-group required">
                                                    <label class="col-sm-2 control-label" for="input-name1">{{ __('Meta Tag Title') }} <span class="text-danger">*</span></label>
                                                    <div class="col-sm-10">
                                                        <input type="text" name="meta" value="{{ old('meta') }}" placeholder="Meta Tag Title" id="input-name1" class="form-control @if(!empty($errors->first('meta'))) is-invalid @endif" />
                                                    </div>
                                                </div>                                                
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="tab-data1">
                                        <div class="tab-content">
                                            <div class="tab-pane active">
                                                <div class="form-group required">
                                                    <label class="col-sm-2 control-label" for="input-name1">{{ __('Price(per night)') }} <span class="text-danger">*</span></label>
                                                    <div class="col-sm-10">
                                                        <input type="text" name="price" value="{{ old('price') }}" placeholder="Price(per night)" id="input-name1" class="form-control @if(!empty($errors->first('price'))) is-invalid @endif" />
                                                    </div>
                                                </div>
                                                <div class="form-group required">
                                                    <label class="col-sm-2 control-label" for="input-name1">{{ __('Quantity') }}</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" name="qty" value="{{ old('qty') }}" placeholder="Quantity" id="input-name1" class="form-control @if(!empty($errors->first('qty'))) is-invalid @endif" />
                                                    </div>
                                                </div>
                                                <div class="form-group required">
                                                    <label class="col-sm-2 control-label" for="input-name1">{{ __('Room Number Prefix') }}</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" name="room_prefix" value="{{ old('room_prefix') }}" placeholder="Room Number Prefix" id="input-name1" class="form-control @if(!empty($errors->first('room_prefix'))) is-invalid @endif" />
                                                    </div>
                                                </div>
                                                <div class="form-group required">
                                                    <label class="col-sm-2 control-label" for="input-name1">{{ __('Booking id Prefix') }}</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" name="booking_prefix" value="{{ old('booking_prefix') }}" placeholder="Booking id Prefix" id="input-name1" class="form-control @if(!empty($errors->first('booking_prefix'))) is-invalid @endif" />
                                                    </div>
                                                </div>
                                                <div class="form-group required">
                                                    <label class="col-sm-2 control-label" for="input-name1">{{ __('Max Adult') }}</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" name="adult" value="{{ old('adult') }}" placeholder="Max Adult" id="input-name1" class="form-control @if(!empty($errors->first('adult'))) is-invalid @endif" />
                                                    </div>
                                                </div>
                                                <div class="form-group required">
                                                    <label class="col-sm-2 control-label" for="input-name1">{{ __('Max Child') }}</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" name="child" value="{{ old('child') }}" placeholder="Max Child" id="input-name1" class="form-control @if(!empty($errors->first('child'))) is-invalid @endif" />
                                                    </div>
                                                </div>
                                                <div class="form-group required">
                                                    <label class="col-sm-2 control-label" for="input-name1">{{ __('Booking From') }} <span class="text-danger">*</span></label>
                                                    <div class="col-sm-10">
                                                        <input type="date" name="booking_from" value="{{ old('booking_from') }}" placeholder="Booking From" id="input-name1" class="form-control @if(!empty($errors->first('booking_from'))) is-invalid @endif" />
                                                    </div>
                                                </div>
                                                <div class="form-group required">
                                                    <label class="col-sm-2 control-label" for="input-name1">{{ __('Booking Till') }} <span class="text-danger">*</span></label>
                                                    <div class="col-sm-10">
                                                        <input type="date" name="booking_to" value="{{ old('booking_to') }}" placeholder="Booking Till" id="input-name1" class="form-control @if(!empty($errors->first('booking_to'))) is-invalid @endif" />
                                                    </div>
                                                </div>
                                                <div class="form-group required">
                                                    <label class="col-sm-2 control-label" for="input-name1">{{ __('Status') }}</label>
                                                    <div class="col-sm-10">
                                                        <select name="status" id="input-status" class="form-control">
                                                            <option value="1" selected="selected">Enable</option>
                                                            <option value="0">Disable</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-pane" id="tab-data2">
                                        <div class="tab-content">
                                            <div class="tab-pane active">
                                                <div class="form-group required">
                                                    <label class="col-sm-2 control-label" for="input-name1">{{ __('Room Type') }}</label>
                                                    <div class="col-sm-10">
                                                        <select name="room_category" id="input-room_category" class="form-control">
                                                            @if(count($data['category']) > 0) 
                                                                <option value="">{{ __('---- select room type ----')  }}</option>
                                                                @foreach($data['category'] as $cate) 
                                                                <option value="{{$cate->category_id}}">{{ $cate->name }}</option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group required">
                                                    <label class="col-sm-2 control-label" for="input-name1">{{ __('Assign Hotel') }} <span class="text-danger">*</span></label>
                                                    <div class="col-sm-10 well well-sm" style="height: 165px; overflow: auto; background: #ededed; padding: 15px; border-radius: 5px;">
                                                    <label for="0" style="display: table-row-group;">
                                                        <input type="radio" checked name="hotel_id" value="" id="0" />
                                                        {{ __('None') }}
                                                    </label>
                                                    <label ng-repeat="hotel in hotelList" for="@{{hotel.id}}" style="display: table-row-group;">
                                                        <input type="radio" name="hotel_id" value="@{{hotel.id}}" id="@{{hotel.id}}" />
                                                        @{{hotel.hotel_name}}
                                                    </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-pane" id="tab-data3">
                                        <div class="table-responsive">
                                            <table id="attribute" class="table table-striped table-bordered table-hover">
                                                <thead>
                                                    <tr>
                                                        <td class="text-left">Fixed Facility (AutoComplete)</td>
                                                        <td class="text-left">About</td>
                                                        <td></td>
                                                    </tr>
                                                </thead>
                                                <tbody></tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td colspan="2"></td>
                                                        <td class="text-left">
                                                            <button type="button" onclick="addAttribute();" data-toggle="tooltip" title="" class="btn btn-primary" data-original-title="Add Facility"><i class="fa fa-plus-circle"></i></button>
                                                        </td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="tab-pane" id="tab-data4">
                                        <table class="table table-striped table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <td class="text-center" style="font-weight: normal;">Facility Name</td>
                                                    <td class="text-center" style="font-weight: normal;">Facility Price</td>
                                                    <td class="text-center" style="font-weight: normal;"></td>
                                                </tr>

                                                <tr ng-repeat="optionfacility in optionFacility">
                                                    <td class="text-center" style="font-weight: normal;">@{{ optionfacility.optional_facilitie_name }}

                                                    <td class="text-center" style="font-weight: normal;">
                                                        <select name="product_option_value[@{{optionfacility.id}}][price_prefix]" class="form-control">
                                                            <option value="+" style="font-weight: normal;" selected="selected">+</option>
                                                            <option value="-" style="font-weight: normal;">-</option>
                                                        </select>
                                                        <input type="text" name="product_option_value[@{{optionfacility.id}}][price]" value="" placeholder="" class="form-control" />
                                                        <input type="hidden" name="product_option_value[@{{optionfacility.id}}][option_value_id]" value="@{{optionfacility.id}}" />
                                                    </td>
                                                    <td class="text-center" style="width: 38%;">
                                                        <select name="product_option_value[@{{optionfacility.id}}][status]" class="form-control" style="font-weight: normal;">
                                                            <option value="0" selected style="font-weight: normal;">Disable</option>
                                                            <option value="1" style="font-weight: normal;">Enable</option>
                                                        </select>
                                                    </td>
                                                    <input type="hidden" name="product_option_id" value="" />
                                                </tr>
                                                
                                            </thead>
                                        </table>
                                    </div>

                                    <div class="tab-pane" id="tab-data5">
                                       <div class="table-responsive">
                                          <table class="table table-striped table-bordered table-hover">
                                             <thead>
                                             <tr>
                                                <td class="text-left"></td>
                                             </tr>
                                             </thead>
                                             <tbody>
                                             <tr>
                                                   <td class="text-left">
                                                      <a href="javascript:;" id="thumb-image">
                                                      <img src="{{ asset('logo/placeholder/placeholder.jpg') }}" onclick="document.getElementById('hotel_main_img').click();" alt="" id="changeImage"></a>
                                                      <input type="file" name="hotel_main_img" class="d-none" id="hotel_main_img" onchange="validate_fileupload(this);">                                                    
                                                   </td>
                                             </tr>
                                             </tbody>
                                          </table>
                                       </div>
                                       <div class="table-responsive">
                                          <table id="images" class="table table-striped table-bordered table-hover">
                                             <thead>
                                             <tr>
                                                   <td class="text-left">More Images</td>                                                
                                                   <td></td>
                                             </tr>
                                             </thead>
                                             <tbody>
                                             </tbody>
                                             <tfoot>
                                             <tr>
                                                   <td colspan="1"></td>
                                                   <td class="text-left"><button type="button" onclick="addImage();" data-toggle="tooltip" title="" class="btn btn-primary" data-original-title="Add Image"><i class="fa fa-plus-circle"></i></button></td>
                                             </tr>
                                             </tfoot>
                                          </table>
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
@include('layouts.footer') @endsection @section('myscript')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.2/angular.min.js"></script>  
<script>
    $('#summernote').summernote({
        tabsize: 2,
        height: 200,
        toolbar: [
          ['style', ['style']],
          ['font', ['bold', 'underline', 'clear']],
          ['color', ['color']],
          ['para', ['ul', 'ol', 'paragraph']],
          ['table', ['table']],
          ['insert', ['link', 'picture', 'video']],
          ['view', ['fullscreen', 'help']]
          ['view', ['fullscreen']]
        ]
    });

    var attribute_row = 0;

    function addAttribute() {
        html  = '<tr id="attribute-row' + attribute_row + '">';
        html += '  <td class="text-left" style="width: 20%;"><input type="text" name="product_attribute[' + attribute_row + '][name]" value="" placeholder="Fixed Facility (AutoComplete)" class="form-control" /><input type="hidden" name="product_attribute[' + attribute_row + '][attribute_id]" value="" /></td>';
        html += '  <td class="text-left">';
        html += '<div class="input-group"><span class="input-group-addon"></span><textarea name="product_attribute[' + attribute_row + '][product_attribute_description]" rows="5" placeholder="About" class="form-control"></textarea></div>';
        html += '  </td>';
        html += '  <td class="text-left"><button type="button" onclick="$(\'#attribute-row' + attribute_row + '\').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
        html += '</tr>';
      
        $('#attribute tbody').append(html);

        attributeautocomplete(attribute_row);

      attribute_row++;
    }

    function attributeautocomplete(attribute_row) {
    
      $('input[name=\'product_attribute[' + attribute_row + '][name]\']').autocomplete({
        'source': function(request, response) {
            $.ajax({
                url: '{{ route('admin.hotel.room.attribute.autocomplate') }}?filter_name=' +  encodeURIComponent(request),
                dataType: 'json',
                success: function(json) {
                    response($.map(json, function(item) {
                        return {
                            category: item.attribute_group,
                            label: item.name,
                            value: item.attribute_id
                        }
                    }));                
                }
            });
        },
        'select': function(item) {     
            $('input[name=\'product_attribute[' + attribute_row + '][name]\']').val(item['label']);
            $('input[name=\'product_attribute[' + attribute_row + '][attribute_id]\']').val(item['value']);
        }
      });
    }
    var image_row = 0;

    function addImage() {
        html  = '<tr id="image-row' + image_row + '">';
        html += ' <td class="text-left">'
                +'<a href="javascript:;" id="thumb-image' + image_row + '">'
                +'<img src="{{ asset('logo/placeholder/placeholder.jpg') }}" class="img_click_hotel" data-id="hotel_gallery'+image_row+'" alt="" id="changeImage'+image_row+'" class="img-80"/>'
                +'</a>'
                +'<input type="file" name="hotel_gallery[]" class="d-none" id="hotel_gallery'+image_row+'" data-id="changeImage'+image_row+'" onchange="validate_fileuploadgallery(this);">'
                +'</td>';         
        html += '  <td class="text-left"><button type="button" onclick="$(\'#image-row' + image_row  + '\').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
        html += '</tr>';

        $('#images tbody').append(html);
        image_row++;
    }

    $(document).on('click','.img_click_hotel',function(){
        var getTriggerId = $(this).data('id');
        $('#'+getTriggerId).trigger('click');
    });

    function validate_fileuploadgallery(thisthis)
    {
        
        var limit = 1;
        var max = {{ config('settings.config_max_upload_size') }};
        var size=thisthis.files[0].size/1000;
        var maxsize = '{{ config('settings.ticket_module_filesize') }}';
        var allowed_extensions ={!! config('settings.config_mime_type') !!}
        var showId = $(thisthis).data('id');
        if(thisthis.type == 'file') {
            fileName = thisthis.value;
            var file_extension = fileName.split('.').pop();
            for(var i = 0; i <= allowed_extensions.length && limit<=max; i++)
            {
                if(allowed_extensions[i]==file_extension && size<maxsize)
                {
                var getImagePath = URL.createObjectURL(thisthis.files[0]);

                    $('#'+showId).attr('src', getImagePath);
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
    function validate_fileupload(thisthis)
    {
        var limit = 1;
        var max = {{ config('settings.config_max_upload_size') }};
        var size=thisthis.files[0].size/1000;
        var maxsize = '{{ config('settings.ticket_module_filesize') }}';
        var allowed_extensions ={!! config('settings.config_mime_type') !!}
        if(thisthis.type == 'file') {
            fileName = thisthis.value;
            var file_extension = fileName.split('.').pop();
            for(var i = 0; i <= allowed_extensions.length && limit<=max; i++)
            {
                if(allowed_extensions[i]==file_extension && size<maxsize)
                {
                var getImagePath = URL.createObjectURL(thisthis.files[0]);
                    
                    $('#changeImage').attr('src', getImagePath);
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

    var app = angular.module('app',[]);

    app.controller('roomController', function ($scope, $http) {
        $scope.hotelList = [];
        $scope.optionFacility = [];
        $scope.autoloadContent = function () {
            $http.post('{{ route("admin.hotel.room.get-content") }}').then(function (response) {
                $scope.hotelList        = response.data.hotellist;
                $scope.optionFacility   = response.data.optionfacility;
            });
        };

    });

    function addRoom() {
    var formData = new FormData($("form#form-room")[0]);
    $.ajax({
        url: '{{ route('admin.hotel.room.add') }}',
        data: formData,
        async: false,
        cache: false,
        contentType: false,
        processData: false,
        type: "post",
        dataType: "json",
        beforeSend: function () {
            console.log('before');
            $('.preloader').css('display','block');            
        },
        success: function (json) {            
            $('.preloader').css('display','none');
            if(!json.success) {
                $('form#form-room')[0].reset();
                $('#editordata').summernote('code', '');
                $('.text-left a img').attr('src','/logo/placeholder/placeholder.jpg');

                $('.error-screen').append('<div class="alert alert-fill-'+json.color+' alert-dismissible fade show" role="alert">'+
                    '<strong>'+json.ss+'! </strong>'+json.message+''+
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
                    '<span aria-hidden="true">&times;</span>'+
                    '</button>'+
                    '</div>');
                if(json.redirect){
                    window.location.href=json.redirect;
                }
            } else {
                $('.error-screen').append('<div class="alert alert-fill-danger" alert-dismissible fade show" role="alert">'+
                    '<strong>Warning! </strong>Please fill fields carefully.<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
                    '<span aria-hidden="true">&times;</span>'+
                    '</button>'+
                    '</div>');

                $('input.form-control').removeClass('is-invalid');
                $('.font-weight-bold.text-danger').html('');
                $.each(json, function( index, value ) {
                    $('input[name=\''+index+'\'').addClass('is-invalid');
                    if(index == 'editordata') {
                        $('textarea[name=\''+index+'\'').addClass('is-invalid');
                    }
                    
                    $.each(value, function(value1, i ) {                        
                        
                        $('#'+value1+''+index).remove();                        
                        $('input[name=\''+index+'\'').parent().append('<div id="'+value1+''+index+'" class="font-weight-bold text-danger">'+i+'</div>');
                        if(index == 'room_category') {
                            $('select[name="'+index+'"]').addClass('is-invalid');
                            $('select[name="'+index+'"]').parent().append('<div id="'+value1+''+index+'" class="font-weight-bold text-danger">'+i+'</div>');
                        }
                        if(index == 'editordata') {
                            $('textarea[name=\''+index+'\'').parent().append('<div id="'+value1+''+index+'" class="font-weight-bold text-danger">'+i+'</div>');
                        }
                    });
                });

                if(json.error_alert) {
                    $('.error-screen').append('<div class="alert alert-fill-'+json.color+' alert-dismissible fade show" role="alert">'+
                    '<strong>'+json.ss+'! </strong>'+json.message+''+
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
                    '<span aria-hidden="true">&times;</span>'+
                    '</button>'+
                    '</div>');
                }
            }
            
        },
        error:function(jxxhr,xhr,error) {
            $('.preloader').css('display','none');
            $('.error-screen').append('<div class="alert alert-fill-warning alert-dismissible fade show" role="alert">'+
                    '<strong>Warning! </strong>'+error+''+
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
                    '<span aria-hidden="true">&times;</span>'+
                    '</button>'+
                    '</div>');
        }
    });
    return false;
}

    // Autocomplete */
(function($) {
	$.fn.autocomplete = function(option) {
		return this.each(function() {
			var $this = $(this);
			var $dropdown = $('<ul class="dropdown-menu" />');

			this.timer = null;
			this.items = [];

			$.extend(this, option);

			$this.attr('autocomplete', 'off');

			// Focus
			$this.on('focus', function() {
				this.request();
			});

			// Blur
			$this.on('blur', function() {
				setTimeout(function(object) {
					object.hide();
				}, 200, this);
			});

			// Keydown
			$this.on('keydown', function(event) {
				switch(event.keyCode) {
					case 27: // escape
						this.hide();
						break;
					default:
						this.request();
						break;
				}
			});

			// Click
			this.click = function(event) {
				event.preventDefault();

				var value = $(event.target).parent().attr('data-value');

				if (value && this.items[value]) {
					this.select(this.items[value]);
				}
			}

			// Show
			this.show = function() {
				var pos = $this.position();                
				$dropdown.css({
					top: pos.top + $this.outerHeight(),
					left: pos.left
				});

				$dropdown.show();
			}

			// Hide
			this.hide = function() {
				$dropdown.hide();
			}

			// Request
			this.request = function() {
				clearTimeout(this.timer);

				this.timer = setTimeout(function(object) {
					object.source($(object).val(), $.proxy(object.response, object));
				}, 200, this);
			}

			// Response
			this.response = function(json) {
				var html = '';
				var category = {};
				var name;
				var i = 0, j = 0;

				if (json.length) {
					for (i = 0; i < json.length; i++) {
						// update element items
						this.items[json[i]['value']] = json[i];

						if (!json[i]['category']) {
							// ungrouped items
							html += '<li data-value="' + json[i]['value'] + '"><a href="#">' + json[i]['label'] + '</a></li>';
						} else {
							// grouped items
							name = json[i]['category'];
							if (!category[name]) {
								category[name] = [];
							}

							category[name].push(json[i]);
						}
					}

					for (name in category) {
                        html += '<li class="dropdown-header">' + name + '</li>';

						for (j = 0; j < category[name].length; j++) {
							html += '<li data-value="' + category[name][j]['value'] + '"><a href="#">&nbsp;&nbsp;&nbsp;' + category[name][j]['label'] + '</a></li>';
						}
					}
				}

				if (html) {
					this.show();
				} else {
					this.hide();
				}

				$dropdown.html(html);
			}

			$dropdown.on('click', '> li > a', $.proxy(this.click, this));
			$this.after($dropdown);
		});
	}
})(window.jQuery);
</script>

@endsection