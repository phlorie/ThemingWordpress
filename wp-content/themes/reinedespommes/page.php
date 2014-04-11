<?php 
get_header(); ?>
<div class="main page">
	<?php if(have_posts()) : ?>
		<?php while (have_posts()) : the_post(); ?>
			<div class="post">
				<h2 class="post-title"><?php the_title(); ?></h2>
				<div class="post-info"></div>
				<div class="post-content">
					<?php the_content(); ?>
				</div>
			</div>
		<?php endwhile; ?>
	<?php endif; ?>
</div>
<?php
get_sidebar();
get_footer();
?>