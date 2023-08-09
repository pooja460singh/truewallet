/*
*****************************************************
*	CUSTOM JS DOCUMENT                              *
*	Single window load event                        *
*   "use strict" mode on                            *
*****************************************************
*/

$(window).on("load", function() {

	"use strict";

	
	var preLoader = $('.preloader');
	var countNumber= $(".count-number");
	var MixItUp1 =  $('#MixItUp1');
	var fancybox =  $('.fancybox');
	var fancybox =  $('.fancybox');
	var faqsAccordion =  $('#faqs-accordion');
	var waTabBtn= $('.wa-tabs .tab-btn');
	var waTabContainer= $('.wa-tabs .tab');
		
// ============================================
// PreLoader On window Load
// =============================================
	
	preLoader.addClass('loaderout');
	
// ============================================
// Fun Factor / Counter
// =============================================	

	countNumber.appear(function() {
		$(this).each(function() {
			var datacount = $(this).attr('data-count');
			$(this).find('.counter').delay(6000).countTo({
				from: 10,
				to: datacount,
				speed: 3000,
				refreshInterval: 50,
			});
		});
	});	
	
//============================================
// MixItUp settings
//============================================

	if(MixItUp1.length){    
		  MixItUp1.mixItUp({
				  selectors: {
				  filter: '.filter-1'
			  }
		  });
	}

  
	
//=========================================
// Tabs
//=========================================			
	
	if(waTabBtn.length){
		waTabBtn.on('click', function(e) {
			e.preventDefault();
			var target = $($(this).attr('href'));
			waTabBtn.removeClass('active-btn');
			$(this).addClass('active-btn');
			waTabContainer.fadeOut(0);
			waTabContainer.removeClass('active-tab');
			$(target).fadeIn(500);
			$(target).addClass('active-tab');
		});
		
	}
	
	
//========================================
// Accordion 
//======================================== 	
	
	if(faqsAccordion.length) {
	      faqsAccordion.accordion();
	}
//========================================
// LightBox / Fancybox
//======================================== 	
	
	if(fancybox.length) {
	     fancybox.fancybox();
	}
	
//***************************************
// Map initialization function Calling
//****************************************
 
	initMap(); 
 
 
//***************************************
// All Owl Carousel function Calling
//****************************************
 
	owlCarouselInit();  
 
 
}); 		// End of the window load event


//***************************************
// Contact Page Map
//****************************************  

 function initMap() {
	 "use strict";
	
   var mapDiv = $('#gmap_canvas');	
   
   if (mapDiv.length) {  
     var myOptions = {
         zoom: 10,
         center: new google.maps.LatLng(-37.81614570000001, 144.95570680000003),
         mapTypeId: google.maps.MapTypeId.ROADMAP
     };
     var map = new google.maps.Map(document.getElementById('gmap_canvas'), myOptions);
     var marker = new google.maps.Marker({
         map: map,
         position: new google.maps.LatLng(-37.81614570000001, 144.95570680000003)
     });
     var infowindow = new google.maps.InfoWindow({
         content: '<strong>Envato</strong><br>Envato, King Street, Melbourne, Victoria<br>'
     });
     google.maps.event.addListener(marker, 'click', function() {
         infowindow.open(map, marker);
     });
	 
     infowindow.open(map, marker);
   }
   
 }
 
 
/* ---------------------	
	All owl Carousels 
/* --------------------- */
function owlCarouselInit() {
	
	"use strict";	
	
	//==========================================
	// owl carousels settings
	//===========================================
    
	var home1MainSlider = $('#home1-main-slider');
	var testimonialSection1 = $('#testimonial-section1');
	var testimonialSection2 = $('#testimonial-section2');
	var testimonialSidebar = $('#testimonial-sidebar');
	var waProductSidebar = $('#wa-product-sidebar');	
	var serviceCarousel1 = $('#service-carousel1');
	var processCarousel = $('#process-carousel');
	var couponCarousel = $("#coupon-carousel");
	var teamCarousel = $("#team-carousel");
	var homeBlogCarousel = $("#home-blog-carousel");
	var waPartnerCarousel = $('.wa-partner-carousel');
	
	
	if (home1MainSlider.length) {    
		  home1MainSlider.owlCarousel({ 		   
			  autoPlay: true, 
			  items : 1,
			  singleItem:true,
			  navigation:true,
			  pagination:true,
		 
		  }); 
	} 
	
	if (testimonialSection1.length) {    
		  testimonialSection1.owlCarousel({ 		   
			  autoPlay: true, 
			  items : 1,
			  singleItem:true,
			  navigation:true,
			  pagination:false,
		 
		  }); 
	} 
	
	if(testimonialSection2.length){	 
		 testimonialSection2.owlCarousel({		 
			  autoPlay: false, 
			  items : 3,
			  navigation:true,
			  pagination:false,
			  temsDesktop : [1199,3],
			  itemsDesktopSmall : [979,3] 
			  
		});
    }	
	
	if (testimonialSidebar.length) {    
		  testimonialSidebar.owlCarousel({ 		   
			  autoPlay: true, 
			  items : 1,
			  singleItem:true,
			  navigation:false,
			  pagination:true,
		 
		  }); 
	} 
	
	if (waProductSidebar.length) {    
		  waProductSidebar.owlCarousel({ 		   
			  autoPlay: true, 
			  items : 1,
			  singleItem:true,
			  navigation:false,
			  pagination:true,
		 
		  }); 
	} 
	
	if(serviceCarousel1.length){	 
		 serviceCarousel1.owlCarousel({		 
			  autoPlay: false, 
			  items : 3,
			  navigation:true,
			  pagination:false,
			  temsDesktop : [1199,3],
			  itemsDesktopSmall : [979,3] 
			  
		});
    }	
	
	if(processCarousel.length){	 
		 processCarousel.owlCarousel({		 
			  autoPlay: false, 
			  items : 3,
			  navigation:true,
			  pagination:false,
			  temsDesktop : [1199,3],
			  itemsDesktopSmall : [979,3] 
			  
		});
    }		

	if (couponCarousel.length) {
		couponCarousel.owlCarousel({ 
		  autoPlay: false, 
		  items : 4,
		  itemsDesktop : [1199,3],
		  itemsDesktopSmall : [979,3],
		  navigation:true,
		  pagination:false       
	 
	  });
	}
	if (teamCarousel.length) {
		teamCarousel.owlCarousel({ 
		  autoPlay: false, 
		  items : 4,
		  itemsDesktop : [1199,3],
		  itemsDesktopSmall : [979,3],
		  navigation:true,
		  pagination:false       
	 
	  });
	}
	if(homeBlogCarousel.length){	 
		 homeBlogCarousel.owlCarousel({		 
			  autoPlay: false, 
			  items : 3,
			  navigation:true,
			  pagination:false,
			  itemsDesktop : [1199,3],
			  itemsDesktopSmall : [979,3] 
			  
		});
    }
	
  	if (waPartnerCarousel.length) {
		waPartnerCarousel.owlCarousel({ 
		  autoPlay: false, 
		  items : 4,
		  itemsDesktop : [1199,4],
		  itemsDesktopSmall : [979,3],
		  margin:5,
		  navigation:true,
		  pagination:false       
	 
	  });
	}

	
}