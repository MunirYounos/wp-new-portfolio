/**
 * Google Maps with ACF
 * http://www.advancedcustomfields.com/resources/google-map/
 * ================================================== */ 

(function($) {


	// Settings from data-attributes
	var settings = $('.js-maps').data();


	/**
	 * new_map
	 * This function will render a Google Map onto the selected jQuery element
	 * @param	$el (jQuery element)
	 * @return	n/a
	 **/

	function new_map( $el ) {
		
		// Marker selector
		var $markers = $el.find('.marker');
		
		// Center map on resize
		google.maps.event.addDomListener(window, 'resize', function() {
			var center = map.getCenter();
			google.maps.event.trigger(map, 'resize');
			map.setCenter(center);
		});


		// Configuration
		var args = {
			zoom		: settings.zoom,
			center		: new google.maps.LatLng(0, 0),
			mapTypeId	: google.maps.MapTypeId.ROADMAP,
			scrollwheel : settings.scrollwheel || false,
			draggable	: settings.draggable || false,
			disableDoubleClickZoom: settings.disabledoubleclickzoom || false,
			styles		: settings.styles || [],
		};
		
		
		// Create new map       	
		var map = new google.maps.Map( $el[0], args);
		
		
		// Add reference to markers
		map.markers = [];
		
		
		// Add markers
		$markers.each(function(){
			
	    	add_marker( $(this), map );
			
		});
		
		
		// Center newly created map
		center_map( map );
		
		
		// Return map
		return map;
		
	}


	/**
	 * add_marker
	 * This function will add a marker to the selected Google Map
	 * @param	$marker (jQuery element)
	 * @param	map (Google Map object)
	 * @return n/a
	 **/

	function add_marker( $marker, map ) {

		// Position
		var latlng = new google.maps.LatLng( $marker.attr('data-lat'), $marker.attr('data-lng') );

		// Custom marker
		var markerIcon = settings.marker;

		if ( typeof markerIcon !== 'undefined' ) {
			var icon = markerIcon
		} else {
			var icon = {
				path				: google.maps.SymbolPath.CIRCLE,
				fillOpacity		: 1,
				fillColor		: settings.colorInner,
				strokeColor		: settings.color,
				scale				: settings.size,
			}
		}

		// Create marker
		var marker = new google.maps.Marker({
			position	: latlng,
			map			: map,
			icon        : icon,
		});

		// Add marker to array
		map.markers.push( marker );

		// If marker contains HTML, add it to an infoWindow
		if ( $marker.html() ) {
			// Create info window
			var infowindow = new google.maps.InfoWindow({
				content		: $marker.html()
			});

			// Show info window when marker is clicked
			google.maps.event.addListener(marker, 'click', function() {

				infowindow.open( map, marker );

			});
		}

	}


	/**
	 * center_map
	 * This function will center the map, showing all markers attached to this map
	 * @param	map (Google Map object)
	 * @return n/a
	 **/

	function center_map( map ) {

		// vars
		var bounds = new google.maps.LatLngBounds();

		// loop through all markers and create bounds
		$.each( map.markers, function( i, marker ){

			var latlng = new google.maps.LatLng( marker.position.lat(), marker.position.lng() );

			bounds.extend( latlng );

		});

		// only 1 marker?
		if ( map.markers.length == 1 )	{
			// set center of map
		    map.setCenter( bounds.getCenter() );
		    map.setZoom( settings.zoom );

		}	else	{
			// fit to bounds
			map.fitBounds( bounds );
		}

	}

	/**
	 * document ready
	 * This function will render each map when the document is ready (page has loaded)
	 * @param	n/a
	 * @return	n/a
	 **/
	
	// Global map variable
	var map = null;

	$(document).ready(function(){

		$('.js-maps').each(function(){

			// Create new map for each maps selector
			map = new_map( $(this) );

		});

	});

})(jQuery);