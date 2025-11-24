<?php

/**
 * Block Name: Location Filter
 *
 * The template for displaying the custom gutenberg block named Section Location Filter.
 *
 * @link https://www.advancedcustomfields.com/resources/blocks/
 *
 * @package Allervie
 * @since 1.0.0
 */
global $option_fields;
global $pID;
global $fields;
$items = create_items_from_get($_GET);
$get_exclude_data = get_exclude_data($items);
// Get all the fields from ACF for this block ID
$block_fields = get_fields_escaped($block['id']);

$alrv_google_maps_api_key = ( isset( $option_fields['alrv_google_maps_api_key'] ) ) ? $option_fields['alrv_google_maps_api_key'] : null;

// Set the block name for it's ID & class from it's file name
$block_glide_name = $block['name'];
$block_glide_name = str_replace('acf/', '', $block_glide_name);

// Set the preview thumbnail for this block for gutenberg editor view.
if (isset($block['data']['preview_image_help'])) {    /* rendering in inserter preview  */
	echo '<img src="' . $block['data']['preview_image_help'] . '" style="width:100%; height:auto;">';
}

// create align class ("alignwide") from block setting ("wide").
$align_class = $block['align'] ? 'align' . $block['align'] : '';

// Get the class name for the block to be used for it.
$class_name = (isset($block['className'])) ? $block['className'] : null;

// Making the unique ID for the block.
$id = 'block-' . $block_glide_name . '-' . $block['id'];

// Making the unique ID for the block.
if ($block['name']) {
	$block_name = $block['name'];
	$block_name = str_replace('/', '-', $block_name);
	$name       = 'block-' . $block_name;
}

// Block variables
$alrv_location_layout = (isset($block_fields['alrv_location_layout'])) ? $block_fields['alrv_location_layout'] : null;
$alrv_lctn_fltr_title = (isset($block_fields['alrv_lctn_fltr_title'])) ? $block_fields['alrv_lctn_fltr_title'] : null;
// $alrv_lctn_fltr_dcr = (isset($block_fields['alrv_lctn_fltr_dcr'])) ? $block_fields['alrv_lctn_fltr_dcr'] : null;
$alrv_loc_link = (isset($block_fields['alrv_loc_link'])) ? $block_fields['alrv_loc_link'] : null;
$default_zip_code = (isset($block_fields['default_zip_code'])) ? $block_fields['default_zip_code'] : null;
$def_radius =  get_field('alrv_loc_filter_rad','option');
$radius_field = (isset($block_fields['alrv_location_blk_radius'])) ? $block_fields['alrv_location_blk_radius'] : $def_radius;
$radius = floatval($radius_field); 
$select_location_brand = (isset($block_fields['select_location_brand'])) ? $block_fields['select_location_brand'] : null;
$lf_select_locations = (isset($block_fields['lf_select_locations'])) ? $block_fields['lf_select_locations'] : null;

$marker_pin = get_template_directory_uri() . '/assets/img/pin-blue.png';
$marker_pin_active = get_template_directory_uri() . '/assets/img/pin-green.png';
$arrZips   = array();
$results    = array();

?>

<div id="<?php echo $id; ?>" class="<?php echo $align_class . ' ' . $class_name . ' ' . $name; ?> glide-block-<?php echo $block_glide_name; ?>">
	<div class="ppc-location-tabs-block ppc-location-with-search <?php echo ($alrv_location_layout == 'container') ? 'container-width-layout' : 'full-width-layout';?> ppc-locations-block <?php if (!empty($lf_select_locations) || !empty($default_zip_code)) {
																											echo 'search-results-loc';
																										} ?> ">
		<div class="ppc-location-tabs-ctn">
			<div class="ppc-location-map" id="interactive-map">
				<div id="locationMap"></div>
			</div>
			<div class="ppc-locations-area">
				<div class="ppc-location-head">
					<h4 class="ppc-title"><?php echo $alrv_lctn_fltr_title; ?></h4>
					<div class="ppc-location-details">
