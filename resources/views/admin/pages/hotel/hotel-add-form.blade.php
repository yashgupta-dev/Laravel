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
.table td img {
    width: 80px;
    height: 80px;
    border:1px solid #dde;
    border-radius:8px;
}

</style>
<div class="page-content">
    <div class="profile-page tx-13">
        <div class="row">
            <div class="col-md-12">
                <nav class="page-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.hotel.list') }}">Hotel List</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $data['hotel_title'] }}</li>
                    </ol>
                </nav>
            </div>
            <div class="col-md-12 error-screen"></div>
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6"><h6 class="card-title">{{ __('Hotel Add') }}</h6></div>
                            <div class="col-md-6">
                                <div class="d-flex justify-content-space-between float-right">
                                    <button type="submit" form-id="form-hotel" id="btn-add-hotel" class="btn btn-primary ml-1"><i class="fa fa-save"></i> {{  __('Save') }}</button>
                                    <a href="#" class="btn btn-danger ml-1"><i class="fa fa-undo"></i> {{  __('Back') }}</a>
                                </div>
                            </div>
                        </div>
						<div class="table-responsive">
                        <form method="post"  onsubmit="return addHotel()" enctype="multipart/form-data" id="form-hotel" class="form-horizontal">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#tab-general" data-toggle="tab" aria-expanded="true">{{ __('General') }}</a></li>
                                <li class=""><a href="#tab-data1" data-toggle="tab" aria-expanded="false">{{ __('Data') }}</a></li>
                                <li class=""><a href="#tab-data2" data-toggle="tab" aria-expanded="false">{{ __('Hotel Details ') }}</a></li>
                                <li class=""><a href="#tab-data3" data-toggle="tab" aria-expanded="false">{{ __('Image') }}</a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab-general">
                                    <div class="tab-content">
                                        <div class="tab-pane active">
                                            <div class="form-group required">
                                                <label class="col-sm-2 control-label" for="input-name1">{{ __('Hotel Name') }} <span class="text-danger">*</span></label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="hotel_name" value="{{ old('name') }}" placeholder="Hotel Name" id="input-name1" class="form-control @if(!empty($errors->first('name'))) is-invalid @endif"/>
                                                    @csrf
                                                </div>
                                            </div>
                                            <div class="form-group required">
                                                <label class="col-sm-2 control-label" for="input-name1">{{ __('Short Description') }} <span class="text-danger">*</span></label>
                                                <div class="col-sm-10">
                                                    <textarea class="form-control" placeholder="short descption" rows="5" name="hotel_short_desc"></textarea>
                                                </div>
                                            </div>

                                            <div class="form-group required">
                                                <label class="col-sm-2 control-label" for="input-name1">{{ __('Hotel Description') }} <span class="text-danger">*</span></label>
                                                <div class="col-sm-10">
                                                    <textarea class="form-control" id="summernote" name="hotel_desc"></textarea>
                                                </div>
                                            </div>

                                            <div class="form-group required">
                                                <label class="col-sm-2 control-label" for="meta_name">{{ __('Meta Tag Title') }} <span class="text-danger">*</span></label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="hotel_meta" value="{{ old('meta_name') }}" placeholder="Meta Tag Title" id="meta_name" class="form-control"/>                                                    
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label" for="meta_desc">{{ __('Meta Tag Description') }}</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="hotel_meta_tag" value="{{ old('meta_desc') }}" placeholder="Meta Tag Description" id="meta_desc" class="form-control"/>                                                    
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-2 control-label" for="mets_keyword">{{ __('Meta Tag Keywords') }}</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="hotel_keywords" value="{{ old('mets_keyword') }}" placeholder="Meta Tag Keywords" id="mets_keyword" class="form-control"/>                                                    
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane " id="tab-data1">
                                    <div class="tab-content">
                                        <div class="tab-pane active">
                                            <div class="form-group">
                                                <label for="customer_name">{{ __('Create Hotel For Customer') }} </label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="assigne" id="assigne" class="form-control" placeholder="{{ __('select customer assignee by name or email') }}">
                                                    <input type="hidden" name="assigne_id" id="assigne_id" class="form-control">
                                                    <small class="text-font-weight-light">{{ __('Or invite a new member by name or email address') }}</small>
                                                </div>
                                            </div>

                                            <div class="form-group required">
                                                <label class="col-sm-2 control-label" for="input-status">{{ __('Status') }} <span class="text-danger">*</span></label>
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

                                <div class="tab-pane " id="tab-data2">
                                    <div class="tab-content">
                                        <div class="tab-pane active">
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label" for="input-country">{{  __('Country') }}</label>
                                                <div class="col-sm-10">
                                                    <select class="form-control" name="country" id="input-country">
                                                        <option value="">{{ __('----- select -----') }}</option>
                                                        @if(count($data['countrys']) > 0)
                                                            @foreach($data['countrys'] as $country)
                                                            <option value="{{ $country->id }}">{{ $country->name }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label" for="input-city">{{  __('City') }}</label>
                                                <div class="col-sm-10">
                                                    <select class="form-control" name="city" id="input-city">

                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group required">
                                                <label class="col-sm-2 control-label" for="input-address">{{ __('Choose Address') }} <span class="text-danger">*</span></label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="hotel_address" value="{{ old('address') }}" placeholder="Choose Address Name" id="input-address" class="form-control"/> 
                                                    <input type="hidden" id="latitude" name="latitude" class="form-control d-none">
                                                    <input type="hidden" name="longitude" id="longitude" class="form-control d-none">
                               
                                                </div>
                                            </div>   
                                            <div class="form-group required">
                                                <label class="col-sm-2 control-label" for="input-email">{{ __('E-Mail') }} <span class="text-danger">*</span></label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="hotel_email" value="{{ old('email') }}" placeholder="E-Mail" id="input-email" class="form-control"/>                                                    
                                                </div>
                                            </div>   
                                            <div class="form-group required">
                                                <label class="col-sm-2 control-label" for="input-website">{{ __('Website') }}</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="website" value="{{ old('website') }}" placeholder="Website Name" id="input-website" class="form-control"/>                                                    
                                                </div>
                                            </div>   
                                            <div class="form-group required">
                                                <label class="col-sm-2 control-label" for="input-contact">{{ __('Contact ') }} <span class="text-danger">*</span></label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="hotel_phone" value="{{ old('contact') }}" placeholder="Contact" id="input-contact" class="form-control"/>                                                    
                                                </div>
                                            </div>   
                                            <div class="form-group required">
                                                <label class="col-sm-2 control-label" for="input-fax">{{ __('Fax No.') }} </label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="hotel_fax" value="{{ old('fax') }}" placeholder="Fax No." id="input-fax" class="form-control"/>                                                    
                                                </div>
                                            </div>
                                            <div class="form-group required">
                                                <label class="col-sm-2 control-label" for="input-bookingcheckin">{{ __('Check-In') }} <span class="text-danger">*</span></label>
                                                <div class="col-sm-10">
                                                    <input type="time" class="form-control" name="bookingcheckin" value="{{ __('06:30') }}" id="bookingcheckin">  
                                                </div>
                                            </div>
                                            <div class="form-group required">
                                                <label class="col-sm-2 control-label" for="input-name1">{{ __('Check-Out') }} <span class="text-danger">*</span></label>
                                                <div class="col-sm-10">
                                                    <input type="time" class="form-control" name="bookingcheckout" value="{{ __('23:00') }}" id="bookingcheckout">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="tab-pane " id="tab-data3">
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
@include('layouts.footer')
@endsection
@section('myscript')

<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?libraries=places&key={{ config('settings.google_module_api_key') }}" type="text/javascript"></script>
<script>
        google.maps.event.addDomListener(window, 'load', initialize);
  
        function initialize() {
            var input = document.getElementById('input-address');
            var autocomplete = new google.maps.places.Autocomplete(input);
  
            autocomplete.addListener('place_changed', function () {
                var place = autocomplete.getPlace();
                $('#latitude').val(place.geometry['location'].lat());
                $('#longitude').val(place.geometry['location'].lng());
            });
        }
</script>

<script>
$(function(){
    $(document).on('change','#input-country',function(){        
        var country_id = $(this).val();
        
        $.ajax({
            url: '{{ route('admin.hotel.get-country-citys') }}',
            data: {'country_id':country_id},
            cache: false,            
            type: "post",
            dataType: "json",
            beforeSend: function () {
                $('#input-country').addClass('disabled');
            },
            success: function (json) {    
                $('#input-country').removeClass('disabled');       
                if(!json.success) {
                    var cityid = localStorage.getItem('cityCode');
                    html = '<option value="0">----- None -----</option>';
                    $.each(json.message, function( index, value ) {
                        if(cityid == value.id) {
                            html += '<option value="'+value.id+'" selected>'+value.name+'</option>';
                        } else {
                            html += '<option value="'+value.id+'">'+value.name+'</option>';
                        }
                    });
                    $('select#input-city').html(html);
                } else {
                    toastr.error(json.message);
                }
            },
            error:function(xhr,error){
                $('#input-country').removeClass('disabled');       
            }
        });
    });
});
$(document).delegate('.nav,.nav-tabs li','click',function(){
    $(this).addClass('active').siblings().removeClass('active');
});
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
        //   ['insert', ['picture', 'video']],
        //   ['insert', ['picture']],
          ['view', ['fullscreen', 'help']]
        //   ['view', ['fullscreen']]
        ]
      });

      var image_row = 0;

