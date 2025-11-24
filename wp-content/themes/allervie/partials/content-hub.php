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
global $pID;
global $fields;

$alrv_posttitle            = glide_page_title( 'alrv_tho_title' );
$alrv_tho_text             = $fields['alrv_tho_text'];
$alrv_tho_changing_content = $fields['alrv_tho_changing_content'];
$alrv_tho_first_button     = $fields['alrv_tho_first_button'];
$alrv_tho_second_button    = $fields['alrv_tho_second_button'];
$alrv_tho_not_text         = $fields['alrv_tho_not_text'];
$alrv_tho_not_button       = $fields['alrv_tho_not_button'];
$rhlp_footer_left_right    = $fields['rhlp_footer_left_right'];
$alrv_tho_sub_text         = isset($fields['alrv_tho_sub_text']) ? $fields['alrv_tho_sub_text'] : '';

// Secondary Navigation
$alrv_psn_menu_items = ( isset( $fields['alrv_psn_menu_items'] ) ) ? $fields['alrv_psn_menu_items'] : null;

if ( $alrv_psn_menu_items ) {
	$has_sec_nav .= ' has-header-links ';
}

$right_class = "";
if ( $rhlp_footer_left_right == 'right' ){
	$right_class = "hero-section-right-content";
}

?>
<section id="hero-section" class="hero-section <?php echo $right_class; ?>">
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
						<?php if($alrv_tho_sub_text){ ?>
							<div class="mobile-hide sub_text"><?php the_field('alrv_tho_sub_text'); ?></div>
						<?php } ?>
						<?php if($alrv_tho_text){ ?>
							<p class="mobile-hide"><?php echo $alrv_tho_text; ?></p>
						<?php } ?>
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
				<?php if($alrv_tho_sub_text){ ?>
					<div class="sub_text"><?php the_field('alrv_tho_sub_text'); ?></div>
				<?php } ?>
				<?php if($alrv_tho_text){ ?>
					<p><?php echo $alrv_tho_text; ?></p>
				<?php } ?>
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

<?php 
if ( $alrv_psn_menu_items ) {
	?>
	<div class="scroll-nav-links header-links d-flex justify-content-center align-items-center flex-wrap">
		<?php
		foreach ( $alrv_psn_menu_items as $menuitem ) {
			$menuitem_icon    = $menuitem['icon'];
			$menuitem_heading = $menuitem['heading'];
			$menuitem_link    = $menuitem['link'];
			if ( substr( $menuitem_link, 0, 1 ) === '#' ) {
				$menuitem_link = sanitize_title( $menuitem_link );
				$menuitem_link = '#' . $menuitem_link;
			}
			?>
			<div class="header-sngl-lnk">
				<a href="<?php echo $menuitem_link; ?>" class="" title="">
					<?php if(!empty($menuitem_icon)){
						echo '<span class="hd-link-icon">';
						echo wp_get_attachment_image( $menuitem_icon, 'thumb_32_32' );
						echo '</span>';
					} ?>
					<?php echo $menuitem_heading; ?>
				</a>
			</div>
		<?php } ?>
	</div>
	<div class="scroll-nav-link header-links-mobile">
		<div class="jump-link-title"><span class="jump-down-icon"></span> Jump to section</div>
		<div class="jumplink-mb-ctn">
			<?php
			foreach ( $alrv_psn_menu_items as $menuitem ) {
				$menuitem_icon    = $menuitem['icon'];
				$menuitem_heading = $menuitem['heading'];
				$menuitem_link    = $menuitem['link'];
				if ( substr( $menuitem_link, 0, 1 ) === '#' ) {
					$menuitem_link = sanitize_title( $menuitem_link );
					$menuitem_link = '#' . $menuitem_link;
				}
				?>
				<div class="head-links-mobile">
					<div class="header-sngl-lnk">
						<a href="<?php echo $menuitem_link; ?>" class="" title="">
						<?php if(!empty($menuitem_icon)){
							echo '<span class="hd-link-icon">';
							echo wp_get_attachment_image( $menuitem_icon, 'thumb_32_32' );
							echo '</span>';
						} ?>
						
						<?php echo $menuitem_heading; ?>
					</a>
				</div>
			</div>
			<?php } ?>
		</div>
	</div>
	<?php 
} 
?>

<section id="page-section" class="page-section">
	<!-- Content Start -->
	<?php
	// while ( have_posts() ) {
		// the_post();
		// Include specific template for the content.
		get_template_part( 'partials/content', 'page' );
	// }
	?>
	<div class="clear"></div>
	<!-- Content End -->
</section>
