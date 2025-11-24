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
global $pID;
global $fields;
$pID = get_the_ID();
if ( function_exists( 'get_fields' ) && function_exists( 'get_fields_escaped' ) ) {
	$post_fields = get_fields_escaped( $pID );
}

// Post Tags & Categories
// $alrv_post_tags = get_the_tags($pID);
$alrv_post_categories = get_categories( $pID );

$alrv_posttitle                  = glide_page_title( 'alrv_sco_title' );
$alrv_sco_intro_text             = ( isset( $post_fields['alrv_sco_intro_text'] ) ) ? $post_fields['alrv_sco_intro_text'] : null;
$alrv_to_cp_conditions_page_link = $option_fields['alrv_to_cp_conditions_page_link'];
$alrv_spo_title                  = ( isset( $post_fields['alrv_spo_title'] ) ) ? $post_fields['alrv_spo_title'] : null;
$alrv_spo_speciality             = ( isset( $post_fields['alrv_spo_speciality'] ) ) ? $post_fields['alrv_spo_speciality'] : null;
$alrv_spo_edu_image              = ( isset( $post_fields['alrv_spo_edu_image'] ) ) ? $post_fields['alrv_spo_edu_image'] : null;
$alrv_spo_edu_education          = ( isset( $post_fields['alrv_spo_edu_education'] ) ) ? $post_fields['alrv_spo_edu_education'] : null;
$alrv_spo_crt_text               = ( isset( $post_fields['alrv_spo_crt_text'] ) ) ? $post_fields['alrv_spo_crt_text'] : null;
$alrv_spo_ct_certifications_list = ( isset( $post_fields['alrv_spo_ct_certifications_list'] ) ) ? $post_fields['alrv_spo_ct_certifications_list'] : null;
$alrv_spo_publications           = ( isset( $post_fields['alrv_spo_publications'] ) ) ? $post_fields['alrv_spo_publications'] : null;
$alrv_spo_postnews           = ( isset( $post_fields['alrv_spo_postnews'] ) ) ? $post_fields['alrv_spo_postnews'] : null;
$alrv_spo_info_title             = ( isset( $post_fields['alrv_spo_info_title'] ) ) ? $post_fields['alrv_spo_info_title'] : null;
$alrv_spo_info_text              = ( isset( $post_fields['alrv_spo_info_text'] ) ) ? $post_fields['alrv_spo_info_text'] : null;
$alrv_spo_short_bio              = ( isset( $post_fields['alrv_spo_short_bio'] ) ) ? $post_fields['alrv_spo_short_bio'] : null;

$the_title                       = get_the_title();
$expr                            = '/(?<=\s|^)\w/iu';
preg_match_all( $expr, $the_title, $matches );
$result = implode( '', $matches[0] );
$result = mb_strtoupper( $result );
$result = substr( $result, 0, 2 );

$fimage = wp_get_attachment_image_url( get_post_thumbnail_id( $pID ), 'thumb_800', false );

// Custom taxonomies
$provider_type          = get_the_terms( $pID, 'providers-type' );
$get_clinical_providers = get_clinical_providers( $pID );
$alrv_spo_chinical_provider              = ( isset( $post_fields['alrv_spo_chinical_provider'] ) ) ? $post_fields['alrv_spo_chinical_provider'] : null;
$providerLocation       = get_provider_location( $pID, 'array' );
$providerLocationOrg    = get_provider_location( $pID, 'post' );

