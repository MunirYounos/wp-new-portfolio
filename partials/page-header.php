<?php
/**
 * Header partial
 * @since 1.1.0
 **/

/**
 * Retrieve proper page title
 **/

if ( is_category() ) {
	$title = single_cat_title( '', false );
} elseif ( is_archive() ) {
	$title = post_type_archive_title( '', false );
} elseif ( is_404() ) {
	$title = __('Oops, the page you are looking for doesn\'t exist, or has been moved!', 'leafMedia');
} elseif ( is_search() ) {
	$title = __('Søgning', 'leafMedia');
} else {
	$id = (is_home()) ? get_option('page_for_posts') : $post->ID;
	$title = get_leafMedia_title($id);
}


/**
 * Get header background
 **/

?>

<header class="page__header" role="banner">
	<div class="container">
		<?php if ( is_front_page() ) : ?>
			<h2 class="page__title"><?= $title; ?></h2>
		<?php else : ?>
			<h1 class="page__title"><?= $title; ?></h1>
		<?php endif; ?>
	</div>
</header>
