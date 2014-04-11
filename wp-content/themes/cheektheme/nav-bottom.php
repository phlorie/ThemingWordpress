<?php
	if($wp_query->max_num_pages > 1)
?>
		<div id="nav-below" class="navigation">
			<div class="nav-previous">
				<?php
					next_posts_link('<span clas="meta-nav">&larr;</span>Anciens articles');
				?>
			</div>
			<div class="nav-next">
				<?php
					previous_posts_link('<span clas="meta-nav">&rarr;</span>Articles récents');
				?>
			</div>
		</div>
<?php
	endif;
?>