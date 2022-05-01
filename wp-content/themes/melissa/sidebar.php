<?php
/**
 * The sidebar template file
 *
 * @package WordPress
 * @subpackage Melissa
 * @since Melissa 1.0
 */

// Homepage
if (is_home()) {

  // Index page (Homepage) - melissa_home_widgets
  if (is_active_sidebar('melissa_home_widgets')) {
    ?>

    <!-- sidebar -->
    <div class="bwp-sidebar-wrap bwp-transition-3" role="complementary">
      <?php dynamic_sidebar('melissa_home_widgets'); ?>
    </div>
    <!-- end sidebar -->

    <?php
  }

// Archive pages
} else if (is_archive() || is_search()) {

  // Archive pages - melissa_archive_widgets
  if (is_active_sidebar('melissa_archive_widgets')) {
    ?>

    <!-- sidebar -->
    <div class="bwp-sidebar-wrap bwp-transition-3" role="complementary">
      <?php dynamic_sidebar('melissa_archive_widgets'); ?>
    </div>
    <!-- end sidebar -->

    <?php
  }

// Single post page
} else if (is_single() || is_attachment()) {

  // Single post page - melissa_single_widgets
  if (is_active_sidebar('melissa_single_widgets')) {
    ?>

    <!-- sidebar -->
    <div class="bwp-sidebar-wrap bwp-transition-3" role="complementary">
      <?php dynamic_sidebar('melissa_single_widgets'); ?>
    </div>
    <!-- end sidebar -->

    <?php
  }

// Pages
} else if (is_page()) {

  // Pages - melissa_page_widgets
  if (is_active_sidebar('melissa_page_widgets')) {
    ?>

    <!-- sidebar -->
    <div class="bwp-sidebar-wrap bwp-transition-3" role="complementary">
      <?php dynamic_sidebar('melissa_page_widgets'); ?>
    </div>
    <!-- end sidebar -->

    <?php
  }
}
