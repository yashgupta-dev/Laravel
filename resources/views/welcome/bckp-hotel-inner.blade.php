@extends('layouts.welcome')

@section('title')
   <title>Hotel | Grezns Hotels </title>
@endsection
@section('css')

<link rel="stylesheet" href="{{ asset('welcome/css/bootstrap-datepicker.css') }}">

<link rel="stylesheet" type="text/css" media="all" href="{{ asset('welcome/css/daterangepicker-bs3.css') }}" />

<link rel="stylesheet" href="{{ asset('welcome/css/responsive3.css') }}">
<link rel="stylesheet" href="{{ asset('welcome/css/responsive4.css') }}">
<link rel="stylesheet" href="{{ asset('welcome/css/responsive.css') }}"> 
<link rel="stylesheet" href="{{ asset('welcome/css/grezns_responsive.css') }}">
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>

       <style>
        .contact-banner {
            text-align: center;
            /* linear-gradient(rgb(142, 142, 144, 80%), rgb(142, 142, 144, 80%)), */
            background-image:url('@if(!empty($exists->image)) /storage{{ explode('public',$exists->image)[1] }} @else {{ asset('logo/placeholder/placeholder.jpg')}} @endif');
    background-size:cover;
    background-position:center;
    background-repeat: no-repeat;
    padding:0px 0 0px;
	height:670px !important;
}
        @media (max-width: 3000px) and (min-width: 992px) {
            .toppHeader .headertop .btn-toggle2 {
               right: 0px !important;
            }
         }
      
       @font-face{font-family:dallas light;src:url('https//static.showit.co/file/KRkaq8XxQ5i7h2tlnNEi5A/77884/dallas-light-webfont.woff');}
      </style>
      <style>
         @font-face{font-family:dallas light;src:url('dallas-light-webfont.woff');}
		 .headingsection.housdddd { margin-top: 0px;}

       @media (min-width: 992px) {
 .check-in-out {
    text-align: left;
}
       }

 .check-in-out {
    border-radius: 4px;
    background: #F2F2F2;
    text-align: center;
    padding-left: 30px;
    padding-right: 30px;
    padding-top: 15px;
    padding-bottom: 15px;
}
.check-in-out small {
    border-bottom: 1px solid #D8D8D8;
    white-space: nowrap;
    display: block;
    padding: 10px;
    font-size: 16px;
    color: #53565A;
    font-weight: 700;
}
.check-in-out [class*="icon-"] {
    margin-right: 10px;
}
.check-in-out [class*="icon-"] {
    margin-right: 10px;
}
.facility-icon li {
    display:inline-block;
}
.facility-icon {
    display: contents;
}
ul.facility-icon li img {
    width: 35px;
    height: 35px;
    border-radius: 50px;
    border: 2px solid #dde;
    background: #dddddd17;
}
      </style>
@endsection
@section('meta')
   
@endsection

