<?php
/**
 * Block Name: Hours of Operation
 *
 * The template for displaying the custom gutenberg block named timing & shots Schedules.
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
$alrv_blk_tss_title = ( isset( $block_fields['alrv_blk_tss_title'] ) ) ? $block_fields['alrv_blk_tss_title'] : null;
$alrv_blk_tss_hours = ( isset( $block_fields['alrv_blk_tss_hours'] ) ) ? $block_fields['alrv_blk_tss_hours'] : null;
$pID       = get_the_ID();
$hoursOfOperations = (get_post_meta($pID,'birdeye_hoursOfOperations',true)) ? get_post_meta($pID,'birdeye_hoursOfOperations',true) : null;
?>
<div id="<?php echo $id; ?>"
	class="<?php echo $align_class . ' ' . $class_name . ' ' . $name; ?> glide-block-<?php echo $block_glide_name; ?>">

	<div class="schedule-section">
		<div class="schdl-cards two-columns <?php if(!$alrv_blk_tss_hours){ ?> justify-content-center <?php } ?> ">
			<?php if($hoursOfOperations){ ?>
			<div class="schdl-sngl-card column">
				<p class="heading-5"><?php _e( 'Open Hours', 'alrv_td' ); ?></p>
					<ul class="schdl-list">
						<?php foreach ($hoursOfOperations as $key => $hours) {
								$hour='';
								if($key==0){
									$day='Monday';
								}elseif($key==1){
									$day='Tuesday';
								}elseif($key==2){
									$day='Wednesday';
								}elseif($key==3){
									$day='Thursday';
								}elseif($key==4){
									$day='Friday';
								}elseif($key==5){
									$day='Saturday';
								}elseif($key==6){
									$day='Sunday';
								}
								$workingHours = ( isset( $hours->workingHours ) ) ? $hours->workingHours : null;
								$isOpen = ( isset( $hours->isOpen ) ) ? $hours->isOpen : null;
								// dump($workingHours);
								if($workingHours){
									$hour=date("g:i", strtotime($workingHours[0]->startHour)).' - '.date("g:i", strtotime($workingHours[0]->endHour));
								}else{
									$hour=null;
								}
							?>
							<li id="shothours-day-monday">
								<?php  if($day){ echo $day;	} ?>: <span><?php  if($isOpen){ echo $hour;	}else{ echo 'Closed'; } ?></span>
							</li>
						<?php } ?>
					</ul>
				</div>
				<?php } ?>

				<?php if($alrv_blk_tss_hours){ ?>
					<div class="schdl-sngl-card column">
						<?php if($alrv_blk_tss_title){  ?>
							<p class="heading-5"> <?php echo $alrv_blk_tss_title; ?> </p>
						<?php } ?>
							<ul class="schdl-list">
								<?php foreach ($alrv_blk_tss_hours as $hours) {
									$day=$hours['day'];
									$hour=$hours['hours'];
									?>
									<li id="shothours-day-monday">
										<?php  if($day){ echo $day;	} ?> <span><?php  if($hour){ echo $hour; } ?></span>
									</li>
								<?php } ?>
							</ul>
						</div>
				<?php } ?>
			</div>
		</div>

	<?php 
		$loc_id = get_the_ID();
		$today  = date('Ymd');
		$today_fm = date('F j', strtotime($today));

		$args = array(
			'post_type'      => 'closure',
			'post_status'    => 'publish',
			'posts_per_page' => 1,
			'orderby' => 'date',
			'order'   => 'DESC',
			'meta_query' => array(
				'relation' => 'AND',
				// Start date must be <= today
				array(
					'key'     => 'alrv_cpt_cl_start_dt',
					'value'   => $today,
					'compare' => '<=',
					'type'    => 'NUMERIC'
				),
				// End date must be >= today
				array(
					'key'     => 'alrv_cpt_cl_end_dt',
					'value'   => $today,
					'compare' => '>=',
					'type'    => 'NUMERIC'
				),
				// Location match
				array(
					'key' => 'alrv_cpt_cl_slct_location',
					'value' => '"'.$loc_id.'"',
					'compare' => 'LIKE'
				)
			)
		);
		$cl_qry = New WP_Query($args);
		
		if($cl_qry->have_posts()){
			$closure_st = array();
			while($cl_qry->have_posts()){
				$cl_qry->the_post();
				// echo "closure location";
				$closure_id = get_the_ID();
				$cl_description = get_field('alrv_cpt_cl_description', $closure_id);
				$cl_categories = get_the_terms($closure_id, 'closure-category');
				if ( !empty($cl_categories) && !is_wp_error($cl_categories) ) {
					$cat_names = wp_list_pluck($cl_categories, 'name');
					$cl_join_cat = implode(', ', $cat_names);
				}
			
			}
			wp_reset_postdata();
			// echo $cl_description;
			?>
			<div class="closure-meassage">The location <?php echo $cl_description; ?> (<?php echo $cl_join_cat; ?>) on <?php echo $today_fm; ?>.</div>
			<?php 
		}
	?>

</div>
