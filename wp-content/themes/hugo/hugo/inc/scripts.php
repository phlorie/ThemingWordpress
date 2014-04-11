<?php
/**
 * Enqueue scripts and stylesheets
 *
 * @package Hugo
 * @since Hugo 1.0
 */

/**
 * I chose to create multiple files. It is easier to navigate and this allows
 * to not load styles that do not have to be loaded if they are not useful on the page.
 * Example: we don't load 'g-comments.css' if we are not on an article or a page.
*/

if ( function_exists( 'get_option_tree') ) {
    $theme_options = get_option('option_tree');
}

function hugo_styles($theme_options) {
    wp_register_style('normalize', get_template_directory_uri() . '/css/a-normalize.min.css');
    wp_register_style('grid', get_template_directory_uri() . '/css/b-grid.css');
    wp_register_style('main', get_template_directory_uri() . '/css/main.css');
    wp_register_style('hugo_fonts', get_template_directory_uri() . '/css/font-awesome.min.css');
    wp_register_style('googleFonts', 'http://fonts.googleapis.com/css?family=Lato:300,400,700,400italic|Open+Sans:400,600');
    $asset = get_option_tree('theme_colors',$theme_options);
    if($asset != 'main'){
    wp_register_style('asset', get_template_directory_uri().'/css/themes/'.$asset.'.css');
    }

    wp_enqueue_style( 'normalize');
    wp_enqueue_style( 'grid');
    wp_enqueue_style( 'main');
    wp_enqueue_style( 'hugo_fonts');
    wp_enqueue_style( 'googleFonts');
    if($asset != 'main'){
    wp_enqueue_style('asset');
    }
}
add_action('wp_enqueue_scripts', 'hugo_styles');

function hugo_scripts($theme_options) {

    if (is_single() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }

    wp_register_script('scripts', get_template_directory_uri() . '/js/scripts.js', false, false, true);

    wp_enqueue_script('jquery');
    wp_enqueue_script('scripts');
}
add_action('wp_enqueue_scripts', 'hugo_scripts');
