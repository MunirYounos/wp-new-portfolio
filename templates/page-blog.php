<?php
/**
 * Template Name: blog-page
 * @since 1.1.0
 **/

get_header(); ?>
<section>


<?php get_template_part('partials/page', 'header'); ?>
<div class="container">
<?php
$query = new WP_query('pagename = blog');
 // the Loop
 if ( $query -> have_posts() ){
   while ( $query -> have_posts() ){
     $query -> the_post(); ?>

     <div class="col-xs-12 col-sm-4 col-md-4">
       <div class="posts__wrapper">
         <a class="posts__boxlink" href="<?php echo the_permalink(); ?>">

           <div class="posts__caption">
             <?php the_post_thumbnail(); ?>
             <div class="posts__caption-title">
               <h4><?php echo the_title(); ?></h4>
             </div>
             <div class="posts__caption-content">
                 <p><?php echo the_excerpt('read more...'); ?></p>
             </div>
           </div>


         </a>
       </div>
       </div>

<?php
   }
 }
 wp_reset_postdata();
 ?>
 </div>
</section>
<?php get_footer(); ?>
