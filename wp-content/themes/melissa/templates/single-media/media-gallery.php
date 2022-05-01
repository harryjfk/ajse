<?php
/**
 * Gallery (Single post page)
 *
 * @package WordPress
 * @subpackage Melissa
 * @since Melissa 1.0
 */

// image size
$image_size = 'melissa-img-1200-auto';

// gallery images ID
$gallery_images_id = get_post_meta($post->ID, 'melissa_mb_gallery', false);
if (!is_array($gallery_images_id)) {
  $gallery_images_id = (array)$gallery_images_id;
}

// if $gallery_images_id is not empty
if (!empty($gallery_images_id) && $gallery_images_id[0]) {
  $images_num = count($gallery_images_id);
  if ($images_num > 1) {
    // several images in the gallery
    ?>

    <!-- media - gallery -->
    <div class="bwp-post-media-carousel">
      <div id="bwp-post-owl-carousel-<?php the_ID(); ?>" class="owl-carousel owl-theme bwp-post-carousel bwp-popup-gallery">

        <?php
        foreach ($gallery_images_id as $image_id) {
          $gallery_full_image_url = wp_get_attachment_image_src($image_id, 'full');
          $gallery_image_url = wp_get_attachment_image_src($image_id, $image_size);
          $image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
          $image_caption = get_post($image_id) -> post_excerpt;
          ?>

          <!-- gallery item -->
          <figure class="bwp-post-carousel-item">
            <a href="<?php echo esc_url($gallery_full_image_url[0]); ?>" class="bwp-popup-gallery-item" title="<?php if ($image_caption) { echo esc_attr($image_caption); } else { the_title_attribute(); } ?>">
              <img src="<?php echo esc_url($gallery_image_url[0]); ?>" alt="<?php if ($image_alt) { echo esc_attr($image_alt); } else { the_title_attribute(); } ?>">
              <span class="bwp-expand-icon bwp-transition-4"><i class="fa fa-expand"></i></span>
            </a>
            <?php if ($image_caption) { ?>
              <figcaption class="bwp-single-media-caption"><?php echo esc_html($image_caption); ?></figcaption>
            <?php } ?>
          </figure>
          <!-- end gallery item -->

          <?php
        }
        ?>

      </div>
    </div>
    <!-- end media -->

    <?php
  } else {
    // one image in the gallery
    $gallery_full_image_url = wp_get_attachment_image_src($gallery_images_id[0], 'full');
    $gallery_image_url = wp_get_attachment_image_src($gallery_images_id[0], $image_size);
    $image_alt = get_post_meta($gallery_images_id[0], '_wp_attachment_image_alt', true);
    $image_caption = get_post($gallery_images_id[0]) -> post_excerpt;
    ?>

    <!-- media - one image from the gallery -->
    <figure class="bwp-post-media">
      <a href="<?php echo esc_url($gallery_full_image_url[0]); ?>" class="bwp-popup-image" title="<?php if ($image_caption) { echo esc_attr($image_caption); } else { the_title_attribute(); } ?>">
        <img src="<?php echo esc_url($gallery_image_url[0]); ?>" alt="<?php if ($image_alt) { echo esc_attr($image_alt); } else { the_title_attribute(); } ?>">
        <span class="bwp-expand-icon bwp-transition-4"><i class="fa fa-expand"></i></span>
      </a>
      <?php if ($image_caption) { ?>
        <figcaption class="bwp-single-media-caption"><?php echo esc_html($image_caption); ?></figcaption>
      <?php } ?>
    </figure>
    <!-- end media -->

    <?php
  }
} else {
  // show featured image
  if (has_post_thumbnail()) {
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
