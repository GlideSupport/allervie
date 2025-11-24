<?php
/**
 * Extra functions for the project
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Allervie
 * @since 1.0.0
 */


/**
 * Custom CSS Styling for Admin Page
 *
 * This function adds some new css styles to admin page.
 */
function glide_custom_admin_css() {
	echo '
	<style>

  	</style>
	';
}

add_action( 'admin_head', 'glide_custom_admin_css' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 */
function glide_theme_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'glide_theme_content_width', 900 );
}

add_filter( 'wp_nav_menu_objects', 'mlnc_wp_nav_menu_objects', 10, 2 );

function mlnc_wp_nav_menu_objects( $items, $args ) {
	if ( isset( $args->menu->slug ) ) {
		if ( 'header-nav' == $args->menu->slug ) {
			// loop
			foreach ( $items as $item ) {

				// vars
				$menuitem_icon = get_field( 'alrv_mio_icon', $item );
				$menuitem_link = get_field( 'alrv_mio_link', $item );
				if ( $menuitem_link ) {
					// $menuitem_link_url    = $menuitem_link['url'];
					// $menuitem_link_title  = $menuitem_link['title'];
					// $menuitem_link_target = $menuitem_link['target'] ? $menuitem_link['target'] : '_self';
				}
				// append field
				if ( $menuitem_link ) {
					// $item->url = null;
					// var_dump( $item );
					$current_title = $item->title;
					$item->title   = '<div class="menu-item menu-btn-item">
					<div class="d-flex align-items-center">
						<div class="menu-icon">
							' . wp_get_attachment_image( $menuitem_icon, 'thumb_32_32' ) . '
						</div>
						<div class="menu-btn-text">
							<p>' . $current_title . '</p>
							<span class="learn-more">
								' . $menuitem_link . '
							</span>
						</div>
					</div>
				</div>';
					// $item->title .= ' <span>' . $your_field . '</span>';
				}
			}
		}
	}

	// return
	return $items;
}

// message field label render
add_filter('acf/get_field_label', 'message_field_html_entity', 10, 3);
function message_field_html_entity($label, $field, $context) {
	return html_entity_decode($label);
}
