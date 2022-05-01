<?php
/**
 * Functions and definitions
 *
 * For more information on hooks, actions, and filters, @link https://codex.wordpress.org/Plugin_API
 *
 * @package WordPress
 * @subpackage Melissa
 * @since Melissa 1.0
 */


/**
 * TGM Plugin Activation
 *
 * @since Melissa 1.0
 */
require_once get_template_directory().'/assets/class-tgm-plugin-activation.php';
require_once get_template_directory().'/assets/plugin-activation.php';


/**
 * Theme meta boxes (Meta Box plugin required)
 *
 * @since Melissa 1.0
 */
require_once get_template_directory().'/assets/theme-meta-boxes.php';


/*
 * Set up the content width value
 *
 * @since Melissa 1.0
 */
if (!isset($content_width)) {
  $content_width = 1040;
}


/**
 * Sets up theme defaults and registers support for various WordPress features
 *
 * @since Melissa 1.0
 */
if (!function_exists('melissa_setup')) {
  function melissa_setup() {

    /*
     * Make theme available for translation.
     * Translations can be filed in the /languages/ directory.
     */
    load_theme_textdomain('melissa', get_template_directory().'/languages');

    // Add default posts and comments RSS feed links to head.
    add_theme_support('automatic-feed-links');

    /*
     * Let WordPress manage the document title.
     * By adding theme support, we declare that this theme does not use a
     * hard-coded <title> tag in the document head, and expect WordPress to
     * provide it for us.
     */
    add_theme_support('title-tag');

    // Register menu
    register_nav_menus(array(
      'melissa_main_menu' => __('Main menu', 'melissa'),
    ));

    /*
     * Switch default core markup for search form, comment form, and comments
     * to output valid HTML5.
     */
    add_theme_support('html5', array(
      'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
    ));

    /*
     * Enable support for Post Formats.
     *
     * See: https://codex.wordpress.org/Post_Formats
     */
    add_theme_support('post-formats', array(
      'aside', 'image', 'video', 'quote', 'link', 'gallery', 'status', 'audio', 'chat'
    ));

    // Enable support for Custom background
    $bg_default = array('default-color' => 'f8f8f8');
    add_theme_support('custom-background', $bg_default);

    // Enable support for Custom logo
    add_theme_support('custom-logo', array(
      'height' => 70,
      'width' => 90,
      'flex-width' => true
    ));

    // Enable support for Custom header
    $header_bg_default = array(
      'width' => 1900,
      'height' => 1100,
      'flex-width' => true,
      'flex-height' => true,
      'header-text' => false
    );
    add_theme_support('custom-header', $header_bg_default);

    // Enable support for Post Thumbnails
    add_theme_support('post-thumbnails');
    set_post_thumbnail_size(150, 150); // default Post Thumbnail dimensions

    // Registers a new image sizes
    add_image_size('melissa-img-706-471', 706, 471); // it is used for "Posts slider widget" and "Posts list widget"
    add_image_size('melissa-img-706-auto', 706, 9999); // it is used for blog posts
    add_image_size('melissa-img-1200-auto', 1200, 9999); // it is used for single pages
  }
}
add_action('after_setup_theme', 'melissa_setup');


/**
 * Show title tag (if WordPress does not support 'title-tag')
 *
 * @since Melissa 1.0
 */
if (!function_exists('_wp_render_title_tag')) {
  function melissa_render_title_tag() {
    ?>
    <title><?php wp_title('|', true, 'right'); ?></title>
    <?php
  }
  add_action('wp_head', 'melissa_render_title_tag');
}


/**
 * Add styles for TinyMCE editor (editor-style.css + font-awesome.css)
 *
 * @since Melissa 1.0
 */
if (!function_exists('melissa_editor_style')) {
  function melissa_editor_style() {

    // add stylesheets
    add_editor_style(array(
      'css/editor-style.css',
      'css/font-awesome.min.css'
    ));

  }
}
add_action('init', 'melissa_editor_style');


/**
 * Google fonts - Register fonts
 *
 * @since Melissa 1.0
 */
if (!function_exists('melissa_google_fonts_url')) {
  function melissa_google_fonts_url() {
    $font_url = '';

    /*
    Translators: If there are characters in your language that are not supported
    by chosen font(s), translate this to 'off'. Do not translate into your own language.
    */
    if ('off' !== _x('on', 'Google fonts: on or off', 'melissa')) {

      // font styles
      $font_styles = '400,400i,700,700i';

      // subset
      $subset = get_theme_mod('fonts_character_sets', 'latin');
      $subset = str_replace(' ', '', $subset);
      if (!$subset) {
        $subset = 'latin';
      }

      // all fonts
      $custom_font_families = array();
      $custom_font_families[] = get_theme_mod('headings_font_family', 'Lato'); // Headings
      $custom_font_families[] = get_theme_mod('content_font_family', 'Lato'); // Content
      $custom_font_families[] = get_theme_mod('metadata_font_family', 'Lato'); // Metadata
      $custom_font_families[] = get_theme_mod('blockquote_font_family', 'Noto Serif'); // Quotes (Blockquote Items)
      $custom_font_families[] = get_theme_mod('text_logo_font_family', 'Lato'); // Logo (Logo Type: Text)
      $custom_font_families[] = get_theme_mod('menu_font_family', 'Lato'); // Menu

      // exceptions (standard fonts)
      $exceptions_font_families = array('Arial', 'Verdana', 'Trebuchet MS', 'Tahoma', 'Palatino', 'Helvetica');

      // remove exceptions
      $clean_custom_font_families = array_diff($custom_font_families, $exceptions_font_families);

      // remove duplicates (unique array)
      $unique_custom_font_families = array_unique($clean_custom_font_families);

      // if $unique_custom_font_families not empty
      if ($unique_custom_font_families) {
        array_walk($unique_custom_font_families, 'melissa_add_font_styles', $font_styles);
        $query_args = array(
          'family' => urlencode(implode('|', $unique_custom_font_families)),
          'subset' => urlencode($subset),
        );
        $font_url = add_query_arg($query_args, 'https://fonts.googleapis.com/css');
      }

    }

    return esc_url_raw($font_url);
  }
}


/**
 * Adds styles for each Google font (Callback function for array_walk());
 * Used in the melissa_google_fonts_url() function.
 *
 * @since Melissa 1.0
 */
if (!function_exists('melissa_add_font_styles')) {
  function melissa_add_font_styles(&$font, $key, $styles) {
    $font = "$font:$styles";
  }
}


/**
 * Enqueue styles
 *
 * @since Melissa 1.0
 */