<!-- 						<div class="subtitle"><?php echo $alrv_lctn_fltr_dcr; ?></div>
 -->						<div class="location-search-result">
							<div class="zip-search">
								<div class="form-group">
									<input type="hidden" name="radius" id="radius" value="<?php echo $radius; ?>">
									<input type='text' name="zipcode" id="zipcodes" value="<?php echo $default_zip_code; ?>" class="loc-filter-rg form-control search-autocomplete" placeholder="Search by City or ZIP code">
									<input type="hidden" id="selected-state" name="selected_state" value="">
									<button type="button" id="resetZipcodeBtn" class="reset-zipcode-btn" style="display: none;">&#10006;</button>
								</div>

								<div id="ajax-error-response"></div>
							</div>
						</div>
					</div>
					<div class="location-loader">
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
					</div>
				</div>

				<div class="ppc-location-inner">
					<div class="ppc-locations-list">
						<div class="ppc-location-box" id="ajax-location-response">
							<?php $alat = '33.0237769';
								$alng = '-96.7963909';
							if (!empty($default_zip_code)) { ?>
								<?php
								$res_zip = '';
								$error = '';
								$count  = 0;
								$results = array();

								if (!empty($default_zip_code)) {
									$zcode = $default_zip_code;
									if (is_numeric($zcode)) {
										// Custom function for check ZIPCODE in local-database
										if (retrieve_location_db_data($zcode)) {
											?>
											<span class="location-from" style="display: none;">From DB</span>
											<?php
											$location_data = retrieve_location_db_data($zcode);
										} else {
											// Custom function for check ZIPCODE in API
											?>
											<span class="location-from" style="display: none;">From API</span>
											<?php
											$location_data = get_geocode_api_data($zcode);
										}
									} else {

										$global_state = 'Invalid';
									}
								}
								
								if($location_data){
									$def_lat = $location_data['latitude'];
							    	$def_long = $location_data['longitude'];							    
							    	$global_state = $location_data['state'];							    
							    }							    
								
								// To select location brands taxonomy option
								if (!empty($select_location_brand)) {
						            $tax_query = array(
						                array(
						                    'taxonomy' => 'location-brand',
						                    'field'    => 'term_id',
						                    'terms'    => $select_location_brand
						                )
						            );
						        } else {
						            $tax_query = array(); // Provide a default value if $select_location_brand is not set
						        }

								$args = array(
									'post_type'      => array('location'),
									'post_status'    => 'publish',
									'posts_per_page' => -1,
									'orderby'        => 'menu_order',
									'order'          => 'ASC',
									'tax_query'      => $tax_query,
								);
								$locations_array = array();

								// dump($args);
								$query                  = new WP_Query($args);
								// The Loop
								if ($query->have_posts()) {

									while ($query->have_posts()) {

										$query->the_post();
										$pID         = get_the_ID();
										$post_fields = get_fields($pID);
										$lat = get_post_meta($pID, 'birdeye_lat', true);
										$lng = get_post_meta($pID, 'birdeye_lng', true);
										if ($def_lat && $def_long) {

											$distance = calculate_distance($def_lat, $def_long, $lat, $lng);
											if ($distance <= $radius) {
												$locations_array[] = array(
													'pID'           => $pID,
													'post_fields'   => $post_fields,
													'lat'           => $lat,
													'lng'           => $lng,
													'distance'      => $distance,
												);
											}
										} else {
											$locations_array[] = array(
												'pID'           => $pID,
												'post_fields'   => $post_fields,
												'lat'           => $lat,
												'lng'           => $lng,
											);
										}
									}
								}
								if ($def_lat && $def_long) {
									// Sort locations array by closest distance first
									usort($locations_array, function($a, $b) {
										return $a['distance'] <=> $b['distance'];
									});
								}
								if ( ! empty( $locations_array ) ) {
									foreach ( $locations_array as $location ) {   
										$pID = $location['pID'];
										$post_fields = $location['post_fields']; 
										if ($post_fields['alrv_slo_birdeye_location_id'] == '') {
											continue;
										}
										$alrv_slo_birdeye_location_id = $post_fields['alrv_slo_birdeye_location_id'];
											if ($alrv_slo_birdeye_location_id) {
												$address1       = (get_post_meta($pID, 'birdeye_address1', true)) ? get_post_meta($pID, 'birdeye_address1', true) : null;
												$address2       = (get_post_meta($pID, 'birdeye_address2', true)) ?  ', ' . get_post_meta($pID, 'birdeye_address2', true)  : null;
												$city           = (get_post_meta($pID, 'birdeye_city', true)) ? ' ' . get_post_meta($pID, 'birdeye_city', true) . ',' : null;
												$state          = (get_post_meta($pID, 'birdeye_state', true)) ? get_post_meta($pID, 'birdeye_state', true) . ',' : null;
												$zip            = (get_post_meta($pID, 'birdeye_zip', true)) ? get_post_meta($pID, 'birdeye_zip', true) : null;
												$phone          = (get_post_meta($pID, 'birdeye_phone', true)) ? get_post_meta($pID, 'birdeye_phone', true) : null;
												$address = $address1 . '' . $address2 . ' ' . $city . ' ' . $state . ' ' . $zip;
												$coverImageUrl  = (get_post_meta($pID, 'birdeye_coverImageUrl', true)) ? get_post_meta($pID, 'birdeye_coverImageUrl', true) : null;
											}
											$lat = (get_post_meta($pID, 'birdeye_lat', true)) ? get_post_meta($pID, 'birdeye_lat', true) : null;
											$lng = (get_post_meta($pID, 'birdeye_lng', true)) ? get_post_meta($pID, 'birdeye_lng', true) : null;
											$alat            = (get_post_meta($pID, 'birdeye_lat', true)) ? get_post_meta($pID, 'birdeye_lat', true) : null;
											$alng            = (get_post_meta($pID, 'birdeye_lng', true)) ? get_post_meta($pID, 'birdeye_lng', true) : null;
											$res_zip            = (get_post_meta($pID, 'birdeye_zip', true)) ? get_post_meta($pID, 'birdeye_zip', true) : null;
											$alrv_slo_title                 = (isset($post_fields['alrv_slo_title'])) ? $post_fields['alrv_slo_title'] : null;
											$alrv_slo_fax                 = (isset($post_fields['alrv_slo_fax'])) ? $post_fields['alrv_slo_fax'] : null;
											$src = wp_get_attachment_image_url(get_post_thumbnail_id($pID), 'thumb_900');
											if (!$src) {
												$src = $coverImageUrl;
											} elseif (!$coverImageUrl) {
												$src = esc_url(get_template_directory_uri()) . '/assets/img/admin/defaults/default-image.webp';
											} else {
												$src = $src;
											} 
											$results[$count]['location_id']   = $pID;
											$results[$count]['title']         = get_the_title($pID);
											$results[$count]['lat']           = $lat;
											$results[$count]['long']          = $lng;
											$results[$count]['phone_numbers'] = $phone;
											$results[$count]['address']       = $address;
											$results[$count]['URL']           = esc_url(get_permalink($pID));
											$results[$count]['fax']           = $alrv_slo_fax;
											$results[$count]['clinical']      = '';
											$arrZips[]                          = array(
												'label' => $zip,
												'value' => $zip,
											);
											
											$count++; ?>
										<a href="<?php echo get_permalink($pID); ?>" class="location-list-data" id="location-<?php echo $pID; ?>" data-zip="<?php echo $zip; ?>">
											<div class="location-tab-image" style="background-image: url(<?php echo $src; ?>);">
											</div>
											<div class="location-tab-content">
												<div class="ppc-tab-loc-title">
													<?php
													if ($alrv_slo_title) {
														echo $alrv_slo_title;
													} else {
														echo get_post_meta($pID, 'birdeye_name', true);
													}
													?>
												</div>
												<?php if ($address) {  ?>
													<div class="ppc-tab-loc-address">
														<?php echo $address; ?>
													</div>
												<?php } ?>
												<div class="ppc-tab-loc-learn">
													learn More
												</div>
											</div>
										</a>									
										<?php 
									} 
									wp_reset_postdata();
									wp_reset_query(); 
								} 
								else {
									if ($global_state == 'Invalid') {
										$error .= '<div class="no-location-found">Please enter a valid Zipcode</div>';
									} elseif ($global_state != '') {
										$error .= '<div class="no-location-found">No locations found in <strong>' . ucfirst($global_state) . '</strong></div>';
									} else {
										$error .= '<div class="no-location-found">No locations found</div>';
									}
									?>
									<script>
										jQuery(document).ready(function() {
											setTimeout(() => {

												jQuery('#ajax-error-response').html('<?php echo $error; ?>');
												jQuery('.ppc-location-with-search').addClass('ppc-location-no-search-result');
												jQuery('.ppc-no-result').show();
												jQuery('.ppc-location-inner').hide();
											}, 500);
										});
									</script>
								<?php
								} 
							} ?>
							<?php if (!empty($lf_select_locations)) { ?>

								<?php
								$results = array();
								$count = 0;
								global $post;
								foreach ($lf_select_locations as $lp_posts) {
									$post = $lp_posts;
									setup_postdata($post);
									$pID         = get_the_ID();
									$post_fields = get_fields($pID);
									$res_zip = '';
									$alrv_slo_birdeye_location_id = $post_fields['alrv_slo_birdeye_location_id'];
									if ($alrv_slo_birdeye_location_id) {

										$address1 = (get_post_meta($pID, 'birdeye_address1', true)) ? get_post_meta($pID, 'birdeye_address1', true) : null;
										$address2 = (get_post_meta($pID, 'birdeye_address2', true)) ?  ', ' . get_post_meta($pID, 'birdeye_address2', true)  : null;
										$city  = (get_post_meta($pID, 'birdeye_city', true)) ? ' ' . get_post_meta($pID, 'birdeye_city', true) . ',' : null;
										$state  = (get_post_meta($pID, 'birdeye_state', true)) ? get_post_meta($pID, 'birdeye_state', true) . ',' : null;
										$zip  = (get_post_meta($pID, 'birdeye_zip', true)) ? get_post_meta($pID, 'birdeye_zip', true) : null;
										$phone  = (get_post_meta($pID, 'birdeye_phone', true)) ? get_post_meta($pID, 'birdeye_phone', true) : null;
										$address = $address1 . '' . $address2 . ' ' . $city . ' ' . $state . ' ' . $zip;
										$coverImageUrl  = (get_post_meta($pID, 'birdeye_coverImageUrl', true)) ? get_post_meta($pID, 'birdeye_coverImageUrl', true) : null;
										$lat = (get_post_meta($pID, 'birdeye_lat', true)) ? get_post_meta($pID, 'birdeye_lat', true) : null;
										$lng = (get_post_meta($pID, 'birdeye_lng', true)) ? get_post_meta($pID, 'birdeye_lng', true) : null;

										$alat = (get_post_meta($pID, 'birdeye_lat', true)) ? get_post_meta($pID, 'birdeye_lat', true) : null;
										$alng = (get_post_meta($pID, 'birdeye_lng', true)) ? get_post_meta($pID, 'birdeye_lng', true) : null;
										$res_zip            = (get_post_meta($pID, 'birdeye_zip', true)) ? get_post_meta($pID, 'birdeye_zip', true) : null;
									}

									$alrv_slo_title                 = (isset($post_fields['alrv_slo_title'])) ? $post_fields['alrv_slo_title'] : null;
									$alrv_slo_fax                 = (isset($post_fields['alrv_slo_fax'])) ? $post_fields['alrv_slo_fax'] : null;
									$src = wp_get_attachment_image_url(get_post_thumbnail_id($pID), 'thumb_900');
									if (!$src) {
										$src = $coverImageUrl;
									} elseif (!$coverImageUrl) {
										$src = esc_url(get_template_directory_uri()) . '/assets/img/admin/defaults/default-image.webp';
									} else {
										$src = $src;
									}
									$results[$count]['location_id']   = $pID;
									$results[$count]['title']         = get_the_title($pID);
									$results[$count]['lat']           = $lat;
									$results[$count]['long']          = $lng;
									$results[$count]['phone_numbers'] = $phone;
									$results[$count]['address']       = $address;
									$results[$count]['URL']           = esc_url(get_permalink($pID));
									$results[$count]['fax']           = $alrv_slo_fax;
									$results[$count]['clinical']      = '';
									$arrZips[]                          = array(
										'label' => $zip,
										'value' => $zip,
									);
									$count++;
								?>

									<a href="<?php echo get_permalink($pID); ?>" class="location-list-data" id="location-<?php echo $pID; ?>" data-zip="<?php echo $zip; ?>">
										<div class="location-tab-image" style="background-image: url(<?php echo $src; ?>);">
										</div>
										<div class="location-tab-content">
											<div class="ppc-tab-loc-title">
												<?php
												if ($alrv_slo_title) {
													echo $alrv_slo_title;
												} else {
													echo get_post_meta($pID, 'birdeye_name', true);
												}
												?>
											</div>
											<?php if ($address) {  ?>
												<div class="ppc-tab-loc-address">
													<?php echo $address; ?>
												</div>
											<?php } ?>
											<div class="ppc-tab-loc-learn">
												learn More
											</div>
										</div>
									</a>


								<?php } ?>
								<?php wp_reset_postdata();
								wp_reset_query(); ?>

							<?php }  ?>
						</div>
					</div>
				</div>
				<div class="ppc-location-details ppc-no-result" style="display:none;">
					<h3>No Nearby locations found</h3>
					<p class="subtitle">Try adjusting your search results to find an office near you.
					</p>
					<ul class="no-search-list">
						<li>Search by your zip code or exact location</li>
						<li>Drag or zoom out on map to show more locations</li>
					</ul>
				</div>
				<div class="ppc-loc-button">
					<a href="<?php echo $alrv_loc_link['url']; ?>" class="button"><?php echo $alrv_loc_link['title']; ?></a>
				</div>
			</div>
		</div>
	</div>
