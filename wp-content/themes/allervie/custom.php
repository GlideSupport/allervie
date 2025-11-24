<?php
/**
 * Custom functions added to all projects
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Allervie
 * @since 1.0.0
 */

/**
 * Excerpt Function
 *
 * Function used to create custom excerpt.
 */
function glide_excerpt( $count ) {
	global $post;
	$permalink = get_permalink( $post->ID );
	$excerpt   = get_the_excerpt();
	$excerpt   = strip_tags( $excerpt );
	$excerpt   = substr( $excerpt, 0, $count );
	$excerpt   = substr( $excerpt, 0, strripos( $excerpt, ' ' ) );
	$excerpt   = $excerpt . ' ...';
	$excerpt   = $excerpt;
	return $excerpt;
}


/**
 * Excerpt with no read more option
 *
 * Function used to create custom excerpt.
 */
function glide_excerpt_nomore( $count ) {
	global $post;
	$permalink = get_permalink( $post->ID );
	$excerpt   = get_the_excerpt();
	$excerpt   = strip_tags( $excerpt );
	$excerpt   = substr( $excerpt, 0, $count );
	$excerpt   = substr( $excerpt, 0, strripos( $excerpt, ' ' ) );
	$excerpt   = $excerpt;
	return $excerpt;
}


/**
 * Pagination Function
 *
 * The pagination function to display pagination on any archive page
 */

function glide_pagination( $pages = '', $range = 4 ) {
	$showitems = ( $range * 2 ) + 1;
	global $paged;
   if ( empty( $paged ) ) {
	   $paged = 1;
   }
   if ( $pages == '' ) {
	   global $wp_query;
	   $pages = $wp_query->max_num_pages;
	   if ( ! $pages ) {
		   $pages = 1;
	   }
   }

   if ( 1 != $pages && $pages != 0) {
	   $buffer = array();
	  echo '<div class="pagination">';

	  echo "<a href='".get_pagenum_link($paged-1)."'' data-page='" . ( $paged - 1 ) . "' aria-label='pagination'><img src='" . get_template_directory_uri() . "/assets/img/pagination-left-arrow.svg' alt='pagination-left-arrow' /></a>";
	   if ( $paged >= 1 ) {
		   // echo "<a href='".get_pagenum_link($paged - 1)."'>&lsaquo; </a>";
		   if ( $pages >= 2 ) {
			   $n = 2;
		   } else {
				 $n = $pages;
		   }
	   }
	   $pageArr = array();
	   for ( $x = $paged;$x <= $pages;$x++ ) {
		   $pageArr[] = $x;
	   }
	   foreach ( array_merge( range( 0, $n - 1 ) ) as $idx ) {
		   if ( empty( $pageArr[ $idx ] ) ) {
			   continue;
		   }
		   if ( $pageArr[ $idx ] == $pages ) {
			   $buffer[] = $pageArr[ $idx ];
		   }
		   if($pageArr[ $idx ]==$paged){
				$current='class="current"';
				echo "<span ".$current."  data-page='" . $pageArr[ $idx ] . "''> $pageArr[$idx] </span>";
			}else{
			   $current='';
			   echo "<a href='".get_pagenum_link($pageArr[ $idx ])."' ".$current." data-page='" . $pageArr[ $idx ] . "''> $pageArr[$idx] </a>";
		   }

		   if ( $idx == $n - 1 && $pageArr[ $idx ] != null ) {

			   if ( in_array( $pageArr[ $idx ], $buffer ) ) {
				   echo '';
			   } else {
				   echo "<div class='pagination-dots'>...</div>";
			   }
		   }

			  $buffer[] = $pageArr[ $idx ];

	   }

		$pageArr_2 = array();
	   if ( $pages >= 2 ) {
		   for ( $y = $pages - 2;$y <= $pages;$y++ ) {
			   $pageArr_2[] = $y;
		   }
		   foreach ( array_merge( range( $n - 1, $n ) ) as $idx ) {
			   if ( in_array( $pageArr_2[ $idx ], $buffer ) ) {
				  echo '';
			   } else {
				   if ( $pageArr_2[ $idx ] > $paged ) {
					  echo "<a href='".get_pagenum_link($pageArr_2[ $idx ])."'' data-page='" . $pageArr_2[ $idx ] . "' > $pageArr_2[$idx] </a>";
				   }
			   }
		   }
	   }
	   if ( $paged < $pages ) {
		   // echo "<a href=\"".get_pagenum_link($paged + 1)."\" aria-label='pagination'>&rsaquo;</a>";
		  echo "<a href='".get_pagenum_link($paged+1)."'' data-page='" . ( $paged + 1 ) . "'  aria-label='pagination'><img src='" . get_template_directory_uri() . "/assets/img/pagination-right-arrow.svg' alt='pagination-right-arrow' /></a>";
	   }
		echo "<div class='clear'></div></div>\n";
   }
}



