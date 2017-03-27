<?php
/**
 * Analytics class
 * @since 2.0.0
 **/

if ( ! class_exists('leafMedia_Analytics') ) {
	class leafMedia_Analytics {

		/**
		 * Constructor
		 **/

		function __construct() {

			// Google Analytics
			$activate_google_analytics = get_field('activate_google_analytics', 'options');
			if ( $activate_google_analytics ) {
				add_action('wp_footer', array($this, 'get_google_analytics'));
			}

			// Google AdWords
			$activate_google_adwords = get_field('activate_google_adwords', 'options');
			if ( $activate_google_adwords ) {
				add_action('wp_footer', array($this, 'get_google_adwords'));
			}

			// Facebook Pixel
			$activate_facebook_pixel = get_field('activate_facebook_pixel', 'options');
			if ( $activate_facebook_pixel ) {
				add_action('wp_head', array($this, 'get_facebook_pixel'));
			}

		}


		/**
		 * Get Google Analytics
 		 * @since 2.0.0
 		 * @access public
 		 * @return string HTML markup for Google Analytics
		 **/

		public function get_google_analytics() {

			$ignored_roles = get_field('google_analytics_ignored_roles', 'options');
			$is_allowed    = $this->is_user_allowed( $ignored_roles );

			if ( $is_allowed ) {
				echo get_field('google_analytics_script', 'options');
			} else {
				return;
			}
		}


		/**
		 * Get Google AdWords conversion script
 		 * @since 2.0.0
 		 * @access public
 		 * @return string HTML markup for Google AdWords
		 **/

		public function get_google_adwords() {

			// Check if user is allowed
			$ignored_roles = get_field('google_adwords_ignored_roles', 'options');
			$is_allowed    = $this->is_user_allowed( $ignored_roles );

			if ( $is_allowed ) {
				global $post;

				// Retrieve and loop through conversion scripts
				if ( $post && have_rows('google_adwords_scripts', 'options') ) {
					while ( have_rows('google_adwords_scripts', 'options') ) {
						the_row();
						$id     = get_sub_field('include');
						$script = get_sub_field('script');

						// Compare current post ID with on the ones from admin
						if ( is_singular() && in_array($post->ID, $id) ) {
							echo $script;
						}
					}
				}
			} else {
				return;
			}
		}


		/**
		 * Get Facebook Pixel
 		 * @since 2.4.0
 		 * @access public
 		 * @return string HTML markup for Google Analytics
		 **/

		public function get_facebook_pixel() {

			// Check if user is allowed
			$ignored_roles = get_field('facebook_pixel_ignored_roles', 'options');
			$is_allowed    = $this->is_user_allowed( $ignored_roles );

			if ( $is_allowed ) {
				global $post;

				// Retrieve and loop through conversion scripts
				if ( $post && have_rows('facebook_pixel_scripts', 'options') ) {
					while ( have_rows('facebook_pixel_scripts', 'options') ) {
						the_row();
						$pages  = get_sub_field('choose');
						$id     = get_sub_field('include');
						$script = get_sub_field('script');

						// Compare current post ID with on the ones from admin
						if ( $pages === "specific" && is_singular() && in_array($post->ID, $id) ) {
							echo $script;
						}elseif ( $pages === "all" ) {
							echo $script;
						}
					}
				}
			} else {
				return;
			}
		}


		/**
		 * Is user allowed
		 * @since 2.0.0
		 * @access private
		 * @param array $ignored_roles An array of ignored roles to match current user role
		 * @return bool
		 **/

		private function is_user_allowed( $ignored_roles = array() ) {

			// Get roles of current user and check for presence among ignored ones
			$current_user  = wp_get_current_user();
			$current_roles = $current_user->roles;
			$role_found    = array_intersect($current_roles, $ignored_roles);

			// Return true if current role is not in ignored roles
			if ( empty($role_found) ) {
				return true;
			} else {
				return false;
			}
		}


	}

	new leafMedia_Analytics;
}
?>
