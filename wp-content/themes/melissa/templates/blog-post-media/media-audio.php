<?php
/**
 * Featured Image / Audio player (Blog post)
 *
 * @package WordPress
 * @subpackage Melissa
 * @since Melissa 1.0
 */

// if the post is not password protected
if (!post_password_required()) {

  // thumbnail type
  $audio_thumb_type = get_post_meta($post->ID, 'melissa_mb_audio_thumb_type', true); // iframe / featured_image
  if (!$audio_thumb_type) {
    $audio_thumb_type = 'iframe'; // default
  }

  // thumbnail type = featured_image
  if ($audio_thumb_type == 'featured_image') {

    // featured image
    if (has_post_thumbnail()) {

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
        <a href="<?php the_permalink(); ?>" class="bwp-post-media-link">
          <?php the_post_thumbnail($image_size); ?>
          <div class="bwp-post-bg-overlay bwp-transition-4"></div>
          <div class="bwp-post-hover-icon-wrap">
            <div class="bwp-post-hover-icon-alignment">
              <div class="bwp-post-hover-icon-center">
                <span class="bwp-transition-4"><i class="fa fa-music"></i></span>
              </div>
            </div>
          </div>
        </a>
      </figure>
      <!-- end media -->

      <?php
    }

  // thumbnail type = iframe
  } else {

    // audio URL
    $audio_url = get_post_meta($post->ID, 'melissa_mb_audio_url', true);
    if ($audio_url) {
      $audio_embed_code = wp_oembed_get(esc_url($audio_url));
      if ($audio_embed_code) {
        ?>

        <!-- media - audio player -->
        <figure class="bwp-post-media">
          <div class="bwp-iframe-audio-wrap">
            <?php echo !empty($audio_embed_code) ? $audio_embed_code : ''; ?>
          </div>
        </figure>
        <!-- end media -->

        <?php
      }
    }

  }

}
