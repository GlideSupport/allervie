<?php
/**
 * The template for displaying website footer
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Allervie
 * @since 1.0.0
 */
// Global variables
global $option_fields;
global $pID;
global $fields;

$pID = get_the_ID();

if ( is_home() ) {
	  $pID = get_option( 'page_for_posts' );
}

if ( is_404() || is_archive() || is_category() || is_search() ) {
	  $pID = get_option( 'page_on_front' );
}

if ( function_exists( 'get_fields' ) && function_exists( 'get_fields_escaped' ) ) {
	  $option_fields = get_fields_escaped( 'option' );
	  $fields        = get_fields_escaped( $pID );
}
?> <?php

// Default Footer Options

$footer_scripts = ( isset( $option_fields['footer_scripts'] ) ) ? $option_fields['footer_scripts'] : null;



// Schema Markup - ACF variables.


$alrv_schema_check = ( isset( $option_fields['alrv_schema_check'] ) ) ? $option_fields['alrv_schema_check'] : null;
if ( $alrv_schema_check ) {
	$alrv_schema_business_name       = html_entity_remove( $option_fields['alrv_schema_business_name'] );
	$alrv_schema_business_legal_name = html_entity_remove( $option_fields['alrv_schema_business_legal_name'] );
	$alrv_schema_street_address      = html_entity_remove( $option_fields['alrv_schema_street_address'] );
	$alrv_schema_locality            = html_entity_remove( $option_fields['alrv_schema_locality'] );
	$alrv_schema_region              = html_entity_remove( $option_fields['alrv_schema_region'] );
	$alrv_schema_postal_code         = html_entity_remove( $option_fields['alrv_schema_postal_code'] );
	$alrv_schema_map_short_link      = html_entity_remove( $option_fields['alrv_schema_map_short_link'] );
	$alrv_schema_latitude            = html_entity_remove( $option_fields['alrv_schema_latitude'] );
	$alrv_schema_longitude           = html_entity_remove( $option_fields['alrv_schema_longitude'] );
	$alrv_schema_opening_hours       = html_entity_remove( $option_fields['alrv_schema_opening_hours'] );
	$alrv_schema_telephone           = html_entity_remove( $option_fields['alrv_schema_telephone'] );
	$alrv_schema_business_email      = html_entity_remove( $option_fields['alrv_schema_business_email'] );
	$alrv_schema_business_logo       = html_entity_remove( $option_fields['alrv_schema_business_logo'] );
	$alrv_schema_price_range         = html_entity_remove( $option_fields['alrv_schema_price_range'] );
	$alrv_schema_type                = html_entity_remove( $option_fields['alrv_schema_type'] );
}
// Custom - ACF variables.

$alrv_ftrop_title     = ( isset( $option_fields['alrv_ftrop_title'] ) ) ? $option_fields['alrv_ftrop_title'] : null;
$alrv_ftrop_text      = ( isset( $option_fields['alrv_ftrop_text'] ) ) ? $option_fields['alrv_ftrop_text'] : null;
$alrv_ftrop_copyright = ( isset( $option_fields['alrv_ftrop_copyright'] ) ) ? $option_fields['alrv_ftrop_copyright'] : null;
$alrv_ftrop_text      = html_entity_decode( $alrv_ftrop_text );
$alrv_ftrop_copyright = html_entity_decode( $alrv_ftrop_copyright );

// Social Links -  Theme options
$alrv_to_social_fb = ( isset( $option_fields['alrv_to_social_fb'] ) ) ? $option_fields['alrv_to_social_fb'] : null;
$alrv_to_social_in = ( isset( $option_fields['alrv_to_social_in'] ) ) ? $option_fields['alrv_to_social_in'] : null;
$alrv_to_social_li = ( isset( $option_fields['alrv_to_social_li'] ) ) ? $option_fields['alrv_to_social_li'] : null;
$alrv_to_social_youtube = (isset($option_fields['alrv_to_social_youtube'])) ? $option_fields['alrv_to_social_youtube'] : null;

// Options Fields for Footer
$alrv_to_ftr_text      = ( isset( $option_fields['alrv_to_ftr_text'] ) ) ? $option_fields['alrv_to_ftr_text'] : null;
$alrv_to_ftr_rtngcode  = ( isset( $option_fields['alrv_to_ftr_rtngcode'] ) ) ? $option_fields['alrv_to_ftr_rtngcode'] : null;
$alrv_to_ftr_formtitle = ( isset( $option_fields['alrv_to_ftr_formtitle'] ) ) ? $option_fields['alrv_to_ftr_formtitle'] : null;
$alrv_to_ftr_form      = ( isset( $option_fields['alrv_to_ftr_form'] ) ) ? $option_fields['alrv_to_ftr_form'] : null;


