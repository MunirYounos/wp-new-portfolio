<?php get_header(); ?>

<?php get_template_part('partials/page', 'header'); ?>

<div class="page__content">
	<div class="container">
		<div class="row">

			<div class="col-sm-8 col-md-7">
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

					<article class="entry entry--<?php echo $post->post_type; ?>">

						<header class="entry__header">
							<h2 class="entry__title"><a href="<?php the_permalink(); ?>"><?php echo get_leafMedia_title(); ?></a></h2>
							<p class="entry__meta"><time datetime="<?php the_time('c'); ?>"><?php the_time('j. F Y'); ?></time></p>
						</header>

						<div class="entry__excerpt">

							       <div class="wrapper">
							         <a class="boxlink" href="<?php echo the_permalink(); ?>">

							           <div class="caption">
							             <?php the_post_thumbnail(); ?>
							             <div class="entry-title">
							               <h4><?php echo the_title(); ?></h4>
							             </div>
							             <div class="entry-content">
							                 <p><?php echo the_excerpt('read more...'); ?></p>
							             </div>
							           </div>


							         </a>
							       </div>

						</div>

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
