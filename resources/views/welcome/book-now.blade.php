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
  
    <section id="bookinginersd" class="contact-banner abt-banner book-nows" style="background-image:url({{ asset('welcome/img/greznsbanner6.jpg') }});background-size:cover;background-position:center center;">
         @include('welcome.common.auth')
         <div class="container">
            <div class="row">
               <div class="col-md-12 col-sm-12 col-12">
			   
			   <div class="hotel_heads">
				<h1 style="font-family: 'Roboto' !important;text-transform: capitalize;">World's Fastest Growing Hotel Chain</h1>
				<p style="font-family: 'Roboto' !important;">Book Domestic & International Hotels</p>
			   </div>
                  <!-- form start here -->								
                  <div class="hotel-form">
                     <form>
					 <div class="form-group">
					 <label style="margin-bottom:9px;">Search By City  <i class="fas fa-chevron-down" style="    position: absolute; margin-left: 58px; background: #dad8ce;width: 22px; text-align: left; margin-top: 39px; z-index: 0; font-size: 11px;color: #706f6f;"></i> </label>	
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
                           <a href="hotel-list-view.html"  class="btn search" style="margin-top: 5px;padding: 18px 38px;width: auto;"> Search </a>
                        </div>
                     </form>
					 
                  </div>
                  <!-- form end here -->
               </div>
            </div>
         </div>
      </section>  
         
	 <section class="book-forms">
	 <h3 style="display:none;">&nbsp;</h3>
         <div class="container">
            <div class="row">
               <div class="col-md-12 col-sm-12 col-12">
               </div>
            </div>
         </div>
      </section>
  
      <section class="now">
         <div class="container">
            <div class="row">
               <div class="col-md-12 col-sm-12 col-12">
                  <div class="better">
				  <div class="headingsection" style="text-align:center">
                     <h3 style="text-align:center;     color: #000;   font-family: 'Roboto' !important;">It's better to book directly</h3>
                     <span style="margin:auto"></span>
                     <h4 style="     font-size: 20px;   font-family: 'Roboto' !important;">When you choose the official site, you choose quality. </h4>
                  </div>
                    
                     <p style="   font-family: 'Roboto' !important;">Booking directly gives you access to exclusive services and guarantees that the hotel will prioritise their relationship with you. Discover special rates and the exclusive benefits of booking via our official website!</p>
                     <div class="best-rt">
                        <div class="icon-first">								<i class="fas fa-dollar-sign"></i> Best rate guaranteed							</div>
                        <div class="icon-first">								<i class="fa fa-street-view"></i>  No intermediary							</div>
                        <div class="icon-first">								<i class="fa fa-key"></i>  Exclusive solutions							</div>
                     </div>
                    
                  </div>
               </div>
            </div>
         </div>
      </section>
	  
	  <section id="boredewdreikc" class="every backgoideff" style="    padding-top: 70px;    position: relative;background-color: #e3ccb400 !important;background-image: url({{ asset('welcome/img/bookingbannersd.jpg') }});">
         <div class="container">
            <div class="row">
               <div class="col-md-6 col-sm-12 col-12">
                  <div class="ev-banner" style="    background: url({{ asset('welcome/img/booking1.jpg') }});background-size: cover; background-position: center center;">
                     <div class="unique">
                        <h2>The grezns Luxurious hotel</h2>
                        <p>Packages, offers and special services just for you</p>
                     </div>
                     <div class="expl">	
						<a href="{{ route('hotel-list') }} " class="btnDFSD">	
							Explore 
						</a>	
					 </div>
                  </div>
               </div>
			       <div class="col-md-6 col-sm-12 col-12">
                   <div class="ev-banner" style="    background: url({{ asset('welcome/img/booking3.jpg') }});background-size: cover; background-position: center center;">
                     <div class="unique">
                        <h2>Unique special offers every day</h2>
                        <p>Packages, offers and special services just for you</p>
                     </div>
                     <div class="expl">	
						<a href="offer.html" class="btnDFSD">	
							Explore 
						</a>	
					 </div>
                  </div>
               </div>
            </div>
			 <div class="row">
			     <div class="col-md-6 col-sm-12 col-12">
                   <div class="ev-banner" style="    background: url({{ asset('welcome/img/booking5.jpg') }});background-size: cover; background-position: center center;">
                     <div class="unique">
                        <h2>The grezns Celebrations & events offer</h2>
                        <p>Packages, offers and special services just for you</p>
                     </div>
                     <div class="expl">	
						<a href="celebrations-events-offer.html" class="btnDFSD">	
							Explore 
						</a>	
					 </div>
                  </div>
               </div>
               <div class="col-md-6 col-sm-12 col-12">
                    <div class="ev-banner" style="    background: url({{ asset('welcome/img/booking4.jpg') }});background-size: cover; background-position: center center;">
                     <div class="unique">
                        <h2>The grezns Wedding Booking Offers</h2>
                        <p>Packages, offers and special services just for you</p>
                     </div>
                     <div class="expl">	
						<a href="wedding-booking-offers.html" class="btnDFSD">	
							Explore 
						</a>	
					 </div>
                  </div>
               </div>
            </div>
			  <div class="row">
               <div class="col-md-6 col-sm-12 col-12">
                   <div class="ev-banner" style="    background: url({{ asset('welcome/img/booking3a.jpg') }});background-size: cover; background-position: center center;">
                     <div class="unique">
                        <h2>The grezns Honeymoon Tour Packages</h2>
                        <p>Packages, offers and special services just for you</p>
                     </div>
                     <div class="expl">	
						<a href="honeymoon-tour-packages.html" class="btnDFSD">	
							Explore 
						</a>	
					 </div>
                  </div>
               </div>
               <div class="col-md-6 col-sm-12 col-12">
                    <div class="ev-banner" style="    background: url({{ asset('welcome/img/booking6.jpg') }});background-size: cover; background-position: center center;">
                     <div class="unique">
                        <h2>The grezns Member Vazard benefits</h2>
                        <p>Packages, offers and special services just for you</p>
                     </div>
                     <div class="expl">	
						<a href="{{ route('member') }}" class="btnDFSD">	
							Explore 
						</a>	
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