?>
<section id="hero-section" class="hero-section hero-default">
	<!-- Hero Start -->
	<div class="wrapper">
		<div class="hero-provider-detail">
			<div class="wrapper">
				<div class="s-100"></div>
				<div class="d-flex justify-content-center">

					<div class="banner-text center-align">
						<?php
						if ( $provider_type ) {
							foreach ( $provider_type as $type ) {
								?>
						<p class="prd"><?php echo $type->name; ?></p>
								<?php
								break;
							}
						}
						?>
						<?php if ( $alrv_posttitle ) { ?>
						<h1>
							<?php
							echo $alrv_posttitle;

							?>
						</h1>
						<?php } ?>
						<?php if ( $providerLocationOrg ) { ?>
						<div class="prdr-locations">
							<?php foreach ( $providerLocationOrg as $location ) { 
								$city = get_the_terms( $location['location_id'], 'location-city' )[0];
								?>
								<a href="<?php echo get_permalink( $location['location_id'] ); ?>">
									<span class="button white-btn loc-btn"><?php echo $city->name; ?></span>
								</a>
							<?php } ?>
						</div>
						<?php } ?>
					</div>

				</div>
			</div>
		</div>

		<div class="section-team">
			<div class="rc-post-archive">
				<div id="<?php echo sanitize_title( $alrv_posttitle ); ?>" class="team-detail mfp-hide">
					<div class="team-detail-inner">
						<div class="single-team-popup d-flex flex-wrap">

							<div class="member-image-popup">
								<?php if ( $fimage ) { ?>
								<div class="sm-popup-img reset-bg"
									style="background-image:url(<?php echo $fimage; ?>);">
								</div>
								<?php } else { ?>
								<div class="sm-popup-img reset-bg d-flex justify-content-center align-items-center">
									<p class="heading-3"><?php echo $result; ?></p>
								</div>
								<?php } ?>
							</div>


							<div class="single-team-content">
								<p class="member-designation heading-3"><?php _e( 'Bio', 'alrv_td' ); ?></p>
								<?php echo get_the_content( $pID ); ?>
							</div>
						</div>
					</div>
				</div>
				<article class="single-member">
					<div class=" open-popup-link">
						<div class="sm-inner-ctn flex-wrap d-flex justify-content-between ">

							<?php if ( $fimage ) { ?>
							<div class="member-image reset-bg" style="background-image:url(<?php echo $fimage; ?>);">
							</div>
							<?php } else { ?>
							<div class="member-image d-flex justify-content-center align-items-center">
								<p class="heading-3"><?php echo $result; ?></p>
							</div>
							<?php } ?>
							<div class="t-detail">
							<?php if ( $alrv_spo_chinical_provider ) { ?>
								<div class="cr-tag-ctn">
									<span class="cr-tag"><?php _e( 'Clinical Research', 'alrv_td' ); ?></span>
								</div>
							<?php } ?>
								<?php if ( $alrv_spo_speciality && is_array($alrv_spo_speciality) ) { 
									$specialityCount = count($alrv_spo_speciality);
									?>
									<div class="specialty-box">
										<h2><?php _e( 'Specialty', 'alrv_td' ); ?></h2>
										<p>
											<?php 
											foreach($alrv_spo_speciality as $key=>$value){
												$speciality = $value['speciality'];
												$speciality_link = $value['speciality_link'];
												if($key != 0 && $key < $specialityCount-1){
													echo ', ';
												}elseif($key == $specialityCount-1 && $key != 0){
													echo ' and ';
												}
												if(!empty($speciality_link) && !empty($speciality)){
													echo '<a href="'.$speciality_link['url'].'">'.$speciality.'</a>';
												}else{
													echo $speciality;
												}	
											}
											?>
										</p>
										
									</div>
								<?php } ?>
								<?php if ( $alrv_spo_short_bio || get_the_content( $pID ) ) { ?>
									<div class="bio-box">
										<?php if ( $alrv_spo_short_bio ) { ?>
											<h2><?php _e( 'bio', 'alrv_td' ); ?></h2>
											<p><?php echo $alrv_spo_short_bio; ?></p>
										<?php } ?>
										<?php if(get_the_content( $pID ) ){ ?>
										<a href="#<?php echo sanitize_title( $alrv_posttitle ); ?>" class="loadmore-btn sm-inner">
											<span></span>
											<?php _e( 'read more', 'alrv_td' ); ?>
										</a>
										<?php } ?>
									</div>
								<?php } ?>
							</div>
						</div>
					</div>
					<?php if ( $alrv_spo_info_title || $alrv_spo_info_text ) { ?>
					<div class="s-80"></div>
					<section class="container-980 ">
						<div class="wrapper">
							<div class="information-section d-flex flex-wrap info-colored-variation">
								<div class="info-icon info-icon-blue">
									<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/information-blue-icon.svg"
										alt="">
								</div>
								<div class="info-icon info-icon-white">
									<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/information-white-icon.svg"
										alt="">
								</div>
								<div class="info-text">
									<p class="heading-4">
										<?php echo $alrv_spo_info_title; ?>
									</p>
									<p><?php echo $alrv_spo_info_text; ?></p>
								</div>
							</div>
						</div>
					</section>
					<div class="s-60"></div>
					<?php } ?>
				</article>
			</div>
		</div>
	</div>
	<!-- Hero End  -->
