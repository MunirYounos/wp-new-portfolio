<?php
/**
 * Allow tags in TinyMCE
 * @since 1.0.0
 **/

function leafMedia_tinymce_enable_html($in) {
	$in['verify_html'] = false;
	return $in;
}

add_filter('tiny_mce_before_init', 'leafMedia_tinymce_enable_html' );



/**
 * Wrapper for oEmbeds
 * @since 1.0.1
 **/

function add_oembed_wrapper($html, $url, $attr) {
	return '<div class="media">' . $html . '</div>';
}

add_filter( 'embed_oembed_html', 'add_oembed_wrapper', 10, 3 );



/**
 * Remove special characters from uploaded files
 * @since 1.0.2
 * @param (string) $filename The name of the uploaded file
 **/

function leafMedia_sanitize_filename( $filename ) {

	$illegal_chars =  array(
		'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A', 'Å'=>'A', 'Æ'=>'A',
		'à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a', 'å'=>'a', 'æ'=>'a',
		'Þ'=>'B', 'þ'=>'b',
		'Ç'=>'C',
		'ç'=>'c',
		'È'=>'E', 'É'=>'E', 'Ê'=>'E', 'Ë'=>'E',
		'è'=>'e', 'é'=>'e', 'ê'=>'e', 'ë'=>'e',
		'Ì'=>'I', 'Í'=>'I', 'Î'=>'I', 'Ï'=>'I',
		'ì'=>'i', 'í'=>'i', 'î'=>'i', 'ï'=>'i',
		'Ñ'=>'N',
		'ñ'=>'n',
		'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O', 'Õ'=>'O', 'Õ'=>'o', 'Ö'=>'O', 'Ø'=>'O',
		'ò'=>'o', 'ó'=>'o', 'ô'=>'o', 'ð'=>'o', 'õ'=>'o', 'ö'=>'o', 'ø'=>'o',
		'Ù'=>'U', 'Ú'=>'U', 'Û'=>'U', 'Ü'=>'U',
		'ù'=>'u', 'ú'=>'u', 'û'=>'u', 'ü'=>'u',
		'Ý'=>'Y', 'ÿ'=>'y',
		'ý'=>'y', 'ÿ'=>'y',
		'ß'=>'Ss',
		'Š'=>'S',
		'š'=>'s',
		'Ž'=>'Z',
		'ž'=>'z'
	);

	$sanitized = str_replace( array_keys($illegal_chars), $illegal_chars, $filename);

	return $sanitized;
}

add_filter( 'sanitize_file_name', 'leafMedia_sanitize_filename', 10 );



/**
 * Allow SVG to be uploaded in WP Media Uploader
 * @since 1.0.2
 * @param (array) $mimes Array of supported mime types
 **/

function leafMedia_cc_mime_types( $mimes ) {
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
}

add_filter( 'upload_mimes', 'leafMedia_cc_mime_types' );



/**
 * Move Yoast SEO to bottom
 * @since 2.0.0
 **/

function move_yoast_to_bottom() {
	return 'low';
}

add_filter( 'wpseo_metabox_prio', 'move_yoast_to_bottom' );

?>
