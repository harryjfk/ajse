<?php
/**
 * Popular posts widget
 *
 * @package WordPress
 * @subpackage Melissa
 * @since Melissa 1.0
 */

/**
 * Register widget
 */
add_action('widgets_init', 'melissa_register_popular_widget');

function melissa_register_popular_widget() {
  register_widget('melissa_popular_widget');
}

/**
 * Class melissa_popular_widget
 */
class melissa_popular_widget extends WP_Widget {

  // 1 - widget code
  function __construct() {
    $widget_ops = array(
      'classname' => 'widget_bwp_popular_posts',
      'description' => __('Widget shows a list of popular posts.', 'melissa')
    );
    parent::__construct('melissa_popular_widget', __('Melissa: Popular Posts', 'melissa'), $widget_ops);
  }

  // 2 - create a widget settings form
  function form($instance) {
    $defaults = array(
      'title' => 'Popular posts',
      'num_posts' => 4,
      'show_author' => 'on',
      'show_date' => 'on',
      'show_categories' => 'on',
      'show_comments'	=> 'on',
      'show_views' => 'on',
      'show_likes' => 'on',
      'categories' => '',
      'widget_orderby' => 'views'
    );
    $instance = wp_parse_args((array) $instance, $defaults);
    ?>

    <!-- title -->
    <p>
      <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Título:', 'melissa'); ?></label>
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
      <label for="<?php echo esc_attr($this->get_field_id('show_author')); ?>"><?php esc_html_e('Ver autor', 'melissa'); ?></label>
    </p>
    <!-- end show author -->

    <!-- show date -->
    <p>
      <input class="checkbox" type="checkbox" <?php checked($instance['show_date'], 'on'); ?> id="<?php echo esc_attr($this->get_field_id('show_date')); ?>" name="<?php echo esc_attr($this->get_field_name('show_date')); ?>" />
      <label for="<?php echo esc_attr($this->get_field_id('show_date')); ?>"><?php esc_html_e('Ver fecha', 'melissa'); ?></label>
    </p>
    <!-- end show date -->

    <!-- show categories -->
    <p>
      <input class="checkbox" type="checkbox" <?php checked($instance['show_categories'], 'on'); ?> id="<?php echo esc_attr($this->get_field_id('show_categories')); ?>" name="<?php echo esc_attr($this->get_field_name('show_categories')); ?>" />
      <label for="<?php echo esc_attr($this->get_field_id('show_categories')); ?>"><?php esc_html_e('Ver categorías', 'melissa'); ?></label>
    </p>
    <!-- end show categories -->

    <!-- show comments -->
    <p>
      <input class="checkbox" type="checkbox" <?php checked($instance['show_comments'], 'on'); ?> id="<?php echo esc_attr($this->get_field_id('show_comments')); ?>" name="<?php echo esc_attr($this->get_field_name('show_comments')); ?>" />
      <label for="<?php echo esc_attr($this->get_field_id('show_comments')); ?>"><?php esc_html_e('Ver comentarios', 'melissa'); ?></label>
    </p>
    <!-- end show comments -->

    <!-- show views -->
    <p>
      <input class="checkbox" type="checkbox" <?php checked($instance['show_views'], 'on'); ?> id="<?php echo esc_attr($this->get_field_id('show_views')); ?>" name="<?php echo esc_attr($this->get_field_name('show_views')); ?>" />
      <label for="<?php echo esc_attr($this->get_field_id('show_views')); ?>"><?php esc_html_e('Ver vistas', 'melissa'); ?></label>
    </p>
    <!-- end show views -->

    <!-- show likes -->
    <p>
      <input class="checkbox" type="checkbox" <?php checked($instance['show_likes'], 'on'); ?> id="<?php echo esc_attr($this->get_field_id('show_likes')); ?>" name="<?php echo esc_attr($this->get_field_name('show_likes')); ?>" />
      <label for="<?php echo esc_attr($this->get_field_id('show_likes')); ?>"><?php esc_html_e('Ver me gusta', 'melissa'); ?></label>
    </p>
    <!-- end show likes -->

    <!-- categories -->
    <p>
      <label for="<?php echo esc_attr($this->get_field_id('categories')); ?>"><?php esc_html_e('Filtrar por Categoría:', 'melissa'); ?></label>
      <select id="<?php echo esc_attr($this->get_field_id('categories')); ?>" name="<?php echo esc_attr($this->get_field_name('categories')); ?>" class="widefat categories" style="width:100%;">
        <option value='' <?php if ('' === $instance['categories']) echo 'selected="selected"'; ?>><?php esc_html_e('Todas las categorías', 'melissa'); ?></option>
        <?php $categories = get_categories( 'hide_empty=0&depth=1&type=post' ); ?>
        <?php foreach ($categories as $category) { ?>
          <option value='<?php echo esc_attr($category->term_id); ?>' <?php if ($category->term_id == $instance['categories']) echo 'selected="selected"'; ?>><?php echo esc_html($category->cat_name); ?></option>
        <?php } ?>
      </select>
    </p>
    <!-- end categories -->

    <!-- orderby -->
    <p>
      <label for="<?php echo esc_attr($this->get_field_id('widget_orderby')); ?>"><?php esc_html_e('Ordenar por:', 'melissa'); ?></label>
      <select id="<?php echo esc_attr($this->get_field_id('widget_orderby')); ?>" name="<?php echo esc_attr($this->get_field_name('widget_orderby')); ?>" class="widefat" style="width:100%;">
        <option value='views' <?php if ('views' == $instance['widget_orderby']) echo 'selected="selected"'; ?>><?php esc_html_e('Views', 'melissa'); ?></option>
        <option value='likes' <?php if ('likes' == $instance['widget_orderby']) echo 'selected="selected"'; ?>><?php esc_html_e('Likes', 'melissa'); ?></option>
        <option value='comments' <?php if ('comments' == $instance['widget_orderby']) echo 'selected="selected"'; ?>><?php esc_html_e('Comments', 'melissa'); ?></option>
      </select>
    </p>
    <!-- end orderby -->

    <?php
  }

