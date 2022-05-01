<?php
/**
 * Inline styles (custom styles from customizer)
 *
 * @package WordPress
 * @subpackage Melissa
 * @since Melissa 1.0
 */

function melissa_inline_styles() {

  $inline_styles = '';


  /**
   * General Settings
   * -------------------------------------------------------------
   */

  // Pagination type (id: pagination_type)
  $pagination_type = get_theme_mod('pagination_type', 'standard_pagination');
  if ($pagination_type == 'load_more') {
    $inline_styles .= '
    #infscr-loading {
      display: none !important;
    }';
  }

  // Increase all small featured images (id: blog_increase_images)
  $blog_increase_images = get_theme_mod('blog_increase_images', 1);
  if ($blog_increase_images) {
    $inline_styles .= '
    .bwp-post-media img,
    .bwp-post-carousel-item img,
    .widget_bwp_posts_slider_item img {
      width: 100%;
      margin: 0;
    }';
  }

  // Show icon and transparent dark background when you hover on featured images (id: blog_images_hover_effect)
  $blog_images_hover_effect = get_theme_mod('blog_images_hover_effect', 1);
  if (!$blog_images_hover_effect) {
    $inline_styles .= '
    .bwp-post-bg-overlay,
    .bwp-post-hover-icon-center span,
    .widget-bwp-bg-overlay {
      display: none;
    }';
  }

  // Disable hover effect for all content blocks (id: general_global_hover_effect)
  $general_global_hover_effect = get_theme_mod('general_global_hover_effect', 0);
  if (!$general_global_hover_effect) {
    $inline_styles .= '
    .bwp-post-wrap:hover {
      margin-top: 0;
      -webkit-box-shadow: 0 4px 0 -2px rgba(46,51,64,0.1);
      -moz-box-shadow: 0 4px 0 -2px rgba(46,51,64,0.1);
      box-shadow: 0 4px 0 -2px rgba(46,51,64,0.1);
    }
    #bwp-masonry-container.no-masonry .bwp-post-wrap:hover {
      top: 0;
    }
    .bwp-no-results-container:hover,
    .bwp-single-article:hover,
    .bwp-featured-media-container:hover,
    .post-navigation .nav-links a:hover,
    .bwp-about-author-container:hover,
    .comment-respond:hover,
    .comment-body:hover,
    #comments .no-comments:hover,
    .comment-navigation .nav-links a:hover,
    .bwp-related-post-wrap:hover,
    .bwp-page-404-container:hover,
    .bwp-sidebar-wrap:hover {
      top: 0;
      -webkit-box-shadow: 0 4px 0 -2px rgba(46,51,64,0.1);
      -moz-box-shadow: 0 4px 0 -2px rgba(46,51,64,0.1);
      box-shadow: 0 4px 0 -2px rgba(46,51,64,0.1);
    }';
  }


  /**
   * Footer
   * -------------------------------------------------------------
   */

  // Footer widgets height (id: footer_widgets_height)
  $footer_widgets_height = get_theme_mod('footer_widgets_height');
  if ($footer_widgets_height) {
    $inline_styles .= '
    #bwp-footer-widgets-wrap .bwp-widget {
      min-height: '.$footer_widgets_height.'px;
    }';
  }


  /**
   * Fonts
   * -------------------------------------------------------------
   */

  // Headings: Font family (id: headings_font_family)
  $headings_font_family = get_theme_mod('headings_font_family', 'Lato');
  if ($headings_font_family && $headings_font_family != 'Lato') {
    $inline_styles .= '
    h1, h2, h3, h4, h5, h6 {
      font-family: "'.$headings_font_family.'", sans-serif;
    }';
  }

  // Content: Font family (id: content_font_family)
  $content_font_family = get_theme_mod('content_font_family', 'Lato');
  if ($content_font_family && $content_font_family != 'Lato') {
    $inline_styles .= '
    body,
    .bwp-about-author-name,
    .comment-reply-title #cancel-comment-reply-link,
    .widget_search #searchform .bwp-search-field,
    .mfp-title,
    .mfp-counter,
    .tooltip-inner {
      font-family: "'.$content_font_family.'", sans-serif;
    }';
  }

  // Metadata: Font family (id: metadata_font_family)
  $metadata_font_family = get_theme_mod('metadata_font_family', 'Lato');
  if ($metadata_font_family && $metadata_font_family != 'Lato') {
    $inline_styles .= '
    .bwp-post-details-wrap,
    .bwp-single-share-wrap span,
    .bwp-single-counters li,
    .bwp-single-metadata li,
    .comment-meta .comment-metadata time,
    .widget_bwp_meta li {
      font-family: "'.$metadata_font_family.'", sans-serif;
    }';
  }

  // Quotes (blockquote items): Font family (id: blockquote_font_family)
  $blockquote_font_family = get_theme_mod('blockquote_font_family', 'Noto Serif');
  if ($blockquote_font_family && $blockquote_font_family != 'Noto Serif') {
    $inline_styles .= '
    blockquote,
    blockquote:before {
      font-family: "'.$blockquote_font_family.'", serif;
    }';
  }

  // Logo: Font family (id: text_logo_font_family)
  $text_logo_font_family = get_theme_mod('text_logo_font_family', 'Lato');
  if ($text_logo_font_family && $text_logo_font_family != 'Lato') {
    $inline_styles .= '
    .bwp-logo-text {
      font-family: "'.$text_logo_font_family.'", sans-serif;
    }';
  }

  // Menu: Font family (id: menu_font_family)
  $menu_font_family = get_theme_mod('menu_font_family', 'Lato');
  if ($menu_font_family && $menu_font_family != 'Lato') {
    $inline_styles .= '
    ul.sf-menu a,
    .bwp-mobile-menu li a,
    .bwp-dropdown-search-container #searchform .bwp-search-field {
      font-family: "'.$menu_font_family.'", sans-serif;
    }';
  }

  // Content: Font size (id: main_content_font_size)
  $main_content_font_size = get_theme_mod('main_content_font_size', 16);
  if ($main_content_font_size && $main_content_font_size != 16) {
    // font size + 1px
    $main_content_font_size_b1px = $main_content_font_size + 1;
    // font size + 4px
    $main_content_font_size_b4px = $main_content_font_size + 4;
    // font size + 5px
    $main_content_font_size_b5px = $main_content_font_size + 5;
    // styles
    $inline_styles .= '
    body,
    pre,
    .bwp-post-excerpt,
    .bwp-post-excerpt.bwp-content,
    .pagination .nav-links .page-numbers,
    .posts-navigation .nav-links a,
    #infscr-loading div,
    .bwp-load-more-button,
    .bwp-loading-posts,
    .bwp-load-more-done,
    .bwp-content,
    .bwp-content button,
    .bwp-content button[disabled]:hover,
    .bwp-content button[disabled]:focus,
    .bwp-content input[type="button"],
    .bwp-content input[type="button"][disabled]:hover,
    .bwp-content input[type="button"][disabled]:focus,
    .bwp-content input[type="reset"],
    .bwp-content input[type="reset"][disabled]:hover,
    .bwp-content input[type="reset"][disabled]:focus,
    .bwp-content input[type="submit"],
    .bwp-content input[type="submit"][disabled]:hover,
    .bwp-content input[type="submit"][disabled]:focus,
    .bwp-single-pagination-wrap > span,
    .bwp-single-pagination-wrap a,
    .post-navigation .nav-links a,
    .bwp-about-author-name span,
    .bwp-about-author-bio,
    #commentform #submit,
    .comment-reply-title #cancel-comment-reply-link,
    .comment-content,
    .comment-navigation .nav-links a,
    .bwp-widget,
    .widget_search #searchform .bwp-search-field,
    .widget_rss ul li a,
    .bwp-footer-text,
    .mfp-title,
    .mfp-counter,
    .tooltip-inner {
      font-size: '.$main_content_font_size.'px;
    }
    .widget_tag_cloud a {
      font-size: '.$main_content_font_size.'px !important;
    }
    .bwp-post-status-format .bwp-post-excerpt.bwp-content {
      font-size: '.$main_content_font_size_b4px.'px;
    }
    .post-navigation .nav-links a .meta-nav,
    .bwp-about-author-name {
      font-size: '.$main_content_font_size_b1px.'px;
    }
    legend {
      font-size: '.$main_content_font_size_b5px.'px;
    }
    @media (max-width: 540px) {
      .post-navigation .nav-links a .meta-nav {
        font-size: '.$main_content_font_size.'px;
      }
    }';
  }

  // Logo: Font size (id: text_logo_font_size)
  $text_logo_font_size = get_theme_mod('text_logo_font_size', 26);
  if ($text_logo_font_size && $text_logo_font_size != 26) {
    $inline_styles .= '
    .bwp-logo-text {
      font-size: '.$text_logo_font_size.'px;
    }';
  }

  // Logo: Font style (id: text_logo_font_style)
  $text_logo_font_style = get_theme_mod('text_logo_font_style', 'bold');
  if ($text_logo_font_style && $text_logo_font_style != 'bold') {
    $text_logo_font_style_css = '';
    if ($text_logo_font_style == 'normal') { $text_logo_font_style_css = 'font-weight: 400; font-style: normal;'; } else
    if ($text_logo_font_style == 'normal-italic') { $text_logo_font_style_css = 'font-weight: 400; font-style: italic;'; } else
    if ($text_logo_font_style == 'bold-italic') { $text_logo_font_style_css = 'font-weight: 700; font-style: italic;'; }
    $inline_styles .= '
    .bwp-logo-text { '.$text_logo_font_style_css.' }';
  }

  // Menu: Font size (id: menu_font_size)
  $menu_font_size = get_theme_mod('menu_font_size', 16);
  if ($menu_font_size && $menu_font_size != 16) {
    $inline_styles .= '
    ul.sf-menu a,
    #bwp-header-search-icon {
      font-size: '.$menu_font_size.'px;
    }';
  }

  // Menu: Font style (id: menu_font_style)
  $menu_font_style = get_theme_mod('menu_font_style', 'bold');
  if ($menu_font_style && $menu_font_style != 'bold') {
    $menu_font_style_css = '';
    if ($menu_font_style == 'normal') { $menu_font_style_css = 'font-weight: 400; font-style: normal;'; } else
    if ($menu_font_style == 'normal-italic') { $menu_font_style_css = 'font-weight: 400; font-style: italic;'; } else
    if ($menu_font_style == 'bold-italic') { $menu_font_style_css = 'font-weight: 700; font-style: italic;'; }
    $inline_styles .= '
    ul.sf-menu a { '.$menu_font_style_css.' }';
  }

  // Submenu: Font size (id: submenu_font_size)
  $submenu_font_size = get_theme_mod('submenu_font_size', 15);
  if ($submenu_font_size && $submenu_font_size != 15) {
    $inline_styles .= '
    ul.sf-menu ul li a,
    .bwp-dropdown-search-container #searchform .bwp-search-field,
    .bwp-mobile-menu li a {
      font-size: '.$submenu_font_size.'px;
    }';
  }

  // Submenu: Font style (id: submenu_font_style)
  $submenu_font_style = get_theme_mod('submenu_font_style', 'bold');
  if ($submenu_font_style && $submenu_font_style != 'bold') {
    $submenu_font_style_css = '';
    if ($submenu_font_style == 'normal') { $submenu_font_style_css = 'font-weight: 400; font-style: normal;'; } else
    if ($submenu_font_style == 'normal-italic') { $submenu_font_style_css = 'font-weight: 400; font-style: italic;'; } else
    if ($submenu_font_style == 'bold-italic') { $submenu_font_style_css = 'font-weight: 700; font-style: italic;'; }
    $inline_styles .= '
    ul.sf-menu ul li a,
    .bwp-mobile-menu li a { '.$submenu_font_style_css.' }';
  }

  // Header custom text: Title font size (id: header_custom_title_font_size)
  $header_custom_title_font_size = get_theme_mod('header_custom_title_font_size', 66);
  if ($header_custom_title_font_size && $header_custom_title_font_size != 66) {
    $inline_styles .= '
    .bwp-header-custom-title {
      font-size: '.$header_custom_title_font_size.'px;
    }';
  }

  // Header custom text: Title font style (id: header_custom_title_font_style)
  $header_custom_title_font_style = get_theme_mod('header_custom_title_font_style', 'bold');
  if ($header_custom_title_font_style && $header_custom_title_font_style != 'bold') {
    $header_custom_title_font_style_css = '';
    if ($header_custom_title_font_style == 'normal') { $header_custom_title_font_style_css = 'font-weight: 400; font-style: normal;'; } else
    if ($header_custom_title_font_style == 'normal-italic') { $header_custom_title_font_style_css = 'font-weight: 400; font-style: italic;'; } else
    if ($header_custom_title_font_style == 'bold-italic') { $header_custom_title_font_style_css = 'font-weight: 700; font-style: italic;'; }
    $inline_styles .= '
    .bwp-header-custom-title { '.$header_custom_title_font_style_css.' }';
  }

  // Header custom text: Subtitle font size (id: header_custom_subtitle_font_size)
  $header_custom_subtitle_font_size = get_theme_mod('header_custom_subtitle_font_size', 21);
  if ($header_custom_subtitle_font_size && $header_custom_subtitle_font_size != 21) {
    $inline_styles .= '
    .bwp-header-custom-text {
      font-size: '.$header_custom_subtitle_font_size.'px;
    }';
  }

  // Header custom text: Subtitle font style (id: header_custom_subtitle_font_style)
  $header_custom_subtitle_font_style = get_theme_mod('header_custom_subtitle_font_style', 'normal');
  if ($header_custom_subtitle_font_style && $header_custom_subtitle_font_style != 'normal') {
    $header_custom_subtitle_font_style_css = '';
    if ($header_custom_subtitle_font_style == 'normal-italic') { $header_custom_subtitle_font_style_css = 'font-weight: 400; font-style: italic;'; } else
    if ($header_custom_subtitle_font_style == 'bold') { $header_custom_subtitle_font_style_css = 'font-weight: 700; font-style: normal;'; } else
    if ($header_custom_subtitle_font_style == 'bold-italic') { $header_custom_subtitle_font_style_css = 'font-weight: 700; font-style: italic;'; }
    $inline_styles .= '
    .bwp-header-custom-text { '.$header_custom_subtitle_font_style_css.' }';
  }

  // Blog post: Title font size (id: blog_post_title_font_size)
  $blog_post_title_font_size = get_theme_mod('blog_post_title_font_size', 29);
  if ($blog_post_title_font_size && $blog_post_title_font_size != 29) {
    $inline_styles .= '
    .bwp-post-title {
      font-size: '.$blog_post_title_font_size.'px;
    }';
  }

  // Blog post: Title font style (id: blog_post_title_font_style)
  $blog_post_title_font_style = get_theme_mod('blog_post_title_font_style', 'bold');
  if ($blog_post_title_font_style && $blog_post_title_font_style != 'bold') {
    $blog_post_title_font_style_css = '';
    if ($blog_post_title_font_style == 'normal') { $blog_post_title_font_style_css = 'font-weight: 400; font-style: normal;'; } else
    if ($blog_post_title_font_style == 'normal-italic') { $blog_post_title_font_style_css = 'font-weight: 400; font-style: italic;'; } else
    if ($blog_post_title_font_style == 'bold-italic') { $blog_post_title_font_style_css = 'font-weight: 700; font-style: italic;'; }
    $inline_styles .= '
    .bwp-post-title { '.$blog_post_title_font_style_css.' }';
  }

  // Blog post: Metadata font size (id: blog_post_metadata_font_size)
  $blog_post_metadata_font_size = get_theme_mod('blog_post_metadata_font_size', 12);
  if ($blog_post_metadata_font_size && $blog_post_metadata_font_size != 12) {
    $inline_styles .= '
    .bwp-post-details-wrap {
      font-size: '.$blog_post_metadata_font_size.'px;
    }';
  }

  // Blog post: Metadata font style (id: blog_post_metadata_font_style)
  $blog_post_metadata_font_style = get_theme_mod('blog_post_metadata_font_style', 'normal');
  if ($blog_post_metadata_font_style && $blog_post_metadata_font_style != 'normal') {
    $blog_post_metadata_font_style_css = '';
    if ($blog_post_metadata_font_style == 'normal-italic') { $blog_post_metadata_font_style_css = 'font-weight: 400; font-style: italic;'; } else
    if ($blog_post_metadata_font_style == 'bold') { $blog_post_metadata_font_style_css = 'font-weight: 700; font-style: normal;'; } else
    if ($blog_post_metadata_font_style == 'bold-italic') { $blog_post_metadata_font_style_css = 'font-weight: 700; font-style: italic;'; }
    $inline_styles .= '
    .bwp-post-details-wrap { '.$blog_post_metadata_font_style_css.' }';
  }

  // Blog post: Metadata text transform (id: blog_post_metadata_transform)
  $blog_post_metadata_transform = get_theme_mod('blog_post_metadata_transform', 'uppercase');
  if ($blog_post_metadata_transform && $blog_post_metadata_transform != 'uppercase') {
    $inline_styles .= '
    .bwp-post-date,
    .bwp-read-more {
      text-transform: '.$blog_post_metadata_transform.';
    }';
  }


  // Single page: Metadata font size (id: single_metadata_font_size)
  $single_metadata_font_size = get_theme_mod('single_metadata_font_size', 16);
  if ($single_metadata_font_size && $single_metadata_font_size != 16) {
    $inline_styles .= '
    .bwp-single-share-wrap span,
    .bwp-single-counters li,
    .bwp-single-metadata li {
      font-size: '.$single_metadata_font_size.'px;
    }';
  }

  // Single page: Metadata font style (id: single_metadata_font_style)
  $single_metadata_font_style = get_theme_mod('single_metadata_font_style', 'normal');
  if ($single_metadata_font_style && $single_metadata_font_style != 'normal') {
    // css code
    $single_metadata_font_style_css = '';
    $single_share_font_style_css = '';
    if ($single_metadata_font_style == 'normal-italic') {
      $single_metadata_font_style_css = 'font-weight: 400; font-style: italic;';
      $single_share_font_style_css = 'font-style: italic;';
    } else
    if ($single_metadata_font_style == 'bold') {
      $single_metadata_font_style_css = 'font-weight: 700; font-style: normal;';
      $single_share_font_style_css = 'font-style: normal;';
    } else
    if ($single_metadata_font_style == 'bold-italic') {
      $single_metadata_font_style_css = 'font-weight: 700; font-style: italic;';
      $single_share_font_style_css = 'font-style: italic;';
    }
    // styles
    $inline_styles .= '
    .bwp-single-counters li,
    .bwp-single-metadata li { '.$single_metadata_font_style_css.' }
    .bwp-single-share-wrap span { '.$single_share_font_style_css.' }';
  }

  // Single page: Metadata text transform (id: single_metadata_transform)
  $single_metadata_transform = get_theme_mod('single_metadata_transform', 'none');
  if ($single_metadata_transform && $single_metadata_transform != 'none') {
    $inline_styles .= '
    .bwp-single-share-wrap span,
    .bwp-single-metadata li {
      text-transform: '.$single_metadata_transform.';
    }';
  }

  // Widget title font size (id: sidebar_widget_title_font_size)
  $widget_title_font_size = get_theme_mod('sidebar_widget_title_font_size', 22);
  if ($widget_title_font_size && $widget_title_font_size != 22) {
    $inline_styles .= '
    .bwp-widget-title {
      font-size: '.$widget_title_font_size.'px;
    }';
  }

  // Widget title font style (id: sidebar_widget_title_font_style)
  $widget_title_font_style = get_theme_mod('sidebar_widget_title_font_style', 'bold');
  if ($widget_title_font_style && $widget_title_font_style != 'bold') {
    $widget_title_font_style_css = '';
    if ($widget_title_font_style == 'normal') { $widget_title_font_style_css = 'font-weight: 400; font-style: normal;'; } else
    if ($widget_title_font_style == 'normal-italic') { $widget_title_font_style_css = 'font-weight: 400; font-style: italic;'; } else
    if ($widget_title_font_style == 'bold-italic') { $widget_title_font_style_css = 'font-weight: 700; font-style: italic;'; }
    $inline_styles .= '
    .bwp-widget-title { '.$widget_title_font_style_css.' }';
  }

  // Widget: Post title font size (id: sidebar_post_title_font_size)
  $sidebar_post_title_font_size = get_theme_mod('sidebar_post_title_font_size', 17);
  if ($sidebar_post_title_font_size && $sidebar_post_title_font_size != 17) {
    $inline_styles .= '
    .widget_bwp_posts_list h4,
    .widget_bwp_posts_slider_item figcaption h4,
    .widget_bwp_content h4 {
      font-size: '.$sidebar_post_title_font_size.'px;
    }';
  }

  // Widget: Post title font style (id: sidebar_post_title_font_style)
  $sidebar_post_title_font_style = get_theme_mod('sidebar_post_title_font_style', 'bold');
  if ($sidebar_post_title_font_style && $sidebar_post_title_font_style != 'bold') {
    $sidebar_post_title_font_style_css = '';
    if ($sidebar_post_title_font_style == 'normal') { $sidebar_post_title_font_style_css = 'font-weight: 400; font-style: normal;'; } else
    if ($sidebar_post_title_font_style == 'normal-italic') { $sidebar_post_title_font_style_css = 'font-weight: 400; font-style: italic;'; } else
    if ($sidebar_post_title_font_style == 'bold-italic') { $sidebar_post_title_font_style_css = 'font-weight: 700; font-style: italic;'; }
    $inline_styles .= '
    .widget_bwp_posts_list h4,
    .widget_bwp_posts_slider_item figcaption h4,
    .widget_bwp_content h4 { '.$sidebar_post_title_font_style_css.' }';
  }

  // Widget: Metadata font size (id: sidebar_metadata_font_size)
  $sidebar_metadata_font_size = get_theme_mod('sidebar_metadata_font_size', 12);
  if ($sidebar_metadata_font_size && $sidebar_metadata_font_size != 12) {
    $inline_styles .= '
    .widget_bwp_meta li {
      font-size: '.$sidebar_metadata_font_size.'px;
    }';
  }

  // Widget: Metadata font style (id: sidebar_metadata_font_style)
  $sidebar_metadata_font_style = get_theme_mod('sidebar_metadata_font_style', 'normal');
  if ($sidebar_metadata_font_style && $sidebar_metadata_font_style != 'normal') {
    $sidebar_metadata_font_style_css = '';
    if ($sidebar_metadata_font_style == 'normal-italic') { $sidebar_metadata_font_style_css = 'font-weight: 400; font-style: italic;'; } else
    if ($sidebar_metadata_font_style == 'bold') { $sidebar_metadata_font_style_css = 'font-weight: 700; font-style: normal;'; } else
    if ($sidebar_metadata_font_style == 'bold-italic') { $sidebar_metadata_font_style_css = 'font-weight: 700; font-style: italic;'; }
    $inline_styles .= '
    .widget_bwp_meta li { '.$sidebar_metadata_font_style_css.' }';
  }

  // Widget: Metadata text transform (id: sidebar_metadata_transform)
  $sidebar_metadata_transform = get_theme_mod('sidebar_metadata_transform', 'none');
  if ($sidebar_metadata_transform && $sidebar_metadata_transform != 'none') {
    $inline_styles .= '
    .widget_bwp_meta li {
      text-transform: '.$sidebar_metadata_transform.';
    }';
  }


  /**
   * Colors
   * -------------------------------------------------------------
   */

  // Main color (id: theme_main_color)
  $theme_main_color = get_theme_mod('theme_main_color', '#5275bf');
  if ($theme_main_color != '#5275bf') {
    $inline_styles .= '
    a:hover,
    .bwp-post-title a:hover,
    .bwp-post-excerpt.bwp-content .more-link:hover,
    .bwp-post-date:hover,
    .bwp-read-more:hover,
    .bwp-post-counters li a:hover,
    .jm-post-like a:hover,
    .jm-post-like a .like.pastliked,
    .jm-post-like a .count.liked,
    .jm-post-like a:hover .like.disliked,
    .jm-post-like a:hover .count.disliked,
    .jm-post-like a .like.prevliked,
    .jm-post-like a .count.alreadyliked,
    .bwp-no-results-container a,
    .bwp-no-results-container a:hover,
    .bwp-single-counters li a:hover,
    .bwp-single-counters .jm-post-like a:hover,
    .bwp-single-counters .jm-post-like a .like.pastliked,
    .bwp-single-counters .jm-post-like a .count.liked,
    .bwp-single-counters .jm-post-like a:hover .like.disliked,
    .bwp-single-counters .jm-post-like a:hover .count.disliked,
    .bwp-single-counters .jm-post-like a .like.prevliked,
    .bwp-single-counters .jm-post-like a .count.alreadyliked,
    .bwp-single-metadata li a:hover,
    .post-navigation .nav-links a:hover,
    .bwp-about-author-name a:hover,
    .bwp-about-author-social li a:hover,
    .comment-respond .must-log-in a,
    .comment-respond .must-log-in a:hover,
    #commentform .logged-in-as a:last-child,
    #commentform .logged-in-as a:last-child:hover,
    .comment-reply-title #cancel-comment-reply-link:hover,
    .pingback .comment-body a,
    .pingback .comment-body a:hover,
    .comment-meta .comment-author .fn .url:hover,
    .comment-meta .comment-metadata a:hover,
    .comment-meta .edit-link .comment-edit-link:hover,
    .comment-body .reply .comment-reply-link:hover,
    .comment-navigation .nav-links a:hover,
    .bwp-page-404-container a,
    .bwp-page-404-container a:hover,
    .bwp-widget-title a:hover,
    .widget_archive ul li a:hover,
    .widget_pages ul li a:hover,
    .widget_categories a:hover,
    .widget_recent_entries ul li a:hover,
    #wp-calendar tbody a,
    .widget_nav_menu a:hover,
    .widget_meta ul li a:hover,
    #recentcomments li a:hover,
    .widget_search #searchform .bwp-search-submit:hover,
    .widget_rss ul li a:hover,
    .widget_bwp_content h4 a:hover,
    .widget_bwp_meta li a:hover,
    .widget_bwp_posts_slider_item figcaption h4 a:hover {
      color: '.$theme_main_color.';
    }
    #wp-calendar tbody a:hover,
    #wp-calendar #next a:hover,
    #wp-calendar #prev a:hover {
      color: '.$theme_main_color.' !important;
    }
    .bwp-post-media-carousel .owl-theme .owl-controls .owl-buttons div:hover,
    .widget_bwp_posts_slider .owl-theme .owl-controls .owl-buttons div:hover {
      background: '.$theme_main_color.';
    }
    .pagination .nav-links .page-numbers.current,
    .pagination .nav-links a.page-numbers:hover,
    .posts-navigation .nav-links a:hover,
    .bwp-load-more-button:hover,
    .bwp-content button:hover,
    .bwp-content input[type="button"]:hover,
    .bwp-content input[type="reset"]:hover,
    .bwp-content input[type="submit"]:hover,
    #commentform #submit:hover,
    #wp-calendar tbody #today,
    #bwp-scroll-top:hover {
      background-color: '.$theme_main_color.';
    }
    .bwp-single-pagination-wrap > span,
    .bwp-single-pagination-wrap a:hover,
    .widget_tag_cloud a:hover,
    .w_bwp_social_i:hover {
      background-color: '.$theme_main_color.';
      border-color: '.$theme_main_color.';
    }
    @media (max-width: 540px) {
      .post-navigation .nav-links a:hover .meta-nav {
        color: '.$theme_main_color.';
      }
    }';
  }

  // Header background color (id: header_bg_color)
  // hex color
  $header_bg_color = get_theme_mod('header_bg_color', '#2e3340');
  // rgba color
  $header_bg_transparency = get_theme_mod('header_bg_transparency', 9);
  $header_bg_transparency_str = '0.'.$header_bg_transparency;
  $header_bg_transparency_float = (float)$header_bg_transparency_str;
  $header_bg_color_rgba = melissa_hex_to_rgb($header_bg_color, $header_bg_transparency_float);
  // styles
  $inline_styles .= '
  #bwp-header-wrap {
    background-color: '.$header_bg_color.';
  }
  .bwp-header-bg-overlay,
  .bwp-header-rs-bg-overlay {
    background-color: '.$header_bg_color_rgba.';
  }';

  // Logo color (id: logo_color)
  $logo_color = get_theme_mod('logo_color', '#ffffff');
  if ($logo_color != '#ffffff') {
    $inline_styles .= '
    .bwp-logo-text,
    .bwp-logo-text:focus,
    .bwp-logo-text:hover {
      color: '.$logo_color.';
    }';
  }

  // Menu link color (id: menu_link_color)
  $menu_link_color = get_theme_mod('menu_link_color', '#c1c4cc');
  if ($menu_link_color != '#c1c4cc') {
    $inline_styles .= '
    ul.sf-menu a,
    .sf-arrows .sf-with-ul:after,
    #bwp-mobile-menu-icon,
    #bwp-mobile-menu-icon:focus {
      color: '.$menu_link_color.';
    }';
  }

  // Menu hover link color (id: menu_hover_link_color)
  $menu_hover_link_color = get_theme_mod('menu_hover_link_color', '#ffffff');
  if ($menu_hover_link_color != '#ffffff') {
    $inline_styles .= '
    ul.sf-menu a:hover,
    ul.sf-menu > li:hover > a,
    ul.sf-menu > li.current-menu-item > a,
    ul.sf-menu > li.current-menu-ancestor > a,
    ul.sf-menu > li.current-menu-ancestor > .sf-with-ul:after,
    .sf-arrows > li > .sf-with-ul:focus:after,
    .sf-arrows > li:hover > .sf-with-ul:after,
    .sf-arrows > .sfHover > .sf-with-ul:after,
    #bwp-mobile-menu-icon:hover,
    #bwp-mobile-menu-icon.bwp-mobile-menu-icon-active {
      color: '.$menu_hover_link_color.';
    }';
  }

  // Submenu background color (id: submenu_bg_color)
  $submenu_bg_color = get_theme_mod('submenu_bg_color', '#ffffff');
  if ($submenu_bg_color != '#ffffff') {
    $inline_styles .= '
    ul.sf-menu ul,
    .bwp-dropdown-mobile-menu {
      background-color: '.$submenu_bg_color.';
    }
    ul.sf-menu ul:after,
    .bwp-dropdown-mobile-menu:after {
      border-right-color: '.$submenu_bg_color.';
      border-bottom-color: '.$submenu_bg_color.';
    }';
  }

  // Submenu link color (id: submenu_link_color)
  $submenu_link_color = get_theme_mod('submenu_link_color', '#3f434c');
  if ($submenu_link_color != '#3f434c') {
    $inline_styles .= '
    ul.sf-menu ul li a,
    .sf-arrows ul .sf-with-ul:after,
    .bwp-mobile-menu li a {
      color: '.$submenu_link_color.';
    }';
  }

  // Submenu hover link color (id: submenu_hover_link_color)
  $submenu_hover_link_color = get_theme_mod('submenu_hover_link_color', '#5275bf');
  if ($submenu_hover_link_color != '#5275bf') {
    $inline_styles .= '
    ul.sf-menu ul li a:hover,
    ul.sf-menu ul > li:hover > a,
    ul.sf-menu ul > li.current-menu-item > a,
    ul.sf-menu ul > li.current-menu-ancestor > a,
    ul.sf-menu ul > li.current-menu-ancestor > .sf-with-ul:after,
    .sf-arrows ul li > .sf-with-ul:focus:after,
    .sf-arrows ul li:hover > .sf-with-ul:after,
    .sf-arrows ul .sfHover > .sf-with-ul:after,
    .bwp-mobile-menu li a:hover,
    .bwp-mobile-menu li.current-menu-item > a {
      color: '.$submenu_hover_link_color.';
    }';
  }

  // Mobile menu border color (id: mobile_menu_border_color)
  $mobile_menu_border_color = get_theme_mod('mobile_menu_border_color', '#eaebec');
  if ($mobile_menu_border_color != '#eaebec') {
    $inline_styles .= '
    .bwp-mobile-menu ul {
      border-right-color: '.$mobile_menu_border_color.';
    }';
  }

  // Search icon color (id: dropdown_search_icon_color)
  $dropdown_search_icon_color = get_theme_mod('dropdown_search_icon_color', '#c1c4cc');
  if ($dropdown_search_icon_color != '#c1c4cc') {
    $inline_styles .= '
    #bwp-header-search-icon,
    #bwp-header-search-icon:focus {
      color: '.$dropdown_search_icon_color.';
    }';
  }

  // Search icon hover color (id: dropdown_search_icon_hover_color)
  $dropdown_search_icon_hover_color = get_theme_mod('dropdown_search_icon_hover_color', '#ffffff');
  if ($dropdown_search_icon_hover_color != '#ffffff') {
    $inline_styles .= '
    #bwp-header-search-icon:hover,
    #bwp-header-search-icon.bwp-search-icon-active {
      color: '.$dropdown_search_icon_hover_color.';
    }';
  }

  // Search form background color (id: dropdown_search_bg_color)
  $dropdown_search_bg_color = get_theme_mod('dropdown_search_bg_color', '#ffffff');
  if ($dropdown_search_bg_color != '#ffffff') {
    $inline_styles .= '
    .bwp-dropdown-search-container {
      background-color: '.$dropdown_search_bg_color.';
    }
    .bwp-dropdown-search-container:after {
      border-right-color: '.$dropdown_search_bg_color.';
      border-bottom-color: '.$dropdown_search_bg_color.';
    }
    .bwp-dropdown-search-container #searchform .bwp-search-field,
    .bwp-dropdown-search-container #searchform .bwp-search-submit {
      background: '.$dropdown_search_bg_color.';
    }';
  }

  // Search form text color 1 (id: dropdown_search_text_color_1)
  $dropdown_search_text_color_1 = get_theme_mod('dropdown_search_text_color_1', '#a9aeba');
  if ($dropdown_search_text_color_1 != '#a9aeba') {
    $inline_styles .= '
    .bwp-dropdown-search-container #searchform .bwp-search-field::-webkit-input-placeholder {
      color: '.$dropdown_search_text_color_1.';
    }
    .bwp-dropdown-search-container #searchform .bwp-search-field:-moz-placeholder {
      color: '.$dropdown_search_text_color_1.';
    }';
  }

  // Search form text color 2 (id: dropdown_search_text_color_2)
  $dropdown_search_text_color_2 = get_theme_mod('dropdown_search_text_color_2', '#3f434c');
  if ($dropdown_search_text_color_2 != '#3f434c') {
    $inline_styles .= '
    .bwp-dropdown-search-container #searchform .bwp-search-field,
    .bwp-dropdown-search-container #searchform .bwp-search-submit {
      color: '.$dropdown_search_text_color_2.';
    }';
  }

  // Search form hover text color (id: dropdown_search_hover_text_color)
  $dropdown_search_hover_text_color = get_theme_mod('dropdown_search_hover_text_color', '#5275bf');
  if ($dropdown_search_hover_text_color != '#5275bf') {
    $inline_styles .= '
    .bwp-dropdown-search-container #searchform .bwp-search-submit:hover {
      color: '.$dropdown_search_hover_text_color.';
    }';
  }

  // Search form border color (id: dropdown_search_border_color)
  $dropdown_search_border_color = get_theme_mod('dropdown_search_border_color', '#eaebec');
  if ($dropdown_search_border_color != '#eaebec') {
    $inline_styles .= '
    .bwp-dropdown-search-container #searchform .bwp-search-field,
    .bwp-dropdown-search-container #searchform .bwp-search-submit {
      border-bottom-color: '.$dropdown_search_border_color.';
    }';
  }

  // Header content: Title color (id: header_content_title_color)
  $header_content_title_color = get_theme_mod('header_content_title_color', '#ffffff');
  if ($header_content_title_color != '#ffffff') {
    $inline_styles .= '
    .bwp-header-custom-title {
      color: '.$header_content_title_color.';
    }';
  }

  // Header content: Subtitle color (id: header_content_subtitle_color)
  $header_content_subtitle_color = get_theme_mod('header_content_subtitle_color', '#c1c4cc');
  if ($header_content_subtitle_color != '#c1c4cc') {
    $inline_styles .= '
    .bwp-header-custom-text {
      color: '.$header_content_subtitle_color.';
    }';
  }

  // Header content: Subtitle link color (id: header_content_subtitle_link_color)
  $header_content_subtitle_link_color = get_theme_mod('header_content_subtitle_link_color', '#c1c4cc');
  if ($header_content_subtitle_link_color != '#c1c4cc') {
    $inline_styles .= '
    .bwp-header-custom-text a,
    .bwp-header-custom-text a:focus {
      color: '.$header_content_subtitle_link_color.';
    }';
  }

  // Header content: Subtitle hover link color (id: header_content_subtitle_hover_link_color)
  $header_content_subtitle_hover_link_color = get_theme_mod('header_content_subtitle_hover_link_color', '#ffffff');
  if ($header_content_subtitle_hover_link_color != '#ffffff') {
    $inline_styles .= '
    .bwp-header-custom-text a:hover {
      color: '.$header_content_subtitle_hover_link_color.';
    }';
  }

  // Header content: Bottom line background color (id: header_content_line_bg)
  // hex
  $header_content_line_bg = get_theme_mod('header_content_line_bg', '#ffffff');
  if ($header_content_line_bg != '#ffffff') {
    // rgba
    $header_content_line_bg_rgba = melissa_hex_to_rgb($header_content_line_bg, 0.4);
    // styles
    $inline_styles .= '
    .bwp-header-transparent-line .bwp-header-t-line-1 {
      background-color: '.$header_content_line_bg.';
    }
    .bwp-header-transparent-line .bwp-header-t-line-2 {
      background-color: '.$header_content_line_bg_rgba.';
    }';
  }

  // Sticky menu background color (id: sticky_menu_bg)
  $sticky_menu_bg = get_theme_mod('sticky_menu_bg', '#2e3340');
  if ($sticky_menu_bg != '#2e3340') {
    // rgba
    $sticky_menu_bg_rgba = melissa_hex_to_rgb($sticky_menu_bg, 0.9);
    // styles
    $inline_styles .= '
    #bwp-sticky-navigation-icon,
    .bwp-sticky-navigation-container,
    .bwp-sticky-navigation-container ul.sf-menu ul {
      background-color: '.$sticky_menu_bg_rgba.';
    }
    .bwp-sticky-navigation-container:after {
      border-left-color: '.$sticky_menu_bg_rgba.';
      border-top-color: '.$sticky_menu_bg_rgba.';
    }
    .bwp-sticky-navigation-container ul.sf-menu ul:after {
      border-right-color: '.$sticky_menu_bg_rgba.';
      border-bottom-color: '.$sticky_menu_bg_rgba.';
    }';
  }

  // Sticky menu link color (id: sticky_menu_link_color)
  $sticky_menu_link_color = get_theme_mod('sticky_menu_link_color', '#c1c4cc');
  if ($sticky_menu_link_color != '#c1c4cc') {
    $inline_styles .= '
    #bwp-sticky-navigation-icon,
    #bwp-sticky-navigation-icon:focus,
    .bwp-sticky-navigation-container ul.sf-menu a,
    .bwp-sticky-navigation-container .sf-arrows .sf-with-ul:after,
    .bwp-sticky-navigation-container ul.sf-menu ul li a,
    .bwp-sticky-navigation-container .sf-arrows ul .sf-with-ul:after {
      color: '.$sticky_menu_link_color.';
    }';
  }

  // Sticky menu hover link color (id: sticky_menu_hover_link_color)
  $sticky_menu_hover_link_color = get_theme_mod('sticky_menu_hover_link_color', '#ffffff');
  if ($sticky_menu_hover_link_color != '#ffffff') {
    $inline_styles .= '
    #bwp-sticky-navigation-icon:hover,
    #bwp-sticky-navigation-icon.bwp-sticky-nav-icon-active,
    .bwp-sticky-navigation-container ul.sf-menu a:hover,
    .bwp-sticky-navigation-container ul.sf-menu > li:hover > a,
    .bwp-sticky-navigation-container ul.sf-menu > li.current-menu-item > a,
    .bwp-sticky-navigation-container ul.sf-menu > li.current-menu-ancestor > a,
    .bwp-sticky-navigation-container ul.sf-menu > li.current-menu-ancestor > .sf-with-ul:after,
    .bwp-sticky-navigation-container .sf-arrows > li > .sf-with-ul:focus:after,
    .bwp-sticky-navigation-container .sf-arrows > li:hover > .sf-with-ul:after,
    .bwp-sticky-navigation-container .sf-arrows > .sfHover > .sf-with-ul:after,
    .bwp-sticky-navigation-container ul.sf-menu ul li a:hover,
    .bwp-sticky-navigation-container ul.sf-menu ul > li:hover > a,
    .bwp-sticky-navigation-container ul.sf-menu ul > li.current-menu-item > a,
    .bwp-sticky-navigation-container ul.sf-menu ul > li.current-menu-ancestor > a,
    .bwp-sticky-navigation-container ul.sf-menu ul > li.current-menu-ancestor > .sf-with-ul:after,
    .bwp-sticky-navigation-container .sf-arrows ul li > .sf-with-ul:focus:after,
    .bwp-sticky-navigation-container .sf-arrows ul li:hover > .sf-with-ul:after,
    .bwp-sticky-navigation-container .sf-arrows ul .sfHover > .sf-with-ul:after {
      color: '.$sticky_menu_hover_link_color.';
    }';
  }

  // Content background color (id: main_content_bg_color)
  $main_content_bg_color = get_theme_mod('main_content_bg_color', '#ffffff');
  if ($main_content_bg_color != '#ffffff') {
    $inline_styles .= '
    .bwp-post-wrap,
    .bwp-post-hover-icon-center span,
    .bwp-no-results-container,
    .pagination .nav-links .page-numbers,
    .posts-navigation .nav-links a,
    .bwp-load-more-button,
    .bwp-loading-posts,
    .bwp-load-more-done,
    .bwp-single-article,
    .bwp-featured-media-container,
    .bwp-single-pagination-wrap a,
    .post-navigation .nav-links a,
    .bwp-about-author-container,
    .comment-respond,
    .comment-body,
    #comments .no-comments,
    .comment-navigation .nav-links a,
    .bwp-related-post-wrap,
    .bwp-page-404-container,
    .bwp-sidebar-wrap,
    .widget_tag_cloud a,
    #wp-calendar thead tr,
    #wp-calendar tbody td,
    .w_bwp_social_i,
    #bwp-scroll-top {
      background-color: '.$main_content_bg_color.';
    }
    .bwp-content input[type="text"],
    .bwp-content input[type="email"],
    .bwp-content input[type="url"],
    .bwp-content input[type="password"],
    .bwp-content input[type="search"],
    .bwp-content input[type="tel"],
    .bwp-content input[type="number"],
    .bwp-content textarea,
    .widget_search #searchform .bwp-search-field,
    .widget_search #searchform .bwp-search-submit,
    #author,
    #email,
    #url,
    #comment,
    .widget_archive select,
    .widget_categories select,
    .textwidget select,
    .bwp-content select {
      background: '.$main_content_bg_color.';
    }';
  }

  // Content color №1 (id: main_content_color_1)
  $main_content_color_1 = get_theme_mod('main_content_color_1', '#2c2f36');
  if ($main_content_color_1 != '#2c2f36') {
    $inline_styles .= '
    h1, h2, h3, h4, h5, h6,
    .bwp-post-title,
    .bwp-post-title a,
    .bwp-post-title a:focus,
    .post-navigation .nav-links a .meta-nav,
    .post-navigation .nav-links a:hover .meta-nav,
    .bwp-about-author-name,
    .bwp-about-author-name a,
    .comment-reply-title,
    .comments-title,
    .bwp-related-posts-title,
    .bwp-widget-title,
    .bwp-widget-title a,
    .bwp-widget-title a:focus,
    .widget_bwp_content h4 a,
    .widget_bwp_posts_slider_item figcaption h4 a {
      color: '.$main_content_color_1.';
    }';
  }

  // Content color №2 (id: main_content_color_2)
  $main_content_color_2 = get_theme_mod('main_content_color_2', '#3f434c');
  if ($main_content_color_2 != '#3f434c') {
    $inline_styles .= '
    body,
    a,
    a:focus,
    code,
    kbd,
    pre,
    legend,
    blockquote:before,
    blockquote cite,
    .bwp-post-hover-icon-center span,
    .bwp-post-excerpt,
    .bwp-post-excerpt.bwp-content,
    .bwp-post-excerpt.bwp-content .more-link,
    .bwp-post-format-icon,
    .bwp-sticky-mark,
    .bwp-post-format-icon:focus,
    .bwp-post-format-icon:hover,
    .pagination .nav-links .page-numbers,
    .posts-navigation .nav-links a,
    .bwp-load-more-button,
    .bwp-loading-posts,
    .bwp-load-more-done,
    .bwp-single-share-wrap span,
    .bwp-single-counters li,
    .bwp-single-counters li.bwp-views-count,
    .bwp-single-counters li a,
    .bwp-single-counters .jm-post-like a,
    .bwp-single-counters .jm-post-like a:hover .like.pastliked,
    .bwp-single-counters .jm-post-like a:hover .count.liked,
    .bwp-single-counters .jm-post-like a .like.disliked,
    .bwp-single-counters .jm-post-like a .count.disliked,
    .bwp-single-counters .jm-post-like a:hover .like.prevliked,
    .bwp-single-counters .jm-post-like a:hover .count.alreadyliked,
    .bwp-single-metadata li,
    .bwp-single-metadata li a,
    .bwp-content,
    .bwp-content input[type="text"],
    .bwp-content input[type="email"],
    .bwp-content input[type="url"],
    .bwp-content input[type="password"],
    .bwp-content input[type="search"],
    .bwp-content input[type="tel"],
    .bwp-content input[type="number"],
    .bwp-content textarea,
    .post-navigation .nav-links a,
    .bwp-about-author-bio,
    .bwp-about-author-social li a,
    #commentform label,
    #author,
    #email,
    #url,
    #comment,
    .comment-respond .must-log-in,
    #commentform .logged-in-as,
    #commentform .logged-in-as a,
    .comment-reply-title #cancel-comment-reply-link,
    .comment-meta .comment-author .fn .url,
    .comment-meta .edit-link .comment-edit-link,
    .comment-content,
    .comment-body .reply .comment-reply-link,
    .comment-navigation .nav-links a,
    .bwp-widget,
    .widget_archive ul li a,
    .widget_pages ul li a,
    .widget_categories a,
    .widget_recent_entries ul li a,
    .widget_tag_cloud a,
    #wp-calendar caption,
    #wp-calendar #next a,
    #wp-calendar #prev a,
    .widget_nav_menu a,
    .widget_meta ul li a,
    #recentcomments li a,
    .widget_search #searchform .bwp-search-field,
    .widget_search #searchform .bwp-search-submit,
    .widget_rss ul li a,
    .w_bwp_social_i,
    #bwp-scroll-top {
      color: '.$main_content_color_2.';
    }
    abbr,
    acronym {
      border-bottom-color: '.$main_content_color_2.' !important;
    }
    .bwp-single-pagination-wrap a {
      color: '.$main_content_color_2.' !important;
    }';
  }

  // Content color №3 (id: main_content_color_3)
  $main_content_color_3 = get_theme_mod('main_content_color_3', '#a9aeba');
  if ($main_content_color_3 != '#a9aeba') {
    $inline_styles .= '
    .bwp-post-date,
    .bwp-post-date:focus,
    .bwp-read-more,
    .bwp-read-more:focus,
    .bwp-post-counters li,
    .bwp-post-counters li a,
    .bwp-post-counters li.bwp-views-count a:focus,
    .jm-post-like a,
    .jm-post-like a:hover .like.pastliked,
    .jm-post-like a:hover .count.liked,
    .jm-post-like a .like.disliked,
    .jm-post-like a .count.disliked,
    .jm-post-like a:hover .like.prevliked,
    .jm-post-like a:hover .count.alreadyliked,
    #commentform .comment-notes,
    .comment-meta .comment-metadata,
    .comment-meta .comment-metadata a,
    .widget_archive ul li,
    .widget_categories ul li,
    .widget_recent_entries ul li .post-date,
    #recentcomments li,
    .widget_rss ul li .rss-date,
    .widget_rss ul li cite,
    .widget_bwp_meta li,
    .widget_bwp_meta li a {
      color: '.$main_content_color_3.';
    }
    .widget_search #searchform .bwp-search-field::-webkit-input-placeholder {
      color: '.$main_content_color_3.';
    }
    .widget_search #searchform .bwp-search-field:-moz-placeholder {
      color: '.$main_content_color_3.';
    }';
  }

  // Main content: Link color (id: main_content_link_color)
  $main_content_link_color = get_theme_mod('main_content_link_color', '#5275bf');
  if ($main_content_link_color != '#5275bf') {
    $inline_styles .= '
    .bwp-content a,
    .comment-content a,
    .bwp-post-quote a {
      color: '.$main_content_link_color.';
    }';
  }

  // Main content: Hover link color (id: main_content_hover_link_color)
  $main_content_hover_link_color = get_theme_mod('main_content_hover_link_color', '#5275bf');
  if ($main_content_hover_link_color != '#5275bf') {
    $inline_styles .= '
    .bwp-content a:hover,
    .comment-content a:hover,
    .bwp-post-quote a:hover {
      color: '.$main_content_hover_link_color.';
    }';
  }

  // Main content: Line color (id: main_content_line_color)
  $main_content_line_color = get_theme_mod('main_content_line_color', '#eaebec');
  if ($main_content_line_color != '#eaebec') {
    $inline_styles .= '
    legend,
    #wp-calendar tbody tr {
      border-bottom-color: '.$main_content_line_color.';
    }
    hr,
    .bwp-content .wp-playlist,
    .bwp-content table td,
    .comment-content table td,
    .bwp-content table th,
    .comment-content table th,
    .bwp-content input[type="text"],
    .bwp-content input[type="email"],
    .bwp-content input[type="url"],
    .bwp-content input[type="password"],
    .bwp-content input[type="search"],
    .bwp-content input[type="tel"],
    .bwp-content input[type="number"],
    .bwp-content textarea,
    .bwp-content select,
    .bwp-single-pagination-wrap a,
    .widget_archive select,
    .widget_categories select,
    .widget_tag_cloud a,
    #wp-calendar thead tr,
    .textwidget select,
    .widget_search #searchform .bwp-search-field,
    .widget_search #searchform .bwp-search-submit,
    .w_bwp_social_i,
    #author,
    #email,
    #url,
    #comment {
      border-color: '.$main_content_line_color.';
    }
    .bwp-widget-line {
      background-color: '.$main_content_line_color.';
    }
    .widget_pages ul ul,
    .widget_categories ul ul,
    .widget_nav_menu ul ul {
      border-left-color: '.$main_content_line_color.';
    }
    #wp-calendar tbody {
      border-right-color: '.$main_content_line_color.';
      border-left-color: '.$main_content_line_color.';
    }
    .bwp-single-metadata-wrap {
      border-top-color: '.$main_content_line_color.';
    }
    .wp-caption {
      -webkit-box-shadow: inset 0 0 0 1px '.$main_content_line_color.';
      -moz-box-shadow: inset 0 0 0 1px '.$main_content_line_color.';
      box-shadow: inset 0 0 0 1px '.$main_content_line_color.';
    }';
  }

  // Main content: Featured media hover background color (id: main_content_featured_media_hover_bg)
  $main_content_featured_media_hover_bg = get_theme_mod('main_content_featured_media_hover_bg', '#2e3340');
  if ($main_content_featured_media_hover_bg != '#2e3340') {
    $inline_styles .= '
    .bwp-post-bg-overlay,
    .widget-bwp-bg-overlay {
      background-color: '.$main_content_featured_media_hover_bg.';
    }';
  }

  // Footer widgets section: Background color (id: footer_widgets_section_bg_color)
  $footer_widgets_section_bg_color = get_theme_mod('footer_widgets_section_bg_color', '#ffffff');
  if ($footer_widgets_section_bg_color != '#ffffff') {
    $inline_styles .= '
    #bwp-footer-widgets-wrap,
    #bwp-footer-widgets-wrap .widget_tag_cloud a,
    #bwp-footer-widgets-wrap #wp-calendar tbody td,
    #bwp-footer-widgets-wrap .w_bwp_social_i,
    #bwp-footer-widgets-wrap .bwp-post-hover-icon-center span,
    #bwp-footer-widgets-wrap #wp-calendar thead tr {
      background-color: '.$footer_widgets_section_bg_color.';
    }
    #bwp-footer-widgets-wrap .widget_archive select,
    #bwp-footer-widgets-wrap .widget_categories select,
    #bwp-footer-widgets-wrap .textwidget select,
    #bwp-footer-widgets-wrap .widget_search #searchform .bwp-search-field,
    #bwp-footer-widgets-wrap .widget_search #searchform .bwp-search-submit {
      background: '.$footer_widgets_section_bg_color.';
    }';
  }

  // Footer widgets: Text color №1 (id: footer_widgets_text_color_1)
  $footer_widgets_text_color_1 = get_theme_mod('footer_widgets_text_color_1', '#2c2f36');
  if ($footer_widgets_text_color_1 != '#2c2f36') {
    $inline_styles .= '
    #bwp-footer-widgets-wrap .bwp-widget-title,
    #bwp-footer-widgets-wrap .bwp-widget-title a,
    #bwp-footer-widgets-wrap .bwp-widget-title a:focus,
    #bwp-footer-widgets-wrap .widget_bwp_content h4 a,
    #bwp-footer-widgets-wrap .widget_bwp_posts_slider_item figcaption h4 a {
      color: '.$footer_widgets_text_color_1.';
    }';
  }

  // Footer widgets: Text color №2 (id: footer_widgets_text_color_2)
  $footer_widgets_text_color_2 = get_theme_mod('footer_widgets_text_color_2', '#3f434c');
  if ($footer_widgets_text_color_2 != '#3f434c') {
    $inline_styles .= '
    #bwp-footer-widgets-wrap .bwp-widget,
    #bwp-footer-widgets-wrap .widget_archive ul li a,
    #bwp-footer-widgets-wrap .widget_pages ul li a,
    #bwp-footer-widgets-wrap .widget_categories a,
    #bwp-footer-widgets-wrap .widget_recent_entries ul li a,
    #bwp-footer-widgets-wrap .widget_tag_cloud a,
    #bwp-footer-widgets-wrap #wp-calendar caption,
    #bwp-footer-widgets-wrap #wp-calendar #next a,
    #bwp-footer-widgets-wrap #wp-calendar #prev a,
    #bwp-footer-widgets-wrap .widget_nav_menu a,
    #bwp-footer-widgets-wrap .widget_meta ul li a,
    #bwp-footer-widgets-wrap #recentcomments li a,
    #bwp-footer-widgets-wrap .widget_search #searchform .bwp-search-field,
    #bwp-footer-widgets-wrap .widget_search #searchform .bwp-search-submit,
    #bwp-footer-widgets-wrap .widget_rss ul li a,
    #bwp-footer-widgets-wrap .w_bwp_social_i,
    #bwp-footer-widgets-wrap .bwp-post-hover-icon-center span {
      color: '.$footer_widgets_text_color_2.';
    }';
  }

  // Footer widgets: Text color №3 (id: footer_widgets_text_color_3)
  $footer_widgets_text_color_3 = get_theme_mod('footer_widgets_text_color_3', '#a9aeba');
  if ($footer_widgets_text_color_3 != '#a9aeba') {
    $inline_styles .= '
    #bwp-footer-widgets-wrap .widget_archive ul li,
    #bwp-footer-widgets-wrap .widget_categories ul li,
    #bwp-footer-widgets-wrap .widget_recent_entries ul li .post-date,
    #bwp-footer-widgets-wrap #recentcomments li,
    #bwp-footer-widgets-wrap .widget_rss ul li .rss-date,
    #bwp-footer-widgets-wrap .widget_rss ul li cite,
    #bwp-footer-widgets-wrap .widget_bwp_meta li,
    #bwp-footer-widgets-wrap .widget_bwp_meta li a {
      color: '.$footer_widgets_text_color_3.';
    }
    #bwp-footer-widgets-wrap .widget_search #searchform .bwp-search-field::-webkit-input-placeholder { color: '.$footer_widgets_text_color_3.'; }
    #bwp-footer-widgets-wrap .widget_search #searchform .bwp-search-field:-moz-placeholder { color: '.$footer_widgets_text_color_3.'; }';
  }

  // Footer widgets: Hover color (id: footer_widgets_hover_color)
  $footer_widgets_hover_color = get_theme_mod('footer_widgets_hover_color', '#5275bf');
  if ($footer_widgets_hover_color != '#5275bf') {
    $inline_styles .= '
    #bwp-footer-widgets-wrap .bwp-widget-title a:hover,
    #bwp-footer-widgets-wrap .widget_archive ul li a:hover,
    #bwp-footer-widgets-wrap .widget_pages ul li a:hover,
    #bwp-footer-widgets-wrap .widget_categories a:hover,
    #bwp-footer-widgets-wrap .widget_recent_entries ul li a:hover,
    #bwp-footer-widgets-wrap .widget_nav_menu a:hover,
    #bwp-footer-widgets-wrap .widget_meta ul li a:hover,
    #bwp-footer-widgets-wrap #recentcomments li a:hover,
    #bwp-footer-widgets-wrap .widget_search #searchform .bwp-search-submit:hover,
    #bwp-footer-widgets-wrap .widget_rss ul li a:hover,
    #bwp-footer-widgets-wrap .widget_bwp_content h4 a:hover,
    #bwp-footer-widgets-wrap .widget_bwp_meta li a:hover,
    #bwp-footer-widgets-wrap .widget_bwp_posts_slider_item figcaption h4 a:hover,
    #bwp-footer-widgets-wrap #wp-calendar tbody a {
      color: '.$footer_widgets_hover_color.';
    }
    #bwp-footer-widgets-wrap .widget_tag_cloud a:hover,
    #bwp-footer-widgets-wrap .w_bwp_social_i:hover {
      background-color: '.$footer_widgets_hover_color.';
      border-color: '.$footer_widgets_hover_color.';
    }
    #bwp-footer-widgets-wrap #wp-calendar tbody a:hover,
    #bwp-footer-widgets-wrap #wp-calendar #next a:hover,
    #bwp-footer-widgets-wrap #wp-calendar #prev a:hover {
      color: '.$footer_widgets_hover_color.' !important;
    }
    #bwp-footer-widgets-wrap #wp-calendar tbody #today {
      background-color: '.$footer_widgets_hover_color.';
    }
    #bwp-footer-widgets-wrap .widget_bwp_posts_slider .owl-theme .owl-controls .owl-buttons div:hover {
      background: '.$footer_widgets_hover_color.';
    }';
  }

  // Footer widgets: Line color (id: footer_widgets_line_color)
  $footer_widgets_line_color = get_theme_mod('footer_widgets_line_color', '#eaebec');
  if ($footer_widgets_line_color != '#eaebec') {
    $inline_styles .= '
    #bwp-footer-widgets-wrap .bwp-widget-line {
      background-color: '.$footer_widgets_line_color.';
    }
    #bwp-footer-widgets-wrap .widget_archive select,
    #bwp-footer-widgets-wrap .widget_categories select,
    #bwp-footer-widgets-wrap .widget_tag_cloud a,
    #bwp-footer-widgets-wrap .textwidget select,
    #bwp-footer-widgets-wrap .widget_search #searchform .bwp-search-field,
    #bwp-footer-widgets-wrap .widget_search #searchform .bwp-search-submit,
    #bwp-footer-widgets-wrap .w_bwp_social_i,
    #bwp-footer-widgets-wrap #wp-calendar thead tr {
      border-color: '.$footer_widgets_line_color.';
    }
    #bwp-footer-widgets-wrap .widget_pages ul ul,
    #bwp-footer-widgets-wrap .widget_categories ul ul,
    #bwp-footer-widgets-wrap .widget_nav_menu ul ul {
      border-left-color: '.$footer_widgets_line_color.';
    }
    .bwp-footer-widgets-container .bwp-footer-col-1,
    .bwp-footer-widgets-container .bwp-footer-col-2 {
      border-right-color: '.$footer_widgets_line_color.';
    }
    #bwp-footer-widgets-wrap #wp-calendar tbody {
      border-right-color: '.$footer_widgets_line_color.';
      border-left-color: '.$footer_widgets_line_color.';
    }
    #bwp-footer-widgets-wrap #wp-calendar tbody tr {
      border-bottom-color: '.$footer_widgets_line_color.';
    }';
  }

  // Footer widgets: Thumbnail hover background color (id: footer_widgets_thumbnail_hover_bg)
  $footer_widgets_thumbnail_hover_bg = get_theme_mod('footer_widgets_thumbnail_hover_bg', '#2e3340');
  if ($footer_widgets_thumbnail_hover_bg != '#2e3340') {
    $inline_styles .= '
    #bwp-footer-widgets-wrap .widget-bwp-bg-overlay {
      background-color: '.$footer_widgets_thumbnail_hover_bg.';
    }';
  }

  // Footer background color (id: footer_bg_color)
  $footer_bg_color = get_theme_mod('footer_bg_color', '#ffffff');
  if ($footer_bg_color != '#ffffff') {
    $inline_styles .= '
    #bwp-footer-wrap {
      background-color: '.$footer_bg_color.';
    }';
  }

  // Footer text color (id: footer_text_color)
  $footer_text_color = get_theme_mod('footer_text_color', '#3f434c');
  if ($footer_text_color != '#3f434c') {
    $inline_styles .= '
    .bwp-footer-text {
      color: '.$footer_text_color.';
    }';
  }

  // Footer link color (id: footer_link_color)
  $footer_link_color = get_theme_mod('footer_link_color', '#3f434c');
  if ($footer_link_color != '#3f434c') {
    $inline_styles .= '
    .bwp-footer-text a,
    .bwp-footer-text a:focus {
      color: '.$footer_link_color.';
    }';
  }

  // Footer hover link color (id: footer_hover_link_color)
  $footer_hover_link_color = get_theme_mod('footer_hover_link_color', '#5275bf');
  if ($footer_hover_link_color != '#5275bf') {
    $inline_styles .= '
    .bwp-footer-text a:hover {
      color: '.$footer_hover_link_color.';
    }';
  }

  // Social icon color (id: footer_social_icon_color)
  $footer_social_icon_color = get_theme_mod('footer_social_icon_color', '#3f434c');
  if ($footer_social_icon_color != '#3f434c') {
    $inline_styles .= '
    .bwp-footer-social-links li a,
    .bwp-footer-social-links li a:focus {
      color: '.$footer_social_icon_color.';
    }';
  }

  // Social icon hover color (id: footer_social_icon_hover_color)
  $footer_social_icon_hover_color = get_theme_mod('footer_social_icon_hover_color', '#5275bf');
  if ($footer_social_icon_hover_color != '#5275bf') {
    $inline_styles .= '
    .bwp-footer-social-links li a:hover {
      color: '.$footer_social_icon_hover_color.';
    }';
  }


  /**
   * Add inline styles (after style.css; id: melissa-style)
   * -------------------------------------------------------------
   */

  wp_add_inline_style('melissa-style', $inline_styles);


  /**
   * Custom CSS code
   * -------------------------------------------------------------
   */

  $custom_css_code = get_theme_mod('custom_css_code');
  if ($custom_css_code) {
    wp_add_inline_style('melissa-style', $custom_css_code);
  }

}
add_action('wp_enqueue_scripts', 'melissa_inline_styles');
