<?php
    require_once( explode( "wp-content" , __FILE__ )[0] . "wp-load.php" );    
    $ajax = $_GET['ajax'] === "true" || false;
    $model = $_REQUEST['series'];
    // echo $model;
    // if ($model == 0) {
    //     die("Please select a series.");
    // }
    if (!$ajax) {
        //get_header();
    } 
    // WP_Query arguments
    wp_reset_query();
    $args = array(
        'post_type'      => 'Equipment',
        'posts_per_page' => -1,
        'tax_query'      => array(
            array(
            'taxonomy' => 'Equipment Types',
            // 'terms'    => "iphone-5c",
            'terms'    => $model,
            'field'    => 'slug',
             )
          )
        );
    $query = new WP_Query( $args );
    
?>
 <?php 
         if ( $query->have_posts() ) {
             while ( $query->have_posts() ) {
                 $query->the_post();
             }
         }
        ?>
<select class="select-model" name="model">
    <option value=""> Select a model </option>
    <?php 
         if ( $query->have_posts() ) {
             while ( $query->have_posts() ) {
                 $query->the_post();
        ?>
        <option value="<?php echo $post->ID; ?>"> <?php echo the_title(); ?></option>
     <?php 
         }
     }
     // Restore original Post Data
     wp_reset_postdata();

    ?>
</select>
