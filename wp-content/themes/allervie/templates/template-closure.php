<?php
/**
 * Template Name: Closure
 * Template Post Type: page
 *
 * This template is for displaying Closure page.
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

$alrv_pagetitle = glide_page_title( 'alrv_temp_cl_title' );
$alrv_temp_cl_desc = !empty( $fields['alrv_temp_cl_desc']) ? $fields['alrv_temp_cl_desc'] : null;
$alrv_temp_cl_sub_desc = !empty( $fields['alrv_temp_cl_sub_desc']) ? $fields['alrv_temp_cl_sub_desc'] : null;
$cl_states = get_terms(array('taxonomy'=>'location-state','hide_empty' => false));
$cl_cities = get_terms(array('taxonomy'=>'location-city','hide_empty' => false));
$cl_categories = get_terms(array('taxonomy'=>'closure-category','hide_empty' => false));

$date_param = isset($_GET['date']) ? sanitize_text_field($_GET['date']) : '' ;
$state_param = isset($_GET['state']) ? sanitize_text_field($_GET['state']) : '' ;
$city_param = isset($_GET['city']) ?  sanitize_text_field($_GET['city']) : '' ;

$fl_date = array();
$today = date('Ymd');
$args = array(
	'post_type'      => 'closure',
	'post_status'    => 'publish',
	'meta_key'       => 'alrv_cpt_cl_start_dt',
	'orderby'        => 'meta_value_num',
	'order'          => 'ASC', 
	// 'meta_query'     => array(

	// 	array(
	// 		'key'     => 'alrv_cpt_cl_end_dt',
	// 		'value'   => $today,
	// 		'compare' => '>=',
	// 		'type'    => 'NUMERIC'
	// 	)
	// 'relation' => 'AND',
	// 	array(
	// 		'key'     => 'alrv_cpt_cl_start_dt',
	// 		'value'   => $today,
	// 		'compare' => '<=',
	// 		'type'    => 'NUMERIC'
	// 	),
	// 	array(
	// 		'key'     => 'alrv_cpt_cl_end_dt',
	// 		'value'   => $today,
	// 		'compare' => '>=',
	// 		'type'    => 'NUMERIC'
	// 	)
	// )
);
$cl_qry = New WP_Query($args);

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
		$cl_categories = get_the_terms($cl_id, 'closure-category');
		$cl_description = get_field('alrv_cpt_cl_description', $cl_id);
		$statewise_locations = [];
		$final_statewise_locations= [];
		if($cl_loc_op == 'manual' && !empty($cl_slct_location)){
			
			foreach ($cl_slct_location as $loc_id) {
				// echo $loc_id;
				$state_terms = get_the_terms($loc_id, 'location-state');
				// print_r($state_terms);
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
						// echo $st_id;
						$loc_args['tax_query'] = array(
								array(
									'taxonomy' => 'location-state',
									'field'    => 'term_id',
									// 'terms'    => (array) $cl_state,
									'terms'    =>  array($st_id),
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
				foreach ($cl_city as $city_id) {
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
						// echo "city inside";
						while($loc_qry->have_posts()){
							$loc_qry->the_post();
							$loc_id = get_the_ID();
							$loc_title = get_the_title($loc_id);
							$state_terms = get_the_terms( $loc_id, 'location-state');
							$short_nm = get_field('alrv_loc_state_short_name', $state_terms[0]) ?? null;
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
		
		$closure_st[] = [
			'clid' => $cl_id,
			'cl_start'=> $start_dt,
			'cl_end'=> $end_dt,
			// 'cl_catgory'=> $cl_categories[0]->slug,
			// 'loc'=>$loc_nm
			// 'cl_desc' => $cl_desc,
			'loca_wise' => $final_statewise_locations,
		];

		
	}
	wp_reset_postdata();

	$startDates = array_column($closure_st, 'cl_start');
	$endDates = array_column($closure_st, 'cl_end');
	
	$startTimestamps  = array_map(function($date) {
		// $dt = DateTime::createFromFormat('d/m/Y', $date);
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
	foreach ($period as $date) {
		
		$current = $date->format('Y-m-d');
		if ($current < date('Y-m-d')) {
			continue;
		}

		
		// Find all locations active on this date
		$active_locs = [];
		// $cl_desc = [];
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
						if (!isset($active_locs[$state_name])) {
							$active_locs[$state_name] = [];
						}
						
						foreach ($cl_cat_slugs as $slug) {
							if (!isset($active_locs[$state_name]['cl_category'][$slug])) {
								$active_locs[$state_name]['cl_category'][$slug] = [];
							}

							$active_locs[$state_name]['cl_category'][$slug] = array_unique(
								array_merge($active_locs[$state_name]['cl_category'][$slug], $locations)
							);
						}
						
					}
				} else {
					// fallback if something unexpected
					$active_locs[] = $cl['loca_wise'];
				}
				
			}
		}
		
		if (is_array($cl_desc)) {
			$cl_desc = implode(', ', array_filter($cl_desc));
		}
		if (!empty($active_locs)) {
			$fl_date[] = $current;
			$active_locs = array_unique($active_locs, SORT_REGULAR);
			$dateList[] = array(
				'date' => $current,
				'loc' => $active_locs,
			);
		}
	}
	// Output result
	// echo "<pre>";
	// print_r($dateList);
	// echo "</pre>";
	// die;
	set_transient( 'closure_date_list', $dateList, DAY_IN_SECONDS );
	
	
	// if (!empty($date_param)) {
	// 	echo "Get Date : ". $date_param;
	// 	$date_param = date('Y-m-d', strtotime($date_param));
	// 	$dateList = array_filter( $dateList, fn( $i ) => $i['date'] === $date_param );
	// }

	if (!empty($date_param)) {
		$dt = DateTime::createFromFormat('m-d-Y', $date_param);
		if ($dt instanceof DateTime) {
			$date_param = $dt->format('Y-m-d'); 
			$dateList = array_filter($dateList, fn($i) => $i['date'] === $date_param);
		}
	}


	/* ---------- STATE (slug → name) ---------- */
	
	// $state_param_nm = '';
	if ($state_param) {
        $st = get_term_by('slug', $state_param, 'location-state');
        if ($st) {
            $state_name = $st->name;
            $filtered_data = array_filter($dateList, function($item) use ($state_name) {
                return isset($item['loc'][$state_name]);
            });
            $dateList = array_map(function($item) use ($state_name) {
                $item['loc'] = [$state_name => $item['loc'][$state_name]];
                return $item;
            }, $filtered_data);
        }
    }

	$city_param_nm = '';
	if ( $city_param ) {
		$ct = get_term_by( 'slug', $city_param, 'location-city' );
		if ( $ct ) {
			$city_param_nm = $ct->name;
			$dateList  = array_filter( $dateList, function( $item ) use ( $city_param_nm ) {
				foreach ( $item['loc'] as $state_data ) {
					foreach ( $state_data['cl_category'] as $cat_arr ) {
						foreach ( $cat_arr as $html ) {
							// Simple case-insensitive contains check
							if ( stripos( $html, $city_param_nm ) !== false ) {
								return true;
							}
						}
					}
				}
				return false;
			} );
		}
	}

}

