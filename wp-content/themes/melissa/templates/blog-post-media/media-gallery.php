<?php
/**
 * Featured Image / Slider (Blog post)
 *
 * @package WordPress
 * @subpackage Melissa
 * @since Melissa 1.0
 */

// if the post is not password protected
if (!post_password_required()) {

  // thumbnail type
  $gallery_thumb_type = get_post_meta($post->ID, 'melissa_mb_gallery_thumb_type', true); // featured_image / slider
  if (!$gallery_thumb_type) {
    $gallery_thumb_type = 'slider'; // default
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

  // thumbnail type = featured_image
  if ($gallery_thumb_type == 'featured_image') {

    // featured image
    if (has_post_thumbnail()) {
      ?>

      <!-- media - featured image -->
      <figure class="bwp-post-media">
        <a href="<?php the_permalink(); ?>" class="bwp-post-media-link">
          <?php the_post_thumbnail($image_size); ?>
          <div class="bwp-post-bg-overlay bwp-transition-4"></div>
          <div class="bwp-post-hover-icon-wrap">
            <div class="bwp-post-hover-icon-alignment">
              <div class="bwp-post-hover-icon-center">
                <span class="bwp-transition-4"><i class="fa fa-share"></i></span>
              </div>
            </div>
          </div>
        </a>
      </figure>
      <!-- end media -->

      <?php
    }

  // thumbnail type = slider
  } else {

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
          <div id="bwp-post-owl-carousel-<?php the_ID(); ?>" class="owl-carousel owl-theme bwp-post-carousel">

            <?php
            foreach ($gallery_images_id as $image_id) {
              $gallery_image_url = wp_get_attachment_image_src($image_id, $image_size);
              $image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
              ?>

              <!-- gallery item -->
              <figure class="bwp-post-carousel-item">
                <a href="<?php the_permalink(); ?>" class="bwp-post-media-link">
                  <img src="<?php echo esc_url($gallery_image_url[0]); ?>" alt="<?php if ($image_alt) { echo esc_attr($image_alt); } else { the_title_attribute(); } ?>">
                  <div class="bwp-post-bg-overlay bwp-transition-4"></div>
                  <div class="bwp-post-hover-icon-wrap">
                    <div class="bwp-post-hover-icon-alignment">
                      <div class="bwp-post-hover-icon-center">
                        <span class="bwp-transition-4"><i class="fa fa-share"></i></span>
                      </div>
                    </div>
                  </div>
                </a>
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
        $gallery_image_url = wp_get_attachment_image_src($gallery_images_id[0], $image_size);
        $image_alt = get_post_meta($gallery_images_id[0], '_wp_attachment_image_alt', true);
        ?>

        <!-- media - one image from the gallery -->
        <figure class="bwp-post-media">
          <a href="<?php the_permalink(); ?>" class="bwp-post-media-link">
            <img src="<?php echo esc_url($gallery_image_url[0]); ?>" alt="<?php if ($image_alt) { echo esc_attr($image_alt); } else { the_title_attribute(); } ?>">
            <div class="bwp-post-bg-overlay bwp-transition-4"></div>
            <div class="bwp-post-hover-icon-wrap">
              <div class="bwp-post-hover-icon-alignment">
                <div class="bwp-post-hover-icon-center">
                  <span class="bwp-transition-4"><i class="fa fa-share"></i></span>
                </div>
              </div>
            </div>
          </a>
        </figure>
        <!-- end media -->

        <?php
      }
    }

  }

}