@section('content')
@include('welcome.common.menu')
@include('welcome.common.desktop-menu')
<!-- menu -->
<div ng-app="app">
   <div ng-controller="hotelinnercontroller">
      <div style="position: relative;">
         <section id="bookinginersd" class="contact-banner abt-banner book-nows hotelpagesub">
            @include('welcome.common.auth')
            <div class="container">
                  <div class="row">
                     <div class="col-md-12 col-sm-12 col-12">
                        <div class="hotel_heads">
                        
                              <h1 style="text-transform: capitalize;">{{ $exists->hotel_name }}</h1>
                              <p style="line-height: 25px;">
                                 {{ $exists->hotel_short_desc }}
                              </p>
                        </div>
                        <div class="hotel">
                              <a id="Hotel" href="#hot_ty">{{ __('EXPLORE') }}</a>
                              <a id="contact" href="{{ route('Book-Now') }}">{{ __('Book Now') }}</a>
                        </div>
                        <!-- <div id="bookinginersd1">
                            <div class="hotel-form" style="margin-top: 80px; height: 150px; background: #fff;">
                                <div class="row">
                                    <div class="col-md-7 col-sm-7 col-12" style="text-align: left;">
                                          <div class="list">
                                             <h3 class="c-12d5dhi"><span class="list-heading">The grezns village blue & spa resort1</span></h3>
                                             <ul>
                                                <li class="circle-bullets show-list-style">
                                                      <span class="list-item">5% additional discount on all Wizard member hotels and 10% off on Wizard Base. </span>
                                                      <span class="list-item">Unlimited usage during the membership validity period. Experience true infinity</span>
                                                      <span class="list-item">Enjoy Wizard-exclusive, exciting deals at The Grezns</span>
                                                </li>
                                             </ul>
                                          </div>
                                    </div>
                                    <div class="col-md-5 col-sm-5 col-12">
                                          <section class="wizard-video-card dark">
                                             <h3 style="display: none;">&nbsp;</h3>
                                             <span class="c-1owv2mq w-icon-default video-w">
                                                <img src="{{ asset('welcome/img/granzs1.png') }}" alt="Grezns" style="width: 20px; margin: 20px 5px;" />
                                             </span>
                                             <section class="video-text">
                                                <h3 style="display: none;">&nbsp;</h3>
                                                <section class="video-heading"><h6>&nbsp;See how it works&nbsp;</h6></section>
                                                <section class="video-subHeading"><h6>&nbsp;Watch Video&nbsp;</h6></section>
                                             </section>
                                             <section class="video-thumbnail">
                                                <h3 style="display: none;">&nbsp;</h3>
                                                <img src="{{ asset('welcome/img/wizardthumbnail.png') }}" alt="Wizard Video" />
                                             </section>
                                          </section>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                     </div>
                  </div>
            </div>
         </section>
      </div>

      <section class="mid-center pt-5 pb-5">
         <div class="container">
            <div class="row">
                  <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                     <div class="mid-img">
                        <div id="headingedkjiid1" class="headingsection" style="padding-top: 30px;">
                              <h4 style="line-height: 2; letter-spacing: 0.2em; font-size: 17px; font-family: 'dallas light' !important; font-weight: 400; font-style: normal;">Hotel</h4>
                              <h3 style="color: rgba(69, 66, 61, 1); line-height: 1.6; letter-spacing: 0.1em; font-size: 33px; font-family: 'Nanum Myeongjo' !important; text-align: left;text-transform: capitalize;">{{ $exists->hotel_name }}</h3>                              
                        </div>
                     </div>
                  </div>
            </div>
            <div class="row" id="overview">
                  <div class="col-sm-12 col-lg-9">
                     {!! $exists->hotel_desc !!}
                  </div>                  
                  <div class="col-sm-12 col-lg-3">
                  <div class="check-in-out">
                        <div class="row">
                            <div class="col-6 col-lg-12 no-gutters-down-md">
                                <small class="">
                                   <span class="icon-checkin xs"><i class="fa fa-clock"></i></span>
                                   {{ __('Check-in:')}}
                                   <span class="text-lower" data-test="checkin-time"> {{ date('h:i A',strtotime($exists->checkin)) }}</span>
                                 </small>
                            </div>
                            <div class="col-6 col-lg-12 no-gutters-down-md">
                                <small class="">
                                   <span class="icon-checkout xs"><i class="fa fa-clock"></i></span>
                                   {{ __('Check-out:')}}
                                   <span class="text-lower" data-test="checkout-time"> {{ date('h:i A',strtotime($exists->checkout)) }}</span>
                                 </small>
                            </div>
                        </div>
                    </div>
                  </div>
            </div>        
         </div>
      </section>
    @if(count($exists->getRooms))
      <section class="serivicegrezns" style="background: #dcdacb;">
         <div class="container">
            <!-- <div class="headingsection housdddd">
                  <h3>SERVICES</h3>
                  <span></span>
                  <h4>Perfectly Located</h4>
                  <p class="grezns34d">
                     Rooms with refined style and awash with light, jewels set in the Mediterranean nature. Rooms with refined style and awash with light, Mediterranean nature.Rooms with refined style and awash with light, jewels set in the
                     Mediterranean nature. Rooms with refined style and awash with light, Mediterranean nature.
                  </p>
            </div> -->
            <div class="firstpenals" style="position: relative;">
                  <div class="columns small-12 rooms-filter">
                     <ul class="nav nav-tabs" role="tablist">
                        @foreach($exists->getRooms as $index => $rooms)
                        <li class="nav-item">
                              <a class="nav-link {{ $index == 0 ? 'active' : '' }}" data-toggle="tab" href="#tabsrooms-filter-{{ $rooms->category_id }}" role="tab">{{ $rooms->name }}</a>
                        </li>
                        @endforeach
                     </ul>
                  </div>
            </div>
         </div>         
         <div class="tab-content" id="serivices22">
            
            @foreach($exists->getRooms as $index => $rooms)
            
            <div class="tab-pane {{ $index == 0 ? 'active' : '' }}" id="tabsrooms-filter-{{ $rooms->category_id }}" role="tabpanel">
                 @if(count($rooms->getRoomsData) > 0)
                  <div class="blogs" style="position: relative;">
                     <div class="containerfluid">
                        <div class="row blogskd">
                              <div class="columns columnsLeft colmadkdsjfk2" style="background-image: url({{ asset('welcome/img/greznsroom1.jpg') }});"></div>
                              <div class="columns columnsRight colmadkdsjfk2222">
                                 <div class="headingsection" style="position: relative;">
                                    <h3>{{ $rooms->name }}</h3>
                                    <span></span>
                                 </div>
                                 <div class="border80"></div>
                              </div>
                                <div class="columns columnsRight boxgreznscolam partone1">
                                    
                                    <div class="colmadkdsjfk">

                                        <div class="mydivs{{ $index}}">
                                        @foreach($exists->getRoomss as $roomss)
                                            @foreach($roomss->getRoomsData as $roomkeys=> $roomsdetails) 
                                            <div class="cls1 cls0">
                                                <div class="colmadkdsjfk">
                                                    <div class="text-alind">
                                                        <span>{{ __('Price (per night)') }}</span>
                                                        <p>Rs.{{ $roomsdetails['price'] }}</p>
                                                    </div>
                                                    <img src="@if(!empty($roomsdetails['image'])) /storage{{ explode('public',$roomsdetails['image'])[1] }} @else {{ asset('logo/placeholder/placeholder.jpg')}} @endif" alt="Grezns" style="width: 100%;" />
                                                </div>
                                            </div>                    
                                            @endforeach
                                        @endforeach
                                        </div>
                                    </div>

                                    <div class="hoteltypesServices">
                                        <div class="mydivs2{{ $index}}">
                                        @foreach($exists->getRoomss as $roomss)
                                        @foreach($roomss->getRoomsData as $roomkeys=> $roomsdetails) 
                                        
                                            <div class="cls1 cls0">
                                                <div class="headingsection secondhots" style="padding-bottom: 0px;">
                                                    <h3>{{ $roomsdetails['name'] }}</h3>                                                
                                                </div>
                                                <div class="d-flex justify-content-between">
                                                    <h6 class="text-dark">{{ __('Max Adult: ') }} {{ $roomsdetails['adult'] }}</h6>
                                                    <h6 class="text-dark">{{ __('Max Child: ') }} {{ $roomsdetails['child'] }}</h6>
                                                </div>
                                                
                                                @if(count($roomss->getFixedFacilties) > 0)
                                                <div style="text-align:start;">
                                                    <h6 style="display:-webkit-inline-box;" class="text-dark">{{ __('Facility: ') }}
                                                    <ul class="facility-icon">
                                                        @foreach($roomss->getFixedFacilties as $facility)    
                                                        <li>
                                                        <img data-toggle="tooltip" data-placement="top" title="{{ $facility->faciltie_name }}" src="@if(!empty($facility->faciltie_icon)) /storage{{ explode('public',$facility->faciltie_icon)[1] }} @else {{ asset('logo/placeholder/placeholder.jpg')}} @endif" alt="{{ $facility->faciltie_name }}" />
                                                        <li>
                                                        @endforeach
                                                    </ul>
                                                    </h6>
                                                </div>
                                                @endif
                                                @if(count($roomss->getOptionalFacilties) > 0)
                                                <div style="text-align:start;">
                                                    <h6 style="display:-webkit-inline-box;" class="text-dark">{{ __('Optinal Facility: ') }}
                                                    <ul class="facility-icon">
                                                        @foreach($roomss->getOptionalFacilties as $optionfacility)    
                                                        <li data-toggle="tooltip" data-placement="top" title="{{ $optionfacility->optional_facilitie_name }} @if(!empty($optionfacility->price)) ( {{ $optionfacility->price_prefix}} Rs. {{$optionfacility->price}} ) @endif">
                                                        <img src="@if(!empty($optionfacility->optional_facilitie_icon)) /storage{{ explode('public',$optionfacility->optional_facilitie_icon)[1] }} @else {{ asset('logo/placeholder/placeholder.jpg')}} @endif" alt="{{ $optionfacility->optional_facilitie_name }}" />
                                                        <li>
                                                        @endforeach
                                                    </ul>
                                                    </h6>
                                                </div>
                                                @endif
                                                
                                                <a href="{{ route('Book-Now') }}" style="float: left;">BOOK NOW</a>
                                                <a href="#" style="float: right;">SEE MORE</a>

                                            </div>
                                        @endforeach
                                        @endforeach
                                        </div>
                                    </div>
                                    

                                </div>
                            @if(count($roomss->getRoomsData) > 0 )
                              <div class="buttons12">
                                 <div class="prev1"><i class="fas fa-angle-up"></i></div>
                                 <div class="next1"><i class="fas fa-chevron-down"></i></div>
                              </div>
                            @endif
                        </div>
                     </div>
                  </div>
                @endif
            </div>            
            @endforeach
         </div>
      </section>
    @endif
   </div>
