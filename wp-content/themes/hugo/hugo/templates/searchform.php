<?php
/**
 * Global searchform
 *
 * @package Hugo
 * @since Hugo 1.0
 */
?>
<form role="search" method="get" class="search-form" action="<?php echo home_url('/'); ?>">
    <input type="search" value="<?php if (is_search()) { echo get_search_query(); } ?>" name="s" class="search-field" placeholder="<?php _e('Search', 'hugo'); ?>">
    <button type="submit" class="search-btn"><i class="fa fa-search wiggle"></i></button>
</form>