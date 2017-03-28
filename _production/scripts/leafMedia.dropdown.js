/**
 * Dropdown toggle
 * @since 1.0.0a
 **/ 

$.fn.atDropdown = function() {
	return this.each(function() {
		var menu = $(this);
		menu.find('.has-dropdown > a').bind('click', function(e) {
			
			// If element has dropdown
			if ($(this).parent().hasClass('has-dropdown')) {
				e.preventDefault();
				
				// If dropdown is open
				if ($(this).parent().hasClass('is-open')) {
					$(this).parent().removeClass('is-open');
					$(this).parent().find('.nav__dropdown').attr('aria-hidden', 'true');
				} else {
					$(this).parent().parent().find('.is-open').removeClass('is-open');
					$(this).parent().addClass('is-open');
					$(this).parent().find('.nav__dropdown').attr('aria-hidden', 'false');
				}
			} else {
				$(this).parent().parent().find('.is-open').removeClass('is-open');
				$(this).parent().parent().find('.nav__dropdown').attr('aria-hidden', 'true');
			}
		});

		$(document).click(function(e) {
			if (e.target !== menu.get(0) && 0 === menu.find($(e.target)).length ) {
				menu.find('.nav__dropdown').attr('aria-hidden', 'true');
				menu.find('.is-open').removeClass('is-open');
			}
		});
	});
};