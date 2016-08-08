<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>

  <link rel="icon" href="http://macmeanoffer.com/favicon.ico" type="image/x-icon" />
  <link rel="shortcut icon" href="http://macmeanoffer.com/favicon.ico" type="image/x-icon" />
  <link rel="apple-touch-icon" sizes="57x57" href="/apple-touch-icon.png" />
  <link rel="apple-touch-icon-precomposed" sizes="72x72" href="http://macmeanoffer.com/apple-icon-72x72-precomposed.png" />
  <link rel="apple-touch-icon-precomposed" sizes="114x114" href="http://macmeanoffer.com/apple-icon-114x114-precomposed.png" />
  <link rel="apple-touch-icon-precomposed" sizes="144x144" href="http://macmeanoffer.com/apple-icon-144x144-precomposed.png" />
  
  <script type="text/javascript">
    setTimeout(function(){var a=document.createElement("script");
    var b=document.getElementsByTagName("script")[0];
    a.src=document.location.protocol+"//script.crazyegg.com/pages/scripts/0011/6197.js?"+Math.floor(new Date().getTime()/3600000);
    a.async=true;a.type="text/javascript";b.parentNode.insertBefore(a,b)}, 1);
  </script>
  <script type="text/javascript">
    var templateUrl = '<?= get_bloginfo("template_url"); ?>';
    var ajaxurl     = "<?php echo admin_url('admin-ajax.php'); ?>";
  </script>
  <?php wp_head(); ?>
</head>

<?php remove_filter ('the_content', 'wpautop'); ?>

<body <?php body_class(); ?>> 
<div id="page_wrapper" class="row-offcanvas row-offcanvas-right">
  <header class="fluid-container">
    <div class="container">
      <div class="row">
        <nav class="navbar navbar-default">
          <a href="/help/" title="Help" id="header-help">Help</a>
          <div class="navbar-header">
            <a href="<?php echo get_bloginfo("wpurl"); ?>" title="mac me an offer" id="header-logo" class="navbar-brand">
              <img src="<?php echo get_template_directory_uri(); ?>/images/macmeanoffer-logo-green.png" alt="<?php echo get_bloginfo("name"); ?>" class="img-responsive"/>
              <span>a division of macofalltrades.com</span>
            </a>
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
              <span class="text">Menu</span>
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
          </div> <!-- end navbar-header -->
          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse sidebar-offcanvas slideRight" id="bs-example-navbar-collapse-1">
            <?php 
            wp_nav_menu( array( 
              'theme_location'  => 'main-nav',
              'container'       => 'div',
              'container_class' => '',
              'container_id'    => 'header-nav',
              'menu_class'      => 'nav navbar-nav',
              'fallback_cb'     => 'wp_bootstrap_navwalker::fallback',
              'walker'          => new wp_bootstrap_navwalker() )
              );
            ?>
          </div><!-- /.navbar-collapse -->
        </nav>
      </div><!-- end row-->
    </div><!-- end container-->
  </header>