function glide_pagination_location_ajax( $pages = '', $items = null, $range = 4 ) {
	$html     = '';
	$type= ( isset( $items[0]->value ) ) ? $items[0]->value: null;
	$state= ( isset( $items[1]->value ) ) ? $items[1]->value: null;
	$brand= ( isset( $items[2]->value ) ) ? $items[2]->value: null;
	$provider= ( isset( $items[3]->value ) ) ? $items[3]->value: null;
	$showitems = ( $range * 2 ) + 1;
	global $paged;
   if ( empty( $paged ) ) {
	   $paged = 1;
   }
   if ( $pages == '' ) {
	   global $wp_query;
	   $pages = $wp_query->max_num_pages;
	   if ( ! $pages ) {
		   $pages = 1;
	   }
   }

   if ( 1 != $pages ) {
	   $buffer = array();
	   $html  .= '<div class="pagination">';

	   $html .= "<a href='javascript:void(0)' data-type='" . $type . "' data-state='" . $state . "' data-brand='" . $brand . "' data-provider='" . $provider . "'  data-page='" . ( $paged - 1 ) . "' class='ajax-location-pagination' aria-label='pagination'><img src='" . get_template_directory_uri() . "/assets/img/pagination-left-arrow.svg' alt='pagination-left-arrow' /></a>";
	   if ( $paged >= 1 ) {
		   // echo "<a href='".get_pagenum_link($paged - 1)."'>&lsaquo; </a>";
		   if ( $pages >= 2 ) {
			   $n = 2;
		   } else {
				 $n = $pages;
		   }
	   }
	   $pageArr = array();
	   for ( $x = $paged;$x <= $pages;$x++ ) {
		   $pageArr[] = $x;
	   }
	   foreach ( array_merge( range( 0, $n - 1 ) ) as $idx ) {
		   if ( empty( $pageArr[ $idx ] ) ) {
			   continue;
		   }
		   if ( $pageArr[ $idx ] == $pages ) {
			   $buffer[] = $pageArr[ $idx ];
		   }
		   if($pageArr[ $idx ]==$paged){
				$current='class="current"';
				$html .= "<span ".$current." data-type='" . $type . "' data-state='" . $state . "' data-brand='" . $brand . "' data-provider='" . $provider . "' data-page='" . $pageArr[ $idx ] . "' class='ajax-location-pagination'> $pageArr[$idx] </span>";
			}else{
			   $current='';
			   $html .= "<a href='javascript:void(0)' ".$current." data-type='" . $type . "' data-state='" . $state . "' data-brand='" . $brand . "' data-provider='" . $provider . "' data-page='" . $pageArr[ $idx ] . "' class='ajax-location-pagination'> $pageArr[$idx] </a>";
		   }

		   if ( $idx == $n - 1 && $pageArr[ $idx ] != null ) {

			   if ( in_array( $pageArr[ $idx ], $buffer ) ) {
				   $html .= '';
			   } else {
				   $html .= "<div class='pagination-dots'>...</div>";
			   }
		   }

			  $buffer[] = $pageArr[ $idx ];

	   }

		$pageArr_2 = array();
	   if ( $pages >= 2 ) {
		   for ( $y = $pages - 2;$y <= $pages;$y++ ) {
			   $pageArr_2[] = $y;
		   }
		   foreach ( array_merge( range( $n - 1, $n ) ) as $idx ) {
			   if ( in_array( $pageArr_2[ $idx ], $buffer ) ) {
				   $html .= '';
			   } else {
				   if ( $pageArr_2[ $idx ] > $paged ) {
					   $html .= "<a href='javascript:void(0)' data-type='" . $type . "' data-state='" . $state . "' data-brand='" . $brand . "' data-provider='" . $provider . "' data-page='" . $pageArr_2[ $idx ] . "' class='ajax-location-pagination' > $pageArr_2[$idx] </a>";
				   }
			   }
		   }
	   }
	   if ( $paged < $pages ) {
		   // echo "<a href=\"".get_pagenum_link($paged + 1)."\" aria-label='pagination'>&rsaquo;</a>";
		   $html .= "<a href='javascript:void(0)' data-type='" . $type . "' data-state='" . $state . "' data-brand='" . $brand . "' data-provider='" . $provider . "' data-page='" . ( $paged + 1 ) . "' class='ajax-location-pagination'  aria-label='pagination'><img src='" . get_template_directory_uri() . "/assets/img/pagination-right-arrow.svg' alt='pagination-right-arrow' /></a>";
	   }
		$html .= "<div class='clear'></div></div>\n";
   }
	return $html;
}






// function glide_pagination( $pages = '', $range = 4 ) {
// $showitems = $range;

// global $paged;
// if ( empty( $paged ) ) {
// $paged = 1;
// }

// if ( $pages == '' ) {
// global $wp_query;
// $pages = $wp_query->max_num_pages;
// if ( ! $pages ) {
// $pages = 1;
// }
// }

// if ( 1 != $pages ) {
// echo '<div class="pagination">';
// if ( $paged > 2 && $paged > $range + 1 && $showitems < $pages ) {
// echo "<a href='" . get_pagenum_link( 1 ) . "'>&laquo; First</a>";
// }
// if ( $paged > 1 && $showitems < $pages ) {
// echo "<a href='" . get_pagenum_link( $paged - 1 ) . "'>&lsaquo; Previous</a>";
// }

// for ( $i = 1; $i <= $pages; $i++ ) {
// if ( 1 != $pages && ( ! ( $i >= $paged + $range + 1 || $i <= $paged - $range - 1 ) || $pages <= $showitems ) ) {
// echo ( $paged == $i ) ? '<span class="current">' . $i . '</span>' : "<a href='" . get_pagenum_link( $i ) . "' class=\"inactive\">" . $i . '</a>';
// }
// }

// if ( $paged < $pages && $showitems < $pages ) {
// echo "<a href='" . get_pagenum_link( $paged + 1 ) . "' class='page-next'></a>";
// }
// if ( $paged < $pages - 1 && $paged + $range - 1 < $pages && $showitems < $pages ) {
// echo "<a href='" . get_pagenum_link( $pages ) . "' class='page-last'></a>";
// }
// echo "<div class='clear'></div></div>\n";
// }
// }


/**
 * Allow SVG files upload in WordPress Media panel - Default restricted
 */
function glide_svg_upload_support( $mimes ) {
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
}

add_filter( 'upload_mimes', 'glide_svg_upload_support' );


/**
 * Remove default WordPress login logo link & set it to homepage of site
 */
function glide_login_logo_url( $url ) {
	return '"' . home_url() . '"';
}

add_filter( 'login_headerurl', 'glide_login_logo_url' );
add_action( 'pre_get_posts', function( $query ) {
    if ( is_tax( 'conditions' ) || is_tax( 'services' ) ) {
        $query->set( 'order', 'ASC' );
		$query->set( 'orderby', 'title' );
    }
});

/**
 * Add viewport meta tag in head
 */
function glide_viewport() {
	echo '
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	';
}

add_action( 'wp_head', 'glide_viewport' );


/**
 * Gravity forms filters
 */
add_filter( 'gform_confirmation_anchor', '__return_true' );
add_filter( 'gform_init_scripts_footer', '__return_true' );

// Set Tabindex For Gravity Form
add_filter( 'gform_tabindex', 'change_tabindex', 10, 2 );
function change_tabindex( $tabindex, $form ) {
	return 10;
}

/**
 * First and last menu item classes
 */
function glide_first_last_menu_classes( $items ) {
	if ( $items ) {
		$items[1]->classes[]                 = 'first-menu-item';
		$items[ count( $items ) ]->classes[] = 'last-menu-item';
		return $items;
	}
	return $items;
}
add_filter( 'wp_nav_menu_objects', 'glide_first_last_menu_classes' );

/**
 * Gravity Forms
 *
 * Disable the tab-index
 */

add_filter(
	'gform_tabindex',
	function() {
		return false;
	}
);



/**
 * Set favicon of dashboard
 */

function glide_theme_favicon() {
	 $favicon_path = get_template_directory_uri() . '/assets/img/pwa/favicon.ico';

	 echo '<link rel="shortcut icon" href="' . esc_url( $favicon_path ) . '" />';
}

add_action( 'admin_head', 'glide_theme_favicon' );


/**
 * Function to remove the starting words from the_archive_title()
 *
 * E.g. from Category : Dallas Neighborhoods => Dallas Neighborhoods
 */

function glide_theme_archive_title( $title ) {
	if ( is_category() ) {
		$title = single_cat_title( '', false );
	} elseif ( is_tag() ) {
		$title = single_tag_title( '', false );
	} elseif ( is_author() ) {
		$title = get_the_author_meta( 'display_name' );
	} elseif ( is_post_type_archive() ) {
		$title = post_type_archive_title( '', false );
	} elseif ( is_tax() ) {
		$title = single_term_title( '', false );
	}

	 return $title;
}

