<?php
/**
 * Post formats setup
 * See http://codex.wordpress.org/Post_Types
 *
 * @package Hugo
 * @since Hugo 1.0
 */

// Add theme support for post formats
add_theme_support( 'post-formats', array('video','audio' ) );

/**
 * Meta box for Video post type
 *
 * @package Hugo
 * @since Hugo 1.0
 */
$hugo_post_metabox = array(
    'youtube_link_url' => array(
        'title' => __('Video Link', 'hugo'),
        'applicableto' => 'post',
        'location' => 'normal',
        'display_condition' => 'post-format-video',
        'priority' => 'low',
        'fields' => array(
            'l_url' => array(
                'title' => __('YouTube Url:', 'hugo'),
                'type' => 'text',
                'description' => 'Paste your url, not embed code',
                'size' => 80
            ),

            'v_url' => array(
                'title' => __('Vimeo Url:', 'hugo'),
                'type' => 'text',
                'description' => 'Paste your url, not embed code',
                'size' => 80
            )
        )
    ),

    'audio_link_url' => array(
        'title' => __('Audio Link', 'hugo'),
        'applicableto' => 'post',
        'location' => 'normal',
        'display_condition' => 'post-format-audio',
        'priority' => 'low',
        'fields' => array(
            'a_url' => array(
                'title' => __('Soundcloud Widget Code:', 'hugo'),
                'type' => 'text',
                'description' => 'Paste your soundcloud widget code, not url',
                'size' => 80
            )
        )
    ),
);

add_action( 'admin_init', 'hugo_add_post_format_metabox' );
function hugo_add_post_format_metabox() {
    global $hugo_post_metabox;

    if ( !empty( $hugo_post_metabox ) ) {
        foreach ( $hugo_post_metabox as $id => $metabox ) {
            add_meta_box( $id, $metabox['title'], 'hugo_show_metaboxes', $metabox['applicableto'], $metabox['location'], $metabox['priority'], $id );
        }
    }
}

function hugo_show_metaboxes( $post, $args ) {
    global $hugo_post_metabox;

    $custom = get_post_custom( $post->ID );
    $fields = $tabs = $hugo_post_metabox[$args['id']]['fields'];

    $output = '<input type="hidden" name="post_format_meta_box_nonce" value="' . wp_create_nonce( basename( __FILE__ ) ) . '" />';

    if ( sizeof( $fields ) ) {
        foreach ( $fields as $id => $field ) {
            switch ( $field['type'] ) {
                default:
                case "text":
                    if (empty($custom[$id][0])) { $custom[$id][0] = "";}
                    $output .= '<label for="' . $id . '">' . $field['title'] . '</label><br><input id="' . $id . '" type="text" name="' . $id . '" value="' . $custom[$id][0] . '" size="' . $field['size'] . '" /><br>'. $field['description'] . '<br><br>';

                    break;
            }
        }
    }

    echo $output;
}

add_action( 'save_post', 'hugo_save_metaboxes' );
function hugo_save_metaboxes( $post_id ) {
    global $hugo_post_metabox;

    if ( isset($_POST['post_format_meta_box_nonce']) && !wp_verify_nonce( $_POST['post_format_meta_box_nonce'], basename( __FILE__ ) ) )
        return $post_id;

    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
        return $post_id;

    if ( 'page' == isset($_POST['post_type'] )) {
        if ( !current_user_can( 'edit_page', $post_id ) )
            return $post_id;
    } elseif ( !current_user_can( 'edit_post', $post_id ) ) {
        return $post_id;
    }

    $post_type = get_post_type();

    foreach ( $hugo_post_metabox as $id => $metabox ) {
        if ( $metabox['applicableto'] == $post_type ) {
            $fields = $hugo_post_metabox[$id]['fields'];

            foreach ( $fields as $id => $field ) {
                $old = get_post_meta( $post_id, $id, true );
                $new = $_POST[$id];

                if ( $new && $new != $old ) {
                    update_post_meta( $post_id, $id, $new );
                }
                elseif ( '' == $new && $old || !isset( $_POST[$id] ) ) {
                    delete_post_meta( $post_id, $id, $old );
                }
            }
        }
    }
}

