jQuery(document).ready(function(){
	//navigation trigger
	$('.nav-toggle').click(function(e) {
			e.preventDefault();
			$('.nav--mobile').toggleClass('is-open');
			$('body').toggleClass('is-fixed');
		});

	//slider autoplay
	var speed = 500;
	var fadeInspeed =300;
	var autoswitch = true;
	var autoswitchspeed = 4000;

  //adding initial active class
	$('.slide').first().addClass('active');
	//next handler
	$('.slider__container__right-arrow').on('click', nextSlide);

	// left arrow functionality
	$('.slider__container__left-arrow').on('click', prevSlide);
  // auto play
	if (autoswitch ==true){
		setInterval(nextSlide, autoswitchspeed);
	}

	//function next slide-copy
	function nextSlide(){
		$('.active').removeClass('active').addClass('oldActive');

			if($('.oldActive').is(':last-child')){
				$('.slide').first().addClass('active');
			}else {
				$('.oldActive').next().addClass('active');
			}
			$('.oldActive').removeClass('oldActive');
			$('.active').fadeOut(speed);
			$('.active').fadeIn(fadeInspeed);
	};

	// function prev slide-copy

	function prevSlide(){
		$('.active').removeClass('active').addClass('oldActive');

			if($('.oldActive').is(':first-child')){
				$('.slide').last().addClass('active');
			}else {
				$('.oldActive').prev().addClass('active');
			}
			$('.oldActive').removeClass('oldActive');
			$('.active').fadeOut(speed);
			$('.active').fadeIn(fadeInspeed);
	};

	/**
		 * Slider
		 **/

		var $slider = $('.slider__list');

		// Iterate sliders
		$slider.each(function() {
			var isSingle = $(this).children().length > 1;

			// Settings from data attributes
			var sliderPause = 6000;
			var sliderSpeed = 4000;
			var animation = "fadeOut";

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
				dots: true,
				animateOut: animation
			});
			$( ".owl-prev").html('<span class="slider__left"><i class="fa fa-angle-left"></i></span>');
	    $( ".owl-next").html('<span class="slider__right"><i class="fa fa-angle-right"></i></span>');
		});


		// Add smooth scrolling to all links
	$("a").on('click', function(event) {
		if (this.hash !== "") {
			event.preventDefault();
			var hash = this.hash;
			$('html, body').animate({
				scrollTop: $(hash).offset().top
			}, 2000, function(){
				var lhash = window.location.hash;
				lhash = hash;
			});
		} // End if
	});


});


//vanila scripts

(function(){
	//selecting the node
	var myNode = document.querySelector('#gallery div.container div.gallery');
	myNode.addEventListener("click", function(e){
		if(e.target.tagName === "IMG"){
			var myOverlay = document.createElement('div');
			myOverlay.id = "myFancyOverlay";
			document.body.appendChild(myOverlay);
			//styles setup
			myOverlay.style.position ='absolute';
			myOverlay.style.top =0;
			myOverlay.style.zIndex =999;
			myOverlay.style.backgroundColor = 'rgba(0,0,0,0.5)';
			myOverlay.style.cursor = 'pointer';

			//hieght and width of the ovelry
			myOverlay.style.width = window.innerWidth + 'px';
			myOverlay.style.height = window.innerHeight + 'px';
			myOverlay.style.top = window.pageYOffset + 'px';
			myOverlay.style.left = window.pageXOffset + 'px';

			var imageSRC = e.target.src;
			var largeImage = document.createElement('img');
			largeImage.id = 'largeImage';
			largeImage.src = imageSRC.substr(0, imageSRC.length - 7) + '.jpg';
			largeImage.style.display = 'block';
			largeImage.style.position = 'absolute';
			// wait untill the image has loaded

			largeImage.addEventListener('load', function(){
				//resize image if taller
				if(this.height > window.innerHeight){
					this.ratio = window.innerHeight / this.height;
					this.height = this.height * this.ratio;
					this.width = this.width * this.ratio;
				}

				//resize if wider
				if(this.width > window.innerWidth){
					this.ratio = window.innerWidth / this.width;
					this.height = this.height * this.ratio;
					this.width = this.width * this.ratio;
				}
				centerImage(this);
				myOverlay.appendChild(largeImage);
			});//image has loaded

			largeImage.addEventListener('click', function(){
				if(myOverlay){
					myOverlay.parentNode.removeChild(myOverlay);
				}
			}, false);

			window.addEventListener('scroll', function(){
				if(myOverlay){
					myOverlay.style.top = window.pageYOffset + 'px';
					myOverlay.style.left = window.pageXOffset + 'px';
					myOverlay.styl.zIndex = 999;
				}
			}, false);

			window.addEventListener('resize', function(){
				if(myOverlay){
					myOverlay.style.width = window.innerWidth + 'px';
					myOverlay.style.height = window.innerHeight + 'px';
					myOverlay.style.top = window.pageYOffset + 'px';
					myOverlay.style.left = window.pageXOffset + 'px';
				}
			}, false);
		};//image is targetet
	}, false);

	function centerImage (theImage) {
		var myCenterImageX = (window.innerWidth - theImage.width)/2;
		var myCenterImageY = (window.innerHeight - theImage.height)/2;

		theImage.style.top = myCenterImageY + 'px';
		theImage.style.left = myCenterImageX + 'px';
		return theImage;
	}
})();//self excuting function