  // 3 - save widget settings
  function update($new_instance, $old_instance) {
    $instance = $old_instance;

    $instance['title'] = htmlspecialchars($new_instance['title'], ENT_QUOTES);
    $instance['num_posts'] = $new_instance['num_posts'];
    $instance['show_author'] = $new_instance['show_author'];
    $instance['show_date'] = $new_instance['show_date'];
    $instance['show_categories'] = $new_instance['show_categories'];
    $instance['show_comments'] = $new_instance['show_comments'];
    $instance['show_views'] = $new_instance['show_views'];
    $instance['show_likes'] = $new_instance['show_likes'];
    $instance['categories'] = $new_instance['categories'];
    $instance['widget_orderby'] = $new_instance['widget_orderby'];

    return $instance;
  }

  // 4 - show widget
  function widget($args, $instance) {
    extract($args);

    $title = $instance['title'];
    $num_posts = $instance['num_posts'];
    $show_author = isset($instance['show_author']) ? 1 : 0;
    $show_date = isset($instance['show_date']) ? 1 : 0;
    $show_categories = isset($instance['show_categories']) ? 1 : 0;
    $show_comments = isset($instance['show_comments']) ? 1 : 0;
    $show_views = isset($instance['show_views']) ? 1 : 0;
    $show_likes = isset($instance['show_likes']) ? 1 : 0;
    $categories = $instance['categories'];
    $widget_orderby = $instance['widget_orderby'];

    // display "aside" tag
    echo wp_kses($before_widget, array('aside' => array('id' => array(), 'class' => array())));

    // display widget title
    if ($title) {
      echo wp_kses($before_title, array('h3' => array('class' => array())));
      echo esc_html($title);
      echo wp_kses($after_title, array('h3' => array()));
    }

    // query args
    if ($widget_orderby == 'views') {
      // views
      $popular_args = array(
        'posts_per_page' => intval($num_posts),
        'post_type' => 'post',
        'cat' => $categories,
        'meta_key' => '_melissa_post_views_count',
        'orderby' => 'meta_value_num',
        'ignore_sticky_posts' => true
      );
    } else if ($widget_orderby == 'likes') {
      // likes
      $popular_args = array(
        'posts_per_page' => intval($num_posts),
        'post_type' => 'post',
        'cat' => $categories,
        'meta_key' => '_melissa_post_like_count',
        'orderby' => 'meta_value_num',
        'ignore_sticky_posts' => true
      );
    } else {
      // comments
      $popular_args = array(
        'posts_per_page' => intval($num_posts),
        'post_type' => 'post',
        'cat' => $categories,
        'orderby' => 'comment_count',
        'ignore_sticky_posts' => true
      );
    }
    $popular_query = new WP_Query($popular_args);

    // start widget
    if ($popular_query->have_posts()) :

      echo '<ul class="list-unstyled">';
        while ($popular_query->have_posts()) : $popular_query->the_post();
          $post_id = get_the_ID();
          echo '<li>';
            $widget_content_style = 'height: auto;';

            // media
            if (has_post_thumbnail()) {
              // featured image
              $widget_content_style = '';
              ?>
              <figure class="widget_bwp_thumb">
                <a href="<?php the_permalink(); ?>">
                  <?php the_post_thumbnail('thumbnail'); ?>
                  <div class="widget-bwp-bg-overlay bwp-transition-4"></div>
                </a>
              </figure>
              <?php
              // gallery image
            } else {
              // get gallery images ID
              $gallery_images_id = get_post_meta($post_id, 'melissa_mb_gallery', false);
              if (!is_array($gallery_images_id)) {
                $gallery_images_id = (array)$gallery_images_id;
              }
              if (!empty($gallery_images_id) && $gallery_images_id[0]) {
                $widget_content_style = '';
                $gallery_image_url = wp_get_attachment_image_src($gallery_images_id[0], 'thumbnail');
                $image_alt = get_post_meta($gallery_images_id[0], '_wp_attachment_image_alt', true);
                ?>
                <figure class="widget_bwp_thumb">
                  <a href="<?php the_permalink(); ?>">
                    <img src="<?php echo esc_url($gallery_image_url[0]); ?>" alt="<?php if ($image_alt) { echo esc_attr($image_alt); } else { the_title_attribute(); } ?>">
                    <div class="widget-bwp-bg-overlay bwp-transition-4"></div>
                  </a>
                </figure>
                <?php
              }
            }

            // content
            ?>
            <div class="widget_bwp_content" style="<?php echo esc_attr($widget_content_style); ?>">
              <?php if (get_the_title()) { ?>
                <h4 class="entry-title">
                  <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                </h4>
              <?php } else { ?>
                <h4>
                  <a href="<?php the_permalink(); ?>"><?php esc_html_e('View post', 'melissa'); ?></a>
                </h4>
              <?php } ?>
              <?php if ($show_author || $show_date || $show_categories || $show_comments || $show_views || $show_likes) { ?>
                <ul class="widget_bwp_meta list-unstyled clearfix">
                  <?php if ($show_author) { ?>
                    <li>
                      <span class="vcard author"><span class="fn"><?php esc_html_e('Por ', 'melissa'); the_author_posts_link(); ?></span></span>
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
                  <?php if ($show_categories) { ?>
                    <li>
                      <?php esc_html_e('en ', 'melissa'); the_category(', '); ?>
                      <span class="widget_bwp_slash">/</span>
                    </li>
                  <?php } ?>
                  <?php if ($show_comments) { ?>
                    <?php if (comments_open()) { ?>
                      <li>
                        <?php comments_popup_link(__('Comentar', 'melissa'), __('1 Comentario', 'melissa'), __('% Comentarios', 'melissa')); ?>
                        <span class="widget_bwp_slash">/</span>
                      </li>
                    <?php } else if (get_comments_number()) { ?>
                      <li>
                        <?php comments_popup_link('', __('1 Comentario', 'melissa'), __('% Comentarios', 'melissa')); ?>
                        <span class="widget_bwp_slash">/</span>
                      </li>
                    <?php } ?>
                  <?php } ?>
                  <?php if ($show_views) { ?>
                    <li>
                      <?php esc_html_e('Visto: ', 'melissa'); echo (int)melissa_getPostViews($post_id); ?>
                      <span class="widget_bwp_slash">/</span>
                    </li>
                  <?php } ?>
                  <?php if ($show_likes) { ?>
                    <li>
                      <?php esc_html_e('Me gusta: ', 'melissa'); echo (int)melissa_getPostLikeCount($post_id); ?>
                      <span class="widget_bwp_slash">/</span>
                    </li>
                  <?php } ?>
                </ul>
              <?php } ?>
            </div>
            <?php

          echo '</li>';
        endwhile;
      echo '</ul>';

    endif;
    // end widget

    // no posts
    if (!$popular_query->have_posts()) :
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
