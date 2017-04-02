jQuery(document).ready(function($){

	/**
	 * Navigation
	 **/

	$('.nav__list').atDropdown();

	$('.nav-toggle').click(function(e) {
		e.preventDefault();
		$('.nav--mobile').toggleClass('is-open');
		$('body').toggleClass('is-fixed');
	});
		/**
		* Sticky Navigation
		**/

		var stickyNavTop = $('.header__nav').offset().top;

		$(window).scroll(function(){
			var scrollTop = $(window).scrollTop();

			if(scrollTop > stickyNavTop) {
				$('.header__nav').addClass('sticky-header');
				$('.header').addClass('shifted');
			} else {
				$('.header__nav').removeClass('sticky-header');
				$('.header').removeClass('shifted');
			}
		});

		// Add smooth scrolling to all links
		  $("a").on('click', function(event) {

		    // Make sure this.hash has a value before overriding default behavior
		    if (this.hash !== "") {
		      // Prevent default anchor click behavior
		      event.preventDefault();

		      // Store hash
		      var hash = this.hash;
					console.log(hash);
		      // Using jQuery's animate() method to add smooth page scroll
		      // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
		      $('html, body').animate({
		        scrollTop: $(hash).offset().top
		      }, 2000, function(){

		        // Add hash (#) to URL when done scrolling (default click behavior)
		        window.location.hash = hash;
		      });
		    } // End if
		  });





	/**
	 * Slider
	 **/

	var $slider = $('.slider__list');

	// Iterate sliders
	$slider.each(function() {
		var isSingle = $(this).children().length > 1;

		// Settings from data attributes
		var sliderPause = $(this).data('pause');
		var sliderSpeed = $(this).data('speed');
		var animation = $(this).data('animation');

		// owlCarousel
		$(this).owlCarousel({
			items: 1,
			loop: isSingle,
			autoplay: isSingle,
			mouseDrag: isSingle,
			touchDrag: isSingle,
			autplaySpeed: sliderSpeed,
			autoplayTimeout: sliderPause,
			smartSpeed: sliderSpeed,
			navSpeed: sliderSpeed,
			nav:true,
			dots: false,
			animateOut: animation
		});
		$( ".owl-prev").html('<span class="slider__left"><i class="fa fa-angle-left"></i></span>');
    $( ".owl-next").html('<span class="slider__right"><i class="fa fa-angle-right"></i></span>');
	});


	/**
	 * Mixitup
	 **/

	 // Use filter
	if (window.location.hash.substr(1) == "") {
			var filter = "all";
	} else {
		var filter = "."+window.location.hash.substr(1);
	}

	var $mixitup = $('.mixitup__wrapper');

	if ( $mixitup.length ) {
		var mixer = mixitup($mixitup, {
		    load: {
		        filter: filter
		    },
				animation: {
					animateResizeTargets: true
				},
		});
	};
	/**
	 * grid - masonry
	 **/

	$('.grid').masonry({
	  itemSelector: '.grid-item',
	  columnWidth:280
	});

	/**
	 * Gallery - Fancybox
	 **/

	$('.js-zoom').fancybox({
		helpers: {
			title: {
				type: 'inside'
			},
			overlay: {
				locked: false
			},
			thumbs: {
					width: 50,
					height: 50,
					source: function(current) {
						return $(current.element).data('thumbnail');
					},
				}
		}
	});



	/**
	 * Add semi-responsive wrapper to entry tables
	 **/

	$('.entry table').wrap('<div class="table-wrapper">');

});



$(window).load(function() {

	/**
	 * Lazy loading
	 **/

	var lazy = new Blazy({
		selector: '.lazy',
		offset: 100,
		successClass: 'has-loaded'
	});



	// /**
	//  * Facebook feed - responsive
	//  **/

	// var $feedContainer = $('#facebook-feed');
	// var $feed = $('.fb-page');
	// var wW = $(window).width();

	// if ( $feedContainer.length && typeof window.FB !== 'undefined' ) {

	// 	var $parseFeed = $feedContainer.get(0);

	// 	// Set up throttled resize and update data attribute with new width, then parse
	// 	$(window).smartresize( function() {
	// 		if ( $(window).width() !== wW ) {

	// 			// Set up appropriate width
	// 			var feedWidth = $feedContainer.width();
	// 			feedWidth = (feedWidth > 500) ? 500 : feedWidth;
	// 			$feed.attr('data-width', feedWidth);

	// 			// Parse Facebook feed after 150 ms
	// 			setTimeout(function(){
	// 				FB.XFBML.parse($parseFeed);
	// 			}, 150);

	// 		}
	// 	});
	// }

});