add_action( 'admin_print_scripts', 'hugo_display_metaboxes', 1000 );
function hugo_display_metaboxes() {
    global $hugo_post_metabox;
    if ( get_post_type() == "post" ) :
        ?>
        <script type="text/javascript">// <![CDATA[
            $ = jQuery;

            <?php
            $formats = $ids = array();
            foreach ( $hugo_post_metabox as $id => $metabox ) {
                array_push( $formats, "'" . $metabox['display_condition'] . "': '" . $id . "'" );
                array_push( $ids, "#" . $id );
            }
            ?>

            var formats = { <?php echo implode( ',', $formats );?> };
            var ids = "<?php echo implode( ',', $ids ); ?>";
            function displayMetaboxes() {
                $(ids).hide();
                var selectedElt = $("input[name='post_format']:checked").attr("id");

                if ( formats[selectedElt] )
                    $("#" + formats[selectedElt]).fadeIn();
            }

            $(function() {
                displayMetaboxes();

                $("input[name='post_format']").change(function() {
                    displayMetaboxes();
                });
            });

        // ]]></script>
        <?php
    endif;
}

/**
 *
 * Video post function
 *
 */
function hugo_video( $height ) {
    $video_url = get_post_meta( get_the_ID(), 'l_url', true );
    if ( !empty($video_url)) {
        $embed_url = explode("?v=", $video_url);
        $new_url = $embed_url[1];
        if (empty($embed_url[1])) { $embed_url[1]=""; }
        if ($embed_url != "") {?>
        <iframe width="100%" height="<?php echo $height;?>" src="http://www.youtube.com/embed/<?php echo $new_url; ?>?wmode=opaque" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe><div class="blog-threeline"></div>
<?php   }}
    else {
        $video_url = get_post_meta( get_the_ID(), 'v_url', true );
        $embed_url = explode("com/", $video_url);
        if (empty($embed_url[1])) { $embed_url[1]=""; }
        $new_url = $embed_url[1];
        if ($new_url != "") {?>
        <iframe width="100%" height="<?php echo $height;?>" src="http://player.vimeo.com/video/<?php echo $new_url; ?>" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe><div class="blog-threeline"></div>
<?php   }}
}

/**
 *
 * Audio post function
 *
 */
function hugo_audio () {
    $audio_url ="";
    $audio_url = get_post_meta ( get_the_ID(), 'a_url', true );
    if(!empty($audio_url)) {
    echo $audio_url;
    }
}

/**
 * Template for the "share" feature.
 *
 */

if ( ! function_exists( 'hugo_share' ) ) :

    function hugo_share() {

        $post = get_post();
        $postpermalink = urlencode( get_permalink() );
        $imageurl = urlencode( wp_get_attachment_url( get_post_thumbnail_id($post->ID) ) );

    ?>
        <div class="<?php if ( comments_open() ) : echo 'share-post'; else : echo 'share-post-com'; endif; ?>">
            <a class="share-btn"><?php _e('Share', 'hugo'); ?></a>
            <div class="share-popover">
                <div class="popover-wrapper">
                    <div class="minilink"><p><?php echo wp_get_shortlink(); ?></p></div>
                    <ul>
                        <script>function fbs_click() {u=location.href;t=document.title;window.open('http://www.facebook.com/sharer.php?u='+encodeURIComponent(u)+'&t='+encodeURIComponent(t),'sharer','toolbar=0,status=0,width=626,height=436'); return false;}</script>
                        <li class="pop-fb"><a rel="nofollow" href="http://www.facebook.com/share.php?u=<;url>" onclick="return fbs_click()" target="_blank"></a></li>

                        <li class="pop-tw"><a href="http://twitter.com/share?text=<?php echo urlencode(the_title()); ?>&url=<?php echo urlencode(the_permalink()); ?>&via=Manoz" title="Share on Twitter" rel="nofollow" target="_blank"></a></li>

                        <li class="pop-pin">
                            <a target="blank" href="http://pinterest.com/pin/create/button/?url=<?php echo $postpermalink ?>&media=<?php echo $imageurl ?>" title="Pin This Post"></a>
                        </li>

                        <li class="pop-g"><a href="https://plus.google.com/share?url=<?php the_permalink(); ?>" onclick="window.open('https://plus.google.com/share?url=<?php the_permalink(); ?>','gplusshare','width=600,height=400,left='+(screen.availWidth/2-225)+',top='+(screen.availHeight/2-150)+'');return false;"></a></li>

                    </ul>
                </div>
            </div>
        </div>
    <?php }

endif;

/**
 * Navigation for next/prev posts
 *
 */
if ( ! function_exists( 'hugo_page_nav' ) ) :

function hugo_page_nav() {

    if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
        return;
    } ?>

    <nav class="post-nav">
        <?php next_posts_link(__('Previous', 'hugo')); ?></li>
        <?php previous_posts_link(__('Next', 'hugo')); ?></li>
    </nav>

<?php }
endif;