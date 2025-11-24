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
$pID=get_the_ID();

$alrv_tmp_ppc_title = (isset($fields['alrv_tmp_ppc_title'])) ? $fields['alrv_tmp_ppc_title'] : null;
$alrv_tmp_ppc_text = (isset($fields['alrv_tmp_ppc_text'])) ? $fields['alrv_tmp_ppc_text'] : null;
$alrv_tmp_ppc_phone = (isset($fields['alrv_tmp_ppc_phone'])) ? $fields['alrv_tmp_ppc_phone'] : null;

$alrv_tmp_ppc_partner_logo = (isset($fields['alrv_tmp_ppc_partner_logo'])) ? $fields['alrv_tmp_ppc_partner_logo'] : null;
$alrv_tmp_ppc_partner_logo = wp_get_attachment_image( $alrv_tmp_ppc_partner_logo, 'thumb_200', null, array( 'class' => '' ) );

$alrv_tmp_ppc_partner_link = (isset($fields['alrv_tmp_ppc_partner_link'])) ? $fields['alrv_tmp_ppc_partner_link'] : null;

$alrv_tmp_ppc_form = (isset($fields['alrv_tmp_ppc_form'])) ? $fields['alrv_tmp_ppc_form'] : null;
$alrv_tmp_ppc_form_title = (isset($fields['alrv_tmp_ppc_form_title'])) ? $fields['alrv_tmp_ppc_form_title'] : null;
$alrv_tmp_ppc_from_text = (isset($fields['alrv_tmp_ppc_from_text'])) ? $fields['alrv_tmp_ppc_from_text'] : null;

$alrv_tmp_ppc_tracking_code = (isset($fields['alrv_tmp_ppc_tracking_code'])) ? $fields['alrv_tmp_ppc_tracking_code'] : null;

$alrv_tmp_ppc_footer_text = (isset($fields['alrv_tmp_ppc_footer_text'])) ? $fields['alrv_tmp_ppc_footer_text'] : null;
$alrv_tmp_ppc_footer_code = (isset($fields['alrv_tmp_ppc_footer_code'])) ? $fields['alrv_tmp_ppc_footer_code'] : null;

$alrv_tmp_ppc_not_banner_text = (isset($fields['alrv_tmp_ppc_not_banner_text'])) ? $fields['alrv_tmp_ppc_not_banner_text'] : null;
$alrv_tmp_ppc_not_banner_button = (isset($fields['alrv_tmp_ppc_not_banner_button'])) ? $fields['alrv_tmp_ppc_not_banner_button'] : null;

