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
function glide_excerpt($count)
{
	global $post;
	$permalink = get_permalink($post->ID);
	$excerpt = get_the_excerpt();
	$excerpt = strip_tags($excerpt);
	$excerpt = substr($excerpt, 0, $count);
	$excerpt = substr($excerpt, 0, strripos($excerpt, ' '));
	$excerpt = $excerpt . ' ...';
	$excerpt = $excerpt;
	return $excerpt;
}


/**
 * Excerpt with no read more option
 *
 * Function used to create custom excerpt.
 */
function glide_excerpt_nomore($count)
{
	global $post;
	$permalink = get_permalink($post->ID);
	$excerpt = get_the_excerpt();
	$excerpt = strip_tags($excerpt);
	$excerpt = substr($excerpt, 0, $count);
	$excerpt = substr($excerpt, 0, strripos($excerpt, ' '));
	$excerpt = $excerpt;
	return $excerpt;
}


/**
 * Pagination Function
 *
 * The pagination function to display pagination on any archive page
 */

function glide_pagination($pages = '', $range = 4)
{
	$showitems = ($range * 2) + 1;
	global $paged;
	if (empty($paged)) {
		$paged = 1;
	}
	if ($pages == '') {
		global $wp_query;
		$pages = $wp_query->max_num_pages;
		if (!$pages) {
			$pages = 1;
		}
	}

	if (1 != $pages && $pages != 0) {
		$buffer = array();
		echo '<div class="pagination">';

		echo "<a href='" . get_pagenum_link($paged - 1) . "'' data-page='" . ($paged - 1) . "' aria-label='pagination'><img src='" . get_template_directory_uri() . "/assets/img/pagination-left-arrow.svg' alt='pagination-left-arrow' /></a>";
		if ($paged >= 1) {
			// echo "<a href='".get_pagenum_link($paged - 1)."'>&lsaquo; </a>";
			if ($pages >= 2) {
				$n = 2;
			} else {
				$n = $pages;
			}
		}
		$pageArr = array();
		for ($x = $paged; $x <= $pages; $x++) {
			$pageArr[] = $x;
		}
		foreach (array_merge(range(0, $n - 1)) as $idx) {
			if (empty($pageArr[$idx])) {
				continue;
			}
			if ($pageArr[$idx] == $pages) {
				$buffer[] = $pageArr[$idx];
			}
			if ($pageArr[$idx] == $paged) {
				$current = 'class="current"';
				echo "<span " . $current . "  data-page='" . $pageArr[$idx] . "''> $pageArr[$idx] </span>";
			} else {
				$current = '';
				echo "<a href='" . get_pagenum_link($pageArr[$idx]) . "' " . $current . " data-page='" . $pageArr[$idx] . "''> $pageArr[$idx] </a>";
			}

			if ($idx == $n - 1 && $pageArr[$idx] != null) {

				if (in_array($pageArr[$idx], $buffer)) {
					echo '';
				} else {
					echo "<div class='pagination-dots'>...</div>";
				}
			}

			$buffer[] = $pageArr[$idx];

		}

		$pageArr_2 = array();
		if ($pages >= 2) {
			for ($y = $pages - 2; $y <= $pages; $y++) {
				$pageArr_2[] = $y;
			}
			foreach (array_merge(range($n - 1, $n)) as $idx) {
				if (in_array($pageArr_2[$idx], $buffer)) {
					echo '';
				} else {
					if ($pageArr_2[$idx] > $paged) {
						echo "<a href='" . get_pagenum_link($pageArr_2[$idx]) . "'' data-page='" . $pageArr_2[$idx] . "' > $pageArr_2[$idx] </a>";
					}
				}
			}
		}
		if ($paged < $pages) {
			// echo "<a href=\"".get_pagenum_link($paged + 1)."\" aria-label='pagination'>&rsaquo;</a>";
			echo "<a href='" . get_pagenum_link($paged + 1) . "'' data-page='" . ($paged + 1) . "'  aria-label='pagination'><img src='" . get_template_directory_uri() . "/assets/img/pagination-right-arrow.svg' alt='pagination-right-arrow' /></a>";
		}
		echo "<div class='clear'></div></div>\n";
	}
}



