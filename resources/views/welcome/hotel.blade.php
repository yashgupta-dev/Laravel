@extends('layouts.welcome')

@section('title')
   <title>Hotel | Grezns Hotels </title>
@endsection
@section('css')
<link rel="stylesheet" href="{{ asset('welcome/css/responsive.css') }}"> 
<link rel="stylesheet" href="{{ asset('welcome/css/grezns_responsive.css') }}"> 
    <style>
        <style>
         @font-face{font-family:dallas light;src:url('https//static.showit.co/file/KRkaq8XxQ5i7h2tlnNEi5A/77884/dallas-light-webfont.woff');}
      </style>
      <style>
         @font-face{font-family:dallas light;src:url('dallas-light-webfont.woff');}
		
		#hotelsd .button.secondary{ padding: 13px 16px;}
        @media (max-width: 3000px) and (min-width: 992px) {
            .toppHeader .headertop .btn-toggle2 {
               right: 0px !important;
            }
         }
         .carousel-inner .carousel-item img {
                width: 100%;
                height: 500px !important;
                object-fit: cover;
            }
      </style>
@endsection
@section('meta')
   
@endsection

@section('content')
@include('welcome.common.menu')
@include('welcome.common.desktop-menu')
<!-- start content -->
<div ng-app="app">
    <div ng-controller="postController" ng-init="getCountryList()">
<div style="position: relative;">
   <section id="bookinginersd" class="contact-banner abt-banner book-nows hotelpagesub" style="background-image:url({{ asset('welcome/img/greznshotel.jpg' ) }}); background-size: cover; background-position: center center;   height: 540px;">
      @include('welcome.common.auth')
      <div class="container">
         <div class="row">
            <div class="col-md-12 col-sm-12 col-12">
               <div class="hotel_heads">
                  <h1 style="font-family: 'Roboto' !important; text-transform: capitalize;">Hotels</h1>
                  <p style="font-family: 'Roboto' !important; line-height: 25px;">Rooms with refined style and awash with light, jewels set in the Mediterranean nature. Rooms with refined style and awash with<br /> light, Mediterranean nature.Rooms with refined style</p>
               </div>
               <div class="hotel">
                  <a id="contact" href="book-now.html" style="background: #ab8e6e;">Book Now</a>
               </div>
            </div>
         </div>
      </div>
   </section>

   <section class="slider1">
      <div class="tab-slider-menu">
         <div class="containerf">
            <div class="bottomtap-menu">
               <ul>
                  <li ng-repeat="country in countrys" id="tabid-@{{ country.country_id }}" class="tabid-@{{ country.country_id }} hotelinfoid@{{ country.country_id }}" ng-if="country.active_state == 'active'" ng-class="country.active_state" ng-init="getHotelList($event, country.country_id)" ng-click="getHotelList($event, country.country_id)">
                     <a href="#@{{ country.country_name }}"><p>@{{ country.country_name }}</p></a>
                  </li>
                  <li ng-repeat="country in countrys" id="tabid-@{{ country.country_id }}" class="tabid-@{{ country.country_id }} hotelinfoid@{{ country.country_id }}" ng-if="country.active_state != 'active'" ng-class="country.active_state" ng-click="getHotelList($event, country.country_id)">
                     <a href="#@{{ country.country_name }}"><p>@{{ country.country_name }}</p></a>
                  </li>
               </ul>
            </div>
         </div>
      </div>
   </section>
</div>

