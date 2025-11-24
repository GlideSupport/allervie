<?php
/**
 * Template Name: Location List
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

$loca_args = array(
	'post_type' => 'location',
	'post_status'    => 'publish',
	'posts_per_page' => '-1',
	'order' => 'ASC'
);

$location_qry = new WP_Query($loca_args);
$loca_num = 1;
if($location_qry->have_posts()) {
	?>
	<table>
		<thead>
			<tr>
				<th>Location ID</th>
				<th>Location Name</th>
				<th>Provider Name</th>
				<th>location Link</th>
            </tr>
        </thead>
	<?php
	while($location_qry->have_posts()) {
	    $location_qry->the_post();
	   	$location_id = get_the_ID();

	    $providers = get_field('alrv_slo_providers_on_location', $location_id);

		if (!empty($providers) && is_array($providers)) {
			// Remove duplicate IDs first
			$unique_providers = array_unique($providers);

			// Get provider post titles
			$provider_names = array_map(function($prov_id) {
				return get_the_title($prov_id);
			}, $unique_providers);

			// Optional: Remove duplicate names (if needed)
			$provider_names = array_unique($provider_names);

			// Convert to comma-separated string
			$providers_names = implode('; ', $provider_names);
		} else {
			$providers_names = '—';
		}
        echo "<tr>";
			// echo "<td>$provide_num</td>";
			echo "<td>$location_id</td>";
			echo "<td>".get_the_title()."</td>";
			echo "<td>$providers_names</td>";
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
 