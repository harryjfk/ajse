/**
 * Theme name: Melissa
 * theme.js v1.1.0
 */

/**
 * Table of Contents:
 *
 * 1.0 - Theme data: string -> boolean
 * 2.0 - Header type 1: Parallax
 * 3.0 - Header type 2: Slider revolution
 * 4.0 - Superfish menu
 * 5.0 - Dropdown search form
 * 6.0 - Sticky menu
 * 7.0 - Mobile menu
 * 8.0 - Masonry blog
 * 9.0 - owlCarousel: Gallery post format
 * 10.0 - Likes counter
 * 11.0 - Infinite scrolling
 * 12.0 - Blog posts: links target
 * 13.0 - magnificPopup
 * 14.0 - "Back to top" button
 * 15.0 - Tooltips
 * 16.0 - Posts slider widget (owlCarousel)
 * 17.0 - Add data-no-retina attribute to all images (fixes retina.js 404 errors)
 */

jQuery.noConflict()(function($) {
  $(document).ready(function() {
    'use strict';

    /**
     * 1.0 - Theme data: string -> boolean
     * ----------------------------------------------------
     */

    melissaData.isMobile = (melissaData.isMobile === 'true') ? true : false;
    melissaData.isSingular = (melissaData.isSingular === 'true') ? true : false;
    melissaData.adminBar = (melissaData.adminBar === 'true') ? true : false;
    melissaData.stickyNavigation = (melissaData.stickyNavigation === 'true') ? true : false;
    melissaData.isMasonry = (melissaData.isMasonry === 'true') ? true : false;
    melissaData.infiniteScroll = (melissaData.infiniteScroll === 'true') ? true : false;
    melissaData.iScrollLoadMoreBtn = (melissaData.iScrollLoadMoreBtn === 'true') ? true : false;
    melissaData.retinaDataAttr = (melissaData.retinaDataAttr === 'true') ? true : false;
    melissaData.toTopButton = (melissaData.toTopButton === 'true') ? true : false;


    /**
     * 2.0 - Header type 1: Parallax
     * ----------------------------------------------------
     */

    if (!melissaData.isMobile && melissaData.headerType == 'simple-header') {
      $('.bwp-header-bg').parallax("50%", 0.5);
    }


    /**
     * 3.0 - Header type 2: Slider revolution
     * ----------------------------------------------------
     */

    function headerSliderRevolution() {
      $('#bwp-header-hero-image').revolution({
        sliderType: 'hero',
        sliderLayout: 'fullwidth',
        responsiveLevels: [4096,1185,977,753],
        gridwidth: [1140,940,720,750],
        gridheight: [750,735,720,720],
        spinner: 'spinner4',
        parallax: {
          type: 'scroll',
          levels: [15,20,25,30,35,40,45,50,55,60],
          origo: 'slidercenter',
          speed: 2000,
          disable_onmobile: 'off',
        },
      });
    }

    // start "headerSliderRevolution" function
    if (melissaData.headerType == 'rev-slider-header') {
      headerSliderRevolution();
    }


    /**
     * 4.0 - Superfish menu
     * ----------------------------------------------------
     */

    $('ul.sf-menu').superfish({
      delay: 500,
      animation: {opacity: "show", marginTop: "13"},
      animationOut: {opacity: "hide", marginTop: "35"},
      speed: 'fast'
    });


    /**
     * 5.0 - Dropdown search form
     * ----------------------------------------------------
     */

    function dropdownSearchForm() {
      var
        $searchIcon = $('#bwp-header-search-icon'),
        $searchForm = $('.bwp-dropdown-search-container');

      // search icon - click
      $searchIcon.on('click', function() {

        if ($searchForm.hasClass('bwp-search-hidden')) {

          // show search form
          $searchForm.css('display', 'block');
          if ($searchForm.hasClass('bwpSlideDown')) {
            $searchForm.removeClass('bwpSlideDown');
          }
          $searchForm.removeClass('bwp-search-hidden').addClass('bwpSlideUp');

          // replace icon (close)
          $('#bwp-header-search-icon i').fadeOut('fast');
          $searchIcon.html('<i class="fa fa-times" style="padding-left: 2px; display: none;"></i>');
          $('#bwp-header-search-icon i').fadeIn('fast');
          $searchIcon.addClass('bwp-search-icon-active');

          // search field - focus
          if ($(window).width() > 768) {
            $('.bwp-dropdown-search-container .bwp-search-field').focus();
          }

        } else {

          // hide search form
          $searchForm.removeClass('bwpSlideUp').addClass('bwpSlideDown bwp-search-hidden');
          setTimeout(function() {
            $searchForm.attr('style', ''); // remove "display: block;" style
          }, 100);

          // replace icon (search)
          $('#bwp-header-search-icon i').fadeOut('fast');
          $searchIcon.html('<i class="fa fa-search" style="display: none;"></i>');
          $searchIcon.removeClass('bwp-search-icon-active');
          $('#bwp-header-search-icon i').fadeIn('fast');

        }

        return false;
      });
    }

    // start "dropdownSearchForm" function
    dropdownSearchForm();


    /**
     * 6.0 - Sticky menu
     * ----------------------------------------------------
     */

    // show navigation container (scroll)
    function showStickyNavigationContainer() {
      var
        $navWrap = $('.bwp-sticky-navigation-wrap'),
        showNavClass = 'bwp-sticky-navigation-show';

      if (melissaData.adminBar) {
        showNavClass = 'bwp-sticky-navigation-show-32';
      }

      $(window).scroll(function() {
        if ($(window).scrollTop() > 1000) {
          $navWrap.addClass(showNavClass);
        }	else {
          $navWrap.removeClass(showNavClass);
        }
      });

      if ($navWrap.hasClass(showNavClass)) {
        $navWrap.removeClass(showNavClass);
      }
    }

    // show sticky navigation (click)
    function showStickyNavigation() {
      var
        $navIcon = $('#bwp-sticky-navigation-icon'),
        $navContainer = $('.bwp-sticky-navigation-container');

      // navigation icon - click
      $navIcon.on('click', function() {

        if ($navContainer.hasClass('bwp-sticky-navigation-hidden')) {

          // show navigation
          $navContainer.css('display', 'block');
          if ($navContainer.hasClass('bwpSlideDown')) {
            $navContainer.removeClass('bwpSlideDown');
          }
          $navContainer.removeClass('bwp-sticky-navigation-hidden').addClass('bwpSlideUp');

          // replace icon (close)
          $('#bwp-sticky-navigation-icon i').fadeOut('fast');
          $navIcon.html('<i class="fa fa-times" style="padding-left: 2px; display: none;"></i>');
          $('#bwp-sticky-navigation-icon i').fadeIn('fast');
          $navIcon.addClass('bwp-sticky-nav-icon-active');

        } else {

          // hide navigation
          $navContainer.removeClass('bwpSlideUp').addClass('bwpSlideDown bwp-sticky-navigation-hidden');
          setTimeout(function() {
            $navContainer.attr('style', ''); // remove "display: block;" style
          }, 100);

          // replace icon (bars)
          $('#bwp-sticky-navigation-icon i').fadeOut('fast');
          $navIcon.html('<i class="fa fa-bars" style="display: none;"></i>');
          $navIcon.removeClass('bwp-sticky-nav-icon-active');
          $('#bwp-sticky-navigation-icon i').fadeIn('fast');

        }

        return false;
      });
    }

    if (melissaData.stickyNavigation && !melissaData.isMobile) {
      // start "showStickyNavigationContainer" function
      showStickyNavigationContainer();
      // start "showStickyNavigation" function
      showStickyNavigation();
    }


    /**
     * 7.0 - Mobile menu
     * ----------------------------------------------------
     */

    function showMobileNavigation() {
      var
        $navIcon = $('#bwp-mobile-menu-icon'),
        $navContainer = $('.bwp-dropdown-mobile-menu');

      // navigation icon - click
      $navIcon.on('click', function() {

        if ($navContainer.hasClass('bwp-mobile-menu-hidden')) {

          // show navigation
          $navContainer.css('display', 'block');
          if ($navContainer.hasClass('bwpSlideDown-2')) {
            $navContainer.removeClass('bwpSlideDown-2');
          }
          $navContainer.removeClass('bwp-mobile-menu-hidden').addClass('bwpSlideUp-2');

          // replace icon (close)
          $('#bwp-mobile-menu-icon i').fadeOut('fast');
          $navIcon.html('<i class="fa fa-times" style="padding-left: 2px; display: none;"></i>');
          $('#bwp-mobile-menu-icon i').fadeIn('fast');
          $navIcon.addClass('bwp-mobile-menu-icon-active');

        } else {

          // hide navigation
          $navContainer.removeClass('bwpSlideUp-2').addClass('bwpSlideDown-2 bwp-mobile-menu-hidden');
          setTimeout(function() {
            $navContainer.attr('style', ''); // remove "display: block;" style
          }, 100);

          // replace icon (bars)
          $('#bwp-mobile-menu-icon i').fadeOut('fast');
          $navIcon.html("Secciones"+'<i class="fa fa-bars" style="display: none;"></i>');
          $navIcon.removeClass('bwp-mobile-menu-icon-active');

          $('#bwp-mobile-menu-icon i').fadeIn('fast');

        }


          return false;
      });
    }

    // start "showMobileNavigation" function
    showMobileNavigation();


    /**
     * 8.0 - Masonry blog
     * ----------------------------------------------------
     */

    if (!melissaData.isSingular && melissaData.isMasonry) {
      var $masonryContainer = $('#bwp-masonry-container');
      $masonryContainer.imagesLoaded(function() {
        $masonryContainer.masonry({
          itemSelector: '.bwp-masonry-item',
          columnWidth: melissaData.masonryColumnWidth
        });
        setTimeout(function() {
          $masonryContainer.masonry('layout');
        }, 500);
      });
    }


    /**
     * 9.0 - owlCarousel: Gallery post format
     * ----------------------------------------------------
     */

    $('.bwp-post-carousel').owlCarousel({
      navigation : true,
      navigationText: ["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
      slideSpeed : 300,
      pagination: false,
      singleItem: true,
      autoPlay: false, // 4500
      stopOnHover: true,
      afterInit: function() {
        if (!melissaData.isSingular && melissaData.isMasonry) {
          $('#bwp-masonry-container').masonry();
        }
      },
      afterUpdate: function() {
        if (!melissaData.isSingular && melissaData.isMasonry) {
          $('#bwp-masonry-container').masonry();
        }
      }
    });


    /**
     * 10.0 - Likes counter
     * ----------------------------------------------------
     */

    $('body').on('click', '.jm-post-like a', function() {
      var
        heart = $(this),
        post_id = heart.data("post_id");

      $.ajax({
        type: "POST",
        url: melissaData.ajaxURL,
        data: "action=jm-post-like&nonce="+melissaData.ajaxNonce+"&jm_post_like=&post_id="+post_id,
        success: function(count) {
          if (count.indexOf("already") !== -1) {
            var lecount = count.replace("already","");
            if (lecount == 0) {
              var lecount = "0";
            }
            heart.children(".like").removeClass("pastliked prevliked").addClass("disliked").html("<i class=\"fa fa-heart-o\"></i>");
            heart.children(".count").removeClass("liked alreadyliked").addClass("disliked").text(lecount);
          } else {
            heart.children(".like").addClass("pastliked").removeClass("disliked").html("<i class=\"fa fa-heart\"></i>");
            heart.children(".count").addClass("liked").removeClass("disliked").text(count);
          }
        }
      });

      return false;
    });


    /**
     * 11.0 - Infinite scrolling
     * ----------------------------------------------------
     */

    // infinite scroll
    function runInfiniteScroll() {

      // hide pagination
      if ($('.pagination').length) {
        $('.pagination').css('display', 'none');
      }

      // start Infinite scroll
      var
        $infiniteContainer = $('#bwp-masonry-container'),
        loadingIMG = '';

      // loading IMG
      if ($(window).width() > 768) {
        loadingIMG = melissaData.templateDirectoryUri + '/img/infinite_loader.gif';
      } else {
        loadingIMG = melissaData.templateDirectoryUri + '/img/infinite_loader@2x.gif';
      }

      $infiniteContainer.infinitescroll({
          navSelector : '.pagination',
          nextSelector : '.pagination .nav-links a.page-numbers',
          itemSelector : '.bwp-masonry-item',
          loading: {
            msgText: melissaData.iScrollLoadingMsg,
            finishedMsg: melissaData.iScrollFinishedMsg,
            img: loadingIMG
          },
          errorCallback: function () {
            // "No more posts to load" message
            if (melissaData.iScrollLoadMoreBtn) {
              finishLoadMore();
            }
          }
        },
        function(newElements) {
          var
            newElementsId_str,
            newElementsId,
            tempIdArr = [],
            isSticky = false,
            stickyIdArr = [];

          // gallery format - get new elements id
          for (var i=0; i < newElements.length; i++) {
            newElementsId_str = newElements[i].id;
            newElementsId = newElementsId_str.match(/(\d+)/i);

            // if is gallery?
            if (newElements[i].className.split('format-gallery').length - 1) {
              tempIdArr.push(newElementsId[0]); // remember gallery post id
              // is sticky?
              if (newElements[i].className.split('bwp-sticky-post').length - 1) {
                isSticky = true;
                stickyIdArr.push(newElementsId[0]); // remember sticky post id
              }
            }
          }

          // hide new elements
          var $newElems = $(newElements).css({opacity: 0});

          // when images loaded
          $newElems.imagesLoaded(function() {

            // show new elements and update masonry
            $newElems.animate({opacity: 1});
            if (!melissaData.isSingular && melissaData.isMasonry) {
              $infiniteContainer.masonry('appended', $newElems, true);
            }

            // gallery format - owlCarousel
            if (tempIdArr.length) {
              for (var i=0; i < tempIdArr.length; i++) {
                $('#bwp-post-owl-carousel-' + tempIdArr[i]).owlCarousel({
                  navigation : true,
                  navigationText: ["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
                  slideSpeed : 300,
                  pagination: false,
                  singleItem: true,
                  autoPlay: false,
                  stopOnHover: true,
                  afterInit: function() {
                    if (!melissaData.isSingular && melissaData.isMasonry) {
                      $infiniteContainer.masonry();
                    }
                  },
                  afterUpdate: function() {
                    if (!melissaData.isSingular && melissaData.isMasonry) {
                      $infiniteContainer.masonry();
                    }
                  }
                });
                // if gallery format is sticky post - owlCarousel
                if (isSticky) {
                  for (var j=0; j < stickyIdArr.length; j++) {
                    $('.bwp-sticky-post #bwp-post-owl-carousel-' + stickyIdArr[j]).owlCarousel({
                      navigation : true,
                      navigationText: ["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
                      slideSpeed : 300,
                      pagination: false,
                      singleItem: true,
                      autoPlay: false,
                      stopOnHover: true,
                      afterInit: function() {
                        if (!melissaData.isSingular && melissaData.isMasonry) {
                          $infiniteContainer.masonry();
                        }
                      },
                      afterUpdate: function() {
                        if (!melissaData.isSingular && melissaData.isMasonry) {
                          $infiniteContainer.masonry();
                        }
                      }
                    });
                  }
                  stickyIdArr.length = 0;
                }
                // update masonry
                if (!melissaData.isSingular && melissaData.isMasonry) {
                  $infiniteContainer.masonry();
                }
              }
              tempIdArr.length = 0;
            }
          });

          // update "Load more" button
          if (melissaData.iScrollLoadMoreBtn) {
            updateLoadMore();
          }

          // blog posts - links target
          if (melissaData.linksTarget === '_blank') {
            addPostLinksTarget();
          }

          // Add data-no-retina attribute to images (fixes retina.js 404 errors)
          if (melissaData.retinaDataAttr) {
            addDataNoRetinaAttrIScroll();
          }

        } // end callback
      ); // end infinitescroll

    }

    // Remove "bwp-sticky-post" class
    function removeStickyPostClass() {
      var stickyPost = $('.sticky');
      if (stickyPost.length) {
        if (stickyPost.hasClass('bwp-sticky-post')) {
          stickyPost.removeClass('bwp-sticky-post');
        }
      }
    }

    // Load more button - click
    function clickLoadMore() {
      $('body').on('click', '#bwp-load-more', function() {
        $('.bwp-load-more-wrap span').fadeOut(150);
        setTimeout(function() {
          $('.bwp-load-more-wrap').html(
            '<div class="bwp-loading-posts">' +
              '<span style="display: none;">' +
                '<i class="fa fa-spinner fa-pulse"></i>' + melissaData.iScrollLoadingMsg +
              '</span>' +
            '</div>'
          );
          $('.bwp-load-more-wrap span').fadeIn(300);
          $('#bwp-masonry-container').infinitescroll('retrieve'); // show new posts
        }, 150);
        return false;
      });
    }

    // Update "Load more" button (when new content is loaded)
    function updateLoadMore() {
      setTimeout(function() {
        $('.bwp-load-more-wrap').html(
          '<a href="#" id="bwp-load-more" class="bwp-load-more-button">' +
            '<span style="display: none;">' + melissaData.loadMoreBtnText + '</span>' +
          '</a>'
        );
        $('.bwp-load-more-wrap span').fadeIn(300);
      }, 150);
    }

    // "No more posts to load" message (infinitescroll errorCallback function)
    function finishLoadMore() {
      $('.bwp-load-more-wrap span').fadeOut(150);
      setTimeout(function() {
        $('.bwp-load-more-wrap').html(
          '<div class="bwp-load-more-done">' +
            '<span style="display: none;">' + melissaData.iScrollFinishedMsg + '</span>' +
          '</div>'
        );
        $('.bwp-load-more-wrap span').fadeIn(300);
      }, 150);
    }

    // start Infinite scroll
    if (melissaData.infiniteScroll && !melissaData.iScrollLoadMoreBtn) {
      // 1 - remove 'bwp-sticky-post' class
      removeStickyPostClass();
      // 2 - run Infinite scroll
      runInfiniteScroll();
    }

    // Load more button
    if (melissaData.infiniteScroll && melissaData.iScrollLoadMoreBtn) {
      // 1 - remove 'bwp-sticky-post' class
      removeStickyPostClass();
      // 2 - run Infinite scroll
      runInfiniteScroll();
      // 3 - unbind normal behavior
      $('#bwp-masonry-container').infinitescroll('unbind');
      // 4 - click Load More button
      clickLoadMore();
    }


    /**
     * 12.0 - Blog posts: links target
     * ----------------------------------------------------
     */

    function addPostLinksTarget() {
      $('#bwp-blog-posts-wrap .bwp-post-media-link, #bwp-blog-posts-wrap .bwp-post-title a, #bwp-blog-posts-wrap .bwp-post-date, #bwp-blog-posts-wrap .bwp-views-count a, #bwp-blog-posts-wrap .more-link, #bwp-blog-posts-wrap .bwp-post-chat-format .bwp-post-format-icon, #bwp-blog-posts-wrap .bwp-post-status-format .bwp-post-format-icon').attr('target', '_blank');
    }

    // start "addPostLinksTarget()" function
    if (melissaData.linksTarget === '_blank') {
      addPostLinksTarget();
    }


    /**
     * 13.0 - magnificPopup
     * ----------------------------------------------------
     */

    // popup-image
    function popupImage() {
      $('.bwp-popup-image').magnificPopup({
        type: 'image',

        closeOnContentClick: true,
        closeMarkup: '<button title="%title%" type="button" class="mfp-close"></button>',

        fixedContentPos: true,
        fixedBgPos: true,
        overflowY: 'auto',

        removalDelay: 300,
        mainClass: 'bwp-popup-zoom-in',
        callbacks : {
          beforeOpen: function() {
            this.container.data('scrollTop', parseInt($(window).scrollTop()));
          },
          afterClose: function(){
            $('html, body').scrollTop(this.container.data('scrollTop'));
          },
        }
      });
    }

    // popup-gallery
    function popupGallery() {
      $('.bwp-popup-gallery').each(function() {
        $(this).magnificPopup({
          delegate: 'a.bwp-popup-gallery-item',
          type: 'image',
          gallery: {
            enabled: true,
            navigateByImgClick: true,
            arrowMarkup: '<button title="%title%" type="button" class="bwp-mfp-arrow bwp-mfp-arrow-%dir%"></button>',
            tPrev: 'Previous',
            tNext: 'Next',
            tCounter: '<span class="mfp-counter">%curr% of %total%</span>'
          },

          closeMarkup: '<button title="%title%" type="button" class="mfp-close"></button>',

          fixedContentPos: true,
          fixedBgPos: true,
          overflowY: 'auto',

          removalDelay: 300,
          mainClass: 'bwp-popup-zoom-in',
          callbacks : {
            beforeOpen: function() {
              this.container.data('scrollTop', parseInt($(window).scrollTop()));
            },
            afterClose: function(){
              $('html, body').scrollTop(this.container.data('scrollTop'));
            },
          }
        });
      });
    }

    // start magnificPopup
    popupImage();
    popupGallery()


    /**
     * 14.0 - "Back to top" button
     * ----------------------------------------------------
     */

    function showToTopButton() {
      var $scrollTopBtn = $('<a rel="nofollow" href="#" id="bwp-scroll-top" class="bwp-transition-4"><i class="fa fa-angle-up"></i></a>').appendTo('body');

      $scrollTopBtn.on('click', function() {
        $('html:not(:animated),body:not(:animated)').animate({scrollTop: 0}, 500);
        return false;
      });

      $(window).scroll(function() {
        if ($(window).scrollTop() > 1000) {
          $scrollTopBtn.addClass('bwp-top-btn-show');
        }	else {
          $scrollTopBtn.removeClass('bwp-top-btn-show');
        }
      });

      if ($scrollTopBtn.hasClass('bwp-top-btn-show')) {
        $scrollTopBtn.removeClass('bwp-top-btn-show');
      }
    }

    // show "Back to top" button
    if (melissaData.toTopButton) {
      showToTopButton();
    }


    /**
     * 15.0 - Tooltips
     * ----------------------------------------------------
     */

    $('.bwp-widget-tooltip').tooltip();


    /**
     * 16.0 - Posts slider widget (owlCarousel)
     * ----------------------------------------------------
     */

    $('.widget-bwp-posts-slider').owlCarousel({
      navigation : true,
      navigationText: ["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
      slideSpeed : 300,
      pagination: false,
      singleItem: true,
      autoPlay: false,
      autoHeight: true,
    });


    /**
     * 17.0 - Add data-no-retina attribute to all images (fixes retina.js 404 errors)
     * ----------------------------------------------------
     */

    function addDataNoRetinaAttr() {
      $('.bwp-logo-container img.custom-logo, .bwp-post-media img, .bwp-post-carousel-item img, .bwp-content img, .comment-content img, .bwp-about-author-avatar img, .comment-meta .comment-author img, .textwidget img, .rsswidget img, .widget_bwp_thumb img, .widget_bwp_thumbnails ul li img, .widget_bwp_posts_slider_item img, .widget_bwp_posts_list_item img').attr('data-no-retina', '');
    }
    function addDataNoRetinaAttrIScroll() {
      $('.bwp-post-media img, .bwp-post-carousel-item img, .bwp-content img').attr('data-no-retina', '');
    }

    // start "addDataNoRetinaAttr()" function
    if (melissaData.retinaDataAttr) {
      addDataNoRetinaAttr();
    }

  });
});