//Tabbed Section Fields
$alrv_tmp_ppc_tabs_section_title = (isset($fields['alrv_tmp_ppc_tabs_section_title'])) ? $fields['alrv_tmp_ppc_tabs_section_title'] : null;
$alrv_tmp_ppc_content_type = (isset($fields['alrv_tmp_ppc_content_type'])) ? $fields['alrv_tmp_ppc_content_type'] : null;
$alrv_tmp_ppc_tab_1_title = (isset($fields['alrv_tmp_ppc_tab_1_title'])) ? $fields['alrv_tmp_ppc_tab_1_title'] : null;
$alrv_tmp_ppc_new_badge_1 = (isset($fields['alrv_tmp_ppc_new_badge_1'])) ? $fields['alrv_tmp_ppc_new_badge_1'] : null;
$alrv_tmp_ppc_tab_1_headline = (isset($fields['alrv_tmp_ppc_tab_1_headline'])) ? $fields['alrv_tmp_ppc_tab_1_headline'] : null;
$alrv_tmp_ppc_tab_1_description = (isset($fields['alrv_tmp_ppc_tab_1_description'])) ? $fields['alrv_tmp_ppc_tab_1_description'] : null;
$alrv_tmp_ppc_tab_1_content_type = (isset($fields['alrv_tmp_ppc_tab_1_content_type'])) ? $fields['alrv_tmp_ppc_tab_1_content_type'] : null;
$alrv_tmp_ppc_tab_1_class = (isset($fields['alrv_tmp_ppc_tab_1_class'])) ? $fields['alrv_tmp_ppc_tab_1_class'] : null;
$alrv_tmp_ppc_tab_1_content_field = html_entity_decode(isset($fields['alrv_tmp_ppc_tab_1_content'])) ? $fields['alrv_tmp_ppc_tab_1_content'] : null;
$alrv_tmp_ppc_tab_1_content = html_entity_decode($alrv_tmp_ppc_tab_1_content_field);
$alrv_tmp_ppc_tab_1_form = (isset($fields['alrv_tmp_ppc_tab_1_form'])) ? $fields['alrv_tmp_ppc_tab_1_form'] : null;
$alrv_tmp_ppc_tab_1_button = (isset($fields['alrv_tmp_ppc_tab_1_button'])) ? $fields['alrv_tmp_ppc_tab_1_button'] : null;
$alrv_tmp_ppc_tab_1_button_class = (isset($fields['alrv_tmp_ppc_tab_1_button_class'])) ? $fields['alrv_tmp_ppc_tab_1_button_class'] : null;
$alrv_tmp_ppc_tab_2_title = (isset($fields['alrv_tmp_ppc_tab_2_title'])) ? $fields['alrv_tmp_ppc_tab_2_title'] : null;
$alrv_tmp_ppc_new_badge_2 = (isset($fields['alrv_tmp_ppc_new_badge_2'])) ? $fields['alrv_tmp_ppc_new_badge_2'] : null;
$alrv_tmp_ppc_tab_2_headline = (isset($fields['alrv_tmp_ppc_tab_2_headline'])) ? $fields['alrv_tmp_ppc_tab_2_headline'] : null;
$alrv_tmp_ppc_tab_2_description = (isset($fields['alrv_tmp_ppc_tab_2_description'])) ? $fields['alrv_tmp_ppc_tab_2_description'] : null;
$alrv_tmp_ppc_tab_2_content_type = (isset($fields['alrv_tmp_ppc_tab_2_content_type'])) ? $fields['alrv_tmp_ppc_tab_2_content_type'] : null;
$alrv_tmp_ppc_tab_2_class = (isset($fields['alrv_tmp_ppc_tab_2_class'])) ? $fields['alrv_tmp_ppc_tab_2_class'] : null;
$alrv_tmp_ppc_tab_2_content_field = (isset($fields['alrv_tmp_ppc_tab_2_content'])) ? $fields['alrv_tmp_ppc_tab_2_content'] : null;
$alrv_tmp_ppc_tab_2_content = html_entity_decode($alrv_tmp_ppc_tab_2_content_field);
$alrv_tmp_ppc_tab_2_form = (isset($fields['alrv_tmp_ppc_tab_2_form'])) ? $fields['alrv_tmp_ppc_tab_2_form'] : null;
$alrv_tmp_ppc_tab_2_button = (isset($fields['alrv_tmp_ppc_tab_2_button'])) ? $fields['alrv_tmp_ppc_tab_2_button'] : null;
$alrv_tmp_ppc_tab_2_button_class = (isset($fields['alrv_tmp_ppc_tab_2_button_class'])) ? $fields['alrv_tmp_ppc_tab_2_button_class'] : null;


$src = wp_get_attachment_image_url( get_post_thumbnail_id(  $pID ), 'thumb_900' );
if ( ! has_post_thumbnail() ) {
	$src = esc_url( get_template_directory_uri() ) . '/assets/img/admin/defaults/default-image.webp';
} else {
	$src = $src;
}