function glide_pagination_location_ajax($filter_type = '', $pages = '', $items = null, $range = 4)
{
	$html = '';
	$type = (isset($items[0]->value)) ? $items[0]->value : null;
	$state = (isset($items[1]->value)) ? $items[1]->value : null;
	$brand = (isset($items[2]->value)) ? $items[2]->value : null;
	$provider = (isset($items[3]->value)) ? $items[3]->value : null;
	if (isset($_COOKIE['storedLat']) && isset($_COOKIE['storedLong'])) {

		$def_lat = $_COOKIE['storedLat'];
		$def_long = $_COOKIE['storedLong'];
	}

	$showitems = ($range * 2) + 1;
	global $paged;
	if (empty($paged)) {
		$paged = 1;
	}
	if ($pages == '') {
		global $wp_query;
		$pages = $wp_query->max_num_pages;
		if (!$pages) {
			$pages = 1;
		}
	}

	if (1 != $pages && 0 != $pages) {
		$buffer = array();
		$html .= '<div class="pagination">';

		$html .= "<a href='javascript:void(0)' data-type='" . $type . "'filter-type='" . $filter_type . "' data-state='" . $state . "' data-brand='" . $brand . "' data-provider='" . $provider . "' data-def-lat='" . $def_lat . "' data-def-long='" . $def_long . "'  data-page='" . ($paged - 1) . "' class='ajax-location-pagination' aria-label='pagination'><img src='" . get_template_directory_uri() . "/assets/img/pagination-left-arrow.svg' alt='pagination-left-arrow' /></a>";
		if ($paged >= 1) {
			// echo "<a href='".get_pagenum_link($paged - 1)."'>&lsaquo; </a>";
			if ($pages >= 2) {
				$n = 2;
			} else {
				$n = $pages;
			}
		}
		$pageArr = array();
		for ($x = $paged; $x <= $pages; $x++) {
			$pageArr[] = $x;
		}
		foreach (array_merge(range(0, $n - 1)) as $idx) {
			if (empty($pageArr[$idx])) {
				continue;
			}
			if ($pageArr[$idx] == $pages) {
				$buffer[] = $pageArr[$idx];
			}
			if ($pageArr[$idx] == $paged) {
				$current = 'class="current"';
				$html .= "<span " . $current . " data-type='" . $type . "'filter-type='" . $filter_type . "' data-state='" . $state . "' data-brand='" . $brand . "' data-provider='" . $provider . "' data-def-lat='" . $def_lat . "' data-def-long='" . $def_long . "' data-page='" . $pageArr[$idx] . "' class='ajax-location-pagination'> $pageArr[$idx] </span>";
			} else {
				$current = '';
				$html .= "<a href='javascript:void(0)' " . $current . " data-type='" . $type . "'filter-type='" . $filter_type . "' data-state='" . $state . "' data-brand='" . $brand . "' data-provider='" . $provider . "' data-def-lat='" . $def_lat . "' data-def-long='" . $def_long . "' data-page='" . $pageArr[$idx] . "' class='ajax-location-pagination'> $pageArr[$idx] </a>";
			}

			if ($idx == $n - 1 && $pageArr[$idx] != null) {

				if (in_array($pageArr[$idx], $buffer)) {
					$html .= '';
				} else {
					$html .= "<div class='pagination-dots'>...</div>";
				}
			}

			$buffer[] = $pageArr[$idx];

		}

		$pageArr_2 = array();
		if ($pages >= 2) {
			for ($y = $pages - 2; $y <= $pages; $y++) {
				$pageArr_2[] = $y;
			}
			foreach (array_merge(range($n - 1, $n)) as $idx) {
				if (in_array($pageArr_2[$idx], $buffer)) {
					$html .= '';
				} else {
					if ($pageArr_2[$idx] > $paged) {
						$html .= "<a href='javascript:void(0)' data-type='" . $type . "'filter-type='" . $filter_type . "' data-state='" . $state . "' data-brand='" . $brand . "' data-provider='" . $provider . "' data-def-lat='" . $def_lat . "' data-def-long='" . $def_long . "' data-page='" . $pageArr_2[$idx] . "' class='ajax-location-pagination' > $pageArr_2[$idx] </a>";
					}
				}
			}
		}
		if ($paged < $pages) {
			// echo "<a href=\"".get_pagenum_link($paged + 1)."\" aria-label='pagination'>&rsaquo;</a>";
			$html .= "<a href='javascript:void(0)' data-type='" . $type . "'filter-type='" . $filter_type . "' data-state='" . $state . "' data-brand='" . $brand . "' data-provider='" . $provider . "' data-def-lat='" . $def_lat . "' data-def-long='" . $def_long . "' data-page='" . ($paged + 1) . "' class='ajax-location-pagination'  aria-label='pagination'><img src='" . get_template_directory_uri() . "/assets/img/pagination-right-arrow.svg' alt='pagination-right-arrow' /></a>";
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
function glide_svg_upload_support($mimes)
{
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
}

add_filter('upload_mimes', 'glide_svg_upload_support');


/**
 * Remove default WordPress login logo link & set it to homepage of site
 */
function glide_login_logo_url($url)
{
	return '"' . home_url() . '"';
}

add_filter('login_headerurl', 'glide_login_logo_url');
add_action('pre_get_posts', function ($query) {
	if (is_tax('conditions') || is_tax('services')) {
		$query->set('order', 'ASC');
		$query->set('orderby', 'title');
	}
});

/**
 * Add viewport meta tag in head
 */
function glide_viewport()
{
	echo '
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	';
}

add_action('wp_head', 'glide_viewport');


/**
 * Gravity forms filters
 */
add_filter('gform_confirmation_anchor', '__return_true');
add_filter('gform_init_scripts_footer', '__return_true');

// Set Tabindex For Gravity Form
add_filter('gform_tabindex', 'change_tabindex', 10, 2);
function change_tabindex($tabindex, $form)
{
	return 10;
}

/**
 * First and last menu item classes
 */
function glide_first_last_menu_classes($items)
{
	if ($items) {
		$items[1]->classes[] = 'first-menu-item';
		$items[count($items)]->classes[] = 'last-menu-item';
		return $items;
	}
	return $items;
}
add_filter('wp_nav_menu_objects', 'glide_first_last_menu_classes');

/**
 * Gravity Forms
 *
 * Disable the tab-index
 */

add_filter(
	'gform_tabindex',
	function () {
		return false;
	}
);



/**
 * Set favicon of dashboard
 */

function glide_theme_favicon()
{
	$favicon_path = get_template_directory_uri() . '/assets/img/pwa/favicon.ico';

	echo '<link rel="shortcut icon" href="' . esc_url($favicon_path) . '" />';
}

add_action('admin_head', 'glide_theme_favicon');


/**
 * Function to remove the starting words from the_archive_title()
 *
 * E.g. from Category : Dallas Neighborhoods => Dallas Neighborhoods
 */

function glide_theme_archive_title($title)
{
	if (is_category()) {
		$title = single_cat_title('', false);
	} elseif (is_tag()) {
		$title = single_tag_title('', false);
	} elseif (is_author()) {
		$title = get_the_author_meta('display_name');
	} elseif (is_post_type_archive()) {
		$title = post_type_archive_title('', false);
	} elseif (is_tax()) {
		$title = single_term_title('', false);
	}

	return $title;
}

add_filter('get_the_archive_title', 'glide_theme_archive_title');



/**
 * Custom logo for WordPress login screen
 *
 * This function replaces the default WordPress logo on the login with website logo.
 */
function glide_login_logo()
{
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
add_action('login_head', 'glide_login_logo');

// removing parmalink from team cpt
add_action('admin_head', 'wpds_custom_admin_post_css');
function wpds_custom_admin_post_css()
{

	global $post_type;

	if ($post_type == 'team') {
		echo '<style>#edit-slug-box {display:none;}</style>';
	}
}
function load_template_part($template_name, $part_name = null, $args = null)
{
	ob_start();
	get_template_part($template_name, $part_name, $args);
	$var = ob_get_contents();
	ob_end_clean();
	return $var;
}

function date_formatting($start_date, $end_date)
{
	$final_date = '';
	if ($start_date == '') {
		return;
	}
	if ($end_date == '') {
		return;
	}
	$start_date = explode(' ', date('F j Y', strtotime($start_date)));
	$end_date = explode(' ', date('F j Y', strtotime($end_date)));

	if ($start_date[2] == $end_date[2]) {
		if ($start_date[0] == $end_date[0]) {
			$final_date .= $start_date[0];
			if ($start_date[1] == $end_date[1]) {
				$final_date .= ' ' . $start_date[1];
			} else {
				$final_date .= ' ' . $start_date[1] . '-' . $end_date[1];
			}
			if ($start_date[2] == $end_date[2]) {
				$final_date .= ', ' . $start_date[2];
			}
		} else {
			if ($start_date[1] == $end_date[1]) {
				$final_date .= ' ' . $start_date[0] . '-' . $end_date[0] . ' ' . $start_date[1];
			} else {
				$final_date .= ' ' . $start_date[0] . ' ' . $start_date[1] . '-' . $end_date[0] . ' ' . $end_date[1];
			}
			if ($start_date[2] == $end_date[2]) {
				$final_date .= ', ' . $start_date[2];
			}
		}
	} else {
		$final_date .= implode(' ', $start_date) . ', ' . implode(' ', $end_date);
	}
	return $final_date;
}


function save_topic_as_meta($post_id)
{
	if (get_post_type($post_id) == 'location') {
		$term = get_the_terms($post_id, 'location-state')[0];
		$term1 = get_the_terms($post_id, 'location-brand')[0];
		update_post_meta($post_id, 'meta_location_state', $term->slug);
		update_post_meta($post_id, 'meta_location_brand', $term1->slug);
	} elseif (get_post_type($post_id) == 'provider') {
		$lastname = '';
		$title = explode(' ', explode(',', get_the_title($post_id))[0]);
		$key = count($title) - 1;
		$lastname = $title[$key];
		update_post_meta($post_id, 'alrv_spo_lastname', $lastname);
	}
}
add_action('post_updated', 'save_topic_as_meta');
// var_dump(get_post_meta(2099, 'meta_location_state')	);
add_filter('gform_pre_render', 'populate_location_and_provider');
add_filter('gform_pre_validation', 'populate_location_and_provider');
add_filter('gform_pre_submission_filter', 'populate_location_and_provider');
add_filter('gform_admin_pre_render', 'populate_location_and_provider');
function populate_location_and_provider($form)
{
	foreach ($form['fields'] as &$field) {
		$cssClass = explode(' ', $field->cssClass);
		if ($field->type == 'select' && (in_array('populate-location', $cssClass) || in_array('next-page-location', $cssClass))) {
			$args = array(
				'post_type' => array('location'),
				'post_status' => array('publish'),
				'posts_per_page' => -1,
				'meta_key' => 'meta_location_state',
				'orderby' => 'meta_value',
				'order' => 'ASC',
				'meta_query' => array(
					array(
						'key' => 'make_an_appointment_button',
						'value' => 'disable',
						'compare' => '!=',
					),
				),
			);
			// var_dump($args);
			$query = new WP_Query($args);
			// $dataAttrsField=$field->dataAttrsField
			$choices = array();
			$attributes = array();

			if ($query->have_posts()) {
				while ($query->have_posts()) {
					$query->the_post();
					$pID = get_the_ID();
					$post_title = get_the_title($pID);
					$state = get_the_terms($pID, 'location-state');
					$city = get_the_terms($pID, 'location-city');
					$alrv_loc_state_short_name = '';
					if (isset($state[0])) {
						$state = $state[0];
						$alrv_loc_state_short_name = (get_field('alrv_loc_state_short_name', $state)) ? get_field('alrv_loc_state_short_name', $state) : null;
					}
					if (isset($city[0])) {
						$city = $city[0];
					}
					if ($city) {
						if ($alrv_loc_state_short_name || $city->name) {
							$post_title = $alrv_loc_state_short_name . '-' . $city->name;
						}
					}
					$post_fields = get_fields($pID);
					$alrv_slo_external_btn = (isset($post_fields['alrv_slo_external_btn'])) ? $post_fields['alrv_slo_external_btn'] : null;
					$alrv_slo_tracking_code = (isset($post_fields['alrv_slo_tracking_code'])) ? $post_fields['alrv_slo_tracking_code'] : null;
					$choices[] = array('text' => $post_title, 'value' => $post_title, 'attributes' => array('data-id' => $pID, 'data-button' => $alrv_slo_external_btn, 'data-tracking-code' => $alrv_slo_tracking_code));
				}
			}

			// update 'Select a Post' to whatever you'd like the instructive option to be
			$field->placeholder = 'Select a Location';
			$field->choices = $choices;
		} elseif ($field->type == 'select' && in_array('populate-provider', $cssClass)) {
			$args = array(
				'post_type' => array('provider'),
				'post_status' => array('publish'),
				'posts_per_page' => -1,
			);
			// var_dump($args);
			$query = new WP_Query($args);

			$choices = array();

			if ($query->have_posts()) {
				while ($query->have_posts()) {
					$query->the_post();
					$pID = get_the_ID();
					$post_title = get_the_title($pID);
					$post_fields = get_fields($pID);
					$choices[] = array('text' => $post_title, 'value' => $post_title, 'attributes' => array('data-id' => $pID));
				}
			}
			// update 'Select a Post' to whatever you'd like the instructive option to be
			$field['title'] = $post_title;
			$field->placeholder = 'Select a Provider';
			$field->choices = $choices;

		} elseif ($field->type == 'select' && in_array('populate-state', $cssClass)) {
			$state = get_terms(array(
				'taxonomy' => 'location-state',
			));
			$choices = array();
			foreach ($state as $state) {
				$choices[] = array('text' => $state->name, 'value' => $state->name, 'attributes' => array('data-id' => $state->term_id));
			}
			// update 'Select a Post' to whatever you'd like the instructive option to be
			$field->placeholder = 'Select a State';
			$field->choices = $choices;
		} else {
			continue;
		}
	}

	return $form;
}
add_filter('gform_field_value_app-location', 'cpt_population_function2');
function cpt_population_function2($value)
{
	if ($value) {
		$post_title = get_the_title($value);
		$state = get_the_terms($value, 'location-state');
		$city = get_the_terms($value, 'location-city');
		$alrv_loc_state_short_name = '';
		if (isset($state[0])) {
			$state = $state[0];
			$alrv_loc_state_short_name = (get_field('alrv_loc_state_short_name', $state)) ? get_field('alrv_loc_state_short_name', $state) : null;
		}
		if (isset($city[0])) {
			$city = $city[0];
		}
		if ($city) {
			if ($alrv_loc_state_short_name || $city->name) {
				$post_title = $alrv_loc_state_short_name . '-' . $city->name;
			}
		}
		$value = $post_title;
	}
	return $value;
}
add_filter('gform_field_value_app-provider', 'cpt_population_function');
function cpt_population_function($value)
{
	if ($value) {
		$value = get_the_title($value);
	}
	return $value;
}
add_filter('gform_field_value_app-state', 'term_population_function');
function term_population_function($value)
{
	$term = get_term_by('id', $value, 'location-state');
	if ($term) {
		$value = $term->name;
	}
	return $value;
}


add_filter('gform_field_choice_markup_pre_render', function ($choice_markup, $choice, $field, $value) {
	// Bail if: in the admin or no data attributes
	if ($field->type == 'select') {
		$cssClass = explode(' ', $field->cssClass);

		if (in_array('populate-location', $cssClass)) {
			$attrs = $choice['attributes'];
			$attrHtml = '';
			foreach ($attrs as $attr => $value) {
				if ($attr == 'data-button') {
					if ($value) {
						$attrHtml .= " {$attr}='{$value['url']}'";
						$attrHtml .= " {$attr}-title='{$value['title']}'";
					} else {
						$attrHtml .= " {$attr}=''";
					}
				} else {
					$attrHtml .= " {$attr}='{$value}'";
				}
			}
			$choice_markup = str_replace('<option ', "<option $attrHtml", $choice_markup);
		} else {
			$attrs = (isset($choice['attributes'])) ? $choice['attributes'] : null;
			$attrHtml = '';
			//  dump($attrs);
			if ($attrs) {
				foreach ($attrs as $attr => $value) {
					if (!is_array($value)) {
						$attrHtml .= " {$attr}='{$value}'";
					}
				}
				$choice_markup = str_replace('<option ', "<option $attrHtml", $choice_markup);
			}
		}
	}

	return $choice_markup;
}, 10, 4);


function get_provider_location($provider_id, $type = 'string')
{
	$args = array(
		'post_type' => array('location'),
		'posts_per_page' => -1,
	);
	// var_dump($args);
	$query = new WP_Query($args);

	$locations = array();
	$loc = array();

	// new acf provider backend relationship 'alrv_spo_location_on_providers'
	$related_locations = get_field('alrv_spo_location_on_providers', $provider_id);

	if ($related_locations) {
		foreach ($related_locations as $location_post) {
			$arr = array();
			$arr['location_id'] = $location_post;
			$arr['provider_ids'] = array($provider_id);
			$locations[] = $arr;
		}
	}

	if ($type == 'post') {
		return $locations;
	} else {
		// var_dump($locations);
		$buffer = array();
		foreach ($locations as $key => $location) {
			if (isset(get_the_terms($location['location_id'], 'location-city')[0])) {
				$city = get_the_terms($location['location_id'], 'location-city')[0];
				if (!in_array($city->name, $buffer)) {
					if ($type == 'string') {
						$loc[] = $city->name;
					} elseif ($type == 'array') {
						$arr['name'] = $city->name;
						$arr['term_id'] = $city->term_id;
						$loc[] = $arr;
					}
				}
				$buffer[] = $city->name;
			}
		}

		if ($type == 'string') {
			return implode(', ', $loc);
		} elseif ($type == 'array') {
			return $loc;
		}
	}
}

// new acf provider backend relationship 'alrv_spo_location_on_providers'
function get_provider_by_city($city)
{
	$args = array(
		'post_type' => array('location'),
		'posts_per_page' => -1,
		'tax_query' => array(
			array(
				'taxonomy' => 'location-city',
				'field' => 'term_id',
				'terms' => $city,
				'operator' => 'IN',
			),
		),
	);
	// var_dump($args);
	$query = new WP_Query($args);

	$locations = array();
	$loc = array();
	$provider_ids = array();

	if ($query->have_posts()) {
		while ($query->have_posts()) {
			$query->the_post();
			$locID = get_the_ID();
			$provider_args = array(
				'post_type' => 'provider',
				'post_status' => 'publish',
				'meta_query' => array(
					array(
						'key' => 'alrv_spo_location_on_providers',
						'value' => '"' . $locID . '"',
						'compare' => 'LIKE',
					),
				),
				'fields' => 'ids',
			);
			$provider_query = new WP_Query($provider_args);

			if ($provider_query->have_posts()) {
				$provider_ids = array_merge($provider_ids, $provider_query->posts);
			}
			wp_reset_postdata();
		}
	}
	wp_reset_postdata();
	return $provider_ids;
}


function array_flatten($array)
{
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
function dump($item)
{
	echo '<pre>';
	var_dump($item);
	echo ' </pre>';
}


function generate_rewrite_rules($wp_rewrite)
{
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
add_action('generate_rewrite_rules', 'generate_rewrite_rules');

function update_post_link($post_link, $id = 0)
{
	$post = get_post($id);
	if (is_object($post) && $post->post_type == 'post') {
		return home_url('/blog/' . $post->post_name . '/');
	}
	return $post_link;
}
add_filter('post_link', 'update_post_link', 1, 3);

function admin_page_birdeye()
{
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

add_action('admin_menu', 'admin_page_birdeye');

function admin_page_birdeye_response()
{
	include_once ABSPATH . '/wp-content/themes/allervie/templates/birdeye-page.php';

}
function global_notice_meta_box()
{

	add_meta_box(
		'bird-eye-location-data',
		__('BirdEye (Location Data)', 'alrv_td'),
		'global_notice_meta_box_callback',
		'location'
	);
}

add_action('add_meta_boxes', 'global_notice_meta_box');
function global_notice_meta_box_callback()
{
	$pID = get_the_ID();
	$brideye = get_field('alrv_slo_birdeye_location_id', $pID);
	echo '<div class="data-content">
	<table class="wp-list-table widefat fixed striped table-view-list pages">
		<tbody>
			<tr>
				<th><strong>Key</strong></strong></th>
				<th><strong>Value</strong></th>
			</tr>
			<tr>
				<th><strong>Name</strong></strong></th>
				<td>' . get_post_meta($pID, 'birdeye_name', true) . '</td>
			</tr>
			<tr>
				<th><strong>Alias</strong></strong></th>
				<td>' . get_post_meta($pID, 'birdeye_alias', true) . '</td>
			</tr>
			<tr>
				<th><strong>Image</strong></strong></th>
				<td><img src="' . get_post_meta($pID, 'birdeye_coverImageUrl', true) . '" ></td>
			</tr>
			<tr>
				<th><strong>Lnt</strong></strong></th>
				<td>' . get_post_meta($pID, 'birdeye_lat', true) . '</td>
			</tr>
			<tr>
				<th><strong>Lng</strong></th>
				<td>' . get_post_meta($pID, 'birdeye_lng', true) . '</td>
			</tr>
			<tr>
				<th><strong>Phone</strong></th>
				<td>' . get_post_meta($pID, 'birdeye_phone', true) . '</td>
			</tr>
			<tr>
				<th><strong>Address 1</strong></th>
				<td>' . get_post_meta($pID, 'birdeye_address1', true) . '</td>
			</tr>
			<tr>
				<th><strong>Address 2</strong></th>
				<td>' . get_post_meta($pID, 'birdeye_address2', true) . '</td>
			</tr>
			<tr>
				<th><strong>City</strong></th>
				<td>' . get_post_meta($pID, 'birdeye_city', true) . '</td>
			</tr>
			<tr>
				<th><strong>State</strong></th>
				<td>' . get_post_meta($pID, 'birdeye_state', true) . '</td>
			</tr>
			<tr>
				<th><strong>Zip</strong></th>
				<td>' . get_post_meta($pID, 'birdeye_zip', true) . '</td>
			</tr>
			<tr>
				<th><strong>Country Code</strong></th>
				<td>' . get_post_meta($pID, 'birdeye_countryCode', true) . '</td>
			</tr>
			<tr>
				<th><strong>Full Address</strong></th>
				<td>' . get_post_meta($pID, 'birdeye_full_address', true) . '</td>
			</tr>
			<tr>
				<th><strong>Google url</strong></th>
				<td><a href="' . get_post_meta($pID, 'birdeye_googleUrl', true) . '" target="_blank">View</a></td>
			</tr>
		</tbody>
	</table></div>';

	if (!empty($brideye)) {
		echo '<div class="location-single-fetch">';
		echo '<button class="button button-primary single-fetch-loc" data-locaid="' . $pID . '">Fetch Location Now</button>';
		echo '<span class="spinner"></span>';
		echo '<div id="single-loc-notifi-res"></div>';
		echo '</div>';
	}
}


function get_clinical_providers($provider_id = null)
{
	$args = array(
		'post_type' => array('location'),
		'posts_per_page' => -1,
		'tax_query' => array(
			array(
				'taxonomy' => 'location-type',
				'field' => 'slug',
				'terms' => array('clinical-research'),
			)
		)

	);
	$query = new WP_Query($args);
	// The Loop
	$providers = array();
	if ($query->have_posts()) {
		while ($query->have_posts()) {
			$query->the_post();
			$pID = get_the_ID();
			$post_fields = get_fields($pID);

			// new acf provider backend relationship 'alrv_spo_location_on_providers'
			$alrv_slo_providers_on_location = get_provider_by_location_id($pID);
			if ($alrv_slo_providers_on_location) {
				$providers[] = $alrv_slo_providers_on_location;
			}

		}
	}
	wp_reset_postdata();
	wp_reset_query();
	$providers = array_flatten($providers);
	if ($provider_id) {
		if (in_array($provider_id, $providers)) {
			return $provider_id;
		} else {
			return false;
		}
	}
	return $providers;
}

//location sub functions
function create_items_from_get($GET)
{
	$items = array();
	foreach ($GET as $type => $value) {
		if ($type == 'current-page') {
			continue;
		}

		$item['title'] = '';
		$item['value'] = $value;
		$item['type'] = $type;

		$items[] = $item;
	}

	return $items;
}
function get_all_location_pins($type = null, $tax_query = null, $meta_query = null, $alat = '33.0237769', $alng = '-96.7963909', $res_zip = '')
{
	$count = 0;
	$arrZips = array();
	$results = array();
	$location_state_html = '';
	$location_state_buffer = array();
	$location_brand_html = '';
	$location_brand_buffer = array();
	$location_provider_html = '';
	$location_provider_buffer = array();


	$marker_pin = get_template_directory_uri() . '/assets/img/pin-blue.png';
	$marker_pin_active = get_template_directory_uri() . '/assets/img/pin-green.png';


	$args = array(
		'post_type' => array('location'),
		'post_status' => array('publish'),
		'posts_per_page' => -1,
		'tax_query' => $tax_query,
		'meta_query' => $meta_query,
	);
	$query = new WP_Query($args);
	if ($query->have_posts()) {
		while ($query->have_posts()) {
			$query->the_post();
			$pID = get_the_ID();
			$post_fields = get_fields($pID);
			$alrv_slo_fax = (isset($post_fields['alrv_slo_fax'])) ? $post_fields['alrv_slo_fax'] : null;

			$lat = (get_post_meta($pID, 'birdeye_lat', true)) ? get_post_meta($pID, 'birdeye_lat', true) : null;
			$lng = (get_post_meta($pID, 'birdeye_lng', true)) ? get_post_meta($pID, 'birdeye_lng', true) : null;
			$phone = (get_post_meta($pID, 'birdeye_phone', true)) ? get_post_meta($pID, 'birdeye_phone', true) : null;
			$address1 = (get_post_meta($pID, 'birdeye_address1', true)) ? get_post_meta($pID, 'birdeye_address1', true) : null;
			$address2 = (get_post_meta($pID, 'birdeye_address2', true)) ? ', ' . get_post_meta($pID, 'birdeye_address2', true) : null;
			$city = (get_post_meta($pID, 'birdeye_city', true)) ? '<br>' . get_post_meta($pID, 'birdeye_city', true) . ',' : null;
			$state = (get_post_meta($pID, 'birdeye_state', true)) ? get_post_meta($pID, 'birdeye_state', true) . ',' : null;
			$zip = (get_post_meta($pID, 'birdeye_zip', true)) ? get_post_meta($pID, 'birdeye_zip', true) : null;
			$countryCode = (get_post_meta($pID, 'birdeye_countryCode', true)) ? get_post_meta($pID, 'birdeye_countryCode', true) : null;
			$googleUrl = (get_post_meta($pID, 'birdeye_googleUrl', true)) ? get_post_meta($pID, 'birdeye_googleUrl', true) : null;

			$address = $address1 . '' . $address2 . ' ' . $city . ' ' . $state . ' ' . $zip;
			$clinical = '';
			$condition_term = get_the_terms($pID, 'location-type');
			if ($condition_term) {
				foreach ($condition_term as $condition) {
					$current_location_type = $condition->slug;
					if ($current_location_type == 'clinical-research') {

						$clinical .= '<div class="services-catagories">
								<span class="cat-btn" style="background-color: #1d9db9;">' . $condition->name . '</span>
							</div>';

					}
				}
			}
			$location_state = get_the_terms($pID, 'location-state');
			$location_brand = get_the_terms($pID, 'location-brand');
			$alrv_slo_providers_on_location = (isset($post_fields['alrv_slo_providers_on_location'])) ? $post_fields['alrv_slo_providers_on_location'] : null;
			if ($location_state) {
				foreach ($location_state as $key => $state) {
					if (!in_array($state->slug, $location_state_buffer)) {
						$location_state_html .= '<option value="' . $state->slug . '">' . $state->name . '</option>';
					}
					$location_state_buffer[] = $state->slug;
				}
			}
			if ($location_brand) {
				foreach ($location_brand as $key => $brand) {
					if (!in_array($brand->slug, $location_brand_buffer)) {
						$location_brand_html .= '<option value="' . $brand->slug . '">' . $brand->name . '</option>';
					}
					$location_brand_buffer[] = $brand->slug;
				}
			}
			if ($alrv_slo_providers_on_location) {
				foreach ($alrv_slo_providers_on_location as $key => $location) {
					$title = get_the_title($location);
					if (!empty($title) && !in_array($location, $location_provider_buffer)) {
						$location_provider_html .= '<option value="' . $location . '">' . $title . '</option>';
					}
					$location_provider_buffer[] = $location;
				}
			}
			$results[$count]['location_id'] = $pID;
			$results[$count]['title'] = get_the_title($pID);
			$results[$count]['lat'] = $lat;
			$results[$count]['long'] = $lng;
			$results[$count]['phone_numbers'] = $phone;
			$results[$count]['address'] = $address;
			$results[$count]['URL'] = esc_url(get_permalink($pID));
			$results[$count]['fax'] = $alrv_slo_fax;
			$results[$count]['clinical'] = $clinical;
			$results[$count]['googleUrl'] = $googleUrl;
			$arrZips[] = array(
				'label' => $zip,
				'value' => $zip,
			);
			$count++;
		}
	}
	// var_dump($arrZips);
	wp_reset_postdata();
	wp_reset_query();
	if ($type != -1) {
		wp_localize_script(
			'locations-scripts',
			'locationVars',
			array(
				'ajaxurl' => admin_url('admin-ajax.php'),
				'alat' => $alat,
				'alng' => $alng,
				'zipcodeParam' => $res_zip,
				'stateParam' => '',
				'zipcodes' => $arrZips,
				'markerImage' => $marker_pin,
				'markerActiveImage' => $marker_pin_active,
				'results' => $results,
				'is_singular' => 'no',
				'is_tooltip' => 'yes',
				'assets_url' => esc_url(get_template_directory_uri()),
			)
		);

		wp_enqueue_script('jquery-ui-autocomplete');

		wp_enqueue_script('locations-scripts');
		wp_enqueue_script('googleapis');
	} else {
		return array(
			'arrZips' => $arrZips,
			'results' => $results,
			'location_state_html' => $location_state_html,
			'location_brand_html' => $location_brand_html,
			'location_provider_html' => $location_provider_html,
		);
	}
}
function get_all_location_filters($pID = null, $exclude_data = null, $GET = null)
{
	$fields = get_fields_escaped($pID);
	$alrv_posttitle = glide_page_title('alrv_tlo_title');
	$alrv_posttitle_hidden = $alrv_posttitle;
	$alrv_tlo_intro_text = $fields['alrv_tlo_intro_text'];
	$alrv_tlo_intro_text_hidden = $alrv_tlo_intro_text;
	$current_location = isset($_GET['location-state']) ? $_GET['location-state'] : '';
	$location_obj = ($current_location != '') ? get_term_by('slug', $current_location, 'location-state') : '';
	$location_name = (!empty($location_obj)) ? $location_obj->name : '';
	$alrv_posttitle = ($location_name != '') ? str_replace('Allervie Locations', 'Allervie Locations in ' . $location_name, $alrv_posttitle) : $alrv_posttitle;
	$alrv_tlo_intro_text = ($location_name != '') ? str_replace('the country', $location_name, $alrv_tlo_intro_text) : $alrv_tlo_intro_text;

	// Get all taxonomy values.
	$location_types = get_terms(
		array(
			'taxonomy' => 'location-type',
			'hide_empty' => false,
		)
	);

	$location_states = get_terms(
		array(
			'taxonomy' => 'location-state',
			'hide_empty' => false,
		)
	);


	$location_brands = get_terms(
		array(
			'taxonomy' => 'location-brand',
			'hide_empty' => false,
		)
	);

	$all_providers_query = array(
		'post_type' => 'provider',
		'posts_per_page' => -1,
		'orderby' => 'title',
		'order' => 'ASC',
	);
	$all_providers_posts = array();
	$all_providers_posts_query = new WP_Query($all_providers_query);
	if ($all_providers_posts_query->have_posts()) {
		while ($all_providers_posts_query->have_posts()) {
			$all_providers_posts_query->the_post();
			$data = array();
			$data['post_id'] = get_the_ID();
			$data['post_title'] = get_the_title(get_the_ID());
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
			<?php if ($alrv_tlo_intro_text) { ?>
				<p id="allervie-location-intro-txt"><?php echo $alrv_tlo_intro_text; ?></p>
			<?php } ?>
			<input type="hidden" value="<?php echo $alrv_tlo_intro_text_hidden; ?>" id="location-intro-txt-hidden">
		</div>
		<div class="s-40"></div>
		<div class="location-filter d-flex justify-content-between flex-wrap">
			<?php if ($location_types) { ?>
				<select name="location-type" id="location-type" class="loc-filter">
					<option value="*"> Select Type</option>
					<?php foreach ($location_types as $type) { ?>
						<option <?php if (isset($GET['location-type'])) {
							if ($GET['location-type'] == $type->slug) {
								echo 'selected';
							}
						} ?> value="<?php echo $type->slug; ?>"> <?php echo $type->name; ?> </option>
					<?php } ?>
				</select>
			<?php } ?>
			<?php if ($location_states) { ?>
				<select name="location-state" id="location-state" class="loc-filter">
					<option value="*"> State</option>
					<?php foreach ($location_states as $state) {
						if (!in_array($state->term_id, $exclude_data['location-states'])) {
							continue;
						}
						?>
						<option <?php if (isset($GET['location-state'])) {
							if ($GET['location-state'] == $state->slug) {
								echo 'selected';
							}
						} ?> value="<?php echo $state->slug; ?>"> <?php echo $state->name; ?> </option>
					<?php } ?>
				</select>
			<?php } ?>
			<?php if ($location_brands) { ?>
				<select name="location-brand" id="location-brand" class="loc-filter">
					<option value="*"> Brands </option>
					<?php foreach ($location_brands as $brand) {
						if (!in_array($brand->term_id, $exclude_data['location-brands'])) {
							continue;
						}
						?>
						<option <?php if (isset($GET['location-brand'])) {
							if ($GET['location-brand'] == $brand->slug) {
								echo 'selected';
							}
						} ?> value="<?php echo $brand->slug; ?>"> <?php echo $brand->name; ?> </option>
					<?php } ?>
				</select>
			<?php } ?>
			<?php if ($all_providers_posts) { ?>
				<select name="provider" id="location-provider" class="loc-filter">
					<option value="*"> Providers </option>
					<?php foreach ($all_providers_posts as $post) {
						if (!in_array($post['post_id'], $exclude_data['location-providers'])) {
							continue;
						}
						?>
						<option <?php if (isset($GET['location-provider'])) {
							if ($GET['location-provider'] == $post['post_id']) {
								echo 'selected';
							}
						} ?> value="<?php echo $post['post_id']; ?>"> <?php echo $post['post_title']; ?>
						</option>
					<?php } ?>
				</select>
			<?php } ?>

			<button type="button" id="clear-all" class="button clear-all-btn"><?php _e('Clear All', 'alrv_td'); ?></button>
		</div>
	</div>
	<div class="s-40"></div>
	<?php
}
function get_query_args($items = null)
{
	$arrZips = get_all_location_pins('-1')['arrZips'];
	$global_state = '';
	if ($items) {
		//print_r($items);
		foreach ($items as $key => $item) {
			if ($item['value'] == '*' || $item['value'] == '') {
				continue;
			}
			if ($item['type'] == 'location-provider') {
				$location_in_id = get_field('alrv_spo_location_on_providers', $item['value']);
				// $arr          = array(
				// 	'key'     => 'alrv_slo_providers_on_location',
				// 	'value'   => intval( $item['value'] ),
				// 	'compare' => 'LIKE',
				// );
				// $meta_query[] = $arr;
				// } elseif ( $item['type'] == 'zipcodes' ) {
				// 	if(isset($_POST['zipcodes'])){
				// 		$zipcodes=$_POST['zipcodes'];
				// 	}else{
				// 		$zipcodes=$arrZips;
				// 	}
				// 	if (  ! in_array( $item['value'], $zipcodes ) ) {
				// 		$zcode=$item['value'];
				// 		if (is_numeric($zcode)) {
				// 			$curl = curl_init();
				// 			// 45230 45201 45205 90011

				// 			curl_setopt_array(
				// 				$curl,
				// 				array(
				// 					CURLOPT_URL            => 'https://maps.googleapis.com/maps/api/geocode/json?address=' . $zcode . '&key=AIzaSyChwuh017ddDzFy8AWK9wnAHCbYJgTCIrw',
				// 					CURLOPT_RETURNTRANSFER => true,
				// 					CURLOPT_ENCODING       => '',
				// 					CURLOPT_MAXREDIRS      => 10,
				// 					CURLOPT_TIMEOUT        => 0,
				// 					CURLOPT_FOLLOWLOCATION => true,
				// 					CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
				// 					CURLOPT_CUSTOMREQUEST  => 'GET',
				// 				)
				// 			);

				// 			$response = curl_exec( $curl );

				// 			curl_close( $curl );
				// 			$response = json_decode( $response );
				// 			// dump($response);
				// 			if($response->status=='OK'){
				// 			$sec_ast             = count( $response->results[0]->address_components ) - 2;
				// 			$global_state        = $response->results[0]->address_components[ $sec_ast ]->long_name;
				// 			$slug        = strtolower( $response->results[0]->address_components[ $sec_ast ]->long_name );

				// 			$arr         = array(
				// 				'taxonomy' => 'location-state',
				// 				'field'    => 'name',
				// 				'terms'    => $slug,
				// 			);
				// 			$tax_query[] = $arr;

				// 			}else{
				// 				$global_state='Invalid';
				// 			}
				// 		}else{
				// 			$arr1 = array(
				//                 'taxonomy' => 'location-city',
				//                 'field' => 'name',
				//                 'terms' => $zcode,
				//             );
				//             $arr2 = array(
				//                 'taxonomy' => 'location-state',
				//                 'field' => 'name',
				//                 'terms' => $zcode,
				//             );

				//             $tax_query[] = array(
				//                 'relation' => 'OR',
				//                 $arr1,
				//                 $arr2
				//             );
				//        		}

				// 	} else {
				// 		$arr          = array(
				// 			'key'     => 'birdeye_zip',
				// 			'value'   => $item['value'],
				// 			'compare' => '==',
				// 		);
				// 		$meta_query[] = $arr;
				// 	}
			} else {
				if ($item['type'] != 'zipcodes') {
					$arr = array(
						'taxonomy' => $item['type'],
						'field' => 'slug',
						'terms' => array($item['value']),
					);

					$tax_query[] = $arr;
				}
			}
		}
	} else {
		$tax_query = '';
		$location_in_id = '';
	}
	if (empty($location_in_id)) {
		$location_in_id = '';
	}
	if (empty($tax_query)) {
		$tax_query = '';
	}
	return array(
		'loc_post_in' => $location_in_id,
		'tax_query' => $tax_query,
		'global_state' => $global_state,
	);
}
function get_exclude_data($items = null)
{
	$get_query_args = get_query_args($items);
	$tax_query = $get_query_args['tax_query'];
	$loc_post_in = $get_query_args['loc_post_in'];

	$args = array(
		'post_type' => array('location'),
		'posts_per_page' => -1,
		'orderby' => 'title',
		'order' => 'ASC',
		'tax_query' => $tax_query,
		'post__in' => $loc_post_in,
	);
	// var_dump($args);
	$query = new WP_Query($args);
	// The Loop
	$location_states = array();
	$location_brands = array();
	$location_providers = array();
	if ($query->have_posts()) {
		while ($query->have_posts()) {
			$query->the_post();
			$pID = get_the_ID();
			$post_fields = get_fields($pID);
			$location_state = get_the_terms($pID, 'location-state');
			$state_ids = join(', ', wp_list_pluck($location_state, 'term_id'));
			$location_brand = get_the_terms($pID, 'location-brand');
			$brand_ids = join(', ', wp_list_pluck($location_brand, 'term_id'));

			// new acf provider backend relationship 'alrv_spo_location_on_providers'
			$alrv_slo_providers_on_location = get_provider_by_location_id($pID);
			if ($alrv_slo_providers_on_location) {
				$provider_ids = join(',', $alrv_slo_providers_on_location);
			} else {
				$provider_ids = '';
			}
			$location_states[] = $state_ids;
			$location_brands[] = $brand_ids;
			$location_providers[] = $provider_ids;
		}
	}
	wp_reset_query();
	wp_reset_postdata();
	return array(
		'location-states' => array_unique(explode(',', join(',', $location_states))),
		'location-brands' => array_unique(explode(',', join(',', $location_brands))),
		'location-providers' => array_filter(array_unique(explode(',', join(',', $location_providers)))),
	);

}


function glide_search_by_title($search, $wp_query)
{
	if (!empty($search) && !empty($wp_query->query_vars['search_terms'])) {
		global $wpdb;
		$type = 'provider';
		$q = $wp_query->query_vars;
		$n = !empty($q['exact']) ? '' : '%';
		if (is_array($q['post_type'])) {
			$arrPost = $q['post_type'];
		} else {
			$arrPost = array($q['post_type']);
		}
		if (in_array($type, $arrPost)) {

			$search = array();

			foreach ((array) $q['search_terms'] as $term)
				$search[] = $wpdb->prepare("$wpdb->posts.post_title LIKE %s", $n . $wpdb->esc_like($term) . $n);

			if (!is_user_logged_in())
				$search[] = "$wpdb->posts.post_password = ''";

			$search = ' AND ' . implode(' AND ', $search);
		}
	}

	return $search;
}

add_filter('posts_search', 'glide_search_by_title', 10, 2);


add_filter('gform_pre_render_10', 'populate_location');
add_filter('gform_pre_validation_10', 'populate_location');
add_filter('gform_pre_submission_filter_10', 'populate_location');
add_filter('gform_admin_pre_render_10', 'populate_location');

add_filter('gform_pre_render_11', 'populate_location');
add_filter('gform_pre_validation_11', 'populate_location');
add_filter('gform_pre_submission_filter_11', 'populate_location');
add_filter('gform_admin_pre_render_11', 'populate_location');

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

		//Location Detail Pages
		if (empty($select_locations)) {
			$select_locations = get_field('select_location', $post->ID);
		}
		$defaultValue = $field->defaultValue;

		if ('location' == get_post_type()) {

			$location_slug = get_post_field('post_name', $post->ID);
			$city_name = ucfirst($location_slug);

			$state = get_the_terms($post->ID, 'location-state');

			$alrv_loc_state_short_name = '';
			if (isset($state)) {
				$state = $state[0];
				$alrv_loc_state_short_name = (get_field('alrv_loc_state_short_name', $state)) ? get_field('alrv_loc_state_short_name', $state) : null;
			}
			$choices[] = array(
				'text' => $alrv_loc_state_short_name . '-' . $city_name,
				'value' => $alrv_loc_state_short_name . '-' . $city_name,
			);

			if ($field->type == 'select') { // Adjust field ID accordingly
				// Add a class to the field to target it with JavaScript later
				$field->cssClass .= ' read-only-select';
			}

			$defaultValue = $alrv_loc_state_short_name . '-' . $city_name;

			$field->defaultValue = $defaultValue;

		} elseif (is_array($select_locations) && count($select_locations) == 1) {
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
					$choices[] = array(
						'text' => $alrv_loc_state_short_name . '-' . $city->name,
						'value' => $alrv_loc_state_short_name . '-' . $city->name,
					);

					$defaultValue = $alrv_loc_state_short_name . '-' . $city->name;

					$field->defaultValue = $defaultValue;
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
function my_custom_canonical_url($canonical)
{
	$current_url = get_site_url() . add_query_arg(null, null);
	$canonical = $current_url;
	return $canonical;
}
add_filter('wpseo_canonical', 'my_custom_canonical_url');

add_filter('wpseo_robots', 'yoast_seo_robots_remove_single');
function yoast_seo_robots_remove_single($robots)
{
	//$current_url = get_site_url().add_query_arg( null, null );  
	if (isset($_REQUEST['provider-type'])) {
		return 'noindex, nofollow';
	} elseif (
		(is_page_template('templates/template-locations.php')
			&& (isset($_REQUEST['location-type']) || isset($_REQUEST['location-brand']) || isset($_REQUEST['location-provider']) || isset($_REQUEST['location-city']))
		)
	) {
		return 'noindex, nofollow';
	} else {
		return $robots;
	}
}

//Search By Location
function calculate_distance($lat1, $lon1, $lat2, $lon2, $unit = 'mi')
{

	$lat1 = (float) $lat1;
	$lon1 = (float) $lon1;
	$lat2 = (float) $lat2;
	$lon2 = (float) $lon2;

	$theta = $lon1 - $lon2;
	$dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
	$dist = acos($dist);
	$dist = rad2deg($dist);
	$miles = $dist * 60 * 1.1515;
	if ($unit == 'km') {
		$miles *= 1.609344;
	}
	return $miles;
}

function sitemap_page_url($url, $post)
{
	if ('custom-provider-premier' === $post->post_name) {
		$url = home_url('/providers/brand/premier/');
	} elseif ('custom-location-premier' === $post->post_name) {
		$url = home_url('/locations/brand/premier/');
	}

	return $url;
}

add_filter('wpseo_xml_sitemap_post_url', 'sitemap_page_url', 10, 2);

// Modify the custom local business schema output
add_filter('saswp_modify_local_business_schema_output', 'custom_modify_local_business_schema_output', 10, 1);

function custom_modify_local_business_schema_output($schema)
{
	$title = get_the_title();
	$description = get_the_excerpt();
	$thumbnail_id = get_post_thumbnail_id(get_the_ID(), 'thumbnail');
	$thumbnail_url = wp_get_attachment_url($thumbnail_id);
	$thumbnail_metadata = wp_get_attachment_metadata($thumbnail_id);
	$thumbnail_caption = wp_get_attachment_caption($thumbnail_id);
	$image_object = [
		"@type" => "ImageObject",
		"@id" => get_permalink(get_the_ID()) . "#primaryimage",
		"url" => $thumbnail_url,
		"width" => $thumbnail_metadata['width'],
		"height" => $thumbnail_metadata['height'],
		"caption" => $thumbnail_caption
	];
	$birdeye_phone = get_post_meta(get_the_ID(), 'birdeye_phone', true) ? get_post_meta(get_the_ID(), 'birdeye_phone', true) : null;
	$birdeye_hoursOfOperations = get_post_meta(get_the_ID(), 'birdeye_hoursOfOperations', true) ? get_post_meta(get_the_ID(), 'birdeye_hoursOfOperations', true) : null;
	$birdeye_googleUrl = get_post_meta(get_the_ID(), 'birdeye_googleUrl', true) ? get_post_meta(get_the_ID(), 'birdeye_googleUrl', true) : null;
	$birdeye_address1 = (get_post_meta(get_the_ID(), 'birdeye_address1', true)) ? get_post_meta(get_the_ID(), 'birdeye_address1', true) : null;
	$birdeye_address2 = (get_post_meta(get_the_ID(), 'birdeye_address2', true)) ? ', ' . get_post_meta(get_the_ID(), 'birdeye_address2', true) : null;
	$birdeye_city = get_post_meta(get_the_ID(), 'birdeye_city', true) ? get_post_meta(get_the_ID(), 'birdeye_city', true) : null;
	$birdeye_state = get_post_meta(get_the_ID(), 'birdeye_state', true) ? get_post_meta(get_the_ID(), 'birdeye_state', true) : null;
	$birdeye_zip = get_post_meta(get_the_ID(), 'birdeye_zip', true) ? get_post_meta(get_the_ID(), 'birdeye_zip', true) : null;
	$birdeye_countryCode = get_post_meta(get_the_ID(), 'birdeye_countryCode', true) ? get_post_meta(get_the_ID(), 'birdeye_countryCode', true) : null;
	$birdeye_lat = get_post_meta(get_the_ID(), 'birdeye_lat', true) ? get_post_meta(get_the_ID(), 'birdeye_lat', true) : null;
	$birdeye_lng = get_post_meta(get_the_ID(), 'birdeye_lng', true) ? get_post_meta(get_the_ID(), 'birdeye_lng', true) : null;
	$workingHours = get_post_meta(get_the_ID(), 'workingHours', true) ? get_post_meta(get_the_ID(), 'workingHours', true) : null;
	$schema_paymentaccepted = get_field('alrv_dynamic_schema_paymentaccepted', 'options');

	if (have_rows('alrv_dynamic_schema_sameas', 'options')) {
		$link_url = [];
		while (have_rows('alrv_dynamic_schema_sameas', 'options')) {
			the_row();
			$social_link = get_sub_field('alrv_dynamic_schema_social_media_links');
			$link_url[] = $social_link['url'];
		}
	}

	$dayOfWeekMap = [
		0 => 'https://schema.org/Monday',
		1 => 'https://schema.org/Tuesday',
		2 => 'https://schema.org/Wednesday',
		3 => 'https://schema.org/Thursday',
		4 => 'https://schema.org/Friday',
		5 => 'https://schema.org/Saturday',
		6 => 'https://schema.org/Sunday',
	];

	$openingHoursSpecification = [];

	foreach ($birdeye_hoursOfOperations as $operation) {
		if ($operation->isOpen) {
			foreach ($operation->workingHours as $hours) {
				$openingHoursSpecification[] = [
					'@type' => 'OpeningHoursSpecification',
					'dayOfWeek' => $dayOfWeekMap[$operation->day],
					'opens' => $hours->startHour,
					'closes' => $hours->endHour,
				];
			}
		}
	}

	if (is_array($schema)) {
		if (!empty($title)) {
			$schema['name'] = $title;
		}
		if (!empty($description)) {
			$schema['description'] = $description;
		}
		if (!empty($thumbnail_id)) {
			$schema['image'] = $image_object;
		}
		if (!empty($birdeye_phone)) {
			$schema['telephone'] = $birdeye_phone;
		}
		if (!empty($birdeye_googleUrl)) {
			$schema['hasMap'] = $birdeye_googleUrl;
		}
		if (!empty($schema_paymentaccepted)) {
			$schema['paymentAccepted'] = $schema_paymentaccepted;
		}
		if (!empty($link_url)) {
			$schema['sameAs'] = $link_url;
		}
		if (!empty($birdeye_address1) || !empty($birdeye_city) || !empty($birdeye_state) || !empty($birdeye_zip) || !empty($birdeye_countryCode)) {
			$schema['address'] = [
				'@type' => 'PostalAddress',
				'streetAddress' => $birdeye_address1 . '' . $birdeye_address2,
				'addressLocality' => $birdeye_city,
				'addressRegion' => $birdeye_state,
				'postalCode' => $birdeye_zip,
				'addressCountry' => $birdeye_countryCode
			];
		}
		if (!empty($birdeye_lat) || !empty($birdeye_lng)) {
			$schema['geo'] = [
				'@type' => 'GeoCoordinates',
				'latitude' => $birdeye_lat,
				'longitude' => $birdeye_lng
			];
		}
		if (!empty($openingHoursSpecification)) {
			$schema['openingHoursSpecification'] = $openingHoursSpecification;
		}
	}
	return $schema;
}

// To excute this function when we edit and add new location page
function custom_location_admin_init()
{
	global $typenow;

	// Check if the current post type is 'location'
	if ($typenow === 'location') {

		dspl_location_func();
	}
}
add_action('load-edit.php', 'custom_location_admin_init');
add_action('load-post-new.php', 'custom_location_admin_init');

// To check wp_location_meta table in database, if not exist create table & store location field value.
function dspl_location_func()
{

	global $wpdb;

	$table_name = $wpdb->prefix . 'location_meta';

	$table_exists = $wpdb->get_var("SHOW TABLES LIKE '$table_name'") == $table_name;

	if (!$table_exists) {
		$charset_collate = $wpdb->get_charset_collate();

		$sql = "CREATE TABLE $table_name (
	        ID INT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
	        zipcode VARCHAR(10) NOT NULL,
	        lat DECIMAL(10, 8) NOT NULL,
	        lng DECIMAL(11, 8) NOT NULL,
	        state VARCHAR(100) NOT NULL,
	        city VARCHAR(100) NOT NULL,
	        PRIMARY KEY (ID),
	        UNIQUE KEY zipcode (zipcode)
	    ) $charset_collate;";

		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

		dbDelta($sql);

		if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") == $table_name) {
			// error_log("Table $table_name created successfully.");
			$args = array(
				'post_type' => 'location',
				'posts_per_page' => -1,
			);

			$query = new WP_Query($args);

			if ($query->have_posts()) {
				global $wpdb;

				while ($query->have_posts()) {
					$query->the_post();
					$pID = get_the_ID();

					$city = (get_post_meta($pID, 'birdeye_city', true)) ? get_post_meta($pID, 'birdeye_city', true) : null;
					$state = (get_post_meta($pID, 'birdeye_state', true)) ? get_post_meta($pID, 'birdeye_state', true) : null;
					$zip = (get_post_meta($pID, 'birdeye_zip', true)) ? get_post_meta($pID, 'birdeye_zip', true) : null;
					$lat = (get_post_meta($pID, 'birdeye_lat', true)) ? get_post_meta($pID, 'birdeye_lat', true) : null;
					$lng = (get_post_meta($pID, 'birdeye_lng', true)) ? get_post_meta($pID, 'birdeye_lng', true) : null;

					$table_name = $wpdb->prefix . 'location_meta';
					$result = $wpdb->insert(
						$table_name,
						array(
							'zipcode' => $zip,
							'lat' => $lat,
							'lng' => $lng,
							'state' => $state,
							'city' => $city
						)
					);

				}
				wp_reset_postdata();
			}
		} else {
			// error_log("Failed to create table $table_name.");
		}
	} else {

		$args = array(
			'post_type' => 'location',
			'posts_per_page' => -1,
		);

		$query = new WP_Query($args);

		if ($query->have_posts()) {
			global $wpdb;

			while ($query->have_posts()) {
				$query->the_post();
				$pID = get_the_ID();

				$city = (get_post_meta($pID, 'birdeye_city', true)) ? get_post_meta($pID, 'birdeye_city', true) : null;
				$state = (get_post_meta($pID, 'birdeye_state', true)) ? get_post_meta($pID, 'birdeye_state', true) : null;
				$zip = (get_post_meta($pID, 'birdeye_zip', true)) ? get_post_meta($pID, 'birdeye_zip', true) : null;
				$lat = (get_post_meta($pID, 'birdeye_lat', true)) ? get_post_meta($pID, 'birdeye_lat', true) : null;
				$lng = (get_post_meta($pID, 'birdeye_lng', true)) ? get_post_meta($pID, 'birdeye_lng', true) : null;

				$table_name = $wpdb->prefix . 'location_meta';

				// Check if record already exists
				$existing_record = $wpdb->get_results(
					$wpdb->prepare(
						"SELECT * FROM $table_name WHERE zipcode = %s AND lat = %s AND lng = %s AND state = %s AND city = %s",
						$zip,
						$lat,
						$lng,
						$state,
						$city
					)
				);

				// If no matching record found, insert new record
				if (empty($existing_record)) {
					$result = $wpdb->insert(
						$table_name,
						array(
							'zipcode' => $zip,
							'lat' => $lat,
							'lng' => $lng,
							'state' => $state,
							'city' => $city
						)
					);
				}
			}
			wp_reset_postdata();
		}
		// error_log("Table $table_name already exists.");
	}
}

// Get geocode value from the Google API based on ZIPCODE
function get_geocode_api_data($zcode)
{
	global $wpdb;

	$curl = curl_init();
	// 45230 45201 45205 90011

	// Set cURL options
	curl_setopt_array(
		$curl,
		array(
			CURLOPT_URL => 'https://maps.googleapis.com/maps/api/geocode/json?address=' . $zcode . '&key=AIzaSyChwuh017ddDzFy8AWK9wnAHCbYJgTCIrw',
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'GET',
		)
	);

	$response = curl_exec($curl);

	curl_close($curl);

	$response = json_decode($response);

	if ($response->status == 'OK') {
		$sec_ast = count($response->results[0]->address_components) - 2;

		$global_state = $response->results[0]->address_components[$sec_ast]->long_name;
		$def_lat = $response->results[0]->geometry->location->lat;
		$def_long = $response->results[0]->geometry->location->lng;
		$state_short_name = $response->results[0]->address_components[$sec_ast]->short_name;
		$components = $response->results[0]->address_components;
		$city_name = "";
		foreach ($components as $city_component) {
			if (in_array("locality", $city_component->types)) {
				$city_name = $city_component->short_name;
				break;
			} elseif (in_array("neighborhood", $city_component->types)) {
				$city_name = $city_component->short_name;
				break;
			}
		}

		$table_name = $wpdb->prefix . 'location_meta';

		$result = $wpdb->insert(
			$table_name,
			array(
				'zipcode' => $zcode,
				'lat' => $def_lat,
				'lng' => $def_long,
				'state' => $state_short_name,
				'city' => $city_name
			)
		);

		return array(
			'latitude' => $def_lat,
			'longitude' => $def_long,
			'state' => $global_state,
		);
	} else {
		return false;
	}
}

// Get location values from the local database
function retrieve_location_db_data($zcode)
{
	global $wpdb;
	$table_name = $wpdb->prefix . 'location_meta';
	$location_query = $wpdb->prepare("SELECT * FROM $table_name WHERE zipcode = %s", $zcode);
	$location_results = $wpdb->get_results($location_query);

	if (!empty($location_results)) {

		$db_lat = $location_results[0]->lat;
		$db_long = $location_results[0]->lng;
		$db_state = $location_results[0]->state;

		return array(
			'latitude' => $db_lat,
			'longitude' => $db_long,
			'state' => $db_state,
		);
	} else {
		return false; // No results found for the given zipcode
	}
}

// Update provider as per selection of State/City.
// add_action('save_post', 'update_location_meta_on_provider_save', 10, 3);
function update_location_meta_on_provider_save($post_id, $post, $update)
{
	if ($post->post_type !== 'provider') {
		return;
	}
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return;
	}
	if (wp_is_post_revision($post_id) || wp_is_post_autosave($post_id)) {
		return;
	}

	// Get the assigned 'Cities' and 'States' terms for the Provider (current selection)
	$current_cities = wp_get_post_terms($post_id, 'location-city', ['fields' => 'ids']);
	$current_states = wp_get_post_terms($post_id, 'location-state', ['fields' => 'ids']);

	// Get the previously assigned 'Cities' and 'States' terms for the Provider (before saving)
	$previous_cities = get_post_meta($post_id, '_previous_location_cities', true) ?: [];
	$previous_states = get_post_meta($post_id, '_previous_location_states', true) ?: [];

	// Store the current terms as the "previous" ones for future comparison
	update_post_meta($post_id, '_previous_location_cities', $current_cities);
	update_post_meta($post_id, '_previous_location_states', $current_states);

	$locations = get_posts([
		'post_type' => 'location',
		'post_status' => 'publish',
		'tax_query' => [
			'relation' => 'AND',
			[
				'taxonomy' => 'location-city',
				'field' => 'term_id',
				'terms' => $current_cities,
			],
			[
				'taxonomy' => 'location-state',
				'field' => 'term_id',
				'terms' => $current_states,
			],
		],
		'fields' => 'ids', // We only need the IDs
		'numberposts' => -1,
	]);

	// Handle the removal of the provider from locations where the city or state is unselected
	$removed_cities = array_diff($previous_cities, $current_cities);
	$removed_states = array_diff($previous_states, $current_states);

	if (!empty($removed_cities) || !empty($removed_states)) {
		$locations_to_remove = get_posts([
			'post_type' => 'location',
			'post_status' => 'publish',
			'tax_query' => [
				'relation' => 'AND',
				[
					'taxonomy' => 'location-city',
					'field' => 'term_id',
					'terms' => $removed_cities,
				],
				[
					'taxonomy' => 'location-state',
					'field' => 'term_id',
					'terms' => $removed_states,
				],
			],
			'fields' => 'ids',
			'numberposts' => -1,
		]);

		foreach ($locations_to_remove as $location_id) {
			$existing_providers = get_post_meta($location_id, 'alrv_slo_providers_on_location', true) ?: [];

			$existing_providers = array_diff($existing_providers, [$post_id]);

			update_post_meta($location_id, 'alrv_slo_providers_on_location', $existing_providers);
		}
	}

	// Update the Provider meta field for each matching Location for the current cities and states
	foreach ($locations as $location_id) {
		$existing_providers = get_post_meta($location_id, 'alrv_slo_providers_on_location', true) ?: [];

		if (!in_array($post_id, $existing_providers)) {
			$existing_providers[] = $post_id;
		}

		update_post_meta($location_id, 'alrv_slo_providers_on_location', $existing_providers);
	}
}

/**
 * Stops the Imagify payment modal from printing which
 * calls the slow imagify_count_attachments function
 * that slows down the wp-admin.
 */
function disable_slow_imagify_payment_modal()
{
	if (class_exists('\\Imagify_Views') && method_exists('\\Imagify_Views', 'get_instance')) {
		$imagify_views = \Imagify_Views::get_instance();
		remove_action('admin_footer', [$imagify_views, 'print_modal_payment']);
	}
}
add_action('admin_footer', 'disable_slow_imagify_payment_modal', 5);


// Not to show archived posts on frontend. [ Due to this code, draft and private display pulically so commented ]
/*function exclude_archived_posts( $query ) {
    if ( ! is_admin() && $query->is_main_query() ) {
        // Get all post statuses and exclude "archive"
        $post_status = get_post_stati(); // get all status
        $post_status = array_diff( $post_status, array( 'archive' ) ); //exclude archive

        // Apply only to specific post types: posts, pages, CPTs
        $query->set( 'post_status', $post_status );
        $query->set( 'post_type', array( 'post', 'page' ) + get_post_types( array( 'public' => true, '_builtin' => false ) ) );
    }
}
add_action( 'pre_get_posts', 'exclude_archived_posts' );
*/



// Only show published posts on frontend from condition CPT
function filter_acf_post_object($value, $post_id, $field)
{
	if (is_array($value)) {
		return array_filter($value, function ($post) {
			return get_post_status($post) === 'publish'; // Only include published posts
		});
	}
	return $value;
}
add_filter('acf/load_value/name=alrv_slo_conditions_on_location', 'filter_acf_post_object', 10, 3);

// Use the function location by the provider
function get_provider_by_location_id($loc_ID)
{

	$args = array(
		'post_type' => 'provider',
		'post_status' => 'publish',
		// 'orderby'        => 'menu_order',
		'order' => 'ASC',
		'meta_query' => array(
			array(
				'key' => 'alrv_spo_location_on_providers',
				'value' => '"' . $loc_ID . '"',
				'compare' => 'LIKE',
			),
		),
		'fields' => 'ids',
	);

	$provider_query = new WP_Query($args);

	if ($provider_query->have_posts()) {
		return $provider_query->posts;
	}
	wp_reset_postdata();
}

function fetch_all_locations()
{
	$log_file = WP_CONTENT_DIR . '/uploads/brideye_location_cron.txt';
	$log_data = "======== Fetch Start Time " . date('d F Y, H:i:s') . " ========\n";

	$location_args = array(
		'post_type' => 'location',
		'post_status' => 'publish',
		'posts_per_page' => '-1',
		'order' => 'ASC',
		'meta_query' => array(
			array(
				'key' => 'alrv_slo_birdeye_location_id',
				'value' => '',
				'compare' => '!=',
			),
		),
		'fields' => 'ids',
	);
	$fetch_qry = new WP_Query($location_args);

	if ($fetch_qry->have_posts()) {
		//  $count = 1;
		foreach ($fetch_qry->posts as $locID) {
			// echo $locID;
			$brideyeID = get_field('alrv_slo_birdeye_location_id', $locID);
			// echo $brideyeID;
			// $count++;
			if (empty($brideyeID)) {
				$log_data .= "Post ID $locID has empty Birdeye ID.\n";
				continue;
			}
			$request_url = 'https://api.birdeye.com/resources/v1/business/' . $brideyeID . '?api_key=XZEFID5efK1ieD6xWQpn2g8f8fe4qYYX';

			$response = wp_remote_get($request_url, array(
				'headers' => array(
					'Content-Type' => 'application/json',
					'Accept' => 'application/json',
				),
			));

			if (is_wp_error($response)) {
				$log_data .= "API ERROR for Post ID $locID: " . $response->get_error_message() . "\n";
				continue;
			}

			$body = wp_remote_retrieve_body($response);
			$data = json_decode($body);

			if (!$data) {
				$log_data .= "Invalid JSON for Post ID $locID.\n";
				continue;
			}

			// Extract values safely
			$alias = $data->alias ?? '';
			$name = $data->name ?? '';
			$coverImageUrl = $data->coverImageUrl ?? '';
			$phone = $data->phone ?? '';
			$lat = $data->location->lat ?? '';
			$lng = $data->location->lng ?? '';
			$address1 = $data->location->address1 ?? '';
			$address2 = $data->location->address2 ?? '';
			$city = $data->location->city ?? '';
			$state = $data->location->state ?? '';
			$zip = $data->location->zip ?? '';
			$countryCode = $data->location->countryCode ?? '';
			$googleUrl = $data->socialProfileURLs->googleUrl ?? '';
			$hoursOfOperations = $data->hoursOfOperations ?? '';

			$full_address = trim(implode(' ', array_filter([$address1, $address2, $city, $state, $zip, $countryCode])));

			// Update post meta
			update_post_meta($locID, 'birdeye_alias', $alias);
			update_post_meta($locID, 'birdeye_name', $name);
			update_post_meta($locID, 'birdeye_coverImageUrl', $coverImageUrl);
			update_post_meta($locID, 'birdeye_phone', $phone);
			update_post_meta($locID, 'birdeye_lat', $lat);
			update_post_meta($locID, 'birdeye_lng', $lng);
			update_post_meta($locID, 'birdeye_address1', $address1);
			update_post_meta($locID, 'birdeye_address2', $address2);
			update_post_meta($locID, 'birdeye_city', $city);
			update_post_meta($locID, 'birdeye_state', $state);
			update_post_meta($locID, 'birdeye_zip', $zip);
			update_post_meta($locID, 'birdeye_countryCode', $countryCode);
			update_post_meta($locID, 'birdeye_full_address', $full_address);
			update_post_meta($locID, 'birdeye_googleUrl', $googleUrl);
			update_post_meta($locID, 'birdeye_hoursOfOperations', $hoursOfOperations);

			$log_data .= html_entity_decode(get_the_title($locID)) . ":- " . $locID . "\n";
		}

		update_option('birdeye-last-save-date', date('d F Y, H:i:s'));
	} else {
		$log_data .= "No posts found to update.\n";
	}

	wp_reset_postdata();
	$log_data .= "======== Fetch End Time " . date('d F Y, H:i:s') . " ========\n";
	file_put_contents($log_file, $log_data . "\n", FILE_APPEND);
}

/** ITEMS FOR ACTION SCHEDULER EXTENDER PLUGIN  */
/**
 * hook to attach to action scheduler - BirdEye Locations
 */
function action_scheduler_birdeye_locations_fetch()
{
	// Instead of a single API call, process all pages
	fetch_all_locations();
}
add_action('birdeye_locations_fetch', 'action_scheduler_birdeye_locations_fetch', 10, 0);
// add_action('init', 'action_scheduler_birdeye_locations_fetch', 10, 0);

/**
 * add new birdeye locations hook to allowable action scheduler extender hooks
 */
function add_birdeye_locations_api_hooks($allow_hooks)
{

	$allow_hooks = array(
		'birdeye_locations_fetch', //add as many new hooks as you need to for each scheduled function
	);
	return $allow_hooks;
}

/**
 * add hooks for plugin UI use after theme init
 */
function add_gsx_plugin_hooks()
{
	if (has_filter('gsx_allow_hooks')):
		add_filter('gsx_allow_hooks', 'add_birdeye_locations_api_hooks', 10, 1); // add new filter to use functions in ACF fields
		$allowed_hooks = apply_filters('gsx_allow_hooks', array());
		return $allowed_hooks;
	endif;
}
add_filter('after_setup_theme', 'add_gsx_plugin_hooks');

// Update closure manual ACF field as per selection of State/City.
add_action('save_post', 'location_assign_closure_blk', 10, 3);
function location_assign_closure_blk($post_id, $post, $update)
{
	if ($post->post_type !== 'closure') {
		return;
	}
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return;
	}
	if (wp_is_post_revision($post_id) || wp_is_post_autosave($post_id)) {
		return;
	}

	$cl_option = get_field('alrv_cpt_cl_auto_manual', $post_id);
	$cl_state = get_field('alrv_cpt_cl_state', $post_id);
	$cl_city = get_field('alrv_cpt_cl_city', $post_id);

	if ($cl_option == 'auto' && empty($cl_state) && empty($cl_city)) {
		update_post_meta($post_id, 'alrv_cpt_cl_slct_location_auto', '');
		return;
	}

	if ($cl_option == 'auto') {
		$tax_query = array();
		// If state selected
		if (!empty($cl_state)) {
			$tax_query[] = array(
				'taxonomy' => 'location-state',
				'field' => 'term_id',
				'terms' => $cl_state,
				'operator' => 'IN',
			);
		}

		// If city selected
		if (!empty($cl_city)) {
			$tax_query[] = array(
				'taxonomy' => 'location-city',
				'field' => 'term_id',
				'terms' => $cl_city,
				'operator' => 'IN',
			);
		}

		// Add relation only if BOTH filters exist
		if (count($tax_query) > 1) {
			$tax_query['relation'] = 'OR';   // OR use 'OR' if you prefer
		}

		$loc_args = array(
			'post_type' => 'location',
			'post_status' => 'publish',
			'posts_per_page' => -1,
		);

		// only add tax_query if something exists
		if (!empty($tax_query)) {
			$loc_args['tax_query'] = $tax_query;
		}

		$loc_qry = new WP_Query($loc_args);
		$loction = [];
		if ($loc_qry->have_posts()) {
			while ($loc_qry->have_posts()) {
				$loc_qry->the_post();
				$loc_id = get_the_ID();
				$loc_id_str = strval($loc_id);
				$loction[] = $loc_id_str;
			}
		}
		wp_reset_postdata();

		if (!empty($loction) && is_array($loction)) {
			update_post_meta($post_id, 'alrv_cpt_cl_slct_location_auto', $loction);
		}
		// update_field( $field_name, $new_related_posts, $post_id_to_update );
	}

}


/*
 *   CPT : Clinic Closure
 *	Description : Disable "View Clinic Closure" Link in admin bar screen.  
 *   Edit Page: http://allervie.local/wp-admin/post.php?post=9817&action=edit
 */

add_action('admin_bar_menu', function ($wp_admin_bar) {

	if (!is_admin()) {
		return;
	}

	$screen = get_current_screen();
	if (empty($screen->post_type) || $screen->post_type !== 'closure') {
		return;
	}

	$view_node = $wp_admin_bar->get_node('view');
	if (!$view_node) {
		return;
	}

	$wp_admin_bar->remove_node('view');

	$wp_admin_bar->add_node([
		'id' => 'view',
		'title' => '<span style="opacity:0.9; cursor:default;">' . esc_html($view_node->title) . '</span>',
	]);

}, 999);


/*
 *   CPT : Clinic Closure
 *	Description : Display Date "Day" using javascript.  
 *   Edit Page: http://allervie.local/wp-admin/post.php?post=9817&action=edit
 */

add_action('acf/input/admin_footer', function () {

	$screen = get_current_screen();
	if (empty($screen->post_type) || $screen->post_type !== 'closure') {
		return;
	}
	?>
	<script>
		jQuery(function ($) {
			// console.log("Script loaded!");
			function addDayMessage($wrapper) {

				const textInput = $wrapper.find('input.hasDatepicker');

				if (!textInput.length) {
					console.log("Date input not found in wrapper:", $wrapper);
					return;
				}

				function showDay() {

					let dateVal = textInput.val().trim();
					$wrapper.find('.acf-date-day-message').remove();

					if (!dateVal) return;

					let dateObj = null;

					// Format MM-DD-YYYY
					if (/^\d{2}-\d{2}-\d{4}$/.test(dateVal)) {
						let [m, d, y] = dateVal.split('-');
						dateObj = new Date(`${y}-${m}-${d}`);
					}

					// Format YYYYMMDD (hidden)
					if (/^\d{8}$/.test(dateVal)) {
						let y = dateVal.slice(0, 4);
						let m = dateVal.slice(4, 6);
						let d = dateVal.slice(6, 8);
						dateObj = new Date(`${y}-${m}-${d}`);
					}

					if (!dateObj || isNaN(dateObj.getTime())) return;

					const dayName = dateObj.toLocaleDateString('en-US', { weekday: 'long' });

					$wrapper.append(`<div class="acf-date-day-message"style="margin-top:6px;color:#333;">Day: ${dayName}</div>`);
				}

				setTimeout(showDay, 200);
				textInput.on('change keyup blur', showDay);
			}

			// FIRE ONLY WHEN DATE FIELD IS READY IN DOM
			acf.addAction('load_field/type=date_picker', function (field) {
				const key = field.data.key;
				if (key === 'field_6901f7eb1b9d7' || key === 'field_6901f8021b9d8') {
					// console.log("Date field loaded:", key);
					const wrapper = field.$el;
					addDayMessage(wrapper);
				}
			});

		});
	</script>
	<?php
});


/*
 *   CPT : Clinic Closure
 *	Description : Get the toggle value from database and display message below toggle
 *   Edit Page: http://allervie.local/wp-admin/post.php?post=9817&action=edit
 */

add_action('acf/input/admin_footer', function () {
	$screen = get_current_screen();
	if (!$screen)
		return;

	if ($screen->post_type !== 'closure') {
		return;
	}

	$post_id = 0;

	if (isset($_GET['post'])) {
		$post_id = (int) $_GET['post']; // Edit screen
	}

	$value = "";
	if ($post_id) {
		$value = get_post_meta($post_id, 'alrv_cpt_cl_auto_manual', true);
	}
	?>

	<script>
		document.addEventListener('DOMContentLoaded', function () {

			const metaValue = "<?php echo esc_js($value); ?>";
			// console.log("Loaded Meta Value:", metaValue);

			if (!metaValue) return;

			setTimeout(function () {

				const fieldWrapper = document.querySelector('[data-name="alrv_cpt_cl_auto_manual"]');

				if (fieldWrapper) {
					let msg = document.createElement("div");
					let messageText = "";

					msg.style.marginTop = "10px";
					msg.style.padding = "10px";
					// msg.style.background = "#e8f6ff";
					// msg.style.border = "1px solid #bce0ff";
					msg.style.borderRadius = "5px";

					if (metaValue == "1") {
						messageText = "The closure is saved as “Auto.”";
					} else if (metaValue == "0") {
						messageText = "The closure is saved as “Manual.”";
					} else {
						return; // no valid value → no message
					}

					msg.innerHTML = messageText;

					fieldWrapper.appendChild(msg);
				}

			}, 500);
		});
	</script>
	<?php
});


/**
 * CPT : Closure
 * Description : Manage Custom Column (Start Date, End Date, Status)
 * URL : http://allervie.local/wp-admin/edit.php?post_type=closure&mode=list
 */


add_filter('manage_closure_posts_columns', 'set_custom_edit_closure_columns', 20);
function set_custom_edit_closure_columns($columns)
{
	unset($columns['date']);
	$columns['alrv_cpt_cl_start_dt'] = "Start Date";
	$columns['alrv_cpt_cl_end_dt'] = "End Date";
	$columns['alrv_cpt_cl_auto_manual'] = "Location Type";
	$columns['date'] = "Date";

	unset($columns['template']);
	return $columns;
}

add_action('manage_closure_posts_custom_column', 'custom_closure_column', 10, 3);
function custom_closure_column($column, $post_id)
{
	switch ($column) {
		case 'alrv_cpt_cl_start_dt':
			if (!empty(get_post_meta($post_id, 'alrv_cpt_cl_start_dt', true))) {
				$startdate_object = DateTime::createFromFormat('Ymd', get_post_meta($post_id, 'alrv_cpt_cl_start_dt', true));
				echo $startdate_object->format('m-d-Y');
			} else {
				echo "-";
			}
			break;

		case 'alrv_cpt_cl_end_dt':
			if (!empty(get_post_meta($post_id, 'alrv_cpt_cl_end_dt', true))) {
				$enddate_object = DateTime::createFromFormat('Ymd', get_post_meta($post_id, 'alrv_cpt_cl_end_dt', true));
				echo $enddate_object->format('m-d-Y');
			} else {
				echo "-";
			}
			break;

		case 'alrv_cpt_cl_auto_manual':
			$status = get_post_meta($post_id, 'alrv_cpt_cl_auto_manual', true);
			if ($status == "1") {
				$status = "Auto";
				$state = get_post_meta($post_id, 'alrv_cpt_cl_state', true);
				$city = get_post_meta($post_id, 'alrv_cpt_cl_city', true);
				if (!empty($state)) {
					$status .= '<br/>state:';
					foreach ($state as $st_id) {
						$stTerm = get_term_by('id', $st_id, 'location-state');
						$status .= ' ' . $stTerm->name;
					}
				}
				if (!empty($city)) {
					$status .= '<br/>city:';
					foreach ($city as $ct_id) {
						$ctTerm = get_term_by('id', $ct_id, 'location-city');
						$status .= ' ' . $ctTerm->name;
					}
				}

			} elseif ($status == "0") {
				$status = "Manual";
			} else {
				$status = "-";
			}
			echo $status;
			break;
	}
}
