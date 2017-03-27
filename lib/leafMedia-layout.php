<?php 
/**
 * Helper functions for ACF Flexible Content
 * @since 1.1.0
 **/ 


/**
 * Get section settings attributes as string
 * @since  2.0.0
 * @param  string $prefix      A prefix to retrieve fields (used for Clone field types)
 * @param  string $extra_class Extra classes to prepend
 * @return string $attributes  A string of attributes
 **/ 

function get_section_attributes($prefix = '', $extra_class = null) {

	// Prepare
	$attributes = '';
	$classes = [];


	/**
	 * Classes
	 **/ 

	// Extra class included programmatically	
	if ( !is_null($extra_class) )
		$classes[] = $extra_class;

	// Background
	$background = get_sub_field($prefix . 'background');
	if ( $background && $background !== 'none' )
		$classes[] = "section--$background";

	// Padding placement
	$padding = get_sub_field($prefix . 'padding_type');
	if ( $padding && $padding !== 'both' )
		$classes[] = "padding--$padding";

	// Padding size
	if ( $padding_size = get_sub_field($prefix . 'padding_size') )
		$classes[] = "section--$padding_size";

	// Custom classes (backend)
	if ( $custom_class = get_sub_field($prefix . 'class') )
		$classes[] = $custom_class;



	/**
	 * ID attribute
	 **/ 

	$id = (get_sub_field($prefix . 'id')) ?: 'section-' . get_row_index();


	/**
	 * Background image
	 **/ 

	if ( $background === 'image' ) {
		$background_image = get_sub_field($prefix . 'background_image');
		$classes[] = 'bg--cover';
		$attributes .= 'style="background-image: url(' . $background_image['url'] . ');"';
	}

	/**
	 * Create string
	 **/ 

	$attributes .= ' class="' . get_classes_from_array($classes) . '"';
	$attributes .= ' id="' . $id . '"';

	return $attributes;
}



/**
 * Get column attributes string
 * @since  2.0.0
 * @param  array  $column      An array of column fields
 * @param  string $extra_class Extra classes to prepend
 * @return string $attributes  A string of attributes
 **/ 

function get_column_attributes($column, $extra_class = null) {

	// Prepare
	$attributes = '';
	$classes    = [];


	/**
	 * Classes
	 **/ 

	// Column class
	if ( isset($column['width']) && isset($column['breakpoint']) )
		$classes[] = get_column_class($column['width'], $column['breakpoint']);

	// Extra class included programmatically
	if ( !is_null($extra_class) )
		$classes[] = $extra_class;

	// Custom class from backend
	if ( isset($column['class']) && $column['class'] !== '' )
		$classes[] = $column['class']; 

	$attributes .= 'class="' . get_classes_from_array($classes) . '"';


	/**
	 * ID
	 **/ 

	if ( isset($column['id']) && $column['id'] !== '' )
		$attributes .= ' id="' . $column['id'] . '"';


	return $attributes;
}


/**
 * Get section title
 * @since  2.0.0
 * @param  string $prefix      A prefix to retrieve fields (used for Clone field types)
 * @param  string $extra_class An extra class to append
 * @return string $title       The formatted title
 **/ 

function get_section_title($prefix = '', $extra_class = null) {

	// Prepare
	$title   = '';
	$classes = [];

	// Retrieve fields
	$type      = get_sub_field($prefix . 'type');
	$text      = get_sub_field($prefix . 'text');
	$classes[] = get_sub_field($prefix . 'class');

	// Bail early if no text available
	if ( !$text || $text === '' ) {
		return '';
	}

	if ( !is_null($extra_class) ) {
		$classes[] = $extra_class;
	}

	$classes = ($classes) ? ' class="' . get_classes_from_array($classes) . '"' : '';

	$title = "<$type $classes>$text</$type>";

	return $title;
}


/**
 * Get column class
 * @since  1.1.0
 * @param  string $columns Number of columns
 * @param  string $bp      The breakpoint
 * @return string          A column class
 **/ 

function get_column_class($columns = '6', $bp = 'sm') {
	return 'col-' . $bp . '-' . $columns;
}



/**
 * Transform array of strings to valid HTML classes
 * @since 1.1.0
 * @param  array $classes Array of strings
 * @return string         Space-spearated string of class names
 **/ 

function get_classes_from_array($classes) {
	if ( is_array($classes) && !empty($classes) ) {
		// Remove empty values
		$classes = array_filter( array_map( 'trim', $classes ), 'strlen' );
		return implode(' ', $classes);
	}

	return '';
}

 ?>