<?php
/**
 * Widget templates
 *
 * @package Hugo
 * @since Hugo 1.0
 */
/*
 * Adds widgets area
 */
function hugo_widgets_init() {
    register_sidebar( array(
        'name' => __( 'Main sidebar', 'hugo' ),
        'id' => 'sidebar-1',
        'description' => __( 'The main blog sidebar.', 'hugo' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h1 class="widget-title">',
        'after_title' => '</h1>',
    ) );

    register_sidebar( array(
        'name' => __( 'Footer widgets', 'hugo' ),
        'id' => 'sidebar-2',
        'description' => __( 'Appears in the footer.', 'hugo' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s col-1-4">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title-foot">',
        'after_title' => '</h1>',
    ) );
}
add_action( 'widgets_init', 'hugo_widgets_init' );

/*******************************
 * WP hugo sidebar recent posts
 ******************************/
class hugo_Recent_Posts extends WP_Widget {

    function __construct() {
        $widget_ops = array('classname' => 'widget_recent_entries', 'description' => __( "Custom recent posts widget for sidebar.", 'hugo') );
        parent::__construct('hugo-recent-posts', __('Hugo Recent Posts - Sidebar', 'hugo'), $widget_ops);
        $this->alt_option_name = 'widget_recent_entries';

        add_action( 'save_post', array($this, 'flush_widget_cache') );
        add_action( 'deleted_post', array($this, 'flush_widget_cache') );
        add_action( 'switch_theme', array($this, 'flush_widget_cache') );
    }

    function widget($args, $instance) {
        $cache = wp_cache_get('widget_recent_posts', 'widget');

        if ( !is_array($cache) )
            $cache = array();

        if ( ! isset( $args['widget_id'] ) )
            $args['widget_id'] = $this->id;

        if ( isset( $cache[ $args['widget_id'] ] ) ) {
            echo $cache[ $args['widget_id'] ];
            return;
        }

        ob_start();
        extract($args);

        $title = apply_filters('widget_title', empty($instance['title']) ? __('Recent Posts', 'hugo') : $instance['title'], $instance, $this->id_base);
        if ( empty( $instance['number'] ) || ! $number = absint( $instance['number'] ) )
            $number = 3;


        $r = new WP_Query( apply_filters( 'widget_posts_args', array( 'posts_per_page' => $number, 'no_found_rows' => true, 'post_status' => 'publish', 'ignore_sticky_posts' => true ) ) );
        if ($r->have_posts()) :
?>

        <?php echo $before_widget; ?>
        <?php if ( $title ) echo $before_title . $title . $after_title; ?>
        <div class="recent-posts-widget">
        <?php while ( $r->have_posts() ) : $r->the_post(); ?>
            <article class="recent-posts clearfix">
                <a href="<?php the_permalink() ?>" title="<?php echo esc_attr( get_the_title() ? get_the_title() : get_the_ID() ); ?>"><?php if (has_post_thumbnail()) {echo the_post_thumbnail('thumbnail');} ?></a>
                <h6><a href="<?php the_permalink() ?>" title="<?php echo esc_attr( get_the_title() ? get_the_title() : get_the_ID() ); ?>"><?php if ( get_the_title() ) the_title(); else the_ID(); ?></a></h6>
                <p class="recent-date"><?php echo __('Posted on ', 'hugo'); echo get_the_date(); ?></p>
                <p class="recent-author"><?php echo __('By', 'hugo');?> <?php the_author_posts_link(); ?></p>
            </article>
        <?php endwhile; ?>
        </div>
        <?php echo $after_widget; ?>
<?php
        wp_reset_postdata();

        endif;

        $cache[$args['widget_id']] = ob_get_flush();
        wp_cache_set('widget_recent_posts', $cache, 'widget');
    }

    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['number'] = (int) $new_instance['number'];
        $this->flush_widget_cache();

        $alloptions = wp_cache_get( 'alloptions', 'options' );
        if ( isset($alloptions['widget_recent_entries']) )
            delete_option('widget_recent_entries');

        return $instance;
    }

    function flush_widget_cache() {
        wp_cache_delete('widget_recent_posts', 'widget');
    }

    function form( $instance ) {
        $title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
        $number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;

?>
        <p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'hugo' ); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>

        <p><label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of posts to show:', 'hugo' ); ?></label>
        <input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo $number; ?>" size="3" /></p>

<?php
    }
}
add_action( 'widgets_init', create_function( '', 'register_widget( "hugo_Recent_Posts" );' ) );

