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
// $alrv_psn_menu_items = ( isset( $fields['alrv_psn_menu_items'] ) ) ? $fields['alrv_psn_menu_items'] : null;

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
	is_home() ? 'page-template-template-blog' : '',
);

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
	<header id="header-section" class="header-section">
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
		<?php if ( has_nav_menu( 'top-nav' ) ) { ?>
		<div class="top-bar">
			<div class="big-wrapper d-flex justify-content-end">
				<?php
				if (!empty($alrv_to_hdr_notifybtn['title'])) :
					echo glide_acf_button( $alrv_to_hdr_notifybtn, 'button hiring-btn aqua-btn' );
				endif;

				wp_nav_menu(
					array(
						'theme_location' => 'top-nav',
						'fallback_cb'    => 'nav_fallback',
					)
				);
				?>
			</div>
		</div>
		<?php } ?>
		<div class="header-wrapper header-inner d-flex align-items-top justify-content-between">
			<div class="header-logo d-flex align-items-start">
				<div class="logo">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
					<img width="170" height="55" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/allervie-logo.svg"	alt="<?php echo get_bloginfo( 'name' ); ?>" /></a>
				</div>
				
			</div>
			<div class="right-header header-navigation">
				<div class="nav-overlay">
					<div class="nav-container">
						<div class="header-nav d-flex align-items-start">
							<?php
								wp_nav_menu(
									array(
										'theme_location' => 'header-nav',
										'fallback_cb'    => 'nav_fallback',
									)
								);
								?>
						</div>

						<div class="menu-mobile secondary-nav">
							<?php
							if (!empty($alrv_to_hdr_notifybtn['title'])) :
								echo glide_acf_button( $alrv_to_hdr_notifybtn, 'button hiring-btn aqua-btn' );
							endif;
							wp_nav_menu(
								array(
									'theme_location' => 'top-nav',
									'fallback_cb'    => 'nav_fallback',
								)
							);
							?>
						</div>
						<div class="header-btns">
							<?php
							if ( $alrv_to_hdr_firstbtn ) :
								echo glide_acf_button( $alrv_to_hdr_firstbtn, 'trp-btn loc-btn small-btn' );
								endif;
							?>
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
		<!-- Header End -->
	</header>
	<?php
		$alrv_to_hdr_col_1_title = ( isset( $option_fields['alrv_to_hdr_col_1_title'] ) ) ? $option_fields['alrv_to_hdr_col_1_title'] : null;
		$alrv_to_hdr_col_1_title_url = (isset($option_fields['alrv_to_hdr_col_1_title_url'])) ? $option_fields['alrv_to_hdr_col_1_title_url'] : null;
		$alrv_to_hdr_col_1_menu  = ( isset( $option_fields['alrv_to_hdr_col_1_menu'] ) ) ? $option_fields['alrv_to_hdr_col_1_menu'] : null;
		$alrv_to_hdr_col_2_title = ( isset( $option_fields['alrv_to_hdr_col_2_title'] ) ) ? $option_fields['alrv_to_hdr_col_2_title'] : null;
		$alrv_to_hdr_col_2_title_url = (isset($option_fields['alrv_to_hdr_col_2_title_url'])) ? $option_fields['alrv_to_hdr_col_2_title_url'] : null;
		$alrv_to_hdr_col_2_menu  = ( isset( $option_fields['alrv_to_hdr_col_2_menu'] ) ) ? $option_fields['alrv_to_hdr_col_2_menu'] : null;
		$alrv_to_hdr_col_3_title = ( isset( $option_fields['alrv_to_hdr_col_3_title'] ) ) ? $option_fields['alrv_to_hdr_col_3_title'] : null;
		$alrv_to_hdr_col_3_title_url = (isset($option_fields['alrv_to_hdr_col_3_title_url'])) ? $option_fields['alrv_to_hdr_col_3_title_url'] : null;
		$alrv_to_hdr_col_3_menu  = ( isset( $option_fields['alrv_to_hdr_col_3_menu'] ) ) ? $option_fields['alrv_to_hdr_col_3_menu'] : null;
		$alrv_to_hdr_col_4_title = ( isset( $option_fields['alrv_to_hdr_col_4_title'] ) ) ? $option_fields['alrv_to_hdr_col_4_title'] : null;
		$alrv_to_hdr_col_4_title_url = (isset($option_fields['alrv_to_hdr_col_4_title_url'])) ? $option_fields['alrv_to_hdr_col_4_title_url'] : null;
		$alrv_to_hdr_col_4_menu  = ( isset( $option_fields['alrv_to_hdr_col_4_menu'] ) ) ? $option_fields['alrv_to_hdr_col_4_menu'] : null;
		$alrv_to_hdr_video_title = ( isset( $option_fields['alrv_to_hdr_video_title'] ) ) ? $option_fields['alrv_to_hdr_video_title'] : null;
		$alrv_to_hdr_video_text  = ( isset( $option_fields['alrv_to_hdr_video_text'] ) ) ? $option_fields['alrv_to_hdr_video_text'] : null;
		$alrv_to_hdr_video_img   = ( isset( $option_fields['alrv_to_hdr_video_img'] ) ) ? $option_fields['alrv_to_hdr_video_img'] : null;
		$alrv_to_hdr_video_url   = ( isset( $option_fields['alrv_to_hdr_video_url'] ) ) ? $option_fields['alrv_to_hdr_video_url'] : null;

		
	?>
	<?php if ( $alrv_to_hdr_col_1_title || $alrv_to_hdr_col_1_menu || $alrv_to_hdr_col_2_title || $alrv_to_hdr_col_2_menu || $alrv_to_hdr_col_3_title || $alrv_to_hdr_col_3_menu || $alrv_to_hdr_col_4_title || $alrv_to_hdr_col_4_menu || $alrv_to_hdr_video_title || $alrv_to_hdr_video_img || $alrv_to_hdr_video_url ) { ?>
	<section class="mega-dropdown">
		<div class="wrapper">
			<div class="dropdown-inner d-flex justify-content-between">
				<div class="dd-left-col">
					<div class="dropdown-menus">

						<div class="dd-menu-one dropdown-nav">
							<?php if ( $alrv_to_hdr_col_1_title ) { ?>
							<div class="dd-menu-title">
								<p class="heading-6">
									<?php if($alrv_to_hdr_col_1_title_url){ ?>
										<a href="<?php echo $alrv_to_hdr_col_1_title_url;?>">
											<?php echo $alrv_to_hdr_col_1_title; ?>
										</a>
									<?php } else{ ?>
										<?php echo $alrv_to_hdr_col_1_title;?>
									<?php } ?>
								</p>
							</div>
							<?php } ?>

							<?php if ( $alrv_to_hdr_col_1_menu ) { ?>
								<?php echo html_entity_decode( $alrv_to_hdr_col_1_menu ); ?>
							<?php } ?>

						</div>
						<div class="dd-menu-two dropdown-nav">
							<?php if ( $alrv_to_hdr_col_2_title ) { ?>
							<div class="dd-menu-title">
								<p class="heading-6">
									<?php if($alrv_to_hdr_col_2_title_url){ ?>
										<a href="<?php echo $alrv_to_hdr_col_2_title_url;?>">
											<?php echo $alrv_to_hdr_col_2_title; ?>
										</a>
									<?php } else{ ?>
										<?php echo $alrv_to_hdr_col_2_title;?>
									<?php } ?>
								</p>
							</div>
							<?php } ?>

							<?php if ( $alrv_to_hdr_col_2_menu ) { ?>
								<?php echo html_entity_decode( $alrv_to_hdr_col_2_menu ); ?>
							<?php } ?>
						</div>
						<div class="dd-menu-three dropdown-nav">
							<?php if ( $alrv_to_hdr_col_3_title ) { ?>
							<div class="dd-menu-title">
								<p class="heading-6">
									<?php if($alrv_to_hdr_col_3_title_url){ ?>
										<a href="<?php echo $alrv_to_hdr_col_3_title_url;?>">
											<?php echo $alrv_to_hdr_col_3_title; ?>
										</a>
									<?php } else{ ?>
										<?php echo $alrv_to_hdr_col_3_title;?>
									<?php } ?>
								</p>
							</div>
							<?php } ?>
							<?php if ( $alrv_to_hdr_col_3_menu ) { ?>
								<?php echo html_entity_decode( $alrv_to_hdr_col_3_menu ); ?>
							<?php } ?>
						</div>
						<div class="dd-menu-four dropdown-nav">
							<?php if ( $alrv_to_hdr_col_4_title ) { ?>
							<div class="dd-menu-title">
								<p class="heading-6">
									<?php if($alrv_to_hdr_col_4_title_url){ ?>
										<a href="<?php echo $alrv_to_hdr_col_4_title_url;?>">
											<?php echo $alrv_to_hdr_col_4_title; ?>
										</a>
									<?php } else{ ?>
										<?php echo $alrv_to_hdr_col_4_title;?>
									<?php } ?>
								</p>
							</div>
							<?php } ?>
							<?php if ( $alrv_to_hdr_col_4_menu ) { ?>
								<?php echo html_entity_decode( $alrv_to_hdr_col_4_menu ); ?>
							<?php } ?>
						</div>
                        
					</div>
				</div>
				<div class="dd-right-col">
					<?php if ( $alrv_to_hdr_video_title ) { ?>
					<h5><?php echo $alrv_to_hdr_video_title; ?></h5>
					<?php } ?>
					<?php if ( $alrv_to_hdr_video_text ) { ?>
					<p><?php echo $alrv_to_hdr_video_text; ?></p>
					<?php } ?>
					<a href="
								<?php
								if ( $alrv_to_hdr_video_url ) {
									echo $alrv_to_hdr_video_url; }
								?>
								" class="dd-video-popup"
						style="background-image: url(<?php echo wp_get_attachment_image_url( $alrv_to_hdr_video_img, 'thumb_600' ); ?>);">
						<div class="play-icon d-flex justify-content-center align-items-center">
							<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/play-icon.svg"
								alt="">
						</div>
					</a>
				</div>
			</div>
		</div>
		</div>
	</section>
	<?php } ?>
	<!-- Main Area Start -->
	<main id="main-section" class="main-section">
