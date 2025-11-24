/* global jQuery */

/**
 * Sticky Header
 * Adds a class to header on scroll
 */

jQuery(document).on('scroll', function () {
	if (jQuery(document).scrollTop() > 0) {
		jQuery('header, body').addClass('shrink');
	} else {
		jQuery('header, body').removeClass('shrink');
	}
});

// To change the "Go Back" link to its previous page.
jQuery(document).ready(function($){
    var referrer = document.referrer;
    var goBackButton = jQuery('#go-back');

    // Check if there's a referrer and it's not the current page
    if (referrer && referrer !== window.location.href) {
        goBackButton.attr('href', referrer);
    } else {
        // If directly access the location detail page link, this set it to a default page on theme option.
        goBackButton.attr('href');
    }
});

/**
 * Document Ready Function
 * Triggered when document get's ready
 */
jQuery(document).ready(function () {
  /* Custom Quote Slider */
  jQuery(".custom-quote-slider").owlCarousel({
    loop: true,
    nav: true,
    dots: true,
    autoplay: true,
    autoHeight: true,
    autoplayTimeout: 4000,
    items: 1,
  });
  jQuery.noConflict();

  // Get the header height for same height with/without adminbar
  var headerHeight = jQuery('header').outerHeight();
  jQuery('body').css('padding-top', headerHeight);

  jQuery.noConflict();

  /**
   * Toggle menu for mobile
   */
  jQuery(".menu-btn").click(function () {
    jQuery(this).toggleClass("active");
    jQuery(".nav-overlay").toggleClass("open");
    jQuery("html, body").toggleClass("no-overflow");
    jQuery(".header-nav ul li.active").removeClass("active");
    jQuery(".header-nav ul.sub-menu").slideUp();
  });
  jQuery.noConflict();

  // Hide header on scroll down
  let didScroll;
  let lastScrollTop = 0;
  const delta = 5;
  const navbarHeight = jQuery("header .top-bar").outerHeight();

  jQuery(window).scroll(function (event) {
    didScroll = true;
  });

  setInterval(function () {
    if (didScroll) {
      hasScrolled();
      didScroll = false;
    }
  }, 250);

  function hasScrolled() {
    const st = jQuery(this).scrollTop();

    // Make scroll more than delta
    if (Math.abs(lastScrollTop - st) <= delta) {
      return;
    }

    // If scrolled down and past the navbar, add class .nav-up.
    if (st > lastScrollTop && st > navbarHeight) {
      // Scroll Down
      jQuery("header").removeClass("nav-down").addClass("nav-up");
    } else {
      // Scroll Up
      if (st + jQuery(window).height() < jQuery(document).height()) {
        jQuery("header").removeClass("nav-up").addClass("nav-down");
      }
    }

    lastScrollTop = st;
  }

  /**
   * Add span tag to multi-level accordion menu for mobile menus
   */
  jQuery("li").each(function () {
    if (jQuery(this).hasClass("menu-item-has-children")) {
      jQuery(this).prepend('<span class="submenu-icon"></span>');
    }
  });

  /**
   *
   *
   *	mega drop down menu
   *
   *
   */
  /** Mobile mega Dropdown */
  jQuery(".has-mega-menu .submenu-icon").click(function () {
    jQuery(".mega-dropdown").toggleClass("active-mega-dropdown");
    jQuery(this).parent(".menu-item").toggleClass("active-dd-parent");
  });

  jQuery.noConflict();

  /**
   * Slide Up/Down internal sub-menu when mobile menu arrow clicked
   */
  jQuery(".header-nav .submenu-icon").click(function () {
    const link = jQuery(this);
    const closestUl = link.closest("ul");
    const parallelActiveLinks = closestUl.find(".active");
    const closestLi = link.closest("li");
    const linkStatus = closestLi.hasClass("active");
    const count = 0;
    if (jQuery(this).parent().find(".sub-menu").find(".back-ctn").length == 0) {
      jQuery(this)
        .parent()
        .find(".sub-menu")
        .prepend(
          '<div class="back-ctn"><a class="back-button-simple">' +
            jQuery(this).parent().find("a:first").text() +
            "</a></div>"
        );
    }
    jQuery(this).parent().addClass("active");
    jQuery(this).parent().find(".sub-menu").show();
  });

  jQuery.noConflict();

  jQuery(".mega-dropdown").appendTo(".has-mega-menu");
  if (jQuery(window).width() <= 1179) {
    jQuery(document).on("click", ".back-button-simple", function () {
      jQuery(this).parents(".sub-menu").hide();
      jQuery(this).parents(".menu-item-has-children").removeClass("active");
    });
    jQuery(document).on("click", ".back-button", function () {
      jQuery(this)
        .parents(".mega-dropdown")
        .removeClass("active-mega-dropdown");
      jQuery(this).parents(".has-mega-menu").removeClass("active");
    });

    if (
      jQuery(".has-mega-menu").find(".mega-dropdown").find(".back-ctn")
        .length == 0
    ) {
      jQuery(".has-mega-menu")
        .find(".mega-dropdown")
        .prepend(
          '<div class="back-ctn"><a class="back-button">' +
            jQuery(".has-mega-menu").find("a:first").text() +
            "</a></div>"
        );
    }
  }

  /**
   *
   *
   *	Video Popup
   *
   *
   */
  jQuery(".video-section").magnificPopup({
    type: "iframe",
  });
  jQuery(".dd-video-popup").magnificPopup({
    type: "iframe",
  });
  jQuery(".sm-inner").magnificPopup({
    type: "inline",
    midClick: true,
    mainClass: "mfp-fade",
    class: ".team-popup",
    midClick: true,
  });
  jQuery.noConflict();

  /**
   *
   *
   *	Stat counter
   *
   *
   */

  jQuery(
    (function (jQuery, win) {
      jQuery.fn.inViewport = function (cb) {
        return this.each(function (i, el) {
          function visPx() {
            const H = jQuery(this).height(),
              r = el.getBoundingClientRect(),
              t = r.top,
              b = r.bottom;
            return cb.call(el, Math.max(0, t > 0 ? H - t : b < H ? b : H));
          }
          visPx();
          jQuery(win).on("resize scroll", visPx);
        });
      };
    })(jQuery, window)
  );
  jQuery.noConflict();
  /**
   *
   *
   *	Testimonials slider
   *
   *
   */
  jQuery(".testimonials-slider").owlCarousel({
    loop: true,
    margin: 32,
    nav: true,
    dots: true,
    // stagePadding: 130,
    items: 1,
    responsive: {
      0: {
        nav: false,
        margin: 10,
        stagePadding: 20,
        autoHeight: false,
      },
      460: {
        nav: false,
        margin: 10,
        stagePadding: 20,
        autoHeight: false,
      },
      748: {
        nav: false,
        stagePadding: 20,
      },
      1003: {
        nav: true,
      },
    },
  });
  jQuery.noConflict();
  if (jQuery(".locations-slider").find(".item").length > 1) {
    jQuery(".locations-slider").owlCarousel({
      loop: true,
      margin: 0,
      nav: true,
      dots: false,
      items: 1,
    });
  }
  jQuery.noConflict();

  jQuery(".home-hero-tag-slider").owlCarousel({
    loop: true,
    margin: 0,
    nav: false,
    dots: false,
    mouseDrag: false,
    autoplay: true,
    autoplayTimeout: 4000,
    // autoplayHoverPause: true,
    checkVisible: false,
    animateOut: "fadeOut",
    animateIn: "fadeIn",
    items: 1,
  });
  jQuery.noConflict();

  jQuery(".home-hero-image-slider").owlCarousel({
    loop: true,
    margin: 0,
    nav: false,
    dots: false,
    mouseDrag: false,
    autoplay: true,
    autoplayTimeout: 4000,
    // autoplayHoverPause: true,
    checkVisible: false,
    animateOut: "fadeOut",
    animateIn: "fadeIn",
    items: 1,
  });
  jQuery.noConflict();

  //  var owl=jQuery( '.provider-teaser' ).owlCarousel( {
  // 	loop: false,
  // 	margin: 80,
  // 	nav: true,
  // 	dots: false,
  // 	items: 3,
  // 	responsive: {
  // 		0: {
  // 			items: 1,
  // 			margin: 25,
  // 			stagePadding: 0,
  // 		},
  // 		650: {
  // 			items: 2,
  // 			margin: 25,
  // 			stagePadding: 0,
  // 		},
  // 		747: {
  // 			items: 2,
  // 			margin: 40,
  // 			stagePadding: 40,
  // 		},
  // 		1003: {
  // 			items: 2,
  // 			margin: 40,
  // 			stagePadding: 0,
  // 		},
  // 		1150: {
  // 			items: 3,
  // 			margin: 40,
  // 		},
  // 	},

  // } );
  if (jQuery(window).width() < 650) {
    var number = 1;
  } else if (jQuery(window).width() < 747) {
    var number = 2;
  } else if (jQuery(window).width() < 1003) {
    var number = 2;
  } else if (jQuery(window).width() < 1150) {
    var number = 2;
  } else {
    var number = 3;
  }
  if (jQuery(".provider-teaser").find(".item").length > number) {
    // owl.owlCarousel('destroy');
    jQuery(".provider-teaser").owlCarousel({
      loop: false,
      margin: 80,
      nav: true,
      dots: false,
      items: 3,
      touchDrag: false,
      mouseDrag: false,
      responsive: {
        0: {
          items: 1,
          margin: 25,
          stagePadding: 0,
        },
        650: {
          items: 2,
          margin: 25,
          stagePadding: 0,
        },
        747: {
          items: 2,
          margin: 40,
          stagePadding: 40,
        },
        1003: {
          items: 2,
          margin: 40,
          stagePadding: 0,
        },
        1150: {
          items: 3,
          margin: 40,
        },
      },
    });
  }

  if (jQuery(window).width() > 747) {
    jQuery(".service-teaser").owlCarousel({
      loop: true,
      margin: 0,
      nav: true,
      dots: false,
      items: 4,
      responsive: {
        0: {
          items: 1,
        },
        480: {
          items: 1,
        },
        500: {
          items: 2,
        },
        768: {
          items: 3,
        },
        1004: {
          items: 4,
        },
      },
      500: {
        items: 2,
      },
      768: {
        items: 4,
      },
    });
  }
  jQuery.noConflict();
  /**
   *
   *
   *	Faqs
   *
   *
   */
//   jQuery(".faq > h3").on("click", function () {
  jQuery(document).on("click", ".faq > h3", function () {
    if (jQuery(this).parent().hasClass("active")) {
      jQuery(this).parent().removeClass("active");
      jQuery(this).siblings(".faq-content").slideUp();
    } else {
      jQuery(".faq > h3").parent().removeClass("active");
      jQuery(this).parent().addClass("active");
      jQuery(".faq-content").slideUp();
      jQuery(this).siblings(".faq-content").slideDown();
    }
  });
  /**
   *
   *
   *	Tabbs
   *
   *
   */

  if (
    jQuery(window).width() > 747 &&
    jQuery("body").hasClass("single-provider")
  ) {
    jQuery(function () {
      jQuery(".tab-content").hide();
      jQuery(".tabs-nav li:first-child").addClass("active");
      jQuery(".tab-content:first-child").show();

     jQuery(".two-col-tabs .tabs-nav li a").click(function () {
        const tabsBlock = jQuery(this).closest(".two-col-tabs");
        const tabWrapper = jQuery(this).closest('.glide-block-tabbed-content');
 
        // Check for active
        // jQuery( '.tabs-nav li' ).removeClass( 'active' );
        // jQuery(".two-col-tabs .tabs-nav li").removeClass("active");
        tabsBlock.find(".tabs-nav li").removeClass("active");
        jQuery(this).parent().addClass("active");
 
        // Display active tab
        const currentTab = jQuery(this).attr("href");
        // jQuery(".two-col-tabs .tab-content").hide();
        tabsBlock.find("div.tab-content").hide();
        // jQuery(currentTab).show();
        const tabId = currentTab.replace("#", "");
        // console.log(tabId);
        tabsBlock.find(`div.tab-content[id="${tabId}"]`).show();
       
        return false;
      });
 
      jQuery(".single-col-tabs .tabs-nav li a").click(function () {
        // Check for active
        // jQuery( '.tabs-nav li' ).removeClass( 'active' );
        const tabsBlocksg = jQuery(this).closest(".single-col-tabs");
        // jQuery(".single-col-tabs .tabs-nav li").removeClass("active");
        tabsBlocksg.find(".tabs-nav li").removeClass("active");
        jQuery(this).parent().addClass("active");
 
        // Display active tab
        const currentTab = jQuery(this).attr("href");
        // jQuery(".single-col-tabs .tab-content").hide();
        // jQuery(currentTab).show();
        tabsBlocksg.find("div.tab-content").hide();
        const tabId = currentTab.replace("#", "");
        tabsBlocksg.find(`div.tab-content[id="${tabId}"]`).show();
 
        return false;
      });
    });
    jQuery(".tabs-nav-var li:first-child").addClass("active");
    jQuery(".tab-content").hide();
    jQuery(".tab-content:first-child").show();
    jQuery(".tabs-nav-var li a").click(function () {
      // Check for active
      jQuery(".tabs-nav-var li").removeClass("active");
      jQuery(this).parent().addClass("active");
      // Display active tab
      const currentTab = jQuery(this).attr("href");
      jQuery(".tab-content").hide();
      jQuery(currentTab).show();
      return false;
    });
  } else {
    jQuery(function () {
      jQuery(".tab-content").hide();
      jQuery(".tabs-nav li:first-child").addClass("active");
      jQuery(".tab-content:first-child").show();

      jQuery(".two-col-tabs .tabs-nav li a").click(function () {
        const tabsBlock = jQuery(this).closest(".two-col-tabs");
        const tabWrapper = jQuery(this).closest('.glide-block-tabbed-content');
 
        // Check for active
        // jQuery( '.tabs-nav li' ).removeClass( 'active' );
        // jQuery(".two-col-tabs .tabs-nav li").removeClass("active");
        tabsBlock.find(".tabs-nav li").removeClass("active");
        jQuery(this).parent().addClass("active");
 
        // Display active tab
        const currentTab = jQuery(this).attr("href");
        // jQuery(".two-col-tabs .tab-content").hide();
        tabsBlock.find("div.tab-content").hide();
        // jQuery(currentTab).show();
        const tabId = currentTab.replace("#", "");
        // console.log(tabId);
        tabsBlock.find(`div.tab-content[id="${tabId}"]`).show();
       
        return false;
      });
 
      jQuery(".single-col-tabs .tabs-nav li a").click(function () {
        // Check for active
        // jQuery( '.tabs-nav li' ).removeClass( 'active' );
        const tabsBlocksg = jQuery(this).closest(".single-col-tabs");
        // jQuery(".single-col-tabs .tabs-nav li").removeClass("active");
        tabsBlocksg.find(".tabs-nav li").removeClass("active");
        jQuery(this).parent().addClass("active");
 
        // Display active tab
        const currentTab = jQuery(this).attr("href");
        // jQuery(".single-col-tabs .tab-content").hide();
        // jQuery(currentTab).show();
        tabsBlocksg.find("div.tab-content").hide();
        const tabId = currentTab.replace("#", "");
        tabsBlocksg.find(`div.tab-content[id="${tabId}"]`).show();
 
        return false;
      });

      if (jQuery("body").hasClass("single-provider")) {
        jQuery(".tabs-nav-var").parent().find(".tab-content").show();
      }
    });
    jQuery(".tabs-nav-var li:first-child").addClass("active");
    jQuery(".tab-content").hide();
    jQuery(".tab-content:first-child").show();
    jQuery(".tabs-nav-var li a").click(function () {
      // Check for active
      jQuery(".tabs-nav-var li").removeClass("active");
      jQuery(this).parent().addClass("active");
      // Display active tab
      const currentTab = jQuery(this).attr("href");
      jQuery(".tab-content").hide();
      jQuery(currentTab).show();
      return false;
    });
  }

  jQuery.noConflict();

  jQuery(function (jQuery) {
    jQuery(".animation-line").inViewport(function (px) {
      //  = Animate numbers
      if (px > 0 && !this.initNumAnim) {
        this.initNumAnim = true; // Set flag to true to prevent re-running the same animation
        jQuery(this).addClass("active");
        // setTimeout( function() {
        // 	jQuery( '.animation-line' ).removeClass( 'active' ).addClass( 'unactive' );
        // }, 4000 );
        jQuery(this).animate({
          duration: 1000,
          step(now) {
            jQuery(this).text(Math.ceil(now));
          },
        });
      }
    });
  });
  jQuery.noConflict();

  jQuery(function (jQuery) {
    jQuery(".fig_number").inViewport(function (px) {
      // Make use of the `px` argument!!!
      // if element entered V.port ( px>0 ) and
      // if prop initNumAnim flag is not yet set
      //  = Animate numbers
      if (px > 0 && !this.initNumAnim) {
        this.initNumAnim = true; // Set flag to true to prevent re-running the same animation
        jQuery(this)
          .prop("Counter", 0)
          .animate(
            {
              Counter: jQuery(this).text(),
            },
            {
              duration: 1000,
              step(now) {
                jQuery(this).text(Math.ceil(now));
              },
            }
          );
      }
    });
  });

  // close btn

  jQuery(".wellcome-note .close-btn").on("click", function () {
    jQuery(".wellcome-note").hide();
  });

  if (jQuery(window).width() <= 747) {
    jQuery(function (jQuery) {
      // jQuery( '.event-btn .button' ).removeClass( 'button small-btn' ).addClass( 'learn-more' );
      // jQuery( '.prdr-content .button' ).removeClass( 'button small-btn' ).addClass( 'learn-more' );
      // jQuery( '.srv-sngl-text .button' ).removeClass( 'button small-btn' ).addClass( 'learn-more' );
    });

    jQuery(".numbered-variation .iwd-text").hide();
    jQuery(".show-btn").click(function () {
      jQuery(this).prev().slideToggle("slow");
      const text = jQuery(this).text();
      jQuery(this).toggleClass("arrow-up");
      if (text == "READ MORE") {
        jQuery(this).text("HIDE TEXT");
      } else if (text == "HIDE TEXT") {
        jQuery(this).text("READ MORE");
      }
    });
  }
  jQuery(".gfield_required_text").text("*");

  // bind change event to select
  // jQuery( '.loc-filter' ).on( 'change', function() {
  // 	let locationTypeParam, locationStateParam, locationBrandParam,
  // 		locationProviderParam = null;
  // 	const locationType = jQuery( '#location-type' ).val();
  // 	if ( locationType ) {
  // 		locationTypeParam = 'location-type=' + locationType;
  // 	} else {
  // 		locationTypeParam = null;
  // 	}
  // 	const locationState = jQuery( '#location-state' ).val();
  // 	if ( locationState ) {
  // 		locationStateParam = '&location-state=' + locationState;
  // 	} else {
  // 		locationStateParam = null;
  // 	}
  // 	const locationBrand = jQuery( '#location-brand' ).val();
  // 	if ( locationBrand ) {
  // 		locationBrandParam = '&location-brand=' + locationBrand;
  // 	} else {
  // 		locationBrandParam = null;
  // 	}
  // 	const locationProvider = jQuery( '#location-provider' ).val();
  // 	if ( locationProvider ) {
  // 		locationProviderParam = '&location-provider=' + locationProvider;
  // 	} else {
  // 		locationProviderParam = null;
  // 	}
  // 	const url = document.location.origin + '/locations?' + locationTypeParam + locationStateParam + locationBrandParam + locationProviderParam; // get selected value
  // 	if ( url ) {
  // 		// require a URL
  // 		window.location = url; // redirect
  // 	}
  // } );

  jQuery(".prdr-filter").on("change", function () {
    let providerTypeParam,
      searchFieldParam,
      providerLocationParam,
      providerBrandParam;
    const providerType = jQuery("#providers-type").val();
    if (providerType) {
      if (providerType != "*") {
        providerTypeParam = "provider-type=" + providerType;
      } else {
        providerTypeParam = "";
      }
    } else {
      providerTypeParam = "";
    }
    const providerLocation = jQuery("#providers-location").val();
    if (providerLocation) {
      if (providerLocation != "*") {
        providerLocationParam = "&provider-location=" + providerLocation;
      } else {
        providerLocationParam = "";
      }
    } else {
      providerLocationParam = "";
    }
    const providerBrand = jQuery("#providers-brand").val();
    if (providerBrand) {
      if (providerBrand != "*") {
        providerBrandParam = "&provider-brand=" + providerBrand;
      } else {
        providerBrandParam = "";
      }
    } else {
      providerBrandParam = "";
    }
    const searchField = jQuery(".search-field").val();
    if (searchField) {
      if (searchField != "*") {
        searchFieldParam = "&search=" + searchField;
      } else {
        searchFieldParam = "";
      }
    } else {
      searchFieldParam = "";
    }
    var path = window.location.pathname.split("/");
    var filtered = path.filter(function (el) {
      return el != "";
    });
    var oldurl =
      window.location.protocol +
      "//" +
      window.location.host +
      "/" +
      filtered[0] +
      "/";
    const url =
      oldurl +
      "?" +
      providerTypeParam +
      providerLocationParam +
      providerBrandParam +
      searchFieldParam; // get selected value;
    if (url) {
      // require a URL
      window.location = url; // redirect
    }
  });
  jQuery(".prdr-filter2").on("click", function () {
    let providerTypeParam,
      searchFieldParam,
      providerLocationParam = "";
    const providerType = jQuery("#providers-type").val();
    if (providerType) {
      if (providerType != "*") {
        providerTypeParam = "provider-type=" + providerType;
      } else {
        providerTypeParam = "";
      }
    } else {
      providerTypeParam = "";
    }
    const providerLocation = jQuery("#providers-location").val();
    if (providerLocation) {
      if (providerLocation != "*") {
        providerLocationParam = "&provider-location=" + providerLocation;
      } else {
        providerLocationParam = "";
      }
    } else {
      providerLocationParam = "";
    }
    const searchField = jQuery(".search-field").val();
    if (searchField) {
      if (searchField != "*") {
        searchFieldParam = "&search=" + searchField;
      } else {
        searchFieldParam = "";
      }
    } else {
      searchFieldParam = "";
    }
    var path = window.location.pathname.split("/");
    var filtered = path.filter(function (el) {
      return el != "";
    });
    var oldurl =
      window.location.protocol +
      "//" +
      window.location.host +
      "/" +
      filtered[0] +
      "/";
    const url =
      oldurl +
      "?" +
      providerTypeParam +
      providerLocationParam +
      searchFieldParam +
      isClinicalParm; // get selected value;
    if (url) {
      // require a URL
      window.location = url; // redirect
    }
  });
  jQuery(".pro-clear-btn").on("click", function () {
    var path = window.location.pathname.split("/");
    var filtered = path.filter(function (el) {
      return el != "";
    });
    var oldurl =
      window.location.protocol +
      "//" +
      window.location.host +
      "/" +
      filtered[0] +
      "/";
    const url = oldurl;
    if (url) {
      // require a URL
      window.location = url; // redirect
    }
  });

  jQuery(document).on("click", "#pollen-count-link", function (e) {
    e.preventDefault();

    const location_zipcode = jQuery(this).attr("data-location-zipcode");

    const settings = {
      url:
        "https://dataservice.accuweather.com/forecasts/v1/daily/1day/" +
        location_zipcode +
        "?apikey=e4zXlnhnPw5IKxOCWMjJCBKyRmGMiuVO&language=en-us&details=true&metric=true",
      method: "GET",
      timeout: 0,
    };

    jQuery.ajax(settings).done(function (response) {
      // Date of the report
      const report_date = response.DailyForecasts[0].Date;
      const date1 = new Date(report_date);

      // Pollen Grass Data
      const pollen_grass_value =
        response.DailyForecasts[0].AirAndPollen[1].CategoryValue;
      const pollen_grass_name = response.DailyForecasts[0].AirAndPollen[1].Name;
      const pollen_grass_risk =
        response.DailyForecasts[0].AirAndPollen[1].Category;

      // Pollen Mold Data
      const pollen_mold_value =
        response.DailyForecasts[0].AirAndPollen[2].CategoryValue;
      const pollen_mold_name = response.DailyForecasts[0].AirAndPollen[2].Name;
      const pollen_mold_risk =
        response.DailyForecasts[0].AirAndPollen[2].Category;

      // Pollen Ragweed Data
      const pollen_ragweed_value =
        response.DailyForecasts[0].AirAndPollen[3].CategoryValue;
      const pollen_ragweed_name =
        response.DailyForecasts[0].AirAndPollen[3].Name;
      const pollen_ragweed_risk =
        response.DailyForecasts[0].AirAndPollen[3].Category;

      // Pollen Tree Data
      const pollen_tree_value =
        response.DailyForecasts[0].AirAndPollen[4].CategoryValue;
      const pollen_tree_name = response.DailyForecasts[0].AirAndPollen[4].Name;
      const pollen_tree_risk =
        response.DailyForecasts[0].AirAndPollen[4].Category;
    });
  });

  // jQuery.each( '.srv-sngl-card', function( index, item ) {
  jQuery(".srv-sngl-card").each(function () {
    if (jQuery(this).attr("data-birdeye-id")) {
    } else {
      // Display None animation
      jQuery(this).find("#location-title-animation").css("display", "none");
      jQuery(this).find("#location-phone-animation").css("display", "none");

      // Display Heading and but not phone because that should come from birdeye
      jQuery(this).find("#location-single-title").css("display", "block");
    }
    // do something with `item` (or `this` is also `item` if you like)
  });
  jQuery(".menu-dropdown").on("click", function () {
    jQuery(this).removeClass("unactive").addClass("active");
    jQuery(this).find(".locations").fadeIn();

    if (jQuery(this).hasClass("active")) {
      jQuery(this).mouseleave(function () {
        jQuery(this)
          .find(".locations")
          .fadeOut("slow", function () {
            jQuery(this).removeClass("active").addClass("unactive");
          });
      });
    }
  });

  // if ( jQuery( window ).width() <= 1004 ) {
  // jQuery('.header-links-mobile').on('click', function(e) {
  // 	e.stopPropagation(); // Prevent the event from reaching the document click handler
  // 	if (jQuery(this).hasClass('active')) {
  // 	jQuery(this).find('.jumplink-mb-ctn').fadeOut('fast', function() {
  // 		jQuery(this).parent().removeClass('active').addClass('unactive');
  // 	});
  // 	} else {
  // 	jQuery('.header-links-mobile.active').find('.jumplink-mb-ctn').fadeOut('fast', function() {
  // 		jQuery(this).parent().removeClass('active').addClass('unactive');
  // 	});
  // 	jQuery(this).find('.jumplink-mb-ctn').fadeIn().parent().removeClass('unactive').addClass('active');
  // 	}
  // });

  // jQuery('.jump-link-title, .jumplink-mb-ctn a').on('click', function(e) {
  // 	e.stopPropagation(); // Prevent the event from reaching the document click handler
  // });

  // jQuery(document).on('click', function() {
  // 	jQuery('.header-links-mobile.active').find('.jumplink-mb-ctn').fadeOut('fast', function() {
  // 	jQuery(this).parent().removeClass('active').addClass('unactive');
  // 	});
  // });

	jQuery(".header-links-mobile").on("click", function () {
		jQuery(this).toggleClass("active");
	});

	jQuery(".header-links-mobile").on("mouseleave", function () {
		jQuery(this).toggleClass("active");
	});

	// }
	if (jQuery(window).width() < 1003) {
		jQuery(".page-section, header, footer").click(function (e) {
		const container = jQuery(".activate-the-map");
		if (!container.is(e.target)) {
			if (container.has(e.target).length === 0) {
			container.css("display", "flex");
			}
		}
		});
		jQuery(document).on("click", ".activate-the-map", function () {
		jQuery(this).css("display", "none");
		});
	}

	// closure summary block
	jQuery('.show-closure-loc').on('click', function(){
		jQuery('.clinic-content').toggle();
		jQuery('.see-update').toggle();
		jQuery('.see-less').toggle();
	});

	jQuery(".cl-date").datepicker({
		dateFormat: "mm-dd-yy",
		beforeShow: function(input, inst) {
			inst.dpDiv.addClass("closure-datepicker"); 
			setTimeout(function(){
				inst.dpDiv.css({
					top: jQuery(input).offset().top + jQuery(input).outerHeight() + "px",
					left: jQuery(input).offset().left + "px !important"
				});
			}, 0);
		}
	});

	// Parse URL parameters on page load
    const urlParams = new URLSearchParams(window.location.search);
    const paramDate = urlParams.get('date') || '';
    const paramState = urlParams.get('state') || '*';
    const paramCity = urlParams.get('city') || '*';

    jQuery('#date').val(paramDate);
    jQuery('#closure-state').val(paramState);
    jQuery('#closure-cn').val(paramCity);
    if (paramDate !== '' || paramState !== '*' || paramCity !== '*') {
		jQuery('.cl-clear-btn').show();
	} else {
		jQuery('.cl-clear-btn').hide();
	}
    // If parameters exist, trigger filter on load
    // if (paramDate || paramState !== '*' || paramCity !== '*') {
    //     applyFilters(1);
    // }

    // Filter change event
    jQuery('.cl-filter, #date').on('change', function() {
        applyFilters(1);
    });

    // Clear all button
    jQuery('#clear-all').on('click', function() {
        jQuery('#date').val('');
        jQuery('#closure-state').val('*');
        jQuery('#closure-cn').val('*');
        applyFilters(1);
        jQuery(this).hide();
    });

    // Load more button
    jQuery('#loadMore').on('click', function(e) {
        e.preventDefault();
        var button = jQuery(this);
        var page = parseInt(button.attr('data-page')) + 1;
        applyFilters(page, true); // true for append mode
    });

    // Function to apply filters via AJAX
    function applyFilters(page = 1, append = false) {
		jQuery('.cl-clear-btn').show();
        var selected_date = jQuery('#date').val();
        var selected_state = jQuery('#closure-state').val() === '*' ? '' : jQuery('#closure-state').val();
        var selected_city = jQuery('#closure-cn').val() === '*' ? '' : jQuery('#closure-cn').val();
        jQuery('.lds-roller').show();
        jQuery.ajax({
            url: localVars.ajax_url,
            type: 'POST',
            data: {
                action: 'alrv_closure_filter',
                page: page,
                date: selected_date,
                state: selected_state,
                city: selected_city
            },
            // beforeSend: function() {
            //     jQuery('#loadMore').text('Loading...');
            // },
            success: function(response) {
                if (response.success) {
                    if (!append) {
						jQuery('.lds-roller').hide();
                        jQuery('.filter-faq-block').html(response.data.html);
                    } else {
						jQuery('.lds-roller').hide();
                        jQuery('.filter-faq-block').append(response.data.html);
                    }

                    jQuery('#loadMore').attr('data-page', page).attr('data-max', response.data.total_pages).text('Show More');
                    if (parseInt(page) >= parseInt(response.data.total_pages)) {
                        jQuery('#loadMore').hide();
                    } else {
                        jQuery('#loadMore').show();
                    }

                    // Update URL without reloading
                    var params = new URLSearchParams();
                    if (selected_date) params.append('date', selected_date);
                    if (selected_state) params.append('state', selected_state);
                    if (selected_city) params.append('city', selected_city);
                    history.pushState(null, '', params.toString() ? '?' + params.toString() : window.location.pathname);

                } else {
                    jQuery('#loadMore').text('No more data');
                }
            }
        });
    }
});
// jQuery(document).on('change', '.loc-filter', function () {
// 	var items = [];
// 	const current = jQuery(this).attr('id');
// 	if (current == 'location-type') {
// 		jQuery('#location-state').val('*');
// 		jQuery('#location-brand').val('*');
// 		jQuery('#location-provider').val('*');
// 	} else if (current == 'location-state') {
// 		var main_heading_text = (jQuery("#location-heading-txt-hidden").val() != '') ? jQuery("#location-heading-txt-hidden").val() : '';
// 		var main_intro_text = (jQuery("#location-intro-txt-hidden").val() != '') ? jQuery("#location-intro-txt-hidden").val() : '';
// 		var choosed_location = jQuery(this).val();
// 		var choosed_location_text = (choosed_location != '*') ? jQuery(this).find("option:selected").text() : '';
// 		var modified_heading = (choosed_location_text != '') ? main_heading_text.replace('Allervie Locations', 'Allervie Locations in ' + choosed_location) : main_heading_text;
// 		var modified_into_text = (choosed_location_text != '') ? main_intro_text.replace('the country', choosed_location_text) : main_intro_text;

