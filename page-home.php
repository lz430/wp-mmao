<?php
/**
 * Template Name: Home Page
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
get_header(); ?>
  <div id="subheader-wrapper" class="container-fluid">
    <div id="subheader" class="container">
        <div class="row">
            <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
                <?php the_content(); ?>
            <?php endwhile; ?> 
        </div><!-- end row-->
    </div><!-- end container-->
</div><!-- end container-fluid -->
<div class="container-fluid callout-container">
<a href="#estimator-home"></a>
    <div class="container">
        <div class="callout-container">
            <h1 class="select-text">
                Select the Apple product you wish to sell: 
            </h1> 
        </div>
    </div>
</div>
<div class="container estimator-app" id="estimator-init">
    <!-- EST WRAPPER START -->
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
                    <div class="loading"><img src="<?php echo get_template_directory_uri(); ?>/images/loading.gif" alt="Loading..."></div>
                    <div class="select-model-dropdown"></div>
                </div> <!-- end padded-panel -->
            </div> 
        </div>
       <?php } // end main for loop ?>
      <div class="clearfix"></div>
  </div><!-- end row-->
</div><!-- end container-->
    
    <div class="clearfloat"></div>
    
    <?php //include(locate_template('page-estimator2.php')) ?>
    <div class="clearfloat"></div>
    
<!-- Estimator stops here -->
<!-- Rest of the home page -->
<div class="container serial-number">
    <div class="row">
        <ul id="serialnumber">
            <li id="serialnumber-first" class="col-lg-3 col-md-3 col-sm-4 col-xs-12"><a href="javascript:void(0);" title="Apple Serial Number Finder" id="est_promo_serial" onclick="window.open('https://selfsolve.apple.com/agreementWarrantyDynamic.do','','width=1000,height=960');return false;">Find By Serial Number</a></li>
            <li id="serialnumber-second" class="col-lg-6 col-md-6 col-sm-4 col-xs-12">Please use Apple's Serial Number tool to find the correct model.</li>
            <li id="serialnumber-last" class="col-lg-3 col-md-3 col-sm-4 col-xs-12"><a href="javascript:void(0);" onclick="window.open('https://selfsolve.apple.com/agreementWarrantyDynamic.do','','width=1000,height=960');return false;" id="est_promo_serial" title="Apple Serial Number Finder">Apple Serial Number lookup</a></li>
            <div class="clearfix"></div>
        </ul>
    </div>
</div>
<div id="whysell-wrapper" class="container-fluid">
    <div id="whysell" class="container">
        <div class="row">
            <h2>Why sell to mac me an offer?</h2>
            <ul>
                <li id="whysell-first" class="col-lg-3 col-md-3 col-sm-3 col-xs-6">Excellent Reputation. <br> 20+ years in business.</li>
                <li id="whysell-second" class="col-lg-3 col-md-3 col-sm-3 col-xs-6">We pay higher and quicker <br> than our competition.</li>
                <li id="whysell-third" class="col-lg-3 col-md-3 col-sm-3 col-xs-6">We pay for shipping. <br> (US sellers only)</li>
                <li id="whysell-fifth" class="col-lg-3 col-md-3 col-sm-3 col-xs-6">Testing and secure data<br> destruction by our Apple<br> Certified Technicians.</li>
            </ul>
        </div><!-- end row-->
    </div> <!-- end container-->
</div><!-- end container-fluid-->
<div id="howitworks" class="container-fluid">
    <div class="container works-container">
        <div class="row">
            <h2>Here is how it works:</h2>
            <div id="works-first" class="works-item col-lg-3 col-md-3 col-sm-6 col-xs-6">
                <img src="<?php echo get_template_directory_uri(); ?>/images/how-icon-imac.png" alt="Select your device" />
                <p>Select your Apple product from the tool above to get an estimate.</p>
            </div>
            <div id="works-second" class="works-item col-lg-3 col-md-3 col-sm-6 col-xs-6">
                <img src="<?php echo get_template_directory_uri(); ?>/images/how-icon-email.png" alt="Submit the form" />
                <p>Complete the seller form, and we will email you within one (1) business day with a formal offer.</p>
            </div>
            <div id="works-third" class="works-item col-lg-3 col-md-3 col-sm-6 col-xs-6">
                <img src="<?php echo get_template_directory_uri(); ?>/images/how-icon-ship.png" alt="Ship the device" />
                <p>After you accept our offer, we provide documentation, instructions, and a pre-paid shipping label.</p>
            </div>
            <div id="works-fourth" class="works-item col-lg-3 col-md-3 col-sm-6 col-xs-6">
                <img src="<?php echo get_template_directory_uri(); ?>/images/how-icon-paid.png" alt="Get paid" />
                <p>Payment is issued via check or PayPal within three (3) business days of delivery. Overnight payment is available for a fee.</p>
            </div>
        </div>
    </div>
</div>
<div class="container bottom-callout-container">
    <div class="row">
        <div id="buybox" class="buybox-item col-lg-5 col-md-5 col-sm-5 col-xs-12">
            <h3>Need to buy a used Mac?</h3> 
            <div class="inner-buybox-wrap">
                <p>Get a great deal on iMacs, Mac Pros, Macbooks, Macbook Airs, iPads, iPhones and more at</p>
                <img id="buybox-bg" src="<?php echo get_template_directory_uri (); ?>/images/buy-box-bg.png" alt="Apple devices" />
                <div class="clearfix"></div>
                <div class="row">
                    <img src="<?php echo get_template_directory_uri (); ?>/images/moat-logo.png" alt="Mac of All Trades - Shop Now" class="moat-logo"/>
                    <a title="Mac of All Trades" href="http://www.macofalltrades.com" target="_blank" class="btn-shop-now">Shop Now</a>
                </div><!-- end row-->
            </div><!-- end inner-buybox-wrap-->
        </div><!-- end buybox-->
        <div id="selltextbox" class="buybox-item col-lg-5 col-md-5 col-sm-5 col-xs-12 pull-right">
            <h3>Sell in volume</h3> 
            <div class="inner-buybox-wrap">
                <p>Do you want to sell more than 5 products?</p>
                <img id="sellbox-bg" src="<?php echo get_template_directory_uri (); ?>/images/sell-box-bg.png" alt="Apple computers" /><div class="clearfix"></div>
                <div class="row">
                    <a title="Click here to sell in volume" href="/sell-in-volume/" class="btn-shop-now">Click Here</a>
                </div><!-- end row-->
            </div><!-- end inner-buybox-wrap-->
        </div> <!-- end selltextbox-->
    </div>
</div>
<?php get_footer(); ?>