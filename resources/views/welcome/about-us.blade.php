@extends('layouts.welcome')

@section('title')
   <title>About Us | Grezns Hotels</title>
@endsection
@section('css')
<link rel="stylesheet" href="{{ asset('welcome/css/responsive.css') }}"> 
<link rel="stylesheet" href="{{ asset('welcome/css/grezns_responsive.css') }}"> 
    <style>
         @font-face{font-family:dallas light;src:url('https//static.showit.co/file/KRkaq8XxQ5i7h2tlnNEi5A/77884/dallas-light-webfont.woff');}
         @font-face{font-family:dallas light;src:url('dallas-light-webfont.woff');}
         #about90 { background-color: #aa8a7a !important;padding-top: 35px;}
         #aboutsuse .about1991 .mid-content .headingsection h3{     line-height: 1;    margin-bottom: 0px;   font-size: 20px;color: #e5e3d7 !important;}
         #aboutsuse .about1991 .mid-content h3{     line-height: 1;    margin-bottom:20px;   font-size: 20px;color: #e5e3d7 !important;}
         #aboutsuse .about1991 .mid-content p{color: #e5e3d7 !important;    padding-top: 0px;}
         #aboutsuse .about1991 .mid-content .headingsection {padding: 0px 0 16px;}
         #aboutsuse .carrer3456 #slide1:after {background-image: url({{ asset('welcome/img/about1.jpg ') }});}
         #aboutsuse .carrer3456 #slide1:before {background-image: url({{ asset('welcome/img/about7.jpg ') }});}
         #aboutsuse .carrer3456 #slide2:after {background-image: url({{ asset('welcome/img/about3.jpg ') }});}
         #aboutsuse .carrer3456 #slide2:before {background-image: url({{ asset('welcome/img/about4.jpg ') }});}
         #aboutsuse .carrer3456 #slide3:after {background-image: url({{ asset('welcome/img/about5.jpg ') }});}
         #aboutsuse .carrer3456 #slide3:before {background-image: url({{ asset('welcome/img/about6.jpg ') }});}
         @media (max-width: 3000px) and (min-width: 992px) {
            .toppHeader .headertop .btn-toggle2 {
               right: 0px !important;
            }
         }
      </style>
@endsection
@section('meta')
   
@endsection

@section('content')
@include('welcome.common.menu')
@include('welcome.common.desktop-menu')
<!-- menu -->
      <div class="about1990">
         <section id="bookinginersd" class="contact-banner abt-banner book-nows" style="background-image:url({{ asset('welcome/img/backgroujdkifsd.jpg ') }});   background-size: cover;
            background-position: center;
            background-repeat: no-repeat;">
            @include('welcome.common.auth')
            <div class="container">
               <div class="row">
                  <div class="col-md-12 col-sm-12 col-12">
                     <div class="hotel_heads">
                        <h1 style="font-family: 'Roboto' !important;text-transform: capitalize;">The Grezns </h1>
                        <p style="font-family: 'Roboto' !important;"> Discover luxurious hotels that have a soul. </p>
                        <div class="hotel">
                           <a id="Hotel" href="#hot_ty">EXPLORE</a>										
                        </div>
                        <div class="soc-sha">
                           <ul class="share-none">
                              <li id="share-open">
                                 <a href="javascript:void(0);">
                                 <i class="fa fa-share-alt" aria-hidden="true"></i>
                                 </a>
                              </li>
                              <li id="share-open1"  class="social-share">
                                 <a href="javascript:void(0);" style="color:#fff;">
                                 <i class="fa fa-share-alt" aria-hidden="true"></i>
                                 </a>
                              </li>
                              <li class="social-share"><a href="https://m.facebook.com/thegreznshotel/" class="face" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                              <li class="social-share"><a href="https://twitter.com/grezns" class="twit" target="_blank"><i class="fab fa-twitter"></i></a></li>
                              <li class="social-share"><a href="https://www.instagram.com/thegrezns/" class="instagram" target="_blank"><i class="fab fa-instagram"></i></a></li>
                           </ul>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section>
      </div>
      <div class="about1991">
         <section id="about90" class="contact-list">
            <div class="container min-container">
               <div class="anbolidfoskdfkds" style="   transform:scale(1, 1) translate(615.5px, 831px) rotate(-270deg);">
                  <h2 style="    color: #e5e3d7;font-size: 20px;">About me</h2>
               </div>
               <div class="row">
                  <div class="col-md-12 col-sm-12 col-12">
                     <div class="contact-full">
                        <div class="con_form" id="about56">
                           <img src="{{ asset('welcome/img/abouts.jpg ') }}" alt="Grezns" style="width:100%;    height: 500px;">
                        </div>
                        <div class="con-img">
                           <div class="mid-content">
                              <div class="about76">
                                 <div class="headingsection">
                                    <h3>About us </h3>
                                    <span></span>
                                    <h4 style="    line-height: 20px;">The Grezns </h4>
                                 </div>
								 <p><b style="    font-weight: 900 !important;"> Rejuvenate your soul at our luxurious hotels revealing premium locations. Stay, dine and celebrate with us at more than 10 luxurious hotels across the globe. </b><br></p>
                                 <p>
								
