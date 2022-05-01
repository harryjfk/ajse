<?php
/**
 * The template for displaying search forms
 *
 * @package WordPress
 * @subpackage Melissa
 * @since Melissa 1.0
 */
?>

<!-- search form -->
<form id="searchform" role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>">
  <div class="input-group">
    <input type="text" name="s" id="s" class="bwp-search-field form-control" placeholder="<?php esc_attr_e('Enter your search query...', 'melissa'); ?>">
    <span class="input-group-btn">
      <button type="submit" class="btn bwp-search-submit">
        <i class="fa fa-search"></i>
      </button>
    </span>
  </div>
</form>
<!-- end search form -->
