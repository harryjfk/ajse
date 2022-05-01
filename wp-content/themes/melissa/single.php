<?php
/**
 * The template for displaying all Single posts
 *
 * @package WordPress
 * @subpackage Melissa
 * @since Melissa 1.0
 */

// header
get_header();

// start the loop
while (have_posts()) : the_post();

  // set (update) views counter
  melissa_setPostViews($post->ID);

  // layout
  $single_layout = get_post_meta($post->ID, 'melissa_mb_single_layout', true); // right_sidebar / left_sidebar / full_width / featured_media_right / featured_media_left
  if (!$single_layout) {
    $single_layout = 'right_sidebar'; // default
  }

  // featured media - show/hide
  $show_featured_media = get_post_meta($post->ID, 'melissa_mb_single_show_featured_media', true); // show / hide
  if (!$show_featured_media) {
    $show_featured_media = 'show'; // default
  }

  // post format
  $format = get_post_format();
  if (false === $format) {
    $format = 'standard';
  }

  // attachment page or not
  $is_attachment_page = is_attachment();
  ?>

  <!-- blog post - single page -->
  <section id="bwp-single-page-wrap">
    <div class="container">
      <div class="bwp-single-page-container" <?php echo ($single_layout == 'full_width') ? 'role="main"' : ''; ?>>

        <?php
        // featured media
        if ($single_layout == 'featured_media_right' || $single_layout == 'featured_media_left') {
          if (melissa_has_post_media($format, $post->ID) && !post_password_required() && $show_featured_media == 'show') {
            ?>
            <!-- featured media -->
            <div class="bwp-featured-media-container bwp-transition-3">
              <?php
              // media template
              if ($format == 'gallery' || $format == 'video' || $format == 'audio') {
                get_template_part('templates/single-media/media', $format);
              } else {
                get_template_part('templates/single-media/media', 'image');
              }
              ?>
            </div>
            <!-- end featured media -->
            <?php
          }
        }
        ?>

        <?php if ($single_layout == 'right_sidebar' || $single_layout == 'featured_media_right') { ?>
          <div class="row"><div class="col-md-8 bwp-single-content-col bwp-sidebar-right"><div class="bwp-single-content-col-wrap" role="main">
        <?php } else if ($single_layout == 'left_sidebar' || $single_layout == 'featured_media_left') { ?>
          <div class="row"><div class="col-md-8 col-md-push-4 bwp-single-content-col bwp-sidebar-left"><div class="bwp-single-content-col-wrap" role="main">
        <?php } ?>

        <!-- article -->
        <article id="post-<?php the_ID(); ?>" class="bwp-single-article bwp-transition-3">

          <?php
          // media template
          if (!post_password_required() && $show_featured_media == 'show') {
            if ($single_layout != 'featured_media_right' && $single_layout != 'featured_media_left') {
              if ($format == 'gallery' || $format == 'video' || $format == 'audio') {
                get_template_part('templates/single-media/media', $format);
              } else {
                get_template_part('templates/single-media/media', 'image');
              }
            }
          }
          ?>

          <!-- content container -->
          <div class="bwp-single-content">

            <!-- content -->
            <div class="bwp-content entry-content clearfix">
              <?php
              // content
              the_content();

              // pagination
              wp_link_pages(array(
                'before' => '<nav class="bwp-single-pagination-wrap">',
                'after' => '</nav>',
                'link_before' => '<span>',
                'link_after'  => '</span>',
                'nextpagelink'  => '<i class="fa fa-angle-right"></i>',
                'previouspagelink' => '<i class="fa fa-angle-left"></i>'
              ));
              ?>
            </div>
            <!-- end content -->

            <?php
            $social_buttons_and_counters = false;

            // if the post is not password protected
            if (!post_password_required()) {

              // social sharing buttons / counters
              $single_show_social_share = get_theme_mod('single_show_social_share', 1);
              $single_show_views = get_theme_mod('single_show_views', 1);
              $single_show_comments_counter_mod = get_theme_mod('single_show_comments_counter', 1);
              $single_show_comments_counter = ($single_show_comments_counter_mod && (comments_open() || get_comments_number())) ? 1 : 0;
              $single_show_likes = get_theme_mod('single_show_likes', 1);

              // social sharing buttons and counters
              if ($single_show_social_share) {
                $social_buttons_and_counters = true;
                ?>

                <!-- social sharing buttons / counters -->
                <div class="row">
                  <div class="col-md-7">
                    <?php
                    // social sharing buttons
                    melissa_single_social_share();
                    ?>
                  </div>
                  <div class="col-md-5">
                    <?php
                    // if it is not an attachment page
                    if (!$is_attachment_page) {
                      if ($single_show_views || $single_show_comments_counter || $single_show_likes) {
                        // counters
                        melissa_single_counters($single_show_views, $single_show_comments_counter, $single_show_likes, $single_show_social_share);
                      }
                    }
                    ?>
                  </div>
                </div>
                <!-- end social sharing buttons / counters -->

                <?php
              // only counters
              } else if ($single_show_views || $single_show_comments_counter || $single_show_likes) {
                $social_buttons_and_counters = true;
                // if it is not an attachment page
                if (!$is_attachment_page) {
                  // counters
                  melissa_single_counters($single_show_views, $single_show_comments_counter, $single_show_likes, $single_show_social_share);
                }
              }

              // metadata
              if (!$is_attachment_page) {
                // if it is not an attachment page
                melissa_single_metadata($social_buttons_and_counters);
              }

            }
            ?>

          </div>
          <!-- end content container -->

        </article>
        <!-- end article -->

        <?php
        // if it is not an attachment page
        if (!$is_attachment_page) {

          // post navigation
          $single_show_post_nav = get_theme_mod('single_show_post_nav', 1);
          if ($single_show_post_nav) {
            the_post_navigation(array(
              'next_text' => '<span class="meta-nav">'.esc_html__('Siguiente', 'melissa').'<i class="fa fa-angle-right"></i></span><span class="post-title-nav">%title</span>',
              'prev_text' => '<span class="meta-nav"><i class="fa fa-angle-left"></i>'.esc_html__('Anterior', 'melissa').'</span><span class="post-title-nav">%title</span>',
            ));
          }

          // about the author
          $single_show_about_author = get_theme_mod('single_show_about_author', 0);
          if ($single_show_about_author && !post_password_required()) {
            melissa_about_the_author();
          }

        }

        // comments
        if (comments_open() || get_comments_number()) {
          comments_template();
        }

        // if it is not an attachment page and if the post is not password protected
        if (!$is_attachment_page && !post_password_required()) {
          // related posts (by tags)
          $single_show_related_posts = get_theme_mod('single_show_related_posts', 0);
          if ($single_show_related_posts) {
            get_template_part('templates/related-posts');
          }
        }
        ?>

        <?php if ($single_layout == 'right_sidebar' || $single_layout == 'featured_media_right') { ?>
          </div><!-- /bwp-single-content-col-wrap --></div><!-- /col-md-8 --><div class="col-md-4 bwp-sidebar-col bwp-sidebar-right">
        <?php } else if ($single_layout == 'left_sidebar' || $single_layout == 'featured_media_left') { ?>
          </div><!-- /bwp-single-content-col-wrap --></div><!-- /col-md-8/col-md-push-4 --><div class="col-md-4 col-md-pull-8 bwp-sidebar-col bwp-sidebar-left">
        <?php } ?>

        <?php if ($single_layout == 'right_sidebar' || $single_layout == 'featured_media_right' || $single_layout == 'left_sidebar' || $single_layout == 'featured_media_left') {
          // sidebar
          get_sidebar(); ?>
          </div><!-- /col --></div><!-- /row -->
        <?php } ?>

      </div>
    </div>
  </section>
  <!-- end blog post - single page -->

  <?php
endwhile;
// end of the loop

// footer
get_footer();
