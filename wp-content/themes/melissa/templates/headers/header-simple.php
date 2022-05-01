<?php
/**
 * Simple header
 *
 * @package WordPress
 * @subpackage Melissa
 * @since Melissa 1.0
 */
?>

<!-- header -->
<header id="bwp-header-wrap" class="bwp-header-simple">

  <!-- header bg -->
  <?php
  // header image
  if (melissa_header_image('simple-header')) {
    $header_bg_style = melissa_header_image('simple-header');
  } else {
    $header_bg_style = '';
  }
  ?>
  <div class="bwp-header-bg" <?php echo ($header_bg_style) ? 'style="'.esc_attr($header_bg_style).'"' : ''; ?>>
    <div class="bwp-header-bg-overlay"></div>

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

        <?php
        // header custom text
        if (is_home() || is_404()) {
          $custom_title = get_theme_mod('header_custom_title', '1');
          $custom_text = get_theme_mod('header_custom_text', '1');
          if ($custom_title || $custom_text) {
            ?>

            <!-- row 2 - header custom text -->
            <div class="bwp-header-custom-text-container">
              <?php
              // custom text
              melissa_header_custom_text();
              ?>
            </div>
            <!-- end row 2 - header custom text -->

            <?php
          }
        } else {
          ?>

          <!-- row 2 - header custom text -->
          <div class="bwp-header-custom-text-container">
            <?php
            // custom text
            melissa_header_custom_text();
            ?>
          </div>
          <!-- end row 2 - header custom text -->

          <?php
        }
        ?>

      </div>
    </div>
    <!-- end header content -->
  </div>
  <!-- end header bg -->

  <?php
  // sticky navigation
  melissa_sticky_navigation();
  ?>

</header>
<!-- end header -->
