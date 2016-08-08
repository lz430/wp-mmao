<?php
/**
 * @package WordPress
 * @subpackage Brandlabs Theme
 */
get_header(); ?>
	<div id="blog_content" class="narrowcolumn index block">
	<?php include (TEMPLATEPATH . '/includes/blogheader.php');?>
	<?php if (have_posts()) : ?>
		<?php while (have_posts()) : the_post(); ?>
			<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
				<?php include (TEMPLATEPATH . '/includes/postheader.php');?>
				<div class="entry section">
					<?php the_content('Read the rest of this entry &raquo;'); ?>
				</div>
				<div class="postfooter section">
					<?php include (TEMPLATEPATH . '/includes/postbyline.php');?>
					<?php include (TEMPLATEPATH . '/includes/postmeta.php');?>	
				</div>	
				<?php include (TEMPLATEPATH . '/includes/postedit.php');?>
			</div>
		<?php endwhile; ?>
		<?php include (TEMPLATEPATH . '/includes/postnav.php');?>
	<?php else : ?>
		<h2 class="center">Not Found</h2>
		<p class="center">Sorry, but you are looking for something that isn't here.</p>
		<?php get_search_form(); ?>
	<?php endif; ?>
	</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>