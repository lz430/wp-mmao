<div id="blog_search">
  <form method="get" id="blog_searchform" action="<?php bloginfo('home'); ?>/">
    <div>
      <input type="text" value="Search our blog" name="s" id="s" onfocus="inputTextClicked(this, '#606060');" onblur="inputTextBlurred(this, '#606060');" />
	  <!--<input src="<?php bloginfo('stylesheet_directory'); ?>/images/blog_search_button.gif" type="image" id="searchsubmit" value="Search" />-->
	   <a onclick="document.forms['blog_searchform'].submit()" title="Go"></a>
    </div>
  </form>
</div>