?>

<!-- Filter Form Date, State, Clinic Name Code Start Here -->
<section id="hero-section" class="hero-section hero-with-filter lblue-container tl-shape">
	<div class="hero-default">
		<div class="wrapper">
			<div class="d-flex justify-content-center align-items-start">
				<div class="banner-text center-align">
					<h1 class="heading block-title"><?php echo $alrv_pagetitle; ?></h1>
					<?php if(!empty($alrv_temp_cl_desc)){ ?>
					    <div class="hero-content-sub">
							<?php echo html_entity_decode($alrv_temp_cl_desc); ?>
						</div> 
					<?php } ?>

					<div class="hero-content"><?php echo html_entity_decode($alrv_temp_cl_sub_desc); ?> </div>
					<div class="s-50"></div>
					<div class="provider-filter closure variation-filter d-flex flex-wrap has-filter-btn">
						<div class="input-date filter-list">
							<!-- <input placeholder="Date" type="text" onfocus="(this.type = 'date')" id="date"> -->
							<input type="text" placeholder="Date" id="date" class="cl-date" autocomplete="off">
						</div>
						
						<div class="filter-list">

							<select name="closure-state" id="closure-state" class="cl-filter">
								<option value="*"><?php _e( 'State', 'alrv_td' ); ?></option>
								<?php foreach ( $cl_states as $cl_state ) {
									
									?>
								<option value="<?php echo $cl_state->slug; ?>"><?php echo $cl_state->name; ?> </option>
								<?php } ?>
							</select>
						</div>
						<div class="filter-list">
							<select name="closure-cn" id="closure-cn" class="cl-filter">
								<option value="*"><?php _e( 'Clinic Names', 'alrv_td' ); ?></option>
								<?php foreach ( $cl_cities as $cl_city ) {
									
									?>
								    <option value="<?php echo $cl_city->slug; ?>"> <?php echo $cl_city->name; ?> </option>
								<?php } ?>
							</select>
						</div>
						<div class="filter-list fiter-btn">
							<button type="button" id="clear-all" class="button cl-clear-btn" style="display:none"><?php _e( 'Clear All', 'alrv_td' ); ?></button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- Filter Form Date, State, Clinic Name Code End Here -->


