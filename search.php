<?php
/**
 * @package WordPress
 * @subpackage Brandlabs Theme
 */

get_header(); ?>
	<div id="blog_content" class="narrowcolumn search section">
	<?php if (have_posts()) : ?>
		<h2 class="pagetitle">Search Results</h2>
		<div class="navigation">
			<div class="alignleft"><?php next_posts_link('&laquo; Older Entries') ?></div>
			<div class="alignright"><?php previous_posts_link('Newer Entries &raquo;') ?></div>
		</div>
		<?php while (have_posts()) : the_post(); ?>
			<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
				<?php include (TEMPLATEPATH . '/includes/postheader.php');?>
				<div class="postfooter section">
					<?php include (TEMPLATEPATH . '/includes/postbyline.php');?>
					<?php include (TEMPLATEPATH . '/includes/postmeta.php');?>	
				</div>	
				<?php include (TEMPLATEPATH . '/includes/postedit.php');?>
			</div>

		<?php endwhile; ?>

		<div class="navigation">
			<div class="alignleft"><?php next_posts_link('&laquo; Older Entries') ?></div>
			<div class="alignright"><?php previous_posts_link('Newer Entries &raquo;') ?></div>
		</div>

	<?php else : ?>

		<h2 class="center">No posts found. Try a different search?</h2>
		<?php get_search_form(); ?>

	<?php endif; ?>

	</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>