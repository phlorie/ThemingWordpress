<?php
/**
 * Template used if there is no post
 *
 * @package Hugo
 * @since Hugo 1.0
 */
?>
<div class="empty-content">
    <?php if ( is_search() ) : ?>

        <p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords. I offer you a motherf*cking badass search form : ', 'hugo' ); ?></p>
        <?php get_search_form();

        else : ?>

        <p>Oops, I'm not a genius but I think <em>"what you're looking for"</em> is not here. Or I don't see it.
        <br>The first thing that comes to my mind is that they are aliens who have stolen <em>"what you're looking for"</em>. I'm not an expert but this is what seems the most logical.</p>

        <p>Or, <em>"what you're looking for"</em> does not exist. And if it does not exist, we can consider that this is a <strong>paradox</strong>. Right?</p>

        <p>Anyway.<br>You can use this little search form (or the badass motherf*cking sidebar) to find <em>"what you're looking for"</em>.<br>It's simple, fast and efficient.<br>I'll watch you while you recover <em>"what you're looking for"</em>. I think I need a little rest.</p>
        <p>Good luck :)</p>
        <?php get_search_form();

    endif; ?>
</div>