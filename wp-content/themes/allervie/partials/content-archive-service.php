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
$service_term = get_the_terms( $pID, 'services' );
?>
<!-- single provider -->
<div class="srv-sngl-card" id="post-<?php the_ID(); ?>" <?php post_class( 'prdr-sngl center-align' ); ?>>
	<a href="<?php the_permalink(); ?>" class="srv-inner-card">
		<div class="srv-sngl-img">
			<?php
			if ( has_post_thumbnail() ) {
				echo wp_get_attachment_image( get_post_thumbnail_id( $pID ), 'thumb_500', false );
			} else {
				?>
			<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/defaults/default-image.webp"
				alt="<?php the_title(); ?>">
			<?php } ?>
			<?php if ( $service_term ) { ?>
			<div class="services-catagories">
				<?php foreach ( $service_term as $service ) { ?>
				<span class="cat-btn"
					style="background-color: <?php echo get_field( 'alrv_tax_cso_color', $service->taxonomy . '_' . $service->term_id ); ?>;"><?php echo $service->name; ?></span>
				<?php break; } ?>
			</div>
			<?php } ?>
		</div>
		<div class="srv-sngl-text hide-text-on-mobile">
			<p class="heading-5">
				<?php the_title(); ?>
			</p>
			<?php
			if ( has_excerpt() ) {
				the_excerpt();
			} else {
				?>
				<?php echo glide_excerpt_nomore( 100 ); } ?>
			<span class="button small-btn hide-on-mobile"><?php esc_html_e( 'learn more', 'alrv_td' ); ?></span>
			<span class="learn-more show-on-mobile"><?php esc_html_e( 'learn more', 'alrv_td' ); ?></span>
		</div>
	</a>
</div>
<!-- #post-<?php the_ID(); ?> -->
