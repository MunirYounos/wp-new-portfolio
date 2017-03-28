<?php

// Layout type: Icons

if ( have_rows('mixitup_mixitup') ) : ?>

<section id='projects' >

      <div class="container">

        <div class="mixitup__tabs">
          <button class="mixitup__btn" type="button" data-filter="all"><?php _e('All', 'leafMedia'); ?></button>
          <?php
          // Loop through icons
          while ( have_rows('mixitup_mixitup') ) :
            the_row();
            //vars
            $number = get_sub_field('link');
            ?>

            <button class="mixitup__btn" type="button" data-filter=".mix<?php echo strtolower($number); ?>"><?php echo $number; ?></button>

          <?php endwhile; ?>

        </div>


      </div>



  <div class="container">
    <div class="row">



  <div class="mixitup__wrapper">

  		<?php
      // Loop through icons
  		while ( have_rows('mixitup_mixitup') ) :
  	   the_row();

        //vars
        $number = get_sub_field('link');
        $gallery = get_sub_field('gallery');
        ?>

        <?php
        // Loop through gallery
        foreach ( $gallery as $image ) : ?>

          <figure class=" mixitup__figure mix mix<?php echo strtolower($number); ?>" itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
            <a href="<?= $image['sizes']['large']; ?>" class="js-zoom gallery__link mixitup__link" data-thumbnail="<?php echo $image['sizes']['thumbnail']; ?>" style="background-image:url('<?= $image['sizes']['large']; ?>');" rel="<?= $number; ?>" itemprop="contentUrl" title="<?= $image['caption'] ?>" data-size="<?= $image['sizes']['large-width'] . 'x' . $image['sizes']['large-height']; ?>">
</a>
          </figure>

        <?php endforeach; ?>
    	 <?php endwhile; ?>

      </div>
    </div>
  </div>
</section>

<?php endif; ?>
