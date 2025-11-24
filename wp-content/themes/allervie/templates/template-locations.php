<?php
/**
 * Template Name: Locations
 * Template Post Type: page
 *
 * This template is for displaying Locations page.
 *
 * @link https://developer.wordpress.org/themes/template-files-section/page-template-files/
 *
 * @package Allervie
 * @since 1.0.0
 */

// Include header
get_header();
global $option_fields;
global $pID;
global $fields;

if(get_query_var('location-brand') && 'premier' == get_query_var('location-brand')){
	$_GET['location-brand'] = 'premier-allergist';
}


$items=create_items_from_get($_GET);
$get_exclude_data=get_exclude_data($items);

?>

<section class="hero-section" id="map-response-ajax">
	<section class="location-map">
		<div id="locationMap"></div>
		<div class="zip-search">
			<div class="form-group">
				<input type='text' name="zipcode" id="zipcodes" class="zip-filter form-control search-autocomplete"
					placeholder="Search by City or ZIP code" value="<?php if(isset($_GET['zipcodes'])){ echo $_GET['zipcodes']; } ?>">
				<input type="hidden" id="selected-state" name="selected_state" value="">
                <input type="hidden" id="def-lat" name="def-lat" value="">
                <input type="hidden" id="def-long" name="def-long" value="">
				<button type="button" id="resetZipcodeBtn" class="reset-zipcode-btn" style="display: none;">&#10006;</button>
			</div>
<!-- 			<button type="button" id="zipcodeBtn" class="loc-filter-click"></button>
 -->			<div id="ajax-error-response"></div>
		</div>
		<div class="activate-the-map">
			Tap to activate the map
		</div>
	</section>
</section>

<section id="page-section" class="page-section location-gradiant-container" id="ajax-request-output">
	<div class="wrapper">
		<div id="to-top"></div>
		<?php get_all_location_filters($pID,$get_exclude_data,$_GET); ?>
		<div class="servies-section">
			<div class="lds-roller" style="display: none;">
				<div></div>
				<div></div>
				<div></div>
				<div></div>
				<div></div>
				<div></div>
				<div></div>
				<div></div>
			</div>
			<div id="ajax-location-response">
				<div class="srv-cards d-flex align-items-stretch flex-wrap">
					<?php
						$alat='33.0237769';
						$alng='-96.7963909';
						$res_zip='';
						global $paged;
						if ( isset( $_GET['current-page'] ) ) {
							$paged = $_GET['current-page'];
						} elseif ( get_query_var( 'paged' ) ) {
							// On a paged page.
							$paged = get_query_var( 'paged' );
						} else { // Default.
							$paged = 1;
						}
						$error='';
						$get_query_args=get_query_args($items);
						
						$tax_query=$get_query_args['tax_query'];
						$loc_post_in = $get_query_args['loc_post_in'];
						$global_state=$get_query_args['global_state'];
						$args = array(
							'post_type'      => array( 'location' ),
							'post_status'    => 'publish',
							'posts_per_page' => 12,
							'orderby'        => 'menu_order',
							'order'          => 'ASC',
							'tax_query'      => $tax_query,
							'post__in'       => $loc_post_in,
							'paged'          => $paged,
						);
						// dump($args);
						$query                  = new WP_Query( $args );
						// The Loop
						if ( $query->have_posts() ) {
							while ( $query->have_posts() ) {
								$query->the_post();
								$pID         = get_the_ID();
								$post_fields = get_fields( $pID );
								if ( $post_fields['alrv_slo_birdeye_location_id'] == ''  ) {
									continue;
								}
								$alat            = ( get_post_meta( $pID, 'birdeye_lat', true ) ) ? get_post_meta( $pID, 'birdeye_lat', true ) : null;
								$alng            = ( get_post_meta( $pID, 'birdeye_lng', true ) ) ? get_post_meta( $pID, 'birdeye_lng', true ) : null;
								$res_zip            = ( get_post_meta( $pID, 'birdeye_zip', true ) ) ? get_post_meta( $pID, 'birdeye_zip', true ) : null;
								get_template_part( 'partials/content-archive', get_post_type(), array( 'paged' => $paged ) );
							}
						}else {
						if ( $global_state == 'Invalid' ) {
							$error.= '<div class="no-location-found">Please enter a valid Zipcode</div>';

						}elseif ( $global_state != '' ) {
							$error .= '<div class="no-location-found">No locations found in <strong>' . ucfirst( $global_state ) . '</strong></div>';
						} else {
							$error .= '<div class="no-location-found">No locations found</div>';
						}
						?>
						<script>
							jQuery(document).ready(function(){
								setTimeout(() => {

									jQuery( '#ajax-error-response' ).html( '<?php echo $error; ?>');
								}, 500);
							});
						</script>
						<?php
					}

					?>
				</div>
				<div class="s-60"></div>
				<?php
				if ( $query->have_posts() ) {
					if ( function_exists( 'glide_pagination_location_ajax' ) ) {
						echo glide_pagination_location_ajax( '', $query->max_num_pages );
					}
				}
					wp_reset_query();
					wp_reset_postdata();
				?>
			</div>
		</div>
	</div>