<div class="hotelinformation1" id="hotelinfo1">
        <div id="hot_ty"></div>
        <section id="serivceksdf234" class="serivicegrezns" style="padding-bottom: 0px !important; background: #e5e3d7;">
            <div class="container">
                <div class="headingsection housdddd" style="text-align: center;">
                    <h3 style="text-align: center;">{{ __('Our Hotel') }}</h3>
                    <span style="margin: auto;"></span>
                    <p class="grezns34d">
                        {{ __('Rooms with refined style and awash with light, jewels set in the Mediterranean nature. Rooms with refined style and awash with light, Mediterranean nature.Rooms with refined style and awash with light, jewels set in the
                        Mediterranean nature. Rooms with refined style and awash with light, Mediterranean nature.') }}
                    </p>
                </div>
                <div class="firstpenals" style="position: relative;">
                    <div class="columns small-12 rooms-filter">
                        <ul class="nav nav-tabs" role="tablist">
                            <li ng-repeat="zone in zones" class="nav-item">
                                <a class="nav-link" data-toggle="tab" ng-class="zone.active_state" href="#tabs-@{{ zone.zone_id }}" role="tab">@{{ zone.zone_name }}</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div id="hoekkdsddsf" class="tab-content mb-5">
                <div ng-repeat="zone in zones" class="tab-pane" ng-class="zone.active_state" id="tabs-@{{ zone.zone_id }}" role="tabpanel">
                    <section class="vill" id="hot_ty">
                        <div class="container">
                            <div ng-repeat="hotel in zone.hotels" class="row mt-5">
                                <div class="col-md-6 col-sm-6 col-12 @{{ hotel.side2 }}">
                                    <div class="produst">
                                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                        <ol class="carousel-indicators">
                                            <li ng-repeat="(slide, key) in hotel.gallery" data-target="#carouselExampleIndicators" data-slide-to="@{{ slide }}" ng-class="slide ==0 ? 'active' : ''"></li>
                                        </ol>
                                        <div class="carousel-inner">
                                            <div ng-repeat="(key,gallery) in hotel.gallery" class="carousel-item"  ng-class="key ==0 ? 'active' : ''">
                                                <img class="d-block w-100" src="@{{ gallery }}" alt="Grezns"/>
                                            </div>
                                        </div>
                                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>                                            
                                        </a>
                                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>                                            
                                        </a>
                                    </div>                                        
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-12 @{{ hotel.side1 }}">
                                    <div class="right-column">
                                        <div class="info-container critical-height">
                                            <div class="logo-container">
                                                <figure class="image-container">
                                                    <img src="@{{ hotel.image }}" alt="Grezns" title="The grezns Village Blue &amp; Spa Resort" />
                                                </figure>
                                            </div>
                                            <header class="main-title-container five-stars">
                                                <div class="desktop-container">
                                                    <div class="stars-container">
                                                        <img class="star" src="{{ asset('welcome/img/1.svg' ) }}" alt="Grezns" />
                                                        <img class="star" src="{{ asset('welcome/img/1.svg' ) }}" alt="Grezns" />
                                                        <img class="star" src="{{ asset('welcome/img/1.svg' ) }}" alt="Grezns" />
                                                        <img class="star" src="{{ asset('welcome/img/1.svg' ) }}" alt="Grezns" />
                                                        <img class="star" src="{{ asset('welcome/img/1.svg' ) }}" alt="Grezns" />
                                                    </div>
                                                    <h2 class="title js-anchor">
                                                        @{{ hotel.hotel_name }}
                                                    </h2>
                                                    <p>@{{ hotel.hotel_short_desc }}</p>
                                                </div>
                                            </header>
                                            <div class="button-container">
                                                <a href="/hotel-inner/@{{ hotel.slug }}" class="button secondary">{{ __('view more') }}</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>                            
                        </div>
                    </section>
                </div>
            </div>
        </section>
</div>
</div>
</div>
<!-- end -->


<!-- section start here -->
<!-- contact form start here -->
<section class="contact-list">
    <div class="container min-container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-12">
                <div class="contact-full">
                    <div class="con_form">
                        <h3>GET IN TOUCH</h3>
                        <form action="index" method="post">
                            <div class="form-group">
                                <input type="text" id="name" class="form-control" name="name" placeholder="Full Name" />
                            </div>
                            <div class="form-group">
                                <input type="text" id="business" class="form-control" name="business" placeholder="Business Name" />
                            </div>
                            <div class="form-group">
                                <input type="email" id="email" class="form-control" name="email" placeholder="Email" />
                            </div>
                            <div class="form-group">
                                <input type="number" id="phone" class="form-control" name="phone" placeholder="Phone No" />
                            </div>
                            <div class="form-group">
                                <input type="text" id="need" class="form-control" name="need" placeholder="Service Needed" />
                            </div>
                            <div class="form-group">
                                <select class="form-control">
                                    <option value="Select">Select</option>
                                    <option value="General">General</option>
                                    <option value="Wedding">Wedding</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" placeholder="Message"></textarea>
                            </div>
                            <button type="button" id="btn_submit" class="btn">Submit</button>
                        </form>
                    </div>
                    <div class="con-img">
                        <img src="{{ asset('welcome/img/q2.jpg' ) }}" alt="Grezns" />
                        <div class="fun-email">
                            <div class="em">
                                <h3>Email</h3>
                                <a href="mailto:info@grezns.com">info@grezns.com</a>
                            </div>
                            <div class="em">
                                <h3>office hours</h3>
                                <p>M - F / 9am - 5pm MST</p>
                            </div>
                            <div class="em">
                                <h3>Based in</h3>
                                <p>India</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- contact form start here -->
<section class="grnad pt-3 pb-3">
    <h3 style="display: none;">&nbsp;</h3>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="owl-cl">
                    <div class="owl-carousel owl-theme" id="custom-owl">
                        <div class="item">
                            <img src="{{ asset('welcome/img/logo-footer-white.png' ) }}" alt="img1" />
                        </div>
                        <div class="item">
                            <img src="{{ asset('welcome/img/logo-footer-white.png' ) }}" alt="img1" />
                        </div>
                        <div class="item">
                            <img src="{{ asset('welcome/img/logo-footer-white.png' ) }}" alt="img1" />
                        </div>
                        <div class="item">
                            <img src="{{ asset('welcome/img/logo-footer-white.png' ) }}" alt="img1" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

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

app.controller('postController', function ($scope, $http) {
    $scope.countrys = [];
    $scope.zones = [];
    $scope.loader = true;
    $scope.getCountryList = function () {
        $http.get('{{ route("country.hotels.get") }}').then(function (response) {
            $scope.loader = false;
            $scope.countrys        = response.data.data;            
        });
    }; 

    $scope.getHotelList = function($event, $id) {        
        $http.post('/country/get/zones/'+$id).then(function (response) {
            $scope.zones        = response.data.data;            
        });
    }
});
</script>
@endsection

