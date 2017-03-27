<?php
/**
 * Basic security precautions
 * ================================================== */


/**
 * Password form markup
 * Used for password protected content
 * @since 1.1.0
 **/

function custom_password_form() {
	global $post;

	$post = get_post( $post );
	$label = 'pwbox-' . ( empty($post->ID) ? rand() : $post->ID );

	$output = '<form action="' . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" class="form form--password" method="post">
	<p>' . __( 'This content is password protected. To view it please enter your password below:' ) . '</p>
	<p><label for="' . $label . '">' . __( 'Password:' ) . ' <input class="form__input form__input--password" name="post_password" id="' . $label . '" type="password" size="20" /></label> <button class="btn" type="submit" name="submit" value="' . esc_attr__( 'Submit' ) . '">' . esc_attr__( 'Submit' ) . '</button></p></form>';

	return $output;
}

add_filter( 'the_password_form', 'custom_password_form' );



/**
 * Head clean up
 * @link http://wpengineer.com/1438/wordpress-header/
 * @since 1.0.0
 **/

remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);



/**
 * Remove the WordPress version
 * @since 1.0.0
 **/

function leafMedia_remove_generator() {
	return '<!-- Made with love by leafMedia/muniryounosi -->';
}

add_filter('the_generator', 'leafMedia_remove_generator');

?>
