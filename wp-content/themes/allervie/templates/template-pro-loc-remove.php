<?php
/**
 * Template Name: Provide and location remove
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

$paged = isset($_REQUEST['pages']) ? $_REQUEST['pages'] : 1;
$per_paged = isset($_GET['per_paged']) ? $_GET['per_paged'] : 10;
$location_empty = isset($_GET['location_empty']) ? $_GET['location_empty'] : 'false';

// use GET veriable for the action perfromed.
$action_per = isset($_GET['action_per']) ? $_GET['action_per'] :'';

if(empty($action_per)){
	echo "==Assign the location in provider and unassign State and City form provider==<br>action_per=provide_add_loc<br>&per_paged=3<br>&loca_up_id=location_id(2035)";
	echo "<br>==Remove the provide on the 'ACF'location==<br>action_per=location_rm_pro&<br>per_paged=3<br>&pro_up_id=provider_id(1700)";
}

// Assign the location in provider.
if(!empty($action_per) && $action_per == 'provide_add_loc'){
	$pro_loc_args = array(
		'post_type' => 'location',
		'posts_per_page' => $per_paged,
        'post_status'    => 'publish',
		'paged'          => $paged,
		'order' => 'ASC'
     );

    $pro_add_loc = new WP_Query($pro_loc_args);
	$pro_add_found = $pro_add_loc->found_posts; //(75)
	$pro_add_max = $pro_add_loc->max_num_pages;
  
    if($pro_add_max >= $paged ){
		if($pro_add_loc->have_posts()) {
			while($pro_add_loc->have_posts()) {
				$pro_add_loc->the_post();
				echo "========<br>";
				$location_id = get_the_ID(); 
				echo $location_id . ' - ' . get_the_title();
				echo "<br>";

				// fetching the location
				$provide_post_sle = get_field('alrv_slo_providers_on_location', $location_id);
				
				foreach($provide_post_sle as $provide_sle_id){
					
					// $existing_locations = get_field('alrv_spo_location_on_providers', $provide_sle_id);
					// $existing_locations = is_array($existing_locations) ? $existing_locations : [];
					// 
					// $existing_location[] = $location_id;
					// $existing_location1 = array(); 

					// Get existing assigned locations
					// $existing_location = get_post_meta($provider_assign[0], 'alrv_spo_location_on_providers', true);
					// $existing_location = is_array($existing_location) ? $existing_location : [];
					
					// // Add current location if not already added
					// if (!in_array($location_id, $existing_location)) {
					//     $existing_location[] = $location_id;
					// }

					// Added provider on the location.
					// $update_res = update_field('alrv_spo_location_on_providers', $existing_location1, $provide_sle_id);

					// if($update_res){
					// 	echo "Assign the location this provider: $provide_sle_id <br>";
					// }else {
					// 	echo "Already Assign the location this provider: $provide_sle_id <br>";
					// }

					// Add location if not already added
					// if($location_empty == 'true'){
					// 	$existing_locations = array();
					// 	$updated = update_field('alrv_spo_location_on_providers', $existing_locations, $provide_sle_id);
					// }else {
					// 	if (!in_array($location_id, $existing_locations)) {

					// 		$existing_locations[] = $location_id;

					// 		// Update provider field with the new list location
					// 		$updated = update_field('alrv_spo_location_on_providers', $existing_locations, $provide_sle_id);

					// 		if($updated){
					// 			echo "Assigned location to provider: $provide_sle_id<br>";
					// 		}else{
					// 			echo "Location already assigned or failed: $provide_sle_id<br>";
					// 		}
					// 	} else {
					// 		echo "Location already exists for provider: $provide_sle_id<br>";
					// 	}
				    // }

					// Remove the state and city form the provider
					echo "+===Start Remove State and City form provider===+<br>";
					$term_slugs = array();
					$state_result = wp_set_post_terms($provide_sle_id, $term_slugs, 'location-state', false);
					$city_result = wp_set_post_terms($provide_sle_id, $term_slugs, 'location-city', false);

					if (is_wp_error($state_result)) {
						echo "<br>Term assigned to Post ID: $provide_sle_id<br>";
						echo "<br>Failed to assign term. Error: " . $state_result->get_error_message()."<br>";
					}else {
						echo "Remove the <strong>".get_the_title($provide_sle_id)."</strong> State :$provide_sle_id<br>";
					}
					if (is_wp_error($city_result)) {
						echo "<br>Term assigned to Post ID: $provide_sle_id<br>";
						echo "<br>Failed to assign term. Error: " . $city_result->get_error_message()."<br>";
					}else {
						echo "Remove the <strong>".get_the_title($provide_sle_id)."</strong> City :$provide_sle_id<br>";
					}
					echo "+===End Remove State and City Form Provider ===+<br>";
					echo "========<br>";
				}
				echo "========<br>";
			}
		}
        
        // if per page so not refresh automatcally
		if(!isset($_GET['per_paged'])){
			sleep(20);
			$paged++;
			$reloadLocation = site_url('/provider-and-location-remove/').'?action_per=provide_add_loc&pages='.$paged;
			?>
			<script>
				document.addEventListener("DOMContentLoaded", () => {
					setTimeout(function(){
						window.location.href = '<?php echo $reloadLocation ?>';
					}, 5000);
				});
			</script>
		<?php
		}
	}else{
		echo "All Provider Assign The Location";
	}
	
}

// Remove the citie and state taxonomy for the provider.
// if(!empty($action_per) && $action_per == 'provide_rm_cities_state'){

	// $paged = isset($_REQUEST['pages']) ? $_REQUEST['pages'] : 1;
	// $pro_cs_args = array(
	// 	'post_type' => 'provider',
    //     'post_status'    => 'publish',
	// 	'posts_per_page' => 10,
	// 	'paged'          => $paged,
	// 	'order'          => 'ASC'
	// );

	// $provide_cs_qry = new WP_Query($pro_cs_args);
	// $provide_cs_qry->found_posts;
	// $provide_cs_max = $provide_cs_qry->max_num_pages;
    
	// if($provide_cs_max >= $paged){
	// 	if($provide_cs_qry->have_posts()){
	// 		while($provide_cs_qry->have_posts()){
	// 			$provide_cs_qry->the_post();
	// 			echo "========<br>";
	// 			$provide_id = get_the_ID(); 
	// 			echo $provide_id.' - '.get_the_title();
	// 			echo "<br>";
	// 			$term_slugs = array();
	// 			// // Ensure terms exist before assigning
	// 			// foreach ($term_slugs as $slug) {
	// 			//     if (!term_exists($slug, $taxonomy)) {
	// 			//         echo "Term '$slug' doesn't exist in '$taxonomy' taxonomy.";
	// 			//     }
	// 			// }
	// 			// // Clear cache
	// 			// clean_post_cache($provide_id);

	// 			// Assign terms if they exist
	// 			$state_result = wp_set_post_terms($provide_id, $term_slugs, 'location-state', false);
	// 			$city_result = wp_set_post_terms($provide_id, $term_slugs, 'location-city', false);

	// 			if (is_wp_error($state_result)) {
	// 			echo "Term assigned to Post ID: $provide_id";
	// 			echo "Failed to assign term. Error: " . $state_result->get_error_message();
	// 			}else {
	// 				echo "Remove the State :$provide_id";
	// 			}
	// 			if (is_wp_error($city_result)) {
	// 			echo "Term assigned to Post ID: $provide_id";
	// 			echo "Failed to assign term. Error: " . $city_result->get_error_message();
	// 			}else {
	// 				echo "Remove the City :$provide_id";
	// 			}
	// 			echo "<br>========<br>";

				
	// 		}
	// 	}
	// 	wp_reset_postdata();

	// 	sleep(20);
	// 	$paged++;
	// 	$reloadLocation = site_url('/provider-and-location-remove/').'?action_per=provide_rm_cities_state&pages='.$paged;
	// 	?>
	 	<script>
	// 		document.addEventListener("DOMContentLoaded", () => {
	// 			setTimeout(function(){
	// 				window.location.href = '<?php //echo $reloadLocation ?>';
	// 			}, 5000);
	// 		});
	 	</script>
		<?php
	// }else{
	// 	echo "All Provider Remove state and cities";
	// }
	
// }

// Remove the provide on the 'ACF'location.
if(!empty($action_per) && $action_per == 'location_rm_pro'){

	$rm_pro_args = array(
		'post_type' => 'location',
        'post_status'    => 'publish',
		'posts_per_page' => $per_paged,
		'paged'          => $paged,
		'order' => 'ASC'
     );

    $location_qry = new WP_Query($rm_pro_args);
	$loc_fd = $location_qry->found_posts;
	$loc_max = $location_qry->max_num_pages;
    
	if($loc_max >= $paged){
	if($location_qry->have_posts()) {
		while($location_qry->have_posts()) {
			$location_qry->the_post();
			echo "========<br>";
			$location_rm_id = get_the_ID(); 
			echo $location_rm_id . ' - ' . get_the_title();
			echo "<br>";
			// $provide_city = get_the_terms($location_rm_id, 'service');
			$term_slugs = array(); 

			// Update location ACF field
			$update_val_provide_title = update_field('alrv_slo_providers_title_physicians', '', $location_rm_id);
			$update_val_provide = update_field('alrv_slo_providers_on_location', array(), $location_rm_id);

			if($update_val_provide_title) {
				echo "Post title field <strong>".get_the_title($location_rm_id)."</strong> removed for Post ID: $location_rm_id";
			}

			if($update_val_provide) {
				echo "Post selected field <strong>".get_the_title($location_rm_id)."</strong> updated for Post ID: $location_rm_id";
			} else {
				echo "Failed to update <strong>".get_the_title($location_rm_id)."</strong> field. Post ID: $location_rm_id";
			}
			echo "<br>========<br>";

		}
	}

	wp_reset_postdata();
    
	if(!isset($_GET['per_paged'])){
		sleep(20);
		$paged++;
		$reloadLocation = site_url('/provider-and-location-remove/').'?action_per=location_rm_pro&pages='.$paged;
		?>
		<script>
			document.addEventListener("DOMContentLoaded", () => {
				setTimeout(function(){
					window.location.href = '<?php echo $reloadLocation ?>';
				}, 5000);
			});
		</script>
		<?php
    }
	}else {
		echo "All provide remove in location";
	}
}

get_footer();
