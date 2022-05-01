<?php
/**
 * The template for displaying blog posts with pagination
 *
 * @package WordPress
 * @subpackage Melissa
 * @since Melissa 1.0
 */
?>

<!-- masonry blog -->
<section id="bwp-blog-posts-wrap">
    <div class="container">
        <h2 class="bwp-hidden-section-heading"><?php esc_html_e('Blog posts', 'melissa'); ?></h2>

        <?php
        // layout
        $blog_layout = get_theme_mod('blog_layout', '3c');

        // is masonry?
        $masonry_layout = array('3c', '2c-ls', '2c-rs', '2c');
        $is_masonry = (in_array($blog_layout, $masonry_layout)) ? true : false;

        // layout with sidebar
        $sidebar_layout = array('2c-ls', '2c-rs', '1c-ls', '1c-rs');
        $with_sidebar = (in_array($blog_layout, $sidebar_layout)) ? true : false;

        // masonry columnWidth
        switch ($blog_layout) {
            case '3c':
                $default_post_width = 'bwp-blog-col-3-default';
                break;
            case '2c-ls':
            case '2c-rs':
            case '2c':
                $default_post_width = 'bwp-blog-col-2-default';
                break;
        }
        ?>

        <?php if ($blog_layout == '2c-rs' || $blog_layout == '1c-rs') { ?>
        <div class="row">
            <div class="col-md-8 bwp-posts-col bwp-sidebar-right">
                <div class="bwp-posts-col-wrap">
                    <?php } else if ($blog_layout == '2c-ls' || $blog_layout == '1c-ls') { ?>
                    <div class="row">
                        <div class="col-md-8 col-md-push-4 bwp-posts-col bwp-sidebar-left">
                            <div class="bwp-posts-col-wrap">
                                <?php } ?>

                                <!-- masonry container -->
                                <div class="bwp-masonry-o-hidden">
                                    <div id="bwp-masonry-container"
                                         class="<?php echo ($is_masonry) ? 'masonry' : 'no-masonry'; ?>" role="main">
                                        <?php if ($is_masonry) { ?>
                                            <div class="<?php echo sanitize_html_class($default_post_width); ?>"></div><!-- default columnWidth -->
                                        <?php } ?>

                                        <?php
                                        // start the loop
                                        if (have_posts()) :
                                            while (have_posts()) :

                                                the_post();


                                                $format = get_post_format();
                                                if (false === $format) {
                                                    get_template_part('content', 'standard');
                                                } else {
                                                    get_template_part('content', $format);
                                                }

                                            endwhile;
                                        endif;
                                        // end the loop
                                        ?>

                                    </div>
                                </div>
                                <!-- end masonry container -->

                                <?php
                                // If no content, include the 'No post found' template
                                if (!have_posts()) :
                                    get_template_part('content', 'none');
                                endif;
                                ?>

                                <?php

                                // pagination type
                                $pagination_type = get_theme_mod('pagination_type', 'standard_pagination');
                                if ($pagination_type == 'next_prev_links') {
                                    // posts navigation
                                    the_posts_navigation(array(
                                        'prev_text' => '<span>' . __('Older posts', 'melissa') . '</span><i class="fa fa-angle-right"></i>',
                                        'next_text' => '<i class="fa fa-angle-left"></i><span>' . __('Newer posts', 'melissa') . '</span>'
                                    ));
                                } else {
                                    // posts pagination
                                    the_posts_pagination(array(
                                        'prev_text' => '<i class="fa fa-angle-left"></i>',
                                        'next_text' => '<i class="fa fa-angle-right"></i>'
                                    ));

                                }

                                ?>

                                <?php if (get_the_posts_pagination() && $pagination_type == 'load_more') { ?>
                                    <!-- load more button -->
                                    <div class="bwp-load-more-wrap">
                                        <a href="#" id="bwp-load-more" class="bwp-load-more-button">
                                            <span><?php esc_html_e('Load more', 'melissa'); ?></span>
                                        </a>
                                    </div>
                                    <!-- end load more button -->
                                <?php } ?>

                                <?php if ($blog_layout == '2c-rs' || $blog_layout == '1c-rs') { ?>
                            </div><!-- /bwp-posts-col-wrap --></div><!-- /col-md-8 -->
                        <div class="col-md-4 bwp-sidebar-col bwp-sidebar-right">
                            <?php } else if ($blog_layout == '2c-ls' || $blog_layout == '1c-ls') { ?>
                        </div><!-- /bwp-posts-col-wrap --></div><!-- /col-md-8/col-md-push-4 -->
                    <div class="col-md-4 col-md-pull-8 bwp-sidebar-col bwp-sidebar-left">
                        <?php } ?>

                        <?php if ($with_sidebar) {
                        // sidebar
                        get_sidebar(); ?>
                    </div><!-- /col --></div><!-- /row -->
                <?php } ?>

            </div>
</section>
<!-- end masonry blog -->