add_filter( 'get_the_archive_title', 'glide_theme_archive_title' );



/**
 * Custom logo for WordPress login screen
 *
 * This function replaces the default WordPress logo on the login with website logo.
 */
function glide_login_logo() {
	 echo '
		<style type="text/css">
			.login h1 a {
				background-image: url(' . get_stylesheet_directory_uri() . '/assets/img/site-logo.svg) !important;
				background-position: center center;
				color:rgba(0, 0, 0, 0);
				background-size: contain;
				height: 80px;
				width: 80%;
				outline: 0;
			}
		</style>
	';
}
add_action('login_head','glide_login_logo');

// removing parmalink from team cpt
add_action( 'admin_head', 'wpds_custom_admin_post_css' );
function wpds_custom_admin_post_css() {

	 global $post_type;

	if ( $post_type == 'team' ) {
		echo '<style>#edit-slug-box {display:none;}</style>';
	}
}
function load_template_part( $template_name, $part_name = null ,$args=null) {
	 ob_start();
	 get_template_part( $template_name, $part_name,$args );
	 $var = ob_get_contents();
	 ob_end_clean();
	 return $var;
}

function date_formatting( $start_date, $end_date ) {
	$final_date = '';
	if ( $start_date == '' ) {
		return;
	}
	if ( $end_date == '' ) {
		return;
	}
	$start_date = explode( ' ', date( 'F j Y', strtotime( $start_date ) ) );
	$end_date   = explode( ' ', date( 'F j Y', strtotime( $end_date ) ) );

	if ( $start_date[2] == $end_date[2] ) {
		if ( $start_date[0] == $end_date[0] ) {
			$final_date .= $start_date[0];
			if ( $start_date[1] == $end_date[1] ) {
				$final_date .= ' ' . $start_date[1];
			} else {
				$final_date .= ' ' . $start_date[1] . '-' . $end_date[1];
			}
			if ( $start_date[2] == $end_date[2] ) {
				$final_date .= ', ' . $start_date[2];
			}
		} else {
			if ( $start_date[1] == $end_date[1] ) {
				$final_date .= ' ' . $start_date[0] . '-' . $end_date[0] . ' ' . $start_date[1];
			} else {
				$final_date .= ' ' . $start_date[0] . ' ' . $start_date[1] . '-' . $end_date[0] . ' ' . $end_date[1];
			}
			if ( $start_date[2] == $end_date[2] ) {
				$final_date .= ', ' . $start_date[2];
			}
		}
	} else {
		$final_date .= implode( ' ', $start_date ) . ', ' . implode( ' ', $end_date );
	}
	return $final_date;
}


function save_topic_as_meta($post_id){
	if(get_post_type($post_id)=='location'){
		$term = get_the_terms( $post_id, 'location-state' )[0];
		$term1 = get_the_terms( $post_id, 'location-brand' )[0];
		update_post_meta($post_id,'meta_location_state',$term->slug);
		update_post_meta($post_id,'meta_location_brand',$term1->slug);
	}elseif(get_post_type($post_id)=='provider'){
		$lastname='';
		$title=explode(' ',explode(',',get_the_title($post_id))[0]);
		$key=count($title)-1;
		$lastname=$title[$key];
		update_post_meta($post_id,'alrv_spo_lastname',$lastname);
	}
}
add_action('post_updated','save_topic_as_meta');
// var_dump(get_post_meta(2099, 'meta_location_state')	);
add_filter( 'gform_pre_render', 'populate_location_and_provider' );
add_filter( 'gform_pre_validation', 'populate_location_and_provider' );
add_filter( 'gform_pre_submission_filter', 'populate_location_and_provider' );
add_filter( 'gform_admin_pre_render', 'populate_location_and_provider' );
function populate_location_and_provider( $form ) {
    foreach ( $form['fields'] as &$field ) {
		$cssClass=explode(' ', $field->cssClass);
        if ( $field->type == 'select' && ( in_array('populate-location',$cssClass) || in_array('next-page-location',$cssClass) ) ) {
			$args = array(
				'post_type'      => array( 'location' ),
				'post_status'    => array( 'publish' ),
				'posts_per_page' => -1,
				'meta_key'  => 'meta_location_state',
				'orderby'  => 'meta_value',
				'order'     => 'ASC',
				'meta_query' => array(
					array(
						'key' => 'make_an_appointment_button',
						'value' => 'disable',
						'compare' => '!=',
					),
				),
 			);
			// var_dump($args);
			$query = new WP_Query( $args );
			// $dataAttrsField=$field->dataAttrsField
			$choices = array();
			$attributes = array();

			if ( $query->have_posts() ) {
				while ( $query->have_posts() ) {
					$query->the_post();
					$pID=get_the_ID();
					$post_title=get_the_title($pID);
					$state = get_the_terms( $pID, 'location-state' );
					$city = get_the_terms( $pID, 'location-city' );
					$alrv_loc_state_short_name='';
					if(isset($state[0])){
						$state=$state[0];
						$alrv_loc_state_short_name=(get_field('alrv_loc_state_short_name', $state)) ? get_field('alrv_loc_state_short_name', $state) : null;
					}
					if(isset($city[0])){
						$city=$city[0];
					}
					if($city){
						if($alrv_loc_state_short_name || $city->name){
							$post_title=$alrv_loc_state_short_name . '-' .$city->name;
						}
					}
					$post_fields = get_fields( $pID );
					$alrv_slo_external_btn = (isset($post_fields['alrv_slo_external_btn'])) ? $post_fields['alrv_slo_external_btn'] : null;
					$alrv_slo_tracking_code = (isset($post_fields['alrv_slo_tracking_code'])) ? $post_fields['alrv_slo_tracking_code'] : null;
					$choices[] = array( 'text' => $post_title, 'value' => $post_title,'attributes' => array( 'data-id' => $pID,'data-button' => $alrv_slo_external_btn,'data-tracking-code' => $alrv_slo_tracking_code ) );
				}
			}

			// update 'Select a Post' to whatever you'd like the instructive option to be
			$field->placeholder = 'Select a Location';
			$field->choices = $choices;
        }elseif ( $field->type == 'select' && in_array('populate-provider',$cssClass) ) {
			$args = array(
				'post_type'      => array( 'provider' ),
				'post_status'    => array( 'publish' ),
				'posts_per_page' => -1,
			);
			// var_dump($args);
			$query = new WP_Query( $args );

			$choices = array();

			if ( $query->have_posts() ) {
				while ( $query->have_posts() ) {
					$query->the_post();
					$pID=get_the_ID();
					$post_title=get_the_title($pID);
					$post_fields = get_fields( $pID );
					$choices[] = array( 'text' => $post_title, 'value' => $post_title,'attributes' => array( 'data-id' => $pID ) );
				}
			}
			// update 'Select a Post' to whatever you'd like the instructive option to be
			$field['title']=$post_title;
			$field->placeholder = 'Select a Provider';
			$field->choices = $choices;

		}elseif ( $field->type == 'select' &&  in_array('populate-state',$cssClass)  ) {
			$state=get_terms(array(
				'taxonomy'=>'location-state',
			));
			$choices = array();
			foreach ($state as $state) {
					$choices[] = array( 'text' => $state->name, 'value' => $state->name,'attributes' => array( 'data-id' => $state->term_id ));
			}
			// update 'Select a Post' to whatever you'd like the instructive option to be
			$field->placeholder = 'Select a State';
			$field->choices = $choices;
		}else{
			continue;
		}
    }

    return $form;
}
add_filter( 'gform_field_value_app-location', 'cpt_population_function2' );
function cpt_population_function2( $value ) {
	if($value){
		$post_title=get_the_title($value);
		$state = get_the_terms( $value, 'location-state' );
		$city = get_the_terms( $value, 'location-city' );
		$alrv_loc_state_short_name='';
		if(isset($state[0])){
			$state=$state[0];
			$alrv_loc_state_short_name=(get_field('alrv_loc_state_short_name', $state)) ? get_field('alrv_loc_state_short_name', $state) : null;
		}
		if(isset($city[0])){
			$city=$city[0];
		}
		if($city){
			if($alrv_loc_state_short_name || $city->name){
				$post_title=$alrv_loc_state_short_name . '-' .$city->name;
			}
		}
		$value=$post_title;
	}
    return $value;
}
add_filter( 'gform_field_value_app-provider', 'cpt_population_function' );
function cpt_population_function( $value ) {
	if($value){
		$value=get_the_title($value);
	}
    return $value;
}
add_filter( 'gform_field_value_app-state', 'term_population_function' );
function term_population_function( $value ) {
	$term = get_term_by('id', $value, 'location-state');
	if($term){
		$value=$term->name;
	}
    return $value;
}


