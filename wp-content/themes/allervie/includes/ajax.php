<?php
/**
 * Ajax related functions
 *
 * @link https://codex.wordpress.org/AJAX#Ajax_in_WordPress
 *
 * @package Allervie
 * @since 1.0.0
 */


function location_pollen_filter() {
    global $paged;

    if ( isset( $_POST['paged'] ) ) {
        $paged = $_POST['paged'];
    } elseif ( get_query_var( 'paged' ) ) {
        // On a paged page.
        $paged = get_query_var( 'paged' );
    } else { // Default.
        $paged = 1;
    }
    
    $data = array();
    $all_pins = array();
    $arrZips = array();
    $tax_query  = array();
    // $meta_query = array();
	$loc_post_in = array();
    $count  = 0;
    $html   = '';
    $error   = '';
    $lang  = '';
    $lung  = '';
    $res_zip  = '';
    $location_state_html      = '<option value="*">State</option>';
    $location_state_buffer    = array();
    $location_brand_html      = '<option value="*">Brands</option>';
    $location_brand_buffer    = array();
    $location_provider_html   = '<option value="*">Providers</option>';
    $location_provider_buffer = array();
    $global_state             = '';
    $filter_type = 'multi';
    $reset_queries = '';

    if ( isset( $_POST['all'] ) ) {
        if ( $_POST['all'] == 'true' ) {
            $get_all_location_pins=get_all_location_pins('-1');
            $all_pins =$get_all_location_pins['results'];
            $arrZips  =$get_all_location_pins['arrZips'];
        }
    }

    $items = $_POST['items'];
    foreach ($items as $item) {
        if (isset($item['lat']) && isset($item['long'])) {
            $def_lat = $item['lat'];
            $def_long = $item['long'];
            $filter_type = 'map';
            break; 
        }
    }
    foreach ($items as $item) {
        if (isset($item['reset'])) {
            if($item['reset'] == 'tax_query'){
                $reset_queries = 'true';
                break;
            }
        }
    }

    $get_query_args=get_query_args($items);
    $tax_query=$get_query_args['tax_query'];
    $loc_post_in = $get_query_args['loc_post_in'];
    $radius = get_field('alrv_loc_filter_rad','option');

    $global_state=$get_query_args['global_state'];
    if($reset_queries == 'true') {
        $tax_query = '';
		$loc_post_in = '';

    }
    if($tax_query=='' && $loc_post_in==''){
        $get_all_location_pins=get_all_location_pins('-1');
        $location_state_html  .=$get_all_location_pins['location_state_html'];
        $location_brand_html  .=$get_all_location_pins['location_brand_html'];
        $location_provider_html  .=$get_all_location_pins['location_provider_html'];
    }

    $args = array(
        'post_type'      => array( 'location' ),
        'post_status'    => 'publish',
        'posts_per_page' => -1, // how many posts you need
        'orderby'        => 'menu_order',
        'order'          => 'ASC',
        'tax_query'      => $tax_query,
        'post__in'        => $loc_post_in,
        'paged'          => $paged, // add the 'paged' parameter to the query
    );

    $locations_array = array();

    $query = new WP_Query( $args );
    if ( $query->have_posts() ) {
        while ( $query->have_posts() ) {
            $query->the_post();
            $pID           = get_the_ID();
            $post_fields   = get_fields( $pID );
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
                        'distance'    => $distance, 

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

        $total_locations = count($locations_array);
        $posts_per_page = 12;
        $current_page = isset($_POST['paged']) ? $_POST['paged'] : 1;
        $total_pages = ceil($total_locations / $posts_per_page);
        $offset = ($current_page - 1) * $posts_per_page;
        $posts_for_this_page = array_slice($locations_array, $offset, $posts_per_page);


        if ( ! empty( $posts_for_this_page ) ) {
        $html .= '<div class="srv-cards d-flex align-items-stretch flex-wrap">';
            global $post;
            $count = 0;
            foreach ( $posts_for_this_page as $location ) {
                $pID = $location['pID'];
                $post = get_post($pID); 
                setup_postdata($post);
                $post_fields = $location['post_fields'];

                if ( $post_fields['alrv_slo_birdeye_location_id'] == ''  ) {
                    continue;
                }

                // Check $_POST['all'] value
                if ( isset( $_POST['all'] ) && $_POST['all'] == 'false' ) {
                    $alrv_slo_fax = ( isset( $post_fields['alrv_slo_fax'] ) ) ? $post_fields['alrv_slo_fax'] : null;
                    $lat            = ( get_post_meta( $pID, 'birdeye_lat', true ) ) ? get_post_meta( $pID, 'birdeye_lat', true ) : null;
                    $lng            = ( get_post_meta( $pID, 'birdeye_lng', true ) ) ? get_post_meta( $pID, 'birdeye_lng', true ) : null;
                    $phone          = ( get_post_meta( $pID, 'birdeye_phone', true ) ) ? get_post_meta( $pID, 'birdeye_phone', true ) : null;
                    $address1       = ( get_post_meta( $pID, 'birdeye_address1', true ) ) ? get_post_meta( $pID, 'birdeye_address1', true ): null;
                    $address2       = ( get_post_meta( $pID, 'birdeye_address2', true ) ) ?  ', '. get_post_meta( $pID, 'birdeye_address2', true )  : null;
                    $city           = ( get_post_meta( $pID, 'birdeye_city', true ) ) ? '<br>' . get_post_meta( $pID, 'birdeye_city', true ) . ',' : null;
                    $state          = ( get_post_meta( $pID, 'birdeye_state', true ) ) ? get_post_meta( $pID, 'birdeye_state', true ) . ',' : null;
                    $zip            = ( get_post_meta( $pID, 'birdeye_zip', true ) ) ? get_post_meta( $pID, 'birdeye_zip', true ) : null;
                    $countryCode    = ( get_post_meta( $pID, 'birdeye_countryCode', true ) ) ? get_post_meta( $pID, 'birdeye_countryCode', true ) : null;
                    $googleUrl      = ( get_post_meta( $pID, 'birdeye_googleUrl', true ) ) ? get_post_meta( $pID, 'birdeye_googleUrl', true ) : null;

                    $address        = $address1 . '' . $address2 . ' ' . $city . ' ' . $state . ' ' . $zip;
                    $lang           = $lat;
                    $lung           = $lng;
                    $res_zip        = $zip;
                    $clinical       = '';
                    $condition_term = get_the_terms( $pID, 'location-type' );
                    if ( $condition_term ) {
                        foreach ( $condition_term as $condition ) {
                            $current_location_type = $condition->slug;
                            if ( $current_location_type == 'clinical-research' ) {
                                $clinical .= '<div class="services-catagories">
                                        <span class="cat-btn" style="background-color: #1d9db9;">' . $condition->name . '</span>
                                    </div>';
                            }
                        }
                    }
                    if($tax_query!='' || $meta_query!=''){
                        $location_state                 = get_the_terms( $pID, 'location-state' );
                        $location_brand                 = get_the_terms( $pID, 'location-brand' );
                      
						// new acf provider backend relationship 'alrv_spo_location_on_providers'
						$alrv_slo_providers_on_location = get_provider_by_location_id($pID);
                        if ( $location_state ) {
                            foreach ( $location_state as $key => $state ) {
                                if ( ! in_array( $state->slug, $location_state_buffer ) ) {
                                    $location_state_html .= '<option value="' . $state->slug . '">' . $state->name . '</option>';
                                }
                                $location_state_buffer[] = $state->slug;
                            }
                        }
                        if ( $location_brand ) {
                            foreach ( $location_brand as $key => $brand ) {
                                if ( ! in_array( $brand->slug, $location_brand_buffer ) ) {
                                    $location_brand_html .= '<option value="' . $brand->slug . '">' . $brand->name . '</option>';
                                }
                                $location_brand_buffer[] = $brand->slug;
                            }
                        }
                        if ( $alrv_slo_providers_on_location ) {
                            foreach ( $alrv_slo_providers_on_location as $key => $location ) {
                                if ( ! in_array( $location, $location_provider_buffer ) ) {
                                    $location_provider_html .= '<option value="' . $location . '">' . get_the_title( $location ) . '</option>';
                                }
                                $location_provider_buffer[] = $location;
                            }
                        }
                    }

                    $all_pins[ $count ]['location_id']   = $pID;
                    $all_pins[ $count ]['title']         = get_the_title( $pID );
                    $all_pins[ $count ]['lat']           = $lat;
                    $all_pins[ $count ]['long']          = $lng;
                    $all_pins[ $count ]['phone_numbers'] = $phone;
                    $all_pins[ $count ]['address']       = $address;
                    $all_pins[ $count ]['URL']           = esc_url( get_permalink( $pID ) );
                    $all_pins[ $count ]['fax']           = $alrv_slo_fax;
                    $all_pins[ $count ]['clinical']      = $clinical;
                    $all_pins[ $count ]['googleUrl']     = $googleUrl;

                    $html .= load_template_part( 'partials/content-archive', get_post_type(), array( 'paged' => $paged ) );
                    wp_reset_postdata();
                    $count++;
                }
                else {
                    $html .= load_template_part( 'partials/content-archive', get_post_type(), array( 'paged' => $paged ) );

                }

            }
            $html .= '</div><div class="s-60"></div>';
        } 
        else 
        {
            // if($filter_type == 'map'){
            //     $html .= '<div class="ppc-location-details ppc-no-result"><h3>No Nearby locations found within ' .$radius .' miles of radius.</h3><p class="subtitle">Try adjusting your search results to find an office near you.</p></div>';
            
            //     $error .= '<div class="no-location-error"><div class="ppc-location-details ppc-no-result"><h3>No Nearby locations found within ' .$radius .' miles of radius.</h3><p class="subtitle">Try adjusting your search results to find an office near you.</p></div></div>';
            // }
            // else{
                $html .= '<div class="ppc-location-details ppc-no-result"><h3>No Nearby locations found</h3><p class="subtitle">Try adjusting your search results to find an office near you.</p></div>';
            
                $error .= '<div class="no-location-error"><div class="ppc-location-details ppc-no-result"><h3>No Nearby locations found</h3><p class="subtitle">Try adjusting your search results to find an office near you.</p></div></div>';
            //}
	        
	            $lang = $def_lat;
	            $lung = $def_long;
	    }
    
        
            if ( function_exists( 'glide_pagination_location_ajax' ) ) {
                $html .= glide_pagination_location_ajax( $filter_type, $total_pages, $items );
            }	
        
    

    $data['all_pins']=$all_pins;
    $data['is_singular']=(count($all_pins) > 1 ) ? 'no' : 'yes';
    $data['arrZips']=$arrZips;
    $data['html']=$html;
    $data['error']=$error;
    $data['lang']=$lang;
    $data['lung']=$lung;
    $data['res_zip']=$res_zip;
    $data['location_state']    = $location_state_html;
    $data['location_brand']    = $location_brand_html;
    $data['location_provider'] = $location_provider_html;
    // data for testing
    $data['items']=$items;
    $data['global_state']=$global_state;
    $data['args']=$args;
    echo json_encode( $data );
    wp_die();
}

add_action( 'wp_ajax_nopriv_location_pollen_filter', 'location_pollen_filter' );
add_action( 'wp_ajax_location_pollen_filter', 'location_pollen_filter' );


function location_pollen_filter_regional() {

	$data = array();
	$all_pins = array();
	$arrZips = array();
	$tax_query  = array();
	$meta_query = array();
	$count  = 0;
	$html   = '';
	$error   = '';
	$lang  = '';
	$lung  = '';
	$res_zip  = '';
	$marker_pin = get_template_directory_uri() . '/assets/img/pin-blue.png';
	$marker_pin_active = get_template_directory_uri() . '/assets/img/pin-green.png';
	$global_state             = '';

	if ( isset( $_POST['all'] ) ) {
		if ( $_POST['all'] == 'true' ) {
			$get_all_location_pins=get_all_location_pins('-1',$marker_pin,$marker_pin_active);
			$all_pins =$get_all_location_pins['results'];
			$arrZips  =$get_all_location_pins['arrZips'];
		}
	}

	$items = $_POST['items'];
	$def_lat = $items[0]['lat'];
	$def_long = $items[0]['long'];
    $def_radius =  get_field('alrv_loc_filter_rad','option');
    $radius_field = isset($_POST['radius']) ? $_POST['radius'] : $def_radius;
    $radius = floatval($radius_field);  $brand_type = $_POST['brand_type'];	$brand_type = $_POST['brand_type'];
	$global_state=$get_query_args['global_state'];

	$args = array(
		'post_type'      => array( 'location' ),
		'post_status'    => 'publish',
		'posts_per_page' => -1, // how many posts you need
		'orderby'        => 'menu_order',
		'order'          => 'ASC',
	);

	$locations_array = array();
	$query = new WP_Query( $args );
	if ( $query->have_posts() ) {
		 while ( $query->have_posts() ) {
            $query->the_post();
            $pID           = get_the_ID();
            $post_fields   = get_fields( $pID );
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

            // Check $_POST['all'] value
            if ( isset( $_POST['all'] ) && $_POST['all'] == 'false' ) {
					$alrv_slo_fax = ( isset( $post_fields['alrv_slo_fax'] ) ) ? $post_fields['alrv_slo_fax'] : null;
				$lat            = ( get_post_meta( $pID, 'birdeye_lat', true ) ) ? get_post_meta( $pID, 'birdeye_lat', true ) : null;
				$lng            = ( get_post_meta( $pID, 'birdeye_lng', true ) ) ? get_post_meta( $pID, 'birdeye_lng', true ) : null;
				$phone          = ( get_post_meta( $pID, 'birdeye_phone', true ) ) ? get_post_meta( $pID, 'birdeye_phone', true ) : null;
				$address1       = ( get_post_meta( $pID, 'birdeye_address1', true ) ) ? get_post_meta( $pID, 'birdeye_address1', true ): null;
				$address2       = ( get_post_meta( $pID, 'birdeye_address2', true ) ) ?  ', '. get_post_meta( $pID, 'birdeye_address2', true )  : null;
				$city           = ( get_post_meta( $pID, 'birdeye_city', true ) ) ? '<br>' . get_post_meta( $pID, 'birdeye_city', true ) . ',' : null;
				$state          = ( get_post_meta( $pID, 'birdeye_state', true ) ) ? get_post_meta( $pID, 'birdeye_state', true ) . ',' : null;
				$zip            = ( get_post_meta( $pID, 'birdeye_zip', true ) ) ? get_post_meta( $pID, 'birdeye_zip', true ) : null;
				$countryCode    = ( get_post_meta( $pID, 'birdeye_countryCode', true ) ) ? get_post_meta( $pID, 'birdeye_countryCode', true ) : null;
				$googleUrl      = ( get_post_meta( $pID, 'birdeye_googleUrl', true ) ) ? get_post_meta( $pID, 'birdeye_googleUrl', true ) : null;

				$address        = $address1 . '' . $address2 . ' ' . $city . ' ' . $state . ' ' . $zip;
				$lang           = $lat;
				$lung           = $lng;
				$res_zip        = $zip;
				$clinical       = '';
				$condition_term = get_the_terms( $pID, 'location-type' );

				$all_pins[ $count ]['location_id']   = $pID;
				$all_pins[ $count ]['title']         = get_the_title( $pID );
				$all_pins[ $count ]['lat']           = $lat;
				$all_pins[ $count ]['long']          = $lng;
				$all_pins[ $count ]['phone_numbers'] = $phone;
				$all_pins[ $count ]['address']       = $address;
				$all_pins[ $count ]['URL']           = esc_url( get_permalink( $pID ) );
				$all_pins[ $count ]['fax']           = $alrv_slo_fax;
				$all_pins[ $count ]['clinical']      = $clinical;
				$all_pins[ $count ]['googleUrl']     = $googleUrl;


				$coverImageUrl  = ( get_post_meta( $pID, 'birdeye_coverImageUrl', true ) ) ? get_post_meta( $pID, 'birdeye_coverImageUrl', true ) : null;

				$src = wp_get_attachment_image_url( get_post_thumbnail_id(  $pID ), 'thumb_900' );
				if ( !$src ) {
					$src=$coverImageUrl;			
				}elseif(!$coverImageUrl){
					$src = esc_url( get_template_directory_uri() ). '/assets/img/admin/defaults/default-image.webp';
				}else {
					$src = $src;
				}

			}
			$ppc_loc_title ='';
			$alrv_slo_title = ( isset( $post_fields['alrv_slo_title'] ) ) ? $post_fields['alrv_slo_title'] : null;

			if ( $alrv_slo_title ) { $ppc_loc_title = $alrv_slo_title; } else {  $ppc_loc_title = get_post_meta( $pID, 'birdeye_name', true ); }
			// $html .= load_template_part( 'partials/content-archive', get_post_type(), array( 'paged' => $paged ) );
			$html .='<a href="'. get_permalink( $pID ) .'" class="location-list-data" id="location-'.$pID.'">
				<div class="location-tab-image" style="background-image: url('.$src .');">
				</div>
				<div class="location-tab-content">
					<div class="ppc-tab-loc-title">'.$ppc_loc_title.'</div>
						<div class="ppc-tab-loc-address">'. $address .'
						</div>
					<div class="ppc-tab-loc-learn">
						learn More
					</div>
				</div>
			</a>';

			$count++;
	
		}
	}
	else 
	{
	
		$error .= '<div class="no-location-found">No locations found</div>';
		$lang = $def_lat;
		$lung = $def_long;
	}
	$data['all_pins']=$all_pins;
	$data['is_singular']=(count($all_pins) > 1 ) ? 'no' : 'yes';
	$data['arrZips']=$arrZips;
	$data['html']=$html;
	$data['error']=$error;
	$data['lang']=$lang;
	$data['lung']=$lung;
	$data['res_zip']=$res_zip;
	$data['location_state']    = $location_state_html;
	$data['location_brand']    = $location_brand_html;
	$data['location_provider'] = $location_provider_html;
	// data for testing
	$data['items']=$items;
	$data['global_state']=$global_state;
	$data['args']=$args;
	echo json_encode( $data );
	wp_die();
}
add_action( 'wp_ajax_nopriv_location_pollen_filter_regional', 'location_pollen_filter_regional' );
add_action( 'wp_ajax_location_pollen_filter_regional', 'location_pollen_filter_regional' );

function populate_location_by_state() {
	if ( $_POST['slug'] != '' ) {
		$tax_query = array(
			array(
				'taxonomy' => 'location-state',
				'field'    => 'name',
				'terms'    => $_POST['slug'],
			),
		);
	} else {
		$tax_query = '';
	}
	$args = array(
		'post_type'      => array( 'location' ),
		'posts_per_page' => -1,
		'meta_key'  => 'meta_location_state',
		'orderby'  => 'meta_value',
		'post_status'    => array( 'publish' ),
		'order'     => 'ASC',
		'tax_query'      => $tax_query,
		'meta_query' => array(
			array(
				'key' => 'make_an_appointment_button',
				'value' => 'disable',
				'compare' => '!=',
			)
		),
	);
	// var_dump($args);
	$query = new WP_Query( $args );
	// $dataAttrsField=$field->dataAttrsField
	$options  = '<option value="" class="gf_placeholder">Select a Location</option>';
	$location = $_POST['location'];
	if ( $query->have_posts() ) {
		while ( $query->have_posts() ) {
			$selected = '';
			$query->the_post();
			$pID         = get_the_ID();
			$post_title  = get_the_title( $pID );
			$state = get_the_terms( $pID, 'location-state' );
			$city = get_the_terms( $pID, 'location-city' );
			$post_fields=get_fields($pID);
			$alrv_slo_external_btn = (isset($post_fields['alrv_slo_external_btn'])) ? $post_fields['alrv_slo_external_btn'] : null;
			$alrv_slo_tracking_code = (isset($post_fields['alrv_slo_tracking_code'])) ? $post_fields['alrv_slo_tracking_code'] : null;
			$alrv_loc_state_short_name='';
			if(isset($state[0])){
				$state=$state[0];
				$alrv_loc_state_short_name=(get_field('alrv_loc_state_short_name', $state)) ? get_field('alrv_loc_state_short_name', $state) : null;
			}
			if(isset($city[0])){
				$city=$city[0];
			}
			if($alrv_loc_state_short_name || $city->name){
				$post_title=$alrv_loc_state_short_name . '-' .$city->name;
			}
			$post_fields = get_fields( $pID );
			if ( $location == $pID ) {
				$selected = 'selected="selected"';
			}
			if($alrv_slo_external_btn){
				$alrv_slo_external_btn='data-button="'.$alrv_slo_external_btn['url'].'" data-button-title="'.$alrv_slo_external_btn['title'].'" ';
			}else{
				$alrv_slo_external_btn='data-button="" data-button-title="" ';
			}
			if($alrv_slo_tracking_code){
				$alrv_slo_tracking_code='data-tracking-code="'.$alrv_slo_tracking_code.'" ';
			}else{
				$alrv_slo_tracking_code='data-tracking-code="" ';
			}
			$options .= '<option data-id="' . $pID . '" '.$alrv_slo_external_btn.' '.$alrv_slo_tracking_code.' value="' . $post_title . '" ' . $selected . '>' . $post_title . '</option>';
		}
	}
	echo $options;
	wp_die();
}
add_action( 'wp_ajax_nopriv_populate_location_by_state', 'populate_location_by_state' );
add_action( 'wp_ajax_populate_location_by_state', 'populate_location_by_state' );


function populate_provider_by_location() {
	$location = $_POST['location'];
	if ( $location ) {
		$args = array(
			'post_type'      => array( 'location' ),
			'posts_per_page' => -1,
			'post_status'    => array( 'publish' ),
			'post__in'       => array( $location ),
		);
	} else {
		$args = array(
			'post_type'      => array( 'location' ),
			'post_status'    => array( 'publish' ),
			'posts_per_page' => -1,
		);
	}

	// var_dump($args);
	$query = new WP_Query( $args );
	// $dataAttrsField=$field->dataAttrsField
	$options = '';
	$options.='<option value="First available">First available</option>';
	if ( $query->have_posts() ) {
		while ( $query->have_posts() ) {
			$selected = '';
			$query->the_post();
			$pID                            = get_the_ID();
			$post_title                     = get_the_title( $pID );
			$post_fields                    = get_fields( $pID );

			// new acf provider backend relationship 'alrv_spo_location_on_providers'
			$alrv_slo_providers_on_location = get_provider_by_location_id($pID);

			foreach ( $alrv_slo_providers_on_location as $provider ) {
				if(get_post_status($provider) == 'publish'){
					$options .= '<option data-id="' . $provider . '" value="' . get_the_title( $provider ) . '">' . get_the_title( $provider ) . '</option>';
				}
			}
		}
	}
	echo $options;
	wp_die();
}
add_action( 'wp_ajax_nopriv_populate_provider_by_location', 'populate_provider_by_location' );
add_action( 'wp_ajax_populate_provider_by_location', 'populate_provider_by_location' );

function fetch_data_from_birdeye_before() {
	update_option( 'birdeye-last-save-date', date( 'd F Y' ) );
	wp_die();
}
add_action( 'wp_ajax_nopriv_fetch_data_from_birdeye_before', 'fetch_data_from_birdeye_before' );
add_action( 'wp_ajax_fetch_data_from_birdeye_before', 'fetch_data_from_birdeye_before' );


function fetch_data_from_birdeye() {
	$element = $_POST['element'];
	// dump($element);
	$pID         = $element['post_id'];
	$location_id = $element['location_id'];
	$curl        = curl_init();

	curl_setopt_array(
		$curl,
		array(
			CURLOPT_URL            => 'https://api.birdeye.com/resources/v1/business/' . $location_id . '?api_key=XZEFID5efK1ieD6xWQpn2g8f8fe4qYYX',
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING       => '',
			CURLOPT_MAXREDIRS      => 10,
			CURLOPT_TIMEOUT        => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST  => 'GET',
			CURLOPT_HTTPHEADER     => array(
				'content-type:  application/json',
				'Accept:  application/json',
			),
		)
	);

	$response = curl_exec( $curl );

	curl_close( $curl );
	$response          = json_decode( $response );
	$phone             = ( isset( $response->phone ) ) ? $response->phone : null;
	$phone             = ( isset( $response->phone ) ) ? $response->phone : null;
	$name              = ( isset( $response->name ) ) ? $response->name : null;
	$alias             = ( isset( $response->alias ) ) ? $response->alias : null;
	$coverImageUrl     = ( isset( $response->coverImageUrl ) ) ? $response->coverImageUrl : null;
	$lat               = ( isset( $response->location->lat ) ) ? $response->location->lat : null;
	$lng               = ( isset( $response->location->lng ) ) ? $response->location->lng : null;
	$address1          = ( isset( $response->location->address1 ) ) ? $response->location->address1 : null;
	$address2          = ( isset( $response->location->address2 ) ) ? $response->location->address2 : null;
	$city              = ( isset( $response->location->city ) ) ? $response->location->city : null;
	$state             = ( isset( $response->location->state ) ) ? $response->location->state : null;
	$zip               = ( isset( $response->location->zip ) ) ? $response->location->zip : null;
	$countryCode       = ( isset( $response->location->countryCode ) ) ? $response->location->countryCode : null;
	$address           = $address1 . ' ' . $address2 . ' ' . $city . ' ' . $state . ' ' . $zip . ' ' . $countryCode;
	$googleUrl         = ( isset( $response->socialProfileURLs->googleUrl ) ) ? $response->socialProfileURLs->googleUrl : null;
	$hoursOfOperations = ( isset( $response->hoursOfOperations ) ) ? $response->hoursOfOperations : null;
	update_post_meta( $pID, 'birdeye_alias', $alias );
	update_post_meta( $pID, 'birdeye_name', $name );
	update_post_meta( $pID, 'birdeye_coverImageUrl', $coverImageUrl );
	update_post_meta( $pID, 'birdeye_phone', $phone );
	update_post_meta( $pID, 'birdeye_lat', $lat );
	update_post_meta( $pID, 'birdeye_lat', $lat );
	update_post_meta( $pID, 'birdeye_lng', $lng );
	update_post_meta( $pID, 'birdeye_address1', $address1 );
	update_post_meta( $pID, 'birdeye_address2', $address2 );
	update_post_meta( $pID, 'birdeye_city', $city );
	update_post_meta( $pID, 'birdeye_state', $state );
	update_post_meta( $pID, 'birdeye_zip', $zip );
	update_post_meta( $pID, 'birdeye_countryCode', $countryCode );
	update_post_meta( $pID, 'birdeye_full_address', $address );
	update_post_meta( $pID, 'birdeye_googleUrl', $googleUrl );
	update_post_meta( $pID, 'birdeye_hoursOfOperations', $hoursOfOperations );
	echo '<li>All data interted in <strong>"' . get_the_title( $pID ) . '"</strong></li> ';

	wp_die();
}
add_action( 'wp_ajax_nopriv_fetch_data_from_birdeye', 'fetch_data_from_birdeye' );
add_action( 'wp_ajax_fetch_data_from_birdeye', 'fetch_data_from_birdeye' );

// AJAX handler for fetching single location data.
function fetch_single_location() {
	$birdeye_location_id = $_POST['birdeye_location_id'];
	$location_pID        = $_POST['location_postid'];

	// if ( empty($birdeye_location_id) || empty($location_pID) ) {
	// 	wp_send_json_error( 'Missing required parameters.' );
	// }

	$request_url = 'https://api.birdeye.com/resources/v1/business/' . $birdeye_location_id . '?api_key=XZEFID5efK1ieD6xWQpn2g8f8fe4qYYX';
	// $request_url = 'https://api.bdfgdfhfgirdeye.com/resources/v1/business/' . $birdeye_location_id . '?api_key=XZEFID5efK1ieD6xWQpn2g8f8fe4qYYX';

	$response = wp_remote_get( $request_url, array(
		'headers' => array(
			'Content-Type' => 'application/json',
			'Accept'       => 'application/json',
		),
		'timeout' => 20,
	) );

	if ( is_wp_error( $response ) ) {
		wp_send_json_error( 'API request failed: ' . $response->get_error_message() );
	}

	$body = wp_remote_retrieve_body( $response );
	$data = json_decode( $body );

	if (!$data) {
		wp_send_json_error( 'Invalid JSON response.' );
	}

	// Extract values safely
	$alias             = $data->alias ?? '';
	$name              = $data->name ?? '';
	$coverImageUrl     = $data->coverImageUrl ?? '';
	$phone             = $data->phone ?? '';
	$lat               = $data->location->lat ?? '';
	$lng               = $data->location->lng ?? '';
	$address1          = $data->location->address1 ?? '';
	$address2          = $data->location->address2 ?? '';
	$city              = $data->location->city ?? '';
	$state             = $data->location->state ?? '';
	$zip               = $data->location->zip ?? '';
	$countryCode       = $data->location->countryCode ?? '';
	$googleUrl         = $data->socialProfileURLs->googleUrl ?? '';
	$hoursOfOperations = $data->hoursOfOperations ?? '';

	$full_address = trim( implode( ' ', array_filter( [ $address1, $address2, $city, $state, $zip, $countryCode ] ) ) );

	// Update post meta
	update_post_meta( $location_pID, 'birdeye_alias', $alias );
	update_post_meta( $location_pID, 'birdeye_name', $name );
	update_post_meta( $location_pID, 'birdeye_coverImageUrl', $coverImageUrl );
	update_post_meta( $location_pID, 'birdeye_phone', $phone );
	update_post_meta( $location_pID, 'birdeye_lat', $lat );
	update_post_meta( $location_pID, 'birdeye_lng', $lng );
	update_post_meta( $location_pID, 'birdeye_address1', $address1 );
	update_post_meta( $location_pID, 'birdeye_address2', $address2 );
	update_post_meta( $location_pID, 'birdeye_city', $city );
	update_post_meta( $location_pID, 'birdeye_state', $state );
	update_post_meta( $location_pID, 'birdeye_zip', $zip );
	update_post_meta( $location_pID, 'birdeye_countryCode', $countryCode );
	update_post_meta( $location_pID, 'birdeye_full_address', $full_address );
	update_post_meta( $location_pID, 'birdeye_googleUrl', $googleUrl );
	update_post_meta( $location_pID, 'birdeye_hoursOfOperations', $hoursOfOperations );

	// $title = get_the_title( $location_pID );
	// $update_loc = global_notice_meta_box_callback();
	$update_loc = '
		<table class="wp-list-table widefat fixed striped table-view-list pages">
			<tbody>
				<tr>
					<th><strong>Key</strong></th>
					<th><strong>Value</strong></th>
				</tr>
				<tr>
					<th><strong>Name</strong></th>
					<td>' . get_post_meta($location_pID, 'birdeye_name', true) . '</td>
				</tr>
				<tr>
					<th><strong>Alias</strong></th>
					<td>' . get_post_meta($location_pID, 'birdeye_alias', true) . '</td>
				</tr>
				<tr>
					<th><strong>Image</strong></th>
					<td><img src="' .get_post_meta($location_pID, 'birdeye_coverImageUrl', true) . '" style="max-width: 150px;"></td>
				</tr>
				<tr>
					<th><strong>Lat</strong></th>
					<td>' . get_post_meta($location_pID, 'birdeye_lat', true) . '</td>
				</tr>
				<tr>
					<th><strong>Lng</strong></th>
					<td>' . get_post_meta($location_pID, 'birdeye_lng', true) . '</td>
				</tr>
				<tr>
					<th><strong>Phone</strong></th>
					<td>' . get_post_meta($location_pID, 'birdeye_phone', true) . '</td>
				</tr>
				<tr>
					<th><strong>Address 1</strong></th>
					<td>' . get_post_meta($location_pID, 'birdeye_address1', true) . '</td>
				</tr>
				<tr>
					<th><strong>Address 2</strong></th>
					<td>' . get_post_meta($location_pID, 'birdeye_address2', true) . '</td>
				</tr>
				<tr>
					<th><strong>City</strong></th>
					<td>' . get_post_meta($location_pID, 'birdeye_city', true) . '</td>
				</tr>
				<tr>
					<th><strong>State</strong></th>
					<td>' . get_post_meta($location_pID, 'birdeye_state', true) . '</td>
				</tr>
				<tr>
					<th><strong>Zip</strong></th>
					<td>' . get_post_meta($location_pID, 'birdeye_zip', true) . '</td>
				</tr>
				<tr>
					<th><strong>Country Code</strong></th>
					<td>' . get_post_meta($location_pID, 'birdeye_countryCode', true) . '</td>
				</tr>
				<tr>
					<th><strong>Full Address</strong></th>
					<td>' . get_post_meta($location_pID, 'birdeye_full_address', true) . '</td>
				</tr>
				<tr>
					<th><strong>Google URL</strong></th>
					<td><a href="' . get_post_meta($location_pID, 'birdeye_googleUrl', true) . '" target="_blank">View</a></td>
				</tr>
			</tbody>
		</table>';
	wp_send_json_success( array( 'result' => $update_loc ) );
}
add_action( 'wp_ajax_fetch_single_loc', 'fetch_single_location' );

function get_location_data(){
	$pID         = $_POST['post_id'];
	$key         = $_POST['key'];
	$phone          = ( get_post_meta( $pID, $key, true ) ) ? get_post_meta( $pID, $key, true ) : null;
	echo $phone;
	wp_die();
}
add_action( 'wp_ajax_nopriv_get_location_data', 'get_location_data' );
add_action( 'wp_ajax_get_location_data', 'get_location_data' );


add_action( 'wp_ajax_alrv_closure_filter', 'alrv_closure_filter' );
add_action( 'wp_ajax_nopriv_alrv_closure_filter', 'alrv_closure_filter' );
function alrv_closure_filter() {
    $page  = intval( $_POST['page'] ?? 1 );
    $date_raw  = sanitize_text_field( $_POST['date'] ?? '' );
    $state = sanitize_text_field( $_POST['state'] ?? '' );
    $city  = sanitize_text_field( $_POST['city'] ?? '' );

    $dateList = get_transient( 'closure_date_list' );
    if ( ! $dateList ) {
        wp_send_json_error( 'No data available' );
    }

    $filtered = $dateList;

    /* ---------- DATE ---------- */
    // if ( $date_raw ) {
	// 	$date = date('m-d-Y', strtotime($date_raw));
    //     $filtered = array_filter( $filtered, fn( $i ) => $i['date'] === $date );
    // }
	if ($date_raw) {
		$dt = DateTime::createFromFormat('m-d-Y', $date_raw);
		if ($dt) {
			$date = $dt->format('Y-m-d'); // normalized version
			$filtered = array_filter($filtered, fn($i) => $i['date'] === $date);
		}
	}

    /* ---------- STATE (slug → name) ---------- */
    $state_name = '';
    if ($state) {
        $st = get_term_by('slug', $state, 'location-state');

        if ($st) {
            $state_name = $st->name;

            $filtered_data = array_filter($filtered, function($item) use ($state_name) {
                return isset($item['loc'][$state_name]);
            });

            $filtered = array_map(function($item) use ($state_name) {
                $item['loc'] = [$state_name => $item['loc'][$state_name]];
                return $item;
            }, $filtered_data);
        }
    }
	
    /* ---------- CITY (slug → name) – SIMPLE STRING MATCH ---------- */
    $city_name = '';
    if ( $city ) {
        $ct = get_term_by( 'slug', $city, 'location-city' );
        if ( $ct ) {
            $city_name = $ct->name;                     // e.g. "Birmingham"
            $filtered  = array_filter( $filtered, function( $item ) use ( $city_name ) {
                foreach ( $item['loc'] as $state_data ) {
                    foreach ( $state_data['cl_category'] as $cat_arr ) {
                        foreach ( $cat_arr as $html ) {
                            // Simple case-insensitive contains check
                            if ( stripos( $html, $city_name ) !== false ) {
                                return true;
                            }
                        }
                    }
                }
                return false;
            } );
        }
    }

    $filtered = array_values( $filtered );
    /* ---------- PAGINATION ---------- */
    $per_page    = 3;
    $total       = count( $filtered );
    $total_pages = $total ? ceil( $total / $per_page ) : 1;
    $offset      = ( $page - 1 ) * $per_page;
    $paged_items = array_slice( $filtered, $offset, $per_page );

    ob_start();
    if ( $paged_items ) {
        foreach ( $paged_items as $cl_item ) {
            $month_dt    = $cl_item['date'];
            $location_dt = $cl_item['loc'] ?? [];

            /* ---- STATE OUTPUT FILTER ---- */
            if ( $state_name && isset( $location_dt[ $state_name ] ) ) {
                $location_dt = [ $state_name => $location_dt[ $state_name ] ];
            }

            /* ---- CITY OUTPUT FILTER – keep only the selected city ---- */
            if ( $city_name ) {
                $tmp = [];
                foreach ( $location_dt as $st_name => $st_data ) {
                    foreach ( $st_data['cl_category'] as $cat => $items ) {
                        foreach ( $items as $html ) {
                            if ( stripos( $html, $city_name ) !== false ) {
                                $tmp[ $st_name ]['cl_category'][ $cat ][] = $html;
                            }
                        }
                    }
                }
                $location_dt = $tmp;
            }

            echo '<div class="faq-row">';
            echo '<h2 class="block-title heading">' . esc_html( date_i18n( 'F j', strtotime( $month_dt ) ) ) . '</h2>';
            echo '<div class="faqs-section faq-variation"><div class="faqs-area">';

            foreach ( $location_dt as $loc_nm => $loc_dt_item ) {
                $cnt = 0;
                foreach ( ( $loc_dt_item['cl_category'] ?? [] ) as $a ) {
                    $cnt += count( $a );
                }

                echo '<div class="faq">';
                echo '<h3 class="large-text faq-title d-flex justify-content-between">'
                    . esc_html( $loc_nm ) . '<span class="faq-numbers">' . $cnt . '</span><span class="close-icon"></span></h3>';
                echo '<div class="faq-content" style="display:none;"><div class="content-list">';

                foreach ( $loc_dt_item['cl_category'] as $cat => $arr ) {
                    $title = $cat === 'shot-hours' ? 'Shot Hours:' : 'Clinic Hours:';
                    echo '<div class="content-col"><div class="list-title small-text">' . esc_html__( $title ) . '</div>';
                    echo '<div class="list-content"><ul>';
                    foreach ( $arr as $html ) {
                        echo '<li>' . wp_kses_post( $html ) . '</li>';
                    }
                    echo '</ul></div></div>';
                }

                echo '</div></div></div>';
            }
            echo '</div></div><div class="s-80"></div></div>';
        }
    }else{
		echo '<p class="cl-found">No More Closures Found.</p>';
	}
    $html = ob_get_clean();

    wp_send_json_success( [
        'html'        => $html,
        'page'        => $page,
        'total_pages' => $total_pages,
    ] );
}
