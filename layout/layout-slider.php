<?php
/**
 * Layout type: Slider
 * @since 2.0.0
 **/

$speed = get_sub_field('slider_speed') ?: get_field('slider_speed');
$pause = get_sub_field('slider_pause') ?: get_field('slider_pause');
$animate = get_sub_field('slider_animation') ?: get_field('slider_animation');

$computer = get_sub_field('slider_computer') ?: get_field('slider_computer');
$caption_title = get_sub_field('slider_caption_title') ?: get_field('slider_caption_title');
$caption = get_sub_field('slider_caption') ?: get_field('slider_caption');
$link = get_sub_field('slider_link') ?: get_field('slider_link');
$link_text = get_sub_field('slider_link_text') ?: get_field('slider_link_text');


if ( have_rows('slider_slides') ) : ?>

	<section id='topcontent' class="slider">
		<div class="col-sm-12 col-md-6 slider__cta">
				<div class="slider__cta-caption">
					<h2 class="slider__cta-title"><?php echo $caption_title; ?></h2>
					<p><?php echo $caption; ?></p>
					<a class="btn slider__cta-btn"href="<?php echo $link; ?>"><?php echo $link_text; ?> <i class="slider__cta-btn-ar fa fa-caret-right"></i></a>
				</div>
		</div>
		<div class="col-sm-12 col-md-6 slider__wrap">
			<div class="slider__frame">
				<img src="<?= $computer['url']; ?>">
			</div>
		<div class="slider__list is-slider" data-speed="<?= $speed; ?>" data-pause="<?= $pause; ?>" data-animation="<?= $animate; ?>">

			<?php
			// Loop through slides
			while ( have_rows('slider_slides') ) :
				the_row();
				$image   = get_sub_field('background'); ?>


				<div class="slider__item" style="background-image: url(<?php echo $image['sizes']['large']; ?>);">
				</div>

			<?php endwhile; ?>
			</div>
		</div>

	</section>

<?php endif; ?>
