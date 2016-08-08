<?php require_once( explode( "wp-content" , __FILE__ )[0] . "wp-load.php" ); ?>

<div class="row estimator-container">
          <!-- build our list -->
        <?php 
            $tax = 'Equipment Types';
            $orderBy = 'id';
            $terms = get_terms( $tax, [
              'hide_empty' => false, // do not hide empty terms
              'orderby' => 'id',
              'parent' => 0,  
            ]);
            foreach( $terms as $term ) {
        ?>
        
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 equipment-outer">
            <a data-toggle="collapse" class="tab-click" data-target="<?php echo "#".$term->term_id; ?>">
                <div class="equipment <?php echo $term->slug; ?>">
                    <div class="equipment-background" style="background-image: url(<?php echo z_taxonomy_image_url($term->term_id); ?>);"></div>
                    <h5>
                        <?php echo $term->name; ?>
                        <img src="<?php echo get_template_directory_uri ();?>/images/arrow-right.png" alt="Choose the <?php $term->name; ?>">
                    </h5>
                </div>
            </a>
            <div class="collapse estimator-panel" id="<?php echo $term->term_id; ?>">
                <div class="padded-panel">
                    <?php 
                        $args = array(
                            'posts_per_page'   => -1,
                            'category_name'    => $term->slug,
                            'orderby'          => 'date',
                            'order'            => 'DESC',
                            'post_type'        => 'equipment',
                            'suppress_filters' => true,
                        );
                        $posts = new WP_Query( $args );
                        $tax_id = $term->term_id; //Top level parent taxonomy
                        $terms = get_terms( 'Equipment Types', array(
                            'hide_empty' => true,
                            'parent'     => $tax_id,
                        ) );
                        // This looks to see if there are children in the parent category 
                        $term_children = get_term_children($tax_id, 'Equipment Types');
                        if( !empty($term_children) ){
                    ?>  
                    <select class="select-series" name="model">
                        <option value=""> Select a Series </option>
                        <?php foreach ($terms as $term) { ?>
                            <option value="<?php echo $term->slug; ?>"> <?php echo $term->name; ?></option>
                        <?php } //end foreach terms as term
                        ?>
                    </select>
                    
                    <?php
                        }else{
                            echo "<p>We currently don't accept that make/model.</p>";
                        } //end else
                    ?>
                    <div class="select-model-dropdown"></div>
                </div> <!-- end padded-panel -->
            </div> 
        </div>
       <?php } // end main for loop ?>
      <div class="clearfix"></div>
  </div><!-- end row-->