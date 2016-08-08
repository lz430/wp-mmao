<?php
    require_once( explode( "wp-content" , __FILE__ )[0] . "wp-load.php" );    
    $ajax = $_GET['ajax'] === "true" || false;
    $model = intval($_REQUEST['p']);
    if ($model == 0) {
        die("Please select a model.");
    }
    if (!$ajax) {
        //get_header();
    } 
    // WP_Query arguments
    $args = array(
        'p'         => $model,
        'post_type' => array('equipment')
    );
    $query = new WP_Query($args);
    if ($query->have_posts() ) {
?>
    <div id="page_2" class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <?php
                while ($query->have_posts() ) {
                    $query->the_post();
                    $terms = wp_get_post_terms($post->ID, 'Equipment Types', array("fields" => "all"));

                    foreach( $terms as $term ) {
                        $termParent = get_term( $term->parent, 'Equipment Types' );
                        if($term->parent == 0){
                            $theterm =  $term->slug;
                            $termID  = $term->term_id;
                        } else{
                            $theterm =  $termParent->slug;
                            $termID  = $termParent->term_id;
                        }

                    unset($term);
                    }
                ?>
        <p class="est_title">
            <!--Please fill in your device details:-->
        </p>
        <div class="est_model_info">
            <?php 
                $priceHigh = get_field("price_high"); 
                if ($priceHigh !== "NULL") {
            ?>
            <div class="est_model_thumb_container" style="background-image: url(<?php echo z_taxonomy_image_url($termID, 'full'); ?>"></div>
            <?php }else{ ?>
            <div class="est_model_thumb_container" style="background-image: url(<?php echo get_template_directory_uri();  ?>/images/device-no-image.png); background-size: auto;"></div>
            <?php } ?>
            <h4 id="est_model_title"><?php the_title(); ?></h4>
            <p>
                <?php 
                    $priceHigh = get_field("price_high"); 
                    if ($priceHigh === "NULL") {
                ?>
                    <p>We can recycle this product! </p>
                    <p>
                        When you recycle with us, your equipment may be either donated or disassembled. We properly erase all data (even if the equipment is non-functional). Upon disassembly, key components which can be reused are removed. Remaining parts are recycled by our R2 certified electronics recycling company.
                    </p>
                <?php
                    }else{
                ?>
                <span id="est_model_price">Estimate: $<?php echo $priceHigh; ?></span> <br>
                Please note: The price above assumes your equipment is in good condition and 100% operational.
                <?php }

                ?>
            </p>
        </div>

        <?php } //endwhile ?>

            </div> <!-- end columns-->
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 estimator-questions">
                <?php 
                    if($theterm == "macbook" || $theterm == "macbook-air" || $theterm == "macbook-pro"){
                        echo do_shortcode('[contact-form-7 id="1411" title="Laptop Questions"]');
                    }
                    if($theterm == "mac-pro" || $theterm == "mac-mini" || $theterm == "imac"){
                        echo do_shortcode('[contact-form-7 id="1366" title="Desktop questions"]');
                    }
                    if($theterm == "accessories"){
                        echo do_shortcode('[contact-form-7 id="1412" title="Accessories Questions"]');
                    }
                    if($theterm == "ipad"){
                        echo do_shortcode('[contact-form-7 id="1413" title="iPad Questions"]');
                    }
                    if($theterm == "iphone"){
                        echo do_shortcode('[contact-form-7 id="1414" title="iPhone Questions"]');
                    }
                ?>
            </div>
        </div><!-- end row-->
    </div> <!-- end container-->
<?php } //end if have posts ?>