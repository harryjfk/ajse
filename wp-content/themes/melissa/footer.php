<?php
/**
 * The template for displaying the footer
 *
 * @package WordPress
 * @subpackage Melissa
 * @since Melissa 1.0
 */

// footer widgets
if (is_active_sidebar('melissa_footer_widgets_1') || is_active_sidebar('melissa_footer_widgets_2') || is_active_sidebar('melissa_footer_widgets_3')) : ?>

  <!-- footer widgets -->
  <section id="bwp-footer-widgets-wrap" role="complementary">
    <div class="container">
      <h2 class="bwp-hidden-section-heading"><?php esc_html_e('Footer widgets', 'melissa'); ?></h2>
      <div class="bwp-footer-widgets-container">
        <div class="row">

          <!-- col 1 -->
          <div class="col-md-4 bwp-footer-col-1">
            <?php if (is_active_sidebar('melissa_footer_widgets_1')) :
              dynamic_sidebar('melissa_footer_widgets_1');
            endif; ?>
          </div>
          <!-- end col 1 -->

          <!-- col 2 -->
          <div class="col-md-4 bwp-footer-col-2">
            <?php if (is_active_sidebar('melissa_footer_widgets_2')) :
              dynamic_sidebar('melissa_footer_widgets_2');
            endif; ?>
          </div>
          <!-- end col 2 -->

          <!-- col 3 -->
          <div class="col-md-4 bwp-footer-col-3">
            <?php if (is_active_sidebar('melissa_footer_widgets_3')) :
              dynamic_sidebar('melissa_footer_widgets_3');
            endif; ?>
          </div>
          <!-- end col 3 -->

        </div>
      </div>
    </div>
  </section>
  <!-- end footer widgets -->

<?php endif; ?>

<!-- footer -->
<footer id="bwp-footer-wrap">
  <div class="container">
    <div class="bwp-footer-container clearfix">

      <?php
      // footer text (copyright)
      $copyright_text = get_theme_mod('copyright_text', 'Copyright text (Appearance -> Customize -> Footer -> Copyright text)');
      if ($copyright_text) { ?>
        <!-- footer text -->
        <div class="bwp-footer-text">
          <?php
          echo wp_kses($copyright_text,
            array(
              'a' => array(
                'href' => array(),
                'title' => array(),
                'target' => array(),
                'class' => array()
              ),
              'span' => array(
                'class' => array()
              ),
              'strong' => array(),
              'b' => array(),
              'em' => array(),
              'i' => array(
                'class' => array()
              ),
              'br' => array()
            )
          );
          ?>
        </div>
        <!-- end footer text -->
      <?php } ?>

      <?php
      // social links
      $social_url = array();
      $social_list = array('twitter', 'facebook', 'google-plus', 'pinterest-p', 'vk', 'flickr', 'instagram', '500px', 'youtube', 'vimeo', 'soundcloud', 'dribbble', 'behance', 'github', 'rss');
      // get all social url
      foreach ($social_list as $social_list_value) {
        $social_url[$social_list_value] = get_theme_mod('footer_url_'.$social_list_value);
      }
      // check $social_url
      $social_url_empty = true;
      foreach ($social_url as $social_url_key => $social_url_value) {
        if ($social_url_value) {
          $social_url_empty = false;
          break;
        }
      }
      // show social links
      if (!$social_url_empty) { ?>
        <!-- social links -->
        <ul class="bwp-footer-social-links list-unstyled clearfix">
          <?php
          foreach ($social_url as $social_url_key => $social_url_value) {
            if ($social_url_value) {
              echo '<li><a href="'.esc_url($social_url_value).'" target="_blank" class="bwp-f-'.esc_attr($social_url_key).'-link"><i class="fa fa-'.esc_attr($social_url_key).'"></i></a></li>';
            }
          }
          ?>
        </ul>
        <!-- end social links -->
      <?php } ?>

    </div>
  </div>
</footer>
<!-- end footer -->

<?php wp_footer(); ?>
</body>
</html>