/*******************************
 * WP hugo footer recent posts
 ******************************/
class hugo_Footer_Recent_Posts extends WP_Widget {

    function __construct() {
        $widget_ops = array('classname' => 'footer_widget_recent_entries', 'description' => __( "Custom recent posts widget for footer.", 'hugo') );
        parent::__construct('hugo-footer-recent-posts', __('Hugo Recent Posts - Footer', 'hugo'), $widget_ops);
        $this->alt_option_name = 'footer_widget_recent_entries';

        add_action( 'save_post', array($this, 'flush_widget_cache') );
        add_action( 'deleted_post', array($this, 'flush_widget_cache') );
        add_action( 'switch_theme', array($this, 'flush_widget_cache') );
    }

    function widget($args, $instance) {
        $cache = wp_cache_get('footer_widget_recent_posts', 'widget');

        if ( !is_array($cache) )
            $cache = array();

        if ( ! isset( $args['widget_id'] ) )
            $args['widget_id'] = $this->id;

        if ( isset( $cache[ $args['widget_id'] ] ) ) {
            echo $cache[ $args['widget_id'] ];
            return;
        }

        ob_start();
        extract($args);

        $title = apply_filters('widget_title', empty($instance['title']) ? __('Recent Posts', 'hugo') : $instance['title'], $instance, $this->id_base);
        if ( empty( $instance['number'] ) || ! $number = absint( $instance['number'] ) )
            $number = 3;


        $r = new WP_Query( apply_filters( 'widget_posts_args', array( 'posts_per_page' => $number, 'no_found_rows' => true, 'post_status' => 'publish', 'ignore_sticky_posts' => true ) ) );
        if ($r->have_posts()) :
?>

        <?php echo $before_widget; ?>
        <?php if ( $title ) echo $before_title . $title . $after_title; ?>
        <div class="footer-recent-posts-container">
        <?php while ( $r->have_posts() ) : $r->the_post(); ?>
            <article class="footer-recent-posts clearfix">
                <a href="<?php the_permalink() ?>" title="<?php echo esc_attr( get_the_title() ? get_the_title() : get_the_ID() ); ?>"><?php if (has_post_thumbnail()) {echo the_post_thumbnail('thumbnail');} ?></a>
                <h6><a href="<?php the_permalink() ?>" title="<?php echo esc_attr( get_the_title() ? get_the_title() : get_the_ID() ); ?>"><?php if ( get_the_title() ) the_title(); else the_ID(); ?></a></h6>
                <p class="recent-date"><?php echo __('Posted on ', 'hugo'); echo get_the_date(); ?></p>
            </article>
        <?php endwhile; ?>
        </div>
        <?php echo $after_widget; ?>
<?php
        wp_reset_postdata();

        endif;

        $cache[$args['widget_id']] = ob_get_flush();
        wp_cache_set('footer_widget_recent_posts', $cache, 'widget');
    }

    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['number'] = (int) $new_instance['number'];
        $this->flush_widget_cache();

        $alloptions = wp_cache_get( 'alloptions', 'options' );
        if ( isset($alloptions['footer_widget_recent_entries']) )
            delete_option('footer_widget_recent_entries');

        return $instance;
    }

    function flush_widget_cache() {
        wp_cache_delete('footer_widget_recent_posts', 'widget');
    }

    function form( $instance ) {
        $title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
        $number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;

?>
        <p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'hugo' ); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>

        <p><label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of posts to show:', 'hugo' ); ?></label>
        <input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo $number; ?>" size="3" /></p>

<?php
    }
}
add_action( 'widgets_init', create_function( '', 'register_widget( "hugo_Footer_Recent_Posts" );' ) );

/*******************************
 * Popular tag list
 ******************************/

class hugo_popular_tag extends WP_Widget {

    function __construct() {
        $widget_ops = array('classname' => 'text_area_content', 'description' => __( "A better tag cloud widget", 'hugo') );
        parent::__construct('hugo_tag_cloud', __('Hugo Tag Cloud', 'hugo'), $widget_ops);
    }

