<?php
/**
 * Default template for content.
 *
 * @package Hugo
 * @since Hugo 1.0
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> >
    <?php
        if ( is_sticky() ) { // Add the sticky css if the post is "sticky"
            echo '<div class="sticky-flag"><i title="Wiggle, wiggle Mister Sticky (^_^)" class="fa fa-thumb-tack wiggle"></i></div>';
        }
    ?>

    <header class="entry-header">
        <div class="post-thumbnail">
            <?php
                if ( has_post_format('video') ) {
                    hugo_video('453'); // Video height
                }

                elseif ( has_post_format('audio') ) {
                    hugo_audio();
                }

                elseif ( has_post_thumbnail() ) {
                    the_post_thumbnail();
                }
            ?>
        </div>
        <h1 class="entry-title">
            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
        </h1>
        <ul class="entry-meta">
            <li class="author"><?php _e('Published by', 'hugo'); ?> <?php the_author_posts_link(); ?></li>
            <li class="date"><time class="published" datetime="<?php echo get_the_time('c'); ?>"><?php _e('on ', 'hugo'); echo get_the_date(); ?></time></li>
            <?php if( get_the_category() ) { ?><li class="category"><?php _e('in', 'hugo'); ?> <?php the_category(' &middot; '); ?></li><?php } ?>
        </ul>
    </header>

    <div class="entry-content">
        <?php
            if ( is_home() || is_search() ) :
                the_excerpt(); ?>
                <a class="read-more" href="<?php the_permalink(); ?>" title="<?php echo _e( 'Read more', 'hugo' ); ?>"><?php echo _e( 'Read more', 'hugo' ); ?></a>
            <?php else:
                the_content();
                hugo_content_nav(); ?>
                <div class="clear"></div>
            <?php endif;
        ?>
    </div>

    <footer class="single-entry-footer">
        <ul class="footer-metas">
            <li class="comments-meta"><a href="<?php the_permalink(); ?>#comments"><?php comments_number('0 comment', '1 comment', '% comments'); ?></a></li>
            <li class="tag-links"><?php
                $tags_list = get_the_tag_list( '', __( ' ', 'hugo' ) );
                if ( $tags_list ) :

                    printf( __( 'Tags: %1$s', 'hugo' ), $tags_list );
                else :
                    _e( 'No tags', 'hugo' ) ;
            endif; ?></li>
        </ul>

        <?php
            if ( is_singular() ) {
                hugo_share();
            }
        ?>

        <div class="clear"></div>
    </footer>
</article>
