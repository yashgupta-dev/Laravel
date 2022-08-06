@extends('layouts.welcome')

@section('title')
   <title>Luxury Hotels & Resorts in India & the World | Grezns Hotels</title>
@endsection
@section('css')
   <link rel="stylesheet" href="{{ asset('welcome/css/responsive4.css') }}">
	<link rel="stylesheet" href="{{ asset('welcome/css/responsive.css') }}"> 
   <link rel="stylesheet" href="{{ asset('welcome/css/grezns_responsive.css') }}"> 
   <style>
        @font-face{font-family:dallas light;src:url('{{ asset("welcome/css/dallas-light-webfont.woff") }}');}
		.toppHeader .headertop .spanline1, .toppHeader .headertop .spanline2, .toppHeader .headertop .spanline3 { background: #ab8e6e;}
    </style>
@endsection
@section('meta')
   <meta name="keywords" content="Grezns hotels, Grezns luxury hotels, 5 star hotels, resorts in india, business hotels, luxury hotels in india, luxury hotels in Delhi, best hotels in india, hotels in delhi"/>
   <meta name="description" content="Grezns is the collection of hotels in across the globe. Reinterprets the tradition of hospitality in a refreshingly modern way to create unique experiences and lifelong memories."/>

   <meta property="og:site_name" content="Grezns Hotels"/>
   <meta property="og:type" content="website"/>
   <meta property="og:url" content="https://www.grezns.com"/>
   <link rel="canonical" href="https://www.grezns.com/"/>

   <meta name="robots" content="index, follow"/>
   <meta property="og:locale" content="en_US" />
   <meta property="og:url" content="https://www.coreseoservices.com/" />
   <meta property="og:site_name" content="Grezns Hotels" />
   <meta property="og:title" content="Luxury Hotels & Resorts in India & the World | Grezns Hotels" />
   <meta property="og:description" content="Grezns is the collection of hotels in across the globe. Reinterprets the tradition of hospitality in a refreshingly modern way to create unique experiences and lifelong memories." />
   <meta property="article:publisher" content="https://www.facebook.com/thegreznshotel/" /><meta property="og:image" content="https://grezns.com/img/horrizontallogo.png" />
   <meta name="twitter:card" content="summary_large_image"/><meta name="twitter:description" content="Grezns is the collection of hotels in across the globe. Reinterprets the tradition of hospitality in a refreshingly modern way to create unique experiences and lifelong memories."/>
   <meta name="twitter:title" content="Luxury Hotels & Resorts in India"/><meta name="twitter:site" content="@grezns"/><meta name="twitter:image" content="https://grezns.com/img/horrizontallogo.png"/>
@endsection
@section('content')
<!-- menu -->
@include('welcome.common.menu')
@include('welcome.common.desktop-menu')
      <section class="slider">
         <div class="log-bg" style="    width: 345px;">
            <img src="{{ asset('welcome/img/logo-bg.png') }} " alt="Grezns"/>
            <div class="toppHeader" style="    right: 0px;">
               <div class="headertop">
                  <div class="rowdiv">
                     <div class="booknow"><a href="book-now.html">Book Now</a></div>
                  </div>
                  <div class="btn-toggle2">
                     <div class="togglebtn2">
                        <span class="spanline1"></span>
                        <span class="spanline2"></span>
                        <span class="spanline3"></span>
                     </div>
                  </div>
               </div>
               <div class="headermiddle">
                  <div class="logohere1"><img src="{{ asset('welcome/img/slhAward.png') }} " alt="Grezns"></div>
                  <div class="logohere1"><img src="{{ asset('welcome/img/condeNastAward.png') }} " alt="Grezns"></div>
               </div>
               <div class="headerbottom">
                  <div class="logohere2">
                     <a href="http://grezns.com"><img src="{{ asset('welcome/img/horrizontallogo.png') }} " alt="Grezns"></a>
                  </div>
               </div>
            </div>
            <div class="scrollbtnss">
               <a><span></span></a>
            </div>
         </div>
         <div class="sld-slider">
            <div class="sld-slides" id="sld-slides">
               <div class="sld-slide">
                  <div class="sliderimages"><img src="{{ asset('welcome/img/greznsbannerslide1b.jpg') }} " alt="Grezns"></div>
                  <div class="container">
                     <div class="sliderHeading homes">
                        <h4>The Grezns New Delhi</h4>
                        <h3>We give you a legendary welcome, every time you come back.</h3>
                     </div>
                  </div>
               </div>
               <div class="sld-slide">
                  <div class="sliderimages"><img src="{{ asset('welcome/img/greznsbannerslide2.jpg') }} " alt="Grezns"></div>
                  <div class="container">
                     <div class="sliderHeading">
                        <h4>The Grezns Mumbai </h4>
                        <h3>We aim to redefine a new dimension of luxury and relaxation</h3>
                     </div>
                  </div>
               </div>
               <div class="sld-slide">
                  <div class="sliderimages"><img src="{{ asset('welcome/img/greznsbannerslide3.jpg') }} " alt="Grezns"></div>
                  <div class="container">
                     <div class="sliderHeading">
                        <h4>The Grezns Bengaluru</h4>
                        <h3>The best people to take care of our most valuable asset: you</h3>
                     </div>
                  </div>
               </div>
               <div class="sld-slide">
                  <div class="sliderimages"><img src="{{ asset('welcome/img/greznsbannerslide4.jpg') }} " alt="Grezns"></div>
                  <div class="container">
                     <div class="sliderHeading">
                        <h4>The Grezns Hyderabad</h4>
                        <h3>Come and stay with us to feel even better than at home.</h3>
                     </div>
                  </div>
               </div>
               <div class="sld-slide">
                  <div class="sliderimages"><img src="{{ asset('welcome/img/greznsbannerslide5.jpg') }} " alt="Grezns"></div>
                  <div class="container">
                     <div class="sliderHeading">
                        <h4>The Grezns Kolkata</h4>
                        <h3>Enjoy family time. Spend more moments together.</h3>
                     </div>
                  </div>
               </div>
               <div class="sld-slide">
                  <div class="sliderimages"><img src="{{ asset('welcome/img/greznsbannerslide6.jpg') }} " alt="Grezns"></div>
                  <div class="container">
                     <div class="sliderHeading">
                        <h4>The Grezns Ahmedabad</h4>
                        <h3>Enjoy an extraordinary retreat with exclusive offers.</h3>
                     </div>
                  </div>
               </div>
               <div class="sld-slide">
                  <div class="sliderimages"><img src="{{ asset('welcome/img/greznsbannerslide7.jpg') }} " alt="Grezns"></div>
                  <div class="container">
                     <div class="sliderHeading">
                        <h4>The Grezns Surat</h4>
                        <h3>Relax and refresh – a perfect family getaway.</h3>
                     </div>
                  </div>
               </div>
               <div class="sld-slide">
                  <div class="sliderimages"><img src="{{ asset('welcome/img/greznsbannerslide8.jpg') }} " alt="Grezns"></div>
                  <div class="container">
                     <div class="sliderHeading">
                        <h4>The Grezns Shimla</h4>
                        <h3>We give you more of what you want and less of what you don’t need.</h3>
                     </div>
                  </div>
               </div>
               <div class="sld-slide">
                  <div class="sliderimages"><img src="{{ asset('welcome/img/greznsbannerslide9.jpg') }} " alt="Grezns"></div>
                  <div class="container">
                     <div class="sliderHeading">
                        <h4>The Grezns bhopal</h4>
                        <h3>Redefine your expectations. A hotel experience, unlike the rest.</h3>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="tab-slider-menu">
            <div class="containerf">
               <div class="bottomtap-menu">
                  <ul>
                     <li class="active"   id="tabid-1" href="tabid-1">
                        <a>
                           <p>New Delhi</p>
                        </a>
                     </li>
                     <li id="tabid-2" href="tabid-2">
                        <a>
                           <p>Mumbai</p>
                        </a>
                     </li>
                     <li id="tabid-3" href="tabid-3">
                        <a>
                           <p>Bengaluru</p>
                        </a>
                     </li>
                     <li id="tabid-4" href="tabid-4">
                        <a>
                           <p>Hyderabad</p>
                        </a>
                     </li>
                     <li id="tabid-5" href="tabid-5">
                        <a>
                           <p>Kolkata</p>
                        </a>
                     </li>
                     <li  id="tabid-6" href="tabid-6">
                        <a>
                           <p>Ahmedabad</p>
                        </a>
                     </li>
                     <li id="tabid-7" href="tabid-7">
                        <a>
                           <p>Surat</p>
                        </a>
                     </li>
                     <li id="tabid-8" href="tabid-8">
                        <a>
                           <p>Shimla</p>
                        </a>
                     </li>
                     <li id="tabid-9" href="tabid-9">
                        <a>
                           <p> BHOPAL</p>
                        </a>
                     </li>
                  </ul>
               </div>
            </div>
         </div>
      </section>
      <div id="sidebarNavigation" class="sidebarNavigation">
         <a href="http://grezns.com"> <img src="{{ asset('welcome/img/horrizontallogo2.png') }} " alt="Grezns"></a>
         <a  class="booknow343" href="book-now.html">Book Now</a>
         <div class="togglebtn">
            <span class="spanline1"></span>
            <span class="spanline2"></span>
            <span class="spanline3"></span>
         </div>
      </div>
     
      <section class="aboutskdfd">
         <div class="container">
            <div class="bannerContainer" style="border-radius: 6px;width:100% !important;">
               <div class="bannerText paragraph">
                  <div class="bannerUpper">
                     <div class="headingsection">
                        <h3>About Us</h3>
                        <span></span>
                        <h4>Who We Are</h4>
                     </div>
                     <span>Rejuvenate your soul at our luxurious hotels revealing premium locations. Stay, dine and celebrate with us at more than 10 luxurious hotels across the globe.  </span>
                     <a class="mobile_only" target="_blank" href="#"><img src="{{ asset('welcome/img/2021award.png') }} " alt="Grezns"></a>
                  </div>
                  <hr>
                  <span class="latin"> The Grezns is a chain of luxurious hotels in India and abroad. We are one of India's fastest growing premium hospitality brands, managing a portfolio of over 10 luxurious properties across the globe. Established in 2011 by prominent hospitality specialist Mr. Ravi Shankar , The Grezns, A chain of luxurious hotels is a renowned and trusted brand with a growth plan to reach more than 100 hotels by 2025.</span>
                  <a href="about-us.html" class="booknow3431">View More</a> 
               </div>
               <div class="bannerLogo mobile_hidden">
                  <img class="full_width" src="{{ asset('welcome/img/greznsabout.jpg') }} " alt="Grezns" style="border-radius:6px;">
               </div>
            </div>
         </div>
      </section>
      <section class="hoteltypes111">
         <div class="firstpenals">
            <div class="container">
               <div class="headingsection">
                  <h3>Destinations</h3>
                  <span></span>
                  <h4>Perfectly Located</h4>
               </div>
               <div class=" columns small-12 rooms-filter">
                  <ul class="nav nav-tabs" role="tablist">
                     <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab">INDIA</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab">BRITAIN</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab">AMERICA</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#tabs-4" role="tab">SOUTH AFRICA</a>
                     </li>
                  </ul>
               </div>
            </div>
         </div>
         <div class="secondpenals">
            <div class="tab-content">
               <div class="tab-pane active" id="tabs-1" role="tabpanel">
                  <div class="backtabskd" style="background:url({{ asset('welcome/img/back1.jpg') }});    position: absolute;top: 0;height:750px;width: 100%;z-index: -1;background-position: center center;background-size: cover;">
                  </div>
                  <div class="container">
                     <div class="row">
                        <div class="col-md-8">
                           <p>During the time that the global pandemic was all around, The Grezns was creating iconic landmarks surpassing all expectations. The Grezns chain of Luxurious Hotels has a range of award-winning properties that celebrates the premium luxury comfort, based primarily on artificial intelligence
						   </p>
                        </div>
                     </div>
                  </div>
                  <section class="sldierAnimate">
                     <div class="owlthemeSlider">
                        <div class="thumbs-block">
                           <div class="thumbs">
                              <div rel="group" class="fancybox thumb">
                                 <div class="elementer1">
                                    <img src="{{ asset('welcome/img/greznshome1.jpg') }} " alt="Grezns">
                                    <a href="hotel-list-view.html">
                                       <h3>The Grezns <span>Luxurius Hotel Collection </span></h3>
                                    </a>
                                 </div>
                                 <div class="overlaybox">
                                    <img src="{{ asset('welcome/img/greznshome1.jpg') }} " alt="Grezns">
                                    <a href="hotel-list-view.html">
                                       <h6>View More</h6>
                                    </a>
                                 </div>
                              </div>
                              <div rel="group" class="fancybox thumb">
                                 <div class="elementer1">
                                    <img src="{{ asset('welcome/img/greznshome3.jpg') }} " alt="Grezns">
                                    <a href="hotel-list-view.html">
                                       <h3>The Grezns2 <span>Luxurius Hotel Collection </span></h3>
                                    </a>
                                 </div>
                                 <div class="overlaybox">
                                    <img src="{{ asset('welcome/img/greznshome3.jpg') }} " alt="Grezns">
                                    <a href="hotel-list-view.html">
                                       <h6>View More</h6>
                                    </a>
                                 </div>
                              </div>
                              <div rel="group" class="fancybox thumb">
                                 <div class="elementer1">
                                    <img src="{{ asset('welcome/img/greznshotel6.jpg') }} " alt="Grezns">
                                    <a href="hotel-list-view.html">
                                       <h3>The Grezns3 <span>Luxurius Hotel Collection </span></h3>
                                    </a>
                                 </div>
                                 <div class="overlaybox">
                                    <img src="{{ asset('welcome/img/greznshotel6.jpg') }} " alt="Grezns">
                                    <a href="hotel-list-view.html">
                                       <h6>View More</h6>
                                    </a>
                                 </div>
                              </div>
                              <div rel="group" class="fancybox thumb">
                                 <div class="elementer1">
                                    <img src="{{ asset('welcome/img/greznshome5.jpg') }} " alt="Grezns">
                                    <a href="hotel-list-view.html">
                                       <h3>The Grezns4 <span>Luxurius Hotel Collection </span></h3>
                                    </a>
                                 </div>
                                 <div class="overlaybox">
                                    <img src="{{ asset('welcome/img/greznshome5.jpg') }} " alt="Grezns">
                                    <a href="hotel-list-view.html">
                                       <h6>View More</h6>
                                    </a>
                                 </div>
                              </div>
                              <div  rel="group"  class="fancybox thumb">
                                 <div class="elementer1">
                                    <img src="{{ asset('welcome/img/greznshome7.jpg') }} " alt="Grezns">
                                    <a href="hotel-list-view.html">
                                       <h3>The Grezns5 <span>Luxurius Hotel Collection </span></h3>
                                    </a>
                                 </div>
                                 <div class="overlaybox">
                                    <img src="{{ asset('welcome/img/greznshome7.jpg') }} " alt="Grezns">
                                    <a href="hotel-list-view.html">
                                       <h6>View More</h6>
                                    </a>
                                 </div>
                              </div>
                              <div rel="group" class="fancybox thumb">
                                 <div class="elementer1">
                                    <img src="{{ asset('welcome/img/greznshome2.jpg') }} " alt="Grezns">
                                    <a href="hotel-list-view.html">
                                       <h3>The Grezns6 <span>Luxurius Hotel Collection </span></h3>
                                    </a>
                                 </div>
                                 <div class="overlaybox">
                                    <img src="{{ asset('welcome/img/greznshome2.jpg') }} " alt="Grezns">
                                    <a href="hotel-list-view.html">
                                       <h6>View More</h6>
                                    </a>
                                 </div>
                              </div>
                              <div rel="group" class="fancybox thumb">
                                 <div class="elementer1">
                                    <img src="{{ asset('welcome/img/greznshome4.jpg') }} " alt="Grezns">
                                    <a href="hotel-list-view.html">
                                       <h3>The Grezns7 <span>Luxurius Hotel Collection </span></h3>
                                    </a>
                                 </div>
                                 <div class="overlaybox">
                                    <img src="{{ asset('welcome/img/greznshome4.jpg') }} " alt="Grezns"> 
                                    <a href="hotel-list-view.html">
                                       <h6>View More</h6>
                                    </a>
                                 </div>
                              </div>
                              <div rel="group" class="fancybox thumb">
                                 <div class="elementer1">
                                    <img src="{{ asset('welcome/img/greznshotel7.jpg') }} " alt="Grezns">
                                    <a href="hotel-list-view.html">
                                       <h3>The Grezns8 <span>Luxurius Hotel Collection </span></h3>
                                    </a>
                                 </div>
                                 <div class="overlaybox">
                                    <img src="{{ asset('welcome/img/greznshotel7.jpg') }} " alt="Grezns"> 
                                    <a href="hotel-list-view.html">
                                       <h6>View More</h6>
                                    </a>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </section>
               </div>
               <div class="tab-pane" id="tabs-2" role="tabpanel">
                  <div class="backtabskd" style="background:url({{ asset('welcome/img/back2.jpg') }});    position: absolute;top: 0;height: 750px;width: 100%;z-index: -1; background-position: center center;background-size: cover;">
                  </div>
                  <div class="container">
                     <div class="row">
                        <div class="col-md-8">
                           <p>During the time that the global pandemic was all around, The Grezns was creating iconic landmarks surpassing all expectations. The Grezns chain of Luxurious Hotels has a range of award-winning properties that celebrates the premium luxury comfort, based primarily on artificial intelligence</p>
                        </div>
                     </div>
                  </div>
                  <section class="sldierAnimate">
                     <div class="owlthemeSlider">
                        <div class="thumbs-block">
                           <div class="thumbs">
                              <div rel="group" class="fancybox thumb">
                                 <div class="elementer1">
                                    <img src="{{ asset('welcome/img/greznshome6.jpg') }} " alt="Grezns">  
                                    <a href="hotel-list-view.html">
                                       <h3>The Grezns <span>Luxurius Hotel Collection </span></h3>
                                    </a>
                                 </div>
                                 <div class="overlaybox">
                                    <img src="{{ asset('welcome/img/greznshome6.jpg') }} " alt="Grezns">
                                    <a href="hotel-list-view.html">
                                       <h6>View More</h6>
                                    </a>
                                 </div>
                              </div>
                              <div rel="group" class="fancybox thumb">
                                 <div class="elementer1">
                                    <img src="{{ asset('welcome/img/greznshome8.jpg') }} " alt="Grezns">
                                    <a href="hotel-list-view.html">
                                       <h3>The Grezns2 <span>Luxurius Hotel Collection </span></h3>
                                    </a>
                                 </div>
                                 <div class="overlaybox">
                                    <img src="{{ asset('welcome/img/greznshome8.jpg') }} " alt="Grezns">
                                    <a href="hotel-list-view.html">
                                       <h6>View More</h6>
                                    </a>
                                 </div>
                              </div>
                              <div rel="group" class="fancybox thumb">
                                 <div class="elementer1">
                                    <img src="{{ asset('welcome/img/greznshome9.jpg') }} " alt="Grezns">
                                    <a href="hotel-list-view.html">
                                       <h3>The Grezns3 <span>Luxurius Hotel Collection </span></h3>
                                    </a>
                                 </div>
                                 <div class="overlaybox">
                                    <img src="{{ asset('welcome/img/greznshome9.jpg') }} " alt="Grezns">
                                    <a href="hotel-list-view.html">
                                       <h6>View More</h6>
                                    </a>
                                 </div>
                              </div>
                              <div rel="group" class="fancybox thumb">
                                 <div class="elementer1">
                                    <img src="{{ asset('welcome/img/greznshome10.jpg') }} " alt="Grezns">
                                    <a href="hotel-list-view.html">
                                       <h3>The Grezns4 <span>Luxurius Hotel Collection </span></h3>
                                    </a>
                                 </div>
                                 <div class="overlaybox">
                                    <img src="{{ asset('welcome/img/greznshome10.jpg') }} " alt="Grezns">
                                    <a href="hotel-list-view.html">
                                       <h6>View More</h6>
                                    </a>
                                 </div>
                              </div>
                              <div  rel="group"  class="fancybox thumb">
                                 <div class="elementer1">
                                    <img src="{{ asset('welcome/img/greznshome12.jpg') }} " alt="Grezns">
                                    <a href="hotel-list-view.html">
                                       <h3>The Grezns5 <span>Luxurius Hotel Collection </span></h3>
                                    </a>
                                 </div>
                                 <div class="overlaybox">
                                    <img src="{{ asset('welcome/img/greznshome12.jpg') }} " alt="Grezns">
                                    <a href="hotel-list-view.html">
                                       <h6>View More</h6>
                                    </a>
                                 </div>
                              </div>
                              <div rel="group" class="fancybox thumb">
                                 <div class="elementer1">
                                    <img src="{{ asset('welcome/img/greznshome13.jpg') }} " alt="Grezns">
                                    <a href="hotel-list-view.html">
                                       <h3>The Grezns6 <span>Luxurius Hotel Collection </span></h3>
                                    </a>
                                 </div>
                                 <div class="overlaybox">
                                    <img src="{{ asset('welcome/img/greznshome13.jpg') }} " alt="Grezns">
                                    <a href="hotel-list-view.html">
                                       <h6>View More</h6>
                                    </a>
                                 </div>
                              </div>
                              <div rel="group" class="fancybox thumb">
                                 <div class="elementer1">
                                    <img src="{{ asset('welcome/img/greznshome14.jpg') }} " alt="Grezns">
                                    <a href="hotel-list-view.html">
                                       <h3>The Grezns7 <span>Luxurius Hotel Collection </span></h3>
                                    </a>
                                 </div>
                                 <div class="overlaybox">
                                    <img src="{{ asset('welcome/img/greznshome14.jpg') }} " alt="Grezns">
                                    <a href="hotel-list-view.html">
                                       <h6>View More</h6>
                                    </a>
                                 </div>
                              </div>
                              <div rel="group" class="fancybox thumb">
                                 <div class="elementer1">
                                    <img src="{{ asset('welcome/img/greznshome15.jpg') }} " alt="Grezns">
                                    <a href="hotel-list-view.html">
                                       <h3>The Grezns8 <span>Luxurius Hotel Collection </span></h3>
                                    </a>
                                 </div>
                                 <div class="overlaybox">
                                    <img src="{{ asset('welcome/img/greznshome15.jpg') }} " alt="Grezns">
                                    <a href="hotel-list-view.html">
                                       <h6>View More</h6>
                                    </a>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </section>
               </div>
               <div class="tab-pane" id="tabs-3" role="tabpanel">
                  <div class="backtabskd" style="background:url({{ asset('welcome/img/back3.jpg') }} );    position: absolute;top: 0;height: 750px;width: 100%;z-index: -1; background-position: center center;background-size: cover;">
                  </div>
                  <div class="container">
                     <div class="row">
                        <div class="col-md-8">
                           <p>During the time that the global pandemic was all around, The Grezns was creating iconic landmarks surpassing all expectations. The Grezns chain of Luxurious Hotels has a range of award-winning properties that celebrates the premium luxury comfort, based primarily on artificial intelligence</p>
                        </div>
                     </div>
                  </div>
                  <section class="sldierAnimate">
                     <div class="owlthemeSlider">
                        <div class="thumbs-block">
                           <div class="thumbs">
                              <div rel="group" class="fancybox thumb">
                                 <div class="elementer1">
                                    <img src="{{ asset('welcome/img/greznshome16.jpg') }} " alt="Grezns">
                                    <a href="hotel-list-view.html">
                                       <h3>The Grezns <span>Luxurius Hotel Collection </span></h3>
                                    </a>
                                 </div>
                                 <div class="overlaybox">
                                    <img src="{{ asset('welcome/img/greznshome16.jpg') }} " alt="Grezns">
                                    <a href="hotel-list-view.html">
                                       <h6>View More</h6>
                                    </a>
                                 </div>
                              </div>
                              <div rel="group" class="fancybox thumb">
                                 <div class="elementer1">
                                    <img src="{{ asset('welcome/img/greznshome17.jpg') }} " alt="Grezns">
                                    <a href="hotel-list-view.html">
                                       <h3>The Grezns2 <span>Luxurius Hotel Collection </span></h3>
                                    </a>
                                 </div>
                                 <div class="overlaybox">
                                    <img src="{{ asset('welcome/img/greznshome17.jpg') }} " alt="Grezns">
                                    <a href="hotel-list-view.html">
                                       <h6>View More</h6>
                                    </a>
                                 </div>
                              </div>
                              <div rel="group" class="fancybox thumb">
                                 <div class="elementer1">
                                    <img src="{{ asset('welcome/img/greznshome18.jpg') }} " alt="Grezns">
                                    <a href="hotel-list-view.html">
                                       <h3>The Grezns3 <span>Luxurius Hotel Collection </span></h3>
                                    </a>
                                 </div>
                                 <div class="overlaybox">
                                    <img src="{{ asset('welcome/img/greznshome18.jpg') }} " alt="Grezns">
                                    <a href="hotel-list-view.html">
                                       <h6>View More</h6>
                                    </a>
                                 </div>
                              </div>
                              <div rel="group" class="fancybox thumb">
                                 <div class="elementer1">
                                    <img src="{{ asset('welcome/img/greznshome20.jpg') }} " alt="Grezns">
                                    <a href="hotel-list-view.html">
                                       <h3>The Grezns4 <span>Luxurius Hotel Collection </span></h3>
                                    </a>
                                 </div>
                                 <div class="overlaybox">
                                    <img src="{{ asset('welcome/img/greznshome20.jpg') }} " alt="Grezns">
                                    <a href="hotel-list-view.html">
                                       <h6>View More</h6>
                                    </a>
                                 </div>
                              </div>
                              <div  rel="group"  class="fancybox thumb">
                                 <div class="elementer1">
                                    <img src="{{ asset('welcome/img/greznshome19.jpg') }} " alt="Grezns">
                                    <a href="hotel-list-view.html">
                                       <h3>The Grezns5 <span>Luxurius Hotel Collection </span></h3>
                                    </a>
                                 </div>
                                 <div class="overlaybox">
                                    <img src="{{ asset('welcome/img/greznshome19.jpg') }} " alt="Grezns">
                                    <a href="hotel-list-view.html">
                                       <h6>View More</h6>
                                    </a>
                                 </div>
                              </div>
                              <div rel="group" class="fancybox thumb">
                                 <div class="elementer1">
                                    <img src="{{ asset('welcome/img/greznshome21.jpg') }} " alt="Grezns">
                                    <a href="hotel-list-view.html">
                                       <h3>The Grezns6 <span>Luxurius Hotel Collection </span></h3>
                                    </a>
                                 </div>
                                 <div class="overlaybox">
                                    <img src="{{ asset('welcome/img/greznshome21.jpg') }} " alt="Grezns">
                                    <a href="hotel-list-view.html">
                                       <h6>View More</h6>
                                    </a>
                                 </div>
                              </div>
                              <div rel="group" class="fancybox thumb">
                                 <div class="elementer1">
                                    <img src="{{ asset('welcome/img/greznshome22.jpg') }} " alt="Grezns">
                                    <a href="hotel-list-view.html">
                                       <h3>The Grezns7 <span>Luxurius Hotel Collection </span></h3>
                                    </a>
                                 </div>
                                 <div class="overlaybox">
                                    <img src="{{ asset('welcome/img/greznshome22.jpg') }} " alt="Grezns">
                                    <a href="hotel-list-view.html">
                                       <h6>View More</h6>
                                    </a>
                                 </div>
                              </div>
                              <div rel="group" class="fancybox thumb">
                                 <div class="elementer1">
                                    <img src="{{ asset('welcome/img/greznshome23.jpg') }} " alt="Grezns">
                                    <a href="hotel-list-view.html">
                                       <h3>The Grezns8 <span>Luxurius Hotel Collection </span></h3>
                                    </a>
                                 </div>
                                 <div class="overlaybox">
                                    <img src="{{ asset('welcome/img/greznshome23.jpg') }} " alt="Grezns">
                                    <a href="hotel-list-view.html">
                                       <h6>View More</h6>
                                    </a>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </section>
               </div>
               <div class="tab-pane" id="tabs-4" role="tabpanel">
                  <div class="backtabskd" style="background:url({{ asset('welcome/img/back4.jpg') }} );    position: absolute;
                     top: 0;
                     height:750px;
                     width: 100%;
                     z-index: -1;
                     background-position: center center;
                     background-size: cover;">
                  </div>
                  <div class="container">
                     <div class="row">
                        <div class="col-md-8">
                           <p>During the time that the global pandemic was all around, The Grezns was creating iconic landmarks surpassing all expectations. The Grezns chain of Luxurious Hotels has a range of award-winning properties that celebrates the premium luxury comfort, based primarily on artificial intelligence</p>
                        </div>
                     </div>
                  </div>
                  <section class="sldierAnimate">
                     <div class="owlthemeSlider">
                        <div class="thumbs-block">
                           <div class="thumbs">
                              <div rel="group" class="fancybox thumb">
                                 <div class="elementer1">
                                    <img src="{{ asset('welcome/img/greznshome24.jpg') }} " alt="Grezns">
                                    <a href="hotel-list-view.html">
                                       <h3>The Grezns <span>Luxurius Hotel Collection </span></h3>
                                    </a>
                                 </div>
                                 <div class="overlaybox">
                                    <img src="{{ asset('welcome/img/greznshome24.jpg') }} " alt="Grezns">
                                    <a href="hotel-list-view.html">
                                       <h6>View More</h6>
                                    </a>
                                 </div>
                              </div>
                              <div rel="group" class="fancybox thumb">
                                 <div class="elementer1">
                                    <img src="{{ asset('welcome/img/greznshome25.jpg') }} " alt="Grezns">
                                    <a href="hotel-list-view.html">
                                       <h3>The Grezns2 <span>Luxurius Hotel Collection </span></h3>
                                    </a>
                                 </div>
                                 <div class="overlaybox">
                                    <img src="{{ asset('welcome/img/greznshome25.jpg') }} " alt="Grezns">
                                    <a href="hotel-list-view.html">
                                       <h6>View More</h6>
                                    </a>
                                 </div>
                              </div>
                              <div rel="group" class="fancybox thumb">
                                 <div class="elementer1">
                                    <img src="{{ asset('welcome/img/greznshome26.jpg') }} " alt="Grezns">
                                    <a href="hotel-list-view.html">
                                       <h3>The Grezns3 <span>Luxurius Hotel Collection </span></h3>
                                    </a>
                                 </div>
                                 <div class="overlaybox">
                                    <img src="{{ asset('welcome/img/greznshome26.jpg') }} " alt="Grezns">
                                    <a href="hotel-list-view.html">
                                       <h6>View More</h6>
                                    </a>
                                 </div>
                              </div>
                              <div rel="group" class="fancybox thumb">
                                 <div class="elementer1">
                                    <img src="{{ asset('welcome/img/greznshome27.jpg') }} " alt="Grezns">
                                    <a href="hotel-list-view.html">
                                       <h3>The Grezns4 <span>Luxurius Hotel Collection </span></h3>
                                    </a>
                                 </div>
                                 <div class="overlaybox">
                                    <img src="{{ asset('welcome/img/greznshome27.jpg') }} " alt="Grezns">
                                    <a href="hotel-list-view.html">
                                       <h6>View More</h6>
                                    </a>
                                 </div>
                              </div>
                              <div  rel="group"  class="fancybox thumb">
                                 <div class="elementer1">
                                    <img src="{{ asset('welcome/img/greznshome28.jpg') }} " alt="Grezns">
                                    <a href="hotel-list-view.html">
                                       <h3>The Grezns5 <span>Luxurius Hotel Collection </span></h3>
                                    </a>
                                 </div>
                                 <div class="overlaybox">
                                    <img src="{{ asset('welcome/img/greznshome28.jpg') }} " alt="Grezns">
                                    <a href="hotel-list-view.html">
                                       <h6>View More</h6>
                                    </a>
                                 </div>
                              </div>
                              <div rel="group" class="fancybox thumb">
                                 <div class="elementer1">
                                    <img src="{{ asset('welcome/img/greznshome29.jpg') }} " alt="Grezns">
                                    <a href="hotel-list-view.html">
                                       <h3>The Grezns6 <span>Luxurius Hotel Collection </span></h3>
                                    </a>
                                 </div>
                                 <div class="overlaybox">
                                    <img src="{{ asset('welcome/img/greznshome29.jpg') }} " alt="Grezns">
                                    <a href="hotel-list-view.html">
                                       <h6>View More</h6>
                                    </a>
                                 </div>
                              </div>
                              <div rel="group" class="fancybox thumb">
                                 <div class="elementer1">
                                    <img src="{{ asset('welcome/img/greznshome30.jpg') }} " alt="Grezns">
                                    <a href="hotel-list-view.html">
                                       <h3>The Grezns7 <span>Luxurius Hotel Collection </span></h3>
                                    </a>
                                 </div>
                                 <div class="overlaybox">
                                    <img src="{{ asset('welcome/img/greznshome30.jpg') }} " alt="Grezns">
                                    <a href="hotel-list-view.html">
                                       <h6>View More</h6>
                                    </a>
                                 </div>
                              </div>
                              <div rel="group" class="fancybox thumb">
                                 <div class="elementer1">
                                    <img src="{{ asset('welcome/img/greznshome31.jpg') }} " alt="Grezns">
                                    <a href="hotel-list-view.html">
                                       <h3>The Grezns8 <span>Luxurius Hotel Collection </span></h3>
                                    </a>
                                 </div>
                                 <div class="overlaybox">
                                    <img src="{{ asset('welcome/img/greznshome31.jpg') }} " alt="Grezns">
                                    <a href="hotel-list-view.html">
                                       <h6>View More</h6>
                                    </a>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </section>
               </div>
            </div>
         </div>
      </section>
	  <div id="photogallery">
     <section class="serivicegrezns">
         <div class="container">
            <div class="headingsection housdddd">
               <h3>SERVICES</h3>
               <span></span>
               <h4>Perfectly Located</h4>
               <p class="grezns34d">Rooms with refined style and awash with light, jewels set in the Mediterranean nature.
                  Rooms with refined style and awash with light, Mediterranean nature.Rooms with refined style and awash with light, jewels set in the Mediterranean nature.
                  Rooms with refined style and awash with light, Mediterranean nature.
               </p>
            </div>
            <div class=" firstpenals" style="position:relative;">
               <div class=" columns small-12 rooms-filter">
                  <ul class="nav nav-tabs" role="tablist">
                     <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#tabs-01" role="tab">All</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#tabs-02" role="tab">Rooms</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#tabs-03" role="tab">Suites</a>
                     </li>
                  </ul>
               </div>
            </div>
         </div>
         <div class="tab-content" id="serivices22">
            <div class="tab-pane active" id="tabs-01" role="tabpanel">
               <div  class="blogs" style="position:relative;">
                  <div class="containerfluid">
                     <div class="row blogskd" >
                        <div class="columns columnsLeft colmadkdsjfk2 " style="background-image: url({{ asset('welcome/img/greznsroom1.jpg') }} );"></div>
                        <div class="columns columnsRight colmadkdsjfk2222">
                           <div class="headingsection" style="position:relative;">
                              <h3>ROOMS & SUITES</h3>
                              <span></span>
                              <h4>Rooms with refined</h4>
                              <p class="grezns34d">Rooms with refined style and awash with light, jewels set in the Mediterranean nature.
                                 Rooms with refined style and awash with light, Mediterranean nature.
                              </p>
                           </div>
                        </div>
                        <div class="columns columnsRight boxgreznscolam partone1">
                           <div class="colmadkdsjfk">
                              <div class="mydivs">
                                 <div class="cls1"><img src="{{ asset('welcome/img/greznsroom1.jpg') }} " alt="Grezns"  style="width:100%;"></div>
                                 <div class="cls2"><img src="{{ asset('welcome/img/greznsroom2.jpg') }} " alt="Grezns" style="width:100%;"></div>
                                 <div class="cls3"><img src="{{ asset('welcome/img/greznsrooms1aa.jpg') }} " alt="Grezns" style="width:100%;"></div>
                               
                              </div>
                           </div>
                           <div class="hoteltypesServices">
                              <div class="mydivs2">
                                 <div class="cls1">
                                    <div class="headingsection" style="padding-bottom:0px;">
                                       <h3>Deluxe Premier Room</h3>
                                    </div>
                                    <p>Large rooms with sofa and sitting area to relax, offer wooden floors & nature inspired rugs and furnishing with a Thai touch giving a uniques sense of place in a resort style ambiance with views of the river & city.
                                    </p>
                                    <a href="book-now.html" style="float:left;">BOOK NOW</a>
                                    <a href="hotel-inner.html" style="    float: right;">SEE MORE</a>
                                 </div>
                                 <div class="cls2">
                                    <div class="headingsection" style="padding-bottom:0px;">
                                       <h3>Deluxe One-Bedroom Suite</h3>
                                    </div>
                                    <p>The suites feature a spacious living area with beautiful wooden floors, decorated in Thai silks in warm tones giving a real sense of place. The living area offers a sitting & dining area. The private balcony is perfect to relax.
                              </p>
                                    <a href="book-now.html" style="float:left;">BOOK NOW</a>
                                    <a href="hotel-inner.html" style="    float: right;">SEE MORE</a>
                                 </div>
                                 <div class="cls3">
                                    <div class="headingsection" style="padding-bottom:0px;">
                                       <h3>Deluxe 2-Bedroom Suite</h3>
                                    </div>
                                     <p>An ideal suite for families this two bedroom suite overlooking the pool and the river, features a private balcony with a sitting area. 
                                 The living area offers separate sitting and dining areas perfect to relax and unwind.
                              </p>
                                    <a href="book-now.html" style="float:left;">BOOK NOW</a>
                                    <a href="hotel-inner.html" style="    float: right;">SEE MORE</a>
                                 </div>
                                
                              </div>
                           </div>
                        </div>
                        <div class="buttons12">
                       <div class="prev1"><i class="fas fa-angle-up"></i></div>
                           <div class="next1"><i class="fas fa-chevron-down"></i></div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="tab-pane " id="tabs-02" role="tabpanel">
               <div  class="blogs" style="position:relative;">
                  <div class="containerfluid">
                     <div class="row blogskd" >
                        <div class="columns columnsLeft colmadkdsjfk2 " style="   background-image: url({{ asset('welcome/img/greznsroom4.jpg') }} );"></div>
                        <div class="columns columnsRight colmadkdsjfk2222" >
                           <div class="headingsection" style="position:relative;">
                              <h3>ROOMS & SUITES</h3>
                              <span></span>
                              <h4>Rooms with refined</h4>
                              <p class="grezns34d">Rooms with refined style and awash with light, jewels set in the Mediterranean nature.
                                 Rooms with refined style and awash with light, Mediterranean nature.
                              </p>
                             
                           </div>
                        </div>
                          <div class="columns columnsRight boxgreznscolam partone1">
                           <div class="colmadkdsjfk">
                              <div class="mydivs3">
                                <div class="cls1"><img src="{{ asset('welcome/img/greznsroom4.jpg') }} " alt="Grezns"  style="width:100%;"></div>
                                 <div class="cls2"><img src="{{ asset('welcome/img/greznsroom5.jpg') }} " alt="Grezns" style="width:100%;"></div>
                                 <div class="cls3"><img src="{{ asset('welcome/img/greznsroom6.jpg') }} " alt="Grezns" style="width:100%;"></div>
                              </div>
                           </div>
                           <div class="hoteltypesServices">
                              <div class="mydivs4">
                                 <div class="cls1">
                                    <div class="headingsection" style="padding-bottom:0px;">
                                       <h3>Mandarin Room</h3>
                                    </div>
                                     <p>These rooms feature floor-to-ceiling windows that open out to a balcony with views across the city and river. The bedroom incorporates a spacious seating area with a large comfortable sofa and a dining table.
                              </p>
                                    <a href="book-now.html" style="float:left;">BOOK NOW</a>
                                    <a href="hotel-inner.html" style="    float: right;">SEE MORE</a>
                                 </div>
                                 <div class="cls2">
                                      <div class="headingsection" style="padding-bottom:0px;">
                                 <h3>Chao Phraya Room</h3>
                              </div>
                              <p>This luxurious room has an entrance area leading to both a spacious and comfortable bedroom and a separate living area with a comfortable sofa bed.
                              </p>
                                    <a href="book-now.html" style="float:left;">BOOK NOW</a>
                                    <a href="hotel-inner.html" style="    float: right;">SEE MORE</a>
                                 </div>
                                 <div class="cls3">
                                    <div class="headingsection" style="padding-bottom:0px;">
                                 <h3>Deluxe Balcony Room</h3>
                              </div>
                              <p>Elegant rooms with wooden floors, nature inspired rugs and furnishings with a private balcony and seating area. The rooms offer a Thai touch, giving a unique sense of place in a resort-style ambience with pool and river views.
                              </p>
                                    <a href="book-now.html" style="float:left;">BOOK NOW</a>
                                    <a href="hotel-inner.html" style="    float: right;">SEE MORE</a>
                                 </div>
                                
                              </div>
                           </div>
                        </div>
                        <div class="buttons12">
                       <div class="prev1"><i class="fas fa-angle-up"></i></div>
                           <div class="next1"><i class="fas fa-chevron-down"></i></div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="tab-pane " id="tabs-03" role="tabpanel">
               <div  class="blogs" style="position:relative;">
                  <div class="containerfluid">
                     <div class="row blogskd" >
                        <div class="columns columnsLeft colmadkdsjfk2 " style="background-image: url({{ asset('welcome/img/greznsroom7.jpg') }} );"></div>
                        <div class="columns columnsRight colmadkdsjfk2222">
                           <div class="headingsection" style="position:relative;">
                              <h3>ROOMS & SUITES</h3>
                              <span></span>
                              <h4>Rooms with refined</h4>
                              <p class="grezns34d">Rooms with refined style and awash with light, jewels set in the Mediterranean nature.
                                 Rooms with refined style and awash with light, Mediterranean nature.
                              </p>
                             
                           </div>
                        </div>
                          <div class="columns columnsRight boxgreznscolam partone1">
                           <div class="colmadkdsjfk">
                              <div class="mydivs5">
                           <div class="cls1"><img src="{{ asset('welcome/img/greznsroom7.jpg') }} " alt="Grezns"  style="width:100%;"></div>
                                 <div class="cls2"><img src="{{ asset('welcome/img/greznsroom8.jpg') }} " alt="Grezns" style="width:100%;"></div>
                                 <div class="cls3"><img src="{{ asset('welcome/img/greznsrooms9.jpg') }} " alt="Grezns" style="width:100%;"></div>
                              </div>
                           </div>
                           <div class="hoteltypesServices">
                             <div class="mydivs6">
                                 <div class="cls1">
                                   <div class="headingsection" style="padding-bottom:0px;">
                                 <h3>Junior Terrace Suite</h3>
                              </div>
                              <p>This large junior suite is ideal for long-staying guests looking for a large open plan space with a combined sitting and dining area. It features a wonderful terrace of 17sqm/188sqf and a working desk.
                              </p>
                                    <a href="book-now.html" style="float:left;">BOOK NOW</a>
                                    <a href="hotel-inner.html" style="    float: right;">SEE MORE</a>
                                 </div>
                                 <div class="cls2">
                                    <div class="headingsection" style="padding-bottom:0px;">
                                 <h3>Authors' Suite</h3>
                              </div>
                              <p>Located in the River Wing, these suites are tributes to some of the great literary figures that have stayed with us. All feature floor-to-ceiling windows, a balcony, spacious sitting room, a large bathroom and powder room.
                              </p>
                                    <a href="book-now.html" style="float:left;">BOOK NOW</a>
                                    <a href="hotel-inner.html" style="    float: right;">SEE MORE</a>
                                 </div>
                                 <div class="cls3">
                                   <div class="headingsection" style="padding-bottom:0px;">
                                 <h3>Premier 1-Bedroom Suite</h3>
                              </div>
                              <p>This luxurious suite has an entrance area leading to a spacious sitting area & desk with a separate dining area for 5 people. It has a private balcony with seating area. The specious bedroom has a dressing table and sitting area.
                              </p>
                                    <a href="book-now.html" style="float:left;">BOOK NOW</a>
                                    <a href="hotel-inner.html" style="    float: right;">SEE MORE</a>
                                 </div>
                                
                              </div>
                           </div>
                        </div>
                        <div class="buttons12">
                       <div class="prev1"><i class="fas fa-angle-up"></i></div>
                           <div class="next1"><i class="fas fa-chevron-down"></i></div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
	  </div>
      <section class="twoColumnsec">
         <div class="container">
            <div class="row">
               <div class="col-sm-12">
                  <div class="headingsection headingsection5">
                     <h3>To enjoy at The Grezns</h3>
                     <span></span>
                     <h4>Perfectly Located </h4>
                  </div>
               </div>
            </div>
         </div>
         <div class="hotelsroom">
            <img src="{{ asset('welcome/img/greznsbanners1.jpg') }} " alt="Grezns">
         </div>
      </section>
      <section class="block_list flexed end less_margin">
         <div class="section_viewport large container">
            <div class="block_container">
               <a href="rooms-overview.html" class="url_manager block reverse">
                  <div class="block_pic">
                     <div class="covered vertical">
                        <div class="cover white has_transition_1500_inout"></div>
                        <div class="content">
                           <img class="full_width" src="{{ asset('welcome/img/greznsrooms1as.jpg') }} " alt="Grezns">
                           <div class="block_veil has_transition_1500"></div>
                        </div>
                     </div>
                  </div>
                  <div class="block_copy has_transition_1500">
                     <div class="copy_back  has_transition_1500"></div>
                     <div  class="block_text transform_all has_transition_1000">
                        <h6>ROOMS</h6>
                     </div>
                  </div>
               </a>
               <a href="breakfast.html" class="url_manager block reverse">
                  <div class="block_pic">
                     <div class="covered vertical">
                        <div class="cover white has_transition_1500_inout"></div>
                        <div class="content">
                           <img class="full_width" src="{{ asset('welcome/img/greznsbrakfast.jpg') }} " alt="Grezns">
                           <div class="block_veil has_transition_1500"></div>
                        </div>
                     </div>
                  </div>
                  <div class="block_copy has_transition_1500">
                     <div class="copy_back  has_transition_1500"></div>
                     <div  class="block_text transform_all has_transition_1000">
                        <h6>BREAKFAST</h6>
                     </div>
                  </div>
               </a>
               <a href="seascape-restaurant.html" class="url_manager block reverse lastreverse">
                  <div class="block_pic">
                     <div class="covered vertical">
                        <div class="cover white has_transition_1500_inout"></div>
                        <div class="content">
                           <img class="full_width" src="{{ asset('welcome/img/greznsrestront.jpg') }} " alt="Grezns">
                           <div class="block_veil has_transition_1500"></div>
                        </div>
                     </div>
                  </div>
                  <div class="block_copy has_transition_1500">
                     <div class="copy_back  has_transition_1500"></div>
                     <div  class="block_text transform_all has_transition_1000">
                        <h6>RESTAURANT</h6>
                     </div>
                  </div>
               </a>
               <a href="body-soul.html" class="url_manager block">
                  <div class="block_pic">
                     <div class="covered vertical">
                        <div class="cover white has_transition_1500_inout"></div>
                        <div class="content">
                           <img class="full_width" src="{{ asset('welcome/img/greznsspas2.jpg') }} " alt="Grezns">
                           <div class="block_veil has_transition_1500"></div>
                        </div>
                     </div>
                  </div>
                  <div class="block_copy has_transition_1500">
                     <div class="copy_back  has_transition_1500"></div>
                     <div class="block_text transform_all has_transition_1000">
                        <h6>SPA</h6>
                     </div>
                  </div>
               </a>
               <a href="wedding.html" class="url_manager block">
                  <div class="block_pic">
                     <div class="covered vertical">
                        <div class="cover white has_transition_1500_inout"></div>
                        <div class="content">
                           <img class="full_width" src="{{ asset('welcome/img/weddingsa.jpg') }} " alt="Grezns">
                           <div class="block_veil has_transition_1500"></div>
                        </div>
                     </div>
                  </div>
                  <div class="block_copy has_transition_1500">
                     <div class="copy_back  has_transition_1500"></div>
                     <div class="block_text transform_all has_transition_1000">
                        <h6>WEDDINGS</h6>
                     </div>
                  </div>
               </a>
               <a href="specials.html" class="url_manager block">
                  <div class="block_pic">
                     <div class="covered vertical">
                        <div class="cover white has_transition_1500_inout"></div>
                        <div class="content">
                           <img class="full_width" src="{{ asset('welcome/img/greznsexperince.jpg') }} " alt="Grezns">
                           <div class="block_veil has_transition_1500"></div>
                        </div>
                     </div>
                  </div>
                  <div class="block_copy has_transition_1500">
                     <div class="copy_back  has_transition_1500"></div>
                     <div class="block_text transform_all has_transition_1000">
                        <h6>EXPERIENCES</h6>
                     </div>
                  </div>
               </a>
            </div>
         </div>
      </section>
      <section class="servicespro">
         <div class="container">
            <div class="headingcenter">
               <span class="smalltexts"><strong>SINCE</strong> 1994</span>
               <h2>Situated In Prime Position At The Foot Of The Slopes Of Courchevel Moriond.</h2>
            </div>
            <div class="tabroww">
               <div class="tabrowwClm tabrowwClm1">
                  <div class="iconshapess">
                     <img src="{{ asset('welcome/img/travelicon.png') }} " alt="Grezns">
                  </div>
                  <div class="iconshapessTitle">BREAKFAST</div>
                  <div class="iconshapessTitlebg"><img src="{{ asset('welcome/img/travelicon.png') }} " alt="Grezns"></div>
               </div>
               <div class="tabrowwClm tabrowwClm2">
                  <div class="iconshapess">
                     <img src="{{ asset('welcome/img/travelicon.png') }} " alt="Grezns">
                  </div>
                  <div class="iconshapessTitle">AIRPORT PICKUP</div>
                  <div class="iconshapessTitlebg"><img src="{{ asset('welcome/img/travelicon.png') }} " alt="Grezns"></div>
               </div>
               <div class="tabrowwClm tabrowwClm3">
                  <div class="iconshapess">
                     <img src="{{ asset('welcome/img/travelicon.png') }} " alt="Grezns">
                  </div>
                  <div class="iconshapessTitle">CITY GURARD</div>
                  <div class="iconshapessTitlebg"><img src="{{ asset('welcome/img/travelicon.png') }} " alt="Grezns"></div>
               </div>
               <div class="tabrowwClm tabrowwClm4">
                  <div class="iconshapess">
                     <img src="{{ asset('welcome/img/travelicon.png') }} " alt="Grezns">
                  </div>
                  <div class="iconshapessTitle">BBQ PARTY</div>
                  <div class="iconshapessTitlebg"><img src="{{ asset('welcome/img/travelicon.png') }} " alt="Grezns"></div>
               </div>
               <div class="tabrowwClm tabrowwClm5">
                  <div class="iconshapess">
                     <img src="{{ asset('welcome/img/travelicon.png') }} " alt="Grezns">
                  </div>
                  <div class="iconshapessTitle">BBQ PARTY2</div>
                  <div class="iconshapessTitlebg"><img src="{{ asset('welcome/img/travelicon.png') }} " alt="Grezns"></div>
               </div>
            </div>
         </div>
      </section>
      <section class="twoColumnsec" id="greznsbood">
         <div class="container">
            <div class="row" style="position:relative;">
               <div class="bordersk"></div>
               <div class="col-lg-4 col-md-4 col-sm-4 col-12">
                  <div class="headingsection globas">
                     <h3>Featured offers</h3>
                     <span></span>
                     <h4>Fantastic Global Offers</h4>
                     <p>We understand the need for flexibility when it comes to planning future travel. 
                        You can book with confidence, 
                        knowing that our flexible cancellation policies will accommodate your needs.
                     </p>
                     <a class="view1" href="#1" style="color:#333;">SEE ALL OFFER</a>
                     <div class="container mobilkdfoe000"   style="    position: relative;width: 100px !important; margin-top: -9px;float: right; margin-right: 12px;">
                        <a class="carousel-control-prev" href="#carouselExampleControls1" role="button" data-slide="prev"><img src="{{ asset('welcome/img/left-arrow.png') }} " alt="Grezns" style="    width: 35px;"></a>
                        <a class="carousel-control-next" href="#carouselExampleControls1" role="button" data-slide="next"><img src="{{ asset('welcome/img/right-arrow.png') }} " alt="Grezns" style="    width: 35px;"></a>
                     </div>
                     <div class="container mobilkdfoe"  style="    position: relative;width: 100px !important;margin-top: -9px; float: right;margin-right: 12px;">
                        <a class="carousel-control-prev" href="#carouselExampleControls20" role="button" data-slide="prev"><img src="{{ asset('welcome/img/left-arrow.png') }} " alt="Grezns" style="    width: 35px;"></a>
                        <a class="carousel-control-next" href="#carouselExampleControls20" role="button" data-slide="next"><img src="{{ asset('welcome/img/right-arrow.png') }} " alt="Grezns" style="    width: 35px;"></a>
                     </div>
                  </div>
               </div>
               <div class="col-lg-8 col-md-8 col-sm-8 col-12" >
                  <div id="carouselExampleControls1" class="carousel slide mobilkdfoe000" data-ride="carousel"  data-interval="false" >
                     <div class="carousel-inner">
                        <div class="carousel-item active">
                           <div class="row ">
                              <div class="col-sm-6 col-12 orderplacesd">
                                 <div class="hotelsroom">
                                    <img src="{{ asset('welcome/img/greznsoffer1.jpg') }} " alt="Grezns">
                                 </div>
                                 <div class="headingsection">
                                    <h3>Travel Again</h3>
                                    <span></span>
                                    <p>Enjoy Saving of up to 20% on room rate</p>
                                    <a class="view1" href="#1">View More</a>
                                    <button>Book Now</button>
                                 </div>
                              </div>
                              <div class="col-sm-6 col-12 orderplacesd">
                                 <div class="hotelsroom">
                                    <img src="{{ asset('welcome/img/greznsoffer2.jpg') }} " alt="Grezns">
                                 </div>
                                 <div class="headingsection">
                                    <h3>Travel Again</h3>
                                    <span></span>
                                    <p>Enjoy Saving of up to 20% on room rate</p>
                                    <a class="view1" href="#1">View More</a>
                                    <button>Book Now</button>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="carousel-item">
                           <div class="row">
                              <div class="col-sm-6 col-12 orderplacesd">
                                 <div class="hotelsroom">
                                    <img src="{{ asset('welcome/img/greznsoffer3.jpg') }} " alt="Grezns">
                                 </div>
                                 <div class="headingsection">
                                    <h3>Travel Again</h3>
                                    <span></span>
                                    <p>Enjoy Saving of up to 20% on room rate</p>
                                    <a class="view1" href="#1">View More</a>
                                    <button>Book Now</button>
                                 </div>
                              </div>
                              <div class="col-sm-6 col-12 orderplacesd">
                                 <div class="hotelsroom">
                                    <img src="{{ asset('welcome/img/greznsoffer4.jpg') }} " alt="Grezns">
                                 </div>
                                 <div class="headingsection">
                                    <h3>Travel Again</h3>
                                    <span></span>
                                    <p>Enjoy Saving of up to 20% on room rate</p>
                                    <a class="view1" href="#1">View More</a>
                                    <button>Book Now</button>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="carousel-item">
                           <div class="row">
                              <div class="col-sm-6 col-12 orderplacesd">
                                 <div class="hotelsroom">
                                    <img src="{{ asset('welcome/img/greznsoffer5.jpg') }} " alt="Grezns">
                                 </div>
                                 <div class="headingsection">
                                    <h3>Travel Again</h3>
                                    <span></span>
                                    <p>Enjoy Saving of up to 20% on room rate</p>
                                    <a class="view1" href="#1">View More</a>
                                    <button>Book Now</button>
                                 </div>
                              </div>
                              <div class="col-sm-6 col-12 orderplacesd">
                                 <div class="hotelsroom">
                                    <img src="{{ asset('welcome/img/greznsoffer6.jpg') }} " alt="Grezns">
                                 </div>
                                 <div class="headingsection">
                                    <h3>Travel Again</h3>
                                    <span></span>
                                    <p>Enjoy Saving of up to 20% on room rate</p>
                                    <a class="view1" href="#1">View More</a>
                                    <button>Book Now</button>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div id="carouselExampleControls20" class="carousel slide mobilkdfoe" data-ride="carousel"  data-interval="false" >
                     <div class="carousel-inner">
                        <div class="carousel-item active">
                           <div class="row ">
                              <div class="col-sm-12 col-12 orderplacesd">
                                 <div class="hotelsroom">
                                    <img src="{{ asset('welcome/img/greznsoffer1.jpg') }} " alt="Grezns">
                                 </div>
                                 <div class="headingsection">
                                    <h3>Travel Again</h3>
                                    <span></span>
                                    <p>Enjoy Saving of up to 20% on room rate</p>
                                    <a class="view1" href="#1">View More</a>
                                    <button>Book Now</button>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="carousel-item">
                           <div class="row">
                              <div class="col-sm-12 col-12 orderplacesd">
                                 <div class="hotelsroom">
                                    <img src="{{ asset('welcome/img/greznsoffer2.jpg') }} " alt="Grezns">
                                 </div>
                                 <div class="headingsection">
                                    <h3>Travel Again</h3>
                                    <span></span>
                                    <p>Enjoy Saving of up to 20% on room rate</p>
                                    <a class="view1" href="#1">View More</a>
                                    <button>Book Now</button>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="carousel-item">
                           <div class="row">
                              <div class="col-sm-12 col-12 orderplacesd">
                                 <div class="hotelsroom">
                                    <img src="{{ asset('welcome/img/greznsoffer3.jpg') }} " alt="Grezns">
                                 </div>
                                 <div class="headingsection">
                                    <h3>Travel Again</h3>
                                    <span></span>
                                    <p>Enjoy Saving of up to 20% on room rate</p>
                                    <a class="view1" href="#1">View More</a>
                                    <button>Book Now</button>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="carousel-item">
                           <div class="row">
                              <div class="col-sm-12 col-12 orderplacesd">
                                 <div class="hotelsroom">
                                    <img src="{{ asset('welcome/img/greznsoffer4.jpg') }} " alt="Grezns">
                                 </div>
                                 <div class="headingsection">
                                    <h3>Travel Again</h3>
                                    <span></span>
                                    <p>Enjoy Saving of up to 20% on room rate</p>
                                    <a class="view1" href="#1">View More</a>
                                    <button>Book Now</button>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="carousel-item">
                           <div class="row">
                              <div class="col-sm-12 col-12 orderplacesd">
                                 <div class="hotelsroom">
                                    <img src="{{ asset('welcome/img/greznsoffer5.jpg') }} " alt="Grezns">
                                 </div>
                                 <div class="headingsection">
                                    <h3>Travel Again</h3>
                                    <span></span>
                                    <p>Enjoy Saving of up to 20% on room rate</p>
                                    <a class="view1" href="#1">View More</a>
                                    <button>Book Now</button>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="carousel-item">
                           <div class="row">
                              <div class="col-sm-12 col-12 orderplacesd">
                                 <div class="hotelsroom">
                                    <img src="{{ asset('welcome/img/greznsoffer6.jpg') }} " alt="Grezns">
                                 </div>
                                 <div class="headingsection">
                                    <h3>Travel Again</h3>
                                    <span></span>
                                    <p>Enjoy Saving of up to 20% on room rate</p>
                                    <a class="view1" href="#1">View More</a>
                                    <button>Book Now</button>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <section class="twoColumnsec" style="    background: #e5e3d7;">
         <div class="container">
            <div class="row">
               <div class="col-sm-12 col-12">
                  <div class="headingsection">
                     <h3>Happenings & Events</h3>
                     <span></span>
                     <h4>stylish celebrations</h4>
                  </div>
               </div>
            </div>
         </div>
         <div class="hotelsroom">
            <img src="{{ asset('welcome/img/greznseventsbanner.jpg') }} " alt="Grezns">
         </div>
      </section>
      <section class="explore">
         <div class="container">
            <div class="row">
               <div class="col-sm-12 col-12">
                  <div class="headingcenter">
                     <div class="threeways">
                        <div>
                           <h3 style="float:left;display:inline-block;">THREE WAYS TO</h3>
                           <hr style="float:left;display:inline-block;">
                           <span style="float:left;display:inline-block;">Experience</span>
                        </div>
                     </div>
                     <!--    <div class="headingsection" style="text-align:center">
                        <h3 style="text-align:center">Three Ways to Experience</h3>
                        <span style="margin:auto"></span>
                        <h4>Perfectly Located </h4>
                        </div> -->
                  </div>
               </div>
            </div>
            <div id="carouselExampleControls" class="carousel slide carousel-fade mobilkdfoe000" data-ride="carousel"  data-interval="false" >
               <div class="carousel-inner">
                  <div class="carousel-item active">
                     <div class="row">
                        <div class="col-sm-4 col-12">
                           <div class="col-det-inner1">
                              <img src="{{ asset('welcome/img/greznsexp6.jpg') }} " alt="Grezns">
                              <div class="border22">
                                 <p class="border23"></p>
                              </div>
                              <h3>How to Get the Perfect Photos for Your Website1</h3>
                           </div>
                        </div>
                        <div class="col-sm-4 col-12">
                           <div class="col-det-inner1">
                              <img src="{{ asset('welcome/img/greznsexp10.jpg') }} " alt="Grezns">
                              <div class="border22">
                                 <p class="border23"></p>
                              </div>
                              <h3>How to Get the Perfect Photos for Your Website1</h3>
                           </div>
                        </div>
                        <div class="col-sm-4 col-12">
                           <div class="col-det-inner1">
                              <img src="{{ asset('welcome/img/greznsexp8.jpg') }} " alt="Grezns">
                              <div class="border22">
                                 <p class="border23"></p>
                              </div>
                              <h3>How to Get the Perfect Photos for Your Website1</h3>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="carousel-item">
                     <div class="row">
                        <div class="col-sm-4 col-12">
                           <div class="col-det-inner1">
                              <img src="{{ asset('welcome/img/greznsexp9.jpg') }} " alt="Grezns">
                              <div class="border22">
                                 <p class="border23"></p>
                              </div>
                              <h3>How to Get the Perfect Photos for Your Website2</h3>
                           </div>
                        </div>
                        <div class="col-sm-4 col-12">
                           <div class="col-det-inner1">
                              <img src="{{ asset('welcome/img/greznsexp5.jpg') }} " alt="Grezns">
                              <div class="border22">
                                 <p class="border23"></p>
                              </div>
                              <h3>How to Get the Perfect Photos for Your Website2</h3>
                           </div>
                        </div>
                        <div class="col-sm-4 col-12">
                           <div class="col-det-inner1">
                              <img src="{{ asset('welcome/img/greznsexp4.jpg') }} " alt="Grezns">
                              <div class="border22">
                                 <p class="border23"></p>
                              </div>
                              <h3>How to Get the Perfect Photos for Your Website2</h3>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="carousel-item">
                     <div class="row">
                        <div class="col-sm-4 col-12">
                           <div class="col-det-inner1">
                              <img src="{{ asset('welcome/img/greznsexp3.jpg') }} " alt="Grezns">
                              <div class="border22">
                                 <p class="border23"></p>
                              </div>
                              <h3>How to Get the Perfect Photos for Your Website3</h3>
                           </div>
                        </div>
                        <div class="col-sm-4 col-12">
                           <div class="col-det-inner1">
                              <img src="{{ asset('welcome/img/greznsexp2.jpg') }} " alt="Grezns">
                              <div class="border22">
                                 <p class="border23"></p>
                              </div>
                              <h3>How to Get the Perfect Photos for Your Website3</h3>
                           </div>
                        </div>
                        <div class="col-sm-4 col-12">
                           <div class="col-det-inner1">
                              <img src="{{ asset('welcome/img/greznsexp1.jpg') }} " alt="Grezns">
                              <div class="border22">
                                 <p class="border23"></p>
                              </div>
                              <h3>How to Get the Perfect Photos for Your Website3</h3>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="container"  style="position:relative;width:100px !important;    margin-top: 35px;">
                  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                  <img src="{{ asset('welcome/img/left-arrow.png') }} " alt="Grezns"  style="    width: 35px;">
                  </a>
                  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                  <img src="{{ asset('welcome/img/right-arrow.png') }} " alt="Grezns"  style="    width: 35px;">
                  </a>
               </div>
            </div>
            <div id="carouselExampleControls34" class="carousel slide carousel-fade mobilkdfoe" data-ride="carousel"  data-interval="false" >
               <div class="carousel-inner">
                  <div class="carousel-item active">
                     <div class="row">
                        <div class="col-sm-12 col-12">
                           <div class="col-det-inner1">
                              <img src="{{ asset('welcome/img/greznsexp1.jpg') }} " alt="Grezns">
                              <div class="border22">
                                 <p class="border23"></p>
                              </div>
                              <h3>How to Get the Perfect Photos for Your Website1</h3>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="carousel-item">
                     <div class="row">
                        <div class="col-sm-12 col-12">
                           <div class="col-det-inner1">
                              <img src="{{ asset('welcome/img/greznsexp2.jpg') }} " alt="Grezns">
                              <div class="border22">
                                 <p class="border23"></p>
                              </div>
                              <h3>How to Get the Perfect Photos for Your Website2</h3>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="carousel-item">
                     <div class="row">
                        <div class="col-sm-12 col-12">
                           <div class="col-det-inner1">
                              <img src="{{ asset('welcome/img/greznsexp3.jpg') }} " alt="Grezns">
                              <div class="border22">
                                 <p class="border23"></p>
                              </div>
                              <h3>How to Get the Perfect Photos for Your Website3</h3>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="container mobilkdfoe"  style="position:relative;width:100px !important;    margin-top: 35px;">
                  <a class="carousel-control-prev" href="#carouselExampleControls34" role="button" data-slide="prev">
                  <img src="{{ asset('welcome/img/left-arrow.png') }} " alt="Grezns"  style="    width: 35px;">
                  </a>
                  <a class="carousel-control-next" href="#carouselExampleControls34" role="button" data-slide="next">
                  <img src="{{ asset('welcome/img/right-arrow.png') }} " alt="Grezns" style="    width: 35px;">
                  </a>
               </div>
            </div>
         </div>
      </section>
      <section class="footer-bg-hotel1" style="    background: #e5e3d7;  padding-bottom: 50px;">
         <div class="container">
            <div class="headingsection" style="text-align:center">
               <h3 style="text-align: center;font-size: 17px; letter-spacing:0.2em;margin-bottom: 0px;">View The Blogs</h3>
               <span style="margin:auto;    width: 260px;"></span>
               <!--  <h4>Perfectly Located </h4> -->
            </div>
         </div>
      </section>
      <section id="backgroundblogsd" class="blogs" style="position:relative;">
         <div class="containerfluid">
            <div class="row blogskd">
               <div class="columns columnsLeft">
                  <div class="sie-cta_7 se " style="transform: scale(1, 1) translate(-74.5px, 0px) rotate(270deg);">
                     <h2 class="blogsdwer">Blogs</h2>
                  </div>
               </div>
               <div class="columns columnsRight">
               </div>
            </div>
            <div class="blogskd">
               <div id="carouselExampleControls3" class="carousel slide" data-ride="carousel"  data-interval="false" >
                  <div class="carousel-inner">
                     <div class="carousel-item active">
                        <div class="slidersd">
                           <div class=" container">
                              <div class="row">
                                 <div class="col-md-6">
                                    <img src="{{ asset('welcome/img/greznsblog1.jpg') }} " alt="Grezns">
                                 </div>
                                 <div class="col-md-6">
                                    <div class="blogparas">
                                       <h4>BLOG1</h4>
                                       <span></span>
                                       <p>Reach out to me about your project. I'd be honored to come alongside you in the branding process!</p>
                                       <a href="#">View Detail</a>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="carousel-item">
                        <div class="slidersd">
                           <div class=" container">
                              <div class="row">
                                 <div class="col-md-6">
                                    <img src="{{ asset('welcome/img/greznsblog3.jpg') }} " alt="Grezns">
                                 </div>
                                 <div class="col-md-6">
                                    <div class="blogparas">
                                       <h4>BLOG2</h4>
                                       <span></span>
                                       <p>Reach out to me about your project. I'd be honored to come alongside you in the branding process!</p>
                                       <a href="#">View Detail</a>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="carousel-item">
                        <div class="slidersd">
                           <div class=" container">
                              <div class="row">
                                 <div class="col-md-6">
                                    <img src="{{ asset('welcome/img/greznsblog2.jpg') }} " alt="Grezns">
                                 </div>
                                 <div class="col-md-6">
                                    <div class="blogparas">
                                       <h4>BLOG3</h4>
                                       <span></span>
                                       <p>Reach out to me about your project. I'd be honored to come alongside you in the branding process!</p>
                                       <a href="#">View Detail</a>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="container"  style="position:relative;    width: 90% !important;">
                     <a class="carousel-control-prev" href="#carouselExampleControls3" role="button" data-slide="prev">
                     <img src="{{ asset('welcome/img/left-arrow.png') }} " alt="Grezns" style="    width: 35px;">
                     </a>
                     <a class="carousel-control-next" href="#carouselExampleControls3" role="button" data-slide="next">
                     <img src="{{ asset('welcome/img/right-arrow.png') }} " alt="Grezns" style="    width: 35px;">
                     </a>
                     <a href="blog.html" class="blogsd234" style="    float: right;color: #333;margin-right: 0;bottom: -40px;position: absolute;z-index: 0;right: 0px;font-size: 12px;letter-spacing: 0.3em;border-bottom: 1px solid #a69e9e;padding-bottom: 10px;">VIEW ENTER BLOG</a>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <section class="footer-bg-hotel" id="footeralongs">
         <div class="container">
            <div class="site-footer__cta">
               <h4>Follow Along!</h4>
               <p>Sign up to receive tips and resources to help your business grow and flourish!</p>
               <div class="site-footer__cta-button btn">
                  <form>
                     <div class="site-btn"><input type="text" placeholder="First Name"  ></div>
                     <div  class="site-btn"><input type="text" placeholder="Last Name"  ></div>
                     <div class="site-btn"><input type="text" placeholder="Email Address"  ></div>
                     <div  class="site-btn"><button type="submit">Subscribe</button></div>
                  </form>
               </div>
            </div>
         </div>
      </section>      
      
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
@endsection
@section('javascript')
   <script>
      $(document).ready(function() {
          var divs = $('.mydivs>div');
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
          var divs = $('.mydivs2>div');
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
          var divs = $('.mydivs3>div');
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
          var divs = $('.mydivs4>div');
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
          var divs = $('.mydivs5>div');
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
          var divs = $('.mydivs6>div');
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
      </script>
@endsection

