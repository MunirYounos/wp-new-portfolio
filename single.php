<?php get_header(); ?>

<?php get_template_part('partials/page', 'header'); ?>

<div class="page__content">
	<div class="container">
		<div class="row">

			<div class="col-sm-12 col-md-12 page__inner">
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

					<article class="entry entry--<?php echo $post->post_type; ?>">
						<div class="col-sm-12 col-md-10 col-md-offset-1 page__image">
							<?php the_post_thumbnail() ?>

						</div>
			 			<div class="col-sm-12 col-md-10 col-md-offset-1 ">
							<span class="grid__caption-header-meta"><time datetime="<?php the_time('c'); ?>"><?php the_time('j. F Y'); ?></time></span>
							<span class="grid__caption-header-meta">| Author:<?php echo ucfirst(get_the_author()); ?></span>
							<?php the_content(); ?>
			 			</div>

					</article>

				<?php endwhile; else: ?>

					<?php get_template_part('partials/content', 'none'); ?>

				<?php endif; ?>
			</div>


		</div>
	</div>
</div>

<?php get_footer(); ?>
