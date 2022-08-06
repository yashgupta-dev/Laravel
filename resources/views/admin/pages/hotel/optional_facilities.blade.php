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
   .table td img{
       width: 16px;
       height: 11px;
       border-radius: 0px;
   }
   .input-group-addon{border: 1px solid #ddd;
    width: 33px;
    height: 34px;
    padding-top: 8px;
    padding-left: 7px;
   }
</style>
<div class="page-content">
   <div class="profile-page tx-13">
      <div class="row">
         <div class="col-md-12">
            <nav class="page-breadcrumb">
               <div class="row">
                  <div class="col-md-12">
                     <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                        <li class="breadcrumb-item"aria-current="page">Optional Facilities</li>
                     </ol>
                  </div>                  
               </div>
            </nav>
         </div>
         <div class="col-md-12 error-screen"></div>
         <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
               <div class="card-body">
                  <div class="row">
                     <div class="col-md-6"><h6 class="card-title">{{ __('Optional Facilities List') }}</h6></div>
                     <div class="col-md-6">
                         <div class="d-flex justify-content-space-between float-right">
                              <button type="submit" form-id="form-option-facilities" class="btn btn-primary ml-1"><i class="fa fa-save"></i> {{  __('Save') }}</button>                     
                              @include('layouts.filter')
                         </div>
                     </div>
                  </div>   
                  <div class="table-responsive">
                     <form method="post" onsubmit="return addoptionfacilities()" enctype="multipart/form-data" id="form-option-facilities" class="form-horizontal">
                        <table id="option-value" class="table table-striped">
                           <thead>
                              <tr>
                                 <td class="text-left required">Facility Name</td>
                                 <td class="text-left">Facility Icon</td>
                                 <td class="text-right">Sort order</td>
                                 <td></td>
                              </tr>
                           </thead>
                           <tbody>
                              @if(count($data)>0)
                                 @foreach($data as $row) 
                                 <tr id="option-value-row{{$row->id}}">
                                    <td class="text-left"><input type="hidden" name="option_value_id[]" value="{{ $row->id }}"/>
                                       <div class="input-group">
                                          <span class="input-group-addon"><img src="{{ asset('logo/en-gb.png') }}" title="English" /></span>
                                          <input type="text" name="option_facilitie[]" value="{{ $row->optional_facilitie_name }}" placeholder="Facility Name" class="form-control"/>
                                       </div>
                                    </td>
                                    <td class="text-left">
                                       <a href="javascript:;">
                                          <img src="@if(!empty($row->optional_facilitie_icon)) {{ asset('storage') }}{{ explode('public',$row->optional_facilitie_icon)[1] }} @else{{ asset('logo/placeholder/placeholder.jpg') }}@endif" class="img_click_hotel" data-id="hotel_gallery{{$row->id}}" alt="" id="changeImage{{$row->id}}" style="width:40px; height:40px; object-fit:cover;border-radius:8px;"/>
                                       </a>
                                       <input type="file" name="hotel_gallery[]" class="d-none" id="hotel_gallery{{$row->id}}" data-id="changeImage{{$row->id}}" onchange="validate_fileuploadgallery(this);">
                                    </td>
                                    <td class="text-right">
                                       <input type="text" name="sort_order[]" value="{{ $row->optional_facilitie_sort }}" placeholder="Sort order" class="form-control" id="sort_order{{$row->id}}"/>
                                    </td>
                                    <td class="text-left">
                                       <button type="button" onclick="removeId({{ $row->id }})" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button>
                                    </td>
                                 </tr>
                                 @endforeach
                              @else
                              <tr>
                                 <td colspan="4" class="text-center">{{ __('Oops! no result available') }}</td>
                              </tr>
                              @endif
                           </tbody>
                           <tfoot>
                              <tr>
                                 <td colspan="3"></td>
                                 <td class="text-left"><button type="button" onclick="addOptionValue();" data-toggle="tooltip" title="" class="btn btn-primary" data-original-title="Add Facility"><i class="fa fa-plus-circle"></i></button></td>
                              </tr>
                           </tfoot>
                        </table>
                     </form>
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
<script type="text/javascript">
var option_value_row = 0;
function addOptionValue() {
	html  = '<tr id="option-value-row' + option_value_row + '">';
   html += '<td class="text-left"><input type="hidden" name="option_value_id[]"/>';
   html += '<div class="input-group">';
	html += '<span class="input-group-addon"><img src="{{ asset('logo/en-gb.png') }}" title="English" /></span><input type="text" name="option_facilitie[]" placeholder="Facility Name" class="form-control" id="option_facilitie."'+option_value_row+'" />';
   html += '</div>';
	html += '</td>';
   html += ' <td class="text-left">'
                +'<a href="javascript:;" id="thumb-image' + option_value_row + '">'
                    +'<img src="{{ asset('logo/placeholder/placeholder.jpg') }}" class="img_click_hotel" data-id="hotel_gallery'+option_value_row+'" alt="" id="changeImage'+option_value_row+'" style="width:40px; height:40px; object-fit:cover;border-radius:8px;"/>'
                +'</a>'
                +'<input type="file" name="hotel_gallery[]" class="d-none" id="hotel_gallery'+option_value_row+'" data-id="changeImage'+option_value_row+'" onchange="validate_fileuploadgallery(this);">'
            +'</td>';
	html += '<td class="text-right"><input type="text" name="sort_order[]" value="0" placeholder="Sort order" class="form-control" id="sort_order."'+option_value_row+'"/></td>';
	html += '<td class="text-left"><button type="button" onclick="$(\'#option-value-row' + option_value_row + '\').remove();" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
	html += '</tr>';
	$('#option-value tbody').append(html);
	option_value_row++;
}

$(document).on('click','.img_click_hotel',function(){
    var getTriggerId = $(this).data('id');
    $('#'+getTriggerId).trigger('click');
});
function removeId(id) {
   $.ajax({
        url: '{{ route('admin.hotel.optional.facilities.delete') }}',
        data: {'id':id},
        type: "post",
        dataType: "json",
        beforeSend: function () {
            $('.preloader').css('display','block');            
        },
        success: function (json) {           
            
            if(json.error){
                $.each(json, function( index, value ) {
                    $.each(value, function(value1, i ) {
                       if(index != 'error'){
                           toastr.info(i);
                       }
                    });
                });
            }
            
            if(json.success) {
               $('#option-value-row'+id).remove();
                $('.error-screen').append('<div class="alert alert-fill-'+json.color+' alert-dismissible fade show" role="alert">'+
                    '<strong>'+json.ss+'! </strong>'+json.message+''+
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
                    '<span aria-hidden="true">&times;</span>'+
                    '</button>'+
                    '</div>');
            }
            $('.preloader').css('display','none');
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
}
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
function addoptionfacilities() {
   var formData = new FormData($("form#form-option-facilities")[0]);
    $.ajax({
        url: '{{ route('admin.hotel.optional.facilities.add') }}',
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
            
            if(json.error){
                $.each(json, function( index, value ) {
                    $.each(value, function(value1, i ) {
                       if(index != 'error'){
                           toastr.info(i);
                       }
                    });
                });
            }
            
            if(json.success) {
                $('.error-screen').append('<div class="alert alert-fill-'+json.color+' alert-dismissible fade show" role="alert">'+
                    '<strong>'+json.ss+'! </strong>'+json.message+''+
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
                    '<span aria-hidden="true">&times;</span>'+
                    '</button>'+
                    '</div>');
               if(json.redirect) {
                  window.location.href=json.redirect;
               }
            }
            $('.preloader').css('display','none');
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
//-->
</script>
@endsection