// 		jQuery("#allervie-location-heading").html(modified_heading);
// 		jQuery("#allervie-location-intro-txt").html(modified_into_text);

// 		jQuery('#location-brand').val('*');
// 		jQuery('#location-provider').val('*');
// 	} else if (current == 'location-brand') {
// 		jQuery('#location-provider').val('*');
// 	}
// 	jQuery('.loc-filter').each(function () {
// 		if (jQuery(this).attr('id') == 'zipcodes') {
// 			var item = {
// 				title: jQuery(this).attr('id'),
// 				value: jQuery(this).val(),
// 				type: jQuery(this).attr('id'),
// 			};
// 		} else {
// 			var item = {
// 				title: jQuery(this).find('option:selected').text(),
// 				value: jQuery(this).val(),
// 				type: jQuery(this).attr('id'),
// 			};
// 		}
// 		items.push(item);
// 	});
// 	const data = {
// 		action: 'location_pollen_filter',
// 		items,
// 		all: false,
// 	};
// 	if (history.pushState) {
// 		var oldurl = window.location.protocol + "//" + window.location.host + window.location.pathname;
// 		oldurl = oldurl.replace("/brand/premier", "");
// 		var count = 0;
// 		for (const key in items) {
// 			const element = items[key];
// 			if (element.value == '*' || element.value == '') {
// 				continue;
// 			}
// 			if (count == 0) {
// 				oldurl = oldurl + '?';
// 				oldurl += element.type + '=' + element.value;
// 			} else {
// 				oldurl += '&' + element.type + '=' + element.value;
// 			}
// 			count++;
// 		}
// 		window.history.pushState({ path: oldurl }, '', oldurl);
// 	}
// 	jQuery('#ajax-location-response').html('');
// 	jQuery('.lds-roller').show();
// 	jQuery.ajax({
// 		url: localVars.ajax_url,
// 		type: 'post',
// 		data,
// 		success(response) {
// 			const data = JSON.parse(response);
// 			console.log(data);
// 			jQuery('#ajax-location-response').html(data.html);
// 			jQuery('#ajax-error-response').html(data.error);
// 			locationVars.results = data.all_pins;
// 			locationVars.is_singular = data.is_singular;
// 			if (data.lang != '') {
// 				locationVars.alat = data.lang;
// 			}
// 			if (data.lung != '') {
// 				locationVars.alng = data.lung;
// 			}
// 			if (data.res_zip) {
// 				locationVars.zipcodeParam = data.res_zip;
// 			}

