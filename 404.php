<?php get_header(); ?>

<?php get_template_part('partials/page', 'header'); ?>

<div class="page__content">
	<div class="container">
		<div class="row">
			<div class="col-sm-8 col-md-7">
				<article class="entry entry--404">
					
					<p><?php _e('UPS! It looks like the page you are searching after does not exist or maybe moved to another place.', 'leafMedia'); ?></p>
					<p><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php _e('Go back to home page', 'leafMedia'); ?></a></p>

				</article>
			</div>

		</div>
	</div>
</div>

<?php get_footer(); ?>
