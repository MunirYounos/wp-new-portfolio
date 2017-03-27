<?php
/**
 * Google Maps
 * @since 2.4.0
 **/

// Prepare
$attributes = '';

// Zoom
$zoom = get_field('maps_zoom', 'options') ?: 12;
$attributes .= " data-zoom='$zoom'";

// Maps settings
if ( $settings = get_field('maps_settings', 'options') ) {
	foreach ( $settings as $setting ) {
		$attributes .= " data-$setting='true'";
	}
}

/*
 * Marker
 */

// Color
if ( $marker_color = get_field('marker_color', 'options') ) {
	$attributes .= "data-color='$marker_color'";
}

// Inner color
if ( $marker_color_inner = get_field('marker_color_inner', 'options') ) {
	$attributes .= "data-color-inner='$marker_color_inner'";
}

// Border size
if ( $marker_size = get_field('marker_size', 'options') ) {
	$attributes .= "data-size='$marker_size'";
}

// Custom marker
if ( $marker = get_field('maps_marker', 'options') && get_field('add_custom_marker', 'options') ) {
	$marker = get_field('maps_marker', 'options');
	$attributes .= ' data-marker="' . $marker['sizes']['thumbnail'] . '"';
}

// Snazzymap
if ( $snazzy = get_field('add_snazzy', 'options') ) {
	$snazzymap = get_field('snazzymap', 'options');
	$attributes .= " data-styles='$snazzymap'";
}

if ( have_rows('google_maps', 'options') ) : ?>

	<div class="contact__maps js-maps" id="googlemaps" <?= $attributes; ?>>

		<?php
		// Loop Google Maps
		while ( have_rows('google_maps', 'options') ) : the_row();
			$location = get_sub_field('locations');
			$address = get_sub_field('address') ?: $location['address'];
			?>

			<div class="marker entry" data-lat="<?= $location['lat']; ?>" data-lng="<?= $location['lng']; ?>">
				<?= $address; ?>
			</div>

		<?php endwhile; ?>

	</div>

<?php endif; ?>
