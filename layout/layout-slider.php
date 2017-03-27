<?php
/**
 * Layout type: Slider
 * @since 2.0.0
 **/

$speed = get_sub_field('slider_speed') ?: get_field('slider_speed');
$pause = get_sub_field('slider_pause') ?: get_field('slider_pause');
$animate = get_sub_field('slider_animation') ?: get_field('slider_animation');

if ( have_rows('slider_slides') ) : ?>

	<section class="slider">
		<div class="slider__list is-slider" data-speed="<?= $speed; ?>" data-pause="<?= $pause; ?>" data-animation="<?= $animate; ?>">

			<?php
			// Loop through slides
			while ( have_rows('slider_slides') ) :
				the_row();
				$image   = get_sub_field('background');
				$caption = get_sub_field('caption'); ?>

				<div class="slider__item" style="background-image: url(<?= $image['sizes']['large']; ?>);">
					<div class="container slider__inner">
						<div class="slider__caption">
							<?= $caption; ?>
						</div>
					</div>
				</div>

			<?php endwhile; ?>

		</div>
	</section>

<?php endif; ?>
