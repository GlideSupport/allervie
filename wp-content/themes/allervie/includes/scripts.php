<?php
/**
 * Setup function for the project
 *
 * @link https://developer.wordpress.org/themes/basics/including-css-javascript/
 *
 * @package Allervie
 * @since 1.0.0
 */


/**
 * Theme assets
 *
 * Define variable to store asset directory folder in it.
 *
 * That can be used afterward to call stylesheet / scripts etc
 */

// Time format for the_time()
DEFINE( 'project_dtformat', 'F j, Y' );

// Define assets folder
DEFINE( 'assetDir', get_template_directory_uri() . '/assets' );

// Define bundle version
DEFINE( 'ASSET_VERSION_JS', filemtime( get_template_directory() . '/assets/js/bundle.js' ));
DEFINE( 'ASSET_VERSION_CSS', filemtime( get_template_directory() . '/assets/css/bundle.css' ) );



/**
 * Theme assets
 *
 * Enqueue and Dequeue required files
 */
function glide_assets() {
	//Maps API Key From Theme options 
	$alrv_google_maps_api_key = get_field('alrv_google_maps_api_key','option');

	// Enqueue theme styles
	wp_enqueue_style( 'glide-theme-stylesheet', assetDir . '/css/bundle.min.css?v=' . ASSET_VERSION_CSS, false, null );

	// Eliminate the emoji script
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );

	// Enqueue comments reply script on single post pages
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( ! is_admin() && ! is_user_logged_in() ) {

		// Deregister dashicons on frontend
		wp_deregister_style( 'dashicons' );
	}
	wp_enqueue_script( 'jquery' );

	// Register project scripts
	wp_register_script( 'glide-theme-scripts', assetDir . '/js/bundle.js?v=' . ASSET_VERSION_JS, array( 'jquery' ), null, false );

	// if ( is_page_template( 'templates/template-home.php' ) ) {
	// 	wp_enqueue_script( 'owl-carousel-js', get_template_directory_uri() . '/assets/js/vendor/owl.carousel.js', '1.0.0', true );
	// 	wp_enqueue_script( 'owl-carousel-js', get_template_directory_uri() . '/assets/js/vendor/owl.carousel.js', '1.0.0', true );
	// 	wp_enqueue_script( 'home-hero-scripts', get_template_directory_uri() . '/templates/js/home.js', '1.0.0', true );
	// }
	// if ( is_page_template( 'templates/template-team.php' ) ) {
	// 	wp_enqueue_script( 'magnific-popup-js', get_template_directory_uri() . '/assets/js/vendor/jquery-magnificpopup.js', '1.0.0', true );
	// 	wp_enqueue_script( 'team-js', get_template_directory_uri() . '/templates/js/team.js', '1.0.0', true );
	// }
	wp_register_script('googleapis', 'https://maps.googleapis.com/maps/api/js?key=' . $alrv_google_maps_api_key . '&libraries=places,geometry&callback=initMap', array('jquery'), null, true);

	// load location filters scripts
	wp_register_script( 'locations-scripts', get_template_directory_uri() . '/assets/js/location.js?v=' . ASSET_VERSION_JS, array(),null, true );
	wp_register_script( 'custom-js-scripts', get_template_directory_uri() . '/assets/js/partials/custom-js.js', array(), '', true );

	if(is_page_template('templates/template-locations.php') || is_page_template('templates/template-ppc.php') || is_singular('location') || is_page_template('templates/template-regional-hub.php') || is_page_template('templates/template-state-hub.php') || is_singular('hub')){
		// wp_register_script('googleapis', 'https://maps.googleapis.com/maps/api/js?key=' . $alrv_google_maps_api_key . '&libraries=places,geometry&callback=initMap', array('jquery'), null, false);

		// load location filters scripts
		// wp_register_script( 'locations-scripts', get_template_directory_uri() . '/assets/js/location.js?v=' . ASSET_VERSION_JS, array(),null, true );
		wp_enqueue_script( 'custom-js-scripts');
	}
	if(is_page_template('templates/template-closure.php')) {
	    wp_enqueue_script('jquery-ui-datepicker');
	}
	// Localize
	wp_localize_script(
		'glide-theme-scripts',
		'localVars',
		array(
			'ajax_url' => admin_url( 'admin-ajax.php' ),
		)
	);

	// Enqueue project scripts
	wp_enqueue_script( 'glide-theme-scripts' );

}

add_action( 'wp_enqueue_scripts', 'glide_assets' );


add_action( 'wp_enqueue_scripts', 'glide_assets' );

function wpdocs_enqueue_custom_admin_style() {
	wp_enqueue_style( 'sample-editor-styles', get_template_directory_uri() . '/assets/css/editor-style.min.css', false, '1.0.0' );
	wp_enqueue_script( 'sample-editor-script', get_template_directory_uri() . '/assets/js/editor-scripts.js', array( 'jquery' ),null,false);
	wp_localize_script(
		'sample-editor-script',
		'localVars',
		array(
			'ajax_url' => admin_url( 'admin-ajax.php' ),
		)
	);
}
add_action( 'admin_enqueue_scripts', 'wpdocs_enqueue_custom_admin_style' );
