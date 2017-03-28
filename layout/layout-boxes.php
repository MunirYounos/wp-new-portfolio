<?php

// Layout type: Icons

if ( have_rows('boxes_boxes') ) : ?>

<section >
  <div class="container-fluid">
    <div class="row">
      <div class="boxes">

  		<?php
      // Loop through icons
  		while ( have_rows('boxes_boxes') ) :
  	   the_row();

        //vars
        // $image = get_sub_field('image');
        // $icon = get_sub_field('icon');
        // $title = get_sub_field('title');
        // $subtitle = get_sub_field('desc');
        // $number = get_sub_field('link');
        // $link = get_sub_field('page_link');
        ?>

          <div class="boxes__wrapper">
            <a class="boxes__boxlink" href="<?php echo $link; ?><?php echo '#mix'. strtolower($number); ?>">

            <div class="boxes__overlay" style="background-image: url('<?php echo $image['url']; ?>')">

              <div class="boxes__caption">
                <img class="boxes__icon" src="<?php echo $icon['sizes']['thumbnail']; ?>" style="width: 8rem;">
                <div class="boxes__caption-title">
                  <?php echo $title; ?>
                </div>
                <div class="boxes__caption-subtitle">
                    <span><?php echo $subtitle; ?></span>
                    <div class="boxes__caption-arrow">
            
                    </div>
                </div>
              </div>
            </div>

            </a>
          </div>
    	 <?php endwhile; ?>

      </div>
    </div>
  </div>
</section>

<?php endif; ?>
