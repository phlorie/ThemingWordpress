<?php 
get_header(); ?>
<div class="main single">
	<?php if(have_posts()) : ?>
		<?php while (have_posts()) : the_post(); ?>
			<div class="post">
				<h2 class="post-title"><?php the_title(); ?></h2>
				<p class="post-info">
					<?php the_date('d M'); ?>
				</p>
				<div class="post-content">
					<?php the_content(); ?>
				</div>
				<div class="post-comments">
					<?php comments_template(); ?>
				</div>
			</div>
		<?php endwhile; ?>
	<?php endif; ?>
</div>
<?php
get_sidebar();
get_footer();
?>