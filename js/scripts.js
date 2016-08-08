(function ($, root, undefined) {
	$(function () {
		'use strict';
		jQuery('.navbar-toggle').on('click', function() {
         // jQuery('#header-nav').addClass('slideRight');
         jQuery('#page_wrapper').toggleClass("active");
        });


        jQuery(document).ready(function(){
          jQuery('#menu-main li > i').parent().prependTo("#menu-main");
          jQuery('.buybox-item p > img').unwrap();
        });
	});
})(jQuery, this);
