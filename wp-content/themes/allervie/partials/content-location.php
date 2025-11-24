<?php
/**
 * Template part for displaying single post
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Allervie
 * @since 1.0.0
 */

// Global variables
global $option_fields;

$post_data = get_queried_object();
$pID       = get_the_ID();
if ( function_exists( 'get_fields' ) && function_exists( 'get_fields_escaped' ) ) {
	$post_fields = get_fields_escaped( $pID );
}

// Post Tags & Categories
// $alrv_post_tags = get_the_tags($pID);
$alrv_post_categories           = get_categories( $pID );
$alrv_slo_title                 = ( isset( $post_fields['alrv_slo_title'] ) ) ? $post_fields['alrv_slo_title'] : null;
$alrv_dfo_intro_text            = ( isset( $post_fields['alrv_dfo_intro_text'] ) ) ? $post_fields['alrv_dfo_intro_text'] : null;
$alrv_slo_external_btn          = ( isset( $post_fields['alrv_slo_external_btn'] ) ) ? $post_fields['alrv_slo_external_btn'] : null;
$alrv_slo_external_class        = ( isset( $post_fields['alrv_slo_external_class'] ) ) ? $post_fields['alrv_slo_external_class'] : 'button  apt-btn-extrn';
$alrv_submit_request_btn        = ( isset( $post_fields['alrv_submit_request_btn'] ) ) ? $post_fields['alrv_submit_request_btn'] : null;
$alrv_submit_request_class      = ( isset( $post_fields['alrv_submit_request_class'] ) ) ? $post_fields['alrv_submit_request_class'] : null;
$alrv_slo_external_btn2         = ( isset( $post_fields['alrv_slo_external_btn2'] ) ) ? $post_fields['alrv_slo_external_btn2'] : null;
$alrv_slo_featured_map          = ( isset( $post_fields['alrv_slo_featured_map'] ) ) ? $post_fields['alrv_slo_featured_map'] : null;
$alrv_slo_external_form         = ( isset( $post_fields['alrv_slo_external_form'] ) ) ? $post_fields['alrv_slo_external_form'] : null;
$alrv_to_cp_locations_page_link = $option_fields['alrv_to_cp_locations_page_link'];

$alrv_tmp_ppc_not_banner_text 	= ( isset( $post_fields['alrv_tmp_ppc_not_banner_text'])) ? $post_fields['alrv_tmp_ppc_not_banner_text'] : null;
$alrv_tmp_ppc_not_banner_button = ( isset( $post_fields['alrv_tmp_ppc_not_banner_button'])) ? $post_fields['alrv_tmp_ppc_not_banner_button'] : null;
$alrv_tmp_ppc_not_banner_bg_color = ( isset( $post_fields['alrv_tmp_ppc_not_banner_bg_color'] ) ) ? $post_fields['alrv_tmp_ppc_not_banner_bg_color'] : null;

// Page Fields
$placeholder_effect = $post_fields['placeholder_effect'];
$alrv_slo_birdeye_location_id = $post_fields['alrv_slo_birdeye_location_id'];
$alrv_slo_fax                 = $post_fields['alrv_slo_fax'];
$alrv_slo_billing_number      = $post_fields['alrv_slo_billing_number'];
$alrv_to_hdr_secondbtn        = ( isset( $option_fields['alrv_to_hdr_secondbtn'] ) ) ? $option_fields['alrv_to_hdr_secondbtn'] : null;
$alrv_slo_sc_al_sho        = ( isset( $post_fields['alrv_slo_sc_al_sho'] ) ) ? $post_fields['alrv_slo_sc_al_sho'] : null;
$alrv_slo_external_snip        = ( isset( $post_fields['alrv_slo_external_snip'] ) ) ? $post_fields['alrv_slo_external_snip'] : null;
$make_an_appointment_button = $post_fields['make_an_appointment_button'];

