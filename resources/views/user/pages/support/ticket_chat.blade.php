@extends('layouts.my')
@section('content')
<style>
.nav-link.active {
    background: transparent !important;
    font-size: 15px;
    font-weight: 600;
    border: none;
    border-bottom: 2px solid #7f40ba !important;
}
.nav-tabs .nav-link {
    color: #242427 !important;
    font-size: 15px;
    font-weight: 600;
}
.nav-tabs .nav-link:hover, .nav-tabs .nav-link:focus{
    background: transparent !important;
    font-size: 15px;
    font-weight: 600;
    border: none;
}

</style>
<div class="page-content">
    <div class="profile-page tx-13">
        <div class="row">
            
            @if(count($data['chats']) > 0)
            <div class="col-md-3" id="responsive">
                <div class="row" style="border-right:1px solid #dde;">
                    <div class="col-md-8"><h5 class="font-weight-bold">{{ __('TICKET #')}}{{$data['ticket']}}</h5></div>
                    <div class="col-md-4"><a href="{{ route('home.support') }}" class="font-weight-bold h5 text-dark"><i class="fas fa-angle-left"></i> {{ __('Back') }}</a></div>
                    <div class="col-md-12 mb-3 mt-3">
                        <div class="border-bottom"></div>
                    </div>
                    @foreach($data['chats'] as $row)
                    <!-- agent information -->
                    <div class="col-md-12">
                        <div>
                            <div class="d-flex">
                                <div>
                                @if(!empty($row->assign))
                                @if(!in_array($row->assign->agent['profile'],['0','1','2','3','4']))
                                    <img src="{{ asset('storage') }}/profile/{{ explode('/',$row->assign->agent['profile'])[2] }}" alt="" style="border-radius: 8px;width: 50px;height: 50px;object-fit: cover;padding: 4px;">
                                @else
                                    <img src="{{ asset('logo') }}/{{ $row->assign->agent['profile'] }}.png" alt="" style="border-radius: 8px;width: 50px;height: 50px;object-fit: cover;padding: 4px;">
                                @endif
                                @endif
                                    
                                </div>
                                <div class="col-md-10 mt-2">
                                    <p class="" style="color: #2d2c2c;font-weight: 600;font-size: 15px;">@if(!empty($row->assign)) {{ $row->assign->agent['name'] }} @else {{ __('Unassigned') }} @endif</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- total replies -->
                    <div class="col-md-12 mt-4">
                        <h6 class="font-weight-dark">{{ __('Total Replies') }}</h6>
                        <div class="mt-2">
                            <div class="d-flex">
                                <div>
                                    <i class="fas fa-share text-dark"></i>
                                </div>
                                <div class="ml-2">
                                    {{ count($row->replies) }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- timestamp -->
                    <div class="col-md-12 mt-4">
                        <h6 class="font-weight-dark">{{ __('TimeStamp') }}</h6>
                        <div class="mt-2">
                            <div class="d-flex">
                                <div>
                                <i class="fas fa-stopwatch text-dark"></i>
                                </div>
                                <div class="ml-2">
                                    {{ date('d-M-y h:i A',strtotime($row->created_at)) }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- channel -->
                    <div class="col-md-12 mt-4">
                        <h6 class="font-weight-dark">{{ __('Channel') }}</h6>
                        <div class="mt-2">
                            <div class="d-flex">
                                <div>
                                <i class="fas fa-globe text-dark"></i>
                                </div>
                                <div class="ml-2">
                                    {{ __('Website') }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 mt-4 mb-4">
                        <div class="border-bottom"></div>
                    </div>
                    <!-- status -->
                    <div class="col-md-12">
                        <h6 class="font-weight-dark">{{ __('Status')}}</h6>
                        <div class="mt-2">
                            <div class="d-flex">
                                <div class="ml-2">
                                @if(!empty(json_decode(config('settings.ticket_module_select_ticket_status'))))
                                            @foreach(json_decode(config('settings.ticket_module_select_ticket_status')) as $status)
                                                @php($statusName = App\Models\Statusmange::where('id',$status)->select('status_name')->first()['status_name'])
                                                
                                                @if($status == $row->status) {{ $statusName }} @endif
                                            @endforeach
                                        @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="col-md-9" id="responsiveChat">
                <div class="row">
                    <div class="col-md-12">
                        <div class="template-header">
                            <ul class="nav nav-tabs" style="border-bottom:none !important;">
                                <li>
                                    <div class="uv-mob-aside">
                                        <span class="uv-icon-aside-menu"></span>
                                    </div>
                                </li>
                            </ul>
                            @foreach($data['chats'] as $row)
                            <div class="title">
                                <h4 class="font-weight-light"> {{ $row->subject }}</h4>
                                <div class="mt-2 d-flex justify-content-arround">
                                    <div class="font-weight-light">{{ __('Created -') }} <span class="font-weight-bold">{{ date('d-M h:i A',strtotime($row->created_at)) }}</span></div>
                                    <div class="font-weight-light ml-3">{{ __('By -') }} <span class="font-weight-bold">{{ $row->user['name'] }}</span></div>
                                    <div class="font-weight-light ml-3">{{ __('Agent -') }} <span class="font-weight-bold">@if(!empty($row->assign)) {{ $row->assign->agent['name'] }} @else {{ __('Unassigned') }} @endif</span></div>
                                </div>
                            </div>
                            <div class="border-bottom mt-3"></div>
                        </div>

                        <div class="template">
                            <div class="template-content">
                                <div class="template-content-chat">                                    
                                    @if(count($row->ticket_msg))
                                        <!-- chat section start -->
                                        <?php $i = 0; ?>
                                        @foreach($row->ticket_msg as $msg)
                                        <?php $i++; ?>
                                        <div class="chat-section mt-3 filter @if($msg->from) replies @endif @if(count($msg->msg_attachement)) attachements @endif">
                                            @if($i == 1)
                                                <div class="mb-1 d-flex justify-content-arround">
                                                    <div class="font-weight-light">{{ date('d-m-y h:i A',strtotime($row->created_at)) }} - <span class="font-weight-bold">{{ $row->user['name'] }}</span> Created</div>
                                                </div>
                                            @else 
                                                <div class="font-weight-light display-inline mb-1">{{ date('d-m-y h:i A',strtotime($msg->created_at)) }} - @if($msg->from){{ $row->user['name'] }}@else @if(!empty($row->assign)) {{ $row->assign->agent['name'] }} @else {{ __('Unassigned') }} @endif @endif <span style="color:#9E9E9E;">replied</span> <span><a href="{{ url()->current() }}#{{ strtotime($msg->created_at) }}" data-toggle="tooltip" data-placement="top" title="{{ url()->current() }}#{{ strtotime($msg->created_at) }}">#{{ strtotime($msg->created_at) }}</a></div>
                                            @endif
                                            <div class="d-flex">
                                                <div class="image">
                                                    @if($msg->from) 
                                                        @if(!in_array($row->user['profile'],['0','1','2','3','4']))
                                                            <img src="{{ asset('storage') }}/profile/{{ explode('/',Auth::user()->profile)[2] }}" alt="{{ Auth::user()->name }}" style="border-radius: 8px;width: 40px;height: 40px;object-fit: cover;">
                                                        @else
                                                            <img src="{{ asset('logo') }}/{{ $row->user['profile'] }}.png" alt="{{ Auth::user()->name }}"  style="border-radius: 8px;width: 40px;height: 40px;object-fit: cover;">
                                                        @endif
                                                    @else
                                                        @if(!in_array($msg->agent['profile'],['0','1','2','3','4']))
                                                            <img src="{{ asset('storage') }}/profile/{{ explode('/',$msg->agent['profile'])[2] }}" alt="{{ $msg->agent['name'] }}" style="border-radius: 8px;width: 40px;height: 40px;object-fit: cover;">
                                                        @else
                                                            <img src="{{ asset('logo') }}/{{ $msg->agent['profile'] }}.png" alt="{{ $row->user['name'] }}" style="border-radius: 8px;width: 40px;height: 40px;object-fit: cover;">
                                                        @endif
                                                    @endif
                                                </div>
                                                <div class="desc ml-3">
                                                    <div class="agent-title mb-1"><a href="#">
                                                        @if($msg->from) 
                                                            {{ Auth::user()->name }} 
                                                        @else 
                                                        @if(!empty($row->assign)) {{ $row->assign->agent['name'] }} @else {{ __('Unassigned') }} @endif
                                                        @endif </a></div>
                                                    {!! $msg->r_msg !!}
                                                </div>
                                            </div>
                                            @if(count($msg->msg_attachement))
                                            <div class="chat-files ml-5 mt-2">                                                
                                                <ul class="docs-pictures flex-row">
                                                    @foreach($msg->msg_attachement as $attachment)
                                                        <li>
                                                        @if (in_array($extension = pathinfo($attachment->attachments, PATHINFO_EXTENSION), ['jpg', 'png', 'bmp','jpeg']))
                                                            <img src="{{ asset('storage')}}/attachements/{{ $attachment->ticket_msg_id }}/{{explode('/',$attachment->attachments)[3] }}" alt="{{ Auth::user()->name }}" data-original="{{ asset('storage')}}/attachements/{{ $attachment->ticket_msg_id }}/{{explode('/',$attachment->attachments)[3] }}">
                                                        @elseif(in_array($extension = pathinfo($attachment->attachments, PATHINFO_EXTENSION), ['pdf']))
                                                            <a href="{{ asset('storage')}}/attachements/{{ $attachment->ticket_msg_id }}/{{explode('/',$attachment->attachments)[3] }}" target="_blank"><img src="{{ asset('logo/filetype/'.$extension.'.png')}}"></a>
                                                        @else
                                                            <a href="{{ asset('storage')}}/attachements/{{ $attachment->ticket_msg_id }}/{{explode('/',$attachment->attachments)[3] }}" target="_blank"><img src="{{ asset('logo/filetype/file.png')}}"></a>
                                                        @endif
                                                            
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                            @endif
                                        </div>
                                        @endforeach
                                        <!-- chat section end -->
                                    @endif
                                    
                                </div>
                            </div>
                
                            <!-- chat message section -->
                            <div class="form mt-2">
                                <div class="d-flex">
                                    <div class="image">
                                    @if(!in_array(Auth::user()->profile,['0','1','2','3','4']))
                                        <img src="{{ asset('storage') }}/profile/{{ explode('/',Auth::user()->profile)[2] }}" alt="{{ Auth::user()->name }}" style="border-radius: 8px;width: 40px;height: 40px;object-fit: cover;">
                                    @else
                                        <img src="{{ asset('logo') }}/{{ Auth::user()->profile }}.png" alt="{{ $row->user['name'] }}" style="border-radius: 8px;width: 40px;height: 40px;object-fit: cover;">
                                    @endif
                                    </div>
                                    <div class="desc ml-3">
                                        <div class="agent-title mb-1">{{ Auth::user()->name }}</div>
                                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">{{ __('Reply') }}</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="tab-content mt-4" id="myTabContent">
                                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                        <form method="post" name="replyTicket" action="{{ route('home.ticket.replies') }}" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group">
                                                <textarea class="form-control" id="summernote" name="editordata">{{ old('editordata') }}</textarea>
                                                @if(!empty($errors->first('editordata')))
                                                <div class="">
                                                    <small class="text-danger">{{ $errors->first('editordata') }}</small>
                                                </div>
                                                @endif
                                                <input type="hidden" name="ticket" value="{{ $data['ticket'] }}">
                                            </div>
                                            <div class="form-group">
                                                <div class="form-group" style="display:inline-block"></div>
                                                <span id="addFile" style="cursor:pointer;" class="label-right pointer text-primary"><i class="fas fa-paperclip"></i> {{ __('add attachements') }}</span>
                                            </div>
                                            <div class="uv-dropdown reply">
                                                <div class="uv-btn uv-dropdown-other">
                                                    Reply
                                                <span class="uv-icon-down-light"></span>
                                                </div>
                                                <div class="uv-dropdown-list uv-top-left" style="display: none;">
                                                    <div class="uv-dropdown-container" id="replyTicket">
                                                        <label>Reply</label>
                                                        @if(!empty(json_decode(config('settings.ticket_module_select_ticket_customer_reply'))))
                                                        <ul>
                                                            @foreach(json_decode(config('settings.ticket_module_select_ticket_customer_reply')) as $status)
                                                                @php($statusName = App\Models\Statusmange::where('id',$status)->select('status_name')->first()['status_name'])
                                                                <li data-id="{{$status}}">Submit And {{ $statusName }}</li>
                                                            @endforeach
                                                        </ul>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            
                            @endforeach

                        </div>
                    </div>
                </div>
                
            </div>
            @endif
        </div>
    </div>
</div>
@include('layouts.footer')
@endsection
@section('myscript')
<link href="{{ asset('support/image_viewer/main.css')}}" rel="stylesheet">
<link href="{{ asset('support/image_viewer/viewer.css')}}" rel="stylesheet">
<script src="{{ asset('support/image_viewer/main.js') }}"></script>
<script src="{{ asset('support/image_viewer/viewer.js') }}"></script>
<style>
    ul.docs-pictures.flex-row {
        display: flex;
    }
</style>
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
<script>
    $(function() {
    
    var viewEl = $('#uv-view');
    var viewContainerEl = $('#uv-view-container');

    $('.uv-dropdown-pta').focus( function() {
        viewEl.addClass('uv-dropdown-disable-parent-scroll');
        viewContainerEl.addClass('uv-dropdown-disable-parent-scroll');
    });

    $('.uv-simple-dropdown-pta').focus( function() {
        viewEl.addClass('uv-dropdown-disable-parent-scroll');
        viewContainerEl.addClass('uv-dropdown-disable-parent-scroll');
    });

    $(document).click(function(e) {
        var target = e.target;

        if (!$(target).parents('.uv-dropdown-open').length || $(target).is('li') || $(target).is('a')) {
            $('.uv-dropdown-list').hide();
            $('.uv-dropdown-btn').removeClass('uv-dropdown-btn-active');
            $('.uv-dropdown-other').removeClass('uv-dropdown-btn-active');
            $('.uv-dropdown-open').removeClass('uv-dropdown-open');

            viewEl.removeClass('uv-dropdown-disable-parent-scroll');
            viewContainerEl.removeClass('uv-dropdown-disable-parent-scroll');

            let targetEl = $('.uv-dropdown-navigations-support.uv-dropdown-active-focus');
            
            targetEl.removeAttr('data-dropdownindex');
            targetEl.removeClass('uv-dropdown-active-focus');
        }

        if (!$(target).parents('.uv-search-result-active').length && !$(target).is('.uv-search-bar')) {
            $('.uv-search-result-wrapper').removeClass('uv-search-result-active');
            $('.uv-search-result-wrapper').removeClass('uv-search-flap-up');
        }
    });

    $('body').delegate('.uv-dropdown-btn, .uv-dropdown-other', 'click', function(e) {
        toggleDropdown(e);
    });
    function toggleDropdown(e) {
        var currentElement = $(e.currentTarget);

        if (currentElement.hasClass('uv-dropdown-btn-active')) {
            $('.uv-dropdown-list').hide();
            $('.uv-dropdown-btn').removeClass('uv-dropdown-btn-active');
            $('.uv-dropdown-other').removeClass('uv-dropdown-btn-active');
            $('.uv-dropdown-open').removeClass('uv-dropdown-open');
        } else {
            $('.uv-dropdown-list').hide(); 
            $('.uv-dropdown-btn').removeClass('uv-dropdown-btn-active');
            $('.uv-dropdown-other').removeClass('uv-dropdown-btn-active');
            $('.uv-dropdown-open').removeClass('uv-dropdown-open');

            if (currentElement.attr('disabled') != "disabled") {
                currentElement.addClass('uv-dropdown-btn-active');
                currentElement.parent().find('.uv-dropdown-list').fadeIn(100);
                currentElement.parent().addClass('uv-dropdown-open');

                // currentElement.parent().find('ul.dropdown-list li').removeClass('active');
                // currentElement.parent().find('ul.dropdown-list li:first').attr('class','active');
                autoDropupDropdown();
            }
        }
    }
    function autoDropupDropdown() {
        dropdownButton = $(".uv-dropdown-open");

        if (
            !dropdownButton.find('.uv-dropdown-list').hasClass('uv-top-left') 
            && !dropdownButton.find('.uv-dropdown-list').hasClass('uv-top-right') 
            && dropdownButton.length
        ) {
            dropdown = dropdownButton.find('.uv-dropdown-list');
            height = dropdown.height() + 50;

            var topOffset = dropdownButton.offset().top - 70;
            var bottomOffset = $(window).height() - topOffset - dropdownButton.height();

            dropdownButton.removeClass("bottom");
            
            if (bottomOffset > topOffset || height < bottomOffset) {
                if (dropdown.hasClass('uv-top-right')) {
                    dropdown.removeClass('uv-top-right')
                    dropdown.addClass('uv-bottom-right')
                } else if (dropdown.hasClass('uv-top-left')) {
                    dropdown.removeClass('uv-top-left')
                    dropdown.addClass('uv-bottom-left')
                }
            } else {
                if (dropdown.hasClass('uv-bottom-right')) {
                    dropdown.removeClass('uv-bottom-right')
                    dropdown.addClass('uv-top-right')
                } else if(dropdown.hasClass('uv-bottom-left')) {
                    dropdown.removeClass('uv-bottom-left')
                    dropdown.addClass('uv-top-left')
                }
            }
        }
    }

    $('div').scroll(function() {
        autoDropupDropdown()
    });

    $('.uv-dropdown-container#replyTicket ul li').on('click',function(e){
        var id = $(this).attr('data-id');
        $('.uv-dropdown-container#replyTicket').append('<input type="hidden" name="note_submit" value="'+id+'">');
        $('form[name="replyTicket"]').submit();
    });

});
$(document).ready(function(){
        @if(!empty($errors->first('er')))
            toastr.warning('{{ $errors->first('er') }}');
        @endif
        @if(!empty($errors->first('success')))
            toastr.success('{{ $errors->first('success') }}');
        @endif

    });
 $('#summernote').summernote({
        placeholder: 'Describe your details here. ',
        tabsize: 2,
        height: 200,
        toolbar: [
          ['style', ['style']],
          ['font', ['bold', 'underline', 'clear']],
          ['color', ['color']],
          ['para', ['ul', 'ol', 'paragraph']],
          ['table', ['table']],
          ['insert', ['link','picture', 'video']],
        //   ['insert', ['picture']],
          ['view', ['fullscreen','help']]
        //   ['view', ['fullscreen']]
        ]
      });
</script>
<script>
    function scrollToBottom(){
        div_height = $("#responsiveChat").height();
        div_offset = $("#myTabContent").offset().top;
        window_height = $(window).height();
        $('#responsiveChat').animate({
            scrollTop: div_offset-window_height+div_height
        },'slow');
    }
    $(document).ready(function() {
        scrollToBottom();
        $(document).on('click','.uv-mob-aside',function() {            
            // $('#responsive').slideToggle('slow');
            $('#responsive').css({
                'display': 'block !important',
            });
            $('#responsive').toggle({ direction: "left" }, 1000);
            
        });
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
  toastr.info('Maximum Number of file is '+max,'Warning!');
  else
        toastr.info("You have allowed only "+allowed_extensions,'Info!');
            toastr.warning("File size is to big from "+maxsize/1024+" MB",'Warning!');
  thisthis.value="";
    return false;
}
$(document.body).on('mouseenter','.attach-file',function(){
  $(this).children().last().css("display","inline-block");
});
$(document.body).on('mouseleave','.attach-file',function(){
  $(this).children().last().css("display","none");
});

$(document).ready(function(){
    $(".filter-button").click(function(){
        $(".filter-button.active").removeClass("active");
        $(this).addClass("active");
        var value = $(this).attr('data-filter');
        if(value == "threads") {
            $('.filter').show('1000');
            $('#remove').remove();
        } else {
            $('#remove').remove();
            if(!$('.'+value).length){
                $('.template-content-chat').append('<div id="remove" class="mt-2 h5 d-flex justify-content-center font-weight-bold">Oops! no '+value+' here.</div>');
            }
            $(".filter").not('.'+value).hide('3000');
            $('.filter').filter('.'+value).show('3000');
        }
    });
});
</script>
@endsection