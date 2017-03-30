<!DOCTYPE html>
<!--[if IE 9]> <html class="old-ie ie9 no-js" <?php language_attributes(); ?>> <![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8) | !(IE 9)]><!--> <html <?php language_attributes(); ?> class="no-js"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
	<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	<script>document.documentElement.className = document.documentElement.className.replace(/\bno-js\b/g, '') + ' js ';</script>
	<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>
<header class="header" role="banner">
		<div class="container">
			<div class="header__logo">
				<?php
				// Logo markup
				$blog_name = get_bloginfo( 'name' );
				$logo  = ( is_front_page() ) ? '<h1 class="ir">' . $blog_name . '</h1>' : '<p class="ir">' . $blog_name . '</p>';
				?>

				<a class="header__logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo $blog_name; ?>" rel="home">
					<?php echo $logo; ?>
				</a>
			</div>
		</div>

		<div id="header_menu" class="header__nav">

					<div class="nav-toggle visible-xs">
						<span class="nav-toggle__label"><?php _e('Menu', 'leafMedia') ?></span>
						<span class="nav-toggle__icon"></span>
					</div>

					<nav class="nav" role="navigation">
						<div class="nav--mobile">
							<?php
								if(is_front_page() ){
									/*custome menu for front page*/
									wp_nav_menu( array(
									'menu' => ' Front Page Menu',
									'container'			=> false,
									'menu_class'		=> 'nav__list',
									'echo'				=> true,
									'items_wrap'		=> '<ul id="%1$s" class="%2$s">%3$s</ul>',
									'depth'				=> 10,
									'fallback_cb'		=> '__return_false',
									'walker'				=> new leafMedia_Walker_Nav
								));}else{
								wp_nav_menu( array(
								'theme_location'	=> 'primary-nav',
								'container'			=> false,
								'menu_class'		=> 'nav__list',
								'echo'				=> true,
								'items_wrap'		=> '<ul id="%1$s" class="%2$s">%3$s</ul>',
								'depth'				=> 10,
								'fallback_cb'		=> '__return_false',
								'walker'				=> new leafMedia_Walker_Nav
							)); } ?>
						</div>
					</nav>

		</div>

</header>
<main class="main" role="main">
