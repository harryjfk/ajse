<?php
/**
 * Header with Slider Revolution
 *
 * @package WordPress
 * @subpackage Melissa
 * @since Melissa 1.0
 */
?>

<!-- header -->
<header id="bwp-header-wrap" class="bwp-header-rev-slider">

  <!-- header content -->
  <div class="container">
    <div class="bwp-header-content-container">

      <!-- row 1 - logo + navigation -->
      <div class="bwp-main-navigation-container clearfix">

        <?php
        // site logo
        melissa_site_logo();

        // drop-down search form
        melissa_dropdown_search();

        // site menu
        melissa_site_menu();

        // mobile menu
        melissa_mobile_site_menu();
        ?>

      </div>
      <!-- end row 1 - logo + navigation -->

    </div>
  </div>
  <!-- end header content -->

  <!-- hero image slider with 1 slide -->
  <?php
  // background type
  $header_bg_type = get_theme_mod('general_header_bg_type', 'image');

  // current post id
  if (is_single() || is_page()) {
    global $post;
    $current_post_ID = $post->ID;
  }

  // single post page
  if (is_single()) {
    $single_post_header_bg = get_post_meta($current_post_ID, 'melissa_mb_single_post_header_bg', true); // default_bg / own_bg
    if (!$single_post_header_bg) {
      $single_post_header_bg = 'default_bg';
    }
    // own background
    if ($single_post_header_bg == 'own_bg') {
      // new background type
      $header_bg_type = get_post_meta($current_post_ID, 'melissa_mb_single_header_bg_type', true); // image / video
      if (!$header_bg_type) {
        $header_bg_type = 'image';
      }
    }
  }

  // single page
  if (is_page()) {
    $single_page_header_bg = get_post_meta($current_post_ID, 'melissa_mb_single_page_header_bg', true); // default_bg / own_bg
    if (!$single_page_header_bg) {
      $single_page_header_bg = 'default_bg';
    }
    // own background
    if ($single_page_header_bg == 'own_bg') {
      // new background type
      $header_bg_type = get_post_meta($current_post_ID, 'melissa_mb_page_header_bg_type', true); // image / video
      if (!$header_bg_type) {
        $header_bg_type = 'image';
      }
    }
  }

  // header image
  if ($header_bg_type == 'image') {

    // image src
    if (melissa_header_image('rev-slider-header')) {
      $header_image_src = melissa_header_image('rev-slider-header');
    } else {
      $header_image_src = '';
    }

  // header video
  } else {

    // video type (YouTube/Vimeo)
    $header_video_bg_type = get_theme_mod('header_video_bg_type', 'youtube');
    // video attributes (data-videoattributes)
    $host_url = melissa_get_host_url();
    $header_video_attributes = ($header_video_bg_type == 'youtube') ? 'version=3&enablejsapi=1&html5=1&hd=1&wmode=opaque&showinfo=0&ref=0;;origin='.esc_url($host_url).';' : 'background=1&title=0&byline=0&portrait=0&api=1';
    // video id
    $header_video_id = get_theme_mod('header_video_id');
    // video image
    $header_video_image = get_theme_mod('header_video_image');
    // video start time
    $header_video_start_time = get_theme_mod('header_video_start_time');
    // video end time
    $header_video_end_time = get_theme_mod('header_video_end_time');
    // video aspect ratio
    $header_video_aspect_ratio_mod = get_theme_mod('header_video_aspect_ratio', '4_3');
    $header_video_aspect_ratio = ($header_video_aspect_ratio_mod == '4_3') ? '4:3' : '16:9';
    // video volume
    $header_video_volume = get_theme_mod('header_video_volume', 0);
    if ($header_video_volume == 0) {
      $header_video_volume = 'mute';
    }

    // single post page
    if (is_single()) {
      if ($single_post_header_bg == 'own_bg') {

        // video type (YouTube/Vimeo)
        $header_video_bg_type = get_post_meta($current_post_ID, 'melissa_mb_single_header_video_bg_type', true);
        if (!$header_video_bg_type) {
          $header_video_bg_type = 'youtube';
        }
        // video attributes (data-videoattributes)
        $header_video_attributes = ($header_video_bg_type == 'youtube') ? 'version=3&enablejsapi=1&html5=1&hd=1&wmode=opaque&showinfo=0&ref=0;;origin='.esc_url($host_url).';' : 'background=1&title=0&byline=0&portrait=0&api=1';
        // video id
        $header_video_id = get_post_meta($current_post_ID, 'melissa_mb_single_header_video_id', true);
        // video image
        $header_video_image_id = get_post_meta($current_post_ID, 'melissa_mb_single_header_video_image', true);
        if ($header_video_image_id) {
          $header_video_image_url = wp_get_attachment_image_src($header_video_image_id, 'full');
          $header_video_image = $header_video_image_url[0];
        } else {
          $header_video_image = '';
        }
        // video start time
        $header_video_start_time = get_post_meta($current_post_ID, 'melissa_mb_single_header_video_start_time', true);
        // video end time
        $header_video_end_time = get_post_meta($current_post_ID, 'melissa_mb_single_header_video_end_time', true);
        // video aspect ratio
        $header_video_aspect_ratio_meta = get_post_meta($current_post_ID, 'melissa_mb_single_header_video_aspect_ratio', true);
        if (!$header_video_aspect_ratio_meta) {
          $header_video_aspect_ratio_meta = '4_3';
        }
        $header_video_aspect_ratio = ($header_video_aspect_ratio_meta == '4_3') ? '4:3' : '16:9';
        // video volume
        $header_video_volume_meta = get_post_meta($current_post_ID, 'melissa_mb_single_header_video_volume', true);
        if (!$header_video_volume_meta) {
          $header_video_volume_meta = 0;
        } else {
          $header_video_volume_meta = intval($header_video_volume_meta);
        }
        if ($header_video_volume_meta >= 0 && $header_video_volume_meta <= 100) {
          if ($header_video_volume_meta == 0) {
            $header_video_volume = 'mute';
          } else {
            $header_video_volume = $header_video_volume_meta;
          }
        }

      }
    }

    // single page
    if (is_page()) {
      if ($single_page_header_bg == 'own_bg') {

        // video type (YouTube/Vimeo)
        $header_video_bg_type = get_post_meta($current_post_ID, 'melissa_mb_page_header_video_bg_type', true);
        if (!$header_video_bg_type) {
          $header_video_bg_type = 'youtube';
        }
        // video attributes (data-videoattributes)
        $header_video_attributes = ($header_video_bg_type == 'youtube') ? 'version=3&enablejsapi=1&html5=1&hd=1&wmode=opaque&showinfo=0&ref=0;;origin='.esc_url($host_url).';' : 'background=1&title=0&byline=0&portrait=0&api=1';
        // video id
        $header_video_id = get_post_meta($current_post_ID, 'melissa_mb_page_header_video_id', true);
        // video image
        $header_video_image_id = get_post_meta($current_post_ID, 'melissa_mb_page_header_video_image', true);
        if ($header_video_image_id) {
          $header_video_image_url = wp_get_attachment_image_src($header_video_image_id, 'full');
          $header_video_image = $header_video_image_url[0];
        } else {
          $header_video_image = '';
        }
        // video start time
        $header_video_start_time = get_post_meta($current_post_ID, 'melissa_mb_page_header_video_start_time', true);
        // video end time
        $header_video_end_time = get_post_meta($current_post_ID, 'melissa_mb_page_header_video_end_time', true);
        // video aspect ratio
        $header_video_aspect_ratio_meta = get_post_meta($current_post_ID, 'melissa_mb_page_header_video_aspect_ratio', true);
        if (!$header_video_aspect_ratio_meta) {
          $header_video_aspect_ratio_meta = '4_3';
        }
        $header_video_aspect_ratio = ($header_video_aspect_ratio_meta == '4_3') ? '4:3' : '16:9';
        // video volume
        $header_video_volume_meta = get_post_meta($current_post_ID, 'melissa_mb_page_header_video_volume', true);
        if (!$header_video_volume_meta) {
          $header_video_volume_meta = 0;
        } else {
          $header_video_volume_meta = intval($header_video_volume_meta);
        }
        if ($header_video_volume_meta >= 0 && $header_video_volume_meta <= 100) {
          if ($header_video_volume_meta == 0) {
            $header_video_volume = 'mute';
          } else {
            $header_video_volume = $header_video_volume_meta;
          }
        }

      }
    }

  }
  ?>
  <div class="rev_slider_wrapper">
    <div id="bwp-header-hero-image" class="rev_slider" data-version="5.4.8">
      <ul>

        <!-- slide -->
        <li
          data-index="rs-1"
          data-transition="fade"
          data-slotamount="default"
          data-hideafterloop="0"
          data-hideslideonmobile="off"
          data-easein="Power2.easeInOut"
          data-easeout="default"
          data-masterspeed="2000"
          data-delay="1500"
          data-rotate="0"
          data-saveperformance="off">

          <?php if ($header_bg_type == 'image') { ?>
            <?php if ($header_image_src) { ?>

              <!-- main image -->
              <img src="<?php echo esc_url($header_image_src); ?>"
                   alt=""
                   width="1900"
                   height="1267"
                   data-bgposition="center center"
                   data-bgfit="cover"
                   data-bgrepeat="no-repeat"
                   data-bgparallax="8"
                   data-kenburns="on"
                   data-duration="25000"
                   data-ease="Power2.easeOut"
                   data-scalestart="130"
                   data-scaleend="100"
                   data-rotatestart="0"
                   data-rotateend="0"
                   data-offsetstart="0 0"
                   data-offsetend="0 0"
                   class="rev-slidebg"
                   data-no-retina>
              <!-- end main image -->

            <?php } else { ?>

              <!-- main image / solid color background -->
              <img src="<?php echo esc_url(get_template_directory_uri()); ?>/img/transparent_slide.png" alt="" class="bwp-header-rs-bg-overlay">
              <!-- end main image / solid color background -->

            <?php } ?>
          <?php } ?>

          <?php if ($header_bg_type == 'video') { ?>
            <?php if ($header_video_image) { ?>

              <!-- main image -->
              <img src="<?php echo esc_url($header_video_image); ?>"
                   alt=""
                   width="1900"
                   height="1267"
                   data-bgposition="center center"
                   data-bgfit="cover"
                   data-bgrepeat="no-repeat"
                   data-bgparallax="6"
                   class="rev-slidebg"
                   data-no-retina>
              <!-- end main image -->

            <?php } else { ?>

              <!-- main image / transparent background -->
              <img src="<?php echo esc_url(get_template_directory_uri()); ?>/img/transparent_slide.png" alt="">
              <!-- end main image / transparent background -->

            <?php } ?>
            <?php if ($header_video_id) { ?>

              <!-- video layer -->
              <div class="rs-background-video-layer"
                   data-forcerewind="on"
                   data-volume="<?php echo esc_attr($header_video_volume); ?>"
                   <?php if ($header_video_bg_type == 'youtube') { ?>
                     data-ytid="<?php echo esc_attr($header_video_id); ?>"
                     data-videorate="1"
                   <?php } else { ?>
                     data-vimeoid="<?php echo esc_attr($header_video_id); ?>"
                   <?php } ?>
                   data-videoattributes="<?php echo esc_attr($header_video_attributes); ?>"
                   data-videowidth="100%"
                   data-videoheight="100%"
                   data-videocontrols="none"
                   <?php if ($header_video_start_time) { ?>
                     data-videostartat="<?php echo esc_attr($header_video_start_time); ?>"
                   <?php } ?>
                   <?php if ($header_video_end_time) { ?>
                     data-videoendat="<?php echo esc_attr($header_video_end_time); ?>"
                   <?php } ?>
                   data-videoloop="loop"
                   data-forceCover="1"
                   data-aspectratio="<?php echo esc_attr($header_video_aspect_ratio); ?>"
                   data-autoplay="true"
                   data-autoplayonlyfirsttime="false"
                   data-nextslideatend="true">
              </div>
              <!-- end video layer -->

            <?php } ?>
          <?php } ?>

          <?php if ($header_bg_type == 'image') { ?>
            <?php if ($header_image_src) { ?>

              <!-- layer 1 - bg overlay -->
              <div class="tp-caption tp-shape tp-shapewrapper bwp-header-rs-bg-overlay"
                   data-basealign="slide"
                   data-x="['center','center','center','center']"
                   data-y="['middle','middle','middle','middle']"
                   data-hoffset="['0','0','0','0']"
                   data-voffset="['0','0','0','0']"
                   data-width="full"
                   data-height="full"
                   data-whitespace="nowrap"
                   data-start="200"
                   style="z-index: 1;">
              </div>
              <!-- end layer 1 -->

            <?php } ?>
          <?php } else { ?>
            <?php if ($header_video_id || $header_video_image) { ?>

              <!-- layer 1 - bg overlay -->
              <div class="tp-caption tp-shape tp-shapewrapper bwp-header-rs-bg-overlay"
                   data-basealign="slide"
                   data-x="['center','center','center','center']"
                   data-y="['middle','middle','middle','middle']"
                   data-hoffset="['0','0','0','0']"
                   data-voffset="['0','0','0','0']"
                   data-width="full"
                   data-height="full"
                   data-whitespace="nowrap"
                   data-start="200"
                   style="z-index: 1;">
              </div>
              <!-- end layer 1 -->

            <?php } ?>
          <?php } ?>

          <!-- layer 2 - header custom text -->
          <div class="tp-caption tp-resizeme rs-parallaxlevel-0 bwp-header-rs-caption"
               data-basealign="grid"
               data-x="['left','left','left','left']"
               data-hoffset="['0','0','0','15']"
               data-y="['bottom','bottom','bottom','bottom']"
               data-voffset="['130','125','125','120']"
               data-width="['1140','940','720','720']"
               data-height="none"
               data-whitespace="normal"
               data-transform_idle="o:1;"
               data-transform_in="y:20px;opacity:0;s:900;e:Power2.easeIn;"
               data-transform_out="opacity:0;s:900;e:Power2.easeOut;"
               data-start="200"
               data-splitin="none"
               data-splitout="none"
               data-responsive_offset="off"
               style="z-index: 5;">

            <?php
            // custom text
            melissa_header_custom_text();
            ?>

          </div>
          <!-- end layer 2 -->

        </li>
        <!-- end slide -->

      </ul>
    </div>
  </div>
  <!-- end hero image slider -->

  <?php
  // sticky navigation
  melissa_sticky_navigation();
  ?>

</header>
<!-- end header -->
