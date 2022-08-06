@section('header') @php($site=App\Models\Site::where('panelId',0)->first())
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('settings.config_store_name') }}</title>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- core:css -->
    <link rel="stylesheet" href="{{asset('assets/vendors/core/core.css')}}">
    <!-- endinject -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{asset('assets/fonts/feather-font/css/iconfont.css')}}">
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{asset('assets/css/demo_5/style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/demo_5/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/demo_5/tooltips.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/demo_5/jquery-confirm.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/demo_5/jquery-ui.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/demo_5/toastr.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/demo_5/dropzone.css')}}">
    <!-- @notifyCss -->
    <!-- End layout styles -->
    <link href="{{ asset('storage')}}/logo/0/favicon/{{explode('/',$site->favicon)[4]}}" rel="icon">
    <style>
        label.attach-file {
            display: inline-block;
            width: 65px;
            height: 65px;
            background: #F1F1F1;
            border: 1px dashed #DDD;
            border-radius: 5px;
            text-align: center;
            line-height: 50px;
            overflow: hidden;
            background-size: cover;
            background-position: center;
        }

        .remove-file {
            margin-left: 10px;
            position: absolute;
            display: none;
        }

        .w-8 {
            width: 2rem
        }

        .object-cover {
            -o-object-fit: cover;
            object-fit: cover
        }

        .h-8 {
            height: 2rem
        }

        .rounded-full {
            border-radius: 9999px
        }

        .close {
            position: absolute;
            right: 0;
            top: -15px
        }

        #profileImg {
            cursor: pointer;
            border-radius: 35px;
            width: 70px;
            height: 70px;
            object-fit: cover
        }

        .camera {
            position: absolute;
            top: 65px;
            left: 60px
        }

        .camera i {
            font-size: 15px;
            color: #565050;
            background: #ffffffab;
            padding: 5px;
            border-radius: 50%
        }

        .windows8 {
            position: relative;
            width: 62px;
            height: 62px;
            margin: auto
        }

        .windows8 .wBall {
            position: absolute;
            width: 59px;
            height: 59px;
            opacity: 0;
            transform: rotate(225deg);
            -o-transform: rotate(225deg);
            -ms-transform: rotate(225deg);
            -webkit-transform: rotate(225deg);
            -moz-transform: rotate(225deg);
            animation: orbit 4.2325s infinite;
            -o-animation: orbit 4.2325s infinite;
            -ms-animation: orbit 4.2325s infinite;
            -webkit-animation: orbit 4.2325s infinite;
            -moz-animation: orbit 4.2325s infinite
        }

        .windows8 .wBall .wInnerBall {
            position: absolute;
            width: 8px;
            height: 8px;
            background:{{  config('settings.config_loder_color')  }};
            left:0;
            top:0;
            border-radius:8px
        }

        .windows8 #wBall_1 {
            animation-delay: 926ms;
            -o-animation-delay: 926ms;
            -ms-animation-delay: 926ms;
            -webkit-animation-delay: 926ms;
            -moz-animation-delay: 926ms
        }

        .windows8 #wBall_2 {
            animation-delay: 183ms;
            -o-animation-delay: 183ms;
            -ms-animation-delay: 183ms;
            -webkit-animation-delay: 183ms;
            -moz-animation-delay: 183ms
        }

        .windows8 #wBall_3 {
            animation-delay: .3665s;
            -o-animation-delay: .3665s;
            -ms-animation-delay: .3665s;
            -webkit-animation-delay: .3665s;
            -moz-animation-delay: .3665s
        }

        .windows8 #wBall_4 {
            animation-delay: .5495s;
            -o-animation-delay: .5495s;
            -ms-animation-delay: .5495s;
            -webkit-animation-delay: .5495s;
            -moz-animation-delay: .5495s
        }

        .windows8 #wBall_5 {
            animation-delay: 743ms;
            -o-animation-delay: 743ms;
            -ms-animation-delay: 743ms;
            -webkit-animation-delay: 743ms;
            -moz-animation-delay: 743ms
        }

        @keyframes orbit {
            0% {
                opacity: 1;
                z-index: 99;
                transform: rotate(180deg);
                animation-timing-function: ease-out
            }
            7% {
                opacity: 1;
                transform: rotate(300deg);
                animation-timing-function: linear;
                origin: 0
            }
            30% {
                opacity: 1;
                transform: rotate(410deg);
                animation-timing-function: ease-in-out;
                origin: 7%
            }
            39% {
                opacity: 1;
                transform: rotate(645deg);
                animation-timing-function: linear;
                origin: 30%
            }
            70% {
                opacity: 1;
                transform: rotate(770deg);
                animation-timing-function: ease-out;
                origin: 39%
            }
            75% {
                opacity: 1;
                transform: rotate(900deg);
                animation-timing-function: ease-out;
                origin: 70%
            }
            76% {
                opacity: 0;
                transform: rotate(900deg)
            }
            100% {
                opacity: 0;
                transform: rotate(900deg)
            }
        }

        @-o-keyframes orbit {
            0% {
                opacity: 1;
                z-index: 99;
                -o-transform: rotate(180deg);
                -o-animation-timing-function: ease-out
            }
            7% {
                opacity: 1;
                -o-transform: rotate(300deg);
                -o-animation-timing-function: linear;
                -o-origin: 0
            }
            30% {
                opacity: 1;
                -o-transform: rotate(410deg);
                -o-animation-timing-function: ease-in-out;
                -o-origin: 7%
            }
            39% {
                opacity: 1;
                -o-transform: rotate(645deg);
                -o-animation-timing-function: linear;
                -o-origin: 30%
            }
            70% {
                opacity: 1;
                -o-transform: rotate(770deg);
                -o-animation-timing-function: ease-out;
                -o-origin: 39%
            }
            75% {
                opacity: 1;
                -o-transform: rotate(900deg);
                -o-animation-timing-function: ease-out;
                -o-origin: 70%
            }
            76% {
                opacity: 0;
                -o-transform: rotate(900deg)
            }
            100% {
                opacity: 0;
                -o-transform: rotate(900deg)
            }
        }

        @-ms-keyframes orbit {
            0% {
                opacity: 1;
                z-index: 99;
                -ms-transform: rotate(180deg);
                -ms-animation-timing-function: ease-out
            }
            7% {
                opacity: 1;
                -ms-transform: rotate(300deg);
                -ms-animation-timing-function: linear;
                -ms-origin: 0
            }
            30% {
                opacity: 1;
                -ms-transform: rotate(410deg);
                -ms-animation-timing-function: ease-in-out;
                -ms-origin: 7%
            }
            39% {
                opacity: 1;
                -ms-transform: rotate(645deg);
                -ms-animation-timing-function: linear;
                -ms-origin: 30%
            }
            70% {
                opacity: 1;
                -ms-transform: rotate(770deg);
                -ms-animation-timing-function: ease-out;
                -ms-origin: 39%
            }
            75% {
                opacity: 1;
                -ms-transform: rotate(900deg);
                -ms-animation-timing-function: ease-out;
                -ms-origin: 70%
            }
            76% {
                opacity: 0;
                -ms-transform: rotate(900deg)
            }
            100% {
                opacity: 0;
                -ms-transform: rotate(900deg)
            }
        }

        @-webkit-keyframes orbit {
            0% {
                opacity: 1;
                z-index: 99;
                -webkit-transform: rotate(180deg);
                -webkit-animation-timing-function: ease-out
            }
            7% {
                opacity: 1;
                -webkit-transform: rotate(300deg);
                -webkit-animation-timing-function: linear;
                -webkit-origin: 0
            }
            30% {
                opacity: 1;
                -webkit-transform: rotate(410deg);
                -webkit-animation-timing-function: ease-in-out;
                -webkit-origin: 7%
            }
            39% {
                opacity: 1;
                -webkit-transform: rotate(645deg);
                -webkit-animation-timing-function: linear;
                -webkit-origin: 30%
            }
            70% {
                opacity: 1;
                -webkit-transform: rotate(770deg);
                -webkit-animation-timing-function: ease-out;
                -webkit-origin: 39%
            }
            75% {
                opacity: 1;
                -webkit-transform: rotate(900deg);
                -webkit-animation-timing-function: ease-out;
                -webkit-origin: 70%
            }
            76% {
                opacity: 0;
                -webkit-transform: rotate(900deg)
            }
            100% {
                opacity: 0;
                -webkit-transform: rotate(900deg)
            }
        }

        @-moz-keyframes orbit {
            0% {
                opacity: 1;
                z-index: 99;
                -moz-transform: rotate(180deg);
                -moz-animation-timing-function: ease-out
            }
            7% {
                opacity: 1;
                -moz-transform: rotate(300deg);
                -moz-animation-timing-function: linear;
                -moz-origin: 0
            }
            30% {
                opacity: 1;
                -moz-transform: rotate(410deg);
                -moz-animation-timing-function: ease-in-out;
                -moz-origin: 7%
            }
            39% {
                opacity: 1;
                -moz-transform: rotate(645deg);
                -moz-animation-timing-function: linear;
                -moz-origin: 30%
            }
            70% {
                opacity: 1;
                -moz-transform: rotate(770deg);
                -moz-animation-timing-function: ease-out;
                -moz-origin: 39%
            }
            75% {
                opacity: 1;
                -moz-transform: rotate(900deg);
                -moz-animation-timing-function: ease-out;
                -moz-origin: 70%
            }
            76% {
                opacity: 0;
                -moz-transform: rotate(900deg)
            }
            100% {
                opacity: 0;
                -moz-transform: rotate(900deg)
            }
        }
    </style>
