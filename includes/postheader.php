<!--START Postheader-->
				<div class="postheader section">
					<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
					<div class="postinfo">
						<span class="postinfo_before">Posted: </span>
						<span class="postinfo_time">&nbsp;&nbsp;&nbsp;<?php the_time('l, F j, Y') 
						//the_time('m\/d\/Y') ?></span>
						<span class="postinfo_cat"> in <?php the_category(', ') ?></span>
					</div>
				</div>
<!--END Postheader-->				