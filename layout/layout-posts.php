<?php

// Layout type: Icons
 $post_main_title = get_sub_field('posts_main_title');
if ( have_rows('posts_posts') ) : ?>

<section id="posts">
  <div class="container">
  <div class="posts">


    <div class="col-sm-12">
      <h2 class='posts__service-title'><?php echo $post_main_title; ?></h2>
    </div>

      <div class="posts__flex">

  		<?php
      // Loop through icons
  		while ( have_rows('posts_posts') ) :
  	   the_row();

        //vars
        $title= get_sub_field('title');
        if(is_front_page){
        $content = wp_trim_words( get_sub_field('content' ), $num_words = 15, $more = '...' );
      }else{
        $content = get_sub_field('content');
      }

        $image = get_sub_field('image');
        $date = get_sub_field('date');
        $author = get_sub_field('author');
        $link = get_sub_field('link');
        ?>
        <div class="col-xs-12 col-sm-4 col-md-4">
          <div class="posts__wrapper">
            <a class="posts__boxlink" href="<?php echo $link; ?>">

              <div class="posts__caption">
                <img class="posts__icon" src="<?php echo $image['sizes']['thumbnail']; ?>" style="width: 20rem;">
                <div class="posts__caption-title">
                  <h4><?php echo $title; ?></h4>
                </div>
                <div class="posts__caption-content">
                    <p><?php echo $content; ?></p>
                    <div class="posts__caption-btn">
                    <div class="posts__caption-btn"href="<?php echo $link; ?>"><?php _e('More..','leafMedia') ?></div>
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
