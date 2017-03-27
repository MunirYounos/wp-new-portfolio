</main>

<footer class="footer" role="contentinfo">
	<div class="container">
		<div class="row footer__wrapper">
		<?php
		$email = get_field('mail', 'options');
		$phone = get_field('phone', 'options');
		$address = get_field('address', 'options');
		$footer_text = get_field('footer_text', 'options');
		$footer_logo = get_field('footer_logo', 'options');
		$footer_contact = get_field('footer_contact', 'options');
		 ?>

		 <div class=" footer__info col-xs-12 col-sm-12 col-md-4 col-md-offset-4 col-lg-4 col-lg-offset-4 ">
		 	<h2 class="footer__info--title"><?php _e('Contact info', 'leafMedia'); ?></h2>

			<div class="footer__info--wrap">
				<p class="footer__info--item"><?php echo  $address; ?></p>
				<p class="footer__info--item"><a href="mailto:<?php echo $email;?>"><?php echo '<strong>EMAIL:</strong>' . $email;?></a></p>
				<p class="footer__info--item"><a href="tel:<?php echo $phone;?>"><?php echo '<strong>PHONE:</strong>' . $phone;?></a></p>
		 </div>
		 </div>
			 <div class=" footer__bottom col-md-12">
			 	<div class="footer__bottom-date">
			 		<?php echo date('d . F . Y') ?>
			 	</div>
				<div class="col-xs-12 col-md-12">
				<img class="footer__bottom--logo" src="<?php echo $footer_logo['sizes']['thumbnail']; ?>" alt="">
				</div>
			 </div>
			<?php
			/**
			 * Footer widgets
			 **/

			if ( have_rows('widgets_footer', 'options') ) :
				while ( have_rows('widgets_footer', 'options') ) :
					the_row();
					$title   = get_sub_field('title');
					$content = get_sub_field('content');
					?>

					<div class="col-sm-4 footer__item">
						<h4 class="footer__item--title"><?= $title ?></h4>
						<div class="footer__item--content"><?= $content ?></div>
					</div>

			<?php endwhile; endif; ?>

		</div>
	</div>
</footer>

<?php wp_footer(); ?>

</body>
</html>
