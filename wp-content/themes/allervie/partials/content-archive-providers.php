<?php
/**
 * Template part for displaying posts in an archive
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

 $pID           = get_the_ID();
$providersTypes = get_the_terms( $pID, 'providers-type' );
$providers      = join( ', ', wp_list_pluck( $providersTypes, 'name' ) );

$the_title = get_the_title( $pID );
$expr      = '/(?<=\s|^)\w/iu';
preg_match_all( $expr, $the_title, $matches );
$result = implode( '', $matches[0] );
$result = mb_strtoupper( $result );
$result = substr( $result, 0, 2 );

$get_clinical_providers = get_clinical_providers( $pID );

$providerLocation = get_provider_location( $pID );
$src              = wp_get_attachment_image_src( get_post_thumbnail_id( $pID ), 'thumb_400', false );
if ( $src ) {
	$src = $src[0];
}

?>
<!-- single provider -->
<article id="post-<?php the_ID(); ?>" <?php post_class( 'prdr-sngl center-align' ); ?>>

	<?php if ( $src ) { ?>
	<div class="prdr-image">
		<a href="<?php echo get_the_permalink( $pID ); ?>"><div class="prder-image-inner" style="background-image: url(<?php echo $src; ?>);"></div></a>
	</div>
	<?php } else { ?>
		<a href="<?php echo get_the_permalink( $pID ); ?>">
			<div class="prdr-image  d-flex justify-content-center align-items-center">
				<h3><?php echo $result; ?></h3>
			</div>
		</a>
	<?php } ?>
	<div class="prdr-content">

		<p class="prdr-title blue-text heading-6">
			<a href="<?php echo get_the_permalink( $pID ); ?>"><?php echo $the_title; ?></a>
		</p>
		<?php if ( $providers ) { ?>
		<div class="mobile-hide prdr-type xs-text blue-text">
			<?php _e( 'Provider Type', 'alrv_td' ); ?>
		</div>
		<p class="mobile-hide"><?php echo $providers; ?></p>
		<?php } ?>
		<?php if ( $providerLocation ) { ?>
		<div class="prdr-location xs-text blue-text">
			<?php _e( 'Location', 'alrv_td' ); ?>
		</div>
		<p><?php echo $providerLocation; ?></p>
		<?php } ?>
		<a href="<?php echo get_the_permalink( $pID ); ?>"
			class="button small-btn hide-on-mobile"><?php _e( 'Learn More', 'alrv_td' ); ?></a>
		<a href="<?php echo get_the_permalink( $pID ); ?>"
			class="learn-more show-on-mobile"><?php _e( 'Learn More', 'alrv_td' ); ?></a>
	</div>
</article>
<!-- #post-<?php the_ID(); ?> -->