The Grezns is a chain of luxurious hotels in India and abroad. We are one of India's fastest growing premium hospitality brands, managing a portfolio of over 10 luxurious properties across the globe. Established in 2011 by prominent hospitality specialist Mr. Ravi Shankar , The Grezns, A chain of luxurious hotels is a renowned and trusted brand with a growth plan to reach more than 100 hotels by 2025.
                 </p>
			
                                 <div id="button9" style="    background: #bba58a;">
                                    <img src="{{ asset('welcome/img/right-arrow.png' ) }}" alt="Grezns"  style="    filter: invert(1);  height: auto;border: none; transform: scale(1, 1) translate(0.5px, 0px) rotate( 226deg); width: 35px;">
                                 </div>
                              </div>
                              <div class="about75">
                                 
                                 <p>
We cater to business and leisure travellers who value luxury, comfort, great cuisines, multi-application bookings and value for money. Our modern and well furnished hotels, resorts, long-stay suites, and inns are what make our guests return time and time again to our properties in metro cities, holiday destinations. With a Head Office based in the heart of Delhi, the team at The Grezns, a chain of luxurious hotels is truly passionate about hospitality and driven to deliver immaculate guest experiences.
                                 </p>
                                 <div id="button10" style="    background: #bba58a;">
                                    <img src="{{ asset('welcome/img/right-arrow.png' ) }}" alt="Grezns"  style="    filter: invert(1);  height: auto;border: none; transform: scale(1, 1) translate(0.5px, 0px) rotate(45deg); width: 35px;">
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <section class="pt-4 pb-4 over-ve" data-spy="scroll" data-target="#scroll_sp" data-offset="50" style="position:relative;">
            <h3 style="display:none">&nbsp;</h3>
            <div class="container">
               <div class="row">
                  <div class="col-md-12 col-sm-12 col-12">
                     <div class="scroll_sp">
                        <ul class="spy">
                           <li><a href="#overview">How we work? </a></li>
                           <li><a href="#vision">Why us?</a></li>
                           <li><a href="#profile">Our work in pandemic</a></li>
                           <li><a href="#eco">Our Hotels</a></li>
                           <li><a href="#profile2">Hand-selected Offers</a></li>
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
         </section>
      </div>
      <section class="mid-center pt-5 pb-5" >
         <div class="container">
            <div class="row">
               <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                  <div class="mid-img">
                     <div class="headingsection" style="padding-top:0px;">
                        <h4 style="line-height: 2;letter-spacing: 0.2em;font-size: 17px; text-align: left; font-family: 'dallas light';font-weight: 400;font-style: normal;">A LITTLE ABOUT</h4>
                        <h3 style="color: rgba(69,66,61,1);line-height: 1.6;letter-spacing: 0.1em;font-size: 33px;text-align: left;    font-family: 'Nanum Myeongjo' !important;">THE PROCESS</h3>
                        <p>We cater to business and leisure travellers who value luxury, comfort, great cuisines, multi-application bookings and value for money. Our modern and well furnished hotels, resorts, long-stay suites, and inns are what make our guests return time and time again to our properties in metro cities, holiday destinations. </p>
                     </div>
                  </div>
               </div>
            </div>
            <div class="row" id="overview">
               <div class="col-lg-7 col-md-7 col-sm-6 col-12">
                  <div class="mid-img">
                     <img src="{{ asset('welcome/img/hoteltypes-1.jpg ') }}" alt="Grezns">
                  </div>
               </div>
               <div class="col-lg-5 col-md-5 col-sm-6 col-12">
                  <div class="mid-content">
                     <div class="about68">
                        <div class="headingsection">
                           <h3>How we work? </h3>
                           <span></span>
                           <h4>The grezns</h4>
                        </div>
                        <p>
