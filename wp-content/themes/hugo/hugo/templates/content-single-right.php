<?php
/**
 * Classic single post template.
 * Right sidebar
 *
 * @package Hugo
 * @since Hugo 1.0
 */
 ?>

<div class="main-content col-8-12">
    <?php while ( have_posts() ) : the_post();

            get_template_part('templates/content');

            hugo_page_nav();

            if ( comments_open() || get_comments_number() ) {

                comments_template('/templates/comments.php');

            }

        endwhile;
    ?>
</div>

<?php get_sidebar();