</head>

<body>

    <div class="main-wrapper">
        @if(config('settings.config_loder_type') != 'default') @if(config('settings.config_loder_name'))
        <!-- LOADER -->
        <div class="preloader">
            <div class="loadingNew loading06">
                @foreach(explode('_',config('settings.config_loder_name')) as $row )
                <span data-text="{{ $row }}">{{ $row }}</span> @endforeach
            </div>
        </div>
        @endif @else
        <!-- LOADER -->
        <div class="preloader">
            <div class="loadingDefault loading06">
                <div class="windows8">
                    <div class="wBall" id="wBall_1">
                        <div class="wInnerBall"></div>
                    </div>
                    <div class="wBall" id="wBall_2">
                        <div class="wInnerBall"></div>
                    </div>
                    <div class="wBall" id="wBall_3">
                        <div class="wInnerBall"></div>
                    </div>
                    <div class="wBall" id="wBall_4">
                        <div class="wInnerBall"></div>
                    </div>
                    <div class="wBall" id="wBall_5">
                        <div class="wInnerBall"></div>
                    </div>
                </div>
            </div>
        </div>
        @endif
        <!-- partial:partials/_navbar.html -->
        <!-- partial:partials/_sidebar.html -->
        <nav class="sidebar">
            <div class="sidebar-header">
                <a href="{{route('admin.home')}}" class="sidebar-brand">
                    <img src="{{ asset('storage')}}/logo/0/{{explode('/',$site->logo)[3]}}" style="width: 145px;object-fit: contain;height: 50px;">
                </a>
                <div class="sidebar-toggler not-active">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
            <div class="sidebar-body">
                @include('admin.layouts.common-menu')
            </div>
        </nav>

        <!-- partial -->
        <div class="page-wrapper">
            @include('admin.layouts.notification')
            @show @section('content') @show @section('footer')

            <!-- core:js -->
            <script src="{{asset('assets/vendors/core/core.js')}}"></script>
            <!-- endinject -->
            <!-- plugin js for this page -->
            <script src="{{asset('assets/js/template.js')}}"></script>
            <script src="{{asset('assets/js/jquery-3.4.1.js')}}"></script>
            <script src="{{asset('assets/js/jquery-confirm.js')}}"></script>
            <script src="{{asset('assets/js/jquery-ui.js')}}"></script>
            <script src="{{asset('assets/js/toastr.min.js')}}"></script>
            <script src="{{asset('assets/vendors/feather-icons/feather.min.js')}}"></script>
            <script src="{{asset('assets/js/dropzone.js')}}"></script>
            <script src="{{asset('assets/js/custome.js')}}"></script>
            <!-- @notifyJs -->
            <!-- <x:notify-messages /> -->

            <script type="text/javascript">
                $("#profile").change(function() {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#profileImg').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(this.files[0]); // convert to base64 string
                });
            </script>
            <script>
                $(function(){
                
                    @if(!empty($errors->first('success_message')))
                        toastr.success('{{ $errors->first('success_message')}}','Success!');
                    @endif
                    
                    @if(!empty($errors->first('failure_message')))
                    	toastr.warning('{{$errors->first('failure_message')}}','Warning!');
                    @endif
					@if(!empty($errors->first('error_message')))
                    	toastr.info('{{$errors->first('error_message')}}','Error!');
                    @endif
                });
            </script>
            @section('create-chart') @show @section('myscript') @show @include('pusher.pusher')
            <!-- end custom js for this page -->
</body>

</html>
@show