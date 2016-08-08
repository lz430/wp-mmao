<?php
/**
 * @package WordPress
 * @subpackage Brandlabs Theme
*/
?>
<div id="sidebar" class="block">
  <ul class="cg">
    <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar()): ?>
    <li id="sidebar_rss" class="section"><a href="feed:<?php bloginfo('rss2_url'); ?>" title="<?php _e('Entries RSS'); ?>">
    	<img src="<?php bloginfo('template_directory')?>/images/rss_button.gif" alt ="RSS Feed" title="RSS Feed"/></a></li>
	<li id="sidebar_search" class="section">
      <?php get_search_form(); ?>
    </li>
    <?php if (is_404() || is_category() || is_day() || is_month() || is_year() || is_search() || is_paged()) { ?>
    <!--<li class="hide">
    <?php /* If this is a 404 page */ if (is_404()) { ?>
    <?php /* If this is a category archive */ } elseif (is_category()) { ?>
    <p>You are currently browsing the archives for the <?php single_cat_title(''); ?> category.</p>
    <?php /* If this is a yearly archive */ } elseif (is_day()) { ?>
    <p>You are currently browsing the <a href="<?php bloginfo('url'); ?>/"><?php echo bloginfo('name'); ?></a> archives
    for the day <?php the_time('l, F jS, Y'); ?>.</p>
    <?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
    <p>You are currently browsing the <a href="<?php bloginfo('url'); ?>/"><?php echo bloginfo('name'); ?></a> archives
    for <?php the_time('F, Y'); ?>.</p>
    <?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
    <p>You are currently browsing the <a href="<?php bloginfo('url'); ?>/"><?php echo bloginfo('name'); ?></a> archives
    for the year <?php the_time('Y'); ?>.</p>
    <?php /* If this is a monthly archive */ } elseif (is_search()) { ?>
    <p>You have searched the <a href="<?php echo bloginfo('url'); ?>/"><?php echo bloginfo('name'); ?></a> archives
    for <strong>'<?php the_search_query(); ?>'</strong>. If you are unable to find anything in these search results, you can try one of these links.</p>
    <?php /* If this is a monthly archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
    <p>You are currently browsing the <a href="<?php echo bloginfo('url'); ?>/"><?php echo bloginfo('name'); ?></a> archives.</p>
    <?php } ?>
    </li>-->
    <?php } ?>
	<!--Recent Posts-->
    <li id="sidebar_posts" class="section">
      <div class="sidebar_header">
        <img src="<?php bloginfo('template_directory')?>/images/sidebar_posts.gif" alt ="Posts" title="Posts"/><h2>Posts</h2>
      </div>
      <?php query_posts /* enter # of posts here----> */('showposts=10'); ?>
      <ul>
        <?php  while (have_posts()): the_post(); ?>
        <li><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>">
            <?php
            the_title();
            ?>
          </a></li>
        <?php
        endwhile;
        ?>
      </ul>
    </li>
    <!--Tag Cloud-->
    <?php if (function_exists('wp_tag_cloud')): ?>
    <li id="sidebar_tagcloud" class="section">
      <div class="sidebar_header">
        <img src="<?php bloginfo('template_directory')?>/images/sidebar_tagcloud.gif" alt ="Tag Cloud" title="Tag Cloud" /><h2>Tag Cloud</h2>
      </div>
      <ul>
        <li> <?php wp_tag_cloud('smallest=8&largest=22'); ?> </li>
      </ul>
    </li>
    <?php endif; ?>
    <li id="sidebar_topics" class="section">
      <div class="sidebar_header">
        <img src="<?php bloginfo('template_directory')?>/images/sidebar_topics.gif" alt ="Topics" title="Topics"/><h2>Topics</h2>
      </div>
      <ul>
        <?php wp_list_categories('show_count=1&title_li=&style=list');  ?>
      </ul>
    </li>
    <li id="sidebar_pages" class="section">
      <div class="sidebar_header">
        <img src="<?php bloginfo('template_directory')?>/images/sidebar_pages.gif" alt ="Pages" title="Pages"/><h2>Pages</h2>
      </div>
      <ul><?php wp_list_pages('title_li=' ); ?></ul>
    </li>
    <li id="sidebar_archives" class="section">
      <div class="sidebar_header">
        <img src="<?php bloginfo('template_directory')?>/images/sidebar_archives.gif" alt ="Archives" title="Archives"/><h2>Archives</h2>
      </div>
      <ul>
        <?php wp_get_archives('type=monthly'); ?>
      </ul>
    </li>
    <li id="sidebar_promo" class="section">
		<div id="display_promotions_999">
			<!--Add Navpromo HTML here--->
     	</div>
	</li>
	<?php
    /* If this is the frontpage */
    if (is_home() || is_page())
    { ?>
	<li id="sidebar_links" class="section">
	<?php wp_list_bookmarks(); ?>
	</li>
    <li id="sidebar_meta" class="section">
      <div class="sidebar_header">
        <img src="<?php bloginfo('template_directory')?>/images/sidebar_meta.gif" alt="Meta" title="Meta" /><h2>Meta</h2>
      </div>
      <ul>
        <?php wp_register();?>
        <li>
          <?php wp_loginout(); ?>
        </li>
        <li><a href="feed:<?php bloginfo('rss2_url'); ?>" title="<?php _e('Entries RSS'); ?>">
            <?php _e('Entries RSS');  ?>
          </a></li>
        <li>
          <?php comments_rss_link('Comments RSS'); ?>
        </li>
        <?php // wp_meta(); ?>
      </ul>
    </li>
    <?php } ?>
    <?php endif;?>
  </ul>
</div>