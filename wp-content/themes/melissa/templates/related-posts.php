<?php
/**
 * Related posts template (by tags)
 *
 * @package WordPress
 * @subpackage Melissa
 * @since Melissa 1.0
 */

// get post tags
$tags = wp_get_post_terms(get_the_ID());
if ($tags) {

  // single post page layout
  $single_layout = get_post_meta($post->ID, 'melissa_mb_single_layout', true); // right_sidebar / left_sidebar / full_width / featured_media_right / featured_media_left
  if (!$single_layout) {
    $single_layout = 'right_sidebar'; // default
  }

  // get tags IDs
  $tagcount = count($tags);
  for ($i = 0; $i < $tagcount; $i++) {
    $tagIDs[$i] = $tags[$i]->term_id;
  }

  // posts_per_page value and related posts container class
  $posts_per_page = 2;
  $posts_number_class = 'bwp-show-2-posts';
  if ($single_layout == 'full_width') {
    $posts_per_page = 3;
    $posts_number_class = 'bwp-show-3-posts';
  }

  // new query arguments
  $args = array(
    'tag__in' => $tagIDs,
    'post__not_in' => array($post->ID),
    'posts_per_page' => intval($posts_per_page),
    'orderby' => 'rand',
    'ignore_sticky_posts' => 1
  );

  // start query
  $relatedPosts = new WP_Query($args);
  if ($relatedPosts->have_posts()) :
    ?>

    <!-- related posts (by tags) -->
    <div class="bwp-related-posts-container <?php echo sanitize_html_class($posts_number_class); ?>">
      <div class="bwp-o-hidden">

        <!-- title -->
        <h2 class="bwp-related-posts-title">
          <?php esc_html_e('You might also like:', 'melissa'); ?>
        </h2>
        <!-- end title -->

        <!-- posts list -->
        <div class="bwp-related-posts clearfix">

          <?php
          while ($relatedPosts->have_posts()) :
            $relatedPosts->the_post();

            // image size
            $image_size = 'melissa-img-706-auto';

            // post format
            $format = get_post_format();
            if (false === $format) {
              $format = 'standard';
            }

            // hover icon + format class
            switch ($format) {
              case 'aside':
                $hover_icon = 'fa-flag-o';
                $format_class = 'bwp-post-aside-format';
                break;
              case 'link':
                $hover_icon = 'fa-link';
                $format_class = 'bwp-post-link-format';
                break;
              case 'quote':
                $hover_icon = 'fa-quote-left';
                $format_class = 'bwp-post-quote-format';
                break;
              case 'status':
                $hover_icon = 'fa-ellipsis-h';
                $format_class = 'bwp-post-status-format';
                break;
              case 'chat':
                $hover_icon = 'fa-comments-o';
                $format_class = 'bwp-post-chat-format';
                break;
              default:
                $hover_icon = 'fa-share';
                $format_class = '';
            }

            // link format
            if ($format == 'link') {
              // get link url
              $link_url = melissa_get_link_url();
              // target attribute
              $get_link_target = get_post_meta($post->ID, 'melissa_mb_link_target', true); // self / blank
              if (!$get_link_target) {
                $get_link_target = 'self'; // default
              }
              $link_target = ($get_link_target == 'self') ? '_self' : '_blank';
            }
            ?>

            <!-- related post -->
            <article class="bwp-related-post <?php echo sanitize_html_class($format_class); ?>">
              <div class="bwp-related-post-wrap bwp-transition-3">

                <?php
                // media
                // video format
                if ($format == 'video') {

                  // thumbnail type
                  $video_thumb_type = get_post_meta($post->ID, 'melissa_mb_video_thumb_type', true); // iframe / featured_image
                  if (!$video_thumb_type) {
                    $video_thumb_type = 'iframe'; // default
                  }

                  // thumbnail type = featured_image
                  if ($video_thumb_type == 'featured_image') {
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
                                <span class="bwp-transition-4"><i class="fa fa-play"></i></span>
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
                    // video URL
                    $video_url = get_post_meta($post->ID, 'melissa_mb_video_url', true);
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
                    }
                  }

                // audio format
                } else if ($format == 'audio') {

                  // thumbnail type
                  $audio_thumb_type = get_post_meta($post->ID, 'melissa_mb_audio_thumb_type', true); // iframe / featured_image
                  if (!$audio_thumb_type) {
                    $audio_thumb_type = 'iframe'; // default
                  }

                  // thumbnail type = featured_image
                  if ($audio_thumb_type == 'featured_image') {
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

                // gallery format
                } else if ($format == 'gallery') {

                  // thumbnail type
                  $gallery_thumb_type = get_post_meta($post->ID, 'melissa_mb_gallery_thumb_type', true); // featured_image / slider
                  if (!$gallery_thumb_type) {
                    $gallery_thumb_type = 'slider'; // default
                  }

                  // thumbnail type = featured_image
                  if ($gallery_thumb_type == 'featured_image') {
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
                      // show one image from the gallery
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

                // all other formats
                } else {

                  if (has_post_thumbnail()) {
                    ?>

                    <!-- media - featured image -->
                    <figure class="bwp-post-media">
                      <?php if ($format == 'link') { ?>
                        <a href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>" class="bwp-post-media-link">
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

                }
                // end media
                ?>

                <!-- content -->
                <div class="bwp-post-content">

                  <?php if ($format == 'link') { ?>
                    <!-- link format icon -->
                    <a href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>" class="bwp-post-format-icon">
                      <i class="fa fa-external-link"></i>
                    </a>
                    <!-- end link format icon -->
                  <?php } else if ($format == 'status') { ?>
                    <!-- status format icon -->
                    <a href="<?php the_permalink(); ?>" class="bwp-post-format-icon">
                      <i class="fa fa-ellipsis-h"></i>
                    </a>
                    <!-- end status format icon -->
                  <?php } else if ($format == 'chat') { ?>
                    <!-- chat format icon -->
                    <a href="<?php the_permalink(); ?>" class="bwp-post-format-icon">
                      <i class="fa fa-comments-o"></i>
                    </a>
                    <!-- end chat format icon -->
                  <?php } ?>

                  <?php
                  // title
                  if ($format == 'aside' || $format == 'quote') {
                    if (get_the_title()) {
                      ?>
                      <!-- title -->
                      <h3 class="bwp-post-title entry-title">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                      </h3>
                      <!-- end title -->
                      <?php
                    }
                  } else if ($format == 'link') {
                    ?>
                    <!-- title -->
                    <h3 class="bwp-post-title entry-title">
                      <a href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>"><?php the_title(); ?></a>
                    </h3>
                    <!-- end title -->
                    <?php
                  } else {
                    ?>
                    <!-- title -->
                    <h3 class="bwp-post-title entry-title">
                      <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h3>
                    <!-- end title -->
                    <?php
                  }
                  ?>

                  <?php
                  // content or excerpt
                  if ($format == 'aside' || $format == 'link' || $format == 'status' || $format == 'chat') {
                    // content
                    melissa_post_content();
                  } else if ($format == 'quote') {
                    // content
                    melissa_quote_content();
                  } else {
                    // excerpt
                    melissa_post_excerpt();
                  }

                  // date + read more link
                  melissa_related_post_details();
                  ?>

                </div>
                <!-- end content -->

              </div>
            </article>
            <!-- end related post -->

            <?php
          endwhile;
          ?>

        </div>
        <!-- end posts list -->

      </div>
    </div>
    <!-- end related posts -->

    <?php
  endif;
  wp_reset_postdata();
}
