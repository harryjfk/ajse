<?php
/**
 * Thumbnails gallery widget
 *
 * @package WordPress
 * @subpackage Melissa
 * @since Melissa 1.0
 */

/**
 * Register widget
 */
add_action('widgets_init', 'melissa_register_thumbnails_widget');

function melissa_register_thumbnails_widget() {
  register_widget('melissa_thumbnails_widget');
}

/**
 * Class melissa_thumbnails_widget
 */
class melissa_thumbnails_widget extends WP_Widget {

  // 1 - widget code
  function __construct() {
    $widget_ops = array(
      'classname' => 'widget_bwp_thumbnails',
      'description' => __('Widget shows a gallery of post thumbnails.', 'melissa')
    );
    parent::__construct('melissa_thumbnails_widget', __('Melissa: Thumbnails Gallery', 'melissa'), $widget_ops);
  }

  // 2 - create a widget settings form
  function form($instance) {
    $defaults = array(
      'title' => 'Thumbnails gallery',
      'num_posts' => 20,
      'categories' => '',
      'show_random' => 'on'
    );
    $instance = wp_parse_args((array) $instance, $defaults);
    ?>

    <!-- title -->
    <p>
      <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title:', 'melissa'); ?></label>
      <input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" value="<?php echo esc_attr($instance['title']); ?>" />
    </p>
    <!-- end title -->

    <!-- posts number -->
    <p>
      <label for="<?php echo esc_attr($this->get_field_id('num_posts')); ?>"><?php esc_html_e('Posts number:', 'melissa'); ?></label>
      <input type="number" min="1" max="200" class="widefat" id="<?php echo esc_attr($this->get_field_id('num_posts')); ?>" name="<?php echo esc_attr($this->get_field_name('num_posts')); ?>" value="<?php echo esc_attr($instance['num_posts']); ?>" />
    </p>
    <!-- end posts number -->

    <!-- categories -->
    <p>
      <label for="<?php echo esc_attr($this->get_field_id('categories')); ?>"><?php esc_html_e('Filter by Category:', 'melissa'); ?></label>
      <select id="<?php echo esc_attr($this->get_field_id('categories')); ?>" name="<?php echo esc_attr($this->get_field_name('categories')); ?>" class="widefat categories" style="width:100%;">
        <option value='' <?php if ('' === $instance['categories']) echo 'selected="selected"'; ?>><?php esc_html_e('All categories', 'melissa'); ?></option>
        <?php $categories = get_categories( 'hide_empty=0&depth=1&type=post' ); ?>
        <?php foreach ($categories as $category) { ?>
          <option value='<?php echo esc_attr($category->term_id); ?>' <?php if ($category->term_id == $instance['categories']) echo 'selected="selected"'; ?>><?php echo esc_html($category->cat_name); ?></option>
        <?php } ?>
      </select>
    </p>
    <!-- end categories -->

    <!-- show random -->
    <p>
      <input class="checkbox" type="checkbox" <?php checked($instance['show_random'], 'on'); ?> id="<?php echo esc_attr($this->get_field_id('show_random')); ?>" name="<?php echo esc_attr($this->get_field_name('show_random')); ?>" />
      <label for="<?php echo esc_attr($this->get_field_id('show_random')); ?>"><?php esc_html_e('Random order', 'melissa'); ?></label>
    </p>
    <!-- end show random -->

    <?php
  }

  // 3 - save widget settings
  function update($new_instance, $old_instance) {
    $instance = $old_instance;

    $instance['title'] = htmlspecialchars($new_instance['title'], ENT_QUOTES);
    $instance['num_posts'] = $new_instance['num_posts'];
    $instance['categories'] = $new_instance['categories'];
    $instance['show_random'] = $new_instance['show_random'];

    return $instance;
  }

  // 4 - show widget
  function widget($args, $instance) {
    extract($args);

    $title = $instance['title'];
    $num_posts = $instance['num_posts'];
    $categories = $instance['categories'];
    $show_random = isset($instance['show_random']) ? 1 : 0;

    // order by
    if ($show_random) {
      $orderby = 'rand';
    } else {
      $orderby = 'date';
    }

    // display "aside" tag
    echo wp_kses($before_widget, array('aside' => array('id' => array(), 'class' => array())));

    // display widget title
    if ($title) {
      echo wp_kses($before_title, array('h3' => array('class' => array())));
      echo esc_html($title);
      echo wp_kses($after_title, array('h3' => array()));
    }

    // query args
    $gallery_args = array(
      'posts_per_page' => intval($num_posts),
      'post_type' => 'post',
      'cat' => $categories,
      'orderby' => $orderby,
      'ignore_sticky_posts' => true
    );
    $gallery_query = new WP_Query($gallery_args);

    // start widget
    if ($gallery_query->have_posts()) :

      echo '<ul class="list-unstyled clearfix">';
        while ($gallery_query->have_posts()) : $gallery_query->the_post();

          // media
          if (has_post_thumbnail()) {
            // featured image
            ?>
            <li>
              <figure>
                <a href="<?php the_permalink(); ?>" class="bwp-widget-tooltip" data-toggle="tooltip" data-placement="top" title="<?php the_title_attribute(); ?>">
                  <?php the_post_thumbnail('thumbnail'); ?>
                  <div class="widget-bwp-bg-overlay bwp-transition-4"></div>
                </a>
              </figure>
            </li>
            <?php
            // gallery image
          } else {
            // get gallery images ID
            $gallery_images_id = get_post_meta(get_the_ID(), 'melissa_mb_gallery', false);
            if (!is_array($gallery_images_id)) {
              $gallery_images_id = (array)$gallery_images_id;
            }
            if (!empty($gallery_images_id) && $gallery_images_id[0]) {
              $gallery_image_url = wp_get_attachment_image_src($gallery_images_id[0], 'thumbnail');
              $image_alt = get_post_meta($gallery_images_id[0], '_wp_attachment_image_alt', true);
              ?>
              <li>
                <figure>
                  <a href="<?php the_permalink(); ?>" class="bwp-widget-tooltip" data-toggle="tooltip" data-placement="top" title="<?php the_title_attribute(); ?>">
                    <img src="<?php echo esc_url($gallery_image_url[0]); ?>" alt="<?php if ($image_alt) { echo esc_attr($image_alt); } else { the_title_attribute(); } ?>">
                    <div class="widget-bwp-bg-overlay bwp-transition-4"></div>
                  </a>
                </figure>
              </li>
              <?php
            }
          }

        endwhile;
      echo '</ul>';

    endif;
    // end widget

    // no posts
    if (!$gallery_query->have_posts()) :
      ?>
      <p class="widget_bwp_no_posts"><?php esc_html_e('No posts found.', 'melissa') ?></p>
      <?php
    endif;

    // reset post data
    wp_reset_postdata();

    // display "aside" and "div" tags
    echo wp_kses($after_widget, array('div' => array('class' => array()), 'aside' => array()));
  }

}
