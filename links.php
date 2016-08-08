<?php
/**
 * @package WordPress
 * @subpackage Brandlabs Theme
 */

/*
Template Name: Links
*/
?>

<?php get_header(); ?>

<div id="blog_content" class="widecolumn">
<?php include (TEMPLATEPATH . '/includes/blogheader.php');?>
<h2>Links:</h2>
<ul>
<?php wp_list_bookmarks(); ?>
</ul>

</div>

<?php get_footer(); ?>
