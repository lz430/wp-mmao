<?php
/**
 * Template Name: About us
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
        <div class="container" style="background-image: url(<?php echo $bgImage; ?>)">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <h1><?php the_title(); ?></h1>
                    <?php 
                        $sub_heading = get_field( "sub_heading",false, false ); 
                        $subsection = get_field( "subsection",false, false ); 
                        if($sub_heading){
                    ?>
                    <h3>
                        <?php
                            echo $sub_heading;
                            }
                        ?>
                    </h3>
                    <p>
                        <?php echo $subsection; ?>
                    </p>
                </div>
                <!-- <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 pull-right">
                    <p>
                        <?php 
                            $heading_content = get_field( "heading_content", false, false ); 
                            echo $heading_content;
                        ?>
                    </p>
                </div> --><!-- end right column-->
            </div><!-- end row-->
        </div> <!-- end container-->    
    </div> <!-- end container-fluid-->    
    <div class="container big-image">
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

    <div class="container subsection-content">
        <div class="row">
            <?php 
                the_content();
             ?>
        </div>
    </div>
<?php endwhile; endif; ?>
<?php get_footer(); ?>