if ( $alrv_slo_birdeye_location_id ) {
	$address1       = ( get_post_meta( $pID, 'birdeye_address1', true ) ) ? get_post_meta( $pID, 'birdeye_address1', true ): null;
	$address2       = ( get_post_meta( $pID, 'birdeye_address2', true ) ) ?  ', '. get_post_meta( $pID, 'birdeye_address2', true )  : null;
	$city           = ( get_post_meta( $pID, 'birdeye_city', true ) ) ? '<br>' . get_post_meta( $pID, 'birdeye_city', true ) . ',' : null;
	$state          = ( get_post_meta( $pID, 'birdeye_state', true ) ) ? get_post_meta( $pID, 'birdeye_state', true ) . ',' : null;
	$zip            = ( get_post_meta( $pID, 'birdeye_zip', true ) ) ? get_post_meta( $pID, 'birdeye_zip', true ) : null;
	$countryCode    = ( get_post_meta( $pID, 'birdeye_countryCode', true ) ) ? get_post_meta( $pID, 'birdeye_countryCode', true ) : null;
	$coverImageUrl  = ( get_post_meta( $pID, 'birdeye_coverImageUrl', true ) ) ? get_post_meta( $pID, 'birdeye_coverImageUrl', true ) : null;
	$googleUrl      = ( get_post_meta( $pID, 'birdeye_googleUrl', true ) ) ? get_post_meta( $pID, 'birdeye_googleUrl', true ) : null;
	$lat            = ( get_post_meta( $pID, 'birdeye_lat', true ) ) ? get_post_meta( $pID, 'birdeye_lat', true ) : null;
	$lng            = ( get_post_meta( $pID, 'birdeye_lng', true ) ) ? get_post_meta( $pID, 'birdeye_lng', true ) : null;
	$state_term     = get_the_terms( $pID, 'location-state' );
	$state_id       = ( isset( $state_term[0]->term_id ) ) ? $state_term[0]->term_id : null;
	$phone          = ( get_post_meta( $pID, 'birdeye_phone', true ) ) ? get_post_meta( $pID, 'birdeye_phone', true ) : null;
	$clinical       = '';
	$arrZips        = array();
	$condition_term = get_the_terms( $pID, 'location-type' );
	$count          = 0;
	if ( $condition_term ) {
		foreach ( $condition_term as $condition ) {
			$current_location_type = $condition->slug;
			if ( $current_location_type == 'clinical-research' ) {
				$clinical .= '<div class="rch-type">
				<a href="#clinical-research" class="d-flex align-items-center"><img src="' . esc_url( get_template_directory_uri() ) . '/assets/img/clinical-research.svg"
				alt="">
					' . $condition->name . '
				</a>
			</div>';
			}
		}
	}
	$address = $address1 . '' . $address2 . ' ' . $city . ' ' . $state . ' ' . $zip;

	$results[ $count ]['location_id']   = $pID;
	$results[ $count ]['title']         = get_the_title( $pID );
	$results[ $count ]['lat']           = $lat;
	$results[ $count ]['long']          = $lng;
	$results[ $count ]['phone_numbers'] = $phone;
	$results[ $count ]['address']       = $address;
	$results[ $count ]['URL']           = esc_url( get_permalink( $pID ) );
	$results[ $count ]['fax']           = $alrv_slo_fax;
	$results[ $count ]['clinical']      = $clinical;
	// var_dump($results);
	?>
<!-- Location detail hero -->
<?php if ($alrv_tmp_ppc_not_banner_text && $alrv_tmp_ppc_not_banner_button['url']) {
		if($alrv_tmp_ppc_not_banner_bg_color == 'blue'){
			$bgcolor_class = '';
		}else{
			$bgcolor_class = 'location-wellcome-note';
		}
	?>
	<div class="wellcome-note <?php echo $bgcolor_class; ?>">
		<div class="wrapper">
			<div class="wellcome-note-inner center-align">
				<p><?php echo $alrv_tmp_ppc_not_banner_text; ?> <?php
					if ($alrv_tmp_ppc_not_banner_button):
						echo glide_acf_button($alrv_tmp_ppc_not_banner_button, '');
					endif;
					?>
				</p>
				<div class="close-btn">
				</div>
			</div>
		</div>
	</div>
<?php } ?>
<section class="aqua-gradiant-container single-location-hero-ctn">
	<div class="wrapper">
		<div class="location-detail-hero">
			<div class="item">
				<div class="loc-sngl d-flex justify-content-between align-items-start flex-wrap">

					<div class="banner-loc-image">
						<?php if ( $alrv_slo_featured_map ) { ?>
						<div id="locationMap" style="height:600px;"></div>
							<?php
						} else {
							if ( has_post_thumbnail() ) {
								the_post_thumbnail( 'thumb_900' );
							} elseif ( $coverImageUrl ) {
								?>
						<img src="<?php echo $coverImageUrl; ?>" alt="<?php the_title(); ?>" />
						<?php } else { ?>
						<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/defaults/default-image.webp"
							alt="<?php the_title(); ?>" />
								<?php
						}
						}
						?>
					</div>
					<div class="banner-loc-text">
						<?php if ( $alrv_to_cp_locations_page_link ) { ?>
							<?php if ( $alrv_to_cp_locations_page_link ) { ?>
							 <a href="<?php echo $alrv_to_cp_locations_page_link; ?>" id="go-back" class="button white-btn small-btn">
						        <span>
						            <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/arrow-left.svg" alt="">
						        </span>
						        <?php _e( 'go back', 'alrv_td' ); ?>
						    </a>
						<?php } ?>
						<?php } ?>
						<h1 class="med-heading">
							<?php
							if ( $alrv_slo_title ) {
								echo $alrv_slo_title;
							} else {
								echo get_post_meta( $pID, 'birdeye_name', true ); }
							?>
						</h1>
						<?php
						// Check if it is Clinical Research Type - To display it's logo below.
							echo $clinical;
						?>
						<div class="s-40"></div>
						<div class="loc-address">
							<p class="heading-6">
								Address
							</p>
							<p><a href="<?php echo $googleUrl; ?>"
								target="_blank"><?php echo $address; ?></a></p>

							<a href="<?php echo $googleUrl; ?>"
								target="_blank"><?php _e( 'Get Directions', 'alrv_td' ); ?></a>
						</div>
						<?php if($placeholder_effect){ ?>
							<div class="text location-phone-animation" id="location-phone-animation"  data-key="birdeye_phone">
								<div class="text-line"></div>
							</div>
						<?php } ?>
						<div class="phone d-flex align-items-center" <?php if($placeholder_effect){ ?> style="display:none;" <?php } ?>   data-id="<?php echo $pID; ?>" data-key="birdeye_phone">
							<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/phone-icon.svg"
								alt="">
							<p>Phone: <a href="tel:<?php echo get_post_meta( $pID, 'birdeye_phone', true ); ?>"><?php echo get_post_meta( $pID, 'birdeye_phone', true ); ?></a></p>
						</div>
						<?php if ( $alrv_slo_fax ) { ?>
							<?php if($placeholder_effect){ ?>
								<div class="text location-phone-animation" id="location-phone-animation"  data-key="alrv_slo_fax">
									<div class="text-line"></div>
								</div>
								<?php } ?>
						<div class="fax d-flex align-items-center" data-id="<?php echo $pID; ?>"  <?php if($placeholder_effect){ ?> style="display:none;" <?php } ?>  data-key="alrv_slo_fax">
							<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/fax-icon.svg"
								alt="">
							<p>Fax: <a href="tel:<?php echo $alrv_slo_fax; ?>"><?php echo $alrv_slo_fax; ?></a></p>
						</div>
						<?php } ?>
						<?php if ( $alrv_slo_billing_number ) { ?>
							<?php if($placeholder_effect){ ?>
						<div class="text location-phone-animation" id="location-phone-animation" data-id="<?php echo $pID; ?>" data-key="alrv_slo_billing_number">
							<div class="text-line"></div>
						</div>
						<?php } ?>
						<div class="billing d-flex align-items-center" <?php if($placeholder_effect){ ?> style="display:none;" <?php } ?>   data-id="<?php echo $pID; ?>" data-key="alrv_slo_billing_number">
							<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/billing-icon.svg"
								alt="">
							<p>Billing number: <a href="tel:<?php echo $alrv_slo_billing_number; ?>"><?php echo $alrv_slo_billing_number; ?></a></p>
						</div>
						<?php } ?>
						<div class="s-16 test"></div>
						<div class="banner-btns">
							<?php
							if ( $alrv_slo_external_form ) {
								$alrv_to_hdr_secondbtn['url'] = $alrv_to_hdr_secondbtn['url'] . '?app-location=' . get_the_ID() . '&form=custom';
								if ( $alrv_to_hdr_secondbtn ) {
									echo glide_acf_button( $alrv_to_hdr_secondbtn, 'button  apt-btn' );
								}
							} elseif ( $alrv_slo_external_btn || $alrv_submit_request_btn) {
								echo glide_acf_button( $alrv_slo_external_btn, $alrv_slo_external_class );
								echo glide_acf_button( $alrv_submit_request_btn, $alrv_submit_request_class );
							} else {
								if ( $state_id ) {
									$alrv_to_hdr_secondbtn['url'] = $alrv_to_hdr_secondbtn['url'] . '?app-state=' . $state_id . '&app-location=' . get_the_ID();
									if(isset($_GET['gclid'])){
										$alrv_to_hdr_secondbtn['url'] = $alrv_to_hdr_secondbtn['url'] . '&gclid='.$_GET['gclid'];
									}
									if(isset($_GET['wc_clear'])){
										$alrv_to_hdr_secondbtn['url'] = $alrv_to_hdr_secondbtn['url'] . '&wc_clear='.$_GET['wc_clear'];
									}
								} else {
									$alrv_to_hdr_secondbtn['url'] = $alrv_to_hdr_secondbtn['url'] . '?app-location=' . get_the_ID();
								}
								if($make_an_appointment_button != 'disable'){
									if ( $alrv_to_hdr_secondbtn ) {
										echo glide_acf_button( $alrv_to_hdr_secondbtn, 'button  apt-btn' );
									}
								}
							} ?>
						</div>

						<?php if($alrv_slo_sc_al_sho=='default'){

							if ( $alrv_slo_external_btn2 ) {
								echo glide_acf_button( $alrv_slo_external_btn2, 'button aqua-btn shots-btn' );
							}
						}else{
							if($alrv_slo_external_snip){
								echo html_entity_decode($alrv_slo_external_snip);
							}
						}
						?>

					</div>
				</div>
				<script>
					var getUrlParameter = function getUrlParameter(sParam) {
						var sPageURL = window.location.search.substring(1),
							sURLVariables = sPageURL.split('&'),
							sParameterName,
							i;

						for (i = 0; i < sURLVariables.length; i++) {
							sParameterName = sURLVariables[i].split('=');

							if (sParameterName[0] === sParam) {
								return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
							}
						}
						return false;
					};
					function getParams (type='arr',exclude=[],url = window.location) {

						// Create a params object
						let params = {};

						new URL(url).searchParams.forEach(function (val, key) {
							if(exclude){
								if(jQuery.inArray(key,exclude)!==-1){
									return;
								}
							}
							if (params[key] !== undefined) {
								if (!Array.isArray(params[key])) {
									params[key] = [params[key]];
								}
								params[key].push(val);
							} else {
								params[key] = val;
							}
						});
						if(type=='arr'){
							return params;
						}else{
							var params_string='';
							for (const key in params) {
								const element = params[key];
								params_string+='&'+key+'='+element;
							}
							return params_string;
						}

					}
					jQuery(document).ready(function(){
						var Arr=jQuery('.apt-btn').attr('href').split('?');
						var url=Arr[0]+'?';
						var para=Arr[1].split('&');

						var i=0;
						for (const key in para) {
							const element = para[key];
							const elementArr = para[key].split('=');
							if(elementArr[0]=='app-state' || elementArr[0]=='app-location'){
								if(i==0){
									url=url+''+element;
								}else{
									url=url+'&'+element;
								}
							}
							i++;
						}

						jQuery('.apt-btn').attr('href',url+getParams('string',['app-state','app-location']))

					});
				</script>
				<?php if(!isset($_GET['gclid']) ){ ?>
					<script>
						jQuery(document).ready(function(){
							setTimeout(() => {
								jQuery('.phone').getLocationData();
								jQuery('.fax').getLocationData();
								jQuery('.billing').getLocationData();
							}, 100);
						});
					</script>
				<?php }else{ ?>
					<script>
						jQuery(document).ready(function(){
							if(jQuery('body').hasClass('single-location')){
								setTimeout(() => {
									jQuery('.location-phone-animation').hide();
								}, 50);
							}
						});
					</script>
				<?php } ?>
			</div>
		</div>
	</div>
<script>
jQuery.fn.getLocationData = function () {
	return this.each(function () {
		var element = jQuery(this);
		var	post_id = element.attr('data-id');
		var	key = element.attr('data-key');
		const data = {
			action: 'get_location_data',
			post_id: post_id,
			key: key,
		};
		jQuery.ajax( {
			url: localVars.ajax_url,
			type: 'post',
			data,
			success( response ) {
				element.find('a').text(response);
				element.find('a').attr('href','tel:'+response);
				element.show();
				if(jQuery('body').hasClass('single-location') ){
					jQuery('.location-phone-animation[data-key='+key+']').hide();
				}
			},
		});
	});
};


</script>
</section>
<!-- Location detail hero -->

<section id="page-section" class="page-section">
	<!-- Content Start -->
	<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<?php get_template_part( 'partials/content' ); ?>
	</div>

	<div class="clear"></div>
	<!-- Content End -->
</section>

	<?php
}
if (!has_block('acf/location-filter', get_post())) {

	wp_localize_script(
		'locations-scripts',
		'locationVars',
		array(
			'ajaxurl'           => admin_url( 'admin-ajax.php' ),
			'alat'              => $lat,
			'alng'              => $lng,
			'zipcodeParam'      => '',
			'stateParam'        => '',
			'zipcodes'          => $arrZips,
			'markerImage'       => get_template_directory_uri() . '/assets/img/pin.svg',
			'markerActiveImage' => get_template_directory_uri() . '/assets/img/pin-active.svg',
			'results'           => $results,
			// 'is_singular'=>'no',
			'is_singular'       => 'yes',
			'is_tooltip'		=> 'yes',
			'assets_url'        => esc_url( get_template_directory_uri() ),
		)
	);

	wp_enqueue_script( 'jquery-ui-autocomplete' );

	wp_enqueue_script( 'locations-scripts' );
	wp_enqueue_script( 'googleapis' );

}
