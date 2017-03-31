<?php

// Layout type: Icons
$args = array(
'posts_per_page' => 3,
'orderby' => 'ASC',
'category_name' => 'web'
);
$query = new WP_query ($args);?>
<?php if( $query -> have_posts()){  ?>



<section id="posts">
  <div class="container">
  <div class="posts">


    <div class="col-sm-12">
      <h2 class='posts__service-title'><?php _e('My Blog', leafMedia); ?></h2>
    </div>

      <div class="posts__flex">


        <?php
      // Loop through icons
  		while ( $query ->have_posts() ) {
        $query ->the_post(); ?>
        <div class="col-xs-12 col-sm-4 col-md-4">
          <div class="posts__wrapper">
            <a class="posts__boxlink" href="<?php echo the_permalink(); ?>">

              <div class="posts__caption">
              <?php echo the_post_thumbnail(); ?>
                <div class="posts__caption-title">
                  <h4><?php echo get_the_title(); ?></h4>
                </div>
                <div class="posts__caption-content">
                    <p><?php echo the_excerpt(); ?></p>
                    <div class="posts__caption-btn">
                    <div class="posts__caption-btn"href="<?php echo the_permalink(); ?>"><?php _e('More..','leafMedia') ?></div>
                    </div>
                </div>
              </div>


            </a>
          </div>
          </div>
      <?php  } ?>

      </div>
    </div>
  </div>
</section>

<?php  }
  wp_reset_postdata();
?>
