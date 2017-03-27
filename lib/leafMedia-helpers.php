<?php
/**
 * atriumWeb helpers
 * @since 1.1.0
 **/


/**
 * Get regular title or ACF
 * @since 1.0.1
 * @param  mixed  $id The ID of the post
 * @return string The title
 **/

function get_leafMedia_title( $id = null  ) {

	if ( is_null($id) ) {
		global $post;
		$id = $post->ID;
	}

	$acf_title = get_field('page_title', $id);

	return ($acf_title) ? $acf_title : get_the_title( $id );
}



/**
 * Get company info from ACF Options Page
 * The fields are prefixed with 'company_'
 * @since 1.1.0
 **/

function get_company_info( $field_id = null ) {

	if ( is_null($field_id) ) {
		return __('You have to give $field_id (row-id from acf)', 'leafMedia');
	}

	$field = get_field($field_id, 'options');

	if ( empty($field) ) {
		return __('Row is not found', 'leafMedia');
	}

	return $field;
}



/**
 * Locate template
 * @since 1.1.0
 **/

function leafMedia_locate_template( $template_name, $template_path = '' ) {
	if ( $template_path !== '' ) {
		$template_path = TEMPLATEPATH . '/partials/';
	}

	// Look within passed path within the theme - this is priority
	$template = locate_template( $template_path . $template_name . '.php');

	// Get default template
	if ( ! $template ) {
		$template = $template_path . $template_name . '.php';
	}

	// Return what we found
	return $template;
}



/**
 * Get template
 * @since 1.1.0
 **/

function leafMedia_get_template( $template_name, $args = array(), $echo = false, $template_path = '' ) {
	if ( $args && is_array( $args ) ) {
		extract( $args );
	}

	$located = atframe_locate_template( $template_name, $template_path );

	if ( ! file_exists( $located ) ) {
		_doing_it_wrong( __FUNCTION__, sprintf( '<code>%s</code> does not exist.', $located ), '1.0' );
		return;
	}

	if ( $echo != false ) {
		return include( $located );
	}	else {
		ob_start();
		include( $located );
		return ob_get_clean();
	}

	return __('something go wrong...', 'leafMedia');
}


/**
 * Get formatted phone number
 * @since  2.0.0
 * @param  string $str The phone number to format
 * @return string $str The formatted phone number
 **/

function get_formatted_phone($str) {

	// Remove +45
	$str = str_replace('+', '00', $str);

	// Only allow integers
	$str = preg_replace('/[^0-9]/s', '', $str);

	return $str;
}


/**
 * Get svg icons for direct embedding
 * @since  2.0.0
 * @param  string  $url        The url of the icon
 * @param  bool    $from_theme Prepend the template directory url
 * @return string  $icon       The content of the svg
 **/

function get_svg_icon( $url = '', $from_theme = false ) {

	// Bail early if no url available
	if ( $url === '' ) {
		return 'no-url';
	}

	// Retrieve icon from theme or url
	if ( $from_theme ) {
		$path = get_template_directory() . '/assets/images/';
		$icon = $path . $url . '.svg';
	} else {
		$extension = pathinfo($url, PATHINFO_EXTENSION);

		// Make sure we are dealing with an svg file
		if ( $extension === 'svg' ) {
			$icon = $url;
		} else {
			return 'not-svg';
		}
	}

	return ( file_exists( $icon ) ) ? file_get_contents( $icon ) : 'no-icon';
}



 ?>
