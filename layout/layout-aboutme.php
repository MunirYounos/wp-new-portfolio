<?php $attributes = get_section_attributes('settings_', $extra_class = 'section__row' );
 ?>

<section id="aboutme" class="about" <?= $attributes; ?>>
	<div class="about__intro">
		<div class="container">
			<div class="row ">
        <?php
        //vars
        $main_title = get_sub_field('aboutme_main_title');
        $about_title = get_sub_field('aboutme_title');
        $about_content = get_sub_field('aboutme_content');
        $about_portriat = get_sub_field('aboutme_portriat');
        $about_link = get_sub_field('aboutme_link');
        $about_link_text = get_sub_field('aboutme_link_text');
        $about_cv = get_sub_field('aboutme_cv');
        $about_cv2 = get_sub_field('aboutme_cv2');
        $about_cv_text = get_sub_field('aboutme_cv_text');
        $about_cv_text2 = get_sub_field('aboutme_cv_text2');
        $about_skillsinfo = get_sub_field('aboutme_kills_info');
        ?>
			<h2 class="about__title"><?php echo $main_title; ?></h2>
				<div class="col-lg-3">
          <div class="row">
          <div class="about__border">
						<div class="about__portrait">
				          <img class="about__image" src="<?php echo $about_portriat['url']; ?>" alt="image" width="200">
					 </div>
          </div>
        </div>
				</div>
				<div class="col-lg-4">
				<h5 class="about__text-title"><?php echo $about_title; ?> </h5>
					<?php echo $about_content; ?>

          <div class="about__cv" >
					<p><a class='btn about__cv-btn' href="<?php echo $about_cv['url']; ?> " target="_blank"> <sm><?php echo $about_cv_text; ?> </sm><i class="cv_icon2 fa fa-arrow-circle-down"></i></a></p>
					<p><a class='btn about__cv-btn'  href="<?php echo $about_cv2['url']; ?>" target="_blank"><sm><?php echo $about_cv_text2; ?> </sm><i class=" cv_icon2 fa fa-arrow-circle-down"></i></a></p>
				</div>
				</div>

				<div class="col-lg-5 ">
              <h5 class="about__info"><?php echo $about_skillsinfo; ?> </h5>
          <div id="bars">
            <?php if ( have_rows('aboutme_skills') ) : ?>
            <?php
              // Loop through icons
              while ( have_rows('aboutme_skills') ) :
               the_row();

                //vars
                $code_name = get_sub_field('name');
                $skill_progress = get_sub_field('progress');
                $icon = get_sub_field('logo');
                ?>

                <div class="bar" data-percent="<?php echo $skill_progress; ?>">
              		<h5 class="about__skills-title"><?php echo $code_name; ?></h5>
              		<canvas class="bar-circle" width="70" height="70"></canvas>
              	</div>


                  <?php endwhile;?>
              <?php endif;?>
            </div>
				</div>
			</div><!--/.row -->
		</div><!--/.container -->
	</div><!--/ #intro -->

  <div class="container-fluid about__logos">
    <div class="about__logo">
      <?php if ( have_rows('aboutme_skills') ) : ?>
      <?php
        // Loop through icons
        while ( have_rows('aboutme_skills') ) :
         the_row();

          //vars
          $icon = get_sub_field('icon');
          ?>
          <div class=" col-xs-4 col-sm-2 col-md-1">
          <span class="about__devicon"><?php echo $icon; ?></span>
          </div>
            <?php endwhile;?>
        <?php endif;?>
    </div>
  </div>
</section>