add_filter('gform_field_choice_markup_pre_render', function ($choice_markup, $choice, $field, $value) {
    // Bail if: in the admin or no data attributes
	if($field->type=='select'){
		$cssClass=explode(' ', $field->cssClass);

		if(in_array('populate-location',$cssClass)){
			$attrs=$choice['attributes'];
			$attrHtml='';
			foreach ($attrs as $attr => $value) {
				if($attr=='data-button'){
					if($value){
						$attrHtml .= " {$attr}='{$value['url']}'";
						$attrHtml .= " {$attr}-title='{$value['title']}'";
					}else{
						$attrHtml .= " {$attr}=''";
					}
				}else{
					$attrHtml .= " {$attr}='{$value}'";
				}
			}
			$choice_markup = str_replace('<option ', "<option $attrHtml", $choice_markup);
		}else{
			$attrs=(isset($choice['attributes']))? $choice['attributes'] :null;
			$attrHtml='';
			//  dump($attrs);
			if($attrs){
				foreach ($attrs as $attr => $value) {
					if(!is_array($value)){
						$attrHtml .= " {$attr}='{$value}'";
					}
				}
				$choice_markup = str_replace('<option ', "<option $attrHtml", $choice_markup);
			}
		}
	}

    return $choice_markup;
}, 10, 4);


function get_provider_location($provider_id,$type='string'){
	$args = array(
		'post_type'      => array( 'location' ),
		'posts_per_page' => -1,
	);
	// var_dump($args);
	$query = new WP_Query( $args );

	$locations=array();
	$loc=array();
	if ( $query->have_posts() ) {
		while ( $query->have_posts() ) {
			$query->the_post();
			$pID=get_the_ID();
			$post_title=get_the_title($pID);
			$post_fields = get_fields( $pID );
			$alrv_slo_providers_on_location=(isset($post_fields['alrv_slo_providers_on_location'])) ? $post_fields['alrv_slo_providers_on_location'] : null ;
			if($alrv_slo_providers_on_location){
				if(in_array($provider_id,$alrv_slo_providers_on_location)){
					$arr['location_id']=$pID;
					$arr['provider_ids']=$alrv_slo_providers_on_location;
					$locations[]=$arr;
				}
			}
		}
	}
	wp_reset_postdata();
	wp_reset_query();
	if($type=='post'){
		return $locations;
	}else{

			// var_dump($locations);
			$buffer=array();
			foreach ($locations as $key => $location) {
			if(isset(get_the_terms( $location['location_id'], 'location-city' )[0])){
				$city = get_the_terms( $location['location_id'], 'location-city' )[0];
				if(!in_array($city->name,$buffer)){
					if($type=='string'){
						$loc[]=$city->name;
					}elseif($type=='array'){
						$arr['name']=$city->name;
						$arr['term_id']=$city->term_id;
						$loc[]=$arr;
					}
				}
				$buffer[]=$city->name;
			}
		}

		if($type=='string'){
			return implode(', ',$loc);
		}elseif($type=='array'){
			return $loc;
		}
	}
}
function get_provider_by_city($city){
	$args = array(
		'post_type'      => array( 'location' ),
		'posts_per_page' => -1,
	);
	// var_dump($args);
	$query = new WP_Query( $args );

	$locations=array();
	$loc=array();
	if ( $query->have_posts() ) {
		while ( $query->have_posts() ) {
			$query->the_post();
			$pID=get_the_ID();
			$post_title=get_the_title($pID);
			$post_fields = get_fields( $pID );
			$alrv_slo_providers_on_location=(isset($post_fields['alrv_slo_providers_on_location'])) ? $post_fields['alrv_slo_providers_on_location'] : null ;
			if($alrv_slo_providers_on_location){
				$arr['location_id']=$pID;
				$arr['provider_ids']=$alrv_slo_providers_on_location;
				$locations[]=$arr;
			}
		}
	}
	wp_reset_postdata();
	wp_reset_query();
	// var_dump($locations);
	foreach ($locations as $key => $location) {
		if(isset(get_the_terms( $location['location_id'], 'location-city' )[0])){
			$city_term = get_the_terms( $location['location_id'], 'location-city' )[0];
			if($city==$city_term->term_id){
				$loc[]=$location['provider_ids'];
			}
		}
	}
	return array_flatten($loc);
}
function array_flatten($array) {
  if (!is_array($array)) {
    return false;
  }
  $result = array();
  foreach ($array as $key => $value) {
    if (is_array($value)) {
      $result = array_merge($result, array_flatten($value));
    } else {
      $result = array_merge($result, array($key => $value));
    }
  }
  return $result;
}
function dump($item){
	echo '<pre>';
	var_dump($item);
	echo' </pre>';
}


