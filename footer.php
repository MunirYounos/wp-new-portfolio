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
