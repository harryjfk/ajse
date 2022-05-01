/**
 * Show/Hide meta boxes
 *
 * @since Melissa 1.0
 */

jQuery.noConflict()(function($) {
  $(document).ready(function() {
    'use strict';

    function showMetaBox() {
      var
        $galleryBox = $('#melissa_mb_gallery_format'),
        $videoBox = $('#melissa_mb_video_format'),
        $audioBox = $('#melissa_mb_audio_format'),
        $linkBox = $('#melissa_mb_link_format');

      // Gallery format box
      if ($('input#post-format-gallery').is(':checked')) {
        $galleryBox.show();
      } else {
        $galleryBox.hide();
      }

      // Video format box
      if ($('input#post-format-video').is(':checked')) {
        $videoBox.show();
      } else {
        $videoBox.hide();
      }

      // Audio format box
      if ($('input#post-format-audio').is(':checked')) {
        $audioBox.show();
      } else {
        $audioBox.hide();
      }

      // Link format box
      if ($('input#post-format-link').is(':checked')) {
        $linkBox.show();
      } else {
        $linkBox.hide();
      }

    }

    // start "showMetaBox" function
    showMetaBox();

    // formats click
    $('#post-formats-select input').on('click', function() {
      showMetaBox();
    });

  });
});
