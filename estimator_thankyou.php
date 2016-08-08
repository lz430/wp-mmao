<?php
/**
 * @package WordPress
 * @subpackage Brandlabs Theme
 */

/*
Template Name: Estimator_Thankyou
*/
?>
<?php include (TEMPLATEPATH . 'cdev/estimator/thank-you.php');?>



<?php get_header(); ?>

	<?php include (TEMPLATEPATH . '/includes/blogheader.php');?>
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div class="post" id="post-<?php the_ID(); ?>">
			<div class="entry section">
				<?php the_content('<p class="serif">Read the rest of this page &raquo;</p>'); ?>				
			</div>
		</div>
		<?php endwhile; endif; ?>
	<?php include (TEMPLATEPATH . '/includes/postedit.php');?>

	



<?php get_footer(); ?>