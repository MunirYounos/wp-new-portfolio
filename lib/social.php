<?php
/**
 * Social media class
 * @since 2.0.0
 **/

if ( !class_exists('leafMedia_Social') ) {
	class leafMedia_Social {


		/**
		 * An array of the enqueued scripts
		 * @access public
		 **/

		public $services = array();
		public $enqueued_scripts = array();


		/**
		 * Constructor
		 **/

		function __construct() {

			// Share buttons shortcode
			$activate_share = get_field('activate_social_share', 'options');
			if ( $activate_share ) {
				add_shortcode('atweb_social_share', array($this, 'get_share_buttons') );
			}

			// Like buttons shortcode
			$activate_like = get_field('activate_social_like', 'options');
			if ( $activate_like ) {
				add_shortcode('atweb_social_like', array($this, 'get_like_buttons') );
			}

			// Facebook page feed shortcode
			$activate_feed = get_field('activate_social_facebook_feed', 'options');
			if ( $activate_feed ) {
				add_shortcode('atweb_facebook_feed', array($this, 'get_facebook_feed') );
			}

			add_action('wp_footer', array($this, 'enqueue_social_sdks'));

		}


		/**
		 * Get Facebook feed
 		 * @since 2.0.0
 		 * @access public
 		 * @return string HTML markup for the Facebook feed
		 **/

		public function get_facebook_feed() {

			ob_start();

			$feed = get_field('social_facebook_feed', 'options');
			$this->services[] = 'facebook';

			echo '<div class="facebook-feed-wrapper" id="facebook-feed">';
				echo $feed;
			echo '</div>';

			return ob_get_clean();
		}


		/**
		 * Get like buttons
 		 * @since 2.0.0
 		 * @access public
 		 * @return string Share button HTML markup
		 **/

		public function get_like_buttons() {

			// Start output buffering
			ob_start();

			// Retrieve list of services to add buttons for
			$services = $this->get_like_services();
			if ( $services ) {

				echo '<div class="like">';
				foreach ( $services as $service  ) {

					$this->services[] = $service;
					$page = get_field('social_like_' . $service, 'options');

					// Test for services
					if ( $service === 'facebook' ) {
						global $post;
						echo '<div class="like__button like__button--facebook"><div class="fb-like" data-href="' . $page . '" data-layout="button" data-action="like" data-size="small" data-show-faces="false" data-share="false"></div></div>';
					}

					if ( $service === 'twitter' ) {
						echo '<div class="like__button like__button--twitter"><a href="' . $page . '" class="twitter-follow-button" data-show-count="false"></a></div>';
					}

					if ( $service === 'linkedin' ) {
						echo '<div class="like__button like__button--linkedin"><script type="IN/FollowCompany" data-id="' . $page . '"></script></div>';
					}

					if ( $service === 'googleplus' ) {
						echo '<div class="like__button like__button--gplus"><div class="g-follow" data-annotation="none" data-height="20" data-href="' . $page . '" data-rel="author"></div></div>';
					}

				}
				echo '</div>';

			} else {
				echo 'Ingen tjenester valgt.';
			}

			return ob_get_clean();

		}


		/**
		 * Get share buttons
 		 * @since 2.0.0
 		 * @access public
 		 * @return string Share button HTML markup
		 **/

		public function get_share_buttons() {

			// Start output buffering
			ob_start();

			// Retrieve list of services to add buttons for
			$services = $this->get_share_services();
			if ( $services ) {

				echo '<div class="share">';
				foreach ( $services as $service  ) {

					$this->services[] = $service;

					// Test for services
					if ( $service === 'facebook' ) {
						global $post;

						echo '<div class="share__button share__button--facebook"><div class="fb-share-button" data-href="' . get_permalink() . '" data-layout="button"></div></div>';
					}

					if ( $service === 'twitter' ) {
						echo '<div class="share__button share__button--twitter"><a href="https://twitter.com/share" class="twitter-share-button"{count}>Tweet</a></div>';
					}
					if ( $service === 'linkedin' ) {
						echo '<div class="share__button share__button--linkedin"><script type="IN/Share"></script></div>';
					}

					if ( $service === 'googleplus' ) {
						echo '<div class="share__button share__button--gplus"><div class="g-plus" data-action="share" data-annotation="none"></div></div>';
					}

				}
				echo '</div>';

			} else {
				echo 'Ingen tjenester valgt.';
			}

			return ob_get_clean();
		}


		/**
		 * Enqueue SDKs for social media
		 * @since 2.0.0
		 * @access private
		 **/

		public function enqueue_social_sdks() {

			// Prepare
			$services = array_unique($this->services);
			$scripts  = $this->enqueued_scripts;

			// Bail early if no services added
			if ( empty($services) ) {
				return;
			}

			foreach ( $services as $service ) {

				if ( $service === 'facebook' && !in_array($service, $scripts) ) {
					$scripts[] = $service;
					echo $this->get_facebook_sdk();
				}

				if ( $service === 'linkedin' && !in_array($service, $scripts) ) {
					$scripts[] = $service;
					echo $this->get_linkedin_sdk();
				}

				if ( $service === 'twitter' && !in_array($service, $scripts) ) {
					$scripts[] = $service;
					echo $this->get_twitter_sdk();
				}

				if ( $service === 'googleplus' && !in_array($service, $scripts) ) {
					$scripts[] = $service;
					echo $this->get_googleplus_sdk();
				}
			}
		}


		/**
		 * Get Facebook SDK markup
		 * @since 2.0.0
		 * @access private
		 **/

		private function get_facebook_sdk() {
			ob_start(); ?>

			<div id="fb-root"></div>
			<script>(function(d, s, id) {
				var js, fjs = d.getElementsByTagName(s)[0];
				if (d.getElementById(id)) return;
				js = d.createElement(s); js.id = id;
				js.src = "//connect.facebook.net/da_DK/sdk.js#xfbml=1&version=v2.7&appId=855130884595916";
				fjs.parentNode.insertBefore(js, fjs);
			}(document, "script", "facebook-jssdk"));</script>

			<?php
			return ob_get_clean();
		}


		/**
		 * Get LinkedIn SDK markup
		 * @since 2.0.0
		 * @access private
		 **/

		private function get_linkedin_sdk() {
			ob_start(); ?>

			<script src="//platform.linkedin.com/in.js" type="text/javascript">lang: da_DK</script>

			<?php
			return ob_get_clean();
		}


		/**
		 * Get Facebook SDK markup
		 * @since 2.0.0
		 * @access private
		 **/

		private function get_twitter_sdk() {
			ob_start(); ?>

			<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?"http":"https";if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document, "script", "twitter-wjs");</script>

			<?php
			return ob_get_clean();
		}


		/**
		 * Get Google Plus SDK markup
		 * @since 2.0.0
		 * @access private
		 **/

		private function get_googleplus_sdk() {
			ob_start(); ?>

			<script src="https://apis.google.com/js/platform.js" async defer>
				{lang: "da"}
			</script>

			<?php
			return ob_get_clean();
		}


		/**
		 * Get list of enqueued scripts
		 * @since 2.0.0
		 **/

		public function get_enqueued_scripts() {
			return $this->enqueued_scripts;
		}


		/**
		 * Get like services
		 * @since 2.0.0
		 **/

		public function get_like_services() {
			return get_field('social_like_services', 'options');
		}


		/**
		 * Get share services
		 * @since 2.0.0
		 **/

		public function get_share_services() {
			return get_field('social_share_services', 'options');
		}

	}

	new leafMedia_Social;
}
?>
