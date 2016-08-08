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
    <div class="container">
        <div class="callout-container">
            <h1 class="select-text">
                Select the Apple product you wish to sell: 
            </h1> 
        </div>
    </div>
</div>

<div class="container estimator-app">
    <!-- EST WRAPPER START -->
    <div class="row estimator-container">
          <!-- build our list -->
        <?php 
            $tax = 'Equipment Types';
            $orderBy = 'id';
            $terms = get_terms( $tax, [
              'hide_empty' => false, // do not hide empty terms
              'orderby' => 'id',
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
                <?php 
                    $args = array(
                        'posts_per_page'   => -1,
                        'category_name'    => $term->slug,
                        'orderby'          => 'date',
                        'order'            => 'DESC',
                        'post_type'        => 'equipment',
                        'suppress_filters' => true 
                    );
                    $posts = get_posts( $args );
                ?>  
            
                <select class="select-model">
                    <option value=""> Select a model </option>
                    <?php foreach($posts as $post){ ?>
                        <?php $field = get_field("price_high", $post->ID); ?>
                        <option value="<?php echo $post->ID; ?>"> <?php echo $post->post_title; ?></option>
                    <?php } ?>
                </select>
                
            </div>
        </div>
       <?php } // end for loop ?>
      <div class="clearfix"></div>
  </div><!-- end row-->
    </div><!-- end container-->
    
    <div class="clearfloat"></div>
    <?php 
        $args = array (
            'p'         => $_GET('p'),
            'post_type' => 'equipment',
        );
        $query = new WP_Query( $args );

        if ( $query->have_posts() ) {
            while ( $query->have_posts() ) {
                $query->the_post();
    ?>
        <div id="page_2" class="container">
            <p class="est_title">Please fill in your device details:</p>
            <div class="est_model_info">
                <div class="est_model_thumb_container">
                    <img id="est_model_thumb" title="Model Name" src="<?php echo z_taxonomy_image_url($term->term_id); ?>" alt="Model Name" />
                </div>
                <h4 id="est_model_title">Model Name</h4>
                <p>
                    Estimate: <span id="est_model_price">$0.00</span> Please note: The price above assumes your equipment is in good condition and 100% operational.
                </p>
            </div>


    <?php 
        }
    } 
     ?>



    



        
    <div class="clearfloat"></div>
    <div id="page_5" style="display: none;">
        <h1>Mac-Estimator</h1>
        <div class="est_model_info">
            <h4 id="est_model_title_zeroval"></h4>
            <span id="est_model_price_zeroval">Estimate: $0</span> We can recycle this product! When you recycle with us, your equipment may be either donated or disassembled. We properly erase all data (even if the equipment is non-functional). Upon disassembly, key components which can be reused are removed. Remaining parts are recycled by our R2 certified electronics recycling company.
        </div>
        <div class="est_model_form">
            <form id="estimator_submission_form_zeroval" class="estimator_form" enctype="multipart/form-data">
                <div id="page_7" class="est_info_form">
                    <table border="0" cellspacing="0" cellpadding="0">
                        <tbody>
                            <tr id="est_form_disclaimer_zeroval">
                                <td>Your item has a zero-dollar market value. We can recycle your product for you. If you wish to proceed, fill in the form and we'll send you a prepaid shipping label. When you receive your shipping label, just pack your product in a box and send it to us. Fields marked with an asterisk (*) are required.</td>
                            </tr>
                            <tr class="est_form_contact_info">
                                <td>Contact Information</td>
                            </tr>
                            <tr>
                                <td>Email Address*:
                                    <input class="required_field" name="estimator_form_email_address" type="text" />
                                </td>
                            </tr>
                            <tr>
                                <td>First Name*:
                                    <input class="required_field" name="estimator_form_first_name" type="text" />
                                </td>
                            </tr>
                            <tr class="est_form_last_name">
                                <td>Last Name*
                                    <input class="required_field" name="estimator_form_last_name" type="text" />
                                </td>
                            </tr>
                            <tr id="est_form_shipping_info">
                                <td>Shipping Information</td>
                            </tr>
                            <tr>
                                <td>Street Address*:
                                    <input class="required_field" name="estimator_form_address" type="text" />
                                </td>
                            </tr>
                            <tr>
                                <td>Apartment, Suite, Building:
                                    <input name="estimator_form_address_line2" type="text" />
                                </td>
                            </tr>
                            <tr>
                                <td>City*:
                                    <input class="required_field" name="estimator_form_city" type="text" />
                                </td>
                            </tr>
                            <tr id="est_form_state">
                                <td>State*:
                                    <select class="required_field" name="estimator_form_state">
                                        <option value="">Select State</option>
                                        <option value="AL">Alabama</option>
                                        <option value="AK">Alaska</option>
                                        <option value="AZ">Arizona</option>
                                        <option value="AR">Arkansas</option>
                                        <option value="CA">California</option>
                                        <option value="CO">Colorado</option>
                                        <option value="CT">Connecticut</option>
                                        <option value="DE">Delaware</option>
                                        <option value="DC">District Of Columbia</option>
                                        <option value="FL">Florida</option>
                                        <option value="GA">Georgia</option>
                                        <option value="HI">Hawaii</option>
                                        <option value="ID">Idaho</option>
                                        <option value="IL">Illinois</option>
                                        <option value="IN">Indiana</option>
                                        <option value="IA">Iowa</option>
                                        <option value="KS">Kansas</option>
                                        <option value="KY">Kentucky</option>
                                        <option value="LA">Louisiana</option>
                                        <option value="ME">Maine</option>
                                        <option value="MD">Maryland</option>
                                        <option value="MA">Massachusetts</option>
                                        <option value="MI">Michigan</option>
                                        <option value="MN">Minnesota</option>
                                        <option value="MS">Mississippi</option>
                                        <option value="MO">Missouri</option>
                                        <option value="MT">Montana</option>
                                        <option value="NE">Nebraska</option>
                                        <option value="NV">Nevada</option>
                                        <option value="NH">New Hampshire</option>
                                        <option value="NJ">New Jersey</option>
                                        <option value="NM">New Mexico</option>
                                        <option value="NY">New York</option>
                                        <option value="NC">North Carolina</option>
                                        <option value="ND">North Dakota</option>
                                        <option value="OH">Ohio</option>
                                        <option value="OK">Oklahoma</option>
                                        <option value="OR">Oregon</option>
                                        <option value="PA">Pennsylvania</option>
                                        <option value="RI">Rhode Island</option>
                                        <option value="SC">South Carolina</option>
                                        <option value="SD">South Dakota</option>
                                        <option value="TN">Tennessee</option>
                                        <option value="TX">Texas</option>
                                        <option value="UT">Utah</option>
                                        <option value="VT">Vermont</option>
                                        <option value="VA">Virginia</option>
                                        <option value="WA">Washington</option>
                                        <option value="WV">West Virginia</option>
                                        <option value="WI">Wisconsin</option>
                                        <option value="WY">Wyoming</option>
                                    </select>
                                </td>
                            </tr>
                            <tr id="est_form_zip_code">
                                <td>Zip Code*:
                                    <input class="required_field" name="estimator_form_zip_code" type="text" />
                                </td>
                            </tr>
                            <tr class="est_form_submit">
                                <td>
                                    <a title="Back" href="#1"><img title="Back" src="<?php echo get_template_directory_uri (); ?>/images/estimator-form-btn-back.jpg" alt="Back" border="0" /></a>
                                    <a class="estimator_form_btn_back" title="Submit" href="#8"><img title="Submit" src="<?php echo get_template_directory_uri (); ?>/images/estimator-form-btn-submit.jpg" alt="Submit" border="0" /></a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <table id="page_8" style="display: none;" border="0" cellspacing="0" cellpadding="0">
                    <tbody>
                        <tr>
                            <td class="form_sumbission_message_title">
                                <h2>Please Wait!</h2>
                            </td>
                        </tr>
                        <tr>
                            <td class="form_sumbission_message_text">We are processing your submission.</td>
                        </tr>
                        <tr class="est_form_submit">
                            <td>
                                <a class="estimator_form_btn_back" title="Back" href="#7"><img title="Back" src="<?php echo get_template_directory_uri (); ?>/images/estimator-form-btn-back.jpg" alt="Back" border="0" /></a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </form>
        </div>
        <div class="clearfloat"></div>
    </div>
    <!-- EST WRAPPER -->
</div>
<!-- Estimator stops here -->

<!-- Rest of the home page -->
<div class="container serial-number">
    <div class="row">
        <ul id="serialnumber">
            <li id="serialnumber-first" class="col-lg-3 col-md-3 col-sm-4 col-xs-12"><a href="javascript:void(0);" title="Apple Serial Number Finder" id="est_promo_serial" onclick="window.open('https://selfsolve.apple.com/agreementWarrantyDynamic.do','','width=1000,height=500');return false;">Find By Serial Number</a></li>
            <li id="serialnumber-second" class="col-lg-6 col-md-6 col-sm-4 col-xs-12">Please use Apple's Serial Number tool to find the correct model.</li>
            <li id="serialnumber-last" class="col-lg-3 col-md-3 col-sm-4 col-xs-12"><a id="est_promo_serial" title="Apple Serial Number Finder">Apple Serial Number lookup</a></li>
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
                <li id="whysell-second" class="col-lg-3 col-md-3 col-sm-3 col-xs-6">We pay higher and quicker than our competition.</li>
                <li id="whysell-third" class="col-lg-3 col-md-3 col-sm-3 col-xs-6">We pay for shipping. <br> (US sellers only)</li>
                <li id="whysell-fifth" class="col-lg-3 col-md-3 col-sm-3 col-xs-6">Testing and secure data destruction by our Apple Certified Technicians.</li>
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

    <div class="container bottom-callout-container">
        <div class="row">
            <div id="buybox" class="buybox-item col-lg-5 col-md-5 col-sm-5 col-xs-12 hidden-xs">
                <h3>Need to buy a used Mac?</h3> 
                <img id="buybox-bg" src="<?php echo get_template_directory_uri (); ?>/images/buy-box-bg.png" alt="Apple devices" />
                <p>Get a great deal on iMacs, Mac Pros, Macbooks, Macbook Airs, iPads, iPhones and more at</p>
                <div class="clearfix"></div>
                <div class="row">
                    <img src="<?php echo get_template_directory_uri (); ?>/images/moat-logo.png" alt="Mac of All Trades - Shop Now" class="moat-logo"/>
                    <a title="Mac of All Trades" href="http://www.macofalltrades.com" target="_blank" class="btn-shop-now">Shop Now</a>
                </div><!-- end row-->
            </div><!-- end buybox-->

            <div id="selltextbox" class="buybox-item col-lg-5 col-md-5 col-sm-5 col-xs-12 hidden-xs pull-right">
                <h3>Sell in volume</h3> 
                <img id="sellbox-bg" src="<?php echo get_template_directory_uri (); ?>/images/sell-box-bg.png" alt="Apple computers" />
                <p>Do you want to sell more than 5 products?</p>
                <div class="clearfix"></div>
                <div class="row">
                    <a title="Click here to sell in volume" href="/sell-in-volume/" class="btn-shop-now">Click Here</a>
                </div><!-- end row-->
            </div> <!-- end selltextbox-->

            <!-- since mobile is drastically different this is the best way to do this -->
            <div id="buybox" class="buybox-item visible-xs hidden-sm hidden-md hidden-lg ">
                <div class="row">
                    <h3>Need to buy a used Mac?</h3> 
                    <p>Get a great deal on iMacs, Mac Pros, Macbooks, Macbook Airs, iPads, iPhones and more at</p>
                    <img src="<?php echo get_template_directory_uri (); ?>/images/moat-logo.png" alt="Mac of All Trades - Shop Now" class="moat-logo"/>
                </div>
                <div class="row">
                    <img id="buybox-bg" src="<?php echo get_template_directory_uri (); ?>/images/buy-box-bg.png" alt="Apple devices" />
                    <a title="Mac of All Trades" href="http://www.macofalltrades.com" target="_blank" class="btn-shop-now">Shop Now</a>
                </div><!-- end row-->
            </div><!-- end buybox-->

            <div id="selltextbox" class="buybox-item visible-xs hidden-sm hidden-md hidden-lg">
                <div class="row">
                    <h3>Sell in volume</h3> 
                    <p>Do you want to sell more than 5 products?</p>
                    <img id="sellbox-bg" src="<?php echo get_template_directory_uri (); ?>/images/sell-box-bg.png" alt="Apple computers" />
                </div>
                <div class="row">
                    <a title="Click here to sell in volume" href="/sell-in-volume/" class="btn-shop-now">Click Here</a>
                </div><!-- end row-->
            </div> <!-- end selltextbox-->
        </div>
    </div>
    
</div>

<?php get_footer(); ?>