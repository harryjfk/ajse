<?php
/**
 * The template for displaying posts in the Standard post format
 *
 * @package WordPress
 * @subpackage Melissa
 * @since Melissa 1.0
 */

// post type
$post_type = get_post_type($post->ID);

// blog page layout
$blog_layout = get_theme_mod('blog_layout', '3c');

// post class
switch ($blog_layout) {
  case '3c':
    $post_classes = 'bwp-masonry-item bwp-blog-col-3';
    break;
  case '2c-ls':
  case '2c-rs':
  case '2c':
    $post_classes = 'bwp-masonry-item bwp-blog-col-2';
    break;
  case '1c-ls':
  case '1c-rs':
  case '1c':
    $post_classes = 'bwp-masonry-item bwp-blog-col-1';
    break;
}
?>

<!-- post - standard format -->
<article id="post-<?php the_ID(); ?>" <?php post_class($post_classes); ?>>
  <div class="bwp-post-wrap bwp-transition-3">

    <?php
    // media - featured image
    get_template_part('templates/blog-post-media/media', 'image');
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
      melissa_post_details($post_type);
      ?>

    </div>
    <!-- end content -->

  </div>
</article>
<!-- end post -->
