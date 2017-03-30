<?php
/**
 * Layout type: Gallery
 * @since 1.1.0
 **/

$index       = get_row_index();
$attributes  = get_section_attributes('settings_', 'gallery');
$title       = get_sub_field('gallery_title');
$gallery     = get_sub_field('gallery_images');
$add_caption = get_sub_field('gallery_add_caption');

if ( $gallery ) : ?>

	<section id="gallery" <?= $attributes ?> itemscope itemtype="http://schema.org/ImageGallery">
		<div class="container">

			<?php
			// Title
			if ( $title !== '' ) : ?>
				<h2 class="gallery__title"><?= $title; ?></h2>
			<?php endif; ?>

			<div class="row--flex gallery__list">

				<?php
				// Loop through gallery
				foreach ( $gallery as $image ) : ?>

					<figure class="gallery__item lazy-wrapper" itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
						<a href="<?= $image['sizes']['large']; ?>" class="js-zoom gallery__link" rel="gallery-<?= $index; ?>" itemprop="contentUrl" title="<?= $image['caption'] ?>" data-size="<?= $image['sizes']['large-width'] . 'x' . $image['sizes']['large-height']; ?>">
							<img class="gallery__image lazy" data-src="<?= $image['sizes']['large']; ?>" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" alt="<?= $image['alt']; ?>" itemprop="thumbnail" height="<?= $image['sizes']['large-height']; ?>" width="<?= $image['sizes']['large-width']; ?>">
						</a>

						<?php	if ( $add_caption && $image['caption'] !== '' ) : ?>
							<figcaption class="gallery__caption" itemprop="caption description">
								<?= $image['caption'] ?>
							</figcaption>
						<?php endif; ?>
					</figure>

				<?php endforeach; ?>

			</div>
		</div>
	</section>

<?php endif; ?>
