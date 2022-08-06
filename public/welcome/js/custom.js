$(document).ready(function(){
$('.mobile_menu').click(function(){
$('nav#menu').css('display','block')
});
});
 	
        
 
$(document).ready(function(){
$(".closee_two").click(function(){
  $(".bubble-info").toggle();
});

$('#similar-hot').owlCarousel({
loop:true,
margin:20,
nav:false,
autoplay:true,		
responsive:{
	0:{
		items:1
	},
	600:{
		items:3
	},
	1000:{
		items:4
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

$('#view-list').owlCarousel({
loop:true,
margin:2,
nav:false,
autoplay:true,		
responsive:{
	0:{
		items:1
	},
	600:{
		items:2
	},
	1000:{
		items:2
	}
}
});


});


$(document).ready(function(){
	$('.crossbtnLinks1').click(function(){
		$('.ul_links1').toggleClass('sldTop');
		$('.navigationsall .rowD .col_41').toggleClass('bg');
	});

	$('.crossbtnLinks2').click(function(){
		$('.ul_links2').toggleClass('sldTop');
		$('.navigationsall .rowD .col_42').toggleClass('bg');
	});
	$('.crossbtnLinks3').click(function(){
		$('.ul_links3').toggleClass('sldTop');
		$('.navigationsall .rowD .col_43').toggleClass('bg');
	});
	$('.crossbtnLinks4').click(function(){
		$('.ul_links4').toggleClass('sldTop');
		$('.navigationsall .rowD .col_44').toggleClass('bg');
	});
});

$(document).ready(function(){
	$('.toppHeader .headertop .btn-toggle2').click(function(){
		$('.navigationsall').show();
	});
	$('.crossbtnlink').click(function(){
		$('.navigationsall').hide();
		location.reload();
	});
	$('.togglebtn').click(function(){
		$('.navigationsall').show();
	});
	$(document).foundation();
});


$(window).scroll(function() {
	if ($(this).scrollTop() > 50){  
		$('body').addClass("sticky");
	}
	else{
		$('body').removeClass("sticky");
	}
});


! function ($) {
	var box = $('.thumbs-block'),
	innerBox = $('.thumbs'),
	lastElement = innerBox.find('.fancybox:last-child');

	var offsetPx = 100;
	var boxOffset = box.offset().left;

	var boxWidth = box.width();
	var innerBoxWidth = (lastElement[0].offsetLeft + lastElement.outerWidth(true)) - boxOffset /* + (offsetPx*2)*/;

	scrollDelayTimer = null;
	box.mousemove(function (e) {
		console.log('boxWidth: ' + boxWidth + '   innerBoxWidth: ' + innerBoxWidth + '   box.scrollLeft(): ' + box.scrollLeft());

		var mouseX = e.pageX;
		var boxMouseX = mouseX - boxOffset;

		if ((boxMouseX > offsetPx) && (boxMouseX < (boxWidth - offsetPx))) {
			var left = (boxMouseX * (innerBoxWidth - boxWidth) / boxWidth);

			clearTimeout(scrollDelayTimer);
			scrollDelayTimer = setTimeout(function () {
				scrollDelayTimer = null;
				box.stop().animate({
					"scrollLeft": left
				}, {
					queue: false,
					duration: 500,
					easing: 'linear'
				});
			}, 10);
		}
	});

}(window.jQuery);

$(document).ready(function(){
	$('.toppHeader .headertop .btn-toggle2').click(function(){
		$('.navigationsall').show();
	});
});






