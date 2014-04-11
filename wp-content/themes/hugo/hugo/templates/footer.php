<?php
/**
 * The Hugo footer
 *
 * @package Hugo
 * @since Hugo 1.0
 */
?>
    </div> <!-- /.main-content -->
</div> <!-- /.site-main #main -->
<div class="main-footer">
    <footer class="footer-widgets">
        <?php get_sidebar( 'footer' ); ?>
    </footer>
    <footer class="footer-credits" id="contentinfo" role="contentinfo">
        <small class="copyright">&copy; <?php echo date( 'Y' ); ?> - <a href="<?php echo home_url( '/' ); ?>" title="<?php bloginfo('name'); ?>" ><?php bloginfo('name'); ?></a></small>
        <small class="credits"><i class="fa fa-coffee wiggle"></i> Fueled with <a title="Caffeine" target="_blank" href="https://en.wikipedia.org/wiki/Caffeine">C<sub>8</sub>H<sub>10</sub>N<sub>4</sub>O<sub>2</sub></a>.</small>
    </footer>
</div>
<?php wp_footer(); ?>
<script>
jQuery(document).ready(function($){
    $('.share-btn').popover({
        content: '.share-popover > .popover-wrapper'
    });
});
</script>
<?php if ( function_exists( 'get_option_tree') ) {

    $theme_options = get_option('option_tree');
    $check = get_option_tree('add_analytics',$theme_options);
    $id = get_option_tree('analytics_id',$theme_options);
    //$smoothy = get_option_tree('smooth_scrool',$theme_options);

    if ( $check != 'Yes' ) {
        echo '
<script>
    (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
    function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
    e=o.createElement(i);r=o.getElementsByTagName(i)[0];
    e.src=\'//www.google-analytics.com/analytics.js\';
    r.parentNode.insertBefore(e,r)}(window,document,\'script\',\'ga\'));
    ga(\'create\', \''.$id.'\');ga(\'send\',\'pageview\');
</script>
    ';
    } else {
        echo 'prout';
    }
} ?>

</body>
</html>