if (!function_exists('melissa_styles')) {
  function melissa_styles() {

    // header type
    $header_type = get_theme_mod('general_header_type', 'simple-header');

    // google fonts
    wp_enqueue_style('melissa-google-fonts', melissa_google_fonts_url(), array(), '1.1.6');

    // bootstrap
    wp_enqueue_style('bootstrap', get_template_directory_uri().'/css/bootstrap.min.css', array(), '3.3.7');
    wp_enqueue_style('bootstrap-theme', get_template_directory_uri().'/css/bootstrap-theme.min.css', array(), '3.3.7');

    // ie10 viewport bug workaround
    wp_enqueue_style('melissa-ie10-viewport-bug-workaround', get_template_directory_uri().'/css/ie10-viewport-bug-workaround.css', array(), '1.0.0');

    // font awesome
    wp_enqueue_style('font-awesome', get_template_directory_uri().'/css/font-awesome.min.css', array(), '4.7.0');

    // add revolution slider styles only if no plugin installed
    if (!class_exists('RevSliderFront') && $header_type == 'rev-slider-header') {
      // slider revolution - main stylesheet
      wp_enqueue_style('melissa-rs-settings', get_template_directory_uri().'/assets/revolution/css/settings.css', array(), '5.4.8');
      // slider revolution - layers stylesheet
      wp_enqueue_style('melissa-rs-layers', get_template_directory_uri().'/assets/revolution/css/layers.css', array(), '5.4.8');
      // slider revolution - navigation stylesheet
      wp_enqueue_style('melissa-rs-navigation', get_template_directory_uri().'/assets/revolution/css/navigation.css', array(), '5.4.8');
    }

    // owl carousel
    wp_enqueue_style('owl-carousel', get_template_directory_uri().'/assets/owl-carousel/owl.carousel.css', array(), '1.3.3');
    wp_enqueue_style('owl-theme', get_template_directory_uri().'/assets/owl-carousel/owl.theme.css', array(), '1.3.3');

    // magnific popup
    wp_enqueue_style('magnific-popup', get_template_directory_uri().'/assets/magnific-popup/magnific-popup.css', array(), '1.1.0');

    // main stylesheet
    wp_enqueue_style('melissa-style', get_stylesheet_directory_uri().'/style.css', array(), '1.1.6');

  }
}
add_action('wp_enqueue_scripts', 'melissa_styles');


/**
 * Enqueue scripts
 *
 * @since Melissa 1.0
 */
if (!function_exists('melissa_scripts')) {
  function melissa_scripts() {

    // header type
    $header_type = get_theme_mod('general_header_type', 'simple-header');

    // blog page layout
    $blog_layout = get_theme_mod('blog_layout', '3c');
    $masonry_layout = array('3c', '2c-ls', '2c-rs', '2c');
    $is_masonry = (in_array($blog_layout, $masonry_layout)) ? true : false;

    // pagination type
    $pagination_type = get_theme_mod('pagination_type', 'standard_pagination');

    /**
     * Enqueue scripts
     * ----------------------------------------------------
     */

    // html5shiv.js (for IE)
    wp_enqueue_script('html5shiv', get_template_directory_uri().'/js/html5shiv.min.js', array(), '3.7.3', false);
    wp_script_add_data('html5shiv', 'conditional', 'lt IE 9');

    // respond.js (for IE)
    wp_enqueue_script('respond', get_template_directory_uri().'/js/respond.min.js', array(), '1.4.2', false);
    wp_script_add_data('respond', 'conditional', 'lt IE 9');

    // bootstrap
    wp_enqueue_script('bootstrap', get_template_directory_uri().'/js/bootstrap.min.js', array('jquery'), '3.3.7', true);

    // parallax
    if ($header_type == 'simple-header') {
      wp_enqueue_script('jquery-parallax', get_template_directory_uri().'/js/jquery.parallax.js', array('jquery'), '1.1.3', true);
    }

    // add revolution slider scripts only if no plugin installed
    if (!class_exists('RevSliderFront') && $header_type == 'rev-slider-header') {
      wp_enqueue_script('melissa-jquery-themepunch-tools', get_template_directory_uri().'/assets/revolution/js/jquery.themepunch.tools.min.js', array('jquery'), '5.4.8', true);
      wp_enqueue_script('melissa-jquery-themepunch-revolution', get_template_directory_uri().'/assets/revolution/js/jquery.themepunch.revolution.min.js', array('jquery'), '5.4.8', true);
    }

    // superfish
    wp_enqueue_script('superfish', get_template_directory_uri().'/js/superfish.min.js', array('jquery'), '1.7.9', true);

    // imagesLoaded
    if (version_compare($GLOBALS['wp_version'], '4.6-alpha', '<')) {
      // only for WordPress < v4.6
      if (!is_singular() && !$is_masonry) {
        wp_enqueue_script('imagesloaded', get_template_directory_uri().'/js/imagesloaded.pkgd.min.js', array('jquery'), '4.1.0', true);
      }
    } else if (!is_singular() && !$is_masonry) {
      // for WordPress >= v4.6
      wp_enqueue_script('imagesloaded');
    }

    // masonry
    if (!is_singular() && $is_masonry) {
      wp_enqueue_script('jquery-masonry');
    }

    // infinite scroll
    if ($pagination_type == 'infinite_scroll' || $pagination_type == 'load_more') {
      wp_enqueue_script('jquery-infinitescroll', get_template_directory_uri().'/js/jquery.infinitescroll.min.js', array('jquery'), '2.1.0', true);
    }

    // owl carousel
    wp_enqueue_script('owl-carousel', get_template_directory_uri().'/assets/owl-carousel/owl.carousel.min.js', array('jquery'), '1.3.3', true);

    // magnific popup
    wp_enqueue_script('jquery-magnific-popup', get_template_directory_uri().'/assets/magnific-popup/jquery.magnific-popup.min.js', array('jquery'), '1.1.0', true);

    // IE10 viewport hack for Surface/desktop Windows 8 bug
    wp_enqueue_script('melissa-ie10-viewport-bug-workaround', get_template_directory_uri().'/js/ie10-viewport-bug-workaround.js', array(), '1.0.0', true);

    // Melissa theme js
    wp_enqueue_script('melissa-theme', get_template_directory_uri().'/js/theme.js', array('jquery'), '1.1.0', true);

    // Melissa theme data
    $isMobile_data = (wp_is_mobile()) ? "true" : "false";
    $isSingular_data = (is_singular()) ? "true" : "false";
    $adminBar_data = (is_admin_bar_showing()) ? "true" : "false";

    // sticky menu
    $enable_sticky_menu = get_theme_mod('general_enable_sticky_menu', 1);
    $stickyNavigation_data = ($enable_sticky_menu) ? "true" : "false";

    // blog layout
    $isMasonry_data = ($is_masonry) ? "true" : "false";
    if ($blog_layout == '3c') {
      $masonryColumnWidth_data = '.bwp-blog-col-3-default';
    } else if ($blog_layout == '2c-ls' || $blog_layout == '2c-rs' || $blog_layout == '2c') {
      $masonryColumnWidth_data = '.bwp-blog-col-2-default';
    } else {
      $masonryColumnWidth_data = '';
    }

    // infinite scroll
    $infiniteScroll_data = ($pagination_type == 'infinite_scroll' || $pagination_type == 'load_more') ? "true" : "false";

    // load more button
    $iScrollLoadMoreBtn_data = ($pagination_type == 'load_more') ? "true" : "false";

    // blog posts - links target
    $post_links_target = get_theme_mod('post_links_target', '_self');

    // add or not data-no-retina attribute to all images (fixes retina.js 404 errors)
    $general_add_data_no_retina_attr = get_theme_mod('general_add_data_no_retina_attr', 0);
    $retinaDataAttr_data = ($general_add_data_no_retina_attr) ? "true" : "false";

    // theme.js localization
    $iScrollLoadingMsg = __('Loading new posts...', 'melissa');
    $iScrollFinishedMsg = __('No more posts to load', 'melissa');
    $loadMoreBtnText = __('Load More', 'melissa');

    // Melissa theme data array
    $melissaData_array = array(
      "ajaxURL" => esc_url(admin_url('admin-ajax.php')),
      "ajaxNonce" => wp_create_nonce('ajax-nonce'),
      "templateDirectoryUri" => esc_url(get_template_directory_uri()),
      "isMobile" => $isMobile_data,
      "isSingular" => $isSingular_data,
      "adminBar" => $adminBar_data,
      "headerType" => $header_type,
      "stickyNavigation" => $stickyNavigation_data,
      "isMasonry" => $isMasonry_data,
      "masonryColumnWidth" => $masonryColumnWidth_data,
      "infiniteScroll" => $infiniteScroll_data,
      "iScrollLoadMoreBtn" => $iScrollLoadMoreBtn_data,
      "linksTarget" => $post_links_target,
      "retinaDataAttr" => $retinaDataAttr_data,
      "toTopButton" => "true",
      "iScrollLoadingMsg" => esc_js($iScrollLoadingMsg),
      "iScrollFinishedMsg" => esc_js($iScrollFinishedMsg),
      "loadMoreBtnText" => esc_js($loadMoreBtnText),
    );
    wp_localize_script('melissa-theme', 'melissaData', $melissaData_array);

    // comments
    if (is_singular() && comments_open() && get_option('thread_comments')) {
      wp_enqueue_script('comment-reply');
    }

    // retina
    wp_enqueue_script('retina', get_template_directory_uri().'/js/retina.min.js', array(), '1.3.0', true);

  }
}
add_action('wp_enqueue_scripts', 'melissa_scripts');