$src_desktop = wp_get_attachment_image_url( get_post_thumbnail_id(  $pID ), 'full' );
if ( ! has_post_thumbnail() ) {
	$src_desktop = esc_url( get_template_directory_uri() ) . '/assets/img/admin/defaults/default-image.webp';
} else {
	$src_desktop = $src_desktop;
}
?>
<header class="header-section ppc-header-section">
	<div class="header-wrapper big-wrapper header-inner d-flex align-items-start justify-content-between">

		<div class="header-logo">
			<div class="logo ppc-logo-area">
				<?php if($alrv_tmp_ppc_partner_logo || $alrv_tmp_ppc_partner_link){  ?>
					<a href="<?php echo $alrv_tmp_ppc_partner_link; ?>" class="location-header-logo"> <?php echo $alrv_tmp_ppc_partner_logo; ?>  </a>
				<?php } ?>
				<a class="hide-on-mobile" href="<?php echo esc_url( home_url( '/' ) ); ?>">
					<img width="170" height="55" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/allervie-logo.svg"	alt="<?php echo get_bloginfo( 'name' ); ?>" />
				</a>
			</div>

		</div>
		<?php if($alrv_tmp_ppc_phone){  ?>
			<div class="right-header header-navigation">
				<a href="tel:<?php echo $alrv_tmp_ppc_phone; ?>" class="button aqua-btn ppc-header-phone big-btn"><?php echo $alrv_tmp_ppc_phone; ?></a>
			</div>
		<?php } ?>
	</div>
</header>

