<?php
/**
 * Contains all the Theme Options functions.
 *
 * @package Hugo
 * @since Hugo 1.0
 */

/**
 * Hide the OptionTree documentation.
 * Comment the filter to show the documentation.
 * Uncomment to hide.
 */
add_filter( 'ot_show_pages', '__return_false' );


// Required: set 'ot_theme_mode' filter to true.
add_filter( 'ot_theme_mode', '__return_true' );

// Required: include OptionTree.
require_once locate_template('/option-tree/ot-loader.php');

// Theme Options
include_once( 'theme-options.php' );

/***********************************
 * Begin custom meta boxes
 ******************************** */
add_action( 'admin_init', 'hugo_ot_meta_boxes' );

function hugo_ot_meta_boxes() {

    /**
    * Create a custom meta boxes array that we pass to
    * the OptionTree Meta Box API Class.
    */
    $posts_meta_box = array(
        'id'          => 'posts_meta_box',
        'title'       => 'Hugo options',
        'desc'        => 'Custom settings for prettiest posts <3 . Below is the layout of the post. <br> You can also choose the post format. If you choose "audio" or "video", new options will appear below.',
        'pages'       => array( 'post' ),
        'context'     => 'normal',
        'priority'    => 'high',
        'fields'      => array(
            array(
                'label'       => 'Post layout',
                'id'          => 'post_layout',
                'type'        => 'radio-image',
                'desc'        => 'Choose a layout for this post. Default layout is "left sidebar".',
                'choices'     => array(
                    array(
                        'value'     => 'left-post',
                        'label'     => 'Left sidebar',
                        'src'       => OT_URL . '/assets/images/layout/2cl.png'
                    ),
                    array(
                        'value'     => 'full-post',
                        'label'     => 'Full width',
                        'src'       => OT_URL . '/assets/images/layout/1col.png'
                    ),
                    array(
                        'value'     => 'right-post',
                        'label'     => 'Right sidebar',
                        'src'       => OT_URL . '/assets/images/layout/2cr.png'
                    )
                ),
                'std'         => 'left-post',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => ''
            )
        )
    );

    /**
    * Register our meta boxes using the
    * ot_register_meta_box() function.
    */
    ot_register_meta_box( $posts_meta_box );
}
