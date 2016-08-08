<?php
/**
 * Template Name: Home Page -2
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
get_header(); 
    
    // WP_Query arguments
    $args = array (
        'p'                      => $_GET["p"]
        // 'post_type'              => array( 'equipment' )
    );

    echo "<pre>";
    echo  print_r($args);
    echo "</pre>";

    // The Query
    $looper = new WP_Query($args);
    
    // The Loop
    if ( $looper->have_posts() ) {
        while ( $looper->have_posts() ) {
            $looper->the_post();
            echo "Success";
        }
    } else {
        // no posts found
    }

    // Restore original Post Data
    wp_reset_postdata();

    echo "<pre>";
    echo  print_r($args);
    echo "</pre>";

    // $query = new WP_Query($args);

    // if ($query -> have_posts() ) {
    //     while ($query -> have_posts() ) {
    //         $query -> the_post();
    ?>

    <div id="page_2" class="container">
        <p class="est_title">Please fill in your device details:</p>
        <div class="est_model_info">
            <div class="est_model_thumb_container">
                <img id="est_model_thumb" title="Model Name" src="<?php //echo z_taxonomy_image_url($term->term_id); ?>" alt="Model Name" />
            </div>
            <h4 id="est_model_title"><?php the_title(); ?></h4>
            <p>
                Estimate: <span id="est_model_price">$0.00</span> Please note: The price above assumes your equipment is in good condition and 100% operational.
            </p>
        </div>


<?php 
//     }
// } 
 ?>

 <?php get_footer(); ?>