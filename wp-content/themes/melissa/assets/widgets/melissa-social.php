<?php
/**
 * Social widget
 *
 * @package WordPress
 * @subpackage Melissa
 * @since Melissa 1.0
 */

/**
 * Register widget
 */
add_action('widgets_init', 'melissa_register_social_widget');

function melissa_register_social_widget() {
  register_widget('melissa_social_widget');
}

/**
 * Class melissa_social_widget
 */
class melissa_social_widget extends WP_Widget {

  // 1 - widget code
  function __construct() {
    $widget_ops = array(
      'classname' => 'widget_bwp_social',
      'description' => __('Widget shows links to social profiles.', 'melissa')
    );
    parent::__construct('melissa_social_widget', __('Melissa: Social Links', 'melissa'), $widget_ops);
  }

  // 2 - create a widget settings form
  function form($instance) {
    $defaults = array(
      'title' => 'Social links',
      'twitter_url' => '',
      'facebook_url' => '',
      'google_plus_url' => '',
      'pinterest_url' => '',
      'vk_url' => '',
      'flickr_url' => '',
      'instagram_url' => '',
      'five_hundred_px_url' => '',
      'youtube_url' => '',
      'vimeo_url' => '',
      'soundcloud_url' => '',
      'dribbble_url' => '',
      'behance_url' => '',
      'github_url' => '',
      'rss_url' => ''
    );
    $instance = wp_parse_args((array) $instance, $defaults);
    ?>

    <!-- title -->
    <p>
      <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title:', 'melissa'); ?></label>
      <input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" value="<?php echo esc_attr($instance['title']); ?>" />
    </p>
    <!-- end title -->

    <!-- twitter -->
    <p>
      <label for="<?php echo esc_attr($this->get_field_id('twitter_url')); ?>"><?php esc_html_e('Twitter URL:', 'melissa'); ?></label>
      <input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('twitter_url')); ?>" name="<?php echo esc_attr($this->get_field_name('twitter_url')); ?>" value="<?php echo esc_attr($instance['twitter_url']); ?>" />
    </p>
    <!-- end twitter -->

