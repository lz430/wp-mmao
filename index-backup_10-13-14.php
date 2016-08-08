<?php
/**
 * Template Name: Coming Soon
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	<title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>
	<link href="/wp-content/themes/custom/style.css" rel="stylesheet" type="text/css" />
</head>
<?php remove_filter ('the_content', 'wpautop'); ?>
<body <?php body_class($class); ?>> 
<div id="page_wrapper">

<div id="header-wrapper">
    <div id="header">
        <a href="/" title="mac me an offer" id="header-logo">a division of macofalltrades.com</a>
    </div>
</div>

	<div id="blog_content" class="narrowcolumn">	
		<?php if (have_posts()) : ?>
		<?php while (have_posts()) : the_post(); ?>
			<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
				<div class="entry section">
					<?php the_content('Read the rest of this entry &raquo;'); ?>
				</div>
		<?php endwhile; endif; ?>
	</div>
<div id="footer-wrapper">
    <div id="footer">
        <p><span>mac me an offer values your privacy</span><img src="/wp-content/themes/custom/images/footer-secure.png" title="100% Secure" alt="100% Secure" /></p>
    </div>
</div>
<div id="subfooter">
    <p id="copyright">&copy; <script type="text/javascript">document.write((new Date()).getFullYear());</script> mac of all trades.<br />Apple and the Apple logo are registered trademarks of Apple Inc.</p>
    <p id="powerdesign">Powered by <a href="http://www.wordpress.com" title="WordPress" target="_blank">WordPress</a><br />Designed by <a href="http://www.brandlabs.us/" title="Brand Labs" target="_blank">Brand Labs</a></p>
</div>

</div>
</body>
</html>