/**
 * Admin enqueue scripts
 *
 * @since Melissa 1.0
 */
if (!function_exists('melissa_admin_scripts')) {
  function melissa_admin_scripts() {
    // Show/Hide meta boxes
    wp_enqueue_script('melissa-show-hide-meta-boxes', get_template_directory_uri().'/assets/show-hide-meta-boxes.js', array('jquery'), '1.1.6', true);
  }
}
add_action('admin_enqueue_scripts', 'melissa_admin_scripts', 9999);


/**
 * Convert Hex color to RGB
 *
 * @since Melissa 1.0
 */
if (!function_exists('melissa_hex_to_rgb')) {
  function melissa_hex_to_rgb($hex, $alpha=false) {
    if ($hex && preg_match('|^#([A-Fa-f0-9]{3}){1,2}$|', $hex)) {
      $hex = str_replace('#', '', $hex);
      // rgb
      $rgb['r'] = hexdec(substr($hex, 0, 2));
      $rgb['g'] = hexdec(substr($hex, 2, 2));
      $rgb['b'] = hexdec(substr($hex, 4, 2));
      // alpha
      if ($alpha && is_float($alpha)) {
        $rgb['a'] = $alpha;
      }
      // rgb(a) string
      return implode('', array_keys($rgb)).'('.implode(', ', $rgb).')';
    }
    return '';
  }
}


/**
 * HOST URL
 *
 * This function returns host URL (example: http(https)://www.hostname.com)
 * Used in the "origin" variable fot YouTube header video background
 *
 * @since Melissa 1.0
 * ----------------------------------------------------------------------------
 */
if (!function_exists('melissa_get_host_url')) {
  function melissa_get_host_url() {
    $home_url = get_home_url();
    $host_url = parse_url($home_url, PHP_URL_HOST);
    if (is_ssl()) {
      return 'https://'.$host_url;
    } else {
      return 'http://'.$host_url;
    }
  }
}


/**
 * Header image
 *
 * @since Melissa 1.0
 * ----------------------------------------------------------------------------
 */
if (!function_exists('melissa_header_image')) {
  function melissa_header_image($header_type) {
    $header_image = '';

    // standard header image
    if (get_header_image()) {
      $header_image = ($header_type == 'simple-header') ? 'background: url('.esc_url(get_header_image()).') 50% 0 no-repeat' : esc_url(get_header_image());
    }

    // return header image
    if (!is_single() && !is_page()) {

      // standard header image
      return $header_image;

    } else {

      // get current post id
      global $post;
      $current_post_ID = $post->ID;

      // single post page
      if (is_single()) {
        $single_post_header_bg = get_post_meta($current_post_ID, 'melissa_mb_single_post_header_bg', true); // default_bg / own_bg
        if (!$single_post_header_bg) {
          $single_post_header_bg = 'default_bg';
        }
        if ($single_post_header_bg == 'own_bg') {
          // own background
          $header_image_id = get_post_meta($current_post_ID, 'melissa_mb_single_header_image', true);
          if ($header_image_id) {
            $header_image_url = wp_get_attachment_image_src($header_image_id, 'full');
            $header_image = ($header_type == 'simple-header') ? 'background: url('.esc_url($header_image_url[0]).') 50% 0 no-repeat' : esc_url($header_image_url[0]);
            return $header_image;
          } else {
            return '';
          }
        } else {
          // default background; return standard header image
          return $header_image;
        }
      }

      // single page
      if (is_page()) {
        $single_page_header_bg = get_post_meta($current_post_ID, 'melissa_mb_single_page_header_bg', true); // default_bg / own_bg
        if (!$single_page_header_bg) {
          $single_page_header_bg = 'default_bg';
        }
        if ($single_page_header_bg == 'own_bg') {
          // own background
          $header_image_id = get_post_meta($current_post_ID, 'melissa_mb_page_header_image', true);
          if ($header_image_id) {
            $header_image_url = wp_get_attachment_image_src($header_image_id, 'full');
            $header_image = ($header_type == 'simple-header') ? 'background: url('.esc_url($header_image_url[0]).') 50% 0 no-repeat' : esc_url($header_image_url[0]);
            return $header_image;
          } else {
            return '';
          }
        } else {
          // default background; return standard header image
          return $header_image;
        }
      }

    }

    return '';
  }
}


/**
 * Site logo
 *
 * @since Melissa 1.0
 */
if (!function_exists('melissa_site_logo')) {
  function melissa_site_logo() {
    // logo type
    $logo_type = get_theme_mod('logo_type', 'text');

    // text
    if ($logo_type == 'text') {
      $logo_text = get_theme_mod('logo_text', 'Melissa');
      if ($logo_text) {
        ?>

        <!-- text logo -->
        <div class="bwp-logo-container">
          <a href="<?php echo esc_url(home_url('/')); ?>" rel="home" class="bwp-logo-text">
            <span><?php echo esc_html($logo_text); ?></span>
          </a>
        </div>
        <!-- end text logo -->

        <?php
      }
    // image
    } else {
      if (!wp_is_mobile()) {
        // custom logo
        melissa_custom_logo();
      } else {
        // custom logo for mobile devices
        melissa_mobile_custom_logo();
      }
    }
  }
}


/**
 * Custom logo (Image)
 *
 * @since Melissa 1.0
 */
if (!function_exists('melissa_custom_logo')) {
  function melissa_custom_logo() {
    if (function_exists('the_custom_logo')) {
      if (has_custom_logo()) {
        ?>

        <!-- image logo -->
        <div class="bwp-logo-container">
          <?php the_custom_logo(); ?>
        </div>
        <!-- end image logo -->

        <?php
      }
    }
  }
}


/**
 * Custom logo for mobile devices (Image + Retina(2x) Image)
 *
 * @since Melissa 1.0
 */
