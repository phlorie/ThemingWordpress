<article id="post-<?php the_ID(); ?>" class="<?php post_class(); ?>">
	<?php
		if(is_singular()){
	?>
			<div id="head-article" class="entry-header">
				<h1 class="entry-title"><?php the_title(); ?></h1>
	<?php
		} else {
	?>
				<h2 class="entry-title">
					<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark">
						<?php the_title(); ?>
					</a>
				</h2>
	<?php
		}
	?>
			</div>

	<?php
		if(is_home() || is_front_page() || is_archive() || is_search()) :
	?>
			<div class="entry-summary">
				<?php the_excerpt(); ?>
				<div class="read-more">
					<?php
						if (comments_open()){
					?>
							<span class="comments-link">
								<?php comments_popup_link("Laisser un commentaire", "1 commentaire","% commentaires"); ?>
							</span> &bull;
					<?php
						}
					?>
					<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark">Continuer à lire &rarr;</a>
				</div>
			</div>

</article>