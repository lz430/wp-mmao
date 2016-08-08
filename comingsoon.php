<?php
/**
 * Template Name: Coming Soon with Links
 */

get_header(); ?>

	<div id="blog_content" class="narrowcolumn">	
		<?php if (have_posts()) : ?>
		<?php while (have_posts()) : the_post(); ?>
			<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
				<div class="entry section">
					<?php the_content('Read the rest of this entry &raquo;'); ?>
				</div>
		<?php endwhile; endif; ?>
	</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>