<?php
/**
 * Main template file.
 *
 * @package Hugo
 * @since Hugo 1.0
 */

get_template_part('templates/header');

if ( function_exists( 'get_option_tree') ) {
    $theme_options = get_option('option_tree');
}

$layout = get_option_tree('homepage_layout',$theme_options);

// Choose the layout with options used in admin pannel.
if ( $layout == "left-sidebar" ) : // Left sidebar homepage
    get_sidebar();
    echo '<div class="main-content col-8-12">';

elseif ( $layout == "full-width" ) : // Full width homepage
    echo '<div class="main-content col-1-1">';

elseif ( $layout == "right-sidebar" ) : // Right sidebar homepage
    echo '<div class="main-content col-8-12">';

endif;

        if ( have_posts() ) :

            while (have_posts()) : the_post(); // Start the loop

                get_template_part('templates/content', get_post_format());

            endwhile;

                // Previous/next page nav
                hugo_page_nav();

        else :

                // If no content, load "nope" template
                get_template_part('templates/content', 'nope');

        endif;

    echo '</div>';

if ( $layout == "right-sidebar" ) : // Right sidebar homepage
    get_sidebar();
endif;

get_template_part('templates/footer');


/**
 * @todo add nivo slider
 */
/*
if ( is_home() && function_exists('show_nivo_slider') ) {
    show_nivo_slider();
}
*/
