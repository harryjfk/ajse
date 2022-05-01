<?php
/**
 * The template for displaying a message that posts cannot be found
 *
 * @package WordPress
 * @subpackage Melissa
 * @since Melissa 1.0
 */
?>

<!-- no results container -->
<div class="bwp-no-results-container bwp-transition-3">
  <h3><?php esc_html_e('Nothing found', 'melissa'); ?></h3>
  <?php if (is_home() && current_user_can('publish_posts')) { ?>
    <p><?php printf(__('Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'melissa'), esc_url(admin_url('post-new.php'))); ?></p>
  <?php } else if (is_search()) { ?>
    <p><?php esc_html_e('Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'melissa'); ?></p>
  <?php } else { ?>
    <p><?php esc_html_e('It seems we can&rsquo;t find what you&rsquo;re looking for.', 'melissa'); ?></p>
  <?php } ?>
</div>
<!-- end no results container -->
