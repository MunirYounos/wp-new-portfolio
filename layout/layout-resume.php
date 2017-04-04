<section id="resume" class="resume">

	<?php if(have_rows('resume_resume') ) : ?>
	<!--WORK DESCRIPTION -->

	<h2 class="about__title"><?php _e('Resume', 'leafMedia'); ?></h2>

				<?php while(have_rows('resume_resume') ):
					the_row();
						//vars
						$icon = get_sub_field('logo');
						$resume_cat = get_sub_field('resume_cat');
						$resume_title = get_sub_field('title');
						$resume_desc = get_sub_field('desc');
						$resume_content = get_sub_field('content');
						$resume_date = get_sub_field('date');
					?>
					<div class="container">
						<div  class="row ">
				<div class="col-lg-2 col-lg-offset-1">
					<h5 class="resume__cat"><?php echo $resume_cat; ?></h5>
				</div>
				<div class="col-lg-6 resume__content">
					<p><h3 class="resume__title"><?php echo $resume_title; ?></h3><br/>
						<span class="resume__desc"><?php echo $resume_desc; ?></span><br/>
					</p>
					<p><more class="resume__content"><?php echo $resume_content; ?></more></p>
				</div>
				<div class="col-lg-3 resume__right" >
					<sm class="resume__date"><?php echo $resume_date; ?></sm>
						<img Class="resume__logo" src="<?php echo $icon['sizes']['large']; ?>" alt="ss">
				</div>
			</div><!--/.row -->
		</div><!--/.container -->
			<span class="resume__hr"></span>
			<?php endwhile; ?>
		<?php endif; ?>
	</section>
