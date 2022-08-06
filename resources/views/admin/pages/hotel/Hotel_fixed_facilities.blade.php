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
                     <ol class="breadcrumb" style="margin-top: 20px;">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                        <li class="breadcrumb-item"  aria-current="page">Facilities List</li>
                     </ol>
                  </div>                  
               </div>
            </nav>
         </div>
        
         <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
               <div class="card-body">
                  <div class="row">
                     <div class="col-md-6"><h6 class="card-title">{{ __('Fixed Facilities List') }}</h6></div>
                     <div class="col-md-6">
                         <div class="d-flex justify-content-space-between float-right">
                             <a href="{{ route('admin.hotel.facilities.add') }}" type="button" class="btn btn-primary ml-1"><i class="fa fa-pen"></i> {{  __('Create') }}</a>                             
                             <button type="button" id="btn-delete" class="btn btn-danger ml-1"><i class="fa fa-trash-alt"></i> {{  __('Delete') }}</button>
                             @include('layouts.filter')
                         </div>
                     </div>
                  </div>   
                  <div class="table-responsive">
                     <form method="post" onsubmit="return deleterecord()" enctype="multipart/form-data" id="form-delete" class="form-horizontal">                     
                        <div class="table-responsive">
                           <table class="table table-striped">
                              <thead>
                                 <tr>
                                    <th><input type="checkbox" onclick="$('input[name*=\'checkbox\']').prop('checked', this.checked);"></th>
                                    <th>#</th>
                                    <th>Facilities</th>
                                    <th>Icon</th>
                                    <th>Status</th>                                    
                                    <th>Edit</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 @if(count($data)> 0)
                                    @foreach($data as $row)
                                       <tr>                                      
                                          <td><input type="checkbox" name="checkbox[]" value="{{ $row->id }}" /></td>
                                          <td>{{ $row->id }}</td>
                                          <td>{{ $row->faciltie_name }}</td>
                                          <td><img src="@if(!empty($row->faciltie_icon)) {{ asset('storage') }}{{ explode('public',$row->faciltie_icon)[1] }}@else{{ asset('logo/placeholder/placeholder.jpg') }}@endif" class="img-40"></td>
                                          <td>@if($row->faciltie_status) {{ __('Enable') }}@else {{ __('Disable')  }} @endif</td>
                                          <td><a href="" class="btn btn-md btn-primary"><i class="fa fa-edit"></i></a></td>
                                       </tr>
                                    @endforeach
                                 @else
                                    <tr>
                                       <td colspan="6" class="text-center">{{ __('Oops! no result available') }}</td>
                                    </tr>
                                 @endif
                              </tbody>
                           </table>
                        </div>
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
<script>

$(function(){
        $(document).on('click','#btn-delete',function(){
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
                            $('#btn-delete').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
                            $('#form-delete').submit();
                        }
                    },
                    close: function () {}
                }
            });
        });
});
function deleterecord() {
   var formData = $('#form-delete').serialize();
    $.ajax({
        url: '{{ route('admin.hotel.facilities.delete') }}',
        data: formData,
        type: "post",
        dataType: "json",
        beforeSend: function () {
            $('.preloader').css('display','block');            
        },
        success: function (json) {           
         $('#btn-delete').html('<i class="fa fa-trash-alt"></i> {{  __('Delete') }}');
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
               if(json.redirect){
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