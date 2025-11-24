<?php
/**
 * Block Name: Closure Summary
 *
 * The template for displaying the custom gutenberg block named conditions list.
 *
 * @link https://www.advancedcustomfields.com/resources/blocks/
 *
 * @package Allervie
 * @since 1.0.0
 */

// Get all the fields from ACF for this block ID
// $block_fields = get_fields( $block['id'] );
$block_fields = get_fields_escaped( $block['id'] );
// $block_fields = get_fields_escaped( $block['id'] ,'sanitize_text_field' ); // if want to remove all html

// Set the block name for it's ID & class from it's file name
$block_glide_name = $block['name'];
$block_glide_name = str_replace( 'acf/', '', $block_glide_name );

// Set the preview thumbnail for this block for gutenberg editor view.
if ( isset( $block['data']['preview_image_help'] ) ) {    /* rendering in inserter preview  */
	echo '<img src="' . $block['data']['preview_image_help'] . '" style="width:100%; height:auto;">';
}

// create align class ("alignwide") from block setting ("wide").
$align_class = $block['align'] ? 'align' . $block['align'] : '';

// Get the class name for the block to be used for it.
$class_name = ( isset( $block['className'] ) ) ? $block['className'] : null;

// Making the unique ID for the block.
$id = 'block-' . $block_glide_name . '-' . $block['id'];

// Making the unique ID for the block.
if ( $block['name'] ) {
	$block_name = $block['name'];
	$block_name = str_replace( '/', '-', $block_name );
	$name       = 'block-' . $block_name;
}

// Block variables
$alrv_blk_closure_text        = $block_fields['alrv_blk_closure_text'] ?? null;
$alrv_blk_cl_button       = $block_fields['alrv_blk_closure_btn'] ?? null;
$alrv_blk_closure_msg       = $block_fields['alrv_blk_closure_msg'] ?? null;
$alrv_blk_closure_select       = $block_fields['alrv_blk_closure_select'] ?? null;

