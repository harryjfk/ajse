<?php
/**
 * The template for displaying posts in the Gallery post format
 *
 * @package WordPress
 * @subpackage Melissa
 * @since Melissa 1.0
 */

// sticky class
$infinite_scroll_class = '';
if (is_sticky()) {
  $infinite_scroll_class = ' bwp-sticky-post';
}

// blog page layout
$blog_layout = get_theme_mod('blog_layout', '3c');

// post class
switch ($blog_layout) {
  case '3c':
    $post_classes = 'bwp-masonry-item bwp-blog-col-3'.$infinite_scroll_class;
    break;
  case '2c-ls':
  case '2c-rs':
  case '2c':
    $post_classes = 'bwp-masonry-item bwp-blog-col-2'.$infinite_scroll_class;
    break;
  case '1c-ls':
  case '1c-rs':
  case '1c':
    $post_classes = 'bwp-masonry-item bwp-blog-col-1'.$infinite_scroll_class;
    break;
}
?>

<!-- post - gallery format -->
<article id="post-<?php the_ID(); ?>" <?php post_class($post_classes); ?>>
  <div class="bwp-post-wrap bwp-transition-3">

    <?php
    // media - featured image or slider
    get_template_part('templates/blog-post-media/media', 'gallery');
    ?>

    <!-- content -->
    <div class="bwp-post-content">

      <?php
      // sticky post icon
      if (is_sticky()) { ?>
        <div class="bwp-sticky-mark"><i class="fa fa-thumb-tack"></i></div>
      <?php } ?>

      <!-- title -->
      <h3 class="bwp-post-title entry-title">
        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
      </h3>
      <!-- end title -->

      <?php
      // excerpt
      melissa_post_excerpt();

      // date + counters
      melissa_post_details();
      ?>

    </div>
    <!-- end content -->

  </div>
</article>
<!-- end post -->
