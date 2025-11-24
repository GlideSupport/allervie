<?php
/**
 * Template Name: Homepage
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

$alrv_posttitle            = glide_page_title( 'alrv_tho_title' );
$alrv_tho_text             = $fields['alrv_tho_text'];
$alrv_tho_changing_content = $fields['alrv_tho_changing_content'];
$alrv_tho_first_button     = $fields['alrv_tho_first_button'];
$alrv_tho_second_button    = $fields['alrv_tho_second_button'];
$alrv_tho_not_text         = $fields['alrv_tho_not_text'];
$alrv_tho_not_button       = $fields['alrv_tho_not_button'];
?>
<section id="hero-section" class="hero-section">
	<!-- hero start -->
	<div class="home-hero">
		<?php if ( $alrv_tho_changing_content ) { ?>
		<div class="home-hero-image-slider owl-carousel owl-theme">
			<?php
			foreach ( $alrv_tho_changing_content as $content ) {
				$content_image = $content['image'];
				?>
			<div class="item">
				<div class="home-hero-image"
					style="background-image: url(<?php echo wp_get_attachment_image_url( $content_image, 'thumb_2000' ); ?>);">
				</div>
			</div>
			<?php } ?>
		</div>
		<?php } ?>
		<div class="wrapper">
			<div class="home-hero-slider d-flex align-items-center">
				<div class="home-hero-inner">
					<div class="home-banner-text">
						<h1 class="heading"><?php echo $alrv_posttitle; ?>
							<?php if ( $alrv_tho_changing_content ) { ?>
							<div class="home-hero-tag-slider owl-carousel owl-theme">
								<?php
								foreach ( $alrv_tho_changing_content as $content ) {
									$content_text = $content['text'];
									?>
								<div class="item">
									<span><?php echo $content_text; ?></span>
								</div>
								<?php } ?>
							</div>
							<?php } ?>
						</h1>
						<p class="mobile-hide"><?php echo $alrv_tho_text; ?></p>
						<div class="mobile-hide home-hero-buttons">
							<?php
							if ( $alrv_tho_first_button ) :
								echo glide_acf_button( $alrv_tho_first_button, 'button white-btn loc-btn' );
								endif;
							?>
							<?php
							if ( $alrv_tho_second_button ) :
								echo glide_acf_button( $alrv_tho_second_button, 'button apt-btn' );
								endif;
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="home-hero-mobile desktop-hide lblue-container">
		<div class="wrapper">
			<div class="home-banner-text">
				<p><?php echo $alrv_tho_text; ?>
				</p>
				<div class="home-hero-buttons">
					<?php
					if ( $alrv_tho_first_button ) :
						echo glide_acf_button( $alrv_tho_first_button, 'button white-btn loc-btn' );
						endif;
					?>
					<?php
					if ( $alrv_tho_second_button ) :
						echo glide_acf_button( $alrv_tho_second_button, 'button apt-btn' );
						endif;
					?>
				</div>
			</div>
		</div>
	</div>


	<?php if ( $alrv_tho_not_text || $alrv_tho_not_button['url'] ) { ?>
	<div class="wellcome-note">
		<div class="wrapper">
			<div class="wellcome-note-inner center-align">
				<p><?php echo $alrv_tho_not_text; ?> <?php
				if ( $alrv_tho_not_button ) :
					echo glide_acf_button( $alrv_tho_not_button, '' );
					endif;
				?>
				</p>
				<div class="close-btn">
				</div>
			</div>
		</div>
	</div>
	<?php } ?>
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
	<div class="ts-80"></div>
	<!-- Content End -->
</section>
<?php get_footer(); ?>