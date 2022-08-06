@extends('admin.layouts.my')
@php($site=App\Models\Site::where('panelId',0)->first())
@section('content')
<link rel="stylesheet" href="{{ asset('css\chat.css') }}">
<link href="{{ asset('support/image_viewer/main.css')}}" rel="stylesheet">
<link href="{{ asset('support/image_viewer/viewer.css')}}" rel="stylesheet">
<div ng-app="app" class="page-content">
    <div ng-controller="chatController" ng-init="getChats()" class="app">
        <div class="header">
            <div class="logo">
                <img src="{{ asset('storage')}}/logo/0/{{explode('/',$site->logo)[3]}}" style="width: 145px;object-fit: contain;height: 80px;">
            </div>
            <div class="search-bar">
                <input type="text" placeholder="Search..." />
            </div>
            <div class="user-settings">
                <div class="dark-light">
                    <svg viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z" />
                    </svg>
                </div>                
                <!-- <img data-toggle="modal" data-target="#exampleModal" class="user-profile" src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3364143/download+%281%29.png" alt="" class="account-profile" alt=""> -->
            </div>
        </div>
        <div class="wrapper">
            <div class="conversation-area">
                
                <div class="msg" ng-show="!loader_userList">
                    <div class="msg-detail">
                    <img src="{{ asset('logo/1488.gif')}}" style="width: 80px;object-fit: contain;height: 80px;">
                    </div>
                </div>

                <div ng-hide="!loader_userList" ng-repeat="user in users"class="msg" ng-class="{'active': active === user.user_id}" ng-click="getChatWindow($event, user.user_id)">
                    <img class="msg-profile" src="@{{ user.profile }}">
                    <div class="msg-detail">
                        <div style="display:flex;">
                            <div class="msg-username" style="text-transform:capitalize;">@{{user.name}}</div>
                            <div class="unread_bading_remove" ng-if="user.last_message.unread" style="position: absolute;right: 10px;margin-top: 25px;"><span class="badge badge-info">@{{ user.last_message.unread }}</span></div>
                        </div>
                        
                        <div class="msg-content" style="display:inline-grid;">
                            <span class="msg-message" ng-if="user.last_message.status">@{{ user.last_message.last_msg }}</span>
                            <span class="msg-date" ng-if="user.last_message.status">@{{ user.last_message.time }}</span>
                        </div>
                    </div>
                    
                </div>
                
            </div>
            <div class="chat-area">
                <div class="chat-area-main">
                    
                    <div class="text-center">
                        <img ng-if="loader" src="{{ asset('logo/1488.gif')}}" style="width: 80px;object-fit: contain;height: 80px;">  
                        <img ng-show="logotext" src="{{ asset('storage')}}/logo/0/{{explode('/',$site->logo)[3]}}" style="width: 250px;object-fit: contain;height: 250px;">
                    </div>
                    
                    <div ng-if="!loader" ng-hide='logotext' ng-repeat="list in lists" class="chat-msg @{{ list.direction }}">
                        <div class="chat-msg-content" ng-if="list.msg_type == 0">
                            <div class="chat-msg-text">@{{ list.msg }}</div>
                            <span class="text-dark">@{{ list.created }}</span>
                        </div>
                        <div class="docs-pictures chat-msg-content" ng-if="list.msg_type == 1"> 
                            <div class="chat-msg-text" ng-repeat="attach in list.msg_attachment">
                                <img src="@{{ attach }}" data-original="@{{ attach }}"/>
                            </div>
                            
                            <span class="text-dark">@{{ list.created }}</span>
                        </div>
                        <div class="chat-msg-content" ng-if="list.msg_type == 2">
                            <div class="chat-msg-text">@{{ list.msg }}</div>
                            <span class="text-dark">@{{ list.created }}</span>
                        </div>
                    </div>
                   
                </div>

                <!-- chat send -->
                <div class="chat-area-footer" ng-if="show">
                    <!-- <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-video">
                        <path d="M23 7l-7 5 7 5V7z" />
                        <rect x="1" y="5" width="15" height="14" rx="2" ry="2" />
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-image">
                        <rect x="3" y="3" width="18" height="18" rx="2" ry="2" />
                        <circle cx="8.5" cy="8.5" r="1.5" />
                        <path d="M21 15l-5-5L5 21" />
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus-circle">
                        <circle cx="12" cy="12" r="10" />
                        <path d="M12 8v8M8 12h8" />
                    </svg> -->
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" onclick="document.getElementById('chatfiles').click();" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-paperclip">
                        <path d="M21.44 11.05l-9.19 9.19a6 6 0 01-8.49-8.49l9.19-9.19a4 4 0 015.66 5.66l-9.2 9.19a2 2 0 01-2.83-2.83l8.49-8.48" />
                    </svg>
                    <form style="width:90%;" name="chatForm" id="chatForm" enctype="multipart/form-data">
                    <!-- start input chat -->
                    <input type="file" class="d-none" name="files[]" id="chatfiles" multiple onchange="validate_fileupload(this);"/>
                    <input type="text" class="d-none" value="@{{ chat_sender_id }}" name="chat_sender_id"/>
                    <input type="text" class="d-none" value="@{{ active }}" name="chat_reciver_id"/>
                    <input type="text" name="chat_text" ng-keyup="send($event)" placeholder="Type something here..."/>
                    </form>
                    <!-- end chat input -->

                    <!-- <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-smile">
                       <circle cx="12" cy="12" r="10" />
                        <path d="M8 14s1.5 2 4 2 4-2 4-2M9 9h.01M15 9h.01" />
                    </svg> -->
                    
                </div>
                <!-- end chat -->
                
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal rightModal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">                    
                <div class="modal-body">
                    <div class="detail-area">
                        <div class="detail-area-header">
                            <div class="msg-profile group">
                            <svg viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round"stroke-linejoin="round" class="css-i6dzq1">
                            <path d="M12 2l10 6.5v7L12 22 2 15.5v-7L12 2zM12 22v-6.5" />
                            <path d="M22 8.5l-10 7-10-7" />
                            <path d="M2 15.5l10-7 10 7M12 2v6.5" /></svg>
                            </div>
                            <div class="detail-title">CodePen Group</div>
                            <div class="detail-subtitle">Created by Aysenur, 1 May 2020</div>
                            <div class="detail-buttons">
                            <button class="detail-button">
                            <svg viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="currentColor" stroke="currentColor" stroke-width="0"stroke-linecap="round" stroke-linejoin="round" class="feather feather-phone">
                            <path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07 19.5 19.5 0 01-6-6 19.79 19.79 0 01-3.07-8.67A2 2 0 01411 2h3a2 2 0 012 1.72 12.84 12.84 0 00.7 2.81 2 2 0 01-.45 2.11L8.09 9.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45 1284 12.84 0 002.81.7A2 2 0 0122 16.92z" />
                            </svg>
                            Call Group
                            </button>
                            <button class="detail-button">
                            <svg viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="currentColor" stroke="currentColor" stroke-width="0"stroke-linecap="round" stroke-linejoin="round" class="feather feather-video">
                            <path d="M23 7l-7 5 7 5V7z" />
                            <rect x="1" y="5" width="15" height="14" rx="2" ry="2" /></svg>
                            Video Chat
                            </button>
                            </div>
                        </div>
                        <div class="detail-changes">
                            <input type="text" placeholder="Search in Conversation">
                            <div class="detail-change">
                            Change Color
                            <div class="colors">
                            <div class="color blue selected" data-color="blue"></div>
                            <div class="color purple" data-color="purple"></div>
                            <div class="color green" data-color="green"></div>
                            <div class="color orange" data-color="orange"></div>
                            </div>
                            </div>
                            <div class="detail-change">
                            Change Emoji
                            <svg xmlns="http://www.w3.org/2000/svg" viewbox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"stroke-linecap="round" stroke-linejoin="round" class="feather feather-thumbs-up">
                            <path d="M14 9V5a3 3 0 00-3-3l-4 9v11h11.28a2 2 0 002-1.7l1.38-9a2 2 0 00-2-2.3zM7 22H4a2 2 0 01-2-2v-7a2 2 0 012-2h3" ></svg>
                            </div>
                        </div>
                        <div class="detail-photos">
                            <div class="detail-photo-title">
                            <svg xmlns="http://www.w3.org/2000/svg" viewbox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"stroke-linecap="round" stroke-linejoin="round" class="feather feather-image">
                            <rect x="3" y="3" width="18" height="18" rx="2" ry="2" />
                            <circle cx="8.5" cy="8.5" r="1.5" />
                            <path d="M21 15l-5-5L5 21" /></svg>
                            Shared photos
                            </div>
                            <div class="detail-photo-grid">
                            <img src="https://images.unsplash.com/photo-1523049673857-eb18f1d7b578?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9auto=format&fit=crop&w=2168&q=80" />
                            <img src="https://images.unsplash.com/photo-1516085216930-c93a002a8b01?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9auto=format&fit=crop&w=2250&q=80" />
                            <img src="https://images.unsplash.com/photo-1458819714733-e5ab3d536722?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9auto=format&fit=crop&w=933&q=80" />
                            <img src="https://images.unsplash.com/photo-1520013817300-1f4c1cb245ef?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9auto=format&fit=crop&w=2287&q=80" />
                            <img src="https://images.unsplash.com/photo-1494438639946-1ebd1d20bf85?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9auto=format&fit=crop&w=2247&q=80" />
                            <img src="https://images.unsplash.com/photo-1559181567-c3190ca9959b?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9auto=format&fit=crop&w=1300&q=80" />
                            <img src="https://images.unsplash.com/photo-1560393464-5c69a73c5770?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9auto=format&fit=crop&w=1301&q=80" />
                            <img src="https://images.unsplash.com/photo-1506619216599-9d16d0903dfd?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9auto=format&fit=crop&w=2249&q=80" />
                            <img src="https://images.unsplash.com/photo-1481349518771-20055b2a7b24?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9auto=format&fit=crop&w=2309&q=80" />
                            <img src="https://images.unsplash.com/photo-1473170611423-22489201d919?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9auto=format&fit=crop&w=2251&q=80" />
                            <img src="https://images.unsplash.com/photo-1579613832111-ac7dfcc7723f?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9auto=format&fit=crop&w=2250&q=80" />
                            <img src="https://images.unsplash.com/photo-1523275335684-37898b6baf30?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9auto=format&fit=crop&w=2189&q=80" />
                            </div>
                            <div class="view-more">View More</div>
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
<script src="{{ asset('support/image_viewer/main.js') }}"></script>
<script src="{{ asset('support/image_viewer/viewer.js') }}"></script>
<script src="{{ asset('vendor/angular/angular.min.js') }}"></script>  
<script>
    $(function(){
        scrollToBottom();
    });
    function validate_fileupload(thisthis)
        {
            var limit = 1;
            var max = {{ config('settings.config_max_upload_size') }};
            var size=thisthis.files[0].size/1000;
            var maxsize = '{{ config('settings.config_max_upload_size') }}';
            var allowed_extensions ={!! config('settings.config_mime_type') !!}
            if(thisthis.type == 'file') {
            fileName = thisthis.value;
            var file_extension = fileName.split('.').pop();
            for(var i = 0; i <= allowed_extensions.length && limit<=max; i++)
            {
                if(allowed_extensions[i]==file_extension && size<maxsize)
                {
                    limit++;
                    var formData = new FormData($("form#chatForm")[0]);
                    $.ajax({
                        url: '{{ route('admin.chat.send.files')}}',
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
                            
                            if(json.status) {
                                $('form#chatForm')[0].reset();
                                toastr.success(json.message,'Success!');
                            } else {
                                toastr.warning(json.message,'Warning!');
                            }
                            history(receiver);
                        },
                        error:function(jxxhr,xhr,error) {
                            $('.preloader').css('display','none');            
                            toastr.warning(error,'Warning!');
                        }
                    });
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
    var app = angular.module('app',[]);
    
    app.controller('chatController', function ($scope, $http) {
        $scope.users = [];
        $scope.lists = [];
        $scope.active = 0;
        $scope.show = false;
        $scope.loader_userList = false;
        $scope.contacts = false;
        $scope.logotext = true;
        $scope.chat_sender_id = '';

        $scope.getChats = function () {
            $http.post('{{ route("admin.chat.getlist") }}').then(function (response) {
                $scope.loader_userList = true;
                $scope.users = response.data;
            });
        };     

        $scope.loader = false;
        $scope.getChatWindow = function($event, id) {
            $scope.show = true; //chat are show
            $scope.active = id; //get userChatWindow section.
            $scope.logotext = false;
            $('.unread_bading_remove').remove();
            $scope.loader = true;
            setTimeout(function(){
                $scope.chat_sender_id = {{ Auth::guard('admin')->user()->id }}
                history(id);
                scrollToBottom();
            },1000);
            
        };

        $scope.send = function($event) {
            if( $event.keyCode == 13 ) {
                
                var msg = $('.chat-area-footer').find('input[name="chat_text"]').val(); // get message
                var sender = $('.chat-area-footer').find('input[name="chat_sender_id"]').val(); // get sender
                var receiver = $('.chat-area-footer').find('input[name="chat_reciver_id"]').val(); // get receiver
                if(!msg && msg == '') {
                    toastr.warning('Message not be empty!','Warning!');
                } else {
                    var formData = new FormData($("form#chatForm")[0]);
                    $.ajax({
                        url: '{{ route('admin.chat.send')}}',
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
                            history(receiver);
                            if(json.status) {
                                $('form#chatForm')[0].reset();
                                scrollToBottom();
                                toastr.success(json.message,'Success!');
                            } else {
                                toastr.warning(json.message,'Warning!');
                            }
                            
                        },
                        error:function(jxxhr,xhr,error) {
                            $('.preloader').css('display','none');            
                            toastr.warning(error,'Warning!');
                        }
                    });
                    // $http.post('{{ route('admin.chat.send')}}',{'msg':msg,'sender':sender,'receiver':receiver}).then(function (response){
                    //     if(!response.data.status) {
                    //         toastr.warning(response.data.message,'Warning!');
                    //     } else {
                    //         $('.chat-area-footer').find('input[name="chat_text"]').val('');
                    //         history(receiver);                            
                    //         scrollToBottom();
                    //         toastr.success(response.data.message,'Success!');
                    //     }

                    // });
                }
            }
        }

        function history(id) {
            $http.post('{{ route("admin.chat.getData") }}',{'id':id}).then(function (response) {
                $scope.loader = false;
                if(response.data.status) {
                    $scope.lists = response.data.message;
                } else {
                    $scope.lists = [];
                }
            });
        }
        

});

function scrollToBottom(){
    $('html,body').animate({
        scrollTop: $(".chat-area-main").offset().top},
        'slow');
    
}
const toggleButton = document.querySelector(".dark-light");
const colors = document.querySelectorAll(".color");

colors.forEach((color) => {
 color.addEventListener("click", (e) => {
  colors.forEach((c) => c.classList.remove("selected"));
  const theme = color.getAttribute("data-color");
  document.body.setAttribute("data-theme", theme);
  color.classList.add("selected");
 });
});

toggleButton.addEventListener("click", () => {
 document.body.classList.toggle("dark-mode");
});
</script>
@endsection
