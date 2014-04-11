<div class="main loop">
	<?php if (have_posts()) : ?>
		<?php while (have_posts()) : the_post(); ?>
			<div class="post">
				<h2 class="post-title">
					<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				</h2>
				<p class="post-info">
					Posté le <?php the_date(); ?> dans <?php the_category(', '); ?> par <?php the_author(); ?>.
				</p>
				<div class="post-content">
					<?php the_content(); ?>
				</div>
			</div>
			<hr>
		<?php endwhile; ?>

	<?php else : ?>
		<div id="post-0" class="post error404not-found">
			<h2 class="entry-title">Not found</h2>
			<div class="entry-content"></div>
				<p>Désolé, cette page n'existe pas.</p>
				<?php get_search_form(); ?>
			</div>
		</div>
	<?php endif; ?>
</div>