<?php
/**
 * The template for displaying 404 pages (Not Found)
 *
 * @package WordPress
 * @subpackage Melissa
 * @since Melissa 1.0
 */

// header
get_header();
?>

<!-- page 404 -->
<section id="bwp-page-404-wrap">
  <div class="container">
    <div class="bwp-page-404-container bwp-transition-3">
      <h2><?php esc_html_e('Oops... Error 404', 'melissa'); ?></h2>
      <h3><?php esc_html_e('We are sorry, but the page you are looking for does not exist.', 'melissa'); ?></h3>
      <p><?php printf(__('Please check entered address and try again or go to <a href="%1$s" rel="home">homepage</a>.', 'melissa'), esc_url(home_url('/'))); ?></p>
    </div>
  </div>
</section>
<!-- end page 404 -->

<?php
// footer
get_footer();