function generate_rewrite_rules( $wp_rewrite ) {
	$new_rules = array(
		'(.?.+?)/page/?([0-9]{1,})/?$' => 'index.php?pagename=$matches[1]&paged=$matches[2]',
		'blog/([^/]+)/?$' => 'index.php?post_type=post&name=$matches[1]',
		'blog/[^/]+/attachment/([^/]+)/?$' => 'index.php?post_type=post&attachment=$matches[1]',
		'blog/[^/]+/attachment/([^/]+)/trackback/?$' => 'index.php?post_type=post&attachment=$matches[1]&tb=1',
		'blog/[^/]+/attachment/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$' => 'index.php?post_type=post&attachment=$matches[1]&feed=$matches[2]',
		'blog/[^/]+/attachment/([^/]+)/(feed|rdf|rss|rss2|atom)/?$' => 'index.php?post_type=post&attachment=$matches[1]&feed=$matches[2]',
		'blog/[^/]+/attachment/([^/]+)/comment-page-([0-9]{1,})/?$' => 'index.php?post_type=post&attachment=$matches[1]&cpage=$matches[2]',
		'blog/[^/]+/attachment/([^/]+)/embed/?$' => 'index.php?post_type=post&attachment=$matches[1]&embed=true',
		'blog/[^/]+/embed/([^/]+)/?$' => 'index.php?post_type=post&attachment=$matches[1]&embed=true',
		'blog/([^/]+)/embed/?$' => 'index.php?post_type=post&name=$matches[1]&embed=true',
		'blog/[^/]+/([^/]+)/embed/?$' => 'index.php?post_type=post&attachment=$matches[1]&embed=true',
		'blog/([^/]+)/trackback/?$' => 'index.php?post_type=post&name=$matches[1]&tb=1',
		'blog/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$' => 'index.php?post_type=post&name=$matches[1]&feed=$matches[2]',
		'blog/([^/]+)/(feed|rdf|rss|rss2|atom)/?$' => 'index.php?post_type=post&name=$matches[1]&feed=$matches[2]',
		'blog/page/([0-9]{1,})/?$' => 'index.php?post_type=post&paged=$matches[1]',
		'blog/[^/]+/page/?([0-9]{1,})/?$' => 'index.php?post_type=post&name=$matches[1]&paged=$matches[2]',
		'blog/([^/]+)/page/?([0-9]{1,})/?$' => 'index.php?post_type=post&name=$matches[1]&paged=$matches[2]',
		'blog/([^/]+)/comment-page-([0-9]{1,})/?$' => 'index.php?post_type=post&name=$matches[1]&cpage=$matches[2]',
		'blog/([^/]+)(/[0-9]+)?/?$' => 'index.php?post_type=post&name=$matches[1]&page=$matches[2]',
		'blog/[^/]+/([^/]+)/?$' => 'index.php?post_type=post&attachment=$matches[1]',
		'blog/[^/]+/([^/]+)/trackback/?$' => 'index.php?post_type=post&attachment=$matches[1]&tb=1',
		'blog/[^/]+/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$' => 'index.php?post_type=post&attachment=$matches[1]&feed=$matches[2]',
		'blog/[^/]+/([^/]+)/(feed|rdf|rss|rss2|atom)/?$' => 'index.php?post_type=post&attachment=$matches[1]&feed=$matches[2]',
		'blog/[^/]+/([^/]+)/comment-page-([0-9]{1,})/?$' => 'index.php?post_type=post&attachment=$matches[1]&cpage=$matches[2]',
	);
	$wp_rewrite->rules = $new_rules + $wp_rewrite->rules;
}
add_action( 'generate_rewrite_rules', 'generate_rewrite_rules' );

    function update_post_link( $post_link, $id = 0 ) {
      $post = get_post( $id );
      if( is_object( $post ) && $post->post_type == 'post' ) {
        return home_url( '/blog/' . $post->post_name . '/' );
      }
      return $post_link;
    }
    add_filter( 'post_link', 'update_post_link', 1, 3 );

function admin_page_birdeye() {
	add_menu_page(
		'BirdEye',
		'BirdEye',
		'manage_options',
		'birdeye-api',
		'admin_page_birdeye_response',
		'dashicons-birdeye',
		3
	);
}

add_action( 'admin_menu', 'admin_page_birdeye' );

function admin_page_birdeye_response() {
	include_once ABSPATH . '/wp-content/themes/allervie/templates/birdeye-page.php';

}
function global_notice_meta_box() {

    add_meta_box(
        'bird-eye-location-data',
        __( 'BirdEye (Location Data)', 'alrv_td' ),
        'global_notice_meta_box_callback',
        'location'
    );
}

add_action( 'add_meta_boxes', 'global_notice_meta_box' );
function global_notice_meta_box_callback(){
	$pID=get_the_ID();
	echo '<div class="data-content">
	<table class="wp-list-table widefat fixed striped table-view-list pages">
		<tbody>
			<tr>
				<th><strong>Key</strong></strong></th>
				<th><strong>Value</strong></th>
			</tr>
			<tr>
				<th><strong>Name</strong></strong></th>
				<td>'. get_post_meta($pID,'birdeye_name',true) .'</td>
			</tr>
			<tr>
				<th><strong>Alias</strong></strong></th>
				<td>'. get_post_meta($pID,'birdeye_alias',true) .'</td>
			</tr>
			<tr>
				<th><strong>Image</strong></strong></th>
				<td><img src="'. get_post_meta($pID,'birdeye_coverImageUrl',true) .'" ></td>
			</tr>
			<tr>
				<th><strong>Lnt</strong></strong></th>
				<td>'. get_post_meta($pID,'birdeye_lat',true) .'</td>
			</tr>
			<tr>
				<th><strong>Lng</strong></th>
				<td>'. get_post_meta($pID,'birdeye_lng',true) .'</td>
			</tr>
			<tr>
				<th><strong>Phone</strong></th>
				<td>'. get_post_meta($pID,'birdeye_phone',true) .'</td>
			</tr>
			<tr>
				<th><strong>Address 1</strong></th>
				<td>'. get_post_meta($pID,'birdeye_address1',true) .'</td>
			</tr>
			<tr>
				<th><strong>Address 2</strong></th>
				<td>'. get_post_meta($pID,'birdeye_address2',true) .'</td>
			</tr>
			<tr>
				<th><strong>City</strong></th>
				<td>'. get_post_meta($pID,'birdeye_city',true) .'</td>
			</tr>
			<tr>
				<th><strong>State</strong></th>
				<td>'. get_post_meta($pID,'birdeye_state',true) .'</td>
			</tr>
			<tr>
				<th><strong>Zip</strong></th>
				<td>'. get_post_meta($pID,'birdeye_zip',true) .'</td>
			</tr>
			<tr>
				<th><strong>Country Code</strong></th>
				<td>'. get_post_meta($pID,'birdeye_countryCode',true) .'</td>
			</tr>
			<tr>
				<th><strong>Full Address</strong></th>
				<td>'. get_post_meta($pID,'birdeye_full_address',true) .'</td>
			</tr>
			<tr>
				<th><strong>Google url</strong></th>
				<td><a href="'. get_post_meta($pID,'birdeye_googleUrl',true) .'" target="_blank">View</a></td>
			</tr>
		</tbody>
	</table></div>';
}