function addImage() {
  html  = '<tr id="image-row' + image_row + '">';
  html += ' <td class="text-left">'
                +'<a href="javascript:;" id="thumb-image' + image_row + '">'
                    +'<img src="{{ asset('logo/placeholder/placeholder.jpg') }}" class="img_click_hotel" data-id="hotel_gallery'+image_row+'" alt="" id="changeImage'+image_row+'"/>'
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

$('input[name=\'assigne\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: '{{ route('admin.hotel.customer.autocomplate') }}?filter_name=' +  encodeURIComponent(request),
			dataType: 'json',
			success: function(json) {
				response($.map(json, function(item) {
                    return {
						label: item['name'],
						value: item['user_id'],
                        image: item['image'],
                        email: item['email'],
					}
				}));                
			}
		});
	},
	'select': function(item) {     
		$('input[name=\'assigne\']').val(item['label']);
		$('input[name=\'assigne_id\']').val(item['value']);       
	}
});

@if($data['edit'])
$(function(){
   $.ajax({
        url: '{{ route('admin.hotel.fetch.hotel-edit') }}',
        data: {'id':{{ $data['id'] }}},
        cache: false,
        type: "post",
        dataType: "json",
        beforeSend: function () {
            $('.preloader').css('display','block');            
        },
        success:function(json)  {
            if(!json.success) {
                $.each(json.message, function( index, value ) {
                    $.each(value, function( i, v ) {
                        if(i == 'status' || i == 'image' || i == 'gallery' || i == 'country' || i == 'city' || i == 'hotel_desc' || i == 'hotel_short_desc') {
                            if(i == 'status') {
                                $('#input-status option[value="'+v+'"]').attr('selected','selected');
                            }
                            if(i == 'hotel_short_desc') {
                                $('textarea[name=\''+i+'\']').val(v);
                            }
                            if(i == 'image') {
                                v1 = v.split('public')[1];                                
                                $('#hotel_main_img').parent().append('<input type="hidden" name="hotel_main_img_name" value="'+v+'" class="form-control">');
                                $('#hotel_main_img').parent().find('img').attr('src','/storage'+v1+'');
                            }
                            if(i == 'country') {
                                $('#input-country option[value="'+v+'"]').attr('selected','selected');
                                $('#input-country').trigger('change');
                            }
                            if(i == 'city') {
                                localStorage.setItem('cityCode', v);
                            }
                            if(i == 'gallery') {
                                $.each(JSON.parse(v), function( gi, gv ) {
                                    gv1 = gv[gi].split('public')[1];
                                    html  = '<tr id="image-row' + gi + '">';
                                    html += ' <td class="text-left">'
                                                    +'<a href="javascript:;" id="thumb-image' + gi + '">'
                                                        +'<img src="/storage'+gv1+'" class="img_click_hotel" data-id="hotel_gallery'+gi+'" alt="" id="changeImage'+gi+'"/>'
                                                    +'</a>'
                                                    +'<input type="hidden" name="hotel_gallery_name" value="'+gv+'" class="form-control">'
                                                    +'<input type="file" name="hotel_gallery[]" class="d-none" id="hotel_gallery'+gi+'" data-id="changeImage'+gi+'" onchange="validate_fileuploadgallery(this);">'
                                                +'</td>';
                                    
                                    html += '  <td class="text-left"><button type="button" onclick="$(\'#image-row' + gi  + '\').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
                                    html += '</tr>';

                                    $('#images tbody').append(html);

                                    image_row++;
                                });
                            }
                        } else  {
                            $('input[name=\''+i+'\']').val(v);
                        }
                    });
                });
            } else {
                toastr.warning(json.message);
            }
        },
        error:function(xhr,error){
            toastr.error(error);
        }
   });
});
@endif
function addHotel() {
    var formData = new FormData($("form#form-hotel")[0]);
    $.ajax({
        url: '{{ $data['route'] }}',
        data: formData,
        async: false,
        cache: false,
        contentType: false,
        processData: false,
        type: "post",
        dataType: "json",
        beforeSend: function () {
            $('.preloader').css('display','block');            
        },
        success: function (json) {           
            $('.preloader').css('display','none');
            if(!json.success) {
                $('form#form-hotel')[0].reset();
                $('#description').summernote('code', '');
                $('.text-left a img').attr('src','/logo/placeholder/placeholder.jpg');
                $('.error-screen').append('<div class="alert alert-fill-'+json.color+' alert-dismissible fade show" role="alert">'+
                    '<strong>'+json.ss+'! </strong>'+json.message+''+
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
                    '<span aria-hidden="true">&times;</span>'+
                    '</button>'+
                    '</div>');
            } else {
                $('.error-screen').append('<div class="alert alert-fill-danger" alert-dismissible fade show" role="alert">'+
                    '<strong>Warning! </strong>Please fill fields carefully.<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
                    '<span aria-hidden="true">&times;</span>'+
                    '</button>'+
                    '</div>');
                $('input.form-control').removeClass('is-invalid');
                $('.font-weight-bold.text-danger').html('');
                $.each(json, function( index, value ) {
                    $('input[name=\''+index+'\']').addClass('is-invalid');
                    if(index == 'hotel_desc') {
                        $('textarea[name=\''+index+'\']').addClass('is-invalid');
                    }
                    if(index == 'hotel_short_desc') {
                        $('textarea[name=\''+index+'\']').addClass('is-invalid');
                    }
                    $.each(value, function(value1, i ) {                        
                        $('#'+value1+''+index).remove();
                        $('input[name=\''+index+'\']').parent().append('<div id="'+value1+''+index+'" class="font-weight-bold text-danger">'+i+'</div>');
                        if(index == 'hotel_desc') {
                            $('textarea[name=\''+index+'\']').parent().append('<div id="'+value1+''+index+'" class="font-weight-bold text-danger">'+i+'</div>');
                        }
                        if(index == 'hotel_short_desc') {
                            $('textarea[name=\''+index+'\']').parent().append('<div id="'+value1+''+index+'" class="font-weight-bold text-danger">'+i+'</div>');
                        }
                    });
                });
                if(json.alert-error) {
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

</script>
@endsection