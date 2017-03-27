<?php
/**
 * Template Name: Contact-page
 * @since 1.1.0
 **/

get_header(); ?>

<?php get_template_part('partials/page', 'header'); ?>

<div class="page__content contact-wrapper">
	<div class="container">
		<div class="row">

			<article class="col-sm-6 contact__content">
				<div class="entry contact__text">

					<?php
					/**
					 * Contact content
					 **/
					$shown_content = get_field('shown_content');
					$content = get_field('content');
					$mail    = get_company_info('mail');
					$phone   = get_company_info('phone');
					$address = get_company_info('address');
					$cvr     = get_company_info('cvr');

					if ( in_array('info', $shown_content)) {
						// Fallback to general information via options page
						echo '<h2>' . __('Contact information','leafMedia') . '</h2>';
						echo $address;
						echo '<p>';
							echo __('Phone', 'leafMedia') . ': <a href="tel:' . get_formatted_phone($phone) . '">' . $phone . '</a><br>';
							echo __('E-mail', 'leafMedia') . ': <a href="mailto:' . $mail . '">' . $mail . '</a><br>';
							echo '<small>' . __('CVR', 'leafMedia') . ': ' . $cvr . '</small>';
						echo '</p>';
					}
					if ( in_array('content', $shown_content) && $content && $content !== '' ) {
						echo $content;
					}
					?>

				</div>

				<div class="contact__form">

					<?php
					/**
					 * Gravity Forms
					 * @link https://www.gravityhelp.com/documentation/article/embedding-a-form/
					 **/

					gravity_form( 1, $display_title = false, $display_description = false, $display_inactive = false, $field_values = null, $ajax = false, 2, $echo = true ); ?>

				</div>

			</article>

		</div>
	</div>

	<?php get_template_part('partials/page', 'googlemaps'); ?>

</div>

<?php get_footer(); ?>