</section>
<?php
if($tax_query =='' && $meta_query==''){
	get_all_location_pins();// default pins for the map [all]
}else{
	get_all_location_pins(null,$tax_query,$meta_query,$alat,$alng,$res_zip);// default pins for the map [all]
} ?>

<!-- Google Places API -->
<script>

// Initialize Google Places autocomplete
function initAutocomplete() {
    var input = jQuery('#zipcodes')[0];
    var options = {
        componentRestrictions: { country: "us" }
    };
    var autocomplete = new google.maps.places.Autocomplete(input, options);
    var autocompleteService = new google.maps.places.AutocompleteService();
    var firstSuggestionText = '';

    jQuery('#zipcodes').on('keypress', function(event) {
        if (event.keyCode === 13) {
            var pacItem = jQuery('.pac-item:first-child');
            var addressParts = [];

            pacItem.children().each(function() {
            var part = jQuery(this).text().trim();
                if (part) {
                    addressParts.push(part);
                }
            });
            var fullAddress = addressParts.join(' ');
            firstSuggestionText = fullAddress;
            jQuery(this).val(firstSuggestionText);
            google.maps.event.trigger(autocomplete, 'place_changed', { query: firstSuggestionText });
            event.preventDefault();
        }
    });

    autocomplete.addListener("place_changed", () => {
        var place = autocomplete.getPlace();

        if (!place.geometry) {
            autocompleteService.getPlacePredictions({ input: firstSuggestionText }, function(predictions, status) {
                if (status === google.maps.places.PlacesServiceStatus.OK && predictions.length > 0) {
                    var firstPrediction = predictions[0];
                    var placeId = firstPrediction.place_id;
                    var request = {
                        placeId: placeId,
                        fields: ['geometry', 'address_components'] // Include address_components in the request
                    };

                    var service = new google.maps.places.PlacesService(document.createElement('div'));
                    service.getDetails(request, function(placeDetails, status) {
                        if (status === google.maps.places.PlacesServiceStatus.OK) {
                            var geometry = placeDetails.geometry;
                            place.geometry = geometry;

                            // Derive state from the place address
                            var state = '';
                            placeDetails.address_components.forEach(function(component) {
                                if (component.types.includes('administrative_area_level_1')) {
                                    state = component.long_name;
                                }
                            });

                            searchLocations(place, state);
                        }
                    });
                }
            });
        } else {
            if(place.address_components) {
                place.address_components.forEach(function(component) {
                    if (component.types.includes('administrative_area_level_1')) {
                        state = component.long_name;
                    }
                });
            }
            searchLocations(place, state);
        }
    });

    function searchLocations(place, stateVal) {
        //Clear URL
        const newURL = location.href.split('?')[0];
        window.history.pushState('object', document.title, newURL);

        //Clear State from DropDown Filter
        jQuery('#location-state').val('*');

        jQuery('#location-state').prop('disabled', true);

       
        // Extract state from the place address
        var lat = '';
        var long = '';
        if(place.address_components) {
	        place.address_components.forEach(function(component) {
	            if (component.types.includes('administrative_area_level_1')) {
	                state = component.long_name;
	            }
	        });
    	} else {
    		state = stateVal;
    	}

        lat = place.geometry.location.lat();
        long = place.geometry.location.lng();

        // Set the selected state, Default Lat and Long to the hidden input field
        jQuery('#selected-state').val(state);
        jQuery('#def-lat').val(lat);
        jQuery('#def-long').val(long);

        // Filter call for zipcode only
        var items = [];
        jQuery('.zip-filter').each(function() {
            if (jQuery(this).attr('id') == 'zipcodes') {
                var item = {
                    lat: lat,
                    long: long,
                };
                items.push(item);
            }
        });
        if(jQuery('#location-state') == '') {

            jQuery('.loc-filter').each(function () {
            
                var item = {
                    title: jQuery(this).find('option:selected').text(),
                    value: jQuery(this).val(),
                    type: jQuery(this).attr('id'),
                };
            
            items.push(item);
            });
        }
        else{
            jQuery('#location-type').val('*');
            jQuery('#location-brand').val('*');
            jQuery('#location-provider').val('*');
            var item = {
                reset: 'tax_query',
            }
            items.push(item);

        }

        const data = {
            action: 'location_pollen_filter',
            items,
            all: false,
        };
        // if (history.pushState) {
        //     var oldurl = window.location.href;
        //     var def_lat = jQuery('#def-lat').val();
        //     var def_long = jQuery('#def-long').val();
        //     var newParams = 'lat=' + encodeURIComponent(lat) + '&long=' + encodeURIComponent(long);

        //     // Check if there are existing query parameters
        //     if (oldurl.indexOf('?') !== -1) {
        //         oldurl += '&' + newParams;
        //     } else {
        //         oldurl += '?' + newParams;
        //     }

        //     window.history.pushState({ path: oldurl }, '', oldurl);
        // }

        jQuery('#ajax-location-response').html('');
        jQuery('.lds-roller').show();
        jQuery.ajax({
            url: localVars.ajax_url,
            type: 'post',
            data,
            success(response) {
                const data = JSON.parse(response);
                jQuery('#ajax-location-response').html(data.html);
                jQuery('#ajax-error-response').html(data.error);
                locationVars.results = data.all_pins;
                locationVars.is_singular = data.is_singular;
                if (data.lang != '') {
                    locationVars.alat = data.lang;
                }
                if (data.lung != '') {
                    locationVars.alng = data.lung;
                }
                if (data.res_zip) {
                    locationVars.zipcodeParam = data.res_zip;
                }

                setTimeout(initMap, 500);
                jQuery('.location-filter').addClass('has-filter-btn');
                jQuery('.lds-roller').hide();
    			// var selectedState = jQuery('#selected-state').val().toLowerCase();
    			// if (selectedState !== '') {
			    //     jQuery('#location-state option').each(function() {
			    //         if (jQuery(this).val() === selectedState) {
			    //             jQuery(this).prop('selected', true); 
			    //             return false; 
			    //         }
			    //     });
		    
		    	
            },
        });
    }
}

