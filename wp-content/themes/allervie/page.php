<?php
/**
 * The template for displaying all pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
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


$alrv_tdho_title = ( isset( $fields['alrv_tdho_title'] ) ) ? $fields['alrv_tdho_title'] : null;
if ( ! $alrv_tdho_title ) {
	$alrv_tdho_title = get_the_title();
}
$alrv_tdho_text = ( isset( $fields['alrv_tdho_text'] ) ) ? $fields['alrv_tdho_text'] : null;
$alrv_tdho_one  = ( isset( $fields['alrv_tdho_one'] ) ) ? $fields['alrv_tdho_one'] : null;
$alrv_tdho_two  = ( isset( $fields['alrv_tdho_two'] ) ) ? $fields['alrv_tdho_two'] : null;

?>


<section id="hero-section" class="hero-section hero-default">

	<!-- hero start -->
	<div class="hero-default
	<?php
	if ( has_post_thumbnail() ) {
		 echo 'with-image'; }
	?>
		 ">
		<div class="wrapper">
			<div class="s-100"></div>
			<?php
			if ( has_post_thumbnail() ) {
				?>
			<div class="d-flex justify-content-between align-items-start flex-wrap">
				<div class="banner-text">
					<h1 class="heading"><?php echo $alrv_tdho_title; ?></h1>
					<?php if ( $alrv_tdho_text ) { ?>
						<?php echo html_entity_decode( $alrv_tdho_text ); ?>
					<?php } ?>
					<?php
					if ( $alrv_tdho_one ) :
						echo glide_acf_button( $alrv_tdho_one, 'button' );
				endif;
					?>
					<?php
					if ( $alrv_tdho_two ) :
						echo glide_acf_button( $alrv_tdho_two, 'loadmore-btn' );
				endif;
					?>
				</div>
				<div class="banner-image">
					<?php
					if ( has_post_thumbnail() ) {
						?>

						<?php
							the_post_thumbnail(
								'thumb_800',
								array(
									'alt'   => get_the_title(),
									'title' => get_the_title(),
								)
							);
						?>

						<?php
					} else {
						?>
					<img src="<?php echo get_template_directory_uri(); ?>/assets/img/admin/defaults/default-image.webp"
						class="" alt="<?php get_the_title(); ?>" title="<?php get_the_title(); ?>"> <?php } ?>
				</div>
			</div>
			<?php } else { ?>
			<div class="d-flex justify-content-center align-items-start">



				<div class="banner-text center-align">
					<h1 class="heading"><?php echo $alrv_tdho_title; ?></h1>
					<?php if ( $alrv_tdho_text ) { ?>
						<?php echo html_entity_decode( $alrv_tdho_text ); ?>
					<?php } ?>
					<?php
					if ( $alrv_tdho_one ) :
						echo glide_acf_button( $alrv_tdho_one, 'button' );
							endif;
					?>
					<?php
					if ( $alrv_tdho_two ) :
						echo glide_acf_button( $alrv_tdho_two, 'loadmore-btn' );
							endif;
					?>
				</div>
			</div>
			<?php }; ?>
			<?php if ( ! $alrv_tdho_text && ! $alrv_tdho_one && ! $alrv_tdho_two ) { ?>
				<div class="s-40">
			<?php } else { ?>
				<div class="s-70">
			<?php } ?>
			</div>
		</div>
	</div>
	<!-- hero end -->
</section>
<section id="page-section" class="page-section">
	<!-- Content Start -->

	<?php
	while ( have_posts() ) {
		the_post();
		// Include specific template for the content.
		get_template_part( 'partials/content', 'page' );

	}
	?>

	<div class="clear"></div>

	<!-- Content End -->
</section>

<?php get_footer(); ?>
