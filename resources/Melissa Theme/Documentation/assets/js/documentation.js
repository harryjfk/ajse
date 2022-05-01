/**
 * documentation.js
 */

jQuery.noConflict()(function($) {
  $(document).ready(function() {
    'use strict';

    /**
     * Scrollspy
     * -------------------------------------------------------------
     */

    $('body').scrollspy({
      target: '#sidebar-scrollspy-nav',
      offset: 55
    });

    /**
     * Affix
     * -------------------------------------------------------------
     */

    $('#sidebar-nav').affix({
      offset: {
        top: function() {
          return (this.top = $('#docs-header').outerHeight(true) + $('#docs-heading-section').outerHeight(true));
        },
        bottom: function() {
          return (this.bottom = $('#docs-footer').outerHeight(true));
        }
      }
    });

    /**
     * prettyPhoto lightbox
     * -------------------------------------------------------------
     */

    $("a[rel^='prettyPhoto']").prettyPhoto({
      autoplay_slideshow: false,
      opacity: 0.5,
      show_title: false,
      allow_resize: true,
      theme: 'pp_default',
      deeplinking: false,
      social_tools: false,
    });


  });
});
