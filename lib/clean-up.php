<?php
/**
 * WordPress clean up
 **/


/**
 * Add and remove body_class() classes
 * @since 1.0.0
 **/

function leafMedia_body_classes($classes) {

	// Browser specific classes based on user agent globals
	global $is_gecko, $is_IE, $is_opera, $is_safari, $is_chrome, $is_iphone, $post;

	if ($is_gecko)					$classes[] = 'is-gecko';
	elseif ($is_opera)			$classes[] = 'is-opera';
	elseif ($is_safari)			$classes[] = 'is-safari';
	elseif ($is_chrome)			$classes[] = 'is-chrome';
	elseif ($is_IE) 				$classes[] = 'is-ie';
	elseif ($is_iphone) 			$classes[] = 'is-iphone';
	else 								$classes[] = 'is-unknown';

	if (!is_front_page())		$classes[] = 'is-not-home';

	// Add post/page slug if not present and template slug
	if (is_single() || is_page() && !is_front_page()) {
		if (!in_array(basename(get_permalink()), $classes)) {
			$classes[] = basename(get_permalink());
		}
		$classes[] = str_replace('.php', '', basename(get_page_template()));
	}

	// Remove unnecessary classes
	$home_id_class = 'page-id-' . get_option('page_on_front');
	$remove_classes = array(
		'page-template-default',
		$home_id_class
	);

	$classes = array_diff($classes, $remove_classes);

	return $classes;
}

add_filter('body_class', 'leafMedia_body_classes');



/**
 * Remove emoji scripts and styles
 * @since 1.0.0
 **/

remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );



/**
 * Clean up output of stylesheet <link> tags
 * @since 1.0.0
 **/

function leafMedia_clean_style_tag($input) {
	preg_match_all("!<link rel='stylesheet'\s?(id='[^']+')?\s+href='(.*)' type='text/css' media='(.*)' />!", $input, $matches);
	// Only display media if it is meaningful
	$media = $matches[3][0] !== '' && $matches[3][0] !== 'all' ? ' media="' . $matches[3][0] . '"' : '';
	return '<link rel="stylesheet" href="' . $matches[2][0] . '"' . $media . '>' . "\n";
}

add_filter('style_loader_tag', 'leafMedia_clean_style_tag');



/**
 * Clean up output of <script> tags
 * @since 1.0.0
 **/

function leafMedia_clean_script_tag($input) {
	$input = str_replace("type='text/javascript' ", '', $input);
	return str_replace("'", '"', $input);
}

add_filter('script_loader_tag', 'leafMedia_clean_script_tag');



/**
 * Remove unnecessary self-closing tags
 * @since 1.0.0
 **/

function leafMedia_remove_self_closing_tags($input) {
	return str_replace(' />', '>', $input);
}

add_filter('get_avatar', 'leafMedia_remove_self_closing_tags'); // <img />
add_filter('comment_id_fields', 'leafMedia_remove_self_closing_tags'); // <input />
add_filter('post_thumbnail_html', 'leafMedia_remove_self_closing_tags'); // <img />



/**
 * Don't return the default description in the RSS feed if it hasn't been changed
 * @since 1.0.0
 **/

function leafMedia_remove_default_description($bloginfo) {
	$default_tagline = 'Just another WordPress site';
	return ($bloginfo === $default_tagline) ? '' : $bloginfo;
}

add_filter('get_bloginfo_rss', 'leafMedia_remove_default_description');

?>
