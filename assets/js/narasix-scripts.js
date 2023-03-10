var NARASIX = NARASIX || {};

( function( $ ) {

    // USE STRICT
    "use strict";

    var $window = $( window );
    var $document = $( document );

    NARASIX.Utility = {

        getBackendVar: function( variableName ) {
            if ( typeof window[ 'narasixVar' ] === 'undefined' ) {
                return '';
            }

            if ( arguments.length == 1 ) {
                return window[ 'narasixVar' ][ variableName ];
            } else {
                var b = arguments[ 1 ]; // take second argument
                return window[ 'narasixVar' ][ variableName ][ b ];
            }
        }

    };

    NARASIX.documentOnReady = {

        init: function() {
            NARASIX.documentOnReady.modalGlobal();
            NARASIX.documentOnReady.backToTop.init();
            NARASIX.documentOnReady.searchModalAutoFocus();
            NARASIX.documentOnReady.navbarSubMenuToggle();
            NARASIX.documentOnReady.offCanvasMenu();
            NARASIX.documentOnReady.horizonScroll();
            NARASIX.documentOnReady.navMenuActive();
            NARASIX.documentOnReady.headerSticky.init( {
                fixedHeader: '.js-sticky-header',
                headerPlaceHolder: '.js-sticky-header-holder',
            } );
            NARASIX.documentOnReady.stickySidebar();
            NARASIX.documentOnScroll.init();
        },

        /* ============================================================================
         * Modal Global
         * ==========================================================================*/
        modalGlobal: function() {
          $(document).ready(function () {
            // Open modal
            $(".modal-open").click(function () {
              var modalId = $(this).attr("data-modal");
              $(".modal").removeClass("active");
              $(".overlay").addClass("active");
              $(modalId).addClass("active fade-in");
              $("body").addClass("overflow-hidden");
            });
          
            // Close modal
            $(".overlay, .closemodal").click(function () {
              $(".overlay").removeClass("active");
              $(".modal").removeClass("active fade-in");
              $("body").removeClass("overflow-hidden");
            });
            
            // Close modal with esc
            $(document).keydown(function(event) { 
              if (event.keyCode === 27) { 
                $(".overlay").removeClass("active");
                $(".modal").removeClass("active fade-in");
                $("body").removeClass("overflow-hidden");
              }
            });
          });               
        },

        /* ============================================================================
         * Offcanvas Menu
         * ==========================================================================*/
        offCanvasMenu: function() {
          var $backdrop = $('<div class="nsix-offcanvas-backdrop"></div>');
          var $offcanvas = $('.js-nsix-offcanvas');
          var $offcanvasToggle = $('.js-nsix-offcanvas-toggle');
          var $offcanvasClose = $('.js-nsix-offcanvas-close');
          var $menuItemsHasChildren = $( '.nsix-offcanvas .offcanvas-navigation li.menu-item-has-children' );

          function closeOffcanvas() {
              $offcanvas.removeClass( 'is-active' );
              $('body').removeClass('overflow-hidden');
              $backdrop.removeClass( 'is-shown' );
              setTimeout( function() {
                  $backdrop.detach();
              }, 300 );
          }

          $backdrop.on( 'click', function() {
              closeOffcanvas();
          } );

          $offcanvasToggle.on( 'click', function( e ) {
              e.preventDefault();
              var targetID = $( this ).attr( 'href' );
              var $target = $( targetID );
              $target.toggleClass( 'is-active' );
              $('body').addClass('overflow-hidden');
              $backdrop.appendTo( document.body );
              setTimeout( function() {
                  $backdrop.addClass( 'is-shown' );
              }, 1 );
          } );

          $offcanvasClose.on( 'click', function( e ) {
              e.preventDefault();
              closeOffcanvas();
          } );

          // Toggle submenu on click
          $menuItemsHasChildren.each( function() {
              var $menuItemHasChildren = $( this );

              $menuItemHasChildren.on( 'click', 'a, li', function( e ) {
                  if ( $( e.target ).attr( 'href' ) === '#' ) {
                      e.preventDefault(); // Menu item is just a placeholder link
                  } else {
                      e.stopPropagation();
                  }
              } );

              $menuItemHasChildren.on( 'click', function() {
                  $menuItemHasChildren.toggleClass( 'is-sub-menu-opened' );
              } );
          } );
        },

        /* ============================================================================
         * Navbar Search Modal
         * ==========================================================================*/
        searchModalAutoFocus: function() {
            var $searchModal = $( '#nsix-search-modal' );

            $searchModal.on( 'shown.bs.modal', function() {
                $searchModal.find( '.search-field' ).focus();
            } );

            function search() {
                // Ambil nilai dari input pencarian
                var s = $('input[name=s]').val();
    
                // Jalankan pencarian jika input tidak kosong
                if (s) {
                    // Tampilkan spinner loading
                    $('#search-results').html('<div class="w-full grid justify-center h-44 content-center">' +
                                                  '<svg class="-ml-1 mr-3 h-5 w-5 animate-spin" fill="none" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">' +
                                                      '<circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>' +
                                                      '<path class="opacity-75" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z" fill="currentColor"/>' +
                                                  '</svg>' +
                                              '</div>');
                    // Buat request AJAX
                    $.ajax({
                        url: '<?php echo home_url( '/' ); ?>',
                        data: {
                            s: s,
                            action: 'search'
                        },
                        type: 'GET',
                        dataType: 'html',
                        success: function(response) {
                            // Tampilkan hasil pencarian di tempat yang sesuai
                            $('#search-results').html(response);
                        }
                    });
                } else {
                    // Kosongkan hasil pencarian jika input kosong
                    $('#search-results').html('');
                }
            }
    
            // Event handler untuk input pencarian
            $('input[name=s]').keyup(function() {
                search();
            });
            
        },

        /* ============================================================================
         * Navbar Sub Menu Toggle
         * ==========================================================================*/
        navbarSubMenuToggle: function() {
            var $navbarMenuItem = $( '.site-header-navigation li.menu-item-has-children' );
            $navbarMenuItem.on( 'click', function() {
                $( this ).children( '.sub-menu' ).slideToggle( 200 );
            } );
            $navbarMenuItem.on( 'click', 'a, li', function( e ) {
                e.stopPropagation();
            } );
        },

        /* ============================================================================
         * Sticky Header
         * ==========================================================================*/
        headerSticky: {
            // settings, obtained from ext
            headerPlaceHolder: '', // static header navbar.
            fixedHeader: '', // fixed header object. 
            isDisabled: false,
            isFixed: false,
            isShown: false,
            windowScrollTop: 0,
            lastWindowScrollTop: 0, // last scrollTop position, used to calculate the scroll direction
            offCheckpoint: 0, // distance from top where fixed header will be hidden.
            onCheckpoint: 0, // distance from top where fixed header can show up.

            init : function init( options ) {

                // Read the settings
                this.fixedHeader = $( options.fixedHeader );
                this.headerPlaceHolder = $( options.headerPlaceHolder );

                // Check if selectors exist
                if( !this.fixedHeader.length ) {
                    return;
                }

                $document.ready( function() {
                    // Unhide header
                    NARASIX.documentOnReady.headerSticky.fixedHeader.css( 'display', 'block' );
                    // Compute on semi dom ready
                    NARASIX.documentOnReady.headerSticky.compute();
                } );

                // Recompute when all the page + logos are loaded
                $window.load( function() {
                    NARASIX.documentOnReady.headerSticky.compute();
                    NARASIX.documentOnReady.headerSticky.updateState();
                } );

            },// End init

            compute: function compute() {
                // Set where from top fixed header starts showing up
                if( !this.headerPlaceHolder.length ) {
                    this.offCheckpoint = 500;
                } else {
                    this.offCheckpoint = $( this.headerPlaceHolder ).offset().top + $( this.headerPlaceHolder ).outerHeight( true ) + 400;
                }

                this.onCheckpoint = this.offCheckpoint + 500;

                // Compute affixed state
                if ( $window.width() < 992 ) {  // Disable on small screen
                    this.isDisabled = true;
                } else {
                    this.windowScrollTop = $window.scrollTop();
                    if ( this.offCheckpoint < this.windowScrollTop ) {
                        this.isFixed = true;
                    }
                }
            },

            updateState: function updateState(){
                // Update affixed state
                if ( this.isFixed ) {
                    this.fixedHeader.addClass( 'is-fixed' );
                } else {
                    this.fixedHeader.removeClass( 'is-fixed' );
                }

                if ( this.isShown ) {
                    this.fixedHeader.addClass( 'is-shown' );
                } else {
                    this.fixedHeader.removeClass( 'is-shown' );
                }
            },

            /**
             * Called by events on scroll
             */

            eventScroll: function eventScroll( scrollTop ) {
                var scrollDirection = '';
                var scrollDelta = 0;

                // check if disabled
                if ( this.isDisabled ) {
                    return;
                }

                // check the direction
                if ( scrollTop != this.lastWindowScrollTop ) { //compute direction only if we have different last scroll top

                    // compute the direction of the scroll
                    if ( scrollTop > this.lastWindowScrollTop ) {
                        scrollDirection = 'down';
                    } else {
                        scrollDirection = 'up';
                    }

                    //calculate the scroll delta
                    scrollDelta = Math.abs( scrollTop - this.lastWindowScrollTop );
                    this.lastWindowScrollTop = scrollTop;

                    // update affix state
                    if ( this.offCheckpoint < scrollTop ) {
                        this.isFixed = true;
                    } else {
                        this.isFixed = false;
                    }

                    // check affix state
                    if ( this.isFixed ) {
                        // We're in affixed state, let's do some check
                        if ( ( scrollDirection == 'down' ) && ( scrollDelta > 14 ) ) {
                            if ( this.isShown ) {
                                this.isShown = false; // hide menu
                            }
                        } else {
                            if ( ( !this.isShown ) && ( scrollDelta > 14 ) && ( this.onCheckpoint < scrollTop ) ) {
                                this.isShown = true; // show menu
                            }
                        }
                    } else {
                        this.isShown = false;
                    }

                    this.updateState(); // update state
                }
            }, // end eventScroll function

            /**
             * Called by events on resize
             */

            eventResize: function eventResize( windowWidth ) {
                if ( windowWidth >= 992 ) {
                    this.isDisabled = false;
                    this.fixedHeader.addClass( 'is-shown' );
                } else {
                    this.isDisabled = true;
                    this.fixedHeader.removeClass( 'is-shown' );
                }
            },
        },

        /* ============================================================================
         * Sticky sidebar
         * ==========================================================================*/
        stickySidebar: function() {
            if ( $.isFunction( $.fn.theiaStickySidebar ) ) { // check if function exists
                var stickySidebarMarginTop = NARASIX.Utility.getBackendVar( 'stickySidebarMarginTop' );
                jQuery( '.js-nsix-sticky-sidebar' ).theiaStickySidebar( {
                    additionalMarginTop: stickySidebarMarginTop,
                    additionalMarginBottom: 20,
                } );
            }
        },

         /* ============================================================================
         * Scroll Horizontal
         * ==========================================================================*/
        horizonScroll: function() {
          const sliders = document.querySelectorAll('.scrolling-wrapper');
          sliders.forEach(slider => {
              let isDown = false;
              let startX;
              let scrollLeft;

              slider.addEventListener('mousedown', (e) => {
                  let rect = slider.getBoundingClientRect();
                  isDown = true;
                  slider.classList.add('active');
                  // Get initial mouse position
                  startX = e.pageX - rect.left;
                  // Get initial scroll position in pixels from left
                  scrollLeft = slider.scrollLeft;
                  console.log(startX, scrollLeft);
              });

              slider.addEventListener('mouseleave', () => {
                  isDown = false;
                  slider.dataset.dragging = false;
                  slider.classList.remove('active');
              });

              slider.addEventListener('mouseup', () => {
                  isDown = false;
                  slider.dataset.dragging = false;
                  slider.classList.remove('active');
              });

              slider.addEventListener('mousemove', (e) => {
                  if (!isDown) return;
                  let rect = slider.getBoundingClientRect();
                  e.preventDefault();
                  slider.dataset.dragging = true;
                  // Get new mouse position
                  const x = e.pageX - rect.left;
                  // Get distance mouse has moved (new mouse position minus initial mouse position)
                  const walk = (x - startX);
                  // Update scroll position of slider from left (amount mouse has moved minus initial scroll position)
                  slider.scrollLeft = scrollLeft - walk;
                  console.log(x, walk, slider.scrollLeft);
              });
          });

        },

         /* ============================================================================
         * Nav Manu Active
         * ==========================================================================*/
        navMenuActive: function() {
          var currentUrl = window.location.href;
          var menuItems = document.querySelectorAll(".navigation .menu-item a");
          menuItems.forEach(function(item) {
            if (item.href === currentUrl) {
              item.parentElement.classList.add("active");
            } else {
              item.parentElement.classList.remove("active");
            }
          });
        },
        
        /* ============================================================================
         * Back to top btn
         * ==========================================================================*/
        backToTop: {
          backTopBtn: null,

          init: function() {
              this.backTopBtn = $( '.js-nsix-back-top-btn' );
              if ( this.backTopBtn.length ) {
                  this.backTopBtn.on( 'click', function() {
                      $( 'html, body' ).animate(
                          {
                              scrollTop: 0,
                          },
                          {
                              duration: 200,
                              easing: 'swing',
                          }
                      );
                  } );
              }
          },

          eventScroll: function eventScroll( scrollTop ) {
              if ( scrollTop > $window.height() ) {
                  this.backTopBtn.addClass( 'is-shown' );
              } else {
                  this.backTopBtn.removeClass( 'is-shown' );
              }
          },
        },
    };

    NARASIX.documentOnScroll = {
        ticking: false,
        windowScrollTop: 0, // used to store the scrollTop

        init: function() {
            window.addEventListener( 'scroll', function( e ) {
                if ( !NARASIX.documentOnScroll.ticking ) {
                    window.requestAnimationFrame( function() {
                        NARASIX.documentOnScroll.windowScrollTop = $window.scrollTop();

                        // Functions to call here
                        NARASIX.documentOnReady.backToTop.eventScroll( NARASIX.documentOnScroll.windowScrollTop );
                        NARASIX.documentOnReady.headerSticky.eventScroll( NARASIX.documentOnScroll.windowScrollTop );

                        NARASIX.documentOnScroll.ticking = false;
                    } );
                }
                NARASIX.documentOnScroll.ticking = true;
            } );
        },
    }; // NARASIX.documentOnScroll

    NARASIX.documentOnResize = {
        ticking: false,
        windowWidth: 0, // used to store window's width

        init: function() {
            window.addEventListener('resize', function(e) {
                if (!NARASIX.documentOnResize.ticking) {
                    window.requestAnimationFrame(function() {
                        NARASIX.documentOnResize.windowWidth = $window.width();

                        // Functions to call here
                        NARASIX.documentOnReady.headerSticky.eventResize( NARASIX.documentOnResize.windowWidth );

                        NARASIX.documentOnResize.ticking = false;
                    });
                }
                NARASIX.documentOnResize.ticking = true;
            });
        },
    }; // NARASIX.documentOnResize


    $document.ready( NARASIX.documentOnReady.init );
    $window.on( 'resize', NARASIX.documentOnResize.init );

} )( jQuery );