</section>

<section id="page-section" class="page-section lblue-container">
	<!-- Content Start -->
	<!-- tabs section container -->
	<div class="wrapper">
		<div class="tabs-section">
			<div class="tabs">
				<ul class="tabs-nav tabs-nav-var d-flex flex-wrap justify-content-center align-items-stretch"
					id="tabs-nav">
					<?php if ( $alrv_spo_edu_education ) { ?>
					<li><a href="#alrv-tab1" class="center-align">
							<div class="tab-icon">
								<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/uploads/education-icon.svg"
									alt="">
							</div>
							<div class="tab-title">
								<p class="medium-text heading-6">
									<?php _e( 'Education', 'alrv_td' ); ?>
								</p>
							</div>
						</a>
					</li>
					<?php } ?>
					<?php if ( $alrv_spo_crt_text || $alrv_spo_ct_certifications_list ) { ?>
					<li><a href="#alrv-tab2" class="center-align">
							<div class="tab-icon">
								<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/uploads/certification.svg"
									alt="">
							</div>
							<div class="tab-title">
								<p class="medium-text heading-6">
									<?php _e( 'Certifications', 'alrv_td' ); ?>
								</p>
							</div>
						</a></li>
					<?php } ?>
					<?php if ( $alrv_spo_publications ) { ?>
					<li><a href="#alrv-tab3" class="center-align">
							<div class="tab-icon">
								<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/uploads/publication.svg"
									alt="">
							</div>
							<div class="tab-title">
								<p class="medium-text heading-6">
									<?php _e( 'Publications', 'alrv_td' ); ?>
								</p>
							</div>
						</a></li>
					<?php } ?>
					<?php if ( $alrv_spo_postnews ) { ?>
					<li><a href="#alrv-tab4" class="center-align">
							<div class="tab-icon">
								<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/uploads/p-posts.svg"
									alt="">
							</div>
							<div class="tab-title">
								<p class="medium-text heading-6">
									<?php _e( 'In The News', 'alrv_td' ); ?>
								</p>
							</div>
						</a></li>
					<?php } ?>
				</ul> <!-- END tabs-nav -->
				<div id="tabs-content">
					<?php if ( $alrv_spo_edu_education ) { ?>
					<div id="alrv-tab1" class="tab-content">
						<div class="s-50"></div>
						<h2><?php _e( 'Education', 'alrv_td' ); ?></h2>
						<ul class="list-column-two">
							<?php

							foreach ( $alrv_spo_edu_education as $list ) {
								$education = ( isset( $list['education'] ) ) ? $list['education'] : null;
								if ( $education ) {
									?>
							<li><?php echo $education; ?></li>
									<?php
								}
							}

							?>
						</ul>
					</div>
					<?php } ?>
					<?php if ( $alrv_spo_ct_certifications_list ) { ?>
					<div id="alrv-tab2" class="tab-content">
						<div class="s-50"></div>
						<div class="numbered-text-section d-flex justify-content-between flex-wrap">
							<div class="numbrd-left">
								<h2>
									<?php _e( 'Certifications', 'alrv_td' ); ?>
								</h2>
								<?php
								if ( $alrv_spo_crt_text ) {
									echo html_entity_decode( $alrv_spo_crt_text );
								}
								?>
							</div>
							<div class="numbrd-right">
								<?php
								if ( $alrv_spo_ct_certifications_list ) {
									foreach ( $alrv_spo_ct_certifications_list as $key => $c_list ) {
										$heading = ( isset( $c_list['heading'] ) ) ? $c_list['heading'] : null;
										$text    = ( isset( $c_list['text'] ) ) ? $c_list['text'] : null;
										$key++;
										?>
								<div class="nmbrd-row d-flex">
									<div class="nmbrd-count">
										<h2 class="gray-text">
											<?php
											if ( $key < 10 ) {
												echo '0';
											}echo $key;
											?>
										</h2>
									</div>
									<div class="nmbrd-content">
										<?php if ( $heading ) { ?>
										<p class="gray-text text-initial heading-4"><?php echo $heading; ?></p>
										<?php } ?>
										<?php if ( $text ) { ?>
										<p><?php echo $text; ?></p>
										<?php } ?>
									</div>
								</div>
										<?php
									}
								}
								?>
							</div>
						</div>

					</div>
					<?php } ?>
					<?php if ( $alrv_spo_publications ) { ?>
					<div id="alrv-tab3" class="tab-content">
						<div class="s-50"></div>
						<h2><?php _e( 'Publications', 'alrv_td' ); ?></h2>
						<div class="publication-single">
							<div class="publication-head d-flex">
								<div class="mobile-flex">
									<p class="small-text text-uppercase heading-6"><?php _e( 'name', 'alrv_td' ); ?></p>
								</div>
								<div class="mobile-flex">
									<p class="small-text text-uppercase heading-6"><?php _e( 'year', 'alrv_td' ); ?></p>
								</div>
								<div class="mobile-flex">
									<p class="small-text text-uppercase heading-6"><?php _e( 'topic', 'alrv_td' ); ?></p>
								</div>
								<div class="mobile-flex">
									<p class="small-text text-uppercase heading-6"></p>
								</div>
							</div>

							<?php
							if ( $alrv_spo_publications ) {
								foreach ( $alrv_spo_publications as $key => $publications ) {
									$title = ( isset( $publications['title'] ) ) ? $publications['title'] : null;
									$year  = ( isset( $publications['year'] ) ) ? $publications['year'] : null;
									$topic = ( isset( $publications['topic'] ) ) ? $publications['topic'] : null;
									$link  = ( isset( $publications['link'] ) ) ? $publications['link'] : null;
									?>
							<div class="publication-link d-flex">
								<div class="mobile-flex">
									<?php if ( $title ) { ?>
									<p class="small-text text-uppercase show-on-mobile heading-6">
										<?php _e( 'name', 'alrv_td' ); ?>
									</p>
									<p><?php echo $title; ?></p>
									<?php } ?>
								</div>
								<div class="mobile-flex pub-year">
									<?php if ( $year ) { ?>
									<p><?php echo $year; ?></p>
									<?php } ?>
								</div>
								<div class="mobile-flex">
									<?php if ( $topic ) { ?>
									<p class="small-text text-uppercase show-on-mobile heading-6">
										<?php _e( 'topic', 'alrv_td' ); ?>
									</p>
									<p><?php echo $topic; ?></p>
									<?php } ?>
								</div>
								<div class="mobile-flex">
									<?php
									if ( $link ) {
										?>
									<p class="external-link">
										<a href="<?php echo $link; ?>" target="_blank">
											<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/external-link-icon.svg"
												alt="External Link Icon">
										</a>
									</p>
									<?php } ?>
								</div>
							</div>

									<?php
								}
							}
							?>
						</div>
					</div>
					<?php } ?>

					<?php if ( $alrv_spo_postnews ) { ?>
						<div id="alrv-tab4" class="tab-content">
							<div class="s-50"></div>
							<h2><?php _e( 'In The News', 'alrv_td' ); ?></h2>
							<div class="publication-single">
								<ul class="list-column-two">
									<?php foreach($alrv_spo_postnews as $key => $post){ ?>
									<li><a href="<?php echo get_the_permalink($post->ID); ?>"><?php echo get_the_title($post->ID); ?></a></li>
									<?php } ?>

								</ul>
							</div>
						</div>
					<?php } ?>

				</div>
			</div>
		</div>
	</div>

	<div class="clear"></div>

	<!-- Content End -->