</div>


@include('welcome.common.contact')
@include('welcome.common.brand')
@include('welcome.common.carsaul')

@endsection

@section('js')
   <script src="{{ asset('welcome/js/jquery.min.js') }} "></script>
   <script src="{{ asset('welcome/js/bootstrap.min.js') }} "></script>
   <script src="{{ asset('welcome/js/popper.min.js') }} "></script>
   <script src="{{ asset('welcome/js/custom.js') }} "></script>
   <script src="{{ asset('welcome/js/owl.carousel.js') }} "></script>
   <script src="{{ asset('welcome/js/mmenu-light.js') }} "></script>
   <script src="{{ asset('welcome/js/script.js') }} "></script>
    <script src="{{ asset('welcome/js/script2.js') }}"></script>
    <script src="{{ asset('welcome/js/script3.js' ) }}"></script>
    <script src="{{ asset('welcome/js/script4.js') }}"></script>
   
@endsection
@section('javascript')
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.2/angular.min.js"></script>  
<script>
var app = angular.module('app',[]);

app.controller('hotelinnercontroller', function ($scope, $http) {
    
    $scope.loader = true;
    $scope.getCountryList = function () {
        $http.get('{{ route("hotel-inner.hotels.details-get") }}').then(function (response) {
            $scope.loader = false;            
        });
    }; 
});
</script>
<script>
    $(function () {
  $('[data-toggle="tooltip"]').tooltip()
});
    @foreach($exists->getRooms as $index => $rooms)
         $(document).ready(function() {
          var divs = $('.mydivs{{$index}}>div');
          var now = 0;  
          divs.hide().first().show(); 
          $(".next1").click(function() {
              divs.eq(now).hide();
              now = (now + 1 < divs.length) ? now + 1 : 0;
              divs.eq(now).slideDown();  
          });
          $(".prev1").click(function() {
              divs.eq(now).hide();
              now = (now > 0) ? now - 1 : divs.length - 1;
              divs.eq(now).slideDown(); 
          });
         });
         $(document).ready(function() {
          var divs = $('.mydivs2{{$index}}>div');
          var now = 0;  
          divs.hide().first().show(); 
          $(".next1").click(function() {
              divs.eq(now).hide();
              now = (now + 1 < divs.length) ? now + 1 : 0;
              divs.eq(now).slideDown();  
          });
          $(".prev1").click(function() {
              divs.eq(now).hide();
              now = (now > 0) ? now - 1 : divs.length - 1;
              divs.eq(now).slideDown(); 
          });
         });
         @endforeach
      </script>

@endsection

