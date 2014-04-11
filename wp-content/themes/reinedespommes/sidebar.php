<div class="side">
	<div id="slogan">Oui oui, je suis une greluche</div>
	<div id="contact">
		<h3>Mail de contact :</h3>
		lagiraferadioactive@gmail.com
	</div>
	<div id="reseaux-sociaux">
		<h3>Suivez-moi</h3>
		<div class="twitter"><a href="https://twitter.com/RDpommes"><img src="<?php bloginfo('template_directory'); ?>/img/twitter.png" /></a></div>
		
		<div class="hellocoton"><a href="http://www.hellocoton.fr/mapage/lareinedespommes"><img src="<?php bloginfo('template_directory'); ?>/img/hellocoton.png" /></a></div>
	</div>
	<div id="search">
		<h3>Rechercher</h3>
		<form method="get" id="searchform" action="<?php bloginfo('url'); ?>">
			<input type="text" value="<?php the_search_query(); ?>" name="s" class="search" />
			<input type="submit" id="submit" value="Hop !" />
		</form>
	</div>

	<div id="derniers-articles">
		<h3>Derniers articles</h3>
		<ul>
		<?php
		    $recentPosts = new WP_Query();
		    $recentPosts->query('showposts=5');
			while ($recentPosts->have_posts()) : $recentPosts->the_post(); ?>
		    	<li><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></li>
		<?php endwhile; ?>
		</ul>
	</div>

	<div id="archives">
		<h3>Archives</h3>
		<ul>
			<?php wp_get_archives('type=monthly'); ?>
		</ul>
	</div>
</div>