<!-- Main Area Start -->
<main id="main-section" class="main-section">
	<?php if ($alrv_tmp_ppc_not_banner_text || $alrv_tmp_ppc_not_banner_button['url']) {?>
		<div class="wellcome-note">
			<div class="wrapper">
				<div class="wellcome-note-inner center-align">
					<p><?php echo $alrv_tmp_ppc_not_banner_text; ?> <?php
						if ($alrv_tmp_ppc_not_banner_button):
							echo glide_acf_button($alrv_tmp_ppc_not_banner_button, '');
						endif;
						?>
					</p>
					<div class="close-btn">
					</div>
				</div>
			</div>
		</div>
	<?php }?>
	<section id="hero-section" class="hero-section">
		<!-- hero start -->
		<div class="ppc-hero-ctn <?php echo ($alrv_tmp_ppc_content_type) == 'tab' ? 'banner-tab-ppc' : ''; ?>" style="background-image: url(<?php echo $src_desktop; ?>);">
			<div class="wrapper">
				<div class="ppc-content-ctn">
					<div class="ppc-content">
						<?php if($alrv_tmp_ppc_title){  ?>
							<h1 class="heading-1"> <?php echo $alrv_tmp_ppc_title; ?>  </h1>
						<?php } ?>
						<?php
							if($alrv_tmp_ppc_text){
								echo html_entity_decode($alrv_tmp_ppc_text);
							}
						?>
						<?php if($alrv_tmp_ppc_phone){  ?>
							<a href="tel:<?php echo $alrv_tmp_ppc_phone; ?>" class="button aqua-btn ppc-header-phone big-btn"><?php echo $alrv_tmp_ppc_phone; ?></a>
						<?php } ?>
					</div>
					<?php if($alrv_tmp_ppc_content_type == 'form' && !empty($alrv_tmp_ppc_form)) { ?>
						<div class="ppc-hero-form">
							<div class="form-title">
								<?php if($alrv_tmp_ppc_form_title){  ?>
									<h2 class="heading-4"> <?php echo $alrv_tmp_ppc_form_title; ?>  </h2>
								<?php } ?>
								<?php
									if($alrv_tmp_ppc_from_text){
										echo '<p>'.$alrv_tmp_ppc_from_text.'</p>';
									}
								?>
							</div>
								<?php
								if($alrv_tmp_ppc_form){
									echo do_shortcode( '[gravityform id="' . $alrv_tmp_ppc_form . '" title=false description=false ajax=true]' );
								}
								?>

							<div class="ppc-hero-mobile-img">
								<img src="<?php echo $src; ?>" alt="<?php the_title(); ?>">
							</div>
						</div>
					<?php } ?>
					<?php if($alrv_tmp_ppc_content_type == 'tab') { ?>
						<!--Tabs Section-->
						<section class="ppc-tab-block">
							<div class="tab-inner">
								<?php if(!empty($alrv_tmp_ppc_tabs_section_title)) { ?>
									<div class="ppc-tab-title">
										<h4><?php echo $alrv_tmp_ppc_tabs_section_title; ?></h4>
									</div>
								<?php } ?>
								<div class="tab-block">
									<div id="content">
										<div class="tabContainer">
										  	<?php if(!empty($alrv_tmp_ppc_tab_1_title) || !empty($alrv_tmp_ppc_tab_2_title)) { ?>
											    <ul class="ppc-tabs">
											    	<?php if(!empty($alrv_tmp_ppc_tab_1_title)) { ?>
												      <li><a src="tab1" href="javascript:void(0);" class="active <?php echo $alrv_tmp_ppc_tab_1_class; ?>"><?php echo $alrv_tmp_ppc_tab_1_title; ?><?php echo ($alrv_tmp_ppc_new_badge_1 == 1) ? '<span>NEW</span>' : '' ;?></a></li>
												  	<?php } ?>
												  	<?php if(!empty($alrv_tmp_ppc_tab_2_title)) { ?>
												      <li><a src="tab2" href="javascript:void(0);" class="<?php echo $alrv_tmp_ppc_tab_2_class; ?>"><?php echo $alrv_tmp_ppc_tab_2_title; ?><?php echo ($alrv_tmp_ppc_new_badge_2 == 1) ? '<span>NEW</span>' : '' ;?></a></li>
												  	<?php } ?>
											    </ul>
											<?php } ?>
										    <div class='line'></div>
										    <?php if(!empty($alrv_tmp_ppc_tab_1_content) || !empty($alrv_tmp_ppc_tab_1_form) || !empty($alrv_tmp_ppc_tab_2_content) || !empty($alrv_tmp_ppc_tab_2_form)) { ?>
											    <div class="tabContent-ppc">
											    	<?php if(!empty($alrv_tmp_ppc_tab_1_headline) || !empty($alrv_tmp_ppc_tab_1_content) || !empty($alrv_tmp_ppc_tab_1_form)) { ?>
														<div id="tab1" class="<?php echo $alrv_tmp_ppc_tab_1_class; ?>">
															<?php if(!empty($alrv_tmp_ppc_tab_1_headline) || !empty($alrv_tmp_ppc_tab_1_description)) { ?>
																<div class="title-row">
																	<?php if(!empty($alrv_tmp_ppc_tab_1_headline)) { ?>
																		<h5><?php echo $alrv_tmp_ppc_tab_1_headline; ?></h5>
																	<?php } ?>
																	<?php if(!empty($alrv_tmp_ppc_tab_1_description)) { ?>
																		<p><?php echo $alrv_tmp_ppc_tab_1_description; ?></p>
																	<?php } ?>
																</div>
															<?php } ?>
															<?php if($alrv_tmp_ppc_tab_1_content_type == 'form') { ?>
																<div class="content-row">
								                					<?php echo do_shortcode( '[gravityform id="' . $alrv_tmp_ppc_tab_1_form . '" title=false description=false ajax=true]' ); ?>
								                				</div>
															<?php } else { ?>
																<div class="content-row">
																	<?php echo $alrv_tmp_ppc_tab_1_content; ?>
																</div>
															<?php } ?>
															<?php if(!empty($alrv_tmp_ppc_tab_1_button)) { ?>
																<div class="button-row">
								                    				<?php echo glide_acf_button( $alrv_tmp_ppc_tab_1_button, 'button large-btn' ); ?>
																</div>
															<?php } ?>
														</div>
													<?php } ?>
													<?php if(!empty($alrv_tmp_ppc_tab_2_headline) || !empty($alrv_tmp_ppc_tab_2_content) || !empty($alrv_tmp_ppc_tab_2_form)) { ?>
												      	<div id="tab2" class="<?php echo $alrv_tmp_ppc_tab_2_class; ?>">
												      		<?php if(!empty($alrv_tmp_ppc_tab_2_headline) || !empty($alrv_tmp_ppc_tab_2_description)) { ?>
																<div class="title-row">
																	<?php if(!empty($alrv_tmp_ppc_tab_2_headline)) { ?>
																		<h5><?php echo $alrv_tmp_ppc_tab_2_headline; ?></h5>
																	<?php } ?>
																	<?php if(!empty($alrv_tmp_ppc_tab_2_description)) { ?>
																		<p><?php echo $alrv_tmp_ppc_tab_2_description; ?></p>
																	<?php } ?>
																</div>
															<?php } ?>
															<?php if($alrv_tmp_ppc_tab_2_content_type == 'form') { ?>
																<div class="content-row">
								                					<?php echo do_shortcode( '[gravityform id="' . $alrv_tmp_ppc_tab_2_form . '" title=false description=false ajax=true]' ); ?>
								                				</div>
															<?php } else { ?>
																<div class="content-row">
																	<?php echo $alrv_tmp_ppc_tab_2_content; ?>
																</div>
															<?php } ?>
															<?php if(!empty($alrv_tmp_ppc_tab_2_button)) { ?>
																<div class="button-row">
								                    				<?php echo glide_acf_button( $alrv_tmp_ppc_tab_2_button, 'button large-btn' ); ?>
																</div>
															<?php } ?>
												        </div>
												    <?php } ?>
											    </div>
											<?php } ?>
										</div>
									</div>
								</div>
							</div>
						</section>
					<?php } ?>
				</div>
			</div>
		</div>
		<!-- hero end -->
	</section>
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
		<div class="ts-80"></div>
		<!-- Content End -->
	</section>
