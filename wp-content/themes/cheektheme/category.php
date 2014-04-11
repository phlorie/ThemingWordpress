<?php get_header(); ?>
<div class="main">
	<h2>Catégorie <?php single_cat_title(); ?></h2>
	<?php get_template_part('loop'); ?>
</div>
<?php
get_sidebar();
get_footer();
?>