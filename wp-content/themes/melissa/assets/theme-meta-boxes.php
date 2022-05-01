<?php
/**
 * Registering meta boxes (Meta Box plugin required)
 *
 * @since Melissa 1.0
 */

add_filter('rwmb_meta_boxes', 'melissa_register_meta_boxes');

function melissa_register_meta_boxes($meta_boxes) {

	$prefix = 'melissa_mb_';

  /**
   * Post meta boxes
   * -----------------------------------------------------------------------------
   *
   * General settings
   * -----------------------------------------------------------------------------
   */
  $meta_boxes[] = array(
    'id' 		    => "{$prefix}general_settings",
    'title' 	  =>  esc_html__('General Settings', 'melissa'),
    'pages' 	  => array('post'),
    'context' 	=> 'normal',
    'priority' 	=> 'high',
    'fields'    => array(

      /**
       * Page layout
       * -----------------------------------------------------------------------------
       */

      // Heading
      array(
        'type' => 'heading',
        'name' => esc_html__('Page Layout', 'melissa'),
      ),

      // Option
      array(
        'name'     => esc_html__('Layout', 'melissa'),
        'id'       => "{$prefix}single_layout",
        'type'     => 'select_advanced',
        'options'  => array(
          'right_sidebar' => esc_html__('Right sidebar', 'melissa'),
          'left_sidebar'  => esc_html__('Left sidebar', 'melissa'),
          'full_width' 	  => esc_html__('Full width', 'melissa'),
          'featured_media_right' => esc_html__('Featured media - Right sidebar', 'melissa'),
          'featured_media_left' => esc_html__('Featured media - Left sidebar', 'melissa')
        ),
        'multiple'    => false,
        'placeholder' => esc_html__('Layout', 'melissa'),
      ),

      /**
       * Featured media
       * -----------------------------------------------------------------------------
       */

      // Heading
      array(
        'type' => 'heading',
        'name' => esc_html__('Featured Media', 'melissa'),
      ),

      // Option
      array(
        'name'     => esc_html__('Show Featured media on the Single page', 'melissa'),
        'desc'    => esc_html__('Show or Hide Featured Image/Video/Audio on the Single post page. Default value: Show.', 'melissa'),
        'id'       => "{$prefix}single_show_featured_media",
        'type'     => 'select_advanced',
        'options'  => array(
          'show' => esc_html__('Show', 'melissa'),
          'hide'  => esc_html__('Hide', 'melissa'),
        ),
        'multiple'    => false,
        'placeholder' => esc_html__('Show / Hide', 'melissa'),
      ),

      /**
       * Header settings
       * -----------------------------------------------------------------------------
       */

      // Heading
      array(
        'type' => 'heading',
        'name' => esc_html__('Header', 'melissa'),
      ),

      /**
       * Subtitle
       * -----------------------------------------------------------------------------
       */
      array(
        'name' => esc_html__('Subtitle', 'melissa'),
        'desc' => esc_html__('Appears on the Single post page under its Title. Allowed HTML Tags: &lt;a&gt;, &lt;span&gt;, &lt;strong&gt;, &lt;b&gt;, &lt;em&gt;, &lt;i&gt;, &lt;br&gt;. Allowed Attributes: &lt;a&gt;: href, title, target, class; &lt;span&gt;: class; &lt;i&gt;: class.', 'melissa'),
        'id'   => "{$prefix}single_subtitle",
        'type' => 'textarea',
        'cols' => 20,
        'rows' => 3,
      ),

      /**
       * Header background for this post (default background / own background)
       * -----------------------------------------------------------------------------
       */
      array(
        'name'    => esc_html__('Header background for this post', 'melissa'),
        'desc'    => esc_html__('You can select what you want to see in the header for this post: default background or own background for this post. Default value: Default background.', 'melissa'),
        'id'      => "{$prefix}single_post_header_bg",
        'type'    => 'select_advanced',
        'options' => array(
          'default_bg' => esc_html__('Default background', 'melissa'),
          'own_bg' => esc_html__('Own background', 'melissa'),
        ),
        'multiple' => false,
        'std' => 'default_bg',
        'placeholder' => esc_html__('Default/Own background', 'melissa'),
      ),

      /**
       * Header background type
       * -----------------------------------------------------------------------------
       */
      array(
        'name'    => esc_html__('Header background type', 'melissa'),
        'desc'    => esc_html__('This option is only for the second header type: Appearance > Customize > General Settings > Header Type > Header with animation. You can set an image or a video for this post in one of the following sections: "Header Image" or "Header Video". You can see these sections below. Also, the option "Header background for this post" must be set to "Own background".', 'melissa'),
        'id'      => "{$prefix}single_header_bg_type",
        'type'    => 'select_advanced',
        'options' => array(
          'image' => esc_html__('Image', 'melissa'),
          'video' => esc_html__('Video', 'melissa'),
        ),
        'multiple' => false,
        'std' => 'image',
        'placeholder' => esc_html__('Image / Video', 'melissa'),
      ),

    )
  );


  /**
   * Header image (Single post page)
   * -----------------------------------------------------------------------------
   */
  $meta_boxes[] = array(
    'id' 		    => "{$prefix}single_header_image_settings",
    'title' 	  =>  esc_html__('Header Image', 'melissa'),
    'pages' 	  => array('post'),
    'context' 	=> 'normal',
    'priority' 	=> 'high',
    'fields'    => array(

      /**
       * Upload header image
       * -----------------------------------------------------------------------------
       */
      array(
        'name' => esc_html__('Upload header image', 'melissa'),
        'id'   => "{$prefix}single_header_image",
        'type' => 'image_advanced',
        'max_file_uploads' => 1,
      ),

    )
  );


  /**
   * Header video (Single post page)
   * -----------------------------------------------------------------------------
   */
  $meta_boxes[] = array(
    'id' 		    => "{$prefix}single_header_video_settings",
    'title' 	  =>  esc_html__('Header Video', 'melissa'),
    'pages' 	  => array('post'),
    'context' 	=> 'normal',
    'priority' 	=> 'high',
    'fields'    => array(

      /**
       * Video type
       * -----------------------------------------------------------------------------
       */
      array(
        'name'    => esc_html__('Video type', 'melissa'),
        'id'      => "{$prefix}single_header_video_bg_type",
        'type'    => 'select_advanced',
        'options' => array(
          'youtube' => esc_html__('YouTube', 'melissa'),
          'vimeo'   => esc_html__('Vimeo', 'melissa'),
        ),
        'multiple' => false,
        'placeholder' => esc_html__('YouTube / Vimeo', 'melissa'),
      ),

      /**
       * Video ID
       * -----------------------------------------------------------------------------
       */
      array(
        'name'  => esc_html__('Video ID', 'melissa'),
        'id'    => "{$prefix}single_header_video_id",
        'desc'  => esc_html__('You can take it from your browser navigation bar when viewing a video on YouTube or Vimeo. Example: 03jJHUQovp0 (YouTube video ID), 69445362 (Vimeo video ID).', 'melissa'),
        'type'  => 'text',
        'clone' => false,
      ),

      /**
       * Image for video
       * -----------------------------------------------------------------------------
       */
      array(
        'name' => esc_html__('Image for your video', 'melissa'),
        'id'   => "{$prefix}single_header_video_image",
        'type' => 'image_advanced',
        'max_file_uploads' => 1,
      ),

      /**
       * Video start time
       * -----------------------------------------------------------------------------
       */
      array(
        'name'  => esc_html__('Video start time, sec.', 'melissa'),
        'id'    => "{$prefix}single_header_video_start_time",
        'desc'  => esc_html__('Example: 00:05', 'melissa'),
        'type'  => 'text',
        'clone' => false,
      ),

      /**
       * Video end time
       * -----------------------------------------------------------------------------
       */
      array(
        'name'  => esc_html__('Video end time, sec.', 'melissa'),
        'id'    => "{$prefix}single_header_video_end_time",
        'desc'  => esc_html__('Example: 01:25', 'melissa'),
        'type'  => 'text',
        'clone' => false,
      ),

      /**
       * Video aspect ratio
       * -----------------------------------------------------------------------------
       */
      array(
        'name'    => esc_html__('Video aspect ratio', 'melissa'),
        'id'      => "{$prefix}single_header_video_aspect_ratio",
        'type'    => 'select_advanced',
        'options' => array(
          '4_3' => esc_html__('4:3', 'melissa'),
          '16_9' => esc_html__('16:9', 'melissa'),
        ),
        'multiple' => false,
        'placeholder' => esc_html__('4:3 / 16:9', 'melissa'),
      ),

      /**
       * Video volume (0..100)
       * -----------------------------------------------------------------------------
       */
      array(
        'name' => esc_html__('Video volume (0..100)', 'melissa'),
        'id'   => "{$prefix}single_header_video_volume",
        'type' => 'number',
        'min'  => 0,
        'max'  => 100,
        'step' => 1,
        'std'  => 0,
      ),

    )
  );


  /**
   * Gallery format
   * -----------------------------------------------------------------------------
   */
  $meta_boxes[] = array(
    'id' 		    => "{$prefix}gallery_format",
    'title' 	  => esc_html__('Gallery Format', 'melissa'),
    'pages' 	  => array('post'),
    'context' 	=> 'normal',
    'priority' 	=> 'high',
    'fields'    => array(

      /**
       * Thumbnail type
       * -----------------------------------------------------------------------------
       */
      array(
        'name'     => esc_html__('Thumbnail type', 'melissa'),
        'id'       => "{$prefix}gallery_thumb_type",
        'type'     => 'select_advanced',
        'options'  => array(
          'featured_image'  => esc_html__('Featured Image', 'melissa'),
          'slider'          => esc_html__('Slider', 'melissa')
        ),
        'multiple'    => false,
        'placeholder' => esc_html__('Featured Image / Slider', 'melissa'),
      ),

      /**
       * Images for the gallery
       * -----------------------------------------------------------------------------
       */
      array(
        'name' 	=> esc_html__('Add Images for the Gallery', 'melissa'),
        'id' 	  => "{$prefix}gallery",
        'type' 	=> 'image_advanced',
        'max_file_uploads' 	=> 60
      )

    )
  );


  /**
   * Video format
   * -----------------------------------------------------------------------------
   */
  $meta_boxes[] = array(
    'id' 		    => "{$prefix}video_format",
    'title' 	  => esc_html__('Video Format', 'melissa'),
    'pages' 	  => array('post'),
    'context' 	=> 'normal',
    'priority' 	=> 'high',
    'fields' 	  => array(

      /**
       * Thumbnail type
       * -----------------------------------------------------------------------------
       */
      array(
        'name'     => esc_html__('Thumbnail type', 'melissa'),
        'id'       => "{$prefix}video_thumb_type",
        'type'     => 'select_advanced',
        'options'  => array(
          'iframe' => esc_html__('Video player (Iframe)', 'melissa'),
          'featured_image' => esc_html__('Featured Image', 'melissa')
        ),
        'multiple'    => false,
        'placeholder' => esc_html__('Video player / Featured Image', 'melissa'),
      ),

      /**
       * Video URL
       * -----------------------------------------------------------------------------
       */
      array(
        'name'  => esc_html__('Video URL', 'melissa'),
        'id'    => "{$prefix}video_url",
        'desc'  => esc_html__('Insert a link (URL) on a video from the popular video hosting (YouTube, Vimeo and etc.)', 'melissa'),
        'type'  => 'oembed',
      )

    )
  );


  /**
   * Audio format
   * -----------------------------------------------------------------------------
   */
  $meta_boxes[] = array(
    'id' 		    => "{$prefix}audio_format",
    'title' 	  =>  esc_html__('Audio Format', 'melissa'),
    'pages' 	  => array('post'),
    'context' 	=> 'normal',
    'priority' 	=> 'high',
    'fields'    => array(

      /**
       * Thumbnail type
       * -----------------------------------------------------------------------------
       */
      array(
        'name'     => esc_html__('Thumbnail type', 'melissa'),
        'id'       => "{$prefix}audio_thumb_type",
        'type'     => 'select_advanced',
        'options'  => array(
          'iframe' => esc_html__('Audio player (Iframe)', 'melissa'),
          'featured_image' => esc_html__('Featured Image', 'melissa')
        ),
        'multiple'    => false,
        'placeholder' => esc_html__('Audio player / Featured Image', 'melissa'),
      ),

      /**
       * Audio URL (from https://soundcloud.com)
       * -----------------------------------------------------------------------------
       */
      array(
        'name'  => esc_html__('SoundCloud URL', 'melissa'),
        'id'    => "{$prefix}audio_url",
        'desc'  => esc_html__('Insert a link (URL) on a song from the SoundCloud service', 'melissa'),
        'type'  => 'oembed',
      )

    )
  );


  /**
   * Link format
   * -----------------------------------------------------------------------------
   */
  $meta_boxes[] = array(
    'id' 		    => "{$prefix}link_format",
    'title' 	  =>  esc_html__('Link Format', 'melissa'),
    'pages' 	  => array('post'),
    'context' 	=> 'normal',
    'priority' 	=> 'high',
    'fields'    => array(

      /**
       * Target attribute
       * -----------------------------------------------------------------------------
       */
      array(
        'name'     => esc_html__('Link open in... (Target attribute)', 'melissa'),
        'id'       => "{$prefix}link_target",
        'type'     => 'select_advanced',
        'options'  => array(
          'self' => esc_html__('Current tab (_self)', 'melissa'),
          'blank' => esc_html__('New tab (_blank)', 'melissa')
        ),
        'multiple'    => false,
        'placeholder' => esc_html__('Current tab / New tab', 'melissa'),
      ),

    )
  );


  /**
   * Pages meta boxes
   * -----------------------------------------------------------------------------
   *
   * Page settings
   * -----------------------------------------------------------------------------
   */
  $meta_boxes[] = array(
    'id' 		    => "{$prefix}page_settings",
    'title' 	  => esc_html__('Page Settings', 'melissa'),
    'pages' 	  => array('page'),
    'context' 	=> 'normal',
    'priority' 	=> 'high',
    'fields' 	  => array(

      /**
       * Page layout
       * -----------------------------------------------------------------------------
       */

      // Heading
      array(
        'type' => 'heading',
        'name' => esc_html__('Page Layout', 'melissa'),
      ),

      // Option
      array(
        'name'     => esc_html__('Layout', 'melissa'),
        'id'       => "{$prefix}page_layout",
        'type'     => 'select_advanced',
        'options'  => array(
          'right_sidebar' => esc_html__('Right sidebar', 'melissa'),
          'left_sidebar'  => esc_html__('Left sidebar', 'melissa'),
          'full_width' 	  => esc_html__('Full width', 'melissa'),
        ),
        'multiple'    => false,
        'placeholder' => esc_html__('Layout', 'melissa'),
      ),

      /**
       * Featured image
       * -----------------------------------------------------------------------------
       */

      // Heading
      array(
        'type' => 'heading',
        'name' => esc_html__('Featured Image', 'melissa'),
      ),

      // Option
      array(
        'name'     => esc_html__('Show Featured image on the Page', 'melissa'),
        'desc'    => esc_html__('Show or Hide Featured image on the page. Default value: Show.', 'melissa'),
        'id'       => "{$prefix}page_show_featured_image",
        'type'     => 'select_advanced',
        'options'  => array(
          'show' => esc_html__('Show', 'melissa'),
          'hide'  => esc_html__('Hide', 'melissa'),
        ),
        'multiple'    => false,
        'placeholder' => esc_html__('Show / Hide', 'melissa'),
      ),

      /**
       * Header settings
       * -----------------------------------------------------------------------------
       */

      // Heading
      array(
        'type' => 'heading',
        'name' => esc_html__('Header', 'melissa'),
      ),

      /**
       * Page subtitle
       * -----------------------------------------------------------------------------
       */
      array(
        'name' => esc_html__('Subtitle', 'melissa'),
        'desc' => esc_html__('Appears on the page under its Title. Allowed HTML Tags: &lt;a&gt;, &lt;span&gt;, &lt;strong&gt;, &lt;b&gt;, &lt;em&gt;, &lt;i&gt;, &lt;br&gt;. Allowed Attributes: &lt;a&gt;: href, title, target, class; &lt;span&gt;: class; &lt;i&gt;: class.', 'melissa'),
        'id'   => "{$prefix}page_subtitle",
        'type' => 'textarea',
        'cols' => 20,
        'rows' => 3,
      ),

      /**
       * Header background for this page (default background / own background)
       * -----------------------------------------------------------------------------
       */
      array(
        'name'    => esc_html__('Header background for this page', 'melissa'),
        'desc'    => esc_html__('You can select what you want to see in the header for this page: default background or own background for this page. Default value: Default background.', 'melissa'),
        'id'      => "{$prefix}single_page_header_bg",
        'type'    => 'select_advanced',
        'options' => array(
          'default_bg' => esc_html__('Default background', 'melissa'),
          'own_bg' => esc_html__('Own background', 'melissa'),
        ),
        'multiple' => false,
        'std' => 'default_bg',
        'placeholder' => esc_html__('Default/Own background', 'melissa'),
      ),

      /**
       * Header background type
       * -----------------------------------------------------------------------------
       */
      array(
        'name'    => esc_html__('Header background type', 'melissa'),
        'desc'    => esc_html__('This option is only for the second header type: Appearance > Customize > General Settings > Header Type > Header with animation. You can set an image or a video for this page in one of the following sections: "Header Image" or "Header Video". You can see these sections below. Also, the option "Header background for this page" must be set to "Own background".', 'melissa'),
        'id'      => "{$prefix}page_header_bg_type",
        'type'    => 'select_advanced',
        'options' => array(
          'image' => esc_html__('Image', 'melissa'),
          'video' => esc_html__('Video', 'melissa'),
        ),
        'multiple' => false,
        'std' => 'image',
        'placeholder' => esc_html__('Image / Video', 'melissa'),
      ),

      /**
       * Other settings
       * -----------------------------------------------------------------------------
       */

      // Heading
      array(
        'type' => 'heading',
        'name' => esc_html__('Other Settings', 'melissa'),
      ),

      /**
       * Show social sharing buttons
       * -----------------------------------------------------------------------------
       */
      array(
        'name'     => esc_html__('Social sharing buttons', 'melissa'),
        'id'       => "{$prefix}page_social_share",
        'type'     => 'select_advanced',
        'options'  => array(
          'show' => esc_html__('Show', 'melissa'),
          'hide'  => esc_html__('Hide', 'melissa'),
        ),
        'multiple'    => false,
        'placeholder' => esc_html__('Show / Hide', 'melissa'),
      ),

    )
  );


  /**
   * Header image (Page)
   * -----------------------------------------------------------------------------
   */
  $meta_boxes[] = array(
    'id' 		    => "{$prefix}page_header_image_settings",
    'title' 	  => esc_html__('Header Image', 'melissa'),
    'pages' 	  => array('page'),
    'context' 	=> 'normal',
    'priority' 	=> 'high',
    'fields' 	  => array(

      /**
       * Upload header image
       * -----------------------------------------------------------------------------
       */
      array(
        'name' => esc_html__('Upload header image', 'melissa'),
        'id'   => "{$prefix}page_header_image",
        'type' => 'image_advanced',
        'max_file_uploads' => 1,
      ),

    )
  );

  /**
   * Header video (Page)
   * -----------------------------------------------------------------------------
   */
  $meta_boxes[] = array(
    'id' 		    => "{$prefix}page_header_video_settings",
    'title' 	  => esc_html__('Header Video', 'melissa'),
    'pages' 	  => array('page'),
    'context' 	=> 'normal',
    'priority' 	=> 'high',
    'fields' 	  => array(

      /**
       * Video type
       * -----------------------------------------------------------------------------
       */
      array(
        'name'    => esc_html__('Video type', 'melissa'),
        'id'      => "{$prefix}page_header_video_bg_type",
        'type'    => 'select_advanced',
        'options' => array(
          'youtube' => esc_html__('YouTube', 'melissa'),
          'vimeo'   => esc_html__('Vimeo', 'melissa'),
        ),
        'multiple' => false,
        'placeholder' => esc_html__('YouTube / Vimeo', 'melissa'),
      ),

      /**
       * Video ID
       * -----------------------------------------------------------------------------
       */
      array(
        'name'  => esc_html__('Video ID', 'melissa'),
        'id'    => "{$prefix}page_header_video_id",
        'desc'  => esc_html__('You can take it from your browser navigation bar when viewing a video on YouTube or Vimeo. Example: 03jJHUQovp0 (YouTube video ID), 69445362 (Vimeo video ID).', 'melissa'),
        'type'  => 'text',
        'clone' => false,
      ),

      /**
       * Image for video
       * -----------------------------------------------------------------------------
       */
      array(
        'name' => esc_html__('Image for your video', 'melissa'),
        'id'   => "{$prefix}page_header_video_image",
        'type' => 'image_advanced',
        'max_file_uploads' => 1,
      ),

      /**
       * Video start time
       * -----------------------------------------------------------------------------
       */
      array(
        'name'  => esc_html__('Video start time, sec.', 'melissa'),
        'id'    => "{$prefix}page_header_video_start_time",
        'desc'  => esc_html__('Example: 00:05', 'melissa'),
        'type'  => 'text',
        'clone' => false,
      ),

      /**
       * Video end time
       * -----------------------------------------------------------------------------
       */
      array(
        'name'  => esc_html__('Video end time, sec.', 'melissa'),
        'id'    => "{$prefix}page_header_video_end_time",
        'desc'  => esc_html__('Example: 01:25', 'melissa'),
        'type'  => 'text',
        'clone' => false,
      ),

      /**
       * Video aspect ratio
       * -----------------------------------------------------------------------------
       */
      array(
        'name'    => esc_html__('Video aspect ratio', 'melissa'),
        'id'      => "{$prefix}page_header_video_aspect_ratio",
        'type'    => 'select_advanced',
        'options' => array(
          '4_3' => esc_html__('4:3', 'melissa'),
          '16_9' => esc_html__('16:9', 'melissa'),
        ),
        'multiple' => false,
        'placeholder' => esc_html__('4:3 / 16:9', 'melissa'),
      ),

      /**
       * Video volume (0..100)
       * -----------------------------------------------------------------------------
       */
      array(
        'name' => esc_html__('Video volume (0..100)', 'melissa'),
        'id'   => "{$prefix}page_header_video_volume",
        'type' => 'number',
        'min'  => 0,
        'max'  => 100,
        'step' => 1,
        'std'  => 0,
      ),

    )
  );

  return $meta_boxes;
}