function get_clinical_providers($provider_id=null){
	$args = array(
		'post_type'      => array( 'location' ),
		'posts_per_page' => -1,
		'tax_query'		 => array(
			array(
				'taxonomy' => 'location-type',
				'field'    => 'slug',
				'terms'    => array('clinical-research'),
			)
		)

	);
	$query = new WP_Query( $args );
	// The Loop
	$providers=array();
	if ( $query->have_posts() ) {
		while ( $query->have_posts() ) {
			$query->the_post();
			$pID=get_the_ID();
			$post_fields = get_fields( $pID );
			$alrv_slo_providers_on_location = ( isset( $post_fields['alrv_slo_providers_on_location'] ) ) ? $post_fields['alrv_slo_providers_on_location'] : null;
			if($alrv_slo_providers_on_location){
				$providers[]=$alrv_slo_providers_on_location;
			}

		}
	}
	wp_reset_postdata();
	wp_reset_query();
	$providers=array_flatten($providers);
	if($provider_id){
		if(in_array($provider_id,$providers)){
			return $provider_id;
		}else{
			return false;
		}
	}
	return $providers;
}





//location sub functions
function create_items_from_get($GET){
	$items=array();
	foreach($GET as $type => $value){
		if($type=='current-page'){
			continue;
		}
		$item['title']='';
		$item['value']=$value;
		$item['type']=$type;

		$items[]=$item;
	}

	return $items;
}
function get_all_location_pins($type=null,$tax_query=null,$meta_query=null,$alat='33.0237769',$alng='-96.7963909',$res_zip=''){
	$count     = 0;
	$arrZips   = array();
	$results    = array();
	$location_state_html      = '';
	$location_state_buffer    = array();
	$location_brand_html      = '';
	$location_brand_buffer    = array();
	$location_provider_html   = '';
	$location_provider_buffer = array();

	
	if (is_page('locations') ){
		$marker_pin = get_template_directory_uri() . '/assets/img/pin.svg';
		$marker_pin_active = get_template_directory_uri() . '/assets/img/pin-active.svg';
	}
	else{
		$marker_pin = get_template_directory_uri() . '/assets/img/pin-blue.png';
		$marker_pin_active = get_template_directory_uri() . '/assets/img/pin-green.png';
	}
	
	$args  = array(
		'post_type'      => array( 'location' ),
		'post_status'    => array( 'publish' ),
		'posts_per_page' => -1,
		'tax_query'      => $tax_query,
		'meta_query'     => $meta_query,
	);
	$query = new WP_Query( $args );
	if ( $query->have_posts() ) {
		while ( $query->have_posts() ) {
			$query->the_post();
			$pID           = get_the_ID();
			$post_fields  = get_fields( $pID );
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
			$location_state                 = get_the_terms( $pID, 'location-state' );
			$location_brand                 = get_the_terms( $pID, 'location-brand' );
			$alrv_slo_providers_on_location = ( isset( $post_fields['alrv_slo_providers_on_location'] ) ) ? $post_fields['alrv_slo_providers_on_location'] : null;
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
			$results[ $count ]['location_id']   = $pID;
			$results[ $count ]['title']         = get_the_title( $pID );
			$results[ $count ]['lat']           = $lat;
			$results[ $count ]['long']          = $lng;
			$results[ $count ]['phone_numbers'] = $phone;
			$results[ $count ]['address']       = $address;
			$results[ $count ]['URL']           = esc_url( get_permalink( $pID ) );
			$results[ $count ]['fax']           = $alrv_slo_fax;
			$results[ $count ]['clinical']      = $clinical;
			$results[ $count ]['googleUrl']      = $googleUrl;
			$arrZips[]                          = array(
				'label' => $zip,
				'value' => $zip,
			);
			$count++;
		}
	}
	// var_dump($arrZips);
	wp_reset_postdata();
	wp_reset_query();
	if($type!=-1){
		wp_localize_script(
			'locations-scripts',
			'locationVars',
			array(
				'ajaxurl'           => admin_url( 'admin-ajax.php' ),
				'alat'              => $alat,
				'alng'              => $alng,
				'zipcodeParam'      => $res_zip,
				'stateParam'        => '',
				'zipcodes'          => $arrZips,
				'markerImage'       => $marker_pin,
				'markerActiveImage' => $marker_pin_active,
				'results'           => $results,
				'is_singular'       => 'no',
				'is_tooltip'		=> 'yes',
				'assets_url'        => esc_url( get_template_directory_uri() ),
			)
		);

		wp_enqueue_script( 'jquery-ui-autocomplete' );

		wp_enqueue_script( 'locations-scripts' );
		wp_enqueue_script( 'googleapis' );
	}else{
		return array(
			'arrZips' => $arrZips,
			'results' => $results,
			'location_state_html' => $location_state_html,
			'location_brand_html' => $location_brand_html,
			'location_provider_html' => $location_provider_html,
		);
	}
}
function get_all_location_filters($pID=null,$exclude_data=null,$GET=null){
	$fields 					 = get_fields_escaped($pID);
	$alrv_posttitle      		 = glide_page_title( 'alrv_tlo_title' );
	$alrv_posttitle_hidden  	 = $alrv_posttitle;
	$alrv_tlo_intro_text 		 = $fields['alrv_tlo_intro_text'];
	$alrv_tlo_intro_text_hidden  = $alrv_tlo_intro_text;
	$current_location 	 		 = isset($_GET['location-state']) ? $_GET['location-state'] : '';
	$location_obj 				 = ($current_location != '') ? get_term_by( 'slug', $current_location, 'location-state' ) : '';
	$location_name 				 = (!empty($location_obj)) ? $location_obj->name : '';
	$alrv_posttitle 	 		 = ($location_name != '') ? str_replace( 'Allervie Locations', 'Allervie Locations in '.$location_name, $alrv_posttitle ) : $alrv_posttitle;
	$alrv_tlo_intro_text 		 = ($location_name != '') ? str_replace( 'the country', $location_name, $alrv_tlo_intro_text) : $alrv_tlo_intro_text;
	
	// Get all taxonomy values.
	$location_types = get_terms(
		array(
			'taxonomy'   => 'location-type',
			'hide_empty' => false,
		)
	);

	$location_states = get_terms(
		array(
			'taxonomy'   => 'location-state',
			'hide_empty' => false,
		)
	);


	$location_brands = get_terms(
		array(
			'taxonomy'   => 'location-brand',
			'hide_empty' => false,
		)
	);

	$all_providers_query       = array(
		'post_type'      => 'provider',
		'posts_per_page' => -1,
		'orderby'        => 'title',
		'order'          => 'ASC',
	);
	$all_providers_posts       = array();
	$all_providers_posts_query = new WP_Query( $all_providers_query );
	if ( $all_providers_posts_query->have_posts() ) {
		while ( $all_providers_posts_query->have_posts() ) {
			$all_providers_posts_query->the_post();
			$data                  = array();
			$data['post_id']       = get_the_ID();
			$data['post_title']    = get_the_title( get_the_ID() );
			$all_providers_posts[] = $data;
		}
	}
	wp_reset_postdata();
	wp_reset_query();
	?>
		<div class="location-filter">
			<div class="banner-text center-align">
				<h1 id="allervie-location-heading"><?php echo $alrv_posttitle; ?></h1>
				<input type="hidden" value="<?php echo $alrv_posttitle_hidden; ?>" id="location-heading-txt-hidden">
				<?php if ( $alrv_tlo_intro_text ) { ?>
				<p id="allervie-location-intro-txt"><?php echo $alrv_tlo_intro_text; ?></p>
				<?php } ?>
				<input type="hidden" value="<?php echo $alrv_tlo_intro_text_hidden; ?>" id="location-intro-txt-hidden">
			</div>
			<div class="s-40"></div>
			<div class="location-filter d-flex justify-content-between flex-wrap">
				<?php if ( $location_types ) { ?>
				<select name="location-type" id="location-type" class="loc-filter">
					<option value="*"> Select Type</option>
					<?php foreach ( $location_types as $type ) {	?>
					<option <?php if(isset($GET['location-type'])){ if($GET['location-type']==$type->slug){ echo 'selected'; } } ?> value="<?php echo $type->slug; ?>"> <?php echo $type->name; ?> </option>
					<?php } ?>
				</select>
				<?php } ?>
				<?php if ( $location_states ) { ?>
				<select name="location-state" id="location-state" class="loc-filter">
					<option value="*"> State</option>
					<?php foreach ( $location_states as $state ) {
						if(!in_array($state->term_id,$exclude_data['location-states'])){
							continue;
						}
						?>
					<option <?php if(isset($GET['location-state'])){ if($GET['location-state']==$state->slug){ echo 'selected'; } } ?> value="<?php echo $state->slug; ?>"> <?php echo $state->name; ?> </option>
					<?php } ?>
				</select>
				<?php } ?>
				<?php if ( $location_brands ) { ?>
				<select name="location-brand" id="location-brand" class="loc-filter">
					<option value="*"> Brands </option>
					<?php foreach ( $location_brands as $brand ) {
						if(!in_array($brand->term_id,$exclude_data['location-brands'])){
							continue;
						}
						?>
					<option <?php if(isset($GET['location-brand'])){ if($GET['location-brand']==$brand->slug){ echo 'selected'; } } ?> value="<?php echo $brand->slug; ?>"> <?php echo $brand->name; ?> </option>
					<?php } ?>
				</select>
				<?php } ?>
				<?php if ( $all_providers_posts ) { ?>
				<select name="provider" id="location-provider" class="loc-filter">
					<option value="*"> Providers </option>
					<?php foreach ( $all_providers_posts as $post ) {
						if(!in_array($post['post_id'],$exclude_data['location-providers'])){
							continue;
						}
						?>
					<option <?php if(isset($GET['location-provider'])){ if($GET['location-provider']==$post['post_id']){ echo 'selected'; } } ?> value="<?php echo $post['post_id']; ?>"> <?php echo $post['post_title']; ?> </option>
					<?php } ?>
				</select>
				<?php } ?>

				<button type="button" id="clear-all" class="button clear-all-btn"><?php _e( 'Clear All', 'alrv_td' ); ?></button>
			</div>
		</div>
		<div class="s-40"></div>
	<?php
}
function get_query_args($items=null){
	$arrZips=get_all_location_pins('-1')['arrZips'];
	$global_state='';
	if ( $items ) {
	foreach ( $items as $key => $item ) {
		if ( $item['value'] == '*' || $item['value'] == '' ) {
			continue;
		}
		if ( $item['type'] == 'location-provider' ) {
			$arr          = array(
				'key'     => 'alrv_slo_providers_on_location',
				'value'   => intval( $item['value'] ),
				'compare' => 'LIKE',
			);
			$meta_query[] = $arr;
		} elseif ( $item['type'] == 'zipcodes' ) {
			if(isset($_POST['zipcodes'])){
				$zipcodes=$_POST['zipcodes'];
			}else{
				$zipcodes=$arrZips;
			}
			if (  ! in_array( $item['value'], $zipcodes ) ) {
				$zcode=$item['value'];
				if (is_numeric($zcode)) {
					$curl = curl_init();
					// 45230 45201 45205 90011

					curl_setopt_array(
						$curl,
						array(
							CURLOPT_URL            => 'https://maps.googleapis.com/maps/api/geocode/json?address=' . $zcode . '&key=AIzaSyChwuh017ddDzFy8AWK9wnAHCbYJgTCIrw',
							CURLOPT_RETURNTRANSFER => true,
							CURLOPT_ENCODING       => '',
							CURLOPT_MAXREDIRS      => 10,
							CURLOPT_TIMEOUT        => 0,
							CURLOPT_FOLLOWLOCATION => true,
							CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
							CURLOPT_CUSTOMREQUEST  => 'GET',
						)
					);

					$response = curl_exec( $curl );

					curl_close( $curl );
					$response = json_decode( $response );
					// dump($response);
					if($response->status=='OK'){
					$sec_ast             = count( $response->results[0]->address_components ) - 2;
					$global_state        = $response->results[0]->address_components[ $sec_ast ]->long_name;
					$slug        = strtolower( $response->results[0]->address_components[ $sec_ast ]->long_name );

					$arr         = array(
						'taxonomy' => 'location-state',
						'field'    => 'name',
						'terms'    => $slug,
					);
					$tax_query[] = $arr;

					}else{
						$global_state='Invalid';
					}
				}else{
					$global_state='Invalid';
				}

			} else {
				$arr          = array(
					'key'     => 'birdeye_zip',
					'value'   => $item['value'],
					'compare' => '==',
				);
				$meta_query[] = $arr;
			}
		} else {
			$arr         = array(
				'taxonomy' => $item['type'],
				'field'    => 'slug',
				'terms'    => array( $item['value'] ),
			);
			$tax_query[] = $arr;
		}
	}
	} else {
		$tax_query  = '';
		$meta_query = '';
	}
	if ( empty( $meta_query ) ) {
		$meta_query = '';
	}
	if ( empty( $tax_query ) ) {
		$tax_query = '';
	}
	return array(
		'meta_query' => $meta_query,
		'tax_query' => $tax_query,
		'global_state' => $global_state,
	);
}
function get_exclude_data($items=null){
	$get_query_args=get_query_args($items);
	$tax_query=$get_query_args['tax_query'];
	$meta_query=$get_query_args['meta_query'];
	$args = array(
		'post_type'      => array( 'location' ),
		'posts_per_page' => -1,
		'orderby'        => 'title',
		'order'          => 'ASC',
		'tax_query'      => $tax_query,
		'meta_query'     => $meta_query,
	);
	// var_dump($args);
	$query                  = new WP_Query( $args );
	// The Loop
	$location_states=array();
	$location_brands=array();
	$location_providers=array();
	if ( $query->have_posts() ) {
		while ( $query->have_posts() ) {
			$query->the_post();
			$pID         = get_the_ID();
			$post_fields = get_fields( $pID );
			$location_state                 = get_the_terms( $pID, 'location-state' );
			$state_ids= join(', ', wp_list_pluck($location_state, 'term_id'));
			$location_brand                 = get_the_terms( $pID, 'location-brand' );
			$brand_ids= join(', ', wp_list_pluck($location_brand, 'term_id'));
			$alrv_slo_providers_on_location = ( isset( $post_fields['alrv_slo_providers_on_location'] ) ) ? $post_fields['alrv_slo_providers_on_location'] : null;
			if($alrv_slo_providers_on_location){
				$provider_ids=join(',',$alrv_slo_providers_on_location);
			}else{
				$provider_ids='';
			}
			$location_states[]=$state_ids;
			$location_brands[]=$brand_ids;
			$location_providers[]=$provider_ids;
		}
	}
	wp_reset_query();
	wp_reset_postdata();
	return array(
		'location-states' =>  array_unique(explode(',',join(',',  $location_states))),
		'location-brands' => array_unique(explode(',',join(',',  $location_brands))),
		'location-providers' =>  array_filter(array_unique(explode(',',join(',',  $location_providers)))),
	);

}


