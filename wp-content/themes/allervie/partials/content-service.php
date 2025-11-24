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

$post_data = get_queried_object();
$pID       = get_the_ID();
if ( function_exists( 'get_fields' ) && function_exists( 'get_fields_escaped' ) ) {
	$post_fields = get_fields_escaped( $pID );
}

// Post Tags & Categories
// $alrv_post_tags = get_the_tags($pID);
$alrv_post_categories = get_categories( $pID );

// Page Options
$alrv_posttitle      = glide_page_title( 'alrv_sso_title' );
$alrv_sso_introtext  = $post_fields['alrv_sso_introtext'];
$alrv_sso_info_title = $post_fields['alrv_sso_info_title'];
$alrv_sso_info_text  = $post_fields['alrv_sso_info_text'];
$alrv_to_hdr_secondbtn = $option_fields['alrv_to_hdr_secondbtn'];
// Theme Options
$alrv_to_cp_services_page_link = $option_fields['alrv_to_cp_services_page_link'];

?>

<section id="hero-section" class="hero-service-toolkit hero-section aqua-gradiant-container br-shape">
	<!-- Hero Start -->
	<div class="s-50"></div>
	<div class="with-image">
		<div class="wrapper">
			<div class="d-flex justify-content-between align-items-start">
				<div class="banner-image">
					<?php
					if ( has_post_thumbnail() ) {
						the_post_thumbnail( 'thumb_800' );
					} else {
						?>
					<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/defaults/default-image.webp"
						alt="<?php the_title(); ?>">
					<?php } ?>
				</div>
				<div class="banner-text">
					<?php if ( $alrv_to_cp_services_page_link ) { ?>
					<a href="<?php echo $alrv_to_cp_services_page_link; ?>" id="go-back" class="button white-btn"><span><img
								src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/arrow-left.svg"
								alt=""></span> <?php _e( 'go back', 'alrv_td' ); ?></a>
					<?php } ?>
					<div class="s-40"></div>
					<h1 class="med-heading"><?php echo $alrv_posttitle; ?></h1>
					<?php if ( $alrv_sso_introtext ) { ?>
					<p><?php echo $alrv_sso_introtext; ?></p>
					<?php } ?>
						<?php
						if( $alrv_to_hdr_secondbtn ) {
							echo glide_acf_button( $alrv_to_hdr_secondbtn, 'button  apt-btn' );
						}
					?>
				</div>

			</div>
		</div>
	</div>
	<!-- Hero End  -->
</section>

<?php if ( $alrv_sso_info_title || $alrv_sso_info_text ) { ?>
<!-- Information Section container  -->
<section class="border-container">
	<div class="wrapper">
		<div class="information-section d-flex  flex-wrap">
			<div class="info-icon info-icon-blue">
				<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/information-blue-icon.svg"
					alt="">
			</div>
			<div class="info-icon info-icon-white">
				<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/information-white-icon.svg"
					alt="">
			</div>
			<div class="info-text">
				<h4>
					<?php echo $alrv_sso_info_title; ?>
				</h4>
				<p><?php echo $alrv_sso_info_text; ?></p>
			</div>
		</div>
	</div>
</section>
<?php } ?>

<section id="page-section" class="page-section">
	<!-- Content Start -->
	<div class="s-100"></div>
	<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<?php get_template_part( 'partials/content' ); ?>
	</div>

	<div class="clear"></div>
	<!-- Content End -->
</section>
