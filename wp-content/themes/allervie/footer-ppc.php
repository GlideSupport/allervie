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
$footer_scripts = ( isset( $option_fields['footer_scripts'] ) ) ? $option_fields['footer_scripts'] : null;

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
 <?php wp_footer(); ?>
 <?php
if ( $footer_scripts != '' ) {
	?>
<div style="display: none;">
	<?php echo html_entity_decode( $footer_scripts, ENT_QUOTES ); ?> </div> <?php } ?> </body>

</html>
