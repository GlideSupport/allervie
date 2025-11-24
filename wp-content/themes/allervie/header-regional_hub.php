<?php
/**
 * The template for displaying website header
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Allervie
 * @since 1.0.0
 */
// Global variables
global $option_fields;
global $pID;
global $fields;
$pID = get_the_ID();
if ( is_home() ) {
	$pID = get_option( 'page_for_posts' );
}
if ( is_404() || is_archive() || is_category() || is_search() ) {
	$pID = get_option( 'page_on_front' );
}
if ( function_exists( 'get_fields' ) && function_exists( 'get_fields_escaped' ) ) {
	$option_fields = get_fields_escaped( 'option' );
	$fields        = get_fields_escaped( $pID );
}
// Page Tags - Advanced custom fields variables
$tracking = ( isset( $option_fields['tracking_code'] ) ) ? $option_fields['tracking_code'] : null;
$ccss     = ( isset( $option_fields['custom_css'] ) ) ? $option_fields['custom_css'] : null;
$hscripts = ( isset( $option_fields['head_scripts'] ) ) ? $option_fields['head_scripts'] : null;
$bscripts = ( isset( $option_fields['body_scripts'] ) ) ? $option_fields['body_scripts'] : null;
// Page variables - Advanced custom fields variables
$alrv_to_hdr_notifybtn = ( isset( $option_fields['alrv_to_hdr_notifybtn'] ) ) ? $option_fields['alrv_to_hdr_notifybtn'] : null;
$alrv_to_hdr_firstbtn  = ( isset( $option_fields['alrv_to_hdr_firstbtn'] ) ) ? $option_fields['alrv_to_hdr_firstbtn'] : null;
$alrv_to_hdr_secondbtn = ( isset( $option_fields['alrv_to_hdr_secondbtn'] ) ) ? $option_fields['alrv_to_hdr_secondbtn'] : null;

// Secondary Navigation
$alrv_psn_menu_items = ( isset( $fields['alrv_psn_menu_items'] ) ) ? $fields['alrv_psn_menu_items'] : null;
$alrv_hub_pg_op = $fields['alrv_hub_pg_op'] ?? '';

// Regional Hub Site Logo 
$alrv_to_regional_hub_logo = ( isset( $option_fields['alrv_to_regional_hub_logo'] ) ) ? $option_fields['alrv_to_regional_hub_logo'] : null;

// var_dump( $alrv_psn_menu_items );

$has_sec_nav = 'has-main-menu';

if ( has_nav_menu( 'top-nav' ) ) {
	$has_sec_nav = ' has-secondary-nav ';
}

if ( $alrv_psn_menu_items ) {
	$has_sec_nav .= ' has-header-links ';
}

$body_classes = array(
	$has_sec_nav,
);


// Social Links -  Theme options
$alrv_to_social_rh_fb = ( isset( $option_fields['alrv_to_social_rh_fb'] ) ) ? $option_fields['alrv_to_social_rh_fb'] : null;
$alrv_to_social_rh_in = ( isset( $option_fields['alrv_to_social_rh_in'] ) ) ? $option_fields['alrv_to_social_rh_in'] : null;
$alrv_to_social_rh_li = ( isset( $option_fields['alrv_to_social_rh_li'] ) ) ? $option_fields['alrv_to_social_rh_li'] : null;
$alrv_to_social_rh_youtube = ( isset( $option_fields['alrv_to_social_rh_youtube'] ) ) ? $option_fields['alrv_to_social_rh_youtube'] : null;
$alrv_to_social_rh_twitter = ( isset( $option_fields['alrv_to_social_rh_twitter'] ) ) ? $option_fields['alrv_to_social_rh_twitter'] : null;

