<?php get_header(); ?>
<?php get_template_part('layout/layout', 'slider'); ?>
<article class="page__content">

	<?php
	if ( have_posts() ) {
		while ( have_posts() ) {
			the_post();

			if ( post_password_required() ) {
					echo '<div class="container">';
						echo get_the_password_form( $post );
					echo '</div>';
			} else {
				get_template_part('layout/layout');
			}
		}
	}
	?>

</article>

<?php get_footer(); ?>
