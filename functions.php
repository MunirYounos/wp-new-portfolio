<?php
/**
 * leafMedia framework functions
 **/

define( 'ATFRAME_DEBUG', true );
define( 'TYPEKIT_ID', 'saz4nfw' );
define( 'GOOGLE_MAPS_KEY', null );

require_once 'lib/leafMedia-framework.php';



/**
 * ACF Options Page
 * @since 1.0.1
 **/

if ( function_exists('acf_add_options_page') && function_exists('acf_add_options_sub_page') ) {

	$parent = acf_add_options_page( array(
		'page_title'   => 'General content',
		'menu_title'   => 'General content',
		'menu_slug'    => 'general_content',
		'capability'   => 'edit_posts',
		'redirect'     => false,
		'position'     => '3.3'
	));

	acf_add_options_sub_page( array(
		'page_title'   => 'Social',
		'menu_title'   => 'Social',
		'parent_slug'  => $parent['menu_slug'],
		'capability'   => 'manage_options',
	));

	acf_add_options_sub_page( array(
		'page_title'   => 'Analysis and statistics',
		'menu_title'   => 'Analysis and statistics',
		'parent_slug'  => $parent['menu_slug'],
		'capability'   => 'manage_options',
	));

}



/**
 * Script and style registration
 * @since 1.0.0
 **/

function register_scripts() {

	// Add .min-extension when not debugging
	$postfix = ( defined( 'LEAFMEDIA_DEBUG' ) && LEAFMEDIA_DEBUG === true ) ? '' : '.min';


	/**
	 * Stylesheets
	 **/

	// wp_enqueue_style( 'google-fonts', 'URL', false, null );
	// wp_enqueue_style( 'ionicons', 'https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css', false, null );
	wp_enqueue_style( 'fontawesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css', false, null );
	wp_enqueue_style( 'main-css', get_template_directory_uri() . '/assets/css/main' . $postfix . '.css', false, null );


	/**
	 * JavaScript
	 * Defer and async attributes can be set in lib/utilities.php
	 **/

	if (!is_admin()) {
		wp_deregister_script( 'jquery' );
		wp_register_script( 'jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js', array(), null, true );
	}

	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'main-js', get_template_directory_uri() . '/assets/scripts/main' . $postfix . '.js', array('jquery'), null, true );

	// Add Google Maps API to contact page
	if ( defined( 'GOOGLE_MAPS_KEY' ) && GOOGLE_MAPS_KEY !== null && is_page_template('templates/page-contact.php') ) {
		wp_enqueue_script( 'google-maps', 'https://maps.googleapis.com/maps/api/js?key=' . GOOGLE_MAPS_KEY, array('jquery'), null, true );
	}

}

add_action('wp_enqueue_scripts', 'register_scripts', 100);



/**
 * Typekit enqueueing
 * Define TYPEKIT_ID constant in top of this document
 * Enqueueing and caching functions are placed in lib/utilities.php
 * @since 1.0.3
 **/

if ( defined( 'TYPEKIT_ID' ) && TYPEKIT_ID !== null ) {
	add_action('wp_footer', 'enqueue_typekit_with_cache');
}



/**
 * Google Maps API key for ACF
 * @since 2.0.0
 **/

if ( defined( 'GOOGLE_MAPS_KEY' ) && GOOGLE_MAPS_KEY !== null ) {
	function add_google_maps_key_to_acf() {
		acf_update_setting('google_api_key', GOOGLE_MAPS_KEY);
	}

	add_action('acf/init', 'add_google_maps_key_to_acf');
}



/**
 * Menu registration
 * @since 1.0.0
 **/

function register_menus() {
	register_nav_menus(
		array(
			'primary-nav'  => __( 'Primary menu', 'leafMedia' )
		)
	);
}

add_action( 'after_setup_theme', 'register_menus' );



/**
 * Add image sizes
 * @since 1.0.0
 * @link https://developer.wordpress.org/reference/functions/add_image_size/
 **/

// Image sizes
// add_image_size('name', width, height, crop);
add_image_size('testimonial', 300, 500, true);


// Add created images sizes to dropdown in WP control panel
// add_filter( 'image_size_names_choose', 'custom_image_sizes' );

// function custom_image_sizes( $sizes ) {
// 	return array_merge( $sizes, array(
// 		'image_size_name' => __( 'Text in dropdown' )
// 	) );
// }



/**
 * Gravity forms
 * @since 1.0.1
 **/

// Load scripts in footer
add_filter( 'gform_init_scripts_footer', '__return_true' );

// Scroll to form if it contains errors
add_filter( 'gform_confirmation_anchor', '__return_true' );



/**
 * Custom excerpt length
 * @since 1.0.0
 **/

function custom_excerpt_length( $length ) {
	return 20;
}

add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );



/**
 * Custom excerpt text
 **/

function custom_excerpt_more( $more ) {
	return '&hellip;';
}

add_filter('excerpt_more', 'custom_excerpt_more');

?>
