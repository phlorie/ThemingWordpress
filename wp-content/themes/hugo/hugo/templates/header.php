<?php
/**
 * The Hugo header
 *
 * @package Hugo
 * @since Hugo 1.0
 */
?>
<!DOCTYPE HTML>
<html <?php language_attributes(); ?> >
<head>
<?php if ( function_exists( 'get_option_tree') ) {
    // Load the option-tree var
    $theme_options = get_option('option_tree');
} ?>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta name="viewport" content="width=device-width" />

    <title><?php

    global $page, $paged;

    wp_title( '|', true, 'right' );

    bloginfo( 'name' );

    $site_description = get_bloginfo( 'description', 'display' );
    if ( $site_description && ( is_home() || is_front_page() ) )
    echo " | $site_description";

    if ( $paged >= 2 || $page >= 2 )
    echo ' | ' . sprintf( __( 'Page %s', 'hugo' ), max( $paged, $page ) );

    ?></title>

    <link rel="shortcut icon" href="<?php if (!empty($theme_options['favicon_upload'])){echo $theme_options['favicon_upload'];} else {echo get_template_directory_uri() . '/images/favicon-1.png';}?>" />
    <link rel="profile" href="http://gmpg.org/xfn/11" />
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

    <!--[if lt IE 9]>
    <script src="<?php echo get_template_directory_uri(); ?>/js/html5shiv.js"></script>
    <![endif]-->

    <?php wp_head(); ?>

<style type="text/css">
<?php // Style used for custom theme colors
    if ( !empty($theme_options['custom_theme_color']) ) {
        echo '    .nav .active a,
    .navbar-nav li a:hover,
    .dropdown-menu > li > a:hover,
    .dropdown-menu > li > a:focus,
    .nav .open > a,
    .nav .open > a:hover,
    .nav .open > a:focus,
    .secondary aside:hover .widget-title,
    .single-entry-footer:hover {
        border-color: '.$theme_options['custom_theme_color'].';
    }

    a,
    .entry-content:hover .read-more,
    .footer-credits a:hover,
    .entry-meta li a:hover,
    .footer-metas li a:hover,
    .entry-title a {
        color: '.$theme_options['custom_theme_color'].';
    }

    .entry-meta li a,
    .footer-metas li a,
    .entry-title a:hover {
        color: '.$theme_options['custom_theme_color'].';
    }
';
    }
?>
</style>
</head>
<body <?php body_class(); ?> >
    <header class="site-header" id="banner" role="banner">
        <div class="site-header-content">
        <?php
            $top_bar = get_option_tree('show_top_bar',$theme_options);
            $show_search = get_option_tree('top_bar_search',$theme_options);
            $show_social = get_option_tree('top_bar_social',$theme_options);
            if ( $top_bar == 'Yes' ) { ?>
                <div class="top-bar">
                    <?php
                        if (has_nav_menu('top_bar_menu')) :
                            wp_nav_menu(array('theme_location' => 'top_bar_menu', 'menu_class' => 'nav topbar-nav'));
                        endif;

                    if ( $show_search == 'Yes' ) { ?>
                        <div class="top-search">
                            <?php get_search_form(); ?>
                        </div>
                    <?php }

                    if ( $show_social == 'Yes' ) { ?>
                        <ul class="top-social">
                            <?php if ( get_option_tree('social_fb', $theme_options) != '') { ?>
                            <li><a title="Facebook" target="_blank" href="<?php echo get_option_tree('social_fb', $theme_options);?>"><i class="fa fa-facebook"></i></a></li>

                            <?php } if ( get_option_tree('social_tw', $theme_options) != '') { ?>
                            <li><a title="Twitter" target="_blank" href="<?php echo get_option_tree('social_tw', $theme_options);?>"><i class="fa fa-twitter"></i></a></li>

                            <?php } if ( get_option_tree('social_goog', $theme_options) != '') { ?>
                            <li><a title="Google+" target="_blank" href="<?php echo get_option_tree('social_goog', $theme_options);?>"><i class="fa fa-google-plus"></i></a></li>

                            <?php } if ( get_option_tree('social_yt', $theme_options) != '') { ?>
                            <li><a title="YouTube" target="_blank" href="<?php echo get_option_tree('social_yt', $theme_options);?>"><i class="fa fa-youtube"></i></a></li>
                            <?php } ?>
                        </ul>
                    <?php } ?>
                    <div class="clear"></div>
                </div>
            <?php } ?>

            <h1 class="site-title"><a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?><span>.</span></a></h1>
            <div class="site-nav">
            <div class="wild-title">
                <a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?><span>.</span></a>
            </div>
                <?php
                  if (has_nav_menu('primary_navigation')) :
                    wp_nav_menu(array('theme_location' => 'primary_navigation', 'menu_class' => 'nav navbar-nav'));
                  endif;
                ?>
            </div>
        </div>
    </header>

<div id="main" class="site-main grid" role="main">
    <div class="main-container">