// 			if (current == 'location-type') {
// 				jQuery('#location-state').html(data.location_state);
// 				jQuery('#location-brand').html(data.location_brand);
// 				jQuery('#location-provider').html(data.location_provider);
// 			} else if (current == 'location-state') {
// 				jQuery('#location-brand').html(data.location_brand);
// 				jQuery('#location-provider').html(data.location_provider);
// 			} else if (current == 'location-brand') {
// 				jQuery('#location-provider').html(data.location_provider);
// 			}
// 			setTimeout(initMap, 500);
// 			jQuery('.location-filter').addClass('has-filter-btn');
// 			jQuery('.lds-roller').hide();
// 		},
// 	});
// });
// jQuery(document).on('click', '.loc-filter-click', function () {
// 	const items = [];
// 	const zipcodes = locationVars.zipcodes;
// 	jQuery('.loc-filter').each(function () {
// 		if (jQuery(this).attr('id') == 'zipcodes') {
// 			var item = {
// 				title: jQuery(this).attr('id'),
// 				value: jQuery(this).val(),
// 				type: jQuery(this).attr('id'),
// 			};
// 		} else {
// 			var item = {
// 				title: jQuery(this).find('option:selected').text(),
// 				value: jQuery(this).val(),
// 				type: jQuery(this).attr('id'),
// 			};
// 		}
// 		items.push(item);
// 	});
// 	const data = {
// 		action: 'location_pollen_filter',
// 		items,
// 		all: false,
// 		zipcodes,
// 	};
// 	if (history.pushState) {
// 		var oldurl = window.location.protocol + "//" + window.location.host + window.location.pathname;
// 		oldurl = oldurl.replace("/brand/premier", "");
// 		var count = 0;
// 		var Vtrue = false;
// 		for (const key in items) {
// 			const element = items[key];
// 			if (element.value == '*' || element.value == '') {
// 				continue;
// 			}
// 			if (count == 0) {
// 				oldurl = oldurl + '?';
// 				oldurl += element.type + '=' + element.value;
// 				Vtrue = true;
// 			} else {
// 				oldurl += '&' + element.type + '=' + element.value;
// 			}
// 			count++;
// 		}
// 		window.history.pushState({ path: oldurl }, '', oldurl);
// 	}
// 	jQuery('#ajax-location-response').html('');

