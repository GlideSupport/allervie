<?php
/**
 * Template Name: Provider List
 * Template Post Type: page
 *
 * This template is for displaying blog page.
 *
 * @link https://developer.wordpress.org/themes/template-files-section/page-template-files/
 *
 * @package Allervie
 * @since 1.0.0
 */
get_header();
 
$pro_args = array(
	'post_type' => 'provider',
	'post_status'    => 'publish',
	'posts_per_page' => '-1',
	'order' => 'ASC'
);

$provider_qry = new WP_Query($pro_args);
$provide_num = 1;
if($provider_qry->have_posts()) {
	?>
	<table>
		<thead>
			<tr>
				<!-- <th>No.</th> -->
				<th>Provider ID</th>
				<th>Provider Name</th>
				<th>Location Name</th>
				<th>Provider State</th>
				<th>Provider City</th>
				<th>Provider Link</th>
            </tr>
        </thead>
	<?php
	while($provider_qry->have_posts()) {
	    $provider_qry->the_post();
	   	$provider_id = get_the_ID();

		// Get taxonomy terms
        $state_terms = get_the_terms($provider_id, 'location-state');
        $city_terms  = get_the_terms($provider_id, 'location-city');
        $state_names = (!is_wp_error($state_terms) && !empty($state_terms)) 
            ? implode(', ', wp_list_pluck($state_terms, 'name')) 
            : '—';

        $city_names = (!is_wp_error($city_terms) && !empty($city_terms)) 
            ? implode(', ', wp_list_pluck($city_terms, 'name')) 
            : '—';

	    $locations = get_field('alrv_spo_location_on_providers', $provider_id);
		if (!empty($locations) && is_array($locations)) {
			// Remove duplicate IDs first
			$unique_locations = array_unique($locations);

			$location_names = array_map(function($loc_id) {
				return get_the_title($loc_id);
			}, $unique_locations);
			$location_names = array_unique($location_names);
			$locations_names = implode(', ', $location_names);
		} else {
			$locations_names = '—';
		}
        echo "<tr>";
			// echo "<td>$provide_num</td>";
			echo "<td>$provider_id</td>";
			echo "<td>".get_the_title()."</td>";
			echo "<td>$locations_names</td>";
			echo "<td>$state_names</td>";
			echo "<td>$city_names</td>";
         	echo '<td><a href="' . get_permalink() . '">' . get_permalink() . '</a></td>';
        echo "</tr>";
        $provide_num++;
	}
	?>
	</table>
	<?php
}
wp_reset_postdata();

get_footer();
