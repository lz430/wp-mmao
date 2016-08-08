<?php
/**
 * Template Name: Why Sell
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
get_header(); ?>

<?php 
    if (have_posts()) : while (have_posts()) : the_post(); 
        $bgImage = get_field("heading_background");
?>
    <div class="container-fluid interior-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
                    <h1><?php the_title(); ?></h1>
                    <h3>
                        <?php 
                            $sub_heading = get_field( "sub_heading" ); 
                            echo $sub_heading;
                        ?>
                    </h3>
                    <p>
                        <?php 
                            $heading_content = get_field( "heading_content" ); 
                            echo $heading_content;
                        ?>
                    </p>
                </div><!-- end column-->
                <div class="col-lg-4 col-md-5 col-sm-5 col-xs-12 pull-right">
                    <img src="<?php echo $bgImage; ?>" alt="Why sell to mac me an offer?" class="why-sell-header">
                </div>
            </div><!-- end row-->
        </div> <!-- end container-->    
    </div> <!-- end container-fluid-->    
    <div class="container">
        <div class="row">
            <?php
                $image = get_field("big_image");
                if( !empty($image) ): ?>
                    <img class="img-responsive" src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
            <?php endif; ?>
        </div>
    </div>
    <div class="container-fluid subsection-heading">
        <div class="row">
            <h2 class="container"> <?php $subsectionHeading = get_field("subsection_heading"); echo $subsectionHeading; ?></h2>
        </div>
    </div>

    <div class="container-fluid subsection-content why-sell">
        <div class="row">
                <?php 
                    $subsection = get_field("subsection"); 
                    echo $subsection;
                 ?>
        </div>
    </div>
<?php endwhile; endif; ?>
<?php get_footer(); ?>