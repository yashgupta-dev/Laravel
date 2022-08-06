@extends('layouts.my')
@section('content')
<div class="page-content">
    <div class="profile-page tx-13">
        <div class="row">
            <div class="col-md-12">
                <nav class="page-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('home.support') }}">Ticket List</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Add Ticket</li>
                    </ol>
                </nav>
            </div>
           
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <form method="post" action="{{ route('home.ticket.add') }}" enctype="multipart/form-data">
                        <div class="card-body">
                            @csrf
                            <div class="form-group">
                                <label for="subject">{{ __('Subject') }} <span class="text-danger">*</span></label>
                                <input type="text" value="{{ old('subject') }}" name="subject" id="subject" class="form-control @if(!empty($errors->first('subject'))) is-invalid  @endif" placeholder="Subject here.">
                                @if(!empty($errors->first('subject')))
                                <div class="">
				                    <small class="text-danger">{{ $errors->first('subject') }}</small>
				                </div>
                                @endif
                            </div>
                              <div class="form-group">
                                <label for="subject">{{ __('Description') }} <span class="text-danger">*</span></label>
                                <textarea class="form-control" id="summernote" name="editordata">{{ old('editordata') }}</textarea>
                                @if(!empty($errors->first('editordata')))
                                <div class="">
				                        <small class="text-danger">{{ $errors->first('editordata') }}</small>
				                      </div>
                                @endif
                            </div>
                            
                            <div class="form-group">
                                <div class="form-group" style="display:inline-block"></div>
                                <span id="addFile" style="cursor:pointer;" class="label-right pointer text-primary"><i class="fas fa-paperclip"></i> {{ __('add attachements') }}</span>
                            </div>

                        </div>
                        <div class="card-footer bg-light p-4">
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">{{ __('Send') }}</button>
                            </div>
                        </div>
                    </form>
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
<script>
 $('#summernote').summernote({
        placeholder: 'type your issue & query here... ',
        tabsize: 2,
        height: 120,
        toolbar: [
          ['style', ['style']],
          ['font', ['bold', 'underline', 'clear']],
          ['color', ['color']],
          ['para', ['ul', 'ol', 'paragraph']],
        //   ['table', ['table']],
        //   ['insert', ['link', 'picture', 'video']],
        //   ['insert', ['picture']],
        //   ['view', ['fullscreen', 'codeview', 'help']]
        //   ['view', ['fullscreen']]
        ]
      });

  $(document).ready(function(){
    var limit = 1;
    var active = "inbox";
    var max = {{ config('settings.ticket_module_attachment') }};
    $('#addFile').on('click', function() {
      limit++;
      if (max >= limit ) {
        html='';
        html += '<label class="attach-file pointer attach"  style="margin-left: 5px; margin-right: 5px;"><i class="fa fa-upload"style="cursor:pointer;"></i><input type="file" name="file[]"  class="files" style="display:none"  onchange="validate_fileupload(this);"><i class="fa fa-times remove-file pointer" style="cursor:pointer;background:#000;color:#fff;border-radius: 3px;padding: 5px;font-size: 7px;"></i></label>';
        $(this).prev().append(html);
        $(this).removeAttr('id');
      } else {
        limit--;
        toastr.warning("maximum limit of attachment is " + max);
      }
    });

    $(document.body).on('click', '.remove-file', function(event) {
      event.preventDefault();
      limit--;
      $(this).parent().remove();
    });
  });

function validate_fileupload(thisthis)
{
    var limit = 1;
    var max = {{ config('settings.ticket_module_attachment') }};
    var size=thisthis.files[0].size/1000;
    var maxsize = '{{ config('settings.ticket_module_filesize') }}';
    var allowed_extensions ={!! config('settings.ticket_module_extension') !!}
    if(thisthis.type == 'file') {
    fileName = thisthis.value;
    var file_extension = fileName.split('.').pop();
    for(var i = 0; i <= allowed_extensions.length && limit<=max; i++)
    {
        if(allowed_extensions[i]==file_extension && size<maxsize)
        {
           var getImagePath = URL.createObjectURL(thisthis.files[0]);
            $(thisthis).parent().css('background-image', 'url(' + getImagePath + ')');
             $(thisthis).parent().append(file_extension);
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
$(document.body).on('mouseenter','.attach-file',function(){
  $(this).children().last().css("display","inline-block");
});
$(document.body).on('mouseleave','.attach-file',function(){
  $(this).children().last().css("display","none");
});

</script>

@endsection