function glide_search_by_title( $search, $wp_query ) {
    if ( ! empty( $search ) && ! empty( $wp_query->query_vars['search_terms'] ) ) {
        global $wpdb;
		$type='provider';
        $q = $wp_query->query_vars;
        $n = ! empty( $q['exact'] ) ? '' : '%';
		if(is_array($q['post_type'])){
			$arrPost=$q['post_type'];
		}else{
			$arrPost=array($q['post_type']);
		}
		if(in_array($type,$arrPost)){

			$search = array();

			foreach ( ( array ) $q['search_terms'] as $term )
            $search[] = $wpdb->prepare( "$wpdb->posts.post_title LIKE %s", $n . $wpdb->esc_like( $term ) . $n );

			if ( ! is_user_logged_in() )
            $search[] = "$wpdb->posts.post_password = ''";

			$search = ' AND ' . implode( ' AND ', $search );
		}
    }

    return $search;
}

add_filter( 'posts_search', 'glide_search_by_title', 10, 2 );


add_filter('gform_pre_render_10', 'populate_location');
add_filter('gform_pre_validation_10', 'populate_location');
add_filter('gform_pre_submission_filter_10', 'populate_location');
add_filter('gform_admin_pre_render_10', 'populate_location');

add_filter( 'gform_pre_render_11', 'populate_location' );
add_filter( 'gform_pre_validation_11', 'populate_location' );
add_filter( 'gform_pre_submission_filter_11', 'populate_location' );
add_filter( 'gform_admin_pre_render_11', 'populate_location' );

