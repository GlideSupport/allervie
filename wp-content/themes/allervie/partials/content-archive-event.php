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
 global $p_id;
 global $fields;
 $post_fields = get_fields( $p_id );

 $alrv_seo_title = ( isset( $post_fields['alrv_seo_title'] ) ) ? $post_fields['alrv_seo_title'] : null;
if ( ! $alrv_seo_title ) {
	$alrv_seo_title = get_the_title();
}
 $alrv_seo_intro      = ( isset( $post_fields['alrv_seo_intro'] ) ) ? $post_fields['alrv_seo_intro'] : null;
 $alrv_seo_start_date = ( isset( $post_fields['alrv_seo_start_date'] ) ) ? $post_fields['alrv_seo_start_date'] : null;
 $alrv_seo_end_date   = ( isset( $post_fields['alrv_seo_end_date'] ) ) ? $post_fields['alrv_seo_end_date'] : null;
 $alrv_seo_date       = date_formatting( $alrv_seo_start_date, $alrv_seo_end_date );
 $alrv_seo_location   = ( isset( $post_fields['alrv_seo_location'] ) ) ? $post_fields['alrv_seo_location'] : null;
 $alrv_seo_button     = ( isset( $post_fields['alrv_seo_button'] ) ) ? $post_fields['alrv_seo_button'] : null;

?>

<!-- single provider -->
<div id="post-<?php the_ID(); ?>" <?php post_class( 'sngl-event-card d-flex align-items-stretch' ); ?>>
	<div class="event-card-left">
		<?php
		if ( has_post_thumbnail() ) {
			?>
			<?php
					the_post_thumbnail(
						'thumb_400',
						array(
							'alt'   => get_the_title(),
							'title' => get_the_title(),
						)
					);
			?>
			<?php
		} else {
			?>
		<img src="<?php echo get_template_directory_uri(); ?>/assets/img/admin/defaults/default-image.webp" class=""
			alt="<?php get_the_title(); ?>" title="<?php get_the_title(); ?>"> <?php } ?>

	</div>
	<div class="event-card-right d-flex justify-content-between align-items-center">
		<div class="event-card-content">
			<p class="event-title heading-5"><?php echo $alrv_seo_title; ?></p>
			<?php if ( $alrv_seo_intro ) { ?>
			<p><?php echo $alrv_seo_intro; ?></p>
			<?php } ?>

			<div class="event-detail d-flex flex-wrap">
				<div class="event-date d-flex align-items-center">
					<span class="event-date-icon d-flex align-items-center"><img
							src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/calendar-gradient.svg"
							alt=""></span>
					<?php if ( $alrv_seo_date ) { ?>
					<span class="event-date-text"><?php echo $alrv_seo_date; ?></span>
					<?php } ?>
				</div>
				<div class="event-location d-flex align-items-center">
					<span class="event-location-icon d-flex align-items-center"><img
							src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/map-marker.svg"
							alt=""></span>
					<?php if ( $alrv_seo_location ) { ?>
					<span class="event-location-text"><?php echo $alrv_seo_location; ?></span>
					<?php } ?>
				</div>
			</div>
		</div>
		<div class="event-btn">
			<?php
			if ( $alrv_seo_button ) {
				echo glide_acf_button( $alrv_seo_button, 'button small-btn hide-on-mobile' );
			} else {
				?>
				<a href="<?php the_permalink(); ?>" class="button small-btn hide-on-mobile">View More</a>
			<?php } ?>
			<?php
			if ( $alrv_seo_button ) {
				echo glide_acf_button( $alrv_seo_button, 'learn-more show-on-mobile' );
			} else {
				?>
				<a href="<?php the_permalink(); ?>" class="learn-more show-on-mobile">View More</a>
			<?php } ?>
		</div>
	</div>
</div>
<!-- #post-<?php the_ID(); ?> -->
