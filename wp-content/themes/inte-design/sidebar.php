<div class="side">
	<div id="search">
		<h3>Rechercher</h3>
		<form method="get" id="searchform" action="<?php bloginfo('url'); ?>">
			<input type="text" value="<?php the_search_query(); ?>" name="s" class="search" />
			<input type="submit" id="submit" />
		</form>
	</div>
	<div id="navigation">
		<h3>Menu</h3>
		<ul id="nav">
			<li><a href="<?php bloginfo('url'); ?>">Home</a></li>
			<?php wp_list_pages('depth=1&title_li='); ?>
			<?php wp_list_cats('sort_column=menu_order&depth=1&title_li=&show_count=0'); ?>
		</ul>
	</div>
	<div id="archives">
		<h3>Archives</h3>
		<ul>
			<?php wp_get_archives('type=monthly'); ?>
		</ul>
	</div>
</div>