<section class="page-section">
	<section class="lblue-container">
		<div class="wrapper">
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
		
			<div class="filter-faq-block">
				<?php
				$per_page = 3; // Number per page
				$paged = 1; // First page
				$total_items = count($dateList);
				$total_pages = ceil($total_items / $per_page);
				
				// Slice array for first load
				$dateListPaged = array_slice($dateList, 0, $per_page);
				if(!empty($dateListPaged) && is_array($dateListPaged)){
					foreach ($dateListPaged as $key => $cl_item) {
						
						$month_dt = $cl_item['date'];
						$location_dt = $cl_item['loc'] ?? null;
						if ( $city_param_nm ) {
							$tmp = [];
							foreach ( $location_dt as $st_name => $st_data ) {
								foreach ( $st_data['cl_category'] as $cat => $items ) {
									foreach ( $items as $html ) {
										if ( stripos( $html, $city_param_nm ) !== false ) {
											$tmp[ $st_name ]['cl_category'][ $cat ][] = $html;
										}
									}
								}
							}
							$location_dt = $tmp;
						}

						?>
						<div class="faq-row"> 
							<h2 class="block-title heading"><?php echo date('F j', strtotime($month_dt)); ?> </h2>
							<div class="faqs-section faq-variation">
								<div class="faqs-area">
									<?php 
									$total_locations = 0;
									foreach ($location_dt as $loc_nm => $loc_dt_item) {
										// $cl_loc_total = count($loc_dt_item);
										// print_r($loc_dt_item);
										// $cl_cat = !empty($loc_dt_item['cl_category']) ?? 'clinic-hours';
										
										// print_r($loc_item);
											$total_locations = 0;
										if (!empty($loc_dt_item['cl_category'])) {
											foreach ($loc_dt_item['cl_category'] as $cat_ws_loc) {
												$total_locations += count($cat_ws_loc);
											}
										}
										?>
										<div class="faq">
											<h3 class="large-text faq-title d-flex justify-content-between"><?php echo $loc_nm; ?><span class="faq-numbers"><?php echo $total_locations; ?></span><span class="close-icon"></span>
											</h3>
											<div class="faq-content" style="display: none;">
												<div class="content-list">
												<?php foreach ($loc_dt_item['cl_category'] as $key => $cat_ws_loc) {
														if($key == 'clinic-hours'){ ?>
														<div class="content-col">
															<div class="list-title small-text"><?php _e('Clinic Hours:'); ?></div>
															<div class="list-content">
																<ul>
																	<?php  foreach($cat_ws_loc as $loc_nm){ ?>
																	<li><?php echo $loc_nm; ?>
																	</li>
																	<?php } ?>
																</ul>
															</div>
														</div>
														<?php }
														if($key == 'shot-hours'){ ?>
														<div class="content-col">
															<div class="list-title small-text"><?php _e('Shot Hours:'); ?></div>
															<div class="list-content">
																<ul>
																	<?php  foreach($cat_ws_loc as $loc_nm){ ?>
																	<li><?php echo $loc_nm; ?>
																	</li>
																	<?php } ?>
																</ul>
															</div>
														</div>
														<?php } ?>
														
												<?php } ?>
												</div>
	
											</div>
										</div>
									<?php } ?>
								</div>
							</div>
							<div class="s-80"></div>
						</div>
						<?php
						// }
					}
				}else{
					echo '<p class="cl-found">No More Closures Found.</p>';
				}
            ?>
			</div>
			<?php 	

			if ((!empty($dateListPaged) && is_array($dateListPaged)) && ($total_pages > 1)){ ?>
				<div class="center-align load-more-btn">
					<a href="" title="See All" target="" data-page="1"  data-max="<?php echo $total_pages; ?>" id="loadMore" class="loadmore-btn"><?php _e( 'Show More', 'alrv_td' ); ?></a>
				</div>
			<?php 
			}
			?>
			
		</div>
	</section>
</section>
<?php
get_footer(); 
?>
