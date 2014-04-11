<?php
/**
 * Full width post template (without sidebar)
 *
 * @package Hugo
 * @since Hugo 1.0
 */
?>

<div class="main-content col-1-1">
    <?php while ( have_posts() ) : the_post();

            get_template_part('templates/content');

            hugo_page_nav();

            if ( comments_open() || get_comments_number() ) {

                comments_template('/templates/comments.php');

            }

        endwhile;
    ?>
</div>