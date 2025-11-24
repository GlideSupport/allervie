	<?php
		$args = array(
			'post_type'      => array( 'location' ),
			'posts_per_page' => -1,
			'post_status' => 'publish'
		);
		// var_dump($args);
		$locations_birdeye_data=array();
		$query = new WP_Query( $args );
		// The Loop
		$count=0;
		if ( $query->have_posts() ) {
			while ( $query->have_posts() ) {
				$query->the_post();
				$pID=get_the_ID();
				$post_fields = get_fields( $pID );
				if ( $post_fields['alrv_slo_birdeye_location_id'] ) {
					$alrv_slo_birdeye_location_id = $post_fields['alrv_slo_birdeye_location_id'];
				} else {
					$alrv_slo_birdeye_location_id = '';
				}
				if ( $alrv_slo_birdeye_location_id != '' ) {
					$arr['post_id']=$pID;
					$arr['location_id']=$alrv_slo_birdeye_location_id;
					$locations_birdeye_data[]=$arr;
					$count++;
				}
			}
		}

	?>
<div class="wrap">
<h1>BirdEye Locations</h1>

<table class="form-table">
	<tbody>
		<tr>
			<th>Total Locations</th>
			<td><?php echo $count; ?></td>
		</tr>
		<tr>
			<th>Last Fetch Date</th>
			<td><?php echo get_option( 'birdeye-last-save-date' ); ?></td>
		</tr>
	</tbody>
</table>
<div id="notification-response"></div>

	<div class="main-page">
		<button type="button" id="working-data-progress-btn" class="button button-primary" data-birdeye='<?php echo json_encode($locations_birdeye_data); ?>'>Fetch Now</button>
		<div id="working-data-progress" style="display:none;">
			<ol></ol>
		</div>
	</div>
</div>