$today = date('Ymd');
if(!empty($alrv_blk_closure_select)){
	$args = array(
		'post_type'      => 'closure',
		'post_status'    => 'publish',
		'posts_per_page' => -1,
		'post__in'       => $alrv_blk_closure_select,
		'orderby'        => 'post__in',
		// 'meta_key'       => 'alrv_cpt_cl_start_dt',
		// 'orderby'        => 'meta_value_num',
		// 'order'          => 'ASC',
		// 'meta_query'     => array(
		// 	'relation' => 'OR',
		// 	array(
		// 		'relation' => 'AND',
		// 		array(
		// 			'key'     => 'alrv_cpt_cl_start_dt',
		// 			'value'   => $today,
		// 			'compare' => '<=',
		// 			'type'    => 'NUMERIC',
		// 		),
		// 		array(
		// 			'key'     => 'alrv_cpt_cl_end_dt',
		// 			'value'   => $today,
		// 			'compare' => '>=',
		// 			'type'    => 'NUMERIC',
		// 		),
		// 	),
		// 	array(
		// 		'key'     => 'alrv_cpt_cl_start_dt',
		// 		'value'   => $today,
		// 		'compare' => '>',
		// 		'type'    => 'NUMERIC',
		// 	),
		// ),
	);
	$cl_qry = new WP_Query($args);

	if($cl_qry->have_posts()){
		$closure_st = array();
		while($cl_qry->have_posts()){
			$cl_qry->the_post();
			$cl_id = get_the_ID();
			$cl_loc_op = get_field('alrv_cpt_cl_auto_manual', $cl_id);
			$start_dt = get_field('alrv_cpt_cl_start_dt', $cl_id);
			
			$end_dt = get_field('alrv_cpt_cl_end_dt', $cl_id);

			$cl_state = get_field('alrv_cpt_cl_state', $cl_id);
			$cl_city = get_field('alrv_cpt_cl_city', $cl_id);
			$cl_slct_location = get_field('alrv_cpt_cl_slct_location', $cl_id);
			$cl_description = get_field('alrv_cpt_cl_description', $cl_id);
			$cl_categories = get_the_terms($cl_id, 'closure-category');
			$cl_cat_slugs = [];
			if (!empty($cl_categories) && !is_wp_error($cl_categories)) {
				foreach ($cl_categories as $cl_cat_item) {
					$cl_cat_slugs[] = !empty($cl_cat_item->slug) ? $cl_cat_item->slug : 'clinic-hours';
				}
			} else {
				$cl_cat_slugs[] = 'clinic-hours';
			}

			$statewise_locations = [];
			$final_statewise_locations = [];
			if($cl_loc_op == 'manual' && !empty($cl_slct_location)){
				
				foreach ($cl_slct_location as $loc_id) {
					
					$state_terms = get_the_terms($loc_id, 'location-state');
					$loc_title = get_the_title($loc_id);
					$short_nm = get_field('alrv_loc_state_short_name', $state_terms[0]);
					
					foreach ($state_terms as $state) {
						$state_name = $state->name;
						if (!isset($statewise_locations[$state_name])) {
							$statewise_locations[$state_name] = [];
						}
						if (!in_array($loc_title, $statewise_locations[$state_name])) {
							$statewise_locations[$state_name][] = "$loc_title , $short_nm <span class='list-update'>$cl_description</span>";
						}	
					}
				}
			}else{
				$loc_args = array(
						'post_type' => 'location',
						'post_status' => 'publish',
						'posts_per_page' => -1,
				);
				if(!empty($cl_state) && empty($cl_city)){
				
					foreach ($cl_state as $st_id) {
						
						$state_term = get_term_by('id', $st_id, 'location-state');
						if ($state_term) {
							$state_name = $state_term->name;
						
							$loc_args['tax_query'] = array(
									array(
										'taxonomy' => 'location-state',
										'field'    => 'term_id',
										'terms'    =>  $st_id,
										'operator' => 'IN',
									),
								);

							$loc_qry = New WP_Query($loc_args);
							if($loc_qry->have_posts()){
								while($loc_qry->have_posts()){
									$loc_qry->the_post();
									$loc_id = get_the_ID();
									$loc_title = get_the_title($loc_id);
									$short_nm = get_field('alrv_loc_state_short_name', $state_term);
									$statewise_locations[$state_name][] = "$loc_title , $short_nm <span class='list-update'>$cl_description</span>";
								}
							}
							wp_reset_postdata();
							
						}
					}
					
				}elseif (!empty($cl_city) && empty($cl_state)) {
					// print_r($cl_city);
					foreach ($cl_city as $city_id) {
						$loc_args['tax_query'] = array(
							array(
								'taxonomy' => 'location-city',
								'field'    => 'term_id',
								'terms'    => $city_id,
								'operator' => 'IN',
							),
						);
						$loc_qry = New WP_Query($loc_args);
						if($loc_qry->have_posts()){
							while($loc_qry->have_posts()){
								$loc_qry->the_post();
								$loc_id = get_the_ID();
								$loc_title = get_the_title($loc_id);
								$state_terms = get_the_terms($loc_id, 'location-state');
								// echo "<pre>";
								// print_r($state_terms);
								$short_nm = get_field('alrv_loc_state_short_name', $state_terms[0]);

								$statewise_locations[$state_terms[0]->name][] = "$loc_title , $short_nm <span class='list-update'>$cl_description</span>";
							}
						}
						wp_reset_postdata();
					}
				}elseif (!empty($cl_city) && !empty($cl_state)) {
					
					foreach ($cl_state as $st_id) {
						$state_term = get_term_by('id', $st_id, 'location-state');
						if ($state_term) {
							$state_name = $state_term->name;
							$loc_args['tax_query'] = array(
								array(
									'taxonomy' => 'location-state',
									'field'    => 'term_id',
									'terms'    => array($st_id),
									'operator' => 'IN',
								),
							);
							$loc_qry = New WP_Query($loc_args);
							if($loc_qry->have_posts()){
								while($loc_qry->have_posts()){
									$loc_qry->the_post();
									$loc_id = get_the_ID();
									$loc_title = get_the_title($loc_id);
									$short_nm = get_field('alrv_loc_state_short_name', $state_term) ?? null;
									$statewise_locations[$state_name][] = "$loc_title , $short_nm <span class='list-update'>$cl_description</span>";
								}
							}
							wp_reset_postdata();
						}
					}
					foreach ($cl_city as $city_id) {
						
						$city_term = get_term_by('id', $city_id, 'location-city');
						if ($city_term) {
							$loc_args['tax_query'] = array(
								array(
									'taxonomy' => 'location-city',
									'field'    => 'term_id',
									'terms'    => array($city_id),
									'operator' => 'IN',
								),
							);
							
							$loc_qry = New WP_Query($loc_args);
							if($loc_qry->have_posts()){
								while($loc_qry->have_posts()){
									$loc_qry->the_post();
									$loc_id = get_the_ID();
									$loc_title = get_the_title($loc_id);
									$state_terms = get_the_terms( $loc_id, 'location-state');
									$short_nm = get_field('alrv_loc_state_short_name', $state_terms[0]) ?? null;
									$statewise_locations[$state_terms[0]->name][] = "$loc_title , $short_nm <span class='list-update'>$cl_description</span>";
									// print_r($statewise_locations);
								}
							}
							wp_reset_postdata();
						}
					}
				}
			}
			foreach ($statewise_locations as $state_name => $locations) {
				if (!isset($final_statewise_locations[$state_name])) {
					$final_statewise_locations[$state_name] = [];
				}
				// merge and remove duplicates
				$final_statewise_locations[$state_name] = array_unique(
					array_merge($final_statewise_locations[$state_name], $locations)
				
				);
			}
			// print_r($final_statewise_locations);
			// die;
			$closure_st[] = [
				'clid'     => $cl_id,
				'cl_start' => $start_dt,
				'cl_end'   => $end_dt,
				'loca_wise' => $final_statewise_locations,
			];
		} //closure end while
		wp_reset_postdata();
		$startDates = array_column($closure_st, 'cl_start');
		$endDates = array_column($closure_st, 'cl_end');

		$startTimestamps  = array_map(function($date) {
			//$dt = DateTime::createFromFormat('d/m/Y', $date);
			$dt = DateTime::createFromFormat('m-d-Y', $date);
			return $dt ? $dt->getTimestamp() : null;
		}, $startDates);
		$startTimestamps  = array_filter($startTimestamps );

		$endTimestamps = array_map(function($date) {
			// $dt = DateTime::createFromFormat('d/m/Y', $date);
			$dt = DateTime::createFromFormat('m-d-Y', $date);
			return $dt ? $dt->getTimestamp() : null;
		}, $endDates);
		$endTimestamps = array_filter($endTimestamps);
		
		$minTimestamp = min($startTimestamps);
		$maxTimestamp = max($endTimestamps);
		// $minDate = date('d/m/Y', $minTimestamp);
		// $maxDate = date('d/m/Y', $maxTimestamp);
		$minDate = date('m-d-Y', $minTimestamp);
		$maxDate = date('m-d-Y', $maxTimestamp);

		// $minDateObj = DateTime::createFromFormat('d/m/Y', $minDate);
		// $maxDateObj = DateTime::createFromFormat('d/m/Y', $maxDate);
		$minDateObj = DateTime::createFromFormat('m-d-Y', $minDate);
		$maxDateObj = DateTime::createFromFormat('m-d-Y', $maxDate);

		$period = new DatePeriod(
			$minDateObj,
			new DateInterval('P1D'),
			(clone $maxDateObj)->modify('+1 day')
		);

		$dateList = [];
		$today = new DateTime();
		$firstActiveDate = null;
		// $firstActiveData = null;
		foreach ($period as $date) {
			// $current = $date->format('d/m/Y');
			// if ($current < date('d/m/Y')) {
			// 	continue;
			// }

			$current = $date->format('m-d-Y');
			if ($current < date('m-d-Y')) {
				continue;
			}
			// Find all locations active on this date
			$active_locs = [];
			$total_location = 0;
			$state_nm = [];
			foreach ($closure_st as $cl) {
				// $startObj = DateTime::createFromFormat('d/m/Y', $cl['cl_start']);
				// $endObj   = DateTime::createFromFormat('d/m/Y', $cl['cl_end']);
				$startObj = DateTime::createFromFormat('m-d-Y', $cl['cl_start']);
				$endObj   = DateTime::createFromFormat('m-d-Y', $cl['cl_end']);
				if ($startObj && $endObj && $date >= $startObj && $date <= $endObj) {
					$cl_id = $cl['clid'];
					
					$cl_categories = get_the_terms($cl_id, 'closure-category');
					$cl_cat_slugs = [];
					if (!empty($cl_categories) && !is_wp_error($cl_categories)) {
						foreach ($cl_categories as $cl_cat_item) {
							$cl_cat_slugs[] = !empty($cl_cat_item->slug) ? $cl_cat_item->slug : 'clinic-hours';
						}
					} else {
						$cl_cat_slugs[] = 'clinic-hours';
					}
					
					if (is_array($cl['loca_wise'])) {
						foreach ($cl['loca_wise'] as $state_name => $locations) {
							// if (!isset($active_locs[$state_name])) {
							// 	$active_locs[$state_name] = [];
							// }
							$state_nm[] = $state_name;
							foreach ($cl_cat_slugs as $slug) {
								if (!isset($active_locs['cl_category'][$slug])) {
									$active_locs['cl_category'][$slug] = [];
								}
								$active_locs['cl_category'][$slug] = array_unique(
									array_merge($active_locs['cl_category'][$slug], $locations)
								);
								// $total_location += count(array_unique(
								// 	array_merge($active_locs['cl_category'][$slug])
								// ));
							}
						}
						
					} else {
						$active_locs[] = $cl['loca_wise'];
					}
				}
			}
			$total_location = 0;
			if (!empty($active_locs['cl_category'])) {
				$all_locations = [];
				foreach ($active_locs['cl_category'] as $slug => $locs) {
					$all_locations = array_merge($all_locations, $locs);
				}
				$total_location = count(array_unique($all_locations));
			}
			if (!empty($active_locs)) {
				$firstActiveDate = $current;
				$active_locs = array_unique($active_locs, SORT_REGULAR);
				$dateList[] = array(
					'date' => $current,
					'state_nm'=> array_unique($state_nm),
					'total_loc'=> $total_location,
					'loc' => $active_locs,
				);
				// break; 
			}
		}
		if (!empty($dateList)) {
			$location_name =  implode(', ', $dateList[0]['state_nm']);
		}
		if(!empty($dateList[0]['loc'])){
		?>
		<div id="<?php echo $id; ?>"
			class="<?php echo $align_class . ' ' . $class_name . ' ' . $name; ?> glide-block-<?php echo $block_glide_name; ?>">
			<div class="clinic-hours-section">
				<div class="clinic">
					<div class="clinic-title">
						<div class="title-row">
							<div class="date-row item">
								<span class="date"><?php echo $dateList[0]['date']; ?></span>
								<span class="icon"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/calendar-black.svg"></span>
							</div>
							<?php if(!empty($alrv_blk_closure_text)){ ?>
							<div class="content-row item">
								<p><?php echo $alrv_blk_closure_text; ?> </p>
							</div>
							<?php } ?> 

						</div>
						<div class="button-row item">
							<a href="javascript:void(0)" class="button show-closure-loc see-update" style="display:block"><?php echo 'See Updates ('.$dateList[0]['total_loc'].')'; ?></a>
							<a href="javascript:void(0)" class="button show-closure-loc see-less" style="display:none"><?php _e ('See Less'); ?></a>
						</div>
					</div>
					<div class="clinic-content" style="display:none">
						<div class="locations">
							<p><?php echo html_entity_decode($alrv_blk_closure_msg); ?></p>
							<!-- <p><?php //echo "All locations in <span>".$location_name."</span> are closed for weather"; ?></p> -->
						</div>
						<div class="content-list">
							<?php 	
								foreach($dateList[0]['loc'] as $key => $location_nm){

								foreach ($location_nm as $key => $cat_ws_loc) {
									if($key == 'clinic-hours'){
									?>
										<div class="content-col">
											<div class="list-title small-text"><?php _e('Clinic Hours:') ?></div>
											<div class="list-content">
												<ul>
													<?php foreach($cat_ws_loc as $loc_nm){?>
														<li>
															<?php echo $loc_nm; ?>
														</li>
													<?php } ?>
												
												</ul>
											</div>
										</div>
									<?php } 
									if($key == 'shot-hours'){
									?>
										<div class="content-col">
											<div class="list-title small-text"><?php _e('Shot Hours:') ?></div>
											<div class="list-content">
												<ul>
													<?php foreach($cat_ws_loc as $loc_nm){
														?>
														<li>
															<?php echo $loc_nm; ?>
														</li>
													<?php } ?>
												</ul>
											</div>
										</div>
									<?php 
									} 
								} 
							} ?>
						</div>

						<?php if(!empty($alrv_blk_cl_button['url'])){ ?>
							<div class="s-40"></div>
							<div class="button-row item bottom-button">
								<?php echo glide_acf_button( $alrv_blk_cl_button, 'button' ); ?>
							</div>
						<?php } ?>
					</div>
		
					<div class="button-row item mobile">
						<a href="#" class="button"><?php echo 'See Updates ('.$dateList[0]['total_loc'].')'; ?></a>
					</div>
					
				</div>
			</div>
		</div>
		<?php }
	}
}