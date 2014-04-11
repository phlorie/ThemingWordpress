<?php
/**
 * The footer widget area.
 *
 * @package Hugo
 * @since Hugo 1.0
 */

if ( ! is_active_sidebar( 'sidebar-2' ) ) {
    return;
}

?>

<div class="widget-area tertiary grid" role="complementary">
    <?php dynamic_sidebar( 'sidebar-2' ); ?>
</div>