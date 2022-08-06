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
            <div class="row">                  
                  <div class="col-md-12">
                     <ol class="breadcrumb" style="    margin-top: 20px;">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.hotel.facilities') }}">Facilities List</a></li>
                        <li class="breadcrumb-item"  aria-current="page">Add Facilities</li>
                     </ol>
                  </div>                  
               </div>               
            </nav>
         </div>
         
         <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
               <div class="card-body">
                  <div class="row">
                      <div class="col-md-6"><h6 class="card-title">{{ __('Facilities Add') }}</h6></div>
                      <div class="col-md-6">
                          <div class="d-flex justify-content-space-between float-right">                              
                              <button type="submit" form-id="form-facilities" id="btn-add-hotel" class="btn btn-primary ml-1"><i class="fa fa-save"></i> {{  __('Save') }}</button>                     
                              <a href="{{ route('admin.hotel.facilities') }}" class="btn btn-danger ml-1"><i class="fa fa-undo"></i> {{  __('Back') }}</a>
                          </div>
                      </div>
                  </div>
                  <div class="table-responsive">                     
                     <form method="post" onsubmit="return addfacilities()" enctype="multipart/form-data" id="form-facilities" class="form-horizontal">
                        <div class="form-group required">
                           <label class="col-sm-2 control-label">Facility Name</label>
                           <div class="col-sm-10">
                              <input type="text" name="name" placeholder="Facility Name" id="input-name" class="form-control">
                           </div>
                        </div>
                        <div class="form-group">
                           <label class="col-sm-2 control-label">Facility Icon</label>
                           <div class="col-sm-10">
                              <a href="javascript:;" id="thumb-image" data-toggle="image">
                                 <img src="{{ asset('logo/placeholder/placeholder.jpg') }}" onclick="document.getElementById('icon').click();" alt="" id="changeImage" class="img-80">
                              </a>
                              <input type="file" name="icon" class="d-none" id="icon" onchange="validate_fileupload(this);">
                           </div>
                        </div>
                        <div class="form-group">
                           <label class="col-sm-2 control-label" for="status">Status</label>
                           <div class="col-sm-10">
                              <select name="status" id="status" class="form-control">
                                 <option value="0" "selected"="">Disable</option>
                                 <option value="1">Enable</option>
                              </select>
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
          //   ['insert', ['picture', 'video']],
          //   ['insert', ['picture']],
            ['view', ['fullscreen', 'help']]
          //   ['view', ['fullscreen']]
          ]
   });

   function validate_fileupload(thisthis){
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
        
function addfacilities() {
   var formData = new FormData($("form#form-facilities")[0]);
    $.ajax({
        url: '{{ route('admin.hotel.facilities.add.form') }}',
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
                $('input.form-control').removeClass('is-invalid');
                $('.font-weight-bold.text-danger').html('');
                $.each(json, function( index, value ) {
                    $('input[name=\''+index+'\'').addClass('is-invalid');                    
                    $.each(value, function(value1, i ) {                        
                        $('#'+value1+''+index).remove();
                        $('input[name=\''+index+'\'').parent().append('<div id="'+value1+''+index+'" class="font-weight-bold text-danger">'+i+'</div>');
                        
                    });
                });
            }
            
            if(json.success) {
                $('form#form-facilities')[0].reset();
                $('img.img-80').attr('src','/logo/placeholder/placeholder.jpg');

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
</script>
@endsection