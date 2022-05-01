<?php
/**
 * Video player (Single post page)
 *
 * @package WordPress
 * @subpackage Melissa
 * @since Melissa 1.0
 */

// video URL
$video_url = get_post_meta($post->ID, 'melissa_mb_video_url', true);

// if $video_url is not empty
if ($video_url) {
  $video_embed_code = wp_oembed_get(esc_url($video_url));
  if ($video_embed_code) {
    ?>

    <!-- media - video player -->
    <figure class="bwp-post-media">
      <div class="bwp-iframe-video-wrap">
        <?php echo !empty($video_embed_code) ? $video_embed_code : ''; ?>
      </div>
    </figure>
    <!-- end media -->

    <?php
  }
} else {
  // show featured image
  if (has_post_thumbnail()) {
    $image_size = 'melissa-img-1200-auto';
    $full_image_url = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
    $image_caption = get_post(get_post_thumbnail_id()) -> post_excerpt;
    ?>

    <!-- media - featured image -->
    <figure class="bwp-post-media">
      <a href="<?php echo esc_url($full_image_url[0]); ?>" class="bwp-popup-image" title="<?php if ($image_caption) { echo esc_attr($image_caption); } else { the_title_attribute(); } ?>">
        <?php the_post_thumbnail($image_size); ?>
        <span class="bwp-expand-icon bwp-transition-4"><i class="fa fa-expand"></i></span>
      </a>
      <?php if ($image_caption) { ?>
        <figcaption class="bwp-single-media-caption"><?php echo esc_html($image_caption); ?></figcaption>
      <?php } ?>
    </figure>
    <!-- end media -->

    <?php
  }
}
