<?php
/**
 * Template Name: Contact
 * Template Post Type: page
 *
 * This template is for displaying home page.
 *
 * @link https://developer.wordpress.org/themes/template-files-section/page-template-files/
 *
 * @package Allervie
 * @since 1.0.0
 */

// Include header
get_header();

// Global variables
global $option_fields;
global $pID;
global $fields;

$alrv_cho_title = ( isset( $fields['alrv_cho_title'] ) && $fields['alrv_cho_title'] != '' ) ? $fields['alrv_cho_title'] : get_the_title();
$alrv_cho_txt   = ( isset( $fields['alrv_cho_txt'] ) ) ? $fields['alrv_cho_txt'] : null;
$alrv_cho_form  = ( isset( $fields['alrv_cho_form'] ) ) ? $fields['alrv_cho_form'] : null;

if ( has_post_thumbnail() ) {
	$src = get_the_post_thumbnail_url( $pID, 'thumb_2000' );
} else {
	$src = esc_url( get_template_directory_uri() ) . '/assets/img/admin/defaults/default-image.webp';
}

?>

<section id="hero-section" class="hero-section">

	<div class="hero-landingpage">
		<div class="contact-banner-image" style="background-image: url(<?php echo $src; ?>);"></div>
		<div class="wrapper">
			<div class="landing-hero-inner d-flex justify-content-between flex-wrap">
				<div class="form-left">
					<?php if ( $alrv_cho_title ) { ?>
					<h1 class="med-heading"><?php echo $alrv_cho_title; ?></h1>
					<?php } ?>
					<?php if ( $alrv_cho_txt ) { ?>
					<p><?php echo $alrv_cho_txt; ?></p>
					<?php } ?>
				</div>
				<?php if ( $alrv_cho_form ) { ?>
				<div class="form-right">
					<?php echo do_shortcode( '[gravityform id="' . $alrv_cho_form . '" title=false description=false ajax=true]' ); ?>
				</div>
				<?php } ?>
			</div>
		</div>
	</div>
	<!-- Content Start -->

	<div class="clear"></div>
	<!-- Content End -->
</section> <?php get_footer(); ?>
