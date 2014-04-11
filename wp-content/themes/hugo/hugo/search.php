<?php
/**
 * Template for Search results pages
 *
 * @package Hugo
 * @since Hugo 1.0
 */

get_template_part('templates/header'); ?>

<div class="main-content col-8-12">

    <?php if ( have_posts() ) : ?>

        <header class="archive-header">
            <h1 class="archive-title"><?php printf( __( 'Search Results for: %s', 'hugo' ), get_search_query( '', false ) ); ?></h1>
        </header>

        <?php
            while (have_posts()) : the_post();

                get_template_part('templates/content', get_post_format());

            endwhile;

            hugo_page_nav();

        else :

            get_template_part('templates/content', 'nope');

        endif; ?>

</div> <!-- /.main-content -->
<?php
get_sidebar();
get_template_part('templates/footer');