</main>

<footer id="footer-section" class="footer-section">
		<!-- Footer Start -->
		<div class="footer-ctn ppc-landing-footer">
			<div class="wrapper">
				<div class="footer-top">
					<div class="footer-left-area">
						<div class="footer-logo">
							<a href="#"><img src="<?php echo esc_url( get_template_directory_uri() )  ?>/assets/img/site-logo.svg" alt=""></a>
						</div>
						<div class="footer-text-area">
							<p><?php echo $alrv_tmp_ppc_footer_text; ?></p>
						</div>
					</div>
					<div class="footer-right-area">
						<div class="ppc-patient-rating">
							<?php echo html_entity_decode($alrv_tmp_ppc_footer_code); ?>
						</div>
					</div>
				</div>
				<div class="footer-bottom ">
					<div class="copy-right">Copyright © <?php echo date( 'Y' ); ?> By Glidedesign</div>
					<div class="legal-nav">
						<div class="menu-legal-nav-container">
							<?php
							wp_nav_menu(
								array(
									'theme_location' => 'legal-nav',
									'fallback_cb'    => 'menu_fallback',
								)
							);
							?>
						</div>
					</div>

				</div>
			</div>
		</div>
	</footer>
	<script>
		jQuery(document).ready(function(){
			jQuery('.srv-inner-card').each(function(){
				jQuery(this).attr('target','_blank');
			});
		});
		jQuery('.ppc-tabs li a').click(function(e) {
        e.preventDefault();
        var tabId = jQuery(this).attr('src');
        jQuery('.ppc-tabs li a').removeClass('active');
        jQuery(this).addClass('active');
        jQuery('.tabContent-ppc > div').hide();
        jQuery('#' + tabId).show();
    });
	</script>

<?php

if($alrv_tmp_ppc_tracking_code){
	echo '<script src="https://scripts.iconnode.com/'.$alrv_tmp_ppc_tracking_code.'.js?v='.ASSET_VERSION_JS.'"></script>';
}