    function widget($args, $instance) {

        extract($args);

        $title = apply_filters('widget_title', empty($instance['title']) ? __( 'Tag cloud', 'hugo' ) : $instance['title'], $instance, $this->id_base);
        ?>
        <?php echo $before_widget; ?>
        <?php if ( $title !="" ) echo $before_title . $title . $after_title; ?>
            <div class="hugo-tag-cloud">
               <?php wp_tag_cloud('unit=px&smallest=13&largest=13&number=10&format=list'); ?>
            </div>
        <?php echo $after_widget; ?>
<?php
        wp_reset_postdata();
    }

        function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        return $instance;
    }

    function form( $instance ) {
        $instance = wp_parse_args( (array) $instance, array( 'title' => '') );
        $title = strip_tags($instance['title']);
?>
        <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'hugo'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

<?php
    }
}
add_action( 'widgets_init', create_function( '', 'register_widget( "hugo_popular_tag" );' ) );

/*******************************
 * Social widget
 ******************************/

class hugo_social_widget extends WP_Widget {

    function __construct() {
        $widget_ops = array('classname' => 'hugo_social_widget', 'description' => __( "A simple social widget.", 'hugo') );
        parent::__construct('hugo_social_widget', __('Hugo Social Widget', 'hugo'), $widget_ops);
        $this->alt_option_name = 'hugo_social_widget';

        add_action( 'save_post', array($this, 'flush_widget_cache') );
        add_action( 'deleted_post', array($this, 'flush_widget_cache') );
        add_action( 'switch_theme', array($this, 'flush_widget_cache') );
    }

    function widget($args, $instance) {
        $cache = wp_cache_get('hugo_social_widget', 'widget');

        if ( !is_array($cache) )
            $cache = array();

        if ( ! isset( $args['widget_id'] ) )
            $args['widget_id'] = $this->id;

        if ( isset( $cache[ $args['widget_id'] ] ) ) {
            echo $cache[ $args['widget_id'] ];
            return;
        }

        ob_start();
        extract($args);
        $theme_options = get_option('option_tree');
        //$mailchimp = get_option_tree('mailchimp',$theme_options);

        $title = apply_filters('widget_title', empty($instance['title']) ? __('Social networks', 'hugo') : $instance['title'], $instance, $this->id_base); ?>

        <?php echo $before_widget; ?>
        <?php if ( $title ) echo $before_title . $title . $after_title; ?>
        <div class="social-widget-container">
            <?php if ( get_option_tree('social_fb', $theme_options) != '') { ?>
            <a href="<?php echo get_option_tree('social_fb', $theme_options);?>"><div class="socialbox"><i class="hugo-face"></i></div></a>

            <?php } if ( get_option_tree('social_tw', $theme_options) != '') { ?>
            <a href="<?php echo get_option_tree('social_tw', $theme_options);?>"><div class="socialbox"><i class="hugo-tweet"></i></div></a>

            <?php } if ( get_option_tree('social_goog', $theme_options) != '') { ?>
            <a href="<?php echo get_option_tree('social_goog', $theme_options);?>"><div class="socialbox"><i class="hugo-google"></i></div></a>

            <?php } if ( get_option_tree('social_yt', $theme_options) != '') { ?>
            <a href="<?php echo get_option_tree('social_yt', $theme_options);?>"><div class="socialbox"><i class="hugo-youtube"></i></div></a>
            <?php } ?>
        </div>
        <?php echo $after_widget; ?>

        <?php
        $cache[$args['widget_id']] = ob_get_flush();
        wp_cache_set('hugo_social_widget', $cache, 'widget');
    }

    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);

        $this->flush_widget_cache();

        $alloptions = wp_cache_get( 'alloptions', 'options' );
        if ( isset($alloptions['mini_soc']) )
            delete_option('mini_soc');

        return $instance;
    }

    function flush_widget_cache() {
        wp_cache_delete('hugo_social_widget', 'widget');
    }

    function form( $instance ) {
        $title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';


?>

<?php
    }
}
add_action( 'widgets_init', create_function( '', 'register_widget( "hugo_social_widget" );' ) );