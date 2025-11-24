<?php
/**
 * Block Name: PPC Maps
 *
 * The template for displaying the custom gutenberg block named providers.
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

//Maps API Key From Theme options 
global $option_fields;
$alrv_google_maps_api_key = ( isset( $option_fields['alrv_google_maps_api_key'] ) ) ? $option_fields['alrv_google_maps_api_key'] : null;

// Making the unique ID for the block.
if ( $block['name'] ) {
	$block_name = $block['name'];
	$block_name = str_replace( '/', '-', $block_name );
	$name       = 'block-' . $block_name;
}

// Block variables
$alrv_blk_ppc_map_title = (isset($block_fields['alrv_blk_ppc_map_title'])) ? $block_fields['alrv_blk_ppc_map_title'] : null;
$alrv_blk_ppc_map_locations = (isset($block_fields['alrv_blk_ppc_map_locations'])) ? $block_fields['alrv_blk_ppc_map_locations'] : null;
$alrv_blk_ppc_map_button = (isset($block_fields['alrv_blk_ppc_map_button'])) ? $block_fields['alrv_blk_ppc_map_button'] : null;


?>

<div id="<?php echo $id; ?>" class="<?php echo $align_class . ' ' . $class_name . ' ' . $name; ?> glide-block-<?php echo $block_glide_name; ?>">
	<div class="ppc-location-tabs-block">
		<?php if($alrv_blk_ppc_map_title){  ?>
			<div class="section-head center-align">
				<h2> <?php echo $alrv_blk_ppc_map_title; ?> </h2>
			</div>
		<?php } ?>
		<div class="ppc-location-tabs-ctn">
			<div class="ppc-location-map">

					<div id="locationMap" class="ppc-map-non-interactive"></div>
			</div>
			<div class="ppc-locations-area">
				<div class="ppc-location-inner">
					<div class="ppc-locations-list">
						<div class="ppc-location-box">
							<?php
							$results=array();
							$count=0;
								global $post;
								foreach ( $alrv_blk_ppc_map_locations as $lp_posts ) {
									$post = $lp_posts;
									setup_postdata( $post );
									$pID         = get_the_ID();
									$post_fields = get_fields( $pID );
									$alrv_slo_birdeye_location_id = $post_fields['alrv_slo_birdeye_location_id'];
									if ( $alrv_slo_birdeye_location_id ) {

										$address1       = ( get_post_meta( $pID, 'birdeye_address1', true ) ) ? get_post_meta( $pID, 'birdeye_address1', true ): null;
										$address2       = ( get_post_meta( $pID, 'birdeye_address2', true ) ) ?  ', '. get_post_meta( $pID, 'birdeye_address2', true )  : null;
										$city           = ( get_post_meta( $pID, 'birdeye_city', true ) ) ? ' ' . get_post_meta( $pID, 'birdeye_city', true ) . ',' : null;
										$state          = ( get_post_meta( $pID, 'birdeye_state', true ) ) ? get_post_meta( $pID, 'birdeye_state', true ) . ',' : null;
										$zip            = ( get_post_meta( $pID, 'birdeye_zip', true ) ) ? get_post_meta( $pID, 'birdeye_zip', true ) : null;
										$phone          = ( get_post_meta( $pID, 'birdeye_phone', true ) ) ? get_post_meta( $pID, 'birdeye_phone', true ) : null;
										$address = $address1 . '' . $address2 . ' ' . $city . ' ' . $state . ' ' . $zip;
										$coverImageUrl  = ( get_post_meta( $pID, 'birdeye_coverImageUrl', true ) ) ? get_post_meta( $pID, 'birdeye_coverImageUrl', true ) : null;
										$lat            = ( get_post_meta( $pID, 'birdeye_lat', true ) ) ? get_post_meta( $pID, 'birdeye_lat', true ) : null;
										$lng            = ( get_post_meta( $pID, 'birdeye_lng', true ) ) ? get_post_meta( $pID, 'birdeye_lng', true ) : null;
									}
									$alrv_slo_title                 = ( isset( $post_fields['alrv_slo_title'] ) ) ? $post_fields['alrv_slo_title'] : null;
									$alrv_slo_fax                 = ( isset( $post_fields['alrv_slo_fax'] ) ) ? $post_fields['alrv_slo_fax'] : null;
									$src = wp_get_attachment_image_url( get_post_thumbnail_id(  $pID ), 'thumb_900' );
									if ( !$src ) {
										$src=$coverImageUrl;			
									}elseif(!$coverImageUrl){
										$src = esc_url( get_template_directory_uri() ). '/assets/img/admin/defaults/default-image.webp';
									}else {
										$src = $src;
									}
									$results[ $count ]['location_id']   = $pID;
									$results[ $count ]['title']         = get_the_title( $pID );
									$results[ $count ]['lat']           = $lat;
									$results[ $count ]['long']          = $lng;
									$results[ $count ]['phone_numbers'] = $phone;
									$results[ $count ]['address']       = $address;
									$results[ $count ]['URL']           = esc_url( get_permalink( $pID ) );
									$results[ $count ]['fax']           = $alrv_slo_fax;
									$results[ $count ]['clinical']      = '';
									$count++;
							?>
								<span class="ppc-locations" id="location-<?php echo $pID; ?>">
									<div class="location-tab-image"
										style="background-image: url(<?php echo $src; ?>);">
									</div>
									<div class="location-tab-content">
										<div class="ppc-tab-loc-title">
											<?php
												if ( $alrv_slo_title ) {
													echo $alrv_slo_title;
												} else {
													echo get_post_meta( $pID, 'birdeye_name', true ); }
												?>

										</div>
										<?php if($address){  ?>
											<div class="ppc-tab-loc-address">
												<?php echo $address; ?>
											</div>
										<?php } ?>
									</div>
								</span>
							<?php } wp_reset_postdata(); wp_reset_query(); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php if( $alrv_blk_ppc_map_button ) { ?>
			<div class="ppc-loc-button">
				<?php echo glide_acf_button( $alrv_blk_ppc_map_button, 'button' ); ?>
			</div>
		<?php } ?>
	</div>
</div>
<?php
wp_register_script('googleapis', 'https://maps.googleapis.com/maps/api/js?key=' . $alrv_google_maps_api_key . '&libraries=places,geometry&callback=initMap', array('jquery', 'locations-scripts'), null, true);

// load location filters scripts
wp_register_script( 'locations-scripts', get_template_directory_uri() . '/assets/js/location.js', array(), '', true );
wp_localize_script(
	'locations-scripts',
	'locationVars',
	array(
		'ajaxurl'           => admin_url( 'admin-ajax.php' ),
		'alat'              => $lat,
		'alng'              => $lng,
		'zipcodeParam'      => '',
		'stateParam'        => '',
		'zipcodes'          => array(),
		'markerImage'       => get_template_directory_uri() . '/assets/img/pin.svg',
		'markerActiveImage' => get_template_directory_uri() . '/assets/img/pin-active.svg',
		'results'           => $results,
		'is_singular'=>'no',
		'is_tooltip'=>'no',
		'assets_url'        => esc_url( get_template_directory_uri() ),
	)
);

wp_enqueue_script( 'jquery-ui-autocomplete' );
wp_enqueue_script( 'locations-scripts' );
wp_enqueue_script( 'googleapis' );
