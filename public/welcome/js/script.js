   var menu = new MmenuLight(
               document.querySelector('#menu'),
               'all'
               );
               
               var navigator = menu.navigation({
               // selectedClass: 'Selected',
               // slidingSubmenus: true,
               // theme: 'dark',
               // title: 'Menu'
               });
               
               var drawer = menu.offcanvas({
               // position: 'left'
               });
               
               
               
               // Open the menu.
               var a = document.querySelector('a[href="#menu"]')
               
               .addEventListener('click', evnt => {
               evnt.preventDefault();
               drawer.open();
               });
  	
	$('#full-width').owlCarousel({
		loop:true,
		margin:10,
		nav:false,
		dots:true,
		autoplay:false,		
		responsive:{
			0:{
				items:1
			},
			600:{
				items:1
			},
			1000:{
				items:1
			}
		}
	});
		$('#custom-owl').owlCarousel({
		loop:true,
		margin:10,
		nav:true,
		autoplay:true,		
		responsive:{
			0:{
				items:1
			},
			600:{
				items:3
			},
			1000:{
				items:6
			}
		}
	});
  
 
         
         $(document).ready(function(){
         
         	$('.bottomtap-menu ul li').click(function(e){
         		e.preventDefault ()
         		$(this).addClass('active').siblings().removeClass('active');
         	});
         
         
         	$('.sitemapmenu').click(function(){
         		$('.fullfooter').addClass('show');
         	});
         
         	$('.closebbbtn').click(function(){
         		$('.fullfooter').removeClass('show');
         	});
         
         	$('.homeSliderss').owlCarousel({
         		loop:true,
         		margin:10,
         		nav:true,
         		responsive:{
         			0:{
         				items:1
         			},
         			600:{
         				items:3
         			},
         			1000:{
         				items:5
         			}
         		}
         	})
         
         });
         
         
         var slide = document.getElementById('sld-slides')
         var slideBtn1 = document.getElementById('tabid-1')
         var slideBtn2 = document.getElementById('tabid-2')
         var slideBtn3 = document.getElementById('tabid-3')
         var slideBtn4 = document.getElementById('tabid-4')
         var slideBtn5 = document.getElementById('tabid-5')
         var slideBtn6 = document.getElementById('tabid-6')
         var slideBtn7 = document.getElementById('tabid-7')
         var slideBtn8 = document.getElementById('tabid-8')
         var slideBtn9 = document.getElementById('tabid-9')
         
         slideBtn1.onclick = function(){
         	slide.style.transform = "translateX(0px)";
         }
         slideBtn2.onclick = function(){
         	slide.style.transform = "translateX(-100%)";
         }
         slideBtn3.onclick = function(){
         	slide.style.transform = "translateX(-200%)";
         }
         slideBtn4.onclick = function(){
         	slide.style.transform = "translateX(-300%)";
         }
         slideBtn5.onclick = function(){
         	slide.style.transform = "translateX(-400%)";
         }
         slideBtn6.onclick = function(){
         	slide.style.transform = "translateX(-500%)";
         }
         slideBtn7.onclick = function(){
         	slide.style.transform = "translateX(-600%)";
         }
         slideBtn8.onclick = function(){
         	slide.style.transform = "translateX(-700%)";
         }
         slideBtn9.onclick = function(){
         	slide.style.transform = "translateX(-800%)";
         };
		 
		 
		 
		 
		 
		 
		 
	