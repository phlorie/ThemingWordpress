<?php
/**
 * Hugo constants
 *
 * @package Hugo
 * @since Hugo 1.0
 */

function hugo_setup() {
    load_theme_textdomain('hugo', get_template_directory() . '/lang');

    // Register wp_nav_menu() menus (http://codex.wordpress.org/Function_Reference/register_nav_menus)
    register_nav_menus(array(
        'primary_navigation' => __('Header navbar menu', 'hugo'),
        'top_bar_menu' => __('Header Top bar menu', 'hugo'),
    ));

// Add some theme support
    add_theme_support( 'automatic-feed-links' );
    add_theme_support('post-thumbnails'); // > http://codex.wordpress.org/Post_Thumbnails
    //set_post_thumbnail_size(150, 150, false);
    //add_image_size('category-thumb', 300, 9999); // 300px wide (and unlimited height)

    add_editor_style('/css/editor-style.css');

}
add_action('after_setup_theme', 'hugo_setup');

/**
 * Add nice search tweak
 * @todo move this tweak
 */
add_theme_support('nice-search');

function is_element_empty($element) {
    $element = trim($element);
    return empty($element) ? false : true;
}
