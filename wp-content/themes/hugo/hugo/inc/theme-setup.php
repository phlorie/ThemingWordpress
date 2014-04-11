<?php
/**
 * Theme setup
 *
 * @package Hugo
 * @since Hugo 1.0
 */

/*
 * Custom Excerpt length
 * Custom Excerpt tag
 */
function custom_excerpt_length( $length ) {
    return 80; // Excerpt length
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

// Inside the excerpt, replace the default [...] by ...
function new_excerpt_more( $more ) {
    return ' ...';
}
add_filter('excerpt_more', 'new_excerpt_more');


if (!isset($content_width)) {$content_width = 830;}