if (!function_exists('melissa_mobile_custom_logo')) {
  function melissa_mobile_custom_logo() {
    if (function_exists('the_custom_logo')) {
      $custom_logo_id = get_theme_mod('custom_logo');
      if ($custom_logo_id) {
        $custom_logo_url = wp_get_attachment_image_src($custom_logo_id, 'full');
        $custom_logo_url_2x = get_theme_mod('retina_logo_image_2x');
        $custom_logo_alt = get_post_meta($custom_logo_id, '_wp_attachment_image_alt', true);
        ?>

        <!-- image logo (for mobile) -->
        <div class="bwp-logo-container">
          <a href="<?php echo esc_url(home_url('/')); ?>" rel="home" class="custom-logo-link">
            <img src="<?php echo esc_url($custom_logo_url[0]); ?>" <?php echo ($custom_logo_url_2x) ? 'data-at2x="'.esc_url($custom_logo_url_2x).'"' : 'data-no-retina'; ?> alt="<?php if ($custom_logo_alt) { echo esc_attr($custom_logo_alt); } else { bloginfo('name'); } ?>">
          </a>
        </div>
        <!-- end image logo (for mobile) -->

        <?php
      }
    }
  }
}


/**
 * Drop-down search form
 *
 * @since Melissa 1.0
 */
if (!function_exists('melissa_dropdown_search')) {
  function melissa_dropdown_search() {
    $show_search_icon = get_theme_mod('general_show_search_icon', 1);
    if ($show_search_icon) {
      ?>

      <!-- search -->
      <div class="bwp-header-search-container hidden-sm hidden-xs">
        <a href="#" id="bwp-header-search-icon">
          <i class="fa fa-search"></i>
        </a>
        <div class="bwp-dropdown-search-container bwp-search-hidden">
          <?php get_search_form(); ?>
        </div>
      </div>
      <!-- end search -->

      <?php
    }
  }
}


/**
 * Site menu
 *
 * @since Melissa 1.0
 */
if (!function_exists('melissa_site_menu')) {
  function melissa_site_menu() {
    if (has_nav_menu('melissa_main_menu')) {
      ?>

      <!-- menu -->
      <div class="bwp-menu-container hidden-sm hidden-xs">
        <?php
        wp_nav_menu(array(
          'theme_location' => 'melissa_main_menu',
          'container' => 'nav',
          'menu_class' => 'sf-menu'
        ));
        ?>
      </div>
      <!-- end menu -->

      <?php
    }
  }
}


/**
 * Mobile menu
 *
 * @since Melissa 1.0
 */
if (!function_exists('melissa_mobile_site_menu')) {
  function melissa_mobile_site_menu() {
    // mobile menu
    if (has_nav_menu('melissa_main_menu')) {
      ?>

      <!-- mobile menu -->
      <div class="bwp-mobile-menu-container hidden-md hidden-lg">
        <!-- mobile menu icon -->
        <a href="#" id="bwp-mobile-menu-icon">
            Secciones
          <i class="fa fa-bars"></i>
        </a>
        <!-- end mobile menu icon -->
        <!-- dropdown mobile menu -->
        <div class="bwp-dropdown-mobile-menu bwp-mobile-menu-hidden">
          <?php
          wp_nav_menu(array(
            'theme_location' => 'melissa_main_menu',
            'container' => 'nav',
            'menu_class' => 'bwp-mobile-menu list-unstyled'
          ));
          ?>
        </div>
        <!-- end dropdown mobile menu -->
      </div>
      <!-- end mobile menu -->

      <?php
    }
  }
}


/**
 * Header custom text
 *
 * @since Melissa 1.0
 */
