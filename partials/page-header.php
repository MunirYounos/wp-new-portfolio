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

$background = get_field('page_hero', $id) ?: get_field('page_hero', 'options');
$cv_english = get_field('cv_english', 'options');
$cv_danish = get_field('cv_danish', 'options');
$cv_e_text = get_field('cv_e_text', 'options');
$cv_d_text = get_field('cv_d_text', 'options');
?>

<header class="page__header" role="banner" style="background-image: url(<?= $background['url']; ?>);">
	<div class="container">

		<?php if ( is_front_page() ) : ?>
			<h2 class="page__title"><?= $title; ?></h2>
			<div class="page__cv col-sm-12">
				<div class="page__cv--btn">
					<a class="btn page__cv--btn-outline" href="<?php echo $cv_english['url']; ?>" target="_blank"><?php echo $cv_e_text; ?><i class="page__cv--btn-outline-fa fa fa-arrow-circle-down" aria-hidden="true"></i></a>
				</div>
				<div class="page__cv--btn">
					<a class="btn page__cv--btn-outline" href="<?php echo $cv_danish['url']; ?>" target="_blank"><?php echo $cv_d_text; ?><i class="page__cv--btn-outline-fa fa fa-arrow-circle-down" aria-hidden="true"></i></a>
				</div>
			</div>
		<?php else : ?>
			<h1 class="page__title"><?= $title; ?></h1>
		<?php endif; ?>
	</div>
</header>
