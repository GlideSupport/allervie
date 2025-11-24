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
 $pID         = get_the_ID();
 $post_fields = get_fields( $pID );

 $alrv_slo_title = ( isset( $post_fields['alrv_slo_title'] ) ) ? $post_fields['alrv_slo_title'] : null;

 $alrv_slo_fax = ( isset( $post_fields['alrv_slo_fax'] ) ) ? $post_fields['alrv_slo_fax'] : null;

if ( isset( $post_fields['alrv_slo_birdeye_location_id'] ) ) {
	$alrv_slo_birdeye_location_id = $post_fields['alrv_slo_birdeye_location_id'];
} else {
	$alrv_slo_birdeye_location_id = '';
}
$paged         = $args['paged'];
$address1      = ( get_post_meta( $pID, 'birdeye_address1', true ) ) ? get_post_meta( $pID, 'birdeye_address1', true ): null;
$address2      = ( get_post_meta( $pID, 'birdeye_address2', true ) ) ?  ', '. get_post_meta( $pID, 'birdeye_address2', true )  : null;
$city          = ( get_post_meta( $pID, 'birdeye_city', true ) ) ? '<br>' . get_post_meta( $pID, 'birdeye_city', true ) . ',' : null;
$state         = ( get_post_meta( $pID, 'birdeye_state', true ) ) ? get_post_meta( $pID, 'birdeye_state', true ) . ',' : null;
$zip           = ( get_post_meta( $pID, 'birdeye_zip', true ) ) ? get_post_meta( $pID, 'birdeye_zip', true ) : null;
$countryCode   = ( get_post_meta( $pID, 'birdeye_countryCode', true ) ) ? get_post_meta( $pID, 'birdeye_countryCode', true ) : null;
$coverImageUrl = ( get_post_meta( $pID, 'birdeye_coverImageUrl', true ) ) ? get_post_meta( $pID, 'birdeye_coverImageUrl', true ) : null;
$googleUrl      = ( get_post_meta( $pID, 'birdeye_googleUrl', true ) ) ? get_post_meta( $pID, 'birdeye_googleUrl', true ) : null;

if ( $alrv_slo_birdeye_location_id != '' ) {
	?>


<!-- single provider -->
<div class="srv-sngl-card" id="post-<?php the_ID(); ?>" data-page="<?php echo $paged; ?>"
	data-birdeye-id="<?php echo $alrv_slo_birdeye_location_id; ?>">

	<div class="srv-sngl-img">
		<a href="<?php the_permalink(); ?>">
			<?php
			if ( has_post_thumbnail() ) {
				the_post_thumbnail( 'thumb_800' );
			} elseif ( $coverImageUrl ) {
				?>
			<img src="<?php echo $coverImageUrl; ?>" alt="<?php the_title(); ?>" />
			<?php } else { ?>
			<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/defaults/default-image.webp"
				alt="<?php the_title(); ?>" />
			<?php } ?>
			<?php
			// Check if it is Clinical Research Type - To display it's logo below.
			$cli_yes        = false;
			$condition_term = get_the_terms( $pID, 'location-type' );
			if ( $condition_term ) {
				foreach ( $condition_term as $condition ) {
					$current_location_type = $condition->slug;
					if ( $current_location_type == 'clinical-research' ) {
						$cli_yes = true;
						?>
			<div class="services-catagories">
				<span class="cat-btn with-gdt
						<?php
						if ( $cli_yes ) {
							echo 'cr-cat'; }
						?>
	" style=""><?php echo $condition->name; ?></span>
			</div>
						<?php
					}
				}
			}
			?>
		</a>
	</div>

	<div class="srv-sngl-text
	<?php
	if ( ! $cli_yes ) {
		echo 'not-loc-tag'; }
	?>
	">

		<p class="heading-5"><a href="<?php the_permalink(); ?>">
				<?php
				if ( $alrv_slo_title ) {
					echo $alrv_slo_title;
				} elseif ( get_post_meta( $pID, 'birdeye_alias', true ) ) {
					echo get_post_meta( $pID, 'birdeye_alias', true );
				} else {
					echo get_post_meta( $pID, 'birdeye_name', true ); }
				?>
			</a></p>
		<p><a href="<?php echo $googleUrl; ?>" target="_blank"><?php echo $address1 . '' . $address2 . ' ' . $city . ' ' . $state . ' ' . $zip; ?></a></p>

		<div class="phone d-flex align-items-center">
			<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/phone-icon.svg" alt="">
			<p>Phone: <a href="tel:<?php echo get_post_meta( $pID, 'birdeye_phone', true ); ?>"><?php echo get_post_meta( $pID, 'birdeye_phone', true ); ?></a></p>
		</div>
		<?php if ( $alrv_slo_fax ) { ?>
		<div class="fax d-flex align-items-center">
			<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/fax-icon.svg" alt="">
			<p>Fax: <a href="tel:<?php echo $alrv_slo_fax; ?>"><?php echo $alrv_slo_fax; ?></a></p>
		</div>
		<?php } ?>

		<a href="<?php the_permalink(); ?>" class="button small-btn hide-on-mobile">learn more</a>
		<a href="<?php the_permalink(); ?>" class="learn-more show-on-mobile">learn more</a>
	</div>
</div>
<!-- single provider -->
<!-- #post-<?php the_ID(); ?> -->
<?php } ?>
