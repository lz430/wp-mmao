<div id="footer-wrapper" class="fluid-container">
    <div id="footer" class="container">
      <div class="row">
            <?php 
                wp_nav_menu( array( 
                  'theme_location' => 'footer-nav',
                  'container_class' => 'col-lg-9 col-md-9 col-sm-12 col-xs-12',
                  'container_id' => 'footer-nav' ));
                ?>
            <p class="col-lg-3 col-md-3 col-sm-12 col-xs-12"><span>mac me an offer values your privacy</span><img src="<?php echo get_template_directory_uri() ?>/images/footer-secure.png" title="100% Secure" alt="100% Secure" /></p>
        </div><!-- end col-lg-12 col-md-12 col-sm-12 col-xs-12-->
      </div><!-- end row-->
  </div>
<div id="subfooter" class="container">
  <div class="row">
    <div id="copyright" class="col-lg-6 col-md-6 col-sm-9 col-xs-12">
      <p>
        &copy; <?php echo date("Y") ?> mac of all trades.<br />Apple and the Apple logo are registered trademarks of Apple Inc.
      </p>
    </div>
    <p id="powerdesign" class="col-lg-6 col-md-6 col-sm-3 col-xs-12 pull-right">
      Powered by <a href="http://www.wordpress.com" title="WordPress" target="_blank">WordPress</a>
      <br>
      Designed by <a href="http://www.brandlabs.us/" title="Brand Labs" target="_blank">Brand Labs</a>
    </p>
  </div><!-- end row-->
</div><!-- end container-->
</div> <!-- end page_wrapper-->
  <?php wp_footer(); ?>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
  ga('create', 'UA-3463382-3', 'macmeanoffer.com');
  ga('require', 'displayfeatures');
  ga('send', 'pageview');
</script>
</body>
</html>