<?php
/**
 * Template Name: Sell in Volume
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
        <div class="container" <?php if( get_field('heading_background') ): ?> style="background-image: url(<?php echo $bgImage; ?>);min-height: 290px;"
<?php endif; ?>>
            <div class="row">
                <?php if( get_field('heading_background') ): ?>
                    <div class="col-lg-6 col-md-6 col-sm-7 col-xs-12">
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
                    <?php endif; ?>
                </div>
            </div><!-- end row-->
            <div class="row">
                <div class="col-xs-12 hidden-lg hidden-md hidden-sm">
                        <img src="<?php echo $bgImage ?>" alt="" class="header-image">
                </div>
            </div>
        </div> <!-- end container-->    
    </div> <!-- end container-fluid--> 
    <div class="container">
        <div class="row">
            <?php the_content(); ?>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <?php
                $image = get_field("big_image");
                if( !empty($image) ): ?>
                    <img class="img-responsive" src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
            <?php endif; ?>
        </div>
    </div>
    <?php if( get_field('subsection_heading') ): ?>
        <div class="container-fluid subsection-heading">
            <div class="row">
                <h2 class="container"> <?php $subsectionHeading = get_field("subsection_heading"); echo $subsectionHeading; ?></h2>
            </div>
        </div>
    <?php endif; ?>

    <div class="container-fluid subsection-content">
        <div class="row">
            <?php 
                $subsectionContent = get_field("subsection"); echo $subsectionContent;
             ?>
        </div>
    </div>
<?php endwhile; endif; ?>
<?php get_footer(); ?>