// Footer Menus Section
$alrv_to_ftr_first_menu_title  = $option_fields['alrv_to_ftr_first_menu_title'];
$alrv_to_ftr_second_menu_title = $option_fields['alrv_to_ftr_second_menu_title'];
$alrv_to_ftr_third_menu_title  = $option_fields['alrv_to_ftr_third_menu_title'];
$alrv_to_ftr_fourth_menu_title = $option_fields['alrv_to_ftr_fourth_menu_title'];
$alrv_to_ftr_fifth_menu_title  = $option_fields['alrv_to_ftr_fifth_menu_title'];
$alrv_to_ftr_six_menu_title    = $option_fields['alrv_to_ftr_six_menu_title'];


$alrv_ft_note_text = ( isset( $fields['alrv_po_note_text'] ) ) ? $fields['alrv_po_note_text'] : $option_fields['alrv_to_note_text'];
$alrv_to_fnv       = ( isset( $fields['alrv_to_fnv'] ) ) ? $fields['alrv_to_fnv'] : null;


?>
</main>
<footer id="footer-section" class="footer-section">
	<?php get_template_part( 'partials/cta' ); ?>
	<?php if ( $alrv_to_fnv ) { ?>
	<div class="footer-notification-bar">
		<div class="wrapper">
			<div class="footer-note-ctn">
				<div class="footer-note-logo">
					<a href="https://allervieclinicalresearch.com/" target="_blank">
						<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/notification-logo.svg"
							alt="">
					</a>
				</div>
				<div class="footer-note-text">
					<?php echo html_entity_decode( $alrv_ft_note_text ); ?>
				</div>
			</div>
		</div>
	</div>
	<?php } ?>
	<!-- Footer Start -->
	<div class="footer-ctn">
		<div class="wrapper">
			<div class="footer-widgets d-flex justify-content-between flex-wrap">
				<div class="fw-left">
					<div class="footer-logo">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
							<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/allervie-logo.svg"
								alt="<?php echo get_bloginfo( 'name' ); ?>">
						</a>
					</div>
					<?php
					if ( $alrv_to_ftr_text ) {
						echo html_entity_decode( $alrv_to_ftr_text );
					}
					?>
					<?php if ( $alrv_to_ftr_rtngcode ) { ?>
					<div class="reviews-section">
						<?php echo html_entity_decode( $alrv_to_ftr_rtngcode, ENT_QUOTES ); ?>
					</div>
					<?php } ?>
					<div class="newsletter-form">
						<?php if ( $alrv_to_ftr_formtitle ) { ?>
						<h6 class="small-text"><?php echo $alrv_to_ftr_formtitle; ?></h6>
						<?php } ?>
						<?php echo do_shortcode( '[gravityform id="' . $alrv_to_ftr_form . '" title=false description=false ajax=true]' ); ?>
					</div>
					<div class="social-icons d-flex">
						<?php if ( $alrv_to_social_fb ) { ?>

						<a href="<?php echo $alrv_to_social_fb; ?>" target="_blank" class="facebook flex-center">
							<img width="16" height="16" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/facebook-icon.svg" alt="Facebook Icon">
						</a>
						<?php } ?>

						<?php if ( $alrv_to_social_in ) { ?>

						<a href="<?php echo $alrv_to_social_in; ?>" target="_blank" class="instagram flex-center">
							<img width="16" height="16"  src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/instagram-icon.svg" alt="Instagram Icon">
						</a>

						<?php } ?>

						<?php if ( $alrv_to_social_li ) { ?>

						<a href="<?php echo $alrv_to_social_li; ?>" target="_blank" class="linkdhin flex-center">
							<img width="16" height="16"  src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/linkedin-icon.svg" alt="LinkedIn Icon">
						</a>

						<?php } ?>
						<?php if ($alrv_to_social_youtube) {?>

						<a href="<?php echo $alrv_to_social_youtube; ?>" target="_blank" class="youtube flex-center">
							<img width="16" height="16"  src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/img/youtubeicon-img.svg" alt="YouTube Icon">
						</a>

						<?php }?>
						
					</div>
				</div>
				<div class="fw-right">
					<div class="single-widget">
						<div class="footer-nav">
							<div class="footer-menu-one">
								<?php if ( $alrv_to_ftr_first_menu_title ) { ?>
								<p class="small-text heading-6">
									<?php echo $alrv_to_ftr_first_menu_title; ?>
								</p>
								<?php } ?>
								<?php
									wp_nav_menu(
										array(
											'theme_location' => 'footer-nav-one',
											'fallback_cb' => 'menu_fallback',
										)
									);
									?>
							</div>
						</div>
					</div>
					<div class="single-widget">
						<div class="footer-nav">
							<div class="footer-menu-two">
								<?php if ( $alrv_to_ftr_second_menu_title ) { ?>
								<p class="small-text heading-6">
									<?php echo $alrv_to_ftr_second_menu_title; ?>
								</p>
								<?php } ?>
								<?php
									wp_nav_menu(
										array(
											'theme_location' => 'footer-nav-two',
											'fallback_cb' => 'menu_fallback',
										)
									);
									?>
							</div>
						</div>
					</div>
					<div class="single-widget">
						<div class="footer-nav">
							<div class="footer-menu-three">
								<?php if ( $alrv_to_ftr_third_menu_title ) { ?>
								<p class="small-text heading-6">
									<?php echo $alrv_to_ftr_third_menu_title; ?>
								</p>
								<?php } ?>
								<?php
									wp_nav_menu(
										array(
											'theme_location' => 'footer-nav-three',
											'fallback_cb' => 'menu_fallback',
										)
									);
									?>
							</div>
						</div>
					</div>
					<div class="single-widget">
						<div class="footer-nav">
							<div class="footer-menu-four">
								<?php if ( $alrv_to_ftr_fourth_menu_title ) { ?>
								<p class="small-text heading-6">
									<?php echo $alrv_to_ftr_fourth_menu_title; ?>
								</p>
								<?php } ?>
								<?php
									wp_nav_menu(
										array(
											'theme_location' => 'footer-nav-four',
											'fallback_cb' => 'menu_fallback',
										)
									);
									?>
							</div>
						</div>
					</div>
					<div class="single-widget">
						<div class="footer-nav">
							<div class="footer-menu-five">
								<?php if ( $alrv_to_ftr_fifth_menu_title ) { ?>
								<p class="small-text heading-6">
									<?php echo $alrv_to_ftr_fifth_menu_title; ?>
								</p>
								<?php } ?>
								<?php
									wp_nav_menu(
										array(
											'theme_location' => 'footer-nav-five',
											'fallback_cb' => 'menu_fallback',
										)
									);
									?>
							</div>
						</div>
					</div>
					<?php if ( ! empty( $alrv_to_ftr_six_menu_title ) || wp_get_nav_menu_items( wp_get_nav_menu_name( 'footer-nav-six' ) ) ) { ?>
						<div class="single-widget">
							<div class="footer-nav">
								<div class="footer-menu-six">
									<?php if ( $alrv_to_ftr_six_menu_title ) { ?>
									<h6 class="small-text">
										<?php echo $alrv_to_ftr_six_menu_title; ?>
									</h6>
									<?php } ?>
									<?php
										wp_nav_menu(
											array(
												'theme_location' => 'footer-nav-six',
												'fallback_cb' => 'menu_fallback',
											)
										);
										?>
								</div>
							</div>
						</div>
					<?php } ?>
				</div>
			</div>
			<div class="footer-bottom ">
				<div class="legal-nav">
					<div class="menu-legal-nav-container">
						<?php
							wp_nav_menu(
								array(
									'theme_location' => 'legal-nav',
									'fallback_cb'    => 'menu_fallback',
								)
							);
							?>
					</div>
				</div>
				<div class="copy-right"> © <?php echo date( 'Y' ); ?> AllerVie Health</div>
			</div>
		</div>
	</div>
	<!-- Footer End -->
	
	<?php
	if ( $alrv_schema_check ) {
		?>
	<script type="application/ld+json">
	{
		"@context": "http://schema.org",
		"@type": "<?php echo $alrv_schema_type; ?>",
		"address": {
			"@type": "PostalAddress",
			"addressLocality": "<?php echo $alrv_schema_locality; ?>",
			"addressRegion": "<?php echo $alrv_schema_region; ?>",
			"postalCode": "<?php echo $alrv_schema_postal_code; ?>",
			"streetAddress": "<?php echo $alrv_schema_street_address; ?>"
		},
		"hasMap": "<?php echo $alrv_schema_map_short_link; ?>",
		"geo": {
			"@type": "GeoCoordinates",
			"latitude": "<?php echo $alrv_schema_latitude; ?>",
			"longitude": "<?php echo $alrv_schema_longitude; ?>"
		},
		"name": "<?php echo $alrv_schema_business_name; ?>",
		"openingHours": "<?php echo $alrv_schema_opening_hours; ?>",
		"telephone": "<?php echo $alrv_schema_telephone; ?>",
		"email": "<?php echo $alrv_schema_business_email; ?>",
		"url": "<?php echo esc_url( home_url() ); ?>",
		"image": "<?php echo $alrv_schema_business_logo; ?>",
		"legalName": "<?php echo $alrv_schema_business_legal_name; ?>",
		"priceRange": "<?php echo $alrv_schema_price_range; ?>"
	}
	</script> <?php } ?>
</footer> <?php wp_footer(); ?> <?php
if ( $footer_scripts != '' ) {
	?>
<div style="display: none;">
	<?php echo html_entity_decode( $footer_scripts, ENT_QUOTES ); ?> </div> <?php } ?> </body>

</html>
