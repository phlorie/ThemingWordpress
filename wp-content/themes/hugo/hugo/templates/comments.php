<?php
/**
 * The template for displaying Comments.
 *
 * @package Hugo
 * @since Hugo 1.0
 */
?>

<?php
    if ( post_password_required() )
        return;
?>
<div id="comments" class="comments-area">
    <?php if ( have_comments() ) : ?>

        <h2 class="comments-title"><?php printf( _n( 'One comment on this post.', '%1$s comments on this post.', get_comments_number(), 'hugo' ), number_format_i18n( get_comments_number() )); ?></h2>

        <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
        <nav role="navigation" id="comment-nav-above" class="site-navigation comment-navigation">
            <h1 class="assistive-text"><?php _e( 'Comment navigation', 'hugo' ); ?></h1>
            <div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'hugo' ) ); ?></div>
            <div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'hugo' ) ); ?></div>
        </nav>
        <?php endif; ?>

        <ul class="commentlist">
            <?php
                wp_list_comments( array( 'callback' => 'hugo_comment' ) );
            ?>
        </ul>

        <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
        <nav role="navigation" id="comment-nav-below" class="site-navigation comment-navigation">
            <h1 class="assistive-text"><?php _e( 'Comment navigation', 'hugo' ); ?></h1>
            <div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'hugo' ) ); ?></div>
            <div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'hugo' ) ); ?></div>
        </nav>
        <?php endif; ?>

    <?php endif; ?>

    <?php
        if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
    ?>
        <p class="nocomments"><?php _e( 'Comments are closed.', 'hugo' ); ?></p>
    <?php endif;
        $comments_args = array(
            'comment_notes_after' => '',
            // You can add your comments settings here
            // See http://codex.wordpress.org/Function_Reference/comment_form
        );
        comment_form($comments_args);
    ?>
</div>
