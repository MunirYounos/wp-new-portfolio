<?php get_header(); ?>

<?php get_template_part('partials/page', 'header'); ?>

<div class="page__content">
	<div class="container">
		<div class="row">

			<div class="col-sm-8 col-md-7">
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

					<article class="entry entry--<?php echo $post->post_type; ?>">
						<?php the_post_thumbnail() ?>
						<p class="entry__meta"><time datetime="<?php the_time('c'); ?>"><?php the_time('j. F Y'); ?></time></p>
						<?php the_content(); ?>

					</article>

				<?php endwhile; else: ?>

					<?php get_template_part('partials/content', 'none'); ?>

				<?php endif; ?>
			</div>

			<div class="col-sm-4 col-md-offset-1">
				<?php get_sidebar(); ?>
			</div>

		</div>
	</div>
</div>

<?php get_footer(); ?>
