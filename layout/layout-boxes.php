<?php

// Layout type: Icons
 $service_title = get_sub_field('boxes_service_title');
if ( have_rows('boxes_boxes') ) : ?>

<section id="services">
  <div class="container">
  <div class="boxes">


    <div class="col-sm-12">
      <h2 class='boxes__service-title'><?php echo $service_title; ?></h2>
    </div>

      <div class="boxes__flex">

  		<?php
      // Loop through icons
  		while ( have_rows('boxes_boxes') ) :
  	   the_row();

        //vars
        $icon = get_sub_field('icon');
        $title = get_sub_field('title');
        $desc = get_sub_field('desc');
        $number = get_sub_field('link');
        $link = get_sub_field('page_link');
        ?>
        <div class="col-xs-12 col-sm-3 col-md-3">
          <div class="boxes__wrapper">
            <a class="boxes__boxlink" href="<?php echo $link; ?>">

              <div class="boxes__caption">
                <img class="boxes__icon" src="<?php echo $icon['sizes']['thumbnail']; ?>" style="width: 6rem;">
                <div class="boxes__caption-title">
                  <?php echo $title; ?>
                </div>
                <div class="boxes__caption-subtitle">
                    <span><?php echo $desc; ?></span>
                    <div class="boxes__caption-btn">
                    <div class="boxes__caption-btn"href="<?php echo $link; ?>"><?php _e('More..','leafMedia') ?></div>
                    </div>
                </div>
              </div>


            </a>
          </div>
          </div>
    	 <?php endwhile; ?>

      </div>
    </div>
  </div>
</section>

<?php endif; ?>
