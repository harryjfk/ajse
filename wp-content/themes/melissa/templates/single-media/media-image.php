<?php
/**
 * Featured Image (Single post page)
 *
 * @package WordPress
 * @subpackage Melissa
 * @since Melissa 1.0
 */

// featured image
if (has_post_thumbnail()) {
  // post format
  $format = get_post_format();
  // image data
  $image_size = 'melissa-img-1200-auto';
  $full_image_url = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
  $image_caption = get_post(get_post_thumbnail_id()) -> post_excerpt;
  $hover_icon = ($format == 'link') ? 'fa-link' : 'fa-expand';
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
      <a href="<?php echo esc_url(melissa_get_link_url()); ?>" target="<?php echo esc_attr($link_target); ?>">
    <?php } else { ?>
      <a href="<?php echo esc_url($full_image_url[0]); ?>" class="bwp-popup-image" title="<?php if ($image_caption) { echo esc_attr($image_caption); } else { the_title_attribute(); } ?>">
    <?php } ?>
      <?php the_post_thumbnail($image_size); ?>
      <span class="bwp-expand-icon bwp-transition-4"><i class="fa <?php echo sanitize_html_class($hover_icon); ?>"></i></span>
    </a>
    <?php if ($image_caption) { ?>
      <figcaption class="bwp-single-media-caption"><?php echo esc_html($image_caption); ?></figcaption>
    <?php } ?>
  </figure>
  <!-- end media -->

  <?php
}
