<?php
/**
 * The template for displaying posts in the Link post format
 *
 * A link to another site. Theme uses the first <a href=""> tag in the post content as the external link for that post.
 *
 * @link https://codex.wordpress.org/Post_Formats
 *
 * @package WordPress
 * @subpackage Melissa
 * @since Melissa 1.0
 */

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

// get link url
$link_url = melissa_get_link_url();

// target attribute
$get_link_target = get_post_meta($post->ID, 'melissa_mb_link_target', true); // self / blank
if (!$get_link_target) {
  $get_link_target = 'self'; // default
}
$link_target = ($get_link_target == 'self') ? '_self' : '_blank';
?>

<!-- post - link format -->
<article id="post-<?php the_ID(); ?>" <?php post_class($post_classes); ?>>
  <div class="bwp-post-wrap bwp-transition-3 bwp-post-link-format">

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

      <!-- link format icon -->
      <a href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>" class="bwp-post-format-icon">
        <i class="fa fa-external-link"></i>
      </a>
      <!-- end link format icon -->

      <!-- title -->
      <h3 class="bwp-post-title entry-title">
        <a href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>"><?php the_title(); ?></a>
      </h3>
      <!-- end title -->

      <?php
      // content
      melissa_post_content();

      // date + counters
      melissa_post_details();
      ?>

    </div>
    <!-- end content -->

  </div>
</article>
<!-- end post -->
