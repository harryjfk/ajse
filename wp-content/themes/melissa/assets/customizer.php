<?php
/**
 * Theme options (customizer)
 *
 * @package WordPress
 * @subpackage Melissa
 * @since Melissa 1.0
 */

function melissa_customize_register($wp_customize) {

  /**
   * Custom control - Heading (title and description)
   * -------------------------------------------------------------
   */
  class melissa_customize_heading_control extends WP_Customize_Control {
    public $type = 'melissa_heading';
    public function render_content() {
      ?>
      <div style="margin: 8px 0 6px; padding: 15px 20px; background-color: #e0e0e0;">
        <span class="customize-control-title" style="margin-bottom: 0;">
          <?php echo esc_html($this->label); ?>
        </span>
        <?php if ($this->value()) { ?>
          <span style="display: block; margin: 4px 0 3px;">
            <?php echo esc_html($this->value()); ?>
          </span>
        <?php } ?>
      </div>
      <?php
    }
  }


  /**
   * Custom control - Number (input type = number; min=1, max=10000)
   * -------------------------------------------------------------
   */
  class melissa_customize_number_control extends WP_Customize_Control {
    public $type = 'melissa_number_field';
    public function render_content() {
      ?>
      <label>
        <span class="customize-control-title">
          <?php echo esc_html($this->label); ?>
        </span>
        <input type="number" min="1" max="10000" value="<?php echo esc_attr($this->value()); ?>" <?php $this->link(); ?> />
      </label>
      <?php
    }
  }


  /**
   * Custom control - RGB alpha value (input type = number; min=1, max=9)
   * -------------------------------------------------------------
   */
  class melissa_customize_rgb_alpha_control extends WP_Customize_Control {
    public $type = 'melissa_rgb_alpha_field';
    public function render_content() {
      ?>
      <label>
        <span class="customize-control-title">
          <?php echo esc_html($this->label); ?>
        </span>
        <input type="number" min="1" max="9" value="<?php echo esc_attr($this->value()); ?>" <?php $this->link(); ?> />
      </label>
      <?php
    }
  }


  /**
   * Custom control - Video volume (input type = number; min=0, max=100)
   * -------------------------------------------------------------
   */
  class melissa_customize_video_volume_control extends WP_Customize_Control {
    public $type = 'melissa_video_volume_field';
    public function render_content() {
      ?>
      <label>
        <span class="customize-control-title">
          <?php echo esc_html($this->label); ?>
        </span>
        <input type="number" min="0" max="100" value="<?php echo esc_attr($this->value()); ?>" <?php $this->link(); ?> />
      </label>
      <?php
    }
  }


  /**
   * Custom control - Short description (some text)
   * -------------------------------------------------------------
   */
  class melissa_customize_text_description_control extends WP_Customize_Control {
    public $type = 'melissa_text_description';
    public function render_content() {
      ?>
      <div style="margin: 0 0 4px; padding: 0 0 17px; border-bottom: 1px solid #dddddd; font-style: italic;">
        <?php
        echo wp_kses($this->value(),
          array(
            'b' => array(),
            'br' => array()
          )
        );
        ?>
      </div>
      <?php
    }
  }


  /**
   * Theme Options
   * -------------------------------------------------------------
   *
   * 1.0 Site Identity
   * -------------------------------------------------------------
   */

  // Retina logo
  $wp_customize->add_setting(
    'retina_logo_image_2x',
    array(
      'default' => '',
      'sanitize_callback' => 'melissa_sanitize_url',
    )
  );

  $wp_customize->add_control(
    new WP_Customize_Image_Control(
      $wp_customize,
      'retina_logo_image_2x',
      array(
        'label' => __('Retina Logo (optional)', 'melissa'),
        'section' => 'title_tagline',
        'settings' => 'retina_logo_image_2x'
      )
    )
  );


  /**
   * 2.0 General Settings
   * -------------------------------------------------------------
   */

  $wp_customize->add_section(
    'general_settings_section',
    array(
      'title' => __('General Settings', 'melissa'),
      'priority' => 21,
    )
  );

  /**
   * General Settings - Header
   * -------------------------------------------------------------
   */

  // General settings - Header (heading)
  $wp_customize->add_setting(
    'general_settings_header_heading',
    array(
      'default' => '',
      'sanitize_callback' => 'melissa_sanitize_text_esc_html',
    )
  );

  $wp_customize->add_control(
    new melissa_customize_heading_control(
      $wp_customize,
      'general_settings_header_heading',
      array(
        'label' => __('Header', 'melissa'),
        'section' => 'general_settings_section',
        'settings' => 'general_settings_header_heading'
      )
    )
  );

  // Header type
  $wp_customize->add_setting(
    'general_header_type',
    array(
      'default' => 'simple-header',
      'sanitize_callback' => 'melissa_sanitize_header_type',
    )
  );

  $wp_customize->add_control(
    'general_header_type',
    array(
      'type' => 'select',
      'label' => __('Header Type', 'melissa'),
      'section' => 'general_settings_section',
      'choices' => array(
        'simple-header' => __('Simple header (without animation)', 'melissa'),
        'rev-slider-header' => __('Header with animation', 'melissa'),
      ),
    )
  );

  // Header types - description
  $wp_customize->add_setting(
    'general_header_type_desc',
    array(
      'default' => __('<b>Simple header</b> - This header type does not support animation and video background. But it supports parallax effect and reduces page load time.<br><b>Header with animation</b> - This header type supports animation, parallax effect, and video background.', 'melissa'),
      'sanitize_callback' => 'melissa_sanitize_wp_kses_b_br',
    )
  );

  $wp_customize->add_control(
    new melissa_customize_text_description_control(
      $wp_customize,
      'general_header_type_desc',
      array(
        'label' => __('Header Types - Description', 'melissa'),
        'section' => 'general_settings_section',
        'settings' => 'general_header_type_desc'
      )
    )
  );

  // Header background type
  $wp_customize->add_setting(
    'general_header_bg_type',
    array(
      'default' => 'image',
      'sanitize_callback' => 'melissa_sanitize_header_bg_type',
    )
  );

  $wp_customize->add_control(
    'general_header_bg_type',
    array(
      'type' => 'select',
      'label' => __('Header Background Type (Header Type: Header with animation)', 'melissa'),
      'section' => 'general_settings_section',
      'choices' => array(
        'image' => __('Image', 'melissa'),
        'video' => __('Video', 'melissa'),
      ),
    )
  );

  // Header background type - description
  $wp_customize->add_setting(
    'general_header_bg_type_desc',
    array(
      'default' => __('You can set an image or a video in one of the following customizer sections: <b>Header Image</b> or <b>Header Video</b>.', 'melissa'),
      'sanitize_callback' => 'melissa_sanitize_wp_kses_b_br',
    )
  );

  $wp_customize->add_control(
    new melissa_customize_text_description_control(
      $wp_customize,
      'general_header_bg_type_desc',
      array(
        'label' => __('Header Background Type - Description', 'melissa'),
        'section' => 'general_settings_section',
        'settings' => 'general_header_bg_type_desc'
      )
    )
  );

  // Show search icon
  $wp_customize->add_setting(
    'general_show_search_icon',
    array(
      'default' => 1,
      'sanitize_callback' => 'melissa_sanitize_checkbox',
    )
  );

  $wp_customize->add_control(
    'general_show_search_icon',
    array(
      'type' => 'checkbox',
      'label' => __('Show search icon', 'melissa'),
      'section' => 'general_settings_section',
    )
  );

  /**
   * General Settings - Logo
   * -------------------------------------------------------------
   */

  // General settings - Logo (heading)
  $wp_customize->add_setting(
    'general_settings_logo_heading',
    array(
      'default' => '',
      'sanitize_callback' => 'melissa_sanitize_text_esc_html',
    )
  );

  $wp_customize->add_control(
    new melissa_customize_heading_control(
      $wp_customize,
      'general_settings_logo_heading',
      array(
        'label' => __('Logo', 'melissa'),
        'section' => 'general_settings_section',
        'settings' => 'general_settings_logo_heading'
      )
    )
  );

  // Logo type
  $wp_customize->add_setting(
    'logo_type',
    array(
      'default' => 'text',
      'sanitize_callback' => 'melissa_sanitize_logo_type',
    )
  );

  $wp_customize->add_control(
    'logo_type',
    array(
      'type' => 'select',
      'label' => __('Logo Type', 'melissa'),
      'section' => 'general_settings_section',
      'choices' => array(
        'text' => __('Text', 'melissa'),
        'image' => __('Image', 'melissa'),
      ),
    )
  );

  // Logo type - description
  $wp_customize->add_setting(
    'logo_type_desc',
    array(
      'default' => __('You can add an image for your logo in the <b>Site Identity</b> section: <b>Site Identity</b> > <b>Logo</b>.', 'melissa'),
      'sanitize_callback' => 'melissa_sanitize_wp_kses_b_br',
    )
  );

  $wp_customize->add_control(
    new melissa_customize_text_description_control(
      $wp_customize,
      'logo_type_desc',
      array(
        'label' => __('Logo Type - Description', 'melissa'),
        'section' => 'general_settings_section',
        'settings' => 'logo_type_desc'
      )
    )
  );

  // Logo text
  $wp_customize->add_setting(
    'logo_text',
    array(
      'default' => 'Melissa',
      'sanitize_callback' => 'melissa_sanitize_text_esc_html',
    )
  );

  $wp_customize->add_control(
    'logo_text',
    array(
      'label' => __('Text for Logo (Logo Type: Text)', 'melissa'),
      'section' => 'general_settings_section',
      'type' => 'text',
    )
  );

  /**
   * General Settings - Header Custom Text
   * -------------------------------------------------------------
   */

  // General settings - Header custom text (heading)
  $wp_customize->add_setting(
    'general_settings_header_text_heading',
    array(
      'default' => '',
      'sanitize_callback' => 'melissa_sanitize_text_esc_html',
    )
  );

  $wp_customize->add_control(
    new melissa_customize_heading_control(
      $wp_customize,
      'general_settings_header_text_heading',
      array(
        'label' => __('Header Custom Text', 'melissa'),
        'section' => 'general_settings_section',
        'settings' => 'general_settings_header_text_heading'
      )
    )
  );

  // Custom title
  $wp_customize->add_setting(
    'header_custom_title',
    array(
      'default' => 'Custom Title',
      'sanitize_callback' => 'melissa_sanitize_wp_kses_html_tags_title',
    )
  );

  $wp_customize->add_control(
    'header_custom_title',
    array(
      'label' => __('Custom Title', 'melissa'),
      'section' => 'general_settings_section',
      'type' => 'text',
    )
  );

  // Custom title - Allowed HTML tags
  $wp_customize->add_setting(
    'header_custom_title_desc',
    array(
      'default' => __('<b>Custom Title - Allowed HTML Tags</b>: span, strong, b, em, i.<br><b>Custom Title - Allowed Attributes</b>: <b>span</b>: class. <b>i</b>: class.', 'melissa'),
      'sanitize_callback' => 'melissa_sanitize_wp_kses_b_br',
    )
  );

  $wp_customize->add_control(
    new melissa_customize_text_description_control(
      $wp_customize,
      'header_custom_title_desc',
      array(
        'label' => __('Custom Title - Allowed HTML Tags', 'melissa'),
        'section' => 'general_settings_section',
        'settings' => 'header_custom_title_desc'
      )
    )
  );

  // Custom text
  $wp_customize->add_setting(
    'header_custom_text',
    array(
      'default' => 'Custom text. You can enter your own title and text in the theme settings: Appearance > Customize > General Settings > Header Custom Text > Custom Title and Custom Text.',
      'sanitize_callback' => 'melissa_sanitize_wp_kses_html_tags_text',
    )
  );

  $wp_customize->add_control(
    'header_custom_text',
    array(
      'label' => __('Custom Text', 'melissa'),
      'section' => 'general_settings_section',
      'type' => 'textarea',
    )
  );

  // Custom text - Allowed HTML tags
  $wp_customize->add_setting(
    'header_custom_text_desc',
    array(
      'default' => __('<b>Custom Text - Allowed HTML Tags</b>: a, span, strong, b, em, i, br.<br><b>Custom Text - Allowed Attributes</b>: <b>a</b>: href, title, target, class. <b>span</b>: class. <b>i</b>: class.', 'melissa'),
      'sanitize_callback' => 'melissa_sanitize_wp_kses_b_br',
    )
  );

  $wp_customize->add_control(
    new melissa_customize_text_description_control(
      $wp_customize,
      'header_custom_text_desc',
      array(
        'label' => __('Custom Text - Allowed HTML Tags', 'melissa'),
        'section' => 'general_settings_section',
        'settings' => 'header_custom_text_desc'
      )
    )
  );

  /**
   * General Settings - Sticky menu
   * -------------------------------------------------------------
   */

  // General settings - Sticky menu (heading)
  $wp_customize->add_setting(
    'general_settings_sticky_menu_heading',
    array(
      'default' => '',
      'sanitize_callback' => 'melissa_sanitize_text_esc_html',
    )
  );

  $wp_customize->add_control(
    new melissa_customize_heading_control(
      $wp_customize,
      'general_settings_sticky_menu_heading',
      array(
        'label' => __('Sticky Menu', 'melissa'),
        'section' => 'general_settings_section',
        'settings' => 'general_settings_sticky_menu_heading'
      )
    )
  );

  // Enable sticky menu
  $wp_customize->add_setting(
    'general_enable_sticky_menu',
    array(
      'default' => 1,
      'sanitize_callback' => 'melissa_sanitize_checkbox',
    )
  );

  $wp_customize->add_control(
    'general_enable_sticky_menu',
    array(
      'type' => 'checkbox',
      'label' => __('Enable sticky menu', 'melissa'),
      'section' => 'general_settings_section',
    )
  );

  /**
   * General Settings - Blog
   * -------------------------------------------------------------
   */

  // General settings - Blog (heading)
  $wp_customize->add_setting(
    'general_settings_blog_heading',
    array(
      'default' => '',
      'sanitize_callback' => 'melissa_sanitize_text_esc_html',
    )
  );

  $wp_customize->add_control(
    new melissa_customize_heading_control(
      $wp_customize,
      'general_settings_blog_heading',
      array(
        'label' => __('Blog', 'melissa'),
        'section' => 'general_settings_section',
        'settings' => 'general_settings_blog_heading'
      )
    )
  );

  // Blog page layout
  $wp_customize->add_setting(
    'blog_layout',
    array(
      'default' => '3c',
      'sanitize_callback' => 'melissa_sanitize_blog_layout',
    )
  );

  $wp_customize->add_control(
    'blog_layout',
    array(
      'type' => 'select',
      'label' => __('Blog Layout', 'melissa'),
      'section' => 'general_settings_section',
      'choices' => array(
        '3c' => __('3 Columns', 'melissa'),
        '2c-ls' => __('2 Columns + Left sidebar', 'melissa'),
        '2c-rs' => __('2 Columns + Right sidebar', 'melissa'),
        '2c' => __('2 Columns', 'melissa'),
        '1c-ls' => __('1 Column + Left sidebar', 'melissa'),
        '1c-rs' => __('1 Column + Right sidebar', 'melissa'),
        '1c' => __('1 Column', 'melissa'),
      ),
    )
  );

  // Pagination type
  $wp_customize->add_setting(
    'pagination_type',
    array(
      'default' => 'standard_pagination',
      'sanitize_callback' => 'melissa_sanitize_pagination_type',
    )
  );

  $wp_customize->add_control(
    'pagination_type',
    array(
      'type' => 'select',
      'label' => __('Pagination Type', 'melissa'),
      'section' => 'general_settings_section',
      'choices' => array(
        'standard_pagination' => __('Standard pagination', 'melissa'),
        'next_prev_links' => __('Next/Previous page links', 'melissa'),
        'infinite_scroll' => __('Infinite scroll', 'melissa'),
        'load_more' => __('Load More button', 'melissa')
      ),
    )
  );

  // Links open in..
  $wp_customize->add_setting(
    'post_links_target',
    array(
      'default' => '_self',
      'sanitize_callback' => 'melissa_sanitize_target',
    )
  );

  $wp_customize->add_control(
    'post_links_target',
    array(
      'type' => 'select',
      'label' => __('Links Open in... (Target Attribute)', 'melissa'),
      'section' => 'general_settings_section',
      'choices' => array(
        '_blank' => __('New tab (_blank)', 'melissa'),
        '_self' => __('Current tab (_self)', 'melissa')
      ),
    )
  );

  // Excerpt or "Read more tag"
  $wp_customize->add_setting(
    'blog_excerpt_type',
    array(
      'default' => 'excerpt',
      'sanitize_callback' => 'melissa_sanitize_blog_excerpt_type',
    )
  );

  $wp_customize->add_control(
    'blog_excerpt_type',
    array(
      'type' => 'select',
      'label' => __('Use Excerpt or "Read More tag"', 'melissa'),
      'section' => 'general_settings_section',
      'choices' => array(
        'excerpt' => __('Excerpt', 'melissa'),
        'more-tag' => __('Read More tag', 'melissa'),
      ),
    )
  );

  // Description for option 'Excerpt or "Read more tag"'
  $wp_customize->add_setting(
    'blog_excerpt_type_desc',
    array(
      'default' => __('<b>Note:</b> Some post formats always show a content with the <b>"Read More tag"</b>, so the <b>"Excerpt"</b> option does not apply to these formats: <b>Aside</b>, <b>Link</b>, <b>Status</b>, <b>Chat</b>, and <b>Quote</b>.', 'melissa'),
      'sanitize_callback' => 'melissa_sanitize_wp_kses_b_br',
    )
  );

  $wp_customize->add_control(
    new melissa_customize_text_description_control(
      $wp_customize,
      'blog_excerpt_type_desc',
      array(
        'label' => __('Excerpt Type Option - Description', 'melissa'),
        'section' => 'general_settings_section',
        'settings' => 'blog_excerpt_type_desc'
      )
    )
  );

  // Excerpt length (number of words)
  $wp_customize->add_setting(
    'blog_excerpt_length',
    array(
      'default' => 20,
      'sanitize_callback' => 'melissa_sanitize_number_intval',
    )
  );

  $wp_customize->add_control(
    new melissa_customize_number_control(
      $wp_customize,
      'blog_excerpt_length',
      array(
        'label' => __('Excerpt Length (Number of Words)', 'melissa'),
        'section' => 'general_settings_section',
        'settings' => 'blog_excerpt_length'
      )
    )
  );

  // Increase all small featured images
  $wp_customize->add_setting(
    'blog_increase_images',
    array(
      'default' => 1,
      'sanitize_callback' => 'melissa_sanitize_checkbox',
    )
  );

  $wp_customize->add_control(
    'blog_increase_images',
    array(
      'type' => 'checkbox',
      'label' => __('Increase all small featured images', 'melissa'),
      'section' => 'general_settings_section',
    )
  );

  // Show icon and transparent dark background when you hover on featured images
  $wp_customize->add_setting(
    'blog_images_hover_effect',
    array(
      'default' => 1,
      'sanitize_callback' => 'melissa_sanitize_checkbox',
    )
  );

  $wp_customize->add_control(
    'blog_images_hover_effect',
    array(
      'type' => 'checkbox',
      'label' => __('Show icon and transparent dark background when you hover on featured images', 'melissa'),
      'section' => 'general_settings_section',
    )
  );

  // Show date
  $wp_customize->add_setting(
    'blog_show_date',
    array(
      'default' => 1,
      'sanitize_callback' => 'melissa_sanitize_checkbox',
    )
  );

  $wp_customize->add_control(
    'blog_show_date',
    array(
      'type' => 'checkbox',
      'label' => __('Show date', 'melissa'),
      'section' => 'general_settings_section',
    )
  );

  // Show views counter
  $wp_customize->add_setting(
    'blog_show_views',
    array(
      'default' => 1,
      'sanitize_callback' => 'melissa_sanitize_checkbox',
    )
  );

  $wp_customize->add_control(
    'blog_show_views',
    array(
      'type' => 'checkbox',
      'label' => __('Show views counter', 'melissa'),
      'section' => 'general_settings_section',
    )
  );

  // Show likes counter
  $wp_customize->add_setting(
    'blog_show_likes',
    array(
      'default' => 1,
      'sanitize_callback' => 'melissa_sanitize_checkbox',
    )
  );

  $wp_customize->add_control(
    'blog_show_likes',
    array(
      'type' => 'checkbox',
      'label' => __('Show likes counter', 'melissa'),
      'section' => 'general_settings_section',
    )
  );

  /**
   * General Settings - Single Post Page
   * -------------------------------------------------------------
   */

  // General settings - Single post page (heading)
  $wp_customize->add_setting(
    'general_settings_single_page_heading',
    array(
      'default' => '',
      'sanitize_callback' => 'melissa_sanitize_text_esc_html',
    )
  );

  $wp_customize->add_control(
    new melissa_customize_heading_control(
      $wp_customize,
      'general_settings_single_page_heading',
      array(
        'label' => __('Single Post Page', 'melissa'),
        'section' => 'general_settings_section',
        'settings' => 'general_settings_single_page_heading'
      )
    )
  );

  // Show social sharing buttons
  $wp_customize->add_setting(
    'single_show_social_share',
    array(
      'default' => 1,
      'sanitize_callback' => 'melissa_sanitize_checkbox',
    )
  );

  $wp_customize->add_control(
    'single_show_social_share',
    array(
      'type' => 'checkbox',
      'label' => __('Show social sharing buttons', 'melissa'),
      'section' => 'general_settings_section',
    )
  );

  // Show views counter
  $wp_customize->add_setting(
    'single_show_views',
    array(
      'default' => 1,
      'sanitize_callback' => 'melissa_sanitize_checkbox',
    )
  );

  $wp_customize->add_control(
    'single_show_views',
    array(
      'type' => 'checkbox',
      'label' => __('Show views counter', 'melissa'),
      'section' => 'general_settings_section',
    )
  );

  // Show comments counter
  $wp_customize->add_setting(
    'single_show_comments_counter',
    array(
      'default' => 1,
      'sanitize_callback' => 'melissa_sanitize_checkbox',
    )
  );

  $wp_customize->add_control(
    'single_show_comments_counter',
    array(
      'type' => 'checkbox',
      'label' => __('Show comments counter', 'melissa'),
      'section' => 'general_settings_section',
    )
  );

  // Show likes counter
  $wp_customize->add_setting(
    'single_show_likes',
    array(
      'default' => 1,
      'sanitize_callback' => 'melissa_sanitize_checkbox',
    )
  );

  $wp_customize->add_control(
    'single_show_likes',
    array(
      'type' => 'checkbox',
      'label' => __('Show likes counter', 'melissa'),
      'section' => 'general_settings_section',
    )
  );

  // Show author
  $wp_customize->add_setting(
    'single_show_author',
    array(
      'default' => 1,
      'sanitize_callback' => 'melissa_sanitize_checkbox',
    )
  );

  $wp_customize->add_control(
    'single_show_author',
    array(
      'type' => 'checkbox',
      'label' => __('Show author', 'melissa'),
      'section' => 'general_settings_section',
    )
  );

  // Show date
  $wp_customize->add_setting(
    'single_show_date',
    array(
      'default' => 1,
      'sanitize_callback' => 'melissa_sanitize_checkbox',
    )
  );

  $wp_customize->add_control(
    'single_show_date',
    array(
      'type' => 'checkbox',
      'label' => __('Show date', 'melissa'),
      'section' => 'general_settings_section',
    )
  );

  // Show categories
  $wp_customize->add_setting(
    'single_show_categories',
    array(
      'default' => 1,
      'sanitize_callback' => 'melissa_sanitize_checkbox',
    )
  );

  $wp_customize->add_control(
    'single_show_categories',
    array(
      'type' => 'checkbox',
      'label' => __('Show categories', 'melissa'),
      'section' => 'general_settings_section',
    )
  );

  // Show tags
  $wp_customize->add_setting(
    'single_show_tags',
    array(
      'default' => 1,
      'sanitize_callback' => 'melissa_sanitize_checkbox',
    )
  );

  $wp_customize->add_control(
    'single_show_tags',
    array(
      'type' => 'checkbox',
      'label' => __('Show tags', 'melissa'),
      'section' => 'general_settings_section',
    )
  );

  // Show post navigation
  $wp_customize->add_setting(
    'single_show_post_nav',
    array(
      'default' => 1,
      'sanitize_callback' => 'melissa_sanitize_checkbox',
    )
  );

  $wp_customize->add_control(
    'single_show_post_nav',
    array(
      'type' => 'checkbox',
      'label' => __('Show post navigation', 'melissa'),
      'section' => 'general_settings_section',
    )
  );

  // Show "About the author" block
  $wp_customize->add_setting(
    'single_show_about_author',
    array(
      'default' => 0,
      'sanitize_callback' => 'melissa_sanitize_checkbox',
    )
  );

  $wp_customize->add_control(
    'single_show_about_author',
    array(
      'type' => 'checkbox',
      'label' => __('Show "About the author" block', 'melissa'),
      'section' => 'general_settings_section',
    )
  );

  // Show related posts (by tags)
  $wp_customize->add_setting(
    'single_show_related_posts',
    array(
      'default' => 0,
      'sanitize_callback' => 'melissa_sanitize_checkbox',
    )
  );

  $wp_customize->add_control(
    'single_show_related_posts',
    array(
      'type' => 'checkbox',
      'label' => __('Show related posts (by tags)', 'melissa'),
      'section' => 'general_settings_section',
    )
  );

  /**
   * General Settings - Other settings
   * -------------------------------------------------------------
   */

  // General settings - Other settings (heading)
  $wp_customize->add_setting(
    'general_settings_other_heading',
    array(
      'default' => '',
      'sanitize_callback' => 'melissa_sanitize_text_esc_html',
    )
  );

  $wp_customize->add_control(
    new melissa_customize_heading_control(
      $wp_customize,
      'general_settings_other_heading',
      array(
        'label' => __('Other Settings', 'melissa'),
        'section' => 'general_settings_section',
        'settings' => 'general_settings_other_heading'
      )
    )
  );

  // Enable hover effect for all content blocks
  $wp_customize->add_setting(
    'general_global_hover_effect',
    array(
      'default' => 0,
      'sanitize_callback' => 'melissa_sanitize_checkbox',
    )
  );

  $wp_customize->add_control(
    'general_global_hover_effect',
    array(
      'type' => 'checkbox',
      'label' => __('Enable hover effect for all content blocks', 'melissa'),
      'section' => 'general_settings_section',
    )
  );

  // Add data-no-retina attribute to all images (fixes retina.js 404 errors)
  $wp_customize->add_setting(
    'general_add_data_no_retina_attr',
    array(
      'default' => 0,
      'sanitize_callback' => 'melissa_sanitize_checkbox',
    )
  );

  $wp_customize->add_control(
    'general_add_data_no_retina_attr',
    array(
      'type' => 'checkbox',
      'label' => __('Add "data-no-retina" attribute to all images (fixes retina.js 404 errors)', 'melissa'),
      'section' => 'general_settings_section',
    )
  );


  /**
   * 3.0 Footer
   * -------------------------------------------------------------
   */

  $wp_customize->add_section(
    'footer_section',
    array(
      'title' => __('Footer', 'melissa'),
      'priority' => 22,
    )
  );

  // Footer widgets (heading)
  $wp_customize->add_setting(
    'footer_widgets_heading',
    array(
      'default' => '',
      'sanitize_callback' => 'melissa_sanitize_text_esc_html',
    )
  );

  $wp_customize->add_control(
    new melissa_customize_heading_control(
      $wp_customize,
      'footer_widgets_heading',
      array(
        'label' => __('Footer Widgets', 'melissa'),
        'section' => 'footer_section',
        'settings' => 'footer_widgets_heading'
      )
    )
  );

  // Footer widgets height
  $wp_customize->add_setting(
    'footer_widgets_height',
    array(
      'default' => '',
      'sanitize_callback' => 'melissa_sanitize_number_intval',
    )
  );

  $wp_customize->add_control(
    new melissa_customize_number_control(
      $wp_customize,
      'footer_widgets_height',
      array(
        'label' => __('Footer Widgets Height, px', 'melissa'),
        'section' => 'footer_section',
        'settings' => 'footer_widgets_height'
      )
    )
  );

  // Footer - Copyright (heading)
  $wp_customize->add_setting(
    'footer_copyright_heading',
    array(
      'default' => '',
      'sanitize_callback' => 'melissa_sanitize_text_esc_html',
    )
  );

  $wp_customize->add_control(
    new melissa_customize_heading_control(
      $wp_customize,
      'footer_copyright_heading',
      array(
        'label' => __('Copyright', 'melissa'),
        'section' => 'footer_section',
        'settings' => 'footer_copyright_heading'
      )
    )
  );

  // Copyright text
  $wp_customize->add_setting(
    'copyright_text',
    array(
      'default' => 'Copyright text (Appearance -> Customize -> Footer -> Copyright text)',
      'sanitize_callback' => 'melissa_sanitize_wp_kses_html_tags_text',
    )
  );

  $wp_customize->add_control(
    'copyright_text',
    array(
      'label' => __('Copyright Text', 'melissa'),
      'section' => 'footer_section',
      'type' => 'textarea',
    )
  );

  // Copyright text - Allowed HTML tags
  $wp_customize->add_setting(
    'copyright_text_desc',
    array(
      'default' => __('<b>Allowed HTML Tags</b>: a, span, strong, b, em, i, br.<br><b>Allowed Attributes</b>: <b>a</b>: href, title, target, class. <b>span</b>: class. <b>i</b>: class.', 'melissa'),
      'sanitize_callback' => 'melissa_sanitize_wp_kses_b_br',
    )
  );

  $wp_customize->add_control(
    new melissa_customize_text_description_control(
      $wp_customize,
      'copyright_text_desc',
      array(
        'label' => __('Copyright Text - Allowed HTML Tags', 'melissa'),
        'section' => 'footer_section',
        'settings' => 'copyright_text_desc'
      )
    )
  );

  // Footer - Social links (heading)
  $wp_customize->add_setting(
    'footer_social_links_heading',
    array(
      'default' => '',
      'sanitize_callback' => 'melissa_sanitize_text_esc_html',
    )
  );

  $wp_customize->add_control(
    new melissa_customize_heading_control(
      $wp_customize,
      'footer_social_links_heading',
      array(
        'label' => __('Social Links & RSS', 'melissa'),
        'section' => 'footer_section',
        'settings' => 'footer_social_links_heading'
      )
    )
  );

  // Twitter URL
  $wp_customize->add_setting(
    'footer_url_twitter',
    array(
      'default' => '',
      'sanitize_callback' => 'melissa_sanitize_url',
    )
  );

  $wp_customize->add_control(
    'footer_url_twitter',
    array(
      'label' => __('Twitter URL', 'melissa'),
      'section' => 'footer_section',
      'type' => 'text',
    )
  );

  // Facebook URL
  $wp_customize->add_setting(
    'footer_url_facebook',
    array(
      'default' => '',
      'sanitize_callback' => 'melissa_sanitize_url',
    )
  );

  $wp_customize->add_control(
    'footer_url_facebook',
    array(
      'label' => __('Facebook URL', 'melissa'),
      'section' => 'footer_section',
      'type' => 'text',
    )
  );

  // Google plus URL
  $wp_customize->add_setting(
    'footer_url_google-plus',
    array(
      'default' => '',
      'sanitize_callback' => 'melissa_sanitize_url',
    )
  );

  $wp_customize->add_control(
    'footer_url_google-plus',
    array(
      'label' => __('Google+ URL', 'melissa'),
      'section' => 'footer_section',
      'type' => 'text',
    )
  );

  // Pinterest URL
  $wp_customize->add_setting(
    'footer_url_pinterest-p',
    array(
      'default' => '',
      'sanitize_callback' => 'melissa_sanitize_url',
    )
  );

  $wp_customize->add_control(
    'footer_url_pinterest-p',
    array(
      'label' => __('Pinterest URL', 'melissa'),
      'section' => 'footer_section',
      'type' => 'text',
    )
  );

  // VK URL
  $wp_customize->add_setting(
    'footer_url_vk',
    array(
      'default' => '',
      'sanitize_callback' => 'melissa_sanitize_url',
    )
  );

  $wp_customize->add_control(
    'footer_url_vk',
    array(
      'label' => __('VK URL', 'melissa'),
      'section' => 'footer_section',
      'type' => 'text',
    )
  );

  // Flickr URL
  $wp_customize->add_setting(
    'footer_url_flickr',
    array(
      'default' => '',
      'sanitize_callback' => 'melissa_sanitize_url',
    )
  );

  $wp_customize->add_control(
    'footer_url_flickr',
    array(
      'label' => __('Flickr URL', 'melissa'),
      'section' => 'footer_section',
      'type' => 'text',
    )
  );

  // Instagram URL
  $wp_customize->add_setting(
    'footer_url_instagram',
    array(
      'default' => '',
      'sanitize_callback' => 'melissa_sanitize_url',
    )
  );

  $wp_customize->add_control(
    'footer_url_instagram',
    array(
      'label' => __('Instagram URL', 'melissa'),
      'section' => 'footer_section',
      'type' => 'text',
    )
  );

  // 500px URL
  $wp_customize->add_setting(
    'footer_url_500px',
    array(
      'default' => '',
      'sanitize_callback' => 'melissa_sanitize_url',
    )
  );

  $wp_customize->add_control(
    'footer_url_500px',
    array(
      'label' => __('500px URL', 'melissa'),
      'section' => 'footer_section',
      'type' => 'text',
    )
  );

  // YouTube URL
  $wp_customize->add_setting(
    'footer_url_youtube',
    array(
      'default' => '',
      'sanitize_callback' => 'melissa_sanitize_url',
    )
  );

  $wp_customize->add_control(
    'footer_url_youtube',
    array(
      'label' => __('YouTube URL', 'melissa'),
      'section' => 'footer_section',
      'type' => 'text',
    )
  );

  // Vimeo URL
  $wp_customize->add_setting(
    'footer_url_vimeo',
    array(
      'default' => '',
      'sanitize_callback' => 'melissa_sanitize_url',
    )
  );

  $wp_customize->add_control(
    'footer_url_vimeo',
    array(
      'label' => __('Vimeo URL', 'melissa'),
      'section' => 'footer_section',
      'type' => 'text',
    )
  );

  // Soundcloud URL
  $wp_customize->add_setting(
    'footer_url_soundcloud',
    array(
      'default' => '',
      'sanitize_callback' => 'melissa_sanitize_url',
    )
  );

  $wp_customize->add_control(
    'footer_url_soundcloud',
    array(
      'label' => __('Soundcloud URL', 'melissa'),
      'section' => 'footer_section',
      'type' => 'text',
    )
  );

  // Dribbble URL
  $wp_customize->add_setting(
    'footer_url_dribbble',
    array(
      'default' => '',
      'sanitize_callback' => 'melissa_sanitize_url',
    )
  );

  $wp_customize->add_control(
    'footer_url_dribbble',
    array(
      'label' => __('Dribbble URL', 'melissa'),
      'section' => 'footer_section',
      'type' => 'text',
    )
  );

  // Behance URL
  $wp_customize->add_setting(
    'footer_url_behance',
    array(
      'default' => '',
      'sanitize_callback' => 'melissa_sanitize_url',
    )
  );

  $wp_customize->add_control(
    'footer_url_behance',
    array(
      'label' => __('Behance URL', 'melissa'),
      'section' => 'footer_section',
      'type' => 'text',
    )
  );

  // GitHub
  $wp_customize->add_setting(
    'footer_url_github',
    array(
      'default' => '',
      'sanitize_callback' => 'melissa_sanitize_url',
    )
  );

  $wp_customize->add_control(
    'footer_url_github',
    array(
      'label' => __('GitHub URL', 'melissa'),
      'section' => 'footer_section',
      'type' => 'text',
    )
  );

  // RSS URL
  $wp_customize->add_setting(
    'footer_url_rss',
    array(
      'default' => '',
      'sanitize_callback' => 'melissa_sanitize_url',
    )
  );

  $wp_customize->add_control(
    'footer_url_rss',
    array(
      'label' => __('RSS URL', 'melissa'),
      'section' => 'footer_section',
      'type' => 'text',
    )
  );


  /**
   * 4.0 Font Family
   * -------------------------------------------------------------
   */

  // Font families
  $font_families = array('Arial' => 'Arial', 'Verdana' => 'Verdana', 'Trebuchet MS' => 'Trebuchet MS', 'Tahoma' => 'Tahoma', 'Palatino' => 'Palatino', 'Helvetica' => 'Helvetica', 'ABeeZee' => 'ABeeZee', 'Abel' => 'Abel', 'Abril Fatface' => 'Abril Fatface', 'Aclonica' => 'Aclonica', 'Acme' => 'Acme', 'Actor' => 'Actor', 'Adamina' => 'Adamina', 'Advent Pro' => 'Advent Pro', 'Aguafina Script' => 'Aguafina Script', 'Akronim' => 'Akronim', 'Aladin' => 'Aladin', 'Aldrich' => 'Aldrich', 'Alegreya' => 'Alegreya', 'Alegreya SC' => 'Alegreya SC', 'Alegreya Sans' => 'Alegreya Sans', 'Alegreya Sans SC' => 'Alegreya Sans SC', 'Alex Brush' => 'Alex Brush', 'Alfa Slab One' => 'Alfa Slab One', 'Alice' => 'Alice', 'Alike' => 'Alike', 'Alike Angular' => 'Alike Angular', 'Allan' => 'Allan', 'Allerta' => 'Allerta', 'Allerta Stencil' => 'Allerta Stencil', 'Allura' => 'Allura', 'Almendra' => 'Almendra', 'Almendra Display' => 'Almendra Display', 'Almendra SC' => 'Almendra SC', 'Amarante' => 'Amarante', 'Amaranth' => 'Amaranth', 'Amatic SC' => 'Amatic SC', 'Amethysta' => 'Amethysta', 'Anaheim' => 'Anaheim', 'Andada' => 'Andada', 'Andika' => 'Andika', 'Angkor' => 'Angkor', 'Annie Use Your Telescope' => 'Annie Use Your Telescope', 'Anonymous Pro' => 'Anonymous Pro', 'Antic' => 'Antic', 'Antic Didone' => 'Antic Didone', 'Antic Slab' => 'Antic Slab', 'Anton' => 'Anton', 'Arapey' => 'Arapey', 'Arbutus' => 'Arbutus', 'Arbutus Slab' => 'Arbutus Slab', 'Architects Daughter' => 'Architects Daughter', 'Archivo Black' => 'Archivo Black', 'Archivo Narrow' => 'Archivo Narrow', 'Arimo' => 'Arimo', 'Arizonia' => 'Arizonia', 'Armata' => 'Armata', 'Artifika' => 'Artifika', 'Arvo' => 'Arvo', 'Asap' => 'Asap', 'Asset' => 'Asset', 'Astloch' => 'Astloch', 'Asul' => 'Asul', 'Atomic Age' => 'Atomic Age', 'Aubrey' => 'Aubrey', 'Audiowide' => 'Audiowide', 'Autour One' => 'Autour One', 'Average' => 'Average', 'Average Sans' => 'Average Sans', 'Averia Gruesa Libre' => 'Averia Gruesa Libre', 'Averia Libre' => 'Averia Libre', 'Averia Sans Libre' => 'Averia Sans Libre', 'Averia Serif Libre' => 'Averia Serif Libre', 'Bad Script' => 'Bad Script', 'Balthazar' => 'Balthazar', 'Bangers' => 'Bangers', 'Basic' => 'Basic', 'BenchNine' => 'BenchNine', 'Battambang' => 'Battambang', 'Baumans' => 'Baumans', 'Bayon' => 'Bayon', 'Belgrano' => 'Belgrano', 'Belleza' => 'Belleza', 'Bentham' => 'Bentham', 'Berkshire Swash' => 'Berkshire Swash', 'Bevan' => 'Bevan', 'Bigelow Rules' => 'Bigelow Rules', 'Bigshot One' => 'Bigshot One', 'Bilbo' => 'Bilbo', 'Bilbo Swash Caps' => 'Bilbo Swash Caps', 'Bitter' => 'Bitter', 'Black Ops One' => 'Black Ops One', 'Bonbon' => 'Bonbon', 'Boogaloo' => 'Boogaloo', 'Bowlby One' => 'Bowlby One', 'Bowlby One SC' => 'Bowlby One SC', 'Brawler' => 'Brawler', 'Bree Serif' => 'Bree Serif', 'Bubblegum Sans' => 'Bubblegum Sans', 'Buda' => 'Buda', 'Buenard' => 'Buenard', 'Butcherman' => 'Butcherman', 'Butterfly Kids' => 'Butterfly Kids', 'Cabin' => 'Cabin', 'Cabin Condensed' => 'Cabin Condensed', 'Cabin Sketch' => 'Cabin Sketch', 'Caesar Dressing' => 'Caesar Dressing', 'Cagliostro' => 'Cagliostro', 'Calligraffitti' => 'Calligraffitti', 'Cambo' => 'Cambo', 'Candal' => 'Candal', 'Cantarell' => 'Cantarell', 'Cantata One' => 'Cantata One', 'Capriola' => 'Capriola', 'Cardo' => 'Cardo', 'Carme' => 'Carme', 'Carrois Gothic' => 'Carrois Gothic', 'Carrois Gothic SC' => 'Carrois Gothic SC', 'Carter One' => 'Carter One', 'Caudex' => 'Caudex', 'Cedarville Cursive' => 'Cedarville Cursive', 'Ceviche One' => 'Ceviche One', 'Changa One' => 'Changa One', 'Chango' => 'Chango', 'Chau Philomene One' => 'Chau Philomene One', 'Chela One' => 'Chela One', 'Chelsea Market' => 'Chelsea Market', 'Cherry Cream Soda' => 'Cherry Cream Soda', 'Cherry Swash' => 'Cherry Swash', 'Chewy' => 'Chewy', 'Chicle' => 'Chicle', 'Chivo' => 'Chivo', 'Cinzel' => 'Cinzel', 'Cinzel Decorative' => 'Cinzel Decorative', 'Clicker Script' => 'Clicker Script', 'Coda' => 'Coda', 'Coda Caption' => 'Coda Caption', 'Codystar' => 'Codystar', 'Combo' => 'Combo', 'Comfortaa' => 'Comfortaa', 'Coming Soon' => 'Coming Soon', 'Concert One' => 'Concert One', 'Condiment' => 'Condiment', 'Contrail One' => 'Contrail One', 'Convergence' => 'Convergence', 'Cookie' => 'Cookie', 'Copse' => 'Copse', 'Corben' => 'Corben', 'Courgette' => 'Courgette', 'Cousine' => 'Cousine', 'Coustard' => 'Coustard', 'Covered By Your Grace' => 'Covered By Your Grace', 'Crafty Girls' => 'Crafty Girls', 'Creepster' => 'Creepster', 'Crete Round' => 'Crete Round', 'Crimson Text' => 'Crimson Text', 'Croissant One' => 'Croissant One', 'Crushed' => 'Crushed', 'Cuprum' => 'Cuprum', 'Cutive' => 'Cutive', 'Cutive Mono' => 'Cutive Mono', 'Damion' => 'Damion', 'Dancing Script' => 'Dancing Script', 'Dawning of a New Day' => 'Dawning of a New Day', 'Days One' => 'Days One', 'Delius' => 'Delius', 'Delius Swash Caps' => 'Delius Swash Caps', 'Delius Unicase' => 'Delius Unicase', 'Della Respira' => 'Della Respira', 'Denk One' => 'Denk One', 'Devonshire' => 'Devonshire', 'Didact Gothic' => 'Didact Gothic', 'Diplomata' => 'Diplomata', 'Diplomata SC' => 'Diplomata SC', 'Domine' => 'Domine', 'Donegal One' => 'Donegal One', 'Doppio One' => 'Doppio One', 'Dorsa' => 'Dorsa', 'Dosis' => 'Dosis', 'Dr Sugiyama' => 'Dr Sugiyama', 'Droid Sans' => 'Droid Sans', 'Droid Sans Mono' => 'Droid Sans Mono', 'Droid Serif' => 'Droid Serif', 'Duru Sans' => 'Duru Sans', 'Dynalight' => 'Dynalight', 'EB Garamond' => 'EB Garamond', 'Eagle Lake' => 'Eagle Lake', 'Eater' => 'Eater', 'Economica' => 'Economica', 'Electrolize' => 'Electrolize', 'Elsie' => 'Elsie', 'Elsie Swash Caps' => 'Elsie Swash Caps', 'Emblema One' => 'Emblema One', 'Emilys Candy' => 'Emilys Candy', 'Engagement' => 'Engagement', 'Englebert' => 'Englebert', 'Enriqueta' => 'Enriqueta', 'Erica One' => 'Erica One', 'Esteban' => 'Esteban', 'Euphoria Script' => 'Euphoria Script', 'Ewert' => 'Ewert', 'Exo' => 'Exo', 'Expletus Sans' => 'Expletus Sans', 'Fanwood Text' => 'Fanwood Text', 'Fascinate' => 'Fascinate', 'Fascinate Inline' => 'Fascinate Inline', 'Faster One' => 'Faster One', 'Federant' => 'Federant', 'Federo' => 'Federo', 'Felipa' => 'Felipa', 'Fenix' => 'Fenix', 'Finger Paint' => 'Finger Paint', 'Fjalla One' => 'Fjalla One', 'Fjord One' => 'Fjord One', 'Flamenco' => 'Flamenco', 'Flavors' => 'Flavors', 'Fondamento' => 'Fondamento', 'Fontdiner Swanky' => 'Fontdiner Swanky', 'Forum' => 'Forum', 'Francois One' => 'Francois One', 'Fredericka the Great' => 'Fredericka the Great', 'Fredoka One' => 'Fredoka One', 'Fresca' => 'Fresca', 'Frijole' => 'Frijole', 'Fruktur' => 'Fruktur', 'Fugaz One' => 'Fugaz One', 'Gabriela' => 'Gabriela', 'Gafata' => 'Gafata', 'Galdeano' => 'Galdeano', 'Galindo' => 'Galindo', 'Gentium Basic' => 'Gentium Basic', 'Gentium Book Basic' => 'Gentium Book Basic', 'Geo' => 'Geo', 'Geostar' => 'Geostar', 'Geostar Fill' => 'Geostar Fill', 'Germania One' => 'Germania One', 'Gilda Display' => 'Gilda Display', 'Give You Glory' => 'Give You Glory', 'Glass Antiqua' => 'Glass Antiqua', 'Glegoo' => 'Glegoo', 'Gloria Hallelujah' => 'Gloria Hallelujah', 'Goblin One' => 'Goblin One', 'Gochi Hand' => 'Gochi Hand', 'Gorditas' => 'Gorditas', 'Goudy Bookletter 1911' => 'Goudy Bookletter 1911', 'Graduate' => 'Graduate', 'Grand Hotel' => 'Grand Hotel', 'Gravitas One' => 'Gravitas One', 'Great Vibes' => 'Great Vibes', 'Griffy' => 'Griffy', 'Gruppo' => 'Gruppo', 'Gudea' => 'Gudea', 'Habibi' => 'Habibi', 'Hammersmith One' => 'Hammersmith One', 'Hanalei' => 'Hanalei', 'Hanalei Fill' => 'Hanalei Fill', 'Handlee' => 'Handlee', 'Happy Monkey' => 'Happy Monkey', 'Headland One' => 'Headland One', 'Henny Penny' => 'Henny Penny', 'Herr Von Muellerhoff' => 'Herr Von Muellerhoff', 'Holtwood One SC' => 'Holtwood One SC', 'Homemade Apple' => 'Homemade Apple', 'Homenaje' => 'Homenaje', 'IM Fell DW Pica' => 'IM Fell DW Pica', 'IM Fell DW Pica SC' => 'IM Fell DW Pica SC', 'IM Fell Double Pica' => 'IM Fell Double Pica', 'IM Fell Double Pica SC' => 'IM Fell Double Pica SC', 'IM Fell English' => 'IM Fell English', 'IM Fell English SC' => 'IM Fell English SC', 'IM Fell French Canon' => 'IM Fell French Canon', 'IM Fell French Canon SC' => 'IM Fell French Canon SC', 'IM Fell Great Primer' => 'IM Fell Great Primer', 'IM Fell Great Primer SC' => 'IM Fell Great Primer SC', 'Iceberg' => 'Iceberg', 'Iceland' => 'Iceland', 'Imprima' => 'Imprima', 'Inconsolata' => 'Inconsolata', 'Inder' => 'Inder', 'Indie Flower' => 'Indie Flower', 'Inika' => 'Inika', 'Irish Grover' => 'Irish Grover', 'Istok Web' => 'Istok Web', 'Italiana' => 'Italiana', 'Italianno' => 'Italianno', 'Jacques Francois Shadow' => 'Jacques Francois Shadow', 'Jim Nightshade' => 'Jim Nightshade', 'Jockey One' => 'Jockey One', 'Jolly Lodger' => 'Jolly Lodger', 'Josefin Sans' => 'Josefin Sans', 'Josefin Slab' => 'Josefin Slab', 'Joti One' => 'Joti One', 'Judson' => 'Judson', 'Julee' => 'Julee', 'Julius Sans One' => 'Julius Sans One', 'Junge' => 'Junge', 'Jura' => 'Jura', 'Just Another Hand' => 'Just Another Hand', 'Just Me Again Down Here' => 'Just Me Again Down Here', 'Kameron' => 'Kameron', 'Karla' => 'Karla', 'Kaushan Script' => 'Kaushan Script', 'Kavoon' => 'Kavoon', 'Keania One' => 'Keania One', 'Kelly Slab' => 'Kelly Slab', 'Kenia' => 'Kenia', 'Kite One' => 'Kite One', 'Knewave' => 'Knewave', 'Kotta One' => 'Kotta One', 'Kranky' => 'Kranky', 'Kreon' => 'Kreon', 'Kristi' => 'Kristi', 'Krona One' => 'Krona One', 'La Belle Aurore' => 'La Belle Aurore', 'Lancelot' => 'Lancelot', 'Lato' => 'Lato', 'League Script' => 'League Script', 'Leckerli One' => 'Leckerli One', 'Ledger' => 'Ledger', 'Lekton' => 'Lekton', 'Lemon' => 'Lemon', 'Libre Baskerville' => 'Libre Baskerville', 'Life Savers' => 'Life Savers', 'Lilita One' => 'Lilita One', 'Limelight' => 'Limelight', 'Linden Hill' => 'Linden Hill', 'Lobster' => 'Lobster', 'Lobster Two' => 'Lobster Two', 'Londrina Outline' => 'Londrina Outline', 'Londrina Shadow' => 'Londrina Shadow', 'Londrina Sketch' => 'Londrina Sketch', 'Londrina Solid' => 'Londrina Solid', 'Lora' => 'Lora', 'Love Ya Like A Sister' => 'Love Ya Like A Sister', 'Loved by the King' => 'Loved by the King', 'Lovers Quarrel' => 'Lovers Quarrel', 'Luckiest Guy' => 'Luckiest Guy', 'Lusitana' => 'Lusitana', 'Lustria' => 'Lustria', 'Macondo' => 'Macondo', 'Macondo Swash Caps' => 'Macondo Swash Caps', 'Magra' => 'Magra', 'Maiden Orange' => 'Maiden Orange', 'Mako' => 'Mako', 'Marcellus' => 'Marcellus', 'Marcellus SC' => 'Marcellus SC', 'Marck Script' => 'Marck Script', 'Margarine' => 'Margarine', 'Marko One' => 'Marko One', 'Marmelad' => 'Marmelad', 'Marvel' => 'Marvel', 'Mate' => 'Mate', 'Mate SC' => 'Mate SC', 'Maven Pro' => 'Maven Pro', 'McLaren' => 'McLaren', 'Meddon' => 'Meddon', 'MedievalSharp' => 'MedievalSharp', 'Medula One' => 'Medula One', 'Megrim' => 'Megrim', 'Meie Script' => 'Meie Script', 'Merienda' => 'Merienda', 'Merienda One' => 'Merienda One', 'Merriweather' => 'Merriweather', 'Merriweather Sans' => 'Merriweather Sans', 'Metal Mania' => 'Metal Mania', 'Metamorphous' => 'Metamorphous', 'Metrophobic' => 'Metrophobic', 'Michroma' => 'Michroma', 'Milonga' => 'Milonga', 'Miltonian' => 'Miltonian', 'Miltonian Tattoo' => 'Miltonian Tattoo', 'Miniver' => 'Miniver', 'Miss Fajardose' => 'Miss Fajardose', 'Modern Antiqua' => 'Modern Antiqua', 'Molengo' => 'Molengo', 'Molle' => 'Molle', 'Monda' => 'Monda', 'Monofett' => 'Monofett', 'Monoton' => 'Monoton', 'Monsieur La Doulaise' => 'Monsieur La Doulaise', 'Montaga' => 'Montaga', 'Montez' => 'Montez', 'Montserrat' => 'Montserrat', 'Montserrat Alternates' => 'Montserrat Alternates', 'Montserrat Subrayada' => 'Montserrat Subrayada', 'Mountains of Christmas' => 'Mountains of Christmas', 'Mouse Memoirs' => 'Mouse Memoirs', 'Mr Bedfort' => 'Mr Bedfort', 'Mr Dafoe' => 'Mr Dafoe', 'Mr De Haviland' => 'Mr De Haviland', 'Mrs Saint Delafield' => 'Mrs Saint Delafield', 'Mrs Sheppards' => 'Mrs Sheppards', 'Muli' => 'Muli', 'Mystery Quest' => 'Mystery Quest', 'Neucha' => 'Neucha', 'Neuton' => 'Neuton', 'New Rocker' => 'New Rocker', 'News Cycle' => 'News Cycle', 'Niconne' => 'Niconne', 'Nixie One' => 'Nixie One', 'Nobile' => 'Nobile', 'Norican' => 'Norican', 'Nosifer' => 'Nosifer', 'Nothing You Could Do' => 'Nothing You Could Do', 'Noticia Text' => 'Noticia Text', 'Noto Sans' => 'Noto Sans', 'Noto Serif' => 'Noto Serif', 'Nova Cut' => 'Nova Cut', 'Nova Flat' => 'Nova Flat', 'Nova Mono' => 'Nova Mono', 'Nova Oval' => 'Nova Oval', 'Nova Round' => 'Nova Round', 'Nova Script' => 'Nova Script', 'Nova Slim' => 'Nova Slim', 'Nova Square' => 'Nova Square', 'Numans' => 'Numans', 'Nunito' => 'Nunito', 'Offside' => 'Offside', 'Old Standard TT' => 'Old Standard TT', 'Oldenburg' => 'Oldenburg', 'Oleo Script' => 'Oleo Script', 'Oleo Script Swash Caps' => 'Oleo Script Swash Caps', 'Open Sans' => 'Open Sans', 'Open Sans Condensed' => 'Open Sans Condensed', 'Oranienbaum' => 'Oranienbaum', 'Orbitron' => 'Orbitron', 'Oregano' => 'Oregano', 'Orienta' => 'Orienta', 'Original Surfer' => 'Original Surfer', 'Oswald' => 'Oswald', 'Over the Rainbow' => 'Over the Rainbow', 'Overlock' => 'Overlock', 'Overlock SC' => 'Overlock SC', 'Ovo' => 'Ovo', 'Oxygen' => 'Oxygen', 'PT Mono' => 'PT Mono', 'PT Sans' => 'PT Sans', 'PT Sans Caption' => 'PT Sans Caption', 'PT Sans Narrow' => 'PT Sans Narrow', 'PT Serif' => 'PT Serif', 'PT Serif Caption' => 'PT Serif Caption', 'Pacifico' => 'Pacifico', 'Paprika' => 'Paprika', 'Parisienne' => 'Parisienne', 'Passero One' => 'Passero One', 'Passion One' => 'Passion One', 'Patrick Hand' => 'Patrick Hand', 'Patrick Hand SC' => 'Patrick Hand SC', 'Patua One' => 'Patua One', 'Paytone One' => 'Paytone One', 'Peralta' => 'Peralta', 'Permanent Marker' => 'Permanent Marker', 'Petrona' => 'Petrona', 'Philosopher' => 'Philosopher', 'Piedra' => 'Piedra', 'Pinyon Script' => 'Pinyon Script', 'Pirata One' => 'Pirata One', 'Plaster' => 'Plaster', 'Play' => 'Play', 'Playball' => 'Playball', 'Playfair Display' => 'Playfair Display', 'Playfair Display SC' => 'Playfair Display SC', 'Podkova' => 'Podkova', 'Poiret One' => 'Poiret One', 'Poller One' => 'Poller One', 'Poly' => 'Poly', 'Pompiere' => 'Pompiere', 'Pontano Sans' => 'Pontano Sans', 'Port Lligat Sans' => 'Port Lligat Sans', 'Port Lligat Slab' => 'Port Lligat Slab', 'Prata' => 'Prata', 'Press Start 2P' => 'Press Start 2P', 'Princess Sofia' => 'Princess Sofia', 'Prociono' => 'Prociono', 'Prosto One' => 'Prosto One', 'Puritan' => 'Puritan', 'Quando' => 'Quando', 'Quantico' => 'Quantico', 'Quattrocento' => 'Quattrocento', 'Quattrocento Sans' => 'Quattrocento Sans', 'Questrial' => 'Questrial', 'Quicksand' => 'Quicksand', 'Quintessential' => 'Quintessential', 'Qwigley' => 'Qwigley', 'Racing Sans One' => 'Racing Sans One', 'Radley' => 'Radley', 'Raleway' => 'Raleway', 'Raleway Dots' => 'Raleway Dots', 'Rambla' => 'Rambla', 'Rammetto One' => 'Rammetto One', 'Ranchers' => 'Ranchers', 'Rancho' => 'Rancho', 'Rationale' => 'Rationale', 'Redressed' => 'Redressed', 'Reenie Beanie' => 'Reenie Beanie', 'Revalia' => 'Revalia', 'Ribeye' => 'Ribeye', 'Ribeye Marrow' => 'Ribeye Marrow', 'Righteous' => 'Righteous', 'Risque' => 'Risque', 'Roboto' => 'Roboto', 'Roboto Condensed' => 'Roboto Condensed', 'Rochester' => 'Rochester', 'Rock Salt' => 'Rock Salt', 'Rokkitt' => 'Rokkitt', 'Romanesco' => 'Romanesco', 'Ropa Sans' => 'Ropa Sans', 'Rosario' => 'Rosario', 'Rosarivo' => 'Rosarivo', 'Rouge Script' => 'Rouge Script', 'Ruda' => 'Ruda', 'Rufina' => 'Rufina', 'Ruge Boogie' => 'Ruge Boogie', 'Ruluko' => 'Ruluko', 'Rum Raisin' => 'Rum Raisin', 'Ruslan Display' => 'Ruslan Display', 'Russo One' => 'Russo One', 'Ruthie' => 'Ruthie', 'Rye' => 'Rye', 'Sacramento' => 'Sacramento', 'Sail' => 'Sail', 'Salsa' => 'Salsa', 'Sanchez' => 'Sanchez', 'Sancreek' => 'Sancreek', 'Sansita One' => 'Sansita One', 'Sarina' => 'Sarina', 'Satisfy' => 'Satisfy', 'Scada' => 'Scada', 'Schoolbell' => 'Schoolbell', 'Seaweed Script' => 'Seaweed Script', 'Sevillana' => 'Sevillana', 'Seymour One' => 'Seymour One', 'Shadows Into Light' => 'Shadows Into Light', 'Shadows Into Light Two' => 'Shadows Into Light Two', 'Shanti' => 'Shanti', 'Share' => 'Share', 'Share Tech' => 'Share Tech', 'Share Tech Mono' => 'Share Tech Mono', 'Shojumaru' => 'Shojumaru', 'Short Stack' => 'Short Stack', 'Sigmar One' => 'Sigmar One', 'Signika' => 'Signika', 'Signika Negative' => 'Signika Negative', 'Simonetta' => 'Simonetta', 'Sirin Stencil' => 'Sirin Stencil', 'Six Caps' => 'Six Caps', 'Slackey' => 'Slackey', 'Smokum' => 'Smokum', 'Smythe' => 'Smythe', 'Sniglet' => 'Sniglet', 'Snippet' => 'Snippet', 'Snowburst One' => 'Snowburst One', 'Sofadi One' => 'Sofadi One', 'Sofia' => 'Sofia', 'Sonsie One' => 'Sonsie One', 'Sorts Mill Goudy' => 'Sorts Mill Goudy', 'Source Code Pro' => 'Source Code Pro', 'Source Sans Pro' => 'Source Sans Pro', 'Special Elite' => 'Special Elite', 'Spicy Rice' => 'Spicy Rice', 'Spinnaker' => 'Spinnaker', 'Spirax' => 'Spirax', 'Squada One' => 'Squada One', 'Stalemate' => 'Stalemate', 'Stalinist One' => 'Stalinist One', 'Stardos Stencil' => 'Stardos Stencil', 'Stint Ultra Condensed' => 'Stint Ultra Condensed', 'Stint Ultra Expanded' => 'Stint Ultra Expanded', 'Stoke' => 'Stoke', 'Strait' => 'Strait', 'Sue Ellen Francisco' => 'Sue Ellen Francisco', 'Sunshiney' => 'Sunshiney', 'Supermercado One' => 'Supermercado One', 'Swanky and Moo Moo' => 'Swanky and Moo Moo', 'Syncopate' => 'Syncopate', 'Tangerine' => 'Tangerine', 'Tauri' => 'Tauri', 'Telex' => 'Telex', 'Tenor Sans' => 'Tenor Sans', 'The Girl Next Door' => 'The Girl Next Door', 'Tienne' => 'Tienne', 'Tinos' => 'Tinos', 'Titan One' => 'Titan One', 'Titillium Web' => 'Titillium Web', 'Trade Winds' => 'Trade Winds', 'Trocchi' => 'Trocchi', 'Trochut' => 'Trochut', 'Trykker' => 'Trykker', 'Tulpen One' => 'Tulpen One', 'Ubuntu' => 'Ubuntu', 'Ubuntu Condensed' => 'Ubuntu Condensed', 'Ubuntu Mono' => 'Ubuntu Mono', 'Ultra' => 'Ultra', 'Uncial Antiqua' => 'Uncial Antiqua', 'Underdog' => 'Underdog', 'Unica One' => 'Unica One', 'UnifrakturCook' => 'UnifrakturCook', 'UnifrakturMaguntia' => 'UnifrakturMaguntia', 'Unkempt' => 'Unkempt', 'Unlock' => 'Unlock', 'Unna' => 'Unna', 'VT323' => 'VT323', 'Vampiro One' => 'Vampiro One', 'Varela' => 'Varela', 'Varela Round' => 'Varela Round', 'Vast Shadow' => 'Vast Shadow', 'Vibur' => 'Vibur', 'Vidaloka' => 'Vidaloka', 'Viga' => 'Viga', 'Voces' => 'Voces', 'Volkhov' => 'Volkhov', 'Vollkorn' => 'Vollkorn', 'Voltaire' => 'Voltaire', 'Waiting for the Sunrise' => 'Waiting for the Sunrise', 'Wallpoet' => 'Wallpoet', 'Walter Turncoat' => 'Walter Turncoat', 'Warnes' => 'Warnes', 'Wellfleet' => 'Wellfleet', 'Wendy One' => 'Wendy One', 'Wire One' => 'Wire One', 'Yanone Kaffeesatz' => 'Yanone Kaffeesatz', 'Yellowtail' => 'Yellowtail', 'Yeseva One' => 'Yeseva One', 'Yesteryear' => 'Yesteryear', 'Zeyada' => 'Zeyada');

  // Font family section
  $wp_customize->add_section(
    'font_family_section',
    array(
      'title' => __('Font Family', 'melissa'),
      'priority' => 23,
    )
  );

  // Headings
  $wp_customize->add_setting(
    'headings_font_family',
    array(
      'default' => 'Lato',
      'sanitize_callback' => 'melissa_sanitize_fonts',
    )
  );

  $wp_customize->add_control(
    'headings_font_family',
    array(
      'type' => 'select',
      'label' => __('Headings', 'melissa'),
      'section' => 'font_family_section',
      'choices' => $font_families,
    )
  );

  // Content
  $wp_customize->add_setting(
    'content_font_family',
    array(
      'default' => 'Lato',
      'sanitize_callback' => 'melissa_sanitize_fonts',
    )
  );

  $wp_customize->add_control(
    'content_font_family',
    array(
      'type' => 'select',
      'label' => __('Content', 'melissa'),
      'section' => 'font_family_section',
      'choices' => $font_families,
    )
  );

  // Metadata
  $wp_customize->add_setting(
    'metadata_font_family',
    array(
      'default' => 'Lato',
      'sanitize_callback' => 'melissa_sanitize_fonts',
    )
  );

  $wp_customize->add_control(
    'metadata_font_family',
    array(
      'type' => 'select',
      'label' => __('Metadata', 'melissa'),
      'section' => 'font_family_section',
      'choices' => $font_families,
    )
  );

  // Quotes (blockquote items)
  $wp_customize->add_setting(
    'blockquote_font_family',
    array(
      'default' => 'Noto Serif',
      'sanitize_callback' => 'melissa_sanitize_fonts',
    )
  );

  $wp_customize->add_control(
    'blockquote_font_family',
    array(
      'type' => 'select',
      'label' => __('Quotes (Blockquote Items)', 'melissa'),
      'section' => 'font_family_section',
      'choices' => $font_families,
    )
  );

  // Logo (Logo type: text)
  $wp_customize->add_setting(
    'text_logo_font_family',
    array(
      'default' => 'Lato',
      'sanitize_callback' => 'melissa_sanitize_fonts',
    )
  );

  $wp_customize->add_control(
    'text_logo_font_family',
    array(
      'type' => 'select',
      'label' => __('Logo (Logo Type: Text)', 'melissa'),
      'section' => 'font_family_section',
      'choices' => $font_families,
    )
  );

  // Menu
  $wp_customize->add_setting(
    'menu_font_family',
    array(
      'default' => 'Lato',
      'sanitize_callback' => 'melissa_sanitize_fonts',
    )
  );

  $wp_customize->add_control(
    'menu_font_family',
    array(
      'type' => 'select',
      'label' => __('Menu', 'melissa'),
      'section' => 'font_family_section',
      'choices' => $font_families,
    )
  );

  // Character sets
  $wp_customize->add_setting(
    'fonts_character_sets',
    array(
      'default' => 'latin',
      'sanitize_callback' => 'melissa_sanitize_text_esc_html',
    )
  );

  $wp_customize->add_control(
    'fonts_character_sets',
    array(
      'label' => __('Character Sets (Example: latin,cyrillic,cyrillic-ext)', 'melissa'),
      'section' => 'font_family_section',
      'type' => 'textarea',
    )
  );


  /**
   * 5.0 Font Size & Style
   * -------------------------------------------------------------
   */

  // Font styles
  $font_styles = array(
    'normal' => __('Normal', 'melissa'),
    'normal-italic' => __('Normal Italic', 'melissa'),
    'bold' => __('Bold', 'melissa'),
    'bold-italic' => __('Bold Italic', 'melissa')
  );

  // Text transform
  $text_transform = array(
    'capitalize' => __('Capitalize', 'melissa'),
    'lowercase' => __('Lowercase', 'melissa'),
    'uppercase' => __('Uppercase', 'melissa'),
    'none' => __('None', 'melissa')
  );

  // Font Size & Style section
  $wp_customize->add_section(
    'font_size_style_section',
    array(
      'title' => __('Font Size & Style', 'melissa'),
      'priority' => 24,
    )
  );

  /**
   * Font Size & Style - Main Content
   * -------------------------------------------------------------
   */

  // Main content - Font settings (heading)
  $wp_customize->add_setting(
    'main_content_font_settings_heading',
    array(
      'default' => '',
      'sanitize_callback' => 'melissa_sanitize_text_esc_html',
    )
  );

  $wp_customize->add_control(
    new melissa_customize_heading_control(
      $wp_customize,
      'main_content_font_settings_heading',
      array(
        'label' => __('Main Content', 'melissa'),
        'section' => 'font_size_style_section',
        'settings' => 'main_content_font_settings_heading'
      )
    )
  );

  // Content: Font size
  $wp_customize->add_setting(
    'main_content_font_size',
    array(
      'default' => 16,
      'sanitize_callback' => 'melissa_sanitize_number_intval',
    )
  );

  $wp_customize->add_control(
    new melissa_customize_number_control(
      $wp_customize,
      'main_content_font_size',
      array(
        'label' => __('Content: Font Size, px', 'melissa'),
        'section' => 'font_size_style_section',
        'settings' => 'main_content_font_size'
      )
    )
  );

  /**
   * Font Size & Style - Text Logo
   * -------------------------------------------------------------
   */

  // Text logo - Font settings (heading)
  $wp_customize->add_setting(
    'text_logo_font_settings_heading',
    array(
      'default' => '',
      'sanitize_callback' => 'melissa_sanitize_text_esc_html',
    )
  );

  $wp_customize->add_control(
    new melissa_customize_heading_control(
      $wp_customize,
      'text_logo_font_settings_heading',
      array(
        'label' => __('Text Logo', 'melissa'),
        'section' => 'font_size_style_section',
        'settings' => 'text_logo_font_settings_heading'
      )
    )
  );

  // Logo: Font size
  $wp_customize->add_setting(
    'text_logo_font_size',
    array(
      'default' => 26,
      'sanitize_callback' => 'melissa_sanitize_number_intval',
    )
  );

  $wp_customize->add_control(
    new melissa_customize_number_control(
      $wp_customize,
      'text_logo_font_size',
      array(
        'label' => __('Logo: Font Size, px (Logo Type: Text)', 'melissa'),
        'section' => 'font_size_style_section',
        'settings' => 'text_logo_font_size'
      )
    )
  );

  // Logo: Font style
  $wp_customize->add_setting(
    'text_logo_font_style',
    array(
      'default' => 'bold',
      'sanitize_callback' => 'melissa_sanitize_font_style',
    )
  );

  $wp_customize->add_control(
    'text_logo_font_style',
    array(
      'type' => 'select',
      'label' => __('Logo: Font Style (Logo Type: Text)', 'melissa'),
      'section' => 'font_size_style_section',
      'choices' => $font_styles,
    )
  );

  /**
   * Font Size & Style - Menu
   * -------------------------------------------------------------
   */

  // Menu - Font settings (heading)
  $wp_customize->add_setting(
    'menu_font_settings_heading',
    array(
      'default' => '',
      'sanitize_callback' => 'melissa_sanitize_text_esc_html',
    )
  );

  $wp_customize->add_control(
    new melissa_customize_heading_control(
      $wp_customize,
      'menu_font_settings_heading',
      array(
        'label' => __('Menu', 'melissa'),
        'section' => 'font_size_style_section',
        'settings' => 'menu_font_settings_heading'
      )
    )
  );

  // Menu: Font size
  $wp_customize->add_setting(
    'menu_font_size',
    array(
      'default' => 16,
      'sanitize_callback' => 'melissa_sanitize_number_intval',
    )
  );

  $wp_customize->add_control(
    new melissa_customize_number_control(
      $wp_customize,
      'menu_font_size',
      array(
        'label' => __('Menu: Font Size, px', 'melissa'),
        'section' => 'font_size_style_section',
        'settings' => 'menu_font_size'
      )
    )
  );

  // Menu: Font style
  $wp_customize->add_setting(
    'menu_font_style',
    array(
      'default' => 'bold',
      'sanitize_callback' => 'melissa_sanitize_font_style',
    )
  );

  $wp_customize->add_control(
    'menu_font_style',
    array(
      'type' => 'select',
      'label' => __('Menu: Font Style', 'melissa'),
      'section' => 'font_size_style_section',
      'choices' => $font_styles,
    )
  );

  // Submenu: Font size
  $wp_customize->add_setting(
    'submenu_font_size',
    array(
      'default' => 15,
      'sanitize_callback' => 'melissa_sanitize_number_intval',
    )
  );

  $wp_customize->add_control(
    new melissa_customize_number_control(
      $wp_customize,
      'submenu_font_size',
      array(
        'label' => __('Submenu: Font Size, px', 'melissa'),
        'section' => 'font_size_style_section',
        'settings' => 'submenu_font_size'
      )
    )
  );

  // Submenu: Font style
  $wp_customize->add_setting(
    'submenu_font_style',
    array(
      'default' => 'bold',
      'sanitize_callback' => 'melissa_sanitize_font_style',
    )
  );

  $wp_customize->add_control(
    'submenu_font_style',
    array(
      'type' => 'select',
      'label' => __('Submenu: Font Style', 'melissa'),
      'section' => 'font_size_style_section',
      'choices' => $font_styles,
    )
  );

  /**
   * Font Size & Style - Header Custom Text
   * -------------------------------------------------------------
   */

  // Header custom text - Font settings (heading)
  $wp_customize->add_setting(
    'header_custom_text_font_settings_heading',
    array(
      'default' => '',
      'sanitize_callback' => 'melissa_sanitize_text_esc_html',
    )
  );

  $wp_customize->add_control(
    new melissa_customize_heading_control(
      $wp_customize,
      'header_custom_text_font_settings_heading',
      array(
        'label' => __('Header Custom Text', 'melissa'),
        'section' => 'font_size_style_section',
        'settings' => 'header_custom_text_font_settings_heading'
      )
    )
  );

  // Header custom text: Title font size
  $wp_customize->add_setting(
    'header_custom_title_font_size',
    array(
      'default' => 66,
      'sanitize_callback' => 'melissa_sanitize_number_intval',
    )
  );

  $wp_customize->add_control(
    new melissa_customize_number_control(
      $wp_customize,
      'header_custom_title_font_size',
      array(
        'label' => __('Header Custom Text: Title Font Size, px', 'melissa'),
        'section' => 'font_size_style_section',
        'settings' => 'header_custom_title_font_size'
      )
    )
  );

  // Header custom text: Title font style
  $wp_customize->add_setting(
    'header_custom_title_font_style',
    array(
      'default' => 'bold',
      'sanitize_callback' => 'melissa_sanitize_font_style',
    )
  );

  $wp_customize->add_control(
    'header_custom_title_font_style',
    array(
      'type' => 'select',
      'label' => __('Header Custom Text: Title Font Style', 'melissa'),
      'section' => 'font_size_style_section',
      'choices' => $font_styles,
    )
  );

  // Header custom text: Subtitle font size
  $wp_customize->add_setting(
    'header_custom_subtitle_font_size',
    array(
      'default' => 21,
      'sanitize_callback' => 'melissa_sanitize_number_intval',
    )
  );

  $wp_customize->add_control(
    new melissa_customize_number_control(
      $wp_customize,
      'header_custom_subtitle_font_size',
      array(
        'label' => __('Header Custom Text: Subtitle Font Size, px', 'melissa'),
        'section' => 'font_size_style_section',
        'settings' => 'header_custom_subtitle_font_size'
      )
    )
  );

  // Header custom text: Subtitle font style
  $wp_customize->add_setting(
    'header_custom_subtitle_font_style',
    array(
      'default' => 'normal',
      'sanitize_callback' => 'melissa_sanitize_font_style',
    )
  );

  $wp_customize->add_control(
    'header_custom_subtitle_font_style',
    array(
      'type' => 'select',
      'label' => __('Header Custom Text: Subtitle Font Style', 'melissa'),
      'section' => 'font_size_style_section',
      'choices' => $font_styles,
    )
  );

  /**
   * Font Size & Style - Blog Post
   * -------------------------------------------------------------
   */

  // Blog post - Font settings (heading)
  $wp_customize->add_setting(
    'blog_post_font_settings_heading',
    array(
      'default' => '',
      'sanitize_callback' => 'melissa_sanitize_text_esc_html',
    )
  );

  $wp_customize->add_control(
    new melissa_customize_heading_control(
      $wp_customize,
      'blog_post_font_settings_heading',
      array(
        'label' => __('Blog Post', 'melissa'),
        'section' => 'font_size_style_section',
        'settings' => 'blog_post_font_settings_heading'
      )
    )
  );

  // Blog post: Title font size
  $wp_customize->add_setting(
    'blog_post_title_font_size',
    array(
      'default' => 29,
      'sanitize_callback' => 'melissa_sanitize_number_intval',
    )
  );

  $wp_customize->add_control(
    new melissa_customize_number_control(
      $wp_customize,
      'blog_post_title_font_size',
      array(
        'label' => __('Blog Post: Title Font Size, px', 'melissa'),
        'section' => 'font_size_style_section',
        'settings' => 'blog_post_title_font_size'
      )
    )
  );

  // Blog post: Title font style
  $wp_customize->add_setting(
    'blog_post_title_font_style',
    array(
      'default' => 'bold',
      'sanitize_callback' => 'melissa_sanitize_font_style',
    )
  );

  $wp_customize->add_control(
    'blog_post_title_font_style',
    array(
      'type' => 'select',
      'label' => __('Blog Post: Title Font Style', 'melissa'),
      'section' => 'font_size_style_section',
      'choices' => $font_styles,
    )
  );

  // Blog post: Metadata font size
  $wp_customize->add_setting(
    'blog_post_metadata_font_size',
    array(
      'default' => 12,
      'sanitize_callback' => 'melissa_sanitize_number_intval',
    )
  );

  $wp_customize->add_control(
    new melissa_customize_number_control(
      $wp_customize,
      'blog_post_metadata_font_size',
      array(
        'label' => __('Blog Post: Metadata Font Size, px', 'melissa'),
        'section' => 'font_size_style_section',
        'settings' => 'blog_post_metadata_font_size'
      )
    )
  );

  // Blog post: Metadata font style
  $wp_customize->add_setting(
    'blog_post_metadata_font_style',
    array(
      'default' => 'normal',
      'sanitize_callback' => 'melissa_sanitize_font_style',
    )
  );

  $wp_customize->add_control(
    'blog_post_metadata_font_style',
    array(
      'type' => 'select',
      'label' => __('Blog Post: Metadata Font Style', 'melissa'),
      'section' => 'font_size_style_section',
      'choices' => $font_styles,
    )
  );

  // Blog post: Metadata text transform
  $wp_customize->add_setting(
    'blog_post_metadata_transform',
    array(
      'default' => 'uppercase',
      'sanitize_callback' => 'melissa_sanitize_text_transform',
    )
  );

  $wp_customize->add_control(
    'blog_post_metadata_transform',
    array(
      'type' => 'select',
      'label' => __('Blog Post: Metadata Text Transform', 'melissa'),
      'section' => 'font_size_style_section',
      'choices' => $text_transform,
    )
  );

  /**
   * Font Size & Style - Single Page
   * -------------------------------------------------------------
   */

  // Single page - Font settings (heading)
  $wp_customize->add_setting(
    'single_page_font_settings_heading',
    array(
      'default' => '',
      'sanitize_callback' => 'melissa_sanitize_text_esc_html',
    )
  );

  $wp_customize->add_control(
    new melissa_customize_heading_control(
      $wp_customize,
      'single_page_font_settings_heading',
      array(
        'label' => __('Single Page', 'melissa'),
        'section' => 'font_size_style_section',
        'settings' => 'single_page_font_settings_heading'
      )
    )
  );

  // Single page: Metadata font size
  $wp_customize->add_setting(
    'single_metadata_font_size',
    array(
      'default' => 16,
      'sanitize_callback' => 'melissa_sanitize_number_intval',
    )
  );

  $wp_customize->add_control(
    new melissa_customize_number_control(
      $wp_customize,
      'single_metadata_font_size',
      array(
        'label' => __('Single Page: Metadata Font Size, px', 'melissa'),
        'section' => 'font_size_style_section',
        'settings' => 'single_metadata_font_size'
      )
    )
  );

  // Single page: Metadata font style
  $wp_customize->add_setting(
    'single_metadata_font_style',
    array(
      'default' => 'normal',
      'sanitize_callback' => 'melissa_sanitize_font_style',
    )
  );

  $wp_customize->add_control(
    'single_metadata_font_style',
    array(
      'type' => 'select',
      'label' => __('Single Page: Metadata Font Style', 'melissa'),
      'section' => 'font_size_style_section',
      'choices' => $font_styles,
    )
  );

  // Single page: Metadata text transform
  $wp_customize->add_setting(
    'single_metadata_transform',
    array(
      'default' => 'none',
      'sanitize_callback' => 'melissa_sanitize_text_transform',
    )
  );

  $wp_customize->add_control(
    'single_metadata_transform',
    array(
      'type' => 'select',
      'label' => __('Single Page: Metadata Text Transform', 'melissa'),
      'section' => 'font_size_style_section',
      'choices' => $text_transform
    )
  );

  /**
   * Font Size & Style - Sidebar and Widgets
   * -------------------------------------------------------------
   */

  // Sidebar and Widgets - Font settings (heading)
  $wp_customize->add_setting(
    'sidebar_font_settings_heading',
    array(
      'default' => '',
      'sanitize_callback' => 'melissa_sanitize_text_esc_html',
    )
  );

  $wp_customize->add_control(
    new melissa_customize_heading_control(
      $wp_customize,
      'sidebar_font_settings_heading',
      array(
        'label' => __('Sidebar & Widgets', 'melissa'),
        'section' => 'font_size_style_section',
        'settings' => 'sidebar_font_settings_heading'
      )
    )
  );

  // Widget title font size
  $wp_customize->add_setting(
    'sidebar_widget_title_font_size',
    array(
      'default' => 22,
      'sanitize_callback' => 'melissa_sanitize_number_intval',
    )
  );

  $wp_customize->add_control(
    new melissa_customize_number_control(
      $wp_customize,
      'sidebar_widget_title_font_size',
      array(
        'label' => __('Widget Title Font Size, px', 'melissa'),
        'section' => 'font_size_style_section',
        'settings' => 'sidebar_widget_title_font_size'
      )
    )
  );

  // Widget title font style
  $wp_customize->add_setting(
    'sidebar_widget_title_font_style',
    array(
      'default' => 'bold',
      'sanitize_callback' => 'melissa_sanitize_font_style',
    )
  );

  $wp_customize->add_control(
    'sidebar_widget_title_font_style',
    array(
      'type' => 'select',
      'label' => __('Widget Title Font Style', 'melissa'),
      'section' => 'font_size_style_section',
      'choices' => $font_styles,
    )
  );

  // Widget: Post title font size
  $wp_customize->add_setting(
    'sidebar_post_title_font_size',
    array(
      'default' => 17,
      'sanitize_callback' => 'melissa_sanitize_number_intval',
    )
  );

  $wp_customize->add_control(
    new melissa_customize_number_control(
      $wp_customize,
      'sidebar_post_title_font_size',
      array(
        'label' => __('Widget: Post Title Font Size, px', 'melissa'),
        'section' => 'font_size_style_section',
        'settings' => 'sidebar_post_title_font_size'
      )
    )
  );

  // Widget: Post title font style
  $wp_customize->add_setting(
    'sidebar_post_title_font_style',
    array(
      'default' => 'bold',
      'sanitize_callback' => 'melissa_sanitize_font_style',
    )
  );

  $wp_customize->add_control(
    'sidebar_post_title_font_style',
    array(
      'type' => 'select',
      'label' => __('Widget: Post Title Font Style', 'melissa'),
      'section' => 'font_size_style_section',
      'choices' => $font_styles,
    )
  );

  // Widget: Metadata font size
  $wp_customize->add_setting(
    'sidebar_metadata_font_size',
    array(
      'default' => 12,
      'sanitize_callback' => 'melissa_sanitize_number_intval',
    )
  );

  $wp_customize->add_control(
    new melissa_customize_number_control(
      $wp_customize,
      'sidebar_metadata_font_size',
      array(
        'label' => __('Widget: Metadata Font Size, px', 'melissa'),
        'section' => 'font_size_style_section',
        'settings' => 'sidebar_metadata_font_size'
      )
    )
  );

  // Widget: Metadata font style
  $wp_customize->add_setting(
    'sidebar_metadata_font_style',
    array(
      'default' => 'normal',
      'sanitize_callback' => 'melissa_sanitize_font_style',
    )
  );

  $wp_customize->add_control(
    'sidebar_metadata_font_style',
    array(
      'type' => 'select',
      'label' => __('Widget: Metadata Font Style', 'melissa'),
      'section' => 'font_size_style_section',
      'choices' => $font_styles,
    )
  );

  // Widget: Metadata text transform
  $wp_customize->add_setting(
    'sidebar_metadata_transform',
    array(
      'default' => 'none',
      'sanitize_callback' => 'melissa_sanitize_text_transform',
    )
  );

  $wp_customize->add_control(
    'sidebar_metadata_transform',
    array(
      'type' => 'select',
      'label' => __('Widget: Metadata Text Transform', 'melissa'),
      'section' => 'font_size_style_section',
      'choices' => $text_transform
    )
  );


  /**
   * 6.0 Colors
   * -------------------------------------------------------------
   */

  // Main color
  $wp_customize->add_setting(
    'theme_main_color',
    array(
      'default' => '#5275bf',
      'sanitize_callback' => 'sanitize_hex_color',
    )
  );

  $wp_customize->add_control(
    new WP_Customize_Color_Control(
      $wp_customize,
      'theme_main_color',
      array(
        'label' => __('Main Color', 'melissa'),
        'section' => 'colors',
        'settings' => 'theme_main_color',
      )
    )
  );

  /**
   * Colors - Header
   * -------------------------------------------------------------
   */

  // Colors - Header (heading)
  $wp_customize->add_setting(
    'colors_header_bg_color_heading',
    array(
      'default' => '',
      'sanitize_callback' => 'melissa_sanitize_text_esc_html',
    )
  );

  $wp_customize->add_control(
    new melissa_customize_heading_control(
      $wp_customize,
      'colors_header_bg_color_heading',
      array(
        'label' => __('Header', 'melissa'),
        'section' => 'colors',
        'settings' => 'colors_header_bg_color_heading'
      )
    )
  );

  // Header background color
  $wp_customize->add_setting(
    'header_bg_color',
    array(
      'default' => '#2e3340',
      'sanitize_callback' => 'sanitize_hex_color',
    )
  );

  $wp_customize->add_control(
    new WP_Customize_Color_Control(
      $wp_customize,
      'header_bg_color',
      array(
        'label' => __('Header Background Color', 'melissa'),
        'section' => 'colors',
        'settings' => 'header_bg_color',
      )
    )
  );

  // Header background transparency
  $wp_customize->add_setting(
    'header_bg_transparency',
    array(
      'default' => 9,
      'sanitize_callback' => 'melissa_sanitize_transparency_intval',
    )
  );

  $wp_customize->add_control(
    new melissa_customize_rgb_alpha_control(
      $wp_customize,
      'header_bg_transparency',
      array(
        'label' => __('Header Background Transparency (1..9)', 'melissa'),
        'section' => 'colors',
        'settings' => 'header_bg_transparency'
      )
    )
  );

  /**
   * Colors - Logo color
   * -------------------------------------------------------------
   */

  // Colors - Logo color (heading)
  $wp_customize->add_setting(
    'colors_logo_color_heading',
    array(
      'default' => '',
      'sanitize_callback' => 'melissa_sanitize_text_esc_html',
    )
  );

  $wp_customize->add_control(
    new melissa_customize_heading_control(
      $wp_customize,
      'colors_logo_color_heading',
      array(
        'label' => __('Text Logo', 'melissa'),
        'section' => 'colors',
        'settings' => 'colors_logo_color_heading'
      )
    )
  );

  // Logo color
  $wp_customize->add_setting(
    'logo_color',
    array(
      'default' => '#ffffff',
      'sanitize_callback' => 'sanitize_hex_color',
    )
  );

  $wp_customize->add_control(
    new WP_Customize_Color_Control(
      $wp_customize,
      'logo_color',
      array(
        'label' => __('Logo Color', 'melissa'),
        'section' => 'colors',
        'settings' => 'logo_color',
      )
    )
  );

  /**
   * Colors - Menu color
   * -------------------------------------------------------------
   */

  // Colors - Menu color (heading)
  $wp_customize->add_setting(
    'colors_menu_color_heading',
    array(
      'default' => '',
      'sanitize_callback' => 'melissa_sanitize_text_esc_html',
    )
  );

  $wp_customize->add_control(
    new melissa_customize_heading_control(
      $wp_customize,
      'colors_menu_color_heading',
      array(
        'label' => __('Menu', 'melissa'),
        'section' => 'colors',
        'settings' => 'colors_menu_color_heading'
      )
    )
  );

  // Menu link color
  $wp_customize->add_setting(
    'menu_link_color',
    array(
      'default' => '#c1c4cc',
      'sanitize_callback' => 'sanitize_hex_color',
    )
  );

  $wp_customize->add_control(
    new WP_Customize_Color_Control(
      $wp_customize,
      'menu_link_color',
      array(
        'label' => __('Menu Link Color', 'melissa'),
        'section' => 'colors',
        'settings' => 'menu_link_color',
      )
    )
  );

  // Menu hover link color
  $wp_customize->add_setting(
    'menu_hover_link_color',
    array(
      'default' => '#ffffff',
      'sanitize_callback' => 'sanitize_hex_color',
    )
  );

  $wp_customize->add_control(
    new WP_Customize_Color_Control(
      $wp_customize,
      'menu_hover_link_color',
      array(
        'label' => __('Menu Hover Link Color', 'melissa'),
        'section' => 'colors',
        'settings' => 'menu_hover_link_color',
      )
    )
  );

  // Submenu background color
  $wp_customize->add_setting(
    'submenu_bg_color',
    array(
      'default' => '#ffffff',
      'sanitize_callback' => 'sanitize_hex_color',
    )
  );

  $wp_customize->add_control(
    new WP_Customize_Color_Control(
      $wp_customize,
      'submenu_bg_color',
      array(
        'label' => __('Submenu Background Color', 'melissa'),
        'section' => 'colors',
        'settings' => 'submenu_bg_color',
      )
    )
  );

  // Submenu link color
  $wp_customize->add_setting(
    'submenu_link_color',
    array(
      'default' => '#3f434c',
      'sanitize_callback' => 'sanitize_hex_color',
    )
  );

  $wp_customize->add_control(
    new WP_Customize_Color_Control(
      $wp_customize,
      'submenu_link_color',
      array(
        'label' => __('Submenu Link Color', 'melissa'),
        'section' => 'colors',
        'settings' => 'submenu_link_color',
      )
    )
  );

  // Submenu hover link color
  $wp_customize->add_setting(
    'submenu_hover_link_color',
    array(
      'default' => '#5275bf',
      'sanitize_callback' => 'sanitize_hex_color',
    )
  );

  $wp_customize->add_control(
    new WP_Customize_Color_Control(
      $wp_customize,
      'submenu_hover_link_color',
      array(
        'label' => __('Submenu Hover Link Color', 'melissa'),
        'section' => 'colors',
        'settings' => 'submenu_hover_link_color',
      )
    )
  );

  // Mobile menu border color
  $wp_customize->add_setting(
    'mobile_menu_border_color',
    array(
      'default' => '#eaebec',
      'sanitize_callback' => 'sanitize_hex_color',
    )
  );

  $wp_customize->add_control(
    new WP_Customize_Color_Control(
      $wp_customize,
      'mobile_menu_border_color',
      array(
        'label' => __('Mobile Menu Border Color', 'melissa'),
        'section' => 'colors',
        'settings' => 'mobile_menu_border_color',
      )
    )
  );

  /**
   * Colors - Dropdown search form
   * -------------------------------------------------------------
   */

  // Colors - Dropdown search form (heading)
  $wp_customize->add_setting(
    'colors_dropdown_search_heading',
    array(
      'default' => '',
      'sanitize_callback' => 'melissa_sanitize_text_esc_html',
    )
  );

  $wp_customize->add_control(
    new melissa_customize_heading_control(
      $wp_customize,
      'colors_dropdown_search_heading',
      array(
        'label' => __('Dropdown Search Form', 'melissa'),
        'section' => 'colors',
        'settings' => 'colors_dropdown_search_heading'
      )
    )
  );

  // Search icon color
  $wp_customize->add_setting(
    'dropdown_search_icon_color',
    array(
      'default' => '#c1c4cc',
      'sanitize_callback' => 'sanitize_hex_color',
    )
  );

  $wp_customize->add_control(
    new WP_Customize_Color_Control(
      $wp_customize,
      'dropdown_search_icon_color',
      array(
        'label' => __('Search Icon Color', 'melissa'),
        'section' => 'colors',
        'settings' => 'dropdown_search_icon_color',
      )
    )
  );

  // Search icon hover color
  $wp_customize->add_setting(
    'dropdown_search_icon_hover_color',
    array(
      'default' => '#ffffff',
      'sanitize_callback' => 'sanitize_hex_color',
    )
  );

  $wp_customize->add_control(
    new WP_Customize_Color_Control(
      $wp_customize,
      'dropdown_search_icon_hover_color',
      array(
        'label' => __('Search Icon Hover Color', 'melissa'),
        'section' => 'colors',
        'settings' => 'dropdown_search_icon_hover_color',
      )
    )
  );

  // Search form background color
  $wp_customize->add_setting(
    'dropdown_search_bg_color',
    array(
      'default' => '#ffffff',
      'sanitize_callback' => 'sanitize_hex_color',
    )
  );

  $wp_customize->add_control(
    new WP_Customize_Color_Control(
      $wp_customize,
      'dropdown_search_bg_color',
      array(
        'label' => __('Search Form Background Color', 'melissa'),
        'section' => 'colors',
        'settings' => 'dropdown_search_bg_color',
      )
    )
  );

  // Search form text color 1
  $wp_customize->add_setting(
    'dropdown_search_text_color_1',
    array(
      'default' => '#a9aeba',
      'sanitize_callback' => 'sanitize_hex_color',
    )
  );

  $wp_customize->add_control(
    new WP_Customize_Color_Control(
      $wp_customize,
      'dropdown_search_text_color_1',
      array(
        'label' => __('Search Form: Text Color 1', 'melissa'),
        'section' => 'colors',
        'settings' => 'dropdown_search_text_color_1',
      )
    )
  );

  // Search form text color 2
  $wp_customize->add_setting(
    'dropdown_search_text_color_2',
    array(
      'default' => '#3f434c',
      'sanitize_callback' => 'sanitize_hex_color',
    )
  );

  $wp_customize->add_control(
    new WP_Customize_Color_Control(
      $wp_customize,
      'dropdown_search_text_color_2',
      array(
        'label' => __('Search Form: Text Color 2', 'melissa'),
        'section' => 'colors',
        'settings' => 'dropdown_search_text_color_2',
      )
    )
  );

  // Search form hover text color
  $wp_customize->add_setting(
    'dropdown_search_hover_text_color',
    array(
      'default' => '#5275bf',
      'sanitize_callback' => 'sanitize_hex_color',
    )
  );

  $wp_customize->add_control(
    new WP_Customize_Color_Control(
      $wp_customize,
      'dropdown_search_hover_text_color',
      array(
        'label' => __('Search Form: Hover Text Color', 'melissa'),
        'section' => 'colors',
        'settings' => 'dropdown_search_hover_text_color',
      )
    )
  );

  // Search form border color
  $wp_customize->add_setting(
    'dropdown_search_border_color',
    array(
      'default' => '#eaebec',
      'sanitize_callback' => 'sanitize_hex_color',
    )
  );

  $wp_customize->add_control(
    new WP_Customize_Color_Control(
      $wp_customize,
      'dropdown_search_border_color',
      array(
        'label' => __('Search Form Border Color', 'melissa'),
        'section' => 'colors',
        'settings' => 'dropdown_search_border_color',
      )
    )
  );

  /**
   * Colors - Header content
   * -------------------------------------------------------------
   */

  // Colors - Header content (heading)
  $wp_customize->add_setting(
    'colors_header_content_heading',
    array(
      'default' => '',
      'sanitize_callback' => 'melissa_sanitize_text_esc_html',
    )
  );

  $wp_customize->add_control(
    new melissa_customize_heading_control(
      $wp_customize,
      'colors_header_content_heading',
      array(
        'label' => __('Header Content', 'melissa'),
        'section' => 'colors',
        'settings' => 'colors_header_content_heading'
      )
    )
  );

  // Title color
  $wp_customize->add_setting(
    'header_content_title_color',
    array(
      'default' => '#ffffff',
      'sanitize_callback' => 'sanitize_hex_color',
    )
  );

  $wp_customize->add_control(
    new WP_Customize_Color_Control(
      $wp_customize,
      'header_content_title_color',
      array(
        'label' => __('Title Color', 'melissa'),
        'section' => 'colors',
        'settings' => 'header_content_title_color',
      )
    )
  );

  // Subtitle color
  $wp_customize->add_setting(
    'header_content_subtitle_color',
    array(
      'default' => '#c1c4cc',
      'sanitize_callback' => 'sanitize_hex_color',
    )
  );

  $wp_customize->add_control(
    new WP_Customize_Color_Control(
      $wp_customize,
      'header_content_subtitle_color',
      array(
        'label' => __('Subtitle Color', 'melissa'),
        'section' => 'colors',
        'settings' => 'header_content_subtitle_color',
      )
    )
  );

  // Subtitle link color
  $wp_customize->add_setting(
    'header_content_subtitle_link_color',
    array(
      'default' => '#c1c4cc',
      'sanitize_callback' => 'sanitize_hex_color',
    )
  );

  $wp_customize->add_control(
    new WP_Customize_Color_Control(
      $wp_customize,
      'header_content_subtitle_link_color',
      array(
        'label' => __('Subtitle Link Color', 'melissa'),
        'section' => 'colors',
        'settings' => 'header_content_subtitle_link_color',
      )
    )
  );

  // Subtitle hover link color
  $wp_customize->add_setting(
    'header_content_subtitle_hover_link_color',
    array(
      'default' => '#ffffff',
      'sanitize_callback' => 'sanitize_hex_color',
    )
  );

  $wp_customize->add_control(
    new WP_Customize_Color_Control(
      $wp_customize,
      'header_content_subtitle_hover_link_color',
      array(
        'label' => __('Subtitle Hover Link Color', 'melissa'),
        'section' => 'colors',
        'settings' => 'header_content_subtitle_hover_link_color',
      )
    )
  );

  // Bottom line background color
  $wp_customize->add_setting(
    'header_content_line_bg',
    array(
      'default' => '#ffffff',
      'sanitize_callback' => 'sanitize_hex_color',
    )
  );

  $wp_customize->add_control(
    new WP_Customize_Color_Control(
      $wp_customize,
      'header_content_line_bg',
      array(
        'label' => __('Bottom Line Background Color', 'melissa'),
        'section' => 'colors',
        'settings' => 'header_content_line_bg',
      )
    )
  );

  /**
   * Colors - Sticky menu
   * -------------------------------------------------------------
   */

  // Colors - Sticky menu (heading)
  $wp_customize->add_setting(
    'colors_sticky_menu_heading',
    array(
      'default' => '',
      'sanitize_callback' => 'melissa_sanitize_text_esc_html',
    )
  );

  $wp_customize->add_control(
    new melissa_customize_heading_control(
      $wp_customize,
      'colors_sticky_menu_heading',
      array(
        'label' => __('Sticky Menu', 'melissa'),
        'section' => 'colors',
        'settings' => 'colors_sticky_menu_heading'
      )
    )
  );

  // Sticky menu background color
  $wp_customize->add_setting(
    'sticky_menu_bg',
    array(
      'default' => '#2e3340',
      'sanitize_callback' => 'sanitize_hex_color',
    )
  );

  $wp_customize->add_control(
    new WP_Customize_Color_Control(
      $wp_customize,
      'sticky_menu_bg',
      array(
        'label' => __('Sticky Menu Background Color', 'melissa'),
        'section' => 'colors',
        'settings' => 'sticky_menu_bg',
      )
    )
  );

  // Sticky menu link color
  $wp_customize->add_setting(
    'sticky_menu_link_color',
    array(
      'default' => '#c1c4cc',
      'sanitize_callback' => 'sanitize_hex_color',
    )
  );

  $wp_customize->add_control(
    new WP_Customize_Color_Control(
      $wp_customize,
      'sticky_menu_link_color',
      array(
        'label' => __('Sticky Menu Link Color', 'melissa'),
        'section' => 'colors',
        'settings' => 'sticky_menu_link_color',
      )
    )
  );

  // Sticky menu hover link color
  $wp_customize->add_setting(
    'sticky_menu_hover_link_color',
    array(
      'default' => '#ffffff',
      'sanitize_callback' => 'sanitize_hex_color',
    )
  );

  $wp_customize->add_control(
    new WP_Customize_Color_Control(
      $wp_customize,
      'sticky_menu_hover_link_color',
      array(
        'label' => __('Sticky Menu Hover Link Color', 'melissa'),
        'section' => 'colors',
        'settings' => 'sticky_menu_hover_link_color',
      )
    )
  );

  /**
   * Colors - Content
   * -------------------------------------------------------------
   */

  // Colors - Content (heading)
  $wp_customize->add_setting(
    'colors_main_content_heading',
    array(
      'default' => '',
      'sanitize_callback' => 'melissa_sanitize_text_esc_html',
    )
  );

  $wp_customize->add_control(
    new melissa_customize_heading_control(
      $wp_customize,
      'colors_main_content_heading',
      array(
        'label' => __('Content', 'melissa'),
        'section' => 'colors',
        'settings' => 'colors_main_content_heading'
      )
    )
  );

  // Content background color
  $wp_customize->add_setting(
    'main_content_bg_color',
    array(
      'default' => '#ffffff',
      'sanitize_callback' => 'sanitize_hex_color',
    )
  );

  $wp_customize->add_control(
    new WP_Customize_Color_Control(
      $wp_customize,
      'main_content_bg_color',
      array(
        'label' => __('Content Background Color', 'melissa'),
        'section' => 'colors',
        'settings' => 'main_content_bg_color',
      )
    )
  );

  // Content color 1
  $wp_customize->add_setting(
    'main_content_color_1',
    array(
      'default' => '#2c2f36',
      'sanitize_callback' => 'sanitize_hex_color',
    )
  );

  $wp_customize->add_control(
    new WP_Customize_Color_Control(
      $wp_customize,
      'main_content_color_1',
      array(
        'label' => __('Text Color 1', 'melissa'),
        'section' => 'colors',
        'settings' => 'main_content_color_1',
      )
    )
  );

  // Content color 2
  $wp_customize->add_setting(
    'main_content_color_2',
    array(
      'default' => '#3f434c',
      'sanitize_callback' => 'sanitize_hex_color',
    )
  );

  $wp_customize->add_control(
    new WP_Customize_Color_Control(
      $wp_customize,
      'main_content_color_2',
      array(
        'label' => __('Text Color 2', 'melissa'),
        'section' => 'colors',
        'settings' => 'main_content_color_2',
      )
    )
  );

  // Content color 3
  $wp_customize->add_setting(
    'main_content_color_3',
    array(
      'default' => '#a9aeba',
      'sanitize_callback' => 'sanitize_hex_color',
    )
  );

  $wp_customize->add_control(
    new WP_Customize_Color_Control(
      $wp_customize,
      'main_content_color_3',
      array(
        'label' => __('Text Color 3', 'melissa'),
        'section' => 'colors',
        'settings' => 'main_content_color_3',
      )
    )
  );

  // Link color
  $wp_customize->add_setting(
    'main_content_link_color',
    array(
      'default' => '#5275bf',
      'sanitize_callback' => 'sanitize_hex_color',
    )
  );

  $wp_customize->add_control(
    new WP_Customize_Color_Control(
      $wp_customize,
      'main_content_link_color',
      array(
        'label' => __('Link Color', 'melissa'),
        'section' => 'colors',
        'settings' => 'main_content_link_color',
      )
    )
  );

  // Hover link color
  $wp_customize->add_setting(
    'main_content_hover_link_color',
    array(
      'default' => '#5275bf',
      'sanitize_callback' => 'sanitize_hex_color',
    )
  );

  $wp_customize->add_control(
    new WP_Customize_Color_Control(
      $wp_customize,
      'main_content_hover_link_color',
      array(
        'label' => __('Hover Link Color', 'melissa'),
        'section' => 'colors',
        'settings' => 'main_content_hover_link_color',
      )
    )
  );

  // Line color
  $wp_customize->add_setting(
    'main_content_line_color',
    array(
      'default' => '#eaebec',
      'sanitize_callback' => 'sanitize_hex_color',
    )
  );

  $wp_customize->add_control(
    new WP_Customize_Color_Control(
      $wp_customize,
      'main_content_line_color',
      array(
        'label' => __('Line Color', 'melissa'),
        'section' => 'colors',
        'settings' => 'main_content_line_color',
      )
    )
  );

  // Featured media: Hover background color
  $wp_customize->add_setting(
    'main_content_featured_media_hover_bg',
    array(
      'default' => '#2e3340',
      'sanitize_callback' => 'sanitize_hex_color',
    )
  );

  $wp_customize->add_control(
    new WP_Customize_Color_Control(
      $wp_customize,
      'main_content_featured_media_hover_bg',
      array(
        'label' => __('Featured Media: Hover Background Color', 'melissa'),
        'section' => 'colors',
        'settings' => 'main_content_featured_media_hover_bg',
      )
    )
  );

  /**
   * Colors - Footer Widgets
   * -------------------------------------------------------------
   */

  // Colors - Footer widgets (heading)
  $wp_customize->add_setting(
    'colors_footer_widgets_heading',
    array(
      'default' => '',
      'sanitize_callback' => 'melissa_sanitize_text_esc_html',
    )
  );

  $wp_customize->add_control(
    new melissa_customize_heading_control(
      $wp_customize,
      'colors_footer_widgets_heading',
      array(
        'label' => __('Footer Widgets', 'melissa'),
        'section' => 'colors',
        'settings' => 'colors_footer_widgets_heading'
      )
    )
  );

  // Footer widgets section: Background color
  $wp_customize->add_setting(
    'footer_widgets_section_bg_color',
    array(
      'default' => '#ffffff',
      'sanitize_callback' => 'sanitize_hex_color',
    )
  );

  $wp_customize->add_control(
    new WP_Customize_Color_Control(
      $wp_customize,
      'footer_widgets_section_bg_color',
      array(
        'label' => __('Footer Widgets Section: Background Color', 'melissa'),
        'section' => 'colors',
        'settings' => 'footer_widgets_section_bg_color',
      )
    )
  );

  // Footer widgets: Text color 1
  $wp_customize->add_setting(
    'footer_widgets_text_color_1',
    array(
      'default' => '#2c2f36',
      'sanitize_callback' => 'sanitize_hex_color',
    )
  );

  $wp_customize->add_control(
    new WP_Customize_Color_Control(
      $wp_customize,
      'footer_widgets_text_color_1',
      array(
        'label' => __('Footer Widgets: Text Color 1', 'melissa'),
        'section' => 'colors',
        'settings' => 'footer_widgets_text_color_1',
      )
    )
  );

  // Footer widgets: Text color 2
  $wp_customize->add_setting(
    'footer_widgets_text_color_2',
    array(
      'default' => '#3f434c',
      'sanitize_callback' => 'sanitize_hex_color',
    )
  );

  $wp_customize->add_control(
    new WP_Customize_Color_Control(
      $wp_customize,
      'footer_widgets_text_color_2',
      array(
        'label' => __('Footer Widgets: Text Color 2', 'melissa'),
        'section' => 'colors',
        'settings' => 'footer_widgets_text_color_2',
      )
    )
  );

  // Footer widgets: Text color 3
  $wp_customize->add_setting(
    'footer_widgets_text_color_3',
    array(
      'default' => '#a9aeba',
      'sanitize_callback' => 'sanitize_hex_color',
    )
  );

  $wp_customize->add_control(
    new WP_Customize_Color_Control(
      $wp_customize,
      'footer_widgets_text_color_3',
      array(
        'label' => __('Footer Widgets: Text Color 3', 'melissa'),
        'section' => 'colors',
        'settings' => 'footer_widgets_text_color_3',
      )
    )
  );

  // Footer widgets: Hover color
  $wp_customize->add_setting(
    'footer_widgets_hover_color',
    array(
      'default' => '#5275bf',
      'sanitize_callback' => 'sanitize_hex_color',
    )
  );

  $wp_customize->add_control(
    new WP_Customize_Color_Control(
      $wp_customize,
      'footer_widgets_hover_color',
      array(
        'label' => __('Footer Widgets: Hover Color', 'melissa'),
        'section' => 'colors',
        'settings' => 'footer_widgets_hover_color',
      )
    )
  );

  // Footer widgets: Line color
  $wp_customize->add_setting(
    'footer_widgets_line_color',
    array(
      'default' => '#eaebec',
      'sanitize_callback' => 'sanitize_hex_color',
    )
  );

  $wp_customize->add_control(
    new WP_Customize_Color_Control(
      $wp_customize,
      'footer_widgets_line_color',
      array(
        'label' => __('Footer Widgets: Line Color', 'melissa'),
        'section' => 'colors',
        'settings' => 'footer_widgets_line_color',
      )
    )
  );

  // Footer widgets: Thumbnail hover background color
  $wp_customize->add_setting(
    'footer_widgets_thumbnail_hover_bg',
    array(
      'default' => '#2e3340',
      'sanitize_callback' => 'sanitize_hex_color',
    )
  );

  $wp_customize->add_control(
    new WP_Customize_Color_Control(
      $wp_customize,
      'footer_widgets_thumbnail_hover_bg',
      array(
        'label' => __('Footer Widgets: Thumbnail Hover Background Color', 'melissa'),
        'section' => 'colors',
        'settings' => 'footer_widgets_thumbnail_hover_bg',
      )
    )
  );

  /**
   * Colors - Footer
   * -------------------------------------------------------------
   */

  // Colors - Footer (heading)
  $wp_customize->add_setting(
    'colors_footer_heading',
    array(
      'default' => '',
      'sanitize_callback' => 'melissa_sanitize_text_esc_html',
    )
  );

  $wp_customize->add_control(
    new melissa_customize_heading_control(
      $wp_customize,
      'colors_footer_heading',
      array(
        'label' => __('Footer', 'melissa'),
        'section' => 'colors',
        'settings' => 'colors_footer_heading'
      )
    )
  );

  // Footer background color
  $wp_customize->add_setting(
    'footer_bg_color',
    array(
      'default' => '#ffffff',
      'sanitize_callback' => 'sanitize_hex_color',
    )
  );

  $wp_customize->add_control(
    new WP_Customize_Color_Control(
      $wp_customize,
      'footer_bg_color',
      array(
        'label' => __('Footer Background Color', 'melissa'),
        'section' => 'colors',
        'settings' => 'footer_bg_color',
      )
    )
  );

  // Footer text color
  $wp_customize->add_setting(
    'footer_text_color',
    array(
      'default' => '#3f434c',
      'sanitize_callback' => 'sanitize_hex_color',
    )
  );

  $wp_customize->add_control(
    new WP_Customize_Color_Control(
      $wp_customize,
      'footer_text_color',
      array(
        'label' => __('Footer Text Color', 'melissa'),
        'section' => 'colors',
        'settings' => 'footer_text_color',
      )
    )
  );

  // Footer link color
  $wp_customize->add_setting(
    'footer_link_color',
    array(
      'default' => '#3f434c',
      'sanitize_callback' => 'sanitize_hex_color',
    )
  );

  $wp_customize->add_control(
    new WP_Customize_Color_Control(
      $wp_customize,
      'footer_link_color',
      array(
        'label' => __('Footer Link Color', 'melissa'),
        'section' => 'colors',
        'settings' => 'footer_link_color',
      )
    )
  );

  // Footer hover link color
  $wp_customize->add_setting(
    'footer_hover_link_color',
    array(
      'default' => '#5275bf',
      'sanitize_callback' => 'sanitize_hex_color',
    )
  );

  $wp_customize->add_control(
    new WP_Customize_Color_Control(
      $wp_customize,
      'footer_hover_link_color',
      array(
        'label' => __('Footer Hover Link Color', 'melissa'),
        'section' => 'colors',
        'settings' => 'footer_hover_link_color',
      )
    )
  );

  // Social icon color
  $wp_customize->add_setting(
    'footer_social_icon_color',
    array(
      'default' => '#3f434c',
      'sanitize_callback' => 'sanitize_hex_color',
    )
  );

  $wp_customize->add_control(
    new WP_Customize_Color_Control(
      $wp_customize,
      'footer_social_icon_color',
      array(
        'label' => __('Social Icon Color', 'melissa'),
        'section' => 'colors',
        'settings' => 'footer_social_icon_color',
      )
    )
  );

  // Social icon hover color
  $wp_customize->add_setting(
    'footer_social_icon_hover_color',
    array(
      'default' => '#5275bf',
      'sanitize_callback' => 'sanitize_hex_color',
    )
  );

  $wp_customize->add_control(
    new WP_Customize_Color_Control(
      $wp_customize,
      'footer_social_icon_hover_color',
      array(
        'label' => __('Social Icon Hover Color', 'melissa'),
        'section' => 'colors',
        'settings' => 'footer_social_icon_hover_color',
      )
    )
  );


  /**
   * 7.0 Header Video
   * -------------------------------------------------------------
   */

  $wp_customize->add_section(
    'header_video_section',
    array(
      'title' => __('Header Video', 'melissa'),
      'priority' => 61,
    )
  );

  // Video settings - Description
  $wp_customize->add_setting(
    'header_video_settings_desc',
    array(
      'default' => __('<b>Important!</b> For video settings the following options must be set to: <b>General Settings</b> > <b>Header Type</b> > <b>Header with animation</b> and <b>General Settings</b> > <b>Header Background Type</b> > <b>Video</b>.', 'melissa'),
      'sanitize_callback' => 'melissa_sanitize_wp_kses_b_br',
    )
  );

  $wp_customize->add_control(
    new melissa_customize_text_description_control(
      $wp_customize,
      'header_video_settings_desc',
      array(
        'label' => __('Video Settings - Description', 'melissa'),
        'section' => 'header_video_section',
        'settings' => 'header_video_settings_desc'
      )
    )
  );

  // Video type
  $wp_customize->add_setting(
    'header_video_bg_type',
    array(
      'default' => 'youtube',
      'sanitize_callback' => 'melissa_sanitize_header_video_type',
    )
  );

  $wp_customize->add_control(
    'header_video_bg_type',
    array(
      'type' => 'select',
      'label' => __('Video Type', 'melissa'),
      'section' => 'header_video_section',
      'choices' => array(
        'youtube' => __('YouTube', 'melissa'),
        'vimeo' => __('Vimeo', 'melissa'),
      ),
    )
  );

  // Video ID
  $wp_customize->add_setting(
    'header_video_id',
    array(
      'default' => '',
      'sanitize_callback' => 'melissa_sanitize_text_esc_html',
    )
  );

  $wp_customize->add_control(
    'header_video_id',
    array(
      'label' => __('Video ID', 'melissa'),
      'section' => 'header_video_section',
      'type' => 'text',
    )
  );

  // Image for video
  $wp_customize->add_setting(
    'header_video_image',
    array(
      'default' => '',
      'sanitize_callback' => 'melissa_sanitize_url',
    )
  );
  $wp_customize->add_control(
    new WP_Customize_Image_Control(
      $wp_customize,
      'header_video_image',
      array(
        'label' => __('Image For Your Video', 'melissa'),
        'section' => 'header_video_section',
        'settings' => 'header_video_image'
      )
    )
  );

  // Video start time
  $wp_customize->add_setting(
    'header_video_start_time',
    array(
      'default' => '',
      'sanitize_callback' => 'melissa_sanitize_text_esc_html',
    )
  );

  $wp_customize->add_control(
    'header_video_start_time',
    array(
      'label' => __('Video Start Time, sec. (Example: 00:05)', 'melissa'),
      'section' => 'header_video_section',
      'type' => 'text',
    )
  );

  // Video end time
  $wp_customize->add_setting(
    'header_video_end_time',
    array(
      'default' => '',
      'sanitize_callback' => 'melissa_sanitize_text_esc_html',
    )
  );

  $wp_customize->add_control(
    'header_video_end_time',
    array(
      'label' => __('Video End Time, sec. (Example: 01:25)', 'melissa'),
      'section' => 'header_video_section',
      'type' => 'text',
    )
  );

  // Video aspect ratio
  $wp_customize->add_setting(
    'header_video_aspect_ratio',
    array(
      'default' => '4_3',
      'sanitize_callback' => 'melissa_sanitize_header_video_aspect_ratio',
    )
  );

  $wp_customize->add_control(
    'header_video_aspect_ratio',
    array(
      'type' => 'select',
      'label' => __('Video Aspect Ratio', 'melissa'),
      'section' => 'header_video_section',
      'choices' => array(
        '4_3' => __('4:3', 'melissa'),
        '16_9' => __('16:9', 'melissa'),
      ),
    )
  );

  // Video volume (0..100)
  $wp_customize->add_setting(
    'header_video_volume',
    array(
      'default' => 0,
      'sanitize_callback' => 'melissa_sanitize_video_volume_intval',
    )
  );

  $wp_customize->add_control(
    new melissa_customize_video_volume_control(
      $wp_customize,
      'header_video_volume',
      array(
        'label' => __('Video Volume (0..100)', 'melissa'),
        'section' => 'header_video_section',
        'settings' => 'header_video_volume'
      )
    )
  );


  /**
   * 8.0 Custom CSS (for WordPress < 4.7)
   * -------------------------------------------------------------
   */

  $wp_customize->add_section(
    'custom_css_section',
    array(
      'title' => __('Custom CSS', 'melissa'),
      'priority' => 130,
    )
  );

  // Custom CSS code
  $wp_customize->add_setting(
    'custom_css_code',
    array(
      'default' => '',
      'sanitize_callback' => 'melissa_sanitize_custom_css',
    )
  );

  $wp_customize->add_control(
    'custom_css_code',
    array(
      'label' => __('Custom CSS Code', 'melissa'),
      'section' => 'custom_css_section',
      'type' => 'textarea',
    )
  );

}
add_action('customize_register', 'melissa_customize_register');
