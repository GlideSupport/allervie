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
global $p_id;
global $fields;
$post_data = get_queried_object();
$pID       = get_the_ID();
if ( function_exists( 'get_fields' ) && function_exists( 'get_fields_escaped' ) ) {
	$post_fields = get_fields_escaped( $pID );
}

$alrv_seo_intro             = ( isset( $post_fields['alrv_seo_intro'] ) ) ? $post_fields['alrv_seo_intro'] : null;
$alrv_seo_start_date = ( isset( $post_fields['alrv_seo_start_date'] ) ) ? $post_fields['alrv_seo_start_date'] : null;
$alrv_seo_end_date   = ( isset( $post_fields['alrv_seo_end_date'] ) ) ? $post_fields['alrv_seo_end_date'] : null;
$alrv_seo_date       = date_formatting( $alrv_seo_start_date, $alrv_seo_end_date );
$alrv_seo_location          = ( isset( $post_fields['alrv_seo_location'] ) ) ? $post_fields['alrv_seo_location'] : null;
$alrv_to_cp_event_page_link = ( isset( $option_fields['alrv_to_cp_event_page_link'] ) ) ? $option_fields['alrv_to_cp_event_page_link'] : null;
// Post Tags & Categories
// $alrv_post_tags = get_the_tags($pID);
$alrv_post_categories = get_categories( $pID );

$alrv_seo_title = glide_page_title( 'alrv_seo_title' );

?>
<section id="hero-section" class="hero-section br-shape"
	style="background: linear-gradient(180deg, #DCEFFA 0%, rgba(220, 239, 250, 0) 100%);">
	<!-- hero start -->
	<div class="hero-condition-toolkit with-image">
		<div class="wrapper">
			<div class="s-50"></div>
			<div class="d-flex justify-content-between align-items-start flex-wrap">
				<div class="banner-image">
					<?php
					if ( has_post_thumbnail() ) {
						?>
					<div class="thumb">
						<?php
						the_post_thumbnail(
							'thumb_800',
							array(
								'alt'   => get_the_title(),
								'title' => get_the_title(),
							)
						);
						?>
					</div>
						<?php
					} else {
						?>
					<img src="<?php echo get_template_directory_uri(); ?>/assets/img/admin/defaults/default-image.webp"
						class="" alt="<?php get_the_title(); ?>" title="<?php get_the_title(); ?>"> <?php } ?>
				</div>
				<div class="banner-text">
					<?php if ( $alrv_to_cp_event_page_link ) { ?>
					<a href="<?php echo $alrv_to_cp_event_page_link; ?>" id="go-back" class="button white-btn">go back</a>
					<?php } ?>
					<div class="s-40"></div>
					<?php if ( $alrv_seo_title ) { ?>
					<h1 class="med-heading"><?php echo $alrv_seo_title; ?></h1>
					<?php } ?>
					<?php if ( $alrv_seo_intro ) { ?>
					<p><?php echo $alrv_seo_intro; ?></p>
					<?php } ?>
					<div class="event-detail d-flex flex-wrap">
						<?php if ( $alrv_seo_date ) { ?>
							<div class="event-date d-flex align-items-center">
								<span class="event-date-icon"><img
										src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/calendar-gradient.svg"
										alt=""></span>
								<span class="event-date-text"><?php echo $alrv_seo_date; ?></span>
							</div>
						<?php } ?>
						<div class="event-location d-flex align-items-center">
							<span class="event-location-icon"><img
									src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/map-marker.svg"
									alt=""></span>
							<?php if ( $alrv_seo_location ) { ?>
							<span class="event-location-text"><?php echo $alrv_seo_location; ?></span>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- hero end -->
</section>
<div class="s-100"></div>


<section id="page-section" class="page-section">
	<!-- Content Start -->

	<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<?php get_template_part( 'partials/content' ); ?>
	</div>

	<div class="clear"></div>
	<!-- Content End -->
</section>
