<?php
/**
 * Featured Image (Blog post)
 *
 * @package WordPress
 * @subpackage Melissa
 * @since Melissa 1.0
 */

// featured image
if (has_post_thumbnail() && !post_password_required()) {

  // post format
  $format = get_post_format();

  // hover icon
  switch ($format) {
    case 'aside':
      $hover_icon = 'fa-flag-o';
      break;
    case 'link':
      $hover_icon = 'fa-link';
      break;
    case 'quote':
      $hover_icon = 'fa-quote-left';
      break;
    case 'status':
      $hover_icon = 'fa-ellipsis-h';
      break;
    case 'chat':
      $hover_icon = 'fa-comments-o';
      break;
    default:
      $hover_icon = 'fa-share';
  }

  // blog layout
  $blog_layout = get_theme_mod('blog_layout', '3c');

  // image size
  $large_image_layouts = array('2c', '1c-ls', '1c-rs', '1c');
  if (in_array($blog_layout, $large_image_layouts)) {
    $image_size = 'melissa-img-1200-auto';
  } else {
    $image_size = 'melissa-img-706-auto';
  }
  ?>

  <!-- media - featured image -->
  <figure class="bwp-post-media">
    <?php
    if ($format == 'link') {
      // target attribute
      $get_link_target = get_post_meta($post->ID, 'melissa_mb_link_target', true); // self / blank
      if (!$get_link_target) {
        $get_link_target = 'self'; // default
      }
      $link_target = ($get_link_target == 'self') ? '_self' : '_blank';
      ?>
      <a href="<?php echo esc_url(melissa_get_link_url()); ?>" target="<?php echo esc_attr($link_target); ?>" class="bwp-post-media-link">
    <?php } else { ?>
      <a href="<?php the_permalink(); ?>" class="bwp-post-media-link">
    <?php } ?>
      <?php the_post_thumbnail($image_size); ?>
      <div class="bwp-post-bg-overlay bwp-transition-4"></div>
      <div class="bwp-post-hover-icon-wrap">
        <div class="bwp-post-hover-icon-alignment">
          <div class="bwp-post-hover-icon-center">
            <span class="bwp-transition-4"><i class="fa <?php echo sanitize_html_class($hover_icon); ?>"></i></span>
          </div>
        </div>
      </div>
    </a>
  </figure>
  <!-- end media -->

  <?php
}
