<?php
/**
 * The Template for displaying all single posts
 *
 * @package Hugo
 * @since Hugo 1.0
 */

get_template_part('templates/header');

$key = get_post_meta( get_the_ID(), 'post_layout', true );
if( $key == 'left-post' ) {

    get_template_part('templates/content', 'single-left');

} elseif ( $key == 'full-post' ) {

    get_template_part('templates/content', 'single-full');

} elseif ( $key == 'right-post' ) {

    get_template_part('templates/content', 'single-right');

} else {
    get_template_part('templates/content', 'single-left');
}

get_template_part('templates/footer');
