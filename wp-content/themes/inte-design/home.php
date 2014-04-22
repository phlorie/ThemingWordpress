<?php 
get_header();
$nbposts = 0;
?>
<div class="main loop">
	<?php while (have_posts()) : the_post(); ?>
		<?php if (($nbposts % 6) == 0) { 
			echo '<div class="row-post">';
		} ?>
				<div class="post">
					<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
					<div class="details">
						<h2 class="post-title">
							<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
						</h2>
					</div>
				</div>
		<?php if (($nbposts % 6) == 5) {
			echo '</div>';
		} ?>
		<?php $nbposts++; ?>
	<?php endwhile; ?>
</div>

<?php
get_footer();
?>