if (!function_exists('melissa_header_custom_text')) {
  function melissa_header_custom_text() {

    // home page - page with your latest posts, and 404 page
    if (is_home() || is_404()) {
      $custom_title = get_theme_mod('header_custom_title', 'Custom Title');
      $custom_text = get_theme_mod('header_custom_text', 'Custom text. You can enter your own title and text in the theme settings: Appearance > Customize > General Settings > Header Custom Text > Custom Title and Custom Text.');
      if ($custom_title || $custom_text) {
        ?>

        <!-- custom text -->
        <?php if ($custom_title) { ?>
          <h1 class="bwp-header-custom-title">
            <?php
            echo wp_kses($custom_title,
              array(
                'span' => array(
                  'class' => array()
                ),
                'strong' => array(),
                'b' => array(),
                'em' => array(),
                'i' => array(
                  'class' => array()
                )
              )
            );
            ?>
          </h1>
        <?php } ?>
        <?php if ($custom_text) { ?>
          <p class="bwp-header-custom-text">
            <?php
            echo wp_kses($custom_text,
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
          </p>
        <?php } ?>
        <?php if ($custom_title) { ?>
          <div class="bwp-header-transparent-line clearfix">
            <span class="bwp-header-t-line-1"></span>
            <span class="bwp-header-t-line-2"></span>
          </div>
        <?php } ?>
        <!-- end custom text -->

        <?php
      }
    // author page
    } else if (is_author()) {
      ?>

      <!-- custom text - author page -->
      <h1 class="bwp-header-custom-title"><?php the_archive_title(); ?></h1>
      <?php if (get_the_author_meta('description')) { ?>
        <div class="bwp-header-custom-text"><?php the_author_meta('description'); ?></div>
      <?php } ?>
      <div class="bwp-header-transparent-line clearfix">
        <span class="bwp-header-t-line-1"></span>
        <span class="bwp-header-t-line-2"></span>
      </div>
      <!-- end custom text -->

      <?php
    // category page
    } else if (is_category()) {
      ?>

      <!-- custom text - category page -->
      <h1 class="bwp-header-custom-title" id="category_title"><?php the_archive_title(); ?></h1>
        <script>
            category_title.innerHTML=      category_title.innerHTML.replace("Categoría: ","")
        </script>
      <?php if (get_the_archive_description()) { ?>
        <div class="bwp-header-custom-text"><?php the_archive_description(); ?></div>
      <?php } ?>
      <div class="bwp-header-transparent-line clearfix">
        <span class="bwp-header-t-line-1"></span>
        <span class="bwp-header-t-line-2"></span>
      </div>
      <!-- end custom text -->

      <?php
    // tag page
    } else if (is_tag()) {
      ?>

      <!-- custom text - tag page -->
      <h1 class="bwp-header-custom-title"><?php the_archive_title(); ?></h1>
      <?php if (get_the_archive_description()) { ?>
        <div class="bwp-header-custom-text"><?php the_archive_description(); ?></div>
      <?php } ?>
      <div class="bwp-header-transparent-line clearfix">
        <span class="bwp-header-t-line-1"></span>
        <span class="bwp-header-t-line-2"></span>
      </div>
      <!-- end custom text -->

      <?php
    // search results page
    } else if (is_search()) {
      ?>

      <!-- custom text - search results page -->
      <h1 class="bwp-header-custom-title">
        <?php echo esc_html__('Search results for: ', 'melissa').get_search_query(); ?>
      </h1>
      <?php
      // the number of found posts
      global $wp_query;
      $results_number = $wp_query->found_posts;
      if ($results_number != '0') { ?>
        <div class="bwp-header-custom-text">
          <?php
          echo esc_html__('Found: ', 'melissa').'<span>'.intval($results_number).'</span>';
          if ($results_number == '1') {
            echo ' '.esc_html__('Post', 'melissa');
          } else {
            echo ' '.esc_html__('Posts', 'melissa');
          }
          ?>
        </div>
      <?php } ?>
      <div class="bwp-header-transparent-line clearfix">
        <span class="bwp-header-t-line-1"></span>
        <span class="bwp-header-t-line-2"></span>
      </div>
      <!-- end custom text -->

      <?php
    // archive page
    } else if (is_archive()) {
      ?>

      <!-- custom text - archive page -->
      <h1 class="bwp-header-custom-title"><?php the_archive_title(); ?></h1>
      <div class="bwp-header-transparent-line clearfix">
        <span class="bwp-header-t-line-1"></span>
        <span class="bwp-header-t-line-2"></span>
      </div>
      <!-- end custom text -->

      <?php
    // singular pages (is_single, is_page, is_attachment, etc.)
    } else if (is_singular()) {
      global $post;
      $current_post_ID = $post->ID;
      // subtitle
      $subtitle = '';
      if (is_single()) {
        $subtitle = get_post_meta($current_post_ID, 'melissa_mb_single_subtitle', true);
      } else if (is_page()) {
        $subtitle = get_post_meta($current_post_ID, 'melissa_mb_page_subtitle', true);
      }
      // if the title is not empty
      if (get_the_title($current_post_ID)) {
        ?>

        <!-- custom text - single page -->
        <h1 class="bwp-header-custom-title entry-title">
          <?php echo get_the_title($post); ?>
        </h1>
        <?php if ($subtitle && !post_password_required()) { ?>
          <p class="bwp-header-custom-text">
            <?php
            echo wp_kses($subtitle,
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
          </p>
        <?php } ?>
        <div class="bwp-header-transparent-line clearfix">
          <span class="bwp-header-t-line-1"></span>
          <span class="bwp-header-t-line-2"></span>
        </div>
        <!-- end custom text -->

        <?php
      }
    }

  }
}


/**
 * Sticky navigation
 *
 * @since Melissa 1.0
 */
if (!function_exists('melissa_sticky_navigation')) {
  function melissa_sticky_navigation() {
    if (has_nav_menu('melissa_main_menu')) {
      $enable_sticky_menu = get_theme_mod('general_enable_sticky_menu', 1);
      if ($enable_sticky_menu) {
        ?>

        <!-- sticky navigation -->
        <div class="bwp-sticky-navigation-wrap bwp-transition-4 clearfix">
          <!-- sticky navigation icon -->
          <a href="#" id="bwp-sticky-navigation-icon">
            <i class="fa fa-bars"></i>
          </a>
          <!-- end sticky navigation icon -->
          <!-- sticky navigation container -->
          <div class="bwp-sticky-navigation-container bwp-sticky-navigation-hidden">
            <?php
            wp_nav_menu(array(
              'theme_location' => 'melissa_main_menu',
              'container' => 'nav',
              'menu_class' => 'sf-menu'
            ));
            ?>
          </div>
          <!-- end sticky navigation container -->
        </div>
        <!-- end sticky navigation -->

        <?php
      }
    }
  }
}


/**
 * Post with media or not
 *
 * Check if post has a media attached (featured image, gallery, video, audio).
 * Used on the single post page.
 *
 * @since Melissa 1.0
 */
if (!function_exists('melissa_has_post_media')) {
  function melissa_has_post_media($format, $postID) {

    // if post format is not defined
    if (!$format) {
      return false;
    }

    // if post id is not defined
    if (!$postID) {
      return false;
    }

    // gallery format
    if ($format == 'gallery') {

      // gallery images ID
      $gallery_images_id = get_post_meta($postID, 'melissa_mb_gallery', false);
      if (!is_array($gallery_images_id)) {
        $gallery_images_id = (array)$gallery_images_id;
      }
      // if $gallery_images_id is not empty
      if (!empty($gallery_images_id) && $gallery_images_id[0]) {
        return true;
      } else if (has_post_thumbnail()) {
        return true;
      } else {
        return false;
      }

    // video format
    } else if ($format == 'video') {

      $video_url = get_post_meta($postID, 'melissa_mb_video_url', true);
      if ($video_url) {
        return true;
      } else if (has_post_thumbnail()) {
        return true;
      } else {
        return false;
      }

    // audio format
    } else if ($format == 'audio') {

      $audio_url = get_post_meta($postID, 'melissa_mb_audio_url', true);
      if ($audio_url) {
        return true;
      } else if (has_post_thumbnail()) {
        return true;
      } else {
        return false;
      }

    // all other formats
    } else {

      if (has_post_thumbnail()) {
        return true;
      } else {
        return false;
      }

    }
    // end if

  }
}


/**
 * Excerpt length
 *
 * @since Melissa 1.0
 */
if (!function_exists('melissa_excerpt_length')) {
  function melissa_excerpt_length($length) {
    $excerpt_length = get_theme_mod('blog_excerpt_length', 20);
    if ($excerpt_length) {
      $excerpt_length = intval($excerpt_length);
    } else {
      $excerpt_length = 20;
    }
    return $excerpt_length;
  }
}
add_filter('excerpt_length', 'melissa_excerpt_length');


/**
 * Views counter
 *
 * @since Melissa 1.0
 */

// get views
if (!function_exists('melissa_getPostViews')) {
  function melissa_getPostViews($postID) {
    // meta keys
    $old_count_key = 'melissa_post_views_count';
    $new_count_key = '_melissa_post_views_count';
    // get old count
    $old_count = get_post_meta($postID, $old_count_key, true);
    if ($old_count == '') {
      // no old count; get new count
      $new_count = get_post_meta($postID, $new_count_key, true);
      if ($new_count == '') {
        // no new count; create it
        delete_post_meta($postID, $new_count_key);
        add_post_meta($postID, $new_count_key, '0');
        return "0";
      }
      return $new_count;
    } else {
      // old count exists; remove it and create new with the same value
      delete_post_meta($postID, $new_count_key);
      add_post_meta($postID, $new_count_key, $old_count);
      delete_post_meta($postID, $old_count_key);
      return $old_count;
    }
  }
}

// set (update) views.
if (!function_exists('melissa_setPostViews')) {
  function melissa_setPostViews($postID) {
    if (!current_user_can('manage_options')) {
      // meta key
      $count_key = '_melissa_post_views_count';
      // get count
      $count = get_post_meta($postID, $count_key, true);
      if ($count == '') {
        // no count; create new
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
      } else {
        // increase by one and update
        $count++;
        update_post_meta($postID, $count_key, $count);
      }
    }
  }
}


/**
 * Likes counter
 *
 * @since Melissa 1.0
 */
require_once get_template_directory().'/assets/post-like.php';


/**
 * Get URL for the Link format
 *
 * @since Melissa 1.0
 */
if (!function_exists('melissa_get_link_url')) {
  function melissa_get_link_url() {
    $has_url = get_url_in_content(get_the_content());
    return $has_url ? $has_url : apply_filters('the_permalink', get_permalink());
  }
}


/**
 * Post excerpt / content
 *
 * @since Melissa 1.0
 */
if (!function_exists('melissa_post_excerpt')) {
  function melissa_post_excerpt() {
    $excerpt_type = get_theme_mod('blog_excerpt_type', 'excerpt');
    if ($excerpt_type == 'excerpt') {
      ?>

      <!-- excerpt -->
      <div class="bwp-post-excerpt entry-content">
        <?php the_excerpt(); ?>
      </div>
      <!-- end excerpt -->

      <?php
    } else {
      ?>

      <!-- content -->
      <div class="bwp-post-excerpt bwp-content entry-content clearfix">
        <?php the_content('[...]', false); ?>
      </div>
      <!-- end content -->

      <?php
    }
  }
}


/**
 * Post content
 *
 * Used for aside/link/status/chat post formats on archive pages
 *
 * @since Melissa 1.0
 */
if (!function_exists('melissa_post_content')) {
  function melissa_post_content() {
    ?>

    <!-- content -->
    <div class="bwp-post-excerpt bwp-content entry-content clearfix">
      <?php the_content('[...]', false); ?>
    </div>
    <!-- end content -->

    <?php
  }
}


/**
 * Quote format content
 *
 * @since Melissa 1.0
 */
if (!function_exists('melissa_quote_content')) {
  function melissa_quote_content() {
    ?>

    <!-- quote -->
    <div class="bwp-post-quote entry-content clearfix">
      <?php the_content(''); ?>
    </div>
    <!-- end quote -->

    <?php
  }
}


/**
 * Post details (author (hidden) + date + counters)
 *
 * @since Melissa 1.0
 */
if (!function_exists('melissa_post_details')) {
  function melissa_post_details($post_type='post') {
    $blog_show_date = get_theme_mod('blog_show_date', 1);
    $blog_show_views = get_theme_mod('blog_show_views', 1);
    $blog_show_likes = get_theme_mod('blog_show_likes', 1);
    ?>

    <!-- details -->
    <div class="bwp-post-details-wrap clearfix">
      <!-- author (hidden) -->
      <span class="screen-reader-text">
        <span class="vcard author"><span class="fn"><?php the_author_posts_link(); ?></span></span>
      </span>
      <!-- end author (hidden) -->
      <?php if ($blog_show_date) { ?>
        <!-- date -->
        <a href="<?php the_permalink(); ?>" class="bwp-post-date">
          <span class="date updated"><?php the_time(get_option('date_format')); ?></span>
        </a>
        <!-- end date -->
      <?php } ?>
      <?php
      // if the post is not password protected & it's not a page
      if (!post_password_required() && $post_type != 'page') {
        if ($blog_show_views || $blog_show_likes) {
          ?>
          <!-- counters -->
          <ul class="bwp-post-counters list-unstyled clearfix" <?php echo (!$blog_show_date) ? 'style="float: left;"' : ''; ?>>
            <?php if ($blog_show_views) { ?>
              <li class="bwp-views-count"><a href="<?php the_permalink(); ?>"><i class="fa fa-eye"></i><?php echo (int)melissa_getPostViews(get_the_ID()); ?></a></li>
            <?php } ?>
            <?php if ($blog_show_likes) { ?>
              <li class="bwp-likes-count"><?php echo melissa_getPostLikeLink(get_the_ID()); ?></li>
            <?php } ?>
          </ul>
          <!-- end counters -->
          <?php
        }
      }
      ?>
    </div>
    <!-- end details -->

    <?php
  }
}


/**
 * Single page - Social sharing buttons
 *
 * @since Melissa 1.0
 */
if (!function_exists('melissa_single_social_share')) {
  function melissa_single_social_share() {
    global $post;
    // image for Pinterest
    $pin_media[] = '';
    $pin_media = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');
    ?>

    <!-- social sharing buttons -->
    <div class="bwp-single-share-wrap">
      <span><?php esc_html_e('Share:', 'melissa'); ?></span>
      <ul class="bwp-single-share list-unstyled">
        <!-- facebook -->
        <li>
          <a rel="nofollow" onclick="window.open('http://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>', 'Facebook', 'width=600, height=300, left='+(screen.availWidth/2-300)+', top='+(screen.availHeight/2-150)+''); return false;" href="http://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>" target="_blank" class="bwp-share-link bwp-facebook-share">
            <i class="fa fa-facebook"></i>
          </a>
        </li>
        <!-- end facebook -->
        <!-- twitter -->
        <li>
          <a rel="nofollow" onclick="window.open('https://twitter.com/share?url=<?php the_permalink(); ?>&text=<?php echo sanitize_title(get_the_title()); ?>', 'Twitter', 'width=600, height=300, left='+(screen.availWidth/2-300)+', top='+(screen.availHeight/2-150)+''); return false;" href="https://twitter.com/share?url=<?php the_permalink(); ?>&text=<?php echo sanitize_title(get_the_title()); ?>" target="_blank" class="bwp-share-link bwp-twitter-share">
            <i class="fa fa-twitter"></i>
          </a>
        </li>
        <!-- end twitter -->
        <!-- google+ -->
        <li>
          <a rel="nofollow" onclick="window.open('https://plus.google.com/share?url=<?php the_permalink(); ?>', 'Google plus', 'width=600, height=460, left='+(screen.availWidth/2-300)+', top='+(screen.availHeight/2-230)+''); return false;" href="https://plus.google.com/share?url=<?php the_permalink(); ?>" target="_blank" class="bwp-share-link bwp-google-plus-share">
            <i class="fa fa-google-plus"></i>
          </a>
        </li>
        <!-- end google+ -->
        <!-- vk -->
        <li>
          <a rel="nofollow" onclick="window.open('http://vk.com/share.php?url=<?php the_permalink(); ?>', 'VK', 'width=600, height=300, left='+(screen.availWidth/2-300)+', top='+(screen.availHeight/2-150)+''); return false;" href="http://vk.com/share.php?url=<?php the_permalink(); ?>" target="_blank" class="bwp-share-link bwp-vk-share">
            <i class="fa fa-vk"></i>
          </a>
        </li>
        <!-- end vk -->
        <!-- pinterest -->
        <li>
          <a rel="nofollow" onclick="window.open('http://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&media=<?php echo esc_url($pin_media[0]); ?>&description=<?php echo sanitize_title(get_the_title()); ?>', 'Pinterest', 'width=600, height=300, left='+(screen.availWidth/2-300)+', top='+(screen.availHeight/2-150)+''); return false;" href="http://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&media=<?php echo esc_url($pin_media[0]); ?>&description=<?php echo sanitize_title(get_the_title()); ?>" target="_blank" class="bwp-share-link bwp-pinterest-share">
            <i class="fa fa-pinterest-p"></i>
          </a>
        </li>
        <!-- end pinterest -->
      </ul>
    </div>
    <!-- end social sharing buttons -->

    <?php
  }
}


/**
 * Single post page - Counters: views, comments, likes
 *
 * @since Melissa 1.0
 */
if (!function_exists('melissa_single_counters')) {
  function melissa_single_counters($show_views, $show_comments, $show_likes, $show_social_share) {
    // counters class
    $counters_class = '';
    if (!$show_social_share) {
      $counters_class = 'bwp-no-single-share';
    }
    ?>

    <!-- counters -->
    <ul class="bwp-single-counters list-unstyled clearfix <?php echo sanitize_html_class($counters_class); ?>">
      <?php if ($show_views) { ?>
        <li class="bwp-views-count"><i class="fa fa-eye"></i><?php echo (int)melissa_getPostViews(get_the_ID()); ?></li>
      <?php } ?>
      <?php if ($show_comments) { ?>
        <li class="bwp-comments-count"><a href="#comments"><i class="fa fa-comment-o"></i><?php comments_number('0', '1', '%'); ?></a></li>
      <?php } ?>
      <?php if ($show_likes) { ?>
        <li class="bwp-likes-count"><?php echo melissa_getPostLikeLink(get_the_ID()); ?></li>
      <?php } ?>
    </ul>
    <!-- end counters -->

    <?php
  }
}


/**
 * Single post page - Metadata: author, date, categories, tags
 *
 * @since Melissa 1.0
 */
if (!function_exists('melissa_single_metadata')) {
  function melissa_single_metadata($social_buttons_and_counters) {
    // metadata class
    $metadata_class = '';
    if (!$social_buttons_and_counters) {
      $metadata_class = 'bwp-no-single-share-and-counters';
    }
    // show/hide values
    $single_show_author = get_theme_mod('single_show_author', 1);
    $single_show_date = get_theme_mod('single_show_date', 1);
    $single_show_categories = get_theme_mod('single_show_categories', 1);
    $single_show_tags = get_theme_mod('single_show_tags', 1);
    // show metadata
    if ($single_show_author || $single_show_date || $single_show_categories || $single_show_tags) {
      ?>

      <!-- metadata -->
      <div class="bwp-single-metadata-wrap <?php echo sanitize_html_class($metadata_class); ?>">
        <ul class="bwp-single-metadata list-unstyled clearfix">
          <?php if ($single_show_author) { ?>
            <!-- author -->
            <li>
              <span class="vcard author">
                <span class="fn">
                  <i class="fa fa-pencil-square-o"></i><?php the_author_posts_link(); ?>
                </span>
              </span>
              <span class="bwp-metadata-slash">/</span>
            </li>
            <!-- end author -->
          <?php } ?>
          <?php if ($single_show_date) { ?>
            <!-- date -->
            <li>
              <?php
              $year = get_the_time('Y');
              $month = get_the_time('m');
              $day = get_the_time('d');
              ?>
              <span class="date updated">
                <i class="fa fa-clock-o"></i><a href="<?php echo esc_url(get_day_link($year, $month, $day)); ?>"><?php the_time(get_option('date_format')); ?></a>
              </span>
              <span class="bwp-metadata-slash">/</span>
            </li>
            <!-- end date -->
          <?php } ?>
          <?php if ($single_show_categories) { ?>
            <!-- categories -->
            <li>
              <i class="fa fa-bookmark-o"></i><?php the_category(', '); ?>
              <span class="bwp-metadata-slash">/</span>
            </li>
            <!-- end categories -->
          <?php } ?>
          <?php if ($single_show_tags && get_the_tags()) { ?>
            <!-- tags -->
            <li>
              <i class="fa fa-tags"></i><?php the_tags('', ', ', ''); ?>
              <span class="bwp-metadata-slash">/</span>
            </li>
            <!-- end tags -->
          <?php } ?>
        </ul>
      </div>
      <!-- end metadata -->

      <?php
    }
  }
}


/**
 * Single post page - About the author
 *
 * @since Melissa 1.0
 */
if (!function_exists('melissa_about_the_author')) {
  function melissa_about_the_author() {
    $post_author_ID = get_the_author_meta('ID');
    $post_author_email = get_the_author_meta('user_email');
    ?>

    <!-- about the author -->
    <div class="bwp-about-author-container bwp-transition-3 clearfix">
      <!-- avatar -->
      <div class="bwp-about-author-avatar">
        <a href="<?php echo esc_url(get_author_posts_url($post_author_ID)); ?>">
          <?php echo get_avatar($post_author_email, '150', ''); ?>
        </a>
      </div>
      <!-- end avatar -->
      <!-- biographical info -->
      <div class="bwp-about-author-bio-wrap">
        <h3 class="bwp-about-author-name">
          <?php the_author_posts_link(); ?>
          <span><i class="fa fa-angle-double-right"></i><?php the_author_posts(); esc_html_e(' Posts', 'melissa'); ?></span>
        </h3>
        <div class="bwp-about-author-bio">
          <?php the_author_meta('description'); ?>
        </div>
        <?php
        // social services
        $social_services = array(
          'twitter' => 'Twitter',
          'facebook' => 'Facebook',
          'google-plus' => 'Google+',
          'pinterest-p' => 'Pinterest',
          'vk' => 'VK',
          'flickr' => 'Flickr',
          'instagram' => 'Instagram',
          '500px' => '500px',
          'youtube' => 'YouTube',
          'vimeo' => 'Vimeo',
          'soundcloud' => 'Soundcloud',
          'dribbble' => 'Dribbble',
          'behance' => 'Behance',
          'github' => 'GitHub',
          'user_url' => 'Web site'
        );
        // show or hide social links
        $show_social_links = false;
        foreach ($social_services as $social_meta => $social_service) {
          if (get_the_author_meta($social_meta)) {
            $show_social_links = true;
            break;
          }
        }
        // social links
        if ($show_social_links) { ?>
          <ul class="bwp-about-author-social list-unstyled clearfix">
            <?php
            foreach ($social_services as $social_meta => $social_service) {
              if (get_the_author_meta($social_meta)) {
                if ($social_meta != 'user_url') { ?>
                  <li><a href="<?php echo esc_url(get_the_author_meta($social_meta)); ?>" target="_blank" class="bwp-a-<?php echo esc_attr($social_meta); ?>-link"><i class="fa fa-<?php echo esc_attr($social_meta); ?>"></i></a></li>
                <?php } else { ?>
                  <li><a href="<?php echo esc_url(get_the_author_meta($social_meta)); ?>" target="_blank" class="bwp-a-website-link"><i class="fa fa-link"></i></a></li>
                <?php }
              }
            }
            ?>
          </ul>
        <?php } ?>
      </div>
      <!-- end biographical info -->
    </div>
    <!-- end about the author -->

    <?php
  }
}


/**
 * New contact fields (User profile page: Users -> Your Profile)
 *
 * @since Melissa 1.0
 */
if (!function_exists('melissa_user_contact_fields')) {
  function melissa_user_contact_fields($user_contact) {
    // Add user contact methods
    if (!isset($user_contact['twitter'])) {
      $user_contact['twitter'] = __('Twitter URL', 'melissa');
    }
    if (!isset($user_contact['facebook'])) {
      $user_contact['facebook'] = __('Facebook URL', 'melissa');
    }
    if (!isset($user_contact['google-plus'])) {
      $user_contact['google-plus'] = __('Google+ URL', 'melissa');
    }
    if (!isset($user_contact['pinterest-p'])) {
      $user_contact['pinterest-p'] = __('Pinterest URL', 'melissa');
    }
    if (!isset($user_contact['vk'])) {
      $user_contact['vk'] = __('VK URL', 'melissa');
    }
    if (!isset($user_contact['flickr'])) {
      $user_contact['flickr'] = __('Flickr URL', 'melissa');
    }
    if (!isset($user_contact['instagram'])) {
      $user_contact['instagram'] = __('Instagram URL', 'melissa');
    }
    if (!isset($user_contact['500px'])) {
      $user_contact['500px'] = __('500px URL', 'melissa');
    }
    if (!isset($user_contact['youtube'])) {
      $user_contact['youtube'] = __('YouTube URL', 'melissa');
    }
    if (!isset($user_contact['vimeo'])) {
      $user_contact['vimeo'] = __('Vimeo URL', 'melissa');
    }
    if (!isset($user_contact['soundcloud'])) {
      $user_contact['soundcloud'] = __('Soundcloud URL', 'melissa');
    }
    if (!isset($user_contact['dribbble'])) {
      $user_contact['dribbble'] = __('Dribbble URL', 'melissa');
    }
    if (!isset($user_contact['behance'])) {
      $user_contact['behance'] = __('Behance URL', 'melissa');
    }
    if (!isset($user_contact['github'])) {
      $user_contact['github'] = __('GitHub URL', 'melissa');
    }

    return $user_contact;
  }
}
add_filter('user_contactmethods', 'melissa_user_contact_fields');


/**
 * Related posts - date + read more link
 *
 * @since Melissa 1.0
 */
if (!function_exists('melissa_related_post_details')) {
  function melissa_related_post_details() {
    ?>

    <!-- date + read more link -->
    <div class="bwp-post-details-wrap clearfix">
      <!-- date -->
      <?php
      $year = get_the_time('Y');
      $month = get_the_time('m');
      $day = get_the_time('d');
      ?>
      <a href="<?php echo esc_url(get_day_link($year, $month, $day)); ?>" class="bwp-post-date">
        <span class="date updated"><?php the_time(get_option('date_format')); ?></span>
      </a>
      <!-- end date -->
      <!-- read more link -->
      <a href="<?php the_permalink(); ?>" class="bwp-read-more"><?php esc_html_e('Read more', 'melissa'); ?></a>
      <!-- end read more link -->
    </div>
    <!-- end date + read more link -->

    <?php
  }
}


/**
 * Register sidebars
 *
 * @since Melissa 1.0
 */
if (!function_exists('melissa_widgets_init')) {
  function melissa_widgets_init() {

    /**
     * Index page (homepage)
     */
    register_sidebar(array(
      'name' => __('Homepage', 'melissa'),
      'id' => 'melissa_home_widgets',
      'description' => __('Appears on the Homepage in the left or right column.', 'melissa'),
      'before_widget' => '<aside id="%1$s" class="bwp-widget %2$s clearfix">',
      'after_widget' => '<div class="bwp-widget-line"></div></aside>',
      'before_title' => '<h3 class="bwp-widget-title">',
      'after_title' => '</h3>'
    ));

    /**
     * Archive pages
     */
    register_sidebar(array(
      'name' => __('Archive Pages', 'melissa'),
      'id' => 'melissa_archive_widgets',
      'description' => __('Appears on the Archive pages (archive, author, category and etc.) in the left or right column.', 'melissa'),
      'before_widget' => '<aside id="%1$s" class="bwp-widget %2$s clearfix">',
      'after_widget' => '<div class="bwp-widget-line"></div></aside>',
      'before_title' => '<h3 class="bwp-widget-title">',
      'after_title' => '</h3>'
    ));

    /**
     * Single post page
     */
    register_sidebar(array(
      'name' => __('Single Post', 'melissa'),
      'id' => 'melissa_single_widgets',
      'description' => __('Appears on the Single post page in the left or right column.', 'melissa'),
      'before_widget' => '<aside id="%1$s" class="bwp-widget %2$s clearfix">',
      'after_widget' => '<div class="bwp-widget-line"></div></aside>',
      'before_title' => '<h3 class="bwp-widget-title">',
      'after_title' => '</h3>'
    ));

    /**
     * Pages
     */
    register_sidebar(array(
      'name' => __('Pages', 'melissa'),
      'id' => 'melissa_page_widgets',
      'description' => __('Appears on the Page in the left or right column.', 'melissa'),
      'before_widget' => '<aside id="%1$s" class="bwp-widget %2$s clearfix">',
      'after_widget' => '<div class="bwp-widget-line"></div></aside>',
      'before_title' => '<h3 class="bwp-widget-title">',
      'after_title' => '</h3>'
    ));

    /**
     * Footer
     */

    // footer (column 1)
    register_sidebar(array(
      'name' => __('Footer (Column 1)', 'melissa'),
      'id' => 'melissa_footer_widgets_1',
      'description' => __('Appears in the Footer (column 1 - left column).', 'melissa'),
      'before_widget' => '<aside id="%1$s" class="bwp-widget %2$s clearfix">',
      'after_widget' => '<div class="bwp-widget-line"></div></aside>',
      'before_title' => '<h3 class="bwp-widget-title">',
      'after_title' => '</h3>'
    ));

    // footer (column 2)
    register_sidebar(array(
      'name' => __('Footer (Column 2)', 'melissa'),
      'id' => 'melissa_footer_widgets_2',
      'description' => __('Appears in the Footer (column 2 - center).', 'melissa'),
      'before_widget' => '<aside id="%1$s" class="bwp-widget %2$s clearfix">',
      'after_widget' => '<div class="bwp-widget-line"></div></aside>',
      'before_title' => '<h3 class="bwp-widget-title">',
      'after_title' => '</h3>'
    ));

    // footer (column 3)
    register_sidebar(array(
      'name' => __('Footer (Column 3)', 'melissa'),
      'id' => 'melissa_footer_widgets_3',
      'description' => __('Appears in the Footer (column 3 - right column).', 'melissa'),
      'before_widget' => '<aside id="%1$s" class="bwp-widget %2$s clearfix">',
      'after_widget' => '<div class="bwp-widget-line"></div></aside>',
      'before_title' => '<h3 class="bwp-widget-title">',
      'after_title' => '</h3>'
    ));

  }
}
add_action('widgets_init', 'melissa_widgets_init');


/**
 * Add new widgets
 *
 * @since Melissa 1.0
 */
require_once get_template_directory().'/assets/widgets/melissa-popular-posts.php';
require_once get_template_directory().'/assets/widgets/melissa-random-posts.php';
require_once get_template_directory().'/assets/widgets/melissa-recent-posts.php';
require_once get_template_directory().'/assets/widgets/melissa-social.php';
require_once get_template_directory().'/assets/widgets/melissa-thumbnails-gallery.php';
require_once get_template_directory().'/assets/widgets/melissa-posts-slider.php';
require_once get_template_directory().'/assets/widgets/melissa-posts-list.php';


/**
 * Customizer
 *
 * @since Melissa 1.0
 */
require_once get_template_directory().'/assets/customizer.php';
require_once get_template_directory().'/assets/sanitize-functions.php';
require_once get_template_directory().'/assets/inline-styles.php';


/**
 * Migrate Custom CSS Code from Theme Settings to Additional CSS (for WordPress 4.7)
 *
 * @since Melissa 1.0.1
 */
if (!function_exists('melissa_custom_css_code_migrate')) {
  function melissa_custom_css_code_migrate() {
    if (function_exists('wp_update_custom_css_post')) {
      // get Custom CSS code from Theme Settings
      $custom_css_code = get_theme_mod('custom_css_code');
      if ($custom_css_code) {
        // get Additional CSS code from WordPress Customizer
        $wp_additional_css_code = wp_get_custom_css();
        // update Additional CSS code
        $update_wp_additional_css_code = wp_update_custom_css_post($wp_additional_css_code.$custom_css_code);
        if (!is_wp_error($update_wp_additional_css_code)) {
          // remove the old theme_mod
          remove_theme_mod('custom_css_code');
        }
      }
    }
  }
}
add_action('after_setup_theme', 'melissa_custom_css_code_migrate');


/**
 * Remove Custom CSS section from WordPress Live Customizer (for WordPress 4.7)
 *
 * @since Melissa 1.0.1
 */
if (!function_exists('melissa_remove_custom_css_section')) {
  function melissa_remove_custom_css_section($wp_customize) {
    if (function_exists('wp_update_custom_css_post')) {
      // get Custom CSS code from Theme Settings
      $custom_css_code = get_theme_mod('custom_css_code');
      if (!$custom_css_code) {
        // remove Custom CSS section
        $wp_customize->remove_section('custom_css_section');
      }
    }
  }
}
add_action('customize_register', 'melissa_remove_custom_css_section', 20);
