<?php
/**
 * Flexible content layout setup
 * @since 1.1.0
 **/

if ( have_rows('layout') ) {
	while ( have_rows('layout') ) {

		the_row();
		$layout = get_row_layout();

		switch ($layout) {
			case 'columns':
				get_template_part('layout/layout', 'columns');
				break;
			case 'gallery':
				get_template_part('layout/layout', 'gallery');
				break;
			case 'slider':
				get_template_part('layout/layout', 'slider');
				break;
				case 'boxes':
					get_template_part('layout/layout', 'boxes');
					break;
				case 'mixitup':
						get_template_part('layout/layout', 'mixitup');
				break;
				case 'posts':
						get_template_part('layout/layout', 'posts');
				break;
				case 'aboutme':
						get_template_part('layout/layout', 'aboutme');
				break;
				case 'resume':
						get_template_part('layout/layout', 'resume');
				break;
			default:
				break;
		}

	}
} else {
	echo '<section class="section">';
		echo '<div class="container">';
			_e('<p> Oops!No contents added yet! add your contents here.</p>', 'leafmedia');
		echo '</div>';
	echo '</section>';
}

?>
