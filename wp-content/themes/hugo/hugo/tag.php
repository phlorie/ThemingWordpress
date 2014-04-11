<?php
/**
 * The template for displaying Tag pages
 * Used to display archive-type pages for posts in a tag.
 *
 * @package Hugo
 * @since Hugo 1.0
 */

get_template_part('templates/header'); ?>

<div class="main-content col-8-12">

    <?php if ( have_posts() ) : ?>

        <header class="archive-header">
            <h1 class="archive-title"><?php printf( __( 'Tag Archives: %s', 'hugo' ), single_tag_title( '', false ) ); ?></h1>
            <?php // Term description
                $term_desc = term_description();
                if (!empty($term_desc)) :
                    printf('<div class="taxonomy-desc">%s</div>', $term_desc);
                endif;
            ?>
        </header>

    <?php // Start the loop
            while (have_posts()) : the_post();

                get_template_part('templates/content', get_post_format());

            endwhile;

                // Previous/next page nav
                hugo_page_nav();

        else :

            // If no content, load "nope" template
            get_template_part('templates/content', 'nope');

        endif; ?>

</div> <!-- /.main-content .col-8-12 -->
<?php
get_sidebar();
get_template_part('templates/footer');
