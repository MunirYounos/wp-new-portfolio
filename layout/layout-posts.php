<?php

// Layout type: Icons
$args = array(
'posts_per_page' => 4,
'orderby' => 'rand',
'category_name' => 'web, graphic, logo, photos'
);
$query = new WP_query ($args);?>
<?php if( $query -> have_posts()){  ?>



<section id="posts">
  <div class="container">
  <div class="posts">


    <div class="col-sm-12">
      <h2 class='posts__main-title'><?php _e('From the Blog', 'leafMedia'); ?></h2>
    </div>

      <div class="posts__flex">


        <?php
      // Loop through icons
  		while ( $query ->have_posts() ) {
        $query ->the_post(); ?>
        <div class="col-xs-12 col-sm-3 col-md-3 posts__gutters">
          <div class="posts__wrapper">
            <a class="posts__boxlink" href="/portfolio/photo/.php?page_id=808 ?>">
              <?php echo the_post_thumbnail(); ?>
              <div class="posts__caption">
                <header class="posts__caption-header">
                  <h4 class="posts__caption-header-title"><?php echo get_the_title(); ?></h4>
                  <span class="posts__caption-header-meta"><time datetime="<?php the_time('c'); ?>"><?php the_time('j. F Y'); ?></time></span>
                  <span class="posts__caption-header-meta">| Author:<?php echo ucfirst(get_the_author()); ?></span>
                </header>
                <div class="posts__caption-content">
                    <p><?php echo the_excerpt(); ?></p>
                    <div class="posts__caption-btn">
                    <div class="posts__caption-btn"href="<?php echo the_permalink(); ?>"></div>
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