    <!-- facebook -->
    <p>
      <label for="<?php echo esc_attr($this->get_field_id('facebook_url')); ?>"><?php esc_html_e('Facebook URL:', 'melissa'); ?></label>
      <input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('facebook_url')); ?>" name="<?php echo esc_attr($this->get_field_name('facebook_url')); ?>" value="<?php echo esc_attr($instance['facebook_url']); ?>" />
    </p>
    <!-- end facebook -->

    <!-- google+ -->
    <p>
      <label for="<?php echo esc_attr($this->get_field_id('google_plus_url')); ?>"><?php esc_html_e('Google+ URL:', 'melissa'); ?></label>
      <input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('google_plus_url')); ?>" name="<?php echo esc_attr($this->get_field_name('google_plus_url')); ?>" value="<?php echo esc_attr($instance['google_plus_url']); ?>" />
    </p>
    <!-- end google+ -->

    <!-- pinterest -->
    <p>
      <label for="<?php echo esc_attr($this->get_field_id('pinterest_url')); ?>"><?php esc_html_e('Pinterest URL:', 'melissa'); ?></label>
      <input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('pinterest_url')); ?>" name="<?php echo esc_attr($this->get_field_name('pinterest_url')); ?>" value="<?php echo esc_attr($instance['pinterest_url']); ?>" />
    </p>
    <!-- end pinterest -->

    <!-- vk -->
    <p>
      <label for="<?php echo esc_attr($this->get_field_id('vk_url')); ?>"><?php esc_html_e('VK URL:', 'melissa'); ?></label>
      <input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('vk_url')); ?>" name="<?php echo esc_attr($this->get_field_name('vk_url')); ?>" value="<?php echo esc_attr($instance['vk_url']); ?>" />
    </p>
    <!-- end vk -->

    <!-- flickr -->
    <p>
      <label for="<?php echo esc_attr($this->get_field_id('flickr_url')); ?>"><?php esc_html_e('Flickr URL:', 'melissa'); ?></label>
      <input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('flickr_url')); ?>" name="<?php echo esc_attr($this->get_field_name('flickr_url')); ?>" value="<?php echo esc_attr($instance['flickr_url']); ?>" />
    </p>
    <!-- end flickr -->

    <!-- instagram -->
    <p>
      <label for="<?php echo esc_attr($this->get_field_id('instagram_url')); ?>"><?php esc_html_e('Instagram URL:', 'melissa'); ?></label>
      <input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('instagram_url')); ?>" name="<?php echo esc_attr($this->get_field_name('instagram_url')); ?>" value="<?php echo esc_attr($instance['instagram_url']); ?>" />
    </p>
    <!-- end instagram -->

    <!-- 500px -->
    <p>
      <label for="<?php echo esc_attr($this->get_field_id('five_hundred_px_url')); ?>"><?php esc_html_e('500px URL:', 'melissa'); ?></label>
      <input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('five_hundred_px_url')); ?>" name="<?php echo esc_attr($this->get_field_name('five_hundred_px_url')); ?>" value="<?php echo esc_attr($instance['five_hundred_px_url']); ?>" />
    </p>
    <!-- end 500px -->

    <!-- YouTube -->
    <p>
      <label for="<?php echo esc_attr($this->get_field_id('youtube_url')); ?>"><?php esc_html_e('YouTube URL:', 'melissa'); ?></label>
      <input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('youtube_url')); ?>" name="<?php echo esc_attr($this->get_field_name('youtube_url')); ?>" value="<?php echo esc_attr($instance['youtube_url']); ?>" />
    </p>
    <!-- end YouTube -->

    <!-- vimeo -->
    <p>
      <label for="<?php echo esc_attr($this->get_field_id('vimeo_url')); ?>"><?php esc_html_e('Vimeo URL:', 'melissa'); ?></label>
      <input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('vimeo_url')); ?>" name="<?php echo esc_attr($this->get_field_name('vimeo_url')); ?>" value="<?php echo esc_attr($instance['vimeo_url']); ?>" />
    </p>
    <!-- end vimeo -->

    <!-- soundcloud -->
    <p>
      <label for="<?php echo esc_attr($this->get_field_id('soundcloud_url')); ?>"><?php esc_html_e('Soundcloud URL:', 'melissa'); ?></label>
      <input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('soundcloud_url')); ?>" name="<?php echo esc_attr($this->get_field_name('soundcloud_url')); ?>" value="<?php echo esc_attr($instance['soundcloud_url']); ?>" />
    </p>
    <!-- end soundcloud -->

    <!-- dribbble -->
    <p>
      <label for="<?php echo esc_attr($this->get_field_id('dribbble_url')); ?>"><?php esc_html_e('Dribbble URL:', 'melissa'); ?></label>
      <input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('dribbble_url')); ?>" name="<?php echo esc_attr($this->get_field_name('dribbble_url')); ?>" value="<?php echo esc_attr($instance['dribbble_url']); ?>" />
    </p>
    <!-- end dribbble -->

    <!-- behance -->
    <p>
      <label for="<?php echo esc_attr($this->get_field_id('behance_url')); ?>"><?php esc_html_e('Behance URL:', 'melissa'); ?></label>
      <input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('behance_url')); ?>" name="<?php echo esc_attr($this->get_field_name('behance_url')); ?>" value="<?php echo esc_attr($instance['behance_url']); ?>" />
    </p>
    <!-- end behance -->

    <!-- github -->
    <p>
      <label for="<?php echo esc_attr($this->get_field_id('github_url')); ?>"><?php esc_html_e('Github URL:', 'melissa'); ?></label>
      <input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('github_url')); ?>" name="<?php echo esc_attr($this->get_field_name('github_url')); ?>" value="<?php echo esc_attr($instance['github_url']); ?>" />
    </p>
    <!-- end github -->

    <!-- rss -->
    <p>
      <label for="<?php echo esc_attr($this->get_field_id('rss_url')); ?>"><?php esc_html_e('RSS URL:', 'melissa'); ?></label>
      <input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('rss_url')); ?>" name="<?php echo esc_attr($this->get_field_name('rss_url')); ?>" value="<?php echo esc_attr($instance['rss_url']); ?>" />
    </p>
    <!-- end rss -->

    <?php
  }

  // 3 - save widget settings
  function update($new_instance, $old_instance) {
    $instance = $old_instance;

    $instance['title'] = htmlspecialchars($new_instance['title'], ENT_QUOTES);
    $instance['twitter_url'] = htmlspecialchars($new_instance['twitter_url'], ENT_QUOTES);
    $instance['facebook_url'] = htmlspecialchars($new_instance['facebook_url'], ENT_QUOTES);
    $instance['google_plus_url'] = htmlspecialchars($new_instance['google_plus_url'], ENT_QUOTES);
    $instance['pinterest_url'] = htmlspecialchars($new_instance['pinterest_url'], ENT_QUOTES);
    $instance['vk_url'] = htmlspecialchars($new_instance['vk_url'], ENT_QUOTES);
    $instance['flickr_url'] = htmlspecialchars($new_instance['flickr_url'], ENT_QUOTES);
    $instance['instagram_url'] = htmlspecialchars($new_instance['instagram_url'], ENT_QUOTES);
    $instance['five_hundred_px_url'] = htmlspecialchars($new_instance['five_hundred_px_url'], ENT_QUOTES);
    $instance['youtube_url'] = htmlspecialchars($new_instance['youtube_url'], ENT_QUOTES);
    $instance['vimeo_url'] = htmlspecialchars($new_instance['vimeo_url'], ENT_QUOTES);
    $instance['soundcloud_url'] = htmlspecialchars($new_instance['soundcloud_url'], ENT_QUOTES);
    $instance['dribbble_url'] = htmlspecialchars($new_instance['dribbble_url'], ENT_QUOTES);
    $instance['behance_url'] = htmlspecialchars($new_instance['behance_url'], ENT_QUOTES);
    $instance['github_url'] = htmlspecialchars($new_instance['github_url'], ENT_QUOTES);
    $instance['rss_url'] = htmlspecialchars($new_instance['rss_url'], ENT_QUOTES);

    return $instance;
  }

  // 4 - show widget
  function widget($args, $instance) {
    extract($args);

    $title = $instance['title'];
    $twitter_url = $instance['twitter_url'];
    $facebook_url = $instance['facebook_url'];
    $google_plus_url = $instance['google_plus_url'];
    $pinterest_url = $instance['pinterest_url'];
    $vk_url = $instance['vk_url'];
    $flickr_url = $instance['flickr_url'];
    $instagram_url = $instance['instagram_url'];
    $five_hundred_px_url = $instance['five_hundred_px_url'];
    $youtube_url = $instance['youtube_url'];
    $vimeo_url = $instance['vimeo_url'];
    $soundcloud_url = $instance['soundcloud_url'];
    $dribbble_url = $instance['dribbble_url'];
    $behance_url = $instance['behance_url'];
    $github_url = $instance['github_url'];
    $rss_url = $instance['rss_url'];

    // display "aside" tag
    echo wp_kses($before_widget, array('aside' => array('id' => array(), 'class' => array())));

    // display widget title
    if ($title) {
      echo wp_kses($before_title, array('h3' => array('class' => array())));
      echo esc_html($title);
      echo wp_kses($after_title, array('h3' => array()));
    }
    ?>

    <ul class="list-unstyled clearfix">
      <?php if ($twitter_url) { ?>
        <li>
          <a href="<?php echo esc_url($twitter_url); ?>" target="_blank" class="w_bwp_social_i w_bwp_social_twitter">
            <i class="fa fa-twitter"></i>
          </a>
        </li>
      <?php } ?>
      <?php if ($facebook_url) { ?>
        <li>
          <a href="<?php echo esc_url($facebook_url); ?>" target="_blank" class="w_bwp_social_i w_bwp_social_facebook">
            <i class="fa fa-facebook"></i>
          </a>
        </li>
      <?php } ?>
      <?php if ($google_plus_url) { ?>
        <li>
          <a href="<?php echo esc_url($google_plus_url); ?>" target="_blank" class="w_bwp_social_i w_bwp_social_google_plus">
            <i class="fa fa-google-plus"></i>
          </a>
        </li>
      <?php } ?>
      <?php if ($pinterest_url) { ?>
        <li>
          <a href="<?php echo esc_url($pinterest_url); ?>" target="_blank" class="w_bwp_social_i w_bwp_social_pinterest">
            <i class="fa fa-pinterest-p"></i>
          </a>
        </li>
      <?php } ?>
      <?php if ($vk_url) { ?>
        <li>
          <a href="<?php echo esc_url($vk_url); ?>" target="_blank" class="w_bwp_social_i w_bwp_social_vk">
            <i class="fa fa-vk"></i>
          </a>
        </li>
      <?php } ?>
      <?php if ($flickr_url) { ?>
        <li>
          <a href="<?php echo esc_url($flickr_url); ?>" target="_blank" class="w_bwp_social_i w_bwp_social_flickr">
            <i class="fa fa-flickr"></i>
          </a>
        </li>
      <?php } ?>
      <?php if ($instagram_url) { ?>
        <li>
          <a href="<?php echo esc_url($instagram_url); ?>" target="_blank" class="w_bwp_social_i w_bwp_social_instagram">
            <i class="fa fa-instagram"></i>
          </a>
        </li>
      <?php } ?>
      <?php if ($five_hundred_px_url) { ?>
        <li>
          <a href="<?php echo esc_url($five_hundred_px_url); ?>" target="_blank" class="w_bwp_social_i w_bwp_social_500px">
            <i class="fa fa-500px"></i>
          </a>
        </li>
      <?php } ?>
      <?php if ($youtube_url) { ?>
        <li>
          <a href="<?php echo esc_url($youtube_url); ?>" target="_blank" class="w_bwp_social_i w_bwp_social_youtube">
            <i class="fa fa-youtube"></i>
          </a>
        </li>
      <?php } ?>
      <?php if ($vimeo_url) { ?>
        <li>
          <a href="<?php echo esc_url($vimeo_url); ?>" target="_blank" class="w_bwp_social_i w_bwp_social_vimeo">
            <i class="fa fa-vimeo"></i>
          </a>
        </li>
      <?php } ?>
      <?php if ($soundcloud_url) { ?>
        <li>
          <a href="<?php echo esc_url($soundcloud_url); ?>" target="_blank" class="w_bwp_social_i w_bwp_social_soundcloud">
            <i class="fa fa-soundcloud"></i>
          </a>
        </li>
      <?php } ?>
      <?php if ($dribbble_url) { ?>
        <li>
          <a href="<?php echo esc_url($dribbble_url); ?>" target="_blank" class="w_bwp_social_i w_bwp_social_dribbble">
            <i class="fa fa-dribbble"></i>
          </a>
        </li>
      <?php } ?>
      <?php if ($behance_url) { ?>
        <li>
          <a href="<?php echo esc_url($behance_url); ?>" target="_blank" class="w_bwp_social_i w_bwp_social_behance">
            <i class="fa fa-behance"></i>
          </a>
        </li>
      <?php } ?>
      <?php if ($github_url) { ?>
        <li>
          <a href="<?php echo esc_url($github_url); ?>" target="_blank" class="w_bwp_social_i w_bwp_social_github">
            <i class="fa fa-github"></i>
          </a>
        </li>
      <?php } ?>
      <?php if ($rss_url) { ?>
        <li>
          <a href="<?php echo esc_url($rss_url); ?>" target="_blank" class="w_bwp_social_i w_bwp_social_rss">
            <i class="fa fa-rss"></i>
          </a>
        </li>
      <?php } ?>
    </ul>

    <?php
    // display "aside" and "div" tags
    echo wp_kses($after_widget, array('div' => array('class' => array()), 'aside' => array()));
  }

}