// 	jQuery('.lds-roller').show();
// 	jQuery.ajax({
// 		url: localVars.ajax_url,
// 		type: 'post',
// 		data,
// 		success(response) {
// 			const data = JSON.parse(response);
// 			locationVars.results = data.all_pins;
// 			locationVars.is_singular = data.is_singular;
// 			// if(data.cod!=''){
// 			if (data.lang != '') {
// 				locationVars.alat = data.lang;
// 			}
// 			if (data.lung != '') {
// 				locationVars.alng = data.lung;
// 			}
// 			if (data.res_zip) {
// 				locationVars.zipcodeParam = data.res_zip;
// 			}
// 			// }
// 			jQuery('#ajax-location-response').html(data.html);
// 			jQuery('#ajax-error-response').html(data.error);

// 			setTimeout(initMap, 500);
// 			jQuery('.location-filter').addClass('has-filter-btn');
// 			jQuery('.lds-roller').hide();
// 		},
// 	});
// });
// jQuery(document).on('click', '.ajax-location-pagination', function () {
// 	const items = [];
// 	const paged = jQuery(this).attr('data-page');
// 	jQuery('.loc-filter').each(function () {
// 		if (jQuery(this).attr('id') == 'zipcodes') {
// 			var item = {
// 				title: jQuery(this).attr('id'),
// 				value: jQuery(this).val(),
// 				type: jQuery(this).attr('id'),
// 			};
// 		} else {
// 			var item = {
// 				title: jQuery(this).find('option:selected').text(),
// 				value: jQuery(this).val(),
// 				type: jQuery(this).attr('id'),
// 			};
// 		}
// 		items.push(item);
// 	});
// 	const data = {
// 		action: 'location_pollen_filter',
// 		items,
// 		paged,
// 		all: false,
// 	};
// 	if (history.pushState) {
// 		var oldurl = window.location.protocol + "//" + window.location.host + window.location.pathname;
// 		oldurl = oldurl.replace("/brand/premier", "");
// 		var count = 0;
// 		var Vtrue = false;
// 		for (const key in items) {
// 			const element = items[key];
// 			if (element.value == '*' || element.value == '') {
// 				continue;
// 			}
// 			if (count == 0) {
// 				oldurl = oldurl + '?';
// 				oldurl += element.type + '=' + element.value;
// 				Vtrue = true;
// 			} else {
// 				oldurl += '&' + element.type + '=' + element.value;
// 			}
// 			count++;
// 		}
// 		if (Vtrue) {
// 			oldurl += '&current-page=' + paged;
// 		} else {
// 			oldurl += '?current-page=' + paged;
// 		}
// 		window.history.pushState({ path: oldurl }, '', oldurl);
// 	}
// 	jQuery('#ajax-location-response').html('');
// 	jQuery('.lds-roller').show();
// 	jQuery.ajax({
// 		url: 	,
// 		type: 'post',
// 		data,
// 		success(response) {
// 			const data = JSON.parse(response);
// 			locationVars.results = data.all_pins;
// 			locationVars.is_singular = data.is_singular;
// 			jQuery('#ajax-location-response').html(data.html);
// 			jQuery('#ajax-error-response').html(data.error);

