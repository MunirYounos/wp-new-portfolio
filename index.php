<?php get_header(); ?>
<section class="banner">
            <div class="banner-image" style="background-image: url(<?php echo get_theme_file_uri("assets/images/herobw.jpg")?>);"></div>
</section>
    <section class="content">
            <div class="container">


            <?php 
            while(have_posts()){
                the_post(); ?>
            <div class="post-item">
                <h2><a href="<?php echo the_permalink(); ?>"><?php echo the_title(); ?></a></h2>
            </div>

            <?php }
            ?>
            </div>
    </section>


<?php get_footer(); ?>