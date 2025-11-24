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
$alrv_to_social_rh_fb = ( isset( $option_fields['alrv_to_social_rh_fb'] ) ) ? $option_fields['alrv_to_social_rh_fb'] : null;
$alrv_to_social_rh_in = ( isset( $option_fields['alrv_to_social_rh_in'] ) ) ? $option_fields['alrv_to_social_rh_in'] : null;
$alrv_to_social_rh_li = ( isset( $option_fields['alrv_to_social_rh_li'] ) ) ? $option_fields['alrv_to_social_rh_li'] : null;
$alrv_to_social_rh_youtube = ( isset( $option_fields['alrv_to_social_rh_youtube'] ) ) ? $option_fields['alrv_to_social_rh_youtube'] : null;
$alrv_to_social_rh_twitter = ( isset( $option_fields['alrv_to_social_rh_twitter'] ) ) ? $option_fields['alrv_to_social_rh_twitter'] : null;

// Regional Hub Site Logo 
$alrv_to_regional_hub_logo = ( isset( $option_fields['alrv_to_regional_hub_logo'] ) ) ? $option_fields['alrv_to_regional_hub_logo'] : null;

$alrv_ft_note_text = ( isset( $fields['alrv_po_note_text'] ) ) ? $fields['alrv_po_note_text'] : $option_fields['alrv_to_note_text'];
$alrv_to_fnv       = ( isset( $fields['alrv_to_fnv'] ) ) ? $fields['alrv_to_fnv'] : null;
$rhlp_footer_logo = get_field('rhlp_footer_logo');
$rhlp_social_media_footer = get_field('rhlp_social_media');

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
	<!-- new footer -->
	<footer class="main-site-footer">
		<div class="wrapper">
			<div class="footer-row">
				<div class="cl-left">
					<div class="column column-1">
						<?php if(!empty($rhlp_footer_logo) || !empty($alrv_to_regional_hub_logo)) { ?>
							<div class="site-footer-logo">
								<a href="/premier-allergist/">
									<?php if(!empty($rhlp_footer_logo)) {
										$image_url = wp_get_attachment_image_url($rhlp_footer_logo, 'logo');
									} else {
					            		$image_url = wp_get_attachment_image_url($alrv_to_regional_hub_logo, 'logo');
									} ?>
					       	 		<img src="<?php echo esc_url($image_url); ?>" alt="<?php echo "Premier Allergist Logo"; ?>" />
								</a>
							</div>
						<?php } ?>
						<?php if(!empty($rhlp_social_media_footer)) { ?>
							<div class="footer-social">
								<ul>
								<?php foreach($rhlp_social_media_footer as $soc_data) { 
									$soc_name = $soc_data['social_platform_name'];
									$soc_icon = $soc_data['social_platform_icon'];
									$soc_url = $soc_data['social_platform_url'];
									if(!empty($soc_url) && !empty($soc_icon)) { ?>
										<li>
											<a href="<?php echo $soc_url; ?>" target="_blank" class="<?php echo $soc_name; ?> flex-center">
												<img width="16" height="16" src="<?php echo $soc_icon['url']; ?>" alt="<?php echo $soc_icon['title']; ?>">
											</a>
										</li>
									<?php } ?>
								<?php } ?>
								</ul>
							</div>
						<?php } else { ?>
							<div class="footer-social">
								<ul>
									<?php if ( $alrv_to_social_rh_fb ) { ?>
										<li>
											<a href="<?php echo $alrv_to_social_rh_fb; ?>" target="_blank" class="facebook flex-center">
												<img width="16" height="16" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/facebook-icon.svg" alt="Facebook Icon">
											</a>	
										</li>
									<?php } ?>
									
									<?php if ( $alrv_to_social_rh_in ) { ?>
										<li>
											<a href="<?php echo $alrv_to_social_rh_in; ?>" target="_blank" class="instagram flex-center">
												<img width="16" height="16"  src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/instagram-icon.svg" alt="Instagram Icon">
											</a>
										</li>
									<?php } ?>
									
									
									<?php if ( $alrv_to_social_rh_li ) { ?>
										<li>
											<a href="<?php echo $alrv_to_social_rh_li; ?>" target="_blank" class="linkdhin flex-center">
												<img width="16" height="16"  src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/linkedin-icon.svg" alt="LinkedIn Icon">
											</a>
										</li>
									<?php } ?>

								
									<?php if ($alrv_to_social_rh_youtube) {?>
										<li>
											<a href="<?php echo $alrv_to_social_rh_youtube; ?>" target="_blank" class="youtube flex-center">
												<img width="16" height="16"  src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/img/youtubeicon-img.svg" alt="YouTube Icon">
											</a>
										</li>
									<?php }?>
									
								</ul>
							</div>
						<?php } ?>
					</div>
					<div class="column column-2">
						<div class="footer-desc">
						 <?php the_field('rhlp_footer_text'); ?>
						</div>
					</div>
				</div>
				<div class="cl-right">
					<div class="quick-links">
						<?php
							wp_nav_menu(
								array(
									'theme_location' => 'footer-nav-regional-hub',
									'fallback_cb' => 'menu_fallback',
								)
							);
						?>
					</div>
				</div>
			</div>
			<div class="footer-bottom-row">
				<div class="site-copyright">
					© <?php echo date( 'Y' ); ?> AllerVie Health
				</div>
				<div class="footer-site-links">
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
		</div>
	</footer>
	<!-- new footer end here-->
	
<script type="text/javascript">
	jQuery(document).ready(function() {
    // Function to be called when 'shrink' class is added
    function onBodyClassChange(mutationsList, observer) {
        for (const mutation of mutationsList) {
            if (mutation.type === 'attributes' && mutation.attributeName === 'class') {
                const bodyClassList = mutation.target.classList;
                if (bodyClassList.contains('shrink')) {
        			jQuery('body').addClass('notice-bar-hidden');
                }
            }
        }
    }

    // Create a MutationObserver to watch for changes in the body class
    const observer = new MutationObserver(onBodyClassChange);

    // Configuration of the observer:
    const config = { attributes: true, attributeFilter: ['class'] };

    // Start observing the body element
    observer.observe(document.body, config);

    // Event handler for close button click
    jQuery('.close-btn').on('click', function() {
        jQuery('.notice').hide();
        jQuery('body').addClass('notice-bar-hidden');
    });
});
</script>


	
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
