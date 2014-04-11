<?php
/**
 * Template for all Pages
 *
 * @package Hugo
 * @since Hugo 1.0
 */

get_template_part('templates/header');
?>
<div class="main-content col-1-1">
    <?php

        if ( have_posts() ) :

            while (have_posts()) : the_post();

                get_template_part( 'templates/content', 'page' );

            endwhile;

        endif;

    ?>
</div>
<?php
get_template_part('templates/footer');