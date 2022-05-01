<?php
/**
 * The template for displaying all pages
 *
 * @package WordPress
 * @subpackage Melissa
 * @since Melissa 1.0
 */

// header
get_header();

// start the loop
while (have_posts()) : the_post();

  // layout
  $page_layout = get_post_meta($post->ID, 'melissa_mb_page_layout', true); // right_sidebar / left_sidebar / full_width
  if (!$page_layout) {
    $page_layout = 'right_sidebar'; // default
  }

  // featured media - show/hide
  $page_show_featured_image = get_post_meta($post->ID, 'melissa_mb_page_show_featured_image', true); // show / hide
  if (!$page_show_featured_image) {
    $page_show_featured_image = 'show'; // default
  }

  // social sharing buttons
  $page_social_share = get_post_meta($post->ID, 'melissa_mb_page_social_share', true); // show / hide
  if (!$page_social_share) {
    $page_social_share = 'hide'; // default
  }
  ?>

  <!-- single page -->
  <section id="bwp-single-page-wrap" class="bwp-page-template">
    <div class="container">
      <div class="bwp-single-page-container" <?php echo ($page_layout == 'full_width') ? 'role="main"' : ''; ?>>

        <?php if ($page_layout == 'right_sidebar') { ?>
          <div class="row"><div class="col-md-8 bwp-single-content-col bwp-sidebar-right"><div class="bwp-single-content-col-wrap" role="main">
        <?php } else if ($page_layout == 'left_sidebar') { ?>
          <div class="row"><div class="col-md-8 col-md-push-4 bwp-single-content-col bwp-sidebar-left"><div class="bwp-single-content-col-wrap" role="main">
        <?php } ?>

        <!-- article -->
        <article id="page-<?php the_ID(); ?>" class="bwp-single-article bwp-transition-3">

          <?php
          // media - featured image
          if (!post_password_required() && $page_show_featured_image == 'show') {
            get_template_part('templates/single-media/media', 'image');
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
            // social sharing buttons
            if ($page_social_share == 'show' && !post_password_required()) {
              melissa_single_social_share();
            }
            ?>

          </div>
          <!-- end content container -->

        </article>
        <!-- end article -->

        <?php
        // comments
        if (comments_open() || get_comments_number()) {
          comments_template();
        }
        ?>

        <?php if ($page_layout == 'right_sidebar') { ?>
          </div><!-- /bwp-single-content-col-wrap --></div><!-- /col-md-8 --><div class="col-md-4 bwp-sidebar-col bwp-sidebar-right">
        <?php } else if ($page_layout == 'left_sidebar') { ?>
          </div><!-- /bwp-single-content-col-wrap --></div><!-- /col-md-8/col-md-push-4 --><div class="col-md-4 col-md-pull-8 bwp-sidebar-col bwp-sidebar-left">
        <?php } ?>

        <?php if ($page_layout == 'right_sidebar' || $page_layout == 'left_sidebar') {
          // sidebar
          get_sidebar(); ?>
          </div><!-- /col --></div><!-- /row -->
        <?php } ?>

      </div>
    </div>
  </section>
  <!-- end single page -->

  <?php
endwhile;
// end of the loop

// footer
get_footer();
