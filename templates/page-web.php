<?php
/**
 * Template Name: Page-web
 * @since 1.1.0
 **/

get_header(); ?>
<section>
<?php get_template_part('partials/page', 'header'); ?>
<?php
$args = array(
'posts_per_page' => 999,
'orderby' => 'rand',
'category_name' => 'web'
);
$query = new WP_query ($args);
 // the Loop
if( $query -> have_posts()){  ?>

 <section>
   <div class="container">
   <div class="grid">
     <div class="grid__content">
         <?php
       // Loop through icons
   		while ( $query ->have_posts() ) {
         $query ->the_post(); ?>
        <div class="grid__item">
           <div class="grid__wrapper">
             <a class="grid__boxlink" href="<?php echo the_permalink(); ?>">
               <?php echo the_post_thumbnail(); ?>
               <div class="grid__caption">
                 <header class="grid__caption-header">
                   <h4 class="grid__caption-header-title"><?php echo get_the_title(); ?></h4>
                   <span class="grid__caption-header-meta"><time datetime="<?php the_time('c'); ?>"><?php the_time('j. F Y'); ?></time></span>
                   <span class="grid__caption-header-meta">| Author:<?php echo ucfirst(get_the_author()); ?></span>
                 </header>
                 <div class="grid__caption-content">
                     <p><?php echo the_excerpt(); ?></p>
                     <div class="grid__caption-btn">
                     <div class="grid__caption-btn"href="<?php echo the_permalink(); ?>"></div>
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

<?php get_footer(); ?>