window.addEventListener('load', initAutocomplete);



//Location Filter AJAX Call
jQuery(document).on('change', '.loc-filter', function () {
    var items = [];
	
    jQuery('#resetZipcodeBtn').hide();
    const current = jQuery(this).attr('id');
    const lat = jQuery('#def-lat').val();
    const long = jQuery('#def-long').val();
    if (current == 'location-type') {
        jQuery('#location-state').val('*');
        jQuery('#location-brand').val('*');
        jQuery('#location-provider').val('*');
    } else if (current == 'location-state') {
        // var main_heading_text = (jQuery("#location-heading-txt-hidden").val() != '') ? jQuery("#location-heading-txt-hidden").val() : '';
        // var main_intro_text = (jQuery("#location-intro-txt-hidden").val() != '') ? jQuery("#location-intro-txt-hidden").val() : '';
        var choosed_location = jQuery(this).val();
        // var choosed_location_text = (choosed_location != '*') ? jQuery(this).find("option:selected").text() : '';
        // var modified_heading = (choosed_location_text != '') ? main_heading_text.replace('Allervie Locations', 'Allervie Locations in ' + choosed_location) : main_heading_text;
        // var modified_into_text = (choosed_location_text != '') ? main_intro_text.replace('the country', choosed_location_text) : main_intro_text;

        // jQuery("#allervie-location-heading").html(modified_heading);
        // jQuery("#allervie-location-intro-txt").html(modified_into_text);

        jQuery('#location-brand').val('*');
        jQuery('#location-provider').val('*');
    } else if (current == 'location-brand') {
        jQuery('#location-provider').val('*');
    }
    jQuery('.loc-filter').each(function () {
            var item = {
                title: jQuery(this).find('option:selected').text(),
                value: jQuery(this).val(),
                type: jQuery(this).attr('id'),
            };

        
        items.push(item);
    });
    jQuery('.zip-filter').each(function() {
        if (jQuery(this).attr('id') == 'zipcodes') {
            var item = {
                lat: lat,
                long: long,
            };
            items.push(item);
        }
    });
    const data = {
        action: 'location_pollen_filter',
        items,
        all: false,
    };
    if (history.pushState) {
		var oldurl = window.location.protocol + "//" + window.location.host + window.location.pathname;
		oldurl = oldurl.replace("/brand/premier", "");
		var count = 0;
		for (const key in items) {
			const element = items[key];
			if (element.value == '*' || element.value == '') {
				continue;
			}
            if ('lat' in element || 'long' in element) {
                continue;
            }
			if (count == 0) {
				oldurl = oldurl + '?';
				oldurl += element.type + '=' + element.value;
			} else {
				oldurl += '&' + element.type + '=' + element.value;
			}
			count++;
		}
		window.history.pushState({ path: oldurl }, '', oldurl);
	}
    jQuery('#ajax-location-response').html('');
    jQuery('.lds-roller').show();
    jQuery.ajax({
        url: localVars.ajax_url,
        type: 'post',
        data,
        success(response) {
            const data = JSON.parse(response);
            jQuery('#ajax-location-response').html(data.html);
            jQuery('#ajax-error-response').html(data.error);
            locationVars.results = data.all_pins;
            locationVars.is_singular = data.is_singular;
            if (data.lang != '') {
                locationVars.alat = data.lang;
            }
            if (data.lung != '') {
                locationVars.alng = data.lung;
            }
            if (data.res_zip) {
                locationVars.zipcodeParam = data.res_zip;
            }

            if (current == 'location-type') {
                jQuery('#location-state').html(data.location_state);
                jQuery('#location-brand').html(data.location_brand);
                jQuery('#location-provider').html(data.location_provider);
            } else if (current == 'location-state') {
                jQuery('#location-brand').html(data.location_brand);
                jQuery('#location-provider').html(data.location_provider);
            } else if (current == 'location-brand') {
                jQuery('#location-provider').html(data.location_provider);
            }
            setTimeout(initMap, 500);
            jQuery('.location-filter').addClass('has-filter-btn');
            jQuery('.lds-roller').hide();
        },
    });
});

