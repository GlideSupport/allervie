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

// js for read-more button about section variation changes done 18-01-2024

jQuery(document).ready(function ($) {
  jQuery(".read-more").click(function () {
    var $paragraph2 = jQuery(this).parent().find(".read-more-content-two");
    $paragraph2.toggle();

    // Update text based on visibility
    var buttonText = $paragraph2.is(":visible") ? "Read Less" : "Read More";
    $(this).text(buttonText);

    // Check condition and hide the class
    if ($paragraph2.is(":visible")) {
      $(".read-more").hide();
    } else {
      $(".read-more").show();
    }
  });
});

// services slider section varaitions changes done on 18-01-2024

jQuery(document).ready(function ($) {
  function initOwlCarousel(obj) {
    obj.owlCarousel({
      loop: false,
      margin: 10,
      nav: true,
      dots: false,
      responsiveClass: true,
      responsive: {
        600: {
          items: 2,
        },
        1000: {
          items: 3,
        },
        1200: {
          items: 4,
        },
      },
    });
  }

  function destroyOwlCarousel(obj) {
    if (obj.hasClass("owl-loaded")) {
      obj.owlCarousel("destroy");
    }
  }

  var owlServicesSlider = jQuery(".glide-block-services-slider .srv-cards");
  initOwlCarousel(owlServicesSlider);
  if (jQuery(window).width() < 748) {
    if (owlServicesSlider.data("owl.carousel")) {
      destroyOwlCarousel(owlServicesSlider);
    }
    owlServicesSlider.find(".srv-sngl-card").show();
    owlServicesSlider.find(".srv-sngl-card").slice(5).hide();
  } else {
    initOwlCarousel(owlServicesSlider);
  }

  var owl_providers_slider = jQuery(".glide-block-featured-providers-slider .provider-teaser, .glide-block-featured-providers-slider-hub-ppc .provider-teaser");
  initOwlCarousel(owl_providers_slider);
  if (jQuery(window).width() < 748) {
	  if (owl_providers_slider.data("owl.carousel")) {
      destroyOwlCarousel(owl_providers_slider);
    }
    if (jQuery(".glide-block-featured-providers-slider").hasClass("mobile-layout-providers" ) ||jQuery(".glide-block-featured-providers-slider-hub-ppc").hasClass("mobile-layout-providers") ) {
      owl_providers_slider.find(".prov-sngl-card").show();
      owl_providers_slider.find(".prov-sngl-card").slice(5).hide();
    }
  } else {
    initOwlCarousel(owl_providers_slider);
  }

  var owl_reviews_slider = jQuery(
    ".glide-block-ppc-reviews-slider .rating-api-ctn"
  );
  var children = owl_reviews_slider.find(".rating-box");
  var defaultVisible = 4;
  var screenSize = 748;
  jQuery(".glide-block-ppc-reviews-slider #show-more").click(function (event) {
    event.preventDefault();
    // Show all hidden children
    // console.log('asd');
    children.show();
    // Hide the "See More" button
    jQuery(this).hide();
  });
  if (window.innerWidth < screenSize) {
    if (children.length <= defaultVisible) {
      jQuery(".glide-block-ppc-reviews-slider #show-more").hide();
    }
  }
  initOwlCarousel(owl_reviews_slider);
  if (jQuery(window).width() < 748) {
    destroyOwlCarousel(owl_reviews_slider);
    children.slice(defaultVisible).hide();
    console.log("hide");
    if (children.length <= defaultVisible) {
      jQuery(".glide-block-ppc-reviews-slider #show-more").hide();
    }
  } else {
    initOwlCarousel(owl_reviews_slider);
  }

  // Limit to 5 conditions in Mobile devices : Featured Conditions block

  var featuredConditionsPremier = jQuery(
    ".glide-block-featured-conditions .service-teaser"
  );
  initOwlCarousel(featuredConditionsPremier);
  if (jQuery(window).width() < 748) {
    if (featuredConditionsPremier.data("owl.carousel")) {
      destroyOwlCarousel(featuredConditionsPremier);
    }
    if (
      jQuery(".glide-block-featured-conditions").hasClass(
        "premier-allergist-location"
      )
    ) {
      featuredConditionsPremier.find(".srv-sngl-card").show();
      featuredConditionsPremier.find(".srv-sngl-card").slice(5).hide();
    }
  } else {
    initOwlCarousel(featuredConditionsPremier);
  }
  
    // To make select box readonly on locations detail page ppc form   
    function readonly_locations(){
        var $readOnlySelect = $('.read-only-select select');
        if ($readOnlySelect.length) {
            $readOnlySelect.each(function() {
                var $this = $(this);

                // Remove the placeholder option
                $this.find('option[value=""]').remove();

                // Make it appear as read-only by preventing changes
                $this.on('focus mousedown', function(e) {
                  e.preventDefault();
                  $this.blur();
                });

                // Optionally style it as read-only
                $this.css({
                  'pointer-events': 'none',
                  'background-color': '#f0f0f0', // Example of a greyed-out background
                  'background-image': 'none',
                  'color': '#6c757d',
                });

                // Ensure the correct option is selected
                var defaultValue = $this.find('option[selected]').val();
                $this.val(defaultValue);
            });
        }
    }
    jQuery(document).on('gform_post_render', function(){        
        readonly_locations();        
    });

});