$alrv_header_phone_number = get_field('rhlp_header_phone_number');
$rhlp_header_logo = get_field('rhlp_header_logo');
$rhlp_social_media_header = get_field('rhlp_social_media');

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="format-detection" content="telephone=no">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimal-ui" />
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<?php
		// Add Head Scripts
	if ( $hscripts != '' ) {
		echo html_entity_decode( $hscripts, ENT_QUOTES );
	}
	?>
	<link rel="apple-touch-icon" sizes="180x180"
		href="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/pwa/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32"
		href="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/pwa/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16"
		href="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/pwa/favicon-16x16.png">
	<link rel="icon" sizes="any"
		href="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/pwa/favicon.ico">
	<link rel="icon" type="image/svg+xml"
		href="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/pwa/icon.svg">
	<link rel="manifest" href="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/pwa/site.webmanifest">
	<meta name="theme-color" content="#088D8D">
	<meta name="mobile-web-app-capable" content="yes">
	<meta name="application-name" content="BaseTheme Package">
	<!-- Windows Phone -->
	<meta name="msapplication-navbutton_color" content="#0047FE">
	<meta name="msapplication-TileColor" content="#0047FE">
	<meta name="msapplication-tap-highlight" content="no">
	<meta name="msapplication-TileImage"
		content="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/pwa/pwa-icon-144.png">
	<!-- iOS Safari -->
	<meta name="apple-mobile-web-app-status-bar-style" content="#0047FE">
	<?php
		// Tracking Code
	if ( $tracking != '' ) {
		echo html_entity_decode( $tracking, ENT_QUOTES );
	}
		// Custom CSS
	if ( $ccss != '' ) {
		echo '<style type="text/css">';
		echo html_entity_decode( $ccss, ENT_QUOTES );
		echo '</style>';
	}
	?>
	
	<?php wp_head(); ?> <script>
	"serviceWorker" in navigator && window.addEventListener("load", function() {
		navigator.serviceWorker.register("/sw.js").then(function(e) {
			console.log("ServiceWorker registration successful with scope: ", e.scope)
		}, function(e) {
			console.log("ServiceWorker registration failed: ", e)
		})
	});
	</script>
	

</head>