// 			if (data.lang != '') {
// 				locationVars.alat = data.lang;
// 			}
// 			if (data.lung != '') {
// 				locationVars.alng = data.lung;
// 			}
// 			if (data.res_zip) {
// 				locationVars.zipcodeParam = data.res_zip;
// 			}
// 			setTimeout(initMap, 500);
// 			jQuery('.location-filter').addClass('has-filter-btn');
// 			jQuery('.lds-roller').hide();
// 		},
// 	});
// });
// jQuery(document).on('click', '#clear-all', function () {
// 	const newURL = location.href.split('?')[0];
// 	window.history.pushState('object', document.title, newURL);
// 	jQuery('#location-type').val('*');
// 	jQuery('#location-state').val('*');
// 	jQuery('#location-brand').val('*');
// 	jQuery('#location-provider').val('*');
// 	jQuery('#zipcodes').val('');
// 	const items = [];
// 	const paged = jQuery(this).attr('data-page');
// 	jQuery('.loc-filter').each(function () {
// 		if (jQuery(this).attr('id') == 'zipcodes') {
// 			var item = {
// 				title: jQuery(this).attr('id'),
// 				value: jQuery(this).val(),
// 				type: jQuery(this).attr('id'),
// 			};
// 		} else {
// 			var item = {
// 				title: jQuery(this).find('option:selected').text(),
// 				value: jQuery(this).val(),
// 				type: jQuery(this).attr('id'),
// 			};
// 		}
// 		items.push(item);
// 	});
// 	const data = {
// 		action: 'location_pollen_filter',
// 		items,
// 		paged,
// 		all: true,
// 	};
// 	var reseturl = location.href.split("?")[0];
// 	window.history.pushState('object', document.title, reseturl);
// 	jQuery('#ajax-location-response').html('');
// 	// console.log( data );
// 	jQuery('.lds-roller').show();
// 	jQuery.ajax({
// 		url: localVars.ajax_url,
// 		type: 'post',
// 		data,
// 		success(response) {
// 			const data = JSON.parse(response);
// 			locationVars.alat = '33.0237769';
// 			locationVars.alng = '-96.7963909';
// 			locationVars.zipcodeParam = '';
// 			locationVars.results = data.all_pins;
// 			locationVars.is_singular = data.is_singular;
// 			jQuery('#ajax-location-response').html(data.html);
// 			jQuery('#ajax-error-response').html(data.error);

