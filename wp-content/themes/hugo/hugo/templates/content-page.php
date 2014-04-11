<?php
/**
 * Template for pages content
 *
 * @package Hugo
 * @since Hugo 1.0
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> >
    <header class="entry-header">
        <div class="post-thumbnail">
            <?php the_post_thumbnail(); ?>
        </div>
        <h1 class="entry-title">
            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
        </h1>
        <ul class="entry-meta">
            <li class="author"><?php echo __('Published by', 'hugo'); ?> <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>" rel="author" class="fn"><?php echo get_the_author(); ?></a></li>
            <li class="date">
                <time class="published" datetime="<?php echo get_the_time('c'); ?>"><?php _e('on ', 'hugo'); echo get_the_date(); ?></time>
            </li>
        </ul>
    </header>

    <div class="entry-content">
        <?php
            the_content();
            wp_link_pages( array(
                'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'hugo' ) . '</span>',
                'after'       => '</div>',
                'link_before' => '<span>',
                'link_after'  => '</span>',
            ) );
            edit_post_link( __( 'Edit', 'hugo' ), '<span class="edit-link">', '</span>' );
        ?>
    </div>

    <footer class="single-entry-footer">
        <ul class="footer-metas">
            <li class="views">238 views</li>
            <li class="comments-meta"><a href=""><?php comments_number('0 comment', '1 comment', '% comments'); ?></a></li>
        </ul>

        <div class="<?php if ( comments_open() ) : echo 'share-post'; else : echo 'share-post-com'; endif; ?>">
            <a class="share-btn"><?php _e('Share', 'hugo'); ?></a>
            <div class="share-popover">
                <div class="popover-wrapper">
                    <div class="minilink"><p><?php echo wp_get_shortlink(); ?></p></div>
                    <ul>
                        <script>function fbs_click() {u=location.href;t=document.title;window.open('http://www.facebook.com/sharer.php?u='+encodeURIComponent(u)+'&t='+encodeURIComponent(t),'sharer','toolbar=0,status=0,width=626,height=436'); return false;}</script>
                        <li class="pop-fb"><a rel="nofollow" href="http://www.facebook.com/share.php?u=<;url>" onclick="return fbs_click()" target="_blank"></a></li>
                        <li class="pop-tw"><a href="http://twitter.com/share?text=<?php echo urlencode(the_title()); ?>&url=<?php echo urlencode(the_permalink()); ?>&via=Manoz" title="Share on Twitter" rel="nofollow" target="_blank"></a></li>
                        <?php $postpermalink = urlencode( get_permalink() );
                              $imageurl = urlencode( wp_get_attachment_url( get_post_thumbnail_id($post->ID) ) ); ?>
                        <li class="pop-pin">
                            <a target="blank" href="http://pinterest.com/pin/create/button/?url=<?php echo $postpermalink ?>&media=<?php echo $imageurl ?>" title="Pin This Post"></a>
                        </li>
                        <li class="pop-g"><a href="https://plus.google.com/share?url=<?php the_permalink(); ?>" onclick="window.open('https://plus.google.com/share?url=<?php the_permalink(); ?>','gplusshare','width=600,height=400,left='+(screen.availWidth/2-225)+',top='+(screen.availHeight/2-150)+'');return false;"></a></li>
                    </ul>
                </div>
            </div>
        </div>

    </footer>
</article>
<?php
comments_template('/templates/comments.php');