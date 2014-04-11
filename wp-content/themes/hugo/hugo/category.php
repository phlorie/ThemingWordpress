<?php
/**
 * Template for Archives page
 *
 * @package Hugo
 * @since Hugo 1.0
 */

get_template_part('templates/header'); ?>
<div class="main-content col-8-12">
    <?php if ( have_posts() ) : ?>
        <header class="archive-header">
            <h1 class="archive-title"><?php printf( __( 'Category Archives: %s', 'hugo' ), single_cat_title( '', false ) ); ?></h1>
            <?php // Term description
                $term_desc = term_description();
                if (!empty($term_desc)) :
                    printf('<div class="taxonomy-desc">%s</div>', $term_desc);
                endif;
            ?>
        </header>
        <?php
            while (have_posts()) : the_post();
                get_template_part('templates/content', get_post_format());
            endwhile;

            if ($wp_query->max_num_pages > 1) : ?>
                <nav class="post-nav">
                    <?php next_posts_link(__('Previous', 'hugo')); ?></li>
                    <?php previous_posts_link(__('Next', 'hugo')); ?></li>
                </nav>
            <?php endif;
        else :
            get_template_part('templates/content', 'nope');
        endif; ?>
</div>
<?php
get_sidebar();
get_template_part('templates/footer');