function populate_location($form)
{

    foreach ($form['fields'] as &$field) {

        if ($field->type != 'select' || strpos($field->cssClass, 'populate-location-ppc') === false) {
            continue;
        }
        global $post;
        $choices = array();
		$buffer = array();

        $select_locations = get_field('select_locations', $post->ID);
        $defaultValue = $field->defaultValue;

        if (is_array($select_locations) && count($select_locations) == 1) {
            foreach ($select_locations as $loc) {
                if (isset(get_the_terms($loc->ID, 'location-city')[0])) {
                    $city = get_the_terms($loc->ID, 'location-city')[0];

                    if (in_array($city->name, $buffer)) {
                        continue;
                    }
                    $buffer[] = $city->name;
                    $state = get_the_terms($loc->ID, 'location-state');
                    $alrv_loc_state_short_name = '';
                    if (isset($state[0])) {
                        $state = $state[0];
                        $alrv_loc_state_short_name = (get_field('alrv_loc_state_short_name', $state)) ? get_field('alrv_loc_state_short_name', $state) : null;
                    }
                    $choices[] = array('text' => $alrv_loc_state_short_name . '-' . $city->name, 'value' => $alrv_loc_state_short_name . '-' . $city->name);
                    $defaultValue = $loc->post_title;
                }
            }
        } elseif (is_array($select_locations) && count($select_locations) >= 1) {
            foreach ($select_locations as $loc) {
                if (isset(get_the_terms($loc->ID, 'location-city')[0])) {
                    $city = get_the_terms($loc->ID, 'location-city')[0];

                    if (in_array($city->name, $buffer)) {
                        continue;
                    }
                    $buffer[] = $city->name;
                    $state = get_the_terms($loc->ID, 'location-state');
                    $alrv_loc_state_short_name = '';
                    if (isset($state[0])) {
                        $state = $state[0];
                        $alrv_loc_state_short_name = (get_field('alrv_loc_state_short_name', $state)) ? get_field('alrv_loc_state_short_name', $state) : null;
                    }
                    $choices[] = array('text' => $alrv_loc_state_short_name . '-' . $city->name, 'value' => $alrv_loc_state_short_name . '-' . $city->name);

                }
            }

        } else {
            $choices[] = array('text' => 'AL-Montgomery', 'value' => 'AL-Montgomery');
        }

        $field->choices = $choices;
        $field->defaultValue = $defaultValue;

    }

    return $form;

}

// Set the canonical URL to the current URL
function my_custom_canonical_url( $canonical ) {    
	$current_url = get_site_url().add_query_arg( null, null );    
    $canonical = $current_url;    
    return $canonical;
}
add_filter( 'wpseo_canonical', 'my_custom_canonical_url' );

add_filter( 'wpseo_robots', 'yoast_seo_robots_remove_single' );
function yoast_seo_robots_remove_single( $robots ) {
	//$current_url = get_site_url().add_query_arg( null, null );  
	if ( isset($_REQUEST['provider-type'])) {
		return 'noindex, nofollow';
	}elseif(
		( is_page_template( 'templates/template-locations.php' ) 
		&& (isset($_REQUEST['location-type']) || isset($_REQUEST['location-brand']) || isset($_REQUEST['location-provider']) || isset($_REQUEST['location-city'])) 
		)
		){
			return 'noindex, nofollow';
	} else {
		return $robots;
	}
}