</section>
<?php if ( $providerLocationOrg ) { ?>
<section class="container-1360">
	<div class="s-120"></div>
	<div class="wrapper">
		<div class="locations-slider owl-carousel owl-theme">
			<?php
			global $post;
			foreach ( $providerLocationOrg as $location ) {
				$location_id         = $location['location_id'];
				$post_fields = get_fields( $location['location_id'] );

				$alrv_slo_external_btn = ( isset( $post_fields['alrv_slo_external_btn'] ) ) ? $post_fields['alrv_slo_external_btn'] : null;
				$alrv_slo_title        = ( isset( $post_fields['alrv_slo_title'] ) ) ? $post_fields['alrv_slo_title'] : null;
				$alrv_slo_fax          = ( isset( $post_fields['alrv_slo_fax'] ) ) ? $post_fields['alrv_slo_fax'] : null;
				$address1       = ( get_post_meta( $location_id, 'birdeye_address1', true ) ) ? get_post_meta( $location_id, 'birdeye_address1', true ): null;
				$address2       = ( get_post_meta( $location_id, 'birdeye_address2', true ) ) ?  ', '. get_post_meta( $location_id, 'birdeye_address2', true )  : null;
				$city           = ( get_post_meta( $location_id, 'birdeye_city', true ) ) ? '<br>' . get_post_meta( $location_id, 'birdeye_city', true ) . ',' : null;
				$state          = ( get_post_meta( $location_id, 'birdeye_state', true ) ) ? get_post_meta( $location_id, 'birdeye_state', true ) . ',' : null;
				$zip            = ( get_post_meta( $location_id, 'birdeye_zip', true ) ) ? get_post_meta( $location_id, 'birdeye_zip', true ) : null;
				$countryCode           = ( get_post_meta( $location_id, 'birdeye_countryCode', true ) ) ? get_post_meta( $location_id, 'birdeye_countryCode', true ) : null;
				$coverImageUrl         = ( get_post_meta( $location_id, 'birdeye_coverImageUrl', true ) ) ? get_post_meta( $location_id, 'birdeye_coverImageUrl', true ) : null;
				$googleUrl             = ( get_post_meta( $location_id, 'birdeye_googleUrl', true ) ) ? get_post_meta( $location_id, 'birdeye_googleUrl', true ) : null;
				$alrv_slo_billing_number      = $post_fields['alrv_slo_billing_number'];
				$state_term = get_the_terms( $location_id, 'location-state' );
				$state_id   = ( isset( $state_term[0]->term_id ) ) ? $state_term[0]->term_id : null;

				$alrv_to_hdr_secondbtn           = ( isset( $option_fields['alrv_to_hdr_secondbtn'] ) ) ? $option_fields['alrv_to_hdr_secondbtn'] : null;
				?>
			<div class="item">
				<div class="loc-sngl d-flex justify-content-between align-items-center flex-wrap">

					<div class="location-image column">
						<?php
						if ( has_post_thumbnail( $location_id ) ) {
							echo wp_get_attachment_image( get_post_thumbnail_id( $location_id ), 'thumb_800', null, array( 'class' => '' ) );
						} elseif ( $coverImageUrl ) {
							?>
						<img src="<?php echo $coverImageUrl; ?>" alt="<?php the_title(); ?>" />
						<?php } else { ?>
						<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/defaults/default-image.webp"
							alt="<?php the_title(); ?>" />
						<?php } ?>
					</div>
					<div class="location-text column">

						<h2>
							<?php
							if ( $alrv_slo_title ) {
								echo $alrv_slo_title;
							} elseif ( get_post_meta( $location_id, 'birdeye_alias', true ) ) {
								echo get_post_meta( $location_id, 'birdeye_alias', true );
							} else {
								echo get_post_meta( $location_id, 'birdeye_name', true ); }
							?>
						</h2>
						<?php
						// Check if it is Clinical Research Type - To display it's logo below.
						$condition_term = get_the_terms( $location_id, 'location-type' );
						if ( $condition_term ) {
							foreach ( $condition_term as $condition ) {
								$current_location_type = $condition->slug;
								if ( $current_location_type == 'clinical-research' ) {
									?>
						<div class="rch-type d-flex align-items-center">
							<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/clinical-research.svg"
								alt="">
									<?php echo $condition->name; ?>
						</div>
									<?php
								}
								break;
							}
						}
						?>

						<div class="s-40"></div>
						<div class="loc-address">
							<p class="heading-6">
								<?php _e( 'Address', 'alrv_td' ); ?>
							</p>

							<p><a href="<?php echo $googleUrl; ?>" target="_blank"><?php echo $address1 . '' . $address2 . ' ' . $city . ' ' . $state . ' ' . $zip; ?></a>
							</p>

						</div>
						<div class="phone d-flex align-items-center">
							<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/phone-icon.svg"
								alt="">
							<p>Phone: <a href="tel:<?php echo get_post_meta( $location_id, 'birdeye_phone', true ); ?>"><?php echo get_post_meta( $location_id, 'birdeye_phone', true ); ?></a></p>
						</div>
						<?php if ( $alrv_slo_fax ) { ?>
						<div class="fax d-flex align-items-center">
							<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/fax-icon.svg"
								alt="">
							<p>Fax: <a href="tel:<?php echo $alrv_slo_fax; ?>"><?php echo $alrv_slo_fax; ?></a></p>
						</div>
						<?php } ?>
						<?php if ( $alrv_slo_billing_number ) { ?>
						<div class="billing d-flex align-items-center">
							<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/billing-icon.svg"
								alt="">
							<p>Billing number: <a href="tel:<?php echo $alrv_slo_billing_number; ?>"><?php echo $alrv_slo_billing_number; ?></a></p>
						</div>
						<?php } ?>
						<div class="s-20"></div>
						<?php
						if ( $alrv_slo_external_btn ) {
							echo glide_acf_button( $alrv_slo_external_btn, 'button  apt-btn' );

						} else {
							if ( $state_id ) {
								$alrv_to_hdr_secondbtn['url'] = $alrv_to_hdr_secondbtn['url'] . '?app-state=' . $state_id . '&app-location=' . $location_id;
							} else {
								$alrv_to_hdr_secondbtn['url'] = $alrv_to_hdr_secondbtn['url'] . '?app-location=' . $location_id;
							}
							if ( $alrv_to_hdr_secondbtn ) {
								echo glide_acf_button( $alrv_to_hdr_secondbtn, 'button  apt-btn' );
							}
						}
						?>
						<a href="<?php echo get_the_permalink( $location['location_id'] ); ?>"
							class="button aqua-btn loc-btn"><?php _e( 'show location details', 'alrv_td' ); ?></a>
					</div>
				</div>
			</div>
			<?php } ?>

		</div>
	</div>
</section>
<?php } ?>
<div class="s-120"></div>
