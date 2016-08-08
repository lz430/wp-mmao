<?php
/**
 * @package WordPress
 * @subpackage Brandlabs Theme
 */

get_header(); ?>

	<div id="blog_content" class="narrowcolumn">
	<?php include (TEMPLATEPATH . '/includes/blogheader.php');?>
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div class="post" id="post-<?php the_ID(); ?>">
		<h2><?php the_title(); ?></h2>
			<div class="entry section">
				<?php the_content('<p class="serif">Read the rest of this page &raquo;</p>'); ?>
				<div class="postpages"><?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?></div>
			</div>
		</div>
		<?php endwhile; endif; ?>
	<?php include (TEMPLATEPATH . '/includes/postedit.php');?>
	</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>