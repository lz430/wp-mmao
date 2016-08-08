<?php
/*
 Template Name: Solutions
 */

get_header(); ?>

  <div class="container content-area col-lg-8 col-md-8 col-sm-12 col-xs-12">
    <main id="main" class="site-main" role="main">
          <?php while ( have_posts() ) : the_post(); ?>
            <?php the_content(); ?>
          <?php endwhile; // end of the loop. ?>
        <?php wp_reset_query(); ?>
      
    </main><!-- #main -->
  </div><!-- .content-area -->
      <?php get_sidebar(); ?>

<?php get_footer(); ?>