<body <?php body_class( $body_classes ); ?>> <?php wp_body_open(); ?> <?php
if ( $bscripts != '' ) {
	?>
	<div style="display: none;">
		<?php echo html_entity_decode( $bscripts, ENT_QUOTES ); ?> </div> <?php } ?> <a
		class="skip-link screen-reader-text"
		href="#page-section"><?php esc_html_e( 'Skip to content', 'alrv_td' ); ?></a>
	<header id="header-section" class="header-section header-no-menu">
		<!-- Header Start -->
		
		<?php $header_notice_text = get_field('rhlp_header_notice'); ?>
		<?php if($header_notice_text){ ?>
		<div class="notice">
			<span class="close-btn"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
<path d="M15.8919 17.0537L2.92832 4.09003C2.60305 3.76476 2.60305 3.23679 2.92832 2.91152C3.25359 2.58625 3.78156 2.58625 4.10683 2.91152L17.0705 15.8751C17.3957 16.2004 17.3957 16.7284 17.0705 17.0537C16.7452 17.3789 16.2172 17.3789 15.8919 17.0537Z" fill="white"></path>
<path d="M17.0712 4.08998L4.10761 17.0536C3.78234 17.3789 3.25437 17.3789 2.9291 17.0536C2.60383 16.7283 2.60383 16.2004 2.9291 15.8751L15.8927 2.91147C16.218 2.5862 16.746 2.5862 17.0712 2.91147C17.3965 3.23674 17.3965 3.76472 17.0712 4.08998Z" fill="white"></path>
</svg></span>

			<?php echo $header_notice_text; ?>
			
		</div>
		<?php } ?>
		<div class="top-bar">
		
			<?php if ( has_nav_menu( 'regional-hub-nav' ) ) { ?>
				<div class="big-wrapper d-flex justify-content-end">
						<?php if(!empty($rhlp_social_media_header)) { ?>
							<div class="social-icons d-flex">
								<?php foreach($rhlp_social_media_header as $soc_data) { 
									$soc_name = $soc_data['social_platform_name'];
									$soc_icon = $soc_data['social_platform_icon'];
									$soc_url = $soc_data['social_platform_url'];
									if(!empty($soc_url) && !empty($soc_icon)) { ?>
										<a href="<?php echo $soc_url; ?>" target="_blank" class="<?php echo $soc_name; ?> flex-center">
											<img width="16" height="16" src="<?php echo $soc_icon['url']; ?>" alt="<?php echo $soc_icon['title']; ?>">
										</a>
									<?php } ?>
								<?php } ?>
							</div>
						<?php } else { ?>
							<div class="social-icons d-flex">

								<?php if ( $alrv_to_social_rh_fb ) { ?>

								<a href="<?php echo $alrv_to_social_rh_fb; ?>" target="_blank" class="facebook flex-center">
									<img width="16" height="16" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/facebook-icon.svg" alt="Facebook Icon">
								</a>
								<?php } ?>

								<?php if ( $alrv_to_social_rh_in ) { ?>

								<a href="<?php echo $alrv_to_social_rh_in; ?>" target="_blank" class="instagram flex-center">
									<img width="16" height="16"  src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/instagram-icon.svg" alt="Instagram Icon">
								</a>

								<?php } ?>

								<?php if ( $alrv_to_social_rh_li ) { ?>

								<a href="<?php echo $alrv_to_social_rh_li; ?>" target="_blank" class="linkdhin flex-center">
									<img width="16" height="16"  src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/linkedin-icon.svg" alt="LinkedIn Icon">
								</a>

								<?php } ?>
								<?php if ($alrv_to_social_rh_youtube) {?>

								<a href="<?php echo $alrv_to_social_rh_youtube; ?>" target="_blank" class="youtube flex-center">
									<img width="16" height="16"  src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/img/youtubeicon-img.svg" alt="YouTube Icon">
								</a>

								<?php }?>
								<?php if ($alrv_to_social_rh_twitter) {?>

								<a href="<?php echo $alrv_to_social_rh_twitter; ?>" target="_blank" class="twitter flex-center">
									<img width="16" height="16"  src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/img/twittericon-img.svg" alt="YouTube Icon">
								</a>

								<?php }?>
							</div>
						<?php } ?>
					<?php
							wp_nav_menu(
								array(
									'theme_location' => 'regional-hub-nav',
									'fallback_cb'    => 'nav_fallback',
								)
							);
					?>
				</div>
			<?php } ?>
			</div>
		
		<div class="header-wrapper header-inner d-flex align-items-top justify-content-between">
			<?php if(!empty($rhlp_header_logo) || !empty($alrv_to_regional_hub_logo)) { ?>
				<div class="header-logo d-flex align-items-start">
					<div class="logo">
					    <a href="/premier-allergist/">
					    	<?php if(!empty($rhlp_header_logo)) { 
					    		$image_url = wp_get_attachment_image_url($rhlp_header_logo, 'logo');
					    	} else {
					            $image_url = wp_get_attachment_image_url($alrv_to_regional_hub_logo, 'logo');
					        } ?>
					        <img width="273" height="75" src="<?php echo esc_url($image_url); ?>" alt="<?php echo "Premier Allergist Logo"; ?>" />
					    </a>
					</div>
				</div>
			<?php } ?>
			<div class="right-header header-navigation">
				<div class="nav-overlay">
					<div class="nav-container">

						
							<div class="menu-mobile secondary-nav">
								<?php
								wp_nav_menu(
									array(
										'theme_location' => 'regional-hub-nav',
										'fallback_cb'    => 'nav_fallback',
									)
								);
								if(!empty($rhlp_social_media_header)) { ?>
									<div class="social-icons d-flex">
										<?php foreach($rhlp_social_media_header as $soc_data) { 
											$soc_name = $soc_data['social_platform_name'];
											$soc_icon = $soc_data['social_platform_icon'];
											$soc_url = $soc_data['social_platform_url'];
											if(!empty($soc_url) && !empty($soc_icon)) { ?>
												<a href="<?php echo $soc_url; ?>" target="_blank" class="<?php echo $soc_icon; ?> flex-center">
													<img width="16" height="16" src="<?php echo $soc_icon['url']; ?>" alt="<?php echo $soc_icon['title']; ?>">
												</a>
											<?php } ?>
										<?php } ?>
									</div>
								<?php } else { ?>
									<div class="social-icons d-flex">

												<?php if ( $alrv_to_social_rh_fb ) { ?>

												<a href="<?php echo $alrv_to_social_rh_fb; ?>" target="_blank" class="facebook flex-center">
													<img width="16" height="16" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/facebook-icon.svg" alt="Facebook Icon">
												</a>
												<?php } ?>

												<?php if ( $alrv_to_social_rh_in ) { ?>

												<a href="<?php echo $alrv_to_social_rh_in; ?>" target="_blank" class="instagram flex-center">
													<img width="16" height="16"  src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/instagram-icon.svg" alt="Instagram Icon">
												</a>

												<?php } ?>

												<?php if ( $alrv_to_social_rh_li ) { ?>

												<a href="<?php echo $alrv_to_social_rh_li; ?>" target="_blank" class="linkdhin flex-center">
													<img width="16" height="16"  src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/linkedin-icon.svg" alt="LinkedIn Icon">
												</a>

												<?php } ?>
												<?php if ($alrv_to_social_rh_youtube) {?>

												<a href="<?php echo $alrv_to_social_rh_youtube; ?>" target="_blank" class="youtube flex-center">
													<img width="16" height="16"  src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/img/youtubeicon-img.svg" alt="YouTube Icon">
												</a>

												<?php }?>
												<?php if ($alrv_to_social_rh_twitter) {?>

												<a href="<?php echo $alrv_to_social_rh_twitter; ?>" target="_blank" class="twitter flex-center">
													<img width="16" height="16"  src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/img/youtubeicon-img.svg" alt="YouTube Icon">
												</a>

												<?php }?>
									</div>
								<?php } ?>
							</div>


						
							<div class="header-btns">
								<?php
								if ( $alrv_to_hdr_secondbtn ) :
									if(get_post_type(get_the_ID())=='location'){
										$state_term     = get_the_terms( get_the_ID(), 'location-state' );
										$state_id       = ( isset( $state_term[0]->term_id ) ) ? $state_term[0]->term_id : null;
										if ( $state_id ) {
											$alrv_to_hdr_secondbtn['url'] = $alrv_to_hdr_secondbtn['url'] . '?app-state=' . $state_id . '&app-location=' . get_the_ID();
										} else {
											$alrv_to_hdr_secondbtn['url'] = $alrv_to_hdr_secondbtn['url'] . '?app-location=' . get_the_ID();
										}
										if(isset($_GET['gclid'])){
											$alrv_to_hdr_secondbtn['url'] = $alrv_to_hdr_secondbtn['url'] . '&gclid='.$_GET['gclid'];
										}
										if(isset($_GET['wc_clear'])){
											$alrv_to_hdr_secondbtn['url'] = $alrv_to_hdr_secondbtn['url'] . '&wc_clear='.$_GET['wc_clear'];
										}
									}
									echo glide_acf_button( $alrv_to_hdr_secondbtn, 'button apt-btn small-btn' );
									endif;
								?>
								
								<?php 
								if( $alrv_header_phone_number ): 

									$link_url = $alrv_header_phone_number['url'];
									$link_title = $alrv_header_phone_number['title'];
								?>
								<a class="button gradient-btn info-colored-variation" href="<?php echo esc_html( $link_url ); ?>">
																<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
										<g clip-path="url(#clip0_226_113)">
										<path d="M0.252325 7.14717C1.46014 11.9457 8.05538 18.5455 12.853 19.7479C13.5007 19.9121 14.1661 19.9957 14.8342 19.9969C16.1039 19.9963 17.354 19.6843 18.4749 19.0881C19.8586 18.3654 20.3944 16.6579 19.6717 15.2743C19.5397 15.0217 19.3703 14.7905 19.1693 14.5886L17.2735 12.6928C16.4515 11.8706 15.2098 11.6359 14.1444 12.1011C13.6472 12.3155 13.1937 12.6195 12.8067 12.9981C12.6449 13.159 12.3468 13.1845 11.9188 13.0681C9.65164 12.1468 7.85297 10.3484 6.93121 8.08149C6.8167 7.65344 6.84032 7.35442 7.0021 7.19358C7.38091 6.80616 7.68527 6.3524 7.90001 5.85492C8.36411 4.78968 8.12942 3.54895 7.30836 2.72678L5.41257 0.831898C4.78282 0.194391 3.88487 -0.101197 2.99965 0.0375235C2.10442 0.169001 1.32682 0.722464 0.909357 1.52526C-0.00606277 3.2508 -0.240557 5.25705 0.252325 7.14717ZM2.5207 2.36865C2.67119 2.08058 2.95072 1.88218 3.27229 1.83518C3.32247 1.82719 3.37322 1.82321 3.42407 1.82337C3.68837 1.82329 3.94168 1.92898 4.12748 2.11691L6.02236 4.0118C6.31394 4.29998 6.40006 4.73693 6.23958 5.1142C6.11546 5.41006 5.93836 5.68081 5.71701 5.91306C5.05404 6.61937 4.84651 7.63938 5.18083 8.54862C5.837 11.0024 9.00241 14.1642 11.4517 14.8195C12.3645 15.1527 13.3873 14.9416 14.0936 14.2742C14.3245 14.053 14.5936 13.8757 14.8879 13.7507C15.2654 13.5898 15.7028 13.6759 15.9912 13.9679L17.8861 15.8628C18.112 16.0864 18.2168 16.4049 18.1678 16.7189C18.1199 17.0409 17.92 17.3203 17.6307 17.4696C16.3036 18.1824 14.7548 18.3631 13.2993 17.9749C9.16959 16.9469 3.05417 10.8315 2.01451 6.70369C1.62646 5.24681 1.80746 3.69688 2.5207 2.36865Z" fill="white"/>
										<path d="M18.087 10.8206C18.5403 11.0358 19.0822 10.843 19.2976 10.3899C21.0187 6.76207 19.4731 2.42584 15.8453 0.704714C13.8717 -0.231608 11.5818 -0.230978 9.60873 0.706485C9.15045 0.91118 8.94485 1.44862 9.14955 1.9069C9.35424 2.36518 9.89168 2.57078 10.35 2.36609C10.363 2.3603 10.3758 2.3542 10.3885 2.34778C13.1087 1.05569 16.3614 2.21339 17.6535 4.93367C18.3567 6.41413 18.3567 8.13239 17.6535 9.61284C17.4406 10.0661 17.6344 10.6062 18.087 10.8206Z" fill="white"/>
										<path d="M14.0087 9.84623C14.3637 10.201 14.9389 10.201 15.2938 9.84623C16.7129 8.42667 16.7129 6.12554 15.2938 4.70598C13.8559 3.33173 11.5914 3.33173 10.1535 4.70598C9.80486 5.06699 9.81486 5.64234 10.1759 5.99103C10.5281 6.33118 11.0864 6.33118 11.4386 5.99103C12.1577 5.30412 13.2898 5.30412 14.0088 5.99103C14.7184 6.70081 14.7184 7.85136 14.0088 8.56118C13.6525 8.91475 13.6479 9.48766 14.0014 9.8439C14.003 9.84552 14.0046 9.84713 14.0087 9.84623Z" fill="white"/>
										</g>
										<defs>
										<clipPath id="clip0_226_113">
										<rect width="20" height="20" fill="white"/>
										</clipPath>
										</defs>
										</svg>
								
								<?php echo esc_html( $link_title ); ?></a>

								<?php endif; ?>
							</div>
						

					</div>
				</div>
				<div class="menu-btn">
					<span class="top"></span>
					<span class="middle"></span>
					<span class="bottom"></span>
				</div>
			</div>
		</div>

	<?php if ( is_page_template( 'templates/template-regional-hub.php' ) || $alrv_hub_pg_op == 'regional_hub') {
		    // regional.php is used
		} else {
		    // regional.php is not used
		 if ( $alrv_psn_menu_items ) { ?>
			<div class="header-links d-flex justify-content-center align-items-center flex-wrap">
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
						<span class="hd-link-icon">
						<?php echo wp_get_attachment_image( $menuitem_icon, 'thumb_32_32' ); ?>
						</span>
						<?php echo $menuitem_heading; ?>
					</a>
				</div>
				<?php } ?>
			</div>
			<div class="header-links-mobile">
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
								<span class="hd-link-icon">
									<?php echo wp_get_attachment_image( $menuitem_icon, 'thumb_32_32' ); ?>
								</span>
								<?php echo $menuitem_heading; ?>
							</a>
						</div>
					</div>
					<?php } ?>
				</div>
		<?php } ?>
		</div>
		<!-- Header End -->
	<?php } ?>
	</header>
	<!-- Header End -->
	
	<!-- Main Area Start -->
	<main id="main-section" class="main-section">