jQuery(document).ready(function(jQuery) {

    // Function to toggle reset button based on input value
    function toggleResetButton() {
        var zipcodesInput = jQuery('#zipcodes');
        var resetButton = jQuery('#resetZipcodeBtn');
        
        if (zipcodesInput.val().trim() !== '') {
            resetButton.show();
        } else {
            resetButton.hide();
        }
    }

    // Call toggleResetButton function initially
    toggleResetButton();

    // Listen for input event on #zipcodes input field
    jQuery('#zipcodes').on('input', function() {
        toggleResetButton();
    });

    // Function to reset input value and hide reset button
    jQuery('#resetZipcodeBtn').on('click', function() {
        jQuery('#zipcodes').val('');
        jQuery(this).hide();
    });

});

jQuery(document).on('click', '.ajax-location-pagination', function () {
    event.preventDefault(); 

    const items = [];
    const paged = jQuery(this).attr('data-page');
    const lat = jQuery('#def-lat').val();
    const long = jQuery('#def-long').val();
    const state = jQuery('#selected-state').val();

        jQuery('.loc-filter').each(function () {        
            if (jQuery(this).val() != '*') {
                var item = {
                    title: jQuery(this).find('option:selected').text(),
                    value: jQuery(this).val(),
                    type: jQuery(this).attr('id'),
                };

            
            items.push(item);
            }
        });
    
    jQuery('.zip-filter').each(function() {
        if (jQuery(this).attr('id') == 'zipcodes') {
            var item = {
                lat: lat,
                long: long,
            };
            items.push(item);
        }
    });
    
    const data = {
        action: 'location_pollen_filter',
        items,
        paged,
        all: false,
    };
    if (history.pushState) {
        var oldurl = window.location.protocol + "//" + window.location.host + window.location.pathname;
        oldurl = oldurl.replace("/brand/premier", "");
        var count = 0;
        var Vtrue = false;
        for (const key in items) {
            const element = items[key];
            if (element.value == '*' || element.value == '') {
                continue;
            }
            if ('lat' in element || 'long' in element) {
                continue;
            }

            if (count == 0) {
                oldurl = oldurl + '?';
                oldurl += element.type + '=' + element.value;
                Vtrue = true;
            } else {
                oldurl += '&' + element.type + '=' + element.value;
            }
            count++;
        }
        if (Vtrue) {
            oldurl += '&current-page=' + paged;
        } else {
            oldurl += '?current-page=' + paged;
        }
        window.history.pushState({ path: oldurl }, '', oldurl);
    }
    jQuery('#ajax-location-response').html('');
    jQuery('.lds-roller').show();
    jQuery.ajax({
        url: localVars.ajax_url,
        type: 'post',
        data,
        success(response) {
            const data = JSON.parse(response);
            locationVars.results = data.all_pins;
            locationVars.is_singular = data.is_singular;
            jQuery('#ajax-location-response').html(data.html);
            jQuery('#ajax-error-response').html(data.error);

            if (data.lang != '') {
                locationVars.alat = data.lang;
            }
            if (data.lung != '') {
                locationVars.alng = data.lung;
            }
            if (data.res_zip) {
                locationVars.zipcodeParam = data.res_zip;
            }
            setTimeout(initMap, 500);
            jQuery('.location-filter').addClass('has-filter-btn');
            jQuery('.lds-roller').hide();
        },
    });
            jQuery('html, body').animate({ scrollTop: jQuery('#page-section').offset().top - 70 }, 'slow');

});
jQuery(document).on('click', '#clear-all', function () {
    const newURL = location.href.split('?')[0];
    window.history.pushState('object', document.title, newURL);

    //Enable Filters
    jQuery('#location-state').prop('disabled', false);
    jQuery('#location-type').prop('disabled', false);
    jQuery('#location-brand').prop('disabled', false);
    jQuery('#location-provider').prop('disabled', false);

    jQuery('#location-type').val('*');
    jQuery('#location-state').val('*');
    jQuery('#location-brand').val('*');
    jQuery('#location-provider').val('*');
    jQuery('#def-lat').val('');
    jQuery('#def-long').val('');
    jQuery('#zipcodes').val('');
    const items = [];
    const paged = jQuery(this).attr('data-page');
    jQuery('.loc-filter').each(function () {
        
            var item = {
                title: jQuery(this).find('option:selected').text(),
                value: jQuery(this).val(),
                type: jQuery(this).attr('id'),
            };
        
        items.push(item);
    });
    const data = {
        action: 'location_pollen_filter',
        items,
        paged,
        all: true,
    };
    var reseturl = location.href.split("?")[0];
    window.history.pushState('object', document.title, reseturl);
    jQuery('#ajax-location-response').html('');
    // console.log( data );
    jQuery('.lds-roller').show();
    jQuery.ajax({
        url: localVars.ajax_url,
        type: 'post',
        data,
        success(response) {
            const data = JSON.parse(response);
            locationVars.alat = '33.0237769';
            locationVars.alng = '-96.7963909';
            locationVars.zipcodeParam = '';
            locationVars.results = data.all_pins;
            locationVars.is_singular = data.is_singular;
            jQuery('#ajax-location-response').html(data.html);
            jQuery('#ajax-error-response').html(data.error);

            jQuery('#location-state').html(data.location_state);
            jQuery('#location-brand').html(data.location_brand);
            jQuery('#location-provider').html(data.location_provider);
            setTimeout(initMap, 500);
            jQuery('.location-filter').removeClass('has-filter-btn');
            jQuery('.lds-roller').hide();
        },
    });
});

</script>

<?php get_footer(); ?>