We have luxury hotels and resorts in India & across the globe. For the premium experience we present a wide range of room options for our guests. Presidential, Luxury, Executive, Boutique and Studio rooms
are an opulent choice for the royal treatment. Being the best hotels in India we have spacious guestrooms. 
						   </p>
                        <div id="button1">
                           <img src="{{ asset('welcome/img/right-arrow.png' ) }}" alt="Grezns"  style="    filter: invert(1);  height: auto;border: none; transform: scale(1, 1) translate(0.5px, 0px) rotate( 226deg); width: 35px;">
                        </div>
                     </div>
                     <div class="about67">
                        <h3>Hospitality services offered by us:- </h3>
                        <p>We present beautiful rooms with modern amenities to give our client’s tasteful experience with aesthetic feels at unbeatable prices. We have our own philosophy focussed in the interest of our mother nature. The Grezns chain of luxury hotels is dedicated to its guests. We provide the amazing feels and delightness to our guests. 
						</p>
                    
                        <div id="button2">
                           <img src="{{ asset('welcome/img/right-arrow.png' ) }}" alt="Grezns"  style="    filter: invert(1);  height: auto;border: none; transform: scale(1, 1) translate(0.5px, 0px) rotate(45deg); width: 35px;">
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="row overview" id="vision">
               <div class="col-lg-7 col-md-7 col-sm-6 col-12  col-push-sm-7  col-md-pull-7">
                  <div class="mid-img">
                     <img src="{{ asset('welcome/img/hoteltypes-2.jpg ') }}" alt="Grezns">
                  </div>
               </div>
               <div class="col-lg-5 col-md-5 col-sm-6 col-12 col-push-sm-6 col-md-push-5">
                  <div class="mid-content">
                     <div class="about70">
                        <div class="headingsection">
                           <h3>Why us? </h3>
                           <span></span>
                           <h4>The grezns</h4>
                        </div>
                        <p>We at The Grezns offer the first hand luxury experience with scenic beauties and modern amenities. Our guests can customize their room requirements with their mobile phones for a complete luxurious and premium experience. The Grezns, Luxurious hotels collection is the world’s first group of hotels to offer Convenient-hygienic-efficient hospitality services with cost effective mobile key feature and increased guest loyalty with positive reviews and direct bookings.</p>
                       
                        <div id="button3">
                           <img src="{{ asset('welcome/img/right-arrow.png' ) }}" alt="Grezns"  style="    filter: invert(1);  height: auto;border: none; transform: scale(1, 1) translate(0.5px, 0px) rotate( 226deg); width: 35px;">
                        </div>
                     </div>
                     <div class="about69">
                        <h3>Why we are the leading luxurious chain of hotels? </h3>
                        <p>
						We are specialized in offering world class hotel services to our guests starting from ‘multi-application check in’ to ‘digital check out’. We are world's first group of hotels to ensure Smart hospitality solution just from the moment you book the hotel till the moment of your check out. 
						</p>
                        <div id="button4">
                           <img src="{{ asset('welcome/img/right-arrow.png' ) }}" alt="Grezns"  style="    filter: invert(1);  height: auto;border: none; transform: scale(1, 1) translate(0.5px, 0px) rotate(45deg); width: 35px;">
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="row" id="profile">
               <div class="col-lg-7 col-md-7 col-sm-6 col-12">
                  <div class="mid-img">
                     <img src="{{ asset('welcome/img/hoteltypes-3.jpg ') }}" alt="Grezns">
                  </div>
               </div>
               <div class="col-lg-5 col-md-5 col-sm-6 col-12">
                  <div class="mid-content">
                     <div class="about72">
                        <div class="headingsection">
                           <h3>Our work in pandemic</h3>
                           <span></span>
                           <h4>The grezns</h4>
                        </div>
                        <p>We are providing 10 to 6 dining time working assistance. Strictly maintaining the covid protocol. We are 24x7 available with our hospitality services. Sanitized machines are installed at the entry to ensure maximum hygiene of our guests and staff. Our staff is there to assist right from the entry to the moment you enter the room. Regular disinfection of handles, doors and hands is our topmost concern. Focussing towards organic and herbal stuff  in lieu of taking care of the environment and the health of our guests. We are also maintaining social distancing at the counters
						</p>
                        <div id="button5">
                           <img src="{{ asset('welcome/img/right-arrow.png' ) }}" alt="Grezns"  style="    filter: invert(1);  height: auto;border: none; transform: scale(1, 1) translate(0.5px, 0px) rotate( 226deg); width: 35px;">
                        </div>
                     </div>
                     <div class="about71">
                        <h3>Our Mission</h3>
                        <p>Our mission is to deliver the best in class luxurious services to our national and international guests. Using Artificial Intelligence from beginning till the end of your visit we are determined to give you an impressive premium experience</p>
                        <h3>Experience us</h3>
                        <p>Present in premium locations of the major cities in different countries majorly in Delhi, India. Our luxury hotels skillfully blend together local aesthetics and modern day comforts along with The Grezns’ renowned culinary expertise.
