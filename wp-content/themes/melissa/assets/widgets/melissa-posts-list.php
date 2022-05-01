<?php
/**
 * Posts list widget
 *
 * @package WordPress
 * @subpackage Melissa
 * @since Melissa 1.0
 */

/**
 * Register widget
 */
add_action('widgets_init', 'melissa_register_posts_list_widget');

function melissa_register_posts_list_widget() {
  register_widget('melissa_posts_list_widget');
}

/**
 * Class melissa_posts_list_widget
 */
class melissa_posts_list_widget extends WP_Widget {

  // 1 - widget code
  function __construct() {
    $widget_ops = array(
      'classname' => 'widget_bwp_posts_list',
      'description' => __('Widget shows posts list with large thumbnails.', 'melissa')
    );
    parent::__construct('melissa_posts_list_widget', __('Melissa: Posts List', 'melissa'), $widget_ops);
  }

  // 2 - create a widget settings form
  function form($instance) {
    $defaults = array(
      'title' => 'Posts list',
      'num_posts' => 3,
      'show_author' => 'on',
      'show_date' => 'on',
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

    <!-- show author -->
    <p>
      <input class="checkbox" type="checkbox" <?php checked($instance['show_author'], 'on'); ?> id="<?php echo esc_attr($this->get_field_id('show_author')); ?>" name="<?php echo esc_attr($this->get_field_name('show_author')); ?>" />
      <label for="<?php echo esc_attr($this->get_field_id('show_author')); ?>"><?php esc_html_e('Show author', 'melissa'); ?></label>
    </p>
    <!-- end show author -->

    <!-- show date -->
    <p>
      <input class="checkbox" type="checkbox" <?php checked($instance['show_date'], 'on'); ?> id="<?php echo esc_attr($this->get_field_id('show_date')); ?>" name="<?php echo esc_attr($this->get_field_name('show_date')); ?>" />
      <label for="<?php echo esc_attr($this->get_field_id('show_date')); ?>"><?php esc_html_e('Show date', 'melissa'); ?></label>
    </p>
    <!-- end show date -->

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
    $instance['show_author'] = $new_instance['show_author'];
    $instance['show_date'] = $new_instance['show_date'];
    $instance['categories'] = $new_instance['categories'];
    $instance['show_random'] = $new_instance['show_random'];

    return $instance;
  }

  // 4 - show widget
  function widget($args, $instance) {
    extract($args);

    $title = $instance['title'];
    $num_posts = $instance['num_posts'];
    $show_author = isset($instance['show_author']) ? 1 : 0;
    $show_date = isset($instance['show_date']) ? 1 : 0;
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
    $posts_list_args = array(
      'posts_per_page' => intval($num_posts),
      'post_type' => 'post',
      'cat' => $categories,
      'orderby' => $orderby,
      'ignore_sticky_posts' => true
    );
    $posts_list_query = new WP_Query($posts_list_args);

    // start widget
    if ($posts_list_query->have_posts()) :
      $image_size = 'melissa-img-706-471';

      echo '<ul class="list-unstyled">';
        while ($posts_list_query->have_posts()) : $posts_list_query->the_post();

          // featured image
          if (has_post_thumbnail()) {
            ?>

            <li>
              <figure class="widget_bwp_posts_list_item">
                <?php the_post_thumbnail($image_size); ?>
                <div class="widget-bwp-dark-bg-overlay bwp-transition-4"></div>
                <figcaption class="w_bwp_posts_list_item_wrap">
                  <div class="w_bwp_posts_list_item_alignment">
                    <div class="w_bwp_posts_list_item_center">
                      <?php if (get_the_title()) { ?>
                        <h4 class="entry-title">
                          <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </h4>
                      <?php } else { ?>
                        <h4>
                          <a href="<?php the_permalink(); ?>"><?php esc_html_e('View post', 'melissa'); ?></a>
                        </h4>
                      <?php } ?>
                      <?php if ($show_author || $show_date) { ?>
                        <ul class="widget_bwp_meta list-unstyled clearfix">
                          <?php if ($show_author) { ?>
                            <li>
                              <span class="vcard author"><span class="fn"><?php esc_html_e('by ', 'melissa'); the_author_posts_link(); ?></span></span>
                              <span class="widget_bwp_slash">/</span>
                            </li>
                          <?php } ?>
                          <?php if ($show_date) { ?>
                            <li>
                              <?php
                              $year = get_the_time('Y');
                              $month = get_the_time('m');
                              $day = get_the_time('d');
                              ?>
                              <a href="<?php echo esc_url(get_day_link($year, $month, $day)); ?>">
                                <span class="date updated"><?php the_time(get_option('date_format')); ?></span>
                              </a>
                              <span class="widget_bwp_slash">/</span>
                            </li>
                          <?php } ?>
                        </ul>
                      <?php } ?>
                    </div>
                  </div>
                </figcaption>
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
              $gallery_image_url = wp_get_attachment_image_src($gallery_images_id[0], $image_size);
              $image_alt = get_post_meta($gallery_images_id[0], '_wp_attachment_image_alt', true);
              ?>

              <li>
                <figure class="widget_bwp_posts_list_item">
                  <img src="<?php echo esc_url($gallery_image_url[0]); ?>" alt="<?php if ($image_alt) { echo esc_attr($image_alt); } else { the_title_attribute(); } ?>">
                  <div class="widget-bwp-dark-bg-overlay bwp-transition-4"></div>
                  <figcaption class="w_bwp_posts_list_item_wrap">
                    <div class="w_bwp_posts_list_item_alignment">
                      <div class="w_bwp_posts_list_item_center">
                        <?php if (get_the_title()) { ?>
                          <h4 class="entry-title">
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                          </h4>
                        <?php } else { ?>
                          <h4>
                            <a href="<?php the_permalink(); ?>"><?php esc_html_e('View post', 'melissa'); ?></a>
                          </h4>
                        <?php } ?>
                        <?php if ($show_author || $show_date) { ?>
                          <ul class="widget_bwp_meta list-unstyled clearfix">
                            <?php if ($show_author) { ?>
                              <li>
                                <span class="vcard author"><span class="fn"><?php esc_html_e('by ', 'melissa'); the_author_posts_link(); ?></span></span>
                                <span class="widget_bwp_slash">/</span>
                              </li>
                            <?php } ?>
                            <?php if ($show_date) { ?>
                              <li>
                                <?php
                                $year = get_the_time('Y');
                                $month = get_the_time('m');
                                $day = get_the_time('d');
                                ?>
                                <a href="<?php echo esc_url(get_day_link($year, $month, $day)); ?>">
                                  <span class="date updated"><?php the_time(get_option('date_format')); ?></span>
                                </a>
                                <span class="widget_bwp_slash">/</span>
                              </li>
                            <?php } ?>
                          </ul>
                        <?php } ?>
                      </div>
                    </div>
                  </figcaption>
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
    if (!$posts_list_query->have_posts()) :
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
