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

<style>
        @media (max-width: 3000px) and (min-width: 992px) {
            .toppHeader .headertop .btn-toggle2 {
               right: 0px !important;
            }
         }
      </style>
<style>
@font-face{font-family:dallas light;src:url('https//static.showit.co/file/KRkaq8XxQ5i7h2tlnNEi5A/77884/dallas-light-webfont.woff');}
 </style>
<style>
@font-face{font-family:dallas light;src:url('dallas-light-webfont.woff');}
.modal.fade.guest button.quantity-right-plus1.btn.btn-success.btn-number {border-radius: 0px;height: 25px;line-height: 13px;padding: 5px;}
.modal.fade.guest button {border-radius: 0px;  height: 25px;line-height: 13px;padding: 5px;}
.modal.fade.guest span.input-group-btn {height: 25px;}
.modal.fade.guest input {height: 25px; border: none;text-align: center;font-weight: 900;font-family: cursive;}
.modal.fade.guest .modal-header .close {padding: 0px;position: absolute;top: 17px;opacity: 1;background: #fff;}
.modal.fade.guest .btn-danger .fa, .modal.fade.guest .btn-danger .fas{    font-weight: 400;}
.modal.fade.guest .btn-danger {color: #fff;background-color: #6c757d;border-color: #6c757d;border-radius: 6px !important;line-height: 0px !important;font-size: 11px;width: 32px;}
.modal.fade.guest .modal-footer {border: none;    padding-top: 0px;}
.modal.fade.guest .input-group{ width: 95px;margin: auto;}
.modal.fade.guest .btn-success {color: #fff;background-color: #6c757d !important;border-color: #6c757d !important;border-radius: 6px !important;font-size: 12px;width: 32px;font-weight: 400 !important;}
.modal.fade.guest .modal-content {margin: auto;display: block;width: 300px;top: 20%;max-width: 300px;height: 400px;border-radius: 6px;}
.modal.fade.guest{max-width: 300px;top: 20%;left: 39%;}
	  </style>
@endsection
@section('meta')
   
@endsection

@section('content')
@include('welcome.common.menu')
@include('welcome.common.desktop-menu')
<!-- menu -->
       
      <section id="bookinginersd" class="contact-banner abt-banner book-nows" style="background-image:url({{ asset('welcome/img/backgroujdkifsd.jpg') }} )">
      @include('welcome.common.auth')
         <div class="container">
            <div class="row">
               <div class="col-md-12 col-sm-12 col-12">
                  <div class="hotel_heads">
                     <h1 style="font-family: 'Roboto' !important;text-transform: capitalize;">The Grezns Luxurious Hotel</h1>
                     <p style="font-family: 'Roboto' !important;">Book Domestic & International Hotels</p>
                  </div>
                  <!-- form start here -->								
                  <div class="hotel-form">
                     <form>
                        <div class="form-group">
                           <label style="margin-bottom:9px;">Search By City   <i class="fas fa-chevron-down" style="    position: absolute; margin-left: 58px; background: #dad8ce;width: 22px; text-align: left; margin-top: 39px; z-index: 0; font-size: 11px;color: #706f6f;"></i> </label>	
                           <select class="form-control" id="citys123">
                              <option value="Select">Select City</option>
                              <option value="Delhi">Delhi</option>
                              <option value="Mumbai">Mumbai</option>
                              <option value="Mumbai">Bengaluru</option>
                              <option value="Mumbai">Hyderabad</option>
                              <option value="Mumbai">Kolkata</option>
                              <option value="Mumbai">Ahmedabad</option>
                              <option value="Mumbai">Surat</option>
                              <option value="Mumbai">Shimla</option>
                              <option value="Mumbai">Bhopal</option>
                           </select>
                        </div>
                        <div class="form-group">
                           <label>Arrival and departure</label>	
                           <div class="input-prepend input-group">
                              <span class="add-on input-group-addon"></span><input type="text" style="  background: #dad8ce; border-radius: 3px;  font-family: 'Roboto' !important;    padding: 0px 30px; font-size: 14px;" name="reservation" id="reservation" class="form-control" value="05/17/2021 - 05/23/2021" />
                           </div>
                        </div>
                        <div class="form-group chil-btn">
                           <label>Guests</label>											
                           <button type="button" data-toggle="modal" data-target="#exampleModal">	
                           <span><i class="fas fa-building"></i> &nbsp; 2 Room, <i class="fas fa-user-friends"></i> 3 Guests</span>	
                           </button>										
                        </div>
                        <div class="form-group">							
                           <label>Promocode</label>											
                           <input type="text" class="form-control" name="promo" id="promo" placeholder="Enter Here">										
                        </div>
                        <div class="form-group btn-srch">										 											
                           <a href="hotel-list-view.html"><button type="button" class="btn" id="search">Search</button></a>
                        </div>
                     </form>
                  </div>
                  <!-- form end here -->
               </div>
            </div>
         </div>
      </section>
      <section id="paddijkdjkfsdsd" class="book-forms" style="    margin-top: 100px;">
         <div class="container">
            <div class="row">
               <div class="col-md-12 col-sm-12 col-12">
               </div>
            </div>
         </div>
      </section>
      <section class="book-forms1">
         <div class="container">
            <div class="row">
               <div class="col-md-12 col-sm-12 col-12">
                  <div class="hotel-form" style="       background: #fff;
                     margin-top:0px;
                     box-shadow: 0px 0px 11px 1px #ab8e6e;
                     border-radius: 6px;">
                     <div class="row">
                        <div class="col-md-7 col-sm-7 col-12" style="text-align:left;">
                           <div class="list">
                              <h3 class="c-12d5dhi"><span class="list-heading">It's better to book directly</span></h3>
                              <p><span class="list-item" style="    font-family: 'Roboto' !important;">When you choose the official site, you choose quality. </span></p>
                              <div class="best-rt" style="    width: 100%;max-width: 100%; margin-top: 0px;">
                                 <div class="icon-first">								<i class="fas fa-dollar-sign"></i> Best rate guaranteed							</div>
                                 <div class="icon-first">								<i class="fa fa-street-view"></i>  No intermediary							</div>
                                 <div class="icon-first">								<i class="fa fa-key"></i>  Exclusive solutions							</div>
                              </div>
                           </div>
                        </div>
                        <div class="col-md-5 col-sm-5 col-12">
                           <section class="wizard-video-card dark"><h3 style="display:none">&nbsp;</h3> 
                              <span class="c-1owv2mq w-icon-default video-w">
                              <img src="{{ asset('welcome/img/granzs1.png') }} " alt="Grezns" style="width: 20px;margin:20px 5px;">
                              </span>
                              <section class="video-text"> <h3 style="display:none">&nbsp;</h3> 
                                <section class="video-heading"><h6>&nbsp;See how it works&nbsp;</h6></section>
                                 <section class="video-subHeading"><h6>&nbsp;Watch Video&nbsp;</h6></section>
                              </section>
                               <section class="video-thumbnail"><h3 style="display:none">&nbsp;</h3>
                                 <img src="{{ asset('welcome/img/wizardthumbnail.png') }} " alt="Wizard Video">
                              </section>
                           </section>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <section class="pb-5" style="padding-bottom:0px !important;">
         <div class="container min-container">
            <div class="hotellistings000">
               <div class="hotellistings">
                  <div class="row">
                     <div class="col-md-4 col-sm-4 col-12">
                        <div id="myImg" style="position: absolute;bottom: 15px;right: 40px;border-radius: 0px;padding: 0px; margin: 0px;"> <i class="fas fa-expand" style="    font-size: 32px;color: #fff;"></i>  </div>
                        <img src="{{ asset('welcome/img/hoteltypes-2.jpg') }} " alt="img2" style="width:100%;    height:330px;">
                        <div id="myModal" class="modal">
                          
                           <div class="modal-content" id="img01">
                              <div id="carouselExampleControls3" class="carousel slide carousel-fade " data-ride="carousel"  data-interval="3000" >
                                 <div class="carousel-inner">
                                    <div class="carousel-item active">
                                       <img src="{{ asset('welcome/img/joom1.jpg') }} " alt="Snow" style="width:820px;height:400px;    border-radius: 6px;">
                                    </div>
                                    <div class="carousel-item">
                                       <img src="{{ asset('welcome/img/joom2.jpg') }} " alt="Snow" style="width:820px;height:400px;    border-radius: 6px;">
                                    </div>
                                    <div class="carousel-item">
                                       <img src="{{ asset('welcome/img/joom3.jpg') }} " alt="Snow" style="width:820px;height:400px;    border-radius: 6px;">
                                    </div>
                                 </div>
                    <div class="container1" id="contacitsd" style=" position: absolute;right: 0px;bottom: 50%;z-index: 999999;width: 100%;margin: auto;">
                    <a class="carousel-control-prev" href="#carouselExampleControls3" role="button" data-slide="prev" style="     width: 55px;left:35;right: inherit; opacity: 1;">
                    <i class="fas fa-chevron-left" style="    font-size: 22px; font-weight: 500;"></i></a>
                    <a class="carousel-control-next" href="#carouselExampleControls3" role="button" data-slide="next" style="     width: auto;left: inherit;right: 42px;opacity: 1;">
					<i class="fas fa-chevron-right" style="    font-size: 22px; font-weight: 500;"></i></a>
                                 </div>
                              </div>
							   <span class="close"><i class="fas fa-times" style="    font-weight: 300;  font-size: 20px;"></i></span>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-8 col-sm-8 col-12">
                        <div class="one-bed">
                           <div class="breaks" style="width:100%;">
                              <div class="headingsection">
                                 <h3><a href="#">CLASSIC VILLA MARINA GARDEN ROOM</a></h3>
                                 <span></span>
                              </div>
                              <p>
                                 The ideal space for those who love intimacy These 20/26 sqm. rooms are characterised by the brightness of Mediterranean Colours and the unique traits ...
                                 The ideal space for those who love intimacy These 20/26 sqm. rooms are characterised by the brightness of Mediterranean Colours and the unique traits ...
                              </p>
                           </div>
                        </div>
                        <hr style="    margin: 20px 0px;">
                        <div class="fast" style="    width: 100%;">
                           <div class="row">
                              <div class="col-md-6 col-sm-6 col-12">
                                 <p style="color: #fe2727; font-weight: 600 !important;">%Deal of the day</p>
                                 <h4 style="text-align:left;    margin-bottom: 10px;">₨21,905.36</h4>
                                 <p>VILLA MARINA SPECIAL RATE</p>
                                 <p>Rate includes <i class="fa fa-coffee"></i> Breakfast</p>
                                 <p style="    color: #2392ff;">Non-refundable (details)</p>
                              </div>
                              <div class="col-md-6 col-sm-6 col-12">
                                 <div class="hotellistbuttons"  style="    text-align: right;      margin-top: 80px;  padding-right: 30px;">
                                    <a href="{{ route('hotel-inner') }} "><button type="button" id="book" class="bostel">View Detail</button></a>
                                    <a href="hotel-room-detail.html"><button type="button" id="book">Book Now</button></a>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="hotellistings11" style="margin-bottom:20px;">
                  <div class="row">
                     <div class="col-md-12 col-sm-12 col-12">
                        <div class="row">
                           <div class="col-md-12 col-sm-12 col-12">
                              <div class="ev-banner" style="    background: url({{ asset('welcome/img/booking1.jpg') }} );background-size: cover; background-position: center center;">
                                 <div class="row" style="width:100%">
                                    <div class="col-md-7 col-sm-7 col-12">
                                       <div class="unique">
                                          <h2>The grezns Luxurious hotel</h2>
                                          <p>Packages, offers and special services just for you</p>
                                       </div>
                                    </div>
                                    <div class="col-md-5 col-sm-5 col-12">
                                       <div class="expl" style="text-align: right; margin-top: 70px;">	
                                          <a href="hotel-list.html">	
                                          <button type="button" class="btn">Explore</button>
                                          </a>	
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="hotellistings">
                  <div class="row">
                     <div class="col-md-4 col-sm-4 col-12">
                        <div id="myImg2" style="position: absolute;bottom: 15px;right: 40px;border-radius: 0px;padding: 0px; margin: 0px;"> <i class="fas fa-expand" style="    font-size: 32px;color: #fff;"></i>  </div>
                        <img src="{{ asset('welcome/img/hoteltypes-2.jpg') }} " alt="img2" style="width:100%;    height:330px;">
                        <div id="myModal2" class="modal2">
                           <div class="modal-content" id="img012">
                              <div id="carouselExampleControls30" class="carousel slide carousel-fade " data-ride="carousel"  data-interval="3000" >
                                 <div class="carousel-inner">
                                    <div class="carousel-item active">
                                       <img src="{{ asset('welcome/img/joom1.jpg') }} " alt="Snow" style="width:820px;height:400px;    border-radius: 6px;">
                                    </div>
                                    <div class="carousel-item">
                                       <img src="{{ asset('welcome/img/joom2.jpg') }} " alt="Snow" style="width:820px;height:400px;    border-radius: 6px;">
                                    </div>
                                    <div class="carousel-item">
                                       <img src="{{ asset('welcome/img/joom3.jpg') }} " alt="Snow" style="width:820px;height:400px;    border-radius: 6px;">
                                    </div>
                                 </div>
                                  <div class="container1" id="contacitsd" style=" position: absolute;right: 0px;bottom: 50%;z-index: 999999;width: 100%;margin: auto;">
                    <a class="carousel-control-prev" href="#carouselExampleControls30" role="button" data-slide="prev" style="     width: 55px;left:35;right: inherit; opacity: 1;">
                    <i class="fas fa-chevron-left" style="    font-size: 22px; font-weight: 500;"></i></a>
                    <a class="carousel-control-next" href="#carouselExampleControls30" role="button" data-slide="next" style="     width: auto;left: inherit;right: 42px;opacity: 1;">
					<i class="fas fa-chevron-right" style="    font-size: 22px; font-weight: 500;"></i></a>
                                 </div>
                              </div>
							     <span class="close2"><i class="fas fa-times" style="    font-weight: 300;  font-size: 20px;"></i></span>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-8 col-sm-8 col-12">
                        <div class="one-bed">
                           <div class="breaks" style="width:100%;">
                              <div class="headingsection">
                                 <h3><a href="#">CLASSIC VILLA MARINA GARDEN ROOM</a></h3>
                                 <span></span>
                              </div>
                              <p>
                                 The ideal space for those who love intimacy These 20/26 sqm. rooms are characterised by the brightness of Mediterranean Colours and the unique traits ...
                                 The ideal space for those who love intimacy These 20/26 sqm. rooms are characterised by the brightness of Mediterranean Colours and the unique traits ...
                              </p>
                           </div>
                        </div>
                        <hr style="    margin: 20px 0px;">
                        <div class="fast" style="    width: 100%;">
                           <div class="row">
                              <div class="col-md-6 col-sm-6 col-12">
                                 <p style="color: #fe2727; font-weight: 600 !important;">%Deal of the day</p>
                                 <h4 style="text-align:left;    margin-bottom: 10px;">₨21,905.36</h4>
                                 <p>VILLA MARINA SPECIAL RATE</p>
                                 <p>Rate includes <i class="fa fa-coffee"></i> Breakfast</p>
                                 <p style="    color: #2392ff;">Non-refundable (details)</p>
                              </div>
                              <div class="col-md-6 col-sm-6 col-12">
                                 <div class="hotellistbuttons"  style="    text-align: right;     margin-top: 80px;
                                    padding-right: 30px;">
                                    <a href="{{ route('hotel-inner') }} "><button type="button" id="book" class="bostel">View Detail</button></a>
                                    <a href="hotel-room-detail.html"><button type="button" id="book">Book Now</button></a>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="hotellistings">
                  <div class="row">
                     <div class="col-md-4 col-sm-4 col-12">
                        <div id="myImg3" style="position: absolute;bottom: 15px;right: 40px;border-radius: 0px;padding: 0px; margin: 0px;"> <i class="fas fa-expand" style="    font-size: 32px;color: #fff;"></i>  </div>
                        <img src="{{ asset('welcome/img/hoteltypes-2.jpg') }} " alt="img2" style="width:100%;    height:330px;">
                        <div id="myModal3" class="modal3">
                           <div class="modal-content" id="img013">
                              <div id="carouselExampleControls03" class="carousel slide carousel-fade " data-ride="carousel"  data-interval="3000" >
                                 <div class="carousel-inner">
                                    <div class="carousel-item active">
                                       <img src="{{ asset('welcome/img/joom1.jpg') }} " alt="Snow" style="width:820px;height:400px;    border-radius: 6px;">
                                    </div>
                                    <div class="carousel-item">
                                       <img src="{{ asset('welcome/img/joom2.jpg') }} " alt="Snow" style="width:820px;height:400px;    border-radius: 6px;">
                                    </div>
                                    <div class="carousel-item">
                                       <img src="{{ asset('welcome/img/joom3.jpg') }} " alt="Snow" style="width:820px;height:400px;    border-radius: 6px;">
                                    </div>
                                 </div>
                                  <div class="container1" id="contacitsd" style=" position: absolute;right: 0px;bottom: 50%;z-index: 999999;width: 100%;margin: auto;">
                    <a class="carousel-control-prev" href="#carouselExampleControls03" role="button" data-slide="prev" style="     width: 55px;left:35;right: inherit; opacity: 1;">
                    <i class="fas fa-chevron-left" style="    font-size: 22px; font-weight: 500;"></i></a>
                    <a class="carousel-control-next" href="#carouselExampleControls03" role="button" data-slide="next" style="     width: auto;left: inherit;right: 42px;opacity: 1;">
					<i class="fas fa-chevron-right" style="    font-size: 22px; font-weight: 500;"></i></a>
                                 </div>
                              </div>
							     <span class="close3"><i class="fas fa-times" style="    font-weight: 300;  font-size: 20px;"></i></span>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-8 col-sm-8 col-12">
                        <div class="one-bed">
                           <div class="breaks" style="width:100%;">
                              <div class="headingsection">
                                 <h3><a href="#">CLASSIC VILLA MARINA GARDEN ROOM</a></h3>
                                 <span></span>
                              </div>
                              <p>
                                 The ideal space for those who love intimacy These 20/26 sqm. rooms are characterised by the brightness of Mediterranean Colours and the unique traits ...
                                 The ideal space for those who love intimacy These 20/26 sqm. rooms are characterised by the brightness of Mediterranean Colours and the unique traits ...
                              </p>
                           </div>
                        </div>
                        <hr style="    margin: 20px 0px;">
                        <div class="fast" style="    width: 100%;">
                           <div class="row">
                              <div class="col-md-6 col-sm-6 col-12">
                                 <p style="color: #fe2727; font-weight: 600 !important;">%Deal of the day</p>
                                 <h4 style="text-align:left;    margin-bottom: 10px;">₨21,905.36</h4>
                                 <p>VILLA MARINA SPECIAL RATE</p>
                                 <p>Rate includes <i class="fa fa-coffee"></i> Breakfast</p>
                                 <p style="    color: #2392ff;">Non-refundable (details)</p>
                              </div>
                              <div class="col-md-6 col-sm-6 col-12">
                                 <div class="hotellistbuttons"  style="    text-align: right;     margin-top: 80px;   padding-right: 30px;">
                                    <a href="{{ route('hotel-inner') }} "><button type="button" id="book" class="bostel">View Detail</button></a>
                                    <a href="hotel-room-detail.html"><button type="button" id="book">Book Now</button></a>
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

  
      @include('welcome.common.contact')
   @include('welcome.common.brand')
   @include('welcome.common.carsaul')
        
   <!-- modal popup start here -->
   <div class="modal fade guest" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
            <div class="modal-content" style="    height: auto;">
               <div class="modal-header" style="    padding: 0px 20px;">
                  <div class="modal-title" id="exampleModalLabel" style="    display: block; width: 100%;"> 
				  <div class="row">
                        <div class="col-md-8">
                           <label style="font-size: 16px;font-weight: 700; line-height: 0; padding: 15px 0px 8px; color: #7a5937; letter-spacing: 2px;">Guests & Rooms</label>
                        </div>
                        <div class="col-md-4">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="    box-shadow: none;margin-right: 7px;margin-top: -15px;text-transform: uppercase; color: red;font-size: 14px;"> <span aria-hidden="true">Close</span>   </button>
                      </div>
                     </div></div>
                 
               </div>
               <div class="modal-body" style="padding: 5px; padding-top: 14px;">
                  <div class="col-md-12 handle-req">
                  
                     <div class=" roomss rooms1" style="    border-bottom: 1px solid #ccc; padding-bottom: 10px;">
                     <div class="row">
                        <div class="col-md-12">
                           <label style="   font-size: 14px; margin-bottom: -7px;letter-spacing: 1px; font-weight: 600; margin-top: -10px;">Guests in room 1</label>
                        </div>
						   <div class="row" style=" width: 100%;padding: 0px 0px;margin: 10px 0px; ">
                        <div class="col-md-6">
                           <label style="      letter-spacing: 1px;  line-height:15px;">Adults</label>
                        </div>
                        <div class="col-md-6">
                        	 <div class="input-group">
                                    <span class="input-group-btn">
                                        <button type="button" id="quantity-left-minus" class="quantity-left-minuse btn btn-danger btn-number"  data-type="minus" data-field="">
                                      <i class="fas fa-minus"></i>
                                        </button>
                                    </span>
                                    <input type="text" id="quantitye" name="quantity" class="form-control input-number" value="1"    >
                                    <span class="input-group-btn">
                                        <button type="button" id="quantity-right-plus" class="quantity-right-pluse btn btn-success btn-number" data-type="plus" data-field="">
                                           <i class="fas fa-plus"></i>
                                        </button>
                                    </span>
                                </div>
                        </div>
						</div>
						   <div class="row" style="width: 100%;padding: 0px 0px;margin: 10px 0px;">
                        <div class="col-md-6">
                           <label style="      letter-spacing: 1px;   line-height: 15px;">Children</label>
                        </div>
                        <div class="col-md-6">
                        	 <div class="input-group">
                                    <span class="input-group-btn">
                                        <button type="button" id="quantity-left-minus1" class="quantity-left-minus1 btn btn-danger btn-number"  data-type="minus" data-field="">
                                      <i class="fas fa-minus"></i>
                                        </button>
                                    </span>
                                    <input type="text" id="quantity1" name="quantity" class="form-control input-number" value="1"  >
                                    <span class="input-group-btn">
                                        <button type="button" id="quantity-right-plus1" class="quantity-right-plus1 btn btn-success btn-number" data-type="plus" data-field="">
                                           <i class="fas fa-plus"></i>
                                        </button>
                                    </span>
                                </div>
                        </div>
						</div>
                     </div>
                     </div>
                    
                     <div class="  roomss rooms2" style="    margin-top:10px;   border-bottom: 1px solid #ccc; padding-bottom: 10px;">
                      <div class="row">
                        <div class="col-md-12">
                           <label style="    font-size: 14px; margin-bottom: -7px;letter-spacing: 1px; font-weight: 600; margin-top: -10px;">Guests in room 2</label>
                        </div>
						   <div class="row" style="width: 100%;padding: 0px 0px;margin: 10px 0px; ">
                        <div class="col-md-6">
                           <label style="        letter-spacing: 1px; line-height: 15px;">Adults</label>
                        </div>
                        <div class="col-md-6">
                        	   <div class="input-group">
                                 <span class="input-group-btn">
                                 <button type="button" class="quantity-left-minusa btn btn-danger btn-number"  data-type="minus" data-field="">
                                 <i class="fas fa-minus"></i>
                                 </button>
                                 </span>
                                 <input type="text" id="quantitya" name="quantity" class="form-control input-number" value="2"   >
                                 <span class="input-group-btn">
                                 <button type="button" class="quantity-right-plusa btn btn-success btn-number" data-type="plus" data-field="">
                                 <i class="fas fa-plus"></i>
                                 </button>
                                 </span>
                              </div>
                        </div>
						</div>
						   <div class="row" style="width: 100%;padding: 0px 0px;margin: 10px 0px; ">
                        <div class="col-md-6">
                           <label style="        letter-spacing: 1px; line-height: 15px;">Children</label>
                        </div>
                        <div class="col-md-6">
                        	    <div class="input-group">
                                 <span class="input-group-btn">
                                 <button type="button" class="quantity-left-minus btn btn-danger btn-number"  data-type="minus" data-field="">
                                 <i class="fas fa-minus"></i>
                                 </button>
                                 </span>
                                 <input type="text" id="quantity" name="quantity" class="form-control input-number" value="2"    >
                                 <span class="input-group-btn">
                                 <button type="button" class="quantity-right-plus btn btn-success btn-number" data-type="plus" data-field="">
                                 <i class="fas fa-plus"></i>
                                 </button>
                                 </span>
                              </div>
                        </div>
						</div>
                     </div>
                     </div>
                     <div class=" roomss rooms3 " style="    margin-top:10px;    border-bottom: 1px solid #ccc; padding-bottom: 10px;">
                       <div class="row">
                        <div class="col-md-12">
                           <label style="    font-size: 14px; margin-bottom: -7px;letter-spacing: 1px; font-weight: 600; margin-top: -10px;">Guests in room 3</label>
                        </div>
						   <div class="row" style="width: 100%;padding: 0px 0px;margin: 10px 0px; ">
                        <div class="col-md-6">
                           <label style="        letter-spacing: 1px; line-height: 15px;">Adults</label>
                        </div>
                        <div class="col-md-6">
                        	 <div class="input-group">
                                 <span class="input-group-btn">
                                 <button type="button" class="quantity-left-minusc btn btn-danger btn-number"  data-type="minus" data-field="">
                                 <i class="fas fa-minus"></i>
                                 </button>
                                 </span>
                                 <input type="text" id="quantityc" name="quantity" class="form-control input-number" value="2"   >
                                 <span class="input-group-btn">
                                 <button type="button" class="quantity-right-plusc btn btn-success btn-number" data-type="plus" data-field="">
                                 <i class="fas fa-plus"></i>
                                 </button>
                                 </span>
                              </div>
                        </div>
						</div>
						   <div class="row" style="width: 100%;padding: 0px 0px;margin: 10px 0px; ">
                        <div class="col-md-6">
                           <label style="        letter-spacing: 1px; line-height: 15px;">Children</label>
                        </div>
                        <div class="col-md-6">
                        	 <div class="input-group">
                                 <span class="input-group-btn">
                                 <button type="button" class="quantity-left-minusd btn btn-danger btn-number"  data-type="minus" data-field="">
                                 <i class="fas fa-minus"></i>
                                 </button>
                                 </span>
                                 <input type="text" id="quantityd" name="quantity" class="form-control input-number" value="2" >
                                 <span class="input-group-btn">
                                 <button type="button" class="quantity-right-plusd btn btn-success btn-number" data-type="plus" data-field="">
                                 <i class="fas fa-plus"></i>
                                 </button>
                                 </span>
                              </div>
                        </div>
						</div>
                     </div>
                     </div>
                   
                   
                  </div>
               </div>
               <div class="modal-footer">  
                  <button type="button" id="deleteroom1" class="btn btn-secondary" style="border-radius: 6px;font-size: 13px;letter-spacing: 1px;height: 30px;width: 100px;">Delete Room</button>
                  <button type="button" id="addroom1" class="btn btn-primary" style="border-radius: 6px;font-size: 13px;letter-spacing: 1px;height: 30px;width: 100px;">Add Room</button>  
                  <button type="button" id="deleteroom2" class="btn btn-secondary" style="border-radius: 6px;font-size: 13px;letter-spacing: 1px;height: 30px;width: 100px;">Delete Room</button>
                  <button type="button" id="addroom2" class="btn btn-primary" style="border-radius: 6px;font-size: 13px;letter-spacing: 1px;height: 30px;width: 100px;">Add Room</button>  
                  <button type="button" id="deleteroom3" class="btn btn-secondary" style="border-radius: 6px;font-size: 13px;letter-spacing: 1px;height: 30px;width: 100px;">Delete Room</button>
                  <button type="button" id="addroom3" class="btn btn-primary" style="border-radius: 6px;font-size: 13px;letter-spacing: 1px;height: 30px;width: 100px;">Add Room</button>  
               </div>
            </div>
         </div>
		
      </div>
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
    <script src="{{ asset('welcome/js/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('welcome/js/moment.js') }}"></script>
	<script src="{{ asset('welcome/js/daterangepicker.js ') }}"></script>
    <script src="{{ asset('welcome/js/script4.js') }}"></script>
    
@endsection
@section('javascript')
<script>
    $(document).ready(function() {
    $('#reservation').daterangepicker(null, function(start, end, label) {
        console.log(start.toISOString(), end.toISOString(), label);
        });
    });
</script>

@endsection