</div>

<?php
// print_r($arrZips);

	// load location filters scripts
	wp_register_script('locations-scripts', get_template_directory_uri() . '/assets/js/location.js', array(), '', true);
	
	wp_localize_script(
		'locations-scripts',
		'locationVars',
		array(
			'ajaxurl'           => admin_url('admin-ajax.php'),
			'alat'              => $alat,
			'alng'              => $alng,
			'zipcodeParam'      => $res_zip,
			'stateParam'        => '',
			'zipcodes'          => $arrZips,
			'markerImage'       => get_template_directory_uri() . '/assets/img/pin-blue.png',
			'markerActiveImage' => get_template_directory_uri() . '/assets/img/pin-green.png',
			'results'           => $results,
			'is_singular' => (count($arrZips) == 1) ? 'yes' : 'no',
			'is_tooltip' => 'yes',
			'assets_url'        => esc_url(get_template_directory_uri()),
		)
	);
    
	
	// get_all_location_pins(null,$tax_query,$meta_query,$alat,$alng,$res_zip);


?>

<!-- Google Places API Autocomplete -->
<script type="text/javascript">

	function initAutocomplete() {
	    var input = jQuery('#zipcodes')[0];
	    var options = {
            componentRestrictions: { country: "us" },

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
        }
	        else {
            	searchLocations(place, '');
        	}

	    function searchLocations(place, stateVal) {
        // Extract state, Lat, Long from the place address
	        var state = '';
	        var lat = ''; 
        	var long = ''; 
        	
        	if(place.address_components){
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


	        //filter logic
		      
		        var items = [];
		        jQuery('.loc-filter-rg').each(function() {
		            var item = {
		                title: jQuery(this).attr('id'),
		                value: state,
		                type: jQuery(this).attr('id'),
		                lat: lat,
		                long: long,
		            };
		            items.push(item);
		        });
		        var data = {
		            action: 'location_pollen_filter_regional',
		            items: items,
		            all: false,
		            zipcodes: locationVars.zipcodes,
		           	radius: jQuery('#radius').val(),

		        };
		        
		    	jQuery('#ajax-location-response').html('');
		        jQuery('.lds-roller').show();

		        // Trigger AJAX call
		        jQuery.ajax({
		            url: localVars.ajax_url,
		            type: 'post',
		            data: data,
		            success: function(response) {
		                var data = JSON.parse(response);
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
		                jQuery('#ajax-location-response').html(data.html);
		                jQuery('#ajax-error-response').html(data.error);
		                if (data.error != '') {
		                    jQuery('.ppc-location-with-search').addClass('ppc-location-no-search-result');
		                    jQuery('.ppc-no-result').show();
		                    jQuery('.ppc-location-inner').hide();
		                } else {
		                    jQuery('.ppc-location-with-search').removeClass('ppc-location-no-search-result');
		                    jQuery('.ppc-no-result').hide();
		                    jQuery('.ppc-location-inner').show();
		                }
		                setTimeout(initMap, 500);
		                jQuery('.location-filter').addClass('has-filter-btn');
		                jQuery('.lds-roller').hide();
		            }
		        });
    }
	    });
	}
	window.addEventListener('load', initAutocomplete);

	jQuery(document).ready(function() {

		function toggleResetButton() {
        var inputValue = jQuery('#zipcodes').val().trim();
        if (inputValue !== '') {
            jQuery('#resetZipcodeBtn').show();
        } else {
            jQuery('#resetZipcodeBtn').hide();
        }
    }

    // Show/hide the "x" button on page load
    toggleResetButton();

    // Show/hide the "x" button on input change
    jQuery('#zipcodes').on('input', toggleResetButton);

    // Reset input value and hide the button on click of the "x" button
    jQuery('#resetZipcodeBtn').on('click', function() {
        jQuery('#zipcodes').val('');
        jQuery(this).hide();
    });

   
});
</script>