// 			jQuery('#location-state').html(data.location_state);
// 			jQuery('#location-brand').html(data.location_brand);
// 			jQuery('#location-provider').html(data.location_provider);
// 			setTimeout(initMap, 500);
// 			jQuery('.location-filter').removeClass('has-filter-btn');
// 			jQuery('.lds-roller').hide();
// 		},
// 	});
// });

// Single hub page for scolling section.
document.addEventListener("DOMContentLoaded", function () {
	const singleHub = document.body;
	if(singleHub.classList.contains('single-hub')){
		window.onscroll = function() {
            scrollnavlinks();
        };

		var header = document.querySelector("#header-section");
		var banner = document.querySelector(".hero-section");
		var headerLinks = document.querySelector(".scroll-nav-links");
		var mobHeaderLinks = document.querySelector(".scroll-nav-link");
		var topBar = document.querySelector(".top-bar");
		var headerWrapper = document.querySelector(".header-wrapper");
		var stickyPoint = header.offsetTop + banner.clientHeight;
		var shrinkTrigger = stickyPoint + 10; // 10px after becoming sticky
		var prevScrollPos = window.pageYOffset;

		function scrollnavlinks() {
			var offset = window.pageYOffset;
			var isScrollingDown = offset > prevScrollPos;

			// Check if "shrink" and "nav-down" classes are present
			var isShrinked = header.classList.contains("shrink");
			var isNavDown = header.classList.contains("nav-down");

			if (offset > stickyPoint) {
				if (isShrinked && isNavDown) {
					// Condition 2: sticky + shrink + nav-down
					headerLinks.classList.add("sticky");
					headerLinks.style.top = topBar.clientHeight + headerWrapper.clientHeight + "px";
				} else {
					// Condition 1: sticky (no shrink or nav-down)
					headerLinks.classList.add("sticky");
					mobHeaderLinks.classList.add("sticky");
					mobHeaderLinks.style.top = header.clientHeight + "px";
					headerLinks.style.top = headerWrapper.clientHeight + "px";
					if (isScrollingDown && offset > shrinkTrigger) {
						mobHeaderLinks.classList.add("shrink");
					} else {
						mobHeaderLinks.classList.remove("shrink");
					}
				}
			} else {
				// Condition 3: remove sticky
				headerLinks.classList.remove("sticky");
				mobHeaderLinks.classList.remove("sticky");
				mobHeaderLinks.style.top = "0";
				mobHeaderLinks.classList.remove("shrink");            
				headerLinks.style.top = "0";
			}
			prevScrollPos = offset; // Update previous scroll position
		}
	}
});