<br>Whether the vibe is European, Mediterranean or an artful, magical mix we are united in delivering a Luxurious Experience. And we are distinctly awesome one at that. 
</p>

                        <div id="button6">
                           <img src="{{ asset('welcome/img/right-arrow.png' ) }}" alt="Grezns"  style="    filter: invert(1);  height: auto;border: none; transform: scale(1, 1) translate(0.5px, 0px) rotate(45deg); width: 35px;">
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="row overview" id="eco">
               <div class="col-lg-7 col-md-7 col-sm-6 col-12  col-push-sm-7  col-md-pull-7 ">
                  <div class="mid-img">
                     <img src="{{ asset('welcome/img/hoteltypes-4.jpg ') }}" alt="Grezns">
                  </div>
               </div>
               <div class=" col-lg-5 col-md-5 col-sm-6 col-12 col-push-sm-6 col-md-push-5">
                  <div class="mid-content">
                     <div class="about74">
                        <div class="headingsection">
                           <h3>Our Hotels</h3>
                           <span></span>
                           <h4>Grezns</h4>
                        </div>
                        <p>Targeting business and leisure guests who favor personality and individuality with unconventional luxurious approach, The Grezns presents unique luxury hotels which deliver a feel good experience that's binded in luxury, comfort and great value. 
						</p>
                        <ul>
                           <li>Business Hotels</li>
                           <li>Leisure Hotels</li>
                           <li>Holiday Destinations</li>
                           <li>Wedding Destinations</li>
                           <li>Party Zone Area</li>
                           <li>Swimming Pools</li>
                           <li>Gyms</li>
                        </ul>
                        <div id="button7">
                           <img src="{{ asset('welcome/img/right-arrow.png' ) }}" alt="Grezns"  style="    filter: invert(1);  height: auto;border: none; transform: scale(1, 1) translate(0.5px, 0px) rotate( 226deg); width: 35px;">
                        </div>
                     </div>
                     <div class="about73">
                             <h3>Quintessential Experiences</h3>
                        <p>The Grezns chain of Luxurious Hotels is on a continuous journey to delight our guests by presenting unrivalled luxury in dazzling vicinity entrenched in the lap of nature and enclosed in the graciousness of Hospitality. We welcome you cordially to sense the divergence, taste and enjoy it with all your senses. 

 </p>
                             <h3>Destination Hotels</h3>
                        <p>During the time that the global pandemic was all around, The Grezns was developing exemplary milestones surpassing all expectations. The Grezns chain of luxurious hotels has a range of award-winning properties that celebrates the premium luxury comfort, based primarily on artificial intelligence. 
						</p>
                        <div id="button8">
                           <img src="{{ asset('welcome/img/right-arrow.png' ) }}" alt="Grezns"  style="    filter: invert(1);  height: auto;border: none; transform: scale(1, 1) translate(0.5px, 0px) rotate(45deg); width: 35px;">
                        </div>
                     </div>
                  </div>
               </div>
            </div>
			
            <div class="row" id="profile2" style="    margin-bottom: 0;margin-top:50px;">
               <div class="col-lg-7 col-md-7 col-sm-6 col-12">
                  <div class="mid-img">
                     <img src="{{ asset('welcome/img/hoteltypes-3.jpg ') }}" alt="Grezns">
                  </div>
               </div>
               <div class="col-lg-5 col-md-5 col-sm-6 col-12">
                  <div class="mid-content">
                     <div class="about76">
                        <div class="headingsection">
                           <h3>Hand-selected Offers</h3>
                           <span></span>
                           <h4>The grezns</h4>
                        </div>
                        <p>On business, leisure or wedding, whatever is the occasion, our range of hand-selected offers allows you to uncover and traverse, coddle and recharge, honour the ecstasy. </p>
                        <div id="button10">
                           <img src="{{ asset('welcome/img/right-arrow.png' ) }}" alt="Grezns"  style="    filter: invert(1);  height: auto;border: none; transform: scale(1, 1) translate(0.5px, 0px) rotate( 226deg); width: 35px;">
                        </div>
                     </div>
                     <div class="about75">
                        <h3> </h3>
                        <p></p>

                        <div id="button9">
                           <img src="{{ asset('welcome/img/right-arrow.png' ) }}" alt="Grezns"  style="    filter: invert(1);  height: auto;border: none; transform: scale(1, 1) translate(0.5px, 0px) rotate(45deg); width: 35px;">
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
     
      <div class="carrer3456 ">
         <div id="carouselExampleControls3" class="carousel slide carousel-fade " data-ride="carousel"  data-interval="false" >
            <div class="carousel-inner">
               <div class="carousel-item active">
                  <section class="contact-list whoweare34" id="slide1">
                     <h4 class="abo57">What you'll be part of </h4>
                     <div class="container min-container">
                        <div class="row">
                           <div class="col-md-12 col-sm-12 col-12">
                              <div class="contact-full">
                                 <div class="con_form1">
                                    <div class="hoteltypesServices">
                                       <div class="headingsection" style="text-align:left;">
                                          <h3 style="    font-size: 21px;">You'll join our mission111 </h3>
                                          <span></span>
                                          <h4>What you'll be part of </h4>
                                          <p style="padding-top:20px;">
                                             We want to surprise and delight every guest that walks through our doors. To make a difference to their day, every day. And to keep improving so we're always the very best.
                                             We want to surprise and delight every guest that walks through our doors. To make a difference to their day, every day. And to keep improving so we're always the very best.
                                          </p>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="con-img">
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <h4 class="abo58">What you'll be part of </h4>
                  </section>
               </div>
               <div class="carousel-item">
                  <section class="contact-list whoweare34" id="slide2">
                     <h4 class="abo57">What you'll be part of </h4>
                     <div class="container min-container">
                        <div class="row">
                           <div class="col-md-12 col-sm-12 col-12">
                              <div class="contact-full">
                                 <div class="con_form1">
                                    <div class="hoteltypesServices">
                                       <div class="headingsection" style="text-align:left;">
                                          <h3 style="    font-size: 21px;">You'll join our mission222 </h3>
                                          <span></span>
                                          <h4>What you'll be part of </h4>
                                          <p style="padding-top:20px;">
                                             We want to surprise and delight every guest that walks through our doors. To make a difference to their day, every day. And to keep improving so we're always the very best.
                                             We want to surprise and delight every guest that walks through our doors. To make a difference to their day, every day. And to keep improving so we're always the very best.
                                          </p>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="con-img">
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <h4 class="abo58">What you'll be part of </h4>
                  </section>
               </div>
               <div class="carousel-item">
                  <section class="contact-list whoweare34" id="slide3">
                     <h4 class="abo57">What you'll be part of </h4>
                     <div class="container min-container">
                        <div class="row">
                           <div class="col-md-12 col-sm-12 col-12">
                              <div class="contact-full">
                                 <div class="con_form1">
                                    <div class="hoteltypesServices">
                                       <div class="headingsection" style="text-align:left;">
                                          <h3 style="    font-size: 21px;">You'll join our mission333 </h3>
                                          <span></span>
                                          <h4>What you'll be part of </h4>
                                          <p style="padding-top:20px;">
                                             We want to surprise and delight every guest that walks through our doors. To make a difference to their day, every day. And to keep improving so we're always the very best.
                                             We want to surprise and delight every guest that walks through our doors. To make a difference to their day, every day. And to keep improving so we're always the very best.
                                          </p>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="con-img">
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <h4 class="abo58">What you'll be part of </h4>
                  </section>
               </div>
            </div>
            <div class="container1"  style="    position: absolute;right: 46%;bottom: 349px; width: 45px; margin: auto;">
               <a class="carousel-control-prev" href="#carouselExampleControls3" role="button" data-slide="prev" style="    width: 35px">
               <img src="{{ asset('welcome/img/left-arrow.png' ) }}" alt="Grezns"  style="     margin-right: 100px;  height: auto; border: none; width: 35px;">
               </a>
               <a class="carousel-control-next" href="#carouselExampleControls3" role="button" data-slide="next" style="    width:35px;">
               <img src="{{ asset('welcome/img/right-arrow.png' ) }}" alt="Grezns"  style="  height: auto;border: none;  width: 35px;">
               </a>
            </div>
         </div>
      </div>
      <section id="about92">
         <div class="container">
            <div class="row">
               <div class="col-md-6 col-sm-6 col-12" style="z-index:0;">
                  <div class="contact-full11">
                     <div id="carouselExampleControls" class="carousel slide" data-ride="carousel"  data-interval="false" >
                        <div class="carousel-inner">
                           <div class="carousel-item active">
                              <a href="photo-gallery.html"> <img src="{{ asset('welcome/img/about9.jpg ') }}" alt="Grezns"></a>
                           </div>
                           <div class="carousel-item">
                              <a href="wedding.html"> <img src="{{ asset('welcome/img/weddings2.jpg ') }}" alt="Grezns"></a>
                           </div>
                           <div class="carousel-item">
                              <a href="meeting-and-events.html"><img src="{{ asset('welcome/img/meetings2.jpg ') }}" alt="Grezns"></a>
                           </div>
                           <div class="carousel-item">
                              <a href="moto-rental.html"><img src="{{ asset('welcome/img/motorental2.jpg ') }}" alt="Grezns"></a>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-md-6 col-sm-6 col-12" style="z-index:1;position:relative;">
                  <div class="contact-full11">
                     <div class="con-img1">
                        <div id="headingedkjiid" class="headingsection" style="padding-top:0px;">
                           <h3 class="skjklsdflkds" style="    line-height: 5;letter-spacing: 0.2em;font-size: 17px;text-align: left; font-weight: 400;font-style: normal;">A few of my favorite things</h3>
                           <span style="width:100%;"></span>
                           <ul class="ulinesd">
                              <li><a href="photo-gallery.html">Browse the Photogallery</a></li>
                              <li><a href="wedding.html">Browse the Wedding</a></li>
                              <li><a href="meeting-and-events.html">Browse the Meetings & Events</a></li>
                              <li><a href="moto-rental.html">Browse the Moto Rental</a></li>
                           </ul>
                        </div>
                     </div>
                  </div>
                  <div class="container1" style="position: absolute;right: 50px;bottom: 0px;width: 45px; margin: auto;">
                     <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev" style="    width: 35px">
                     <img src="{{ asset('welcome/img/left-arrow.png' ) }}" alt="Grezns"  style="     margin-right: 100px;  height: auto; border: none; width: 35px;">
                     </a>
                     <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next" style="    width:35px;">
                     <img src="{{ asset('welcome/img/right-arrow.png' ) }}" alt="Grezns"  style="  height: auto;border: none;  width: 35px;">
                     </a>
                  </div>
               </div>
            </div>
         </div>
      </section>
      
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
   
@endsection
@section('javascript')
  
@endsection

